<?php

error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);
ini_set('error_log', __DIR__."/php-error.log");
error_log("Inicio de aplicación web");

require_once(__DIR__.'/vendor/autoload.php');


$app = new App();
?>