<?php

namespace App\Exceptions;

use \Exception;

class BaseException extends Exception
{
    protected $_errorMessage;
    protected $_errorCode;

    public function __construct($message = "系统内部异常", $code = 40002, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->_errorMessage = $message;
        $this->_errorCode = $code;
    }
}
