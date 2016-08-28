<?php
class Cookie(){

	public static function isCookie($name) {
		return (isset($_COOKIE[$name])) ? true : false;
	}

	public static function getCookie($name) {
		return $_COOKIE[$name];
	}

	public static function insertCookie($name, $value, $expiry) {
		if (setcookie($name, $value, strtotime( '+30 days' ), '/')) {
			return true;
		}
		return false;
	}

	public static function deleteCookie($name){
		self::insertCookie($name, '', time()-1);
	}
}
?>