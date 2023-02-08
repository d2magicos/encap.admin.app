<?php
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

//Obtenemos la fecha actual

class Compra
{
    //Implementamos nuestro constructor
    public function __construct()
    {
    }

    //Implementamos un método para insertar registros
    //Incluyendo los detalles del ingreso
    public function insertar($idpersonal, $fecha_hora, $cod_matricula, $idparticipante, $idcurso1, $fecha_inicio2, $qr, $monto, $formato, $idforma_recaudacion, $idmediospagos, $noperacion, $prioridad, $accesoaula, $observaciones_envio, $estadoventa, $comprobante, $observaciones, $contexto, $nota, $año, $voucher, $compromiso)
    {
        $sql = "INSERT INTO matricula (idpersonal,fecha_hora,cod_matricula,idparticipante,idcurso,fecha_inicio,qr,monto,formato,idforma_recaudacion,idmediospagos,noperacion,prioridad,enviodigital,accesoaula,observaciones_envio,estadoenvio,estadoventa,comprobante,observaciones,condicion,voucher,compromiso)
		VALUES ('$idpersonal','$fecha_hora','$cod_matricula','$idparticipante','$idcurso1','$fecha_inicio2','$qr','$monto','$formato','$idforma_recaudacion','$idmediospagos','$noperacion','$prioridad','ENTREGADO','$accesoaula','$observaciones_envio','POR ENVIAR','$estadoventa','$comprobante','$observaciones','1',$voucher,$compromiso)";
        return ejecutarConsulta($sql);
    }

