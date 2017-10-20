<?php
require_once '../conexion/bd_conexion.php';
class FormularioKardex
{
  private $intIdMovimiento;
  private $dtmFechaMovimiento;
  private $intIdComprobante;
  private $intIdTipoComprobante;
  private $intTipoDetalle;
  private $nvchSerie;
  private $nvchNumeracion;
  private $intIdProducto;
  private $intCantidadEntrada;
  private $dcmPrecioUnitarioEntrada;
  private $dcmTotalEntrada;
  private $intCantidadSalida;
  private $dcmPrecioUnitarioSalida;
  private $dcmTotalSalida;
  private $intCantidadExistencia;
  private $dcmPrecioUnitarioExistencia;
  private $dcmTotalExistencia;
  
  public function IdMovimiento($intIdMovimiento){ $this->intIdMovimiento = $intIdMovimiento; }
  public function FechaMovimiento($dtmFechaMovimiento){ $this->dtmFechaMovimiento = $dtmFechaMovimiento; }
  public function IdComprobante($intIdComprobante){ $this->intIdComprobante = $intIdComprobante; }
  public function IdTipoComprobante($intIdTipoComprobante){ $this->intIdTipoComprobante = $intIdTipoComprobante; }
  public function TipoDetalle($intTipoDetalle){ $this->intTipoDetalle = $intTipoDetalle; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function CantidadEntrada($intCantidadEntrada){ $this->intCantidadEntrada = $intCantidadEntrada; }
  public function PrecioUnitarioEntrada($dcmPrecioUnitarioEntrada){ $this->dcmPrecioUnitarioEntrada = $dcmPrecioUnitarioEntrada; }
  public function TotalEntrada($dcmTotalEntrada){ $this->dcmTotalEntrada = $dcmTotalEntrada; }
  public function CantidadSalida($intCantidadSalida){ $this->intCantidadSalida = $intCantidadSalida; }
  public function PrecioUnitarioSalida($dcmPrecioUnitarioSalida){ $this->dcmPrecioUnitarioSalida = $dcmPrecioUnitarioSalida; }
  public function TotalSalida($dcmTotalSalida){ $this->dcmTotalSalida = $dcmTotalSalida; }
  public function CantidadExistencia($intCantidadExistencia){ $this->intCantidadExistencia = $intCantidadExistencia; }
  public function PrecioUnitarioExistencia($dcmPrecioUnitarioExistencia){ $this->dcmPrecioUnitarioExistencia = $dcmPrecioUnitarioExistencia; }
  public function TotalExistencia($dcmTotalExistencia){ $this->dcmTotalExistencia = $dcmTotalExistencia; }

  function ConsultarFormulario($funcion)
  {
  ?>
      <div id="Formulario" class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nuevo Kardex</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Kardex</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button id="btn-form-kardex-remove" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-kardex" method="POST">
          <div class="box-body">
            <div class="row">
                <div class="col-md-5">
                  <div id="nvchDescripcionGroup" class="form-group">
                    <label>Descripción:</label>
                    <input type="text" id="nvchDescripcion" name="nvchDescripcion" class="form-control select2" 
                    placeholder="Ingrese la Descripción" value="<?php echo $this->nvchDescripcion; ?>" maxlength="850" 
                    onkeyup="EsVacio('nvchDescripcion')" required>
                    <span id="nvchDescripcionIcono" class="" aria-hidden=""></span>
                    <div id="nvchDescripcionObs" class=""></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Unidad de Medida:</label>
                    <input type="text" name="nvchUnidadMedida" class="form-control select2" placeholder="Ingrese Unidad de Medida" value="UND" maxlength="20" readonly required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div id="intCantidadMinimaGroup" class="form-group">
                    <label>Cantidad Mínima:</label>
                    <input type="text" id="intCantidadMinima" name="intCantidadMinima" class="form-control select2" 
                    placeholder="Ingrese Cantidad Minima" value="<?php echo $this->intCantidadMinima; ?>" 
                    onkeypress="return EsNumeroEnteroTecla(event)" onkeyup="EsNumeroEntero('intCantidadMinima')" maxlength="11" required>
                    <span id="intCantidadMinimaIcono" class="" aria-hidden=""></span>
                    <div id="intCantidadMinimaObs" class=""></div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Imagen:</label>
                    <input type="file" name="SeleccionImagen" id="SeleccionImagen" accept=".png, .jpg, .jpeg">
                    <?php if($funcion == "F"){ ?>
                    <img id="resultadoimagen" src="" style="width: 100px; height: 100px;" />
                    <?php } else if($funcion == "M") { ?>
                    <img id="resultadoimagen" src="<?php echo '../../datos/inventario/imgKardex/'.$this->nvchDireccionImg; ?>" style="width: 100px; height: 100px;" />
                    <?php } ?>
                    <input type="hidden" id="nvchDireccionImg" name="nvchDireccionImg" value="<?php echo $this->nvchDireccionImg; ?>" />
                    <div id="operacionimagen"></div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label>Observación y/o Datos Adicionales (Opcional):</label>
                    <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-kardex" rows="6"><?php echo $this->nvchObservacion; ?></textarea>
                  </div>
                </div>
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
                <label>Tipo de Moneda:</label>
                <select id="tipo-moneda" name="intIdTipoMoneda" class="form-control select2" >
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
                <input type="hidden" id="intIdTipoMoneda" value="<?php echo $this->intIdTipoMoneda; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <div id="dcmPrecioVenta1Group" class="form-group">
                <label>Precio de Venta 1:</label>
                <input type="text" id="dcmPrecioVenta1" name="dcmPrecioVenta1" class="form-control select2" 
                placeholder="Precio de Venta 1" value="<?php echo $this->dcmPrecioVenta1; ?>" 
                onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioVenta1')" maxlength="15" required>
                <span id="dcmPrecioVenta1Icono" class="" aria-hidden=""></span>
                <div id="dcmPrecioVenta1Obs" class=""></div>
              </div>
            </div>
            <div class="col-md-2">
              <div id="dcmPrecioVenta2Group" class="form-group">
                <label>Precio de Venta 2:</label>
                <input type="text" id="dcmPrecioVenta2" name="dcmPrecioVenta2" class="form-control select2" 
                placeholder="Precio de Venta 2" value="<?php echo $this->dcmPrecioVenta2; ?>" 
                onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioVenta2')" maxlength="15" readonly required>
                <span id="dcmPrecioVenta2Icono" class="" aria-hidden=""></span>
                <div id="dcmPrecioVenta2Obs" class=""></div>
              </div>
            </div>
            <div class="col-md-2">
              <div id="dcmDescuentoVenta2Group" class="form-group">
                <label>Descuento 2 (%):</label>
                <input type="text" id="dcmDescuentoVenta2" name="dcmDescuentoVenta2" class="form-control select2" 
                placeholder="Descuento 2" value="<?php if($funcion == "F") { echo "7"; } else if($funcion == "M") { echo $this->dcmDescuentoVenta2; } ?>" 
                onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmDescuentoVenta2')" maxlength="6" required>
                <span id="dcmDescuentoVenta2Icono" class="" aria-hidden=""></span>
                <div id="dcmDescuentoVenta2Obs" class=""></div>
              </div>
            </div>
            <div class="col-md-2">
              <div id="dcmPrecioVenta3Group"  class="form-group">
                <label>Precio de Venta 3:</label>
                <input type="text" id="dcmPrecioVenta3" name="dcmPrecioVenta3" class="form-control select2" 
                placeholder="Precio de Venta 3" value="<?php echo $this->dcmPrecioVenta3; ?>" 
                onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioVenta3')" maxlength="15" readonly required>
                <span id="dcmPrecioVenta3Icono" class="" aria-hidden=""></span>
                <div id="dcmPrecioVenta3Obs" class=""></div>
              </div>
            </div>
            <div class="col-md-2">
              <div id="dcmDescuentoVenta3Group" class="form-group">
                <label>Descuento 3 (%):</label>
                <input type="text" id="dcmDescuentoVenta3" name="dcmDescuentoVenta3" class="form-control select2" 
                placeholder="Descuento 3" value="<?php if($funcion == "F") { echo "15"; } else if($funcion == "M") { echo $this->dcmDescuentoVenta3; } ?>" 
                onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmDescuentoVenta3')" maxlength="6" required>
                <span id="dcmDescuentoVenta3Icono" class="" aria-hidden=""></span>
                <div id="dcmDescuentoVenta3Obs" class=""></div>
              </div>
            </div>
          </div>
          <?php if($funcion == "M") { ?>
          <input type="submit" id="btn-editar-kardex" class="btn btn-sm btn-warning btn-flat pull-left" value="Editar Kardex">
          <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
          <?php } ?>
      </div>
      <div class="box-header with-border">
      </div>
      <div class="box-header with-border">
        <h3 class="box-title">Códigos Adicionales</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
              <div id="nvchCodigoGroup" class="form-group">
                <label>Código:</label>
                <input type="text" id="nvchCodigo" class="form-control select2" 
                placeholder="Ingrese Código" onkeyup="EsVacio('nvchCodigo')"
                maxlength="85"/>
                <span id="nvchCodigoIcono" class="" aria-hidden=""></span>
                <div id="nvchCodigoObs" class=""></div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tipo de Código:</label>
                <select id="tipo-codigo-kardex" class="form-control select2" >
                  <?php try{
                    $sql_conexion = new Conexion_BD();
                    $sql_conectar = $sql_conexion->Conectar();
                    $sql_comando = $sql_conectar->prepare('CALL mostrartipocodigoKardex()');
                    $sql_comando->execute();
                    while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                    {
                      echo '<option value="'.$fila['intIdTipoCodigoKardex'].'">'.$fila['nvchNombre'].'</option>';
                    }
                  }catch(PDPExceptions $e){
                    echo $e->getMessage();
                  }?>
                </select>
              </div>
            </div>
            <input type="hidden" id="intIdCodigoKardex" />
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
        <h3 class="box-title">Ubicación del Kardex</h3>
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
                <th>Cantidad</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <tbody id="ListaDeUbicaciones">
              </tbody>
            </table>
          </div>
          <input type="hidden" id="intIdUbigeoKardex" />
        </div>  
          <div class="box-footer clearfix">
              <?php if($funcion == "F"){ ?>
              <input type="hidden" name="funcion" value="I" />
              <?php } else if($funcion == "M") { ?>
              <input type="hidden" name="funcion" value="A" />
              <?php } ?>
              <input type="hidden" id="intIdKardex" name="intIdKardex" value="<?php echo $this->intIdKardex; ?>" />
              <input type="hidden" name="dtmFechaIngreso" value="<?php echo $this->dtmFechaIngreso; ?>" />
              <?php if($funcion == "F"){ ?>
              <input type="button" id="btn-crear-kardex" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Kardex">
              <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
              <?php } ?>
          </div>              
        </form>
        <div id="resultadocrud"></div>
      </div>
<?php
  }
}
?>