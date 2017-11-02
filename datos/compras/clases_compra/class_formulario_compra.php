<?php
require_once '../conexion/bd_conexion.php';
class FormularioCompra
{
  private $intIdCompra;
  private $intIdTipoComprobante;
  private $intIdSucursal;
  private $nvchSerie;
  private $nvchNumeracion;
  private $intIdUsuario;
  private $nvchRUC;
  private $nvchRazonSocial;
  private $dtmFechaCreacion;
  private $intIdTipoMoneda;
  private $intIdTipoPago;
  private $bitEstado;

  private $NombreUsuario;
  private $SimboloMoneda;
  private $NombrePago;

  private $nvchObservacion;

  public function IdCompra($intIdCompra){ $this->intIdCompra = $intIdCompra; }
  public function IdTipoComprobante($intIdTipoComprobante){ $this->intIdTipoComprobante = $intIdTipoComprobante; }
  public function IdSucursal($intIdSucursal){ $this->intIdSucursal = $intIdSucursal; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function IdTipoPago($intIdTipoPago){ $this->intIdTipoPago = $intIdTipoPago; }
  public function Estado($bitEstado){ $this->bitEstado = $bitEstado; }

  public function NombreUsuario($NombreUsuario){ $this->NombreUsuario = $NombreUsuario; }
  public function SimboloMoneda($SimboloMoneda){ $this->SimboloMoneda = $SimboloMoneda; }
  public function NombrePago($NombrePago){ $this->NombrePago = $NombrePago; }

  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div id="Formulario" class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nuevo Comprobante de Compra</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Comprobante de Compra</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" id="btn-form-compra-remove" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-compra" method="POST">
          <div class="box-header with-border">
            <h3 class="box-title">Datos del Comprobante</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Tipo de Comprobante:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="tipo-comprobante" name="intIdTipoComprobante"  class="form-control select2">
                  <?php 
                    try{
                    $sql_conexion = new Conexion_BD();
                    $sql_conectar = $sql_conexion->Conectar();
                    $sql_comando = $sql_conectar->prepare('CALL mostrartipocomprobante(:intTipoDetalle)');
                    $sql_comando->execute(array(':intTipoDetalle' => 2));
                    while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                    {
                      echo '<option value="'.$fila['intIdTipoComprobante'].'">'.$fila['nvchNombre'].'</option>';
                    }
                  }catch(PDPExceptions $e){
                    echo $e->getMessage();
                  }?>
                </select>
                <input type="hidden" id="intIdTipoComprobante" value="<?php echo $this->intIdTipoComprobante ?>" />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Sucursal:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="lugar-compra" name="intIdSucursal"  class="form-control select2">
                  <?php 
                    try{
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
                <input type="hidden" id="intIdSucursal" value="<?php echo $this->intIdSucursal ?>" />
                </div>
              </div>
              <script type="text/javascript">AccionNumeracion(5);</script>
              <div id="SerieNumeracionCE">
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Serie:</label>
                    <input type="text" id="nvchSerie" name="nvchSerie" placeholder="Ingresar Serie" class="form-control select2"/>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Numeración:</label>
                    <input type="text" id="nvchNumeracion" name="nvchNumeracion" placeholder="Ingresar Numeración" class="form-control select2"/>
                  </div>
                </div>
              </div>
              <div id="SerieNumeracionGIE">
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Serie:</label>
                    <input type="text" id="nvchSerieGIE" name="nvchSerieGIE" class="form-control select2" readonly/>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Numeración:</label>
                    <input type="text" id="nvchNumeracionGIE" name="nvchNumeracionGIE" class="form-control select2" readonly/>
                  </div>
                </div>
                <?php if($funcion == "F") {?>
                <script>TimerComprobante();</script>
                <?php } ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div id="nvchRUCGroup" class="form-group">
                  <label>RUC:</label>
                  <input type="text" id="nvchRUC" name="nvchRUC" placeholder="Ingrese RUC" class="form-control select2" value="<?php echo $this->nvchRUC; ?>" onkeyup="EsVacioOp('nvchRUC')" maxlength="15" >
                  <span id="nvchRUCIcono" class="" aria-hidden=""></span>
                  <div id="nvchRUCObs" class=""></div>
                </div>
              </div>
              <div class="col-md-3">
                <div id="nvchRazonSocialGroup" class="form-group">
                  <label>Razón Social:</label>
                  <input type="text" id="nvchRazonSocial" name="nvchRazonSocial" class="form-control select2" placeholder="Ingrese Razón Social" 
                  value="<?php echo $this->nvchRazonSocial; ?>" onkeyup="EsVacio('nvchRazonSocial')" maxlength="125" required>
                  <span id="nvchRazonSocialIcono" class="" aria-hidden=""></span>
                  <div id="nvchRazonSocialObs" class=""></div>
                </div>
              </div>
              <div class="col-md-2">
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
                </div>
                <input type="hidden" id="intIdTipoCliente" value="<?php echo $this->intIdTipoCliente; ?>">
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Forma de Pago:</label>
                  <select id="tipo-pago" name="intIdTipoPago" class="form-control select2" >
                    <?php try{
                      $sql_conexion = new Conexion_BD();
                      $sql_conectar = $sql_conexion->Conectar();
                      $sql_comando = $sql_conectar->prepare('CALL mostrartipopago()');
                      $sql_comando->execute();
                      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                      {
                        echo '<option value="'.$fila['intIdTipoPago'].'">'.$fila['nvchNombre'].'</option>';
                      }
                    }catch(PDPExceptions $e){
                      echo $e->getMessage();
                    }?>
                  </select>
                </div>
                <input type="hidden" id="intIdTipoCliente" value="<?php echo $this->intIdTipoCliente; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label>Observación y/o Datos Adicionales (Opcional):</label>
                  <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-compra" rows="6"><?php echo $this->nvchObservacion; ?></textarea>
                </div>
              </div>
            </div>
          </div>
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
              <select id="tipo-busqueda" name="tipo-busqueda"  class="form-control select2" >
                <option value="C">Por Códigos</option>
                <option value="T">Resto de Campos</option>
              </select>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-condensed">
            <thead>
            <tr>
              <th>Código</th>
              <th>Descripción</th>
              <th>Ubicación</th>
              <th>Imágen</th>
              <th>Precio Unit.</th>
              <th>Cantidad</th>
              <th>Total</th>
              <th>Opción</th>
            </tr>
            </thead>
            <tbody id="ListaDeProductosSeleccion">
              <script type="text/javascript">ListarProductosSeleccion(0,5,'F');</script>
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
        <div id="TablaDetalleUbigeo">
          <hr>
          <div class="text-left"><h4>Detalle de la ubicación del Producto: <p id="CodigoProducto"></p></h4></div>
          <div class="table-responsive">
            <table class="table table-hover table-condensed">
              <thead>
              <tr>
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

      <div class="box-header with-border">
      </div>
      <div class="box-header with-border">
        <h3 class="box-title">Productos para Ingresar</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-hover table-condensed">
            <thead>
            <tr>
              <th>Código</th>
              <th>Descripción</th>
              <th>Cantidad</th>
              <th>Precio Unit.</th>
              <th>Total</th>
              <th>Opción</th>
            </tr>
            </thead>
            <tbody id="ListaDeProductosCompra">
            </tbody>
          </table>
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
              <input type="hidden" id="intIdEntrada" name="intIdEntrada" value="<?php echo $this->intIdEntrada; ?>" />
              <input type="hidden" name="dtmFechaCreacion" value="<?php echo $this->dtmFechaCreacion; ?>" />
              <?php if($funcion == "F"){ ?>
              <input type="button" id="btn-crear-compra" class="btn btn-sm btn-info btn-flat pull-left" value="Generar Compra de Productos">
              <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px" required="">
              <?php } ?>
          </div>              
        </form>
        <div id="resultadocrud"></div>
      </div>
<?php
  }
  function MostrarDetalle(){
  ?>
  <div id="Formulario" class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Detalle del Comprobante de Compra: <?php echo $this->nvchSerie.'-'.$this->nvchNumeracion; ?> 
            Fecha: <?php echo date('d/m/Y', strtotime($this->dtmFechaCreacion)); ?> Hora: <?php echo date('H:i:s', strtotime($this->dtmFechaCreacion)); ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" id="btn-form-compra-remove" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
          <div class="box-header with-border">
            <h3 class="box-title">Cliente</h3>
          </div>
          <div class="box-body">
            <div id="DatosDelCliente">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Usuario que Generó:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->NombreUsuario; ?>" readonly>
                </div>
              </div>
              <div class="col-md-3 nvchRUC">
                <div class="form-group">
                  <label>RUC:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->nvchRUC; ?>" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Razón Social/Nombres:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->nvchRazonSocial; ?>" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Tipo de Moneda:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->SimboloMoneda; ?>" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Tipo de Pago:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->NombrePago; ?>" readonly>
                </div>
              </div>
              <input type="hidden" id="intIdTipoEntrada" value="<?php echo $this->intIdTipoEntrada; ?>" />
            </div>
          </div>
          <div class="box-header with-border">
          </div>
          <div class="box-header with-border">
            <h3 class="box-title">Productos</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-hover table-condensed">
                <thead>
                <tr>
                  <th>Ítem</th>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Precio Unit.</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody id="ListaDeProductosCompra">
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label>Observación y/o Datos Adicionales (Opcional):</label>
                  <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-cotizacion" rows="6" readonly="true"><?php echo $this->nvchObservacion; ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer clearfix">
              <input type="hidden" id="intIdCotizacion" name="intIdCotizacion" value="<?php echo $this->intIdCotizacion; ?>" />
              <input type="hidden" name="dtmFechaCreacion" value="<?php echo $this->dtmFechaCreacion; ?>" />
              <input type="button" id="" class="btn btn-sm btn-info btn-flat pull-left" value="Cerrar Detalle">
          </div>              
        <div id="resultadocrud"></div>
      </div>
  <?php 
  }
}
?>