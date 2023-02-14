<?php 
require_once "../modelos/Searchcourse.php";

$search=new SearchCourse();
$nombre= $_POST["query"];
 
 if(isset($_POST["query"]))  
 {  
      
        $rspta= $search->buscar($nombre);
     
      $output = '<ul class="list-unstyled" style="background-color:#eee;cursor:pointer;z-index:50">'; 
   
      if(mysqli_num_rows( $rspta) > 0)  
      {  
        while($reg=$rspta->fetch_object())  
        {  
             
          
            $output .= '<li id="lista" name="'.$reg->id.'|'.$reg->nombre.'">'.$reg->nombrec.' | '.$reg->nombre.'</li>';  
        }   
      }  
      else  
      {  
           $output .= '<li>No se encontro el Curso</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 ?>  