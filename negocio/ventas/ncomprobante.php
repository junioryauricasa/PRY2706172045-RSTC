<script>
//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Cliente */
$(document).on('click', '#btn-form-crear-venta', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
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
$(document).on('click', '#btn-crear-venta', function(){
	var intIdTipoVenta = $("#intIdTipoVenta").val();
	var num_filas_detalle_cotizacion = document.getElementById('ListaDeProductosComprar').rows.length;
	if(intIdTipoVenta == 1){
	  var num_filas_detalle_cotizacion = document.getElementById('ListaDeProductosComprar').rows.length;
	  var intIdCliente = $("#intIdCliente").val();
	  if(intIdCliente == "" || intIdCliente == null){
	  	MensajeNormal("Seleccionar a un Cliente",2);
	  	return false;
	  } else if(num_filas_detalle_cotizacion == 0){
	  	MensajeNormal("Ingresar por lo menos elegir un Producto",2);
	  	return false;
	  }
	} else if(intIdTipoVenta == 2){
	  var num_filas_detalle_cotizacion = document.getElementById('ListaDeServiciosComprar').rows.length;
	  var intIdCliente = $("#intIdCliente").val();
	  if(intIdCliente == "" || intIdCliente == null){
	  	MensajeNormal("Seleccionar a un Cliente",2);
	  	return false;
	  } else if(num_filas_detalle_cotizacion == 0){
	  	MensajeNormal("Ingresar por lo menos ingresar un Servicio",2);
	  	return false;
	  }
	}
	  var formData = $("#form-venta").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
  	  var intIdTipoComprobante = document.getElementById("tipo-comprobante").value;
	  $.ajax({
	   url: "../../datos/ventas/funcion_venta.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okokokokokok") {
	   		MensajeNormal("Se generó correctamente la Venta",1);
	   		$("#btn-form-venta-remove").click();
	   		$("#lista-comprobante").val($("#tipo-comprobante").val());
	   		AccionCabecerasTablaComprobante(intIdTipoComprobante);
	   		$('#txt-busqueda').val("");
	   		ListarVenta(x,y,tipolistado);
	   		PaginarVenta(x,y,tipolistado);
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
$(document).on('click', '.btn-mostrar-venta', function(){
  	  var intIdVenta = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{intIdVenta:intIdVenta,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	goToBox("#Formulario");
	   	$("#tipo-comprobante").val($("#intIdTipoComprobante").val());
	   	MostrarSeleccionComprobante($("#intIdTipoComprobante").val());
	   	MostrarDetalleVenta(intIdVenta,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Cliente */
$(document).on('click', '.btn-download-report', function(){
  	  var intIdVenta = $(this).attr("id");
  	  //var funcion = "OCR";
	  $.ajax({
	   url:"../../view/reporte/reportes_internos/consultaSQL4Report.php",
	   method:"POST",
	   data:{intIdVenta:intIdVenta},
	   success:function(datos)
	   {
	   	//$("#formulario-crud").html(datos);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Cliente */
$(document).on('click', '#btn-editar-venta', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-venta").serialize();
  	  var intIdTipoComprobante = document.getElementById("tipo-comprobante").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente la Venta",1);
	   		$("#lista-comprobante").val($("#tipo-comprobante").val());
	   		AccionCabecerasTablaComprobante(intIdTipoComprobante);
	   		$("#btn-form-venta-remove").click();
	   		ListarVenta(x,y,tipolistado);
	   		PaginarVenta(x,y,tipolistado);
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
$(document).on('click', '.btn-eliminar-venta', function(){
  	  var intIdVenta = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{intIdVenta:intIdVenta,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se anuló correctamente la Venta",1);
	   		ListarVenta(x,y,tipolistado);
	   		PaginarVenta((x/y),y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Cliente */
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
  	ListarVenta(x,y,tipolistado);
});

$(document).on('change', '#num-lista', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarVenta(x,y,tipolistado);
});

$(document).on('keyup', '#txt-busqueda', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarVenta(x,y,tipolistado);
});

$(document).on('click', '#btnBuscar', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarVenta(x,y,tipolistado);
});

$(document).on('click', '.btn-pagina', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(this).attr("idp") * y;
  	var tipolistado = "T";
  	ListarVenta(x,y,tipolistado);
});

$(document).on('change', '#lista-tipo-moneda', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(".marca").attr("idp") * y;
  	var tipolistado = "T";
  	ListarVenta(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Venta Realizada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Cliente */
function ListarVenta(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
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
      url:'../../datos/ventas/funcion_venta.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdTipoComprobante:intIdTipoComprobante,
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda},
      success:function(datos) {
          $("#ListaDeVentas").html(datos);
          PaginarVenta((x/y),y,tipolistado);
          TotalVentas();
      }
  });
}
/* FIN - Funcion Ajax - Listar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Total Ventas */
function TotalVentas() {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "TV";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
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
      url:'../../datos/ventas/funcion_venta.php',
      method:"POST",
      data:{busqueda:busqueda,funcion:funcion,intIdTipoComprobante:intIdTipoComprobante,
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda},
      success:function(datos) {
          $("#TotalVentas").val(datos);
      }
  });
}
/* FIN - Funcion Ajax - Total Ventas */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Cliente */
function PaginarVenta(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;

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
      url:'../../datos/ventas/funcion_venta.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdTipoComprobante:intIdTipoComprobante,
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal},
      success:function(datos) {
          $("#PaginacionDeVenta").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Tipo Comprobante */
$(document).on('change', '#tipo-comprobante', function(){
  	 var intIdTipoComprobante = document.getElementById("tipo-comprobante").value;
  	 MostrarSeleccionComprobante(intIdTipoComprobante);
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Tipo Comprobante */
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
	   url:"../../datos/ventas/funcion_cotizacion.php",
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
	   url:"../../datos/ventas/funcion_cotizacion.php",
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
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{intIdCliente:intIdCliente,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	/*
	   	$("#intIdCliente").val(datos.intIdCliente);
	   	$("#nvchRUC").val(datos.nvchRUC);
	   	$("#nvchDNI").val(datos.nvchDNI);
	   	$("#nvchRazonSocial").val(datos.nvchRazonSocial);
	   	$("#nvchApellidoPaterno").val(datos.nvchApellidoPaterno);
	   	$("#nvchApellidoMaterno").val(datos.nvchApellidoMaterno);
	   	$("#nvchNombres").val(datos.nvchNombres);
	   	$("#TipoCliente").val(datos.TipoCliente);
	   	$("#intIdTipoCliente").val(datos.intIdTipoCliente);
	   	*/
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
	   	$("#formCliente").modal("hide");
	   	//MostrarSeleccionCliente(datos.intIdTipoPersona);
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
/* INICIO - Funcion Ajax - Comprobante */
$(document).on('change', '#lugar-venta', function(){
	var y = 5;
	var x = $(".pa-producto").attr("idprt") * y;
	ListarProductosSeleccion(x,y);
});
/* FIN - Funcion Ajax - Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Cliente */
function MostrarSeleccionComprobante() {
	  var intIdTipoComprobante = $("#intIdTipoComprobante").val();
	  var intIdSucursal = $("#intIdSucursal").val();
	  var funcion = "NCPR";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{funcion:funcion,intIdTipoComprobante:intIdTipoComprobante,intIdSucursal:intIdSucursal},
	   dataType:"json",
	   success:function(datos)
	   { 
	   	 if(datos.resultado == "ok"){
		   	$("#nvchSerie").val(datos.nvchSerie);
		   	$("#nvchNumeracion").val(datos.nvchNumeracion);
	   	 } else {
	   	 	alert(datos.resultado);
	   	 }
	   }
	  });
}
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function MostrarTipoVenta() {
	var intIdTipoVenta = $("#intIdTipoVenta").val();
	if(intIdTipoVenta == "1"){
		$("#repuestos").show();
  	  	$("#servicios").hide();
	} else if (intIdTipoVenta == "2") {
		$("#repuestos").hide();
  	  	$("#servicios").show();
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////
</script>