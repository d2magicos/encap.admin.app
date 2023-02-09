<?php
class Home extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->view->cantidad_empleos = $this->model->getCantidad_empleos();
        $this->view->empleos = $this->model->get_all_empleos();
        $this->view->css = array("home/css/main.css");
        $this->view->js = array("home/js/main.js");
        $this->view->render("home/index");
    }

    public function get_all_empleos()
    {
        echo json_encode($this->model->get_all_empleos());
    }

    public function get_empleoForID()
    {
        echo json_encode($this->model->get_empleoForID($_POST));
    }

    public function empleo($name_empleo = null, $id_empleo = 0)
    {
        if (is_numeric($id_empleo)) {
            $this->view->mas_empleos_departamento = $this->model->get_masempleosDepartamento($id_empleo);
            $this->view->empleo_relacionados = $this->model->get_empleosRelacionados($id_empleo);
            $this->view->empleo = $this->model->get_empleo($id_empleo);
            if ($this->view->empleo["success"]) {
                $this->view->css = array("home/css/empleo.css", "home/css/main.css");
                $this->view->js = array("home/js/main.js");
                $this->view->render("home/php/empleo");
            } else {
                header('location: ' . URL . 'error');
            }
        } else {
            header('location: ' . URL . 'error');
        }
    }

    public function search($name_empleo = null, $name_depa = null)
    {
        if (($name_empleo == null && $name_depa == null)) {
            header('location: ' . URL . 'error');
        }
        if (!is_numeric(rtrim($name_empleo)) && !is_numeric(rtrim($name_depa))) {
            $this->view->get_allprovinciasSearch = $this->get_allprovinciasSearch($name_depa);
            $this->view->name_empleo = $name_empleo;
            $this->view->name_depa = $name_depa;
            $this->view->css = array("home/css/search.css", "home/css/main.css");
            $this->view->js = array("home/js/main.js", "home/js/search.js");
            $this->view->render("home/php/search");
        } else {
            header('location: ' . URL . 'error');
        }
    }

    public function get_empleosSearch($name_empleo = null, $name_depa = null)
    {
        if (!is_numeric(rtrim($name_empleo)) && !is_numeric(rtrim($name_depa))) {
            echo json_encode($this->model->get_all_empleosSearch(["name_empleo" => $name_empleo, "name_depa" => $name_depa]));
        } else {
            echo json_encode(array("success" => false, "message" => "Error"));
        }
    }

    public function get_anuncios()
    {
        echo json_encode($this->model->get_anuncios());
    }
}
