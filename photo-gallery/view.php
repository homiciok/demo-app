<?php

class View {
	private $path = "templates/home.php";

	public function __construct($path) {
		$this->path = $path;
	}

	public function render(array $data = array()) {
		extract($data);
		ob_start();

		include $this->path;

		$content = ob_get_clean();

		return $content;
	}
}
?>