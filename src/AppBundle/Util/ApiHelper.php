<?php
 
// src/AppBundle/Util/ApiHelper.php
 
namespace AppBundle\Util;
 
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
 
class ApiHelper
{
	const QUEUE_ID_CONQUEST5V5 = 423;
	const QUEUE_ID_NOVICEQUEUE = 424;
	const QUEUE_ID_CONQUEST = 426;
	const QUEUE_ID_PRACTICE = 427;
	const QUEUE_ID_CHALLENGE_CONQUEST = 429;
	const QUEUE_ID_RANKED_CONQUEST = 430;
	const QUEUE_ID_DOMINATION = 433;
	const QUEUE_ID_MOTD_CLOSING = 434;
	const QUEUE_ID_ARENA = 435;
	const QUEUE_ID_CHALLENGE_ARENA = 438;
	const QUEUE_ID_CHALLENGE_DOMINATION = 439;
	const QUEUE_ID_LEAGUE_JOUST = 440;
	const QUEUE_ID_CHALLENGE_JOUST = 441;
	const QUEUE_ID_ASSAULT = 445;
	const QUEUE_ID_CHALLENGE_ASSAULT = 446;
	const QUEUE_ID_JOUST3V3 = 448;
	const QUEUE_ID_LEAGUE_CONQUEST = 451;
	const QUEUE_ID_LEAGUE_ARENA = 452;
	const QUEUE_ID_MOTD = 465;
	
	const LANGUAGE_EN = 1;
	const LANGUAGE_GER = 2;
	const LANGUAGE_FR = 3;
	const LANGUAGE_SPA = 7;
	const LANGUAGE_SPA_LATAM = 9;
	const LANGUAGE_PORTU = 10;
	const LANGUAGE_RU = 11;
	const LANGUAGE_POL = 12;
	const LANGUAGE_TURK = 13;
	
	const LEAGUE_TIER_BRONZE1 = 1;
	const LEAGUE_TIER_BRONZE2 = 2;
	const LEAGUE_TIER_BRONZE3 = 3;
	const LEAGUE_TIER_BRONZE4 = 4;
	const LEAGUE_TIER_BRONZE5 = 5;
	const LEAGUE_TIER_SILVER1 = 6;
	const LEAGUE_TIER_SILVER2 = 7;
	const LEAGUE_TIER_SILVER3 = 8;
	const LEAGUE_TIER_SILVER4 = 9;
	const LEAGUE_TIER_SILVER5 = 10;
	const LEAGUE_TIER_GOLD1 = 11;
	const LEAGUE_TIER_GOLD2 = 12;
	const LEAGUE_TIER_GOLD3 = 13;
	const LEAGUE_TIER_GOLD4 = 14;
	const LEAGUE_TIER_GOLD5 = 15;
	const LEAGUE_TIER_PLATINUM1 = 16;
	const LEAGUE_TIER_PLATINUM2 = 17;
	const LEAGUE_TIER_PLATINUM3 = 18;
	const LEAGUE_TIER_PLATINUM4 = 19;
	const LEAGUE_TIER_PLATINUM5 = 20;
	const LEAGUE_TIER_DIAMOND1 = 21;
	const LEAGUE_TIER_DIAMOND2 = 22;
	const LEAGUE_TIER_DIAMOND3 = 23;
	const LEAGUE_TIER_DIAMOND4 = 24;
	const LEAGUE_TIER_DIAMOND5 = 25;
	const LEAGUE_TIER_MASTERS = 26;
	
	
    private $devId = null;
	private $authKey  = null;
	private $baseURI = null;
	
    private $_entityManager;
	
	public function __construct(
		EntityManager $entityManager,
        Container $serviceContainer
    )
    {
        $this->_entityManager = $entityManager;
        $this->devId = $serviceContainer->getParameter('smite_dev_id');
        $this->authKey = $serviceContainer->getParameter('smite_auth_key');
        $this->baseURI = $serviceContainer->getParameter('smite_base_uri');
    }

	/**
	 * Return league and other high level data for a player
	 */
	public function getPlayer($_name)
    {
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getplayer', $timestamp);
		$url = $this->baseURI . 'getplayerJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_name;	

		return $this->decodeResponse($this->getRequest($url));
    }
	
