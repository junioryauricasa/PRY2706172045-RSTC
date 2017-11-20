<?php 
include('../_include/rstheader.php');
require_once '../../datos/conexion/bd_conexion.php';
?>  
    <?php require_once '../../negocio/comprobante/ncomprobante.php'; ?>
    <?php require_once '../../negocio/comprobante/ndetallecomprobante.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <?php require_once '../../view/modals/vformCliente.php'; ?>
    <?php require_once '../../view/modals/vformProducto.php'; ?>
    <?php require_once '../../view/modals/vformCotizacion.php'; ?>
    <?php require_once '../../negocio/inventario/nproducto.php'; ?>

    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <script type="text/javascript">
    var num = 2;
    var nums = 2;
    var numm = 2;
    var numfila = 0;
    $(document).on('keyup', '.buscar', function(){
      $(this).closest('tr').find("input[name='fila[]']").each(function() {
         numfila = this.value;
      });

      var search = $(this).val();
      search = search.replace(/\s/g,'');
      var funcion = "BP"
      if(search != '')
      {
          var intIdTipoMoneda = $("#intIdTipoMoneda").val();
          $.ajax({
          type: "POST",
          url: "../../datos/inventario/funcion_producto.php",
          data: {search:search,funcion:funcion,intIdTipoMoneda:intIdTipoMoneda},
          cache: false,
          success: function(html)
          {
            $("#result"+numfila).html(html).show();
          }
          });
      }
      else {
        $("#result"+numfila).html("").hide();
      }
      return false; 
    });

    $(document).on('click', '.result', function(e){
      var clicked = $(e.target);
      if(!clicked.find('.nvchCodigo').html()) {
        $("#formProducto").modal("show");
      } else {
        var nvchCodigo = clicked.find('.nvchCodigo').html();
        var intIdProducto = clicked.find('.intIdProducto').val();
        nvchCodigo = nvchCodigo.replace(/\s/g,'');
        intIdProducto = intIdProducto.replace(/\s/g,'');
        $('#nvchCodigo'+numfila).val(nvchCodigo);
        $(".result").html("").hide();
        InsertarProductoElegido(intIdProducto,numfila);
      }
      numfila = 0;
    });

    $(document).on('click', '.buscar', function(){
      $(".result").html("").hide();
    });

    $(document).on('click', function(e){
      var clicked = $(e.target);
      if (!clicked.hasClass("buscar")){
        $(".result").html("").hide();
      }
    });

    function InsertarProductoElegido(intIdProducto,id){
      var funcion = "SP";
      var intIdTipoMoneda = $("#intIdTipoMoneda").val();
      $.ajax({
       url:"../../datos/inventario/funcion_producto.php",
       method:"POST",
       data:{intIdProducto:intIdProducto,funcion:funcion,intIdTipoMoneda:intIdTipoMoneda},
       dataType:"json",
       success:function(datos)
       {
        $("#intIdProducto"+id).val(datos.intIdProducto);
        $("#dcmPrecio"+id).val(datos.dcmPrecioVenta1);
        $("#nvchDescripcion"+id).val(datos.nvchDescripcion);
        $("#dcmDescuentoVenta2"+id).val(datos.dcmDescuentoVenta2);
        $("#dcmDescuentoVenta3"+id).val(datos.dcmDescuentoVenta3);
       }
      });
    }

    function AgregarFila(intIdTipoVenta){
    if(intIdTipoVenta == 1){
        $('#ListaDeProductosVender').append(
        '<tr>'+
          '<td class="heading" data-th="ID"></td>'+
          '<td><input type="hidden" style="width: 110px !important" name="fila[]" value="'+num+'" form="form-comprobante" />'+
              '<input type="hidden" style="width: 110px !important" id="intIdProducto'+num+'" name="intIdProducto[]" form="form-comprobante" />'+
              '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigo'+num+'" name="nvchCodigo[]" form="form-comprobante" />'+
              '<div class="result" id="result'+num+'">'+
          '</td>'+
          '<td><input type="text" style="width: 100% !important" id="nvchDescripcion'+num+'" name="nvchDescripcion[]" form="form-comprobante" readonly/></td>'+
          '<td>'+
            '<input type="text" id="dcmPrecio'+num+'" name="dcmPrecio[]" form="form-comprobante" readonly />'+
            '<input type="hidden" id="dcmDescuentoVenta2'+num+'" form="form-comprobante" readonly />'+
            '<input type="hidden" id="dcmDescuentoVenta3'+num+'" form="form-comprobante" readonly />'+
          '</td>'+
          '<td><input type="text" style="max-width: 105px !important" id="dcmDescuento'+num+'" name="dcmDescuento[]" form="form-comprobante" idsprt="'+num+'"'+
            'onkeyup="CalcularPrecioTotal(this)"/></td>'+
          '<td><input type="text" style="max-width: 105px !important" id="dcmPrecioUnitario'+num+'" name="dcmPrecioUnitario[]" form="form-comprobante" readonly/></td>'+
          '<td><input type="text" id="intCantidad'+num+'" name="intCantidad[]" form="form-comprobante" idsprt="'+num+'"'+
            'onkeyup="CalcularPrecioTotal(this)"/></td>'+
          '<td><input type="text" id="dcmTotal'+num+'" name="dcmTotal[]" form="form-comprobante" readonly/></td>'+
          '<td>'+
            '<button type="button" style="width: 25px !important" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit" data-toggle="tooltip" title="Eliminar!"></i></button>'+
          '</td>'+
        '</tr>');
        num++;
      } else if(intIdTipoVenta == 2){
        $('#ListaDeServiciosVender').append(
        '<tr>'+
          '<td class="heading" data-th="ID"></td>'+
          '<td>'+
            '<input style="width: 110px !important" type="hidden" name="fila[]" value="'+nums+'" form="form-comprobante" />'+
            '<textarea id="nvchDescripcionS'+nums+'" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionS[]" form="form-comprobante" rows="4"></textarea>'+
            //'<input type="text" style="width: 100%" id="nvchDescripcionS'+nums+'" name="nvchDescripcionS[]" form="form-comprobante" />'+
          '</td>'+
          '<td>'+
            '<input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioS'+nums+'" name="dcmPrecioUnitarioS[]" idsprt="'+nums+'" form="form-comprobante" onkeyup="CalcularPrecioTotalS(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="intCantidadS'+nums+'" name="intCantidadS[]" idsprt="'+nums+'" form="form-comprobante" onkeyup="CalcularPrecioTotalS(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="dcmTotalS'+nums+'" name="dcmTotalS[]" form="form-comprobante" readonly/>'+
          '</td>'+
          '<td style="width: 25px !important" >'+
            '<button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">'+
                '<i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i>' +
            '</button>'+
          '</td>'+
        '</tr>');
        nums++;
      } else if(intIdTipoVenta == 3){
        $('#ListaDeMaquinariasVender').append(
        '<tr>'+
          '<td class="heading" data-th="ID"></td>'+
          '<td>'+
            '<input style="width: 110px !important" type="hidden" name="fila[]" value="'+numm+'" form="form-comprobante" />'+
            '<textarea id="nvchDescripcionM'+numm+'" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionM[]" form="form-comprobante" rows="4"></textarea>'+
            //'<input type="text" style="width: 100%" id="nvchDescripcionS'+nums+'" name="nvchDescripcionS[]" form="form-comprobante" />'+
          '</td>'+
          '<td>'+
            '<input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioM'+numm+'" name="dcmPrecioUnitarioM[]" idsprt="'+numm+'" form="form-comprobante" onkeyup="CalcularPrecioTotalM(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="intCantidadM'+numm+'" name="intCantidadM[]" idsprt="'+numm+'" form="form-comprobante" onkeyup="CalcularPrecioTotalM(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="dcmTotalM'+numm+'" name="dcmTotalM[]" form="form-comprobante" readonly/>'+
          '</td>'+
          '<td style="width: 25px !important" >'+
            '<button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">'+
                '<i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i>' +
            '</button>'+
          '</td>'+
        '</tr>');
        numm++;
      }
    }

    function formCliente(){
      $("#formCliente").modal("show");
    }

    function formCotizacion(){
      $("#formCotizacion").modal("show");
    }

    function ElegirTabla(intIdTipoVenta){
      if(intIdTipoVenta == 1){
        $("#tablaRepuestos").show();
        $("#tablaServicios").hide();
        $("#tablaMaquinarias").hide();
        CalcularTotal();
      } else if(intIdTipoVenta == 2) {
        $("#tablaRepuestos").hide();
        $("#tablaServicios").show();
        $("#tablaMaquinarias").hide();
        CalcularTotal();
      } else if(intIdTipoVenta == 3) {
        $("#tablaRepuestos").hide();
        $("#tablaServicios").hide();
        $("#tablaMaquinarias").show();
        CalcularTotal();
      }
    }
    </script>
    <style>
    textarea.textoarea:first-line { font-weight: bold; }
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
    .result
    {
        position: absolute;
        z-index: 1;
        width:500px;
        padding:10px;
        display:none;
        margin-top:-1px;
        border-top:0px;
        overflow:hidden;
        border:1px #CCC solid;
        background-color: white;
    }
    .show
    {
        padding:10px;
        border-bottom:1px solid #000000;
        font-size:15px; 
        height:50px;
    }
    .show:hover
    {
        background:#4c66a4;
        color:#FFF;
        cursor:pointer;
    }
    </style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Registro de Ventas
        <small>Módulo de Ventas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../default/index">Inicio</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Fixed</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- TABLE: LATEST USERS -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#formRealizarComprobante" id="btnFormRealizarComprobante" data-toggle="tab" aria-expanded="true">Realizar Venta</a></li>
          <li class=""><a href="#formListarComprobante" id="btnFormListarComprobante" data-toggle="tab" aria-expanded="false">Lista de Ventas</a></li>
        </ul>
        <div class="tab-content">
          <!-- INICIO - Formulario Realizar Venta -->
          <form id="form-comprobante" method="POST"></form>
          <div class="tab-pane active" id="formRealizarComprobante">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Fecha Actual:</label>
                  <input type="text" id="nvchFecha" name="nvchFecha" class="form-control select2" readonly form="form-comprobante"/>
                  <script type="text/javascript">$("#nvchFecha").val(FechaActual());</script>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Lugar de Venta:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="intIdSucursal" name="intIdSucursal"  class="form-control select2" form="form-comprobante">
                  <?php 
                    try{   
                    $sql_conexion = new Conexion_BD();
                    $sql_conectar = $sql_conexion->Conectar();
                    $sql_comando = $sql_conectar->prepare('CALL mostrarsucursal()');
                    $sql_comando->execute();
                    while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                    {
                      echo '<option value="'.$fila['intIdSucursal'].'">'.$fila['nvchNombre'].'</option>';
                    }
                  }catch(PDPExceptions $e){
                    echo $e->getMessage();
                  }?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo de Comprobante:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="intIdTipoComprobante" name="intIdTipoComprobante"  class="form-control select2" form="form-comprobante">
                  <?php 
                    try{
                    $sql_conexion = new Conexion_BD();
                    $sql_conectar = $sql_conexion->Conectar();
                    $sql_comando = $sql_conectar->prepare('CALL mostrartipocomprobante(:intTipoDetalle)');
                    $sql_comando->execute(array(':intTipoDetalle' => 1));
                    while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                    {
                      echo '<option value="'.$fila['intIdTipoComprobante'].'">'.$fila['nvchNombre'].'</option>';
                    }
                  }catch(PDPExceptions $e){
                    echo $e->getMessage();
                  }?>
                </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Serie:</label>
                  <input type="text" id="nvchSerie" name="nvchSerie" class="form-control select2" readonly form="form-comprobante"/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Numeración:</label>
                  <input type="text" id="nvchNumeracion" name="nvchNumeracion" class="form-control select2" readonly form="form-comprobante"/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Seleccionar el Tipo de Venta:</label>
                  <select id="intIdTipoVenta" name="intIdTipoVenta" onchange="ElegirTabla(this.value)" class="form-control select2" form="form-comprobante">
                    <?php try{
                      $sql_conexion = new Conexion_BD();
                      $sql_conectar = $sql_conexion->Conectar();
                      $sql_comando = $sql_conectar->prepare('CALL mostrartipoventa()');
                      $sql_comando->execute();
                      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                      {
                        echo '<option value="'.$fila['intIdTipoVenta'].'">'.$fila['nvchNombre'].'</option>';
                      }
                    }catch(PDPExceptions $e){
                      echo $e->getMessage();
                    }?>
                  </select>
                </div>
              </div>
              <script type="text/javascript">MostrarSeleccionComprobante();</script>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo de Moneda:</label>
                  <select id="intIdTipoMoneda" name="intIdTipoMoneda" class="form-control select2" onchange="CambiarMoneda()" form="form-comprobante">
                    <?php try{
                      $sql_conexion = new Conexion_BD();
                      $sql_conectar = $sql_conexion->Conectar();
                      $sql_comando = $sql_conectar->prepare('CALL mostrartipomoneda()');
                      $sql_comando->execute();
                      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                      {
                        echo '<option value="'.$fila['intIdTipoMoneda'].'">'.$fila['nvchNombre'].'</option>';
                      }
                    }catch(PDPExceptions $e){
                      echo $e->getMessage();
                    }?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Forma de Pago:</label>
                  <select id="intIdTipoPago" name="intIdTipoPago" class="form-control select2" form="form-comprobante">
                    <?php try{
                      $sql_conexion = new Conexion_BD();
                      $sql_conectar = $sql_conexion->Conectar();
                      $sql_comando = $sql_conectar->prepare('CALL mostrartipopago()');
                      $sql_comando->execute();
                      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                      {
                        echo '<option value="'.$fila['intIdTipoPago'].'">'.$fila['nvchNombre'].'</option>';
                      }
                    }catch(PDPExceptions $e){
                      echo $e->getMessage();
                    }?>
                  </select>
                </div>
              </div>
              <div class="col-md-2 opcion-boton-nuevo">
                <div class="form-group">
                  <label>Seleccionar Cliente:</label>
                  <input type="button" class="form-control select2 btn btn-md btn-primary btn-flat" value="Buscar" onclick="formCliente()">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>DNI/RUC:</label>
                  <input type="text" id="nvchNumDocumento" name="nvchDNIRUC" class="form-control select2" form="form-comprobante" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Razón Social/Nombres:</label>
                  <input type="text" id="nvchDenominacion" name="nvchClienteProveedor" class="form-control select2" form="form-comprobante" readonly>
                </div>
              </div>   
              <div class="col-md-4">
                <div class="form-group">
                  <label>Domicilio:</label>
                  <input type="text" id="nvchDomicilio" name="nvchDireccion" class="form-control select2" form="form-comprobante" readonly>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo de Cliente:</label>
                  <input type="text" id="TipoCliente" class="form-control select2" readonly>
                  <input type="hidden" id="intIdTipoCliente">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 opcion-boton-nuevo">
                <div class="form-group">
                  <label>Agregar Fila:</label>
                  <input type="button" onclick="AgregarFila($('#intIdTipoVenta').val())" value="Agregar +" class="form-control select2 btn btn-md btn-primary btn-flat" />
                </div>
              </div>
              <div class="col-md-2 opcion-boton-nuevo">
                <div class="form-group">
                  <label>Seleccionar Cotización:</label>
                  <input type="button" onclick="formCotizacion()" value="Agregar +" class="form-control select2 btn btn-md btn-primary btn-flat" />
                </div>
              </div>
            </div>

            <!-- INICIO Tabla - Repuestos -->
            <div id="tablaRepuestos">
            <div class="row">
              <div class="col-md-12">
                <!-- Comentar-->
                <div class="table-responsive" style="max-height: 310px; overflow-y: visible;" id="scrool-slim">
                  <table class="ExcelTable2007 rwd-table" width="100%">
                    <thead>
                    <tr>
                      <th class="heading" width="25px">&nbsp;</th>
                      <th style="width: 110px" >Código</th>
                      <th>Descripción</th>
                      <th style="width: 110px" >Precio Lista</th>
                      <th style="width: 110px" >Desc. (%)</th>
                      <th style="width: 110px" >Precio Unit.</th>
                      <th style="width: 110px" >Cantidad</th>
                      <th style="width: 110px" >Total</th>
                      <th style="width: 25px !important" class="opcion-columna-nuevo"></th>
                    </tr>
                    </thead>
                    <tbody id="ListaDeProductosVender">
                      <tr>
                        <td class="heading" data-th="ID"></td>
                        <td>
                            <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-comprobante" />
                            <input style="width: 110px !important" type="hidden" id="intIdProducto1" name="intIdProducto[]" form="form-comprobante" />
                            <input style="width: 110px !important" type="text" class="buscar input-without-border" id="nvchCodigo1" name="nvchCodigo[]" form="form-comprobante" />
                            <div class="result" id="result1">
                        </td>
                        <td>
                            <input type="text" style="width: 100%" id="nvchDescripcion1" name="nvchDescripcion[]" form="form-comprobante" class="input-without-border" readonly/>
                        </td>
                        <td>
                            <input type="text" id="dcmPrecio1" name="dcmPrecio[]" form="form-comprobante" class="input-without-border" readonly />
                            <input type="hidden" id="dcmDescuentoVenta21" form="form-comprobante" readonly />
                            <input type="hidden" id="dcmDescuentoVenta31" form="form-comprobante" readonly />
                        </td>
                        <td>
                            <input style="max-width: 105px !important" type="text" id="dcmDescuento1" name="dcmDescuento[]" form="form-comprobante" class="input-without-border" idsprt="1" 
                          onkeyup="CalcularPrecioTotal(this)"/>
                        </td>
                        <td>
                            <input style="max-width: 105px !important"  type="text" id="dcmPrecioUnitario1" name="dcmPrecioUnitario[]" form="form-comprobante" class="input-without-border" readonly/>
                        </td>
                        <td>
                            <input type="text" id="intCantidad1" name="intCantidad[]" form="form-comprobante" idsprt="1"
                          onkeyup="CalcularPrecioTotal(this)" class="input-without-border"/>
                        </td>
                        <td>
                            <input type="text" id="dcmTotal1" name="dcmTotal[]" form="form-comprobante" class="input-without-border" readonly/>
                        </td>
                        <td style="width: 25px !important" >
                            <button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">
                                <i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i> 
                            </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
            <!-- FIN Tabla - Repuestos -->

            <!-- INICIO Tabla - Servicios -->
            <div id="tablaServicios">
            <div class="row">
              <div class="col-md-12">
                <!-- Comentar-->
                <div class="table-responsive" style="max-height: 310px; overflow-y: visible;">
                  <table class="ExcelTable2007 rwd-table" width="100%">
                    <thead>
                    <tr>
                      <th class="heading" width="25px">&nbsp;</th>
                      <th>Descripción</th>
                      <th style="width: 110px" >Precio Unit.</th>
                      <th style="width: 110px" >Cantidad</th>
                      <th style="width: 110px" >Total</th>
                      <th style="width: 25px !important" class="opcion-columna-nuevo"></th>
                    </tr>
                    </thead>
                    <tbody id="ListaDeServiciosVender">
                      <tr>
                        <td class="heading" data-th="ID"></td>
                        <td>
                          <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-comprobante" />
                          <textarea id="nvchDescripcionS1" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionS[]" form="form-comprobante" rows="4"></textarea>
                          <!--<input type="text" style="width: 100%" id="nvchDescripcionS1" name="nvchDescripcionS[]" form="form-comprobante" />-->
                        </td>
                        <td>
                          <input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioS1" name="dcmPrecioUnitarioS[]" idsprt="1" form="form-comprobante" onkeyup="CalcularPrecioTotalS(this)" class="input-without-border"/>
                        </td>
                        <td> 
                          <input type="text" id="intCantidadS1" name="intCantidadS[]" idsprt="1" form="form-comprobante" 
                          onkeyup="CalcularPrecioTotalS(this)" class="input-without-border"/>           
                        </td>
                        <td>
                          <input type="text" id="dcmTotalS1" name="dcmTotalS[]" form="form-comprobante" class="input-without-border" readonly/>
                        </td>
                        <td style="width: 25px !important" >
                          <button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">
                              <i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i> 
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
            <!-- FIN Tabla - Servicios -->

            <!-- INICIO Tabla - Maquinarias -->
            <div id="tablaMaquinarias">
            <div class="row">
              <div class="col-md-12">
                <!-- Comentar-->
                <div class="table-responsive" style="max-height: 310px; overflow-y: visible;">
                  <table class="ExcelTable2007 rwd-table" width="100%">
                    <thead>
                    <tr>
                      <th class="heading" width="25px">&nbsp;</th>
                      <th>Descripción</th>
                      <th style="width: 110px" >Precio Unit.</th>
                      <th style="width: 110px" >Cantidad</th>
                      <th style="width: 110px" >Total</th>
                      <th style="width: 25px !important" class="opcion-columna-nuevo"></th>
                    </tr>
                    </thead>
                    <tbody id="ListaDeMaquinariasVender">
                      <tr>
                        <td class="heading" data-th="ID"></td>
                        <td>
                          <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-comprobante" />
                          <textarea id="nvchDescripcionM1" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionM[]" form="form-comprobante" rows="4"></textarea>
                          <!--<input type="text" style="width: 100%" id="nvchDescripcionS1" name="nvchDescripcionS[]" form="form-comprobante" />-->
                        </td>
                        <td>
                          <input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioM1" name="dcmPrecioUnitarioM[]" idsprt="1" form="form-comprobante" onkeyup="CalcularPrecioTotalM(this)" class="input-without-border"/>
                        </td>
                        <td> 
                          <input type="text" id="intCantidadM1" name="intCantidadM[]" idsprt="1" form="form-comprobante" 
                          onkeyup="CalcularPrecioTotalM(this)" class="input-without-border"/>           
                        </td>
                        <td>
                          <input type="text" id="dcmTotalM1" name="dcmTotalM[]" form="form-comprobante" class="input-without-border" readonly/>
                        </td>
                        <td style="width: 25px !important" >
                          <button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">
                              <i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i> 
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
            <!-- FIN Tabla - Maquinarias -->
            <script type="text/javascript">ElegirTabla(1);</script>

            <div class="row">
              <div class="col-md-9">
              </div>
              <div class="col-md-3">
                <div class="row col-lg-12">
                  <table border="1" class="ExcelTable2007 rwd-table" width="100%">
                    <tbody>
                      <tr>
                          <th>Valor de Venta</th>
                          <td style="width: 120px !important">
                              <input type="text" id="ValorVenta" name="ValorVenta" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/>
                          </td>
                      </tr>
                      <tr>
                          <th>IGV (18%)</th>
                          <td style="width: 120px !important">
                              <input type="text" id="IGVVenta" name="IGVVenta" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/>
                          </td>
                      </tr>
                      <tr>
                          <th>Venta Total</th>
                          <td style="width: 120px !important">
                              <input type="text" id="VentaTotal" name="VentaTotal" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/>
                          </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <!--div class="form-group">
                  <label>Valor de Venta:</label>
                  <input type="text" id="ValorVenta" name="ValorVenta" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/><br>
                  <label>IGV (18%):</label>
                  <input type="text" id="IGVVenta" name="IGVVenta" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/><br>
                  <label>Venta Total:</label>
                  <input type="text" id="VentaTotal" name="VentaTotal" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/>
                </div-->
              </div>
            </div>
            <br><br>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Observación y/o Datos Adicionales (Opcional):</label>
                  <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-comprobante" rows="6"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <input type="hidden" name="intTipoDetalle" value="1" form="form-comprobante">
                  <input type="hidden" name="funcion" value="I" form="form-comprobante">
                  <input type="hidden" id="intIdProveedor" name="intIdProveedor" value="" form="form-comprobante">
                  <input type="hidden" id="intIdCliente" name="intIdCliente" value="" form="form-comprobante">
                  <input type="button" id="btn-crear-comprobante" class="btn btn-md btn-primary opcion-boton-nuevo" value="Realizar Venta" form="form-comprobante">
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group" id="resultadocrud">
                </div>
              </div>
            </div>
          </div>
          <!-- FIN - Formulario Realizar Venta -->

          <!-- INICIO - Formulario Listar Venta -->
          <div class="tab-pane" id="formListarComprobante">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Mostrar:</label>
                  <br>
                  <select id="num-lista" name="num-lista"  class="form-control select2">
                    <option value="10">Ver 10 Resultados</option>
                    <option value="25">Ver 25 Resultados</option>
                    <option value="50">Ver 50 Resultados</option>
                    <option value="100">Ver 100 Resultados</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                    <label class="text-left">Ingresar Búsqueda:</label>
                    <input type="text" name="txt-busqueda" id="txt-busqueda" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo Comprobante:</label>
                  <br>
                  <select id="lista-comprobante" name="lista-comprobante"  class="form-control select2">
                    <?php 
                      try{
                      $sql_conexion = new Conexion_BD();
                      $sql_conectar = $sql_conexion->Conectar();
                      $sql_comando = $sql_conectar->prepare('CALL mostrartipocomprobante(:intTipoDetalle)');
                      $sql_comando->execute(array(':intTipoDetalle' => 1));
                      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                      {
                        echo '<option value="'.$fila['intIdTipoComprobante'].'">'.$fila['nvchNombre'].'</option>';
                      }
                    }catch(PDPExceptions $e){
                      echo $e->getMessage();
                    }?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo Moneda:</label>
                  <br>
                  <select id="lista-tipo-moneda" class="form-control select2">
                    <?php 
                      try{
                      $sql_conexion = new Conexion_BD();
                      $sql_conectar = $sql_conexion->Conectar();
                      $sql_comando = $sql_conectar->prepare('CALL mostrartipomoneda()');
                      $sql_comando->execute();
                      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                      {
                        echo '<option value="'.$fila['intIdTipoMoneda'].'">'.$fila['nvchNombre'].'</option>';
                      }
                    }catch(PDPExceptions $e){
                      echo $e->getMessage();
                    }?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                    <label class="text-left">Fecha Inicial:</label>
                    <input type="text" id="dtmFechaInicial" class="form-control select2" placeholder="dd/mm/aaaa" value="">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                    <label class="text-left">Fecha Final:</label>
                    <input type="text" id="dtmFechaFinal" class="form-control select2" placeholder="dd/mm/aaaa" value="">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                    <label class="text-left">Opción:</label>
                    <input type="button" id="btnBuscar" class="form-control select2 btn btn-md btn-primary btn-flat" value="Realizar Búsqueda">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                    <label class="text-left">Total de Ventas:</label>
                    <input type="text" id="TotalComprobante" class="form-control select2" placeholder="0.00" readonly>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="ExcelTable2007 rwd-table" width="100%">
                <thead>
                <tr>
                  <th class="heading" width="25px">&nbsp;</th>
                  <th class="listaNumFactura">Número de Factura</th>
                  <th class="listaNumBoletaVenta">Número de Boleta</th>
                  <th class="listaNumNotaCredito">Número de Nota de Crédito</th>
                  <th class="listaNumGuiaRemision">Número de Guía de Remisión</th>
                  <th>Cliente</th>
                  <th>Usuario que Generó</th>
                  <th>Fecha de Creación</th>
                  <th>Valor de Venta</th>
                  <th>IGV</th>
                  <th>Venta Total</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="ListaDeComprobantes">
                  <script>ListarComprobante(0,10,"T");</script>
                </tbody>
              </table>
              <script>AccionCabecerasTablaComprobante(1);</script>
            </div>
            <hr>
            <div class="text-center">
              <nav aria-label="...">
                <ul id="PaginacionDeComprobante" class="pagination">
                  <script>PaginarComprobante(0,10,"T");</script>
                </ul>
              </nav>
            </div>
            <div class="row">
              <script type="text/javascript">TotalComprobante();</script>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="button" onclick="NuevoComprobante()" class="btn btn-md btn-primary" form="form-comprobante" value="Nueva Venta"/>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN - Formulario Listar Venta -->
        </div>
      </div>
    </section>
  </div>
<script>
  $('#modalcust').modal({
    keyboard: false
  });
</script>
<style>
  input{
    padding: 2px 3px;
  }
  select{
    padding: 3px;
  }
</style>
<?php include('../_include/rstfooter.php'); ?>