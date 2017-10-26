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
	   	$("#resultadoimagen").attr("src", "../../usuarios/imgperfil/" + datos.nvchImgPerfil);
	   	$("#nvchImgPerfil").val(datos.nvchImgPerfil);
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
	   		MensajeNormal("Se guardó correctamente los Datos",1);
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Usuario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function ComprobarPassword() {
	var nvchUserPassword = $("#nvchUserPassword").val();
	var nvchUserPasswordRep = $("#nvchUserPasswordRep").val();
	if(nvchUserPasswordRep == ""){
		$("#nvchUserPasswordRepGroup").attr("class","form-group");
	    $("#nvchUserPasswordRepIcono").attr({"class":"", "aria-hidden":""});
	    $("#nvchUserPasswordRepObs").html("");
	    return false;
	}
	if(nvchUserPassword === nvchUserPasswordRep) {
		$("#nvchUserPasswordRepGroup").attr("class","form-group has-success has-feedback");
	    $("#nvchUserPasswordRepIcono").attr({"class":"glyphicon glyphicon-ok form-control-feedback", "aria-hidden":"true"});
	    $("#nvchUserPasswordRepObs").html("");
	} else {
		$("#nvchUserPasswordRepGroup").attr("class","form-group has-error has-feedback");
	    $("#nvchUserPasswordRepIcono").attr({"class":"glyphicon glyphicon-remove form-control-feedback", "aria-hidden":"true"});
	    $("#nvchUserPasswordRepObs").attr("class","text-danger");
	    $("#nvchUserPasswordRepObs").html("La contraseña no concuerda");
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Seleccion de imagen del Usuario */
$(document).on('change', '#SeleccionImagen', function(){
        var formData = new FormData($("#form-img-perfil")[0]);
        var ruta = "../../datos/usuarios/proceso_guardar_imagen.php";
        var anteriorImagen = document.getElementById("nvchImgPerfil").value;
        $.ajax({
            url: ruta,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos)
            {
            	if(datos=="blank"){
            		document.getElementById("resultadoimagen").src = anteriorImagen;
		        	document.getElementById("nvchImgPerfil").value = anteriorImagen;
            	}
            	else {
			        document.getElementById("resultadoimagen").src = datos;
			        document.getElementById("nvchImgPerfil").value = datos;
		    	}	
			}
        });
});
/* FIN - Funcion Ajax - Seleccion de imagen del Usuario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Cambiar Contraseña */
$(document).on('click', '#btn-editar-imgperfil', function(){
  	  var formData = $("#form-img-perfil").serialize();
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:formData,
	   dataType:"json",
	   success:function(datos)
	   {
	   	if (datos.resultado == "ok") {
	   		MensajeNormal("Se modificó correctamente la Imagen de Perfil",1);
	   		$(".imgperfil").attr("src", "../../usuarios/imgperfil/" + datos.nvchImgPerfil);
	   	} else { 
	   		$("#resultadoimg").html(datos.resultado); 
	   	}
	   }
	  });
	 return false;
});
/* FIN - Cambiar Contraseña */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function ComprobarPassword() {
	var nvchUserPassword = $("#nvchUserPassword").val();
	var nvchUserPasswordRep = $("#nvchUserPasswordRep").val();
	if(nvchUserPasswordRep == ""){
	    $("#nvchUserPasswordRepObs").html("");
	    return false;
	}
	if(nvchUserPassword === nvchUserPasswordRep) {
	    $("#nvchUserPasswordRepObs").html("");
	} else {
	    $("#nvchUserPasswordRepObs").attr("class","text-danger");
	    $("#nvchUserPasswordRepObs").html("La contraseña no concuerda");
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Cambiar Contraseña */
$(document).on('click', '#btn-editar-userpassword', function(){
	var nvchUserPasswordAnt = $("#nvchUserPasswordAnt").val();
	if(nvchUserPasswordAnt == ""){
	 MensajeNormal("Ingresar su Contraseña Anterior",2);
	 return false;
	}
	var nvchUserPassword = $("#nvchUserPassword").val();
	var nvchUserPasswordRep = $("#nvchUserPasswordRep").val();
	if(nvchUserPassword === nvchUserPasswordRep) {
  	  var formData = $("#form-user-password").serialize();
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente la Contraseña del Usuario",1);
	   		$("#nvchUserPasswordRep").val("");
	   		$("#nvchUserPassword").val("");
	   		$("#nvchUserPasswordAnt").val("");
	   	}
	   	else { MensajeNormal(datos,3); }
	   }
	  });
	 return false;
	 } else {
		MensajeNormal("Las contraseñas no coinciden",2);
	 	return false;
	}
});
/* FIN - Cambiar Contraseña */
//////////////////////////////////////////////////////////////