	/**
	 * Return gods and their info
	 */
	public function getGods()
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getgods', $timestamp);
		$url = $this->baseURI . 'getgodsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $this::LANGUAGE_EN;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return a list of items
	 */
	public function getItems()
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getitems', $timestamp);
		$url = $this->baseURI . 'getitemsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $this::LANGUAGE_EN;	
		
		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return information regarding a particular match. getMatchDetails advised to use instead
	 */
	public function getDemoDetails($_matchId)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getdemodetails', $timestamp);
		$url = $this->baseURI . 'getdemodetailsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . _matchId;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return matchup information to each matchup in the current league season
	 */
	public function getEsportsProLeagueDetails()
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getesportsproleaguedetails', $timestamp);
		$url = $this->baseURI . 'getesportsproleaguedetailsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return friends of a player
	 */
	public function getFriends($_name)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getfriends', $timestamp);
		$url = $this->baseURI . 'getfriendsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_name;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return ranks for a god id
	 */
	public function getGodRanks($_name)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getgodranks', $timestamp);
		$url = $this->baseURI . 'getgodranksJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_name;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return recommended items for a god
	 */
	public function getGodRecommendedItems($_godId)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getgodrecommendeditems', $timestamp);
		$url = $this->baseURI . 'getgodrecommendeditemsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_godId . '/' . $this::LANGUAGE_EN;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return match statistics/details for a completed match id
	 */
	public function getMatchDetails($_matchId)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getmatchdetails', $timestamp);
		$url = $this->baseURI . 'getmatchdetailsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_matchId;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return player information for a live match
	 */
	public function getMatchPlayerDetails($_matchId)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getmatchplayerdetails', $timestamp);
		$url = $this->baseURI . 'getmatchplayerdetailsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_matchId;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return match ids for a particular match queue
	 */
	public function getMatchIdsByQueue($_queue, $_date, $_hour)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getmatchidsbyqueue', $timestamp);
		$url = $this->baseURI . 'getmatchidsbyqueueJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_queue . '/' . $_date . '/' . $_hour;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return top players for a particular league
	 */
	public function getLeagueLeaderboard($_queue, $_tier, $_season)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getleagueleaderboard', $timestamp);
		$url = $this->baseURI . 'getleagueleaderboardJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_queue . '/' . $_tier . '/' . $_season;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return a list of seasons for a queue
	 */
	public function getLeagueSeasons($_queue)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getleagueseasons', $timestamp);
		$url = $this->baseURI . 'getleagueseasonsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_queue;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return recent matches and statistics for a player
	 */
	public function getMatchHistory($_player)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getmatchhistory', $timestamp);
		$url = $this->baseURI . 'getmatchhistoryJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_player;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return info on 20 most recent MOTD's
	 */
	public function getMotd()
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getmotd', $timestamp);
		$url = $this->baseURI . 'getmotdJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return info on 20 most recent MOTD's
	 */
	public function getPlayerStatus($_player)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getplayerstatus', $timestamp);
		$url = $this->baseURI . 'getplayerstatusJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_player;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return match summary stats for a (player,queue) grouped by gods played
	 */
	public function getQueueStats($_player, $_queue)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getqueuestats', $timestamp);
		$url = $this->baseURI . 'getqueuestatsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_player . '/' . $_queue;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return player count and high level details for a clan/team
	 */
	public function getTeamDetails($_clanId)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getteamdetails', $timestamp);
		$url = $this->baseURI . 'getteamdetailsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_clanId;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return list of players for a clan/team
	 */
	public function getTeamPlayers($_clanId)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getteamplayers', $timestamp);
		$url = $this->baseURI . 'getteamplayersJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_clanId;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return 50 most watched/most recent recorded matches
	 */
	public function getTopMatches()
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('gettopmatches', $timestamp);
		$url = $this->baseURI . 'gettopmatchesJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return teams containing the search term
	 */
	public function searchTeams($_searchTerm)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('searchteams', $timestamp);
		$url = $this->baseURI . 'searchteamsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_searchTerm;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	/**
	 * Return select achievement totals
	 */
	public function getPlayerAchievements($_player)
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('getplayerachievements', $timestamp);
		$url = $this->baseURI . 'getplayerachievementsJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp . '/' . $_player;	

		return $this->decodeResponse($this->getRequest($url));
	}
	
	
	public function createSession()
	{		
		$timestamp = $this->getTimestamp();
		
		$hash = $this->createHash('createsession', $timestamp);
		$url = $this->baseURI . 'createsessionJson/' . $this->devId . '/' . $hash . '/' . $timestamp;
		
		$data = $this->decodeResponse($this->getRequest($url));
		
		return $data;
	}
	
	public function getDataUsed()
	{
		$sessionId = $this->getSession();
		$timestamp = $this->getTimestamp();	
		
		$hash = $this->createHash('getdataused', $timestamp);
		$url = $this->baseURI . 'getdatausedJson/' . $this->devId . '/' . $hash . '/' . $sessionId . '/' . $timestamp;
		
		$data = $this->decodeResponse($this->getRequest($url));
		
		return $data;
	}
	
	
	//*************************************************************************************************************************
	// BELOW HERE ARE UTILITY AND SYSTEM FUNCTIONS. SHOULD ONLY BE CALLED FROM SELF SOMEWHERE
	//
	//*************************************************************************************************************************
	private function getTimestamp($format = true)
	{
		$timestamp = new \DateTime("now", new \DateTimeZone("UTC"));	
		if ($format) {
			$timestamp = $timestamp->format("YmdHis");
		}
		return $timestamp;
	}
	
	private function createHash($route, $timestamp)
	{
		$hash = md5($this->devId . $route . $this->authKey . $timestamp);
		return $hash;
	}	
	
	private function getRequest($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		$json = curl_exec($ch);
		curl_close($ch);
		
		if (!$json) $json = '[]';	
		return $json;
	}
	
	private function getSession()
	{
		$sessionLifeTime = 895;
		
		$session = $this->_entityManager->getRepository('AppBundle:APISession')->findAll()[0];	
		$now = $this->getTimestamp(false);
		
		//Time elapsed since session created
		$elapsedTime = 
			$now->getTimestamp() - 
			$session->getTimestamp()->getTimestamp();
		
		if ($elapsedTime > $sessionLifeTime) {
			$data = $this->createSession();
			
			//Write new session data to DB
			if ($data["session_id"]) {
				$session->setId($data["session_id"]);
				$session->setTimestamp($now);
				$this->_entityManager->flush();
			}
		}
		
		return $session->getId();
	}
	
	private function decodeResponse($response)
	{
		$data = json_decode($response, true);
		return $data;
	}
}