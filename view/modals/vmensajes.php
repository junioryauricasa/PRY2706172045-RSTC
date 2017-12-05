<!-- INICIO - Modal General -->
<div id="MensajeNormal" class="modal fade">
 <div class="modal-dialog modal-sm">
   <div class="modal-content">
    <div id="MensajeNormalHeader" class="modal-header" style="background-color: rgb(4, 165, 246)">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 id="MensajeNormalTitulo" class="modal-title"></h4>
    </div>
    <div id="MensajeNormalBody" class="modal-body">
    </div>
    <div id="MensajeNormalFooter" class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
    </div>
   </div>
 </div>
</div>
<!-- FIN - Modal General -->

<!-- INICIO - Modal Confirmar Anulación -->
<div id="MensajeAnularConfirmar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Confirmar Anulación</h4>
      </div>
      <div class="modal-body">
        ¿ Estás Seguro de Anular el Comprobante ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary modal-btn-si" id="">Sí</button>
        <button type="button" class="btn btn-danger modal-btn-no" id="">No</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN - Modal Confirmar Anulación -->

<!-- INICIO - Modal Confirmar Visualización de Códigos -->
<div id="MensajeVisualizarCodigos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Confirmar Impresión</h4>
      </div>
      <div class="modal-body">
        ¿ Quiere imprimir con Códigos ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="MVC-btn-si">Sí</button>
        <button type="button" class="btn btn-danger" id="MVC-btn-no">No</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN - Modal Confirmar Visualización de Códigos -->