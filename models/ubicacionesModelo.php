<?php
class UbicacionesModelo extends Model{
		
		public function __construct(){
			parent:: __construct();
		}

		public function estados(){
			$sql = "CALL get_estados";			
			$db = $this->getDB()->conectar();
			$res = $db->prepare($sql);
			$res->execute();
			$result = $res->fetchAll(PDO::FETCH_ASSOC);
			$db = NULL;
			return $result;
		}

		public function municipios($id_estado){
			$sql = "CALL get_municipios($id_estado)";			
			$db = $this->getDB()->conectar();
			$res = $db->prepare($sql);
			$res->execute();
			$result = $res->fetchAll(PDO::FETCH_ASSOC);
			$db = NULL;
			return $result;
		}

		public function ciudades($id_estado){
			$sql = "CALL get_ciudades($id_estado)";			
			$db = $this->getDB()->conectar();
			$res = $db->prepare($sql);
			$res->execute();
			$result = $res->fetchAll(PDO::FETCH_ASSOC);
			$db = NULL;
			return $result;
		}


		public function parroquias($id_municipio){
			$sql = "CALL get_parroquias($id_municipio)";			
			$db = $this->getDB()->conectar();
			$res = $db->prepare($sql);
			$res->execute();
			$result = $res->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			$db = NULL;
		}
	}

?>