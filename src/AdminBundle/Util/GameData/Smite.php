<?php

namespace AdminBundle\Util\GameData;

use AdminBundle\Util\AbstractGameData;
use AdminBundle\Util\Exception\InvalidResponseException;
use AdminBundle\Util\GameData\Smite\Session;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class Smite extends AbstractGameData
{
	//Smite constants
	const API_PARAM_LANGUAGE = [
		'EN' 		=> 1,
		'GER' 		=> 2,
		'FR' 		=> 3,
		'SPA' 		=> 7,
		'SPA_LATAM' => 9,
		'PORTU' 	=> 10,
		'RU' 		=> 11,
		'POL' 		=> 12,
		'TURK' 		=> 13
	];

    const API_REQUEST_SESSION = 'createSession';
    const API_REQUEST_GODS = 'getgods';

	const BASE_URI = 'http://api.smitegame.com/smiteapi.svc/';


	/** @var string */
	protected $_devId;

	/** @var string */
	protected $_authKey;


	public function __construct(Container $serviceContainer)
	{
		$this->_devId = $serviceContainer->getParameter('smite_dev_id');
        $this->_authKey = $serviceContainer->getParameter('smite_auth_key');
	}


    /**
     * Test that Api is connectable, using the getdataused Smite Api request.
     *
     * @return bool
     */
	public function testConnection()
	{
		$endpoint = $this->_constructUrl('getdataused');

		return (json_decode($this->_callApi($endpoint), true) != null);
	}


    /**
     * Request god list from the Smite Api.
     *
     * @return mixed
     */
	public function getCharacters()
	{
		$endpoint = $this->_constructUrl(self::API_REQUEST_GODS, [self::API_PARAM_LANGUAGE['EN']]);

		return json_decode($this->_callApi($endpoint), true);
	}


    /**
     * Request a new session object from the Smite Api.
     *
     * @return mixed
     */
    private function _createSession()
    {
        $endpoint = $this->_constructUrl(self::API_REQUEST_SESSION);

        return json_decode($this->_callApi($endpoint, [], false), true);
    }


	/**
	 * Construct a url to request from.
	 *
	 * @param string  $method
     * @param bool    $useLanguage
	 *
	 * @return string  Url to send request to
	 */
	private function _constructUrl($method, $params = [])
	{
        $timestamp = $this->_getTimestamp();

        array_unshift($params, $timestamp);
        if ($method != self::API_REQUEST_SESSION) {
            array_unshift($params, $this->_getSession()->getId());
        }

	    $baseUrl = self::BASE_URI . strtolower($method) . 'Json/' .
            $this->_devId . '/' .
            $this->_createHash(strtolower($method), $timestamp) . '/';

	    if ($args = implode('/', $params)) {
            $baseUrl .= $args;
        }

        return $baseUrl;
	}


	/**
	 * Get a timestamp of now.
     *
     * @param string|bool  $format  Should format timestamp or not
     *
     * @return string|\Datetime
	 */
	private function _getTimestamp($format = 'YmdHis')
	{
		$timestamp = new \DateTime("now", new \DateTimeZone("UTC"));
		if ($format === false) return $timestamp->getTimestamp();
		return $timestamp->format($format);
	}

    /**
     * Create a request hash.
     *
     * @param string $method     Api method string
     * @param string $timestamp  Timestamp as YmdHis
     *
     * @return string
     */
	private function _createHash($method, $timestamp)
    {
        return md5($this->_devId . $method . $this->_authKey . $timestamp);
    }
	

	/**
	 * Get a Smite API session object.
	 */
	private function _getSession()
	{
	    //Prep a cache
        $cache = new FilesystemAdapter();
        $now = $this->_getTimestamp(false);

        //Fetch existing session (if exits)
	    $session = Session::fromCache($cache);
	    if ($session && !$session->isExpired($now)) {
            return $session;
        }

        //Request and store a new Session
	    $data = $this->_createSession();
	    if (is_array($data) && isset($data['session_id'])) {
            $session = new Session($data['session_id'], $now);
            $session->persist($cache);

            return $session;
        }

        throw new InvalidResponseException('Unable to create a valid Smite Session.');
	}
}