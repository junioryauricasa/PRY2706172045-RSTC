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
    $nvbr_administrativo_modulousuarios_registrousuario = 'active';
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
    <?php require_once '../../negocio/operaciones/ndatosgenerales.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <!--<script type="text/javascript" src="../../negocio/usuarios/nusuario.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/ndatosgenerales.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/nvalidaciones.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/nestilos.js"></script>-->
    <style>
      .pagination a {
          margin: 0 4px;
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
    <!--section class="content-header">
      <h1>
        Administrar Usuario
        <small>Módulo de Usuario</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Estatico</li>
      </ol>
    </section-->

    <!-- Main content -->
    <section class="content">
      <!-- TABLE: LATEST USERS -->
      <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
              <li class="active">
                  <a href="#tab_1" data-toggle="tab" id="tab-listado-usuario-btn">Administrar Usuarios</a>
              </li>
              <li>
                  <a href="#tab_2" data-toggle="tab" id="tab-detalles-usuario-btn">Formulário de Usuarios</a>
              </li>
            </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="row">
                  <div class="col-md-12">
                      <div class="">
                        <h3 class="">Registro de Usuarios</h3>
                        <div class="pull-right">
                              <button type="button" style="margin-right: 5px" id="btn-form-crear-usuario" class="btn btn-sm btn-info btn-flat pull-left" onclick="clickdetallesUsuario()"><i class="fa fa-plus-square" aria-hidden="true" style="padding-right: 5px"></i> Agregar Usuario</button>
                              <button type="button" style="margin-right: 5px" id="btn-form-crear-usuario" class="btn btn-sm btn-success btn-flat pull-left" onclick=""><i class="fa fa-file-excel-o" aria-hidden="true" style="padding-right: 5px"></i> 
                              Reporte Excel</button>
                              <button type="button" style="margin-right: 5px" id="btn-form-crear-usuario" class="btn btn-sm btn-danger btn-flat pull-left" onclick=""><i class="fa fa-file-pdf-o" aria-hidden="true" style="padding-right: 5px"></i> 
                              Reporte PDF</button>
                        </div>
                      </div>
                      <div class="">
                        <div class="row">
                          <?php include '../campos/cmbNumLista.php'; ?>
                          <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-left">Ingresar Búsqueda:</label>
                                <input type="text" name="txt-busqueda" id="txt-busqueda" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
                            </div>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table  class="ExcelTable2007 rwd-table" width="100%">
                            <thead>
                            <tr>
                              <!--th class="heading" width="25px">&nbsp;</th-->
                              <th class="" width="25px" style="background: #a9c4e9">
                                <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                              </th>
                              <th>DNI</th>
                              <th>Nombres y Apellidos</th>
                              <th>Usuario</th>
                              <th>Tipo Usuario</th>
                              <th>Estado</th>
                              <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody id="ListaDeUsuarios">
                              <script>ListarUsuario(0,10,"T");</script>
                            </tbody>
                          </table>
                        </div>
                        <hr>
                        <div class="text-center">
                          <nav aria-label="...">
                            <ul id="PaginacionDeUsuarios" class="pagination">
                              <script>PaginarUsuario(0,10,"T");</script>
                            </ul>
                          </nav>
                        </div>
                        <br>
                        
                      </div> 
                  </div>                 
                </div>
            </div>

            <div class="tab-pane active" id="tab_2">    
                <div class="result"></div>
                <div id="formulario-crud"></div>
                <div id="resultadocrud"></div>
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


  
<script>

  function clickdetallesUsuario(){
      $('#tab-detalles-usuario-btn').click();
  }
  function clienteslistado(){
      $('#tab-listado-usuario-btn').click();
  }
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