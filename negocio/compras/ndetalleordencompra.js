//////////////////////////////////////////////////////////////
/* INICIO - Paginar Proveedores para la Selección */
function PaginacionProductos(seleccion) {
	var busqueda = document.getElementById("BusquedaProducto").value;
	var y = 5;
	var x = $(seleccion).attr("idprt") * y;
	var funcion = "MPT";
	var tipofuncion = document.getElementById("tipofuncion").value;
	var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,tipofuncion,tipofuncion,TipoBusqueda:TipoBusqueda},
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
function PaginarProductosSeleccion(x,y) {
	var busqueda = document.getElementById("BusquedaProducto").value;
	var funcion = "PPT";
	var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,TipoBusqueda:TipoBusqueda},
	   success:function(datos)
	   {
	   	$("#PaginacionDeProductos").html(datos);
	   }
	  });
}
/* FIN - Paginar Proveedores para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Productos para la Selección */
function ListarProductosSeleccion(x,y,tipofuncion) {
	var busqueda = document.getElementById("BusquedaProducto").value;
	var funcion = "MPT";
	var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
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
  	  var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
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
/* FIN - Funcion Ajax - Buscar Elemento Proveedor */
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
	   url:"../../datos/compras/funcion_ordencompra.php",
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
function AgregarProducto(seleccion) {
	if(EsVacio("nvchCodigo") == false){
		return false;
	}
	if(EsVacio("nvchDescripcion") == false){
		return false;
	}
	if(EsNumeroEntero("intCantidad") == false){
		return false;
	}
	if(EsDecimal("dcmPrecio") == false){
		return false;
	}
	
	var nvchCodigo = $("#nvchCodigo").val();
	var nvchDescripcion = $("#nvchCodigo").val();
	var dcmPrecio = $("#dcmPrecio").val();
	var intCantidad = $("#intCantidad").val();
	var Total = Number(dcmPrecio) * Number(intCantidad);

	$('#ListaDeProductosComprar').append('<tr>'+
		'<td>'+'<input type="hidden" name="nvchCodigo[]" value="'+nvchCodigo+'"/>'+nvchCodigo+'</td>'+
		'<td>'+'<input type="hidden" name="nvchDescripcion[]" value="'+nvchDescripcion+'"/>'+nvchDescripcion+'</td>'+
		'<td>'+'<input type="hidden" name="intCantidad[]" value="'+intCantidad+'"/>'+intCantidad+'</td>'+
		'<td>'+'<input type="hidden" name="dcmPrecio[]" value="'+dcmPrecio+'"/>'+dcmPrecio+'</td>'+
		'<td>'+'<input type="hidden" name="dcmTotal[]" value="'+Total+'"/>'+Total+'</td>'+
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
function CalcularTotalOrdenCompra(NombreId) {
	if(NombreId == "dcmPrecioOrdenCompra"){
		if($("#intCantidadOrdenCompra").val() == "" ||
			$("#intCantidadOrdenCompra").val() == null){
			return false;
		}
		else {
			dcmPrecioOrdenCompra = $("#dcmPrecioOrdenCompra").val();
			intCantidadOrdenCompra = $("#intCantidadOrdenCompra").val();
			dcmTotalOrdenCompra = (dcmPrecioOrdenCompra * intCantidadOrdenCompra).toFixed(2);
			$("#dcmTotalOrdenCompra").val(dcmTotalOrdenCompra);
		}
	}
	if(NombreId == "intCantidadOrdenCompra") {
		if($("#dcmPrecioOrdenCompra").val() == "" ||
			$("#dcmPrecioOrdenCompra").val() == null){
			return false;
		}
		else {
			dcmPrecioOrdenCompra = $("#dcmPrecioOrdenCompra").val();
			intCantidadOrdenCompra = $("#intCantidadOrdenCompra").val();
			dcmTotalOrdenCompra = (dcmPrecioOrdenCompra * intCantidadOrdenCompra).toFixed(2);
			$("#dcmTotalOrdenCompra").val(dcmTotalOrdenCompra);
		}
	}
}
/* FIN - Ocultar Campos */
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

//////////////////////////////////////////////////////////////
/* INICIO - Ver Imagen */
function VerImagenProducto(seleccion) {
	var nvchDireccionImg = $(seleccion).attr("imagen");
	$("#CuadroImagenHeader").css("background-color", "#78909c");
    $("#CuadroImagenTitulo").css("color", "#FFFFFF");
    $("#CuadroImagenFooter").css("background-color", "#cfd8dc");
    $("#CuadroImagenTitulo").html("Imágen del Producto");
	$("#DireccionImgProducto").html("<img class='img-responsive center-block' src='../../datos/inventario/imgproducto/"+nvchDireccionImg+"' />");
	$("#CuadroImagen").modal("show");
}
/* FIN - Ver Imagen */
//////////////////////////////////////////////////////////////