<?php

namespace Hard2Code\Exception;

use Exception;
use Throwable;

class NullPointerException extends Exception
{
    /**
     * @inheritDoc
     */
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
