<?php

namespace PatientBook\Models;

enum PatientBookCommand: string
{
    case ADD = 'add';
    case REMOVE = 'remove';
    case SHOW = 'show';
    
    public function text(): string
    {
        return match ($this) {
            self::ADD => 'Добавить пациента',
            self::REMOVE => 'Удалить пациента',
            self::SHOW => 'Показать книгу',
        };
    }

}