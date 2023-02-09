<?php

require('config.php');

function banshee_autoload($class)
{
    require LIBS . $class . ".php";
}

spl_autoload_register("banshee_autoload");

$app = new App();
