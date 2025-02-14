<?php
//namespace SystemaEcclesiae2\Libs;

//require_once (__DIR__.'/../Controllers/Errorr.php');
require_once (__DIR__.'/../config/constants.php');


class App{
	public function __construct(){
		//echo "<p>Nueva app</p>";

		
		$url = explode('/', URL);
		
		$controlador= empty($url[1])? 'login':$url[1];
		$method= empty($url[2])? 'index':$url[2];

		//var_dump($url);
		$archivoController = __DIR__.'/../Controllers/'. $controlador . '.php';

		if(file_exists($archivoController)){
			require_once $archivoController;
			$controller = new $controlador;
			
			$urlModelo = __DIR__.'/../Models/'.$controlador.'Modelo.php';
                if (file_exists($urlModelo)) {
                    require_once($urlModelo);
                    $modelo = $controlador.'Modelo';
                    $controller->loadModel($modelo);
                }
			
			$exists = method_exists($controller, $method);			
			if($exists){ 
				$controller->$method();
			}else{
				$controller = new Errors();
				$controller->index();
			}				
							
		}else{	
				$controller = new Errors();
				$controller->index();
			}
					//$controller->$method();
				
	}
}

?>

