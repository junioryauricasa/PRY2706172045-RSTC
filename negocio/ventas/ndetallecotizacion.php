<script>
//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Producto */
function PaginacionProductos(seleccion) {
	var y = 5;
	var x = $(seleccion).attr("idprt") * y;
	ListarProductosSeleccion(x,y);
}

$(document).on('keyup', '#BusquedaProducto', function(){
	var y = 5;
	var x = 0;
	ListarProductosSeleccion(x,y);
});

$(document).on('change', '#tipo-busqueda', function(){
	var y = 5;
	var x = 0;
	ListarProductosSeleccion(x,y);
});
/* FIN - Funciones Ajax - Listar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Productos para la Selección */
function ListarProductosSeleccion(x,y) {
	var busqueda = document.getElementById("BusquedaProducto").value;
	var funcion = "MPT";
	var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	var intIdTipoMoneda = document.getElementById("tipo-moneda").value;
	var tipofuncion = document.getElementById("tipofuncion").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cotizacion.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,tipofuncion:tipofuncion,x:x,y:y,TipoBusqueda:TipoBusqueda,intIdTipoMoneda:intIdTipoMoneda},
	   success:function(datos)
	   {
	   	$("#ListaDeProductosSeleccion").html(datos);
	   	PaginarProductosSeleccion((x/y),y);
	   }
	});
}
/* FIN - Listar Productos para la Selección */
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
	   	if($("#intIdTipoVenta").val() == 1){
	   		$("#ListaDeProductosComprar").html(datos);
	   	} else if($("#intIdTipoVenta").val() == 2){
	   		$("#ListaDeServiciosComprar").html(datos);
	   	}
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
/* INICIO - Listar Domicilios según Ingresa */
function SeleccionarProducto(seleccion) {
	var intIdProducto = $(seleccion).attr("idsprt");
	var nvchCodigo = $("input[type=hidden][name='SnvchCodigo["+intIdProducto+"]']").val();
	var nvchSimbolo = $("input[type=hidden][name='SnvchSimbolo["+intIdProducto+"]']").val();
	var nvchDescripcion = $("input[type=hidden][name='SnvchDescripcion["+intIdProducto+"]']").val();
	var intCantidad = $("input[type=text][name='SintCantidad["+intIdProducto+"]']").val();
	var dcmPrecio = $("input[type=hidden][name='SdcmPrecioVenta1["+intIdProducto+"]']").val();
	var dcmDescuento = $("input[type=text][name='SdcmDescuento["+intIdProducto+"]']").val();
	var dcmPrecioUnitario = $("input[type=text][name='SdcmPrecioLista["+intIdProducto+"]']").val();
	var dcmTotal = $("input[type=text][name='SdcmTotal["+intIdProducto+"]']").val();

	if(dcmDescuento == "" || dcmDescuento == null) {
		MensajeNormal("Ingresar el Descuento del Producto que estás eligiendo",2);
		return false;
	} else if(intCantidad == "" || intCantidad == null) {
		MensajeNormal("Ingresar la cantidad del Producto que estás eligiendo",2);
		return false;
	}

	$('#ListaDeProductosComprar').append('<tr><td class="heading" data-th="ID"></td>'+
		'<td>'+'<input type="hidden" name="intIdProducto[]" value="'+intIdProducto+'"/>'+nvchCodigo+'</td>'+
		'<td>'+nvchDescripcion+'</td>'+
		'<td>'+'<input type="hidden" name="intCantidad[]" value="'+intCantidad+'"/>'+intCantidad+'</td>'+
		'<td>'+'<input type="hidden" name="dcmPrecio[]" value="'+dcmPrecio+'"/>'+nvchSimbolo+' '+dcmPrecio+'</td>'+
		'<td>'+'<input type="hidden" name="dcmDescuento[]" value="'+dcmDescuento+'"/>'+dcmDescuento+'%'+'</td>'+
		'<td>'+'<input type="hidden" name="dcmPrecioUnitario[]" value="'+dcmPrecioUnitario+'"/>'+nvchSimbolo+' '+dcmPrecioUnitario+'</td>'+
		'<td>'+'<input type="hidden" name="dcmTotal[]" value="'+dcmTotal+'"/>'+nvchSimbolo+' '+dcmTotal+'</td>'+
		'<td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>'+
		'</tr>');
}
/* FIN - Listar Domicilios según Ingresa */
////////////////////////////////////////////////////////////// 

