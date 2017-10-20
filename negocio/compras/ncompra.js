//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Cliente */
$(document).on('click', '#btn-form-crear-compra', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/compras/funcion_compra.php",
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
$(document).on('click', '#btn-crear-compra', function(){
	var intIdTipoCompra = $("#tipo-compra").val();
	var formData = $("#form-compra").serialize();
	var funcion = "I";
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "N";
  	var intIdTipoComprobante = document.getElementById("tipo-comprobante").value;
	  $.ajax({
	   url: "../../datos/compras/funcion_compra.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okokokok") {
	   		MensajeNormal("Se generó correctamente la Compra de Productos",1);
	   		$("#btn-form-compra-remove").click();
	   		$("#lista-comprobante").val($("#tipo-comprobante").val());
	   		AccionCabecerasTablaComprobante(intIdTipoComprobante);
	   		$('#txt-busqueda').val("");
	   		ListarCompra(x,y,tipolistado);
	   		PaginarCompra(x,y,tipolistado);
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
$(document).on('click', '.btn-mostrar-compra', function(){
  	  var intIdCompra = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/compras/funcion_compra.php",
	   method:"POST",
	   data:{intIdCompra:intIdCompra,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	goToBox("#Formulario");
	   	$("#tipo-comprobante").val($("#intIdTipoComprobante").val());
	   	MostrarSeleccionComprobante($("#intIdTipoComprobante").val());
	   	MostrarDetalleCompra(intIdCompra,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Cliente */
$(document).on('click', '.btn-download-report', function(){
  	  var intIdCompra = $(this).attr("id");
  	  //var funcion = "OCR";
	  $.ajax({
	   url:"../../view/reporte/reportes_internos/consultaSQL4Report.php",
	   method:"POST",
	   data:{intIdCompra:intIdCompra},
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
$(document).on('click', '#btn-editar-compra', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-compra").serialize();
  	  var intIdTipoComprobante = document.getElementById("tipo-comprobante").value;
	  $.ajax({
	   url:"../../datos/compras/funcion_compra.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente la Compra de Productos",1);
	   		$("#lista-comprobante").val($("#tipo-comprobante").val());
	   		AccionCabecerasTablaComprobante(intIdTipoComprobante);
	   		$("#btn-form-compra-remove").click();
	   		ListarCompra(x,y,tipolistado);
	   		PaginarCompra(x,y,tipolistado);
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
$(document).on('click', '.btn-eliminar-compra', function(){
  	  var intIdCompra = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/compras/funcion_compra.php",
	   method:"POST",
	   data:{intIdCompra:intIdCompra,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se anuló correctamente la Compra",1);
	   		ListarCompra(x,y,tipolistado);
	   		PaginarCompra((x/y),y,tipolistado);
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
	if(intIdTipoComprobante == "5"){
		$(".listaNumFactura").show();
  	  	$(".listaNumBoletaVenta").hide();
  	  	$(".listaNumNotaCredito").hide();
  	  	$(".listaNumGuiaRemision").hide();
	} else if (intIdTipoComprobante == "6") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").show();
  	  	$(".listaNumNotaCredito").hide();
  	  	$(".listaNumGuiaRemision").hide();
	} else if (intIdTipoComprobante == "7") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").hide();
  	  	$(".listaNumNotaCredito").hide();
  	  	$(".listaNumGuiaRemision").show();
	} else if (intIdTipoComprobante == "8") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").hide();
  	  	$(".listaNumNotaCredito").show();
  	  	$(".listaNumGuiaRemision").hide();
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function AccionNumeracion(intIdTipoComprobante) {
	if(intIdTipoComprobante == "5"){
		$("#SerieNumeracionCE").show();
  	  	$("#SerieNumeracionGIE").hide();
	} else if (intIdTipoComprobante == "6") {
		$("#SerieNumeracionCE").show();
  	  	$("#SerieNumeracionGIE").hide();
	} else if (intIdTipoComprobante == "7") {
		$("#SerieNumeracionCE").show();
  	  	$("#SerieNumeracionGIE").hide();
	} else if (intIdTipoComprobante == "8") {
		$("#SerieNumeracionCE").show();
  	  	$("#SerieNumeracionGIE").hide();
	} else if (intIdTipoComprobante == "9") {
		$("#SerieNumeracionCE").hide();
  	  	$("#SerieNumeracionGIE").show();
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Compra Realizada */
$(document).on('change', '#lista-comprobante', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  	AccionCabecerasTablaComprobante(intIdTipoComprobante)
  	ListarCompra(x,y,tipolistado);
});

$(document).on('change', '#num-lista', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarCompra(x,y,tipolistado);
});

$(document).on('keyup', '#txt-busqueda', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarCompra(x,y,tipolistado);
});

$(document).on('click', '.btn-pagina', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(this).attr("idp") * y;
  	var tipolistado = "T";
  	ListarCompra(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Compra Realizada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Cliente */
function ListarCompra(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  $.ajax({
      url:'../../datos/compras/funcion_compra.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdTipoComprobante:intIdTipoComprobante},
      success:function(datos) {
          $("#ListaDeCompras").html(datos);
          PaginarCompra((x/y),y,tipolistado);
      }
  });
}
/* FIN - Funcion Ajax - Listar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Cliente */
function PaginarCompra(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  $.ajax({
      url:'../../datos/compras/funcion_compra.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdTipoComprobante:intIdTipoComprobante},
      success:function(datos) {
          $("#PaginacionDeCompra").html(datos);
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
/* INICIO - Listar Clientes para la Selección */
function ListarClientesSeleccion(x,y) {
	var busqueda = document.getElementById("BusquedaCliente").value;
	var funcion = "MCL";
	var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/compras/funcion_compra.php",
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
	   url:"../../datos/compras/funcion_compra.php",
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
/* INICIO - Funcion Ajax - Comprobante */
$(document).on('change', '#lugar-compra', function(){
	var y = 5;
	var x = $(".pa-producto").attr("idprt") * y;
	ListarProductosSeleccion(x,y);
});
/* FIN - Funcion Ajax - Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Cliente */
function MostrarSeleccionComprobante() {
	var intIdTipoComprobante = $("#tipo-comprobante").val();
	AccionNumeracion(intIdTipoComprobante);
	if(intIdTipoComprobante == 9){
	  var intIdTipoComprobante = $("#tipo-comprobante").val();
	  var intIdSucursal = $("#lugar-compra").val();
	  var funcion = "NCPR";
	  $.ajax({
	   url:"../../datos/compras/funcion_compra.php",
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
}
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Timer Comprobante */
function TimerComprobante() {
    miVariable = setInterval(MostrarSeleccionComprobante, 500);
}
/* FIN - Timer Comprobante */
//////////////////////////////////////////////////////////////