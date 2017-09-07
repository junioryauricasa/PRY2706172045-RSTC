<?php 
require_once '../conexion/bd_conexion.php';
class FormularioCotizacion
{
  private $intIdCotizacion;
  private $nvchNumeracion;
  private $intIdUsuario;
  private $intIdCliente;
  private $NombreUsuario;
  private $NombreCliente;
  private $dtmFechaCreacion;

  public function IdCotizacion($intIdCotizacion){ $this->intIdCotizacion = $intIdCotizacion; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function NombreUsuario($NombreUsuario){ $this->NombreUsuario = $NombreUsuario; }
  public function NombreCliente($NombreCliente){ $this->NombreCliente = $NombreCliente; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nueva Cotización</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Cotización</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-cotizacion" method="POST">
          <div class="box-header with-border">
            <h3 class="box-title">Cliente</h3>
          </div>
          <?php if($funcion == "F") { ?>
          <div class="box-body">
          <div id="TablaDeClientes">
            <script>AccionSeleccionClientes('S');</script>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Ingresar Búsqueda:</label>
                  <input type="text" id="BusquedaCliente" name="BusquedaCliente" class="form-control select2" placeholder="Ingresar Búsqueda">
                </div>
              </div>
            </div>
              <div class="table-responsive">
                <table class="table table-hover table-condensed">
                  <thead>
                  <tr>
                    <th>RUC/DNI</th>
                    <th>Razón Social/Nombres</th>
                    <th>Tipo de Persona</th>
                    <th>Opción</th>
                  </tr>
                  </thead>
                  <tbody id="ListaDeClientesSeleccion">
                  <?php if($funcion == "F"){ ?>
                    <script type="text/javascript">ListarClientesSeleccion(0,5);</script>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <hr>
              <div class="text-center">
                <nav aria-label="...">
                  <ul id="PaginacionDeClientes" class="pagination">
                    <script>PaginarClientesSeleccion(0,5);</script>
                  </ul>
                </nav>
              </div>
          </div>
            <div id="DatosDelCliente">
            <div class="row">
              <div class="col-md-3 nvchDNI">
                <div class="form-group">
                  <label>DNI:</label>
                  <input type="text" id="nvchDNI" class="form-control select2" placeholder="Ingrese código del producto" value="" required>
                </div>
              </div>
              <div class="col-md-3 nvchRUC">
                <div class="form-group">
                  <label>RUC:</label>
                  <input type="text" id="nvchRUC" class="form-control select2" placeholder="Ingrese código de inCotizacionrio" value="" required>
                </div>
              </div>
              <div class="col-md-3 nvchRazonSocial">
                <div class="form-group">
                  <label>Razón Social:</label>
                  <input type="text" id="nvchRazonSocial" class="form-control select2" placeholder="Ingrese nombre del producto" value="" required>
                </div>
              </div>
              <div class="col-md-3 nvchApellidoPaterno">
                <div class="form-group">
                  <label>Apellido Paterno:</label>
                  <input type="text" id="nvchApellidoPaterno" class="form-control select2" placeholder="Ingrese la descripción" value="" required>
                </div>
              </div>
              <div class="col-md-3 nvchApellidoMaterno">
                <div class="form-group">
                  <label>Apellido Materno:</label>
                  <input type="text" id="nvchApellidoMaterno" class="form-control select2" placeholder="Ingrese el precio de compra" value="" required>
                </div>
              </div>
              <div class="col-md-3 nvchNombres">
                <div class="form-group">
                  <label>Nombres:</label>
                  <input type="text" id="nvchNombres" class="form-control select2" placeholder="Ingrese el precio de Cotizacion" value="" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden" id="intIdCliente" name="intIdCliente" value="">
                  <input type="button" onclick="AccionSeleccionClientes('S')" class="btn btn-sm btn-danger btn-flat" value="Cancelar Selección">
                </div>
              </div>
            </div>
          </div>
          <?php } else if($funcion == "M") { ?>
          <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Nombre del Usuario:</label>
                    <input type="text" name="NombreUsuario" class="form-control select2" placeholder="Ingrese código del Cotizacion" value="<?php echo $this->NombreUsuario; ?>" required>
                    <input type="hidden" name="intIdUsuario" value="<?php echo $this->intIdUsuario; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Nombre del Cliente:</label>
                    <input type="text" name="NombreCliente" class="form-control select2" placeholder="Ingrese código de inCotizacionrio" value="<?php echo $this->NombreCliente; ?>" required>
                    <input type="hidden" name="intIdCliente" value="<?php echo $this->intIdCliente; ?>" required>
                  </div>
                </div>
            </div>
            <?php if($funcion == "M") { ?>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <input type="submit" id="btn-editar-cotizacion" class="btn btn-sm btn-warning btn-flat" value="Editar Cotizacion">
                  <input type="reset" class="btn btn-sm btn-danger btn-flat" value="Limpiar">
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
          <?php } ?>
      <div class="box-header with-border">
      </div>
      <div class="box-header with-border">
        <h3 class="box-title">Productos</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Ingresar Búsqueda:</label>
              <input type="text" id="BusquedaProducto" name="BusquedaProducto" class="form-control select2" placeholder="Ingresar Búsqueda">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tipo de Búsqueda:</label>
              <br>
              <select id="tipo-busqueda" name="tipo-busqueda"  class="form-control select2">
                <option value="T">Resto de Campos</option>
                <option value="C">Por Códigos</option>
              </select>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-condensed">
            <thead>
            <tr>
              <th>Código</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Precio de Venta 1</th>
              <th>Precio de Venta 2</th>
              <th>Precio de Venta 3</th>
              <th>Precio Negociable</th>
              <th>Cantidad</th>
              <th>Opción</th>
            </tr>
            </thead>
            <tbody id="ListaDeProductosSeleccion">
              <?php if($funcion == "F") { ?>
              <script type="text/javascript">ListarProductosSeleccion(0,5,'F');</script>
              <?php } else if($funcion == "M") { ?>
              <script type="text/javascript">ListarProductosSeleccion(0,5,'M');</script>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <hr>
        <div class="text-center">
          <nav aria-label="...">
            <ul id="PaginacionDeProductos" class="pagination">
              <script>PaginarProductosSeleccion(0,5);</script>
            </ul>
          </nav>
        </div>
      </div>
      <div class="box-header with-border">
      </div>
      <div class="box-header with-border">
        <h3 class="box-title">Productos a Comprar</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-hover table-condensed">
            <thead>
            <tr>
              <th>Código</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Precio Negociable</th>
              <th>Cantidad</th>
              <th>Opción</th>
            </tr>
            </thead>
            <tbody id="ListaDeProductosComprar">
            </tbody>
          </table>
        </div>
        <div id="CamposDetalleCotizacion">
        <script>CamposDetalleCotizacion('C');</script>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Nombre del Producto:</label>
                <input type="text" class="form-control select2" id="nvchNombre">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Descripción del Producto:</label>
                <input type="text" class="form-control select2" id="nvchDescripcion">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Precio Negociable:</label>
                <input type="text" class="form-control select2" id="dcmPrecio">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Cantidad:</label>
                <input type="text" class="form-control select2" id="intCantidad">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <input type="hidden" class="form-control select2" id="intIdProducto">
                <input type="hidden" class="form-control select2" id="intIdOperacionCotizacion">
                <input type="button" onclick="ActualizarDetalleCotizacion()" id="btn-agregar-detalleCotizacion" class="btn btn-sm btn-warning btn-flat" value="Editar Detalle del Orden de Compra">
                <input type="button" onclick="CamposDetalleCotizacion('C')" id="btn-cancelar-detalleCotizacion" class="btn btn-sm btn-danger btn-flat" value="Cancelar Modificación">
              </div>
            </div>
          </div>
        </div>
      </div>
          <div class="box-footer clearfix">
              <?php if($funcion == "F"){ ?>
              <input type="hidden" name="funcion" value="I" />
              <input type="hidden" id="tipofuncion" name="tipofuncion" value="F" />
              <?php } else if($funcion == "M") { ?>
              <input type="hidden" name="funcion" value="A" />
              <input type="hidden" id="tipofuncion" name="tipofuncion" value="M" />
              <?php } ?>
              <input type="hidden" id="intIdCotizacion" name="intIdCotizacion" value="<?php echo $this->intIdCotizacion; ?>" />
              <input type="hidden" name="dtmFechaCreacion" value="<?php echo $this->dtmFechaCreacion; ?>" />
              <?php if($funcion == "F"){ ?>
              <input type="submit" id="btn-crear-cotizacion" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Cotizacion">
              <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px" required="">
              <?php } ?>
          </div>              
        </form>
        <div id="resultadocrud"></div>
      </div>
<?php
  }
}
?>