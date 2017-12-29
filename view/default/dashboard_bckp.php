<?php 

    $nvbr_inicio = '';
    $nvbr_infogeneral = 'active';
    // inventario
    $nvbr_inventario = '';
    $nvbr_inventario_registroproducto = '';
    $nvbr_inventario_ubigeoproducto = '';
    // compras
    $nvbr_compras = '';
    $nvbr_compras_registroproveedores = '';
    $nvbr_compras_registrocompras = '';
    $nvbr_compras_ordenesporcompra = '';
    // ventas
    $nvbr_ventas = '';
    $nvbr_ventas_registroclientes = '';
    $nvbr_ventas_registroventas = '';
    $nvbr_ventas_registrocotizacion = '';
    // reportes
    $nvbr_reportes = '';
    $nvbr_reportes_kardexproducto = '';
    $nvbr_reportes_kardexgeneral = '';
    // reportes
    $nvbr_reportes = '';
    $nvbr_reportes_kardexproducto = '';
    $nvbr_reportes_kardexgeneral = '';
    // reportes
    $nvbr_administrativo = '';
    $nvbr_administrativo_cambiomonedatributaria = '';
    $nvbr_administrativo_cambiomonedacomercial = '';
    $nvbr_administrativo_numeraciondecomprobantes = '';
    $nvbr_administrativo_modulousuarios = '';
    $nvbr_administrativo_modulousuarios_registrousuario = '';
    $nvbr_administrativo_modulousuarios_historialusuarios = '';
    // equipos
    $nvbr_equipos = '';
    // cuentas
    $nvbr_cuentas = '';
    $nvbr_cuentas_miperfil = '';
    $nvbr_cuentas_cerrarsession = '';

		include('../_include/rstheader.php');
    include('../../datos/default/class_default.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <?php require_once '../../negocio/usuarios/nusuario.php'; ?>
    <!--<script type="text/javascript" src="../../negocio/usuarios/nusuario.js"></script>-->
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
            Información General
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Panel de consulta tiempo real datos -->
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion-bag"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Productos</span>
                  <span class="info-box-number">
                      <small><?php echo ContarProductos(); ?> Existentes</small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Usuarios</span>
                  <span class="info-box-number">
                      <small><?php echo ContarUsuarios(); ?> Existentes</small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion-ios-person"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Clientes</span>
                  <span class="info-box-number">
                      <small><?php echo ContarClientes(); ?> Existentes</small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </div>
          <!-- END Panel de consulta tiempo real datos -->

          <div class="row">
            
            <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Productos con Stock Mínimo</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                    <?php  
                      try{
                        $sql_conexion = new Conexion_BD();
                        $sql_conectar = $sql_conexion->Conectar();
                        $sql_comando = $sql_conectar->prepare('CALL LISTARCANTIDADMINIMA()');
                        $sql_comando -> execute();
                        while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                        {
                    ?>
                    <li class="item">
                      <div class="product-img">
                        <?php if($fila['nvchDireccionImg'] != "") {?>
                        <img src="<?php echo '../../datos/inventario/imgproducto/'.$fila['nvchDireccionImg']; ?>" alt="Product Image">
                        <?php } else { ?>
                        <img src="http://mobile--shop2.ecudemo4320.cafe24.com/web/product/medium/14_shop2_120454.jpg" alt="Product Image">
                        <?php } ?>
                      </div>
                      <div class="product-info">
                        <div class="product-title"><?php echo $fila['nvchCodigo']; ?>
                          <span class="label label-danger pull-right"><?php echo $fila['nvchNombre']; ?></span><div>
                            <span class="product-description">
                              <div class="pull-left"><?php echo $fila['nvchDescripcion']; ?></div>
                              <div class="pull-right">Cantidad: <?php echo $fila['intCantidadUbigeo']; ?></div>
                            </span>
                      </div>
                    </li>
                    <?php
                        }
                      }
                      catch(PDPExceptio $e){
                        echo $e->getMessage();
                      }
                    ?>
                  </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="../inventario/vproducto" class="uppercase">
                      Ver todos los Productos
                  </a>
                </div>
                <!-- /.box-footer -->
              </div>
            </div>
            <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">10 Últimas Ventas Hechas</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="rwd-table ExcelTable2007" style="width:100%">
                        <thead>
                        <tr>
                          <!--th class="heading" width="25px">&nbsp;</th-->
                          <th class="" width="25px" style="background: #a9c4e9">
                              <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                          </th>
                          <th style="width: 140px" >Numeración</th>
                          <th style="width: 130px">Tipo</th>
                          <th style="min-width: 250px">Cliente</th>
                          <th style="width: 140px">Fecha</th>
                          <th>Moneda</th>
                          <th>Valor Venta</th>
                          <th>IGV</th>
                          <th style="">Venta</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php  
                            try {
                              $sql_conexion = new Conexion_BD();
                              $sql_conectar = $sql_conexion->Conectar();
                              $sql_comando = $sql_conectar->prepare('CALL LISTARULTIMASVENTAS()');
                              $sql_comando -> execute();
                              $i = 1;
                              while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                              {
                                echo
                                '<tr>
                                    <td data-th="ID" class="heading">'.$i.'</td>
                                    <td data-th="Numeración">'.$fila["nvchSerie"].'-'.$fila["nvchNumeracion"].'</td>
                                    <td data-th="Tipo">'.$fila["NombreComprobante"].'</td>
                                    <td data-th="Cliente">'.$fila["NombreCliente"].'</td>
                                    <td data-th="Fecha">'.$fila["dtmFechaCreacion"].'</td>
                                    <td data-th="Moneda" style="text-align: right;">'.$fila["SimboloMoneda"].'</td>
                                    <td data-th="Valor Venta" style="text-align: right;">'.$fila["ValorComprobante"].'</td>
                                    <td data-th="IGV" style="text-align: right;">'.$fila["IGVComprobante"].'</td>
                                    <td data-th="Venta" style="text-align: right;">'.$fila["TotalComprobante"].'</td>
                                </tr>';
                                $i++;
                              }
                            } catch(PDPExceptio $e) {
                              echo $e->getMessage();
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.box-body -->
                  <!--<div class="box-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">
                        <i class="ion-plus-circled"></i>
                        Ingresar Nuevo pedido
                    </a>
                    <a href="" class="btn btn-sm btn-default btn-flat pull-right">
                        <i class="ion-eye"></i>
                        Ver Todos los Pedidos
                    </a>
                  </div>-->
                  <!-- /.box-footer -->
                </div>
                <!-- CUMPLEAÑOS CLIENTES -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Lista de Clientes Cumpleañeros</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="rwd-table ExcelTable2007" style="width:100%">
                        <thead>
                        <tr>
                          <!--th class="heading" width="25px">&nbsp;</th-->
                          <th class="" width="25px" style="background: #a9c4e9">
                              <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                          </th>
                          <th>DNI/RUC</th>
                          <th>Cliente</th>
                          <th>Tipo Cliente</th>
                          <th>Fecha Cumpleaños</th>
                          <th>Días Restantes</th>
                          <th>Gustos</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php  
                            try {
                              $sql_conexion = new Conexion_BD();
                              $sql_conectar = $sql_conexion->Conectar();
                              $sql_comando = $sql_conectar->prepare('CALL BUSCARCLIENTE_HAPPY()');
                              $sql_comando -> execute();
                              $i = 1;
                              while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                              {
                                echo
                                '<tr>
                                    <td data-th="ID" class="heading">'.$i.'</td>
                                    <td data-th="Numeración">'.$fila["DNIRUC"].'</td>
                                    <td data-th="Tipo">'.$fila["NombreCliente"].'</td>
                                    <td data-th="Cliente">'.$fila["TipoCliente"].'</td>
                                    <td data-th="Fecha">'.$fila["FechaNacimiento"].'</td>
                                    <td data-th="Moneda" style="text-align: right;">'.utf8_encode($fila["DiasRestantes"]).'</td>
                                    <td data-th="Valor Venta" style="text-align: right;">'.$fila["nvchGustos"].'</td>
                                </tr>';
                                $i++;
                              }
                            } catch(PDPExceptio $e) {
                              echo $e->getMessage();
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
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


<!-- INICIO - librerias y script para jsonDataTable -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- END - librerias y script para jsonDataTable -->

<?php include('../_include/rstfooter.php'); ?>