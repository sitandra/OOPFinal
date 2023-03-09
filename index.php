<?php
/** @var ClassLoader $loader */
$loader = require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/ClassLoader.php';
$loader->setNamespaces('PatientBook');
date_default_timezone_set('Asia/Yekaterinburg');
define('PB_SETTINGS',
    parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/Data/Private/PB.ini', true, INI_SCANNER_TYPED));

(new \PatientBook\Controllers\HTMLController(new \PatientBook\Views\HTML\MainView(), new \PatientBook\Storage\Database\MySQL()))->run();