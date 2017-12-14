<?php require_once '../../negocio/inventario/nproducto.php'; ?>
<?php require_once '../../negocio/inventario/ncodigoproducto.php'; ?>
<?php require_once '../../negocio/inventario/nubigeoproducto.php'; ?>
<div id="formProducto" class="modal fade">
 <div class="modal-dialog modal-lg" style="width: 95%">
   <div class="modal-content">
    <div style="background-color: #78909c;"  class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 style="color: #FFFFFF;" class="modal-title">Formulario Producto</h4>
    </div>
    <div class="modal-body">
        <section class="content">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#formRegistroProducto" data-toggle="tab" aria-expanded="true">Datos del Producto</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="formRegistroProducto">
                <?php $funcionComprobante = 1; ?>
                <?php include '../inventario/formularios/registroProducto.php'; ?>
                <script type="text/javascript">limpiarformProducto();</script>
              </div>
            </div>
          </div>
        </section>
    </div>
    <div style="background-color: #cfd8dc;"  class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
   </div>
 </div>
</div>