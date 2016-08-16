<?php
	
	class Redirect{
		
		public static function toPage($location = null){
			if($location){
				header('Location: ' . $location);
				exit;
			}
		}
	}

?>