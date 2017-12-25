
<div id="formUbigeoProducto" class="modal fade">
 <div class="modal-dialog modal-lg">
   <div class="modal-content">
    <div style="background-color: #78909c;"  class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 style="color: #FFFFFF;" class="modal-title">Formulario Ubigeo del Producto</h4>
    </div>
    <div class="modal-body">
        <section class="content">
          <div class="nav-tabs-custom">
              <div class="tab-pane active" id="formRegistroUbigeo">
                <div id="nvchUbicacionMCol" class="col-md-3">
                  <div id="nvchUbicacionMGroup" class="form-group">
                    <label>Ubicación del Almacén:</label>
                    <input type="text" id="nvchUbicacionM" class="form-control select2"
                    placeholder="Ingrese la Ubicación" value="" maxlength="150">
                    <span id="nvchUbicacionMIcono" class="" aria-hidden=""></span>
                    <div id="nvchUbicacionMObs" class=""></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Cantidad:</label>
                    <input type="text" id="intCantidadUbigeoM" class="form-control select2"
                    value="" maxlength="150" readonly>
                  </div>
                </div>
                <input type="hidden" id="intIdUbigeoProductoM"/>
                <input type="hidden" id="intIdProductoM"/>
                <input type="hidden" id="intIdSucursalM"/>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Opción:</label>
                    <input type="button" onclick="ModificarUbigeoProducto()" 
                    class="btn btn-sm btn-primary btn-flat form-control select2" value="Modificar Ubicación">
                  </div>
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