<?php
set_include_path(get_include_path()
				.PATH_SEPARATOR.'controllers'
				.PATH_SEPARATOR.'controllers/pageControllers'
				.PATH_SEPARATOR.'controllers/facadeControllers'
				.PATH_SEPARATOR.'controllers/commandControllers'
				.PATH_SEPARATOR.'models/interfaces'
				.PATH_SEPARATOR.'models/utilities'
				.PATH_SEPARATOR.'models/validators'
				.PATH_SEPARATOR.'models'
				.PATH_SEPARATOR.'views');
require_once "config/config.php";
function __autoload($class){
	require_once $class.'.php';
}
$fc = FrontController::getInstance();
$fc->route();
echo $fc->getBody();
?>