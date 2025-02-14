<?php
	
	$folderPath = dirname($_SERVER['SCRIPT_NAME']);
	$urlPath = $_SERVER['REQUEST_URI'];
	$url = substr($urlPath,strlen($folderPath));
	//$url = $urlPath;
	$server = 'http://'.$_SERVER['SERVER_NAME'];
	define('URL', $url);
	define('RUTA', $server.'/LunchSystem');
	define('RUTAP', RUTA.'/public/');
	define('RUTACSS', RUTAP. 'css/');
	define('RUTAIMG', RUTAP. 'assets/img/');
	define('RUTAJS', RUTAP. 'assets/js/');
	define('SERVER', $server);






 	function closeSession(){
	session_start();
	session_destroy();
	}


?>