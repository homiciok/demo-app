<?php

class Sessions {

		
		public static function isSession($name) {
			return (isset($_SESSION[$name])) ? true : false;
		}
		public static function insertSession($name, $value) {
			return $_SESSION[$name] = $value;
		}
		public static function getSession($name) {
			return $_SESSION[$name];
		}
		public static function deleteSession($name) {
			if (self::exists($name)) {
				unset($_SESSION[$name]);
			}
		}
	}

?>