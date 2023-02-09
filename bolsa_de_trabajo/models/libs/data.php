<?php
Session::init();
require("libs/Database.php");
/**
 * Datos que serán heredados por la mayoria de controladores.
 */
trait Data
{
    private function connect()
    {
        return $database = new Database();
    }

    public function get_alldepartamentos()
    {
        $this->db = $this->connect();
        $query = $this->db->connect()->prepare("SELECT COUNT(ubi_depa) AS cantidad, ubi_depa
        FROM empleos
        WHERE condicion='1' AND fechafin>=CURDATE() GROUP BY ubi_depa");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($data) {
            return (array("success" => true, "message" => $data));
        } else {
            return (array("success" => false, "message" => "No se encontraron registros"));
        }
    }

    public function get_allprovincias()
    {
        $this->db = $this->connect();
        $query = $this->db->connect()->prepare("SELECT COUNT(ubi_provi) AS cantidad, ubi_provi
        FROM empleos
        WHERE condicion='1' AND fechafin>=CURDATE() GROUP BY ubi_provi");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($data) {
            return (array("success" => true, "message" => $data));
        } else {
            return (array("success" => false, "message" => "No se encontraron registros"));
        }
    }

    public function get_allprovinciasSearch($name)
    {
        $this->db = $this->connect();
        $query = $this->db->connect()->prepare("SELECT COUNT(ubi_provi) AS cantidad, ubi_provi, ubi_depa
        FROM empleos
        WHERE ubi_depa =(SELECT ubi_depa FROM empleos WHERE ubi_depa='$name' OR ubi_provi='$name' LIMIT 1) 
        AND condicion='1' AND fechafin>=CURDATE() GROUP BY ubi_provi");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($data) {
            return (array("success" => true, "message" => $data));
        } else {
            return (array("success" => false, "message" => "No se encontraron registros"));
        }
    }
}
