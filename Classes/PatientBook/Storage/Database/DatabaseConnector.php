<?php

namespace PatientBook\Storage\Database;


use PatientBook\Exceptions\DBException;
use PatientBook\Storage\StorageController;
use PDO;

abstract class DatabaseConnector extends StorageController
{
    private static PDO $database_entry_point;

    /**
     * @throws DBException
     */
    public static function init(iDatabase $database): void
    {
        self::$database_entry_point = $database->connect();
    }

    protected static function PDO(): PDO
    {
        return self::$database_entry_point;
    }
}