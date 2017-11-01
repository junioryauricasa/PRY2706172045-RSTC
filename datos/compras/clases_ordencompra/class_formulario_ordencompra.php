<?php 
require_once '../conexion/bd_conexion.php';
class FormularioOrdenCompra
{
  private $intIdOrdenCompra;
  private $nvchSerie;
  private $nvchNumeracion;
  private $nvchRazonSocial;
  private $nvchRUC;
  private $nvchAtencion;
  private $intIdTipoMoneda;
  private $intIdTipoPago;
  private $nvchNombreDe;
  private $intIdUsuario;
  private $intIdDireccionEmpresa;

  private $NombreUsuario;
  private $SimboloMoneda;
  private $NombrePago;

  private $dtmFechaCreacion;
  private $nvchObservacion;
  
  public function IdOrdenCompra($intIdOrdenCompra){ $this->intIdOrdenCompra = $intIdOrdenCompra; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function Atencion($nvchAtencion){ $this->nvchAtencion = $nvchAtencion; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function IdTipoPago($intIdTipoPago){ $this->intIdTipoPago = $intIdTipoPago; }
  public function NombreDe($nvchNombreDe){ $this->nvchNombreDe = $nvchNombreDe; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdDireccionEmpresa($intIdDireccionEmpresa){ $this->intIdDireccionEmpresa = $intIdDireccionEmpresa; }

  public function NombreUsuario($NombreUsuario){ $this->NombreUsuario = $NombreUsuario; }
  public function SimboloMoneda($SimboloMoneda){ $this->SimboloMoneda = $SimboloMoneda; }
  public function NombrePago($NombrePago){ $this->NombrePago = $NombrePago; }

  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div id="Formulario" class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nuevo Orden de Compra</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Orden de Compra</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" id="btn-form-ordencompra-remove" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-ordencompra" method="POST">
          <div class="box-header with-border">
            <h3 class="box-title">Proveedor</h3>
          </div>
          <div class="box-body">
            <div id="DatosDelProveedor">
            <div class="row">
              <div class="col-md-3">
                <div id="nvchRUCGroup" class="form-group">
                  <label>RUC:</label>
                  <input type="text" id="nvchRUC" name="nvchRUC" placeholder="Ingrese RUC" class="form-control select2" value="<?php echo $this->nvchRUC; ?>" onkeyup="EsVacioOp('nvchRUC')" maxlength="125" >
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
              <div class="col-md-3">
                <div id="nvchAtencionGroup" class="form-group">
                  <label>Atención:</label>
                  <input type="text" id="nvchAtencion" name="nvchAtencion" class="form-control select2" placeholder="Ingrese Atención" 
                  value="<?php echo $this->nvchAtencion; ?>" onkeyup="EsVacioOp('nvchAtencion')" maxlength="250" required>
                  <span id="nvchAtencionIcono" class="" aria-hidden=""></span>
                  <div id="nvchAtencionObs" class=""></div>
                </div>
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
                  <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-ordencompra" rows="6"><?php echo $this->nvchObservacion; ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="box-header with-border">
      </div>
      <div class="box-header with-border">
        <h3 class="box-title">Características del Producto</h3>
      </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                <div id="nvchCodigoGroup" class="form-group">
                  <label>Código:</label>
                  <input type="text" id="nvchCodigo" class="form-control select2" placeholder="Ingrese Código" 
                  value="" onkeyup="EsVacio('nvchCodigo')" maxlength="125" required>
                  <span id="nvchCodigoIcono" class="" aria-hidden=""></span>
                  <div id="nvchCodigoObs" class=""></div>
                </div>
              </div>
              <div class="col-md-3">
                <div id="nvchDescripcionGroup" class="form-group">
                  <label>Descripción:</label>
                  <input type="text" id="nvchDescripcion" class="form-control select2" placeholder="Ingrese Descripción" 
                  value="" onkeyup="EsVacio('nvchDescripcion')" maxlength="125" required>
                  <span id="nvchDescripcionIcono" class="" aria-hidden=""></span>
                  <div id="nvchDescripcionObs" class=""></div>
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
              <div id="intCantidadOrdenCompraGroup" class="form-group">
                <label>Cantidad:</label>
                <input type="text" id="intCantidadOrdenCompra" class="form-control select2" 
                placeholder="Ingrese Cantidad" value="" 
                onkeypress="return EsNumeroEnteroTecla(event)" onkeyup="EsNumeroEntero('intCantidadOrdenCompra')" maxlength="11" required>
                <span id="intCantidadOrdenCompraIcono" class="" aria-hidden=""></span>
                <div id="intCantidadOrdenCompraObs" class=""></div>
              </div>
            </div>
            <div class="col-md-2">
              <div id="dcmPrecioOrdenCompraGroup" class="form-group">
                <label>Precio Unitario:</label>
                <input type="text" id="dcmPrecioOrdenCompra" class="form-control select2" 
                placeholder="Ingrese Precio" value="" 
                onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioOrdenCompra')" maxlength="15" required>
                <span id="dcmPrecioOrdenCompraIcono" class="" aria-hidden=""></span>
                <div id="dcmPrecioOrdenCompraObs" class=""></div>
              </div>
            </div>
            <div class="col-md-2">
              <div id="dcmTotalOrdenCompraGroup" class="form-group">
                <label>Total:</label>
                <input type="text" id="dcmTotalOrdenCompra" class="form-control select2"
                value="0.00" maxlength="15" required readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <input type="button" onclick="AgregarProducto()" class="btn btn-sm btn-success btn-flat" value="Agregar Producto">
              </div>
            </div>
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
              <input type="button" id="btn-crear-ordencompra" class="btn btn-sm btn-info btn-flat pull-left" value="Crear OrdenCompra">
              <?php } else if($funcion == "M") { ?>
              <input type="button" id="btn-editar-ordencompra" class="btn btn-sm btn-info btn-flat pull-left" value="Editar OrdenCompra">
              <?php } ?>
              <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px" required="">
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
          <h3 class="box-title">Detalle del Orden de Compra:</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" id="btn-form-ordencompra-remove" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
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
                  <th>Opciones</th>
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
                  <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-ordencompra" rows="6" readonly="true"><?php echo $this->nvchObservacion; ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer clearfix">
              <input type="hidden" id="intIdOrdenCompra" name="intIdOrdenCompra" value="<?php echo $this->intIdOrdenCompra; ?>" />
              <input type="hidden" name="dtmFechaCreacion" value="<?php echo $this->dtmFechaCreacion; ?>" />
              <input type="button" id="" class="btn btn-sm btn-info btn-flat pull-left" value="Cerrar Detalle">
          </div>              
        <div id="resultadocrud"></div>
      </div>
<?php 
  }
} 
?>