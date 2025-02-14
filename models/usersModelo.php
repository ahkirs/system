<?php

class UsersModelo extends Model
	{
		
		public function __construct()
		{
			parent:: __construct();
		}

		public function nuevo_usuario($data){

			$db = $this->getDB()->conectar();
			// Iniciar transacción
			$stmt = $db->prepare("START TRANSACTION");
			$stmt->execute();
			try{
				$sql = "CALL INSERTA_USUARIO(:id_empleado, :usuario, :password, :id_rol, @user)";			
				
				$res = $db->prepare($sql);
				$res->execute($data);

				

			    $stmt= $db->prepare("SELECT @user"); //Obteniendo el id_usuario
				$stmt->execute();
				$id_user = $stmt->fetch(PDO::FETCH_ASSOC);
				$id_user = $id_user['@user'];


				// CONFIRMAR TRANSACCION
			    
			    $stmt = $db->prepare("COMMIT");
			    $stmt->execute();
	  			
			    	  			
			    $msg = ['id_usuario'=> $id_user];

			}catch(PDOException $e) {
			    
			    $stmt = $db->prepare("ROLLBACK");
	  			$stmt->execute();
			    $error= "Error: " . $e->getMessage();
			    $msg = ['id_usuario'=> NULL];
			}

			$db = NULL;
			return $msg;
						
		}


		public function Reinicio_Usuario($id, $pass){
			$db = $this->getDB()->conectar();



			// Iniciar transacción
			$stmt = $db->prepare("START TRANSACTION");
			$stmt->execute();
			try{
				

				$stmt = $db->prepare("CALL RESET_PREGUNTAS_USER(?, ?)");
				$stmt->bindParam(1, $id, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
				$stmt->bindParam(2, $pass, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);
				$stmt->execute();
			
				if($stmt->rowCount() > 0){
					$resp = true;
				}else{
					$resp = false;
				}

				// CONFIRMAR TRANSACCION
			    
			    $stmt = $db->prepare("COMMIT");
			    $stmt->execute();
	  			
			    	  			
			    $msg = ['reinicio'=> $resp];

			}catch(PDOException $e) {
			    
			    $stmt = $db->prepare("ROLLBACK");
	  			$stmt->execute();
			    $error= "Error: " . $e->getMessage();
			    $msg = ['reinicio'=> false];
			}

			return $msg;
		}

		public function Elimina_Usuario($id){
			$db = $this->getDB()->conectar();



			// Iniciar transacción
			$stmt = $db->prepare("START TRANSACTION");
			$stmt->execute();
			try{
				

				$stmt = $db->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
				$stmt->bindParam(1, $id, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
				$stmt->execute();
			
				if($stmt->rowCount() > 0){
					$resp = true;
				}else{
					$resp = false;
				}

				// CONFIRMAR TRANSACCION
			    
			    $stmt = $db->prepare("COMMIT");
			    $stmt->execute();
	  			
			    	  			
			    $msg = ['elimina'=> $resp];

			}catch(PDOException $e) {
			    
			    $stmt = $db->prepare("ROLLBACK");
	  			$stmt->execute();
			    $error= "Error: " . $e->getMessage();
			    $msg = ['elimina'=> false];
			}

			return $msg;
		}

		public function existe_user($data, $field){
			$sql = "SELECT COUNT(u.id_usuario) as userExists, id_recovery as recovery FROM usuarios u LEFT JOIN recuperarpassword rp ON u.id_usuario = rp.id_usuario where u.$field = :value";			
			$db = $this->getDB()->conectar();
			$res = $db->prepare($sql);
			$res->execute($data);
			$pass = $res->fetch(PDO::FETCH_ASSOC);
							
			$db = NULL;
			return $pass;		
		}

		public function lista_Users(){
			$db = $this->getDB()->conectar();

			$stmt = $db->prepare("CALL LISTA_USUARIOS()");
			$stmt->execute();

			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}

		public function estadisticas_Users(){
			$db = $this->getDB()->conectar();

			$stmt = $db->prepare("CALL ESTADISTICAS_USUARIOS()");
			$stmt->execute();

			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}

		public function datos_User($id){
			$sql = "CALL DETALLES_USUARIO (?)";			
			$db = $this->getDB()->conectar();
			$res = $db->prepare($sql);
			$res->bindParam(1, $id);
			$res->execute();
			$result = $res->fetch(PDO::FETCH_ASSOC);
			$db = NULL;
			return $result;
			
		}

		public function validar_password($id, $password){
			$sql = "SELECT COUNT(id_usuario) as userOK, password FROM usuarios where id_usuario = ?";			
			$db = $this->getDB()->conectar();
			$res = $db->prepare($sql);
			$res->bindParam(1, $id, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
			$res->execute();
			$pass = $res->fetch(PDO::FETCH_ASSOC);
			
			if(!password_verify($password, $pass['password'])){
				$pass = 0;
			}else{
				$pass = 1;
			}

			$db = NULL;
			return $pass;		
		}


		public function default_password($id){
			$db = $this->getDB()->conectar();

			$stmt = $db->prepare("SELECT CONCAT(mayus_first(u.usuario), '1234$') as defaultPass 
									FROM usuarios u WHERE id_usuario =:id_usuario");
			$stmt->bindParam('id_usuario', $id);
			$stmt->execute();
			$pass = $stmt->fetch(PDO::FETCH_ASSOC);
			$pass = $pass['defaultPass'];

			return $pass;
		}
	}


?>
