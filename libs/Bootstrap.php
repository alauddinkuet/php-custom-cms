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
        //$args= empty($url[2]) ? NULL : $url[2];
		// calling methods
		$controller = new $controllerName();
		if(method_exists($controller, $method)){
       		//$controller->$method($args);
            unset($url[0]);
            unset($url[1]);
            call_user_func_array(array($controller, $method), $url);
		}else{
		    if($url[1]){
                $this->loadFolderController($url);
            }else{
			    throw new Exception ("Method doesn't exist");
            }
		}
	}

	function loadFolderController($url) {
        $class = $url[0] . '/'. $url[1];
        $controllerName = $url[1];
        $controllerFile = CONTROLLERPATH . $class . '.php';

        if(file_exists($controllerFile))
            require($controllerFile);
        else
            throw new Exception('File ' . $controllerFile . ' not found.');

        $controller = new $controllerName();
        $method = empty($url[2]) ?  'index': $url[2];
        //$args= empty($url[3]) ? NULL : $url[3];
        if(method_exists($controller, $method)){
            //$controller->$method($args);
            unset($url[0]);
            unset($url[1]);
            unset($url[2]);
            call_user_func_array(array($controller, $method), $url);
        }else{
            throw new Exception ("Method doesn't exist");
        }
    }
}
