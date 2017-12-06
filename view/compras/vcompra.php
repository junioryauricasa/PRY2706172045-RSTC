<?php
$lblPersonaSingular = "Proveedor";
$lblTituloSingular = "Compra";
$lblTituloPlural = "Compras";
$intTipoDetalle = 2;
$intIdTipoComprobante = 0;
include('../_include/rstheader.php');
require_once '../../datos/conexion/bd_conexion.php';
?>
<?php require_once '../../negocio/comprobante/ncomprobante.php'; ?>
<?php require_once '../../negocio/comprobante/ndetallecomprobante.php'; ?>
<?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
<?php require_once '../../negocio/operaciones/nestilos.php'; ?>
<?php require_once '../../view/modals/vformProveedor.php'; ?>
<?php require_once '../../view/modals/vformProducto.php'; ?>
<?php require_once '../../view/modals/vformCotizacion.php'; ?>
<?php require_once '../../negocio/operaciones/nestiloscomprobante.php'; ?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Registro de Compras
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
      <?php
        require_once '../comprobante/vcomprobante.php'; 
      ?>
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