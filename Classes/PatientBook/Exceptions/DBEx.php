<?php

namespace PatientBook\Exceptions;

enum DBEx: int
{
    case PDO = 0;
    case notHost = 1;
    case notName = 2;
    case notCharset = 3;
    case notUser = 4;
    case notPassword = 5;
    case notInsert = 6;
    case notUpdate = 7;
    case notDelete = 8;
    case notAction = 9;

    public function message(): string
    {
        return match ($this){
            self::PDO => 'Ошибка PDO при подключении к базе данных',
            self::notHost => 'Не указан хост базы данных',
            self::notName => 'Не указано имя базы данных',
            self::notCharset => 'Не указана кодировка базы данных',
            self::notUser => 'Не указан пользователь базы данных',
            self::notPassword => 'Не указан пароль от базы данных',
            self::notInsert => 'Не удалось сохранить данные в таблице',
            self::notUpdate => 'Не удалось изменить данные в таблице',
            self::notDelete => 'Не удалось удалить данные из таблицы',
            self::notAction => 'Не удалось выполнить действие',
        };
    }
}
