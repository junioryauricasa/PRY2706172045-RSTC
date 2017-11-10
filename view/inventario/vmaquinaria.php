<?php 
include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <?php require_once '../../negocio/inventario/nproducto.php'; ?>
    <?php require_once '../../negocio/inventario/ncodigoproducto.php'; ?>
    <?php require_once '../../negocio/inventario/nubigeoproducto.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <?php require_once '../../negocio/inventario/nmaquinaria.php'; ?>
    <!--<script type="text/javascript" src="../../negocio/inventario/nproducto.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/inventario/ncodigoproducto.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/inventario/nubigeoproducto.js"></script>-->
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
          <h3 class="box-title">Maquinarias</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <form id="form-maquinaria">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Nombres:</label>
                <input type="text" name="nvchNombres" class="form-control select2" value="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Atención:</label>
                <input type="text" name="nvchAtencion" class="form-control select2" value="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Dirección:</label>
                <input type="text" name="nvchDireccion" class="form-control select2" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Día:</label>
                <input type="text" name="nvchDia" class="form-control select2" value="">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Mes:</label>
                <input type="text" name="nvchMes" class="form-control select2" value="">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Año:</label>
                <input type="text" name="nvchAnio" class="form-control select2" value="">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Precio de Venta:</label>
                <input type="text" name="dcmPrecioVenta" class="form-control select2" value="">
                <input type="hidden" name="funcion" class="form-control select2" value="IMQ">
              </div>
            </div>
          </div>
          </form>
          <div class="table-responsive">
            <table class="rwd-table ExcelTable2007" width="100%">
              <thead>
              <tr>
                <th class="heading" width="25px">&nbsp;</th>
                <th style="width: 50px">Día</th>
                <th>Mes</th>
                <th>Anio</th>
                <th>Nombres</th>
                <th>Precio de Venta</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <tbody id="ListaDeMaquinarias">
                <script>ListarMaquinaria(0,10,"T");</script>
              </tbody>
            </table>
          </div>
        </div>
        <div class="box-footer clearfix">
          <div class="row">
            <div class="col-md-5">  
              <button type="button" id="btn-crear-maquinaria" class="btn btn-sm btn-info btn-flat">Crear Maquinaria</button>
            </div>
          </div>
        </div>
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

  <!-- EN`D Scripts DataTable -->
  <style>
    input{
      padding: 2px 3px;
    }
    select{
      padding: 3px;
    }
  </style>

<?php include('../_include/rstfooter.php'); ?>