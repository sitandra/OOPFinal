<?php

namespace PatientBook\Models;

class PatientBook
{
    /** @var Patient[] $patients */
    private array $patients = [];


    public function add(Patient $patient): static
    {
        $this->patients[] = $patient;
        return $this;
    }

    public function get(): array
    {
        return $this->patients;
    }
}