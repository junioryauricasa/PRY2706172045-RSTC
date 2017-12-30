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
    input[type="text"]{
      width: 100% !important;
    }

    div .table-responsive{
      /*border: solid 1px #a9c4e9 !important;*/
    }
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
    /*
      *  STYLE for scrool
    */
    #scrool-slim::-webkit-scrollbar-track
    {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
      background-color: #F5F5F5;
    }

    #scrool-slim::-webkit-scrollbar
    {
      width: 6px;
      height: 6px;
      background-color: #F5F5F5;
    }

    #scrool-slim::-webkit-scrollbar-thumb
    {
      background-color: #000000;
    }

    /* CLASS PARA QUITAR EL BORDE A LOS INPUT */
    .input-without-border{
      border: none;
    }

    /* Variables para el ancho */
    :root{
      --anchoCampoTableFooter: 110px;
    }
</style>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini" id="scrool-slim">
<script type="text/javascript">MostrarUsuarioPerfilNav(<?php echo $_SESSION['intIdUsuarioSesion']; ?>);</script>

<div class="wrapper">
  <header class="main-header">
    <a href="#" class="logo" id="RestecoSFT">
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
      
      <?php //include('camposnavbar.php'); // navbar ?>

      <div class="navbar-custom-menu" style="float: left;">
          <ul style="margin-right: 10px; margin-left: 5px" class="nav navbar-nav">
            <li class="<?php echo $nvbr_inicio; ?>" id="ver-en-pc"><a href="../default/">Inicio</a></li>
            <li class="<?php echo $nvbr_infogeneral; ?>" id="ver-en-pc">
              <a href="../default/dashboard">
                Información General
              </a>
            </li>
            <?php 
              if($_SESSION['NombrePermiso'] == 'Administrador' || $_SESSION['NombrePermiso'] == 'Almacenero'){
                echo ""
            ?>
            <li class="dropdown <?php echo $nvbr_inventario; ?>" id="ver-en-pc">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Inventario 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li class="<?php echo $nvbr_inventario_registroproducto; ?>">
                    <a href="../inventario/vproducto">Registro de Producto</a>
                </li>
                <li class="<?php echo $nvbr_inventario_ubigeoproducto ?>">
                    <a href="../inventario/vubigeoproducto">Ubigeo del Producto</a>
                </li>
                <!--<li><a href="../inventario/ventrada">Administrar Entrada</a></li>
                <li><a href="../inventario/vsalida">Administrar Salida</a></li>-->
              </ul>
            </li>
            <?php 
            "";
              }
            ?>
            <?php 
              if($_SESSION['NombrePermiso'] == 'Administrador' || $_SESSION['NombrePermiso'] == 'Almacenero'){
                echo ""
            ?>
            
            <li class="dropdown <?php echo $nvbr_compras ?>" id="ver-en-pc">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Compras
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li class="<?php echo $nvbr_compras_registroproveedores; ?>">
                    <a href="../compras/vproveedor">Registro de Proveedores</a>
                </li>
                <li class="<?php echo $nvbr_compras_registrocompras; ?>">
                    <a href="../compras/vcompra">Registro de Compras</a>
                </li>
                <li class="<?php echo $nvbr_compras_ordenesporcompra; ?>">
                    <a href="../compras/vordencompra">Registro de Órdenes de Compra</a>
                </li>
              </ul>
            </li>

            <?php 
            "";
              }
            ?>
            <?php 
              if($_SESSION['NombrePermiso'] == 'Administrador' || $_SESSION['NombrePermiso'] == 'Vendedor'){
                echo ""
            ?>
            <li class="dropdown <?php echo $nvbr_ventas; ?>" id="ver-en-tablet">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Ventas 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li class="<?php echo $nvbr_ventas_registroclientes; ?>">
                    <a href="../ventas/vcliente">Registro de Clientes</a>
                </li>
                <li class="<?php echo $nvbr_ventas_registroventas; ?>">
                    <a href="../ventas/vventa">Registro de Ventas</a>
                </li>
                <li class="<?php echo $nvbr_ventas_registrocotizacion; ?>">
                    <a href="../ventas/vcotizacion">Registro de Cotización</a>
                </li>
              </ul>
            </li>
            <?php 
            "";
              }
            ?>
            <?php 
              if($_SESSION['NombrePermiso'] == 'Administrador'){
                echo ""
            ?>
            <li class="dropdown <?php echo $nvbr_reportes ?>" id="ver-en-tablet" role="menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Reportes
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li class="<?php echo $nvbr_reportes_kardexproducto ?>">
                    <a href="../reportes/vkardexproducto">Reporte Kardex Producto</a>
                </li>
                <li class="<?php echo $nvbr_reportes_kardexgeneral ?>">
                    <a href="../reportes/vkardexgeneral">Reporte Kardex General</a>
                </li>
              </ul>
            </li>
            <?php 
            "";
              }
            ?>
            <!--li class="dropdown" id="ver-en-pc">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Usuarios 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="../usuarios/vusuario">Registro de Usuarios</a></li>
                <li><a href="../usuarios/vpermisos">Administrar Permisos</a></li>
                <li><a href="../historialacceso/vhistorialacceso">Historial de Accesos</a></li>
              </ul>
            </li-->
            <?php 
              if($_SESSION['NombrePermiso'] == 'Administrador'){
                echo ""
            ?>
            <li class="dropdown <?php echo $nvbr_administrativo; ?>" id="ver-en-pc">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Administrativo 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li class='<?php echo $nvbr_administrativo_cambiomonedatributaria; ?>'>
                    <a href="../administrativo/vmonedatributaria">Administrar Cambio de Moneda Tributaria</a>
                </li>
                <li class='<?php echo $nvbr_administrativo_cambiomonedacomercial; ?>'>
                    <a href="../administrativo/vmonedacomercial">Administrar Cambio de Moneda Comercial</a>
                </li>
                <!--li class='<?php echo $$nvbr_administrativo_numeraciondecomprobantes; ?>'>
                    <a href="../administrativo/vnumeracion">Administrar Numeración de Comprobantes</a>
                </li-->
                <li class="dropdown-submenu <?php echo $nvbr_administrativo_modulousuarios; ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Módulo Usuarios</a>
                    <ul class="dropdown-menu">
                        <li class='<?php echo $nvbr_administrativo_modulousuarios_registrousuario ?>'>
                            <a href="../usuarios/vusuario">Registro de Usuarios</a>
                        </li>
                        <!--<li><a href="../usuarios/vpermisos">Administrar Permisos</a></li>-->
                        <li class='<?php echo $nvbr_administrativo_modulousuarios_historialusuarios ?>'>
                            <a href="../historialacceso/vhistorialacceso">Historial de Accesos</a>
                        </li>
                    </ul>
                </li>
              </ul>
            </li>
            <?php 
            "";
              }
            ?>
            <?php 
              if($_SESSION['NombrePermiso'] == 'Administrador'){
                echo ""
            ?>
            <li class="<?php echo $nvbr_equipos; ?>" id="ver-en-pc"><a href="../equipo/vcotizacionequipo">Equipos</a></li>
            <?php 
            "";
              }
            ?>
            <li class="dropdown <?php echo $nvbr_cuentas; ?>" id="ver-en-pc">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Mi Cuenta 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li class="<?php echo $nvbr_cuentas_miperfil; ?>">
                    <a href="../perfil/vperfil">Mi Perfil</a>
                </li>
                <li class="<?php echo $nvbr_cuentas_cerrarsession; ?>">
                    <a href="../../logout.php">Cerrar Sesión</a>
                </li>
              </ul>
            </li>
          </ul>
          <?php 
            require_once '../../datos/conexion/bd_conexion.php';
            $dtmFechaCambio =  date('Y-m-d');
            $sql_conexion_moneda = new Conexion_BD();
            $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
            $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDACOMERCIALFECHA(:dtmFechaCambio)');
            $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
            $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
          ?>
          <ul  id="tasa_de_cambio" class="nav navbar-nav navbar-right" style="float: right !important; position: absolute; right: 10px">
            <li class="active" style="font-weight:bolder">
              <a href="#">1USD = <?php echo number_format($fila_moneda['dcmCambio2'],2,'.',','); ?>PEN</a>
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
          if($_SESSION['NombrePermiso'] == 'Administrador' || $_SESSION['NombrePermiso'] == 'Almacenero'){
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
        <?php 
            "";
          }
        ?>


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
                    <a href="../historialacceso/vhistorialacceso">
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


    /* Submenu */
    .dropdown-submenu {
    position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .dropdown-submenu>a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }

    .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
    }

    .dropdown-submenu.pull-left {
        float: none;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }


    /* Show Options of menu */
    @media screen and (max-width: 435px){
        #ver-en-pc{
            display: none
        }
        #ver-en-tablet{
            display: none
        }

        /* Ver logo in navbar*/
        #RestecoSFT{
          display: block
        }
    }
    @media screen and (min-width: 436px) and (max-width: 768px){
        #ver-en-pc{
            display: none
        }
        #ver-en-tablet{
            display: block
        }

        /* Ver logo in navbar*/
        #RestecoSFT{
          display: none
        }
        .main-header>.navbar{
          margin-left: 0px
        }
    }
    @media screen and (min-width: 769px){
        #ver-en-pc{
            display: block
        }
        #ver-en-tablet{
            display: block
        }

        /* Ver logo in navbar*/
        #RestecoSFT{
          display: none
        }
        .main-header>.navbar{
          margin-left: 0px
        }
    }


    /* Alinear dropdown-list in responsive view */
    @media (max-width: 991px){
        .navbar-custom-menu>.navbar-nav>li {
            position: relative;
        }
        .navbar-custom-menu>.navbar-nav>li>.dropdown-menu {
            right: 0%;
        }
    }

    /* Responsive table */


