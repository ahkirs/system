<?php
class Login extends Controller{
	private $UserModelo;
	public function __construct(){
		parent::__construct();
        $this->UserModelo = new UsersModelo();
        $this->PerfilModelo = new PerfilModelo();
		session_start();

	}

	public function index(){
		$this->CheckSessionStart($_SESSION['userId']);
		$this->getView()->titlepage($title="Inicio de Sesión");
		$vista= 'login/index';
		$this->getView()->render($vista);
	}


	public function startLogin(){
		$this->CheckSessionStart($_SESSION['userId']);
		$data = json_decode(file_get_contents('php://input'), true);    
        $data = $this->limpiar_cadena_array($data);
        $user = (isset($data['username'])) ? $data['username']: NULL;
        $pass = (isset($data['password'])) ? $data['password']: NULL;

        if(is_null($user) || is_null($pass)){
			echo json_encode(['status'=> false, 'response'=>'¡No se ha recibido ningún dato!'], JSON_UNESCAPED_UNICODE);
			return;
		}

		$mensaje = "";
		$status = false;
		if ($user != "") {
			if ($pass != "") {
				$res =  $this->getModel()->login($user, $pass);
				if ($res['id_usuario'] != NULL) {
					$status = true;
					$_SESSION['userId'] = $res['id_usuario'];
					$_SESSION['idPersona'] = $res['id_persona'];
					$_SESSION['rolId'] = $res['id_rol'];
					$_SESSION['rolname'] = $res['nombre'];
					$_SESSION['idRecovery'] = $res['id_recovery'];
					if($_SESSION['idRecovery'] == NULL){
						$_SESSION['userStatus'] = "NON";
					}
					$mensaje = "¡Acceso concedido!";
					$status = true;
				}else{
					$mensaje = "Usuario o Contraseña incorrectos";
					$status = false;
				}
			}else{
				$mensaje = "Contraseña requerida";
			}
		}else{
			$mensaje = "Usuario requerido";
		}
		$datos = array('estado' => $status, 'mensaje' => $mensaje);
		echo json_encode($datos);
		
	}


	public function iniciar(){

		if(isset($_SESSION['userId']) && $_SESSION['userStatus'] == "NON"){
			//echo $this->CheckSessionStart($_SESSION['userId']);
			$this->getView()->titlepage($title= "Cambio de Contraseña");
			$res =  $this->getModel()->getUser($_SESSION['userId']);
			$this->getView()->usuario =  $res['usuario'];
			$vista= 'login/changepass';
			$this->getView()->render($vista);
			return;
		}elseif ($_SESSION['userStatus'] == 'NO') {
			self::preguntasseguridad();
		}
		else{
			self::index();
		}
	}


	public function changepass(){
		$res =  $this->getModel()->getUser($_SESSION['userId']);
		$username = $res['usuario'];
		$pass0 = $this->limpiar_cadena($_POST['current_pass']);
		$pass = $this->limpiar_cadena($_POST['new_pass']);
		$pass1 = $this->limpiar_cadena($_POST['new_pass1']);
		$mensaje = "";
		$status = false;


		if(is_null($pass) ||  $pass =='' || is_null($pass1) || $pass1 ==''){
            echo $this->return_response(false, "La contraseña no puede estar vacía.");
            return;
        }

        if($pass != $pass1){
            echo $this->return_response(false, "Las contraseñas no coinciden.");
            return;
        }

        $validar_pass= $this->PerfilModelo->validar_password($_SESSION['userId'], $pass0);

        if($validar_pass == 0){
            echo $this->return_response(false, "La contraseña actual es incorrecta.");
            return;
        }

        $pass_def = $this->UserModelo->default_password($_SESSION['userId']);

        if($pass == $pass_def){
            echo $this->return_response(false, "La contraseña no puede ser igual a la contraseña por defecto.");
            return;
        }

		$res =  $this->getModel()->recoverysetpassword($pass, $username);
		if ($res) {
			$status = true;
			$mensaje= "¡Contraseña restablecida exitosamente!";
			$_SESSION['userStatus'] = "NO";
		}else{
			$mensaje = "No se logró restablecer la contraseña";
			$status = false;
		}
			
		echo $this->return_response($status, $mensaje);
	}

	public function activar(){
		$status = $this->activateuser();
		if($status){
			$this->index();
		}else{
			$this->iniciar();
		}
	}

	public function activateuser(){
		$user = $_SESSION['userId'];
		$recovery = $_SESSION['idRecovery'];
		if(isset($user) && $recovery != NULL){
			return true;
		}else{
			return false;
		}	
				
	}


	public function preguntasseguridad(){
		$this->getView()->titlepage($title= "Preguntas de seguridad");
		$res =  $this->getModel()->getUser($_SESSION['userId']);
		$this->getView()->id_rol = $res['id_rol'];
		$this->getView()->usuario =  $res['usuario'];
		$vista= 'login/preguntasseguridad';
		$this->getView()->render($vista);
	}


