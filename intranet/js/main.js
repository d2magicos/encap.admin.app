const modal=document.getElementById("ventanaModal");
const btnCertificado=document.getElementById("campoSeis");
const campoSeisMod=document.getElementById("campoSeisMod");
const campoSiete=document.getElementById("campoSiete");
const campoSieteMod=document.getElementById("campoSieteMod");
const campoOcho=document.getElementById("campoOcho");
const campoOchoMod=document.getElementById("campoOchoMod");
/**Codigo para llamar al modal */

function llamarModal(){
    modal.style.opacity="1";
    modal.style.display="block";
}

  
function cerrarModal(){
    modal.style.opacity="0";
    modal.style.display="none";
}

/**Obteniendo datos */



    $('body').on('click', '#tabla tr', function() {
        var codigoCurso = $(this).attr('codigo');
        var nombre = $(this).attr('nombre');
        var tipo = $(this).attr('tipo');
        var numero = $(this).attr('numero');
        var fecha = $(this).attr('fecha');
        var url = $(this).attr('url');
        var certificado = $(this).attr('certificado');
        var certificadoUrl="";

        var certificado = $(this).attr('certificado');
        console.log(tipo+certificado);

        var materiales = $(this).attr('materiales');
        var aulaVirtual = $(this).attr('aula');
        console.log(materiales);
        
        /**Condicionales para las URLS de los certificados */

        if(tipo=="CURSO CORTO" && certificado=="SI" ){
            btnCertificado.style.opacity="1";
            btnCertificado.style.display="inline-block";
            campoSeisMod.style.display="none";
            certificadoUrl= "../cert_digitales/curso_corto.php?id="+codigoCurso;
        
        }else if((tipo=="DIPLOMA" || tipo=="MOVIMIENTO SIERRA Y SELVA CONTIGO JUNÍN") && certificado=="SI"){
            btnCertificado.style.opacity="1";
            btnCertificado.style.display="inline-block";
            certificadoUrl="../cert_digitales/diploma.php?id="+codigoCurso;
            campoSeisMod.style.display="none";
        }else if(tipo=="DIPLOMA DE ESPECIALIZACIÓN" && certificado=="SI"){
            btnCertificado.style.display="inline-block";
            btnCertificado.style.opacity="1";
            certificadoUrl="../cert_digitales/diploma_especializacion.php?id="+codigoCurso;
            campoSeisMod.style.display="none"
        }else if(tipo=="CONVENIO CIP HUANCAVELICA" && certificado=="SI"){
            btnCertificado.style.display="inline-block";
            btnCertificado.style.opacity="1";
            certificadoUrl="../cert_digitales/diplomacip.php?id="+codigoCurso;
            campoSeisMod.style.display="none";
        }else if(tipo=="DOCENTES" && certificado=="SI"){
            btnCertificado.style.display="inline-block";
            btnCertificado.style.opacity="1";
            certificadoUrl="../cert_digitales/"+url+"?id="+codigoCurso;
            campoSeisMod.style.display="none";
        }else{
            btnCertificado.style.opacity="0";
            btnCertificado.style.display="none";
            campoSeisMod.style.display="inline-block";
        }
        /**Condicionales para la sección de materiales */

        if(tipo=="CURSO CORTO" && materiales==""){
            campoSiete.style.display="none"
            campoSieteMod.style.display="inline-block"
        }else if(tipo=="CURSO CORTO"){
            campoSiete.style.display="inline-block"
            campoSieteMod.style.display="none"

        }else{
            campoSiete.style.display="none"
            campoSieteMod.style.display="inline-block"
        }

        /**Condicionales para el aula virtual */
        if(aulaVirtual==""){
            campoOcho.style.display="none";
            campoOchoMod.style.display="inline-block"
        }else if(tipo=="CURSO CORTO"){
            campoOcho.style.display="none";
            campoOchoMod.style.display="inline-block"
        }else{
            campoOcho.style.display="inline-block"
            campoOchoMod.style.display="none"
        }

        

        /**AGREGANDO DATOS A LOS CAMPOS */

        document.getElementById("campoOne").innerHTML = codigoCurso;
        document.getElementById("campoDos").innerHTML = nombre;
        document.getElementById("campoTres").innerHTML = tipo;
        document.getElementById("campoCuatro").innerHTML = numero;
        document.getElementById("campoCinco").innerHTML = fecha;
        document.getElementById("campoSeis").href = certificadoUrl;
        document.getElementById("campoSiete").href = materiales;
        document.getElementById("campoOcho").href = aulaVirtual;
      
    });    




