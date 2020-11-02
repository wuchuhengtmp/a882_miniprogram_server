<?php


namespace App\Exceptions;


class InnerErrorException extends BaseException
{
    public function __construct($message = "系统内部异常", $code = 40002, $showType = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $showType, $previous);
    }
}
