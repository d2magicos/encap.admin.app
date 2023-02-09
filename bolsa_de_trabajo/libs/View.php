<?php

class View
{
	public $pathScript = null;
	public $url = null;

	function __construct()
	{
	}

	public function render($name, $noInclude = false)
	{
		if ($noInclude == true) {
			require 'views/' . $name . '.php';
		} else {
			require 'views/templates/header.php';
			require 'views/' . $name . '.php';
			require 'views/templates/footer.php';
		}
	}
}
