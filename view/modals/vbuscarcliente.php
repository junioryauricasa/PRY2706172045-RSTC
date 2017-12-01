<div id="formCliente" class="modal fade">
 <div class="modal-dialog modal-lg">
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
                      <a href="#formBuscarCliente" data-toggle="tab" aria-expanded="true" id="btnbuscarcliente">
                          Buscar Cliente
                      </a>
                  </li>
                  <li class="">
                      <a href="#formRegistroCliente" data-toggle="tab" aria-expanded="false">
                          Registro Cliente
                      </a>
                  </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="formBuscarCliente">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Ingresar Búsqueda:</label>
                              <input type="text" id="BusquedaCliente" name="BusquedaCliente" class="form-control select2" placeholder="Ingresar Búsqueda">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Tipo Persona:</label>
                              <br>
                              <select id="lista-persona" name="lista-persona"  class="form-control select2">
                                <?php 
                                  require_once '../../datos/conexion/bd_conexion.php';
                                  try{
                                  $sql_conexion = new Conexion_BD();
                                  $sql_conectar = $sql_conexion->Conectar();
                                  $sql_comando = $sql_conectar->prepare('CALL mostrartipopersona()');
                                  $sql_comando->execute();
                                  while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                                  {
                                    echo '<option value="'.$fila['intIdTipoPersona'].'">'.$fila['nvchNombre'].'</option>';
                                  }
                                }catch(PDPExceptions $e){
                                  echo $e->getMessage();
                                }?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Nuevo Cliente:</label>
                              <br>
                              <a href="../ventas/vcliente" class="btn btn-sm btn-primary btn-flat" target="_blank">+ Agregar</a>
                            </div>
                          </div>
                        </div>
                        <div class="table-responsive">
                        <table class="ExcelTable2007 rwd-table" width="100%">
                          <thead>
                          <tr>
                            <th class="heading" width="25px">&nbsp;</th>
                            <th class="ListaDNI">DNI</th>
                            <th class="ListaRUC">RUC</th>
                            <th class="ListaRazonSocial">Razón Social</th>
                            <th class="ListaApellidoPaterno">Apellido Paterno</th>
                            <th class="ListaApellidoMaterno">Apellido Materno</th>
                            <th class="ListaNombres">Nombres</th>
                            <th>Tipo de Cliente</th>
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