<?php
class CategoriasModelo extends Model{
		
	public function __construct(){
		parent:: __construct();
	}

	public function all_categorias(){
		$sql = "SELECT id_categoria as idCategoria, nombre as nombreCategoria, descripcion as descripCategoria FROM CATEGORIAS ORDER BY nombre";			
		$db = $this->getDB()->conectar();
		$res = $db->prepare($sql);
		$res->execute();
		$result = $res->fetchAll(PDO::FETCH_ASSOC);
		$db = NULL;
		return $result;
	}

	public function all_id_categorias(){
		$sql = "SELECT id_categoria as idCategoria FROM CATEGORIAS";			
		$db = $this->getDB()->conectar();
		$res = $db->prepare($sql);
		$res->execute();
		$result = $res->fetchAll(PDO::FETCH_ASSOC);
		$db = NULL;
		return $result;
	}


	public function nueva_categoria($data){

		$db = $this->getDB()->conectar();
		// Iniciar transacción
		$stmt = $db->prepare("START TRANSACTION");
		$stmt->execute();
		try{
			
			$sql = "CALL INSERTA_CATEGORIA(:nombre, :descripcion, @id_category)";
			$res = $db->prepare($sql);
			$res->execute($data);

			$stmt= $db->prepare("SELECT @id_category"); //Obteniendo el id_categoria
			$stmt->execute();
			$id_categoria = $stmt->fetch(PDO::FETCH_ASSOC);
			$id_cate = $id_categoria['@id_category'];


			// CONFIRMAR TRANSACCION
		    
		    $stmt = $db->prepare("COMMIT");
		    $stmt->execute();
  			
		    $msg = ['id_categoria'=> $id_cate, 'status'=> true];

		}catch(PDOException $e) {
		    
		    $stmt = $db->prepare("ROLLBACK");
  			$stmt->execute();
		    $error= "Error: " . $e->getMessage();
		    $msg = ['id_categoria'=> $error, 'status'=>false];
		}

		$db = NULL;
		return $msg;

	}


	public function buscar_categoria($value, $field){
		$sql = "SELECT COUNT(id_categoria) as idCategoria FROM categorias WHERE $field = '$value'";			
		$db = $this->getDB()->conectar();
		$res = $db->prepare($sql);
		$res->execute();
		$result = $res->fetch(PDO::FETCH_ASSOC);
		$db = NULL;
		return $result;
	}

	public function buscar_name_categoria_id($value, $id){
		$sql = "SELECT COUNT(id_categoria) as idCategoria FROM categorias WHERE nombre = '$value' AND id_categoria != $id";			
		$db = $this->getDB()->conectar();
		$res = $db->prepare($sql);
		$res->execute();
		$result = $res->fetch(PDO::FETCH_ASSOC);
		$db = NULL;
		return $result;
	}

	public function update_categoria($data){
		$sql = "UPDATE categorias SET nombre = :nombre, descripcion = :descripcion WHERE id_categoria = :id_categoria";			
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

	public function delete_categoria($id){
		
		try{
			$sql = "DELETE FROM categorias WHERE id_categoria = '$id'";			
			$db = $this->getDB()->conectar();
			$res = $db->prepare($sql);
			$res->execute();

			$msg = ['status'=>true];
			
		}catch(PDOException $e) {
		    
		    $stmt = $db->prepare("ROLLBACK");
  			$stmt->execute();
		    $error= "Error: " . $e->getMessage();
		    $msg = ['id_categoria'=> $error, 'status'=>false];
		}

		$db = NULL;
		return $msg;
	}


}

?>