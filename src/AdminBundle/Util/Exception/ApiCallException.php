<?php

namespace AdminBundle\Util\Exception;


class ApiCallException extends \Exception
{
	protected $_httpCode;

	public function __construct($message, $code = 0, $previous = null)
	{
		$this->_httpCode = $code;
		parent::__construct($message, $code, $previous);
	}
}