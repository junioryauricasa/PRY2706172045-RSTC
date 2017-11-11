<?php 
include('../_include/rstheader.php');
require_once '../../datos/conexion/bd_conexion.php';
?>  
    <?php require_once '../../negocio/ventas/ncomprobante.php'; ?>
    <?php require_once '../../negocio/ventas/ndetallecomprobante.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <?php require_once '../../view/modals/vformCliente.php'; ?>
    <?php require_once '../../view/modals/vformProducto.php'; ?>
    <?php require_once '../../negocio/inventario/nproducto.php'; ?>

    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <script type="text/javascript">
    var num = 2;
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
          $.ajax({
          type: "POST",
          url: "../../datos/inventario/funcion_producto.php",
          data: {search:search,funcion:funcion},
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
      $.ajax({
       url:"../../datos/inventario/funcion_producto.php",
       method:"POST",
       data:{intIdProducto:intIdProducto,funcion:funcion},
       dataType:"json",
       success:function(datos)
       {
        $("#dcmPrecio"+id).val(datos.dcmPrecioVenta1);
        $("#nvchDescripcion"+id).val(datos.nvchDescripcion);
        $("#dcmDescuentoVenta2"+id).val(datos.dcmDescuentoVenta2);
        $("#dcmDescuentoVenta3"+id).val(datos.dcmDescuentoVenta3);
       }
      });
    }

    function AgregarFila(){
      $('#ListaDeProductosVender').append(
      '<tr>'+
        '<td class="heading" data-th="ID"></td>'+
        '<td>'+
            '<input type="hidden" name="fila[]" value="'+num+'" form="form-venta"  style="width:130px"/>'+
            '<input type="hidden" id="intIdProducto'+num+'" name="intIdProducto[]" form="form-venta"  style="width:130px"/>'+
            '<input type="text" class="buscar" id="nvchCodigo'+num+'" name="nvchCodigo[]" form="form-venta"  style="width:130px"/>'+
            '<div class="result" id="result'+num+'" style="width:130px">'+
        '</td>'+
        '<td><input type="text" style="width:100% !important" id="nvchDescripcion'+num+'" name="nvchDescripcion[]" form="form-venta" readonly/></td>'+
        '<td>'+
          '<input type="text" style="width:100px !important" id="dcmPrecio'+num+'" name="dcmPrecio[]" form="form-venta" readonly />'+
          '<input type="hidden" id="dcmDescuentoVenta2'+num+'" form="form-venta" readonly />'+
          '<input type="hidden" id="dcmDescuentoVenta3'+num+'" form="form-venta" readonly />'+
        '</td>'+
        '<td><input type="text" style="width:150px !important" id="dcmDescuento'+num+'"  name="dcmDescuento[]" form="form-venta" idsprt="'+num+'"'+
          'onkeyup="CalcularPrecioTotal(this)"/></td>'+
        '<td><input type="text" style="width:100px !important" id="dcmPrecioUnitario'+num+'" name="dcmPrecioUnitario[]" form="form-venta" readonly/></td>'+
        '<td><input type="text" style="width:150px !important" id="intCantidad'+num+'" name="intCantidad[]" form="form-venta" idsprt="'+num+'"'+
          'onkeyup="CalcularPrecioTotal(this)"/></td>'+
        '<td><input type="text" style="width:100px !important" id="dcmTotal'+num+'" name="dcmTotal[]" form="form-venta" readonly/></td>'+
        '<td>'+
          '<button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="Eliminar"></i> </button>'+
        '</td>'+
      '</tr>');
      num++;
    }

    function formCliente(){
      $("#formCliente").modal("show");
    }
    </script>
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
    .result
    {
        position: absolute;
        z-index: 100;
        width: 500px !important;
        /*padding:10px;*/
        display:none;
        margin-top:-1px;
        border-top:0px;
        overflow:hidden;
        border:1px #CCC solid;
        background-color: white;
    }
    .show
    {
        padding:5px;
        border-bottom:1px solid #000000;
        font-size:15px; 
        /*height:50px;*/
    }
    .show:hover
    {
        background:#4c66a4;
        color:#FFF;
        cursor:pointer;
    }
    
    /*
        @Nombre: Truncate Text
        @Autor: JY
        @Descripción: 
            Antes >>

            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum ipsa sed, quas molestias quidem ducimus consectetur neque doloribus vitae quasi blanditiis qui iure, tempore explicabo exercitationem nisi hic officiis eos.

            Despues >>

            Lorem ipsum solor...
    */
    .truncate {
      width: 500px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* Text Bolder */
    #textbolder{
      font-weight:bolder; 
      color: black
    }
    .show:hover > #textbolder{
      color: white;
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
          <li class="active"><a href="#formRealizarVenta" data-toggle="tab" aria-expanded="true">Realizar Venta</a></li>
          <li class=""><a href="#formListarVenta" data-toggle="tab" aria-expanded="false">Lista de Ventas</a></li>
        </ul>
        <div class="tab-content">
          <!-- INICIO - Formulario Realizar Venta -->
          <form id="form-venta" method="POST"></form>
          <div class="tab-pane active" id="formRealizarVenta">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Fecha Actual:</label>
                  <input type="text" id="nvchFecha" name="nvchFecha" class="form-control select2" readonly form="form-venta"/>
                  <script type="text/javascript">$("#nvchFecha").val(FechaActual());</script>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo de Moneda:</label>
                  <select id="intIdTipoMoneda" name="intIdTipoMoneda" class="form-control select2" form="form-venta">
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
                  <label>Tipo de Comprobante:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="intIdTipoComprobante" name="intIdTipoComprobante"  class="form-control select2" form="form-venta">
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
                  <label>Lugar de Venta:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="intIdSucursal" name="intIdSucursal"  class="form-control select2" form="form-venta">
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
                  <label>Serie:</label>
                  <input type="text" id="nvchSerie" name="nvchSerie" class="form-control select2" readonly form="form-venta"/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Numeración:</label>
                  <input type="text" id="nvchNumeracion" name="nvchNumeracion" class="form-control select2" readonly form="form-venta"/>
                </div>
              </div>
              <script type="text/javascript">MostrarSeleccionComprobante();</script>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Forma de Pago:</label>
                  <select id="tipo-pago" name="intIdTipoPago" class="form-control select2" form="form-venta">
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
              <div class="col-md-2">
                <div class="form-group">
                  <label>Seleccionar el Tipo de Venta:</label>
                  <select id="tipo-venta" name="intIdTipoVenta" onchange="MostrarTipoVenta()" class="form-control select2">
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
              <div class="col-md-2">
                <div class="form-group">
                  <label>Seleccionar Cliente:</label>
                  <input type="button" class="form-control select2 btn btn-md btn-primary btn-flat" value="Buscar" onclick="formCliente()">
                </div>
              </div>
            </div>
            <!--
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Seleccionar Cliente:</label>
                  <input type="button" class="form-control select2 btn btn-md btn-primary btn-flat" value="Buscar" onclick="formCliente()">
                </div>
              </div>
            </div>
            -->
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>DNI/RUC:</label>
                  <input type="text" id="nvchNumDocumento" class="form-control select2" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Razón Social/Nombres:</label>
                  <input type="text" id="nvchDenominacion" class="form-control select2" readonly>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo de Cliente:</label>
                  <input type="text" id="TipoCliente" class="form-control select2" readonly>
                  <input type="hidden" id="intIdTipoCliente">
                </div>
              </div>
              <!--
              <div class="col-md-3 nvchApellidoPaterno">
                <div class="form-group">
                  <label>Apellido Paterno:</label>
                  <input type="text" id="nvchApellidoPaterno" class="form-control select2" readonly>
                </div>
              </div>
              <div class="col-md-3 nvchApellidoMaterno">
                <div class="form-group">
                  <label>Apellido Materno:</label>
                  <input type="text" id="nvchApellidoMaterno" class="form-control select2" readonly>
                </div>
              </div>
              <div class="col-md-3 nvchNombres">
                <div class="form-group">
                  <label>Nombres:</label>
                  <input type="text" id="nvchNombres" class="form-control select2" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Tipo de Cliente:</label>
                  <input type="text" id="TipoCliente" class="form-control select2" readonly>
                  <input type="hidden" id="intIdTipoCliente">
                </div>
              </div>
              -->
            
              <div class="col-md-4">
                <div class="form-group">
                  <label>Domicilio:</label>
                  <input type="text" id="nvchDomicilio" class="form-control select2" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Agregar Fila:</label>
                  <input type="button" onclick="AgregarFila()" value="Agregar +" class="form-control select2 btn btn-md btn-primary btn-flat" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <!-- Comentar-->
                <div class="table-responsive" style="max-height: 310px; overflow-y: visible;">
                  <table class="ExcelTable2007 rwd-table" width="100%">
                    <thead>
                    <tr>
                      <th class="heading" width="25px">&nbsp;</th>
                      <th style="width:130px">Código</th>
                      <th>Descripción</th>
                      <th style="width:100px !important">Precio Lista</th>
                      <th style="width:150px !important">Desc. (%)</th>
                      <th style="width:100px !important">Precio Unit.</th>
                      <th style="width:150px !important">Cantidad</th>
                      <th style="width:100px !important">Total</th>
                      <th style="width:50px !important"></th>
                    </tr>
                    </thead>
                    <tbody id="ListaDeProductosVender">
                      <tr>
                        <td class="heading" data-th="ID"></td>
                        <td style="width:130px">
                          <input type="hidden" name="fila[]" value="1" form="form-venta"  style="width:130px"/>
                          <input type="hidden" id="intIdProducto1" name="intIdProducto[]" form="form-venta" style="width:130px"/>
                          <input type="text" class="buscar" id="nvchCodigo1" name="nvchCodigo[]" form="form-venta" style="width:130px"/>
                          <div class="result" id="result1" style="width:130px">
                        </td>
                        <td width="">
                          <input type="text" id="nvchDescripcion1" name="nvchDescripcion[]" form="form-venta" style="width:100% !important" readonly/></td>
                        <td>
                          <input type="text" id="dcmPrecio1" name="dcmPrecio[]" form="form-venta" readonly style="width:100px !important"/>
                          <input type="hidden" id="dcmDescuentoVenta21" form="form-venta" readonly />
                          <input type="hidden" id="dcmDescuentoVenta31" form="form-venta" readonly />
                        </td>
                        <td>
                            <input style="width:150px !important" type="text" id="dcmDescuento1" name="dcmDescuento[]" form="form-venta" idsprt="1" 
                          onkeyup="CalcularPrecioTotal(this)"/>
                        </td>
                        <td>
                            <input style="width:100px !important" type="text" id="dcmPrecioUnitario1" name="dcmPrecioUnitario[]" form="form-venta" readonly/>
                        </td>
                        <td>
                            <input type="text" id="intCantidad1" name="intCantidad[]" form="form-venta" idsprt="1" onkeyup="CalcularPrecioTotal(this)" style="width:150px !important"/>
                        </td>
                        <td>
                            <input type="text" id="dcmTotal1" name="dcmTotal[]" style="width:100px !important" form="form-venta" readonly/>
                        </td>
                        <td>
                            <button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                                <i class="fa fa-trash"></i> 
                            </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <br>
            <br>
            <div class="row">
              <div class="col-md-9">
                <div class="form-group">
                  <label>Observación y/o Datos Adicionales (Opcional):</label>
                  <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-venta" rows="6"></textarea>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Valor de Venta:</label>
                  <input type="text" id="ValorVenta" name="ValorVenta" class="form-control select2" value="S/. 0.00" readonly form="form-venta"/><br>
                  <label>IGV (18%):</label>
                  <input type="text" id="IGVVenta" name="IGVVenta" class="form-control select2" value="S/. 0.00" readonly form="form-venta"/><br>
                  <label>Venta Total:</label>
                  <input type="text" id="VentaTotal" name="VentaTotal" class="form-control select2" value="S/. 0.00" readonly form="form-venta"/>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN - Formulario Realizar Venta -->

          <!-- INICIO - Formulario Listar Venta -->
          <div class="tab-pane" id="formListarVenta">
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
                    <input type="text" id="TotalVentas" class="form-control select2" placeholder="0.00" readonly>
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
                <tbody id="ListaDeVentas">
                  <script>ListarVenta(0,10,"T");</script>
                </tbody>
              </table>
              <script>AccionCabecerasTablaComprobante(1);</script>
            </div>
            <hr>
            <div class="text-center">
              <nav aria-label="...">
                <ul id="PaginacionDeVenta" class="pagination">
                  <script>PaginarVenta(0,10,"T");</script>
                </ul>
              </nav>
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