//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crea Producto */
$(document).on('click', '#btn-form-crear-usuario', function(){
	  $.ajax({
	   url:"../../view/usuario/formularios/insertar_usuario.php",
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