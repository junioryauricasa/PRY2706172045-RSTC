//////////////////////////////////////////////////////////////
/* INICIO - Paginar Clientes para la Selección */
function PaginacionClientes(seleccion) {
	var busqueda = document.getElementById("BusquedaCliente").value;
	var y = 5;
	var x = $(seleccion).attr("idcli") * y;
	var funcion = "MCL";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
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
	   url:"../../datos/ventas/funcion_venta.php",
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
	   url:"../../datos/ventas/funcion_venta.php",
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
	   url:"../../datos/ventas/funcion_venta.php",
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
	   url:"../../datos/ventas/funcion_venta.php",
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
	   url:"../../datos/ventas/funcion_venta.php",
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
function AgregarDetalleVenta_II(seleccion) {
	var intIdVenta = document.getElementById("intIdVenta").value;
	var intIdProducto = $(seleccion).attr("idsprt");
	var dcmPrecio = $("input[type=text][name='SdcmPrecio["+intIdProducto+"]']").val();
	var intCantidad = $("input[type=text][name='SintCantidad["+intIdProducto+"]']").val();
	var tipolistado = "I";
	var funcion = "IDV";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{intIdVenta:intIdVenta,
	   		intIdProducto:intIdProducto,
	   		intCantidad:intCantidad,
	   		dcmPrecio:dcmPrecio,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		alert("Se insertó correctamente la comunicación");
	   		MostrarDetalleVenta(intIdVenta,tipolistado);
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
function MostrarDetalleVenta(intIdVenta,tipolistado) {
	var funcion = "MDV";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{intIdVenta:intIdVenta,funcion:funcion,tipolistado:tipolistado},
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
function ActualizarDetalleVenta() {
	var intIdOperacionVenta = document.getElementById("intIdOperacionVenta").value;
	var intIdVenta = document.getElementById("intIdVenta").value;
	var intIdProducto = document.getElementById("intIdProducto").value;
	var intCantidad = document.getElementById("intCantidad").value;
	var dcmPrecio = document.getElementById("dcmPrecio").value;
	var tipolistado = "A";
	var accion = "C";
	var funcion = "ADV";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{intIdOperacionVenta:intIdOperacionVenta,
	   		intIdVenta:intIdVenta,
	   		intIdProducto:intIdProducto,
	   		intCantidad:intCantidad,
	   		dcmPrecio:dcmPrecio,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		alert("Se modificó correctamente el Detalle de Orden de Compra");
	   		MostrarDetalleVenta(intIdVenta,tipolistado);
	   		CamposDetalleVenta(accion);
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
function SeleccionarDetalleVenta(seleccion) {
	var intIdOperacionVenta = $(seleccion).attr("idov");
	var funcion = "SDV";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
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
	   	CamposDetalleVenta('I');
	   }
	  });
}
/* FIN - Mostrar Domicilio Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Comunicacion Seleccionado */
function EliminarDetalleVenta(seleccion) {
	var intIdOperacionVenta = $(seleccion).attr("idov");
	var intIdVenta = document.getElementById("intIdVenta").value;
	var funcion = "EDV";
	var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{intIdOperacionVenta:intIdOperacionVenta,funcion:funcion},
	   success:function(datos)
	   {
	   	 if(datos=="ok"){
	   	 	alert("Se eliminó correctamente el Domicilio Seleccionado");
	   	 	MostrarDetalleVenta(intIdVenta,tipolistado);
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
	   url:"../../datos/ventas/funcion_venta.php",
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
	   url:"../../datos/ventas/funcion_venta.php",
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
/* INICIO - Listar Domicilios según Ingresa */
function InsertarCotizacion() {
	var nvchNumeracionCotizacion =  document.getElementById("nvchNumeracionCotizacion").value;
	var funcion = "ICT";
	$.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{nvchNumeracionCotizacion:nvchNumeracionCotizacion,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#ListaDeProductosComprar").append(datos); 
	   }
	  });
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
function CamposDetalleVenta(accion) {
	if(accion == "I"){
		$("#CamposDetalleVenta").show();
	} else if (accion == "C") {
		$("#CamposDetalleVenta").hide();
	}
}
/* FIN - Ocultar Campos */
//////////////////////////////////////////////////////////////