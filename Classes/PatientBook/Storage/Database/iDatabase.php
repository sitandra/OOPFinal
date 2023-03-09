<?php

namespace PatientBook\Storage\Database;

use PatientBook\Exceptions\DBException;
use PDO;

interface iDatabase
{
    /**
     * @throws DBException
     */
    public function connect(): PDO;
}