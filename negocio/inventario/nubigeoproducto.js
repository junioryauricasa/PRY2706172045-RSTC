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
	if(EsVacio("nvchUbicacion") == false){
		return false;
	}
	if(EsNumeroEntero("intCantidadUbigeo") == false){
		return false;
	}
	var intIdProducto = document.getElementById("intIdProducto").value;
	var nvchSucursal = document.getElementById("nvchSucursal").value;
	var nvchUbicacion = document.getElementById("nvchUbicacion").value;
	var intCantidadUbigeo = document.getElementById("intCantidadUbigeo").value;
	var tipolistado = "I";
	var funcion = "IUP";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,
	   		nvchSucursal:nvchSucursal,
	   		nvchUbicacion:nvchUbicacion,
	   		intCantidadUbigeo:intCantidadUbigeo,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		MensajeNormal("Se agregó correctamente el Ubigeo del Producto",1);
	   		MostrarUbigeo(intIdProducto,tipolistado);
	   		$("#tipo-busqueda").val("T");
	   		ListarProducto(x,y,"T");
	   		PaginarProducto(x,y,"T");
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
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
	var nvchSucursal = document.getElementById("nvchSucursal").value;
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
	   		nvchSucursal:nvchSucursal,
	   		nvchUbicacion:nvchUbicacion,
	   		intCantidadUbigeo:intCantidadUbigeo,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		MensajeNormal("Se modificó correctamente el Ubigeo del Producto",1);
	   		MostrarUbigeo(intIdProducto,tipolistado);
	   		BotonesUbigeo(accion);
	   		$("#tipo-busqueda").val("T");
	   		ListarProducto(x,y,"T");
	   		PaginarProducto(x,y,"T");
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
	   	$("#nvchSucursal").val(datos.nvchSucursal);
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
	   	 if(datos=="ok"){
	   	 	MensajeNormal("Se eliminó correctamente el Ubigeo del Producto",1);
	   	 	MostrarUbigeo(intIdProducto,tipolistado);
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
		$("#btn-agregar-ubigeo").show();
		$("#btn-actualizar-ubigeo").hide();
		$("#btn-cancelar-ubigeo").hide();
	} else if (accion == "A") {
		RestablecerValidacion("nvchUbicacion",2);
		RestablecerValidacion("intCantidadUbigeo",2);
		$("#btn-agregar-ubigeo").hide();
		$("#btn-actualizar-ubigeo").show();
		$("#btn-cancelar-ubigeo").show();
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////