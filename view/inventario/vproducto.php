<?php 
include('../_include/rstheader.php');
require_once '../../datos/conexion/bd_conexion.php';
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
			                <th style="min-width: 50px; max-width: 50px">Código</th>
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
			  		<!--<button type="button" id="btn-form-crear-producto" class="btn btn-sm btn-info btn-flat " onclick="mostrar()">Desplegar Formulario</button>-->
			  		
			  		<div>
        <form id="form-producto" method="POST">
          <div class="box-body">
            <div class="row">
                <!-- datos de Producto -->
                <div class="col-lg-3 col-md-6">
                      <h4 class="box-title text-center">Registro de Nuevo Producto</h4>
                      <h4 class="box-title">Editar Producto</h4>
                    ?>
                    <hr>
                    <div class="col-md-12">
                      <div id="nvchDescripcionGroup" class="form-group">
                        <label>Descripción:</label>
                        <input type="text" id="nvchDescripcion" name="nvchDescripcion" class="form-control select2" 
                        placeholder="Ingrese la Descripción" value="" maxlength="850" 
                        onkeyup="EsVacio('nvchDescripcion')" required>
                        <span id="nvchDescripcionIcono" class="" aria-hidden=""></span>
                        <div id="nvchDescripcionObs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Unidad de Medida:</label>
                        <input type="text" name="nvchUnidadMedida" class="form-control select2" placeholder="Ingrese Unidad de Medida" value="UND" maxlength="20" readonly required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="intCantidadMinimaGroup" class="form-group">
                        <label>Cantidad Mínima:</label>
                        <!-- accept atribute is required for this form -->
                        <input type="text" id="intCantidadMinima" name="intCantidadMinima" class="form-control select2" 
                        placeholder="Ingrese Cantidad Minima" value="" 
                        onkeypress="return EsNumeroEnteroTecla(event)" onkeyup="EsNumeroEntero('intCantidadMinima')" maxlength="11" accept="image/*" required>
                        <span id="intCantidadMinimaIcono" class="" aria-hidden=""></span>
                        <div id="intCantidadMinimaObs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Imagen:</label>
                        <input type="file" name="SeleccionImagen" id="SeleccionImagen" accept=".png, .jpg, .jpeg">
                        <img id="resultadoimagen" src="" style="/*width: 100px;*/ height: 100px;" />
                        <img id="resultadoimagen" src="" class="img-responsive" style="width: 100%; height: 100px;"/>
                        <input type="hidden" id="nvchDireccionImg" name="nvchDireccionImg" value="" />
                        <div id="operacionimagen"></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Observación y/o Datos Adicionales (Opcional):</label>
                        <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-producto" rows="6"></textarea>
                      </div>
                    </div>
                </div>

                <!-- datos Precios de Producto -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="box-title text-center">Precios del Producto</h4>
                    <hr>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Tipo de Moneda:</label>
                        <select id="intIdTipoMonedaCompra" name="intIdTipoMonedaCompra" class="form-control select2" >
                          <?php try{
                            $sql_conexion = new Conexion_BD();
                            $sql_conectar = $sql_conexion->Conectar();
                            $sql_comando = $sql_conectar->prepare('CALL mostrartipomoneda()');
                            $sql_comando->execute();
                            while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                            {
                              echo '<option value="'.$fila['intIdTipoMoneda'].'">'.$fila['nvchNombre'].'</option>';
                            }
                          }catch(PDPExceptions $e){
                            echo $e->getMessage();
                          }?>
                        </select>
                        <script type="text/javascript">$("#intIdTipoMonedaCompra").val();</script>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="dcmPrecioCompraGroup" class="form-group">
                        <label>Precio de Compra:</label>
                        <input type="text" id="dcmPrecioCompra" name="dcmPrecioCompra" class="form-control select2" 
                        placeholder="Precio de Compra" value="" 
                        onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioCompra')" maxlength="15" required>
                        <span id="dcmPrecioCompraIcono" class="" aria-hidden=""></span>
                        <div id="dcmPrecioCompraObs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="dcmPrecioVenta1Group" class="form-group">
                        <label>Precio de Venta 1:</label>
                        <input type="text" id="dcmPrecioVenta1" name="dcmPrecioVenta1" class="form-control select2" 
                        placeholder="Precio de Venta 1" value="" 
                        onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioVenta1')" maxlength="15" required>
                        <span id="dcmPrecioVenta1Icono" class="" aria-hidden=""></span>
                        <div id="dcmPrecioVenta1Obs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="dcmDescuentoVenta2Group" class="form-group">
                        <label>Descuento 2 (%):</label>
                        <input type="text" id="dcmDescuentoVenta2" name="dcmDescuentoVenta2" class="form-control select2" 
                        placeholder="Descuento 2" value="" 
                        onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmDescuentoVenta2')" maxlength="6" required>
                        <span id="dcmDescuentoVenta2Icono" class="" aria-hidden=""></span>
                        <div id="dcmDescuentoVenta2Obs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="dcmPrecioVenta2Group" class="form-group">
                        <label>Precio de Venta 2:</label>
                        <input type="text" id="dcmPrecioVenta2" name="dcmPrecioVenta2" class="form-control select2" 
                        placeholder="Precio de Venta 2" value="" 
                        onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioVenta2')" maxlength="15" readonly required>
                        <span id="dcmPrecioVenta2Icono" class="" aria-hidden=""></span>
                        <div id="dcmPrecioVenta2Obs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="dcmDescuentoVenta3Group" class="form-group">
                        <label>Descuento 3 (%):</label>
                        <input type="text" id="dcmDescuentoVenta3" name="dcmDescuentoVenta3" class="form-control select2" 
                        placeholder="Descuento 3" value="" 
                        onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmDescuentoVenta3')" maxlength="6" required>
                        <span id="dcmDescuentoVenta3Icono" class="" aria-hidden=""></span>
                        <div id="dcmDescuentoVenta3Obs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="dcmPrecioVenta3Group"  class="form-group">
                        <label>Precio de Venta 3:</label>
                        <input type="text" id="dcmPrecioVenta3" name="dcmPrecioVenta3" class="form-control select2" 
                        placeholder="Precio de Venta 3" value="" 
                        onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioVenta3')" maxlength="15" readonly required>
                        <span id="dcmPrecioVenta3Icono" class="" aria-hidden=""></span>
                        <div id="dcmPrecioVenta3Obs" class=""></div>
                      </div>
                    </div>
                    <br>

                    <input type="submit" id="btn-editar-producto" class="btn btn-sm btn-warning btn-flat pull-left" value="Editar Producto">
                    <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
                </div>

                <!-- Datos de codigos adicionales -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="box-title text-center">Códigos Adicionales</h4>
                    <hr>
                    
                    <!-- button for modal codprods -->
                    <button class="btn btn-sm btn-info btn-flat pull-center" id="btn-modal-codigoproductos">Códigos Adicionales</button>
                    <br>
                    <br>
                    <!-- Tabla de codigos por producto -->
                    <div class="table-responsive">
                      <table class="ExcelTable2007 rwd-table" width="100%">
                        <thead>
                        <tr>
                          <th class="heading" width="25px">&nbsp;</th>
                          <th>Código</th>
                          <th>Tipo</th>
                          <th>Opción</th>
                        </tr>
                        </thead>
                        <tbody id="ListaDeCodigos">
                        </tbody>
                      </table>
                    </div>

                    <!-- Modal -->
                    <div class="modal modal-default fade" id="modal-codigoproductos" data-backdrop="static">
                      <div class="modal-dialog" style="width: 350px;">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-book"></i> Registro de Códigos </h4>
                          </div>
                          <div class="modal-body">
                            <div class="box-body table-responsive">
                              <div class="box-body">
                                <div class="row">
                                  <div class="col-xs-12">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div id="nvchCodigoGroup" class="form-group">
                                            <label>Código:</label>
                                            <input type="text" id="nvchCodigo" class="form-control select2" 
                                            placeholder="Ingrese Código" onkeyup="EsVacio('nvchCodigo')"
                                            maxlength="85"/>
                                            <span id="nvchCodigoIcono" class="" aria-hidden=""></span>
                                            <div id="nvchCodigoObs" class=""></div>
                                          </div>
                                        </div>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <label>Tipo de Código:</label>
                                            <select id="tipo-codigo-producto" class="form-control select2" >
                                              <?php try{
                                                $sql_conexion = new Conexion_BD();
                                                $sql_conectar = $sql_conexion->Conectar();
                                                $sql_comando = $sql_conectar->prepare('CALL mostrartipocodigoproducto()');
                                                $sql_comando->execute();
                                                while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                                                {
                                                  echo '<option value="'.$fila['intIdTipoCodigoProducto'].'">'.$fila['nvchNombre'].'</option>';
                                                }
                                              }catch(PDPExceptions $e){
                                                echo $e->getMessage();
                                              }?>
                                            </select>
                                          </div>
                                        </div>
                                        <input type="hidden" id="intIdCodigoProducto" />
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="form-group">
                                          <script type="text/javascript">BotonesCodigo('I');</script>
                                              <input type="button" id="btn-agregar-codigo" class="btn btn-sm btn-success btn-flat pull-left" value="Agregar Código" onclick="AgregarCodigo()" style="width: 120px" />
                                              <input type="button" id="btn-agregar-codigo" class="btn btn-sm btn-success btn-flat pull-left" value="Agregar Código" onclick="AgregarCodigo_II()" style="width: 120px"/>
                                              <input type="button" onclick="ActualizarCodigo()" id="btn-actualizar-codigo" class="btn btn-sm btn-warning btn-flat" value="Editar Código">
                                              <input type="button" onclick="BotonesCodigo('I')" id="btn-cancelar-codigo" class="btn btn-sm btn-danger btn-flat" value="Cancelar Modificación">
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div><!-- /.box-body -->
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- script for modal codproductos -->
                    <script type="text/javascript">
                          $(document).ready(function() {
                            $('#btn-modal-codigoproductos').click(function(){
                                $('#modal-codigoproductos').modal('show');
                            });
                          });
                    </script>


                </div>
            </div>
          </div>
      <div class="box-header with-border">
      </div>

      <div class="box-header with-border">
      </div>
      <div class="box-header with-border">
        <h3 class="box-title">Ubicación del Producto</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Sucursal:</label>
                <select id="intIdSucursal" name="intIdSucursal" class="form-control select2" >
                  <?php try{
                    $sql_conexion = new Conexion_BD();
                    $sql_conectar = $sql_conexion->Conectar();
                    $sql_comando = $sql_conectar->prepare('CALL mostrarsucursal()');
                    $sql_comando->execute();
                    while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                    {
                      echo '<option value="'.$fila['intIdSucursal'].'">'.$fila['nvchNombre'].'</option>';
                    }
                  }catch(PDPExceptions $e){
                    echo $e->getMessage();
                  }?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div id="nvchUbicacionGroup" class="form-group">
                <label>Ubicación en el Almacén:</label>
                <input type="text" id="nvchUbicacion" class="form-control select2" 
                placeholder="Ingrese Ubicacion" onkeyup="EsVacio('nvchUbicacion')" maxlength="45">
                <span id="nvchUbicacionIcono" class="" aria-hidden=""></span>
                <div id="nvchUbicacionObs" class=""></div>
              </div>
            </div>
            <div class="col-md-3">
              <div id="intCantidadUbigeoGroup" class="form-group">
                <label>Cantidad:</label>
                <input type="text" id="intCantidadUbigeo" class="form-control select2" 
                placeholder="Ingrese Cantidad" onkeypress="return EsNumeroEnteroTecla(event)" onkeyup="EsNumeroEntero('intCantidadUbigeo')"
                maxlength="11">
                <span id="intCantidadUbigeoIcono" class="" aria-hidden=""></span>
                <div id="intCantidadUbigeoObs" class=""></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
              <script type="text/javascript">BotonesUbigeo('I');</script>
              <input type="button" id="btn-agregar-ubigeo" class="btn btn-sm btn-success btn-flat pull-left" value="Agregar Ubigeo" onclick="AgregarUbigeo()" style="width: 120px" />
              <input type="button" id="btn-agregar-ubigeo" class="btn btn-sm btn-success btn-flat pull-left" value="Agregar Ubigeo" onclick="AgregarUbigeo_II()" style="width: 120px" />
              <input type="button" onclick="ActualizarUbigeo()" id="btn-actualizar-ubigeo" class="btn btn-sm btn-warning btn-flat" value="Editar Ubicación">
              <input type="button" onclick="BotonesUbigeo('I')" id="btn-cancelar-ubigeo" class="btn btn-sm btn-danger btn-flat" value="Cancelar Modificación">
              </div>
            </div>
          </div>
          <br>
          <div class="table-responsive">
            <table class="ExcelTable2007 rwd-table" width="100%">
              <thead>
              <tr>
                <th class="heading" width="25px">&nbsp;</th>
                <th>Sucursal</th>
                <th>Ubicación en el Almacén</th>
                <th>Cantidad</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <tbody id="ListaDeUbicaciones">
              </tbody>
            </table>
          </div>
          <input type="hidden" id="intIdUbigeoProducto" />
        </div>  
          <div class="box-footer clearfix">
              <input type="hidden" name="funcion" value="I" />
              <input type="hidden" name="funcion" value="A" />
              <input type="hidden" id="intIdProducto" name="intIdProducto" value="" />
              <input type="hidden" name="dtmFechaIngreso" value="" />
              <input type="button" id="btn-crear-producto" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Producto">
              <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
          </div>              
        </form>
        <div id="resultadocrud"></div>
      </div>

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