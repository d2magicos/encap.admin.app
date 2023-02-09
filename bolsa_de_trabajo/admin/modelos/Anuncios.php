<?php
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";
require "../modelos/libs/upload.php";

class Anuncio
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		$this->upload = new Upload();
	}

	//Implementamos un método para insertar registros
	public function insertar($img_anuncio, $before_img, $link_anuncio, $device_desktop, $device_tablet, $device_movil)
	{
		// Foto
		if ($_FILES["img_anuncio"]["error"] == 0) {
			$reply = $this->upload->upload_basic($_FILES["img_anuncio"], "../public/images/anuncios/", $_FILES["img_anuncio"]["name"]);
			if ($reply["success"]) {
				$imagen = $reply["message"];
				$sql = "INSERT INTO anuncios (imagen, link, device_desktop, device_tablet, device_movil)
				VALUES ('$imagen','$link_anuncio','$device_desktop','$device_tablet', '$device_movil')";
				if (ejecutarConsulta($sql)) {
					return array("success" => true, "message" => "El anuncio se registro con éxito");
				} else {
					return array("success" => false, "message" => "El anuncio no se pudo registrar");
				}
			} else {
				return array("success" => false, "message" => "El formato es incorrecto");
				exit;
			}
		} else {
			return array("success" => false, "message" => "Debe adjuntar una imagen");
		}
	}

	//Implementamos un método para editar registros
	public function editar($id_anuncio, $img_anuncio, $before_img, $link_anuncio, $device_desktop, $device_tablet, $device_movil)
	{
		// Foto
		if ($_FILES["img_anuncio"]["error"] == 0) {
			$reply = $this->upload->upload_basic($_FILES["img_anuncio"], "../public/images/anuncios/", $_FILES["img_anuncio"]["name"]);
			if ($reply["success"]) {
				$imagen = $reply["message"];
			} else {
				return array("success" => false, "message" => "El formato es incorrecto");
				exit;
			}
		} else {
			if ($before_img) {
				$imagen = $before_img;
			} else {
				return array("success" => false, "message" => "Debe adjuntar una imagen");
			}
		}

		$sql = "UPDATE anuncios SET imagen='$imagen',link='$link_anuncio',device_desktop='$device_desktop', device_tablet='$device_tablet', device_movil='$device_movil' WHERE id_anuncio='$id_anuncio'";
		if (ejecutarConsulta($sql)) {
			return array("success" => true, "message" => "El anuncio se actualizo con éxito");
		} else {
			return array("success" => false, "message" => "El anuncio no se pudo actualizar");
		}
	}

	//Implementamos un método para eliminar registros
	public function eliminar($id_anuncio)
	{
		$sql = "DELETE FROM anuncios WHERE id_anuncio='$id_anuncio'";
		if (ejecutarConsulta($sql)) {
			return array("success" => true, "message" => "El anuncio se elimino con éxito");
		} else {
			return array("success" => false, "message" => "El anuncio no se pudo eliminar");
		}
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_anuncio)
	{
		$sql = "SELECT * FROM anuncios WHERE id_anuncio='$id_anuncio'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT * FROM anuncios";
		return ejecutarConsulta($sql);
	}
}
