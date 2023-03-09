<?php

namespace PatientBook\Views;

use JetBrains\PhpStorm\ArrayShape;

interface iPatientAddView extends iView
{
    #[ArrayShape([
        'name' => "string",
        'surname' => "string",
        'birthdate' => "string",
        'action' => "string",
        'submit' => "string"
    ])] public function getData(): array;
}