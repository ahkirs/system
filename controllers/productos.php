<?php
class Productos extends Controller{
	public function __construct(){
		parent::__construct();
		session_start();
        $this->ProductoRutaImg = __DIR__.'../../public/assets/img/productos';
		$this->ProductosM = new ProductosModelo();
		$this->CheckSession($_SESSION['userId']);
		$this->CheckStatusUser($_SESSION['userStatus']);
			
	}

	public function index(){
		$this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
		$this->getView()->titlepage($title="Productos");
		$vista= 'productos/index';
		$this->getView()->render($vista);
	}

	public function registrar(){
        $this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
        $this->getView()->titlepage($title="Registrar Producto");
        $vista= 'productos/registrar';
        $this->getView()->render($vista);           
    }

    public function listarProducts(){
        $lista = $this->ProductosM->listar_productos();
        $estadi['generalData'] = $this->ProductosM->estadisticas_productos();
        $data['dataRegistro']= json_decode(json_encode($lista, JSON_FORCE_OBJECT), true);
        $json= json_encode(array_merge($data, $estadi), JSON_UNESCAPED_UNICODE);
        echo $json;               
    }

	public function newProduct(){
		$ruta_img_produc = $this->ProductoRutaImg;
		$datas = json_decode(file_get_contents('php://input'), true);
		$data = $this->limpiar_cadena_array($datas);
        $data = $this->quitar_espacios_array($data);


        $categoria = (isset($data['categoriaProducto'])) ? $data['categoriaProducto']:'0';
        $nombre = (isset($data['nombreProducto'])) ? $data['nombreProducto']:NULL;
        $descrip = (isset($data['descripcionProducto'])) ? $data['descripcionProducto']:NULL;
        $img_produc = (isset($datas['imagenProducto'])) ? $datas['imagenProducto']:NULL;
        $precio = (isset($data['precioProducto'])) ? $data['precioProducto']:'0.00';
        //$precio = '0.00';

        if($categoria == '0' || is_null($categoria) || $nombre == '' || is_null($nombre) || $descrip == '' || is_null($descrip) || $precio == '0.00' || is_null($precio) || $img_produc == '' || is_null($img_produc)){
        	echo $this->return_response(false, "No se recibió toda la información");
            return;
        }


        $producto = $this->array_producto($data);

        $check_image = $this->validate_image_format($img_produc);
       
        if(!$check_image['response']){
            echo json_encode(['status'=> false, 'response'=>$check_image['imagen']], JSON_UNESCAPED_UNICODE);
            return;
        }

        $buscar = $this->ProductosM->buscar_producto($nombre, 'nombre');

        if($buscar['idProducto']!= '0'){
        	echo $this->return_response(false, "El nombre del producto que intenta registrar ya existe.");
            return;
        }

        $img = $this->decode_image_base_64($check_image['imagen'], $check_image['extension'], $ruta_img_produc);

        $producto = array_merge($producto, ['imagen'=>$img['avatar']]);
        
        $produc = $this->ProductosM->nuevo_producto($producto);

        if($produc['status']){
            $msg = ['status'=> true, 'response'=>'¡Producto registrado exitosamente!'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo registrar el nuevo producto.', 'error'=>$produc];
            unlink($ruta_img_produc.$img['avatar']); //Eliminar imagen del servidor cuando suceda error al registrar
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
	}

	public function upProduct(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = $this->limpiar_cadena_array($data);
        $data = $this->quitar_espacios_array($data);


        $id = (isset($data['idProduct'])) ? $data['idProduct']:'0';
        $id_category = (isset($data['newCategory'])) ? $data['newCategory']:'0';
        $nombre = (isset($data['newProduct'])) ? $data['newProduct']:NULL;
        $descrip = (isset($data['newDescripcion'])) ? $data['newDescripcion']:NULL;
        $precio = (isset($data['newPrecio'])) ? $data['newPrecio']:'0.00';

        if($id =='0' || is_null($id) || $id_category =='0' || is_null($id_category) || $nombre == '' || is_null($nombre) || $descrip == '' || is_null($descrip) || $precio =='0.00' || is_null($precio)){
        	echo $this->return_response(false, "No se recibió toda la información");
            return;
        }

        $buscar = $this->ProductosM->buscar_producto($id, 'id_producto');

        if($buscar['idProducto'] =='0'){
        	echo $this->return_response(false, "El producto que intenta modificar no existe.");
            return;
        }

        $buscar_name_id = $this->ProductosM->buscar_name_producto_id($nombre, $id);
        if($buscar_name_id['idProducto'] =='1'){
            echo $this->return_response(false, "El nombre del producto ya se encuentra registrado.");
            return;
        }

        $datos = ['nombre' =>ucwords(strtolower($nombre)), 'descripcion'=>ucwords(strtolower($descrip)),
    			'id_categoria' => $id_category, 'id_producto' => $id, 'precio_usd'=> $precio];

        $produc = $this->ProductosM->update_producto($datos);

        if($produc){
            $msg = ['status'=> true, 'response'=>'¡Producto actualizado exitosamente!'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo actualizar el producto.', 'error'=>$produc];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
	}

    public function upimgproduct(){
        $ruta_img_produc = $this->ProductoRutaImg;
        $data = json_decode(file_get_contents('php://input'), true);
        $id = (isset($data['idProduct'])) ? $data['idProduct']:'0';
        $id = $this->limpiar_cadena($id);
        $image = (isset($data['newImgProduct'])) ? $data['newImgProduct']:'';

        if($id =='0' || is_null($id) || is_null($image) || $image ==''){
            echo json_encode(['status'=> false, 'response'=>'¡No se ha recibido ningún dato!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $check_image = $this->validate_image_format($image);
        
        if(!$check_image['response']){
            echo json_encode(['status'=> false, 'response'=>$check_image['imagen']], JSON_UNESCAPED_UNICODE);
            return;
        }

        $buscar = $this->ProductosM->buscar_producto($id, 'id_producto');
        if($buscar['idProducto'] =='0'){
            echo $this->return_response(false, "El producto al que intenta actualizar la imagen no existe.");
            return;
        }

        $img_old = $buscar['imagenProducto'];

        $img = $this->decode_image_base_64($check_image['imagen'], $check_image['extension'], $ruta_img_produc);
        
        if($img['status']){
            $datos = ['imagen'=> $img['avatar'],'id_producto'=>$id];
            $produc = $this->ProductosM->update_img_producto($datos);            
        }else{
            $produc = false;
        }


        if($produc){
            $msg = ['status'=> true, 'response'=>'Imagen del producto actualizada correctamente.'];
            unlink($ruta_img_produc.$img_old);
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo actualizar la imagen del producto.'];
            unlink($ruta_img_produc.$img['avatar']);
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }

	public function delProduct(){
        $ruta_img_produc = $this->ProductoRutaImg;
		$data = json_decode(file_get_contents('php://input'), true);
		$data = $this->limpiar_cadena_array($data);
        $data = $this->quitar_espacios_array($data);


        $id = (isset($data['idProducto'])) ? $data['idProducto']:'0';        

        if($id == '0' || is_null($id)){
        	echo $this->return_response(false, "No se recibió toda la información.");
            return;
        }

        $buscar = $this->ProductosM->buscar_producto($id, 'id_producto');
        if($buscar['idProducto'] =='0'){
        	echo $this->return_response(false, "El producto que intenta eliminar no existe.");
            return;
        }

        $img = $buscar['imagenProducto'];

        $buscar_venta = $this->ProductosM->buscar_venta_producto($id);
        if($buscar_venta['idProducto'] =='0'){
            $produc = $this->ProductosM->delete_producto($id);         
        }else{
            $produc = $this->ProductosM->delete_hide_producto($id);         
        }

        if($produc){
            $msg = ['status'=> true, 'response'=>'¡Producto eliminado exitosamente!'];
            unlink($ruta_img_produc.$img); //Eliminar imagen del servidor cuando se elimine o se oculte el producto    
        }else{
            $msg = ['status'=> false, 'response'=>'No es posible eliminar el producto.', 'error'=>$produc];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
	}

			

}

?>