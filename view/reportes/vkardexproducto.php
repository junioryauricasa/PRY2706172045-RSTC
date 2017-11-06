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

    <!-- Main content -->
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
            <table class="table table-hover table-condensed">
              <thead>
              <tr>
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
          <div class="text-center">
            <nav aria-label="...">
              <ul id="PaginacionDeProductos" class="pagination">
                <script>PaginarProducto(0,10,"T");</script>
              </ul>
            </nav>
          </div>
          <div id="TablaDetalleUbigeo">
          <hr>
            <div class="text-left"><h4>Detalle de la ubicación del Producto: <p id="CodigoProducto"></p></h4></div>
            <div class="table-responsive">
              <table class="table table-hover table-condensed">
                <thead>
                <tr>
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
          <div class="table-responsive">
            <table class="table table-hover table-condensed">
              <thead>
              <tr>
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
        <div class="box-footer clearfix">     
          <button type="button" id="btn-reporte-kardex" onclick="ReporteKardex()" class="btn btn-sm btn-danger btn-flat pull-left">Generar Reporte PDF</button>
        </div>
        <div id="ReporteKardex"></div>
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