	public function recovery(){
		$this->CheckSessionStart($_SESSION['userId']);
		$this->getView()->titlepage($title= "Recuperación de Contraseña");
		$vista= 'login/recovery';
		$this->getView()->render($vista);
			
	}



	public function setpreguntasrecovery(){
		if($_POST['action'] == 'frmSETPS'){

			$p1= $this->limpiar_cadena($_POST['q1']);
			$p2= $this->limpiar_cadena($_POST['q2']);
			$p3= $this->limpiar_cadena($_POST['q3']);
			$r1= $this->limpiar_cadena($_POST['a1']);
			$r2= $this->limpiar_cadena($_POST['a2']);
			$r3= $this->limpiar_cadena($_POST['a3']);
			$res =  $this->getModel()->getUser($_SESSION['userId']);
			$user = $res['id_usuario'];
			$mensaje = "";
			$status = false;

			if($p1 == "" && $p2 == "" && $p3 == ""){
            echo $this->return_response(false, "¡Complete todas las preguntas de seguridad!");
            return;
        	}

        	if(!$this->validarPreguntas($p1) || !$this->validarPreguntas($p2) || !$this->validarPreguntas($p3)){
            echo $this->return_response(false, "¡Preguntas con carácteres especiales no permitidos. Longitud mínima 10 caracteres!");
            return;
        	}

        	if(!$this->validarRespuestas($r1) || !$this->validarRespuestas($r2) || !$this->validarRespuestas($r3)){
            echo $this->return_response(false, "¡Respuestas con carácteres especiales no permitidos. Longitud mínima 4 caracteres!");
            return;
        	}


        	if($r1 == "" || $r2 == "" || $r3 == ""){
            echo $this->return_response(false, "¡Complete todas las respuestasss!");
            return;
        	}

			$res =  $this->getModel()->recoverySETpreguntas($p1, $p2, $p3, $r1, $r2, $r3, $user);
			if ($res['status']) {
				$status = true;
				$_SESSION['idRecovery'] = $res['msg'];
				$_SESSION['userStatus'] = "YES";
			}else{
				$mensaje = "No se pudo establecer las preguntas de seguridad.";
				$status = false;
			}
				
			echo $this->return_response($status, $mensaje);
		}
	}

	public function recuperarpass(){
		$username = $this->limpiar_cadena($_POST['user']);
		$mensaje = "";
		$status = false;

		if ($username != "") {
			$res =  $this->getModel()->recovery($username);
			if ($res) {
				$status = true;
				session_start();
				$_SESSION['p1'] = $res['p1'];
				$_SESSION['p2'] = $res['p2'];
				$_SESSION['p3'] = $res['p3'];
				$_SESSION['userrecovery'] = $res['usuario'];
			}else{
				$mensaje = "Usuario incorrecto o el Usuario no tiene Preguntas de Seguridad definidas.";
				$status = false;
				}
		}else{
			$mensaje = "Usuario requerido";
			}	
		
		$datos = array('status' => $status, 'response' => $mensaje);
		echo json_encode($datos);
	}


	public function recuperarpassword(){
		session_start();
		$username = $_SESSION['userrecovery'];
		$ans1 = $this->limpiar_cadena($_POST['ans1']);
		$ans2 = $this->limpiar_cadena($_POST['ans2']);
		$ans3 = $this->limpiar_cadena($_POST['ans3']);
		$mensaje = "";
		$status = false;
		if ($username != "") {
			$res =  $this->getModel()->recoverypassword($username, $ans1, $ans2, $ans3);
			if ($res) {
				$status = true;
				$_SESSION['uservalidated'] = $res['usuario'];
				unset($_SESSION['userrecovery']);
			}else{
				$mensaje = "¡Respuestas incorrectas!";
				$status = false;
				}
		}else{
			$mensaje = "Por favor, responda todas las preguntas de seguridad.";
			}	
		
		$datos = array('status' => $status, 'response' => $mensaje);
		echo json_encode($datos);
	}


	public function recuperarSETpassword(){
		session_start();
		$username = $_SESSION['uservalidated'];
		$pass = $this->limpiar_cadena($_POST['pass']);
		$pass1 = $this->limpiar_cadena($_POST['pass1']);
		$mensaje = "";
		$status = false;
		if ($pass != "" && $pass1 !="") {
			if ($pass == $pass1) {
				$res =  $this->getModel()->recoverysetpassword($pass, $username);
				if ($res) {
					$status = true;
					unset($_SESSION['uservalidated']);
					$mensaje= "¡Contraseña restablecida exitosamente!";
				}else{
					$mensaje = "No se logró restablecer la contraseña";
					$status = false;
				}
			}else{
				$mensaje = "Las contraseñas no coinciden";
			}
		}else{
			$mensaje = "Los campos de contraseña no pueden estar vacíos";
		}
		$datos = array('status' => $status, 'response' => $mensaje);
		echo json_encode($datos);
	}

	public function logout(){
		session_start();
		$_SESSION = array();
		session_destroy();

		echo json_encode(array('status' => true));					
	}


}

?>