<?php

namespace PatientBook\Views;

use Exception;

interface iView
{
    public function output(): void;
    public function getData(): array;
    public function outputOK(): void;
    public function outputException(Exception $exception): void;
}