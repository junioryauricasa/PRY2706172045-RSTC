<?php
require_once '../conexion/bd_conexion.php';
class FormularioEntrada
{
  private $intIdEntrada;
  private $dtmFechaCreacion;
  private $nvchSerie;
  private $nvchNumeracion;
  private $nvchRazonSocial;
  private $nvchRUC;
  private $nvchAtencion;
  private $intIdUsuario;
  private $intIdSucursal;
  private $bitEstado;
  private $nvchObservacion;

  public function IdEntrada($intIdEntrada){ $this->intIdEntrada = $intIdEntrada; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function Atencion($nvchAtencion){ $this->nvchAtencion = $nvchAtencion; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdSucursal($intIdSucursal){ $this->intIdSucursal = $intIdSucursal; }
  public function Estado($bitEstado){ $this->bitEstado = $bitEstado; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div id="Formulario" class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nuevo Comprobante de Entrada</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Comprobante de Entrada</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" id="btn-form-entrada-remove" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-entrada" method="POST">
          <div class="box-header with-border">
            <h3 class="box-title">Datos del Comprobante</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Lugar de Entrada:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="lugar-entrada" name="intIdSucursal"  class="form-control select2">
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
                  <input type="text" id="nvchRazonSocial" name="nvchRazonSocial" class="form-control select2" placeholder="Ingrese Atención" 
                  value="<?php echo $this->nvchRazonSocial; ?>" onkeyup="EsVacio('nvchRazonSocial')" maxlength="125" required>
                  <span id="nvchRazonSocialIcono" class="" aria-hidden=""></span>
                  <div id="nvchRazonSocialObs" class=""></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label>Observación y/o Datos Adicionales (Opcional):</label>
                  <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-entrada" rows="6"><?php echo $this->nvchObservacion; ?></textarea>
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
              <th>Cantidad</th>
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
              <th>Cantidad</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Opción</th>
            </tr>
            </thead>
            <tbody id="ListaDeProductosEntrada">
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
              <input type="hidden" id="intIdVenta" name="intIdVenta" value="<?php echo $this->intIdVenta; ?>" />
              <input type="hidden" name="dtmFechaCreacion" value="<?php echo $this->dtmFechaCreacion; ?>" />
              <?php if($funcion == "F"){ ?>
              <input type="button" id="btn-crear-entrada" class="btn btn-sm btn-info btn-flat pull-left" value="Generar Entrada de Productos">
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
          <h3 class="box-title">Detalle del Comprobante de Entrada: <?php echo $this->nvchSerie.'-'.$this->nvchNumeracion; ?> 
            Fecha: <?php echo date('d/m/Y', strtotime($this->dtmFechaCreacion)); ?> Hora: <?php echo date('H:i:s', strtotime($this->dtmFechaCreacion)); ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" id="btn-form-entrada-remove" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
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
              <input type="hidden" id="intIdTipoVenta" value="<?php echo $this->intIdTipoVenta; ?>" />
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
                  <th>Cantidad</th>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="ListaDeProductosEntrada">
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