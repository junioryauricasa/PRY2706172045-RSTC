//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear GuiaInternaEntrada */
$(document).on('click', '#btn-form-crear-guiainternaentrada', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:'POST',
	   data:{funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Visualizar Formulario Crear GuiaInternaEntrada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar GuiaInternaEntrada */
$(document).on('click', '#btn-crear-guiainternaentrada', function(){
	  var formData = $("#form-guiainternaentrada").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/inventario/funcion_entrada.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okok") {
	   		$("#resultadocrud").html("<script>alert('Se Agregó correctamente')</script>");
	   		$('#txt-busqueda').val("");
	   		ListarGuiaInternaEntrada(x,y,tipolistado);
	   		PaginarGuiaInternaEntrada(x,y,tipolistado);
	   		MostrarDetalleOrdenCompra($("#intIdOrdenCompra").val());
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar GuiaInternaEntrada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar GuiaInternaEntrada */
$(document).on('click', '.btn-mostrar-guiainternaentrada', function(){
  	  var intIdGuiaInternaEntrada = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{intIdGuiaInternaEntrada:intIdGuiaInternaEntrada,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	MostrarDetalleOrdenCompra($("#intIdOrdenCompra").val());
	   	MostrarDetalleGuiaInternaEntrada(intIdGuiaInternaEntrada,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar GuiaInternaEntrada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar GuiaInternaEntrada */
$(document).on('click', '#btn-editar-guiainternaentrada', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-guiainternaentrada").serialize();
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		$("#resultadocrud").html("<script>alert('Se Actualizó correctamente')</script>");
	   		ListarGuiaInternaEntrada(x,y,tipolistado);
	   		PaginarGuiaInternaEntrada(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Actualizar GuiaInternaEntrada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Eliminar GuiaInternaEntrada */
$(document).on('click', '.btn-eliminar-guiainternaentrada', function(){
  	  var intIdGuiaInternaEntrada = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{intIdGuiaInternaEntrada:intIdGuiaInternaEntrada,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") { 
	   		$("#resultadocrud").html("<script>alert('Se Eliminó correctamente')</script>");
	   		ListarGuiaInternaEntrada(x,y,tipolistado);
	   		PaginarGuiaInternaEntrada(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar GuiaInternaEntrada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar GuiaInternaEntrada */
function ListarGuiaInternaEntrada(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  $.ajax({
      url:'../../datos/inventario/funcion_entrada.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#ListaDeGuiasInternaEntrada").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Listar GuiaInternaEntrada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista GuiaInternaEntrada */
$(document).on('change', '#num-lista', function(){
  	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var funcion = "L";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeGuiasInternaEntrada").html(datos);
	   	PaginarGuiaInternaEntrada(x,y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista GuiaInternaEntrada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar GuiaInternaEntrada */
function PaginarGuiaInternaEntrada(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  $.ajax({
      url:'../../datos/inventario/funcion_entrada.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#PaginacionDeGuiasInternaEntrada").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar GuiaInternaEntrada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Página de Lista GuiaInternaEntrada */
$(document).on('click', '.btn-pagina', function(){
      var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(this).attr("idp") * y;
  	  var funcion = "L";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeGuiasInternaEntrada").html(datos);
	   	PaginarGuiaInternaEntrada((x/y),y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Página de Lista GuiaInternaEntrada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Ingresa de la Lista del GuiaInternaEntrada II */
$(document).on('keyup', '#txt-busqueda', function(){
	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var funcion = "L";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeGuiasInternaEntrada").html(datos);
	   	PaginarGuiaInternaEntrada(x,y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Ingresa de la Lista del GuiaInternaEntrada II */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar DetalleGuiaInternaEntradaes según Ingresa */
function AgregarDetalleGuiaInternaEntrada(seleccion) {
	var intIdOperacionOrdenCompra = $(seleccion).attr("idooc");
	var nvchDescripcion = $("input[type=hidden][name='SnvchDescripcion["+intIdOperacionOrdenCompra+"]']").val();
	var intCantidad = $("input[type=text][name='SintCantidad["+intIdOperacionOrdenCompra+"]']").val();
	var intCantidadO = $("input[type=hidden][name='SintCantidadO["+intIdOperacionOrdenCompra+"]']").val();
	var intCantidadP = $("input[type=hidden][name='SintCantidadP["+intIdOperacionOrdenCompra+"]']").val();
	if(Number(intCantidadP) < Number(intCantidad)){
		alert('Esta Pasando el Limite de lo que Compró');
		return false;
	}

	$('#ListaDeDetallesGuiasInternaEntrada').append('<tr>'+
		'<td>'+'<input type="hidden" name="intIdOperacionOrdenCompra[]" value="'+intIdOperacionOrdenCompra+'"/>'+intIdOperacionOrdenCompra+'</td>'+
		'<td>'+nvchDescripcion+'</td>'+
		'<td>'+'<input type="hidden" name="intCantidad[]" value="'+intCantidad+'"/>'+intCantidad+'</td>'+
		'<td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>'+
		'</tr>');
}
/* FIN - Listar DetalleGuiaInternaEntradaes según Ingresa */
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
/* INICIO - Mostrar DetalleGuiaInternaEntradaes del GuiaInternaEntrada Seleccionado */
function MostrarDetalleGuiaInternaEntrada(intIdGuiaInternaEntrada,tipolistado) {
	var funcion = "MD";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{intIdGuiaInternaEntrada:intIdGuiaInternaEntrada,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeDetallesGuiasInternaEntrada").html(datos);
	   }
	  });
}
/* FIN - Mostrar DetalleGuiaInternaEntradaes del GuiaInternaEntrada Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Insertar DetalleGuiaInternaEntrada Nueva */
function AgregarDetalleGuiaInternaEntrada_II() {
	var intIdGuiaInternaEntrada = document.getElementById("intIdGuiaInternaEntrada").value;
	var nvchMedio = document.getElementById("nvchMedio").value;
	var nvchLugar = document.getElementById("nvchLugar").value;
	var intIdTipoDetalleGuiaInternaEntrada = document.getElementById("tipo-DetalleGuiaInternaEntrada").value;
	var tipolistado = "I";
	var funcion = "IC";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{intIdGuiaInternaEntrada:intIdGuiaInternaEntrada,
	   		intIdOperacionOrdenCompra:intIdOperacionOrdenCompra,
	   		intCantidad:intCantidad,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		alert("Se insertó correctamente la comunicación");
	   		MostrarDetalleGuiaInternaEntrada(intIdGuiaInternaEntrada,tipolistado);
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Insertar DetalleGuiaInternaEntrada Nueva */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Actualizar DetalleGuiaInternaEntrada Seleccionado */
function ActualizarDetalleGuiaInternaEntrada() {
	var intIdOperacionGuiaInternaEntrada = document.getElementById("intIdOperacionGuiaInternaEntrada").value;
	var intIdGuiaInternaEntrada = document.getElementById("intIdGuiaInternaEntrada").value;
	var nvchMedio = document.getElementById("nvchMedio").value;
	var nvchLugar = document.getElementById("nvchLugar").value;
	var intIdTipoDetalleGuiaInternaEntrada = document.getElementById("tipo-DetalleGuiaInternaEntrada").value;
	var tipolistado = "A";
	var accion = "I";
	var funcion = "AC";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{intIdOperacionGuiaInternaEntrada:intIdOperacionGuiaInternaEntrada,
	   		intIdGuiaInternaEntrada:intIdGuiaInternaEntrada,
	   		intIdOperacionOrdenCompra:intIdOperacionOrdenCompra,
	   		intCantidad:intCantidad,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		alert("Se modificó correctamente la comunicación");
	   		MostrarDetalleGuiaInternaEntrada(intIdGuiaInternaEntrada,tipolistado);
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Actualizar DetalleGuiaInternaEntrada Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar DetalleGuiaInternaEntrada Seleccionado */
function SeleccionarDetalleGuiaInternaEntrada(seleccion) {
	var intIdOperacionGuiaInternaEntrada = $(seleccion).attr("iddgie");
	var funcion = "SC";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{intIdOperacionGuiaInternaEntrada:intIdOperacionGuiaInternaEntrada,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#intIdOperacionGuiaInternaEntrada").val(datos.intIdOperacionGuiaInternaEntrada);
	   	$("#intIdOperacionOrdenCompra").val(datos.intIdOperacionOrdenCompra);
	   	$("#DescripcionProducto").val(datos.DescripcionProducto);
	   	$("#intCantidad").val(datos.intCantidad);
	   }
	  });
}
/* FIN - Mostrar DetalleGuiaInternaEntrada Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar DetalleGuiaInternaEntrada Seleccionado */
function EliminarDetalleGuiaInternaEntrada(seleccion) {
	var intIdOperacionGuiaInternaEntrada = $(seleccion).attr("iddgie");
	var funcion = "EC";
	var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{intIdOperacionGuiaInternaEntrada:intIdOperacionGuiaInternaEntrada,funcion:funcion},
	   success:function(datos)
	   {
	   	 if(datos=="ok"){
	   	 	alert("Se eliminó correctamente la Comunicación Seleccionada");
	   	 	MostrarDetalleGuiaInternaEntrada(intIdGuiaInternaEntrada,tipolistado);
	   	 }
	   }
	  });
}
/* FIN - Eliminar DetalleGuiaInternaEntrada Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Orden de Compra II */
$(document).on('keyup', '#BusquedaOrdenCompra', function(){
	  var busqueda = document.getElementById("BusquedaOrdenCompra").value;
  	  var y = 5;
  	  var x = 0;
  	  var funcion = "LOC";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#ListaDeOrdenesCompra").html(datos);
	   	PaginarOrdenCompra(x,y);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Orden de Compra II */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Ordenes de Compra para la Selección */
function ListarOrdenCompra(x,y) {
	var busqueda = document.getElementById("BusquedaOrdenCompra").value;
	var funcion = "LOC";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y},
	   success:function(datos)
	   {
	   	$("#ListaDeOrdenesCompra").html(datos);
	   }
	  });
}
/* FIN - Listar Ordenes de Compra para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Ordenes de Compra para la Selección */
function PaginacionOrdenesCompra(seleccion) {
	var busqueda = document.getElementById("BusquedaOrdenCompra").value;
	var y = 5;
	var x = $(seleccion).attr("idpoc") * y;
	var funcion = "LOC";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y},
	   success:function(datos)
	   {
	   	$("#ListaDeOrdenesCompra").html(datos);
	   	PaginarOrdenCompra((x/y),y);
	   }
	  });
}
/* FIN - Paginar Ordenes de Compra para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Ordenes de Compra para la Selección */
function PaginarOrdenCompra(x,y) {
	var busqueda = document.getElementById("BusquedaOrdenCompra").value;
	var funcion = "POC";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y},
	   success:function(datos)
	   {
	   	$("#PaginacionDeOrdenesCompra").html(datos);
	   }
	  });
}
/* FIN - Paginar Ordenes de Compra para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Proveedor */
function MostrarDetalleOrdenCompra(intIdOrdenCompra) {
	var funcion = "SOC";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{intIdOrdenCompra:intIdOrdenCompra,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#ListaDeDetallesOrdenCompra").html(datos);
	   }
	  });
}
/* FIN - Seleccion del Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Proveedor */
function SeleccionarOrdenCompra(seleccion) {
	var intIdOrdenCompra = $(seleccion).attr("idoc");
	var funcion = "SOC";
	  $.ajax({
	   url:"../../datos/inventario/funcion_entrada.php",
	   method:"POST",
	   data:{intIdOrdenCompra:intIdOrdenCompra,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#intIdOrdenCompra").val(intIdOrdenCompra);
	   	AccionOrdenCompra('S');
	   	$("#ListaDeDetallesOrdenCompra").html(datos);
	   }
	  });

}
/* FIN - Seleccion del Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Proveedor */
function AccionOrdenCompra(accion) {
	if(accion == "S"){
		$("#form-busqueda-ordencompra").hide();
		$("#form-productosordencompra").show();
	} else if(accion == "C"){
		$("#form-busqueda-ordencompra").show();
		$("#form-productosordencompra").hide();
	}
}
/* FIN - Seleccion del Proveedor */
//////////////////////////////////////////////////////////////