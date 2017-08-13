<?php 
		include('../_include/rstheader.php');
    include('../../datos/default/class_default.php');
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
            Bienvenido al portal Resteco <?php echo $_SESSION['usr_name']; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Ejemplo </a></li>
            <li class="active">Perfil Usuario</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Panel de consulta tiempo real datos -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Usuarios</span>
                  <span class="info-box-number">
                      <?php echo ContarUsuarios(); ?>
                      <small> Registros</small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Productos</span>
                  <span class="info-box-number">
                      <?php echo ContarProductos(); ?>
                      <small> Registros</small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Clientes</span>
                  <span class="info-box-number">
                      <?php echo ContarClientes(); ?>
                      <small> Registros</small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Empleados</span>
                  <span class="info-box-number">
                      <?php echo ContarEmpleados(); ?>
                      <small> Registros</small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </div>
          <!-- END Panel de consulta tiempo real datos -->

          <div class="row">
            
            <div class="col-md-8">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Pedidos Recientes</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table no-margin">
                        <thead>
                        <tr>
                          <th>Order ID</th>
                          <th>Item</th>
                          <th>Status</th>
                          <th>Popularity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR9842</a></td>
                          <td>Call of Duty IV</td>
                          <td><span class="label label-success">Shipped</span></td>
                          <td>
                            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                          </td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR1848</a></td>
                          <td>Samsung Smart TV</td>
                          <td><span class="label label-warning">Pending</span></td>
                          <td>
                            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                          </td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                          <td>iPhone 6 Plus</td>
                          <td><span class="label label-danger">Delivered</span></td>
                          <td>
                            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                          </td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                          <td>Samsung Smart TV</td>
                          <td><span class="label label-info">Processing</span></td>
                          <td>
                            <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                          </td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR1848</a></td>
                          <td>Samsung Smart TV</td>
                          <td><span class="label label-warning">Pending</span></td>
                          <td>
                            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                          </td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                          <td>iPhone 6 Plus</td>
                          <td><span class="label label-danger">Delivered</span></td>
                          <td>
                            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                          </td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR9842</a></td>
                          <td>Call of Duty IV</td>
                          <td><span class="label label-success">Shipped</span></td>
                          <td>
                            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                          </td>
                        </tr>
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
            </div>

            <div class="col-md-4">

              <!-- Profile Image -->
              <!--div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="<?php echo $_SESSION['usr_photo']; ?>" alt="User profile picture">
                  <h3 class="profile-username text-center">
                    <?php echo $_SESSION['usr_name']; ?>
                  </h3>
                  <p class="text-muted text-center">
                    <?php echo $_SESSION['user_typeuser']; ?>
                  </p>
                  <p class="text-muted text-center">
                    <a href="#">micorreo@gmail.com</a>
                  </p>

                  <a href="../..//logout.php" class="btn btn-danger btn-block"><b>Cerrar Sesion</b></a>
                </div>
              </div-->

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Ultimos Productos en Almacen</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                    <li class="item">
                      <div class="product-img">
                        <img src="http://mobile--shop2.ecudemo4320.cafe24.com/web/product/medium/14_shop2_120454.jpg" alt="Product Image">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Samsung TV
                          <span class="label label-warning pull-right">$1800</span></a>
                            <span class="product-description">
                              Samsung 32" 1080p 60Hz LED Smart HDTV.
                            </span>
                      </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="http://mobile--shop2.ecudemo4320.cafe24.com/web/product/medium/14_shop2_120454.jpg" alt="Product Image">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Bicycle
                          <span class="label label-info pull-right">$700</span></a>
                            <span class="product-description">
                              26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                            </span>
                      </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="http://mobile--shop2.ecudemo4320.cafe24.com/web/product/medium/14_shop2_120454.jpg" alt="Product Image">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
                            <span class="product-description">
                              Xbox One Console Bundle with Halo Master Chief Collection.
                            </span>
                      </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="http://mobile--shop2.ecudemo4320.cafe24.com/web/product/medium/14_shop2_120454.jpg" alt="Product Image">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">PlayStation 4
                          <span class="label label-success pull-right">$399</span></a>
                            <span class="product-description">
                              PlayStation 4 500GB Console (PS4)
                            </span>
                      </div>
                    </li>
                    <!-- /.item -->
                  </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">Ver todos los Productos</a>
                </div>
                <!-- /.box-footer -->
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