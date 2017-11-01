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
	var intIdSucursal = document.getElementById("lugar-venta").value;
	var intIdTipoMoneda = document.getElementById("tipo-moneda").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,TipoBusqueda:TipoBusqueda,intIdSucursal:intIdSucursal,
	   		intIdTipoMoneda:intIdTipoMoneda},
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
/* INICIO - Listar Domicilios según Ingresa */
function SeleccionarProducto(seleccion) {
	var intIdProducto = $(seleccion).attr("idsprt");
	var nvchCodigo = $("input[type=hidden][name='SnvchCodigo["+intIdProducto+"]']").val();
	var nvchSimbolo = $("input[type=hidden][name='SnvchSimbolo["+intIdProducto+"]']").val();
	var nvchDescripcion = $("input[type=hidden][name='SnvchDescripcion["+intIdProducto+"]']").val();
	var intCantidad = $("input[type=text][name='SintCantidad["+intIdProducto+"]']").val();
	var CantidadTotal = $("input[type=hidden][name='SCantidadTotal["+intIdProducto+"]']").val();
	var dcmPrecio = $("input[type=hidden][name='SdcmPrecioVenta1["+intIdProducto+"]']").val();
	var Descuento = $("input[type=text][name='SdcmDescuento["+intIdProducto+"]']").val();
	var PrecioUnitario = $("input[type=text][name='SdcmPrecioLista["+intIdProducto+"]']").val();
	var Total = $("input[type=text][name='SdcmTotal["+intIdProducto+"]']").val();

	if(Descuento == "" || Descuento == null) {
		MensajeNormal("Ingresar el Descuento del Producto que estás eligiendo",2);
		return false;
	} else if(intCantidad == "" || intCantidad == null) {
		MensajeNormal("Ingresar la Cantidad del Producto que estás eligiendo",2);
		return false;
	}

	$('#ListaDeProductosComprar').append('<tr>'+
		'<td>'+'<input type="hidden" name="intIdProducto[]" value="'+intIdProducto+'"/>'+nvchCodigo+'</td>'+
		'<td>'+nvchDescripcion+'</td>'+
		'<td>'+'<input type="hidden" name="intCantidad[]" value="'+intCantidad+'"/>'+intCantidad+'</td>'+
		'<td>'+'<input type="hidden" name="dcmPrecioUnitario[]" value="'+PrecioUnitario+'"/>'+
		'<input type="hidden" name="dcmPrecio[]" value="'+dcmPrecio+'"/>'+
		'<input type="hidden" name="dcmDescuento[]" value="'+Descuento+'"/>'+nvchSimbolo+' '+PrecioUnitario+'</td>'+
		'<td>'+'<input type="hidden" name="dcmTotal[]" value="'+Total+'"/>'+nvchSimbolo+' '+Total+'</td>'+
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

	$('#ListaDeServiciosComprar').append('<tr>'+
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
/* INICIO - Mostrar Detalle Orden Compra Seleccionado */
function MostrarDetalleVenta(intIdVenta,tipolistado) {
	var funcion = "MDV";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{intIdVenta:intIdVenta,funcion:funcion,tipolistado:tipolistado},
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
	$("#DireccionImgProducto").html("<img class='img-responsive center-block' src='../../datos/inventario/imgproducto/"+nvchDireccionImg+"' />");
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

//////////////////////////////////////////////////////////////
/* INICIO - Listar Domicilios según Ingresa */
function InsertarCotizacion(seleccion) {
	var intIdCotizacion = $(seleccion).attr("idct");
	var funcion = "ICT";
	var intIdTipoMoneda = $("#tipo-moneda").val();
	$.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{intIdCotizacion:intIdCotizacion,funcion:funcion,intIdTipoMoneda:intIdTipoMoneda},
	   success:function(datos)
	   {
	   	$("#ListaDeProductosComprar").append(datos); 
	   }
	});	
}
/* FIN - Listar Domicilios según Ingresa */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Producto */
function PaginacionCotizaciones(seleccion) {
	var y = 5;
	var x = $(seleccion).attr("idct") * y;
	ListarCotizaciones(x,y);
}

$(document).on('keyup', '#BusquedaCotizacion', function(){
	var y = 5;
	var x = 0;
	ListarCotizaciones(x,y);
});
/* FIN - Funciones Ajax - Listar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Productos para la Selección */
function ListarCotizaciones(x,y) {
	var busqueda = document.getElementById("BusquedaCotizacion").value;
	var funcion = "MCT";
	var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeCotizaciones").html(datos);
	   	PaginarCotizaciones((x/y),y);
	   }
	});
}
/* FIN - Listar Productos para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Clientes para la Selección */
function PaginarCotizaciones(x,y) {
	var busqueda = document.getElementById("BusquedaProducto").value;
	var funcion = "PCT";
	var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#PaginacionDeCotizaciones").html(datos);
	   }
	  });
}
/* FIN - Paginar Clientes para la Selección */
//////////////////////////////////////////////////////////////