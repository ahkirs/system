<?php
class Ventas extends Controller{
	private $VentaModelo;
	public function __construct(){
		parent::__construct();
		session_start();
		$this->VentaModelo = new VentasModelo();
		$this->CheckSession($_SESSION['userId']);
		$this->CheckStatusUser($_SESSION['userStatus']);			
	}

	public function index(){
		$this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
		$this->getView()->titlepage($title="Ventas");
		$vista= 'ventas/index';
		$this->getView()->render($vista);
	}

	public function tasas(){
        $tasas = $this->VentaModelo->listar_tasas();
        echo json_encode($tasas);               
    }

    public function upTasa(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = $this->limpiar_cadena_array($data);
        $data = $this->quitar_espacios_array($data);


        $id = (isset($data['idTasa'])) ? $data['idTasa']:'0';
        $valor = (isset($data['newValorTasa'])) ? $data['newValorTasa']:'0.00';

        if($id =='0' || is_null($id) || $valor == '' ||  $valor == '0.00' || is_null($valor)){
        	echo $this->return_response(false, "No se recibió toda la información");
            return;
        }


        $datos = ['valor_tasa' => $valor,
    				'id_tasa' => $id];
        $tasa = $this->VentaModelo->update_tasa($datos);

        if($tasa){
            $msg = ['status'=> true, 'response'=>'¡Tasa actualizada exitosamente!'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo actualizar la tasa.', 'error'=>$tasa];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
	}

	public function registrar(){
        $this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
        $this->getView()->titlepage($title="Registrar Venta");
        $vista= 'ventas/registrar';
        $this->getView()->render($vista);
                
    }
			

}

?>