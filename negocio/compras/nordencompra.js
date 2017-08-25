//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Proveedor */
$(document).on('click', '#btn-form-crear-ordencompra', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:'POST',
	   data:{funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Visualizar Formulario Crear Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Proveedor */
$(document).on('click', '#btn-crear-ordencompra', function(){
	  var formData = $("#form-ordencompra").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/compras/funcion_ordencompra.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okok") {
	   		$("#resultadocrud").html("<script>alert('Se Agregó correctamente')</script>");
	   		$('#txt-busqueda').val("");
	   		ListarOrdenCompra(x,y,tipolistado);
	   		PaginarOrdenCompra(x,y,tipolistado);
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Proveedor */
$(document).on('click', '.btn-mostrar-ordencompra', function(){
  	  var intIdOrdenCompra = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{intIdOrdenCompra:intIdOrdenCompra,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	MostrarDetalleOrdenCompra(intIdOrdenCompra,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Proveedor */
$(document).on('click', '#btn-editar-ordencompra', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-ordencompra").serialize();
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		$("#resultadocrud").html("<script>alert('Se Actualizó correctamente')</script>");
	   		ListarOrdenCompra(x,y,tipolistado);
	   		PaginarOrdenCompra(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Actualizar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Eliminar Proveedor */
$(document).on('click', '.btn-eliminar-ordencompra', function(){
  	  var intIdOrdenCompra = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{intIdOrdenCompra:intIdOrdenCompra,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") { 
	   		$("#resultadocrud").html("<script>alert('Se Eliminó correctamente')</script>");
	   		ListarOrdenCompra(x,y,tipolistado);
	   		PaginarOrdenCompra(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Proveedor */

function ListarOrdenCompra(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  $.ajax({
      url:'../../datos/compras/funcion_ordencompra.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#ListaDeProveedores").html(datos);
      }
  });
}

/* FIN - Funcion Ajax - Listar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Proveedor */

$(document).on('change', '#num-lista', function(){
  	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var funcion = "L";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeProveedores").html(datos);
	   	PaginarOrdenCompra(x,y,tipolistado);
	   }
	  });
	 return false;
});

/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Proveedor */

function PaginarOrdenCompra(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  $.ajax({
      url:'../../datos/compras/funcion_ordencompra.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#PaginacionDeOrdenCompra").html(datos);
      }
  });
}

/* FIN - Funcion Ajax - Paginar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Página de Lista Proveedor */

$(document).on('click', '.btn-pagina', function(){
      var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(this).attr("idp") * y;
  	  var funcion = "L";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeProveedores").html(datos);
	   	PaginarOrdenCompra((x/y),y,tipolistado);
	   }
	  });
	 return false;
});

/* FIN - Funcion Ajax - Cambiar Página de Lista Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Proveedor II */

$(document).on('keyup', '#txt-busqueda', function(){
	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var funcion = "L";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeProveedores").html(datos);
	   	PaginarOrdenCompra(x,y,tipolistado);
	   }
	  });
	 return false;
});

/* FIN - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Proveedor II */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Proveedor*/

$(document).on('keyup', '#BusquedaProveedor', function(){
	  var busqueda = document.getElementById("BusquedaProveedor").value;
  	  var y = 5;
  	  var x = 0;
  	  var funcion = "MPD";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#ListaDeProveedoresSeleccion").html(datos);
	   	PaginarProveedoresSeleccion((x/y),y);
	   }
	  });
	 return false;
});

/* FIN - Funcion Ajax - Buscar Elemento Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Proveedor */
function SeleccionarProveedor(seleccion) {
	var intIdProveedor = $(seleccion).attr("idsprd");
	var funcion = "SPD";
	  $.ajax({
	   url:"../../datos/compras/funcion_ordencompra.php",
	   method:"POST",
	   data:{intIdProveedor:intIdProveedor,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#intIdProveedor").val(datos.intIdProveedor);
	   	$("#nvchRUC").val(datos.nvchRUC);
	   	$("#nvchDNI").val(datos.nvchDNI);
	   	$("#nvchRazonSocial").val(datos.nvchRazonSocial);
	   	$("#nvchApellidoPaterno").val(datos.nvchApellidoPaterno);
	   	$("#nvchApellidoMaterno").val(datos.nvchApellidoMaterno);
	   	$("#nvchNombres").val(datos.nvchNombres);
	   	MostrarSeleccionProveedor(datos.intIdTipoPersona);
	   }
	  });
}
/* FIN - Seleccion del Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Proveedor */
function MostrarSeleccionProveedor(intIdTipoPersona) {
	  AccionSeleccionProveedores('M');
	  if(intIdTipoPersona == 1){
	  	$(".nvchDNI").hide();
      	$(".nvchApellidoPaterno").hide();
      	$(".nvchApellidoMaterno").hide();
      	$(".nvchNombres").hide();
      	$(".nvchRUC").show();
      	$(".nvchRazonSocial").show();
	  } else if(intIdTipoPersona == 2){
	  	$(".nvchDNI").show();
      	$(".nvchApellidoPaterno").show();
      	$(".nvchApellidoMaterno").show();
      	$(".nvchNombres").show();
      	$(".nvchRUC").show();
      	$(".nvchRazonSocial").hide();
	  }
}
/* FIN - Seleccion del Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
function AccionSeleccionProveedores(funcion) {
	  if(funcion == 'S'){
	  	$("#TablaDeProveedores").show();
      	$("#DatosDelProveedor").hide();
	  } else if(funcion == 'M'){
	  	$("#TablaDeProveedores").hide();
      	$("#DatosDelProveedor").show();
	  }
}
/* FIN - Seleccion del Proveedor */
//////////////////////////////////////////////////////////////