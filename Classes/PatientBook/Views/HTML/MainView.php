<?php

namespace PatientBook\Views\HTML;

use JetBrains\PhpStorm\ArrayShape;
use PatientBook\Views\HTML\Components\Page;
use PatientBook\Views\iMainView;

class MainView extends HTMLView implements iMainView
{
    public function __construct()
    {
        $this->page = new Page('Журнал пациентов');
    }

    public function output(): void
    {
        $this->page->print('<p>Выберите действие</p>');
    }

    #[ArrayShape(['action' => "string"])] public function getData(): array
    {
        return array_merge($_POST, $_GET);
    }
}