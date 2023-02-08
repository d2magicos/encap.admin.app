const btnCertificado = document.getElementById('btnCertificado');
const btnCertificadoNull = document.getElementById('btnCertificadoNull');
const btnAula = document.getElementById('btnAula');
const btnMateriales = document.getElementById('btnMateriales');

$(document).on("click", "#btnEncuesta", function(e) {
    var codigoCurso = $(this).attr('codigo');
    document.getElementById("cod_matricula").value = codigoCurso;
})

$(document).on("click", "#btnDetails", function(e) {
    var codigoCurso = $(this).attr('codigo');

    $.get("../controladores/curso.php?op=detailsCursoDoc", { codigoCurso }, function(data) {
        /* console.log(codigoCurso) */
        let arrData = JSON.parse(data);
        //  console.log(arrData.aaData[0])

        /* console.log($arrData.aaData[0]); */

        document.getElementById("codigo").innerHTML = arrData.aaData[0][0];
        document.getElementById("curso").innerHTML = arrData.aaData[0][1];
        document.getElementById("fecha").innerHTML = arrData.aaData[0][2];
        document.getElementById("certificado").innerHTML = arrData.aaData[0][3];
    })
})