.rwd-table th {
  display: none;
}
.rwd-table td {
  display: block;
}
.rwd-table td:first-child {
  /*padding-top: .5em;*/
  margin-top: 15px
}
.rwd-table td:last-child {
  /*padding-bottom: .5em;*/
  margin-bottom: 15px
}
.rwd-table td:before {
  content: attr(data-th) ": ";
  font-weight: bold;
}

@media (min-width: 480px) {
  .rwd-table td:before {
    display: none;
  }
}


@media (min-width: 480px) {
  .rwd-table th, .rwd-table td {
    display: table-cell;
  }
}

.rwd-table {
  overflow: hidden;
}

@media screen and (max-width: 767px){
  table.table{
      border: solid 1px white
  }
}
@media screen and (max-width: 767px){
.table-responsive {
      border: solid 0px white
  }
}

@media screen and (max-width: 767px){
  .table-responsive>.table>tbody>tr>td, 
  .table-responsive>.table>tbody>tr>th, 
  .table-responsive>.table>tfoot>tr>td, 
  .table-responsive>.table>tfoot>tr>th, 
  .table-responsive>.table>thead>tr>td, 
  .table-responsive>.table>thead>tr>th {
      white-space: normal;
  }
}

/* Table style 2007 */
.ExcelTable2007 {
    border: 1px solid #B0CBEF;
    border-width: 1px 0px 0px 1px;
    font-size: 11pt;
    /*font-family: Calibri;
    font-weight: 100;*/
    border-spacing: 0px;
    border-collapse: collapse;

    border-right:  1px solid #D0D7E5;
}

