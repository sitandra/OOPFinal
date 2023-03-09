<?php

namespace PatientBook\Exceptions;

enum UIEx: int
{
    case sectionNotImplemented = 0;
    case actionNotImplemented = 1;

    public function message(): string
    {
        return match ($this) {
            self::sectionNotImplemented => 'Секция не реализована',
            self::actionNotImplemented => 'Операция не реализована',
        };
    }
}
