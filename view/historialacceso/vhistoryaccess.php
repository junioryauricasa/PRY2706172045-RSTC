<?php 
include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <script type="text/javascript" src="../../negocio/historialacceso/nhistorialacceso.js"></script>
    <!--script type="text/javascript" src="ajax/vhistorialacceso.js"></script-->
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
        Historial de Accesos
        <small>Vista al Historial de Accesos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Historial Acceso</a></li>
        <li class="active">Tabla</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- TABLE: LATEST USERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Registro de Historial de Accesos</h3>
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
                <select id="num-lista" name="num-lista"  class="form-control select2" >
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
          <!--div class="row">
            <div class="col-md-2">
              <label class="text-left">Ingresar Búsqueda:</label>
              <div class="form-group">
                  <input type="text" name="txt-busqueda" id="txt-busqueda" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
              </div>
            </div>
          </div-->
          <div class="table-responsive">
            <table class="table table-hover table-condensed">
              <thead>
              <tr>
                <th>#Código</th>
                <th>Usuario</th>
                <th>Último Acceso</th>
                <th>IP Registrada</th>
                <th>Dispositivo</th>
              </tr>
              </thead>
              <tbody id="ListaDeHistorialAccesos">
                <script>ListarProducto(0,10,"T");</script>
              </tbody>
            </table>
          </div>
          <hr>
          <div class="text-center">
            <nav aria-label="...">
              <ul id="PaginacionDeHistorialAccesos" class="pagination">
                <script>PaginarProducto(0,10,"T");</script>
              </ul>
            </nav>
          </div>
        </div>
        <div class="box-footer clearfix">     
          <a href="" class="btn btn-sm btn-success btn-flat pull-left" style="margin: 0px 5px">Generar Reporte</a>
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