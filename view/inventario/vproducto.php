<?php 
include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <script type="text/javascript" src="../../negocio/inventario/nproducto.js"></script>
    <script type="text/javascript" src="../../negocio/inventario/ncodigoproducto.js"></script>
    <script type="text/javascript" src="../../negocio/inventario/nubigeoproducto.js"></script>
    <script type="text/javascript" src="../../negocio/inventario/nvalidacion_producto.js"></script>
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
        Registro de Productos
        <small>Módulo de Inventario</small>
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
          <h3 class="box-title">Productos</h3>
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
            <div class="col-md-2">
              <div class="form-group">
                <label>Tipo de Búsqueda:</label>
                <br>
                <select id="tipo-busqueda" name="tipo-busqueda"  class="form-control select2" >
                  <option value="T">Resto de Campos</option>
                  <option value="C">Por Códigos</option>
                </select>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-condensed">
              <thead>
              <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Unidad de Medida</th>
                <th>Precio de Venta 1</th>
                <th>Precio de Venta 2</th>
                <th>Precio de Venta 3</th>
                <th>Cant. Huancayo</th>
                <th>Cant. San Jerónimo</th>
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
        </div>
        <div class="box-footer clearfix">     
          <button type="button" id="btn-form-crear-producto" class="btn btn-sm btn-info btn-flat pull-left">Agregar Producto</button>
          <a href="reportes" class="btn btn-sm btn-success btn-flat pull-left" style="margin: 0px 5px">Generar Reporte del Registro</a>
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