//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crea Producto */
$(document).on('click', '#btn-form-crear-producto', function(){
	  $.ajax({
	   url:"../../view/inventario/formularios/insertar_producto.php",
	   method:'POST',
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Visualizar Formulario Crea Producto */
//////////////////////////////////////////////////////////////