<script>
//////////////////////////////////////////////////////////////
/* INICIO - Operaciones de Comprobante */
	  var numprtst = 0; Number(numprtst);
    var numprt = 0; Number(numprt);
    var num = 2;
    var nums = 2;
    var numm = 2;
    var numi = 2;
    var numfila = 0;

    function TipoLetra(){
      var intIdTipoVenta = $("#intIdTipoVenta").val();
      var Letra = "";
      switch(intIdTipoVenta){
        case "1":
          Letra = "";
          break;
        case "2":
          Letra = "S";
          break;
        case "3":
          Letra = "M";
          break;
        case "4":
          Letra = "I";
          break;
      }
      $("#Letra").val(Letra);
      return Letra;
    }

    function TipoTabla(){
      var intIdTipoVenta = $("#intIdTipoVenta").val();
      var Tabla = "";
      switch(intIdTipoVenta){
        case "1":
          Tabla = "Productos";
          break;
        case "2":
          Tabla = "Servicios";
          break;
        case "3":
          Tabla = "Maquinarias";
          break;
        case "4":
          Tabla = "Implementos";
          break;
      }
      $("#Tabla").val(Tabla);
      return Tabla;
    }

    $(document).on('keyup', '.buscar', function(evt){
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if(charCode == 40 || charCode == 38)
        return false;

      $(this).closest('tr').find("input[name='fila[]']").each(function() {
         numfila = this.value;
      });

      var Letra = TipoLetra();
      var search = $(this).val();
      search = search.replace(/\s/g,'');
      var funcion = "BP";
      var intIdTipoVenta = $("#intIdTipoVenta").val();
      var intTipoDetalle = $("#intTipoDetalle").val();
      if(search != '')
      {
        var intIdTipoMoneda = $("#intIdTipoMoneda").val();
        $.ajax({
          type: "POST",
          url: "../../datos/inventario/funcion_producto.php",
          data: {search:search,funcion:funcion,intIdTipoMoneda:intIdTipoMoneda,intIdTipoVenta:intIdTipoVenta,intTipoDetalle:intTipoDetalle},
          cache: false,
          success: function(html)
          {
            $("#result"+Letra+numfila).html(html).show();
            numprt = $("#result"+Letra+numfila+" li").length;
            numprtst = 0;
            $(".result li:eq("+numprtst+")").css("background","#4C66A4");
            $(".result li:eq("+numprtst+")").css("color","#FFFFFF");
          }
        });
      }
      else {
        $("#result"+Letra+numfila).html("").hide();
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
        //$('#nvchCodigo'+numfila).val(nvchCodigo);
        $(".result").html("").hide();
        InsertarProductoElegido(intIdProducto,numfila);
      }
    });

    $(document).on('click', function(e){
      var clicked = $(e.target);
      if (!clicked.hasClass("buscar")){
        $(".result").html("").hide();
      }
    });

    function TeclaSeleccionCodigo(evt){
      var Letra = TipoLetra();
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if($(".result").is(":visible")){
        switch(charCode){
          case 13:
              var nvchCodigo = $(".result li:eq("+numprtst+")").find('.nvchCodigo').html();
              var intIdProducto = $(".result li:eq("+numprtst+")").find('.intIdProducto').val();
              nvchCodigo = nvchCodigo.replace(/\s/g,'');
              intIdProducto = intIdProducto.replace(/\s/g,'');
              $('#nvchCodigo'+Letra+numfila).val(nvchCodigo);
              $('#nvchCodigo'+Letra+numfila).blur();
              $(".result").html("").hide();
              InsertarProductoElegido(intIdProducto,numfila);
            break;
          case 38:
              $(".result li:eq("+numprtst+")").css("background","#FFFFFF");
              $(".result li:eq("+numprtst+")").css("color","#000000");

              if(numprtst + 1 <= numprt && numprtst > 0)
                numprtst--;
              
              $(".result li:eq("+numprtst+")").css("background","#4C66A4");
              $(".result li:eq("+numprtst+")").css("color","#FFFFFF");
            break;
          case 40:
              $(".result li:eq("+numprtst+")").css("background","#FFFFFF");
              $(".result li:eq("+numprtst+")").css("color","#000000");

              if(numprtst < numprt-1)
                numprtst++;

              $(".result li:eq("+numprtst+")").css("background","#4C66A4");
              $(".result li:eq("+numprtst+")").css("color","#FFFFFF");
              return false;
            break;
        }
      }
    }

    function InsertarProductoElegido(intIdProducto,id){
      var funcion = "SP";
      var intIdTipoMoneda = $("#intIdTipoMoneda").val();
      var Letra = TipoLetra();
      $.ajax({
       url:"../../datos/inventario/funcion_producto.php",
       method:"POST",
       data:{intIdProducto:intIdProducto,funcion:funcion,intIdTipoMoneda:intIdTipoMoneda},
       dataType:"json",
       success:function(datos)
       {
        $("#intIdProducto"+Letra+id).val(datos.intIdProducto);
        $("#nvchCodigo"+Letra+id).val(datos.nvchCodigo);
        //$("#detalleUbigeoProducto"+id).html(datos.detalleUbigeoProducto);
        $("#nvchDescripcion"+Letra+id).val(datos.nvchDescripcion);
        $("#UbigeoHuancayo"+Letra+id).val(datos.UbicacionHuancayo+' | '+datos.CantidadHuancayo);
        $("#UbigeoSanJeronimo"+Letra+id).val(datos.UbicacionSanJeronimo+' | '+datos.CantidadSanJeronimo);
        /*
        $("#UbicacionHuancayo"+Letra+id).val(datos.UbicacionHuancayo);
        $("#CantidadHuancayo"+Letra+id).val(datos.CantidadHuancayo);
        $("#UbicacionSanJeronimo"+Letra+id).val(datos.UbicacionSanJeronimo);
        $("#CantidadSanJeronimo"+Letra+id).val(datos.CantidadSanJeronimo);*/
        $("#dcmPrecio"+Letra+id).val(datos.dcmPrecioVenta1);
        $("#dcmDescuentoVenta2"+Letra+id).val(datos.dcmDescuentoVenta2);
        $("#dcmDescuentoVenta3"+Letra+id).val(datos.dcmDescuentoVenta3);
       }
      });
    }

    function AgregarFila(intIdTipoVenta){
    var intTipoDetalle = $("#intTipoDetalle").val();
    var intIdTipoComprobante = $("#intIdTipoComprobante").val();
    var camposVender = '';
    var readonlyVender = '';
    if(intTipoDetalle == 1 && intIdTipoComprobante < 9){
      readonlyVender = 'readonly="true"';
      camposVender ='<td class="filaPrecio">'+
                  '<input type="text" id="dcmPrecio'+num+'" name="dcmPrecio[]" style="width: 100% !important; text-align: right" form="form-comprobante" readonly />'+
                  '<input type="hidden" id="dcmDescuentoVenta2'+num+'" style="width: 100% !important;s" form="form-comprobante" readonly />'+
                  '<input type="hidden" id="dcmDescuentoVenta3'+num+'" style="width: 100% !important; text-align: right" form="form-comprobante" readonly />'+
                '</td>'+
                '<td class="filaDescuento"><input type="text" style="width: 100% !important; width: 100% !important" id="dcmDescuento'+num+'" name="dcmDescuento[]" form="form-comprobante" idsprt="'+num+'"'+
                  'onkeyup="CalcularPrecioTotal(this)"/></td>';
	  }
    if(intIdTipoVenta == 1){
        $('#ListaDeProductosVender').append(
        '<tr>'+
          '<td class="heading" data-th="ID">'+num+'</td>'+
          '<td><input type="hidden" style="width: 100% !important" name="fila[]" value="'+num+'" form="form-comprobante" />'+
              '<input type="hidden" style="width: 100% !important" id="intIdProducto'+num+'" name="intIdProducto[]" form="form-comprobante" />'+
              '<input type="text" style="width: 100% !important" class="buscar" id="nvchCodigo'+num+'" name="nvchCodigo[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>'+
              '<div class="result" id="result'+num+'">'+
          '</td>'+
          '<td><input type="text" style="width: 100% !important" id="nvchDescripcion'+num+'" name="nvchDescripcion[]" form="form-comprobante" readonly/></td>'+
          '<td class="filaUbigeoHuancayo">'+
            '<input type="text" style="width: 100% !important" id="UbigeoHuancayo'+num+'" form="form-comprobante" class="" readonly/>'+
          '</td>'+
          '<td class="filaUbigeoSanJeronimo">'+
            '<input type="text" style="width: 100% !important" id="UbigeoSanJeronimo'+num+'" form="form-comprobante" class="" readonly/>'+
          '</td>'+
          camposVender+
          '<td class="filaPrecioUnitario">'+
          '<input type="text" style="width: 100% !important; text-align: right !important" id="dcmPrecioUnitario'+num+'" name="dcmPrecioUnitario[]" form="form-comprobante" onkeyup="CalcularPrecioTotal(this)" idsprt="'+num+'" class="txtPrecioUnitario" '+readonlyVender+' /></td>'+
          '<td><input type="text" style="width: 100% !important; text-align: right !important" id="intCantidad'+num+'" name="intCantidad[]" form="form-comprobante" idsprt="'+num+'"'+
            'onkeyup="CalcularPrecioTotal(this)"/></td>'+
          '<td class="filaTotal"><input type="text" id="dcmTotal'+num+'" style="width: 100% !important; text-align: right" name="dcmTotal[]" form="form-comprobante" readonly/></td>'+
          '<td>'+
            '<button type="button" style="width: 25px !important" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit" data-toggle="tooltip" title="Eliminar!"></i></button>'+
          '</td>'+
        '</tr>');
        num++;
      } else if(intIdTipoVenta == 2){
        $('#ListaDeServiciosVender').append(
        '<tr>'+
          '<td class="heading" data-th="ID">'+nums+'</td>'+
          '<td>'+
            '<input style="width: 100% !important; text-align: left" type="hidden" name="fila[]" value="'+nums+'" form="form-comprobante" />'+
            '<textarea id="nvchDescripcionS'+nums+'" style="resize: vertical;" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionS[]" form="form-comprobante" rows="4"></textarea>'+
          '</td>'+
          '<td>'+
            '<input style="width: 100% !important; text-align: right" type="text" id="dcmPrecioUnitarioS'+nums+'" name="dcmPrecioUnitarioS[]" idsprt="'+nums+'" form="form-comprobante" onkeyup="CalcularPrecioTotalS(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" style="width: 100% !important; text-align: right" id="intCantidadS'+nums+'" name="intCantidadS[]" idsprt="'+nums+'" form="form-comprobante" onkeyup="CalcularPrecioTotalS(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="dcmTotalS'+nums+'" name="dcmTotalS[]" style="width: 100% !important" form="form-comprobante" readonly/>'+
          '</td>'+
          '<td style="width: 25px !important">'+
            '<button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">'+
                '<i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i>' +
            '</button>'+
          '</td>'+
        '</tr>');
        nums++;
      } else if(intIdTipoVenta == 3){
        $('#ListaDeMaquinariasVender').append(
        '<tr>'+
          '<td class="heading" data-th="ID">'+numm+'</td>'+
          '<td><input type="hidden" style="width: 100% !important;" name="fila[]" value="'+numm+'" form="form-comprobante" />'+
              '<input type="hidden" style="width: 100% !important; text-align: left !important;" id="intIdProductoM'+numm+'" name="intIdProductoM[]" form="form-comprobante" />'+
              '<input type="text" style="width: 100% !important; text-align: left !important;" class="buscar" id="nvchCodigoM'+numm+'" name="nvchCodigoM[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>'+
              '<div class="result" id="resultM'+numm+'">'+
          '</td>'+
          '<td>'+
            '<input style="width: 100% !important; text-align: right !important;" type="hidden" name="fila[]" value="'+numm+'" form="form-comprobante" />'+
            '<textarea id="nvchDescripcionM'+numm+'" style="resize: vertical;" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionM[]" form="form-comprobante" rows="4"></textarea>'+
          '</td>'+
          '<td class="filaUbigeoHuancayo">'+
            '<input type="text" style="width: 100% !important; text-align: right !important;" id="UbigeoHuancayoM'+numm+'" form="form-comprobante" class="" readonly/>'+
          '</td>'+
          '<td class="filaUbigeoSanJeronimo">'+
            '<input type="text" style="width: 100% !important; text-align: right;" id="UbigeoSanJeronimoM'+numm+'" form="form-comprobante" class="" readonly/>'+
          '</td>'+
          '<td class="filaPrecioUnitario">'+
            '<input style="width: 100% !important; text-align: right;" type="text" id="dcmPrecioUnitarioM'+numm+'" name="dcmPrecioUnitarioM[]" idsprt="'+numm+'" form="form-comprobante" onkeyup="CalcularPrecioTotalM(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="intCantidadM'+numm+'" name="intCantidadM[]" idsprt="'+numm+'" form="form-comprobante" style="text-align: right !important; width: 100% !important;" onkeyup="CalcularPrecioTotalM(this)"/>'+
          '</td>'+
          '<td class="filaTotal">'+
            '<input type="text" style="text-align: right; width: 100% !important;" id="dcmTotalM'+numm+'" name="dcmTotalM[]" form="form-comprobante" readonly/>'+
          '</td>'+
          '<td style="width: 25px !important" >'+
            '<button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">'+
                '<i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i>' +
            '</button>'+
          '</td>'+
        '</tr>');
        numm++;
      } else if(intIdTipoVenta == 4){
        $('#ListaDeImplementosVender').append(
        '<tr>'+
          '<td class="heading" data-th="ID">'+numi+'</td>'+
          '<td><input type="hidden" style="width: 100% !important" name="fila[]" value="'+numi+'" form="form-comprobante" />'+
              '<input type="hidden" style="width: 100% !important" id="intIdProductoI'+numi+'" name="intIdProductoI[]" form="form-comprobante" />'+
              '<input type="text" style="width: 100% !important" class="buscar" id="nvchCodigoI'+numi+'" name="nvchCodigoI[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>'+
              '<div class="result" id="resultI'+numi+'">'+
          '</td>'+
          '<td>'+
            '<input style="width: 100% !important; text-align: right !important" type="hidden" name="fila[]" value="'+numi+'" form="form-comprobante" />'+
            '<textarea id="nvchDescripcionI'+numi+'" style="resize: vertical;" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionI[]" form="form-comprobante" rows="4"></textarea>'+
          '</td>'+
          '<td class="filaUbigeoHuancayo">'+
            '<input type="text" style="width: 100% !important; text-align: right !important" id="UbigeoHuancayoI'+numi+'" form="form-comprobante" class="" readonly/>'+
          '</td>'+
          '<td class="filaUbigeoSanJeronimo">'+
            '<input type="text" style="width: 100% !important; text-align: right !important" id="UbigeoSanJeronimoI'+numi+'" form="form-comprobante" class="" readonly/>'+
          '</td>'+
          '<td class="filaPrecioUnitario">'+
            '<input style="width: 100% !important; text-align: right !important" type="text" id="dcmPrecioUnitarioI'+numi+'" name="dcmPrecioUnitarioI[]" idsprt="'+numi+'" form="form-comprobante" onkeyup="CalcularPrecioTotalI(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="intCantidadI'+numi+'" style="text-align: right !important; width: 100% !important;" name="intCantidadI[]" idsprt="'+numi+'" form="form-comprobante" onkeyup="CalcularPrecioTotalI(this)"/>'+
          '</td>'+
          '<td class="filaTotal">'+
            '<input type="text" id="dcmTotalI'+numi+'" name="dcmTotalI[]" style="width: 100% !important; text-align: right !important; text-align: right !important" form="form-comprobante" readonly/>'+
          '</td>'+
          '<td style="width: 25px !important" >'+
            '<button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">'+
                '<i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i>' +
            '</button>'+
          '</td>'+
        '</tr>');
        numi++;
      }
      CamposTabla(intTipoDetalle,intIdTipoComprobante);
    }

    function formCliente(){
      $("#formCliente").modal("show");
    }

    function formProveedor(){
      $("#formProveedor").modal("show");
    }

    function formCotizacion(){
      $("#formCotizacion").modal("show");
    }

    function formComprobanteVenta(){
      $("#formComprobanteVenta").modal("show");
    }

    function ElegirTabla(intIdTipoVenta){
      if(intIdTipoVenta == 1){
        $("#tablaRepuestos").show();
        $("#tablaServicios").hide();
        $("#tablaMaquinarias").hide();
        $("#tablaImplementos").hide();
        CalcularTotal();
      } else if(intIdTipoVenta == 2) {
        $("#tablaRepuestos").hide();
        $("#tablaServicios").show();
        $("#tablaMaquinarias").hide();
        $("#tablaImplementos").hide();
        CalcularTotal();
      } else if(intIdTipoVenta == 3) {
        $("#tablaRepuestos").hide();
        $("#tablaServicios").hide();
        $("#tablaMaquinarias").show();
        $("#tablaImplementos").hide();
        CalcularTotal();
      } else if(intIdTipoVenta == 4) {
        $("#tablaRepuestos").hide();
        $("#tablaServicios").hide();
        $("#tablaMaquinarias").hide();
        $("#tablaImplementos").show();
        CalcularTotal();
      }
      TipoLetra();
      TipoTabla();
    }
