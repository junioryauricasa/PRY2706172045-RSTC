<script>
//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Limpiear campos del Comprobante */
function LimpiarCampos(){
	$("#nvchNumDocumento").val("");
	$("#nvchDenominacion").val("");
	$("#nvchDomicilio").val("");
	$("#TipoCliente").val("");
	$("#intIdCliente").val("");
	$("#intIdProveedor").val("");
	$("#intIdSucursal").val(1);
	$("#intIdTipoComprobante").val(1);
	$("#intIdTipoVenta").val(1);
	$("#intIdTipoMoneda").val(1);
	$("#intIdTipoPago").val(1);
	$("#ListaDeProductosVender").html("");
	$("#ListaDeServiciosVender").html("");
	$("#ListaDeMaquinariasVender").html("");
	AgregarFila(1);
	AgregarFila(2);
	AgregarFila(3);
	if($("#intTipoDetalle").val() == 1){
		$("#ValorVenta").val("S/. 0.00");
		$("#IGVVenta").val("S/. 0.00");
		$("#VentaTotal").val("S/. 0.00");
	} else if($("#intTipoDetalle").val() == 2){
		$("#ValorCompra").val("S/. 0.00");
		$("#IGVCompra").val("S/. 0.00");
		$("#CompraTotal").val("S/. 0.00");
	}
	$("#nvchObservacion").val("");
	MostrarSeleccionComprobante();
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

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Cliente */
$(document).on('click', '#btn-crear-comprobante', function(){
	var intIdTipoVenta = $("#intIdTipoVenta").val();
	if(intIdTipoVenta == 1){
	  var num_filas_detalle_comprobante = document.getElementById('ListaDeProductosVender').rows.length;
	  var intIdCliente = $("#intIdCliente").val();
	  if(intIdCliente == "" || intIdCliente == null){
	  	MensajeNormal("Seleccionar a un Cliente",2);
	  	return false;
	  } else if(num_filas_detalle_comprobante == 0){
	  	MensajeNormal("Ingresar por lo menos elegir un Producto",2);
	  	return false;
	  }
	} else if(intIdTipoVenta == 2){
	  var num_filas_detalle_comprobante = document.getElementById('ListaDeServiciosVender').rows.length;
	  var intIdCliente = $("#intIdCliente").val();
	  if(intIdCliente == "" || intIdCliente == null){
	  	MensajeNormal("Seleccionar a un Cliente",2);
	  	return false;
	  } else if(num_filas_detalle_comprobante == 0){
	  	MensajeNormal("Ingresar por lo menos ingresar un Servicio",2);
	  	return false;
	  }
	}
	  var formData = $("#form-comprobante").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
  	  var intIdTipoComprobante = document.getElementById("intIdTipoComprobante").value;
	  $.ajax({
	   url: "../../datos/comprobante/funcion_comprobante.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okokokokokok" || datos=="okokok") {
	   		MensajeNormal("Se generó correctamente la Venta",1);
	   		$("#lista-comprobante").val(intIdTipoComprobante);
	   		AccionCabecerasTablaComprobante(intIdTipoComprobante);
	   		$('#txt-busqueda').val("");
	   		LimpiarCampos();
	   		$("#btnFormListarComprobante").click();
	   		ListarComprobante(x,y,tipolistado);
	   		PaginarComprobante(x,y,tipolistado);
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
	   success:function(datos)
	   {
	   	/*
	   	$("#formulario-crud").html(datos);
	   	goToBox("#Formulario");
	   	$("#tipo-comprobante").val($("#intIdTipoComprobante").val());
	   	*/
	   	MostrarSeleccionComprobante($("#intIdTipoComprobante").val());
	   	MostrarDetalleComprobante(intIdComprobante,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Cliente */
$(document).on('click', '#btn-editar-comprobante', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-comprobante").serialize();
  	  var intIdTipoComprobante = document.getElementById("tipo-comprobante").value;
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente el Comprobante",1);
	   		/*
	   		$("#lista-comprobante").val($("#tipo-comprobante").val());
	   		AccionCabecerasTablaComprobante(intIdTipoComprobante);
	   		$("#btn-form-comprobante-remove").click();
	   		*/
	   		ListarComprobante(x,y,tipolistado);
	   		PaginarComprobante(x,y,tipolistado);
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
$(document).on('click', '.btn-eliminar-comprobante', function(){
  	  var intIdVenta = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:{intIdVenta:intIdVenta,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se anuló correctamente el Comprobante",1);
	   		ListarComprobante(x,y,tipolistado);
	   		PaginarComprobante((x/y),y,tipolistado);
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

$(document).on('click', '.btn-pagina', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(this).attr("idp") * y;
  	var tipolistado = "T";
  	ListarComprobante(x,y,tipolistado);
});

$(document).on('change', '#lista-tipo-moneda', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(".marca").attr("idp") * y;
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
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda},
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
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda},
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
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal},
      success:function(datos) {
          $("#PaginacionDeComprobante").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Tipo Comprobante */
$(document).on('change', '#intIdTipoComprobante', function(){
  	 var intIdTipoComprobante = document.getElementById("intIdTipoComprobante").value;
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
/* INICIO - Funcion Ajax - Comprobante */
$(document).on('change', '#lugar-comprobante', function(){
	
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
	   url:"../../datos/comprobante/funcion_comprobante.php",
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
</script>