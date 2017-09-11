<?php

namespace AdminBundle\Util;

/**
 * class AbstractGameData
 * @package AdminBundle\Util
 */
abstract class AbstractGameData implements ApiInterface {

    /** @var  ParserInterface */
    protected $_parser;

    public function setParser($parser)
    {
        $this->_parser = $parser;
    }


	/**
	 * Send an external request to a service.
	 *
	 * @return mixed
	 */
	protected function _callApi($url, $params = [], $useParser = true)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		$response = curl_exec($ch);

		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		//Determine grouping (4xx, 5xx, etc.)
		$httpCodeGroup = (int)($httpCode / 100);

		//Handle error codes
		if ($httpCode != 200) {
			if ($httpCodeGroup == 4) {
				throw new Exception\BadRequestException(sprintf('Api returned error code: %s\nMessage was: %s', $httpCode, $response));
			}
			if ($httpCodeGroup == 5) {
				throw new Exception\InvalidResponseException(sprintf('Api returned error code: %s', $httpCode));
			}
		}

		//Also catch an empty response
		if (!$response) {
			throw new Exception\InvalidResponseException('Api returned an empty response');
		}

		if ($this->_parser !== null && $useParser == true) {
		    return $this->_parser->toStandardFormat($response);
        }

		return $response;
	}
}