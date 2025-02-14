<?php
Class VentasModelo extends Model{
		
	public function __construct(){
		parent:: __construct();
	}

	public function listar_tasas(){
		$sql = "SELECT id_tasa as idTasa, nombre as nombreTasa, valor as valorTasa, 
		CONCAT(DATE_FORMAT(tc.fecha_UP, '%d de %M de %Y '), TIME_FORMAT(tc.fecha_UP, '%I:%i %p')) as fechaUpdatedTasa FROM tasas_cambio as tc";
		$db = $this->getDB()->conectar();
		$res = $db->prepare($sql);
		$res->execute();
		$result = $res->fetchAll(PDO::FETCH_ASSOC);
		$db = NULL;
		return $result;
	}

	public function update_tasa($data){
		$sql = "UPDATE tasas_cambio SET valor = :valor_tasa WHERE id_tasa = :id_tasa";			
		$db = $this->getDB()->conectar();
		$res = $db->prepare($sql);
		$res->execute($data);

		if($res->rowCount() > 0){
				$resp = true;
			}else{
				$resp = false;
			}

		$db = NULL;
		return $resp;
	}



	

	
}


?>