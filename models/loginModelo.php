<?php

class LoginModelo extends Model
	{
		
		public function __construct()
		{
			parent:: __construct();
		}

		public function login($user, $pass){
			$sql = "SELECT u.id_usuario, u.id_rol, r.id_recovery, u.password, roles.nombre FROM usuarios as u JOIN roles on u.id_rol=roles.id_rol LEFT JOIN recuperarpassword as r on u.id_usuario=r.id_usuario WHERE usuario=?";			
			$db = $this->getDB()->conectar();
			$result = $db->prepare($sql);
			$result->bindParam(1, $user, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
			$result->execute();
			$res = $result->fetch(PDO::FETCH_ASSOC);

			if(!password_verify($pass, $res['password'])){
				$res = ['id_usuario'=> NULL];
				return $res;
			}

			if (!is_null($res['id_usuario'])) {
				$id = LoginModelo::loginEmple($res['id_usuario'], $db);
				$res = array_merge($res, $id);
			}else{
				$res = NULL;
			}



			$db = NULL;
			return $res;
		}


		public static function loginEmple($id_user, $db){
			$sql = "SELECT id_empleado as id_persona FROM empleados WHERE id_usuario = ?";			
			
			$result = $db->prepare($sql);
			$result->bindParam(1, $id_user, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
			$result->execute();
			$res = $result->fetch(PDO::FETCH_ASSOC);
			return $res;
		}


		public function getUser($id_user){
			$sql = "SELECT usuario, id_rol, id_usuario from usuarios WHERE usuarios.id_usuario=?";			
			$db = $this->getDB()->conectar();
			$result = $db->prepare($sql);
			$result->bindParam(1, $id_user, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
			$result->execute();
			$res = $result->fetch(PDO::FETCH_ASSOC);
			$db = NULL;
			return $res;
		}

		public function recovery($username){
			$sql = "SELECT u.id_usuario, u.usuario, pregunta1 AS p1, pregunta2 AS p2, pregunta3 AS p3 from usuarios AS u JOIN recuperarpassword AS r ON u.id_usuario=r.id_usuario WHERE u.usuario=?";			
			$db = $this->getDB()->conectar();
			$result = $db->prepare($sql);
			$result->bindParam(1, $username, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
			$result->execute();
			$res = $result->fetch(PDO::FETCH_ASSOC);
			$db = NULL;
			return $res;
		}

		
		public function recoverypassword($usuario, $r1, $r2, $r3){
			$sql = "SELECT usuario from usuarios as u join recuperarpassword as r on u.id_usuario=r.id_usuario WHERE respuesta1= BINARY ? AND respuesta2 = BINARY ? AND respuesta3= BINARY ? AND usuario=? ";			
			$db = $this->getDB()->conectar();
			$result = $db->prepare($sql);
			$result->bindParam(1, $r1, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
			$result->bindParam(2, $r2, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
			$result->bindParam(3, $r3, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
			$result->bindParam(4, $usuario, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
			$result->execute();
			$res = $result->fetch(PDO::FETCH_ASSOC);
			$db = NULL;
			return $res;
		}


		public function recoverySETpassword($clave, $usuario){
      		$hashed_password = password_hash($clave, PASSWORD_DEFAULT);	
			$sql = "UPDATE usuarios SET password=? WHERE usuarios.usuario ='".$usuario."' ";	
			$db = $this->getDB()->conectar();
			$result = $db->prepare($sql);
			$result->bindParam(1, $hashed_password, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
			$result->execute();
			$db = NULL;
			return $result;
		}

		public function recoverySETpreguntas($p1, $p2, $p3, $r1, $r2, $r3, $user){
			$db = $this->getDB()->conectar();
			$msg = ['mensaje'=>'Mensaje desde el Modelo'];
			// Iniciar transacción
			$stmt = $db->prepare("START TRANSACTION");
			$stmt->execute();
			try {
				  
			    $stmt = $db->prepare("CALL SET_PREGUNTAS_USER(?, ?, ?, ?, ?, ?, ?, @id_recovery)");
			   	$stmt->bindParam(1, $p1, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
				$stmt->bindParam(2, $p2, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
				$stmt->bindParam(3, $p3, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
				$stmt->bindParam(4, $r1, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
				$stmt->bindParam(5, $r2, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
				$stmt->bindParam(6, $r3, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
				$stmt->bindParam(7, $user, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
			    $stmt->execute();

			    $stmt= $db->prepare("SELECT @id_recovery"); //Obteniendo el id_recovery;
				$stmt->execute();
				$id_recovery = $stmt->fetch(PDO::FETCH_ASSOC);
				$id_recovery = $id_recovery['@id_recovery'];


			    // CONFIRMAR TRANSACCION
			    
			    $stmt = $db->prepare("COMMIT");
			    $stmt->execute();
	  			
			    if(!empty($id_recovery)){
			    	$status = true;
			    }else{
			    	$status = false;
			    }
	  			
			    $msg = ['msg' => $id_recovery, 'status'=>$status];


			    
			} catch(PDOException $e) {
			    
			    $stmt = $db->prepare("ROLLBACK");
	  			$stmt->execute();
			    $error= "Error: " . $e->getMessage();
			    $msg = ['error' => $error];
			}
			$db = NULL;
			return $msg;

		}
	}


?>
