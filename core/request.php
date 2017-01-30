<?php
class Request{

	public $url;  // ULR appellé par l'utilisateur

	function __construct(){
		$this->url = $_SERVER['PATH_INFO'];
	}
}
?>