<?php
session_start();
require_once "../modelos/Validacion.php";
$usuario=new Usuario();

$consultar=isset($_POST["consultar"])? limpiarCadena($_POST["consultar"]):"";

switch ($_GET["op"]){	

	case 'verificar':
		$consultar=$_POST['consultar'];
		  
		$rspta=$usuario->verificar($consultar);
		$fetch=$rspta->fetch_object();
		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['num_documento']=$fetch->num_documento;

	        $_SESSION['nombre_consulta']=$fetch->nombre;
	        $_SESSION['ciudad']=$fetch->ciudad; 
	        $_SESSION['departamento']=$fetch->departamento; 
	        $_SESSION['cod_matricula']=$fetch->cod_matricula; 
	        $_SESSION['qr']=$fetch->qr; 		
			
	    }
		
	    echo json_encode($fetch);
	break;
	
	case 'verificarDocente':
		$consultar=$_POST['consultar'];
		  
		$rspta=$usuario->verificarDocente($consultar);
		$fetch=$rspta->fetch_object();
		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['num_documento']=$fetch->num_documento;

	        $_SESSION['nombre_consulta']=$fetch->nombre;
	        $_SESSION['ciudad']=$fetch->ciudad; 
	        $_SESSION['departamento']=$fetch->departamento; 
	        $_SESSION['cod_matricula']=$fetch->cod_matricula; 
	        $_SESSION['qr']=$fetch->qr; 		
			
	    }
		
	    echo json_encode($fetch);
	break;


	case 'login':
		$user=$_POST['usuario'];
		

		$rspta=$usuario->login($user);
		$fetch=$rspta->fetch_object();
		
	    echo json_encode($fetch);
	break;


	case 'logindocente':
		$user=$_POST['usuario'];
		
		$rspta=$usuario->logindocente($user);
		$fetch=$rspta->fetch_object();
		
	    echo json_encode($fetch);
	break;

	case 'verificarseguimiento':

		$consultar=$_POST['consultar'];
		$rspta=$usuario->verificarseguimiento($consultar);
		$fetch=$rspta->fetch_object();
		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['num_documento']=$fetch->num_documento;
	        $_SESSION['nombre']=$fetch->nombre;			
	    }
	    echo json_encode($fetch);
	break;

	case 'verificarseguimientofisico':

		$consultar = $_POST['consultar'];
		$rspta = $usuario->verificarseguimientofisico($consultar);
		$fetch = $rspta->fetch_object();

		if (isset($fetch)) {
	        //Declaramos las variables de sesión
	        $_SESSION['num_documento'] = $fetch->num_documento;
	        $_SESSION['nombre'] = $fetch->nombre;			
	    }
		
	    echo json_encode($fetch);
	break;

	case 'verificarpresencial':

		$consultar=$_POST['consultar'];
		$rspta=$usuario->verificarpresencial($consultar);
		$fetch=$rspta->fetch_object();
		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['dni']=$fetch->dni;
	        $_SESSION['nombres']=$fetch->nombres;	
	        $_SESSION['departamento']=$fetch->departamento;			
	        $_SESSION['ciudad']=$fetch->ciudad;			

	    }
	    echo json_encode($fetch);
	break;
	
	case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../certificados/index.php");

	break;

	case 'salirenvio':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../tracking/index.php");

	break;

	case 'salirpresencial':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../certificados_presenciales/index.php");

	break;

}
?>
