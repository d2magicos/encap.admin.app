<?php
class Contactos extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->view->css = array("contactos/css/main.css");
        $this->view->js = array("contactos/js/main.js");
        $this->view->php = array("contactos/php/modal.php");
        $this->view->render("contactos/index");
    }

    public function send_email()
    {
        if ($this->validate->validateEmail($_POST["email"])) {
            echo json_encode($this->model->send_email($_POST));
        } else {
            return array("success" => false, "message" => "El correo electrónico ingresado no es correcto");
        }
    }
}