/* FIN - Operaciones de Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Limpiear campos del Comprobante */
function LimpiarCampos(){
  RestablecerValidacion("dtmFechaTraslado",1);
  RestablecerValidacion("nvchPuntoLlegada",1);
  RestablecerValidacion("nvchPuntoPartida",1);
  RestablecerValidacion("nvchFecha",1);
  RestablecerValidacion("nvchSerie",1);
  RestablecerValidacion("nvchNumeracion",1);
  RestablecerValidacion("nvchAtencion",1);
  RestablecerValidacion("nvchDestino",1);
	//$("#nvchFecha").val(FechaActual());
  $("#intIdComprobanteReferencia").val("");
	$("#nvchNumDocumento").val("");
	$("#nvchDenominacion").val("");
	$("#nvchDomicilio").val("");
	$("#TipoCliente").val("");
	$("#intIdTipoCliente").val("");
	$("#intIdClienteC").val("");
	$("#intIdProveedorC").val("");
	$("#nvchSerie").val("");
	$("#nvchNumeracion").val("");
	$("#intIdSucursalC").val(1);
	if($("#intTipoDetalle").val() == 1)
		$("#intIdTipoComprobante").val(1);
	else if($("#intTipoDetalle").val() == 2)
		$("#intIdTipoComprobante").val(5);
	$("#intIdTipoVenta").val(1);
  $("#intIdTipoVenta").change();
	$("#intIdTipoMoneda").val(2);
	$("#intIdTipoPago").val(1);
  $("#intDescontarGR").val(0);
  $("#intIdUsuarioSolicitado").val(1);
	LimpiarTablas();
	HabilitacionOpciones(1);
	$("#ValorComprobante").val("S/. 0.00");
	$("#IGVComprobante").val("S/. 0.00");
	$("#ComprobanteTotal").val("S/. 0.00"); 
	$("#nvchObservacion").val("");
	//if($("#intTipoDetalle").val() == 1)
	//MostrarSeleccionComprobante();
}
/* FIN - Funcion Ajax - Limpiear campos del Comprobante */
//////////////////////////////////////////////////////////////

