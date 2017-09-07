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
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y},
	   success:function(datos)
	   {
	   	$("#ListaDeClientesSeleccion").html(datos);
	   	PaginarClientesSeleccion((x/y),y);
	   }
	  });
}
/* FIN - Paginar Clientes para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Clientes para la Selección */
function PaginacionProductos(seleccion) {
	var busqueda = document.getElementById("BusquedaProducto").value;
	var y = 5;
	var x = $(seleccion).attr("idprt") * y;
	var funcion = "MPT";
	var tipofuncion = document.getElementById("tipofuncion").value;
	var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,tipofuncion:tipofuncion,TipoBusqueda:TipoBusqueda},
	   success:function(datos)
	   {
	   	$("#ListaDeProductosSeleccion").html(datos);
	   	PaginarProductosSeleccion((x/y),y);
	   }
	  });
}
/* FIN - Paginar Clientes para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Clientes para la Selección */
function PaginarClientesSeleccion(x,y) {
	var busqueda = document.getElementById("BusquedaCliente").value;
	var funcion = "PCL";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y},
	   success:function(datos)
	   {
	   	$("#PaginacionDeClientes").html(datos);
	   }
	  });
}
/* FIN - Paginar Clientes para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Clientes para la Selección */
function PaginarProductosSeleccion(x,y) {
	var busqueda = document.getElementById("BusquedaProducto").value;
	var funcion = "PPT";
	var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,TipoBusqueda:TipoBusqueda},
	   success:function(datos)
	   {
	   	$("#PaginacionDeProductos").html(datos);
	   }
	  });
}
/* FIN - Paginar Clientes para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Clientes para la Selección */
function ListarClientesSeleccion(x,y) {
	var busqueda = document.getElementById("BusquedaCliente").value;
	var funcion = "MCL";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y},
	   success:function(datos)
	   {
	   	$("#ListaDeClientesSeleccion").html(datos);
	   }
	  });
}
/* FIN - Listar Clientes para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Productos para la Selección */
function ListarProductosSeleccion(x,y,tipofuncion) {
	var busqueda = document.getElementById("BusquedaProducto").value;
	var funcion = "MPT";
	var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,tipofuncion:tipofuncion,TipoBusqueda:TipoBusqueda},
	   success:function(datos)
	   {
	   	$("#ListaDeProductosSeleccion").html(datos);
	   }
	  });
}
/* FIN - Listar Productos para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Insertar Comunicacion Nueva */
function AgregarDetalleCotizacion_II(seleccion) {
	var intIdCotizacion = document.getElementById("intIdCotizacion").value;
	var intIdProducto = $(seleccion).attr("idsprt");
	var dcmPrecio = $("input[type=text][name='SdcmPrecio["+intIdProducto+"]']").val();
	var intCantidad = $("input[type=text][name='SintCantidad["+intIdProducto+"]']").val();
	var tipolistado = "I";
	var funcion = "IDV";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{intIdCotizacion:intIdCotizacion,
	   		intIdProducto:intIdProducto,
	   		intCantidad:intCantidad,
	   		dcmPrecio:dcmPrecio,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		alert("Se insertó correctamente la comunicación");
	   		MostrarDetalleCotizacion(intIdCotizacion,tipolistado);
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Insertar Comunicacion Nueva */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Detalle Orden Compra Seleccionado */
function MostrarDetalleCotizacion(intIdCotizacion,tipolistado) {
	var funcion = "MDCT";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{intIdCotizacion:intIdCotizacion,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeProductosComprar").html(datos);
	   }
	  });
}

