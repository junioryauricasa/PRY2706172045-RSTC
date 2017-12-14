<?php require_once '../../negocio/compras/nproveedor.php'; ?>
<?php require_once '../../negocio/operaciones/ndatosgenerales.php';?>
<div id="formProveedor" class="modal fade">
 <div class="modal-dialog modal-lg" style="width: 95%">
   <div class="modal-content">
    <div style="background-color: #78909c;"  class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 style="color: #FFFFFF;" class="modal-title">Formulario Proveedor</h4>
    </div>
    <div class="modal-body">
        <section class="content">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a href="#formBuscarProveedor" data-toggle="tab" aria-expanded="true" id="btntabbuscarproveedor">
                        Buscar Proveedor
                    </a>
                  </li>
                  <li class="">
                      <a href="#formRegistroProveedor" data-toggle="tab" aria-expanded="false" id="btntabformulario">
                        Registro Proveedor
                      </a>
                  </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="formBuscarProveedor">
                        <div class="row">
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
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Ingresar Búsqueda:</label>
                              <input type="text" id="BusquedaProveedor" name="BusquedaProveedor" class="form-control select2" placeholder="Ingresar Búsqueda">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Nuevo Proveedor:</label>
                              <br>
                              <!--a href="../ventas/vProveedor" class="btn btn-sm btn-primary btn-flat" target="_blank">+ Agregar</a-->
                              <button type="button" id="btn-form-crear-proveedor" class="btn btn-sm btn-info btn-flat pull-left" onclick="verformulario()">Agregar Proveedor</button>
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
                            <th class="ListaDNI">DNI</th>
                            <th class="ListaRUC">RUC</th>
                            <th class="ListaRazonSocial">Razón Social</th>
                            <th class="ListaApellidoPaterno">Apellido Paterno</th>
                            <th class="ListaApellidoMaterno">Apellido Materno</th>
                            <th class="ListaNombres">Nombres</th>
                            <?php if($intTipoDetalle == 1) { ?><th>Tipo de Proveedor</th> <?php } ?>
                            <th>Opciones</th>
                          </tr>
                          </thead>
                          <tbody id="ListaDeProveedoresSeleccion">
                            <script type="text/javascript">ListarProveedoresSeleccion(0,5,1);</script>
                          </tbody>
                        </table>
                        <script>AccionCabecerasTabla("1");</script>
                        </div>
                        <hr>
                        <div class="text-center">
                          <nav aria-label="...">
                            <ul id="PaginacionDeProveedores" class="pagination">
                            <script>PaginarProveedoresSeleccion(0,5,1);</script>
                            </ul>
                          </nav>
                        </div>
                    </div>
                    <div class="tab-pane" id="formRegistroProveedor">
                      <!-- INICIO - formulario proveedor -->
                      <div id="formulario-crud"></div>
                      <div id="resultadocrud"></div>
                      <script type="text/javascript">SNuevoProveedor = "I";</script>
                      <!-- END - formulario proveedor -->
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
  function verformulario(){
    $('#btntabformulario').click();
  }
</script>