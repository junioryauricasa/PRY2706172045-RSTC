<?php 
require_once '../conexion/bd_conexion.php';
class FormularioOrdenCompra
{
  private $intIdOrdenCompra;
  private $intIdUsuario;
  private $intIdProveedor;
  private $NombreUsuario;
  private $NombreProveedor;
  private $dtmFechaCreacion;

  public function IdOrdenCompra($intIdOrdenCompra){ $this->intIdOrdenCompra = $intIdOrdenCompra; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdProveedor($intIdProveedor){ $this->intIdProveedor = $intIdProveedor; }
  public function NombreUsuario($NombreUsuario){ $this->NombreUsuario = $NombreUsuario; }
  public function NombreProveedor($NombreProveedor){ $this->NombreProveedor = $NombreProveedor; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nuevo Orden de Compra</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Orden de Compra</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-ordencompra" method="POST">
          <div class="box-header with-border">
            <h3 class="box-title">Proveedor</h3>
          </div>
          <?php if($funcion == "F") { ?>
          <div class="box-body">
          <div id="TablaDeProveedores">
            <script>AccionSeleccionProveedores('S');</script>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Ingresar Búsqueda:</label>
                  <input type="text" id="BusquedaProveedor" name="BusquedaProveedor" class="form-control select2" placeholder="Ingresar Búsqueda" required>
                </div>
              </div>
              <!--
              <div class="col-md-3">
                <div class="form-group">
                  <label>Tipo de Persona:</label>
                  <select id="tipo-persona" name="tipo-persona" class="form-control select2">
                    <?php /* try{
                            $sql_conexion = new Conexion_BD();
                            $sql_conectar = $sql_conexion->Conectar();
                            $sql_comando = $sql_conectar->prepare('CALL mostrartipopersona()');
                            $sql_comando->execute();
                            while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                            {
                              echo '<option value="'.$fila['intIdTipoPersona'].'">'.$fila['nvchNombre'].'</option>';
                            }
                          }catch(PDPExceptions $e){
                            echo $e->getMessage();
                          }*/?>
                  </select>
                </div>
              </div>
              -->
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
                  <tbody id="ListaDeProveedoresSeleccion">
                  <?php if($funcion == "F"){ ?>
                    <script type="text/javascript">ListarProveedoresSeleccion(0,5);</script>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <hr>
              <div class="text-center">
                <nav aria-label="...">
                  <ul id="PaginacionDeProveedores" class="pagination">
                    <script>PaginarProveedoresSeleccion(0,5);</script>
                  </ul>
                </nav>
              </div>
          </div>
            <div id="DatosDelProveedor">
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
                  <input type="text" id="nvchRUC" class="form-control select2" placeholder="Ingrese código de inventario" value="" required>
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
                  <input type="text" id="nvchNombres" class="form-control select2" placeholder="Ingrese el precio de venta" value="" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden" id="intIdProveedor" name="intIdProveedor" value="">
                  <input type="button" onclick="AccionSeleccionProveedores('S')" class="btn btn-sm btn-danger btn-flat" value="Cancelar Selección">
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
                    <input type="text" name="NombreUsuario" class="form-control select2" placeholder="Ingrese código del OrdenCompra" value="<?php echo $this->NombreUsuario; ?>" required>
                    <input type="hidden" name="intIdUsuario" value="<?php echo $this->intIdUsuario; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Nombre del Proveedor:</label>
                    <input type="text" name="NombreProveedor" class="form-control select2" placeholder="Ingrese código de inventario" value="<?php echo $this->NombreProveedor; ?>" required>
                    <input type="hidden" name="intIdProveedor" value="<?php echo $this->intIdProveedor; ?>" required>
                  </div>
                </div>
            </div>
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
              <input type="text" id="BusquedaProducto" name="BusquedaProducto" class="form-control select2" placeholder="Ingresar Búsqueda" required>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-condensed">
            <thead>
            <tr>
              <th>Código</th>
              <th>Descripción</th>
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
        <div id="CamposDetalleOrdenCompra">
        <script>CamposDetalleOrdenCompra('C');</script>
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
                <input type="hidden" class="form-control select2" id="intIdOperacionOrdenCompra">
                <input type="button" onclick="ActualizarDetalleOrdenCompra()" id="btn-agregar-detalleordencompra" class="btn btn-sm btn-warning btn-flat" value="Editar Detalle del Orden de Compra">
                <input type="button" onclick="CamposDetalleOrdenCompra('C')" id="btn-cancelar-detalleordencompra" class="btn btn-sm btn-danger btn-flat" value="Cancelar Modificación">
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
              <input type="hidden" id="intIdOrdenCompra" name="intIdOrdenCompra" value="<?php echo $this->intIdOrdenCompra; ?>" />
              <input type="hidden" name="dtmFechaCreacion" value="<?php echo $this->dtmFechaCreacion; ?>" />
              <?php if($funcion == "F"){ ?>
              <input type="submit" id="btn-crear-ordencompra" class="btn btn-sm btn-info btn-flat pull-left" value="Crear OrdenCompra">
              <?php } else if($funcion == "M") { ?>
              <input type="submit" id="btn-editar-ordencompra" class="btn btn-sm btn-info btn-flat pull-left" value="Editar OrdenCompra">
              <?php } ?>
              <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px" required="">
          </div>              
        </form>
        <div id="resultadocrud"></div>
      </div>
<?php
  }
}
?>