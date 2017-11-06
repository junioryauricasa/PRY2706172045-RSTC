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
	var intIdSucursal = document.getElementById("intIdSucursal").value;
	  $.ajax({
	   url:"../../datos/inventario/funcion_salida.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,TipoBusqueda:TipoBusqueda,intIdSucursal:intIdSucursal},
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
	   url:"../../datos/inventario/funcion_salida.php",
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
	var nvchDescripcion = $("input[type=hidden][name='SnvchDescripcion["+intIdProducto+"]']").val();
	var intCantidad = $("input[type=text][name='SintCantidad["+intIdProducto+"]']").val();
	var dcmPrecioUnitario = $("input[type=text][name='SdcmPrecioUnitario["+intIdProducto+"]']").val();
	var dcmTotal = $("input[type=text][name='SdcmTotal["+intIdProducto+"]']").val();

	var intIdTipoMoneda = document.getElementById("tipo-moneda").value;
	var nvchSimbolo = "";
	if(intIdTipoMoneda == 1){
		nvchSimbolo = "S/.";
	} else if(intIdTipoMoneda == 2){
		nvchSimbolo = "US$";
	}

	if(intCantidad == "" || intCantidad == null) {
		MensajeNormal("Ingresar la Cantidad del Producto que estás eligiendo",2);
		return false;
	} else if(dcmPrecioUnitario == "" || dcmPrecioUnitario == null) {
		MensajeNormal("Ingresar el Precio del Producto que estás eligiendo",2);
		return false;
	}

	dcmPrecioUnitario = Number(dcmPrecioUnitario).toFixed(2);

	$('#ListaDeProductosSalida').append('<tr>'+
		'<td>'+'<input type="hidden" name="intIdProducto[]" value="'+intIdProducto+'"/><input type="hidden" name="nvchCodigo[]" value="'+nvchCodigo+'"/>'+nvchCodigo+'</td>'+
		'<td>'+'<input type="hidden" name="nvchDescripcion[]" value="'+nvchDescripcion+'"/>'+nvchDescripcion+'</td>'+
		'<td>'+'<input type="hidden" name="intCantidad[]" value="'+intCantidad+'"/>'+intCantidad+'</td>'+
		'<td>'+'<input type="hidden" name="dcmPrecioUnitario[]" value="'+dcmPrecioUnitario+'"/>'+nvchSimbolo+' '+dcmPrecioUnitario+'</td>'+
		'<td>'+'<input type="hidden" name="dcmTotal[]" value="'+dcmTotal+'"/>'+nvchSimbolo+' '+dcmTotal+'</td>'+
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
/* INICIO - Mostrar Detalle Orden Compra Seleccionado */
function MostrarDetalleSalida(intIdSalida,tipolistado) {
	var funcion = "MD";
	  $.ajax({
	   url:"../../datos/inventario/funcion_salida.php",
	   method:"POST",
	   data:{intIdSalida:intIdSalida,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeProductosSalida").html(datos);
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
	var intIdProducto = $(accion).attr("idsprt");
	var intCantidad = $("input[type=text][name='SintCantidad["+intIdProducto+"]']").val();
	var dcmPrecioUnitario = $("input[type=text][name='SdcmPrecioUnitario["+intIdProducto+"]']").val();

	if (intCantidad == "" || intCantidad == null) {
		$("input[type=text][name='SdcmTotal["+intIdProducto+"]']").val("0.00");
		return false;
	}
	if (dcmPrecioUnitario == "" || dcmPrecioUnitario == null){
		$("input[type=text][name='SdcmTotal["+intIdProducto+"]']").val("0.00");
		return false;
	}
	var dcmTotal = (dcmPrecioUnitario * intCantidad).toFixed(2);
	$("input[type=text][name='SdcmTotal["+intIdProducto+"]']").val(dcmTotal);
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
</script>