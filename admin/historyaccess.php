<?php 
  //historyaccess.php
  include('_include/rstheader.php'); 
  include('reports/querySQL4report.php');
?>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
    </script>   
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Historial de accesos
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Usuarios</a></li>
        <li class="active">Historial de Acceso</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-danger" id="success-alert">
        <h4>Importante! Lea esto antes de hacer uso de esta sección</h4>
        <p>Esta sección esta enfocada para uso exclusivo del administrador en esta seccion podra revisar el historial de acceso de cada usuario a la plataforma, permitiendo tener control sobre quienes logran acceder y que dispositivos navegador, fecha y hora en la cual esta ingresando a esta, cabe recalcar que esta información no podra ser editada o eliminada, por razones obvias.</p>
      </div>

      <!-- TABLE: LATEST USERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Historial de acceso de usuarios</h3>
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
                <th>Estado Actual</th>
                <th>Ultimo Acceso</th>
                <th>Dispositivo</th>
                <th>IP Registrada</th>
              </tr>
              </thead>
              <tbody>
                  <?php echo users_HistoryAccess(); ?>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Ingresar Nuevo pedido</a>
          <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Ver Todos los Pedidos</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->

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
  $(document).ready( function () {
      $('table').DataTable();
  } );
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