//////////////////////////////////////////////////////////////
/* INICIO - Listar Domicilios según Ingresa */
function AgregarServicio() {

	if(EsVacio("nvchDescripcionServicio") == false){
		return false;
	} else if(EsNumeroEntero("intCantidadServicio") == false){
		return false;
	} else if(EsDecimal("dcmPrecioUnitarioServicio")== false){
		return false;
	}

	var nvchDescripcion = $("#nvchDescripcionServicio").val();
	var intCantidad = $("#intCantidadServicio").val();
	var dcmPrecioUnitario = Number($("#dcmPrecioUnitarioServicio").val()).toFixed(2);
	var Total = (dcmPrecioUnitario * intCantidad).toFixed(2); 

	$('#ListaDeServiciosComprar').append('<tr><td class="heading" data-th="ID">12</td>'+
		'<td>'+'<input type="hidden" name="intCantidad[]" value="'+intCantidad+'"/>'+intCantidad+'</td>'+
		'<td>'+'<input type="hidden" name="nvchDescripcionServicio[]" value="'+nvchDescripcion+'"/>'+nvchDescripcion+'</td>'+
		'<td>'+'<input type="hidden" name="dcmPrecioUnitario[]" value="'+dcmPrecioUnitario+'"/>'+dcmPrecioUnitario+'</td>'+
		'<td>'+'<input type="hidden" name="dcmTotal[]" value="'+Total+'"/>'+Total+'</td>'+
		'<td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>'+
		'</tr>');
	RestablecerValidacion("nvchDescripcionServicio",1);
	RestablecerValidacion("intCantidadServicio",1);
	RestablecerValidacion("dcmPrecioUnitarioServicio",1);
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

//////////////////////////////////////////////////////////////
/* INICIO - Calcular Precio Unitario */
function CalcularPrecioTotal(accion) {
	var intIdTipoCliente = $("#intIdTipoCliente").val();
	var intIdProducto = $(accion).attr("idsprt");
	var dcmDescuentoVenta2 = $("input[type=hidden][name='SdcmDescuentoVenta2["+intIdProducto+"]']").val();
	var dcmDescuentoVenta3 = $("input[type=hidden][name='SdcmDescuentoVenta3["+intIdProducto+"]']").val();
	var dcmDescuento = $("input[type=text][name='SdcmDescuento["+intIdProducto+"]']").val();
	var intCantidad = $("input[type=text][name='SintCantidad["+intIdProducto+"]']").val();
	if((dcmDescuento == "" || dcmDescuento == null) && (intCantidad == "" || intCantidad == null)){
		return false;
	} else {
		if(intIdTipoCliente == 1) {
			if(Number(dcmDescuento) > dcmDescuentoVenta2) {
				MensajeNormal("Sobrepasa al descuento 2",2);
				$("input[type=text][name='SdcmDescuento["+intIdProducto+"]']").val("");
				return false;
			}
		} else if (intIdTipoCliente == 2) {
			if(Number(dcmDescuento) > dcmDescuentoVenta3) {
				MensajeNormal("Sobrepasa al descuento 3",2);
				$("input[type=text][name='SdcmDescuento["+intIdProducto+"]']").val("");
				return false;
			}
		} else {
			MensajeNormal("Seleccionar un Cliente",2);
			$("input[type=text][name='SdcmDescuento["+intIdProducto+"]']").val("");
			return false
		}
		var dcmPrecioVenta1 = $("input[type=hidden][name='SdcmPrecioVenta1["+intIdProducto+"]']").val();
		var dcmPrecioUnitario = (dcmPrecioVenta1 - (dcmPrecioVenta1*(dcmDescuento/100))).toFixed(2);
		$("input[type=text][name='SdcmPrecioLista["+intIdProducto+"]']").val(dcmPrecioUnitario);

		if (intCantidad == "" || intCantidad == null) {
			$("input[type=text][name='SdcmTotal["+intIdProducto+"]']").val("0.00");
			return false;
		}
		else {
			var dcmTotal = (dcmPrecioUnitario * intCantidad).toFixed(2);
			$("input[type=text][name='SdcmTotal["+intIdProducto+"]']").val(dcmTotal);
		}
	}
}
/* FIN - Calcular Precio Unitario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ver Imagen */
function VerImagenProducto(seleccion) {
	var nvchDireccionImg = $(seleccion).attr("imagen");
	$("#CuadroImagenHeader").css("background-color", "#78909c");
    $("#CuadroImagenTitulo").css("color", "#FFFFFF");
    $("#CuadroImagenFooter").css("background-color", "#cfd8dc");
    $("#CuadroImagenTitulo").html("Imágen del Producto");
	//$("#DireccionImgProducto").html("<img class='img-responsive center-block' src='../../datos/inventario/imgproducto/"+nvchDireccionImg+"' />");

	/* Mostrara una imagen nula si el producto no posee imagen */
	if(!nvchDireccionImg){
		$("#DireccionImgProducto").html("<img class='img-responsive center-block' style='width: 400px' src='../../datos/inventario/imgproducto/productosinfoto.png'/>");
	}else{
		$("#DireccionImgProducto").html("<img class='img-responsive center-block' style='width: 400px' src='../../datos/inventario/imgproducto/"+nvchDireccionImg+"' />");
	}
	
	$("#CuadroImagen").modal("show");
}
/* FIN - Ver Imagen */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ver Detalle del Ubigeo del Producto Solicitado */
function VerDetalleUbigeo(seleccion) {
	var nvchCodigo = $(seleccion).attr("codigo");
	var intIdProducto = $(seleccion).attr("id");
	var funcion = "VDU";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#CodigoProducto").html(nvchCodigo);
	   	$("#DetalleUbigeo").html(datos);
	   	//goToBox("#TablaDetalleUbigeo");
	   }
	  });
}
/* FIN - Ver Detalle del Ubigeo del Producto Solicitado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ver Detalle del Ubigeo del Producto Solicitado */
function LimpiarDetalleUbigeo() {
   	$("#CodigoProducto").html("");
   	$("#DetalleUbigeo").html("");
}
/* FIN - Ver Detalle del Ubigeo del Producto Solicitado */
//////////////////////////////////////////////////////////////
</script>