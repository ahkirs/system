<?php

class SuministrosModelo extends Model	{
	private $ProveedorModelo;		
	public function __construct(){
		parent:: __construct();
		$this->ProveedorModelo = new ProveedoresModelo();
	}


	public function listar_suministros(){
		$db = $this->getDB()->conectar();
		$stmt = $db->prepare("CALL LISTA_SUMINISTROS()");
		$stmt->execute();
		$sumi = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $sumi;
	}

	public function estadisticas_suministros(){
		$db = $this->getDB()->conectar();
		$stmt = $db->prepare("CALL ESTADISTICAS_SUMINISTROS()");
		$stmt->execute();
		$estadi = $stmt->fetch(PDO::FETCH_ASSOC);
		return $estadi;
	}

	public function historial_compras_suministros(){
		$db = $this->getDB()->conectar();
		$stmt = $db->prepare("CALL HISTORIAL_COMPRAS_SUMINISTROS()");
		$stmt->execute();
		$sumi = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $sumi;
	}


	public function existe_suministro($field, $value){
		$db = $this->getDB()->conectar();
		$stmt = $db->prepare("SELECT COUNT(id_suministro) as idSuministro, imagen FROM suministros WHERE $field = $value");
		$stmt->execute();
		$sumi = $stmt->fetch(PDO::FETCH_ASSOC);
		return $sumi;
	}

	public function nuevo_suministro($suministro, $proveedor, $old_provee){

		$db = $this->getDB()->conectar();
		// Iniciar transacción
		$stmt = $db->prepare("START TRANSACTION");
		$stmt->execute();
		try{
			
			if($old_provee == 'false'){
				$id_provee = $this->insertProveedor($proveedor, $db);
			}else{
				$id_provee = $old_provee;
			}
						
			$id_sumi = $this->insertSuministro($suministro, $db);

			$abastece = $this->proveedor_Abastece_Suministro($suministro, $id_sumi, $id_provee, $db);


			// CONFIRMAR TRANSACCION
		    
		    $stmt = $db->prepare("COMMIT");
		    $stmt->execute();
  			
		    	  			
		    //$msg = ['id_suministro'=> $id_provee];
		    $msg = ['id_suministro'=> $id_sumi, 'status'=> true];

		}catch(PDOException $e) {
		    
		    $stmt = $db->prepare("ROLLBACK");
  			$stmt->execute();
		    $error= "Error: " . $e->getMessage();
		    $msg = ['id_suministro'=> $error, 'status'=>false];
		}

		$db = NULL;
		return $msg;

	}


	public function abastece_suministro($suministro, $id_sumi, $id_provee){

		$db = $this->getDB()->conectar();
		// Iniciar transacción
		$stmt = $db->prepare("START TRANSACTION");
		$stmt->execute();
		try{
			
			$abastece = $this->proveedor_Abastece_Suministro($suministro, $id_sumi, $id_provee, $db);


			// CONFIRMAR TRANSACCION
		    
		    $stmt = $db->prepare("COMMIT");
		    $stmt->execute();
  			
		    	  			
		    //$msg = ['id_suministro'=> $id_provee];
		    $msg = ['id_suministro'=> $id_sumi, 'status'=> true];

		}catch(PDOException $e) {
		    
		    $stmt = $db->prepare("ROLLBACK");
  			$stmt->execute();
		    $error= "Error: " . $e->getMessage();
		    $msg = ['id_suministro'=> $error, 'status'=>false];
		}

		$db = NULL;
		return $msg;

	}

	public function eliminar_suministro($suministro){
		$db = $this->getDB()->conectar();
		$sql = "DELETE FROM suministros WHERE id_suministro = :id_suministro";		
		$res = $db->prepare($sql);
		$res->execute($suministro);

		if($res->rowCount() > 0){
			$resp = true;
		}else{
			$resp = false;
		}

		$db = NULL;
		return $resp;
	}




	public function insertSuministro($data, $db){
		$sql = "CALL INSERTA_SUMINISTRO(:codigo,:nombre,:descripcion,:imagen,:id_categoria,@id_sumi)";		
		$res = $db->prepare($sql);
		$res->bindParam(':codigo', $data['codigo']);
		$res->bindParam(':nombre', $data['nombre']);
		$res->bindParam(':descripcion', $data['descripcion']);
		$res->bindParam(':imagen', $data['imagen']);
		$res->bindParam(':id_categoria', $data['id_categoria']);
		$res->execute();

	    $stmt= $db->prepare("SELECT @id_sumi"); //Obteniendo el id_suministro
		$stmt->execute();
		$id_suministro = $stmt->fetch(PDO::FETCH_ASSOC);
		return $id_suministro['@id_sumi'];
	}


	public function insertProveedor($data, $db) {
		$provee = $this->ProveedorModelo->nuevo_proveedor($data, $db);
		return $provee['id_proveedor'];
    }

	public function proveedor_Abastece_Suministro($data, $suministro, $proveedor, $db) {
		$sql = "INSERT INTO PROVEEDORES_ABASTECEN_SUMINISTROS VALUES 
			(NULL,:id_proveedor,:id_suministro,:fecha,set_null_if_empty(:fecha_pago),set_null_if_empty(:fecha_vencimiento),:cantidad,:condicion,:pagado_usd,:pagado_bs)";		
		$res = $db->prepare($sql);
		$res->bindParam(':id_proveedor', $proveedor);
		$res->bindParam(':id_suministro', $suministro);
		$res->bindParam(':fecha', $data['fecha_compra']);
		$res->bindParam(':fecha_pago', $data['fecha_pago']);
		$res->bindParam(':fecha_vencimiento', $data['fecha_vencimiento']);
		$res->bindParam(':cantidad', $data['cantidad']);
		$res->bindParam(':condicion', $data['condicion_pago']);
		$res->bindParam(':pagado_usd', $data['pagado_usd']);
		$res->bindParam(':pagado_bs', $data['pagado_bs']);
		$res->execute();
    }


    public function comprobante_lista_suministros($data){
		$db = $this->getDB()->conectar();
		$stmt = $db->prepare("CALL COMPROBANTE_LISTA_SUMINISTROS(:id_proveedor, :fecha_compra)");
		$stmt->execute($data);

		if($stmt->rowCount() > 0){
			$resp = true;
		}else{
			$resp = false;
		}

		$sumi = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$db = NULL;
		$response = ['status'=> $resp, 'lista'=>$sumi];
		return $response;
	}


	public function comprobante_total_suministros($data){
		$db = $this->getDB()->conectar();
		$stmt = $db->prepare("CALL COMPROBANTE_TOTAL_SUMINISTROS(:id_proveedor, :fecha_compra)");
		$stmt->execute($data);


		$sumi = $stmt->fetch(PDO::FETCH_ASSOC);
		$db = NULL;
		return $sumi;
	}







	

	
}


?>