<?php 
    //  Incluímos inicialmente la conexión a la base de datos
    require "../configuraciones/Conexion.php";

    class Subtipocurso {
        public function __construct() { }

        public function insertar($nombre, $idcategoria) { 
            $sql = "INSERT INTO subtipocurso (nombre, idcategoria, condicion) VALUES ('$nombre', $idcategoria, 1)";

            return ejecutarConsulta($sql);
        }

        public function editar($id, $nom, $idcat) { 
            $sql = "UPDATE subtipocurso SET nombre = '$nom', idcategoria = '$idcat'
                    WHERE idsubtipo = '$id'";

            return ejecutarConsulta($sql);
        }

        public function desactivar($id) {
            $sql = "UPDATE subtipocurso SET condicion = 0
                    WHERE idsubtipo = '$id'";

            return ejecutarConsulta($sql);
        }

        public function activar($id) {
            $sql = "UPDATE subtipocurso SET condicion = 1
                    WHERE idsubtipo = '$id'";

            return ejecutarConsulta($sql);
        }

        public function listar() { 
            $sql = "SELECT scat.idsubtipo, scat.nombre, cat.nombre as categoria, scat.condicion 
                    FROM subtipocurso scat
                    INNER JOIN categoria cat ON scat.idcategoria = cat.idcategoria";

            return ejecutarConsulta($sql);
        }

        public function mostrarx($id) {
            $sql = "SELECT idsubtipo, nombre, idcategoria, condicion
                    FROM subtipocurso
                    WHERE idsubtipo = '$id'";

            return ejecutarConsultaSimpleFila($sql);
        }

        public function listarxCategoria($idcategoria) {
            $sql = "SELECT scat.idsubtipo, scat.nombre
                    FROM subtipocurso scat
                    WHERE scat.idcategoria = $idcategoria";

            return ejecutarConsulta($sql);
        }
    }