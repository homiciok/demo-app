<?php

class Router {

	private $defaultController = "HomeController";
	private $routes = [
		"/home$/"     => "HomeController",
		"/profile$/"  => "ProfileController",
		"/logout$/"   => "LogoutController",
		"/register$/" => "RegisterController",
		"/login$/"	  => "LoginController",
		"/404$/"	  => "NotFoundController",
		"/gallery$/"  => "GalleryController"

	];

	public function __contruct($defaultController) {
		$this->defaultController = $defaultController;
	}

	public function getController($request_url) {
		foreach($this->routes as $route => $controller) {
			if (preg_match($route, $request_url)) {
				return new $controller();
			}
		}

		return new $this->defaultController();
	}

	public static function redirect($url){
		header('Location'. $url);
	}
}
?>
