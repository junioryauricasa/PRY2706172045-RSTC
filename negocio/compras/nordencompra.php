<script>
//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Proveedor */
$(document).on('click', '#btn-form-crear-ordencompra', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
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
/* FIN - Funcion Ajax - Visualizar Formulario Crear Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Proveedor */
$(document).on('click', '#btn-crear-ordencompra', function(){
	  var num_filas_detalle_cotizacion = document.getElementById('ListaDeProductosComprar').rows.length;
	  if(EsVacio("nvchRazonSocial") == false){
	  	goToBox("#nvchRazonSocial");
	  	return false;
	  } else if(num_filas_detalle_cotizacion == 0){
	  	MensajeNormal("Ingresar por lo menos elegir un Producto",2);
	  	return false;
	  }
	  var formData = $("#form-ordencompra").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/compras/funcion_ordencompra.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okok") {
	   		MensajeNormal("Se agregó correctamente la cotización",1);
	   		$("#btn-form-ordencompra-remove").click();
	   		$('#txt-busqueda').val("");
	   		ListarOrdenCompra(x,y,tipolistado);
	   		PaginarOrdenCompra(x,y,tipolistado);
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Proveedor */
$(document).on('click', '.btn-mostrar-ordencompra', function(){
  	  var intIdOrdenCompra = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{intIdOrdenCompra:intIdOrdenCompra,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	goToBox("#Formulario");
	   	MostrarDetalleOrdenCompra(intIdOrdenCompra,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Proveedor */
$(document).on('click', '#btn-editar-ordencompra', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-ordencompra").serialize();
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente el Orden de Compra",1);
	   		$("#btn-form-cotizacion-remove").click();
	   		ListarOrdenCompra(x,y,tipolistado);
	   		PaginarOrdenCompra(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Actualizar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Eliminar Proveedor */
$(document).on('click', '.btn-eliminar-ordencompra', function(){
  	  var intIdOrdenCompra = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{intIdOrdenCompra:intIdOrdenCompra,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") { 
	   		MensajeNormal("Se anuló correctamente el Orden de Compra",1);
	   		ListarOrdenCompra(x,y,tipolistado);
	   		PaginarOrdenCompra(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Orden de Compra r */
$(document).on('change', '#num-lista', function(){
  var y = document.getElementById("num-lista").value;
  var x = 0;
  var tipolistado = "T";
  ListarOrdenCompra(x,y,tipolistado);
});

$(document).on('click', '.btn-pagina', function(){
  var y = document.getElementById("num-lista").value;
  var x = $(this).attr("idp") * y;
  var funcion = "L";
 ListarOrdenCompra(x,y,tipolistado);
});

$(document).on('keyup', '#txt-busqueda', function(){
  var y = document.getElementById("num-lista").value;
  var x = 0;
  var funcion = "L";
  ListarOrdenCompra(x,y,tipolistado);
});

$(document).on('change', '#lista-tipo-moneda', function(){
  var y = document.getElementById("num-lista").value;
  var x = $(".marca").attr("idp") * y;
  var tipolistado = "T";
  ListarOrdenCompra(x,y,tipolistado);
});

$(document).on('click', '#btnBuscar', function(){
  var y = document.getElementById("num-lista").value;
  var x = 0;
  var tipolistado = "T";
  ListarOrdenCompra(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Orden de Compra */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Proveedor */
function ListarOrdenCompra(x,y,tipolistado) {
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
      url:'../../datos/compras/funcion_ordencompra.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,dtmFechaInicial:dtmFechaInicial,
      	dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda},
      success:function(datos) {
          $("#ListaDeOrdenCompra").html(datos);
          PaginarOrdenCompra((x/y),y,tipolistado);
          TotalOrdenCompra();
      }
  });
}
/* FIN - Funcion Ajax - Listar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Proveedor */
function TotalOrdenCompra() {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "TOC";
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
      url:'../../datos/compras/funcion_ordencompra.php',
      method:"POST",
      data:{busqueda:busqueda,funcion:funcion,dtmFechaInicial:dtmFechaInicial,
      	dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda},
      success:function(datos) {
          $("#TotalOrdenCompra").val(datos);
      }
  });
}
/* FIN - Funcion Ajax - Listar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Proveedor */
function PaginarOrdenCompra(x,y,tipolistado) {
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
      url:'../../datos/compras/funcion_ordencompra.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,dtmFechaInicial:dtmFechaInicial,
      	dtmFechaFinal:dtmFechaFinal},
      success:function(datos) {
          $("#PaginacionDeOrdenCompra").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Cliente */
$(document).on('change', '#lista-persona', function(){
  	  var busqueda = document.getElementById("BusquedaProveedor").value;
  	  var y = 5;
  	  var x = 0;
  	  var funcion = "MPD";
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
	   	$("#ListaDeProveedoresSeleccion").html(datos);
	   	PaginarProveedoresSeleccion(x,y,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Proveedor*/
$(document).on('keyup', '#BusquedaProveedor', function(){
	  var busqueda = document.getElementById("BusquedaProveedor").value;
	  var intIdTipoPersona = document.getElementById("lista-persona").value;
  	  var y = 5;
  	  var x = 0;
  	  var funcion = "MPD";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeProveedoresSeleccion").html(datos);
	   	PaginarProveedoresSeleccion(x,y,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Proveedor */
function SeleccionarProveedor(seleccion) {
	var intIdProveedor = $(seleccion).attr("idsprd");
	var funcion = "SPD";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{intIdProveedor:intIdProveedor,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#intIdProveedor").val(datos.intIdProveedor);
	   	$("#nvchRUC").val(datos.nvchRUC);
	   	$("#nvchDNI").val(datos.nvchDNI);
	   	$("#nvchRazonSocial").val(datos.nvchRazonSocial);
	   	$("#nvchApellidoPaterno").val(datos.nvchApellidoPaterno);
	   	$("#nvchApellidoMaterno").val(datos.nvchApellidoMaterno);
	   	$("#nvchNombres").val(datos.nvchNombres);
	   	MostrarSeleccionProveedor(datos.intIdTipoPersona);
	   }
	  });
}
/* FIN - Seleccion del Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Proveedor */
function MostrarSeleccionProveedor(intIdTipoPersona) {
	  AccionSeleccionProveedores('M');
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
/* FIN - Seleccion del Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
function AccionSeleccionProveedores(funcion) {
	  if(funcion == 'S'){
	  	$("#TablaDeProveedores").show();
      	$("#DatosDelProveedor").hide();
	  } else if(funcion == 'M'){
	  	$("#TablaDeProveedores").hide();
      	$("#DatosDelProveedor").show();
	  }
}
/* FIN - Seleccion del Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Proveedores para la Selección */
function PaginacionProveedores(seleccion) {
	var busqueda = document.getElementById("BusquedaProveedor").value;
	var y = 5;
	var x = $(seleccion).attr("idprd") * y;
	var funcion = "MPD";
	var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeProveedoresSeleccion").html(datos);
	   	PaginarProveedoresSeleccion((x/y),y,intIdTipoPersona);
	   }
	  });
}
/* FIN - Paginar Proveedores para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Proveedores para la Selección */
function PaginarProveedoresSeleccion(x,y,intIdTipoPersona) {
	var busqueda = document.getElementById("BusquedaProveedor").value;
	var funcion = "PPD";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#PaginacionDeProveedores").html(datos);
	   }
	  });
}
/* FIN - Paginar Proveedores para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Proveedores para la Selección */
function ListarProveedoresSeleccion(x,y,intIdTipoPersona) {
	var busqueda = document.getElementById("BusquedaProveedor").value;
	var funcion = "MPD";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeProveedoresSeleccion").html(datos);
	   }
	  });
}
/* FIN - Listar Proveedores para la Selección */
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
</script>