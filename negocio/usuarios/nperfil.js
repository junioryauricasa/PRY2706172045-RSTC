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
/* INICIO - Cambiar Contraseña */
$(document).on('click', '#btn-editar-userpassword', function(){
  	  var formData = $("#UserPasswordForm").serialize();
  	  var funcion = "AP";
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente la Contraseña del Usuario",1);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Cambiar Contraseña */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Seleccion de imagen del producto */
$(document).on('change', '#SeleccionImagen', function(){
        var formData = new FormData($("#form-producto")[0]);
        var ruta = "../../datos/inventario/proceso_guardar_imagen.php";
        var anteriorImagen = document.getElementById("nvchDireccionImg").value;
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
		        	document.getElementById("nvchDireccionImg").value = anteriorImagen;
            	}
            	else {
			        document.getElementById("resultadoimagen").src = datos;
			        document.getElementById("nvchDireccionImg").value = datos;
		    	}	
			}
        });
});
/* FIN - Funcion Ajax - Seleccion de imagen del producto */
//////////////////////////////////////////////////////////////