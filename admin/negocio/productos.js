$(document).on('click', '.btnedit', function(){
  	  var producto_idproducto = $(this).attr("id");
	  $.ajax({
	   url:"datos/bd_producto.php",
	   method:"POST",
	   data:{producto_idproducto:producto_idproducto},
	   success:function(data)
	   {
	   	$("#formulario-crud").html(data);
	   }
	  });
	 return false;
});
/*
$(document).on('click', '.botoneditar', function(){
  	  var producto_idproducto = $(this).attr("id");
	  $.ajax({
	   url:"datos/bd_producto.php",
	   method:"POST",
	   data:{producto_idproducto:producto_idproducto},
	   dataType:"json",
	   success:function(data)
	   {
	   	$('#paciente_idpaciente').val(paciente_idpaciente);
	    $('#editar_paciente_dni').val(data.dni);
	    $('#editar_paciente_apellidopaterno').val(data.apellidopaterno);
	    $('#editar_paciente_apellidomaterno').val(data.apellidomaterno);
	    $('#editar_paciente_nombres').val(data.nombres);
	    $('#editar_paciente_fechanacimiento').val(data.fechanacimiento);
	    $('#editar_paciente_correoelectronico').val(data.correoelectronico);
	    $('#editar_paciente_direcciondomicilio').val(data.direcciondomicilio);
	   }
	  });
	 return false;
});
*/