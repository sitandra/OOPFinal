<?php
namespace PatientBook\Controllers;

use Exception;
use PatientBook\Models\PatientBookCommand;
use PatientBook\Storage\Database\DatabaseConnector;
use PatientBook\Storage\Database\iDatabase;
use PatientBook\Views\HTML\MainView;
use PatientBook\Views\HTML\PatientAddView;

class HTMLController
{
    private MainView $view;

    public function __construct(MainView $view, iDatabase $database)
    {
        $this->view = $view;
        try {
            DatabaseConnector::init($database);
        } catch (Exception $e) {
            $this->view->outputException($e);
        }
    }

    public function run(): void
    {
        try {
            $data = $this->view->getData();
            if (isset($data['action'])) {
                $command = PatientBookCommand::tryFrom($data['action']);
                switch ($command) {
                    case PatientBookCommand::ADD:
                        (new PatientAddController(new PatientAddView()))->run();
                        break;
                    case PatientBookCommand::SHOW:
                        throw new \Exception('To be implemented');
                    case PatientBookCommand::REMOVE:
                        throw new \Exception('To be implemented');
                    case null:
                        throw new Exception('Неизвестная команда');
                };
            } else $this->view->output();
        } catch (Exception $e) {
            $this->view->outputException($e);
        }
    }
}