//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Cliente */
$(document).on('click', '#btn-form-crear-cotizacion', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:'POST',
	   data:{funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Visualizar Formulario Crear Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Cliente */
$(document).on('click', '#btn-crear-cotizacion', function(){
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
	   		$("#resultadocrud").html("<script>alert('Se Agregó correctamente')</script>");
	   		$('#txt-busqueda').val("");
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
/* INICIO - Funcion Ajax - Mostrar Cliente */
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
	   	MostrarDetalleCotizacion(intIdCotizacion,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Cliente */
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
/* FIN - Funcion Ajax - Mostrar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Cliente */
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
	   		$("#resultadocrud").html("<script>alert('Se Actualizó correctamente')</script>");
	   		ListarCotizacion(x,y,tipolistado);
	   		PaginarCotizacion(x,y,tipolistado);
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
  	  var intIdCotizacion = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
  	  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{intIdCotizacion:intIdCotizacion,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		$("#resultadocrud").html("<script>alert('Se Eliminó correctamente')</script>");
	   		ListarCotizacion(x,y,tipolistado);
	   		PaginarCotizacion(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Cliente */
function ListarCotizacion(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  $.ajax({
      url:'../../datos/ventas/funcion_cotizacion.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#ListaDeCotizaciones").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Listar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Cliente */
$(document).on('change', '#num-lista', function(){
  	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var funcion = "L";
  	  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeCotizaciones").html(datos);
	   	PaginarCotizacion(x,y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Cliente */
function PaginarCotizacion(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  $.ajax({
      url:'../../datos/ventas/funcion_cotizacion.php',
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
/* INICIO - Funcion Ajax - Cambiar Página de Lista Cliente */
$(document).on('click', '.btn-pagina', function(){
      var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(this).attr("idp") * y;
  	  var funcion = "L";
  	  var tipolistado = "T";
  	  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeCotizaciones").html(datos);
	   	PaginarCotizacion((x/y),y,tipolistado,intIdTipoComprobante);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Página de Lista Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Cliente II */
$(document).on('keyup', '#txt-busqueda', function(){
	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var funcion = "L";
  	  var tipolistado = "T";
  	  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeCotizaciones").html(datos);
	   	PaginarCotizacion(x,y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Cliente II */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Cliente */
$(document).on('change', '#lista-persona', function(){
  	  var busqueda = document.getElementById("BusquedaCliente").value;
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
	   	$("#ListaDeClientesSeleccion").html(datos);
	   	PaginarClientesSeleccion(x,y,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Cliente*/
$(document).on('keyup', '#BusquedaCliente', function(){
	  var busqueda = document.getElementById("BusquedaCliente").value;
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
	   	$("#ListaDeClientesSeleccion").html(datos);
	   	PaginarClientesSeleccion(x,y,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Cliente */
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
	   	$("#intIdCliente").val(datos.intIdCliente);
	   	$("#nvchRUC").val(datos.nvchRUC);
	   	$("#nvchDNI").val(datos.nvchDNI);
	   	$("#nvchRazonSocial").val(datos.nvchRazonSocial);
	   	$("#nvchApellidoPaterno").val(datos.nvchApellidoPaterno);
	   	$("#nvchApellidoMaterno").val(datos.nvchApellidoMaterno);
	   	$("#nvchNombres").val(datos.nvchNombres);
	   	MostrarSeleccionCliente(datos.intIdTipoPersona);
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
/* INICIO - Paginar Clientes para la Selección */
function PaginacionClientes(seleccion) {
	var busqueda = document.getElementById("BusquedaCliente").value;
	var y = 5;
	var x = $(seleccion).attr("idcli") * y;
	var funcion = "MCL";
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
/* FIN - Paginar Clientes para la Selección */
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
/* INICIO - Listar Clientes para la Selección */
function ListarClientesSeleccion(x,y,intIdTipoPersona) {
	var busqueda = document.getElementById("BusquedaCliente").value;
	var funcion = "MCL";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeClientesSeleccion").html(datos);
	   }
	  });
}
/* FIN - Listar Clientes para la Selección */
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