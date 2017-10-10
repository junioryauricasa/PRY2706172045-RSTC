<?php 
		include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <script type="text/javascript" src="../../negocio/usuario/nusuario.js"></script>
    <script type="text/javascript" src="ajax/vusuario.js"></script>
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
                  <img class="profile-user-img img-responsive img-circle" src="<?php echo $_SESSION['nvchImgPerfil']; ?>" alt="User profile picture">
                  <h3 class="profile-username text-center">
                    <?php echo $_SESSION['NombresApellidos']; ?>
                  </h3>
                  <p class="text-muted text-center">
                    <?php echo $_SESSION['NombrePermiso']; ?>
                  </p>
                  <a href="../..//logout.php" class="btn btn-danger btn-block"><b>Cerrar Sesion</b></a>
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
                  <li class=""><a href="#UserInfo" data-toggle="tab" aria-expanded="false">Información</a></li>
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
                        <table class="table no-margin">
                          <thead>
                            <tr>
                              <th>#Cod.</th>
                              <th>Último Acceso</th>
                              <th>IP Registrada</th>
                              <th>Dispositivo</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><a href="pages/examples/invoice.html">OR9842</a></td>
                              <td>Call of Duty IV</td>
                              <td><span class="label label-success">Shipped</span></td>
                              <td><div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div></td>
                            </tr>
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
                      <h3 class="box-title">Información</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nombres:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="Ingrese sus Generales" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email:</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Ingrese su Correo Electrónico" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Contraseña:</label>
                        <div class="col-sm-5">
                           <input type="text" class="form-control" placeholder="Ingrese Nueva Contraseña " required="">
                        </div>
                        <div class="col-sm-5">
                           <input type="text" class="form-control" placeholder="Ingrese Contraseña Nuevamente" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Guardar</button>
                          <button type="reset" class="btn btn-secondary">Limpiar</button>
                        </div>
                      </div>
                    </form>
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
                          <input type="password" class="form-control" id="inputName" placeholder="Ingrese Anterior Contraseña" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Contraseña:</label>
                        <div class="col-sm-4">
                           <input type="password" class="form-control" placeholder="Ingrese Nueva Contraseña " required="">
                        </div>
                        <div class="col-sm-4">
                           <input type="password" class="form-control" placeholder="Ingrese Contraseña Nuevamente" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="button" class="btn btn-primary">Guardar</button>
                          <button type="reset" class="btn btn-secondary">Limpiar</button>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>

                  <!-- form upload image for profile -->
                  <div class="tab-pane" id="UserImgPerfil">
                    <div class="box-header with-border">
                      <h3 class="box-title">Cambiar mi Foto</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <form method="post" id="formulario" enctype="multipart/form-data">
                          <div class="col-sm-12">
                            <input type="file" name="file" class="form-control">
                          </div>
                          <div class="col-sm-12">
                            <div id="respuesta" style="margin: 15px;"></div>
                          </div>
                          <div class="col-sm-12">
                            <!--input type="submit" class="btn btn-primary"-->
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="box-footer clearfix">
                      <!--a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                      <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a-->
                    </div>
                  </div>
                  <!-- END form upload image for profile -->

                </div>
              </div>
            </div>
          </div>

        </section><!-- /.content -->
      </div>

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