<?php

class PerfilModelo extends Model	{
		
	public function __construct()
	{
		parent:: __construct();
	}

	public function Datos_User($id_persona){
	    $db = $this->getDB()->conectar();
		$sql = "CALL DETALLES_EMPLEADO (?)";			
		$result = $db->prepare($sql);
		$result->bindParam(1, $id_persona, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
		$result->execute();	
		$res = $result->fetch(PDO::FETCH_ASSOC);
		$db = NULL;
		return $res;
	}

	public function update_address_user($data){

		$db = $this->getDB()->conectar();

		// Iniciar transacción
		$stmt = $db->prepare("START TRANSACTION");
		$stmt->execute();

		try{

			$sql = "CALL UP_DIRECCION_USER(:id_persona, :cod_postal, :sector, :calle,:ca_edf, :n_vivienda, :pto_ref, :parroquia, @id_address)";			
			$res = $db->prepare($sql);
			$res->execute($data);
			
			$res= $db->prepare("SELECT @id_address"); //Obteniendo el id_direccion del usuario
			$res->execute();
			$id_direccion = $res->fetch(PDO::FETCH_ASSOC);
			$id_direccion = $id_direccion['@id_address'];

			if($res->rowCount() > 0){
				$resp = true;
			}else{
				$resp = false;
			}
			// CONFIRMAR TRANSACCION
		    
		    $stmt = $db->prepare("COMMIT");
		    $stmt->execute();
			
		}catch(PDOException $e) {
		    
		    $stmt = $db->prepare("ROLLBACK");
  			$stmt->execute();
		    $error= "Error: " . $e->getMessage();
		    //$msg = ['error' => $error];
		}

		$db = NULL;
		return $resp;			
	}

	public function update_phone_user($data){

		$db = $this->getDB()->conectar();

		// Iniciar transacción
		$stmt = $db->prepare("START TRANSACTION");
		$stmt->execute();

		try{

			$sql = "CALL UP_TELEFONO_USER(:id_persona, :tipo, :cod_area, :numero, @id_phone)";			
			$res = $db->prepare($sql);
			$res->execute($data);
			
			$res= $db->prepare("SELECT @id_phone"); //Obteniendo el id_telefono del usuario
			$res->execute();
			$id_telefono = $res->fetch(PDO::FETCH_ASSOC);
			$id_telefono = $id_telefono['@id_phone'];

			// CONFIRMAR TRANSACCION
		    
		    $stmt = $db->prepare("COMMIT");
		    $stmt->execute();
			
		}catch(PDOException $e) {
		    
		    $stmt = $db->prepare("ROLLBACK");
  			$stmt->execute();
		    $error= "Error: " . $e->getMessage();
		    $id_telefono = NULL;
		    //$msg = ['error' => $error];
		}

		$db = NULL;
		return $id_telefono;			
	}

	public function update_correo_user($data){

		$db = $this->getDB()->conectar();

		// Iniciar transacción
		$stmt = $db->prepare("START TRANSACTION");
		$stmt->execute();

		try{

			$sql = "CALL UP_CORREO_USER(:id_persona, :direccion_correo, @id_email)";			
			$res = $db->prepare($sql);
			$res->execute($data);
			
			$res= $db->prepare("SELECT @id_email"); //Obteniendo el id_correo del usuario
			$res->execute();
			$id_correo = $res->fetch(PDO::FETCH_ASSOC);
			$id_correo = $id_correo['@id_email'];

			// CONFIRMAR TRANSACCION
		    
		    $stmt = $db->prepare("COMMIT");
		    $stmt->execute();
			
		}catch(PDOException $e) {
		    
		    $stmt = $db->prepare("ROLLBACK");
  			$stmt->execute();
		    $error= "Error: " . $e->getMessage();
		    $id_correo = NULL;
		    //$msg = ['error' => $error];
		}

		$db = NULL;
		return $id_correo;			
	}

	public function update_user_pass_avatar_user($data, $field){
		$sql = "UPDATE usuarios SET $field = :value WHERE id_usuario = :id_usuario";			
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

	public function validar_password($id, $password){
		$this->UserModelo = new UsersModelo();
		$pass = $this->UserModelo->validar_password($id, $password);
		return $pass;		
	}


	public function actualizar_pregunta_seguridad($data, $field1, $field2){
		$sql = "UPDATE recuperarpassword SET $field1 = :value1, $field2 = :value2  WHERE id_usuario = :id_usuario";			
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