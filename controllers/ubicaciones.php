<?php
class Ubicaciones extends Controller{
	public function __construct(){
		parent::__construct();
		$this->ubicacionesM = new UbicacionesModelo();
		session_start();
	}

	public function estados(){
		$status = $this->ubicacionesM->estados();
		$res = json_encode($status, JSON_UNESCAPED_UNICODE);
		echo $res;	
	}

	public function municipios(){
        $data = json_decode(file_get_contents('php://input'), true); 
		//$_POST['code_state'] = 2;
		if(isset($data['code_state'])){
			$id_estado = $data['code_state'];
			$status =  $this->ubicacionesM->municipios($id_estado);

			$res = json_encode($status, JSON_UNESCAPED_UNICODE);
		}
		echo $res;		
	}

	public function parroquias(){
        $data = json_decode(file_get_contents('php://input'), true); 
		//$_POST['code_municiple'] = 28;
		if(isset($data['code_municiple'])){
			$id_municipio = $data['code_municiple'];
			$status =  $this->getModel()->parroquias($id_municipio);
			$res = json_encode($status, JSON_UNESCAPED_UNICODE);
		}
		echo $res;	
	}

	public function ciudades(){
		if(isset($_POST['code_state'])){
			$id_estado = $_POST['code_state'];
			$status =  $this->getModel()->ciudades($id_estado);
			$res = json_encode($status, JSON_UNESCAPED_UNICODE);
		}
		echo $res;	
	}		
	
}

?>