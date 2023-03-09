<?php

namespace PatientBook\Exceptions;

use Exception;
use Throwable;

class UIException extends Exception
{
    public function __construct(UIEx $exception, ?Throwable $previous = null)
    {
        parent::__construct($exception->message(), $exception->value, $previous);
    }
}