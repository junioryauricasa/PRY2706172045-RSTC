//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Cotización */
$(document).on('click', '#btn-form-crear-cotizacion', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
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
/* FIN - Funcion Ajax - Visualizar Formulario Crear Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Cotización */
$(document).on('click', '#btn-crear-cotizacion', function(){
	var intIdTipoVenta = $("#tipo-venta").val();
	if(intIdTipoVenta == 1){
	  var num_filas_detalle_cotizacion = document.getElementById('ListaDeProductosComprar').rows.length;
	  var intIdCotización = $("#intIdCotización").val();
	  if(intIdCotización == "" || intIdCotización == null){
	  	MensajeNormal("Seleccionar a un Cotización",2);
	  	return false;
	  } else if(EsVacio("nvchAtencion") == false){
	  	goToBox("#nvchAtencionGroup");
	  	return false;
	  } else if(EsNumeroEntero("intDiasValidez") == false){
	  	goToBox("#intDiasValidezGroup");
	  	return false;
	  } else if(num_filas_detalle_cotizacion == 0){
	  	MensajeNormal("Ingresar por lo menos elegir un Producto",2);
	  	return false;
	  }
	} else if(intIdTipoVenta == 2){
	  var num_filas_detalle_cotizacion = document.getElementById('ListaDeServiciosComprar').rows.length;
	  var intIdCotización = $("#intIdCotización").val();
	  if(intIdCotización == "" || intIdCotización == null){
	  	MensajeNormal("Seleccionar a un Cotización",2);
	  	return false;
	  } else if(EsVacio("nvchAtencion") == false){
	  	goToBox("#nvchAtencionGroup");
	  	return false;
	  } else if(EsNumeroEntero("intDiasValidez") == false){
	  	goToBox("#intDiasValidezGroup");
	  	return false;
	  } else if(EsVacio("nvchTipo") == false){
	  	goToBox("#nvchTipoGroup");
	  	return false;
	  } else if(EsVacio("nvchModelo") == false){
	  	goToBox("#nvchModeloGroup");
	  	return false;
	  } else if(EsVacio("nvchMarca") == false){
	  	goToBox("#nvchMarcaGroup");
	  	return false;
	  } else if(EsVacio("nvchHorometro") == false){
	  	goToBox("#nvchHorometroGroup");
	  	return false;
	  } else if(num_filas_detalle_cotizacion == 0){
	  	MensajeNormal("Ingresar por lo menos ingresar un Servicio",2);
	  	return false;
	  }
	}
	  var formData = $("#form-cotizacion").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/ventas/funcion_cotizacion.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okok") {
	   		MensajeNormal("Se generó correctamente la cotización",1);
	   		$("#btn-form-cotizacion-remove").click();
	   		$('#txt-busqueda').val("");
	   		ListarCotizacion(x,y,tipolistado);
	   		PaginarCotizacion(x,y,tipolistado);
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Cotización */
$(document).on('click', '.btn-mostrar-cotizacion', function(){
  	  var intIdCotizacion = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{intIdCotizacion:intIdCotizacion,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	goToBox("#Formulario");
	   	MostrarDetalleCotizacion(intIdCotizacion,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Cotización */
$(document).on('click', '.btn-download-report', function(){
  	  var intIdCotizacion = $(this).attr("id");
  	  //var funcion = "OCR";
	  $.ajax({
	   url:"../../view/reporte/reportes_internos/consultaSQL4Report.php",
	   method:"POST",
	   data:{intIdCotizacion:intIdCotizacion},
	   success:function(datos)
	   {
	   	//$("#formulario-crud").html(datos);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Cotización */
$(document).on('click', '#btn-editar-cotizacion', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-cotizacion").serialize();
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente la cotización",1);
	   		$("#btn-form-cotizacion-remove").click();
	   		ListarCotizacion(x,y,tipolistado);
	   		PaginarCotizacion(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Actualizar Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Eliminar Cotización */
$(document).on('click', '.btn-eliminar-cotizacion', function(){
  	  var intIdCotizacion = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{intIdCotizacion:intIdCotizacion,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se anuló correctamente la Cotización",1);
	   		ListarCotizacion(x,y,tipolistado);
	   		PaginarCotizacion(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Cotización */
$(document).on('change', '#num-lista', function(){
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

$(document).on('change', '#lista-tipo-moneda', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(".marca").attr("idp") * y;
  	var tipolistado = "T";
  	ListarCotizacion(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Cotización */
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
      url:'../../datos/ventas/funcion_cotizacion.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdTipoMoneda:intIdTipoMoneda,
      	dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal},
      success:function(datos) {
          $("#ListaDeCotizaciones").html(datos);
          PaginarCotizacion((x/y),y,tipolistado);
          TotalCotizaciones();
      }
  });
}
/* FIN - Funcion Ajax - Listar Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Total Cotizaciones */
function TotalCotizaciones() {
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
      url:'../../datos/ventas/funcion_cotizacion.php',
      method:"POST",
      data:{busqueda:busqueda,funcion:funcion,intIdTipoMoneda:intIdTipoMoneda,dtmFechaInicial:dtmFechaInicial,
      	dtmFechaFinal:dtmFechaFinal},
      success:function(datos) {
          $("#TotalCotizaciones").val(datos);
      }
  });
}
/* FIN - Funcion Ajax - Total Cotizaciones */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Cotización */
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
      url:'../../datos/ventas/funcion_cotizacion.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,dtmFechaInicial:dtmFechaInicial,
      	dtmFechaFinal:dtmFechaFinal},
      success:function(datos) {
          $("#PaginacionDeCotizacion").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Cotización */
$(document).on('change', '#lista-persona', function(){
  	  var busqueda = document.getElementById("BusquedaCotización").value;
  	  var y = 5;
  	  var x = 0;
  	  var funcion = "MCL";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
  	  if(intIdTipoPersona == 1){
  	  	$(".ListaDNI").hide();
  	  	$(".ListaRUC").show();
  	  	$(".ListaRazonSocial").show();
  	  	$(".ListaApellidoPaterno").hide();
  	  	$(".ListaApellidoMaterno").hide();
  	  	$(".ListaNombres").hide();
  	  } else if(intIdTipoPersona == 2){
  	  	$(".ListaDNI").show();
  	  	$(".ListaRUC").show();
  	  	$(".ListaRazonSocial").hide();
  	  	$(".ListaApellidoPaterno").show();
  	  	$(".ListaApellidoMaterno").show();
  	  	$(".ListaNombres").show();
  	  }
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeCotizaciónsSeleccion").html(datos);
	   	PaginarCotizaciónsSeleccion(x,y,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Cotización*/
$(document).on('keyup', '#BusquedaCotización', function(){
	  var busqueda = document.getElementById("BusquedaCotización").value;
	  var intIdTipoPersona = document.getElementById("lista-persona").value;
  	  var y = 5;
  	  var x = 0;
  	  var funcion = "MCL";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeCotizaciónsSeleccion").html(datos);
	   	PaginarCotizaciónsSeleccion(x,y,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Cotización */
function SeleccionarCotización(seleccion) {
	var intIdCotización = $(seleccion).attr("idscli");
	var funcion = "SCL";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{intIdCotización:intIdCotización,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#intIdCotización").val(datos.intIdCotización);
	   	$("#nvchRUC").val(datos.nvchRUC);
	   	$("#nvchDNI").val(datos.nvchDNI);
	   	$("#nvchRazonSocial").val(datos.nvchRazonSocial);
	   	$("#nvchApellidoPaterno").val(datos.nvchApellidoPaterno);
	   	$("#nvchApellidoMaterno").val(datos.nvchApellidoMaterno);
	   	$("#nvchNombres").val(datos.nvchNombres);
	   	$("#TipoCotización").val(datos.TipoCotización);
	   	$("#intIdTipoCotización").val(datos.intIdTipoCotización);
	   	MostrarSeleccionCotización(datos.intIdTipoPersona);
	   }
	  });
}
/* FIN - Seleccion del Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Cotización */
function MostrarSeleccionCotización(intIdTipoPersona) {
	  AccionSeleccionCotizacións('M');
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
/* FIN - Seleccion del Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
function AccionSeleccionCotizacións(funcion) {
	  if(funcion == 'S'){
	  	$("#TablaDeCotizacións").show();
      	$("#DatosDelCotización").hide();
	  } else if(funcion == 'M'){
	  	$("#TablaDeCotizacións").hide();
      	$("#DatosDelCotización").show();
	  }
}
/* FIN - Seleccion del Cotización */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Cotizacións para la Selección */
function PaginacionCotizacións(seleccion) {
	var busqueda = document.getElementById("BusquedaCotización").value;
	var y = 5;
	var x = $(seleccion).attr("idcli") * y;
	var funcion = "MCL";
	var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeCotizaciónsSeleccion").html(datos);
	   	PaginarCotizaciónsSeleccion((x/y),y,intIdTipoPersona);
	   }
	  });
}
/* FIN - Paginar Cotizacións para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Cotizacións para la Selección */
function PaginarCotizaciónsSeleccion(x,y,intIdTipoPersona) {
	var busqueda = document.getElementById("BusquedaCotización").value;
	var funcion = "PCL";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#PaginacionDeCotizacións").html(datos);
	   }
	  });
}
/* FIN - Paginar Cotizacións para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Cotizacións para la Selección */
function ListarCotizaciónsSeleccion(x,y,intIdTipoPersona) {
	var busqueda = document.getElementById("BusquedaCotización").value;
	var funcion = "MCL";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeCotizaciónsSeleccion").html(datos);
	   }
	  });
}
/* FIN - Listar Cotizacións para la Selección */
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
/* INICIO - Ocultar Botones */
function MostrarTipoVenta() {
	var intIdTipoVenta = $("#tipo-venta").val();
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