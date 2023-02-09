<?php
require("models/libs/validation.php");
require("models/libs/data.php");

class Controller
{
    use Data;

    function __construct()
    {
        $this->validate = new Validation();
        $this->view = new View();
        $this->view->get_alldepartamentos= $this->get_alldepartamentos();
        $this->view->get_allprovincias= $this->get_allprovincias();
    }


    function loadModel($model)
    {
        $url = "models/" . $model . "model.php";
        $url_lib = "models/libs/" . $model . "model.php";
        if (file_exists($url)) {
            require $url;
            $modelName = $model . "Model";
            $this->model = new $modelName();
        }
        if (file_exists($url_lib)) {
            require $url_lib;
            $modelName = $model . "Model";
            $this->model = new $modelName();
        }
    }
}
