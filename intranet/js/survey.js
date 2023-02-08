$('body').on('click', '.clasificacion input', function() {
    
    //  let calificacion = $('input:radio[name=estrellas]:checked').val();
    //  let calificacionFinal = String(calificacion);
    let respuesta = document.getElementById('txtRespuesta');
    
    respuesta.value = '';

    /*if (calificacion == '1') {
        document.getElementById('qualification').value = calificacionFinal + " - Muy insatisfecho";
        respuesta.innerHTML = "Muy insatisfecho";
    } else if (calificacion == '2') {
        document.getElementById('qualification').value = calificacionFinal + " - Insatisfecho";
        respuesta.innerHTML = "Insatisfecho";
    } else if (calificacion == '3') {
        document.getElementById('qualification').value = calificacionFinal + " - Regular";
        respuesta.innerHTML = "Regular";
    } else if (calificacion == '4') {
        document.getElementById('qualification').value = calificacionFinal + " - Satisfecho";
        respuesta.innerHTML = "Satisfecho";
    } else if (calificacion == '5') {
        document.getElementById('qualification').value = calificacionFinal + " - Muy satisfecho";
        respuesta.innerHTML = "Muy satisfecho";
    } */
})

saveSurvey = () => {
    let formData = new FormData($('#surveyForm')[0]);
    let calificacion = document.getElementById('qualification');
    let comentario = document.getElementById('comment');

    /*if (calificacion.value.length <= 0) {
        swal("Advertencia", "Por favor elija un ícono para mostrar su calificación.", "warning");
    } else {*/
        if (comentario.value.length <= 0) {
            swal("Advertencia", "Por favor ingrese su comentario.", "warning");
        } else {
            swal({
                title: "Muchas gracias",
                text: "Ya puedes ver tu certificado.",
                icon: "success",
                button: "Cerrar"
            });
            /* swal("Muchas gracias", "Ya puedes ver tu certificado.", "success"); */
            //  console.log(formData);
            $.ajax({
                url: "../controladores/survey.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
        
                success: function(datos) {                    
                    console.log("Se registró: " + datos);
                    limpiar();
                    hideModal();
                    tabla.ajax.reload();
                }
            });
        }
    //}
}

limpiar = () => {
    document.getElementById('cod_matricula').value = '';
    //  document.getElementById('qualification').value = '';
    document.getElementById('comment').value = '';
}

hideModal = () => {
    const truck_modal = document.querySelector('#encuestaModal');
    const modal = bootstrap.Modal.getInstance(truck_modal);    
    modal.hide();
}