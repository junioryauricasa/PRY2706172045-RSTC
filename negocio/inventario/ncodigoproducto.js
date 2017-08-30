//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Codigos del Producto Seleccionado */
function MostrarCodigo(intIdProducto,tipolistado) {
	var funcion = "MCP";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeCodigos").html(datos);
	   }
	  });
}
/* FIN - Mostrar Codigos del Producto Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Insertar Codigo Nueva */
function AgregarCodigo_II() {
	var intIdProducto = document.getElementById("intIdProducto").value;
	var nvchCodigo = document.getElementById("nvchCodigo").value;
	var intIdTipoCodigoProducto = document.getElementById("tipo-codigo-producto").value;
	var tipolistado = "I";
	var funcion = "ICP";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,
	   		nvchCodigo:nvchCodigo,
	   		intIdTipoCodigoProducto:intIdTipoCodigoProducto,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		alert("Se insertó correctamente la comunicación");
	   		MostrarCodigo(intIdProducto,tipolistado);
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Insertar Codigo Nueva */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Actualizar Codigo Seleccionado */
function ActualizarCodigo() {
	var intIdCodigoProducto = document.getElementById("intIdCodigoProducto").value;
	var intIdProducto = document.getElementById("intIdProducto").value;
	var nvchCodigo = document.getElementById("nvchCodigo").value;
	var dtmFechaInicio = document.getElementById("dtmFechaInicio").value;
	var dtmFechaFinal = document.getElementById("dtmFechaFinal").value;
	var intIdTipoCodigoProducto = document.getElementById("tipo-codigo-producto").value;
	var tipolistado = "A";
	var accion = "I";
	var funcion = "ACP";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdCodigoProducto:intIdCodigoProducto,
	   		intIdProducto:intIdProducto,
	   		nvchCodigo:nvchCodigo,
	   		dtmFechaInicio:dtmFechaInicio,
	   		dtmFechaFinal:dtmFechaFinal,
	   		intIdTipoCodigoProducto:intIdTipoCodigoProducto,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		alert("Se modificó correctamente la comunicación");
	   		MostrarCodigo(intIdProducto,tipolistado);
	   		BotonesCodigo(accion);
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Actualizar Codigo Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Codigo Seleccionado */
function SeleccionarCodigo(seleccion) {
	var intIdCodigoProducto = $(seleccion).attr("idcp");
	var funcion = "SCP";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdCodigoProducto:intIdCodigoProducto,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#intIdCodigoProducto").val(datos.intIdCodigoProducto);
	   	$("#nvchCodigo").val(datos.nvchCodigo);
	   	$("#dtmFechaInicio").val(datos.dtmFechaInicio);
	   	$("#dtmFechaFinal").val(datos.dtmFechaFinal);
	   	$("#tipo-codigo-producto").val(datos.intIdTipoCodigoProducto);
	   	BotonesCodigo('A');
	   }
	  });
}
/* FIN - Mostrar Codigo Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Codigo Seleccionado */
function EliminarCodigo(seleccion) {
	var intIdCodigoProducto = $(seleccion).attr("idcp");
	var funcion = "ECP";
	var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdCodigoProducto:intIdCodigoProducto,funcion:funcion},
	   success:function(datos)
	   {
	   	 if(datos=="ok"){
	   	 	alert("Se eliminó correctamente la Comunicación Seleccionada");
	   	 	MostrarCodigo(intIdProducto,tipolistado);
	   	 }
	   }
	  });
}
/* FIN - Eliminar Codigo Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function BotonesCodigo(accion) {
	if(accion == "I"){
		$("#btn-agregar-codigo").show();
		$("#btn-actualizar-codigo").hide();
		$("#btn-cancelar-codigo").hide();
	} else if (accion == "A") {
		$("#btn-agregar-codigo").hide();
		$("#btn-actualizar-codigo").show();
		$("#btn-cancelar-codigo").show();
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////