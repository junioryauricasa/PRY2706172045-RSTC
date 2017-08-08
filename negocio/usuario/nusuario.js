//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Producto */
$(document).on('click', '#btn-crear-usuario', function(){
	  var formData = $("#form-crear-usuario").serialize();
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/usuario/class_usuario.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") { 
	   		$("#resultadocrud").html("<script>alert('Se Agregó correctamente el registro')</script>");
	   		$('#txt-busqueda').val("");
	   		ListarProducto(x,y,tipolistado);
	   		PaginarProducto(x,y,tipolistado);
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Producto */
$(document).on('click', '.btn-mostrar-usuario', function(){
  	  var intIdProducto = $(this).attr("id");
  	  var funcion = "M";
	  $.ajax({
	   url:"../../datos/usuario/class_usuario.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Usuario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Usuario */
$(document).on('click', '#btn-editar-usuario', function(){
  	  var intIdProducto = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-editar-usuario").serialize();
	  $.ajax({
	   url:"../../datos/usuario/class_usuario.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") { 
	   		$("#resultadocrud").html("<script>alert('Se Actualizó correctamente')</script>");
	   		ListarProducto(x,y,tipolistado);
	   		PaginarProducto(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Actualizar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Eliminar Producto */
$(document).on('click', '.btn-eliminar-usuario', function(){
  	  var intIdProducto = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/usuario/class_usuario.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") { 
	   		$("#resultadocrud").html("<script>alert('Se Eliminó correctamente')</script>");
	   		ListarProducto(x,y,tipolistado);
	   		PaginarProducto(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Producto */

function ListarProducto(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  $.ajax({
      url:'../../datos/usuario/class_usuario.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#ListaDeUsuarios").html(datos);
      }
  });
}

/* FIN - Funcion Ajax - Listar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Producto */

$(document).on('change', '#num-lista', function(){
  	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var funcion = "L";
	  $.ajax({
	   url:"../../datos/usuario/class_usuario.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeUsuarios").html(datos);
	   	PaginarProducto(x,y,tipolistado);
	   }
	  });
	 return false;
});

/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Producto */

function PaginarProducto(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  $.ajax({
      url:'../../datos/usuario/class_usuario.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#PaginacionDeUsuarios").html(datos);
      }
  });
}

/* FIN - Funcion Ajax - Paginar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Página de Lista Producto */

$(document).on('click', '.btn-pagina', function(){
      var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(this).attr("idp") * y;
  	  var funcion = "L";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/usuario/class_usuario.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeUsuarios").html(datos);
	   	PaginarProducto((x/y),y,tipolistado);
	   }
	  });
	 return false;
});

/* FIN - Funcion Ajax - Cambiar Página de Lista Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Producto II */

$(document).on('keyup', '#txt-busqueda', function(){
	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var funcion = "L";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/usuario/class_usuario.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeUsuarios").html(datos);
	   	PaginarProducto(x,y,tipolistado);
	   }
	  });
	 return false;
});

/* FIN - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Producto II */
//////////////////////////////////////////////////////////////