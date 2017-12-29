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
    $nvbr_ventas = '';
    $nvbr_ventas_registroclientes = '';
    $nvbr_ventas_registroventas = '';
    $nvbr_ventas_registrocotizacion = '';
    // reportes
    $nvbr_reportes = '';
    $nvbr_reportes_kardexproducto = '';
    $nvbr_reportes_kardexgeneral = '';
    // administrativo
    $nvbr_administrativo = 'active';
    $nvbr_administrativo_cambiomonedatributaria = '';
    $nvbr_administrativo_cambiomonedacomercial = '';
    $nvbr_administrativo_numeraciondecomprobantes = '';
    $nvbr_administrativo_modulousuarios = 'active';
    $nvbr_administrativo_modulousuarios_registrousuario = '';
    $nvbr_administrativo_modulousuarios_historialusuarios = 'active';
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
    <?php require_once '../../negocio/historialacceso/nhistorialacceso.php'; ?>
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

    <!-- Main content -->
    <section class="content">
      <!-- TABLE: LATEST USERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h2 class="box-title">Registro de Historial de Accesos</h2>
          <div class="box-tools pull-right">
            <!--a href="" class="btn btn-sm btn-success btn-flat pull-left" style="margin: 0px 5px">Generar Reporte</a-->
            <button type="button" style="margin-right: 5px" id="btn-form-crear-usuario" class="btn btn-sm btn-success btn-flat pull-left" onclick="">
                <i class="fa fa-file-excel-o" aria-hidden="true" style="padding-right: 5px"></i> 
                Reporte Excel
              </button>
            <button type="button" style="margin-right: 5px" id="btn-form-crear-usuario" class="btn btn-sm btn-danger btn-flat pull-left" onclick="">
                <i class="fa fa-file-pdf-o" aria-hidden="true" style="padding-right: 5px"></i> 
                Reporte PDF
            </button>
          </div>
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
            <table class="ExcelTable2007 rwd-table" width="100%">
              <thead>
              <tr>
                <!--th class="heading" width="25px">&nbsp;</th-->
                <th class="" width="25px" style="background: #a9c4e9">
                  <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                </th>
                <th>Código</th>
                <th>Usuario</th>
                <th>Último Acceso</th>
                <th>IP Registrada</th>
                <th>Dispositivo</th>
              </tr>
              </thead>
              <tbody id="ListaDeHistorialAccesos">
                <script>ListarHistorialDeAcceso(0,10,"T");</script>
              </tbody>
            </table>
          </div>
          <hr>
          <div class="text-center">
            <nav aria-label="...">
              <ul id="PaginacionDeHistorialAccesos" class="pagination">
                <script>PaginarHistorialDeAcceso(0,10,"T");</script>
              </ul>
            </nav>
          </div>
        </div>
        <div class="box-footer clearfix">
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