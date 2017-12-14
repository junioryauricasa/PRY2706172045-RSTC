<?php
require_once '../conexion/bd_conexion.php';
class FormularioSalida
{
  private $intIdSalida;
  private $dtmFechaCreacion;
  private $intIdCliente;
  private $nvchSerie;
  private $nvchNumeracion;
  private $nvchRazonSocial;
  private $nvchRUC;
  private $nvchAtencion;
  private $nvchDestino;
  private $nvchDireccion;
  private $intTipoPersona;
  private $intIdUsuarioSolicitado;
  private $intIdClienteSolicitado;
  private $intIdUsuario;
  private $intIdSucursal;
  private $intIdTipoMoneda;
  private $bitEstado;
  private $nvchObservacion;

  public function IdSalida($intIdSalida){ $this->intIdSalida = $intIdSalida; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function Atencion($nvchAtencion){ $this->nvchAtencion = $nvchAtencion; }
  public function Destino($nvchDestino){ $this->nvchDestino = $nvchDestino; }
  public function Direccion($nvchDireccion){ $this->nvchDireccion = $nvchDireccion; }
  public function TipoPersona($intTipoPersona){ $this->intTipoPersona = $intTipoPersona; }
  public function IdUsuarioSolicitado($intIdUsuarioSolicitado){ $this->intIdUsuarioSolicitado = $intIdUsuarioSolicitado; }
  public function IdClienteSolicitado($intIdClienteSolicitado){ $this->intIdClienteSolicitado = $intIdClienteSolicitado; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdSucursal($intIdSucursal){ $this->intIdSucursal = $intIdSucursal; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function Estado($bitEstado){ $this->bitEstado = $bitEstado; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div id="Formulario" class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nuevo Comprobante de Salida</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Comprobante de Salida</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" id="btn-form-salida-remove" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-salida" method="POST">
          <div class="box-header with-border">
            <h3 class="box-title">Datos del Comprobante</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Lugar de Salida:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="intIdSucursal" name="intIdSucursal"  class="form-control select2">
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
                <script>$("#intIdSucursal").val(<?php echo $this->intIdSucursal; ?>);</script>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Tipo de Persona:</label>
                  <select id="intTipoPersona" name="intTipoPersona" class="form-control select2">
                    <option value="1">Usuario</option>
                    <option value="2">Cliente</option>
                  </select>
                <script>$("#intIdUsuarioSolicitado").val(<?php echo $this->intIdUsuarioSolicitado; ?>);</script>
                </div>
                <input type="hidden" id="intIdCliente" name="intIdCliente" value="1">
                <input type="hidden" id="intIdClienteSolicitado" name="intIdClienteSolicitado" value="1">
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Usuario que Solicitó:</label>
                  <select id="intIdUsuarioSolicitado" name="intIdUsuarioSolicitado"  class="form-control select2">
                  <?php 
                    try{
                    $sql_conexion = new Conexion_BD();
                    $sql_conectar = $sql_conexion->Conectar();
                    $sql_comando = $sql_conectar->prepare('CALL listarusuarios()');
                    $sql_comando->execute();
                    while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                    {
                      echo '<option value="'.$fila['intIdUsuario'].'">'.$fila['NombreUsuario'].'</option>';
                    }
                  }catch(PDPExceptions $e){
                    echo $e->getMessage();
                  }?>
                  </select>
                <script>$("#intIdUsuarioSolicitado").val(<?php echo $this->intIdUsuarioSolicitado; ?>);</script>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Serie:</label>
                  <input type="text" id="nvchSerie" name="nvchSerie" class="form-control select2" readonly/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Numeración:</label>
                  <input type="text" id="nvchNumeracion" name="nvchNumeracion" class="form-control select2" readonly/>
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
              <div class="col-md-3">
                <div id="nvchAtencionGroup" class="form-group">
                  <label>Atención:</label>
                  <input type="text" id="nvchAtencion" name="nvchAtencion" class="form-control select2" placeholder="Ingrese Atención" 
                  value="<?php echo $this->nvchAtencion; ?>" onkeyup="EsVacio('nvchAtencion')" maxlength="250" required>
                  <span id="nvchAtencionIcono" class="" aria-hidden=""></span>
                  <div id="nvchAtencionObs" class=""></div>
                </div>
              </div>
              <div class="col-md-3">
                <div id="nvchDestinoGroup" class="form-group">
                  <label>Destino:</label>
                  <input type="text" id="nvchDestino" name="nvchDestino" class="form-control select2" placeholder="Ingrese Destino" 
                  value="<?php echo $this->nvchDestino; ?>" onkeyup="EsVacio('nvchDestino')" maxlength="250" required>
                  <span id="nvchDestinoIcono" class="" aria-hidden=""></span>
                  <div id="nvchDestinoObs" class=""></div>
                </div>
              </div>
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
                </div>
                <input type="hidden" id="intIdTipoMoneda" value="<?php echo $this->intIdTipoMoneda; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div id="nvchDireccionGroup" class="form-group">
                  <label>Dirección:</label>
                  <input type="text" id="nvchDireccion" name="nvchDireccion" class="form-control select2" placeholder="Ingrese Dirección" 
                  value="<?php echo $this->nvchDireccion; ?>" onkeyup="EsVacio('nvchDireccion')" maxlength="500" required>
                  <span id="nvchDireccionIcono" class="" aria-hidden=""></span>
                  <div id="nvchDireccionObs" class=""></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label>Observación y/o Datos Adicionales (Opcional):</label>
                  <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-salida" rows="6"><?php echo $this->nvchObservacion; ?></textarea>
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
          <table class="ExcelTable2007 rwd-table" width="100%">
            <thead>
            <tr>
              <!--th class="heading" width="25px">&nbsp;</th-->
              <th class="" width="25px" style="background: #a9c4e9">
                <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
              </th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Ubicación</th>
              <th>Imágen</th>
              <th>Precio Unitario</th>
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
            <table class="ExcelTable2007 rwd-table" width="100%">
              <thead>
              <tr>
                <!--th class="heading" width="25px">&nbsp;</th-->
                <th class="" width="25px" style="background: #a9c4e9">
                  <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                </th>
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
          <table class="ExcelTable2007 rwd-table" width="100%">
            <thead>
            <tr>
              <th class="heading" width="25px">&nbsp;</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Cantidad</th>
              <th>Precio Unitario</th>
              <th>Total</th>
              <th>Opción</th>
            </tr>
            </thead>
            <tbody id="ListaDeProductosSalida">
            </tbody>
          </table>
        </div>
      </div>
          <div class="box-footer clearfix">
              <?php 
                if($funcion == "F"){ 
              ?>
                  <input type="hidden" name="funcion" value="I" />
                  <input type="hidden" id="tipofuncion" name="tipofuncion" value="F" />
                  <?php 
              } else 
                if($funcion == "M") { 
              ?>
                  <input type="hidden" name="funcion" value="A" />
                  <input type="hidden" id="tipofuncion" name="tipofuncion" value="M" />
              <?php 
                  } 
              ?>
                  <input type="hidden" id="intIdVenta" name="intIdVenta" value="<?php echo $this->intIdVenta; ?>" />
                  <input type="hidden" name="dtmFechaCreacion" value="<?php echo $this->dtmFechaCreacion; ?>" />
              <?php 
                  if($funcion == "F"){ 
              ?>
                  <input type="button" id="btn-crear-salida" class="btn btn-sm btn-info btn-flat pull-left" value="Generar Salida de Productos">
                  <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px" required="">
              <?php 
                  } 
              ?>
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
          <h3 class="box-title">Detalle del Comprobante de Salida: <?php echo $this->nvchSerie.'-'.$this->nvchNumeracion; ?> 
            Fecha: <?php echo date('d/m/Y', strtotime($this->dtmFechaCreacion)); ?> Hora: <?php echo date('H:i:s', strtotime($this->dtmFechaCreacion)); ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" id="btn-form-salida-remove" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
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
                  <label>Atención:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->nvchAtencion; ?>" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Destino:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->nvchDestino; ?>" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Dirección:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->nvchDireccion; ?>" readonly>
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
              <table class="ExcelTable2007 rwd-table" width="100%">
                <thead>
                <tr>
                  <!--th class="heading" width="25px">&nbsp;</th-->
                  <th class="" width="25px" style="background: #a9c4e9">
                    <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                  </th>
                  <th>Ítem</th>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Precio Unitario</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody id="ListaDeProductosSalida">
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