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
    $nvbr_ventas_registroclientes = 'active';
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
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <?php require_once '../../negocio/ventas/ncliente.php'; ?>
    <?php require_once '../../negocio/operaciones/ndatosgenerales.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>}
    <!--<script type="text/javascript" src="../../negocio/ventas/ncliente.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/ndatosgenerales.js"></script>-->
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
        Registro de Clientes
        <small>Módulo de Ventas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Fixed</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active">
                <a href="#listarclientes" data-toggle="tab" aria-expanded="false" id="lilistarclientes">Lista de Clientes</a>
            </li>
            <li class="">
                <a href="#formularioclientes" data-toggle="tab" id="liformularioclientes">Formulario de Clientes</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="listarclientes">

                <!-- Main content -->
                <section class="content">
                  <!-- TABLE: LATEST USERS -->
                  <div class="">
                    <div class="box-header with-border">
                      <h3 class="box-title">Clientes</h3>
                    </div>
                    <div class="box-body">
                      <div class="row">
                        <?php include '../campos/cmbNumLista.php'; ?>
                        <div class="col-md-2">
                          <div class="form-group">
                              <label class="text-left">Ingresar Búsqueda:</label>
                              <input type="text" name="txt-busqueda" id="txt-busqueda" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
                          </div>
                        </div>
                        <?php include '../campos/cmbListaPersona.php'; ?>
                      </div>
                      <div class="table-responsive">
                        <table class="ExcelTable2007 rwd-table" width="100%">
                          <thead>
                          <tr>
                            <!--th class="heading" width="25px">&nbsp;</th-->
                            <th class="" width="25px" style="background: #a9c4e9">
                              <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                            </th>
                            <!--
                            <th class="ListaDNI">DNI</th>
                            <th class="ListaRUC">RUC</th>
                            <th class="ListaRazonSocial">Razón Social</th>
                            <th class="ListaApellidoPaterno">Apellido Paterno</th>
                            <th class="ListaApellidoMaterno">Apellido Materno</th>
                            <th class="ListaNombres">Nombres</th>-->
                            <th>RUC / DNI</th>
                            <th>Razón Social / Nombres</th>
                            <th>Tipo Cliente</th>
                            <th>Opciones</th>
                          </tr>
                          </thead>
                          <tbody id="ListaDeClientes">
                            <script>ListarCliente(0,10,"T",1);</script>
                          </tbody>
                        </table>
                        <script>AccionCabecerasTabla("1");</script>
                      </div>
                      <br>
                      <div class="text-center">
                        <nav aria-label="...">
                          <ul id="PaginacionDeClientes" class="pagination">
                            <script>PaginarCliente(0,10,"T",1);</script>
                          </ul>
                        </nav>
                      </div>
                    </div>
                    <div class="box-footer clearfix">     
                      <button type="button" id="btn-form-crear-cliente" class="btn btn-sm btn-info btn-flat pull-left" onclick="verformulario()">Agregar Cliente</button>
                    </div>
                  </div>
                </section>
                <!-- /.content -->

            </div>
            <div class="tab-pane" id="formularioclientes">
                <div id="formulario-crud"></div>
                <div id="resultadocrud"></div>
            </div>
          </div>
      </div>
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


<script>
  function verlistado(){
    $('#lilistarclientes').click();
  }

  function verformulario(){
    $('#liformularioclientes').click();
  }
</script>