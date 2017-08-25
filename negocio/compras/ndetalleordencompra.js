//////////////////////////////////////////////////////////////
/* INICIO - Paginar Proveedores para la Selección */

function PaginacionProveedores(seleccion) {
	var busqueda = document.getElementById("BusquedaProveedor").value;
	var y = 5;
	var x = $(seleccion).attr("idprd") * y;
	var funcion = "MPD";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y},
	   success:function(datos)
	   {
	   	$("#ListaDeProveedoresSeleccion").html(datos);
	   	PaginarProveedoresSeleccion((x/y),y);
	   }
	  });
}

/* FIN - Paginar Proveedores para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Proveedores para la Selección */

function PaginacionProductos(seleccion) {
	var busqueda = document.getElementById("BusquedaProducto").value;
	var y = 5;
	var x = $(seleccion).attr("idprt") * y;
	var funcion = "MPT";
	var tipofuncion = document.getElementById("tipofuncion").value;
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,tipofuncion,tipofuncion},
	   success:function(datos)
	   {
	   	$("#ListaDeProductosSeleccion").html(datos);
	   	PaginarProductosSeleccion((x/y),y);
	   }
	  });
}

/* FIN - Paginar Proveedores para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Proveedores para la Selección */

function PaginarProveedoresSeleccion(x,y) {
	var busqueda = document.getElementById("BusquedaProveedor").value;
	var funcion = "PPD";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y},
	   success:function(datos)
	   {
	   	$("#PaginacionDeProveedores").html(datos);
	   }
	  });
}

/* FIN - Paginar Proveedores para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Proveedores para la Selección */

function PaginarProductosSeleccion(x,y) {
	var busqueda = document.getElementById("BusquedaProducto").value;
	var funcion = "PPT";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y},
	   success:function(datos)
	   {
	   	$("#PaginacionDeProductos").html(datos);
	   }
	  });
}

/* FIN - Paginar Proveedores para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Proveedores para la Selección */

function ListarProveedoresSeleccion(x,y) {
	var busqueda = document.getElementById("BusquedaProveedor").value;
	var funcion = "MPD";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y},
	   success:function(datos)
	   {
	   	$("#ListaDeProveedoresSeleccion").html(datos);
	   }
	  });
}

/* FIN - Listar Proveedores para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Productos para la Selección */

function ListarProductosSeleccion(x,y,tipofuncion) {
	var busqueda = document.getElementById("BusquedaProducto").value;
	var funcion = "MPT";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,tipofuncion:tipofuncion},
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

