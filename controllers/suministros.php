<?php
class Suministros extends Controller{
	private $suministroModelo;
	private $Proveedor;
	public function __construct(){
		parent::__construct();
        $this->SuministroRutaImg = __DIR__.'../../public/assets/img/suministros';
        $this->SuministroModelo = new SuministrosModelo();
        $this->Proveedor = new Proveedores();
		session_start();
		$this->CheckSession($_SESSION['userId']);
		$this->CheckStatusUser($_SESSION['userStatus']);
			
	}

	public function index(){
		$this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
		$this->getView()->titlepage($title="Suministros");
		$vista= 'suministros/index';
		$this->getView()->render($vista);
	}

	public function registrar(){
        $this->getView()->menu = $this->Menu($_SESSION['rolId']);
        $this->getView()->titlepage($title="Registrar Suministros");
        $vista= 'suministros/registrar';
        $this->getView()->render($vista);          
    }

    public function historial(){
        $this->getView()->menu = $this->Menu($_SESSION['rolId']);
        $this->getView()->titlepage($title="Historial de Suministros");
        $vista= 'suministros/historial';
        $this->getView()->render($vista);          
    }

    public function comprobante(){
        $this->getView()->menu = $this->Menu($_SESSION['rolId']);
        $this->getView()->titlepage($title="Comprobante de Compra de Suministros");
        $vista= 'suministros/comprobante0';
        $this->getView()->render($vista);          
    }

