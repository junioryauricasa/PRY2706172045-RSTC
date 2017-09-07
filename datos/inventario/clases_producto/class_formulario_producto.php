<?php
require_once '../conexion/bd_conexion.php';
class FormularioProducto
{
  private $intIdProducto;
  private $nvchDescripcion;
  private $nvchUnidadMedida;
  private $intCantidad;
  private $intCantidadMinima;
  private $nvchDireccionImg;
  private $dcmPrecioVenta1;
  private $dcmPrecioVenta2;
  private $dcmPrecioVenta3;
  private $dtmFechaIngreso;

  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function Descripcion($nvchDescripcion){ $this->nvchDescripcion = $nvchDescripcion; }
  public function UnidadMedida($nvchUnidadMedida){ $this->nvchUnidadMedida = $nvchUnidadMedida; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function CantidadMinima($intCantidadMinima){ $this->intCantidadMinima = $intCantidadMinima; }
  public function DireccionImg($nvchDireccionImg){ $this->nvchDireccionImg = $nvchDireccionImg; }
  public function PrecioVenta1($dcmPrecioVenta1){ $this->dcmPrecioVenta1 = $dcmPrecioVenta1; }
  public function PrecioVenta2($dcmPrecioVenta2){ $this->dcmPrecioVenta2 = $dcmPrecioVenta2; }
  public function PrecioVenta3($dcmPrecioVenta3){ $this->dcmPrecioVenta3 = $dcmPrecioVenta3; }
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
                    <label>Descripción:</label>
                    <input type="text" name="nvchDescripcion" class="form-control select2" placeholder="Ingrese la Descripción" value="<?php echo $this->nvchDescripcion; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Unidad de Medida:</label>
                    <input type="text" name="nvchUnidadMedida" class="form-control select2" placeholder="Ingrese Unidad de Medida" value="<?php echo $this->nvchUnidadMedida; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Cantidad Mínima:</label>
                    <input type="text" name="intCantidadMinima" class="form-control select2" placeholder="Ingrese Cantidad Minima" value="<?php echo $this->intCantidadMinima; ?>" required>
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
        <h3 class="box-title">Códigos Adicionales</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Código:</label>
                <input type="text" id="nvchCodigo" class="form-control select2" placeholder="Ingrese Código"/>
              </div>
            </div>
            <?php if($funcion == "M") { ?>
            <div class="col-md-3">
              <div class="form-group">
                <label>Fecha de Inicio:</label>
                <input type="text" id="dtmFechaInicio" class="form-control select2" placeholder="Ingrese Fecha de Inicio"/>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Fecha de Finalización:</label>
                <input type="text" id="dtmFechaFinal" class="form-control select2" placeholder="Ingrese Fecha de Finalización"/>
              </div>
            </div>
            <?php } ?>
            <div class="col-md-3">
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
            <div class="col-md-5">
              <div class="form-group">
              <script type="text/javascript">BotonesCodigo('I');</script>
              <?php if($funcion == "F") { ?>
              <input type="button" id="btn-agregar-codigo" class="form-control select2 btn btn-success" value="Agregar Código" onclick="AgregarCodigo()"/>
              <?php } else if($funcion == "M") { ?>
              <input type="button" id="btn-agregar-codigo" class="form-control select2 btn btn-success" value="Agregar Código" onclick="AgregarCodigo_II()"/>
              <?php } ?>
              <input type="button" onclick="ActualizarCodigo()" id="btn-actualizar-codigo" class="btn btn-sm btn-warning btn-flat" value="Editar Código">
              <input type="button" onclick="BotonesCodigo('I')" id="btn-cancelar-codigo" class="btn btn-sm btn-danger btn-flat" value="Cancelar Modificación">
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-condensed">
              <thead>
              <tr>
                <th>Código</th>
                <?php if($funcion == "M") { ?>
                <th>Fecha Inicio</th>
                <th>Fecha Final</th>
                <?php } ?>
                <th>Tipo</th>
                <th>Opción</th>
              </tr>
              </thead>
              <tbody id="ListaDeCodigos">
              </tbody>
            </table>
          </div>
        </div>
      <div class="box-header with-border">
      </div>
      <div class="box-header with-border">
        <h3 class="box-title">Precios de Venta</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Precio de Venta 1:</label>
                <input type="text" name="dcmPrecioVenta1" class="form-control select2" placeholder="Ingrese el Precio de Venta 1" value="<?php echo $this->dcmPrecioVenta1; ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Precio de Venta 2:</label>
                <input type="text" name="dcmPrecioVenta2" class="form-control select2" placeholder="Ingrese el Precio de Venta 2" value="<?php echo $this->dcmPrecioVenta2; ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Precio de Venta 3:</label>
                <input type="text" name="dcmPrecioVenta3" class="form-control select2" placeholder="Ingrese el Precio de Venta 3" value="<?php echo $this->dcmPrecioVenta3; ?>">
              </div>
            </div>
          </div>
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
                <select id="nvchSucursal" name="nvchSucursal" class="form-control select2">
                  <option value="Huancayo">Huancayo</option>
                  <option value="San Jerónimo">San Jerónimo</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Ubicación en el Almacén:</label>
                <input type="text" id="nvchUbicacion" class="form-control select2" placeholder="Ingrese Ubicacion" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Cantidad:</label>
                <input type="text" id="intCantidadUbigeo" class="form-control select2" placeholder="Ingrese Ubicacion" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
              <script type="text/javascript">BotonesUbigeo('I');</script>
              <?php if($funcion == "F") { ?>
              <input type="button" id="btn-agregar-ubigeo" class="form-control select2 btn btn-success" value="Agregar Ubigeo" onclick="AgregarUbigeo()"/>
              <?php } else if($funcion == "M") { ?>
              <input type="button" id="btn-agregar-ubigeo" class="form-control select2 btn btn-success" value="Agregar Ubigeo" onclick="AgregarUbigeo_II()"/>
              <?php } ?>
              <input type="button" onclick="ActualizarUbigeo()" id="btn-actualizar-ubigeo" class="btn btn-sm btn-warning btn-flat" value="Editar Ubicación">
              <input type="button" onclick="BotonesUbigeo('I')" id="btn-cancelar-ubigeo" class="btn btn-sm btn-danger btn-flat" value="Cancelar Modificación">
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-condensed">
              <thead>
              <tr>
                <th>Sucursal</th>
                <th>Ubicación en el Almacén</th>
                <th>Opción</th>
              </tr>
              </thead>
              <tbody id="ListaDeUbicaciones">
              </tbody>
            </table>
          </div>
          <input type="hidden" id="intIdUbigeoProducto" />
        </div>  
          <div class="box-footer clearfix">
              <?php if($funcion == "F"){ ?>
              <input type="hidden" name="funcion" value="I" />
              <?php } else if($funcion == "M") { ?>
              <input type="hidden" name="funcion" value="A" />
              <?php } ?>
              <input type="hidden" id="intIdProducto" name="intIdProducto" value="<?php echo $this->intIdProducto; ?>" />
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