<?php
require_once 'controllers/error.php';

// Mapeo a donde queremos llevar al usuario
class App
{

    function __construct()
    {

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        // cuando se ingresa sin definir controlador
        if (empty($url[0])) {
            $archivoController = 'controllers/home.php';
            require_once $archivoController;
            $controller = new Home();
            $controller->loadModel('home');
            $controller->render();
            return false;
        }
        $archivoController = 'controllers/' . $url[0] . '.php';
        if ($url[0] == "error") {
            $controller = new Errors();
            $controller->render();
            exit;
        }
        if (file_exists($archivoController)) {
            require_once $archivoController;
            // inicializar controlador
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            // # elementos del arreglo
            $nparam = sizeof($url);

            if ($nparam > 1) {
                if ($nparam > 2) {
                    $param = [];
                    for ($i = 2; $i < $nparam; $i++) {
                        array_push($param, $url[$i]);
                    }
                    if (method_exists($controller, $url[1])) {
                        if(count($param)>=2){
                            $controller->{$url[1]}($param[0], $param[1]);
                        }else{
                            $controller = new Errors();
                            $controller->render();
                        }
                    } else {
                        $controller = new Errors();
                        $controller->render();
                    }
                } else {
                    if (method_exists($controller, $url[1])) {
                        $controller->{$url[1]}();
                    } else {
                        $controller = new Errors();
                        $controller->render();
                    }
                }
            } else {
                $controller->render();
            }
        } else {
            $controller = new Errors();
            $controller->render();
        }
    }
}
