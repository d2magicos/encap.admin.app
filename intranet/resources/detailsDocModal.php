<!-- Teachers: Details Modal -->
<div class="modal fade" id="teachersModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalles de curso</h5>
        <button type="button" class="btn-close white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body">
        <div class="student-details">
          <table class="table table-striped table-responsive modal-table" id="table-details">
            <tr>
              <th class="title">Código de matrícula :</th>
              <th class="description" id="codigo"></th>
            </tr>
            <tr>
              <th class="title">Nombre del curso :</th>
              <th class="description" id="curso"></th>
            </tr>
            <tr>
              <th class="title">Fecha :</th>
              <th class="description" id="fecha"></th>
            </tr>
            <tr>
              <th class="title">Certificado :</th>
              <th class="description" id="certificado">
                <!-- <a target="_blank" class="btn-certificado-success" id="btnCertificado"><i class="fa-solid fa-circle-check pdf-icon"></i>Certificado Listo</a>
                <a target="_blank" class="btn-certificadonull" id="btnCertificadoNull"><i class="fa-solid fa-spinner loading-icon"></i>Certificado en Proceso</a> -->
              </th>
            </tr>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <input id="pages-toggle" type="checkbox" /> -->
        <!-- <button type="button" class="btn-certificado py-2 btn-download" id="btnQuest"><i class="fa-solid fa-file-pdf pdf-icon"></i>Ver certificado</button> -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>