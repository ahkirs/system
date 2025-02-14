<?php
class Empleados extends Controller{
    private $EmpleadoModelo;
	private $User;
	public function __construct(){
		parent::__construct();
        $this->EmpleadoModelo = new EmpleadosModelo();
        $this->User = new Users();
		session_start();
		$this->CheckSession($_SESSION['userId']);
        $this->CheckStatusUser($_SESSION['userStatus']);
	}

	public function index(){
        $this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
		$this->getView()->titlepage($title="Empleados");
		$vista= 'empleados/index';
		$this->getView()->render($vista);
				
	}

    public function registrar(){
        $this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
        $this->getView()->titlepage($title="Registrar Empleados");
        $vista= 'empleados/registrar';
        $this->getView()->render($vista);
                
    }


	public function NewEmployee(){
        $data = json_decode(file_get_contents('php://input'), true); 
        $data = $this->limpiar_cadena_array($data);
        $data = $this->quitar_espacios_array($data);
        $tipo_ci = (isset($data['ciTipo'])) ? $data['ciTipo']:'V';
        $ci = (isset($data['ci'])) ? $data['ci']:NULL;
        $pn = (isset($data['pn'])) ? $data['pn']:NULL;
        $sn = (isset($data['sn'])) ? $data['sn']:NULL;
        $tn = (isset($data['tn'])) ? $data['tn']:NULL;
        $pa = (isset($data['pa'])) ? $data['pa']:NULL;
        $sa = (isset($data['sa'])) ? $data['sa']:NULL;
        $fn = (isset($data['fn'])) ? $data['fn']:NULL;
        $sex = (isset($data['sex'])) ? $data['sex']:NULL;
        $ec = (isset($data['ec'])) ? $data['ec']:NULL;
        $sector = (isset($data['sector'])) ? $data['sector']:NULL;
        $calle = (isset($data['calle'])) ? $data['calle']:NULL;
        $ca_edf = (isset($data['tipoCasa'])) ? $data['tipoCasa']:NULL;
        $n_casa = (isset($data['numCasa'])) ? $data['numCasa']:NULL;
        $pto_ref = (isset($data['refCasa'])) ? $data['refCasa']:NULL;
        $parroquia = (isset($data['parroquia'])) ? $data['parroquia']:NULL;
        $cod_post = (isset($data['codPost'])) ? $data['codPost']:NULL;
        $cargo = (isset($data['cargo'])) ? $data['cargo']:NULL;
        $fecha_ingreso = (isset($data['fi'])) ? $data['fi']:NULL;
        $username = (isset($data['username'])) ? $data['username']:NULL;


        if(is_null($ci) || is_null($pn) || is_null($pa) || $ci =='' || $pn =='' || $pa =='' || is_null($fn) || is_null($sex)|| is_null($cargo) || is_null($fecha_ingreso) || $fn ==''|| $sex =='' || $cargo ==''|| $fecha_ingreso ==''){
            echo $this->return_response(false, "No se recibió toda la información");
            return;
        }

        if(self::empleado_Exists_Ci($tipo_ci, $ci)){
            echo $this->return_response(false, "¡La persona que intenta registrar ya es empleada!");
            return;
        }

        if($this->User->user_Exists($username, 'usuario')){
            echo $this->return_response(false, "¡El nombre de usuario no se encuentra disponible, intente uno distinto!");
            return;
        }       
        
        $datos = $this->array_full_persona($data);
        $datos = array_merge($datos, ['cargo'=>strtoupper($cargo), 'fecha_ingreso'=>$fecha_ingreso]);

        //echo "<pre>";
        //echo json_encode($datos);
        //echo "<\pre>";
        //return;

        $emple= $this->EmpleadoModelo;
        $newemple = $emple->nuevo_empleado($datos);
        $text= "";
        $userr = NULL;
        $pass_default = NULL;

        if(!is_null($username) && !is_null($newemple['id_empleado'])) {
            $id_emple = $newemple['id_empleado'];
            $user = $this->User->NewUser($id_emple, $username, 2);
            if($user){
                $text = "con Usuario ";
                $userr = strtolower($username);
                $pass_default = ucfirst(strtolower($username)).'1234$';
            }
        }
     

        if($newemple['resp']){
            $msg = ['status'=> true, 'response'=>'Empleado registrado '. $text.'exitosamente.', 'user'=> $userr, 'pass_default'=> $pass_default];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo registrar el nuevo empleado.', 'error'=>$newemple['id_empleado']];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }


    public function empleado_Exists_Ci($tipo_ci, $ci){
        $array = ['tipo_ci'=>$tipo_ci, 'ci' => $ci];
        $data = $this->EmpleadoModelo->existe_empleado($array);
        return $data['empleadoExists'];
    }

    public function empleado_Exists($id_empleado){
        $data = $this->EmpleadoModelo->existe_user_empleado($id_empleado);
        return $data['idEmpleado'];
    }

    public function empleado_User_Exists($id_empleado){
        $data = $this->EmpleadoModelo->existe_user_empleado($id_empleado);
        return $data['empleadoUser'];
    }

    public function SetUser(){
        $data = json_decode(file_get_contents('php://input'), true);    
        $data = $this->limpiar_cadena_array($data);
        $data = $this->quitar_espacios_array($data);
        $id = (isset($data['idEmpleado'])) ? $data['idEmpleado']: NULL;
        $username = (isset($data['username'])) ? $data['username']: NULL;
        
        if(is_null($id) ||  $id =='' || is_null($username) || $username ==''){
            echo $this->return_response(false, "¡No se recibió toda la información!");
            return;
        }

        if(is_null(self::empleado_Exists($id))){
            echo json_encode(['status'=> false, 'response'=>'¡El empleado no existe!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        if(!$this->validarUsuario($username)){
            echo $this->return_response(false, "Nombre de usuario no admitido, no debe contener carácteres especiales y debe tener una longitud mínima 5 caracteres y máximo 15 carácteres.");
            return;
        }

        if($this->User->user_Exists($username, 'usuario')){
            echo $this->return_response(false, "¡El nombre de usuario no se encuentra disponible, intente uno distinto!");
            return;
        }

        if(self::empleado_User_Exists($id)){
            echo $this->return_response(false, "¡El empleado ya posee registrado un usuario!");
            return;
        }


        $user = $this->User->NewUser($id, $username, 2);

        if($user){
            $msg = ['status'=> true, 'response'=>'Usuario creado exitosamente.', 'user'=> strtolower($username), 'pass_default'=> ucfirst(strtolower($username)).'1234$'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo crear el usuario.'];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
             
        echo $json;
    }

	public function listarEmployees(){
        $lista= $this->EmpleadoModelo->lista_Empleados();
        $index=1;
        $estadi['generalData'] = $this->EmpleadoModelo->estadisticas_Empleados();
        
        $json_objects = array_map(function ($row) use (&$index) {
        $key = "Empleado" . ($index++);
        return ["$key" => $row];
        }, $lista, array_keys($lista));
        // Convierte el array en un JSON
        $data['dataRegistro']= json_decode(json_encode($json_objects, JSON_FORCE_OBJECT), true);
        $json= json_encode(array_merge($data, $estadi), JSON_UNESCAPED_UNICODE);
        
        //echo "<pre>";
        echo $json;
        //echo "</pre>";
        return;
    }

    public function detailsEmployee(){
        //$data = json_decode(file_get_contents('php://input'), true);    
        //$data = $this->limpiar_cadena_array($data);
        $id = (isset($data['id'])) ? $data['id']: '3';


        if(is_null(self::empleado_Exists($id))){
            header("Location:" .RUTA.'/empleados/index');
            return;
        }
        
        $user= $this->EmpleadoModelo->Detalles_Empleado($id);
        $json = json_encode($user, JSON_UNESCAPED_UNICODE);
                
        echo $json;
    }

    public function delEmployee(){
        $data = json_decode(file_get_contents('php://input'), true);    
        $data = $this->limpiar_cadena_array($data);
        $id = (isset($data['idEmpleado'])) ? $data['idEmpleado']: NULL;

        if(is_null($id) ||  $id ==''){
            echo $this->return_response(false, "¡No se recibió toda la información!");
            return;
        }

        if(is_null(self::empleado_Exists($id))){
            echo json_encode(['status'=> false, 'response'=>'¡El empleado no existe!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        if($id == $_SESSION['userId'] ){
            echo json_encode(['status'=> false, 'response'=>'¡No se puede eliminar al Administrador!'], JSON_UNESCAPED_UNICODE);
            return;
        }
        
        $emple= $this->EmpleadoModelo->Elimina_Empleado($id);

        if($emple['elimina']){
            $msg = ['status'=> true, 'response'=>'Empleado eliminado exitosamente.'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo eliminar el empleado.'];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
                
        echo $json;
    }




    

}

?>