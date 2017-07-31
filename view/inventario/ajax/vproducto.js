$(document).on('click', '#btn-form-crear-producto', function(){
	  var x = ""; 
	  $.ajax({
	   url:"../../view/inventario/formularios/insertar_producto.php",
	   method:"POST",
	   data:{x:x},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   }
	  });
	 return false;
});
$(document).on('click', '.btn-form-editar-producto', function(){
	  var x = ""; 
	  $.ajax({
	   url:"../../view/inventario/formularios/actualizar_producto.php",
	   method:"POST",
	   data:{x:x},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   }
	  });
	 return false;
});