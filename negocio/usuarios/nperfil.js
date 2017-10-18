//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Usuario */
function MostrarUsuarioPerfil(intIdUsuario){
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

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Usuario */
$(document).on('click', '#btn-guardar-usuario', function(){
	  var formData = $("#UserInfoData").serialize();
	  	if(EsNumeroEntero("nvchDNI") == false){
	  		goToBox("#nvchDNI");
	  		return false;
	  	} else if(EsVacio("nvchApellidoPaterno") == false){
	  		goToBox("#nvchApellidoPaterno");
	  		return false;
	  	} else if(EsVacio("nvchApellidoMaterno") == false){
	  		goToBox("#nvchApellidoMaterno");
	  		return false;
	  	} else if(EsVacio("nvchNombres") == false){
	  		goToBox("#nvchNombres");
	  		return false;
	  	}
	  $.ajax({
	   url: "../../datos/usuarios/funcion_usuario.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if(datos == "ok") {
	   		MensajeNormal("Se corrigió correctamente los Datos",1);
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Usuario */
//////////////////////////////////////////////////////////////