//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Cliente */
$(document).on('click', '#btn-form-crear-entrada', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
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
$(document).on('click', '#btn-crear-entrada', function(){
	var intIdTipoEntrada = $("#tipo-entrada").val();
	var formData = $("#form-entrada").serialize();
	var funcion = "I";
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "N";
  	var intIdTipoComprobante = document.getElementById("tipo-comprobante").value;
	  $.ajax({
	   url: "../../datos/inventario/funcion_entrada.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okokokok") {
	   		MensajeNormal("Se generó correctamente la Entrada de Productos",1);
	   		$("#btn-form-entrada-remove").click();
	   		$("#lista-comprobante").val($("#tipo-comprobante").val());
	   		AccionCabecerasTablaComprobante(intIdTipoComprobante);
	   		$('#txt-busqueda').val("");
	   		ListarEntrada(x,y,tipolistado);
	   		PaginarEntrada(x,y,tipolistado);
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
$(document).on('click', '.btn-mostrar-entrada', function(){
  	  var intIdEntrada = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{intIdEntrada:intIdEntrada,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	goToBox("#Formulario");
	   	$("#tipo-comprobante").val($("#intIdTipoComprobante").val());
	   	MostrarSeleccionComprobante($("#intIdTipoComprobante").val());
	   	MostrarDetalleEntrada(intIdEntrada,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Cliente */
$(document).on('click', '.btn-download-report', function(){
  	  var intIdEntrada = $(this).attr("id");
  	  //var funcion = "OCR";
	  $.ajax({
	   url:"../../view/reporte/reportes_internos/consultaSQL4Report.php",
	   method:"POST",
	   data:{intIdEntrada:intIdEntrada},
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
$(document).on('click', '#btn-editar-entrada', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-entrada").serialize();
  	  var intIdTipoComprobante = document.getElementById("tipo-comprobante").value;
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente la Entrada de Productos",1);
	   		$("#lista-comprobante").val($("#tipo-comprobante").val());
	   		AccionCabecerasTablaComprobante(intIdTipoComprobante);
	   		$("#btn-form-entrada-remove").click();
	   		ListarEntrada(x,y,tipolistado);
	   		PaginarEntrada(x,y,tipolistado);
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
$(document).on('click', '.btn-eliminar-entrada', function(){
  	  var intIdEntrada = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{intIdEntrada:intIdEntrada,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se anuló correctamente la Entrada",1);
	   		ListarEntrada(x,y,tipolistado);
	   		PaginarEntrada((x/y),y,tipolistado);
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
  	  	$(".listaNumGuiaInternaEntrada").hide();
	} else if (intIdTipoComprobante == "6") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").show();
  	  	$(".listaNumNotaCredito").hide();
  	  	$(".listaNumGuiaRemision").hide();
  	  	$(".listaNumGuiaInternaEntrada").hide();
	} else if (intIdTipoComprobante == "7") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").hide();
  	  	$(".listaNumNotaCredito").hide();
  	  	$(".listaNumGuiaRemision").show();
  	  	$(".listaNumGuiaInternaEntrada").hide();
	} else if (intIdTipoComprobante == "8") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").hide();
  	  	$(".listaNumNotaCredito").show();
  	  	$(".listaNumGuiaRemision").hide();
  	  	$(".listaNumGuiaInternaEntrada").hide();
	} else if (intIdTipoComprobante == "9") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").hide();
  	  	$(".listaNumNotaCredito").hide();
  	  	$(".listaNumGuiaRemision").hide();
  	  	$(".listaNumGuiaInternaEntrada").show();
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
/* INICIO - Funcion Ajax - Buscar Entrada Realizada */
$(document).on('change', '#lista-comprobante', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  	AccionCabecerasTablaComprobante(intIdTipoComprobante)
  	ListarEntrada(x,y,tipolistado);
});

$(document).on('change', '#num-lista', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarEntrada(x,y,tipolistado);
});

$(document).on('keyup', '#txt-busqueda', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarEntrada(x,y,tipolistado);
});

$(document).on('click', '.btn-pagina', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(this).attr("idp") * y;
  	var tipolistado = "T";
  	ListarEntrada(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Entrada Realizada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Cliente */
function ListarEntrada(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  $.ajax({
      url:'../../datos/inventario/funcion_entrada.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdTipoComprobante:intIdTipoComprobante},
      success:function(datos) {
          $("#ListaDeEntradas").html(datos);
          PaginarEntrada((x/y),y,tipolistado);
      }
  });
}
/* FIN - Funcion Ajax - Listar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Cliente */
function PaginarEntrada(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  $.ajax({
      url:'../../datos/inventario/funcion_entrada.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdTipoComprobante:intIdTipoComprobante},
      success:function(datos) {
          $("#PaginacionDeEntrada").html(datos);
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
	   url:"../../datos/inventario/funcion_entrada.php",
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
	   url:"../../datos/inventario/funcion_entrada.php",
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
$(document).on('change', '#lugar-entrada', function(){
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
	  var intIdSucursal = $("#lugar-entrada").val();
	  var funcion = "NCPR";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
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