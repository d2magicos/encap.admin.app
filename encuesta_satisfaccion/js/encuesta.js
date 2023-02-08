
$('body').on('click', '.botones__boton button', function() {
    
    /**cAPTURANDO VALORES DE BOTONES */
    let calificacion = $(this).attr('cal');
    let calificacionFinal = String(calificacion);
   

    /**Condicionando al contenido que será agegado al imput */
    $('.botones__boton button').css('color',"white");
    $('.botones__boton button').css("background-color","black");
  
    $('.botones__boton button').css('scale',"1");
   // $(this).css({'scale':"1.2", "color":"white","background-color":"#192440"});
    $(this).css({'scale':"1.2", "color":"black","background-color":"white"});
    if (calificacion==1){
        document.getElementById("campo").value =calificacionFinal+"-Muy  insatisfecho";
    }else if(calificacion==2){
        document.getElementById("campo").value =calificacionFinal+"-Insatisfecho";
    }else if(calificacion==3){
        document.getElementById("campo").value =calificacionFinal+"-Regular";
    }else if(calificacion==4){
        document.getElementById("campo").value =calificacionFinal+"-satisfecho";
    }else if(calificacion==5){
        document.getElementById("campo").value =calificacionFinal+"-Muy satisfecho";
    }
})

function Blank(){
    var inputcomentario=document.getElementById("comentario");
    if(inputcomentario.value.length <=0){
      

        inputcomentario.style.border="3px solid #e90e16";
    }else{
        inputcomentario.style.border="0px solid #e90e16";
    }
   
}


//Función para guardar o editar
function guardaryeditar()
{
	var formData = new FormData($("#formulario")[0]);

    var inputcalificacion=document.getElementById("campo");

    var inputcomentario=document.getElementById("comentario");


    if(inputcalificacion.value.length <=0){
        console.log("nada");
        swal({
            title: 'Importante',
            type: 'error',
              text:'Debe escoger un número del 1 al 5.'
          });
    }else{

        if(inputcomentario.value.length <=0){
            swal({
                title: 'Importante',
                type: 'error',
                  text:'Por favor ingrese un comentario.'
              });

              inputcomentario.style.border="3px solid #e90e16";
        }else{
           
           $.ajax({
                url: "../controladores/encuesta.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
        
                success: function(datos)
                {                    
                     
                        console.log("Se registró, " + datos);
                         redirect();
                }
            });
        }

    
    }

	

}
function redirect(){

    var cod= document.getElementById("codMatricula").value;

  

    window.location.href="https://sistemas.encap.edu.pe/encuesta_satisfaccion/encuesta_enviada.php?id="+cod;
}

