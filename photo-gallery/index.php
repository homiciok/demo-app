<?php
	$classesDir = array (
		'controllers/',
		'templates/',
		'models/'
		);

	function __autoload($class_name) {
		global $classesDir;
		foreach ($classesDir as $directory) {
			if (file_exists($directory . $class_name . '.php')) {
				require_once ($directory . $class_name . '.php');
				return;
			}
		}
	}
	require("router.php");
	require("view.php");

	$connection = DB::getInstance();

	$router = new Router();
	$controller = $router->getController($_SERVER['REQUEST_URI']);
	echo $controller->execute($connection);

?>