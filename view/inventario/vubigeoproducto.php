<?php 
        
    $nvbr_inicio = '';
    $nvbr_infogeneral = '';
    // inventario
    $nvbr_inventario = 'active';
    $nvbr_inventario_registroproducto = '';
    $nvbr_inventario_ubigeoproducto = 'active';
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
    $funcionComprobante = 0;
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <?php require_once '../../negocio/inventario/nproducto.php'; ?>
    <?php require_once '../../negocio/inventario/nubigeoproducto.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
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
	     <div class="nav-tabs-custom">
	     
		    <ul class="nav nav-tabs">
		      <li class="active" id="li_show_table_products">
		      	<a href="#tab_1" data-toggle="tab" aria-expanded="true" id="btnListarProducto">
		      		Lista de Ubigeo de los Productos
		      	</a>
		      </li>
		    </ul>

		    <div class="tab-content">
		      <div class="tab-pane active" id="tab_1">
    			    <section class="content-header">
    			      <h1>
    			        Registro de Ubigeo Producto
    			        <small>Módulo de Inventario</small>
    			      </h1>
    			    </section>
    			    <!-- Main content -->
    			    <section class="content">
    			      <!-- TABLE: LATEST USERS -->
    			      <div class="">
    			        <div class="box-body">
    			          <div class="row">
                      <?php include '../campos/cmbNumListaUbigeo.php'; ?>
    			            <div class="col-md-4">
    			              <div class="form-group">
    			                <label class="text-left">Ingresar Búsqueda:</label>
    			                <input type="text" name="txt-busqueda-ubigeo" id="txt-busqueda-ubigeo" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
    			              </div>
    			            </div>

                      <!-- INICIO - busqueda avanzada button -->
                      <!--<div id="busqueda-AVANZADA" class="col-md-2" style="">
                        <div class="form-group">
                          <label id="label-busqueda-avanzada">Presione</label>
                          <br>
                          <input type="button" value="Busqueda avanzada" class="btn btn-sm btn-info btn-flat" id="btnBusqeudaAvanzada" onclick="mostrarBusquedaAvanzada()">
                          <div id="loader" style="display: none"></div>
                        </div>
                      </div>-->
                      <!-- END - busqueda avanzada button -->

                      <!-- INICIO - formulario busqueda avanzada -->
                      <!-- div del form -->
                      
                      
                      <!-- END- formulario busqueda avanzada -->

    			          </div>
    			          <div class="table-responsive">
    			            <table class="rwd-table ExcelTable2007" width="100%">
    			              <thead>
    			              <tr>
    			                <!--th class="heading" width="25px">&nbsp;</th-->
                          <th class="" width="25px" style="background: #a9c4e9">
                              <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                          </th>
    			                <th style="width: 120px">Código</th>
    			                <th style="width: 500px">Descripción</th>
                          <th style="width: 80px">Sucursal</th>
    			                <th style="width: 80px">Ubicación</th>
                          <th style="width: 80px">Cantidad</th>
    			                <th style="width: 70px">Imágen</th>
    			                <th style="width: 100px; text-align:center">Opciones</th>
    			              </tr>
    			              </thead>
    			              <tbody id="ListaDeUbigeos">
    			                <script>ListarUbigeo(0,10,'T');</script>
    			              </tbody>
    			            </table>
    			          </div>
    			          <div class="text-center">
    			            <nav aria-label="...">
    			              <ul id="PaginacionDeUbigeos" class="pagination">
    			                <script>PaginarUbigeo(0,10,'T');</script>
    			              </ul>
    			            </nav>
    			          </div>
    			        </div>
    			        <div class="box-footer clearfix">
    			          <div class="row">
    			            <div class="col-md-5">
                        <!-- button para descarga de excel -->
                      </div>
    			          </div>
    			        </div>
    			      </div>
    			    </section>
		      </div>
		      <!-- /.tab-pane -->
		    </div>
		    <!-- /.tab-content -->
		  </div>
    </section>
      
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- Scripts DataTable -->
<?php require_once '../../view/modals/vformUbigeoProducto.php'; ?>
<!-- ENd Scripts DataTable -->
<style>
  input{
    padding: 2px 3px;
  }
  select{
    padding: 3px;
  }
</style>

  <!-- EN`D Scripts DataTable -->
  <style>
    input{
      padding: 2px 3px;
    }
    select{
      padding: 3px;
    }
  </style>


<!--
<div class="box box-info direct-chat direct-chat-warning" id="chatbox">
  <div class="box-header with-border">
    <h3 class="box-title">Informacion auxiliar</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

    </div>
  </div>

  <div class="box-body" style="">
        
        <div class="direct-chat-messages">
         
          <div class="direct-chat-msg">
            <div class="direct-chat-info clearfix">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet dignissimos placeat dicta omnis, obcaecati eaque ullam unde, quas iusto, nobis libero optio magnam earum aspernatur cupiditate dolorum nisi officia commodi.</p>
            </div>
          </div>
        </div>
        <
  </div>

  <div class="box-footer" style="">

      <div class="input-group">
        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
        <span class="input-group-btn">
              <button type="button" class="btn btn-warning btn-flat">Enviar</button>
            </span>
      </div>
    </form>
  </div>

</div>-->
<!-- END - elemento emergente estilo chat -->



<!-- INICIO - elementos emergentes -->
<style>
  /* Center the loader */
  #loader {
    border: 6px solid #f3f3f3;
    border-radius: 50%;
    border-top: 6px solid #3498db;
    width: 30px;
    height: 30px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;

    transition: 2s
  }

  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  /* Add animation to "page content" */
  .animate-bottom {
    position: relative;
    -webkit-animation-name: animatebottom;
    -webkit-animation-duration: 1s;
    animation-name: animatebottom;
    animation-duration: 1s
  }

  @-webkit-keyframes animatebottom {
    from { bottom:-100px; opacity:0 } 
    to { bottom:0px; opacity:1 }
  }

  @keyframes animatebottom { 
    from{ bottom:-100px; opacity:0 } 
    to{ bottom:0; opacity:1 }
  }

  #divBusquedaAvanzada {
    display: none;
  }
</style>
<script>

  function mostrarBusquedaAvanzada() {
      document.getElementById("loader").style.display = "block";
      document.getElementById("btnBusqeudaAvanzada").style.display = "none";
      document.getElementById("label-busqueda-avanzada").style.display = "none";
      setTimeout(showPage, 1500); //timer de medidos en segundos
  }

  function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("divBusquedaAvanzada").style.display = "block";
  }
</script>
<!-- END - elementos emergentes -->

<?php include('../_include/rstfooter.php'); ?>