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
	$conexion->query("INSERT INTO consultaciudades
  						(ciudad,
						 provincia,
						 departamento,
 						 idcourier,
 						 montoa,
 						 adicional,
						 direccion,
 						 condicion)
 						 VALUES
 						 ('{$contactData[0]}',
 						  '{$contactData[1]}', 
 						  '{$contactData[2]}',
						  '{$contactData[3]}',
						  '{$contactData[4]}',
 						  '{$contactData[5]}',
						  '{$contactData[6]}',
						  '{$contactData[7]}'
 						   )
 						 "); 
 }
?>