<?php

/**
 * Index page load the needed files and dispatch requests
 * 
 * */

require 'config/config.php';
require 'libs/Autoload.php';
 

// handle request and dispatch it to the appropriate controller through bootstrap
try{ 
$app = new Bootstrap(); 
} 
catch (Exception $e){
	if(DEVELOPMENT==true){
	echo $e->getMessage();
	}
	exit();
} 
