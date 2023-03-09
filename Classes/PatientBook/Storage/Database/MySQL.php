<?php

namespace PatientBook\Storage\Database;

use PatientBook\Exceptions\DBEx;
use PatientBook\Exceptions\DBException;
use PDO;
use PDOException;
use const PB_SETTINGS as PBS;

final class MySQL implements iDatabase
{
    private const OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL
    ];

    /**
     * @throws DBException
     */
    public function connect(): PDO
    {
        $host = PBS['database']['host'] ?? throw new DBException(DBEx::notHost);
        $name = PBS['database']['name'] ?? throw new DBException(DBEx::notName);
        $charset = PBS['database']['charset'] ?? throw new DBException(DBEx::notCharset);
        $user = PBS['database']['user'] ?? throw new DBException(DBEx::notUser);
        $password = PBS['database']['password'] ?? throw new DBException(DBEx::notPassword);
        try {
            $connection = new PDO('mysql:host=' . $host . ';dbname=' . $name . ';charset=' . $charset,
                $user, $password, self::OPTIONS);
            $connection->query("SET NAMES `utf8mb4` COLLATE `utf8mb4_unicode_ci`;");
            return $connection;
        } catch (PDOException $exception) {
            throw new DBException(DBEx::PDO, $exception);
        }
    }
}