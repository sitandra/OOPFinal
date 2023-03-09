<?php

namespace PatientBook\Models;
use DateTime;

class Patient
{
    private int $ID;
    private string $name;
    private string $surname;
    private DateTime $birthdate;

    /**
     * @param string $name
     * @param string $surname
     * @param DateTime $birthdate
     */
    public function __construct(?int $ID, string $name, string $surname, DateTime $birthdate)
    {
        if (!is_null($ID)) $this->ID = $ID;
        $this->name = trim($name);
        $this->surname = trim($surname);
        $this->birthdate = $birthdate;
    }

    public function __toString(): string
    {
        return $this->surname . ' ' . $this->name . ' ' . $this->birthdate->format('Y-m-d');
    }

    /**
     * @param int $ID
     */
    public function setID(int $ID): void
    {
        $this->ID = $ID;
    }

    /**
     * @return int
     */
    public function getID(): int
    {
        return $this->ID;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return DateTime
     */
    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
    }



}