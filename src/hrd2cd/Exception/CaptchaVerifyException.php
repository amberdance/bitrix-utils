<?php

namespace Hard2Code\Exception;

use Exception;
use Throwable;

class CaptchaVerifyException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
