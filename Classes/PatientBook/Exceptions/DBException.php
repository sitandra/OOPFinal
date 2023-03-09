<?php

namespace PatientBook\Exceptions;

use Exception;
use Throwable;

class DBException extends Exception
{
    public function __construct(DBEx $exception, ?Throwable $previous = null)
    {
        parent::__construct($exception->message(), $exception->value, $previous);
    }
}