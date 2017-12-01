<?php
    require_once '../../datos/conexion/bd_conexion.php'; 
    include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <?php require_once '../../negocio/usuarios/nperfil.php'; ?>
    <?php require_once '../../negocio/operaciones/ndatosgenerales.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <!--<script type="text/javascript" src="../../negocio/usuarios/nperfil.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/ndatosgenerales.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/nvalidaciones.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/nestilos.js"></script>-->
    <style>
      .pagination a {
          margin: 0 4px; /* 0 is for top and bottom. Feel free to change it */
      }
      hr { 
          display: block;
          margin-top: 0.5em;
          margin-bottom: 0.5em;
          margin-left: auto;
          margin-right: auto;
          border-style: inset;
          border-width: 1px;
      }
    </style>

<div class="content-wrapper" style="min-height: 1096px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Perfil de Usuario
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">User profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle imgperfil" src="" alt="User profile picture">
                  <h3 class="profile-username text-center">
                    <?php echo $_SESSION['NombresApellidos']; ?>
                  </h3>
                  <p class="text-muted text-center">
                    <?php echo $_SESSION['NombrePermiso']; ?>
                  </p>
                  <a href="../..//logout.php" class="btn btn-danger btn-block"><b>Cerrar Sesión</b></a>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <!--div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Información</h3>
                </div>
                <div class="box-body">
                  <strong><i class="fa fa-book margin-r-5"></i>  Educación</strong>
                  <p class="text-muted">
                    B.S. in Computer Science from the University of Tennessee at Knoxville
                  </p>

                  <hr>

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Localización</strong>
                  <p class="text-muted">Malibu, California</p>

                  <hr>

                  <strong><i class="fa fa-pencil margin-r-5"></i> Habilidades</strong>
                  <p>
                    <span class="label label-danger">UI Design</span>
                    <span class="label label-success">Coding</span>
                    <span class="label label-info">Javascript</span>
                    <span class="label label-warning">PHP</span>
                    <span class="label label-primary">Node.js</span>
                  </p>

                  <hr>

                  <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>
              </div-->
            </div>

            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#UserActividad" data-toggle="tab" aria-expanded="true">Actividad</a></li>
                  <li class=""><a href="#UserInfo" data-toggle="tab" aria-expanded="false">Información General</a></li>
                  <li class=""><a href="#UserComunicacion" data-toggle="tab" aria-expanded="false">Comunicación</a></li>
                  <li class=""><a href="#UserPassword" data-toggle="tab" aria-expanded="false">Contraseña</a></li>
                  <li class=""><a href="#UserImgPerfil" data-toggle="tab" aria-expanded="false">Mi Foto</a></li>
                </ul>

                <div class="tab-content">
                  <div class="tab-pane active" id="UserActividad">
                    <div class="box-header with-border">
                      <h3 class="box-title">Historial de Acceso</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">

                        <table class="rwd-table ExcelTable2007" width="100%">
                          <thead>
                            <tr>
                              <th class="heading">&nbsp;</th>
                              <th>Último Acceso</th>
                              <th>IP Registrada</th>
                              <th>Dispositivo</th>
                            </tr>
                          </thead>
                          <tbody id="ListaDeAccesos" style="border: 1px solid #D0D7E5;">
                          </tbody>
                        </table>

                      </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                      <!--a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                      <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a-->
                    </div><!-- /.box-footer -->
                  </div>

                  <div class="tab-pane" id="UserInfo">
                    <div class="box-header with-border">
                      <h3 class="box-title">Información General</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <form class="form-horizontal" id="UserInfoData">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">DNI:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="nvchDNI" name="nvchDNI" placeholder="Ingrese su DNI" value="" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">RUC:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="nvchRUC" name="nvchRUC" placeholder="Ingrese su RUC" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Apellido Paterno:</label>
                        <div class="col-sm-10">
                          <input class="form-control" id="nvchApellidoPaterno" name="nvchApellidoPaterno" placeholder="Ingrese su Apellido Paterno" value="" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Apellido Materno:</label>
                        <div class="col-sm-10">
                          <input class="form-control" id="nvchApellidoMaterno" name="nvchApellidoMaterno" placeholder="Ingrese su Apellido Materno" value="" required/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombres:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="nvchNombres" name="nvchNombres" placeholder="Ingrese sus Nombres" value="" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Género:</label>
                        <div class="col-sm-10">
                          <select id="nvchGenero" name="nvchGenero" class="form-control select2">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">País:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="nvchPais" name="nvchPais" placeholder="Ingrese sus Nombres" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Departamento (Opcional):</label>
                        <div class="col-sm-10">
                          <select onchange="MostrarProvincia()" id="intIdDepartamento" name="intIdDepartamento" class="form-control select2">
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
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Provincia (Opcional):</label>
                        <div class="col-sm-10">
                          <select onchange="MostrarDistrito()" id="intIdProvincia" name="intIdProvincia" class="form-control select2">
                            <?php try{
                              $sql_conexion = new Conexion_BD();
                              $sql_conectar = $sql_conexion->Conectar();
                              $sql_comando = $sql_conectar->prepare('CALL MostrarUsuario(:intIdUsuario)');
                              $sql_comando->execute(array(':intIdUsuario' => $_SESSION['intIdUsuarioSesion']));
                              $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
                              $intIdDepartamento = $fila['intIdDepartamento'];
                              $sql_comando = $sql_conectar->prepare('CALL MostrarProvincia(:intIdDepartamento)');
                              $sql_comando->execute(array(':intIdDepartamento' => $intIdDepartamento));
                              while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                              {
                                echo '<option value="'.$fila['intIdProvincia'].'">'.$fila['nvchProvincia'].'</option>';
                              }
                            }catch(PDPExceptions $e){
                              echo $e->getMessage();
                            }?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Distrito (Opcional):</label>
                        <div class="col-sm-10">
                          <select id="intIdDistrito" name="intIdDistrito" class="form-control select2">
                            <?php try{
                              $sql_conexion = new Conexion_BD();
                              $sql_conectar = $sql_conexion->Conectar();
                              $sql_comando = $sql_conectar->prepare('CALL MostrarUsuario(:intIdUsuario)');
                              $sql_comando->execute(array(':intIdUsuario' => $_SESSION['intIdUsuarioSesion']));
                              $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
                              $intIdProvincia = $fila['intIdProvincia'];
                              $sql_comando = $sql_conectar->prepare('CALL MostrarDistrito(:intIdProvincia)');
                              $sql_comando->execute(array(':intIdProvincia' => $intIdProvincia));
                              while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                              {
                                echo '<option value="'.$fila['intIdDistrito'].'">'.$fila['nvchDistrito'].'</option>';
                              }
                            }catch(PDPExceptions $e){
                              echo $e->getMessage();
                            }?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Dirección:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="nvchDireccion" name="nvchDireccion" placeholder="Ingrese la Dirección" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <input type="hidden" name="intIdUsuario" value="<?php echo $_SESSION['intIdUsuarioSesion']; ?>"/>
                          <input type="hidden" name="funcion" value="APF"/>
                          <button type="button" id="btn-guardar-usuario" class="btn btn-primary">Guardar</button>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
                  <script type="text/javascript">
                    MostrarUsuarioPerfil(<?php echo $_SESSION['intIdUsuarioSesion']; ?>);
                  </script>
                  <div id="resultadocrud"></div>

                  <div class="tab-pane" id="UserComunicacion">
                    <div class="box-header with-border">
                      <h3 class="box-title">Comunicación</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <form id="form-user-comunicacion" class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo de Comunicación:</label>
                        <div class="col-sm-10">
                          <select id="intIdTipoComunicacion" name="intIdTipoComunicacion" class="form-control select2">
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
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Medio:</label>
                        <div class="col-sm-10">
                          <input class="form-control" id="nvchMedio" name="nvchMedio" placeholder="Ingrese el Medio" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Lugar/Pertenencia:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="nvchLugar" name="nvchLugar" placeholder="Ingrese el Lugar/Pertenencia" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <input type="hidden" name="intIdUsuario" id="intIdUsuario-comunicacion" value="<?php echo $_SESSION['intIdUsuarioSesion']; ?>"/>
                          <input type="hidden" name="intIdComunicacionUsuario" id="intIdComunicacionUsuario" value=""/>
                          <input type="hidden" name="funcion" value="IC"/>
                          <input type="hidden" name="tipolistado" id="tipolistado-comunicacion" value="I"/>
                          <input type="button" onclick="ActualizarComunicacion()" id="btn-actualizar-comunicacion" name="btn-actualizar-comunicacion" class="btn btn-sm btn-warning btn-flat" value="Editar Comunicación">
                          <input type="button" onclick="BotonesComunicacion('I')" id="btn-cancelar-comunicacion" name="btn-cancelar-comunicacion" class="btn btn-sm btn-danger btn-flat" value="Cancelar Modificación">
                          <button type="button" id="btn-agregar-comunicacion" class="btn btn-primary">Agregar</button>
                          <button type="reset" id="btn-comunicacion-limpiar" class="btn btn-secondary">Limpiar</button>
                          <script type="text/javascript">BotonesComunicacion("I");</script>
                        </div>
                      </div>
                    </form>
                    <div class="table-responsive">
                      <!--table class="table table-hover table-condensed"-->
                      <table class="ExcelTable2007 rwd-table" style="width: 100%">
                        <thead>
                        <tr>
                          <th class="heading">&nbsp;</th>
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
                  </div>

                  <div class="tab-pane" id="UserPassword">
                    <div class="box-header with-border">
                      <h3 class="box-title">Contraseña</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <form id="form-user-password" class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Anterior Contraseña:</label>
                        <div class="col-sm-4">
                          <input type="password" class="form-control" id="nvchUserPasswordAnt" name="nvchUserPasswordAnt" placeholder="Ingrese Anterior Contraseña" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Contraseña:</label>
                        <div class="col-sm-4">
                           <input type="password" class="form-control" id="nvchUserPassword" name="nvchUserPassword" placeholder="Ingrese Nueva Contraseña" required>
                        </div>
                        <div class="col-sm-4">
                           <input type="password" class="form-control" id="nvchUserPasswordRep" name="nvchUserPasswordRep" placeholder="Ingrese Contraseña Nuevamente" onkeyup="ComprobarPassword()" required>
                           <div id="nvchUserPasswordRepObs" class=""></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <input type="hidden" name="intIdUsuario" value="<?php echo $_SESSION['intIdUsuarioSesion']; ?>"/>
                          <input type="hidden" name="funcion" value="APP"/>
                          <button type="button" id="btn-editar-userpassword" class="btn btn-primary">Guardar</button>
                          <button type="reset" class="btn btn-secondary">Limpiar</button>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>

                  <div class="tab-pane" id="UserImgPerfil">
                    <div class="box-header with-border">
                      <h3 class="box-title">Cambiar mi Foto</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <form method="post" id="form-img-perfil">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <label>Imagen:</label>
                              <input type="file" name="SeleccionImagen" id="SeleccionImagen" accept=".png, .jpg, .jpeg">
                              <img id="resultadoimagen" src="" style="width: 100px; height: 100px;" />
                              <input type="hidden" id="nvchImgPerfil" name="nvchImgPerfil" value="" />
                              <div id="operacionimagen"></div>
                              <br>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                              <input type="hidden" name="funcion" value="AIP"/>
                              <button type="button" id="btn-editar-imgperfil" class="btn btn-primary">Guardar</button>
                            </div>
                          </div>
                          <div id="resultadoimg"></div>
                        </form>
                      </div>
                    </div>
                    <div class="box-footer clearfix">
                    </div>
                  </div>
                  <!-- END form upload image for profile -->

                </div>
              </div>
            </div>
          </div>

        </section><!-- /.content -->
      </div>


<!-- INICIO modal confirmar -->
<div class="modal fade mi-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
      </div>
      <div class="modal-body">
        Estas seguro de eliminar registro?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default modal-btn-si" id="">Si</button>
        <button type="button" class="btn btn-primary modal-btn-no" id="">No</button>
      </div>
    </div>
  </div>
</div>
<!-- END modal confirmar -->


<script>
  // Modal
  $('#modalcust').modal({
    keyboard: false
  });
</script>
<!-- ENd Scripts DataTable -->
<style>
  input{
    padding: 2px 3px;
  }
  select{
    padding: 3px;
  }
</style>

<!-- For upload image -->
<script>
     $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario")[0]);
            var ruta = "ajax-imagen.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
     });
</script>
<!-- END For upload image -->

<?php include('../_include/rstfooter.php'); ?>