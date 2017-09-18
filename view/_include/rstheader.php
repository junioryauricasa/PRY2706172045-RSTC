<?php 
session_start();
if(!isset($_SESSION['intIdUsuarioSesion']))
{
    header("Location: ../../");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panel Control | RestecoSFT</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../frameworks/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../../frameworks/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../frameworks/dist/css/skins/_all-skins.min.css">

  <script src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
  <link rel="icon" href="../../frameworks/dist/img/icons/025-pie-chart.png" type="image/png" sizes="16x16">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
  <script type="text/javascript" src="../../frameworks/bootstrap-filestyle/src/bootstrap-filestyle.min.js">$(":file").filestyle({input: false});</script>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="index" class="logo">
      <span class="logo-mini"><b>R</b>SF</span>
      <span class="logo-lg"><b>Resteco</b>SFT</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $_SESSION['nvchImgPerfil']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['NombresApellidos'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $_SESSION['nvchImgPerfil']; ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $_SESSION['NombresApellidos'];?> - <?php echo $_SESSION['NombrePermiso']; ?>
                  <!--small>Member since Nov. 2012</small-->
                </p>
              </li>
              <!-- Menu Body -->
              <!--li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div-->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="../perfil/vperfil" class="btn btn-default btn-flat">
                      <i class="ion-ios-person"></i>
                      Mi Perfil
                  </a>
                </div>
                <div class="pull-right">
                  <a href="../../logout.php" class="btn btn-danger btn-flat" style="border-radius: 3px">
                      <i class="ion-log-out"></i>
                      Salir
                  </a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $_SESSION['nvchImgPerfil']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['NombresApellidos']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENÚ RESTECO SFT</li>
      <li>
        <a href="../default/">
          <i class="fa fa-home"></i> 
          <span>Inicio</span>
        </a>
      </li>
      <li>
        <a href="../default/dashboard">
          <i class="fa fa-dashboard"></i> 
          <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-th-list"></i> <span>Inventario</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active">
            <a href="../inventario/vproducto">
              <i class="fa fa-circle-o"></i> 
                Registro de Productos
            </a>
          </li>
          <li>
            <a href="../inventario/ventrada">
              <i class="fa fa-circle-o"></i> 
                Administrar Entrada
            </a>
          </li>
          <li>
            <a href="../inventario/vsalida">
              <i class="fa fa-circle-o"></i> 
                Administrar Salida
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cart-plus"></i> <span>Compras</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active">
            <a href="../compras/vproveedor">
              <i class="fa fa-circle-o"></i> 
                Registro de Proveedores
            </a>
          </li>
          <li>
            <a href="../compras/vordencompra">
              <i class="fa fa-circle-o"></i> 
                Registro de Compras
            </a>
          </li>
        </ul>
      </li>
      <?php 
        if($_SESSION['NombrePermiso'] == 'Administrador'){
          echo ""
      ?>

            <!--Ventas-->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-list-alt"></i> <span>Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active">
                  <a href="../ventas/vcliente">
                    <i class="fa fa-circle-o"></i> 
                      Clientes
                  </a>
                </li>
                <li>
                  <a href="../ventas/vventa">
                    <i class="fa fa-circle-o"></i> 
                      Registro de Ventas
                  </a>
                </li>
                <li>
                  <a href="../ventas/vcotizacion">
                    <i class="fa fa-circle-o"></i> 
                      Registro de Cotización
                  </a>
                </li>
              </ul>
            </li>
            <!--END Ventas-->

            <!--Usuarios-->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active">
                  <a href="../usuario/vusuario" target="_blank">
                    <i class="fa fa-circle-o"></i> 
                      Administrar Usuarios
                  </a>
                </li>
                <li>
                  <a href="../permisos/vpermisos">
                    <i class="fa fa-circle-o"></i> 
                      Administrar Permisos
                  </a>
                </li>
                <li>
                  <a href="../historialacceso/vhistoryaccess">
                    <i class="fa fa-circle-o"></i> 
                     Historial de acceso
                  </a>
                </li>
              </ul>
            </li>
            <!--END Usuarios-->


            <!--Reportes-->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-pdf-o"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="../reporte/vlistarusuario" target="_blank">
                    <i class="fa fa-circle-o"></i> 
                      Listar de Usuarios
                  </a>
                </li>
                <li>
                  <a href="#" >
                  <!--a href="../reporte/vlistarcliente" target="_blank"-->
                    <i class="fa fa-circle-o"></i> 
                     Lista Clientes
                  </a>
                </li>
                <li>
                  <a href="../reporte/vlistaracceso" target="_blank">
                    <i class="fa fa-circle-o"></i> 
                      Lista de Accesos
                  </a>
                </li>
                <li>
                  <a href="../reporte/listarcomprobante">
                    <i class="fa fa-circle-o"></i> 
                      Formato Comprobantes
                  </a>
                </li>
              </ul>
            </li>
            <!--END Reportes-->
          <?php 
          "";
        }

      ?>

          <!--Mi cuenta-->
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> 
                <span>Mi Cuenta</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="../perfil/vperfil">
                  <i class="fa fa-circle-o"></i> 
                    Mi Perfil
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="../../logout.php">
              <i class="fa fa-circle-o text-red"></i> 
              <span>Cerrar sesion</span>
            </a>
          </li>
          <!-- END user logout -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>