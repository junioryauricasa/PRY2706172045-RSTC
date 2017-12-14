<?php 
require_once '../conexion/bd_conexion.php';
class FormularioVenta
{
  private $intIdVenta;
  private $intIdTipoComprobante;
  private $intIdSucursal;
  private $nvchSerie;
  private $nvchNumeracion;
  private $intIdUsuario;
  private $intIdCliente;
  private $dtmFechaCreacion;
  private $intIdTipoMoneda;
  private $intIdTipoPago;
  private $bitEstado;
  private $intIdTipoVenta;

  private $NombreUsuario;
  private $NombreCliente;
  private $DNICliente;
  private $RUCCliente;
  private $SimboloMoneda;
  private $NombrePago;
  private $NombreVenta;

  private $nvchObservacion;

  public function IdVenta($intIdVenta){ $this->intIdVenta = $intIdVenta; }
  public function IdTipoComprobante($intIdTipoComprobante){ $this->intIdTipoComprobante = $intIdTipoComprobante; }
  public function IdSucursal($intIdSucursal){ $this->intIdSucursal = $intIdSucursal; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function IdTipoPago($intIdTipoPago){ $this->intIdTipoPago = $intIdTipoPago; }
  public function Estado($bitEstado){ $this->bitEstado = $bitEstado; }
  public function IdTipoVenta($intIdTipoVenta){ $this->intIdTipoVenta = $intIdTipoVenta; }

  public function NombreUsuario($NombreUsuario){ $this->NombreUsuario = $NombreUsuario; }
  public function NombreCliente($NombreCliente){ $this->NombreCliente = $NombreCliente; }
  public function DNICliente($DNICliente){ $this->DNICliente = $DNICliente; }
  public function RUCCliente($RUCCliente){ $this->RUCCliente = $RUCCliente; }
  public function SimboloMoneda($SimboloMoneda){ $this->SimboloMoneda = $SimboloMoneda; }
  public function NombrePago($NombrePago){ $this->NombrePago = $NombrePago; }
  public function NombreVenta($NombreVenta){ $this->NombreVenta = $NombreVenta; }

  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div id="Formulario" class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nuevo Venta</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Venta</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" id="btn-form-venta-remove" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-venta" method="POST">
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
                    $sql_comando->execute(array(':intTipoDetalle' => 1));
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
                  <label>Lugar de Venta:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="lugar-venta" name="intIdSucursal"  class="form-control select2">
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
            </div>
          </div>
          <div class="box-header with-border">
            <h3 class="box-title">Cliente</h3>
          </div>
          <?php if($funcion == "F") { ?>
          <div class="box-body">
          <div id="TablaDeClientes">
            <script>AccionSeleccionClientes('S');</script>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Ingresar Búsqueda:</label>
                  <input type="text" id="BusquedaCliente" name="BusquedaCliente" class="form-control select2" placeholder="Ingresar Búsqueda">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo Persona:</label>
                  <br>
                  <select id="lista-persona" name="lista-persona"  class="form-control select2">
                    <?php 
                      require_once '../../datos/conexion/bd_conexion.php';
                      try{
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
                    }?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Nuevo Cliente:</label>
                  <br>
                  <a href="../ventas/vcliente" class="btn btn-sm btn-primary btn-flat" target="_blank">+ Agregar</a>
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
                    <th class="ListaDNI">DNI</th>
                    <th class="ListaRUC">RUC</th>
                    <th class="ListaRazonSocial">Razón Social</th>
                    <th class="ListaApellidoPaterno">Apellido Paterno</th>
                    <th class="ListaApellidoMaterno">Apellido Materno</th>
                    <th class="ListaNombres">Nombres</th>
                    <th>Tipo de Cliente</th>
                    <th>Opciones</th>
                  </tr>
                  </thead>
                  <tbody id="ListaDeClientesSeleccion">
                  <?php if($funcion == "F"){ ?>
                    <script type="text/javascript">ListarClientesSeleccion(0,5,1);</script>
                  <?php } ?>
                  </tbody>
                </table>
                <script>AccionCabecerasTabla("1");</script>
              </div>
              <hr>
              <div class="text-center">
                <nav aria-label="...">
                  <ul id="PaginacionDeClientes" class="pagination">
                    <script>PaginarClientesSeleccion(0,5,1);</script>
                  </ul>
                </nav>
              </div>
          </div>
            <div id="DatosDelCliente">
            <div class="row">
              <div class="col-md-3 nvchDNI">
                <div class="form-group">
                  <label>DNI:</label>
                  <input type="text" id="nvchDNI" class="form-control select2" readonly>
                </div>
              </div>
              <div class="col-md-3 nvchRUC">
                <div class="form-group">
                  <label>RUC:</label>
                  <input type="text" id="nvchRUC" class="form-control select2" readonly>
                </div>
              </div>
              <div class="col-md-3 nvchRazonSocial">
                <div class="form-group">
                  <label>Razón Social:</label>
                  <input type="text" id="nvchRazonSocial" class="form-control select2" readonly>
                </div>
              </div>
              <div class="col-md-3 nvchApellidoPaterno">
                <div class="form-group">
                  <label>Apellido Paterno:</label>
                  <input type="text" id="nvchApellidoPaterno" class="form-control select2" readonly>
                </div>
              </div>
              <div class="col-md-3 nvchApellidoMaterno">
                <div class="form-group">
                  <label>Apellido Materno:</label>
                  <input type="text" id="nvchApellidoMaterno" class="form-control select2" readonly>
                </div>
              </div>
              <div class="col-md-3 nvchNombres">
                <div class="form-group">
                  <label>Nombres:</label>
                  <input type="text" id="nvchNombres" class="form-control select2" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Tipo de Cliente:</label>
                  <input type="text" id="TipoCliente" class="form-control select2" readonly>
                  <input type="hidden" id="intIdTipoCliente">
                </div>
              </div>
            </div>
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
                </div>
                <input type="hidden" id="intIdTipoMoneda" value="<?php echo $this->intIdTipoMoneda; ?>">
              </div>
              <div class="col-md-3">
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
                <input type="hidden" id="intIdTipoPago" value="<?php echo $this->intIdTipoPago; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label>Observación y/o Datos Adicionales (Opcional):</label>
                  <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-venta" rows="6"><?php echo $this->nvchObservacion; ?></textarea>
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
          <?php } ?>
      <div class="box-header with-border">
      </div>
      <div class="box-header with-border">
        <h3 class="box-title">Tipo de Venta</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Seleccionar el Tipo de Venta:</label>
                <select id="tipo-venta" name="intIdTipoVenta" onchange="MostrarTipoVenta()" class="form-control select2">
                  <?php try{
                    $sql_conexion = new Conexion_BD();
                    $sql_conectar = $sql_conexion->Conectar();
                    $sql_comando = $sql_conectar->prepare('CALL mostrartipoventa()');
                    $sql_comando->execute();
                    while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                    {
                      echo '<option value="'.$fila['intIdTipoVenta'].'">'.$fila['nvchNombre'].'</option>';
                    }
                  }catch(PDPExceptions $e){
                    echo $e->getMessage();
                  }?>
                </select>
            </div>
            <input type="hidden" id="intIdTipoVenta" value="<?php echo $this->intIdTipoVenta; ?>">
          </div>
        </div>
      </div>
      <script>MostrarTipoVenta();</script>
      <div id="repuestos">
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
              <th>Moneda</th>
              <th>Precio Lista</th>
              <th>Cantidad Total</th>
              <th>Cantidad Local</th>
              <th>Ubicación</th>
              <th>Imágen</th>
              <th>Desc. (%)</th>
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
        <h3 class="box-title">Cotizaciones</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
                <label class="text-left">Ingresar Búsqueda:</label>
                <input type="text" id="BusquedaCotizacion" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
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
              <th>Numeración</th>
              <th>Cliente</th>
              <th>Usuario que Generó</th>
              <th>Fecha de Creación</th>
              <th>Opción</th>
            </tr>
            </thead>
            <tbody id="ListaDeCotizaciones">
              <script type="text/javascript">ListarCotizaciones(0,5);</script>
            </tbody>
          </table>
        </div>
        <hr>
        <div class="text-center">
          <nav aria-label="...">
            <ul id="PaginacionDeCotizaciones" class="pagination">
              <script>PaginarCotizaciones(0,5);</script>
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
          <table class="ExcelTable2007 rwd-table" width="100%">
            <thead>
            <tr>
              <!--th class="heading" width="25px">&nbsp;</th-->
              <th class="" width="25px" style="background: #a9c4e9">
                <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
              </th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Cantidad</th>
              <th>Precio Unit.</th>
              <th>Total</th>
              <th>Opción</th>
            </tr>
            </thead>
            <tbody id="ListaDeProductosComprar">
            </tbody>
          </table>
        </div>
        <div id="CamposDetalleVenta">
        <script>CamposDetalleVenta('C');</script>
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
                <input type="hidden" class="form-control select2" id="intIdOperacionVenta">
                <input type="button" onclick="ActualizarDetalleVenta()" id="btn-agregar-detalleventa" class="btn btn-sm btn-warning btn-flat" value="Editar Detalle del Orden de Compra">
                <input type="button" onclick="CamposDetalleVenta('C')" id="btn-cancelar-detalleventa" class="btn btn-sm btn-danger btn-flat" value="Cancelar Modificación">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="servicios">
        <div class="box-header with-border">
        </div>
        <div class="box-header with-border">
          <h3 class="box-title">Servicios</h3>
        </div>
        <div class="box-body">
          <hr>
          <div class="row">
            <div class="col-md-6">
              <div id="nvchDescripcionServicioGroup" class="form-group">
                <label>Descripción del Servicio:</label>
                <input type="text" id="nvchDescripcionServicio" class="form-control select2" 
                placeholder="Ingrese la Descripción" maxlength="850" 
                onkeyup="EsVacio('nvchDescripcionServicio')">
                <span id="nvchDescripcionServicioIcono" class="" aria-hidden=""></span>
                <div id="nvchDescripcionServicioObs" class=""></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div id="intCantidadServicioGroup" class="form-group">
                <label>Cantidad:</label>
                <input type="text" id="intCantidadServicio" class="form-control select2" 
                placeholder="Ingrese Cantidad"  
                onkeypress="return EsNumeroEnteroTecla(event)" onkeyup="EsNumeroEntero('intCantidadServicio')" maxlength="11">
                <span id="intCantidadServicioIcono" class="" aria-hidden=""></span>
                <div id="intCantidadServicioObs" class=""></div>
              </div>
            </div>
            <div class="col-md-2">
              <div id="dcmPrecioUnitarioServicioGroup" class="form-group">
                <label>Precio Unitario:</label>
                <input type="text" id="dcmPrecioUnitarioServicio" class="form-control select2" 
                placeholder="Ingrese Precio" 
                onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioUnitarioServicio')" maxlength="15">
                <span id="dcmPrecioUnitarioServicioIcono" class="" aria-hidden=""></span>
                <div id="dcmPrecioUnitarioServicioObs" class=""></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <input type="button" onclick="AgregarServicio()" class="btn btn-sm btn-success btn-flat pull-left" value="Agregar Servicio"/>
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
                <th>Cantidad</th>
                <th>Descripción</th>
                <th>Precio Unit.</th>
                <th>Total</th>
                <th>Opción</th>
              </tr>
              </thead>
              <tbody id="ListaDeServiciosComprar">
              </tbody>
            </table>
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
              <input type="hidden" id="intIdVenta" name="intIdVenta" value="<?php echo $this->intIdVenta; ?>" />
              <input type="hidden" name="dtmFechaCreacion" value="<?php echo $this->dtmFechaCreacion; ?>" />
              <?php if($funcion == "F"){ ?>
              <input type="button" id="btn-crear-venta" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Venta">
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
          <h3 class="box-title">Detalle de la Venta: <?php echo $this->nvchSerie.'-'.$this->nvchNumeracion; ?> 
            Fecha: <?php echo date('d/m/Y', strtotime($this->dtmFechaCreacion)); ?> Hora: <?php echo date('H:i:s', strtotime($this->dtmFechaCreacion)); ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" id="btn-form-venta-remove" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
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
              <div class="col-md-3 nvchDNI">
                <div class="form-group">
                  <label>DNI:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->DNICliente ?>" readonly>
                </div>
              </div>
              <div class="col-md-3 nvchRUC">
                <div class="form-group">
                  <label>RUC:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->RUCCliente; ?>" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Razón Social/Nombres:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->NombreCliente; ?>" readonly>
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
              <input type="hidden" id="intIdTipoVenta" value="<?php echo $this->intIdTipoVenta; ?>" />
            </div>
          </div>
          <?php if($this->intIdTipoVenta == 1) {?>
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
                  <th>Precio Unit.</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody id="ListaDeProductosComprar">
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
          <?php } else if($this->intIdTipoVenta == 2) {?>
          <div class="box-header with-border">
          </div>
          <div class="box-header with-border">
            <h3 class="box-title">Servicios</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Tipo:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->nvchTipo; ?>" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Modelo:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->nvchModelo; ?>" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Marca:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->nvchMarca; ?>" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Horómetro:</label>
                  <input type="text" class="form-control select2" value="<?php echo $this->nvchHorometro; ?>" readonly>
                </div>
              </div>
            </div>
            <hr>
            <div class="table-responsive">
              <table class="ExcelTable2007 rwd-table" width="100%">
                <thead>
                <tr>
                  <!--th class="heading" width="25px">&nbsp;</th-->
                  <th class="" width="25px" style="background: #a9c4e9">
                    <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                  </th>
                  <th>Ítem</th>
                  <th>Descripcion</th>
                  <th>Cantidad</th>
                  <th>Precio Unit.</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody id="ListaDeServiciosComprar">
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
          <?php } ?>
          <div class="box-footer clearfix">
              <input type="hidden" id="intIdCotizacion" name="intIdCotizacion" value="<?php echo $this->intIdCotizacion; ?>" />
              <input type="hidden" name="dtmFechaCreacion" value="<?php echo $this->dtmFechaCreacion; ?>" />
              <input type="submit" id="" class="btn btn-sm btn-info btn-flat pull-left" value="Cerrar Detalle">
          </div>              
        <div id="resultadocrud"></div>
      </div>
  <?php 
  }
}
?>