<?php

namespace PatientBook\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public function __construct(array $exceptions)
    {
        parent::__construct('Некорректные данные. ' . implode(' ', $exceptions));
    }
}