<script>
//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Ubicaciones del Producto Seleccionado */
function MostrarUbigeo(intIdProducto,tipolistado) {
	var funcion = "MUP";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeUbicaciones").html(datos);
	   }
	  });
}
/* FIN - Mostrar Ubicaciones del Producto Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Insertar Ubigeo Nueva */
function AgregarUbigeo_II() {
	var intIdSucursal = document.getElementById("intIdSucursal").value;
	var nvchSucursal = $("#intIdSucursal option:selected").html().replace(/\s/g,'');
	if(EsVacio("nvchUbicacion") == false){
		return false;
	}
	if(EsNumeroEntero("intCantidadUbigeo") == false){
		return false;
	}
	var validacion = true;
	$('#ListaDeUbicaciones tr').each(function(){
        if($(this).find('td').eq(1).text().replace(/\s/g,'') == nvchSucursal){
            validacion = false;
        }
    });
    if(validacion == false){
    	MensajeNormal("No puede haber más de una Ubicación de la Sucursal seleccionada",2);
    	return false;
    }
	var intIdProducto = document.getElementById("intIdProducto").value;
	var nvchUbicacion = document.getElementById("nvchUbicacion").value;
	var intCantidadUbigeo = document.getElementById("intCantidadUbigeo").value;
	var tipolistado = "I";
	var funcion = "IUP";
	var y = document.getElementById("num-lista").value;
  	var x = $(".marca").attr("idp") * y;
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,
	   		intIdSucursal:intIdSucursal,
	   		nvchUbicacion:nvchUbicacion,
	   		intCantidadUbigeo:intCantidadUbigeo,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	datos = datos.replace(/\s/g,''); 
	   	if(datos == "okokokok"){
	   		MensajeNormal("Se agregó correctamente el Ubigeo del Producto",1);
	   		MostrarUbigeo(intIdProducto,tipolistado);
	   		ListarProducto(x,y,$("#tipo-busqueda").val());
	   		PaginarProducto(x,y,$("#tipo-busqueda").val());
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
	RestablecerValidacion("nvchUbicacion",1);
	RestablecerValidacion("intCantidadUbigeo",1);
}
/* FIN - Insertar Ubigeo Nueva */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Actualizar Ubigeo Seleccionado */
function ActualizarUbigeo() {
	if(EsVacio("nvchUbicacion") == false){
		return false;
	}
	if(EsNumeroEntero("intCantidadUbigeo") == false){
		return false;
	}
	var intIdUbigeoProducto = document.getElementById("intIdUbigeoProducto").value;
	var intIdProducto = document.getElementById("intIdProducto").value;
	var intIdSucursal = document.getElementById("intIdSucursal").value;
	var nvchUbicacion = document.getElementById("nvchUbicacion").value;
	var intCantidadUbigeo = document.getElementById("intCantidadUbigeo").value;
	var tipolistado = "A";
	var accion = "I";
	var funcion = "AUP";
	var y = document.getElementById("num-lista").value;
  	var x = $(".marca").attr("idp") * y;
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdUbigeoProducto:intIdUbigeoProducto,
	   		intIdProducto:intIdProducto,
	   		intIdSucursal:intIdSucursal,
	   		nvchUbicacion:nvchUbicacion,
	   		intCantidadUbigeo:intCantidadUbigeo,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	datos = datos.replace(/\s/g,''); 
	   	if(datos == "okok"){
	   		MensajeNormal("Se modificó correctamente el Ubigeo del Producto",1);
	   		MostrarUbigeo(intIdProducto,tipolistado);
	   		BotonesUbigeo(accion);
	   		ListarProducto(x,y,$("#tipo-busqueda").val());
	   		PaginarProducto(x,y,$("#tipo-busqueda").val());
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Actualizar Ubigeo Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Ubigeo Seleccionado */
function SeleccionarUbigeo(seleccion) {
	var intIdUbigeoProducto = $(seleccion).attr("idup");
	var funcion = "SUP";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdUbigeoProducto:intIdUbigeoProducto,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#intIdUbigeoProducto").val(datos.intIdUbigeoProducto);
	   	$("#intIdSucursal").val(datos.intIdSucursal);
	   	$("#nvchUbicacion").val(datos.nvchUbicacion);
	   	$("#intCantidadUbigeo").val(datos.intCantidadUbigeo);
	   	BotonesUbigeo('A');
	   }
	  });
}
/* FIN - Mostrar Ubigeo Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Ubigeo Seleccionado */
function EliminarUbigeo(seleccion) {
	var intIdUbigeoProducto = $(seleccion).attr("idup");
	var intIdProducto = document.getElementById("intIdProducto").value;
	var funcion = "EUP";
	var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdUbigeoProducto:intIdUbigeoProducto,funcion:funcion},
	   success:function(datos)
	   {
	   	 datos = datos.replace(/\s/g,''); //quita los espacios del FLAG OK
	   	 if(datos=="ok"){
	   	 	MensajeNormal("Se eliminó correctamente el Ubigeo del Producto",1);
	   	 	MostrarUbigeo(intIdProducto,tipolistado);
	   	 	ListarProducto(x,y,$("#tipo-busqueda").val());
	   		PaginarProducto(x,y,$("#tipo-busqueda").val());
	   	 } else {
	   	 	alert(datos);
	   	 }
	   }
	  });
}
/* FIN - Eliminar Ubigeo Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function BotonesUbigeo(accion) {
	if(accion == "I"){
		RestablecerValidacion("nvchUbicacion",1);
		RestablecerValidacion("intCantidadUbigeo",1);
		$("#btn-agregar-ubigeo-mostrar").show();
		$("#btn-actualizar-ubigeo").hide();
		$("#btn-cancelar-ubigeo").hide();

		//alert("la cagaste");

	} else if (accion == "A") {
		RestablecerValidacion("nvchUbicacion",2);
		RestablecerValidacion("intCantidadUbigeo",2);
		$("#btn-agregar-ubigeo-mostrar").hide();
		$("#btn-actualizar-ubigeo").show();
		$("#btn-cancelar-ubigeo").show();

		//alert("la cagaste");
	}
}
/* FIN - Ocultar Botones */
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
	   	goToBox("#TablaDetalleUbigeo");
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
/* INICIO - Funcion Ajax - Buscar Producto */
$(document).on('change', '#num-lista-ubigeo', function(){
  	  var y = document.getElementById("num-lista-ubigeo").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  ListarUbigeo(x,y,tipolistado);
});

