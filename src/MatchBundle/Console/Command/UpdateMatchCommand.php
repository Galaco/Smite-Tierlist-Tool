<?php

namespace MatchBundle\Console\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\DBAL\DBALException;


use MatchBundle\Entity\Match;
use MatchBundle\Entity\MatchGod;
use MatchBundle\Entity\MatchQueue;
use MatchBundle\Entity\MatchQueueGod;
use MatchBundle\Entity\MatchQueueGodItem;

class UpdateMatchCommand extends ContainerAwareCommand
{
	protected $_api;	//Smite api
	protected $_em;		//EntityManager
	protected $_hourToRequest = 1;
	protected $_queueId;
	protected $_executionDateTime;
	
    protected function configure()
    {
        $this
            ->setName('match:update')
            ->setDescription('Update Match information for queues')
			->addArgument(
                'hourToRequest',
                InputArgument::REQUIRED,
                'What hour of the day to run for'
            )
        ;
	}

    protected function execute(InputInterface $input, OutputInterface $output)
    {
		$this->_prepCommandVars($input, $output);
		
		$data = $this->_api->getMatchIdsByQueue($this->_queueId, $this->_executionDateTime->format("Ymd"), $this->_hourToRequest);
			
		$total = count($data);
		$output->writeln('Date executed (+UTC): ' . $this->_executionDateTime->format("Ymd") . '. Hour to grab: ' . $this->_hourToRequest);
		$output->writeln('Total matches for Queue ' . $this->_queueId . ': ' . $total);
		$count = 0;
		$batchSize = 10;	// Flush in batches of 20
		
		//Loop through all matches
		foreach($data as $jsonMatchInfo) {
			$count++;
			if ($jsonMatchInfo['Active_Flag'] == 'y') {
				$output->writeln($count . '/' . $total . ' | Match: ' . $jsonMatchInfo['Match'] . ' not valid/ongoing. Skipped..');
			} else {
				// Create and save match_info
				$this->_saveMatch($jsonMatchInfo, $this->_executionDateTime);
										
				//Create and save match info for players
				$jsonMatchPlayers = $this->_api->getMatchDetails((int)$jsonMatchInfo['Match']);		
				$this->_saveMatchGods($jsonMatchPlayers);
				
				//Log progress back to system
				$output->writeln($count . '/' . $total . ' | Match: ' . $jsonMatchInfo['Match'] . ' processed.');	
			}
						
			//Flush DB if batch limit reached
			if ($count % $batchSize === 0 || $count == $total - 1) {
				$output->writeln('Flushing objects to database..');
				try {
					$this->_em->flush(); //Flush objects into the database	
				} catch(\Exception $e) {
					$output->writeln('<error>Error flushing to database. Cleaning up list..</error>');
				}
				$this->_em->clear(); //detach objects from doctrine
			}
		}
		
		//Cleanup old matches
		$this->_deleteOldMatches();
		
        $output->writeln('Complete.');
    }
	
	
	/**
	 * Set some members for use across the script. Function not required, but it tidies up the main execution.
	 */
	private function _prepCommandVars($input, $output)
	{
		$this->_em = $this->getContainer()->get('doctrine')->getManager();
		$this->_api = $this->getContainer()->get('appbundle.util.apihelper');
		$this->_hourToRequest = $input->getArgument('hourToRequest');	
		$this->_queueId = '451';
		$this->_executionDateTime = new \DateTime("now", new \DateTimeZone("UTC"));
	}
	
	
	/**
	 * Save match info. Not much, just queue, id, and when it was added.
	 */
	private function _saveMatch($jsonMatch, $datetime)
	{
		if ($jsonMatch['Active_Flag'] == 'y') continue;
				
		// Create and save match_info
		try {
			$match = new Match;
			$match->setId((int)$jsonMatch['Match']);
			$match->setQueueId($this->_queueId);		
			$match->setDateAdded($datetime);
			$this->_em->persist($match);
		}catch(\Exception $e) { 
			$output->writeln('<error>Error saving match: ' . $jsonMatch['Match'] . ' info. Match data already exists</error>');		
			continue;
		}
	}
	
	
	/**
	 * Save match gods. Note if 1 fails to save they all fail. We shouldn't care as any broken match data should mean all match data ignored.
	 */
	private function _saveMatchGods($jsonMatchPlayers) {
		$matchGods = [];	
					
		try {	
			//Construct new match player data for each player in match
			foreach($jsonMatchPlayers as $matchPlayer) {
				$playerId = (int)$matchPlayer['playerId'];
				if (!$playerId || $playerId == "0") continue;
						
				$matchGod = new MatchGod;
				$matchGod->setMatchId($matchPlayer['Match']);
				$matchGod->setPlayerId($playerId);
				$matchGod->setGodId($matchPlayer['GodId']);
				$matchGod->setItem1($matchPlayer['ItemId1']);
				$matchGod->setItem2($matchPlayer['ItemId2']);
				$matchGod->setItem3($matchPlayer['ItemId3']);
				$matchGod->setItem4($matchPlayer['ItemId4']);
				$matchGod->setItem5($matchPlayer['ItemId5']);
				$matchGod->setItem6($matchPlayer['ItemId6']);
				$matchGod->setGoldEarned($matchPlayer['Gold_Earned']);
						
				$matchGods[] = $matchGod;		
			}	
		
			// Persist to database.
			foreach($matchGods as $matchGod) {
				$this->_em->persist($matchGod);
			}
		}catch(\Exception $e) {
			// Log error. We don't want to continue though, missing data for broken matches doesn't matter.
			$output->writeln('<error>Error saving match: ' . $jsonMatchInfo['Match'] . ' info. Player data already exists</error>');
		}
	}
	
	
	/**
	 * Delete any matche info older than specifed date (-1 months). Data older than that is no longer relevant enough for use.
	 */
	private function _deleteOldMatches()
	{		
		try {
			//Get old matches
			$query = $this->_em->createQuery('SELECT m.id FROM MatchBundle:Match m WHERE m.date_added < :date');
			$query->setParameter('date', new \DateTime('-1 month'));
			$data = $query->execute();
			
			//convert old match ids into useable data
			$ids = array_column($data, 'id');
			$list = implode(',', $ids);
			//delete old matches
			$query = $this->_em->createQuery('DELETE MatchBundle:Match m WHERE m.id IN(:params)');
			$query->setParameter('params', $list);
			$query->execute(); 	
		}catch(\Exception $e) {
			// Log error. Something went very wrong, but there is no reason for it to be fatal. 
			// Any rerun would clean up what this failed to.
			$output->writeln('<error>Could not delete old matches. Perhaps there are none?</error>');
		}	
	}
}