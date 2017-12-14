<div id="CuadroImagen" class="modal fade">
 <div class="modal-dialog modal-xl">
   <div class="modal-content">
    <div id="CuadroImagenHeader" class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 id="CuadroImagenTitulo" class="modal-title"></h4>
    </div>
    <div id="CuadroImagenBody" class="modal-body">
        <div class="row row-eq-height">
          <div id="DireccionImgProducto" class="col-sm-12">    
          </div>
        </div>
    </div>
    <div id="CuadroImagenFooter" class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
    </div>
   </div>
 </div>
</div>

<!-- script for modal detalles prod -->
<script type="text/javascript">
  function showmodaldetalles(){
    $('#modal-detalleproductos').modal('show');
  }
</script>
<!-- Modal codigo productos-->
<div id="modal-detalleproductos" class="modal modal-default fade">
  <div class="modal-dialog" style="">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="fa fa-book" style=""></i>
            Detalle de la ubicación del Producto: <b><span id="CodigoProducto"></span></b>
        </h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
                  <div id="TablaDetalleUbigeo">
                      <div class="table-responsive">
                        <table class="rwd-table ExcelTable2007" width="100%">
                          <thead>
                            <tr>
                              <!--th class="heading" width="25px">&nbsp;</th-->
                              <th class="" width="25px" style="background: #a9c4e9">
                                <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                              </th>
                              <th>Sucursal</th>
                              <th>Ubicación en el Almacén</th>
                              <th>Cantidad</th>
                            </tr>
                          </thead>
                          <tbody id="DetalleUbigeo">
                          </tbody>
                        </table>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div><!-- /.box-body -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- END Modal codigo productos-->