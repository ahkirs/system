<?php
class Perfil extends Controller{
    private $PerfilModelo;
    private $UserModelo;
	public function __construct(){
		parent::__construct();
        $this->PerfilModelo = new PerfilModelo();
        $this->UserModelo = new UsersModelo();
		session_start();
		$this->CheckSession($_SESSION['userId']);
		$this->CheckStatusUser($_SESSION['userStatus']);
			
	}

	public function index(){
		$this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
		$this->getView()->titlepage($title="Perfil");
		$vista= 'perfil/index';
		$this->getView()->render($vista);
	}


    private function BuscarUsuario($id){
        $datos = $this->PerfilModelo->Datos_User($id);
        return $datos;
        
    }

    public function getUsuario(){
        $data = $this->BuscarUsuario($_SESSION['idPersona']);
        $json = json_encode($data, JSON_UNESCAPED_UNICODE);
        echo $json;
    }

    public function CheckUser($id){
        $data = $this->BuscarUsuario($id);
        return $data;
    }




    /*public function setNames(){
        $data = json_decode(file_get_contents('php://input'), true);    
        $data = $this->limpiar_cadena_array($data);
        $pn = (isset($data['pn'])) ? $data['pn']:NULL;
        $sn = (isset($data['sn'])) ? $data['sn']:NULL;
        $tn = (isset($data['tn'])) ? $data['tn']:NULL;
        $pa = (isset($data['pa'])) ? $data['pa']:NULL;
        $sa = (isset($data['sa'])) ? $data['sa']:NULL;
        

        if(is_null($pn) || is_null($pn) || $pa =='' || $pa ==''){
            echo json_encode(['status'=> false, 'response'=>'¡No se ha recibido ningún dato!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $datos = ['pn'=> $pn,
                'sn'=> $sn,
                'tn'=> $tn,
                'pa'=> $pa,
                'sa'=> $sa,
                'id_persona'=> $_SESSION['idPersona']];

        $persona= $this->Persona;
        $names = $persona->setPersona($datos);

        if(!is_null($names)){
            $msg = ['status'=> true, 'response'=>'Datos personales actualizados exitosamente.'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo actualizar los datos personales.'];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }

    public function setborndate(){
        $data = json_decode(file_get_contents('php://input'), true);    
        $data = $this->limpiar_cadena_array($data);
        $fn = (isset($data['fn'])) ? $data['fn']:NULL;
                

        if(is_null($fn) || is_null($fn)){
            echo json_encode(['status'=> false, 'response'=>'¡No se ha recibido ningún dato!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $datos = ['fn'=> $fn,
                'id_persona'=> $_SESSION['idPersona']];

        $persona= $this->Persona;
        $names = $persona->setFechaNacPersona($datos);

        if(!is_null($names)){
            $msg = ['status'=> true, 'response'=>'Fecha de nacimiento actualizada exitosamente.'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo actualizar la fecha de nacimiento.'];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }*/


