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
    $nvbr_ventas = 'active';
    $nvbr_ventas_registroclientes = '';
    $nvbr_ventas_registroventas = 'active';
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


    $lblPersonaSingular = "Cliente";
    $lblTituloSingular = "Venta";
    $lblTituloPlural = "Ventas";
    $intTipoDetalle = 1;
    $intIdTipoComprobante = 0;
    include('../_include/rstheader.php');
    require_once '../../datos/conexion/bd_conexion.php';
?>  
<?php require_once '../../negocio/comprobante/ncomprobante.php'; ?>
<?php require_once '../../negocio/comprobante/ndetallecomprobante.php'; ?>
<?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
<?php require_once '../../negocio/operaciones/nestilos.php'; //stylos del autocompletado?>
<?php require_once '../../view/modals/vformCliente.php'; ?>
<?php require_once '../../view/modals/vformProducto.php'; ?>
<?php require_once '../../view/modals/vformCotizacion.php'; ?>
<?php require_once '../../view/modals/vformComprobanteVenta.php'; ?>
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
      <li><a href="../default/index"></a></li>
      <li><a href="#"></a></li>
      <li class="active"></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php
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