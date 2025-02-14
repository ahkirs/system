<?php

class ProductosModelo extends Model	{
		
	public function __construct(){
		parent:: __construct();
	}

	public function listar_productos(){
		$db = $this->getDB()->conectar();
		$stmt = $db->prepare("CALL LISTA_PRODUCTOS()");
		$stmt->execute();
		$produc = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $produc;
	}

	public function estadisticas_productos(){
		$db = $this->getDB()->conectar();
		$stmt = $db->prepare("CALL ESTADISTICAS_PRODUCTOS()");
		$stmt->execute();
		$estadi = $stmt->fetch(PDO::FETCH_ASSOC);
		return $estadi;
	}


	public function nuevo_producto($data){

		$db = $this->getDB()->conectar();
		// Iniciar transacción
		$stmt = $db->prepare("START TRANSACTION");
		$stmt->execute();
		try{
			
			$sql = "CALL INSERTA_PRODUCTO(:nombre, :descripcion, :imagen, :precio_usd, :id_categoria, @id_product)";
			$res = $db->prepare($sql);
			$res->execute($data);

			$stmt= $db->prepare("SELECT @id_product"); //Obteniendo el id_product
			$stmt->execute();
			$id_producto = $stmt->fetch(PDO::FETCH_ASSOC);
			$id_produc = $id_categoria['@id_product'];


			// CONFIRMAR TRANSACCION
		    
		    $stmt = $db->prepare("COMMIT");
		    $stmt->execute();
  			
		    $msg = ['id_producto'=> $id_produc, 'status'=> true];

		}catch(PDOException $e) {
		    
		    $stmt = $db->prepare("ROLLBACK");
  			$stmt->execute();
		    $error= "Error: " . $e->getMessage();
		    $msg = ['id_producto'=> $error, 'status'=>false];
		}

		$db = NULL;
		return $msg;

	}


	public function buscar_producto($value, $field){
		$sql = "SELECT COUNT(id_producto) as idProducto, imagen as imagenProducto FROM productos WHERE $field = '$value' AND eliminado != '1'";			
		$db = $this->getDB()->conectar();
		$res = $db->prepare($sql);
		$res->execute();
		$result = $res->fetch(PDO::FETCH_ASSOC);
		$db = NULL;
		return $result;
	}

	public function buscar_name_producto_id($value, $id){
		$sql = "SELECT COUNT(id_producto) as idProducto FROM productos WHERE nombre = '$value' AND id_producto != $id AND eliminado !='1'";			
		$db = $this->getDB()->conectar();
		$res = $db->prepare($sql);
		$res->execute();
		$result = $res->fetch(PDO::FETCH_ASSOC);
		$db = NULL;
		return $result;
	}

	public function buscar_venta_producto($id){
		$sql = "SELECT COUNT(p.id_producto) as idProducto FROM productos p JOIN compras_contienen_productos ccp ON p.id_producto = ccp.id_producto WHERE ccp.id_producto = $id";			
		$db = $this->getDB()->conectar();
		$res = $db->prepare($sql);
		$res->execute();
		$result = $res->fetch(PDO::FETCH_ASSOC);
		$db = NULL;
		return $result;
	}

	public function update_producto($data){
		$sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio_usd = :precio_usd, id_categoria = :id_categoria WHERE id_producto = :id_producto";			
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

	public function update_img_producto($data){
		$sql = "UPDATE productos SET imagen = :imagen WHERE id_producto = :id_producto";			
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

	public function delete_hide_producto($id){
		
		$sql = "UPDATE productos SET eliminado = '1', imagen = NULL WHERE id_producto = $id";			
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

	public function delete_producto($id){
		
		$sql = "DELETE FROM productos WHERE id_producto = $id";			
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