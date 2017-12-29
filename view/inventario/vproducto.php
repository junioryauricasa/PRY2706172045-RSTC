<?php 
    
    $nvbr_inicio = '';
    $nvbr_infogeneral = '';
    // inventario
    $nvbr_inventario = 'active';
    $nvbr_inventario_registroproducto = 'active';
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
    <?php require_once '../../negocio/inventario/ncodigoproducto.php'; ?>
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
		      		Lista de Productos
		      	</a>
		      </li>
		      <li id="li_ver_editar_formulario">
		      	<a href="#tab_2" data-toggle="tab" aria-expanded="false" id="btnFormProducto">
		      		Formulario Producto
		      	</a>
		      </li>
		    </ul>

		    <div class="tab-content">
		      <div class="tab-pane active" id="tab_1">
              <section class="content-header">
    			      <h1 style="">
    			        Registro de Productos
    			        <small>Módulo de Inventario</small>
    			      </h1>                  
    			    </section>
    			    <!-- Main content -->
    			    <section class="content">
                <div class="row pull-right" style="">
                    <!-- Modal for New Product -->
                    <button type="button" style="margin-left: 5px" class="btn btn-sm btn-info btn-flat pull-right" onclick="limpiarformProducto();botonesRegistrar(); $('#btnFormProducto').click()"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Nuevo Producto</button>
                    <!-- button para descarga de excel -->
                    <a href="#" style="margin-left: 5px" class="btn btn-sm btn-success btn-flat pull-right" id="DescargarListaProductoExcel"><i class="fa fa-download" aria-hidden="true"></i> Descargar Excel</a>

                    <!-- button para descarga de excel -->
                    <a href="#" style="margin-left: 5px" class="btn btn-sm btn-danger btn-flat pull-right" id="DescargarListaProductoPDF"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar PDF</a>
                </div>

    			      <!-- TABLE: LATEST USERS -->
    			      <div class="">
    			        <div class="box-body">
    			          <div class="row">
                      <?php include '../campos/cmbNumLista.php'; ?>
    			            <div class="col-md-4">
    			              <div class="form-group">
    			                <label class="text-left">Ingresar Búsqueda:</label>
    			                <input type="text" name="txt-busqueda" id="txt-busqueda" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
    			              </div>
    			            </div>
    			            <div id="divBusquedaAvanzada">
                        <div id="" class="col-md-2">
      			              <div class="form-group">
      			                <label>Tipo de Búsqueda:</label>
      			                <br>
      			                <select id="tipo-busqueda" name="tipo-busqueda"  class="form-control select2" >
      			                  <option value="C">Por Códigos</option>
      			                  <!--<option value="T">Resto de Campos</option>-->
      			                </select>
      			              </div>
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

                      <script type="text/javascript">
                        $("#tipo-busquedaCol").hide();
                      </script>
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
    			                <th style="width: 150px">Moneda</th>
    			                <th style="width: 125px">Precio Venta 1</th>
    			                <th style="width: 125px">Precio Venta 2</th>
    			                <th style="width: 125px">Precio Venta 3</th>
    			                <th style="width: 90px">Cant. Total</th>
    			                <th style="width: 80px">Ubicación</th>
    			                <th style="width: 70px">Imágen</th>
    			                <th style="width: 100px; text-align:center">Opciones</th>
    			              </tr>
    			              </thead>
    			              <tbody id="ListaDeProductos">
    			                <script>ListarProducto(0,10,"T");</script>
    			              </tbody>
    			            </table>
    			          </div>
    			          <div class="text-center">
    			            <nav aria-label="...">
    			              <ul id="PaginacionDeProductos" class="pagination">
    			                <script>PaginarProducto(0,10,"T");</script>
    			              </ul>
    			            </nav>
    			          </div>
    			        </div>
    			        <div class="box-footer clearfix">
    			          <!--
                    <div class="row">
    			            
                      <div class="col-md-5">

                        <button type="button" class="btn btn-sm btn-info btn-flat" onclick="limpiarformProducto();botonesRegistrar(); $('#btnFormProducto').click()"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Nuevo Producto</button>

                        <a href="#" class="btn btn-sm btn-success btn-flat" id="DescargarListaProductoExcel"><i class="fa fa-download" aria-hidden="true"></i> Descargar Excel</a>

                        <a href="#" class="btn btn-sm btn-danger btn-flat" id="DescargarListaProductoPDF"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar PDF</a>
    			            
                      </div>
    			          </div>
                  -->
    			        </div>
    			      </div>
    			    </section>
		      </div>
          <div class="tab-pane" id="tab_2">
              <?php include 'formularios/registroProducto.php'; ?>
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