<?php 
include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>   

    <script type="text/javascript" src="../../negocio/inventario/nproducto.js"></script>
    <script type="text/javascript" src="ajax/vproducto.js"></script>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Administrar Productos
        <small>Blank example to the fixed layout</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Fixed</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!--div class="callout callout-info">
        <h4>Tip!</h4>
        <p>Add the fixed class to the body tag to get this layout. The fixed layout is your best option if your sidebar
          is bigger than your content because it prevents extra unwanted scrolling.</p>
      </div-->

      <!-- TABLE: LATEST USERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Registro de Productos</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-hover table-condensed">
              <thead>
              <tr>
                <th>#Código</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Imagen</th>
                <th>Descripción</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <tbody id="result">
              </tbody>
            </table>
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
  // add json datatable
  $(document).ready( function () {
      $('table').DataTable();
  } );

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