    public function NewSupply(){
		$ruta_img_sumi = $this->SuministroRutaImg;
        $data = json_decode(file_get_contents('php://input'), true);
        $data = $this->quitar_espacios_array($data);

        $categoria = (isset($data['categoriaSuministro'])) ? $data['categoriaSuministro']:'0';
        $namesumi = (isset($data['nombreSuministro'])) ? $data['nombreSuministro']:NULL;
        $descsumi = (isset($data['descripcionSuministro'])) ? $data['descripcionSuministro']:NULL;
        $imgsumi = (isset($data['imagenSuministro'])) ? $data['imagenSuministro']:NULL;
        $datesumi = (isset($data['fechaCompraSuministro'])) ? $data['fechaCompraSuministro']:NULL;
        $undsumi = (isset($data['unidadesAdquiridas'])) ? $data['unidadesAdquiridas']:NULL;
        $montobs = (isset($data['montoBsSuministro'])) ? $data['montoBsSuministro']:NULL;
        $montodlls = (isset($data['montoDolaresSuministro'])) ? $data['montoDolaresSuministro']:NULL;

        $old_provee = (isset($data['proveedorSelect'])) ? $data['proveedorSelect']:'false';
        $tiporif_provee = (isset($data['rifProveedorTipo'])) ? $data['rifProveedorTipo']:NULL;
        $rif_provee = (isset($data['rifProveedor'])) ? $data['rifProveedor']:NULL;
        $name_provee = (isset($data['nombreProveedor'])) ? $data['nombreProveedor']:NULL;
        $codarea_provee = (isset($data['codAreaProveedor'])) ? $data['codAreaProveedor']:NULL;
        $tel_provee = (isset($data['telProveedor'])) ? $data['telProveedor']:NULL;
        $correo_provee = (isset($data['correoProveedor'])) ? $data['correoProveedor']:NULL;
        $sector = (isset($data['comunidadProveedor'])) ? $data['comunidadProveedor']:NULL;
        $pto_ref = (isset($data['refProveedor'])) ? $data['refProveedor']:NULL;
        $parroquia = (isset($data['parroquiaProveedor'])) ? $data['parroquiaProveedor']:NULL;
        $cod_post = (isset($data['codPostProveedor'])) ? $data['codPostProveedor']:'6050';



        if(is_null($categoria) || is_null($namesumi) || is_null($descsumi) || is_null($imgsumi) || is_null($datesumi) || is_null($undsumi) || is_null($montobs) || is_null($montodlls) || $categoria =='0' || $namesumi =='' || $descsumi =='' || $imgsumi =='' || $datesumi =='' || $undsumi =='' || $montobs =='' || $montodlls ==''){
            echo json_encode(['status'=> false, 'response'=>'¡No se ha recibido toda la información del Suministro!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        if($old_provee == 'false'){
			if(is_null($tiporif_provee) || is_null($rif_provee) || is_null($name_provee) || is_null($codarea_provee) || is_null($tel_provee) || is_null($correo_provee) || is_null($sector) || is_null($pto_ref) || is_null($parroquia) || is_null($cod_post)|| $tiporif_provee =='' || $rif_provee =='' || $name_provee =='' || $codarea_provee =='' || $tel_provee =='' || $correo_provee =='' || $sector =='' || $pto_ref =='' || $parroquia =='' || $cod_post ==''){
            echo $this->return_response(false, "¡No se ha recibido toda la información del Proveedor!");
            return;}
        }       

        $proveedor = $this->array_full_proveedor($data);
        $suministro = $this->array_suministro($data);


        $suministro_imagen = $suministro['imagen'];
        $check_image = $this->validate_image_format($suministro_imagen);
        
        if(!$check_image['response']){
            echo json_encode(['status'=> false, 'response'=>$check_image['imagen']], JSON_UNESCAPED_UNICODE);
            return;
        }



        $proveedor = $this->limpiar_cadena_array($proveedor);
        $proveedor['id_empresa'] = 1;
       
        $img = $this->decode_image_base_64($check_image['imagen'], $check_image['extension'], $ruta_img_sumi);
        $suministro = $this->limpiar_cadena_array($suministro);
        $suministro = array_merge($suministro, ['imagen'=>$img['avatar']]);

        
		
		$sumi = $this->SuministroModelo->nuevo_suministro($suministro, $proveedor, $old_provee); //Registrar Suministro y Proveedor

        if($sumi['status']){
            $msg = ['status'=> true, 'response'=>'¡Suministro registrado exitosamente!'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo registrar el nuevo suministro', 'error'=>$sumi['id_suministro']];
            unlink($ruta_img_sumi.$img['avatar']); //Eliminar imagen del servidor cuando suceda error al registrar
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }


    public function AddSupply(){
		$data = json_decode(file_get_contents('php://input'), true);
        $data = $this->quitar_espacios_array($data);

        $datesumi =(isset($data['fechaCompraSuministro'])) ? $data['fechaCompraSuministro']:NULL;
        $undsumi =(isset($data['unidadesAdquiridasSuministro'])) ? $data['unidadesAdquiridasSuministro']:NULL;
        $montobs =(isset($data['montoBsSuministro'])) ? $data['montoBsSuministro']:NULL;
        $montodlls =(isset($data['montoUsdSuministro'])) ? $data['montoUsdSuministro']:NULL;
        $id_provee = (isset($data['idProveedor'])) ? $data['idProveedor']:NULL;
        $id_sumi = (isset($data['idSuministro'])) ? $data['idSuministro']:NULL;
        $fecha_venci = (isset($data['fechaVencimientoSuministro'])) ? $data['fechaVencimientoSuministro']:NULL;
        $condicion = (isset($data['condicionPagoSuministro'])) ? $data['condicionPagoSuministro']:'2';

        switch ($condicion) {
            case '1':
                $condicion = 'CR';
                $fecha_pago = NULL;
                break;

            case '2':
                $condicion = 'CO';
                $fecha_pago = $datesumi;
                break;
        }


        $data = ['fecha_compra' => $datesumi, 'fecha_vencimiento'=>$fecha_venci, 'fecha_pago'=>$fecha_pago, 'cantidad' => $undsumi, 'condicion_pago'=>$condicion, 'pagado_bs' => $montobs, 'pagado_usd' => $montodlls];
        
		
		$sumi = $this->SuministroModelo->abastece_suministro($data, $id_sumi, $id_provee); //Abastecer Suministro

        if($sumi['status']){
            $msg = ['status'=> true, 'response'=>'¡Suministro abastecido exitosamente!'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo abastecer el suministro', 'error'=>$sumi];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }

    public function DelSupply(){
        $data = json_decode(file_get_contents('php://input'), true);
        $data = $this->quitar_espacios_array($data);

        $id_sumi = (isset($data['idSuministro'])) ? $data['idSuministro']:NULL;

        if($_SESSION['rolId'] == '2'){
            echo $this->return_response(false, "Usted no tiene permisos para eliminar suministros.");
            return;
        }

        if($id_sumi == '' || is_null($id_sumi)){
            echo $this->return_response(false, "No se recibió toda la información");
            return;
        }

        $suministro = $this->SuministroModelo->existe_suministro('id_suministro', $id_sumi);

        if($suministro['idSuministro']== '0'){
            echo $this->return_response(false, "No es posible eliminar el suministro debido a que no existe.");
            return;
        }
        
        $img_suministro = $this->SuministroRutaImg.$suministro['imagen'];

        $data = ['id_suministro' => $id_sumi];
        
        
        $sumi = $this->SuministroModelo->eliminar_suministro($data); //Eliminar Suministro

        if($sumi){
            $msg = ['status'=> true, 'response'=>'¡Suministro eliminado exitosamente!'];
            unlink($img_suministro);
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo eliminar el suministro.', 'error'=>$sumi];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }


    public function listarSupplies(){
        $lista = $this->SuministroModelo->listar_suministros();
        $estadi['generalData'] = $this->SuministroModelo->estadisticas_suministros();
        $data['dataRegistro']= json_decode(json_encode($lista, JSON_FORCE_OBJECT), true);
        $json= json_encode(array_merge($data, $estadi), JSON_UNESCAPED_UNICODE);
        echo $json;               
    }

	
	public function ShoppingList(){
        $lista = $this->SuministroModelo->historial_compras_suministros();
        $json= json_encode($lista, JSON_UNESCAPED_UNICODE);        
        echo $json;                
    }

    public function ComprobanteSupplies(){
        $data = json_decode(file_get_contents('php://input'), true);
        $data = $this->quitar_espacios_array($data);

        $id_provee = (isset($data['proveedorSelect'])) ? $data['proveedorSelect']:NULL;
        $fecha_compra = (isset($data['fechaCompraSuministro'])) ? $data['fechaCompraSuministro']:NULL;

        if($id_provee == '' || is_null($id_provee) || $fecha_compra == '' || is_null($fecha_compra)){
            echo $this->return_response(false, "No se recibió toda la información");
            return;
        }
        $datos = ['id_proveedor'=> $id_provee, 'fecha_compra'=>$fecha_compra];

        $lista = $this->SuministroModelo->comprobante_lista_suministros($datos);

        if(!$lista['status']){
            echo $this->return_response(false, "No hay registros.");
            return;
        }else{
            echo $this->return_response(true, "¡Comprobante generado! Por favor, espere...");
            return;
        }          
    }

    public function ComprobanteSuppliess(){
        $id_provee = (isset($_POST['proveedorSelect'])) ? $_POST['proveedorSelect']:NULL;
        $fecha_compra = (isset($_POST['fechaCompraSuministro'])) ? $_POST['fechaCompraSuministro']:NULL;

        if($id_provee == '' || is_null($id_provee) || $fecha_compra == '' || is_null($fecha_compra)){
            echo $this->return_response(false, "No se recibió toda la información");
            return;
        }
        $datos = ['id_proveedor'=> $id_provee, 'fecha_compra'=>$fecha_compra];

        $lista = $this->SuministroModelo->comprobante_lista_suministros($datos);

        if(!$lista['status']){
            echo $this->return_response(false, "No hay registros.");
            return;
        }

        $total = $this->SuministroModelo->comprobante_total_suministros($datos);


        $fechaOriginal = trim($fecha_compra);

        list($anio, $mes, $dia) = explode('-', $fechaOriginal);

        $fecha_formateada = "$dia/$mes/$anio";

        $rif_proveedor = $lista['lista'][0]['nombreRifProveedor'];
        $this->getView()->titlepage($title="Comprobante de Adquisición $fecha_formateada $rif_proveedor");
        $this->getView()->array = $lista['lista'];
        $this->getView()->fecha = $fecha_formateada;
        $this->getView()->total = $total;
        $vista= 'suministros/comprobante';
        $this->getView()->render($vista);              
    }    			

}

?>