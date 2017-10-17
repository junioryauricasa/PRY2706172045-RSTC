//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Usuario */
function MostrarUsuario(intIdUsuario){
  	  var funcion = "MP";
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:{intIdUsuario:intIdUsuario,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#nvchDNI").val(datos.nvchDNI);
	   	$("#nvchRUC").val(datos.nvchRUC);
	   	$("#nvchApellidoPaterno").val(datos.nvchApellidoPaterno);
	   	$("#nvchApellidoMaterno").val(datos.nvchApellidoMaterno);
	   	$("#nvchNombres").val(datos.nvchNombres);
	   	$("#nvchPais").val(datos.nvchPais);
	   	$("#intIdDepartamento").val(datos.intIdDepartamento);
	   	$("#intIdProvincia").val(datos.intIdProvincia);
	   	$("#intIdDistrito").val(datos.intIdDistrito);
	   	$("#nvchDireccion").val(datos.nvchDireccion);
	   }
	  });
}
/* FIN - Funcion Ajax - Mostrar Usuario */
//////////////////////////////////////////////////////////////