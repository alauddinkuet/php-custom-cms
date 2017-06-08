<?php
/**
 * Dispatch the request splitting url and launch the proper controller
 * 
 * */

class Bootstrap {

	function __construct() {

		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		
		
		$controllerName=empty($url[0])?DEFAULTCONTROLLER:$url[0];
	


        $method = empty($url[1]) ?  'index': $url[1];
        $args= empty($url[2]) ? NULL : $url[2];
		// calling methods
		$controller = new $controllerName(); 
		if(method_exists($controller, $method)){
       		 $controller->$method($args);
		}else{
			throw new Exception ("Method doesn't exist");
		}
		
		
	}
}
