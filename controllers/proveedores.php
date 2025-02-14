<?php
class Proveedores extends Controller{
	private $proveedorModelo;
	public function __construct(){
		parent::__construct();
		$this->ProveedorModelo = new ProveedoresModelo();
		session_start();
		$this->CheckSession($_SESSION['userId']);
		$this->CheckStatusUser($_SESSION['userStatus']);
			
	}

	public function index(){
		$this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
		$this->getView()->titlepage($title="Proveedores");
		$vista= 'proveedores/index';
		$this->getView()->render($vista);
	}



	public function listarSuppliers(){
        $lista = $this->ProveedorModelo->listar_proveedores();
        $estadi['generalData'] = $this->ProveedorModelo->estadisticas_proveedores();        
        $data['dataRegistro']= json_decode(json_encode($lista, JSON_FORCE_OBJECT), true);
        $json= json_encode(array_merge($data, $estadi), JSON_UNESCAPED_UNICODE);
        echo $json;                
    }


    public function getsupplier(){
        $lista = $this->ProveedorModelo->obtener_proveedores();
        echo json_encode($lista, JSON_UNESCAPED_UNICODE);
    }
	

	public function NewProveedor($data, $db){ 

        $id_empresa = 1;
        $data['id_empresa'] = $id_empresa;

        return $data;
        
        $proveedor= $this->ProveedorModelo;
        $provee = $proveedor->nuevo_proveedor($datos);

        if(!is_null($newuser['id_usuario'])){
            return true;
        }else{
            return false;
        }
    }


			

}

?>