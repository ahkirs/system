<?php

require_once ('config/constants.php');
class Controller{
	private $view;
    private $model;
    private $controller;
	public function __construct(){

		$this->view = new View();

	}

	public function getView(){
		return $this->view;
	}


	public function setView($view)
    {
	    $this->view = $view;

	    return $this;
    }

/**
     * Get the value of model
     */ 
    public function getModel()
    {
            return $this->model;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */ 
    public function setModel($model)
    {
            $this->model = $model;

            return $this;
    }

    public function loadModel ($modelo){
            $this->model = new $modelo();
    }


    public function Menu($id_rol){
        if(isset($id_rol)){
            switch ($id_rol) {
                case 1:
                    $menu = 'views/menu.php';
                    break;

                case 2:
                    $menu = 'views/menu-asistente.php';
                    break;          
                }
            return $menu;
        }                       
    }


    //Función para ser llamada desde el constructor de un controlador, para que no se pueda acceder a ninguno de los métodos de la clase si no existe una sesión iniciada y redirija al Login//
    public function CheckSession($id_user){
        if(!isset($id_user)){
            header("Location: ".RUTA."/login");
            //return "El usuario está activado";
        }           
    }

    //Función para ser llamada desde un método de un controlador, para que no se pueda acceder a ese método si ya existe una sesión activa, redirije al Main//
    public function CheckSessionStart($id_user){
        if(isset($id_user)){
            header("Location: ".RUTA."/main/");
            //return "El usuario está activado";
        }           
    }


    //Función para ser llamada desde un método de un controlador, para que no se pueda acceder a ese método si no tiene el rol requerido, redirije al Main//
    public function CheckStatusUser($status){
        if(isset($status)){
            if ($status == "NO" || $status == "NON") {
                header("Location: ".RUTA."/login/iniciar");
            }   
        }               
    }


    public function ValidateMasivo($id_rol){
        if(isset($id_rol)){
            if ($id_rol != 1) {
                header("Location: ".RUTA."/main/index");
            }
        }               
    }

    public function ValidateAsistente($id_rol){
        if(isset($status)){
            if ($id_rol == 1 || $id_rol == 2) {
                header("Location: ".RUTA."/main/index");
            }
        }               
    }


    public function encripta_pass($pass) {
      return password_hash($pass, PASSWORD_DEFAULT);
    }

    public function return_response($status, $message) {
      $array = ['status'=> $status, 'response'=> $message];
      $array = json_encode($array, JSON_UNESCAPED_UNICODE);
      return $array;
    }




    public function limpiar_cadena($cadena){

        $palabras=["<script>","</script>","<script src","<script type=","SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE","DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>","--","^","<",">","==","=",";","::"];

        $cadena=trim($cadena);
        $cadena=stripslashes($cadena);

        foreach($palabras as $palabra){
            $cadena=str_ireplace($palabra, "", $cadena);
        }

        $cadena=trim($cadena);
        $cadena=stripslashes($cadena);

        return $cadena;
    }


    public function limpiar_cadena_array($array){

        $arreglo = array();
        foreach ($array as $clave => $valor){
            $arreglo[$clave] = $this->limpiar_cadena($valor);
        }

        return $arreglo;
    }


    // funcion para quitar espacios
    public function quitar_espacios($Frase){
        $array = explode(' ',$Frase);  // convierte en array separa por espacios;
        $salida ='';
        // quita los campos vacios y pone un solo espacio
        for ($i=0; $i < count($array); $i++) { 
            if(strlen($array[$i])>0) {
                $salida.= ' ' . $array[$i];
            }
        }
      return  trim($salida);
    }

    public function quitar_espacios_array($array){

        $arreglo = array();
        foreach ($array as $clave => $valor){
            $arreglo[$clave] = $this->quitar_espacios($valor);
        }

        return $arreglo;
    }

    public function dia_letras($dia){

        switch ($dia) {
            case 1:
                $day_letra = 'un';
                break;
            
            case 2:
                $day_letra = 'dos';
                break;

            case 3:
                $day_letra = 'tres';
                break;

            case 4:
                $day_letra = 'cuatro';
                break;

            case 5:
                $day_letra = 'cinco';
                break;

            case 6:
                $day_letra = 'seis';
                break;

            case 7:
                $day_letra = 'siete';
                break;

            case 8:
                $day_letra = 'ocho';
                break;

            case 9:
                $day_letra = 'nueve';
                break;

            case 10:
                $day_letra = 'diez';
                break;
            
            case 11:
                $day_letra = 'once';
                break;

            case 12:
                $day_letra = 'doce';
                break;

            case 13:
                $day_letra = 'trece';
                break;

            case 14:
                $day_letra = 'catorce';
                break;

            case 15:
                $day_letra = 'quince';
                break;

            case 16:
                $day_letra = 'dieciseis';
                break;

            case 17:
                $day_letra = 'diecisiete';
                break;

            case 18:
                $day_letra = 'dieciocho';
                break;

            case 19:
                $day_letra = 'diecinueve';
                break;

            case 20:
                $day_letra = 'veinte';
                break;

            case 21:
                $day_letra = 'veintiún';
                break;
            
            case 22:
                $day_letra = 'veintidos';
                break;

            case 23:
                $day_letra = 'veintitres';
                break;

            case 24:
                $day_letra = 'veinticuatro';
                break;

            case 25:
                $day_letra = 'veinticinco';
                break;

            case 26:
                $day_letra = 'veintiseis';
                break;

            case 27:
                $day_letra = 'veintisiete';
                break;

            case 28:
                $day_letra = 'veintiocho';
                break;

            case 29:
                $day_letra = 'veintinueve';
                break;

            case 30:
                $day_letra = 'treinta';
                break;

            case 31:
                $day_letra = 'treinta y un';
                break;

        }

        return $day_letra;
    }

    public function validarUsuario($nombre) {
        $pattern = "/^[a-zA-Z0-9,_]{5,15}$/";
        return preg_match($pattern, $nombre);
    }

    public function validarPreguntas($pregunta) {
        $pattern = "/^[a-zA-Z\sñáéíóúÁÉÍÓÚ]{10,50}$/";
        return preg_match($pattern, $pregunta);
    }

    public function validarRespuestas($respuesta) {
        $pattern = "/^[a-zA-Z\sñáéíóúÁÉÍÓÚ]{4,25}$/";
        return preg_match($pattern, $respuesta);
    }


    public function decode_image_base_64($base64_img, $extension, $ruta_img) {
        if (isset($base64_img)) {
            // Definir la ruta donde se guardará la imagen
            $nombre_img = '/imagen_' . uniqid() .'.' . $extension;
            $ruta_destino = $ruta_img . $nombre_img;

            // Guardar la imagen en el servidor
            if (file_put_contents($ruta_destino, $base64_img)) {
                $msg = ['status' => true, 'message' => 'Imagen guardada con éxito', 'avatar' => $nombre_img];
            } else {
                $msg = ['status' => false, 'message' => 'Error al guardar la imagen'];
            }
        } else {
            $msg = ['status' => false, 'message' => 'No se recibió ninguna imagen'];
        }

        return $msg;
    }

    public function validate_image_format($base64_img){
        if (preg_match('#^data:image/([a-zA-Z]+);base64,(.*)$#', $base64_img, $matches)) {
            $image_type = $matches[1]; // Tipo de imagen (ej. jpeg, png)
            $base64_string = $matches[2]; // Cadena base64 sin el prefijo

            // Reemplazar espacios por +
            $base64_string = str_replace(' ', '+', $base64_string);

            // Decodificar la cadena Base64
            $decoded_data = base64_decode($base64_string);

            // Definir la extensión del archivo según el tipo de imagen
            $extension = '';
            switch (strtolower($image_type)) {
                case 'jpeg':
                case 'jpg':
                    $extension = 'jpg';
                    break;
                case 'png':
                    $extension = 'png';
                    break;
                default:
                $msg = ['response' => false, 'imagen' => 'Tipo de imagen no soportado'];
                return $msg;
            }
        $msg = ['response' => true, 'imagen' => $decoded_data, 'extension'=> $extension];
        return $msg;
        }
    }
    

    public function array_full_persona($datos){
        $tipoci = (isset($datos['ciTipo'])) ? $datos['ciTipo']:'V';     
        $ci = (isset($datos['ci'])) ? $datos['ci']:NULL;
        $pn = (isset($datos['pn'])) ? $datos['pn']:NULL;
        $sn = (isset($datos['sn'])) ? $datos['sn']:NULL;
        $tn = (isset($datos['tn'])) ? $datos['tn']:NULL;
        $pa = (isset($datos['pa'])) ? $datos['pa']:NULL;
        $sa = (isset($datos['sa'])) ? $datos['sa']:NULL;
        $fn = (isset($datos['fn'])) ? $datos['fn']:NULL;        
        $sexo = (isset($datos['sex'])) ? $datos['sex']:NULL;

        $edo_civil = (isset($datos['ec'])) ? $datos['ec']:'S';           
        $cod_postal = (isset($datos['codPost'])) ? $datos['codPost']:'6050';
        $calle = (isset($datos['calle'])) ? $datos['calle']:NULL;
        $sector = (isset($datos['sector'])) ? $datos['sector']:NULL;
        $ca_edf = (isset($datos['tipoCasa'])) ? $datos['tipoCasa']:'Casa';
        $n_vivienda = (isset($datos['numCasa'])) ? $datos['numCasa']:NULL;
        $pto_ref = (isset($datos['refCasa'])) ? $datos['refCasa']:NULL;
        $parroquia = (isset($datos['parroquia'])) ? $datos['parroquia']:NULL;



        $cod_area = (isset($datos['codArea'])) ? $datos['codArea']:NULL;
        if($cod_area == '0416' || '0426' || '0424' || '0414' || '0412'){
            $tipo_tlf = 'M';
        }else{
            $tipo_tlf = 'F';
        }

        $tipo = $tipo_tlf;
        
        $numero = (isset($datos['numTel'])) ? $datos['numTel']:NULL;
        $direccion_correo = (isset($datos['correo'])) ? $datos['correo']:NULL;

        $datos = array();
        $datos = ['tipo_ci'=> $tipoci,
                'ci'=> $ci,
                'nombre1'=> ucwords(strtolower($pn)),
                'nombre2'=> ucwords(strtolower($sn)),
                'nombre3'=> ucwords(strtolower($tn)),
                'apellido1'=> ucwords(strtolower($pa)),
                'apellido2'=> ucwords(strtolower($sa)),
                'fecha_nac'=> $fn,
                'sexo'=> $sexo,
                'edo_civil'=> $edo_civil,
                'cod_postal'=> $cod_postal,
                'calle'=> ucwords(strtolower($calle)),
                'sector'=> ucwords(strtolower($sector)),
                'ca_edf'=> $ca_edf,
                'n_vivienda'=> $n_vivienda,
                'pto_ref'=> ucwords(strtolower($pto_ref)),
                'parroquia'=> $parroquia,
                'tipo'=> $tipo,
                'cod_area'=> $cod_area,
                'numero'=> $numero,
                'direccion_correo'=> $direccion_correo];

        return $datos;
    }



    public function array_persona($datos){
        $tipoci = (isset($datos['ciTipo'])) ? $datos['ciTipo']:'V';     
        $ci = (isset($datos['ci'])) ? $datos['ci']:NULL;
        $pn = (isset($datos['pn'])) ? $datos['pn']:NULL;
        $sn = (isset($datos['sn'])) ? $datos['sn']:NULL;
        $tn = (isset($datos['tn'])) ? $datos['tn']:NULL;
        $pa = (isset($datos['pa'])) ? $datos['pa']:NULL;
        $sa = (isset($datos['sa'])) ? $datos['sa']:NULL;
        $fn = (isset($datos['fn'])) ? $datos['fn']:NULL;
        $sexo = (isset($datos['sex'])) ? $datos['sex']:NULL;

        
        $edo_civil = (isset($datos['ec'])) ? $datos['ec']:'soltero';
        
        switch ($edo_civil) {
            case 'soltero':
                $edo_civil = 'S';
                break;

            case 'casado':
                $edo_civil = 'C';
                break;

            case 'divorciado':
                $edo_civil = 'D';
                break;

            case 'viudo':
                $edo_civil = 'V';
                break;
        }
        
        $address = NULL;
        $phone = NULL;
        $email = NULL;


        $datos = array();
        $datos = ['tipo_ci'=> $tipoci,
                'ci'=> $ci,
                'nombre1'=> ucwords(strtolower($pn)),
                'nombre2'=> ucwords(strtolower($sn)),
                'nombre3'=> ucwords(strtolower($tn)),
                'apellido1'=> ucwords(strtolower($pa)),
                'apellido2'=> ucwords(strtolower($sa)),
                'fecha_nac'=> $fn,
                'sexo'=> $sexo,
                'edo_civil'=> $edo_civil,
                'id_direccion'=> $address,
                'id_telefono'=> $phone,
                'id_correo'=> $email];

        return $datos;
    }

    public function array_full_proveedor($datos){
        $tiporif = (isset($datos['rifProveedorTipo'])) ? $datos['rifProveedorTipo']:'V';     
        $rif = (isset($datos['rifProveedor'])) ? $datos['rifProveedor']:NULL;
        $nombre = (isset($datos['nombreProveedor'])) ? $datos['nombreProveedor']:NULL;
        $cod_postal = (isset($datos['codPost'])) ? $datos['codPost']:'6050';
        $calle = (isset($datos['calle'])) ? $datos['calle']:'Principal';
        $sector = (isset($datos['comunidadProveedor'])) ? $datos['comunidadProveedor']:NULL;
        $ca_edf = (isset($datos['tipoCasa'])) ? $datos['tipoCasa']:'Casa';
        $n_vivienda = (isset($datos['numCasa'])) ? $datos['numCasa']:NULL;
        $pto_ref = (isset($datos['refProveedor'])) ? $datos['refProveedor']:NULL;
        $parroquia = (isset($datos['parroquiaProveedor'])) ? $datos['parroquiaProveedor']:NULL;

        $cod_area = (isset($datos['codAreaProveedor'])) ? $datos['codAreaProveedor']:NULL;
        if($cod_area == '0416' || '0426' || '0424' || '0414' || '0412'){
            $tipo_tlf = 'M';
        }else{
            $tipo_tlf = 'F';
        }

        $tipo = $tipo_tlf;
        
        $numero = (isset($datos['telProveedor'])) ? $datos['telProveedor']:NULL;
        $direccion_correo = (isset($datos['correoProveedor'])) ? $datos['correoProveedor']:NULL;

        $datos = array();
        $datos = ['tipo_rif'=> $tiporif,
                'rif'=> $rif,
                'nombre'=> ucwords(strtolower($nombre)),
                'cod_postal'=> $cod_postal,
                'calle'=> ucwords(strtolower($calle)),
                'sector'=> ucwords(strtolower($sector)),
                'ca_edf'=> $ca_edf,
                'n_vivienda'=> $n_vivienda,
                'pto_ref'=> ucwords(strtolower($pto_ref)),
                'parroquia'=> $parroquia,
                'tipo'=> $tipo,
                'cod_area'=> $cod_area,
                'numero'=> $numero,
                'direccion_correo'=> $direccion_correo];

        return $datos;
    }

    public function array_suministro($datos){
        $codigo = (isset($datos['codigoSuministro'])) ? $datos['codigoSuministro']:date('Ydm').rand(2000, 1000000);     
        $categoria = (isset($datos['categoriaSuministro'])) ? $datos['categoriaSuministro']:'0';     
        $nombre = (isset($datos['nombreSuministro'])) ? $datos['nombreSuministro']:NULL;
        $descrip = (isset($datos['descripcionSuministro'])) ? $datos['descripcionSuministro']:NULL;
        $imagen = (isset($datos['imagenSuministro'])) ? $datos['imagenSuministro']:NULL;
        $fecha = (isset($datos['fechaCompraSuministro'])) ? $datos['fechaCompraSuministro']:NULL;
        $fecha_venci = (isset($datos['fechaVencimientoSuministro'])) ? $datos['fechaVencimientoSuministro']:NULL;
        $unidades = (isset($datos['unidadesAdquiridas'])) ? $datos['unidadesAdquiridas']:NULL;
        $monto_dlls = (isset($datos['montoDolaresSuministro'])) ? $datos['montoDolaresSuministro']:NULL;
        $monto_bs = (isset($datos['montoBsSuministro'])) ? $datos['montoBsSuministro']:NULL;
        $condicion = (isset($datos['condicionPagoSuministro'])) ? $datos['condicionPagoSuministro']:'2';

        
        switch ($condicion) {
            case '1':
                $condicion = 'CR';
                $fecha_pago = NULL;
                break;

            case '2':
                $condicion = 'CO';
                $fecha_pago = $fecha;
                break;
        }


        $datos = array();
        $datos = ['id_categoria'=> $categoria,
                'codigo' => $codigo,
                'nombre'=> ucwords(strtolower($nombre)),
                'descripcion'=> ucwords(strtolower($descrip)),
                'imagen'=> $imagen,
                'fecha_compra'=> $fecha,
                'fecha_pago'=> $fecha_pago,
                'fecha_vencimiento'=> $fecha_venci,
                'condicion_pago'=> $condicion,
                'cantidad'=> $unidades,
                'pagado_usd'=> $monto_dlls,
                'pagado_bs'=> $monto_bs];

        return $datos;
    }


    public function array_producto($datos){  
        $categoria = (isset($datos['categoriaProducto'])) ? $datos['categoriaProducto']:'0';
        $nombre = (isset($datos['nombreProducto'])) ? $datos['nombreProducto']:NULL;
        $descrip = (isset($datos['descripcionProducto'])) ? $datos['descripcionProducto']:NULL;
        $imagen = (isset($datos['imagenProducto'])) ? $datos['imagenProducto']:NULL;
        $precio_usd = (isset($datos['precioProducto'])) ? $datos['precioProducto']:NULL;

        $datos = array();
        $datos = ['id_categoria'=> $categoria,
                'nombre'=> ucwords(strtolower($nombre)),
                'descripcion'=> ucwords(strtolower($descrip)),
                'imagen'=> $imagen,
                'precio_usd'=> $precio_usd];

        return $datos;
    }








}


?>