/* FIN - Mostrar Detalle Orden Compra Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Actualizar Comunicacion Seleccionado */
function ActualizarDetalleCotizacion() {
	var intIdOperacionVenta = document.getElementById("intIdOperacionVenta").value;
	var intIdCotizacion = document.getElementById("intIdCotizacion").value;
	var intIdProducto = document.getElementById("intIdProducto").value;
	var intCantidad = document.getElementById("intCantidad").value;
	var dcmPrecio = document.getElementById("dcmPrecio").value;
	var tipolistado = "A";
	var accion = "C";
	var funcion = "ADCT";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{intIdOperacionVenta:intIdOperacionVenta,
	   		intIdCotizacion:intIdCotizacion,
	   		intIdProducto:intIdProducto,
	   		intCantidad:intCantidad,
	   		dcmPrecio:dcmPrecio,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		alert("Se modificó correctamente el Detalle de Orden de Compra");
	   		MostrarDetalleCotizacion(intIdCotizacion,tipolistado);
	   		CamposDetalleCotizacion(accion);
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Actualizar Comunicacion Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Domicilio Seleccionado */
function SeleccionarDetalleCotizacion(seleccion) {
	var intIdOperacionVenta = $(seleccion).attr("idov");
	var funcion = "SDCT";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{intIdOperacionVenta:intIdOperacionVenta,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#intIdOperacionVenta").val(datos.intIdOperacionVenta);
	   	$("#intIdProducto").val(datos.intIdProducto);
	   	$("#nvchDescripcion").val(datos.nvchDescripcion);
	   	$("#dcmPrecio").val(datos.dcmPrecio);
	   	$("#intCantidad").val(datos.intCantidad);
	   	CamposDetalleCotizacion('I');
	   }
	  });
}
/* FIN - Mostrar Domicilio Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Comunicacion Seleccionado */
function EliminarDetalleCotizacion(seleccion) {
	var intIdOperacionVenta = $(seleccion).attr("idov");
	var intIdCotizacion = document.getElementById("intIdCotizacion").value;
	var funcion = "EDCT";
	var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{intIdOperacionVenta:intIdOperacionVenta,funcion:funcion},
	   success:function(datos)
	   {
	   	 if(datos=="ok"){
	   	 	alert("Se eliminó correctamente el Domicilio Seleccionado");
	   	 	MostrarDetalleCotizacion(intIdCotizacion,tipolistado);
	   	 }
	   }
	  });
}
/* FIN - Eliminar Comunicacion Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Cliente*/
$(document).on('keyup', '#BusquedaProducto', function(){
	  var busqueda = document.getElementById("BusquedaProducto").value;
  	  var y = 5;
  	  var x = 0;
  	  var funcion = "MPT";
  	  var tipofuncion = document.getElementById("tipofuncion").value;
  	  var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipofuncion:tipofuncion,TipoBusqueda:TipoBusqueda},
	   success:function(datos)
	   {
	   	$("#ListaDeProductosSeleccion").html(datos);
	   	PaginarProductosSeleccion((x/y),y);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Cliente*/
$(document).on('change', '#tipo-busqueda', function(){
	  var busqueda = document.getElementById("BusquedaProducto").value;
  	  var y = 5;
  	  var x = 0;
  	  var funcion = "MPT";
  	  var tipofuncion = document.getElementById("tipofuncion").value;
  	  var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipofuncion:tipofuncion,TipoBusqueda:TipoBusqueda},
	   success:function(datos)
	   {
	   	$("#ListaDeProductosSeleccion").html(datos);
	   	PaginarProductosSeleccion((x/y),y);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Domicilios según Ingresa */
function SeleccionarProducto(seleccion) {
	var intIdProducto = $(seleccion).attr("idsprt");
	var nvchDescripcion = $("input[type=hidden][name='SnvchDescripcion["+intIdProducto+"]']").val();
	var dcmPrecio = $("input[type=text][name='SdcmPrecio["+intIdProducto+"]']").val();
	var intCantidad = $("input[type=text][name='SintCantidad["+intIdProducto+"]']").val();

	$('#ListaDeProductosComprar').append('<tr>'+
		'<td>'+'<input type="hidden" name="intIdProducto[]" value="'+intIdProducto+'"/>'+intIdProducto+'</td>'+
		'<td>'+nvchDescripcion+'</td>'+
		'<td>'+'<input type="hidden" name="dcmPrecio[]" value="'+dcmPrecio+'"/>'+dcmPrecio+'</td>'+
		'<td>'+'<input type="hidden" name="intCantidad[]" value="'+intCantidad+'"/>'+intCantidad+'</td>'+
		'<td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>'+
		'</tr>');
}
/* FIN - Listar Domicilios según Ingresa */
////////////////////////////////////////////////////////////// 

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Fila Seleccionada */
function EliminarFila(btn) {
	var fila = btn.parentNode.parentNode;
  	fila.parentNode.removeChild(fila);
}
/* FIN - Eliminar Fila Seleccionada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Campos */
function CamposDetalleCotizacion(accion) {
	if(accion == "I"){
		$("#CamposDetalleCotizacion").show();
	} else if (accion == "C") {
		$("#CamposDetalleCotizacion").hide();
	}
}
/* FIN - Ocultar Campos */
//////////////////////////////////////////////////////////////