<?php

class EmpleadosModelo extends Model	{
		
		public function __construct()
		{
			parent:: __construct();
		}

		public function nuevo_empleado($data){

			$db = $this->getDB()->conectar();
			// Iniciar transacción
			$stmt = $db->prepare("START TRANSACTION");
			$stmt->execute();
			try{
				$sql = "CALL INSERTA_EMPLEADO(:tipo_ci, :ci, :nombre1, :nombre2, :nombre3, :apellido1, :apellido2, :fecha_nac, :sexo, :edo_civil,:cod_postal,:sector,:calle,:ca_edf,:n_vivienda,:pto_ref,:parroquia,:tipo,:cod_area,:numero,:direccion_correo, :cargo, :fecha_ingreso, @employee)";			
				
				$res = $db->prepare($sql);
				$res->execute($data);

				if($res->rowCount() > 0){
					$resp = true;
				}else{
					$resp = false;
				}

			    $stmt= $db->prepare("SELECT @employee"); //Obteniendo el id_empleado
				$stmt->execute();
				$id_empleado = $stmt->fetch(PDO::FETCH_ASSOC);
				$id_emple = $id_empleado['@employee'];


				// CONFIRMAR TRANSACCION
			    
			    $stmt = $db->prepare("COMMIT");
			    $stmt->execute();
	  			
			    	  			
			    $msg = ['id_empleado'=> $id_emple, 'resp'=> $resp];

			}catch(PDOException $e) {
			    
			    $stmt = $db->prepare("ROLLBACK");
	  			$stmt->execute();
			    $error= "Error: " . $e->getMessage();
			    $msg = ['id_empleado'=> $error, 'resp'=> $resp];
			}

			$db = NULL;
			return $msg;
						
		}


		public function existe_empleado($data){
			$sql = "SELECT COUNT(id_empleado) as empleadoExists, id_usuario FROM personas p JOIN empleados e ON p.id_persona = e.id_empleado WHERE tipo_ci = :tipo_ci AND ci = :ci AND e.eliminado = '0'";			
			$db = $this->getDB()->conectar();
			$res = $db->prepare($sql);
			$res->execute($data);
			$pass = $res->fetch(PDO::FETCH_ASSOC);
							
			$db = NULL;
			return $pass;		
		}


		public function existe_user_empleado($id){
			$sql = "SELECT id_usuario as empleadoUser, id_empleado as idEmpleado FROM empleados WHERE id_empleado = $id AND eliminado = '0'";			
			$db = $this->getDB()->conectar();
			$res = $db->prepare($sql);
			$res->execute($data);
			$pass = $res->fetch(PDO::FETCH_ASSOC);
							
			$db = NULL;
			return $pass;		
		}


		public function lista_Empleados(){
			$db = $this->getDB()->conectar();

			$stmt = $db->prepare("CALL LISTA_EMPLEADOS()");
			$stmt->execute();

			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}

		public function estadisticas_Empleados(){
			$db = $this->getDB()->conectar();

			$stmt = $db->prepare("CALL ESTADISTICAS_EMPLEADOS()");
			$stmt->execute();

			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}

		public function Detalles_Empleado($id){
			$db = $this->getDB()->conectar();

			$stmt = $db->prepare("CALL DETALLES_USUARIO(?)");
			$stmt->bindParam(1, $id, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
			$stmt->execute();
			$res = $stmt->fetch(PDO::FETCH_ASSOC);
			return $res;
		}


		public function Elimina_Empleado($id){
			$db = $this->getDB()->conectar();



			// Iniciar transacción
			$stmt = $db->prepare("START TRANSACTION");
			$stmt->execute();
			try{
				

				$stmt = $db->prepare("CALL ELIMINA_EMPLEADO (?)");
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




	}


?>
