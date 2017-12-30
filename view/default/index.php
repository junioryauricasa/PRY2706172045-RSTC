<?php 
    $nvbr_inicio = 'active';
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
    $nvbr_ventas = '';
    $nvbr_ventas_registroclientes = '';
    $nvbr_ventas_registroventas = '';
    $nvbr_ventas_registrocotizacion = '';
    // reportes
    $nvbr_reportes = '';
    $nvbr_reportes_kardexproducto = '';
    $nvbr_reportes_kardexgeneral = '';
    // reportes
    $nvbr_reportes = '';
    $nvbr_reportes_kardexproducto = '';
    $nvbr_reportes_kardexgeneral = '';
    // reportes
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
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <?php require_once '../../negocio/usuarios/nusuario.php'; ?>
    <!--<script type="text/javascript" src="../../negocio/usuarios/nusuario.js"></script>-->
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

<div class="content-wrapper" style="min-height: 1096px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Bienvenido al portal Resteco <?php echo $_SESSION['NombresApellidos'] ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Ejemplo </a></li>
            <li class="active">Perfil Usuario</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">          

          <div class="row">
            
            <div class="col-md-12">
                <div class="box box-info">
                  <img style="padding:50px;" src="../../frameworks/dist/img/logoResteco-for_init.JPG" alt="Logo CCPJ" id="logo-ccpj-default" width="100%">
                </div>
                <div class="box-footer clearfix">     
		            <a href="dashboard" class="btn btn-sm btn-info btn-flat pull-left" style="margin: 0px 5px; border-radius: 3px">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Ver Información General
                </a>

                <!-- INICIO - btn moneda comercial -->
                <a href="../administrativo/vmonedacomercial" class="btn btn-sm btn-danger btn-flat pull-left" style="margin: 0px 5px; border-radius: 3px">
                    <i class="fa fa-usd" aria-hidden="true"></i> Registrar Comercial
                </a>
                <!-- END - btn moneda comercial -->
		        </div>
            </div>
          </div>
        </section><!-- /.content -->
      </div>

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

<!-- For upload image -->
<script>
     $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario")[0]);
            var ruta = "ajax-imagen.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
     });
</script>
<!-- END For upload image -->

<?php include('../_include/rstfooter.php'); ?>