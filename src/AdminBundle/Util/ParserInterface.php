<?php

namespace AdminBundle\Util;

interface ParserInterface {

	/**
	 * Fetch list of characters from an API.
     *
     * @param mixed  $data
	 *
	 * @return array
	 */
	public function toStandardFormat($data);
}