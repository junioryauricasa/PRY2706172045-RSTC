<?php 
include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <?php require_once '../../negocio/compras/nordencompra.php'; ?>
    <?php require_once '../../negocio/compras/ndetalleordencompra.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <!--<script type="text/javascript" src="../../negocio/compras/nordencompra.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/compras/ndetalleordencompra.js"></script>-->
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
        Orden de Compra
        <small>Módulo de Compras</small>
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
          <h3 class="box-title">Ordenes de Compra</h3>
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
                  <label class="text-left">Total Orden Compra:</label>
                  <input type="text" id="TotalOrdenCompra" class="form-control select2" placeholder="0.00" readonly>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="ExcelTable2007 rwd-table" width="100%">
              <thead>
              <tr>
                <th class="heading" width="25px">&nbsp;</th>
                <th>Numeración</th>
                <th>Proveedor</th>
                <th>Usuario</th>
                <th>Fecha de Creación</th>
                <th>Valor de Compra</th>
                <th>IGV</th>
                <th>Total Compra</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <tbody id="ListaDeOrdenCompra">
                <script>ListarOrdenCompra(0,10,"T");</script>
              </tbody>
            </table>
          </div>
          <hr>
          <div class="text-center">
            <nav aria-label="...">
              <ul id="PaginacionDeOrdenCompra" class="pagination">
                <script>PaginarOrdenCompra(0,10,"T");</script>
              </ul>
            </nav>
          </div>
        </div>
        <div class="box-footer clearfix">     
          <button type="button" id="btn-form-crear-ordencompra" class="btn btn-sm btn-info btn-flat pull-left">Crear Orden de Compra</button>
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