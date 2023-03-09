<?php
namespace PatientBook\Controllers;

use DateTime;
use Exception;
use PatientBook\Models\Patient;
use PatientBook\Storage\Database\Tables\PatientTable;
use PatientBook\Views\iPatientAddView;

class PatientAddController
{
    private iPatientAddView $view;
    public function __construct(iPatientAddView $view)
    {
        $this->view = $view;
    }

    public function run(): void
    {
        $data = $this->view->getData();
        if ($data['submit'] ?? false) try {
            (new PatientTable(new Patient(null, $data['name'], $data['surname'], new DateTime($data['birthdate']))))
                ->save();
            $this->view->outputOK();
        } catch (Exception $e) {
            $this->view->outputException($e);
        }
        else $this->view->output();
    }
}