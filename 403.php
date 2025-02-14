<?php
include(__DIR__.'/config/constants.php');
require_once(__DIR__.'/vendor/autoload.php');
$controller = new Errors("Error 403: ¡Acceso Prohibido!", "¡Error 403! 🚫", "Usted no tiene permisos para acceder al directorio solicitado.", "index");
$controller->index();
?>