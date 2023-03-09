<?php

namespace PatientBook\Views\HTML;

use JetBrains\PhpStorm\ArrayShape;
use PatientBook\Views\HTML\Components\Page;
use PatientBook\Views\iPatientAddView;

class PatientAddView extends HTMLView implements iPatientAddView
{
    public function __construct()
    {
        $this->page = new Page('Добавление пациента');
    }

    public function output(): void
    {
        $this->page->print('<form enctype="multipart/form-data" action="/" method="get" >
            <input type="text" name="name" value="" placeholder="Введите имя" />
            <input type="text" name="surname" value="" placeholder="Введите фамилию" />
            <input type="date" name="birthdate" value="" placeholder="Введите дату рождения" />
            <input type="hidden" name="action" value="add" />
            <input type="submit" name="submit" value="Сохранить" />
        </form>');
    }

    #[ArrayShape([
        'name' => "string",
        'surname' => "string",
        'birthdate' => "string",
        'action' => "string",
        'submit' => "string"
    ])] public function getData(): array
    {
        return $_GET;
    }
}