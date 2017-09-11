<?php

namespace AdminBundle\Util;

/**
 * Required methods that any api implementation must define.
 *
 * @package AdminBundle\Util
 */
interface ApiInterface {

	/**
	 * Test the API connection.
	 *
	 * @return bool
	 */
	public function testConnection(); 

	/**
	 * Fetch list of characters from an API.
	 *
	 * @return array
	 */
	public function getCharacters(); 
}