<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Controller\DefaultController;

class APIController extends DefaultController
{
	const TEST_USER = 'dormantlemon';
	const TEST_TEAM = 'SpMot';
	const TEST_GOD = '1670'; //ymir
	const TEST_MATCH = '';
	const TEST_SEARCH_TERM = 'sh';
	const TEST_MATCHID = 206044613;
	const TEST_MODE_QUEUE = 435;
	const TEST_MODE_TIER = 1;
	const TEST_MODE_SEASON = 2;
	
	
    public function testAction($_requestName)
    {
		$data = '[]';
		switch ($_requestName) {
			case 'getplayer':
				$data = $this->_apiHelper->getPlayer($this::TEST_USER);	
				break;
			case 'getgods':
				$data = $this->_apiHelper->getGods();	
				break;
			case 'getitems':
				$data = $this->_apiHelper->getItems();				
				break;
			case 'getdemodetails':
				$data = $this->_apiHelper->getDemoDetails($this::TEST_MATCHID);	
				break;
			case 'getesportsproleaguedetails':	
				$data = $this->_apiHelper->getEsportsProLeagueDetails();		
				break;
			case 'getfriends':
				$data = $this->_apiHelper->getFriends($this::TEST_USER);	
				break;
			case 'getgodranks':
				$data = $this->_apiHelper->getGodRanks($this::TEST_USER);
				break;
			case 'getgodrecommendeditems':	
				$data = $this->_apiHelper->getGodRecommendedItems($this::TEST_GOD);	
				break;
			case 'getmatchdetails':		
				$data = $this->_apiHelper->getMatchDetails($this::TEST_MATCHID);	
				break;
			case 'getmatchplayerdetails':		
				$data = $this->_apiHelper->getMatchPlayerDetails($this::TEST_MATCHID);	
				break;
			case 'getmatchidsbyqueue':
				$data = $this->_apiHelper->getMatchIdsByQueue(435, date('d-m-Y'), 2);	
				break;
			case 'getleagueleaderboard':	
				$data = $this->_apiHelper->getLeagueLeaderboard($this::TEST_USER);	
				break;
			case 'getleagueseasons':
				$data = $this->_apiHelper->getLeagueSeasons($this::TEST_MODE_QUEUE, $this::TEST_MODE_TIER, $this::TEST_MODE_SEASON);	
				break;
			case 'getmatchhistory':	
				$data = $this->_apiHelper->getMatchHistory($this::TEST_USER);	
				break;
			case 'getmotd':	
				$data = $this->_apiHelper->getMotd();	
				break;
			case 'getplayerstatus':	
				$data = $this->_apiHelper->getPlayerStatus($this::TEST_USER);	
				break;
			case 'getqueuestats':		
				$data = $this->_apiHelper->getQueueStats($this::TEST_USER, $this::TEST_MODE_QUEUE);	
				break;
			case 'getteamdetails':		
				$data = $this->_apiHelper->getTeamDetails($this::TEST_TEAM);	
				break;
			case 'getteamplayers':	
				$data = $this->_apiHelper->getTeamPlayers($this::TEST_TEAM);		
				break;
			case 'gettopmatches':
				$data = $this->_apiHelper->getTopMatches();			
				break;
			case 'searchteams':
				$data = $this->_apiHelper->searchTeams($this::TEST_SEARCH_TERM);	
				break;
			case 'getplayerachievements':		
				$data = $this->_apiHelper->getPlayerAchievements($this::TEST_USER);	
				break;
			case 'getdataused':	
				$data = $this->_apiHelper->getDataUsed();	
				break;
		}
		return new JsonResponse(array('response' => $data));
    }
}