$(document).on('change', '#tipo-busqueda-ubigeo', function(){
  	  var y = document.getElementById("num-lista-ubigeo").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  ListarUbigeo(x,y,tipolistado);
});

$(document).on('click', '.btn-pagina-ubigeo', function(){
  	  var y = document.getElementById("num-lista-ubigeo").value;
  	  var x = $(this).attr("idp") * y;
  	  var tipolistado = "T";
  	  ListarUbigeo(x,y,tipolistado);
});

$(document).on('keyup', '#txt-busqueda-ubigeo', function(){
  	  var y = document.getElementById("num-lista-ubigeo").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  ListarUbigeo(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Producto */
function ListarUbigeo(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda-ubigeo").value;
  var funcion = "LUP";
  $.ajax({
      url:'../../datos/inventario/funcion_producto.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#ListaDeUbigeos").html(datos);
          PaginarUbigeo((x/y),y,tipolistado);
      }
  });
}
/* FIN - Funcion Ajax - Listar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Producto */
function PaginarUbigeo(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda-ubigeo").value;
  var funcion = "PUP";
  $.ajax({
      url:'../../datos/inventario/funcion_producto.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#PaginacionDeUbigeos").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Producto */
//////////////////////////////////////////////////////////////

$(document).on('click', '.btn-mostrar-ubigeo-producto', function(){
	var intIdUbigeoProducto = $(this).attr("id");
	var funcion = "SUP";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdUbigeoProducto:intIdUbigeoProducto,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#intIdUbigeoProductoM").val(datos.intIdUbigeoProducto);
	   	$("#intIdProductoM").val(datos.intIdProducto);
	   	$("#intIdSucursalM").val(datos.intIdSucursal);
	   	$("#nvchUbicacionM").val(datos.nvchUbicacion);
	   	$("#intCantidadUbigeoM").val(datos.intCantidadUbigeo);
	   	$('#formUbigeoProducto').modal('show');
	   }
	  });
	 return false;
});

function ModificarUbigeoProducto(){
	if(EsVacio("nvchUbicacionM") == false){
		return false;
	}
	var intIdUbigeoProducto = document.getElementById("intIdUbigeoProductoM").value;
	var intIdProducto = document.getElementById("intIdProductoM").value;
	var intIdSucursal = document.getElementById("intIdSucursalM").value;
	var nvchUbicacion = document.getElementById("nvchUbicacionM").value;
	var intCantidadUbigeo = document.getElementById("intCantidadUbigeoM").value;
	var accion = "I";
	var funcion = "AUP";
	var y = document.getElementById("num-lista-ubigeo").value;
  	var x = $(".marca-ubigeo").attr("idp") * y;
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdUbigeoProducto:intIdUbigeoProducto,
	   		intIdProducto:intIdProducto,
	   		intIdSucursal:intIdSucursal,
	   		nvchUbicacion:nvchUbicacion,
	   		intCantidadUbigeo:intCantidadUbigeo,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	datos = datos.replace(/\s/g,''); 
	   	if(datos == "okok"){
	   		MensajeNormal("Se Modificó correctamente el Ubigeo del Producto",1);
	   		ListarUbigeo(x,y,'E');
	   		$('#formUbigeoProducto').modal('hide');
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
</script>