.ExcelTable2007 tr {
    border:  2px solid #D0D7E5;
    border-right-width:2px;
    border-left-width:2px;
    border-bottom-width: 2px
}

.ExcelTable2007 TH {
  
    font-weight: bolder;

    background-image: url('../../datos/usuarios/imgperfil/excel-2007-header-bg.gif');
    background-repeat: repeat-x; 
    font-size: 14px;
    border: 1px solid #9EB6CE;
    border-width: 0px 1px 1px 0px;
    height: 17px;
    text-align: center;
    background: rgba(212,228,239,1);
    background: -moz-linear-gradient(top, rgba(212,228,239,1) 0%, rgba(212,228,239,1) 11%, rgba(212,228,239,1) 31%, rgba(183,195,204,1) 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(212,228,239,1)), color-stop(11%, rgba(212,228,239,1)), color-stop(31%, rgba(212,228,239,1)), color-stop(100%, rgba(183,195,204,1)));
    background: -webkit-linear-gradient(top, rgba(212,228,239,1) 0%, rgba(212,228,239,1) 11%, rgba(212,228,239,1) 31%, rgba(183,195,204,1) 100%);
    background: -o-linear-gradient(top, rgba(212,228,239,1) 0%, rgba(212,228,239,1) 11%, rgba(212,228,239,1) 31%, rgba(183,195,204,1) 100%);
    background: -ms-linear-gradient(top, rgba(212,228,239,1) 0%, rgba(212,228,239,1) 11%, rgba(212,228,239,1) 31%, rgba(183,195,204,1) 100%);
    background: linear-gradient(to bottom, rgba(212,228,239,1) 0%, rgba(212,228,239,1) 11%, rgba(212,228,239,1) 31%, rgba(183,195,204,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d4e4ef', endColorstr='#b7c3cc', GradientType=0 );
}

.ExcelTable2007 TD {
    border: 0px;
    /*background-color: white;*/
    
    padding-top: 3px;
    padding-bottom: 3px;
    padding-right: 5px;
    padding-left: 5px;
    
    border: 1px solid #D0D7E5;
    border-width: 0px 1px 1px 0px;

    text-align: left;
    padding-left: 5px

    border-right:  1px solid #D0D7E5;
}

.ExcelTable2007 TD B {
    border: 0px;
    background-color: white;
    font-weight: bold;
}

.ExcelTable2007 TD.heading {
    background-color: #E4ECF7;
    text-align: center;
    border: 1px solid #9EB6CE;
    border-width: 0px 1px 1px 0px;
    border-right:  1px solid #D0D7E5;

}

.ExcelTable2007 TH.heading {
    background-image: url('../../datos/usuarios/imgperfil/excel-2007-header-left.gif');
    background-repeat: none;
}



table tr:hover{
    background-color: #80808038;
}

/*
text area el ancho 
*/
textarea{
    max-width: 100%;
    min-width: 100%;

    min-height: 100px;
    overflow-x: hidden;
}


/*
  rows / registros deshabilitados
*/
table tr .deshabilitado{
  background-color: #ff0000ba;
}


#chatbox{
  z-index: 1000;
  width: 300px;
  position: fixed;
  right: 0px;
  bottom: 0px;

  margin-bottom: 0px;
}


/* alineamiento de moneda */
#dcmTotal1{
  /*text-align: right;*/
}

.navbar-custom-menu > ul > li > ul > li.active > a , 
.navbar-custom-menu > ul > li > ul > li > ul > li.active > a 
{
  background-color: #eaeaea !important;
}

/* Estilo para tasa de cambio */
#tasa_de_cambio{
      display: none;
}
@media screen and (min-width: 944px){
  #tasa_de_cambio{
      display: block;
  }
}

/*
  truncate Texto
*/
.truncate-text {
    white-space: nowrap; 
    width: 50px !important; 
    overflow: hidden;
    text-overflow: ellipsis; 
}

</style>