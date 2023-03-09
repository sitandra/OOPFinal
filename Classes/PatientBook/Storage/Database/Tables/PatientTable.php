<?php

namespace PatientBook\Storage\Database\Tables;

use Exception;
use PatientBook\Exceptions\ValidationException;
use PatientBook\Models\Patient;
use PatientBook\Exceptions\DBEx;
use PatientBook\Exceptions\DBException;
use PatientBook\Storage\Database\DatabaseConnector;
use PDO;

class PatientTable extends DatabaseConnector
{
    /** @var Patient[] $patients */
    private array $patients;

    public function __construct(Patient ...$patient)
    {
        $this->patients = $patient;
    }

    public static function load(int $ID): ?Patient
    {
        $stmt = self::PDO()->prepare('SELECT * FROM `pb_patient` WHERE `ID`=:this;');
        $stmt->bindValue(':this', $ID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchObject(Patient::class);
        return is_object($result) ? $result : null;
    }

    /**
     * @throws Exception
     */
    private static function validate(Patient $patient): void
    {
        $errors = [];
        if ($patient->getName() == '') $errors[] = 'Нельзя добавить пациента без имени.';
        if ($patient->getSurname() == '') $errors[] = 'Нельзя добавить пациента без фамилии.';
        if ($patient->getBirthdate()->getTimestamp() > time() - 24 * 60 * 60)
            $errors[] = 'Нельзя добавить пациента без даты рождения.';
        if (!empty($errors)) throw new ValidationException($errors);
    }

    /**
     * @throws DBException
     */
    public function save(): void
    {
        self::PDO()->beginTransaction();
        try {
            $stmt = self::PDO()->prepare('INSERT INTO `pb_patient` (`name`, `surname`, `birthdate`) 
                VALUES (:name, :surname, :birthdate);');
            foreach ($this->patients as &$patient) {
                self::validate($patient);
                $stmt->bindValue(':name', $patient->getName());
                $stmt->bindValue(':surname', $patient->getSurname());
                $stmt->bindValue(':birthdate', $patient->getBirthdate()->format('Y-m-d'));
                $stmt->execute();
                $patient->setID(self::PDO()->lastInsertId());
            }
            self::PDO()->commit();
        } catch (Exception $exception) {
            self::PDO()->rollBack();
            throw new DBException(DBEx::notInsert, $exception);
        }
    }

    /**
     * @throws DBException
     */
    public function delete(): void
    {
        self::PDO()->beginTransaction();
        try {
            $stmt = self::PDO()->prepare('UPDATE `pb_patient` SET 
                        `name`=:name, `surname`=:surname, `birthdate`=:birthdate 
                WHERE `ID`=:this;');
            foreach ($this->patients as &$patient) {
                $stmt->bindValue(':name', $patient->getName());
                $stmt->bindValue(':surname', $patient->getSurname());
                $stmt->bindValue(':birthdate', $patient->getBirthdate()->format('Y-m-d'));
                $stmt->bindValue(':this', $patient->getID(), PDO::PARAM_INT);
                $stmt->execute();
            }
            self::PDO()->commit();
        } catch (Exception $exception) {
            self::PDO()->rollBack();
            throw new DBException(DBEx::notUpdate, $exception);
        }
    }

    /**
     * @throws DBException
     */
    public function update(): void
    {
        self::PDO()->beginTransaction();
        try {
            $stmt = self::PDO()->prepare('DELETE FROM `pb_patient` WHERE `ID`=:this;');
            foreach ($this->patients as &$patient) {
                self::validate($patient);
                $stmt->bindValue(':this', $patient->getID(), PDO::PARAM_INT);
                $stmt->execute();
            }
            self::PDO()->commit();
        } catch (Exception $exception) {
            self::PDO()->rollBack();
            throw new DBException(DBEx::notDelete, $exception);
        }
    }
}