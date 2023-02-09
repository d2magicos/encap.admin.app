<?php
date_default_timezone_set("America/Lima");

class HomeModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getCantidad_empleos()
    {
        $query = $this->db->connect()->prepare("SELECT COUNT(idempleo) as amount FROM empleos WHERE condicion='1' AND fechafin>=CURDATE()");
        $query->execute();
        $reply = $query->fetch(PDO::FETCH_ASSOC)["amount"];

        return array('success' => true, 'message' => $reply);
    }

    public function get_all_empleos()
    {
        $query = $this->db->connect()->prepare("SELECT * FROM empleos WHERE condicion='1' AND fechafin>=CURDATE() ORDER BY destacado DESC, fechainicio DESC");
        $query->execute();
        $reply = $query->fetchAll(PDO::FETCH_ASSOC);

        return array('success' => true, 'message' => $reply);
    }

    public function get_all_empleosDestacados()
    {
        $query = $this->db->connect()->prepare("SELECT * FROM empleos WHERE condicion='1' AND destacado='1' OR fechafin>=CURDATE() ORDER BY fechainicio DESC LIMIT 3");
        $query->execute();
        $reply = $query->fetchAll(PDO::FETCH_ASSOC);

        return array('success' => true, 'message' => $reply);
    }

    public function get_empleoForID($data)
    {
        $query = $this->db->connect()->prepare("SELECT * FROM empleos WHERE condicion='1' AND fechafin>=CURDATE() AND idempleo=:idempleo");
        $query->bindParam(":idempleo", $data["id_empleo"]);
        $query->execute();
        $reply = $query->fetch(PDO::FETCH_ASSOC);

        if ($reply) {
            return array('success' => true, 'message' => $reply);
        } else {
            return array('success' => false, 'message' => null);
        }
    }

    public function get_empleo($id_empleo)
    {
        if (is_int(intval($id_empleo))) {
            $query = $this->db->connect()->prepare("SELECT * FROM empleos WHERE condicion='1' AND fechafin>=CURDATE() AND idempleo=$id_empleo");
            $query->execute();
            $reply = $query->fetch(PDO::FETCH_ASSOC);

            if ($reply) {
                return array('success' => true, 'message' => $reply);
            } else {
                return array('success' => false, 'message' => $reply);
            }
        } else {
            return array('success' => false, 'message' => "Error");
        }
    }

    public function get_masempleosDepartamento($id_empleo)
    {
        $query = $this->db->connect()->prepare("SELECT idempleo, nombre, ubi_depa FROM empleos WHERE ubi_depa=(SELECT ubi_depa FROM empleos WHERE idempleo=$id_empleo) AND condicion='1' AND fechafin>=CURDATE() AND idempleo!=$id_empleo");
        $query->execute();
        $reply = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($reply) {
            return array('success' => true, 'message' => $reply);
        } else {
            return array('success' => false, 'message' => "Error");
        }
    }

    public function get_empleosRelacionados($id_empleo)
    {
        $query = $this->db->connect()->prepare("SELECT nombre, ubi_depa, ubi_provi FROM empleos WHERE idempleo=$id_empleo");
        $query->execute();
        $reply = $query->fetch(PDO::FETCH_ASSOC);
        $nombre = $reply["nombre"];
        $ubi_depa = $reply["ubi_depa"];
        $ubi_provi = $reply["ubi_provi"];
        if ($nombre) {
            $query = $this->db->connect()->prepare("SELECT * FROM empleos WHERE (nombre LIKE '%$nombre%' OR ubi_depa LIKE '%$ubi_depa%' OR ubi_provi LIKE '%$ubi_provi%') AND idempleo!=$id_empleo AND fechafin>=CURDATE() LIMIT 3");
            $query->execute();
            $reply = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($reply) {
                return array('success' => true, 'message' => $reply);
            } else {
                return array('success' => false, 'message' => $reply);
            }
        } else {
            return array('success' => false, 'message' => "Error");
        }
    }

    public function get_all_empleosSearch($data)
    {
        $name_empleo = $data["name_empleo"] == "todo" ? "%" : $data["name_empleo"];
        $ubi = $data["name_depa"] == "todo" ? "%" : $data["name_depa"];

        $query = $this->db->connect()->prepare("SELECT * FROM empleos WHERE nombre LIKE '%$name_empleo%' AND (ubi_depa LIKE '%$ubi%' OR ubi_provi LIKE '%$ubi%') AND fechafin>=CURDATE() ORDER BY 1 DESC");
        $query->execute();
        $reply = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($reply) {
            return array('success' => true, 'message' => $reply);
        } else {
            return array('success' => false, 'message' => []);
        }
    }

    public function get_anuncios()
    {
        $query = $this->db->connect()->prepare("SELECT * FROM anuncios");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($data) {
            return (array("success" => true, "message" => $data));
        } else {
            return (array("success" => false, "message" => "No se encontraron registros"));
        }
    }
}
