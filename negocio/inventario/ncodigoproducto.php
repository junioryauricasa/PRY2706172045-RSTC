<script>
//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Codigos del Producto Seleccionado */
function MostrarCodigo(intIdProducto,tipolistado) {
	var funcion = "MCP";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeCodigos").html(datos);
	   }
	  });
}
/* FIN - Mostrar Codigos del Producto Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Insertar Codigo Nueva */
function AgregarCodigo_II() {
	var intIdProducto = document.getElementById("intIdProducto").value;
	var nvchCodigo = document.getElementById("nvchCodigo").value;
	var intIdTipoCodigoProducto = document.getElementById("tipo-codigo-producto").value;
	var validacion = true;
	$('#ListaDeCodigos tr').each(function(){
        if($(this).find('td').eq(1).text() == 'Principal'){
            validacion = false;
        }
    });
	if(EsVacio("nvchCodigo") == false){
		return false;
	} else if(validacion == false){
    	if (intIdTipoCodigoProducto == 1) {
	    	MensajeNormal("No puede haber más de un Código Principal",2);
	    	return false;
    	}
    }
	var tipolistado = "I";
	var funcion = "ICP";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,
	   		nvchCodigo:nvchCodigo,
	   		intIdTipoCodigoProducto:intIdTipoCodigoProducto,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	datos = datos.replace(/\s/g,''); //quitando espacio
	   	if(datos == "ok"){
	   		MensajeNormal("Se agregó correctamente el Código del Producto",1);
	   		MostrarCodigo(intIdProducto,tipolistado);
	   		$("#tipo-busqueda").val();
	   		ListarProducto(x,y,$("#tipo-busqueda").val());
	   		PaginarProducto(x,y,$("#tipo-busqueda").val());
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Insertar Codigo Nueva */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Actualizar Codigo Seleccionado */
function ActualizarCodigo() {
	var intIdCodigoProducto = document.getElementById("intIdCodigoProducto").value;
	var intIdProducto = document.getElementById("intIdProducto").value;
	var nvchCodigo = document.getElementById("nvchCodigo").value;
	var intIdTipoCodigoProducto = document.getElementById("tipo-codigo-producto").value;
	var validacion = true;
	$('#ListaDeCodigos tr').each(function(){
        if($(this).find('td').eq(1).text() == 'Principal'){
            validacion = false;
        }
    });
	if(EsVacio("nvchCodigo") == false){
		return false;
	} else if(validacion == false){
    	if (intIdTipoCodigoProducto == 1) {
	    	MensajeNormal("No puede haber más de un Código Principal",2);
	    	return false;
    	}
    }
    var y = document.getElementById("num-lista").value;
  	var x = $(".marca").attr("idp") * y;
	var tipolistado = "A";
	var accion = "I";
	var funcion = "ACP";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdCodigoProducto:intIdCodigoProducto,
	   		intIdProducto:intIdProducto,
	   		nvchCodigo:nvchCodigo,
	   		intIdTipoCodigoProducto:intIdTipoCodigoProducto,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	datos = datos.replace(/\s/g,''); //quitando espacio
	   	if(datos == "ok"){
	   		MensajeNormal("Se modificó correctamente el Código del Producto",1);
	   		MostrarCodigo(intIdProducto,tipolistado);
	   		BotonesCodigo(accion);
	   		ListarProducto(x,y,$("#tipo-busqueda").val());
	   		PaginarProducto(x,y,$("#tipo-busqueda").val());
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Actualizar Codigo Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Codigo Seleccionado */
function SeleccionarCodigo(seleccion) {
	var intIdCodigoProducto = $(seleccion).attr("idcp");
	var funcion = "SCP";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdCodigoProducto:intIdCodigoProducto,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#intIdCodigoProducto").val(datos.intIdCodigoProducto);
	   	$("#nvchCodigo").val(datos.nvchCodigo);
	   	$("#tipo-codigo-producto").val(datos.intIdTipoCodigoProducto);
	   	BotonesCodigo('A');
	   }
	  });
}
/* FIN - Mostrar Codigo Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Codigo Seleccionado */
function EliminarCodigo(seleccion) {
	var intIdCodigoProducto = $(seleccion).attr("idcp");
	var intIdProducto = document.getElementById("intIdProducto").value;
	var funcion = "ECP";
	var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdCodigoProducto:intIdCodigoProducto,funcion:funcion},
	   success:function(datos)
	   {
	   	 datos = datos.replace(/\s/g,''); //quitando espacio
	   	 if(datos=="ok"){
	   	 	MensajeNormal("Se eliminó correctamente el Código del Producto",1);
	   	 	MostrarCodigo(intIdProducto,tipolistado);
	   	 	ListarProducto(x,y,$("#tipo-busqueda").val());
	   		PaginarProducto(x,y,$("#tipo-busqueda").val());
	   	 }
	   }
	  });
}
/* FIN - Eliminar Codigo Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function BotonesCodigo(accion) {
	if(accion == "I"){
		RestablecerValidacion("nvchCodigo",1);
		$("#btn-agregar-codigo").show();
		$("#btn-actualizar-codigo").hide();
		$("#btn-cancelar-codigo").hide();
	} else if (accion == "A") {
		RestablecerValidacion("nvchCodigo",2);
		$("#btn-agregar-codigo").hide();
		$("#btn-actualizar-codigo").show();
		$("#btn-cancelar-codigo").show();
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////
</script>