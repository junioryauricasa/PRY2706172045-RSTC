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
  private $dcmPrecioCompra;
  private $intIdTipoMonedaCompra;
  private $dcmPrecioVenta1;
  private $dcmPrecioVenta2;
  private $dcmPrecioVenta3;
  private $dcmDescuentoVenta2;
  private $dcmDescuentoVenta3;
  private $intIdTipoMonedaVenta;
  private $dtmFechaIngreso;
  private $nvchObservacion;

  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function Descripcion($nvchDescripcion){ $this->nvchDescripcion = $nvchDescripcion; }
  public function UnidadMedida($nvchUnidadMedida){ $this->nvchUnidadMedida = $nvchUnidadMedida; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function CantidadMinima($intCantidadMinima){ $this->intCantidadMinima = $intCantidadMinima; }
  public function DireccionImg($nvchDireccionImg){ $this->nvchDireccionImg = $nvchDireccionImg; }
  public function PrecioCompra($dcmPrecioCompra){ $this->dcmPrecioCompra = $dcmPrecioCompra; }
  public function IdTipoMonedaCompra($intIdTipoMonedaCompra){ $this->intIdTipoMonedaCompra = $intIdTipoMonedaCompra; }
  public function PrecioVenta1($dcmPrecioVenta1){ $this->dcmPrecioVenta1 = $dcmPrecioVenta1; }
  public function PrecioVenta2($dcmPrecioVenta2){ $this->dcmPrecioVenta2 = $dcmPrecioVenta2; }
  public function PrecioVenta3($dcmPrecioVenta3){ $this->dcmPrecioVenta3 = $dcmPrecioVenta3; }
  public function DescuentoVenta2($dcmDescuentoVenta2){ $this->dcmDescuentoVenta2 = $dcmDescuentoVenta2; }
  public function DescuentoVenta3($dcmDescuentoVenta3){ $this->dcmDescuentoVenta3 = $dcmDescuentoVenta3; }
  public function IdTipoMonedaVenta($intIdTipoMonedaVenta){ $this->intIdTipoMonedaVenta = $intIdTipoMonedaVenta; }
  public function FechaIngreso($dtmFechaIngreso){ $this->dtmFechaIngreso = $dtmFechaIngreso; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }

  function ConsultarFormulario($funcion)
  {
  ?>
      <!--div id="Formulario" class="box box-default"-->
      <div>
        <form id="form-producto" method="POST">
          <div class="box-body">
            <div class="row">
                <!-- datos de Producto -->
                <div class="col-lg-3 col-md-6">
                    <?php 
                      if($funcion == "F"){ 
                    ?>
                      <h4 class="box-title text-center">Registro de Nuevo Producto</h4>
                    <?php 
                      } else 
                      if($funcion == "M") {
                        ?>
                      <h4 class="box-title">Editar Producto</h4>
                    <?php 
                      } 
                    ?>
                    <hr>
                    <div class="col-md-12">
                      <div id="nvchDescripcionGroup" class="form-group">
                        <label>Descripción:</label>
                        <input type="text" id="nvchDescripcion" name="nvchDescripcion" class="form-control select2" 
                        placeholder="Ingrese la Descripción" value="<?php echo $this->nvchDescripcion; ?>" maxlength="850" 
                        onkeyup="EsVacio('nvchDescripcion')" required>
                        <span id="nvchDescripcionIcono" class="" aria-hidden=""></span>
                        <div id="nvchDescripcionObs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Unidad de Medida:</label>
                        <input type="text" name="nvchUnidadMedida" class="form-control select2" placeholder="Ingrese Unidad de Medida" value="UND" maxlength="20" readonly required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="intCantidadMinimaGroup" class="form-group">
                        <label>Cantidad Mínima:</label>
                        <!-- accept atribute is required for this form -->
                        <input type="text" id="intCantidadMinima" name="intCantidadMinima" class="form-control select2" 
                        placeholder="Ingrese Cantidad Minima" value="<?php echo $this->intCantidadMinima; ?>" 
                        onkeypress="return EsNumeroEnteroTecla(event)" onkeyup="EsNumeroEntero('intCantidadMinima')" maxlength="11" accept="image/*" required>
                        <span id="intCantidadMinimaIcono" class="" aria-hidden=""></span>
                        <div id="intCantidadMinimaObs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Imagen:</label>
                        <input type="file" name="SeleccionImagen" id="SeleccionImagen" accept=".png, .jpg, .jpeg">
                        <?php if($funcion == "F"){ ?>
                        <img id="resultadoimagen" src="" style="/*width: 100px;*/ height: 100px;" />
                        <?php } else if($funcion == "M") { ?>
                        <img id="resultadoimagen" src="<?php echo '../../datos/inventario/imgproducto/'.$this->nvchDireccionImg; ?>" class="img-responsive" style="width: 100%; height: 100px;"/>
                        <?php } ?>
                        <input type="hidden" id="nvchDireccionImg" name="nvchDireccionImg" value="<?php echo $this->nvchDireccionImg; ?>" />
                        <div id="operacionimagen"></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Observación y/o Datos Adicionales (Opcional):</label>
                        <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-producto" rows="6"><?php echo $this->nvchObservacion; ?></textarea>
                      </div>
                    </div>
                </div>

                <!-- datos Precios de Producto -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="box-title text-center">Precios del Producto</h4>
                    <hr>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Tipo de Moneda:</label>
                        <select id="intIdTipoMonedaCompra" name="intIdTipoMonedaCompra" class="form-control select2" >
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
                        <script type="text/javascript">$("#intIdTipoMonedaCompra").val(<?php echo $this->intIdTipoMonedaCompra; ?>);</script>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="dcmPrecioCompraGroup" class="form-group">
                        <label>Precio de Compra:</label>
                        <input type="text" id="dcmPrecioCompra" name="dcmPrecioCompra" class="form-control select2" 
                        placeholder="Precio de Compra" value="<?php echo $this->dcmPrecioCompra; ?>" 
                        onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioCompra')" maxlength="15" required>
                        <span id="dcmPrecioCompraIcono" class="" aria-hidden=""></span>
                        <div id="dcmPrecioCompraObs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="dcmPrecioVenta1Group" class="form-group">
                        <label>Precio de Venta 1:</label>
                        <input type="text" id="dcmPrecioVenta1" name="dcmPrecioVenta1" class="form-control select2" 
                        placeholder="Precio de Venta 1" value="<?php echo $this->dcmPrecioVenta1; ?>" 
                        onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioVenta1')" maxlength="15" required>
                        <span id="dcmPrecioVenta1Icono" class="" aria-hidden=""></span>
                        <div id="dcmPrecioVenta1Obs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="dcmDescuentoVenta2Group" class="form-group">
                        <label>Descuento 2 (%):</label>
                        <input type="text" id="dcmDescuentoVenta2" name="dcmDescuentoVenta2" class="form-control select2" 
                        placeholder="Descuento 2" value="<?php if($funcion == "F") { echo "7"; } else if($funcion == "M") { echo $this->dcmDescuentoVenta2; } ?>" 
                        onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmDescuentoVenta2')" maxlength="6" required>
                        <span id="dcmDescuentoVenta2Icono" class="" aria-hidden=""></span>
                        <div id="dcmDescuentoVenta2Obs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="dcmPrecioVenta2Group" class="form-group">
                        <label>Precio de Venta 2:</label>
                        <input type="text" id="dcmPrecioVenta2" name="dcmPrecioVenta2" class="form-control select2" 
                        placeholder="Precio de Venta 2" value="<?php echo $this->dcmPrecioVenta2; ?>" 
                        onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioVenta2')" maxlength="15" readonly required>
                        <span id="dcmPrecioVenta2Icono" class="" aria-hidden=""></span>
                        <div id="dcmPrecioVenta2Obs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="dcmDescuentoVenta3Group" class="form-group">
                        <label>Descuento 3 (%):</label>
                        <input type="text" id="dcmDescuentoVenta3" name="dcmDescuentoVenta3" class="form-control select2" 
                        placeholder="Descuento 3" value="<?php if($funcion == "F") { echo "15"; } else if($funcion == "M") { echo $this->dcmDescuentoVenta3; } ?>" 
                        onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmDescuentoVenta3')" maxlength="6" required>
                        <span id="dcmDescuentoVenta3Icono" class="" aria-hidden=""></span>
                        <div id="dcmDescuentoVenta3Obs" class=""></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div id="dcmPrecioVenta3Group"  class="form-group">
                        <label>Precio de Venta 3:</label>
                        <input type="text" id="dcmPrecioVenta3" name="dcmPrecioVenta3" class="form-control select2" 
                        placeholder="Precio de Venta 3" value="<?php echo $this->dcmPrecioVenta3; ?>" 
                        onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioVenta3')" maxlength="15" readonly required>
                        <span id="dcmPrecioVenta3Icono" class="" aria-hidden=""></span>
                        <div id="dcmPrecioVenta3Obs" class=""></div>
                      </div>
                    </div>
                    <br>
                    <?php if($funcion == "M") { ?>
                    <input type="submit" id="btn-editar-producto" class="btn btn-sm btn-warning btn-flat pull-left" value="Editar Producto">
                    <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
                    <?php } ?>
                </div>

                <!-- Datos de codigos adicionales -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="box-title text-center">Códigos Adicionales</h4>
                    <hr>
                    
                    <!-- button for modal codprods -->
                    <button class="btn btn-sm btn-info btn-flat pull-center" id="btn-modal-codigoproductos">Códigos Adicionales</button>
                    <br>
                    <br>
                    <!-- Tabla de codigos por producto -->
                    <div class="table-responsive">
                      <table class="ExcelTable2007 rwd-table" width="100%">
                        <thead>
                        <tr>
                          <th class="heading" width="25px">&nbsp;</th>
                          <th>Código</th>
                          <th>Tipo</th>
                          <th>Opción</th>
                        </tr>
                        </thead>
                        <tbody id="ListaDeCodigos">
                        </tbody>
                      </table>
                    </div>

                    <!-- Modal -->
                    <div class="modal modal-default fade" id="modal-codigoproductos" data-backdrop="static">
                      <div class="modal-dialog" style="width: 350px;">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-book"></i> Registro de Códigos </h4>
                          </div>
                          <div class="modal-body">
                            <div class="box-body table-responsive">
                              <div class="box-body">
                                <div class="row">
                                  <div class="col-xs-12">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div id="nvchCodigoGroup" class="form-group">
                                            <label>Código:</label>
                                            <input type="text" id="nvchCodigo" class="form-control select2" 
                                            placeholder="Ingrese Código" onkeyup="EsVacio('nvchCodigo')"
                                            maxlength="85"/>
                                            <span id="nvchCodigoIcono" class="" aria-hidden=""></span>
                                            <div id="nvchCodigoObs" class=""></div>
                                          </div>
                                        </div>
                                        <div class="col-md-12">
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
                                        <div class="col-md-12">
                                          <div class="form-group">
                                          <script type="text/javascript">BotonesCodigo('I');</script>
                                          <?php 
                                              if($funcion == "F"){ 
                                          ?>
                                              <input type="button" id="btn-agregar-codigo" class="btn btn-sm btn-success btn-flat pull-left" value="Agregar Código" onclick="AgregarCodigo()" style="width: 120px" />
                                          <?php 
                                              } else 
                                              if($funcion == "M"){ 
                                          ?>
                                              <input type="button" id="btn-agregar-codigo" class="btn btn-sm btn-success btn-flat pull-left" value="Agregar Código" onclick="AgregarCodigo_II()" style="width: 120px"/>
                                          <?php 
                                            } 
                                          ?>
                                              <input type="button" onclick="ActualizarCodigo()" id="btn-actualizar-codigo" class="btn btn-sm btn-warning btn-flat" value="Editar Código">
                                              <input type="button" onclick="BotonesCodigo('I')" id="btn-cancelar-codigo" class="btn btn-sm btn-danger btn-flat" value="Cancelar Modificación">
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div><!-- /.box-body -->
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- script for modal codproductos -->
                    <script type="text/javascript">
                          $(document).ready(function() {
                            $('#btn-modal-codigoproductos').click(function(){
                                $('#modal-codigoproductos').modal('show');
                            });
                          });
                    </script>


                </div>
            </div>
          </div>
      <div class="box-header with-border">
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
              <input type="button" id="btn-agregar-ubigeo" class="btn btn-sm btn-success btn-flat pull-left" value="Agregar Ubigeo" onclick="AgregarUbigeo()" style="width: 120px" />
              <?php } else if($funcion == "M") { ?>
              <input type="button" id="btn-agregar-ubigeo" class="btn btn-sm btn-success btn-flat pull-left" value="Agregar Ubigeo" onclick="AgregarUbigeo_II()" style="width: 120px" />
              <?php } ?>
              <input type="button" onclick="ActualizarUbigeo()" id="btn-actualizar-ubigeo" class="btn btn-sm btn-warning btn-flat" value="Editar Ubicación">
              <input type="button" onclick="BotonesUbigeo('I')" id="btn-cancelar-ubigeo" class="btn btn-sm btn-danger btn-flat" value="Cancelar Modificación">
              </div>
            </div>
          </div>
          <br>
          <div class="table-responsive">
            <table class="ExcelTable2007 rwd-table" width="100%">
              <thead>
              <tr>
                <th class="heading" width="25px">&nbsp;</th>
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
              <input type="button" id="btn-crear-producto" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Producto">
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

