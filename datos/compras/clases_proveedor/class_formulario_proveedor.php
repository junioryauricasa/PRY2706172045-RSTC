<?php
require_once '../conexion/bd_conexion.php';
class FormularioProveedor
{
  private $intIdProveedor;
  private $nvchDNI;
  private $nvchRUC;
  private $nvchRazonSocial;
  private $nvchApellidoPaterno;
  private $nvchApellidoMaterno;
  private $nvchNombres;
  private $intIdTipoPersona;

  public function IdProveedor($intIdProveedor){ $this->intIdProveedor = $intIdProveedor; }
  public function DNI($nvchDNI){ $this->nvchDNI = $nvchDNI; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function ApellidoPaterno($nvchApellidoPaterno){ $this->nvchApellidoPaterno = $nvchApellidoPaterno; }
  public function ApellidoMaterno($nvchApellidoMaterno){ $this->nvchApellidoMaterno = $nvchApellidoMaterno; }
  public function Nombres($nvchNombres){ $this->nvchNombres = $nvchNombres; }
  public function IdTipoPersona($intIdTipoPersona){ $this->intIdTipoPersona = $intIdTipoPersona; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nuevo Proveedor</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Proveedor</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-proveedor" method="POST">
          <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Tipo de Persona:</label>
                    <select onchange="MostrarTipoPersona()" id="tipo-persona" name="intIdTipoPersona" class="form-control select2" >
                      <?php try{
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
                <input type="hidden" id="intIdTipoPersona" value="<?php echo $this->intIdTipoPersona; ?>">
                </div>
            </div>
            <div class="row">
            <script>MostrarTipoPersona();</script>
                <div class="col-md-3 nvchDNI">
                  <div class="form-group">
                    <label>DNI:</label>
                    <input type="text" name="nvchDNI" class="form-control select2" placeholder="Ingrese código del producto" value="<?php echo $this->nvchDNI; ?>" required>
                  </div>
                </div>
                <div class="col-md-3 nvchRUC">
                  <div class="form-group">
                    <label>RUC:</label>
                    <input type="text" name="nvchRUC" class="form-control select2" placeholder="Ingrese código de inventario" value="<?php echo $this->nvchRUC; ?>" required>
                  </div>
                </div>
                <div class="col-md-3 nvchRazonSocial">
                  <div class="form-group">
                    <label>Razón Social:</label>
                    <input type="text" name="nvchRazonSocial" class="form-control select2" placeholder="Ingrese nombre del producto" value="<?php echo $this->nvchRazonSocial; ?>" required>
                  </div>
                </div>
                <div class="col-md-3 nvchApellidoPaterno">
                  <div class="form-group">
                    <label>Apellido Paterno:</label>
                    <input type="text" name="nvchApellidoPaterno" class="form-control select2" placeholder="Ingrese la descripción" value="<?php echo $this->nvchApellidoPaterno; ?>" required>
                  </div>
                </div>
                <div class="col-md-3 nvchApellidoMaterno">
                  <div class="form-group">
                    <label>Apellido Materno:</label>
                    <input type="text" name="nvchApellidoMaterno" class="form-control select2" placeholder="Ingrese el precio de compra" value="<?php echo $this->nvchApellidoMaterno; ?>" required>
                  </div>
                </div>
                <div class="col-md-3 nvchNombres">
                  <div class="form-group">
                    <label>Nombres:</label>
                    <input type="text" name="nvchNombres" class="form-control select2" placeholder="Ingrese el precio de venta" value="<?php echo $this->nvchNombres; ?>" required>
                  </div>
                </div>
            </div>
            <?php if($funcion == "M") { ?>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <input type="submit" id="btn-editar-proveedor" class="btn btn-sm btn-warning btn-flat" value="Editar Proveedor"> 
                  <input type="reset" class="btn btn-sm btn-danger btn-flat" value="Limpiar" required="">
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        <div class="box-header with-border">
        </div>
        <div class="box-header with-border">
          <h3 class="box-title">Domicilio</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>País:</label>
                    <input type="text" name="Pais" id="nvchPais" class="form-control select2" placeholder="Ingrese el País" value="" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Región:</label>
                    <input type="text" name="Region" id="nvchRegion" class="form-control select2" placeholder="Ingrese Región" value="" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Provincia:</label>
                    <input type="text" name="Provincia" id="nvchProvincia" class="form-control select2" placeholder="Ingrese Provincia" value="" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Distrito:</label>
                    <input type="text" name="Distrito" id="nvchDistrito" class="form-control select2" placeholder="Ingrese Distrito" value="" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Direccion:</label>
                    <input type="text" name="Direccion" id="nvchDireccion" class="form-control select2" placeholder="Ingrese Dirección" value="" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Tipo de Domicilio:</label>
                    <select id="tipo-domicilio" name="tipo-domicilio"  class="form-control select2" >
                      <?php try{
                        $sql_conexion = new Conexion_BD();
                        $sql_conectar = $sql_conexion->Conectar();
                        $sql_comando = $sql_conectar->prepare('CALL mostrartipodomicilio()');
                        $sql_comando->execute();
                        while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                        {
                          echo'<option value="'.$fila['intIdTipoDomicilio'].'">'.$fila['nvchNombre'].'</option>';
                        }
                      }catch(PDPExceptions $e){
                        echo $e->getMessage();
                      }?>
                    </select>
                  </div>
                  <input type="hidden" name="IdDomicilioProveedor" id="intIdDomicilioProveedor" value="" />
                </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <script type="text/javascript">BotonesDomicilio('I');</script>
                  <?php if($funcion == "F"){ ?>
                  <input type="button" onclick="AgregarDomicilio()" id="btn-agregar-domicilio" name="btn-agregar-domicilio" class="btn btn-sm btn-success btn-flat" value="Agregar Domicilio">
                  <?php } else if($funcion == "M") { ?>
                  <input type="button" onclick="AgregarDomicilio_II()" id="btn-agregar-domicilio" name="btn-agregar-domicilio" class="btn btn-sm btn-success btn-flat" value="Agregar Domicilio">
                  <?php } ?>
                  <input type="button" onclick="ActualizarDomicilio()" id="btn-actualizar-domicilio" name="btn-actualizar-domicilio" class="btn btn-sm btn-warning btn-flat" value="Editar Domicilio">
                    <input type="button" onclick="BotonesDomicilio('I')" id="btn-cancelar-domicilio" name="btn-cancelar-domicilio" class="btn btn-sm btn-danger btn-flat" value="Cancelar Modificación">
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover table-condensed">
                <thead>
                <tr>
                  <th>País</th>
                  <th>Región</th>
                  <th>Provincia</th>
                  <th>Distrito</th>
                  <th>Dirección</th>
                  <th>Tipo de Domicilio</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="ListaDeDomicilios">
                </tbody>
              </table>
            </div>
        </div>
         <div class="box-header with-border">
            </div>
            <div class="box-header with-border">
              <h3 class="box-title">Comunicación</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Medio:</label>
                    <input type="text" name="Medio" id="nvchMedio" class="form-control select2" placeholder="Ingrese Medio" value="" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Lugar/Pertenencia:</label>
                    <input type="text" name="Lugar" id="nvchLugar" class="form-control select2" placeholder="Ingrese Lugar/Pertenencia" value="" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Tipo de Comunicación:</label>
                    <select id="tipo-comunicacion" name="tipo-comunicacion"  class="form-control select2" >
                      <?php try{
                        $sql_conexion = new Conexion_BD();
                        $sql_conectar = $sql_conexion->Conectar();
                        $sql_comando = $sql_conectar->prepare('CALL mostrartipocomunicacion()');
                        $sql_comando->execute();
                        while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                        {
                          echo'<option value="'.$fila['intIdTipoComunicacion'].'">'.$fila['nvchNombre'].'</option>';
                        }
                      }catch(PDPExceptions $e){
                        echo $e->getMessage();
                      }?>
                    </select>
                  </div>
                  <input type="hidden" name="IdComunicacionProveedor" id="intIdComunicacionProveedor" value="" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <script type="text/javascript">BotonesComunicacion('I');</script>
                    <?php if($funcion == "F"){ ?>
                    <input type="button" onclick="AgregarComunicacion()" id="btn-agregar-comunicacion" name="btn-agregar-comunicacion" class="btn btn-sm btn-success btn-flat" value="Agregar Comunicación">
                    <?php } else if($funcion == "M") { ?>
                    <input type="button" onclick="AgregarComunicacion_II()" id="btn-agregar-comunicacion" name="btn-agregar-comunicacion" class="btn btn-sm btn-success btn-flat" value="Agregar Comunicación">
                    <?php } ?>
                    <input type="button" onclick="ActualizarComunicacion()" id="btn-actualizar-comunicacion" name="btn-actualizar-comunicacion" class="btn btn-sm btn-warning btn-flat" value="Editar Comunicación">
                    <input type="button" onclick="BotonesComunicacion('I')" id="btn-cancelar-comunicacion" name="btn-cancelar-comunicacion" class="btn btn-sm btn-danger btn-flat" value="Cancelar Modificación">
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-hover table-condensed">
                  <thead>
                  <tr>
                    <th>Medio</th>
                    <th>Lugar</th>
                    <th>Tipo de Comunicación</th>
                    <th>Opciones</th>
                  </tr>
                  </thead>
                  <tbody id="ListaDeComunicaciones">
                  </tbody>
                </table>
              </div>
            </div>
        <div class="box-footer clearfix">
            <?php if($funcion == "F"){ ?>
            <input type="hidden" name="funcion" value="I" />
            <?php } else if($funcion == "M") { ?>
            <input type="hidden" name="funcion" value="A" />
            <?php } ?>
            <input type="hidden" name="intIdProveedor" id="intIdProveedor" value="<?php echo $this->intIdProveedor; ?>" />
            <?php if($funcion == "F"){ ?>
            <input type="submit" id="btn-crear-proveedor" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Proveedor">
            <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px" required="">
            <?php } ?>
        </div>              
        </form>
        <div id="resultadocrud"></div>
      </div>
<?php
  }
}
?>