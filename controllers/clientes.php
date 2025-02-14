<?php
class Clientes extends Controller{
	public function __construct(){
		parent::__construct();
		$this->clientesM = new ClientesModelo();
		session_start();
	}

	public function index(){
		$this->getView()->menu = $this->Menu($_SESSION['rolId']);// A partir del Rol se envía el menu a la vista
		$this->getView()->titlepage($title="Clientes");
		$vista= 'clientes/index';
		$this->getView()->render($vista);
	}

	

	
}

?>