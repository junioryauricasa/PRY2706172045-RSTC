<?php
    $lblPersonaSingular = "Proveedor";
    $lblTituloSingular = "Compra";
    $lblTituloPlural = "Compras";
    $intTipoDetalle = 2;
    $intIdTipoComprobante = 0;


    $nvbr_inicio = '';
    $nvbr_infogeneral = '';
    // inventario
    $nvbr_inventario = '';
    $nvbr_inventario_registroproducto = '';
    $nvbr_inventario_ubigeoproducto = '';
    // compras
    $nvbr_compras = 'active';
    $nvbr_compras_registroproveedores = '';
    $nvbr_compras_registrocompras = 'active';
    $nvbr_compras_ordenesporcompra = '';
    // ventas
    $nvbr_ventas = '';
    $nvbr_ventas_registroclientes = '';
    $nvbr_ventas_registroventas = '';
    $nvbr_ventas_registrocotizacion = '';
    // reportes
    $nvbr_reportes = '';
    $nvbr_reportes_kardexproducto = '';
    $nvbr_reportes_kardexgeneral = '';
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