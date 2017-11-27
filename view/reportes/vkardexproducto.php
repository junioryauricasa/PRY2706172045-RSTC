<?php 
include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>

    <?php require_once '../../negocio/reportes/nkardexproducto.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <!--<script type="text/javascript" src="../../negocio/reportes/nkardexproducto.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/nvalidaciones.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/nestilos.js"></script>-->
    <style>
      .pagination a {
          margin: 0 4px; /* 0 is for top and bottom. Feel free to change it */
      }
      hr { 
          display: block;
          margin-top: 0.5em;
          margin-bottom: 0.5em;
          margin-left: auto;
          margin-right: auto;
          border-style: inset;
          border-width: 1px;
      }
    </style>

    <div class="content-wrapper">
        <section class="content">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab-kardex-producto" data-toggle="tab">Kardex de Productos</a>
                </li>
                <li>
                    <a href="#tab-detalles-kardex-producto" id="tab-detalles-kardex-producto-btn" data-toggle="tab">Detalles kardex de Producto</a>
                </li>
              </ul>
              <div class="tab-content">

                <div class="tab-pane active" id="tab-kardex-producto">
                  <section class="content-header">
                    <h1>
                      Kardex
                      <small>Módulo de Reportes</small>
                    </h1>
                    <ol class="breadcrumb">
                      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                      <li><a href="#">Layout</a></li>
                      <li class="active">Fixed</li>
                    </ol>
                  </section>
                  <!-- Inicio - Main content -->
                  <section class="content">
                    <!-- TABLE: LATEST USERS -->
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <h3 class="box-title">Kardex</h3>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Mostrar:</label>
                              <br>
                              <select id="num-lista-producto" name="num-lista-producto"  class="form-control select2" >
                                <option value="10">Ver 10 Resultados</option>
                                <option value="25">Ver 25 Resultados</option>
                                <option value="50">Ver 50 Resultados</option>
                                <option value="100">Ver 100 Resultados</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="text-left">Ingresar Búsqueda:</label>
                              <input type="text" name="txt-busqueda-producto" id="txt-busqueda-producto" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Tipo de Búsqueda:</label>
                              <br>
                              <select id="tipo-busqueda-producto" name="tipo-busqueda-producto" class="form-control select2" >
                                <option value="C">Por Códigos</option>
                                <option value="T">Resto de Campos</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Tipo Moneda:</label>
                              <br>
                              <select id="lista-tipo-moneda" class="form-control select2">
                                <?php 
                                  require_once '../../datos/conexion/bd_conexion.php';
                                  try{
                                  $sql_conexion = new Conexion_BD();
                                  $sql_conectar = $sql_conexion->Conectar();
                                  $sql_comando = $sql_conectar->prepare('CALL mostrartipomoneda()');
                                  $sql_comando->execute();
                                  while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                                  {
                                    echo '<option value="'.$fila['intIdTipoMoneda'].'">'.$fila['nvchNombre'].'</option>';
                                  }
                                }catch(PDPExceptions $e){
                                  echo $e->getMessage();
                                }?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-left">Fecha Inicial:</label>
                                <input type="text" id="dtmFechaInicial" class="form-control select2" placeholder="dd/mm/aaaa" value="">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-left">Fecha Final:</label>
                                <input type="text" id="dtmFechaFinal" class="form-control select2" placeholder="dd/mm/aaaa" value="">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-left">Opción:</label>
                                <input type="button" id="btnBuscar" class="form-control select2 btn btn-md btn-primary btn-flat" value="Realizar Búsqueda">
                            </div>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="ExcelTable2007 rwd-table" width="100%">
                            <thead>
                            <tr>
                              <th class="heading" width="25px">&nbsp;</th>
                              <th>Código</th>
                              <th>Descripción</th>
                              <th>Tipo de Moneda</th>
                              <th>Precio de Venta 1</th>
                              <th>Precio de Venta 2</th>
                              <th>Precio de Venta 3</th>
                              <th>Cant. Total</th>
                              <th>Ubicación</th>
                              <th>Imágen</th>
                              <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody id="ListaDeProductos">
                              <script>ListarProducto(0,10,"T");</script>
                            </tbody>
                          </table>
                        </div>
                        <hr>
                        <!-- INICIO - paginacion de productos -->
                        <div class="text-center">
                          <nav aria-label="...">
                            <ul id="PaginacionDeProductos" class="pagination">
                              <script>PaginarProducto(0,10,"T");</script>
                            </ul>
                          </nav>
                        </div>
                        <!-- END - paginacion de productos -->
                        <div id="TablaDetalleUbigeo">
                        <hr>
                        <input type="hidden" id="intIdProducto"/>
                        <div class="row">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Mostrar:</label>
                              <br>
                              <select id="num-lista" name="num-lista"  class="form-control select2">
                                    <option value="10">Ver 10 Resultados</option>
                                    <option value="25">Ver 25 Resultados</option>
                                    <option value="50">Ver 50 Resultados</option>
                                    <option value="100">Ver 100 Resultados</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-left">Ingresar Búsqueda:</label>
                                <input type="text" name="txt-busqueda" id="txt-busqueda" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
                            </div>
                          </div>
                        </div>

                        

                      </div>

                      <div class="box-footer clearfix">     
                        <button type="button" id="btn-reporte-kardex" onclick="ReporteKardex()" class="btn btn-sm btn-danger btn-flat pull-left">Generar Reporte PDF</button>
                      </div>
                      <div id="ReporteKardex"></div>
                    </div>

                    <div class="result"></div>
                    <div id="formulario-crud"></div>
                    <div id="resultadocrud"></div>
                  </section>
                  <!-- END - Main content -->
                </div>

                <div class="tab-pane" id="tab-detalles-kardex-producto">
                      
                      <div class="table-responsive">
                        <table class="ExcelTable2007 rwd-table" width="100%">
                          <thead>
                          <tr>
                            <th class="heading" width="25px">&nbsp;</th>
                            <th>Ítem</th>
                            <th>Fecha</th>
                            <th>Tipo de Mov.</th>
                            <th>Tipo Comprobante</th>
                            <th>Serie</th>
                            <th>Numeración</th>
                            <th>Cantidad Entrada</th>
                            <th>Cantidad Salida</th>
                            <th>Stock</th>
                            <th>Precio Uni. Entrada</th>
                            <th>Total Entrada</th>
                            <th>Precio Uni. Salida</th>
                            <th>Total Salida</th>
                            <th>Saldo Valorizado</th>
                            <th>Opción</th>
                          </tr>
                          </thead>
                          <tbody id="ListaDeKardex">
                          </tbody>
                        </table>
                      </div>

                      <hr>
                      
                      <div class="text-center">
                        <nav aria-label="...">
                          <ul id="PaginacionDeKardex" class="pagination">
                          </ul>
                        </nav>
                      </div>

                </div>

              </div>
            </div>
        </section>
    </div>

          <!-- script for modal detalles prod -->
          <script type="text/javascript">
                function showmodaldetalles(){
                  $('#modal-detalleproductos').modal('show');
                }
          </script>
          <!-- Modal codigo productos-->
          <div class="modal modal-default fade" id="modal-detalleproductos" data-backdrop="static">
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
                                        <th class="heading" style="width: 25px">&nbsp;</th>
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
                  <button type="button" onclick="LimpiarDetalleUbigeo()" class="btn  btn-success btn-flat">Limpiar Detalles</button>
                  <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- END Modal codigo productos-->




<script>
  // Modal
  $('#modalcust').modal({
    keyboard: false
  });

  function clickdetalleskardex(){
      $('#tab-detalles-kardex-producto-btn').click();
  }
</script>
<!-- ENd Scripts DataTable -->
<style>
  input{
    padding: 2px 3px;
  }
  select{
    padding: 3px;
  }

  .ExcelTable2007 tr:hover{
    background-color: #ffff99 !important;
  }
</style>
<?php include('../_include/rstfooter.php'); ?>