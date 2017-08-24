<?php
require_once '../conexion/bd_conexion.php';
class FormularioProducto
{
  private $intIdProducto;
  private $nvchCodigoProducto;
  private $nvchCodigoInventario;
  private $nvchNombre;
  private $nvchDescripcion;
  private $dcmPrecioCompra;
  private $dcmPrecioVenta;
  private $intCantidad;
  private $nvchDescuento;
  private $nvchDireccionImg;
  private $nvchSucursal;
  private $nvchGabinete;
  private $nvchCajon;
  private $dtmFechaIngreso;

  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function CodigoProducto($nvchCodigoProducto){ $this->nvchCodigoProducto = $nvchCodigoProducto; }
  public function CodigoInventario($nvchCodigoInventario){ $this->nvchCodigoInventario = $nvchCodigoInventario; }
  public function Nombre($nvchNombre){ $this->nvchNombre = $nvchNombre; }
  public function Descripcion($nvchDescripcion){ $this->nvchDescripcion = $nvchDescripcion; }
  public function PrecioCompra($dcmPrecioCompra){ $this->dcmPrecioCompra = $dcmPrecioCompra; }
  public function PrecioVenta($dcmPrecioVenta){ $this->dcmPrecioVenta = $dcmPrecioVenta; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function Descuento($nvchDescuento){ $this->nvchDescuento = $nvchDescuento; }
  public function DireccionImg($nvchDireccionImg){ $this->nvchDireccionImg = $nvchDireccionImg; }
  public function Sucursal($nvchSucursal){ $this->nvchSucursal = $nvchSucursal; }
  public function Gabinete($nvchGabinete){ $this->nvchGabinete = $nvchGabinete; }
  public function Cajon($nvchCajon){ $this->nvchCajon = $nvchCajon; }
  public function FechaIngreso($dtmFechaIngreso){ $this->dtmFechaIngreso = $dtmFechaIngreso; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nuevo Producto</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Producto</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-producto" method="POST">
          <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Código del Producto:</label>
                    <input type="text" name="nvchCodigoProducto" class="form-control select2" placeholder="Ingrese código del producto" value="<?php echo $this->nvchCodigoProducto; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Código de Inventario:</label>
                    <input type="text" name="nvchCodigoInventario" class="form-control select2" placeholder="Ingrese código de inventario" value="<?php echo $this->nvchCodigoInventario; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" name="nvchNombre" class="form-control select2" placeholder="Ingrese nombre del producto" value="<?php echo $this->nvchNombre; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Descripción:</label>
                    <input type="text" name="nvchDescripcion" class="form-control select2" placeholder="Ingrese la descripción" value="<?php echo $this->nvchDescripcion; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Precio Compra: S/.</label>
                    <input type="text" name="dcmPrecioCompra" class="form-control select2" placeholder="Ingrese el precio de compra" value="<?php echo $this->dcmPrecioCompra; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Precio Venta: S/.</label>
                    <input type="text" name="dcmPrecioVenta" class="form-control select2" placeholder="Ingrese el precio de venta" value="<?php echo $this->dcmPrecioVenta; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Cantidad:</label>
                    <input type="text" name="intCantidad" class="form-control select2" placeholder="Ingrese la cantidad" value="<?php echo $this->intCantidad; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Descuento:</label>
                    <input type="text" name="nvchDescuento" class="form-control select2" placeholder="Ingrese el descuento" value="<?php echo $this->nvchDescuento; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Imagen:</label>
                    <input type="file" name="SeleccionImagen" id="SeleccionImagen" accept=".png, .jpg, .jpeg">
                    <?php if($funcion == "F"){ ?>
                    <img id="resultadoimagen" src="" style="width: 100px; height: 100px;" />
                    <?php } else if($funcion == "M") { ?>
                    <img id="resultadoimagen" src="<?php echo '../../datos/inventario/imgproducto/'.$this->nvchDireccionImg; ?>" style="width: 100px; height: 100px;" />
                    <?php } ?>
                    <input type="hidden" id="nvchDireccionImg" name="nvchDireccionImg" value="<?php echo $this->nvchDireccionImg; ?>" />
                    <div id="operacionimagen"></div>
                  </div>
                </div>
            </div>
          </div>
      <div class="box-header with-border">
      </div>
      <div class="box-header with-border">
        <h3 class="box-title">Ubigeo</h3>
      </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Sucursal:</label>
                    <input type="text" name="nvchSucursal" class="form-control select2" placeholder="Ingrese la sucursal (Ubigeo)" value="<?php echo $this->nvchSucursal; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Gabinete:</label>
                    <input type="text" name="nvchGabinete" class="form-control select2" placeholder="Ingrese el gabinete (Ubigeo)" value="<?php echo $this->nvchGabinete; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Cajon:</label>
                    <input type="text" name="nvchCajon" class="form-control select2" placeholder="Ingrese el cajón (Ubigeo)" value="<?php echo $this->nvchCajon; ?>" required>
                  </div>
                </div>
            </div>
        </div>  
          <div class="box-footer clearfix">
              <?php if($funcion == "F"){ ?>
              <input type="hidden" name="funcion" value="I" />
              <?php } else if($funcion == "M") { ?>
              <input type="hidden" name="funcion" value="A" />
              <?php } ?>
              <input type="hidden" name="intIdProducto" value="<?php echo $this->intIdProducto; ?>" />
              <input type="hidden" name="dtmFechaIngreso" value="<?php echo $this->dtmFechaIngreso; ?>" />
              <?php if($funcion == "F"){ ?>
              <input type="submit" id="btn-crear-producto" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Producto">
              <?php } else if($funcion == "M") { ?>
              <input type="submit" id="btn-editar-producto" class="btn btn-sm btn-info btn-flat pull-left" value="Editar Producto">
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