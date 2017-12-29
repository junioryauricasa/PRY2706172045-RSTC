<?php require_once '../../negocio/ventas/ncliente.php'; ?>
<?php require_once '../../negocio/operaciones/ndatosgenerales.php';?>
<div id="formCliente" class="modal fade" style="">
 <div class="modal-dialog modal-lg" style="width: 95%">
   <div class="modal-content">
    <div style="background-color: #78909c;"  class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 style="color: #FFFFFF;" class="modal-title">Formulario Cliente</h4>
    </div>
    <div class="modal-body">
        <section class="content">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a href="#formBuscarCliente" data-toggle="tab" aria-expanded="true" id="tablistadoclientebutton">
                          Buscar Cliente
                    </a>
                  </li>
                  <li class="">
                      <a href="#formRegistroCliente" data-toggle="tab" id="tabformularioclientebutton" aria-expanded="false"> 
                          Registro Cliente
                      </a>
                  </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="formBuscarCliente">
                        <div class="row">
                          <?php include '../campos/cmbListaPersona.php'; ?>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Ingresar Búsqueda:</label>
                              <input type="text" id="BusquedaCliente" name="BusquedaCliente" class="form-control select2" placeholder="Ingresar Búsqueda">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Nuevo Cliente:</label>
                              <br>
                              <!--a href="../ventas/vcliente" class="btn btn-sm btn-primary btn-flat" target="_blank">+ Agregar</a-->
                              <button type="button" id="btn-form-crear-cliente" class="btn btn-sm btn-info btn-flat pull-left" onclick="verformulariocliente()">Agregar Cliente</button>
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
                            <th>RUC / DNI</th>
                            <th>Razón Social / Nombres</th>
                            <th>Tipo Cliente</th>
                            <th>Opciones</th>
                          </tr>
                          </thead>
                          <tbody id="ListaDeClientesSeleccion">
                            <script type="text/javascript">ListarClientesSeleccion(0,5,1);</script>
                          </tbody>
                        </table>
                        <script>AccionCabecerasTabla("1");</script>
                        </div>
                        <hr>
                        <div class="text-center">
                          <nav aria-label="...">
                            <ul id="PaginacionDeClientes" class="pagination">
                            <script>PaginarClientesSeleccion(0,5,1);</script>
                            </ul>
                          </nav>
                        </div>
                    </div>
                    <div class="tab-pane" id="formRegistroCliente">
                        <!-- INICIO - formulario vcliente -->
                        <div class="tab-pane" id="formularioclientes">
                            <div id="formulario-crud"></div>
                            <div id="resultadocrud"></div>
                            <script type="text/javascript">SNuevoCliente = "I";</script>
                        </div>
                        <!-- END - formulario vcliente -->
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


<script>
  function verformulariocliente(){
    $('#tabformularioclientebutton').click();
  }
</script>