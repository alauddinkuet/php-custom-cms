<?php
error_reporting(-1);
define('DEVELOPMENT',true);


define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_custom_cms');
define('DB_USER', 'root');
define('DB_PASS', '');

 
define('BASEPATH', 'http://localhost/php-custom-cms/');
define('MODELPATH','models/');
define('CONTROLLERPATH','controllers/');
define('VIEWPATH','views/');
define('LIBPATH','libs/');
 
define('DEFAULTCONTROLLER', 'index');
define('PRODUCT_IMAGE_URL', BASEPATH . 'product_image/');
define('PRODUCT_IMAGE_PATH', DOCUMENT_ROOT . 'product_image/');


DEFINE('SESSION_SALT',  'SALT_FOR_SESSION');
