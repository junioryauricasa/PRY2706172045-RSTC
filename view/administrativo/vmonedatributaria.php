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
    $nvbr_administrativo_cambiomonedatributaria = 'active';
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
    <?php include('../../negocio/administrativo/nmonedatributaria.php'); ?>
    <?php include('../../negocio/operaciones/nvalidaciones.php'); ?>
    <?php include('../../negocio/operaciones/nestilos.php'); ?>
    <!--<script type="text/javascript" src="../../negocio/administrativo/nmonedatributaria.js"></script>-->
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
    <section class="content-header">
      <h1>
        Administrar Cambios de Moneda Tributaria
        <small>Módulo Administrativo</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- TABLE: LATEST USERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Registro de Cambios de Monedas</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <!-- INICIO - button -->
            <div class="col-md-12" style="text-align: right;">
                <button type="button" id="btn-form-crear-moneda-tributaria" class="btn btn-sm btn-danger btn-flat pull-right" onclick="showmodalNuevaMonedaTrib()">Nueva Moneda Comercial</button>
            </div>
            <!-- END - button -->

          <br>
          <br>

            <?php include '../campos/cmbNumLista.php'; ?>
            <div class="col-md-2">
              <div class="form-group">
                  <label class="text-left">Ingresar Búsqueda:</label>
                  <input type="text" name="txt-busqueda" id="txt-busqueda" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Tipo de Cambio:</label>
                <br>
                <select id="lista-tipo-cambio" name="lista-tipo-cambio"  class="form-control select2">
                  <?php 
                    require_once '../../datos/conexion/bd_conexion.php';
                    try{
                    $sql_conexion = new Conexion_BD();
                    $sql_conectar = $sql_conexion->Conectar();
                    $sql_comando = $sql_conectar->prepare('CALL mostrartipocambio()');
                    $sql_comando->execute();
                    while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                    {
                      echo '<option value="'.$fila['intIdTipoCambio'].'">'.$fila['nvchDescripcion'].'</option>';
                    }
                  }catch(PDPExceptions $e){
                    echo $e->getMessage();
                  }?>
                </select>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <!--table class="ExcelTable2007 rwd-table" width="100%"-->
            <table class="ExcelTable2007 rwd-table" width="50%" style="text-align: center; margin: 0 auto">
              <thead>
              <tr>
                <!--th class="heading" width="25px">&nbsp;</th-->
                <th class="" width="25px" style="background: #a9c4e9">
                  <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                </th>
                <th>Fecha</th>
                <th>Valor EstadoUnidense</th>
                <th>Valor Sol</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <tbody id="ListaDeMonedaTributaria">
                <script>ListarMonedaTributaria(0,10,"T");</script>
              </tbody>
            </table>
          </div>
          <div class="text-center" style="width: 50%;text-align: center !important; margin: 0 auto">
            <nav aria-label="...">
              <ul id="PaginacionDeMonedaTributaria" class="pagination">
                <script>PaginarMonedaTributaria(0,10,"T");</script>
              </ul>
            </nav>
          </div>
        </div>
        <div class="box-footer clearfix">     
            <!--button type="button" id="btn-form-crear-moneda-tributaria" class="btn btn-sm btn-info btn-flat pull-left">Agregar Moneda Tributaria</button-->

            <!-- script for modal -->
            <script type="text/javascript">
                  function showmodalNuevaMonedaTrib(){
                    $('#modalNuevaMonedaTrib').modal('show'); // abrira el modal seleccionado
                  }
            </script>
        </div>
      </div>


          <!-- INICIO modal -->
          <div class="modal fade" id="modalNuevaMonedaTrib" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="result"></div>
                  <div id="formulario-crud"></div>
                  <!--div id="resultadocrud"></div-->
              </div>
            </div>
          </div>
          <!-- END modal -->


        <!-- INICIO modal confirmar 
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
        END modal confirmar -->


    </section>
  </div>



<style>
    input{
      padding: 2px 3px;
    }
    select{
      padding: 3px;
    }
</style>

<?php include('../_include/rstfooter.php'); ?>