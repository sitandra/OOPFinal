<?php

namespace PatientBook\Views;

use JetBrains\PhpStorm\ArrayShape;

interface iMainView extends iView
{
    #[ArrayShape(['action' => "string"])]
    public function getData(): array;
}