function LimpiarTablas(){
  $("#ListaDeProductosVender").html("");
  $("#ListaDeServiciosVender").html("");
  $("#ListaDeMaquinariasVender").html("");
  $("#ListaDeImplementosVender").html("");
  num = 1;
  nums = 1;
  numm = 1;
  numi = 1;
  AgregarFila(1);
  AgregarFila(2);
  AgregarFila(3);
  AgregarFila(4);
}

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Limpiear campos del Comprobante */
function HabilitacionOpciones(accion){
	if(accion == 1){
    $('.opcion-boton-editar').hide();
		$('#intIdSucursalC').attr("disabled", false);
		$('#intIdTipoComprobante').attr("disabled", false);
		$('#intIdTipoVenta').attr("disabled", false);
		$('#intIdTipoPago').attr("disabled", false);
    $("#nvchSerie").attr("readonly",false);
    $("#nvchNumeracion").attr("readonly",false);
		$('.opcion-boton-nuevo').show();
		$('.opcion-columna-nuevo').show();
    $("#intIdUsuarioSolicitado").attr("disabled", false); // Guías Internas
    $("#nvchAtencion").attr("readonly",false); // Guía Interna de Salida
    $("#nvchDestino").attr("readonly",false); // Guía Interna de Salida
    $("#funcionC").val("I");
    OpcionFecha("2");
	} else {
    <?php if($_SESSION['intIdTipoUsuario'] != 1) {?>
		$('#intIdSucursalC').attr("disabled", true);
		$('#intIdTipoComprobante').attr("disabled", true);
		$('#intIdTipoVenta').attr("disabled", true);
		$('#intIdTipoPago').attr("disabled", true);
    $("#nvchSerie").attr("readonly",true);
    $("#nvchNumeracion").attr("readonly",true);
		$('.opcion-columna-nuevo').hide();
    $('.opcion-boton-editar').show();
    $("#intIdUsuarioSolicitado").attr("disabled", true); // Guías Internas
    $("#nvchAtencion").attr("readonly",true); // Guía Interna de Salida
    $("#nvchDestino").attr("readonly",true); // Guía Interna de Salida
    $("#txtOpcionFecha").val("1");
    OpcionFecha("1");
    $("nvchFecha").attr("readonly",true);
    <?php } else {?>
    $('#btn-crear-comprobante').hide();
    $('.opcion-boton-editar').show();
    OpcionFecha("1");
    <?php } ?>
    $("#funcionC").val("A");
	}
}
/* FIN - Funcion Ajax - Limpiear campos del Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Formulario de Realizar Venta */
function NuevoComprobante(){
	LimpiarCampos();
	$("#btnFormRealizarComprobante").click();
}
/* FIN - Funcion Ajax - Formulario de Realizar Venta */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Cliente */
$(document).on('click', '#btn-form-crear-comprobante', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:'POST',
	   data:{funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	goToBox("#Formulario");
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Visualizar Formulario Crear Cliente */
//////////////////////////////////////////////////////////////

function ValidacionFilasVacias(TipoVenta,Letra) {
  var i = 0;
  $('table tbody#ListaDe'+TipoVenta+'Vender tr').each(function() {
        $(this).find("td input[name='dcmTotal"+Letra+"[]']").each(function() {
            if(this.value == "" || this.value == null){
              i++;            
            }
        });
    });
  return i;
}

function ValidacionComprobante(){
  var intIdTipoVenta = $("#intIdTipoVenta").val();
  var Persona = "<?php echo $lblPersonaSingular; ?>";
  var intIdPersona = $("#intId"+Persona+"C").val()
  if(intIdPersona == "" || intIdPersona == null){
    MensajeNormal("Seleccionar a un "+Persona,2);
    return false;
  } else if(EsFechaHora('nvchFecha') == false){
    goToBox("#nvchFechaGroup");
    return false;
  } else if(EsVacio('nvchSerie') == false){
    goToBox("#nvchSerieGroup");
    return false;
  } else if(EsVacio('nvchNumeracion') == false){
    goToBox("#nvchNumeracionGroup");
    return false;
  }

  switch(intIdTipoVenta){
    case "1":
        var num_filas_detalle_comprobante = document.getElementById('ListaDeProductosVender').rows.length;
        if(num_filas_detalle_comprobante == 0){
          MensajeNormal("Ingresar por lo menos elegir un Producto",2);
          return false;
        } else {
          var filas_vacias = ValidacionFilasVacias("Productos","");
          if (filas_vacias == num_filas_detalle_comprobante) {
            MensajeNormal("Ingresar por lo menos elegir un Producto",2);
            return false;
          }
        }
        break;
    case "2":
        var num_filas_detalle_comprobante = document.getElementById('ListaDeServiciosVender').rows.length;
        if(num_filas_detalle_comprobante == 0){
          MensajeNormal("Ingresar por lo menos ingresar un Servicio",2);
          return false;
        } else {
          var filas_vacias = ValidacionFilasVacias("Servicios","S");
          if (filas_vacias == num_filas_detalle_comprobante) {
            MensajeNormal("Ingresar por lo menos elegir un Servicio",2);
            return false;
          }
        }
        break;
    case "3":
        var num_filas_detalle_comprobante = document.getElementById('ListaDeMaquinariasVender').rows.length;
        if(num_filas_detalle_comprobante == 0){
          MensajeNormal("Ingresar por lo menos ingresar una Maquinaria",2);
          return false;
        } else {
          var filas_vacias = ValidacionFilasVacias("Maquinarias","M");
          if (filas_vacias == num_filas_detalle_comprobante) {
            MensajeNormal("Ingresar por lo menos elegir una Maquinaria",2);
            return false;
          }
        }
        break;
    case "4":
        var num_filas_detalle_comprobante = document.getElementById('ListaDeImplementosVender').rows.length;
        if(num_filas_detalle_comprobante == 0){
          MensajeNormal("Ingresar por lo menos ingresar un Implemento",2);
          return false;
        } else {
          var filas_vacias = ValidacionFilasVacias("Implementos","I");
          if (filas_vacias == num_filas_detalle_comprobante) {
            MensajeNormal("Ingresar por lo menos elegir un Implemento",2);
            return false;
          }
        }
        break;
  }
}

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Cliente */
$(document).on('click', '#btn-crear-comprobante', function(){
  var resultado = ValidacionComprobante();
  if(resultado == false){
    return true;
  }
  var formData = $("#form-comprobante").serialize();
  var y = document.getElementById("num-lista").value;
  var x = 0;
  var tipolistado = "N";
  var intIdTipoComprobante = $("#intIdTipoComprobante").val();
  var intTipoDetalle = $("#intTipoDetalle").val();
	  $.ajax({
	   url: "../../datos/comprobante/funcion_comprobante.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
      datos = datos.replace(/\s/g,'');  // 5ok - Facturas, boleta y nota de de crédito | 3ok - Servicio | 2ok - Guía de Remisión
	   	if (datos=="okokokokok" || datos=="okokok" || datos == "okok") {
        if(intTipoDetalle == 1)
	   		  MensajeNormal("Se generó correctamente la Venta",1);
        else
          MensajeNormal("Se generó correctamente la Compra",1);
	   		//$("#lista-comprobante").val(intIdTipoComprobante);
	   		AccionCabecerasTablaComprobante(intIdTipoComprobante);
	   		$('#txt-busqueda').val("");
	   		LimpiarCampos();
	   		$("#btnFormListarComprobante").click();
	   		ListarComprobante(x,y,tipolistado);
	   		//PaginarComprobante(x,y,tipolistado);
		  }
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Cliente */
$(document).on('click', '.btn-mostrar-comprobante', function(){
  	  var intIdComprobante = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:{intIdComprobante:intIdComprobante,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
      LimpiarCampos();
      $("#intIdComprobante").val(datos.intIdComprobante);
	   	$("#nvchFecha").val(datos.dtmFechaCreacion);
	   	$("#intIdSucursalC").val(datos.intIdSucursal);
	   	$("#intIdTipoComprobante").val(datos.intIdTipoComprobante);
	   	$("#nvchSerie").val(datos.nvchSerie);
	   	$("#nvchNumeracion").val(datos.nvchNumeracion);
	   	$("#intIdTipoVenta").val(datos.intIdTipoVenta);
	   	$("#intIdTipoMoneda").val(datos.intIdTipoMoneda);
	   	$("#intIdTipoPago").val(datos.intIdTipoPago);
	   	$("#nvchNumDocumento").val(datos.nvchDNIRUC);
		  $("#nvchDenominacion").val(datos.nvchClienteProveedor);
		  $("#nvchDomicilio").val(datos.nvchDireccion);
  		$("#TipoCliente").val(datos.TipoCliente);
  		$("#intIdTipoCliente").val(datos.intIdTipoCliente);
  		$("#intIdClienteC").val(datos.intIdCliente);
  		$("#intIdProveedorC").val(datos.intIdProveedor);
      $("#intIdUsuarioSolicitado").val(datos.intIdUsuarioSolicitado); // Guías Internas
      $("#nvchAtencion").val(datos.nvchAtencion); // Guía Interna de Salida
      $("#nvchDestino").val(datos.nvchDestino); // Guía Interna de Salida
      $("#nvchPuntoPartida").val(datos.nvchPuntoPartida);
      $("#nvchPuntoLlegada").val(datos.nvchPuntoLlegada);
      $("#intIdComprobanteReferencia").val(datos.intIdComprobanteReferencia);
      $("#intDescontarGR").val(datos.intDescontarGR);
      $("#dtmFechaTraslado").val(datos.dtmFechaTraslado);
  		$("textarea#nvchObservacion").val(datos.nvchObservacion);
  		HabilitacionOpciones(2);
  		ElegirTabla(datos.intIdTipoVenta);
  		MostrarDetalleComprobante(datos.intIdComprobante,datos.intIdTipoVenta);
      CamposComprobante(datos.intIdTipoComprobante);
  	  $("#btnFormRealizarComprobante").click();
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Cliente */
$(document).on('click', '#btn-editar-comprobante', function(){
  var resultado = ValidacionComprobante();
  if(resultado == false){
    return true;
  }
  var formData = $("#form-comprobante").serialize();
  var y = document.getElementById("num-lista").value;
  var x = $(".marca-comprobante").attr("idp") * y;
  var tipolistado = "E";
  var intIdTipoComprobante = $("#intIdTipoComprobante").val();
  var intTipoDetalle = $("#intTipoDetalle").val();
    $.ajax({
     url: "../../datos/comprobante/funcion_comprobante.php",
     method: "POST",
     data: formData,
     success:function(datos)
     {
      datos = datos.replace(/\s/g,''); // 5ok - Facturas, boleta y nota de de crédito | 3ok - Servicio | 2ok - Guía de Remisión 
      if (datos=="okokokokok" || datos=="okokok" || datos == "okok") {
        if(intTipoDetalle == 1)
          MensajeNormal("Se Modificó correctamente la Venta",1);
        else
          MensajeNormal("Se Modificó correctamente la Compra",1);
        //$("#lista-comprobante").val(intIdTipoComprobante);
        AccionCabecerasTablaComprobante(intIdTipoComprobante);
        LimpiarCampos();
        $("#btnFormListarComprobante").click();
        ListarComprobante(x,y,tipolistado);
        //PaginarComprobante((x/y),y,tipolistado);
      }
      else { $("#resultadocrud").html(datos); }
     }
    });
   return false;
});
/* FIN - Funcion Ajax - Actualizar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Eliminar Cliente */
$(document).on('click', '.btn-anular-comprobante', function(){
var intIdComprobante = $(this).attr("id");
$('#MensajeAnularConfirmar').modal('show');
$(document).on('click', '.modal-btn-si', function(){
  var y = document.getElementById("num-lista").value;
  var x = $(".marca-comprobante").attr("idp") * y;
  var tipolistado = "D";
  var funcion = "E";
  $.ajax({
  url:"../../datos/comprobante/funcion_comprobante.php",
  method:"POST",
  data:{intIdComprobante:intIdComprobante,funcion:funcion},
  success:function(datos)
  {
    datos = datos.replace(/\s/g,'');
    if (datos=="ok") {
      MensajeNormal("Se Anuló correctamente el Comprobante",1);
      ListarComprobante(x,y,tipolistado);
      //PaginarComprobante((x/y),y,tipolistado);
    }
    else { $("#resultadocrud").html(datos); }
  }
  });
  $('#MensajeAnularConfirmar').modal('hide');
  return false;
});

$(document).on('click', '.modal-btn-no', function(){
  $('#MensajeAnularConfirmar').modal('hide');
  });
});
/* FIN - Funcion Ajax - Eliminar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Reporte Cotizacion */
$(document).on('click', '.btn-reporte-comprobante', function(){
  var intIdComprobante = $(this).attr("id");
  var intIdTipoComprobante = $(this).attr("idcr");
  if(intIdTipoComprobante == 1)
     var url = '../../datos/comprobante/clases_comprobante/reporte_factura.php?intIdComprobante='+intIdComprobante;
  else if(intIdTipoComprobante == 2)
     var url = '../../datos/comprobante/clases_comprobante/reporte_boleta_de_venta.php?intIdComprobante='+intIdComprobante;
  else if(intIdTipoComprobante == 3)
     var url = '../../datos/comprobante/clases_comprobante/reporte_guia_de_remision_remitente.php?intIdComprobante='+intIdComprobante;
  else if(intIdTipoComprobante == 4)
     var url = '../../datos/comprobante/clases_comprobante/reporte_nota_de_credito.php?intIdComprobante='+intIdComprobante;
  else if(intIdTipoComprobante == 9)
    var url = '../../datos/comprobante/clases_comprobante/reporte_salida_interna_de_repuestos.php?intIdComprobante='+intIdComprobante;
  else if(intIdTipoComprobante == 10)
    var url = '../../datos/comprobante/clases_comprobante/reporte_ingreso_interno_de_repuestos.php?intIdComprobante='+intIdComprobante;
  window.open(url, '_blank');
});
/* FIN - Funcion Ajax - Reporte Cotizacion */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Ubigeo Cotizacion */
$(document).on('click', '.btn-ubigeo-comprobante', function(){
  var intIdComprobante = $(this).attr("id");
  var intIdTipoVenta = $(this).attr("idtv");
  if(intIdTipoVenta != 2)
  var url = '../../datos/inventario/clases_producto/reporte_ubicacion_producto.php?intIdComprobante='+intIdComprobante;
  else
  MensajeNormal('Es un Servicio, no tiene ubicación de almacén',2);
  window.open(url, '_blank');
});
/* FIN - Funcion Ajax - Ubigeo Cotizacion */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function AccionCabecerasTablaComprobante(intIdTipoComprobante) {
	if(intIdTipoComprobante == "1"){
		$(".listaNumFactura").show();
  	  	$(".listaNumBoletaVenta").hide();
  	  	$(".listaNumNotaCredito").hide();
  	  	$(".listaNumGuiaRemision").hide();
	} else if (intIdTipoComprobante == "2") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").show();
  	  	$(".listaNumNotaCredito").hide();
  	  	$(".listaNumGuiaRemision").hide();
	} else if (intIdTipoComprobante == "3") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").hide();
  	  	$(".listaNumNotaCredito").hide();
  	  	$(".listaNumGuiaRemision").show();
	} else if (intIdTipoComprobante == "4") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").hide();
  	  	$(".listaNumNotaCredito").show();
  	  	$(".listaNumGuiaRemision").hide();
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Venta Realizada */
$(document).on('change', '#lista-comprobante', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  	AccionCabecerasTablaComprobante(intIdTipoComprobante);
  	ListarComprobante(x,y,tipolistado);
});

$(document).on('change', '#num-lista', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarComprobante(x,y,tipolistado);
});

$(document).on('keyup', '#txt-busqueda', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarComprobante(x,y,tipolistado);
});

$(document).on('click', '#btnBuscar', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarComprobante(x,y,tipolistado);
});

$(document).on('click', '.btn-pagina-comprobante', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(this).attr("idp") * y;
  	var tipolistado = "T";
  	ListarComprobante(x,y,tipolistado);
});

$(document).on('change', '#lista-tipo-moneda', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(".marca-comprobante").attr("idp") * y;
  	var tipolistado = "T";
  	ListarComprobante(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Venta Realizada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Cliente */
function ListarComprobante(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  var intIdTipoMoneda = document.getElementById("lista-tipo-moneda").value;
  var intTipoDetalle = $("#intTipoDetalle").val();
  
  if(EsFecha("dtmFechaInicial") == false){
  	var dtmFechaInicial = "";
  } else {
  	var dtmFechaInicial = $("#dtmFechaInicial").val();
  }
  if(EsFecha("dtmFechaFinal") == false){
  	var dtmFechaFinal = FechaActual();
  } else {
  	var dtmFechaFinal = $("#dtmFechaFinal").val();
  }

  $.ajax({
      url:'../../datos/comprobante/funcion_comprobante.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdTipoComprobante:intIdTipoComprobante,
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda,intTipoDetalle:intTipoDetalle},
      success:function(datos) {
          $("#ListaDeComprobantes").html(datos);
          PaginarComprobante((x/y),y,tipolistado);
          TotalComprobante();
      }
  });
}
/* FIN - Funcion Ajax - Listar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Total Ventas */
function TotalComprobante() {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "TV";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  var intIdTipoMoneda = document.getElementById("lista-tipo-moneda").value;
  var intTipoDetalle = $("#intTipoDetalle").val();
  
  if(EsFecha("dtmFechaInicial") == false){
  	var dtmFechaInicial = "";
  } else {
  	var dtmFechaInicial = $("#dtmFechaInicial").val();
  }
  if(EsFecha("dtmFechaFinal") == false){
  	var dtmFechaFinal = FechaActual();
  } else {
  	var dtmFechaFinal = $("#dtmFechaFinal").val();
  }

  $.ajax({
      url:'../../datos/comprobante/funcion_comprobante.php',
      method:"POST",
      data:{busqueda:busqueda,funcion:funcion,intIdTipoComprobante:intIdTipoComprobante,
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda,intTipoDetalle:intTipoDetalle},
      success:function(datos) {
          $("#TotalComprobante").val(datos);
      }
  });
}
/* FIN - Funcion Ajax - Total Ventas */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Cliente */
function PaginarComprobante(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  var intTipoDetalle = $("#intTipoDetalle").val();

  if(EsFecha("dtmFechaInicial") == false){
  	var dtmFechaInicial = "";
  } else {
  	var dtmFechaInicial = $("#dtmFechaInicial").val();
  }
  if(EsFecha("dtmFechaFinal") == false){
  	var dtmFechaFinal = FechaActual();
  } else {
  	var dtmFechaFinal = $("#dtmFechaFinal").val();
  }

  $.ajax({
      url:'../../datos/comprobante/funcion_comprobante.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdTipoComprobante:intIdTipoComprobante,
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intTipoDetalle:intTipoDetalle},
      success:function(datos) {
          $("#PaginacionDeComprobante").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
function AccionSeleccionClientes(funcion) {
	  if(funcion == 'S'){
	  	$("#TablaDeClientes").show();
      	$("#DatosDelCliente").hide();
	  } else if(funcion == 'M'){
	  	$("#TablaDeClientes").hide();
      	$("#DatosDelCliente").show();
	  }
}
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function AccionCabecerasTabla(intIdTipoPersona) {
	if(intIdTipoPersona == "1"){
		$(".ListaDNI").hide();
  	  	$(".ListaRUC").show();
  	  	$(".ListaRazonSocial").show();
  	  	$(".ListaApellidoPaterno").hide();
  	  	$(".ListaApellidoMaterno").hide();
  	  	$(".ListaNombres").hide();
	} else if (intIdTipoPersona == "2") {
		$(".ListaDNI").show();
  	  	$(".ListaRUC").show();
  	  	$(".ListaRazonSocial").hide();
  	  	$(".ListaApellidoPaterno").show();
  	  	$(".ListaApellidoMaterno").show();
  	  	$(".ListaNombres").show();
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Cliente */
$(document).on('change', '#lista-persona', function(){
	var intIdTipoPersona = document.getElementById("lista-persona").value;
  var intTipoDetalle = $("#intTipoDetalle").val();
	AccionCabecerasTabla(intIdTipoPersona);
	var y = 5;
	var x = 0;
  if(intTipoDetalle == 1)
	   ListarClientesSeleccion(x,y);
  else if(intTipoDetalle == 2)
     ListarProveedoresSeleccion(x,y);
});

$(document).on('keyup', '#BusquedaCliente', function(){
	var y = 5;
	var x = 0;
	ListarClientesSeleccion(x,y);
});

$(document).on('keyup', '#BusquedaProveedor', function(){
  var y = 5;
  var x = 0;
  ListarProveedoresSeleccion(x,y);
});

function PaginacionClientes(seleccion) {
	var y = 5;
	var x = $(seleccion).attr("idp") * y;
	ListarClientesSeleccion(x,y);
}

function PaginacionProveedores(seleccion) {
  var y = 5;
  var x = $(seleccion).attr("idp") * y;
  ListarProveedoresSeleccion(x,y);
}
/* FIN - Funcion Ajax - Buscar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Clientes para la Selección */
function ListarClientesSeleccion(x,y) {
	var busqueda = document.getElementById("BusquedaCliente").value;
	var funcion = "MCL";
	var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeClientesSeleccion").html(datos);
	   	PaginarClientesSeleccion((x/y),y,intIdTipoPersona);
	   }
	  });
}

function ListarProveedoresSeleccion(x,y) {
  var busqueda = document.getElementById("BusquedaProveedor").value;
  var funcion = "MPR";
  var intIdTipoPersona = document.getElementById("lista-persona").value;
    $.ajax({
     url:"../../datos/comprobante/funcion_comprobante.php",
     method:"POST",
     data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
     success:function(datos)
     {
      $("#ListaDeProveedoresSeleccion").html(datos);
      PaginarProveedoresSeleccion((x/y),y,intIdTipoPersona);
     }
    });
}
/* FIN - Listar Clientes para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Clientes para la Selección */
function PaginarClientesSeleccion(x,y,intIdTipoPersona) {
	var busqueda = document.getElementById("BusquedaCliente").value;
	var funcion = "PCL";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#PaginacionDeClientes").html(datos);
	   }
	  });
}

function PaginarProveedoresSeleccion(x,y,intIdTipoPersona) {
  var busqueda = document.getElementById("BusquedaProveedor").value;
  var funcion = "PPR";
    $.ajax({
     url:"../../datos/comprobante/funcion_comprobante.php",
     method:"POST",
     data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
     success:function(datos)
     {
      $("#PaginacionDeProveedores").html(datos);
     }
    });
}
/* FIN - Paginar Clientes para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Cliente */
function SeleccionarCliente(seleccion) {
	var intIdCliente = $(seleccion).attr("idscli");
	var funcion = "SCL";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:{intIdCliente:intIdCliente,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	if(datos.intIdTipoPersona == 1){
	   	 $("#nvchNumDocumento").val(datos.nvchRUC);
	   	 $("#nvchDenominacion").val(datos.nvchRazonSocial);
	   	} else if(datos.intIdTipoPersona == 2){
	   	 $("#nvchNumDocumento").val(datos.nvchDNI);
	   	 $("#nvchDenominacion").val(datos.nvchNombres + " " + datos.nvchApellidoPaterno + " " + datos.nvchApellidoMaterno);
	   	}
	   	$("#intIdClienteC").val(datos.intIdCliente);
	   	$("#TipoCliente").val(datos.TipoCliente);
	   	$("#intIdTipoCliente").val(datos.intIdTipoCliente);
	   	$("#nvchDomicilio").val(datos.nvchDomicilio);
      $("#nvchPuntoLlegada").val(datos.nvchDomicilio);
	   	$("#intIdClienteC").val(datos.intIdCliente);
	   	$("#formCliente").modal("hide");
	   }
	  });
}
/* FIN - Seleccion del Cliente */
///////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Producto */
$(document).on('click', '#btn-crear-producto-s', function(){
    var resultado = ValidacionProducto();
    if(resultado == false){
      return false;
    }
    var formData = $("#form-producto").serialize();
    var funcion = "I";
    var y = document.getElementById("num-lista").value;
      var x = 0;
      var tipolistado = "N";
    $.ajax({
     url: "../../datos/inventario/funcion_producto.php",
     method: "POST",
     data: formData,
     success:function(datos)
     {
      datos = datos.replace(/\s/g,''); //quitando espacio
      if (datos == "okokokokokok" || datos == "okokokok") {
        MensajeNormal("Se agregó correctamente el nuevo Producto",1);
        limpiarformProducto();
        ConsultarIdProducto();
      }
      else { $("#resultadocrud").html(datos); }
     }
    });
   return false;
});

function ConsultarIdProducto(){
  var funcion = "Id";
  $.ajax({
     url: "../../datos/inventario/funcion_producto.php",
     method: "POST",
     data: {funcion:funcion},
     success:function(datos)
     {
      datos = datos.replace(/\s/g,'');
      InsertarProductoElegido(datos,numfila);
      $("#formProducto").modal("hide");
     }
    });
}
/* FIN - Funcion Ajax - Insertar Producto */
//////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
// INICIO - funcion creada para autoselecionar cliente despues de su registro
function SeleccionarClienteS(intIdCliente) {
  var funcion = "SCL";
    $.ajax({
     url:"../../datos/comprobante/funcion_comprobante.php",
     method:"POST",
     data:{intIdCliente:intIdCliente,funcion:funcion},
     dataType:"json",
     success:function(datos)
     {
      if(datos.intIdTipoPersona == 1){
       $("#nvchNumDocumento").val(datos.nvchRUC);
       $("#nvchDenominacion").val(datos.nvchRazonSocial);
      } else if(datos.intIdTipoPersona == 2){
       $("#nvchNumDocumento").val(datos.nvchDNI);
       $("#nvchDenominacion").val(datos.nvchNombres + " " + datos.nvchApellidoPaterno + " " + datos.nvchApellidoMaterno);
      }
      $("#intIdClienteC").val(datos.intIdCliente);
      $("#TipoCliente").val(datos.TipoCliente);
      $("#intIdTipoCliente").val(datos.intIdTipoCliente);
      $("#nvchDomicilio").val(datos.nvchDomicilio);
      $("#intIdClienteC").val(datos.intIdCliente);
      $("#formCliente").modal("hide");
     }
    });
}
// END - funcion creada para autoselecionar cliente despues de su registro
/////////////////////////////////////////////////////////////////////////////


function SeleccionarProveedor(seleccion) {
  var intIdProveedor = $(seleccion).attr("idspro");
  var funcion = "SPR";
    $.ajax({
     url:"../../datos/comprobante/funcion_comprobante.php",
     method:"POST",
     data:{intIdProveedor:intIdProveedor,funcion:funcion},
     dataType:"json",
     success:function(datos)
     {
      if(datos.intIdTipoPersona == 1){
       $("#nvchNumDocumento").val(datos.nvchRUC);
       $("#nvchDenominacion").val(datos.nvchRazonSocial);
      } else if(datos.intIdTipoPersona == 2){
       $("#nvchNumDocumento").val(datos.nvchDNI);
       $("#nvchDenominacion").val(datos.nvchNombres + " " + datos.nvchApellidoPaterno + " " + datos.nvchApellidoMaterno);
      }
      $("#intIdProveedorC").val(datos.intIdProveedor);
      $("#nvchDomicilio").val(datos.nvchDomicilio);
      $("#formProveedor").modal("hide");
     }
    });
}

function SeleccionarProveedorS(intIdProveedor) {
  var funcion = "SPR";
    $.ajax({
     url:"../../datos/comprobante/funcion_comprobante.php",
     method:"POST",
     data:{intIdProveedor:intIdProveedor,funcion:funcion},
     dataType:"json",
     success:function(datos)
     {
      if(datos.intIdTipoPersona == 1){
       $("#nvchNumDocumento").val(datos.nvchRUC);
       $("#nvchDenominacion").val(datos.nvchRazonSocial);
      } else if(datos.intIdTipoPersona == 2){
       $("#nvchNumDocumento").val(datos.nvchDNI);
       $("#nvchDenominacion").val(datos.nvchNombres + " " + datos.nvchApellidoPaterno + " " + datos.nvchApellidoMaterno);
      }
      $("#intIdProveedorC").val(datos.intIdProveedor);
      $("#nvchDomicilio").val(datos.nvchDomicilio);
      $("#formProveedor").modal("hide");
     }
    });
}
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Cliente */
function MostrarSeleccionCliente(intIdTipoPersona) {
	  AccionSeleccionClientes('M');
	  if(intIdTipoPersona == 1){
	  	$(".nvchDNI").hide();
      	$(".nvchApellidoPaterno").hide();
      	$(".nvchApellidoMaterno").hide();
      	$(".nvchNombres").hide();
      	$(".nvchRUC").show();
      	$(".nvchRazonSocial").show();
	  } else if(intIdTipoPersona == 2){
	  	$(".nvchDNI").show();
      	$(".nvchApellidoPaterno").show();
      	$(".nvchApellidoMaterno").show();
      	$(".nvchNombres").show();
      	$(".nvchRUC").show();
      	$(".nvchRazonSocial").hide();
	  }
}
function MostrarSeleccionProveedor(intIdTipoPersona) {
    AccionSeleccionClientes('M');
    if(intIdTipoPersona == 1){
      $(".nvchDNI").hide();
        $(".nvchApellidoPaterno").hide();
        $(".nvchApellidoMaterno").hide();
        $(".nvchNombres").hide();
        $(".nvchRUC").show();
        $(".nvchRazonSocial").show();
    } else if(intIdTipoPersona == 2){
      $(".nvchDNI").show();
        $(".nvchApellidoPaterno").show();
        $(".nvchApellidoMaterno").show();
        $(".nvchNombres").show();
        $(".nvchRUC").show();
        $(".nvchRazonSocial").hide();
    }
}
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Comprobante */
$(document).on('change', '#lugar-comprobante', function(){
	
});
/* FIN - Funcion Ajax - Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Cliente */
function MostrarSeleccionComprobante() {
    var intTipoDetalle = $("#intTipoDetalle").val();
	  var intIdTipoComprobante = $("#intIdTipoComprobante").val();
    var intIdSucursal = $("#intIdSucursalC").val();
    /*
    if(intIdSucursal == 1){
      $(".filaUbicacionHuancayo").show();
      $(".filaCantidadHuancayo").show();
      $(".filaUbicacionSanJeronimo").hide();
      $(".filaCantidadSanJeronimo").hide();
    } else if(intIdSucursal == 2){
      $(".filaUbicacionHuancayo").hide();
      $(".filaCantidadHuancayo").hide();
      $(".filaUbicacionSanJeronimo").show();
      $(".filaCantidadSanJeronimo").show();
    }*/
    CamposComprobante(intIdTipoComprobante);
    CamposTabla(intTipoDetalle,intIdTipoComprobante);
    if(intTipoDetalle == 1 || intIdTipoComprobante == 9 || intIdTipoComprobante == 10)
    {
  	  var funcion = "NCPR";
  	  $.ajax({
  	   url:"../../datos/comprobante/funcion_comprobante.php",
  	   method:"POST",
  	   data:{funcion:funcion,intIdTipoComprobante:intIdTipoComprobante,intIdSucursal:intIdSucursal},
  	   dataType:"json",
  	   success:function(datos)
  	   { 
  	   	 if(datos.resultado == "ok"){
  		   	$("#nvchSerie").val(datos.nvchSerie);
  		   	$("#nvchNumeracion").val(datos.nvchNumeracion);
          $("#nvchPuntoPartida").val(datos.nvchDireccion);
  	   	 } else {
  	   	 	alert(datos);
  	   	 }
  	   }
  	  });
    } else {
      $("#nvchSerie").val("");
      $("#nvchNumeracion").val("");
    }
}
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////

function CamposComprobante(intIdTipoComprobante){
  if(intIdTipoComprobante == 10 || intIdTipoComprobante == 9)
    $("#intIdUsuarioSolicitadoCol").show();
  else
    $("#intIdUsuarioSolicitadoCol").hide();
  if(intIdTipoComprobante == 9){
    $("#nvchAtencionCol").show();
    $("#nvchDestinoCol").show();
    $(".filaPrecio").hide();
    $(".filaDescuento").hide();
    $(".txtPrecioUnitario").attr("readonly",false);
  } else {
    $("#nvchAtencionCol").hide();
    $("#nvchDestinoCol").hide();
    $(".filaPrecio").show();
    $(".filaDescuento").show();
    $(".txtPrecioUnitario").attr("readonly",true);
  }
  if(intIdTipoComprobante == 1 || intIdTipoComprobante == 2)
    $("#btnAgregarCotizacion").show();
  else 
    $("#btnAgregarCotizacion").hide();
  if(intIdTipoComprobante == 3 || intIdTipoComprobante == 4)
    $("#btnAgregarVenta").show();
  else
    $("#btnAgregarVenta").hide();

  if(intIdTipoComprobante == 3 ||intIdTipoComprobante == 7){
    $("#btnDescontarGR").show();
  } else {
    $("#btnDescontarGR").hide();
  }

  if(intIdTipoComprobante == 3){
    $("#dtmFechaTrasladoCol").show();
    $("#nvchPuntoPartidaCol").show();
    $("#nvchPuntoLlegadaCol").show();
  } else {
    $("#dtmFechaTrasladoCol").hide();
    $("#nvchPuntoPartidaCol").hide();
    $("#nvchPuntoLlegadaCol").hide();
  }
}

function CamposTabla(intTipoDetalle,intIdTipoComprobante){
  if((intTipoDetalle == 1 && intIdTipoComprobante == 9) || intTipoDetalle == 2 || intIdTipoComprobante == 3 ||
    intIdTipoComprobante == 4){
      if(intIdTipoComprobante == 3 || intIdTipoComprobante == 7){
        $(".filaPrecio").hide();
        $(".filaDescuento").hide();
        $(".filaPrecioUnitario").hide();
        $(".filaTotal").hide();
        $(".txtTotales").hide();
      } else if(intIdTipoComprobante == 4){
        $(".filaPrecio").hide();
        $(".filaDescuento").hide();
        $(".filaPrecioUnitario").show();
        $(".filaTotal").show();
        $(".txtTotales").show();
        $(".txtPrecioUnitario").attr("readonly",true);
      } else {
        $(".filaPrecio").hide();
        $(".filaDescuento").hide();
        $(".filaPrecioUnitario").show();
        $(".filaTotal").show();
        $(".txtTotales").show();
        $(".txtPrecioUnitario").attr("readonly",false);
      }
    } else {
      $(".filaPrecio").show();
      $(".filaDescuento").show();
      $(".filaPrecioUnitario").show();
      $(".filaTotal").show();
      $(".txtTotales").show();
      $(".txtPrecioUnitario").attr("readonly",true);
    }
}

//////////////////////////////////////////////////////////////
/* INICIO - Descargar Reporte Comprobante en Excel */
$(document).on('click', '#DescargarListaComprobanteExcel', function(){
  var busqueda = document.getElementById("txt-busqueda").value;
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  var intIdTipoMoneda = document.getElementById("lista-tipo-moneda").value;
  var intTipoDetalle = $("#intTipoDetalle").val();
  var lblPersonaSingular = '<?php echo $lblPersonaSingular; ?>';
  var lblTituloSingular = '<?php echo $lblTituloSingular; ?>';
  var lblTituloPlural = '<?php echo $lblTituloPlural; ?>';
  
  if(EsFecha("dtmFechaInicial") == false){
    var dtmFechaInicial = "";
  } else {
    var dtmFechaInicial = $("#dtmFechaInicial").val();
  }
  if(EsFecha("dtmFechaFinal") == false){
    var dtmFechaFinal = FechaActual();
  } else {
    var dtmFechaFinal = $("#dtmFechaFinal").val();
  }

  // invocando al excel
  var url = '../../datos/comprobante/clases_comprobante/reporte_comprobante_excel.php?busqueda='+busqueda+'&intIdTipoComprobante='+intIdTipoComprobante+'&intIdTipoMoneda='+intIdTipoMoneda+'&intTipoDetalle='+intTipoDetalle+'&dtmFechaInicial='+dtmFechaInicial+'&dtmFechaFinal='+dtmFechaFinal+'&lblPersonaSingular='+lblPersonaSingular+'&lblTituloSingular='+lblTituloSingular+'&lblTituloPlural='+lblTituloPlural;
  window.open(url);
});
/* FIN - Descargar Reporte Comprobante en Excel */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Descargar Reporte Comprobante en PDF */
$(document).on('click', '#DescargarListaComprobantePDF', function(){
  var busqueda = document.getElementById("txt-busqueda").value;
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  var intIdTipoMoneda = document.getElementById("lista-tipo-moneda").value;
  var intTipoDetalle = $("#intTipoDetalle").val();
  var lblPersonaSingular = '<?php echo $lblPersonaSingular; ?>';
  var lblTituloSingular = '<?php echo $lblTituloSingular; ?>';
  var lblTituloPlural = '<?php echo $lblTituloPlural; ?>';
  
  if(EsFecha("dtmFechaInicial") == false){
    var dtmFechaInicial = "";
  } else {
    var dtmFechaInicial = $("#dtmFechaInicial").val();
  }
  if(EsFecha("dtmFechaFinal") == false){
    var dtmFechaFinal = FechaActual();
  } else {
    var dtmFechaFinal = $("#dtmFechaFinal").val();
  }

  // invocando al excel
  var url = '../../datos/comprobante/clases_comprobante/reporte_comprobante_pdf.php?busqueda='+busqueda+'&intIdTipoComprobante='+intIdTipoComprobante+'&intIdTipoMoneda='+intIdTipoMoneda+'&intTipoDetalle='+intTipoDetalle+'&dtmFechaInicial='+dtmFechaInicial+'&dtmFechaFinal='+dtmFechaFinal+'&lblPersonaSingular='+lblPersonaSingular+'&lblTituloSingular='+lblTituloSingular+'&lblTituloPlural='+lblTituloPlural;
  window.open(url);
});
/* FIN - Descargar Reporte Comprobante en PDF */
//////////////////////////////////////////////////////////////
</script>