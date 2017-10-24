//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Cliente */
$(document).on('click', '#btn-form-crear-salida', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/inventario/funcion_salida.php",
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
$(document).on('click', '#btn-crear-salida', function(){
	var intIdTipoSalida = $("#tipo-salida").val();
	var formData = $("#form-salida").serialize();
	var funcion = "I";
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/inventario/funcion_salida.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okokokok") {
	   		MensajeNormal("Se generó correctamente la Salida de Productos",1);
	   		$("#btn-form-salida-remove").click();
	   		$('#txt-busqueda').val("");
	   		ListarSalida(x,y,tipolistado);
	   		PaginarSalida(x,y,tipolistado);
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
$(document).on('click', '.btn-mostrar-salida', function(){
  	  var intIdSalida = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/inventario/funcion_salida.php",
	   method:"POST",
	   data:{intIdSalida:intIdSalida,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	goToBox("#Formulario");
	   	MostrarDetalleSalida(intIdSalida,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Cliente */
$(document).on('click', '.btn-download-report', function(){
  	  var intIdSalida = $(this).attr("id");
  	  //var funcion = "OCR";
	  $.ajax({
	   url:"../../view/reporte/reportes_internos/consultaSQL4Report.php",
	   method:"POST",
	   data:{intIdSalida:intIdSalida},
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
$(document).on('click', '#btn-editar-salida', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-salida").serialize();
  	  var intIdTipoComprobante = document.getElementById("tipo-comprobante").value;
	  $.ajax({
	   url:"../../datos/inventario/funcion_salida.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente la Salida de Productos",1);
	   		$("#lista-comprobante").val($("#tipo-comprobante").val());
	   		$("#btn-form-salida-remove").click();
	   		ListarSalida(x,y,tipolistado);
	   		PaginarSalida(x,y,tipolistado);
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
$(document).on('click', '.btn-eliminar-salida', function(){
  	  var intIdSalida = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/inventario/funcion_salida.php",
	   method:"POST",
	   data:{intIdSalida:intIdSalida,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se anuló correctamente la Salida",1);
	   		ListarSalida(x,y,tipolistado);
	   		PaginarSalida((x/y),y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Salida Realizada */
$(document).on('change', '#num-lista', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarSalida(x,y,tipolistado);
});

$(document).on('keyup', '#txt-busqueda', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarSalida(x,y,tipolistado);
});

$(document).on('click', '.btn-pagina', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(this).attr("idp") * y;
  	var tipolistado = "T";
  	ListarSalida(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Salida Realizada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Cliente */
function ListarSalida(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  $.ajax({
      url:'../../datos/inventario/funcion_salida.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#ListaDeSalidas").html(datos);
          PaginarSalida((x/y),y,tipolistado);
      }
  });
}
/* FIN - Funcion Ajax - Listar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Cliente */
function PaginarSalida(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  $.ajax({
      url:'../../datos/inventario/funcion_salida.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#PaginacionDeSalida").html(datos);
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
	   url:"../../datos/inventario/funcion_salida.php",
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
	   url:"../../datos/inventario/funcion_salida.php",
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
$(document).on('change', '#lugar-salida', function(){
	var y = 5;
	var x = $(".pa-producto").attr("idprt") * y;
	ListarProductosSeleccion(x,y);
});
/* FIN - Funcion Ajax - Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Cliente */
function MostrarSeleccionComprobante() {
	  var intIdSucursal = $("#lugar-salida").val();
	  var funcion = "NCPR";
	  $.ajax({
	   url:"../../datos/inventario/funcion_salida.php",
	   method:"POST",
	   data:{funcion:funcion,intIdSucursal:intIdSucursal},
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
/* INICIO - Timer Comprobante */
function TimerComprobante() {
    miVariable = setInterval(MostrarSeleccionComprobante, 500);
}
/* FIN - Timer Comprobante */
//////////////////////////////////////////////////////////////