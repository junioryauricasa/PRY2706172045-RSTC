<?php 
    
    $nvbr_inicio = '';
    $nvbr_infogeneral = '';
    // inventario
    $nvbr_inventario = '';
    $nvbr_inventario_registroproducto = '';
    $nvbr_inventario_ubigeoproducto = '';
    // compras
    $nvbr_compras = 'active';
    $nvbr_compras_registroproveedores = 'active';
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
    <?php require_once '../../negocio/compras/nproveedor.php'; ?>
    <?php require_once '../../negocio/operaciones/ndatosgenerales.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <!--<script type="text/javascript" src="../../negocio/compras/nproveedor.js"></script>-->
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
        Registro de Proveedores
        <small>Módulo de Compras</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
              <div class="nav-tabs-custom">
                  
                  <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#lilistaproveedores" data-toggle="tab" aria-expanded="false" id="btn-listaproveedores">
                            Relación de Proveedores
                        </a>
                    </li>
                    <li class="">
                        <a href="#liformularioproveedores" data-toggle="tab" id="btn-formularioproveedores">
                            Formulario de Proveedores
                        </a>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <div class="tab-pane active" id="lilistaproveedores">
                      <!-- Main content -->
                      <section class="content">
                        <!-- TABLE: LATEST USERS -->
                        <div class="">
                          <!--h3 class="box-title">Registro de Proveedores</h3-->
                          
                          <div class="pull-right">
                            <!-- Agregar proveedor -->
                            <button type="button" id="btn-form-crear-proveedor" class="btn btn-sm btn-info btn-flat" onclick="verformularioproveedor()">
                              <i class="fa fa-plus-square" aria-hidden="true"></i>
                              Agregar Proveedor
                            </button> 
    
                            <!-- button para descarga de excel -->
                            <a href="#" class="btn btn-sm btn-success btn-flat" id="DescargarListaProveedorExcel">
                              <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                              Descargar Excel
                            </a> 

                            <!-- button para descarga de pdf -->
                            <a href="#" class="btn btn-sm btn-danger btn-flat" id="DescargarListaProveedorExcel">
                              <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                              Descargar PDF
                            </a> 
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
                                  <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody id="ListaDeProveedores">
                                  <script>ListarProveedor(0,10,"T",1);</script>
                                </tbody>
                              </table>
                              <script>AccionCabecerasTabla("1");</script>
                            </div>
                            <br>
                            <div class="text-center">
                              <nav aria-label="...">
                                <ul id="PaginacionDeProveedores" class="pagination">
                                  <script>PaginarProveedor(0,10,"T",1);</script>
                                </ul>
                              </nav>
                            </div>
                          </div>
                        </div>
                      
                      </section>
                      <!-- /.content -->
                      
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="liformularioproveedores">
                        <div id="formulario-crud"></div>
                        <div id="resultadocrud"></div>
                    </div>

                  </div>
              </div>
            </div>
        </div>
    </section>
  </div>

  <!-- INICIO modal confirmar -->
  <div class="modal fade mi-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
        </div>
        <div class="modal-body">
          Estas seguro de eliminar registro?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default modal-btn-si" id="">Si</button>
          <button type="button" class="btn btn-primary modal-btn-no" id="">No</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END modal confirmar -->


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
    function verformularioproveedor(){
      $('#btn-formularioproveedores').click();
    }
</script>