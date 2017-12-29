<script>
//////////////////////////////////////////////////////////////
/* INICIO - Operaciones de Comprobante */
	var numprtst = 0; Number(numprtst);
    var numprt = 0; Number(numprt);
    var num = 2;
    var nums = 2;
    var numfila = 0;
    $(document).on('keyup', '.buscar', function(evt){
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if(charCode == 40 || charCode == 38)
        return false;

      $(this).closest('tr').find("input[name='fila[]']").each(function() {
         numfila = this.value;
      });

      var search = $(this).val();
      search = search.replace(/\s/g,'');
      var funcion = "BP"
      if(search != '')
      {
        var intIdTipoMoneda = $("#intIdTipoMoneda").val();
        var intTipoDetalle = $("#intTipoDetalle").val();
        var intIdTipoVenta = $("#intIdTipoVenta").val();
        $.ajax({
          type: "POST",
          url: "../../datos/inventario/funcion_producto.php",
          data: {search:search,funcion:funcion,intIdTipoMoneda:intIdTipoMoneda,intTipoDetalle:intTipoDetalle,intIdTipoVenta:intIdTipoVenta},
          cache: false,
          success: function(html)
          {
            $("#result"+numfila).html(html).show();
            numprt = $("#result"+numfila+" li").length;
            numprtst = 0;
            $(".result li:eq("+numprtst+")").css("background","#4C66A4");
            $(".result li:eq("+numprtst+")").css("color","#FFFFFF");
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

    $(document).on('click', '.buscar', function(){
      $(".result").html("").hide();
    });

    $(document).on('click', function(e){
      var clicked = $(e.target);
      if (!clicked.hasClass("buscar")){
        $(".result").html("").hide();
      }
    });

    function TeclaSeleccionCodigo(evt){
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if($(".result").is(":visible")){
        switch(charCode){
          case 13:
              var nvchCodigo = $(".result li:eq("+numprtst+")").find('.nvchCodigo').html();
              var intIdProducto = $(".result li:eq("+numprtst+")").find('.intIdProducto').val();
              nvchCodigo = nvchCodigo.replace(/\s/g,'');
              intIdProducto = intIdProducto.replace(/\s/g,'');
              $('#nvchCodigo'+numfila).val(nvchCodigo);
              $('#nvchCodigo'+numfila).blur();
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
      $.ajax({
       url:"../../datos/inventario/funcion_producto.php",
       method:"POST",
       data:{intIdProducto:intIdProducto,funcion:funcion,intIdTipoMoneda:intIdTipoMoneda},
       dataType:"json",
       success:function(datos)
       {
        $("#intIdProducto"+id).val(datos.intIdProducto);
        $("#nvchCodigo"+id).val(datos.nvchCodigo);
        $("#nvchDescripcion"+id).val(datos.nvchDescripcion);
        $("#UbigeoHuancayo"+id).val(datos.UbicacionHuancayo+' | '+datos.CantidadHuancayo);
        $("#UbigeoSanJeronimo"+id).val(datos.UbicacionSanJeronimo+' | '+datos.CantidadSanJeronimo);
        /*
        $("#UbicacionHuancayo").val(datos.UbicacionHuancayo);
        $("#CantidadHuancayo").val(datos.CantidadHuancayo);
        $("#UbicacionSanJeronimo").val(datos.UbicacionSanJeronimo);
        $("#CantidadSanJeronimo").val(datos.CantidadSanJeronimo);
        */
        $("#dcmPrecio"+id).val(datos.dcmPrecioVenta1);
        $("#dcmDescuentoVenta2"+id).val(datos.dcmDescuentoVenta2);
        $("#dcmDescuentoVenta3"+id).val(datos.dcmDescuentoVenta3);
       }
      });
    }

    function AgregarFila(intIdTipoVenta){
    var camposVender = '';
	   camposVender ='<td>'+
		            '<input type="text" id="dcmPrecio'+num+'" name="dcmPrecio[]" form="form-cotizacion" readonly />'+
		            '<input type="hidden" id="dcmDescuentoVenta2'+num+'" form="form-cotizacion" readonly />'+
		            '<input type="hidden" id="dcmDescuentoVenta3'+num+'" form="form-cotizacion" readonly />'+
		          '</td>'+
		          '<td><input type="text" style="max-width: 105px !important" id="dcmDescuento'+num+'" name="dcmDescuento[]" form="form-cotizacion" idsprt="'+num+'"'+
		            'onkeyup="CalcularPrecioTotal(this)"/></td>';
    if(intIdTipoVenta == 1){
        $('#ListaDeProductosVender').append(
        '<tr>'+
          '<td class="heading" data-th="ID">'+num+'</td>'+
          '<td><input type="hidden" style="width: 110px !important" name="fila[]" value="'+num+'" form="form-cotizacion" />'+
              '<input type="hidden" style="width: 110px !important" id="intIdProducto'+num+'" name="intIdProducto[]" form="form-cotizacion" />'+
              '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigo'+num+'" name="nvchCodigo[]" form="form-cotizacion" onkeydown="return TeclaSeleccionCodigo(event)"/>'+
              '<div class="result" id="result'+num+'">'+
          '</td>'+
          '<td><input type="text" style="width: 100% !important" id="nvchDescripcion'+num+'" name="nvchDescripcion[]" form="form-cotizacion" readonly/></td>'+
          '<td class="filaUbigeoHuancayo">'+
            '<input type="text" style="width: 100%" id="UbigeoHuancayo'+num+'" form="form-comprobante" class="" readonly/>'+
          '</td>'+
          '<td class="filaUbigeoSanJeronimo">'+
            '<input type="text" style="width: 100%" id="UbigeoSanJeronimo'+num+'" form="form-comprobante" class="" readonly/>'+
          '</td>'+
          camposVender+
          '<td><input type="text" style="max-width: 105px !important" id="dcmPrecioUnitario'+num+'" name="dcmPrecioUnitario[]" form="form-cotizacion" onkeyup="CalcularPrecioTotal(this)" idsprt="'+num+'" readonly /></td>'+
          '<td><input type="text" id="intCantidad'+num+'" name="intCantidad[]" form="form-cotizacion" idsprt="'+num+'"'+
            'onkeyup="CalcularPrecioTotal(this)"/></td>'+
          '<td><input type="text" id="dcmTotal'+num+'" name="dcmTotal[]" form="form-cotizacion" readonly/></td>'+
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
            '<input style="width: 110px !important" type="hidden" name="fila[]" value="'+nums+'" form="form-cotizacion" />'+
            '<textarea id="nvchDescripcionS'+nums+'" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionS[]" form="form-cotizacion" rows="4"></textarea>'+
          '</td>'+
          '<td>'+
            '<input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioS'+nums+'" name="dcmPrecioUnitarioS[]" idsprt="'+nums+'" form="form-cotizacion" onkeyup="CalcularPrecioTotalS(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="intCantidadS'+nums+'" name="intCantidadS[]" idsprt="'+nums+'" form="form-cotizacion" onkeyup="CalcularPrecioTotalS(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="dcmTotalS'+nums+'" name="dcmTotalS[]" form="form-cotizacion" readonly/>'+
          '</td>'+
          '<td style="width: 25px !important" >'+
            '<button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">'+
                '<i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i>' +
            '</button>'+
          '</td>'+
        '</tr>');
        nums++;
      }
    }

    function formCliente(){
      $("#formCliente").modal("show");
    }

    function formProveedor(){
      $("#formProveedor").modal("show");
    }

    function ElegirTabla(intIdTipoVenta){
      if(intIdTipoVenta == 1){
        $("#tablaRepuestos").show();
        $("#tablaServicios").hide();
        $("#tablaMaquinarias").hide();
        CamposMaquinaria(intIdTipoVenta);
        CalcularTotal();
      } else if(intIdTipoVenta == 2) {
        $("#tablaRepuestos").hide();
        $("#tablaServicios").show();
        $("#tablaMaquinarias").hide();
        CamposMaquinaria(intIdTipoVenta);
        CalcularTotal();
      }
    }
/* FIN - Operaciones de Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Limpiear campos del Cotizacion */
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

function LimpiarCampos(){
	$("#nvchNumDocumento").val("");
	$("#nvchDenominacion").val("");
	$("#nvchDomicilio").val("");
	$("#TipoCliente").val("");
	$("#intIdClienteC").val("");
	$("#intIdTipoVenta").val(1);
	$("#intIdTipoVenta").change();
	$("#intIdTipoMoneda").val(2);
	$("#intIdTipoPago").val(1);
	$("#ListaDeProductosVender").html("");
	$("#ListaDeServiciosVender").html("");
	RestablecerValidacion("intDiasValidez",1);
	RestablecerValidacion("nvchAtencion",1);
	RestablecerValidacion("nvchTipo",1);
	RestablecerValidacion("nvchModelo",1);
	RestablecerValidacion("nvchMarca",1);
	RestablecerValidacion("nvchHorometro",1);
	LimpiarTablas();
  HabilitacionOpciones(1);
	$("#VentaTotal").val("S/. 0.00");
	$("#nvchObservacion").val("");
}
/* FIN - Funcion Ajax - Limpiear campos del Cotizacion */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Formulario de Realizar Venta */
function NuevaCotizacion(){
	LimpiarCampos();
	$("#btnFormRealizarCotizacion").click();
}

function LimpiarTablas(){
  $("#ListaDeProductosVender").html("");
  $("#ListaDeServiciosVender").html("");
  num = 1;
  nums = 1;
  AgregarFila(1);
  AgregarFila(2);
}

function HabilitacionOpciones(accion){
  if(accion == 1){
    $('.opcion-boton-editar').hide();
    $('#intIdTipoVenta').attr("disabled", false);
    $('#intIdTipoPago').attr("disabled", false);
    $('.opcion-boton-nuevo').show();
    $('.opcion-columna-nuevo').show();
    $("#funcionC").val("I");
    $("#nvchNumeracionCol").hide();
  } else {
    <?php if($_SESSION['intIdTipoUsuario'] != 1) {?>
    $('#intIdTipoVenta').attr("disabled", true);
    $('#intIdTipoPago').attr("disabled", true);
    $('.opcion-columna-nuevo').hide();
    $('.opcion-boton-editar').show();
    $("#txtOpcionFecha").val("1");
    OpcionFecha("1");
    $("nvchFecha").attr("readonly",true);
    <?php } else {?>
    $('#btn-crear-cotizacion').hide();
    $('.opcion-boton-editar').show();
    OpcionFecha("1");
    <?php } ?>
    $("#funcionC").val("A");
    $("#nvchNumeracionCol").show();
  }
}

function ValidacionCotizacion(){
  var intIdTipoVenta = $("#intIdTipoVenta").val();
  var intIdCliente = $("#intIdClienteC").val()
  if(intIdCliente == "" || intIdCliente == null){
    MensajeNormal("Seleccionar a un Cliente",2);
    return false;
  } else if(EsFechaHora('nvchFecha') == false){
    goToBox("#nvchFechaGroup");
    return false;
  } else if(EsNumeroEntero('intDiasValidez') == false){
    goToBox("#intDiasValidezGroup");
    return false;
  } else if(EsVacio('nvchAtencion') == false){
    goToBox("#nvchAtencionGroup");
    return false;
  }

  if(intIdTipoVenta == 2){
    if(EsVacio('nvchTipo') == false){
      goToBox("#nvchTipoGroup");
      return false;
    } else if(EsVacio('nvchModelo') == false){
      goToBox("#nvchModeloGroup");
      return false;
    } else if(EsVacio('nvchMarca') == false){
      goToBox("#nvchMarcaGroup");
      return false;
    } else if(EsVacio('nvchHorometro') == false){
      goToBox("#nvchHorometroGroup");
      return false;
    }
  }

  switch(intIdTipoVenta){
    case "1":
        var num_filas_detalle_cotizacion = document.getElementById('ListaDeProductosVender').rows.length;
        if(num_filas_detalle_cotizacion == 0){
          MensajeNormal("Ingresar por lo menos elegir un Producto",2);
          return false;
        } else {
          var filas_vacias = ValidacionFilasVacias("Productos","");
          if (filas_vacias == num_filas_detalle_cotizacion) {
            MensajeNormal("Ingresar por lo menos elegir un Producto",2);
            return false;
          }
        }
        break;
    case "2":
        var num_filas_detalle_cotizacion = document.getElementById('ListaDeServiciosVender').rows.length;
        if(num_filas_detalle_cotizacion == 0){
          MensajeNormal("Ingresar por lo menos ingresar un Servicio",2);
          return false;
        } else {
          var filas_vacias = ValidacionFilasVacias("Servicios","S");
          if (filas_vacias == num_filas_detalle_cotizacion) {
            MensajeNormal("Ingresar por lo menos elegir un Servicio",2);
            return false;
          }
        }
        break;
  }
}
/* FIN - Funcion Ajax - Formulario de Realizar Venta */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Cliente */
$(document).on('click', '#btn-form-crear-cotizacion', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_cotizacion.php",
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

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Cliente */
$(document).on('click', '#btn-crear-cotizacion', function(){
  var resultado = ValidacionCotizacion();
  if(resultado == false){
    return true;
  }
	var formData = $("#form-cotizacion").serialize();
  var funcion = "I";
  var y = document.getElementById("num-lista").value;
  var x = 0;
  var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/comprobante/funcion_cotizacion.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	datos = datos.replace(/\s/g,'');
	   	if (datos=="okok") {
	   		MensajeNormal("Se generó correctamente la Cotización",1);
	   		$('#txt-busqueda').val("");
	   		LimpiarCampos();
	   		$("#btnFormListarCotizacion").click();
	   		ListarCotizacion(x,y,tipolistado);
	   		//PaginarCotizacion(x,y,tipolistado);
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
$(document).on('click', '.btn-mostrar-cotizacion', function(){
  var intIdCotizacion = $(this).attr("id");
  var funcion = "M";
  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_cotizacion.php",
	   method:"POST",
	   data:{intIdCotizacion:intIdCotizacion,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
       $("#intIdCotizacion").val(datos.intIdCotizacion);
       $("#nvchSerie").val(datos.nvchSerie);
       $("#nvchNumeracion").val(datos.nvchNumeracion);
     	 $("#nvchFecha").val(datos.dtmFechaCreacion);
       $("#nvchAtencion").val(datos.nvchAtencion);
       $("#intDiasValidez").val(datos.intDiasValidez);
       $("#nvchTipo").val(datos.nvchTipo);
       $("#nvchMarca").val(datos.nvchMarca);
       $("#nvchModelo").val(datos.nvchModelo);
       $("#nvchHorometro").val(datos.nvchHorometro);
     	 $("#intIdTipoVenta").val(datos.intIdTipoVenta);
     	 $("#intIdTipoMoneda").val(datos.intIdTipoMoneda);
     	 $("#intIdTipoPago").val(datos.intIdTipoPago);
       $("#nvchNumDocumento").val(datos.nvchDNIRUC);
  	   $("#nvchDenominacion").val(datos.nvchClienteProveedor);
  	   $("#nvchDomicilio").val(datos.nvchDireccion);
  	   $("#TipoCliente").val(datos.TipoCliente);
       $("#intIdTipoCliente").val(datos.intIdTipoCliente);
       $("#intIdClienteC").val(datos.intIdCliente);
       $("textarea#nvchObservacion").val(datos.nvchObservacion);
  	   HabilitacionOpciones(2);
  	   ElegirTabla(datos.intIdTipoVenta);
  	   MostrarDetalleCotizacion(datos.intIdCotizacion,datos.intIdTipoVenta);
     	 $("#btnFormRealizarCotizacion").click();
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Cliente */
$(document).on('click', '#btn-editar-cotizacion', function(){
  var resultado = ValidacionCotizacion();
  if(resultado == false){
    return true;
  }
  var funcion = "A";
  var y = document.getElementById("num-lista").value;
  var x = $(".marca-cotizacion").attr("idp") * y;
  var tipolistado = "E";
  var formData = $("#form-cotizacion").serialize();
	  $.ajax({
	   url:"../../datos/comprobante/funcion_cotizacion.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
      datos = datos.replace(/\s/g,'');
	   	if (datos=="okok") {
	   		MensajeNormal("Se modificó correctamente el Cotizacion",1);
        LimpiarCampos();
        $("#btnFormListarCotizacion").click();
	   		ListarCotizacion(x,y,tipolistado);
	   		//PaginarCotizacion(x,y,tipolistado);
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
$(document).on('click', '.btn-eliminar-cotizacion', function(){
	  var intIdVenta = $(this).attr("id");
	  var y = document.getElementById("num-lista").value;
	  var x = $(".marca-cotizacion").attr("idp") * y;
	  var tipolistado = "D";
	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_cotizacion.php",
	   method:"POST",
	   data:{intIdVenta:intIdVenta,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se anuló correctamente el Cotizacion",1);
	   		ListarCotizacion(x,y,tipolistado);
	   		PaginarCotizacion((x/y),y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Cliente */
//////////////////////////////////////////////////////////////

var intIdC = 0;
var intIdTV = 0;

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Reporte Cotizacion */
$(document).on('click', '.btn-reporte-cotizacion', function(){
var intIdCotizacion = $(this).attr("id");
var intIdTipoVenta = $(this).attr("idtv");
var intConfirmacion = 0;
if(intIdTipoVenta == 1){
    intIdC = intIdCotizacion;
    intIdTV = intIdTipoVenta;
    $('#MensajeVisualizarCodigos').modal('show');
  }
else
  ReporteCotizacion(intIdCotizacion,intIdTipoVenta,intConfirmacion);
});

$(document).on('click', '#MVC-btn-si', function(){
  var intConfirmacion = 1;
  $('#MensajeVisualizarCodigos').modal('hide');
  ReporteCotizacion(intIdC,intIdTV,intConfirmacion);
});

$(document).on('click', '#MVC-btn-no', function(){
  var intConfirmacion = 0;
  $('#MensajeVisualizarCodigos').modal('hide');
  ReporteCotizacion(intIdC,intIdTV,intConfirmacion);
});

function ReporteCotizacion(intIdCotizacion,intIdTipoVenta,intConfirmacion){
if(intIdTipoVenta == 1)
var url = '../../datos/comprobante/clases_cotizacion/reporte_cotizacion_repuesto.php?intIdCotizacion='+intIdCotizacion+'&intConfirmacion='+intConfirmacion;
else if(intIdTipoVenta == 2)
  var url = '../../datos/comprobante/clases_cotizacion/reporte_cotizacion_servicio.php?intIdCotizacion='+intIdCotizacion;
window.open(url);
return false;
}
/* FIN - Funcion Ajax - Reporte Cotizacion */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Venta Realizada */
$(document).on('change', '#num-lista', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarCotizacion(x,y,tipolistado);
});

$(document).on('keyup', '#txt-busqueda', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarCotizacion(x,y,tipolistado);
});

$(document).on('click', '#btnBuscar', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarCotizacion(x,y,tipolistado);
});

$(document).on('click', '.btn-pagina-cotizacion', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(this).attr("idp") * y;
  	var tipolistado = "T";
  	ListarCotizacion(x,y,tipolistado);
});

$(document).on('change', '#lista-tipo-moneda', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(".marca-cotizacion").attr("idp") * y;
  	var tipolistado = "T";
  	ListarCotizacion(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Venta Realizada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Cliente */
function ListarCotizacion(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  var intIdTipoMoneda = document.getElementById("lista-tipo-moneda").value;
  
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
      url:'../../datos/comprobante/funcion_cotizacion.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda},
      success:function(datos) {
          $("#ListaDeCotizaciones").html(datos);
          PaginarCotizacion((x/y),y,tipolistado);
          TotalCotizacion();
      }
  });
}
/* FIN - Funcion Ajax - Listar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Total Ventas */
function TotalCotizacion() {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "TCT";
  var intIdTipoMoneda = document.getElementById("lista-tipo-moneda").value;
  
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
      url:'../../datos/comprobante/funcion_cotizacion.php',
      method:"POST",
      data:{busqueda:busqueda,funcion:funcion,dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda},
      success:function(datos) {
          $("#TotalCotizacion").val(datos);
      }
  });
}
/* FIN - Funcion Ajax - Total Ventas */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Cliente */
function PaginarCotizacion(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";

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
      url:'../../datos/comprobante/funcion_cotizacion.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal},
      success:function(datos) {
          $("#PaginacionDeCotizacion").html(datos);
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
function CamposMaquinaria(intIdTipoVenta) {
  if(intIdTipoVenta == "1"){
    $("#nvchTipoCol").hide();
    $("#nvchMarcaCol").hide();
    $("#nvchModeloCol").hide();
    $("#nvchHorometroCol").hide();
  } else if (intIdTipoVenta == "2") {
    $("#nvchTipoCol").show();
    $("#nvchMarcaCol").show();
    $("#nvchModeloCol").show();
    $("#nvchHorometroCol").show();
  }
}
/* FIN - Ocultar Botones */
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
	AccionCabecerasTabla(intIdTipoPersona);
	var y = 5;
	var x = 0;
	ListarClientesSeleccion(x,y);
});

$(document).on('keyup', '#BusquedaCliente', function(){
	var y = 5;
	var x = 0;
	ListarClientesSeleccion(x,y);
});

function PaginacionClientes(seleccion) {
	var y = 5;
	var x = $(seleccion).attr("idcli") * y;
	ListarClientesSeleccion(x,y);
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
	   url:"../../datos/comprobante/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeClientesSeleccion").html(datos);
	   	PaginarClientesSeleccion((x/y),y,intIdTipoPersona);
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
	   url:"../../datos/comprobante/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#PaginacionDeClientes").html(datos);
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
	   url:"../../datos/comprobante/funcion_cotizacion.php",
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
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Producto */
$(document).on('click', '#btn-crear-producto-s', function(){
    var num_filas_codigo = document.getElementById('ListaDeCodigos').rows.length;
    var num_filas_ubicacion = document.getElementById('ListaDeUbicaciones').rows.length;
    $("#funcion").val("I");
    if(EsVacio("nvchDescripcion") == false){
      goToBox("#nvchDescripcionGroup");
      return false;
    } else if(EsNumeroEntero("intCantidadMinima") == false){
      goToBox("#intCantidadMinimaGroup");
      return false;
    } else if(EsDecimal("dcmPrecioCompra") == false){
      goToBox("#dcmPrecioCompraGroup");
      return false;
    } else if(EsDecimal("dcmPrecioVenta1") == false){
      goToBox("#dcmPrecioVenta1Group");
      return false;
    } else if(EsDecimal("dcmPrecioVenta2") == false){
      goToBox("#dcmPrecioVenta2Group");
      return false;
    } else if(EsDecimal("dcmPrecioVenta3") == false){
      goToBox("#dcmPrecioVenta3Group");
      return false;
    } else if(EsDecimal("dcmDescuentoVenta2") == false){
      goToBox("#dcmDescuentoVenta2Group");
      return false;
    } else if(EsDecimal("dcmDescuentoVenta3") == false){
      goToBox("#dcmDescuentoVenta3Group");
      return false;
    } else if(num_filas_codigo == 0){
      MensajeNormal("Ingrese por lo menos un Código de Producto",2);
      return false;
    } else if(num_filas_ubicacion == 0){
      MensajeNormal("Ingresar por lo menos una Ubicación del Producto",2);
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
      if (datos == "okokokokok") {
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
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////
</script>