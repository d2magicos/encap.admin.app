<?php
$html = '';
require "../configuraciones/Conexion.php";
$idasunto = $_POST['idasunto'];

$result = $conexion->query(
    "SELECT sb.idsubasunto as idsubasunto, sb.nombre as nombre
	FROM subasunto sb INNER JOIN asunto a ON a.idasunto=sb.idasunto
	WHERE a.idasunto = '$idasunto'"
);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['idsubasunto'].'">'.$row['nombre'].'</option>';
    }
}
echo $html;

?>