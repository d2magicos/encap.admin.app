<?php require "../configuraciones/Conexion.php";?>

<!-- Students: Details Modal -->
<div class="modal fade" id="encuestaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body">

        <div class="survey-container" id="survey-container">
          <div class="satisfaction-survey" id="satisfaction-survey">
            <div class="info-encuesta-container">
              <h5 class="mb-2" style="color: red; font-weight: 600;">Importante 📣</h5>
              <p class="" style="font-weight: 500;">Es necesario que respondas esta breve encuesta para descargar tu
                certificado, ayúdanos a seguir mejorando.</p>
            </div>
            <h5 class="text-center pt-4 pb-2 px-2" style="font-size: 18px; font-weight: 600;">¿En qué otros cursos te gustaría<br> capacitarte?</h5>
            <!-- <h6 class="pt-1 pb-1 text-center" style="font-weight: 400; font-size: 14px;">¿Qué puntuación nos daría?</h6> -->
            <!-- <div class="d-block text-center pt-3 pb-2">
              <div class="clasificacion">
                <input id="radio1" type="radio" name="estrellas" value="5">
                <label for="radio1"><i class="fas fa-star"></i></label>
                <input id="radio2" type="radio" name="estrellas" value="4">
                <label for="radio2"><i class="fas fa-star"></i></label>
                <input id="radio3" type="radio" name="estrellas" value="3">
                <label for="radio3"><i class="fas fa-star"></i></label>
                <input id="radio4" type="radio" name="estrellas" value="2">
                <label for="radio4"><i class="fas fa-star"></i></label>
                <input id="radio5" type="radio" name="estrellas" value="1">
                <label for="radio5"><i class="fas fa-star"></i></label>
              </div>
            </div> -->
            <!-- <div class="d-block text-center pt-3">
              <span class="fw-bold" id="txtRespuesta" style="color: #4C4C4C;"></span>
            </div> -->
            <form action="post" id="surveyForm">
              <input type="hidden" name="cod_matricula" id="cod_matricula" value="">
              <!-- <input type="hidden" name="qualification" id="qualification" value=""> -->
              <!-- <h6 class="py-2">Déjanos un comentario ♡</h6> -->
              <div class="pt-2">
                <textarea name="comment" id="comment" class="w-100 mt-3 mb-2" rows="4"
                  placeholder="Ingrese los cursos sugeridos.."></textarea>
              </div>
              <button type="button" class="btn btn-primary mt-2" onclick="saveSurvey();">Responder</button>
            </form>
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer encuesta-footer">
        <div class="text-center w-100">
          <button type="button" class="btn-close close-custom" data-bs-dismiss="modal" aria-label="Close"></button>
          
        </div>
      </div> -->
    </div>
  </div>
</div>