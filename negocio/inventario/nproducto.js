//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Producto */
$(document).on('click', '#btn-crear-producto', function(){
	  var formData = $("#form-crear-producto").serialize();
	  $.ajax({
	   url: "../../datos/inventario/class_producto.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") { $("#resultadocrud").html("<script>alert('Se Agregó correctamente')</script>"); refresh_div();}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Producto */
$(document).on('click', '.btn-mostrar-producto', function(){
  	  var intIdProducto = $(this).attr("id");
  	  var funcion = "M";
	  $.ajax({
	   url:"../../datos/inventario/class_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Producto */
$(document).on('click', '#btn-editar-producto', function(){
  	  var intIdProducto = $(this).attr("id");
  	  var formData = $("#form-editar-producto").serialize();
	  $.ajax({
	   url:"../../datos/inventario/class_producto.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") { $("#resultadocrud").html("<script>alert('Se Actualizó correctamente')</script>");}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Actualizar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Eliminar Producto */
$(document).on('click', '.btn-eliminar-producto', function(){
  	  var intIdProducto = $(this).attr("id");
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/inventario/class_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") { $("#resultadocrud").html("<script>alert('Se Eliminó correctamente')</script>");}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Producto */

function ListarProducto() {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  var x = 0;
  var y = 10;
  $.ajax({
      url:'../../datos/inventario/class_producto.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion},
      success:function(datos) {
          $("#ListaDeProductos").html(datos);
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
  	  var funcion = "L";
	  $.ajax({
	   url:"../../datos/inventario/class_producto.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#ListaDeProductos").html(datos);
	   	PaginarProducto(x,y);
	   }
	  });
	 return false;
});

/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Producto */

function PaginarProducto(x,y) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  $.ajax({
      url:'../../datos/inventario/class_producto.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion},
      success:function(datos) {
          $("#PaginacionDeProductos").html(datos);
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
	  $.ajax({
	   url:"../../datos/inventario/class_producto.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#ListaDeProductos").html(datos);
	   	PaginarProducto((x/y),y);
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
	  $.ajax({
	   url:"../../datos/inventario/class_producto.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#ListaDeProductos").html(datos);
	   	PaginarProducto(x,y);
	   }
	  });
	 return false;
});

/* FIN - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Producto II */
//////////////////////////////////////////////////////////////