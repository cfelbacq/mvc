<?php
class Dispatcher {

	var $request;

	function __construct(){
		$this->request = new Request();
		print_r ($this->request);
		Router::parse($this->request->url, $this->request);
		print_r ($this->request);
		$controller = $this->loadController();
		echo "<br/>";
		call_user_func_array(array($controller, $this->request->action), $this->request->params);
	}

	function loadController(){
		$name = ucfirst($this->request->controller).'Controller';
		echo "<br/>";
		echo $name;
		$file = ROOT.DS.'controller'.DS.$name.'.php';
		require $file;
		return new $name($this->request);
	}
}
?>