<?php
class Main extends Controller{
	public function __construct(){
		parent::__construct();
		session_start();
		$this->CheckSession($_SESSION['userId']);
		$this->CheckStatusUser($_SESSION['userStatus']);
			
	}

	public function index(){
		$this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
		$this->getView()->titlepage($title="Inicio");
		$vista= 'main/index';
		$this->getView()->render($vista);
	}
			

}

?>