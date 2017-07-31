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
	   	if (datos=="ok") { $("#resultadocrud").html("<script>alert('Se Agregó correctamente')</script>");}
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

function refresh_div() {
jQuery.ajax({
	    url:'../../negocio/inventario/selectAllProducto.php',
	    type:'POST',
	    success:function(results) {
	        jQuery("#result").html(results);
	    }
	});
}
t = setInterval(refresh_div,700); //tiempo de refrescado del consulta