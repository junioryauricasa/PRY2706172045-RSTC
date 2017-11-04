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
  <script type="text/javascript">
    function MostrarUsuarioPerfilNav(intIdUsuario){
          var funcion = "MP";
        $.ajax({
         url:"../../datos/usuarios/funcion_usuario.php",
         method:"POST",
         data:{intIdUsuario:intIdUsuario,funcion:funcion},
         dataType:"json",
         success:function(datos)
         {
         $(".imgperfil").attr("src", "../../usuarios/imgperfil/" + datos.nvchImgPerfil);
         }
        });
    }
  </script>
  <style>
  .table {
    border: 2px solid #727070;
  }
  .table > thead > tr > th,
  .table > tbody > tr > th,
  .table > tfoot > tr > th,
  .table > thead > tr > td,
  .table > tbody > tr > td,
  .table > tfoot > tr > td {
    border: 2px solid #727070;
    border-right-width:2px;
    border-left-width:2px;
  }
  .table > thead {
    background: #EAF1F7;
  }
}
  </style>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<script type="text/javascript">MostrarUsuarioPerfilNav(<?php echo $_SESSION['intIdUsuarioSesion']; ?>);</script>
<div class="wrapper">

  <header class="main-header">
    <a href="index" class="logo">
      <span class="logo-mini"><b>R</b>SF</span>
      <span class="logo-lg"><b>Resteco</b>SFT</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style=" display: flex">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu" style="float: left;">
          <ul style="margin-right: 10px; margin-left: 5px" class="nav navbar-nav">
            <li class="" id="ver-en-pc"><a href="../default/">Inicio</a></li>
            <li class="" id="ver-en-pc"><a href="../default/dashboard">Información General</a></li>
            <li class="dropdown" id="ver-en-pc">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Inventario 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="../inventario/vproducto">Registro de Producto</a></li>
                <li><a href="../inventario/ventrada">Administrar Entrada</a></li>
                <li><a href="../inventario/vsalida">Administrar Salida</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Compras
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="../compras/vcompra">Registro de Compras</a></li>
                <li><a href="../compras/vordencompra">Registro de Órdenes de Compra</a></li>
              </ul>
            </li>
            <li class="dropdown" id="ver-en-tablet">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Ventas 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="../ventas/vcliente">Registro de Clientes</a></li>
                <li><a href="../ventas/vventa">Registro de Ventas</a></li>
                <li><a href="../ventas/vcotizacion">Registro de Cotización</a></li>
              </ul>
            </li>
            <li class="dropdown" id="ver-en-tablet">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Reportes
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="../reportes/vkardexproducto">Reporte Kardex Producto</a></li>
                <li><a href="../reportes/vkardexgeneral">Reporte Kardex General</a></li>
              </ul>
            </li>
            <li class="dropdown" id="ver-en-pc">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Usuarios 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="../usuarios/vusuario">Registro de Usuarios</a></li>
                <li><a href="../usuarios/vpermisos">Administrar Permisos</a></li>
                <li><a href="../usuarios/vhistoryaccess">Historial de Accesos</a></li>
              </ul>
            </li>
            <li class="dropdown" id="ver-en-pc">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Administrativo 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="../administrativo/vmonedatributaria">Administrar Cambio de Moneda Tributaria</a></li>
                <li><a href="../administrativo/vmonedacomercial">Administrar Cambio de Moneda Comercial</a></li>
                <li><a href="../administrativo/vnumeracion">Administrar Numeración de Comprobantes</a></li>
              </ul>
            </li>
            <li class="dropdown" id="ver-en-pc">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Mi Cuenta 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="../perfil/vperfil">Mi Perfil</a></li>
                <li><a href="../../logout.php">Cerrar Sesión</a></li>
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
            <img src="" class="img-circle imgperfil" alt="User Image">
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
            <span>Información General</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th-list"></i> <span>Módulo Inventario</span>
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
            <i class="fa fa-cart-plus"></i> <span>Módulo Compras</span>
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
              <a href="../compras/vcompra">
                <i class="fa fa-circle-o"></i> 
                  Registro de Compras
              </a>
            </li>
            <li>
              <a href="../compras/vordencompra">
                <i class="fa fa-circle-o"></i> 
                  Registro de Órdenes <br>
                <i class="fa"></i> de Compras
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
                  <i class="fa fa-list-alt"></i> <span>Módulo Ventas</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="active">
                    <a href="../ventas/vcliente">
                      <i class="fa fa-circle-o"></i> 
                        Registro de Clientes
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

              <!--Reportes-->
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-file-pdf-o"></i> <span>Módulo Reportes</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="../reportes/vkardexproducto">
                      <i class="fa fa-circle-o"></i> 
                        Reporte Kardex Producto
                    </a>
                  </li>
                  <li>
                    <a href="../reportes/vkardexgeneral">
                      <i class="fa fa-circle-o"></i> 
                        Reporte Kardex General
                    </a>
                  </li>
                </ul>
              </li>
              <!--END Reportes-->

              <!--Usuarios-->
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-users"></i> <span>Módulo Usuarios</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="active">
                    <a href="../usuarios/vusuario">
                      <i class="fa fa-circle-o"></i> 
                        Registro de Usuarios
                    </a>
                  </li>
                  <li>
                    <a href="../usuarios/vpermisos">
                      <i class="fa fa-circle-o"></i> 
                        Administrar Permisos
                    </a>
                  </li>
                  <li>
                    <a href="../usuarios/vhistoryaccess">
                      <i class="fa fa-circle-o"></i> 
                       Historial de acceso
                    </a>
                  </li>
                </ul>
              </li>
              <!--END Usuarios-->

              <!--Usuarios-->
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-users"></i> <span>Módulo Administrativo</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="active">
                    <a href="../administrativo/vmonedatributaria">
                      <i class="fa fa-circle-o"></i> 
                        Administrar Cambio de <br>
                        <i class="fa"></i> Moneda Tributaria
                    </a>
                  </li>
                  <li class="active">
                    <a href="../administrativo/vmonedacomercial">
                      <i class="fa fa-circle-o"></i> 
                        Administrar Cambio de <br>
                        <i class="fa"></i> Moneda Comercial
                    </a>
                  </li>
                  <li>
                    <a href="../administrativo/vnumeracion">
                      <i class="fa fa-circle-o"></i> 
                        Administrar Numeración de <br>
                        <i class="fa"></i> Comprobantes
                    </a>
                  </li>
                </ul>
              </li>
              <!--END Usuarios-->
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


  <style>

    /*  Ocultar el menu horizontal de desktop  
    @media screen and (max-width: 1301px){
        .navbar-custom-menu{
            display: none
        }
    }*/

    @media screen and (min-width: 768px){
        .content-wrapper, .right-side, .main-footer {
            margin-left: 0px;
        }
        .main-sidebar{
            width: 0px;
        }
        .sidebar-toggle{
            display: none;
        }
    }


    /*    Redimension de tamaño de la fuente a 12px   */
    .skin-blue .main-header .navbar .nav>li>a , .skin-blue .main-header .navbar .nav > li > ul > li > a{
        font-size: 12px
    }

    .skin-blue .main-header .navbar .dropdown-menu li a {
        color: #494949;
    }



    /* Show Options of menu */
    @media screen and (max-width: 435px){
        #ver-en-pc{
            display: none
        }
        #ver-en-tablet{
            display: none
        }
    }
    @media screen and (min-width: 436px) and (max-width: 768px){
        #ver-en-pc{
            display: none
        }
        #ver-en-tablet{
            display: block
        }
    }
    @media screen and (min-width: 769px){
        #ver-en-pc{
            display: block
        }
        #ver-en-tablet{
            display: block
        }
    }


  </style>