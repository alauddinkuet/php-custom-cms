<?php
    
// specify parameters for autoloading classes
spl_autoload_register(NULL, FALSE);
spl_autoload_extensions('.php');
spl_autoload_register(array('Autoloader', 'load'));

// define a simple Autoloader class  
class Autoloader
{ 
	public static function load($class)
	{
		if (class_exists($class, FALSE))
		{
			return;
		}
		$modelFile = MODELPATH.$class . '.php';
		$controllerFile = CONTROLLERPATH.$class . '.php';
		$libFile=LIBPATH.$class. '.php';
		if (file_exists($modelFile))
		{
			require($modelFile);
		}elseif(file_exists($controllerFile))
		{
			require($controllerFile);
			}
		elseif(file_exists($libFile)){
			
			require($libFile);
		}
		else{
			throw new Exception('File ' . $class . ' not found.');
		}
		
		if (!class_exists($class, FALSE))
		{
			throw new Exception('Class ' . $class . ' not found.');
		}
	}
}
?>