<?php
class Errors extends Controller{
	public function __construct($title="Error 404: No encontrado", $head="¡Error 404! ❌", $message= "La página que intenta buscar no existe", $render= "index"){
		parent::__construct();
		$this->title = $title;
		$this->head = $head;
		$this->message = $message;
		$this->render = $render;
		
			
	}

	public function index(){
		$this->getView()->titlepage($this->title);
		$this->getView()->mensaje = $this->message;
		$this->getView()->head = $this->head;
		$this->getView()->render('errors/'.$this->render);
	}




}

?>