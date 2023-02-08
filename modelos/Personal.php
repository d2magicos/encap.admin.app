<?php 
require "../configuraciones/Conexion.php";

    Class Personal {
        //Implementamos nuestro constructor
        public function __construct() { } 
        
        public function selectPersonal() {
            $sql = "SELECT * FROM personal
                    WHERE cargo = 'ASESOR COMERCIAL' AND condicion = 1";

            return ejecutarConsulta($sql);
        }
    }
?>