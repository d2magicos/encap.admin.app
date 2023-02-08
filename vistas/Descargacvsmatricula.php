<?php
// Asegurate de que es un archivo realmente válido
// Recuperamos el archivo
$archivo = "../archivos/listamasivapresencial.csv";

// Nos aseguramos que el archivo exista
if (!file_exists($archivo)) {
    echo "El fichero $archivo no existe";
    exit;
}

// Establecemos el nombre del archivo
header('Content-Disposition: attachment;filename="'. 'Excel_'.date('dmYHis').'.csv"');

// Esto  
// header("Content-Type: application/vnd.openxmlformats-   officedocument.spreadsheetml.sheet");
// lo cambiamos por esto
header('Content-Type: text/csv; charset=UTF-8');

// Indicamos el tamaño del archivo 
header('Content-Length: '.filesize($archivo));

// Evitamos que sea cachedo 
header('Cache-Control: max-age=0');

// Realizamos la salida del fichero
readfile($archivo);

// Fin del cuento
exit;
?>
