<?php


namespace App\Exceptions;

class ValidateException extends BaseException
{
    public $_showType = 4;
    public function __construct($message = "验证失败", $code = 40002, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
