<?php 
  include('_include/rstheader.php'); 
  include('reports/querySQL4report.php');


if (isset($_POST['regNewUser'])) {
    $nvchUserName = $_POST['nombre'];
    $nchUserMail = $_POST['correo'];
    $nvchUserPassword = $_POST['passw'];
    $bitUserEstado = $_POST['cbestado'];
    $intTypeUser = $_POST['cbtpusuario'];

    include '../dbconnect.php';

    // Create connection
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO tb_usuario (nvchUserName, nchUserMail, nvchUserPassword, bitUserEstado,intTypeUser) VALUES ('$nvchUserName', '$nchUserMail', md5('$nvchUserPassword'),'$bitUserEstado','$intTypeUser')";

    if (mysqli_query($con, $sql)) {
        echo "Registro creado";
          $nvchUserName = null;
          $nchUserMail = null;
          $nvchUserPassword = null;
          $bitUserEstado = null;
          $intTypeUser = null;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}

?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>   

    <!-- Test Script Ajax -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script>
        function refresh_div() {
            jQuery.ajax({
                url:'ajax/selectAllUsuario.php',
                type:'POST',
                success:function(results) {
                    jQuery("#result").html(results);
                }
            });
        }

        refresh_div(); //tiempo de refrescado del consulta
    </script> 
    <!-- END Test Script Ajax -->


  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Usuarios
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
              <tbody id="result">
              <!--tbody-->
                  <?php //echo users_data2(); ?>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          
          <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#modalcust">Agregar Usuario</button>

          <a href="reportesUsers" class="btn btn-sm btn-danger btn-flat pull-left" style="margin: 0px 5px">Reportes</a>

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
      <!--div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Registro de Usuario</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
      </div-->

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
  
  $(document).ready( function () {
      $('table').DataTable();
  } );
  

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
