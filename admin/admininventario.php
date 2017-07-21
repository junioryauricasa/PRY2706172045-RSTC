<?php 
  include('_include/rstheader.php'); 
  include('reports/querySQL4report.php');


if (isset($_POST['regNuevoProducto'])) {
    $nvchNombre = $_POST['nombre'];
    $dcmPrecio = $_POST['precio'];
    $intCantidad = $_POST['cantidad'];
    $nvchDireccionImg = $_POST['direccionimg'];
    $nvchDescripcion = $_POST['descripcion'];

    include '../dbconnect.php';

    // Create connection
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO tb_producto (nvchNombre, dcmPrecio, intCantidad, nvchDireccionImg, nvchDescripcion) VALUES ('$nvchNombre', $dcmPrecio, $intCantidad,'$nvchDireccionImg','$nvchDescripcion')";

    if (mysqli_query($con, $sql)) {
        echo "Registro creado";
          $nvchNombre = null;
          $dcmPrecio = 0.00;
          $intCantidad = 0;
          $nvchDireccionImg = null;
          $nvchDescripcion = null;
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
                url:'ajax/selectAllProducto.php',
                type:'POST',
                success:function(results) {
                    jQuery("#result").html(results);
                }
            });
        }

        t = setInterval(refresh_div,700); //tiempo de refrescado del consulta
    </script> 
    <!-- END Test Script Ajax -->


  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Productos
        <small>Blank example to the fixed layout</small>
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
          <h3 class="box-title">Registro de Productos</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-hover table-condensed">
              <thead>
              <tr>
                <th>#Código</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Imagen</th>
                <th>Descripción</th>
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
          
          <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#modalcust">Agregar Producto</button>

          <a href="reportes" class="btn btn-sm btn-danger btn-flat pull-left" style="margin: 0px 5px">Reportes</a>

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
          <h3 class="box-title">Registro de Producto</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="box-body">
            <div class="row">
                
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control select2" placeholder="Ingrese nombre del producto">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Precio:</label>
                        <input type="text" name="precio" class="form-control select2" placeholder="Ingrese precio del producto">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="text" name="cantidad" class="form-control select2" placeholder="Ingrese cantidad del producto">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Imagen:</label>
                        <input type="text" name="direccionimg" class="form-control select2" placeholder="Ingrese imagen del producto">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Descripción:</label>
                        <input type="text" name="descripcion" class="form-control select2" placeholder="Ingrese descripción del producto">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Buscar producto:</label> <br>
                        <select class="selectpicker" data-live-search="true">
                          <option data-tokens="User1">selecciona</option>
                          <option data-tokens="User1">Junior Yauricasa</option>
                          <option data-tokens="User2">Hector Vvanco</option>
                          <option data-tokens="User3">Luis Sanchez</option>
                        </select>
                      </div>
                    </div>

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
                      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
                      <script>
                        $('.selectpicker').selectpicker({
                          style: 'btn-default',
                          size: 4
                        });
                      </script>

                    
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
            </div>
          </div>
          <div class="box-footer">
              <input type="submit" name="regNuevoProducto" class="btn btn-sm btn-info btn-flat pull-left" value="Guardar">
              <input type="reset" class="btn btn-sm btn-info btn-flat pull-left" value="Limpiar">
          </div>              
        </form>
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
  // add json datatable
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