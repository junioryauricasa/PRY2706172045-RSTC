<div id="formComprobanteVenta" class="modal fade">
 <div class="modal-dialog modal-lg">
   <div class="modal-content">
    <div style="background-color: #78909c;"  class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 style="color: #FFFFFF;" class="modal-title">Formulario Venta</h4>
    </div>
    <div class="modal-body">
        <section class="content">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#formBuscarVenta" data-toggle="tab" aria-expanded="true">Buscar Venta</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="formBuscarVenta">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label class="text-left">Ingresar Búsqueda:</label>
                                <input type="text" id="BusquedaVenta" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="text-left">Fecha Inicial:</label>
                              <input type="text" id="dtmFechaInicialV" class="form-control select2" placeholder="dd/mm/aaaa" value="">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="text-left">Fecha Final:</label>
                              <input type="text" id="dtmFechaFinalV" class="form-control select2" placeholder="dd/mm/aaaa" value="">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="text-left">Opción:</label>
                              <input type="button" id="btnBuscarV" class="form-control select2 btn btn-md btn-primary btn-flat" value="Realizar Búsqueda">
                            </div>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="ExcelTable2007 rwd-table" width="100%">
                            <thead>
                              <tr>
                                <!--th class="heading" width="25px">&nbsp;</th-->
                                <th class="" width="25px" style="background: #a9c4e9">
                                  <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                                </th>
                                <th>Serie</th>
                                <th>Numeración</th>
                                <th>Cliente</th>
                                <th>Usuario que Generó</th>
                                <th>Fecha de Creación</th>
                                <th>Tipo Venta</th>
                                <th>Opción</th>
                              </tr>
                            </thead>
                            <tbody id="ListaDeVentas">
                              <script type="text/javascript">ListarVentas(0,5);</script>
                            </tbody>
                          </table>
                        </div>
                        <hr>
                        <div class="text-center">
                          <nav aria-label="...">
                            <ul id="PaginacionDeVentas" class="pagination">
                              <script>PaginarVentas(0,5);</script>
                            </ul>
                          </nav>
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