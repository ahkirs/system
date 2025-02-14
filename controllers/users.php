<?php
class Users extends Controller{
	private $UserModelo;
	public function __construct(){
		parent::__construct();
        $this->UserModelo = new UsersModelo();
		session_start();
        $this->CheckSession($_SESSION['userId']);
		$this->ValidateMasivo($_SESSION['rolId']);
        $this->CheckStatusUser($_SESSION['userStatus']);
			
	}

	public function index(){
        $this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
		$this->getView()->titlepage($title="Usuarios");
		$vista= 'users/index';
		$this->getView()->render($vista);
				
	}


	public function NewUser($id_emple, $username, $id_rol){ 

        if ($username == '') {
            return false;
        }

        $def_pass = ucfirst(strtolower($username)).'1234$';
        $def_pass = $this->encripta_pass($def_pass);
        $datos = ['id_empleado'=> $id_emple,'usuario'=>strtolower($username), 'password'=>$def_pass, 'id_rol'=> $id_rol];

        $usuario= $this->UserModelo;
        $newuser = $usuario->nuevo_usuario($datos);

        if(!is_null($newuser['id_usuario'])){
            return true;
        }else{
            return false;
        }
    }

    public function listarUsers(){
        $lista= $this->UserModelo->lista_Users();
        $index=1;
        $estadi['generalData'] = $this->UserModelo->estadisticas_Users();
        
        $json_objects = array_map(function ($row) use (&$index) {
        $key = "Usuario" . ($index++);
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

    public function user_Exists($data, $field){
        $data = ['value'=>$data];
        $data = $this->UserModelo->existe_user($data, $field);
        return $data['userExists'];
    }

	

    public function detailsUser(){
        $data = json_decode(file_get_contents('php://input'), true);    
        $data = $this->limpiar_cadena_array($data);
        $id = (isset($data['id'])) ? $data['id']: NULL;

        if(!self::user_Exists($id, 'id_usuario')){
            header("Location:" .RUTA.'/users/index');
            return;
        }
        
        $user= $this->UserModelo->datos_User($id);
        $json = json_encode($user, JSON_UNESCAPED_UNICODE);
        echo $json;
    }


    public function resetUser(){
        $data = json_decode(file_get_contents('php://input'), true);    
        $data = $this->limpiar_cadena_array($data);
        $id = (isset($data['id'])) ? $data['id']: NULL;

        if(!self::user_Exists($id, 'id_usuario')){
            echo json_encode(['status'=> false, 'response'=>'¡El usuario no existe!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $recovery = $this->UserModelo->existe_user(['value'=>$id],'id_usuario');

        $pass = $this->UserModelo->default_password($id);
        $pass = $this->encripta_pass($pass);

        $validar_pass = $this->UserModelo->validar_password($id, $pass);

        if($validar_pass == 0){
            echo json_encode(['status'=> false, 'response'=>'¡El usuario no ha cambiado la contraseña por defecto!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        if($id == $_SESSION['userId'] ){
            echo json_encode(['status'=> false, 'response'=>'¡No se puede reiniciar el usuario en sesión!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $pass = $this->UserModelo->default_password($id);
        $pass = $this->encripta_pass($pass);
        
        $user= $this->UserModelo->Reinicio_Usuario($id, $pass);

        if($user['reinicio']){
            $msg = ['status'=> true, 'response'=>'Usuario reiniciado exitosamente.'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo reiniciar el usuario.'];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
                
        echo $json;
    }

    

    public function delUser(){
        $data = json_decode(file_get_contents('php://input'), true);    
        $data = $this->limpiar_cadena_array($data);
        $id = (isset($data['id'])) ? $data['id']: NULL;

        if(!self::user_Exists($id, 'id_usuario') ){
            echo json_encode(['status'=> false, 'response'=>'¡El usuario no existe!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        if($id == $_SESSION['userId'] ){
            echo json_encode(['status'=> false, 'response'=>'¡No se puede eliminar el usuario en sesión!'], JSON_UNESCAPED_UNICODE);
            return;
        }
        
        $user= $this->UserModelo->Elimina_Usuario($id);

        if($user['elimina']){
            $msg = ['status'=> true, 'response'=>'Usuario eliminado exitosamente.'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo eliminar el usuario.'];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
                
        echo $json;
    }


}

?>