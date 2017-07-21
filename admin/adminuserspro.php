<?php 
  include('_include/rstheader.php'); 
  include('reports/querySQL4report.php');

  require 'SControlador/usuario.entidad.php';
  require 'SModelo/usuario.model.php';



// Logica
$per = new Usuario();
$model = new UsuarioModel();

if(isset($_REQUEST['action']))
{
  switch($_REQUEST['action'])
  {
    case 'actualizar':
      $per->__SET('intUserId',$_REQUEST['intUserId']);
      $per->__SET('nvchUserName',$_REQUEST['nvchUserName']);
      $per->__SET('nchUserMail',$_REQUEST['nchUserMail']);
      $per->__SET('nvchUserPassword',MD5($_REQUEST['nchUserMail']));
      $per->__SET('intIdEmpleado',$_REQUEST['intIdEmpleado']);
      $per->__SET('intTypeUser',$_REQUEST['intTypeUser']);
      $per->__SET('bitUserEstado',$_REQUEST['bitUserEstado']);
      
            //$alm->__SET('foto', $_REQUEST['foto']);
      $model->Actualizar($per);
      header('Location: adminuserspro');
      break;

    case 'registrar':
      //$per->__SET('intUserId',$_REQUEST['intUserId']);
      $per->__SET('nvchUserName',$_REQUEST['nvchUserName']);
      $per->__SET('nchUserMail',$_REQUEST['nchUserMail']);
      $per->__SET('nvchUserPassword',MD5($_REQUEST['nchUserMail']));
      $per->__SET('intIdEmpleado',$_REQUEST['intIdEmpleado']);
      $per->__SET('intTypeUser',$_REQUEST['intTypeUser']);
      $per->__SET('bitUserEstado',$_REQUEST['bitUserEstado']);

      $model->Registrar($per);
      echo "<script>alert('Registro exitoso..!!');</script>";
      header('Location: adminuserspro');
      break;

    case 'eliminar':
      $model->Eliminar($_REQUEST['intUserId']);
      echo "<script>alert('Pedido Eliminado..!!');</script>";
      header('Location: adminuserspro');
      break;

    case 'editar':
      $per = $model->Obtener($_REQUEST['intUserId']);
      break;
  }
}




?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>   

    <!-- Test Script Ajax -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>


    <!-- END Test Script Ajax -->


  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Usuarios Avanzado
        <!--small>Blank example to the fixed layout</small-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Fixed</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!--div class="callout callout-info">
        <h4>Tip!</h4>
        <p>Add the fixed class to the body tag to get this layout. The fixed layout is your best option if your sidebar
          is bigger than your content because it prevents extra unwanted scrolling.</p>
      </div-->

      <!-- TABLE: LATEST USERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Ultimos Registros</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <!--table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc"-->
            <table class="table table-hover table-condensed">
              <thead>
              <tr>
                <th>#Código</th>
                <th>Nombres</th>
                <th>Correo</th>
                <th>Tipo Usuario</th>
                <th>Estado</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <!--tbody id="result"-->
              <tbody>
                  <?php echo USERS_TABLE(); ?>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          
          <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#modalcust">Agregar Usuario</button>

          <a href="reportes" class="btn btn-sm btn-danger btn-flat pull-left" style="margin: 0px 5px">Reportes</a>

          <a href="adminuserspro" class="btn btn-sm btn-success btn-flat pull-left" style="margin: 0px 5px">Avanzado</a>

          <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right" style="margin: 0px 5px">Ver Todos los Pedidos</a>

        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->

      <div>
        <div class="result"></div>
      </div>

  
      <!-- Formulario registro Usuario -->
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Registro de Usuario</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>

        <form action="?action=<?php echo $per->intUserId > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
                    
                    <input class="form-control" type="hidden" name="intUserId" value="<?php echo $per->__GET('intUserId'); ?>" />

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Nombres:</label>
                        <input type="text" name="nvchUserName" class="form-control select2" placeholder="Ingrese Nombres Abreviado" value="<?php echo ($per->__GET('nvchUserName')); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Correo:</label>
                        <input type="text" name="nchUserMail" class="form-control select2" placeholder="Ingrese Nombres Abreviado" value="<?php echo ($per->__GET('nchUserMail')); ?>" required>
                      </div>
                    </div>
                    <!--div class="col-md-3">
                      <div class="form-group">
                        <label>Contraseña</label>
                        <input type="text" name="nvchUserPassword" class="form-control select2" placeholder="Ingrese Contraseña de Usuario" value="<?php echo ($per->__GET('nvchUserPassword')); ?>" required>
                      </div>
                    </div-->
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Tipo de Usuario:</label>
                        <!--input type="text" name="" class="form-control select2" placeholder="Ingrese Nombres Abreviado"-->
                        <select name="intTypeUser" id="" class="form-control" >
                          <option value="0">Usuario</option>
                          <option value="1">Administrador</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Estado del Usuario:</label>
                        <!--input type="text" name="" class="form-control select2" placeholder="Ingrese Nombres Abreviado"-->
                        <select name="bitUserEstado" id="" class="form-control" >
                          <option value="0">Deshabilitado</option>
                          <option value="1">Habilitado</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Usuario:</label> <br>
                        <!--input type="text" name="" class="form-control select2" placeholder="Ingrese Nombres Abreviado"-->
                        <select class="selectpicker show-tick" data-live-search="true" name="intIdEmpleado">
                          <option data-tokens="User1" value="User1">Junior Yauricasa</option>
                          <option data-tokens="User2" value="User1">Hector Vvanco</option>
                          <option data-tokens="User3" value="User3">Luis Sanchez</option>
                        </select>
                      </div>
                    </div>

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
                      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
                      <script>
                        $('.selectpicker').selectpicker({
                          style: 'btn-default',
                          size: 6
                        });
                      </script>

                    <!-- /.col -->
                    <!--div class="col-md-3">
                      <div class="form-group">
                        <label>Disabled Result</label>
                        <select class="form-control select2" style="width: 100%;">
                          <option selected="selected">Alabama</option>
                          <option>Alaska</option>
                          <option disabled="disabled">California (disabled)</option>
                          <option>Delaware</option>
                          <option>Tennessee</option>
                          <option>Texas</option>
                          <option>Washington</option>
                        </select>
                      </div>
                    </div-->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
              <input type="submit" name="regNewUser" class="btn btn-sm btn-info btn-flat pull-left" value="Guardar" style="margin: 0px 5px">
              <input type="reset" class="btn btn-sm btn-info btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
          </div>              
        </form>
      </div>

      <!-- /.box -->
      <!-- END Formulario registro Usuario -->

      <!-- /.box -->

      <!-- Default box -->
      <!--div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          Start creating your amazing application!
        </div>
        <div class="box-footer">
          Footer
        </div>
      </div-->
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




<!-- Scripts DataTable -->
<script>
  // add json datatable a los elementos table
  /*
  $(document).ready( function () {
      $('table').DataTable();
  } );
  */

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

<?php include('_include/rstfooter.php'); ?>