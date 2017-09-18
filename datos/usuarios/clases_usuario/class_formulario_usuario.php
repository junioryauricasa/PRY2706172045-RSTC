<?php
require_once '../conexion/bd_conexion.php';
class FormularioUsuario
{
  private $intIdUsuario;
  private $nvchDNI;
  private $nvchRUC;
  private $nvchApellidoPaterno;
  private $nvchApellidoMaterno;
  private $nvchNombres;
  private $nvchGenero;
  private $nvchUserName;
  private $nvchUserPassword;
  private $intIdTipoUsuario;
  private $nvchImgPerfil;
  private $bitUserEstado;
  private $nvchPais;
  private $nvchRegion;
  private $nvchProvincia;
  private $nvchDistrito;
  private $nvchDireccion;
  private $nvchObservacion;

  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function DNI($nvchDNI){ $this->nvchDNI = $nvchDNI; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function ApellidoPaterno($nvchApellidoPaterno){ $this->nvchApellidoPaterno = $nvchApellidoPaterno; }
  public function ApellidoMaterno($nvchApellidoMaterno){ $this->nvchApellidoMaterno = $nvchApellidoMaterno; }
  public function Nombres($nvchNombres){ $this->nvchNombres = $nvchNombres; }
  public function Genero($nvchGenero){ $this->nvchGenero = $nvchGenero; }
  public function UserName($nvchUserName){ $this->nvchUserName = $nvchUserName; }
  public function UserPassword($nvchUserPassword){ $this->nvchUserPassword = $nvchUserPassword; }
  public function IdTipoUsuario($intIdTipoUsuario){ $this->intIdTipoUsuario = $intIdTipoUsuario; }
  public function ImgPerfil($nvchImgPerfil){$this->nvchImgPerfil = $nvchImgPerfil; }
  public function bitUserEstado($bitUserEstado){ $this->bitUserEstado = $bitUserEstado; }
  public function Pais($nvchPais){ $this->nvchPais = $nvchPais; }
  public function Region($nvchRegion){ $this->nvchRegion = $nvchRegion; }
  public function Provincia($nvchProvincia){ $this->nvchProvincia = $nvchProvincia; }
  public function Distrito($nvchDistrito){ $this->nvchDistrito = $nvchDistrito; }
  public function Direccion($nvchDireccion){ $this->nvchDireccion = $nvchDireccion; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div id="Formulario" class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nuevo Usuario</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Usuario</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" id="btn-form-usuario-remove" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-usuario" method="POST">
          <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                  <div id="nvchDNIGroup" class="form-group">
                    <label>DNI:</label>
                    <input type="text" id="nvchDNI" name="nvchDNI" class="form-control select2" placeholder="Ingrese DNI" 
                    value="<?php echo $this->nvchDNI; ?>" onkeypress="return EsNumeroEnteroTecla(event)" 
                    onkeyup="EsNumeroEntero('nvchDNI')" maxlength="8" required>
                    <span id="nvchDNIIcono" class="" aria-hidden=""></span>
                    <div id="nvchDNIObs" class=""></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div id="nvchRUCGroup" class="form-group">
                    <label>RUC (Opcional):</label>
                    <input type="text" id="nvchRUC" name="nvchRUC" class="form-control select2" placeholder="Ingrese RUC" 
                    value="<?php echo $this->nvchRUC; ?>" onkeypress="return EsNumeroEnteroTecla(event)" 
                    onkeyup="EsNumeroEntero('nvchRUC')" maxlength="11" required>
                    <span id="nvchRUCIcono" class="" aria-hidden=""></span>
                    <div id="nvchRUCObs" class=""></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div id="nvchApellidoPaternoGroup" class="form-group">
                    <label>Apellido Paterno:</label>
                    <input type="text" id="nvchApellidoPaterno" name="nvchApellidoPaterno" class="form-control select2" 
                    placeholder="Ingrese Apellido Paterno" value="<?php echo $this->nvchApellidoPaterno; ?>" 
                    onkeyup="EsVacio('nvchApellidoPaterno')" maxlength="120" required>
                    <span id="nvchApellidoPaternoIcono" class="" aria-hidden=""></span>
                    <div id="nvchApellidoPaternoObs" class=""></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div id="nvchApellidoMaternoGroup" class="form-group">
                    <label>Apellido Materno:</label>
                    <input type="text" id="nvchApellidoMaterno" name="nvchApellidoMaterno" class="form-control select2" 
                    placeholder="Ingrese Apellido Materno" value="<?php echo $this->nvchApellidoMaterno; ?>" 
                    onkeyup="EsVacio('nvchApellidoMaterno')" maxlength="120" required>
                    <span id="nvchApellidoMaternoIcono" class="" aria-hidden=""></span>
                    <div id="nvchApellidoMaternoObs" class=""></div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                  <div id="nvchNombresGroup" class="form-group">
                    <label>Nombres:</label>
                    <input type="text" id="nvchNombres" name="nvchNombres" class="form-control select2" 
                    placeholder="Ingrese los Nombres" value="<?php echo $this->nvchNombres; ?>" 
                    onkeyup="EsVacio('nvchNombres')" maxlength="250" required>
                    <span id="nvchNombresIcono" class="" aria-hidden=""></span>
                    <div id="nvchNombresObs" class=""></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Género:</label>
                    <select id="nvchGenero" name="nvchGenero" class="form-control select2">
                      <option value="Masculino">Masculino</option>
                      <option value="Femenino">Femenino</option>
                    </select>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                  <div id="nvchUserNameGroup" class="form-group">
                    <label>Nombre de Usuario:</label>
                    <input type="text" id="nvchUserName" name="nvchUserName" class="form-control select2" 
                    placeholder="Ingrese los Nombres" value="<?php echo $this->nvchUserName; ?>" 
                    onkeyup="EsVacio('nvchUserName')" maxlength="250" required>
                    <span id="nvchUserNameIcono" class="" aria-hidden=""></span>
                    <div id="nvchUserNameObs" class=""></div>
                  </div>
                </div>
                <div id="nvchUserPasswordGroup" class="col-md-3">
                  <div class="form-group">
                    <label>Contraseña de Usuario:</label>
                    <input type="text" id="nvchUserPassword" name="nvchUserPassword" class="form-control select2" 
                    placeholder="Ingrese los Nombres" value="<?php echo $this->nvchUserPassword; ?>" 
                    onkeyup="EsVacio('nvchUserPassword')" maxlength="250" required>
                    <span id="nvchUserPasswordIcono" class="" aria-hidden=""></span>
                    <div id="nvchUserPasswordObs" class=""></div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label>Observación y/o Datos Adicionales (Opcional):</label>
                    <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-Usuario" rows="6"><?php echo $this->nvchObservacion; ?></textarea>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                  <div id="nvchPaisGroup" class="form-group">
                    <label>País:</label>
                    <input type="text" name="Pais" id="nvchPais" class="form-control select2" 
                    placeholder="Ingrese el País" value="" onkeypress="return EsLetraTecla(event)" 
                    onkeyup="EsLetra('nvchPais')" maxlength="150">
                    <span id="nvchPaisIcono" class="" aria-hidden=""></span>
                    <div id="nvchPaisObs" class=""></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div id="nvchRegionGroup" class="form-group">
                    <label>Región:</label>
                    <input type="text" name="Region" id="nvchRegion" class="form-control select2" 
                    placeholder="Ingrese Región" value="" onkeypress="return EsLetraTecla(event)" 
                    onkeyup="EsLetra('nvchRegion')" maxlength="150">
                    <span id="nvchRegionIcono" class="" aria-hidden=""></span>
                    <div id="nvchRegionObs" class=""></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div id="nvchProvinciaGroup" class="form-group">
                    <label>Provincia:</label>
                    <input type="text" name="Provincia" id="nvchProvincia" class="form-control select2" 
                    placeholder="Ingrese Provincia" value="" onkeypress="return EsLetraTecla(event)" 
                    onkeyup="EsLetra('nvchProvincia')" maxlength="150">
                    <span id="nvchProvinciaIcono" class="" aria-hidden=""></span>
                    <div id="nvchProvinciaObs" class=""></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div id="nvchDistritoGroup" class="form-group">
                    <label>Distrito:</label>
                    <input type="text" name="Distrito" id="nvchDistrito" class="form-control select2" 
                    placeholder="Ingrese Distrito" value="" onkeypress="return EsLetraTecla(event)" 
                    onkeyup="EsLetra('nvchDistrito')" maxlength="150">
                    <span id="nvchDistritoIcono" class="" aria-hidden=""></span>
                    <div id="nvchDistritoObs" class=""></div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                  <div id="nvchDireccionGroup" class="form-group">
                    <label>Direccion:</label>
                    <input type="text" name="Direccion" id="nvchDireccion" class="form-control select2" 
                    placeholder="Ingrese Dirección" value="" onkeyup="EsVacio('nvchDireccion')" maxlength="450">
                    <span id="nvchDireccionIcono" class="" aria-hidden=""></span>
                    <div id="nvchDireccionObs" class=""></div>
                  </div>
                </div>
            </div>
            <?php if($funcion == "M") { ?>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <input type="submit" id="btn-editar-Usuario" class="btn btn-sm btn-warning btn-flat" value="Editar Usuario"> 
                  <input type="reset" class="btn btn-sm btn-danger btn-flat" value="Limpiar" required="">
                </div>
              </div>
            </div>
            <?php } ?>
        </div>
        <div class="box-header with-border">
        </div>
        <div class="box-header with-border">
          <h3 class="box-title">Comunicación</h3>
        </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                  <div id="nvchMedioGroup" class="form-group">
                    <label>Medio:</label>
                    <input type="text" name="Medio" id="nvchMedio" class="form-control select2" placeholder="Ingrese Medio" 
                    value="" onkeyup="EsVacio('nvchMedio')" maxlength="100">
                    <span id="nvchMedioIcono" class="" aria-hidden=""></span>
                    <div id="nvchMedioObs" class=""></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div id="nvchLugarGroup" class="form-group">
                    <label>Lugar/Pertenencia:</label>
                    <input type="text" name="Lugar" id="nvchLugar" class="form-control select2" placeholder="Ingrese Lugar/Pertenencia" 
                    value="" onkeyup="EsVacio('nvchLugar')" maxlength="550">
                    <span id="nvchLugarIcono" class="" aria-hidden=""></span>
                    <div id="nvchLugarObs" class=""></div>
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
                  <input type="hidden" name="IdComunicacionUsuario" id="intIdComunicacionUsuario" value="" />
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
            <input type="hidden" name="intIdUsuario" id="intIdUsuario" value="<?php echo $this->intIdUsuario; ?>" />
            <?php if($funcion == "F"){ ?>
            <input type="submit" id="btn-crear-Usuario" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Usuario">
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