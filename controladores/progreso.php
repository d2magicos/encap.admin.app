<?php

require_once "../modelos/Progreso.php";

$progreso=new Progreso();


$idmatricula=isset($_POST["idmatricula"])? limpiarCadena($_POST["idmatricula"]):"";
$idlecciones=isset($_POST["idlecciones"])? limpiarCadena($_POST["idlecciones"]):"";
$idcurso=isset($_POST["idcursoa"])? limpiarCadena($_POST["idcursoa"]):"";
$idpersona=isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
$idcursob=isset($_POST["idcursob"])? limpiarCadena($_POST["idcursob"]):"";
$idleccionb=isset($_POST["idleccionb"])? limpiarCadena($_POST["idleccionb"]):"";
$idfamilia=isset($_POST["idfamilia"])? limpiarCadena($_POST["idfamilia"]):"-1";
$comentario=isset($_POST["comentario"])? limpiarCadena($_POST["comentario"]):"";
$comentariox=isset($_POST["comentariox"])? limpiarCadena($_POST["comentariox"]):"";
$cont=0;
switch ($_GET["op"]){
	case 'actualizarprogreso':
    
        $rspta=$progreso->actualizarprogreso($idmatricula,$idlecciones,$idcurso);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
    break;
    
    case 'listarcomentarios':
    
        $rspta2= $progreso->listarcomentarios($idcursob,$idleccionb);
      
        while ($reg=$rspta2->fetch_object()){
            if($reg->idfamilia=="-1"){
                $cont++;
                $usuario = explode(" ",str_replace(",","",$reg->nombre));
                echo "<h6><img width='30' height='30' src='../intranet/img/user.png'/>&nbsp;".$usuario[1]." ".$usuario[2]." comento:</h6><time style='font-size: .7rem;margin-left:40px'>".$reg->fecha."</time><p>&nbsp;</p><p style='width:100%;font-size: 0.9rem;line-height: 1rem;margin-left:40px'>".$reg->comentario."</p><div style='width:100;float:right;'><br></div><br><div id='responderpool".$cont."' style='margin-left:15px;display:none'><form id='formulario4'><input id='idfamilia' name='idfamilia' value=".$reg->id."></input><input id='idcursob' name='idcursob' value=".$reg->idcurso."></input><input id='idpersona' name='idpersona' value=".$reg->idpersona."></input><input id='idleccionc' name='idleccionc' value=".$reg->idlecciones."></input></input><textarea id='comentariox' name='comentariox' style='width:100%' placeholder='Dejanos un comentario'></textarea><button class='btnMateriales' onclick='ResponderComentario()' type='button'>Publicar</button></form></div><hr><br>";
                $rspta3= $progreso->listarSubcomentarios($reg->id);
                while ($reg2=$rspta3->fetch_object()){
                    echo "<div style='margin-left:20px'><h6>sUsuario ".$reg2->idpersona."</h6><time style='font-size: .7rem;'>".$reg2->fecha."</time><p>&nbsp;</p><p style='width:100%;font-size: 0.9rem;line-height: 1.5rem;'>".$reg2->comentario."</p><div style='width:100;float:right;'><br><button class='btnMateriales' onclick=\"MostrarR('responderpool".$cont."')\">Responder</button></div><br><div id='responderpool".$cont."' style='margin-left:15px;display:none'><form id='formulario4'><input id='idfamilia' name='idfamilia' value=".$reg2->id."></input><input id='idcursob' name='idcursob' value=".$reg2->idcurso."></input><input id='idpersona' name='idpersona' value=".$reg2->idpersona."></input><input id='idleccionc' name='idleccionc' value=".$reg2->idlecciones."></input></input><textarea id='comentariox' name='comentariox' style='width:100%' placeholder='Dejanos un comentario'></textarea><button class='btnMateriales' onclick='ResponderComentario()' type='button'>Publicar</button></form></div><div style='background:white;width:100%;height:5px;float:left'></div><br><br></div>";
              
                }
            
            }
          
        }
    break;

    case 'comentar':
    
        $rspta=$progreso->comentar($idpersona,$idcursob,$idleccionb,$comentario,$idfamilia);

        $rspta2= $progreso->listarcomentarios($idcursob,$idleccionb);

        while ($reg=$rspta2->fetch_object()){
            if($reg->idfamilia=="-1"){
                $cont++;
                $usuario = explode(",",$reg->nombre);
                echo "<h6><img width='30' height='30' src='../intranet/img/user.png'/>".$usuario[1]." comento:</h6><time style='font-size: .7rem;margin-left:40px'>".$reg->fecha."</time><p>&nbsp;</p><p style='width:100%;font-size: 0.9rem;line-height: 1rem;margin-left:40px'>".$reg->comentario."</p><div style='width:100;float:right;'><br></div><br><div id='responderpool".$cont."' style='margin-left:15px;display:none'><form id='formulario4'><input id='idfamilia' name='idfamilia' value=".$reg->id."></input><input id='idcursob' name='idcursob' value=".$reg->idcurso."></input><input id='idpersona' name='idpersona' value=".$reg->idpersona."></input><input id='idleccionc' name='idleccionc' value=".$reg->idlecciones."></input></input><textarea id='comentariox' name='comentariox' style='width:100%' placeholder='Dejanos un comentario'></textarea><button class='btnMateriales' onclick='ResponderComentario()' type='button'>Publicar</button></form></div><hr><br>";
                $rspta3= $progreso->listarSubcomentarios($reg->id);
                while ($reg2=$rspta3->fetch_object()){
                    echo "<h6>".$reg->nombre."</h6><time style='font-size: .7rem;'>".$reg->fecha."</time><p>&nbsp;</p><p style='width:100%;font-size: 0.9rem;line-height: 1.5rem;'>".$reg->comentario."</p><div style='width:100;float:right;'><br><button class='btnMateriales' onclick=\"MostrarR('responderpool".$cont."')\">Responder</button></div><br><div id='responderpool".$cont."' style='margin-left:15px;display:none'><form id='formulario4'><input id='idfamilia' name='idfamilia' value=".$reg->id."></input><input id='idcursoc' name='idcursoc' value=".$reg->idcurso."></input><input id='idpersona' name='idpersona' value=".$reg->idpersona."></input><input id='idleccionc' name='idleccionc' value=".$reg->idlecciones."></input></input><textarea id='comentariox' name='comentariox' style='width:100%' placeholder='Dejanos un comentario'></textarea><button class='btnMateriales' onclick='ResponderComentario()' type='button'>Publicar</button></form></div><div style='background:white;width:100%;height:5px;float:left'></div><br><br>";
     
                }
            
            }
             }
        //Codificar el resultado utilizando json
      
    break;
    

    case 'responder':
    
        $rspta=$progreso->comentar($idpersona,$idcursob,$idleccionb,$comentariox,$idfamilia);

        $rspta2= $progreso->listarcomentarios($idcursob,$idleccionb);

        while ($reg=$rspta2->fetch_object()){
            $cont++;
            $usuario = explode("",$reg->nombre);
            echo "<h6><img width='30' height='30' src='../intranet/img/user.png'/>".$usuario[1]." comento:</h6><time style='font-size: .7rem;margin-left:40px'>".$reg->fecha."</time><p>&nbsp;</p><p style='width:100%;font-size: 0.9rem;line-height: 1rem;margin-left:40px'>".$reg->comentario."</p><div style='width:100;float:right;'><br></div><br><div id='responderpool".$cont."' style='margin-left:15px;display:none'><form id='formulario4'><input id='idfamilia' name='idfamilia' value=".$reg->id."></input><input id='idcursob' name='idcursob' value=".$reg->idcurso."></input><input id='idpersona' name='idpersona' value=".$reg->idpersona."></input><input id='idleccionc' name='idleccionc' value=".$reg->idlecciones."></input></input><textarea id='comentariox' name='comentariox' style='width:100%' placeholder='Dejanos un comentario'></textarea><button class='btnMateriales' onclick='ResponderComentario()' type='button'>Publicar</button></form></div><hr><br>";
        }
        //Codificar el resultado utilizando json
      
    break;
    }

?>