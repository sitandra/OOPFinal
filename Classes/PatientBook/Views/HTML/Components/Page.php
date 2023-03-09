<?php

namespace PatientBook\Views\HTML\Components;

use PatientBook\Models\PatientBookCommand;

class Page
{
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function menu(): string
    {
        $result = '';
        foreach (PatientBookCommand::cases() as &$command)
            $result .= '<p><a href="/?action=' . $command->value . '">' . $command->text() . '</a></p>';
        return $result;
    }

    public function print(string $content): void
    {
        echo '<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="Content-Language" content="ru"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $this->title . '</title>
    </head>
    <body>
    ' . $this->menu() . '
    ' . $content . '
    </body>
</html>
    ';
    }
}