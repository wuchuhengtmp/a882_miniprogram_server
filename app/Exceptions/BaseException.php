<?php

namespace App\Exceptions;

use \Exception;

class BaseException extends Exception
{
    public  $_errorMessage;
    public $_errorCode;
    public $_showType = 0;

    public function __construct($message = "系统内部异常", $code = 40002, $showType = 0,  Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->_errorMessage = $message;
        $this->_errorCode = $code;
        if ($showType > 0 ) $this->_showType = $showType;
    }
}
