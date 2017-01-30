<?php
class Dispatcher {

	var $request;

	function __construct(){
		$this->request = new Request();
		//print_r ($this->request);
		Router::parse($this->request->url, $this->request);
	//	print_r ($this->request);
		$controller = $this->loadController();
	//	echo "<br/>";
		if (!in_array($this->request->action, get_class_methods($controller))){
			$this->error('Le controller'.$this->request->controller.'n\'a pas de methode '.$this->request->action);
		}
		call_user_func_array(array($controller, $this->request->action), $this->request->params);
		$controller->render($this->request->action);
	}

	function error($message){
		$controller = new Controller($this->request);
		$controller->render('/errors/404');
		die();
	}

	function loadController(){
		$name = ucfirst($this->request->controller).'Controller';
	//	echo "<br/>";
	//	echo $name;
		$file = ROOT.DS.'controller'.DS.$name.'.php';
		require $file;
		return new $name($this->request);
	}
}
?>