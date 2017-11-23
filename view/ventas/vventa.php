<?php 
include('../_include/rstheader.php');
require_once '../../datos/conexion/bd_conexion.php';
?>  
    <?php require_once '../../negocio/comprobante/ncomprobante.php'; ?>
    <?php require_once '../../negocio/comprobante/ndetallecomprobante.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <?php require_once '../../view/modals/vformCliente.php'; ?>
    <?php require_once '../../view/modals/vformProducto.php'; ?>
    <?php require_once '../../view/modals/vformCotizacion.php'; ?>
    <?php require_once '../../negocio/inventario/nproducto.php'; ?>
    <?php require_once '../../negocio/operaciones/nestiloscomprobante.php'; ?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Registro de Ventas
        <small>Módulo de Ventas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../default/index">Inicio</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Fixed</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php 
        $intTipoDetalle = 1;
        require_once '../comprobante/vcomprobante.php'; 
      ?>
    </section>
  </div>
<script>
  $('#modalcust').modal({
    keyboard: false
  });
</script>
<style>
  input{
    padding: 2px 3px;
  }
  select{
    padding: 3px;
  }
</style>
<?php include('../_include/rstfooter.php'); ?>