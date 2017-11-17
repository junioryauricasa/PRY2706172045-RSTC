<?php 
include('../_include/rstheader.php');
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
    <!--<script type="text/javascript" src="../../negocio/inventario/nproducto.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/inventario/ncodigoproducto.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/inventario/nubigeoproducto.js"></script>-->
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
    <!-- Main content -->
    <section class="content" style="margin-top: -20px">
	      <div class="nav-tabs-custom">
	     
		    <ul class="nav nav-tabs">
		      <li class="active" id="li_show_table_products">
		      	<a href="#tab_1" data-toggle="tab" aria-expanded="true" id="show_table_products">
		      		Productos
		      	</a>
		      </li>
		      <li class="" onclick="ver_formulario()" id="li_ver_editar_formulario">
		      	<a href="#tab_2" data-toggle="tab" aria-expanded="false" id="ver_editar_formulario">
		      		Agregar Producto
		      	</a>
		      </li>
		    </ul>

		    <div class="tab-content">
		      <div class="tab-pane active" id="tab_1">
			    <section class="content-header">
			      <h1>
			        Registro de Productos
			        <small>Módulo de Inventario</small>
			      </h1>
			      <ol class="breadcrumb">
			        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			        <li><a href="#">Layout</a></li>
			        <li class="active">Fixed</li>
			      </ol>
			    </section>
			    <!-- Main content -->
			    <section class="content">
			      <!-- TABLE: LATEST USERS -->
			      <div class="">
			        <div class="box-body">
			          <div class="row">
			            <div class="col-md-2">
			              <div class="form-group">
			                <label>Mostrar:</label>
			                <br>
			                <select id="num-lista" name="num-lista"  class="form-control select2" >
			                  <option value="10">Ver 10 Resultados</option>
			                  <option value="25">Ver 25 Resultados</option>
			                  <option value="50">Ver 50 Resultados</option>
			                  <option value="100">Ver 100 Resultados</option>
			                </select>
			              </div>
			            </div>
			            <div class="col-md-2">
			              <div class="form-group">
			                <label class="text-left">Ingresar Búsqueda:</label>
			                <input type="text" name="txt-busqueda" id="txt-busqueda" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
			              </div>
			            </div>
			            <div class="col-md-2">
			              <div class="form-group">
			                <label>Tipo de Búsqueda:</label>
			                <br>
			                <select id="tipo-busqueda" name="tipo-busqueda"  class="form-control select2" >
			                  <option value="C">Por Códigos</option>
			                  <option value="T">Resto de Campos</option>
			                </select>
			              </div>
			            </div>
			          </div>
			          <div class="table-responsive">
			            <table class="rwd-table ExcelTable2007" width="100%">
			              <thead>
			              <tr>
			                <th class="heading" width="25px">&nbsp;</th>
			                <th style="width: 50px">Código</th>
			                <th>Descripción</th>
			                <th>Tipo de Moneda</th>
			                <th>Precio de Venta 1</th>
			                <th>Precio de Venta 2</th>
			                <th>Precio de Venta 3</th>
			                <th>Cant. Total</th>
			                <th>Ubicación</th>
			                <th>Imágen</th>
			                <th>Opciones</th>
			              </tr>
			              </thead>
			              <tbody id="ListaDeProductos">
			                <script>ListarProducto(0,10,"T");</script>
			              </tbody>
			            </table>
			          </div>
			          <br>
			          <div class="text-center">
			            <nav aria-label="...">
			              <ul id="PaginacionDeProductos" class="pagination">
			                <script>PaginarProducto(0,10,"T");</script>
			              </ul>
			            </nav>
			          </div>
			          <div id="TablaDetalleUbigeo">
			          <hr>
			            <div class="text-left"><h4>Detalle de la ubicación del Producto: <p id="CodigoProducto"></p></h4></div>
			            <div class="table-responsive">
			              <table class="rwd-table ExcelTable2007" width="100%">
			                <thead>
			                  <tr>
			                    <th class="heading" style="width: 25px">&nbsp;</th>
			                    <th>Sucursal</th>
			                    <th>Ubicación en el Almacén</th>
			                    <th>Cantidad</th>
			                  </tr>
			                </thead>
			                <tbody id="DetalleUbigeo">
			                </tbody>
			              </table>
			            </div>
			          </div>
			        </div>
			        <div class="box-footer clearfix">
			          <div class="row">
			            <div class="col-md-5">  
			              <button type="button" class="btn btn-sm btn-info btn-flat" onclick="ver_formulario()">Agregar Producto</button>
			              <button type="button" onclick="LimpiarDetalleUbigeo()" class="btn btn-sm btn-success btn-flat">Limpiar Detalle de Ubicación</button>
			            </div>
			          </div>
			        </div>
			      </div>
			    </section>
		      </div>

		      <!-- /.tab-pane -->
		      <div class="tab-pane" id="tab_2">
			  		<button type="button" id="btn-form-crear-producto" class="btn btn-sm btn-info btn-flat " onclick="mostrar()">Desplegar Formulario</button>
			  		
			  		<style>
			  			.esconder{
			  				display: none;
			  			}
			  		</style>
			  		<script>
			  			function mostrar(){
			  				$("button#btn-form-crear-producto").toggleClass("esconder");
			  			}

			  			function ver_formulario(){
			  				$("li#li_show_table_products").removeClass("active");
			  				$("a#show_table_products").attr("aria-expanded","false");
			  				$("#tab_1").removeClass("active");

			  				$("li#li_ver_editar_formulario").addClass("active");
			  				$("a#ver_editar_formulario").attr("aria-expanded","true");
			  				$("#tab_2").addClass("active");	
			  			}
			  		</script>
					
					<!-- Formulario CRUD nuevo producto -->
					<div id="formulario-crud"></div>
					<!-- mostrando resultados  -->
			      	<div id="resultadocrud"></div>
		      </div>
		    </div>
		    <!-- /.tab-content -->
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

  <!-- EN`D Scripts DataTable -->
  <style>
    input{
      padding: 2px 3px;
    }
    select{
      padding: 3px;
    }
  </style>

<?php include('../_include/rstfooter.php'); ?>