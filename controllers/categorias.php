<?php
class Categorias extends Controller{
	public function __construct(){
		parent::__construct();
		$this->CategoriasM = new CategoriasModelo();
		session_start();
	}

	public function index(){
		$this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
		$this->getView()->titlepage($title="Categorías");
		$vista= 'categorias/index';
		$this->getView()->render($vista);
	}

    public function getCategory(){
        $status = $this->CategoriasM->all_categorias();
        $res = json_encode($status, JSON_UNESCAPED_UNICODE);
        echo $res;  
    }

    public function getidCategory() {
        $status = $this->CategoriasM->all_categorias();
        
        $ids_category = array_column($status, 'idCategoria');
        
        echo json_encode($ids_category, JSON_UNESCAPED_UNICODE);
    }

	public function newCategory(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = $this->limpiar_cadena_array($data);
        $data = $this->quitar_espacios_array($data);


        $nombre = (isset($data['nombreCategoria'])) ? $data['nombreCategoria']:NULL;
        $descrip = (isset($data['descripcionCategoria'])) ? $data['descripcionCategoria']:NULL;

        if($nombre == '' || is_null($nombre) || $descrip == '' || is_null($descrip)){
        	echo $this->return_response(false, "No se recibió toda la información");
            return;
        }

        $buscar = $this->CategoriasM->buscar_categoria($nombre, 'nombre');

        if($buscar['idCategoria']!= '0'){
        	echo $this->return_response(false, "La categoría que intenta registrar ya existe.");
            return;
        }

        $datos = ['nombre' =>ucwords(strtolower($nombre)), 'descripcion'=>ucwords(strtolower($descrip))];
        $cate = $this->CategoriasM->nueva_categoria($datos);

        if($cate['status']){
            $msg = ['status'=> true, 'response'=>'¡Categoría registrada exitosamente!'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo registrar la nueva categoría.', 'error'=>$cate];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
	}

	public function upCategory(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = $this->limpiar_cadena_array($data);
        $data = $this->quitar_espacios_array($data);


        $id = (isset($data['idCategory'])) ? $data['idCategory']:'0';
        $nombre = (isset($data['newCategory'])) ? $data['newCategory']:NULL;
        $descrip = (isset($data['newDescripcion'])) ? $data['newDescripcion']:NULL;

        if($id =='0' || is_null($id) || $nombre == '' || is_null($nombre) || $descrip == '' || is_null($descrip)){
        	echo $this->return_response(false, "No se recibió toda la información");
            return;
        }

        $buscar = $this->CategoriasM->buscar_categoria($id, 'id_categoria');
        if($buscar['idCategoria'] =='0'){
        	echo $this->return_response(false, "La categoría que intenta modificar no existe.");
            return;
        }

        $buscar_name_id = $this->CategoriasM->buscar_name_categoria_id($nombre, $id);
        if($buscar_name_id['idCategoria']=='1'){
            echo $this->return_response(false, "El nombre de la categoría ya se encuentra registrado.");
            return;        	
        }


        $datos = ['nombre' =>ucwords(strtolower($nombre)), 'descripcion'=>ucwords(strtolower($descrip)),
    				'id_categoria' => $id];
        $cate = $this->CategoriasM->update_categoria($datos);

        if($cate){
            $msg = ['status'=> true, 'response'=>'¡Categoría actualizada exitosamente!'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo actualizar la categoría.', 'error'=>$cate];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
	}


	public function delCategory(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = $this->limpiar_cadena_array($data);
        $data = $this->quitar_espacios_array($data);


        $id = (isset($data['idCategory'])) ? $data['idCategory']:'0';        

        if($id == '0' || is_null($id)){
        	echo $this->return_response(false, "No se recibió toda la información.");
            return;
        }

        $buscar = $this->CategoriasM->buscar_categoria($id, 'id_categoria');
        if($buscar['idCategoria'] =='0'){
        	echo $this->return_response(false, "La categoría que intenta eliminar no existe.");
            return;
        }

        $cate = $this->CategoriasM->delete_categoria($id);

        if($cate['status']){
            $msg = ['status'=> true, 'response'=>'¡Categoría eliminada exitosamente!'];
        }else{
            $msg = ['status'=> false, 'response'=>'No es posible eliminar la categoría. Pudiera estar siendo utilizada.', 'error'=>$cate];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
	}


	
}

?>