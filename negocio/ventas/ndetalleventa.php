<script>
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
	var intIdTipoCliente = 1;
	//var intIdTipoCliente = $("#intIdTipoCliente").val();
	var intIdProducto = $(accion).attr("idsprt");
	var dcmDescuentoVenta2 = $("#dcmDescuentoVenta2"+intIdProducto).val();
	var dcmDescuentoVenta3 = $("#dcmDescuentoVenta3"+intIdProducto).val();
	var dcmDescuento = $("#dcmDescuento"+intIdProducto).val();
	var intCantidad = $("#intCantidad"+intIdProducto).val();
	if((dcmDescuento == "" || dcmDescuento == null) && (intCantidad == "" || intCantidad == null)){
		return false;
	} else {
		if(intIdTipoCliente == 1) {
			if(Number(dcmDescuento) > dcmDescuentoVenta2) {
				MensajeNormal("Sobrepasa al descuento 2",2);
				$("#dcmDescuento"+intIdProducto).val("");
				return false;
			}
		} else if (intIdTipoCliente == 2) {
			if(Number(dcmDescuento) > dcmDescuentoVenta3) {
				MensajeNormal("Sobrepasa al descuento 3",2);
				$("#dcmDescuento"+intIdProducto).val("");
				return false;
			}
		} else {
			MensajeNormal("Seleccionar un Cliente",2);
			$("#dcmDescuento"+intIdProducto).val("");
			return false
		}
		var dcmPrecioVenta1 = $("#dcmPrecio"+intIdProducto).val();
		var dcmPrecioUnitario = (dcmPrecioVenta1 - (dcmPrecioVenta1*(dcmDescuento/100))).toFixed(2);
		$("#dcmPrecioUnitario"+intIdProducto).val(dcmPrecioUnitario);

		if (intCantidad == "" || intCantidad == null) {
			$("#dcmTotal"+intIdProducto).val("0.00");
			CalcularTotal();
			return false;
		}
		else {
			var dcmTotal = (dcmPrecioUnitario * intCantidad).toFixed(2);
			$("#dcmTotal"+intIdProducto).val(dcmTotal);
			CalcularTotal();
		}
	}
}
/* FIN - Calcular Precio Unitario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Calcula el Total del Comprobante */
function CalcularTotal(){
	var VentaTotal = 0.00;
	var IGVVenta = 0.00;
	var ValorVenta = 0.00;
	Number(IGVVenta);
	Number(VentaTotal);
	Number(ValorVenta);
	$('table tbody#ListaDeProductosVender tr').each(function() {
        $(this).find("td input[name='dcmTotal[]']").each(function() {
            VentaTotal = VentaTotal + Number(this.value);
        }); 
    });
    ValorVenta = (VentaTotal / 1.18).toFixed(2);
    IGVVenta = (VentaTotal - ValorVenta).toFixed(2);
    $("#ValorVenta").val(ValorVenta);
    $("#IGVVenta").val(IGVVenta);
	$("#VentaTotal").val(VentaTotal);
}
/* FIN - Calcula el Total del Comprobante */
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
	var intIdTipoMoneda = $("#intIdTipoMoneda").val();

	$('table tbody#ListaDeProductosVender tr').each(function() {
        $(this).find("td input[name='nvchDescripcion[]']").each(function() {
            if(this.value == "" || this.value == null){
            	var fila = this.parentNode.parentNode;
  				fila.parentNode.removeChild(fila);
            }
        });
    });
	$.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{intIdCotizacion:intIdCotizacion,funcion:funcion,intIdTipoMoneda:intIdTipoMoneda,num:num},
	   success:function(datos)
	   {
	   	$("#ListaDeProductosVender").append(datos); 
	   	ReestablecerNumeracionFilas();
	   	CalcularTotal();
	   }
	});
}
/* FIN - Listar Domicilios según Ingresa */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Reestablecer Numeración de Filas */
function ReestablecerNumeracionFilas(){
	var num_filas_ventas = document.getElementById('ListaDeProductosVender').rows.length;
	$('table tbody#ListaDeProductosVender tr').each(function() {
        $(this).find("td input[name='fila[]']").each(function() {
            	num = this.value;
        });
    });
    num++;
}
/* FIN - Reestablecer Numeración de Filas */
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

	if(EsFecha("dtmFechaInicialCT") == false){
	  	var dtmFechaInicial = "";
	  } else {
	  	var dtmFechaInicial = $("#dtmFechaInicialCT").val();
	  }
	  if(EsFecha("dtmFechaFinalCT") == false){
	  	var dtmFechaFinal = FechaActual();
	  } else {
	  	var dtmFechaFinal = $("#dtmFechaFinalCT").val();
	  }

	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,dtmFechaInicial:dtmFechaInicial,
	   		dtmFechaFinal:dtmFechaFinal},
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
	var busqueda = document.getElementById("BusquedaCotizacion").value;
	var funcion = "PCT";

	if(EsFecha("dtmFechaInicialCT") == false){
	  	var dtmFechaInicial = "";
	  } else {
	  	var dtmFechaInicial = $("#dtmFechaInicialCT").val();
	  }
	  if(EsFecha("dtmFechaFinalCT") == false){
	  	var dtmFechaFinal = FechaActual();
	  } else {
	  	var dtmFechaFinal = $("#dtmFechaFinalCT").val();
	  }

	  $.ajax({
	   url:"../../datos/ventas/funcion_venta.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,dtmFechaInicial:dtmFechaInicial,
	   		dtmFechaFinal:dtmFechaFinal},
	   success:function(datos)
	   {
	   	$("#PaginacionDeCotizaciones").html(datos);
	   }
	  });
}
/* FIN - Paginar Clientes para la Selección */
//////////////////////////////////////////////////////////////
</script>