    public function editar($idmatricula, $idpersonal, $fecha_hora, $cod_matricula, $idparticipante, $idcurso1, $fecha_inicio2, $qr, $monto, $formato, $idforma_recaudacion, $idmediospagos, $noperacion, $prioridad, $accesoaula, $observaciones_envio, $estadoventa, $comprobante, $observaciones, $horas, $contexto, $nota, $año, $voucher, $compromiso, $imagen, $imagenposterior, $idplantilla, $categoria)
    {
        $sql = "UPDATE matricula SET idpersonal ='$idpersonal',fecha_hora='$fecha_hora',cod_matricula ='$cod_matricula',idparticipante='$idparticipante',idcurso='$idcurso1',fecha_inicio='$fecha_inicio2',qr='$qr',monto='$monto',formato='$formato',
		idforma_recaudacion='$idforma_recaudacion',idmediospagos= '$idmediospagos',noperacion= '$noperacion',prioridad= '$prioridad',accesoaula= '$accesoaula',observaciones_envio='$observaciones_envio',estadoenvio= 'POR ENVIAR',estadoventa= '$estadoventa',comprobante='$comprobante',
		observaciones='$observaciones',condicion= '1',horas='$horas',contexto='$contexto',nota='$nota',año='$año',voucher='$voucher',compromiso='$compromiso', imagen='$imagen',imagenposterior='$imagenposterior',idplantilla='$idplantilla',categoria='$categoria' WHERE idmatricula='$idmatricula'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para anular categorías
    public function enviar($idmatricula)
    {
        $sql = "UPDATE matricula SET enviodigital='ENTREGADO' WHERE idmatricula='$idmatricula'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para anular categorías
    public function noenviar($idmatricula)
    {
        $sql = "UPDATE matricula SET enviodigital='PENDIENTE' WHERE idmatricula='$idmatricula'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para habilitar certificados
    public function habilitar($idmatricula)
    {
        $sql = "UPDATE matricula SET certificado='SI' WHERE idmatricula='$idmatricula'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para anular habilitacion de certificados
    public function nohabilitar($idmatricula)
    {
        $sql = "UPDATE matricula SET certificado='NO' WHERE idmatricula='$idmatricula'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para habilitar notificaciones
    public function habilitarNotf($idmatricula)
    {
        $sql = "UPDATE matricula SET notificacion='SI' WHERE cod_matricula='$idmatricula'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para anular habilitacion de notificaciones
    public function nohabilitarNotf($idmatricula)
    {
        $sql = "UPDATE matricula SET notificacion='NO' WHERE cod_matricula='$idmatricula'";
        return ejecutarConsulta($sql);
    }
    //Implementamos un método para anular categorías
    public function anular($idmatricula)
    {
        $sql = "UPDATE matricula SET estado='Anulado' WHERE idmatricula='$idmatricula'";
        return ejecutarConsulta($sql);
    }

    //Eliminar FUNCION DE PENDIENTE*************+
    //************************
    public function eliminarRegistro($idmatricula)
    {
        $sql = "DELETE FROM matricula WHERE idmatricula='$idmatricula'";

        return ejecutarConsulta($sql);
    }

    //Implementar un método para mostrar los datos de un registro
    public function mostrar($idmatricula)
    {
        $sql = "SELECT m.idmatricula,m.fecha_hora as fecha,p.email, per.nombre as nombrepersonal, pa.nombre as pais,p.departamento,p.ciudad,p.direccion,p.fecha_cumple,p.telefono,p.telefono2,m.horas AS horas,
		p.nombre as participante,m.cod_matricula, c.nombre,categoria.nombre as categoria,c.n_horas,td.nombre as tipo_documento,p.num_documento,m.qr, me.nombre AS mediopago, m.compromiso AS compromiso,m.voucher AS voucher,
		fr.nombre as formarecaudacion, m.formato,m.monto,m.prioridad,m.enviodigital,m.accesoaula,m.observaciones_envio,m.condicion,m.idforma_recaudacion,m.observaciones,m.año,c.contexto,m.nota,
		m.idmediospagos,m.idcurso,m.idparticipante,m.idpersonal,m.noperacion,m.comprobante,m.estadoventa,m.idplantilla,m.imagen,m.imagenposterior,m.categoria
			FROM matricula m INNER JOIN persona p ON m.idparticipante=p.idpersona
			INNER JOIN personal per ON per.idpersonal=m.idpersonal
			INNER JOIN cursos c ON m.idcurso=c.idcurso
			INNER JOIN pais pa  ON pa.idpais =p.idpais
			INNER JOIN tipo_documento td  ON td.idtipo_documento =p.idtipo_documento
			INNER JOIN mediospagos me ON me.idmediospagos=m.idmediospagos
			INNER JOIN forma_recaudacion fr ON fr.idforma_recaudacion=m.idforma_recaudacion
			INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
		WHERE m.idmatricula='$idmatricula'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listarDetalle($idmatricula)
    {
        $sql = "SELECT m.idmatricula,m.idcurso,c.cod_curso,c.nombre as curso ,categoria.nombre as categoria, c.n_horas, m.fecha_inicio
		FROM matricula m INNER JOIN cursos c ON m.idcurso= c.idcurso
		INNER JOIN categoria categoria ON categoria.idcategoria=c.idcategoria
		WHERE m.idmatricula='$idmatricula'";
        return ejecutarConsulta($sql);
    }

    //Implementar un método para listar los registros
    public function listar()
    {
        $sql = "SELECT DISTINCT m.idmatricula,m.fecha_hora as fecha,m.hora, p.email, pe.nombre as personal, p.nombre as participante, p.telefono, p.departamento, p.ciudad, tr.nombre as mediotrafico,
					m.cod_matricula, c.nombre,categoria.nombre as categoria, c.n_horas, m.fecha_inicio, td.nombre as tipo_documento, me.nombre as mediosdepagos, p.num_documento, m.certificado, notificacion,
					m.qr, m.formato, m.monto, m.prioridad, m.enviodigital, m.accesoaula, m.observaciones_envio, m.comprobante, m.estadoventa, m.condicion, m.observaciones,m.compromiso, m.voucher, idplantilla,
					scat.nombre as subtipo
				FROM matricula m 
				INNER JOIN persona p ON m.idparticipante = p.idpersona
				INNER JOIN tipo_documento td ON td.idtipo_documento = p.idtipo_documento
				INNER JOIN personal pe ON pe.idpersonal = m.idpersonal
				INNER JOIN cursos c ON m.idcurso = c.idcurso
				INNER JOIN categoria categoria ON c.idcategoria = categoria.idcategoria
				LEFT JOIN subtipocurso scat ON c.idsubtipo = scat.idsubtipo
				INNER JOIN mediospagos me ON me.idmediospagos = m.idmediospagos
				INNER JOIN trafico tr ON tr.idtrafico = m.idtrafico
                GROUP BY m.idmatricula
				ORDER BY m.idmatricula DESC";
        return ejecutarConsulta($sql);
    }

    public function listarCategoria($idcat)
    {

        $sql = "SELECT * FROM certificados
		WHERE idcategoria=$idcat";
        return ejecutarConsulta($sql);
    }
}
