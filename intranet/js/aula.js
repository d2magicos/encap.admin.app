contclicks = document.getElementById("progreso").getAttribute("lecm");

document.getElementById("minombre").innerHTML = "";
document.getElementById("idpersona").value = localStorage.getItem("miusuario");


function Cargarleccion(id, nombre, codigohmtl, linkvideo, linkmaterial, linkexamen) {




    document.getElementById("idleccionb").value = id;
    console.log(document.getElementById("idleccionb").value);
    let cuerpo = "";
    let cuerpo2 = " <p>Aqui encontraras archivos, enlaces y descargas del curso que haya dejado el profesor.</p><br>";
    cuerpo = "<div>" + codigohmtl + "</div>";

    if (linkvideo.length > 0) {
        $("#mat").css("display", "block");
        cuerpo2 += '<a style="width:100%" href="#" onclick="window.open(\'' + linkvideo + '\',\'_blank\')"><i class="fa-solid fa-video"></i>&nbsp;  Descargar Video</a><p>&nbsp;</p>';
        $("#mat").css("display:block");

    }
    if (linkmaterial.length > 0) {
        $("#mat").css("display", "block");

        cuerpo2 += '<a style="width:100%" href="#" onclick="window.open(\'' + linkmaterial + '\',\'_blank\')"><i class="fa-solid fa-folder"></i>&nbsp;  Descargar Material</a><p>&nbsp;</p>';
    }

    if (linkvideo.length <= 0 && linkmaterial.length <= 0) {
        $("#mat").css("display", "none");
    }
    if (linkexamen.length > 0) {
        console.log("entra");
        cuerpo2 += '<a style="width:100%" href="#" onclick="window.open(\'' + linkexamen + '\',\'_blank\')"><i class="fa-solid fa-file"></i>&nbsp;  Examen</a><p>&nbsp;</p>';
    }


    document.getElementById("details").innerHTML = cuerpo;
    document.getElementById("recursos").innerHTML = cuerpo2;
    document.getElementById("leccionname").innerHTML = nombre;
    document.getElementById("idlecciones").value = id;
    document.getElementById("idmatricula").value = localStorage.getItem("miusuario");

    console.log(document.getElementById(id).style.color);
    if (document.getElementById(id).style.color != "gray") {
        contclicks++;

        let porcentaje = parseFloat(contclicks / document.getElementById("progreso").getAttribute("lecc") * 100).toFixed(2);
        if (porcentaje > 100) {
            porcentaje = 100;
        }
        document.getElementById("progress").innerHTML = '<progress  id="progreso" max="100" value="' + porcentaje + '"></progress>&nbsp;&nbsp;&nbsp;<label>' + porcentaje + '% completado</label>';
        ActualizarProgreso();
    }
    document.getElementById(id).style.color = "gray";
    ListarComentarios();
}


function CargarVistas() {


    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controladores/curso.php?op=sumarvista",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            console.log(datos);

        }

    });

}


function ActualizarProgreso() {


    var formData = new FormData($("#formulario2")[0]);

    $.ajax({
        url: "../controladores/progreso.php?op=actualizarprogreso",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            console.log(datos);

        }

    });



}

function EnviarComentario() {


    var formData = new FormData($("#formulario3")[0]);
    let textcomentario = document.getElementById("comentario");

    $.ajax({
        url: "../controladores/progreso.php?op=comentar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {

            document.getElementById("deadpool").innerHTML = datos;
            textcomentario.value = "";
        }

    });



}

function MostrarR(id) {
    document.getElementById(id).style = "margin-left:15px;display:block";
    console.log(document.getElementById(id))
}

function ResponderComentario() {


    var formData = new FormData($("#formulario4")[0]);

    $.ajax({
        url: "../controladores/progreso.php?op=comentar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {

            document.getElementById("deadpool").innerHTML = datos;
        }

    });



}

function ListarComentarios() {


    var formData = new FormData($("#formulario3")[0]);

    $.ajax({
        url: "../controladores/progreso.php?op=listarcomentarios",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {

            document.getElementById("deadpool").innerHTML = datos;
        }

    });



}


function convert() {

    var text = document.getElementById("url").innerHTML;
    if (text.length <= 0) {
        return false;
    }
    var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
    var text1 = text.replace(exp, "<a style='color:lightblue' target='_blank' href='$1'>$1</a>");
    text1 = text1.replace(/\n/g, '<br/>');
    var exp2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
    document.getElementById("converted_url").innerHTML = text1.replace(exp2, '$1<a style="color:lightblue" target="_blank" href="http://$2">$2</a>');
}

CargarVistas();
ListarComentarios();
convert();