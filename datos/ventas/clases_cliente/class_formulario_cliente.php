<?php
require_once '../conexion/bd_conexion.php';
class FormularioCliente
{
  private $intIdCliente;
  private $nvchDNI;
  private $nvchRUC;
  private $nvchRazonSocial;
  private $nvchApellidoPaterno;
  private $nvchApellidoMaterno;
  private $nvchNombres;
  private $intIdTipoPersona;
  private $intIdTipoCliente;
  private $dtmFechaNacimiento;
  private $nvchGustos;
  private $nvchObservacion;

  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function DNI($nvchDNI){ $this->nvchDNI = $nvchDNI; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function ApellidoPaterno($nvchApellidoPaterno){ $this->nvchApellidoPaterno = $nvchApellidoPaterno; }
  public function ApellidoMaterno($nvchApellidoMaterno){ $this->nvchApellidoMaterno = $nvchApellidoMaterno; }
  public function Nombres($nvchNombres){ $this->nvchNombres = $nvchNombres; }
  public function IdTipoPersona($intIdTipoPersona){ $this->intIdTipoPersona = $intIdTipoPersona; }
  public function IdTipoCliente($intIdTipoCliente){ $this->intIdTipoCliente = $intIdTipoCliente; }
  public function FechaNacimiento($dtmFechaNacimiento){ $this->dtmFechaNacimiento = $dtmFechaNacimiento; }
  public function Gustos($nvchGustos){ $this->nvchGustos = $nvchGustos; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div id="Formulario" class="">
          <?php 
            /*
            if($funcion == "F"){ 
          ?>
            <h3 class="box-title">Nuevo Cliente</h3>
          <?php 
            } else 
            if($funcion == "M") {
          ?>
            <h3 class="box-title">Editar Cliente</h3>
          <?php 
            }
            */
          ?>
          
          <!-- END Botones del box 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" id="btn-form-cliente-remove" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
          Botones del box -->
        <form id="form-cliente" method="POST">
          <div class="box-body">
              <!-- formulario de cliente -->
              <div class="col-md-3">

                  <?php 
                    if($funcion == "F"){ 
                  ?>
                    <h4 class="box-title text-center">Nuevo Cliente</h4>
                  <?php 
                    } else 
                    if($funcion == "M") {
                  ?>
                    <h4 class="box-title text-center">Modificar Cliente</h4>
                  <?php 
                    }
                  ?>
                  
                  <hr>
                  <div class="col-md-12">
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
                  <script>MostrarTipoPersona();</script>
                  <div class="col-md-12 nvchDNI">
                    <div id="nvchDNIGroup" class="form-group">
                      <label>DNI:</label>
                      <input type="text" id="nvchDNI" name="nvchDNI" class="form-control select2" placeholder="Ingrese DNI" 
                      value="<?php echo $this->nvchDNI; ?>" onkeypress="return EsNumeroEnteroTecla(event)" 
                      onkeyup="EsNumeroEntero('nvchDNI')" maxlength="8" required>
                      <span id="nvchDNIIcono" class="" aria-hidden=""></span>
                      <div id="nvchDNIObs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-12 nvchRUC">
                    <div id="nvchRUCGroup" class="form-group">
                      <label>RUC:</label>
                      <input type="text" id="nvchRUC" name="nvchRUC" class="form-control select2" placeholder="Ingrese RUC" 
                      value="<?php echo $this->nvchRUC; ?>" onkeypress="return EsNumeroEnteroTecla(event)" 
                      onkeyup="EsNumeroEnteroOp('nvchRUC')" maxlength="11" required>
                      <span id="nvchRUCIcono" class="" aria-hidden=""></span>
                      <div id="nvchRUCObs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-12 nvchRazonSocial">
                    <div id="nvchRazonSocialGroup" class="form-group">
                      <label>Razón Social:</label>
                      <input type="text" id="nvchRazonSocial" name="nvchRazonSocial" class="form-control select2" placeholder="Ingrese Razón Social" 
                      value="<?php echo $this->nvchRazonSocial; ?>" onkeyup="EsVacio('nvchRazonSocial')" maxlength="250" required>
                      <span id="nvchRazonSocialIcono" class="" aria-hidden=""></span>
                      <div id="nvchRazonSocialObs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-12 nvchApellidoPaterno">
                    <div id="nvchApellidoPaternoGroup" class="form-group">
                      <label>Apellido Paterno:</label>
                      <input type="text" id="nvchApellidoPaterno" name="nvchApellidoPaterno" class="form-control select2" 
                      placeholder="Ingrese Apellido Paterno" value="<?php echo $this->nvchApellidoPaterno; ?>" 
                      onkeyup="EsVacio('nvchApellidoPaterno')" maxlength="120" required>
                      <span id="nvchApellidoPaternoIcono" class="" aria-hidden=""></span>
                      <div id="nvchApellidoPaternoObs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-12 nvchApellidoMaterno">
                    <div id="nvchApellidoMaternoGroup" class="form-group">
                      <label>Apellido Materno:</label>
                      <input type="text" id="nvchApellidoMaterno" name="nvchApellidoMaterno" class="form-control select2" 
                      placeholder="Ingrese Apellido Materno" value="<?php echo $this->nvchApellidoMaterno; ?>" 
                      onkeyup="EsVacio('nvchApellidoMaterno')" maxlength="120" required>
                      <span id="nvchApellidoMaternoIcono" class="" aria-hidden=""></span>
                      <div id="nvchApellidoMaternoObs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-12 nvchNombres">
                    <div id="nvchNombresGroup" class="form-group">
                      <label>Nombres:</label>
                      <input type="text" id="nvchNombres" name="nvchNombres" class="form-control select2" 
                      placeholder="Ingrese los Nombres" value="<?php echo $this->nvchNombres; ?>" 
                      onkeyup="EsVacio('nvchNombres')" maxlength="250" required>
                      <span id="nvchNombresIcono" class="" aria-hidden=""></span>
                      <div id="nvchNombresObs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Tipo de Cliente:</label>
                      <select id="tipo-cliente" name="intIdTipoCliente" class="form-control select2" >
                        <?php try{
                          $sql_conexion = new Conexion_BD();
                          $sql_conectar = $sql_conexion->Conectar();
                          $sql_comando = $sql_conectar->prepare('CALL mostrartipocliente()');
                          $sql_comando->execute();
                          while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                          {
                            echo '<option value="'.$fila['intIdTipoCliente'].'">'.$fila['nvchNombre'].'</option>';
                          }
                        }catch(PDPExceptions $e){
                          echo $e->getMessage();
                        }?>
                      </select>
                    </div>
                    <input type="hidden" id="intIdTipoCliente" value="<?php echo $this->intIdTipoCliente; ?>">
                  </div>
                  <div class="col-md-12">
                    <div id="dtmFechaNacimientoGroup" class="form-group">
                      <label>Fecha de Nacimiento (Opcional):</label>
                      <input type="text" id="dtmFechaNacimiento" name="dtmFechaNacimiento" class="form-control select2" 
                      placeholder="Ingrese Fecha Nacimiento" value="<?php echo $this->dtmFechaNacimiento; ?>" 
                      onkeyup="EsFechaOp('dtmFechaNacimiento')" maxlength="10" required>
                      <span id="dtmFechaNacimientoIcono" class="" aria-hidden=""></span>
                      <div id="dtmFechaNacimientoObs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div id="nvchGustosGroup" class="form-group">
                      <label>Gustos (Opcional):</label>
                      <input type="text" id="nvchGustos" name="nvchGustos" class="form-control select2" 
                      placeholder="Ingrese Gustos" value="<?php echo $this->nvchGustos; ?>" 
                      onkeyup="EsVacioOp('nvchGustos')" maxlength="120" required>
                      <span id="nvchGustosIcono" class="" aria-hidden=""></span>
                      <div id="nvchGustosObs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Observación y/o Datos Adicionales (Opcional):</label>
                      <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-cliente" rows="6"><?php echo $this->nvchObservacion; ?></textarea>
                    </div>
                  </div>

                  <!-- botones del formulario  -->
                  <?php if($funcion == "M") { ?>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="button" id="btn-editar-cliente-actualizar" class="btn btn-sm btn-warning btn-flat" value="Editar Cliente"> 
                        <input type="reset" id="btn-reset-actualizar" class="btn btn-sm btn-danger btn-flat" value="Limpiar" required="">
                      </div>
                    </div>
                  <?php } ?>
              </div>
              <!-- END formulario de cliente -->

              <!-- formulario domicilio -->
              <div class="col-md-9">
                <div class="box-header with-border">
                  <h3 class="box-title">Domicilio</h3>
                </div>
                  <div class="box-body">
                      <div class="row">
                          <div id="nvchPaisCol" class="col-md-3">
                            <div id="nvchPaisGroup" class="form-group">
                              <label>País:</label>
                              <input type="text" name="Pais" id="nvchPais" class="form-control select2" 
                              placeholder="Ingrese el País" value="PERU" onkeypress="return EsLetraTecla(event)" 
                              onkeyup="EsLetra('nvchPais')" maxlength="150" />
                              <span id="nvchPaisIcono" class="" aria-hidden=""></span>
                              <div id="nvchPaisObs" class=""></div>
                            </div>
                          </div>
                          <script type="text/javascript">$("#nvchPaisCol").hide();</script>
                          <div class="col-md-3">
                            <div id="intIdDepartamentoGroup" class="form-group">
                              <label>Departamento:</label>
                              <select onchange="MostrarProvincia()" id="intIdDepartamento" class="form-control select2" >
                                <?php try{
                                  $sql_conexion = new Conexion_BD();
                                  $sql_conectar = $sql_conexion->Conectar();
                                  $sql_comando = $sql_conectar->prepare('CALL mostrardepartamento()');
                                  $sql_comando->execute();
                                  while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                                  {
                                    echo '<option value="'.$fila['intIdDepartamento'].'">'.$fila['nvchDepartamento'].'</option>';
                                  }
                                }catch(PDPExceptions $e){
                                  echo $e->getMessage();
                                }?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div id="intIdProvinciaGroup" class="form-group">
                              <label>Provincia:</label>
                              <select onchange="MostrarDistrito()" id="intIdProvincia" class="form-control select2" >
                                <?php try{
                                  $sql_conexion = new Conexion_BD();
                                  $sql_conectar = $sql_conexion->Conectar();
                                  $sql_comando = $sql_conectar->prepare('CALL mostrarProvincia(1)');
                                  $sql_comando->execute();
                                  while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                                  {
                                    echo'<option value="'.$fila['intIdProvincia'].'">'.$fila['nvchProvincia'].'</option>';
                                  }
                                }catch(PDPExceptions $e){
                                  echo $e->getMessage();
                                }?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div id="intIdDistritoGroup" class="form-group">
                              <label>Distrito:</label>
                              <select id="intIdDistrito" class="form-control select2" >
                                <?php try{
                                  $sql_conexion = new Conexion_BD();
                                  $sql_conectar = $sql_conexion->Conectar();
                                  $sql_comando = $sql_conectar->prepare('CALL MostrarDistrito(1)');
                                  $sql_comando->execute();
                                  while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                                  {
                                    echo'<option value="'.$fila['intIdDistrito'].'">'.$fila['nvchDistrito'].'</option>';
                                  }
                                }catch(PDPExceptions $e){
                                  echo $e->getMessage();
                                }?>
                              </select>
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
                            <input type="hidden" name="IdDomicilioCliente" id="intIdDomicilioCliente" value="" />
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
                        <table class="ExcelTable2007 rwd-table" width="100%">
                          <thead>
                          <tr>
                            <!--th class="heading" width="25px">&nbsp;</th-->
                            <th class="" width="25px" style="background: #a9c4e9">
                              <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                            </th>
                            <th>País</th>
                            <th>Departamento</th>
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
              </div>
              <!-- END formulario domicilio -->

              <br>

              <!-- formulario comunicacion -->
              <div class="col-md-9">
                  <div class="box-header with-border">
                  <h3 class="box-title">Comunicación (Opcional)</h3>
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
                        <input type="hidden" name="IdComunicacionCliente" id="intIdComunicacionCliente" value="" />
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
                      <table class="ExcelTable2007 rwd-table" width="100%">
                        <thead>
                        <tr>
                          <!--th class="heading" width="25px">&nbsp;</th-->
                          <th class="" width="25px" style="background: #a9c4e9">
                            <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                          </th>
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
                      <input type="hidden" name="funcion" id="funcion" value="I" />
                      <?php } else if($funcion == "M") { ?>
                      <input type="hidden" name="funcion" id="funcion" value="A" />
                      <?php } ?>
                      <input type="hidden" name="intIdCliente" id="intIdCliente" value="<?php echo $this->intIdCliente; ?>" />
                      <?php if($funcion == "F"){ ?>
                      <input type="button" id="btn-crear-cliente-nuevo" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Cliente">
                      <input type="reset" id="btn-reset-nuevo" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
                      <?php } ?>
                  </div>
              </div>
               <!-- END formulario comunicacion -->
          </div>              
        </form>
        
        <!--  
          <div id="resultadocrud"></div>
        -->

      </div>
<?php
  }
}
?>