    public function setAddress(){
        $data = json_decode(file_get_contents('php://input'), true);    
        $data = $this->limpiar_cadena_array($data);
        $sector = (isset($data['sector'])) ? $data['sector']:NULL;
        $calle = (isset($data['calle'])) ? $data['calle']:NULL;
        $tipocasa = (isset($data['tipoCasa'])) ? $data['tipoCasa']:'Casa';
        $ncasa = (isset($data['numCasa'])) ? $data['numCasa']:NULL;
        $codpostal = (isset($data['codPostal'])) ? $data['codPostal']:'6050';
        $ptoref = (isset($data['refCasa'])) ? $data['refCasa']:NULL;
        $parroquia = (isset($data['parroquia'])) ? $data['parroquia']:NULL;
        

        if(is_null($sector) || is_null($calle) || is_null($ncasa) || is_null($parroquia) || $calle =='' || $sector =='' || $ncasa =='' || $parroquia ==''){
            echo json_encode(['status'=> false, 'response'=>'¡No se ha recibido ningún dato!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $datos = ['sector'=> $sector,
                'calle'=> $calle,
                'cod_postal'=> $codpostal,
                'ca_edf'=> $tipocasa,
                'n_vivienda'=> $ncasa,
                'pto_ref'=> $ptoref,
                'parroquia'=> $parroquia,
                'id_persona'=> $_SESSION['idPersona']];

        $address = $this->PerfilModelo->update_address_User($datos);

        if($address){
            $msg = ['status'=> true, 'response'=>'Dirección actualizada exitosamente.'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo actualizar la dirección.'];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }

    public function setPhone(){
        $data = json_decode(file_get_contents('php://input'), true);    
        $data = $this->limpiar_cadena_array($data);
        $cod_area = (isset($data['newCodArea'])) ? $data['newCodArea']: NULL;
        $numero = (isset($data['newTel'])) ? $data['newTel']: NULL;

        if(is_null($cod_area) || is_null($numero) || $cod_area =='' || $numero ==''){
            echo json_encode(['status'=> false, 'response'=>'¡No se ha recibido ningún dato!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $datos = ['cod_area'=> $cod_area,
                'numero'=> $numero,
                'tipo'=> 'M',
                'id_persona'=> $_SESSION['idPersona']];

        $phone = $this->PerfilModelo->update_phone_User($datos);

        if(!is_null($phone)){
            $msg = ['status'=> true, 'response'=>'Teléfono actualizado correctamente.'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo actualizar los datos del teléfono.'];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }

    public function setEmail(){
        $data = json_decode(file_get_contents('php://input'), true);
        $data = $this->limpiar_cadena_array($data);
        $correo = (isset($data['newEmail'])) ? $data['newEmail']: NULL;

        if(is_null($correo) || $correo ==''){
            echo json_encode(['status'=> false, 'response'=>'¡No se ha recibido ningún dato!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $datos = ['direccion_correo'=> $correo,
                    'id_persona'=> $_SESSION['idPersona']];

        $email = $this->PerfilModelo->update_correo_User($datos);

        if(!is_null($email)){
            $msg = ['status'=> true, 'response'=>'Correo electrónico actualizado correctamente.'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo actualizar el correo electrónico.'];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }

    public function setusername(){
        $data = json_decode(file_get_contents('php://input'), true);
        $data = $this->limpiar_cadena_array($data);
        $usuario = (isset($data['newUsername'])) ? $data['newUsername']: NULL;

        if(is_null($usuario) || $usuario ==''){
            echo json_encode(['status'=> false, 'response'=>'¡No se ha recibido ningún dato!'], JSON_UNESCAPED_UNICODE);
            return;
        }


        if(self::user_Exists($usuario, 'usuario')){
            echo $this->return_response(false, "¡Intente con un nombre de usuario distinto!");
            return;
        }


        $datos = ['value'=> $usuario,
                    'id_usuario'=> $_SESSION['userId']];

        $user = $this->PerfilModelo->update_user_pass_avatar_user($datos, 'usuario');

        if($user){
            $msg = ['status'=> true, 'response'=>'Nombre de usuario actualizado correctamente.'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo actualizar el nombre de usuario.'];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }


    public function setpassword(){
        $data = json_decode(file_get_contents('php://input'), true);
        $data = $this->limpiar_cadena_array($data);
        $password_actual = (isset($data['currentPass'])) ? $data['currentPass']: NULL;
        $password = (isset($data['newPass'])) ? $data['newPass']:NULL;


        if(is_null($password_actual) || is_null($password) || $password_actual =='' || $password ==''){
            echo json_encode(['status'=> false, 'response'=>'¡No se ha recibido toda la información!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $datos = ['value'=> $password,
                    'id_usuario'=> $_SESSION['userId']];

        $pass = $this->PerfilModelo->validar_password($_SESSION['userId'], $password_actual);


        $pass_def = $this->UserModelo->default_password($_SESSION['userId']);

        
        if($pass == 1){
            if($password == $pass_def){
            echo $this->return_response(false, "La nueva contraseña no puede ser la contraseña por defecto.");
            return;
            }
        }

        if($password == $password_actual){
            echo $this->return_response(false, "La nueva contraseña no puede ser igual a la contraseña actual.");
            return;
        }
        
        if ($pass == 1) {
            $datos['value'] = $this->encripta_pass($password);
            $user = $this->PerfilModelo->update_user_pass_avatar_user($datos, 'password');
        }else{
            echo json_encode(['status'=> false, 'response'=>'¡Contraseña actual incorrecta!'], JSON_UNESCAPED_UNICODE);
            return;
        }
        
        if($user){
            $msg = ['status'=> true, 'response'=>'Contraseña actualizada correctamente.'];
        }else{
            $msg = ['status'=> false, 'response'=>'No fue posible actualizar la contraseña.'];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }


    public function setavatar(){
        $ruta_img_perfil = __DIR__.'../../public/assets/img/perfiles';
        $data = json_decode(file_get_contents('php://input'), true);
        $image = (isset($data['newAvatar'])) ? $data['newAvatar']: '';

        if(is_null($image) || $image ==''){
            echo json_encode(['status'=> false, 'response'=>'¡No se ha recibido ningún dato!'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $check_image = $this->validate_image_format($image);
        
        if(!$check_image['response']){
            echo json_encode(['status'=> false, 'response'=>$check_image['imagen']], JSON_UNESCAPED_UNICODE);
            return;
        }

        $usuario = self::CheckUser($_SESSION['idPersona']);

        if(is_null($usuario['avatar'])){
            $img = $this->decode_image_base_64($check_image['imagen'], $check_image['extension'], $ruta_img_perfil);
            if ($img['status']){
                $datos = ['value'=> $img['avatar'],'id_usuario'=> $_SESSION['userId']];
                $user = $this->PerfilModelo->update_user_pass_avatar_user($datos, 'avatar');
            }
        }else{
            unlink($ruta_img_perfil.$usuario['avatar']);
            $img = $this->decode_image_base_64($check_image['imagen'], $check_image['extension'], $ruta_img_perfil);
            if ($img['status']){
                $datos = ['value'=> $img['avatar'],'id_usuario'=> $_SESSION['userId']];
                $user = $this->PerfilModelo->update_user_pass_avatar_user($datos, 'avatar');
            }
        }


        if($user){
            $msg = ['status'=> true, 'response'=>'Foto de perfil actualizada correctamente.'];
        }else{
            $msg = ['status'=> false, 'response'=>'No se pudo actualizar la foto de perfil.'];
            unlink($ruta_img_perfil.$img['avatar']);
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }

    /*public function setrecovery(){
        $data = json_decode(file_get_contents('php://input'), true);
        $data = $this->limpiar_cadena_array($data);
        $newquest = (isset($data['newQuestion'])) ? $data['newQuestion']: NULL;
        $newans = (isset($data['newAnswer'])) ? $data['newAnswer']: NULL;
        $questnum = (isset($data['questionNumber'])) ? $data['questionNumber']: NULL;


        if(is_null($newquest) || is_null($newans) || is_null($questnum) ||  $newquest =='' ||  $newans =='' ||  $questnum ==''){
            echo json_encode(['status'=> false, 'response'=>'¡No se ha recibido ningún dato!'], JSON_UNESCAPED_UNICODE);
            return;
        }


        $datos = ['value1'=> $newquest,
                  'value2'=> $newans,
                  'id_recovery'=> $_SESSION['idRecovery']];
        $field1 = 'p'.$questnum;
        $field2 = 'r'.$questnum;

        $usuario= $this->Usuarios;
        $recovery = $usuario->Actualizar_Recovery($datos, $field1, $field2);
        
              
        if($recovery){
            $msg = ['status'=> true, 'response'=>'Pregunta de Seguridad actualizada correctamente.'];
        }else{
            $msg = ['status'=> false, 'response'=>'No fue posible actualizar la pregunta de seguridad.'];
        }
        $json = json_encode($msg, JSON_UNESCAPED_UNICODE);
        echo $json;
    }*/

    public function user_Exists($data, $field){
        $data = ['value'=>$data];
        $data = $this->UserModelo->existe_user($data, $field);
        return $data['userExists'];
    }
			

}

?>