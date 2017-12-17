<script>
var SintIdPlantillaCotizacion = 0;
var SIIPC = 0;
//////////////////////////////////////////////////////////////
/* INICIO - Operaciones de Comprobante */
function formCliente(){
  $("#formCliente").modal("show");
}
/* FIN - Operaciones de Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Limpiear campos del Cotizacion */
function LimpiarCampos(){
$("#nvchNumDocumento").val("");
$("#nvchDenominacion").val("");
$("#nvchDomicilio").val("");
$("#TipoCliente").val("");
$("#intIdCliente").val("");
$("#intIdTipoVenta").val(3);
$("#intIdTipoMoneda").val(1);
$("#intIdTipoVenta").change();
$("#intIdPlantillaCotizacion").val(1);
$("#intIdAutor").val(1);
$("#dcmIGVVenta").val("0.00");
$("#dcmValorVenta").val("0.00");
RestablecerValidacion("dcmPrecioVenta",1);
RestablecerValidacion("nvchDiasValidez",1);
RestablecerValidacion("nvchAtencion",1);
RestablecerValidacion("nvchTelefono",1);
RestablecerValidacion("nvchGarantia",1);
RestablecerValidacion("nvchFormaPago",1);
RestablecerValidacion("nvchLugarEntrega",1);
RestablecerValidacion("nvchTiempoEntrega",1);
$("#nvchGarantia").val("01 Año, sin límites de horas");
$("#nvchFormaPago").val("Contado o Leasing");
$("#nvchLugarEntrega").val("Almacenes de Huancayo");
$("#nvchTiempoEntrega").val("Inmediata, salvo previa venta");
$("#nvchDiasValidez").val("15 Días");
$("#nvchObservacion").val("");
}
/* FIN - Funcion Ajax - Limpiear campos del Cotizacion */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Limpiear campos del Comprobante */
function HabilitacionOpciones(accion){
	if(accion == 1){
		$('.opcion-boton-nuevo').show();
		$('.opcion-boton-editar').hide();
	} else {
		$('.opcion-boton-nuevo').hide();
		$('.opcion-boton-editar').show();
	}
}
/* FIN - Funcion Ajax - Limpiear campos del Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Formulario de Realizar Venta */
function ListarTipoEquipo(intIdTipoVenta){
  var funcion = "LTE";
  $.ajax({
     url:"../../datos/equipo/funcion_equipo.php",
     method:'POST',
     data:{funcion:funcion,intIdTipoVenta:intIdTipoVenta},
     success:function(datos)
     { 
       $("#intIdPlantillaCotizacion").html(datos);
       if($("#funcion").val()=="M" && SIIPC < 2){
       	$("#intIdPlantillaCotizacion").val(SintIdPlantillaCotizacion);
       	SIIPC++;
       } else {
       	 $("#funcion").val("");
       	 SIIPC = 0;
       }
     }
    });
}
/* FIN - Funcion Ajax - Formulario de Realizar Venta */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Formulario de Realizar Venta */
function NuevaCotizacion(){
	LimpiarCampos();
	$("#btnFormRealizarCotizacion").click();
}
/* FIN - Funcion Ajax - Formulario de Realizar Venta */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Cliente */
$(document).on('click', '#btn-crear-cotizacion', function(){
    $("#funcion").val("I");
    var intIdCliente = $("#intIdCliente").val();
	  if(intIdCliente == "" || intIdCliente == null){
	  	MensajeNormal("Seleccionar a un Cliente",2);
	  	return false;
	  }
	  var formData = $("#form-cotizacion").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/equipo/funcion_equipo.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	datos = datos.replace(/\s/g,'');
	   	if (datos=="ok") {
	   		MensajeNormal("Se generó correctamente la Cotización",1);
	   		$('#txt-busqueda').val("");
	   		LimpiarCampos();
	   		$("#btnFormListarCotizacion").click();
	   		ListarCotizacion(x,y,tipolistado);
	   		PaginarCotizacion(x,y,tipolistado);
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Reporte Cotizacion */
$(document).on('click', '.btn-reporte-cotizacion', function(){
  var intIdCotizacionEquipo = $(this).attr("id");
  var url = '../../datos/equipo/clases_equipo/reporte_equipo.php?intIdCotizacionEquipo='+intIdCotizacionEquipo;
  //window.open(url);
  window.location.href = url;
});
/* FIN - Funcion Ajax - Reporte Cotizacion */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Cliente */
$(document).on('click', '.btn-mostrar-cotizacion', function(){
	  $("#funcion").val("M");
  	  var intIdCotizacionEquipo = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/equipo/funcion_equipo.php",
	   method:"POST",
	   data:{intIdCotizacionEquipo:intIdCotizacionEquipo,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	LimpiarCampos();
	   	$("#intIdCotizacionEquipo").val(datos.intIdCotizacionEquipo);
	   	$("#nvchFecha").val(datos.dtmFechaCreacion);
	   	$("#intIdTipoVenta").val(datos.intIdTipoVenta);
	   	$("#intIdTipoMoneda").val(datos.intIdTipoMoneda);
	   	//$("#intIdPlantillaCotizacion").val(datos.intIdPlantillaCotizacion);

	   	$("#nvchNumDocumento").val(datos.nvchDNIRUC);
		$("#nvchDenominacion").val(datos.nvchClienteProveedor);
		$("#nvchDomicilio").val(datos.nvchDireccion);
		$("#TipoCliente").val(datos.TipoCliente);
		$("#intIdTipoCliente").val(datos.intIdTipoCliente);
		$("#intIdCliente").val(datos.intIdCliente);
		$("#intIdUsuario").val(datos.intIdUsuario);
		$("#nvchTelefono").val(datos.nvchTelefono);
		$("#nvchAtencion").val(datos.nvchAtencion);

		$("#nvchGarantia").val(datos.nvchGarantia);
		$("#nvchTiempoEntrega").val(datos.nvchTiempoEntrega);
		$("#nvchLugarEntrega").val(datos.nvchLugarEntrega);
		$("#nvchDiasValidez").val(datos.nvchDiasValidez);
		$("#nvchFormaPago").val(datos.nvchFormaPago);

		$("#dcmValorVenta").val(datos.dcmValorVenta);
		$("#dcmIGVVenta").val(datos.dcmIGVVenta);
		$("#dcmPrecioVenta").val(datos.dcmPrecioVenta);

		$("textarea#nvchObservacion").val(datos.nvchObservacion);
		HabilitacionOpciones(2);
		SintIdPlantillaCotizacion = datos.intIdPlantillaCotizacion;
		$("#intIdTipoVenta").change();
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
      $("#funcion").val("A");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-cotizacion").serialize();
	  $.ajax({
	   url:"../../datos/equipo/funcion_equipo.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se Modificó correctamente la Cotizacion",1);
	   		ListarCotizacion(x,y,tipolistado);
	   		PaginarCotizacion(x,y,tipolistado);
	   		LimpiarCampos();
	   		HabilitacionOpciones(1);
	   		$("#btnFormListarCotizacion").click();
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
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/equipo/funcion_equipo.php",
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

$(document).on('click', '.btn-pagina', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(this).attr("idp") * y;
  	var tipolistado = "T";
  	ListarCotizacion(x,y,tipolistado);
});

$(document).on('change', '#lista-tipo-moneda', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(".marca").attr("idp") * y;
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
  //var intIdTipoMoneda = document.getElementById("lista-tipo-moneda").value;
  
  /*
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
  */

  $.ajax({
      url:'../../datos/equipo/funcion_equipo.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#ListaDeCotizaciones").html(datos);
          PaginarCotizacion((x/y),y,tipolistado);
          //TotalCotizacion();
      }
  });
}
/* FIN - Funcion Ajax - Listar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Total Ventas */
/*
function TotalCotizacion() {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "TV";
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
      url:'../../datos/equipo/funcion_equipo.php',
      method:"POST",
      data:{busqueda:busqueda,funcion:funcion,dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda},
      success:function(datos) {
          $("#TotalCotizacion").val(datos);
      }
  });
}
*/
/* FIN - Funcion Ajax - Total Ventas */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Cliente */
function PaginarCotizacion(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  /*
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
  */

  $.ajax({
      url:'../../datos/equipo/funcion_equipo.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
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
	   url:"../../datos/ventas/funcion_venta.php",
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
	   url:"../../datos/ventas/funcion_venta.php",
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
	   	$("#intIdCliente").val(datos.intIdCliente);
	   	$("#TipoCliente").val(datos.TipoCliente);
	   	$("#intIdTipoCliente").val(datos.intIdTipoCliente);
	   	$("#nvchDomicilio").val(datos.nvchDomicilio);
	   	$("#intIdCliente").val(datos.intIdCliente);
	   	$("#formCliente").modal("hide");
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
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Campos */
function CalcularVentaIGV() {
  if(EsDecimal('dcmPrecioVenta') == false){
    return false;
  }
  var dcmPrecioVenta = $("#dcmPrecioVenta").val();
  var dcmValorVenta = (dcmPrecioVenta / 1.18).toFixed(2) ;
  var dcmIGVVenta = (dcmPrecioVenta - dcmValorVenta).toFixed(2);
    $("#dcmIGVVenta").val(dcmIGVVenta);
    $("#dcmValorVenta").val(dcmValorVenta);
}
/* FIN - Ocultar Campos */
//////////////////////////////////////////////////////////////
</script>