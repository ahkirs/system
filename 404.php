<?php
include(__DIR__.'/config/constants.php');
require_once(__DIR__.'/vendor/autoload.php');
$controller = new Errors();
$controller->index();
?>