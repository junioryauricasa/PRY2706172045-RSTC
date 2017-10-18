//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Usuario */
$(document).on('click', '#btn-form-crear-usuario', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:'POST',
	   data:{funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	goToBox("#Formulario");
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Visualizar Formulario Crear Usuario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Usuario */
$(document).on('click', '#btn-crear-usuario', function(){
	  var formData = $("#form-usuario").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
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
	   	if(datos == "okok" || datos == "ok") {
	   		MensajeNormal("Se agregó correctamente el nuevo Usuario",1);
	   		$('#txt-busqueda').val("");
	   		ListarUsuario(x,y,tipolistado);
	   		PaginarUsuario(x,y,tipolistado);
	   		$("#btn-form-usuario-remove").click();
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Usuario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Usuario */
$(document).on('click', '.btn-mostrar-usuario', function(){
  	  var intIdUsuario = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:{intIdUsuario:intIdUsuario,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	MostrarComunicacion(intIdUsuario,tipolistado);
	   	goToBox("#Formulario");
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Usuario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Usuario */
$(document).on('click', '#btn-editar-usuario', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-usuario").serialize();
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
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente el Usuario",1);
	   		ListarUsuario(x,y,tipolistado);
	   		PaginarUsuario(x,y,tipolistado);
	   		$("#btn-form-usuario-remove").click();
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Actualizar Usuario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Eliminar Usuario */
$(document).on('click', '.btn-eliminar-usuario', function(){
  	  var intIdUsuario = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:{intIdUsuario:intIdUsuario,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") { 
	   		MensajeNormal("Se Eliminó correctamente el Usuario",1);
	   		ListarUsuario(x,y,tipolistado);
	   		PaginarUsuario(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Usuario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Usuario */

function ListarUsuario(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  $.ajax({
      url:'../../datos/usuarios/funcion_usuario.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#ListaDeUsuarios").html(datos);
      }
  });
}

/* FIN - Funcion Ajax - Listar Usuario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Usuario */
$(document).on('change', '#num-lista', function(){
  	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var funcion = "L";
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeUsuarios").html(datos);
	   	PaginarUsuario(x,y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Usuario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Usuario */
function PaginarUsuario(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  $.ajax({
      url:'../../datos/usuarios/funcion_usuario.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#PaginacionDeUsuarios").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Usuario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Página de Lista Usuario */
$(document).on('click', '.btn-pagina', function(){
      var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(this).attr("idp") * y;
  	  var funcion = "L";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeUsuarios").html(datos);
	   	PaginarUsuario((x/y),y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Página de Lista Usuario */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Usuario II */
$(document).on('keyup', '#txt-busqueda', function(){
	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var funcion = "L";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeUsuarios").html(datos);
	   	PaginarUsuario(x,y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Usuario II */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Seleccion de imagen del Usuario */
$(document).on('change', '#SeleccionImagen', function(){
        var formData = new FormData($("#form-usuario")[0]);
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
/* INICIO - Listar Comunicaciones según Ingresa */
function AgregarComunicacion() {
	if(EsVacio("nvchMedio") == false){
		return false;
	} else if(EsVacio("nvchLugar") == false) {
		return false;
	}
	var nvchMedio = document.getElementById("nvchMedio").value;
	var nvchLugar = document.getElementById("nvchLugar").value;
	var intIdTipoComunicacion = document.getElementById("tipo-comunicacion").value;
	$('#ListaDeComunicaciones').append('<tr>'+
		'<td>'+'<input type="hidden" name="nvchMedio[]" value="'
		+nvchMedio+'"/>'+nvchMedio+'</td>'+
		'<td>'+'<input type="hidden" name="nvchLugar[]" value="'
		+nvchLugar+'"/>'+nvchLugar+'</td>'+
		'<td>'+'<input type="hidden" name="intIdTipoComunicacion[]" value="'
		+intIdTipoComunicacion+'"/>'+$("#tipo-comunicacion option:selected").html()+'</td>'+
		'<td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>'+
		'</tr>');
	RestablecerValidacion('nvchMedio',1);
	RestablecerValidacion('nvchLugar',1);
}
/* FIN - Listar Comunicaciones según Ingresa */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Fila Seleccionada */
function EliminarFila(btn) {
	var fila = btn.parentNode.parentNode;
  	fila.parentNode.removeChild(fila);
}
/* FIN - Eliminar Fila Seleccionada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Comunicaciones del Usuario Seleccionado */
function MostrarComunicacion(intIdUsuario,tipolistado) {
	var funcion = "MC";
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:{intIdUsuario:intIdUsuario,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeComunicaciones").html(datos);
	   }
	  });
}
/* FIN - Mostrar Comunicaciones del Usuario Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Insertar Comunicacion Nueva */
function AgregarComunicacion_II() {
	if(EsVacio("nvchMedio") == false){
		return false;
	} else if(EsVacio("nvchLugar") == false) {
		return false;
	}
	var intIdUsuario = document.getElementById("intIdUsuario").value;
	var nvchMedio = document.getElementById("nvchMedio").value;
	var nvchLugar = document.getElementById("nvchLugar").value;
	var intIdTipoComunicacion = document.getElementById("tipo-comunicacion").value;
	var tipolistado = "I";
	var funcion = "IC";
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:{intIdUsuario:intIdUsuario,
	   		nvchMedio:nvchMedio,
	   		nvchLugar:nvchLugar,
	   		intIdTipoComunicacion:intIdTipoComunicacion,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		MensajeNormal("Se agregó correctamente la nueva Comunicación",1);
	   		MostrarComunicacion(intIdUsuario,tipolistado);
	   		RestablecerValidacion('nvchMedio',1);
			RestablecerValidacion('nvchLugar',1);
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Insertar Comunicacion Nueva */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Actualizar Comunicacion Seleccionado */
function ActualizarComunicacion() {
	if(EsVacio("nvchMedio") == false){
		return false;
	} else if(EsVacio("nvchLugar") == false) {
		return false;
	}
	var intIdComunicacionUsuario = document.getElementById("intIdComunicacionUsuario").value;
	var intIdUsuario = document.getElementById("intIdUsuario").value;
	var nvchMedio = document.getElementById("nvchMedio").value;
	var nvchLugar = document.getElementById("nvchLugar").value;
	var intIdTipoComunicacion = document.getElementById("tipo-comunicacion").value;
	var tipolistado = "A";
	var accion = "I";
	var funcion = "AC";
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:{intIdComunicacionUsuario:intIdComunicacionUsuario,
	   		intIdUsuario:intIdUsuario,
	   		nvchMedio:nvchMedio,
	   		nvchLugar:nvchLugar,
	   		intIdTipoComunicacion:intIdTipoComunicacion,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		MensajeNormal("Se agregó correctamente la Comunicacion",1);
	   		MostrarComunicacion(intIdUsuario,tipolistado);
	   		BotonesComunicacion(accion);
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Actualizar Comunicacion Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Comunicacion Seleccionado */
function SeleccionarComunicacion(seleccion) {
	var intIdComunicacionUsuario = $(seleccion).attr("idcu");
	var funcion = "SC";
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:{intIdComunicacionUsuario:intIdComunicacionUsuario,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#nvchMedio").val(datos.nvchMedio);
	   	$("#nvchLugar").val(datos.nvchLugar);
	   	$("#tipo-comunicacion").val(datos.intIdTipoComunicacion);
	   	$("#intIdComunicacionUsuario").val(datos.intIdComunicacionUsuario);
	   	BotonesComunicacion('A');
	   }
	  });
}
/* FIN - Mostrar Comunicacion Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Comunicacion Seleccionado */
function EliminarComunicacion(seleccion) {
	var intIdComunicacionUsuario = $(seleccion).attr("idcu");
	var funcion = "EC";
	var tipolistado = "T";
	var intIdUsuario = $("#intIdUsuario").val();
	  $.ajax({
	   url:"../../datos/usuarios/funcion_usuario.php",
	   method:"POST",
	   data:{intIdComunicacionUsuario:intIdComunicacionUsuario,funcion:funcion},
	   success:function(datos)
	   {
	   	 if(datos=="ok"){
	   	 	MensajeNormal("Se eliminó correctamente la Comunicación",1);
	   	 	MostrarComunicacion(intIdUsuario,tipolistado);
	   	 }
	   }
	  });
}
/* FIN - Eliminar Comunicacion Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function BotonesComunicacion(accion) {
	if(accion == "I"){
		RestablecerValidacion('nvchMedio',1);
		RestablecerValidacion('nvchLugar',1);
		$("#btn-agregar-comunicacion").show();
		$("#btn-actualizar-comunicacion").hide();
		$("#btn-cancelar-comunicacion").hide();
	} else if (accion == "A") {
		RestablecerValidacion('nvchMedio',2);
		RestablecerValidacion('nvchLugar',2);
		$("#btn-agregar-comunicacion").hide();
		$("#btn-actualizar-comunicacion").show();
		$("#btn-cancelar-comunicacion").show();
	}
}
/* FIN - Ocultar Botones */
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