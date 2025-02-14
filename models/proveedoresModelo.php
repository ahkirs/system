<?php

class ProveedoresModelo extends Model	{
		
	public function __construct()
	{
		parent:: __construct();
	}

	public function listar_proveedores(){
		$db = $this->getDB()->conectar();
		$stmt = $db->prepare("CALL LISTA_PROVEEDORES()");
		$stmt->execute();
		$provee = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $provee;
	}

	public function estadisticas_proveedores(){
		$db = $this->getDB()->conectar();
		$stmt = $db->prepare("CALL ESTADISTICAS_PROVEEDORES()");
		$stmt->execute();
		$estadi = $stmt->fetch(PDO::FETCH_ASSOC);
		return $estadi;
	}

	public function obtener_proveedores(){
		$db = $this->getDB()->conectar();
		$stmt = $db->prepare("SELECT p.id_proveedor as idProveedor, CONCAT(upper(p.nombre),' (', p.tipo_rif, '-', p.rif,')')  as nombreRifProveedor FROM proveedores as p");
		$stmt->execute();
		$provee = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $provee;
	}




	public function nuevo_proveedor($data, $db){

		try{
			$sql = "CALL INSERTA_FULL_PROVEEDOR(:tipo_rif, :rif, :nombre, :cod_postal,:sector,:calle,:ca_edf,:n_vivienda,:pto_ref,:parroquia,:tipo,:cod_area,:numero,:direccion_correo, :id_empresa, @id_provee)";			
			
			$res = $db->prepare($sql);
			$res->execute($data);

			if($res->rowCount() > 0){
				$resp = true;
			}else{
				$resp = false;
			}

		    $stmt= $db->prepare("SELECT @id_provee"); //Obteniendo el id_proveedor
			$stmt->execute();
			$id_proveedor = $stmt->fetch(PDO::FETCH_ASSOC);
			$id_provee = $id_proveedor['@id_provee'];
  			
		    	  			
		    $msg = ['id_proveedor'=> $id_provee];

		}catch(PDOException $e) {
		    
		    $stmt = $db->prepare("ROLLBACK");
  			$stmt->execute();
		    $error= "Error: " . $e->getMessage();
		    $msg = ['id_proveedor'=> $error];
		}

		$db = NULL;
		return $msg;
						
	}

	

	
}


?>