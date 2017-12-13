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
    <?php require_once '../../negocio/operaciones/nestiloscomprobante.php'; ?>
    <?php require_once '../../view/modals/vformComprobante.php'; ?>
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
                    <a href="#tab-kardex-producto" id="tab-kardex-producto-btn" data-toggle="tab">Kardex de Productos</a>
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
                    <!--ol class="breadcrumb">
                      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                      <li><a href="#">Layout</a></li>
                      <li class="active">Fixed</li>
                    </ol-->
                  </section>
                  <!-- Inicio - Main content -->
                  <section class="content">
                    <!-- TABLE: LATEST USERS -->
                    <div class="">
                      <div class="">
                        <!--h3 class="box-title">Kardex</h3-->
                        <div class="box-tools pull-right">
                          <!--button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button-->
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="row">
                          <?php include '../campos/cmbNumListaProducto.php'; ?>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="text-left">Ingresar Búsqueda:</label>
                              <input type="text" name="txt-busqueda-producto" id="txt-busqueda-producto" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
                            </div>
                          </div>
                          <div id="tipo-busquedaCol" class="col-md-2">
                            <div class="form-group">
                              <label>Tipo de Búsqueda:</label>
                              <br>
                              <select id="tipo-busqueda-producto" name="tipo-busqueda-producto" class="form-control select2" >
                                <option value="C">Por Códigos</option>
                                <!--<option value="T">Resto de Campos</option>-->
                              </select>
                            </div>
                          </div>
                          <script type="text/javascript">
                            $("#tipo-busquedaCol").hide();
                          </script>
                        </div>
                        <div class="table-responsive">
                          <table class="ExcelTable2007 rwd-table" width="100%">
                            <thead>
                            <tr>
                              <th class="heading" style="width: 25px !important">&nbsp;</th>
                              <th style="width: 120px">Código</th>
                              <th style="">Descripción</th>
                              <th style="width: 100px">Cant. Total</th>
                              <th style="width: 95px">Ubicación</th>
                              <th style="width: 55px">Imágen</th>
                              <th style="width: 95px">Opciones</th>
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
                        

                      <div class="box-footer clearfix">     
                        
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
                        <div id="TablaDetalleUbigeo">
                          <h4 id="lblTituloDetalleKardex" class="box-title text-left"></h4>
                          <button type="button" id="btn-reporte-kardex" onclick="ReporteKardex()" class="btn btn-sm btn-danger btn-flat">Generar Reporte PDF</button>
                          <hr>
                          <input type="hidden" id="intIdProducto"/>
                          <input type="hidden" id="nvchCodigo"/>
                          <div class="row">
                            <?php include '../campos/cmbNumLista.php'; ?>
                            <div id="txt-busquedaCol" class="col-md-2">
                              <div class="form-group">
                                  <label class="text-left">Ingresar Búsqueda:</label>
                                  <input type="text" name="txt-busqueda" id="txt-busqueda" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
                              </div>
                            </div>
                           <script type="text/javascript">$("#txt-busquedaCol").hide();</script>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label>Elegir Sucursal:</label>
                                <select id="intIdSucursal" name="intIdSucursal"  class="form-control select2" form="form-comprobante">
                                <option value="T">General</option>
                                <?php
                                require_once '../../datos/conexion/bd_conexion.php';
                                  try{   
                                  $sql_conexion = new Conexion_BD();
                                  $sql_conectar = $sql_conexion->Conectar();
                                  $sql_comando = $sql_conectar->prepare('CALL mostrarsucursal()');
                                  $sql_comando->execute();
                                  while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                                  {
                                    echo '<option value="'.$fila['intIdSucursal'].'">'.$fila['nvchNombre'].'</option>';
                                  }
                                }catch(PDPExceptions $e){
                                  echo $e->getMessage();
                                }?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-10">
                              <div class="form-group">
                                  <input type="button" value="Volver a la Página de Inicio" class="btn btn-sm btn-danger btn-flat pull-right" style="margin-top: 25px" onclick="$('#tab-kardex-producto-btn').click()">
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
                        </div>

                      <div class="table-responsive">
                        <table class="ExcelTable2007 rwd-table" width="100%">
                          <thead>
                          <tr>
                            <th class="heading" style="width: 25px !important">&nbsp;</th>
                            <th>Fecha Mov.</th>
                            <th>Tipo Mov.</th>
                            <th>Tipo Comprob.</th>
                            <th>Serie</th>
                            <th>Numeración</th>
                            <th>Cantidad Entrada</th>
                            <th>Cantidad Salida</th>
                            <th>Stock</th>
                            <th>Precio Entrada</th>
                            <th>Total Entrada</th>
                            <th>Precio Salida</th>
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
                        <nav aria-label="">
                          <ul id="PaginacionDeKardex" class="pagination">
                          </ul>
                        </nav>
                      </div>
                </div>
              </div>
            </div>
        </section>
    </div>
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