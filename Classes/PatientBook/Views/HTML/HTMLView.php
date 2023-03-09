<?php

namespace PatientBook\Views\HTML;

use PatientBook\Views\HTML\Components\Page;
use PatientBook\Views\iView;
use Exception;

abstract class HTMLView implements iView
{
    protected Page $page;
    public function outputOK(): void
    {
        $this->page->print('<p>OK</p>');
    }

    public function outputException(Exception $exception): void
    {
        $this->page->print('<p style="color:#ff0000;">' . $this->drawException($exception) . '</p>');
    }

    private function drawException(?Exception $exception): ?string
    {
        if (is_null($exception)) return null;
        $message = [$exception->getMessage()];
        $previous = $this->drawException($exception->getPrevious());
        if (!is_null($previous)) $message[] = $previous;
        return implode(' :: ', $message);
    }
}