<?php     
    
    $nvbr_inicio = '';
    $nvbr_infogeneral = '';
    // inventario
    $nvbr_inventario = '';
    $nvbr_inventario_registroproducto = '';
    $nvbr_inventario_ubigeoproducto = '';
    // compras
    $nvbr_compras = '';
    $nvbr_compras_registroproveedores = '';
    $nvbr_compras_registrocompras = '';
    $nvbr_compras_ordenesporcompra = '';
    // ventas
    $nvbr_ventas = '';
    $nvbr_ventas_registroclientes = '';
    $nvbr_ventas_registroventas = '';
    $nvbr_ventas_registrocotizacion = '';
    // reportes
    $nvbr_reportes = 'active';
    $nvbr_reportes_kardexproducto = '';
    $nvbr_reportes_kardexgeneral = 'active';
    // administrativo
    $nvbr_administrativo = '';
    $nvbr_administrativo_cambiomonedatributaria = '';
    $nvbr_administrativo_cambiomonedacomercial = '';
    $nvbr_administrativo_numeraciondecomprobantes = '';
    $nvbr_administrativo_modulousuarios = '';
    $nvbr_administrativo_modulousuarios_registrousuario = '';
    $nvbr_administrativo_modulousuarios_historialusuarios = '';
    // equipos
    $nvbr_equipos = '';
    // cuentas
    $nvbr_cuentas = '';
    $nvbr_cuentas_miperfil = '';
    $nvbr_cuentas_cerrarsession = '';


    include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <?php require_once '../../negocio/reportes/nkardexgeneral.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <!--<script type="text/javascript" src="../../negocio/reportes/nkardexgeneral.js"></script>-->
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

    <!-- Main content -->
    <section class="content">
      <!-- TABLE: LATEST USERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Kardex General <small> Módulo de Reportes</small></h3>
        </div>

        <div class="box-body">
          
          <div class="pull-right">
              <button type="button" id="btn-reporte-kardex" onclick="ReporteKardex()" class="btn btn-sm btn-danger btn-flat">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                Reporte PDF
              </button>
              <button type="button" id="btn-reporte-kardex" onclick="ReporteKardexExcel()" class="btn btn-sm btn-success btn-flat ">
                <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                Reporte EXCEL
              </button>
          </div>

          <br>

          <div class="row">
            <?php include '../campos/cmbNumLista.php'; ?>
            <div class="col-md-2">
              <div class="form-group">
                  <label class="text-left">Ingresar Búsqueda:</label>
                  <input type="text" name="txt-busqueda" id="txt-busqueda" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Elegir Sucursal:</label>
                <select id="intIdSucursal" name="intIdSucursal" class="form-control select2" form="form-comprobante">
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
            <div class="col-md-2">
              <div class="form-group">
                  <label class="text-left">Total Saldo Valorizado:</label>
                  <input type="text" id="TotalKardexValorizado" class="form-control select2" placeholder="0.00" readonly>
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
                <!--<th>Ítem</th>-->
                <th style="width: 150px">Fecha</th>
                <th style="width: 120px">Código</th>
                <th style="width: 600px">Descripción</th>
                <th>Entrada Total</th>
                <th>Salida Total</th>
                <th>Stock</th>
                <th>Saldo Valorizado</th>
              </tr>
              </thead>
              <tbody id="ListaDeKardex">
                <script>ListarKardex(0,10,"T");</script>
              </tbody>
            </table>
          </div>
          <hr>
          <div class="text-center">
            <nav aria-label="...">
              <ul id="PaginacionDeKardex" class="pagination">
                <!--<script>PaginarKardex(0,10,"T");</script>-->
              </ul>
            </nav>
          </div>
        </div>
        <div class="box-footer clearfix">     
        </div>
      </div>

      <div>
        <div class="result"></div>
      </div>

      <div id="formulario-crud"></div>
      <div id="resultadocrud"></div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- Scripts DataTable -->
<script>
  // Modal
  $('#modalcust').modal({
    keyboard: false
  });
</script>
<!-- ENd Scripts DataTable -->
<style>
  input{
    padding: 2px 3px;
  }
  select{
    padding: 3px;
  }
</style>
<?php include('../_include/rstfooter.php'); ?>