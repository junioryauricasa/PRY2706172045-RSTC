<div id="formCotizacion" class="modal fade">
 <div class="modal-dialog modal-lg">
   <div class="modal-content">
    <div style="background-color: #78909c;"  class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 style="color: #FFFFFF;" class="modal-title">Formulario Cotizacióm</h4>
    </div>
    <div class="modal-body">
        <section class="content">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#formBuscarCotizacion" data-toggle="tab" aria-expanded="true">Buscar Cotización</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="formBuscarCotizacion">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label class="text-left">Ingresar Búsqueda:</label>
                                <input type="text" id="BusquedaCotizacion" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="text-left">Fecha Inicial:</label>
                              <input type="text" id="dtmFechaInicialCT" class="form-control select2" placeholder="dd/mm/aaaa" value="">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="text-left">Fecha Final:</label>
                              <input type="text" id="dtmFechaFinalCT" class="form-control select2" placeholder="dd/mm/aaaa" value="">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="text-left">Opción:</label>
                              <input type="button" id="btnBuscarCT" class="form-control select2 btn btn-md btn-primary btn-flat" value="Realizar Búsqueda">
                            </div>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="ExcelTable2007 rwd-table" width="100%">
                            <thead>
                              <tr>
                                <th class="heading" width="25px">&nbsp;</th>
                                <th>Numeración</th>
                                <th>Cliente</th>
                                <th>Usuario que Generó</th>
                                <th>Fecha de Creación</th>
                                <th>Opción</th>
                              </tr>
                            </thead>
                            <tbody id="ListaDeCotizaciones">
                              <script type="text/javascript">ListarCotizaciones(0,5);</script>
                            </tbody>
                          </table>
                        </div>
                        <hr>
                        <div class="text-center">
                          <nav aria-label="...">
                            <ul id="PaginacionDeCotizaciones" class="pagination">
                              <script>PaginarCotizaciones(0,5);</script>
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