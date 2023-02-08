<?php

include('Conexion.php');

$fileContacts = $_FILES['fileContacts']; 
$fileContacts = file_get_contents($fileContacts['tmp_name']); 

$fileContacts = explode("\n", $fileContacts);
$fileContacts = array_filter($fileContacts); 

// preparar contactos (convertirlos en array)
foreach ($fileContacts as $contact) 
{
	$contactList[] = explode(";", $contact);
}

// insertar contactos
 foreach ($contactList as $contactData) 
 {
	$conexion->query("INSERT INTO presenciales
 						(fecha,
						 codigo,
						 asesor,
						 nombres,
						 dni,
						 celular,
						 correo,
						 cumpleaños,
						 ciudad,
						 departamento,
						 n_operacion,
 						 curso,
 						 fecha_certificado,
 						 horas,
						 codigo_curso,
						 monto,
 						 forma_pago,
 						 observacion,
 						 condicion)
 						 VALUES

 						 ('{$contactData[0]}',
 						  '{$contactData[1]}', 
 						  '{$contactData[2]}',
						  '{$contactData[3]}', 
 						  '{$contactData[4]}',
						  '{$contactData[5]}', 
 						  '{$contactData[6]}',
						  '{$contactData[7]}', 
 						  '{$contactData[8]}',
						  '{$contactData[9]}', 
 						  '{$contactData[10]}',
						  '{$contactData[11]}',
 						  '{$contactData[12]}',
 						  '{$contactData[13]}',
						  '{$contactData[14]}', 
 						  '{$contactData[15]}',
						  '{$contactData[16]}', 
 						  '{$contactData[17]}',
						  '{$contactData[18]}'					   
 						   )
 						 "); 
 }

?>