function AgregarDetalleOrdenCompra_II(seleccion) {
	var intIdOrdenCompra = document.getElementById("intIdOrdenCompra").value;
	var intIdProducto = $(seleccion).attr("idsprt");
	var dcmPrecio = $("input[type=text][name='SdcmPrecio["+intIdProducto+"]']").val();
	var intCantidad = $("input[type=text][name='SintCantidad["+intIdProducto+"]']").val();
	var tipolistado = "I";
	var funcion = "IDOC";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{intIdOrdenCompra:intIdOrdenCompra,
	   		intIdProducto:intIdProducto,
	   		intCantidad:intCantidad,
	   		dcmPrecio:dcmPrecio,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		alert("Se insertó correctamente la comunicación");
	   		MostrarDetalleOrdenCompra(intIdOrdenCompra,tipolistado);
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

function MostrarDetalleOrdenCompra(intIdOrdenCompra,tipolistado) {
	var funcion = "MDOC";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{intIdOrdenCompra:intIdOrdenCompra,funcion:funcion,tipolistado:tipolistado},
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

function ActualizarDetalleOrdenCompra() {
	var intIdOperacionOrdenCompra = document.getElementById("intIdOperacionOrdenCompra").value;
	var intIdOrdenCompra = document.getElementById("intIdOrdenCompra").value;
	var intIdProducto = document.getElementById("intIdProducto").value;
	var intCantidad = document.getElementById("intCantidad").value;
	var dcmPrecio = document.getElementById("dcmPrecio").value;
	var tipolistado = "A";
	var accion = "C";
	var funcion = "ADOC";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{intIdOperacionOrdenCompra:intIdOperacionOrdenCompra,
	   		intIdOrdenCompra:intIdOrdenCompra,
	   		intIdProducto:intIdProducto,
	   		intCantidad:intCantidad,
	   		dcmPrecio:dcmPrecio,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		alert("Se modificó correctamente el Detalle de Orden de Compra");
	   		MostrarDetalleOrdenCompra(intIdOrdenCompra,tipolistado);
	   		CamposDetalleOrdenCompra(accion);
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

function SeleccionarDetalleOrdenCompra(seleccion) {
	var intIdOperacionOrdenCompra = $(seleccion).attr("idooc");
	var funcion = "SDOC";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{intIdOperacionOrdenCompra:intIdOperacionOrdenCompra,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#intIdOperacionOrdenCompra").val(datos.intIdOperacionOrdenCompra);
	   	$("#intIdProducto").val(datos.intIdProducto);
	   	$("#nvchNombre").val(datos.nvchNombre);
	   	$("#nvchDescripcion").val(datos.nvchDescripcion);
	   	$("#dcmPrecio").val(datos.dcmPrecio);
	   	$("#intCantidad").val(datos.intCantidad);
	   	CamposDetalleOrdenCompra('I');
	   }
	  });
}

/* FIN - Mostrar Domicilio Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Comunicacion Seleccionado */

function EliminarDetalleOrdenCompra(seleccion) {
	var intIdOperacionOrdenCompra = $(seleccion).attr("idooc");
	var intIdOrdenCompra = document.getElementById("intIdOrdenCompra").value;
	var funcion = "EDOC";
	var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{intIdOperacionOrdenCompra:intIdOperacionOrdenCompra,funcion:funcion},
	   success:function(datos)
	   {
	   	 if(datos=="ok"){
	   	 	alert("Se eliminó correctamente el Domicilio Seleccionado");
	   	 	MostrarDetalleOrdenCompra(intIdOrdenCompra,tipolistado);
	   	 }
	   }
	  });
}

/* FIN - Eliminar Comunicacion Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Proveedor*/

$(document).on('keyup', '#BusquedaProducto', function(){
	  var busqueda = document.getElementById("BusquedaProducto").value;
  	  var y = 5;
  	  var x = 0;
  	  var funcion = "MPT";
  	  var tipofuncion = document.getElementById("tipofuncion").value;
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipofuncion:tipofuncion},
	   success:function(datos)
	   {
	   	$("#ListaDeProductosSeleccion").html(datos);
	   	PaginarProductosSeleccion((x/y),y);
	   }
	  });
	 return false;
});

/* FIN - Funcion Ajax - Buscar Elemento Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Domicilios según Ingresa */

function SeleccionarProducto(seleccion) {
	var intIdProducto = $(seleccion).attr("idsprt");
	var nvchNombre = $("input[type=hidden][name='SnvchNombre["+intIdProducto+"]']").val();
	var nvchDescripcion = $("input[type=hidden][name='SnvchDescripcion["+intIdProducto+"]']").val();
	var dcmPrecio = $("input[type=text][name='SdcmPrecio["+intIdProducto+"]']").val();
	var intCantidad = $("input[type=text][name='SintCantidad["+intIdProducto+"]']").val();

	$('#ListaDeProductosComprar').append('<tr>'+
		'<td>'+'<input type="hidden" name="intIdProducto[]" value="'+intIdProducto+'"/>'+intIdProducto+'</td>'+
		'<td>'+nvchNombre+'</td>'+
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
function CamposDetalleOrdenCompra(accion) {
	if(accion == "I"){
		$("#CamposDetalleOrdenCompra").show();
	} else if (accion == "C") {
		$("#CamposDetalleOrdenCompra").hide();
	}
}
/* FIN - Ocultar Campos */
//////////////////////////////////////////////////////////////