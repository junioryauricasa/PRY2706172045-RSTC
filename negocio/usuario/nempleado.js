//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Empleado */
$(document).on('click', '#btn-form-crear-empleado', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
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
/* FIN - Funcion Ajax - Visualizar Formulario Crear Empleado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Empleado */
$(document).on('click', '#btn-crear-empleado', function(){
	  var formData = $("#form-empleado").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
  	  var intIdTipoPersona = document.getElementById("tipo-persona").value;
	  var num_filas_domicilio = document.getElementById('ListaDeDomicilios').rows.length;
	  var num_filas_comunicacion = document.getElementById('ListaDeComunicaciones').rows.length;
	  if(intIdTipoPersona == 1){
	  	if(EsNumeroEntero("nvchRUC") == false){
	  		goToBox("#nvchRUC");
	  		return false;
	  	} else if(EsVacio("nvchRazonSocial") == false){
	  		goToBox("#nvchRazonSocial");
	  		return false;
	  	}
	  } else if(intIdTipoPersona == 2){
	  	if(EsNumeroEntero("nvchRUC") == false){
	  		goToBox("#nvchRUC");
	  		return false;
	  	} else if(EsNumeroEntero("nvchDNI") == false){
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
	  } 
	  if(num_filas_domicilio == 0){
	  	MensajeNormal("Ingrese por lo menos un Domicilio Fiscal",2);
	  	return false;
	  } else if(num_filas_comunicacion == 0){
	  	MensajeNormal("Ingresar por lo menos una Comunicación",2);
	  	return false;
	  }
	  $.ajax({
	   url: "../../datos/usuario/funcion_empleado.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okokok") {
	   		MensajeNormal("Se agregó correctamente el nuevo Empleado",1);
	   		$('#txt-busqueda').val("");
	   		ListarEmpleado(x,y,tipolistado,intIdTipoPersona);
	   		PaginarEmpleado(x,y,tipolistado,intIdTipoPersona);
	   		$("#lista-persona").val($("#tipo-persona").val());
	   		$("#btn-form-empleado-remove").click();
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Empleado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Empleado */
$(document).on('click', '.btn-mostrar-empleado', function(){
  	  var intIdEmpleado = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdEmpleado:intIdEmpleado,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	$("#tipo-persona").val($("#intIdTipoPersona").val());
	   	MostrarTipoPersona();
	   	MostrarDomicilio(intIdEmpleado,tipolistado);
	   	MostrarComunicacion(intIdEmpleado,tipolistado);
	   	goToBox("#Formulario");
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Empleado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Empleado */
$(document).on('click', '#btn-editar-empleado', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-empleado").serialize();
  	  var intIdTipoPersona = document.getElementById("tipo-persona").value;
  	  var num_filas_domicilio = document.getElementById('ListaDeDomicilios').rows.length;
	  var num_filas_comunicacion = document.getElementById('ListaDeComunicaciones').rows.length;
	  if(num_filas_domicilio == 0){
	  	MensajeNormal("Ingrese por lo menos un Domicilio Fiscal",2);
	  	return false;
	  } else if(num_filas_comunicacion == 0){
	  	MensajeNormal("Ingresar por lo menos una Comunicación",2);
	  	return false;
	  }
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente el Empleado",1);
	   		ListarEmpleado(x,y,tipolistado,intIdTipoPersona);
	   		PaginarEmpleado(x,y,tipolistado,intIdTipoPersona);
	   		$("#lista-persona").val($("#tipo-persona").val());
	   		$("#btn-form-empleado-remove").click();
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Actualizar Empleado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Eliminar Empleado */
$(document).on('click', '.btn-eliminar-empleado', function(){
  	  var intIdEmpleado = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdEmpleado:intIdEmpleado,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") { 
	   		MensajeNormal("Se Eliminó correctamente el Empleado",1);
	   		ListarEmpleado(x,y,tipolistado,intIdTipoPersona);
	   		PaginarEmpleado(x,y,tipolistado,intIdTipoPersona);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Empleado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Empleado */

function ListarEmpleado(x,y,tipolistado,intIdTipoPersona) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  $.ajax({
      url:'../../datos/usuario/funcion_empleado.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
      intIdTipoPersona:intIdTipoPersona},
      success:function(datos) {
          $("#ListaDeEmpleados").html(datos);
      }
  });
}

/* FIN - Funcion Ajax - Listar Empleado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Empleado */
$(document).on('change', '#num-lista', function(){
  	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var funcion = "L";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
	   intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeEmpleados").html(datos);
	   	PaginarEmpleado(x,y,tipolistado,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Empleado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Empleado */
$(document).on('change', '#lista-persona', function(){
  	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var funcion = "L";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
  	  if(intIdTipoPersona == 1){
  	  	$(".ListaDNI").hide();
  	  	$(".ListaRUC").show();
  	  	$(".ListaRazonSocial").show();
  	  	$(".ListaApellidoPaterno").hide();
  	  	$(".ListaApellidoMaterno").hide();
  	  	$(".ListaNombres").hide();
  	  } else if(intIdTipoPersona == 2){
  	  	$(".ListaDNI").show();
  	  	$(".ListaRUC").show();
  	  	$(".ListaRazonSocial").hide();
  	  	$(".ListaApellidoPaterno").show();
  	  	$(".ListaApellidoMaterno").show();
  	  	$(".ListaNombres").show();
  	  }
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
	   	intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeEmpleados").html(datos);
	   	PaginarEmpleado(x,y,tipolistado,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Empleado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Empleado */
function PaginarEmpleado(x,y,tipolistado,intIdTipoPersona) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  $.ajax({
      url:'../../datos/usuario/funcion_empleado.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
      intIdTipoPersona:intIdTipoPersona},
      success:function(datos) {
          $("#PaginacionDeEmpleados").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Empleado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Página de Lista Empleado */
$(document).on('click', '.btn-pagina', function(){
      var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(this).attr("idp") * y;
  	  var funcion = "L";
  	  var tipolistado = "T";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
	   	intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeEmpleados").html(datos);
	   	PaginarEmpleado((x/y),y,tipolistado,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Página de Lista Empleado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Empleado II */
$(document).on('keyup', '#txt-busqueda', function(){
	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var funcion = "L";
  	  var tipolistado = "T";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
	   	intIdTipoPersona,intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeEmpleados").html(datos);
	   	PaginarEmpleado(x,y,tipolistado,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Empleado II */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Campos de acuerdo al Tipo de Persona */
function MostrarTipoPersona() {
  var tipo_persona = document.getElementById("tipo-persona").value;
      if(tipo_persona == "1"){
      	$(".nvchDNI").hide();
      	$(".nvchApellidoPaterno").hide();
      	$(".nvchApellidoMaterno").hide();
      	$(".nvchNombres").hide();
      	$(".nvchRUC").show();
      	$(".nvchRazonSocial").show();
      } else if(tipo_persona == "2"){
      	$(".nvchDNI").show();
      	$(".nvchApellidoPaterno").show();
      	$(".nvchApellidoMaterno").show();
      	$(".nvchNombres").show();
      	$(".nvchRUC").show();
      	$(".nvchRazonSocial").hide();
      }
}
/* FIN - Mostrar Campos de acuerdo al Tipo de Persona */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Domicilios según Ingresa */
function AgregarDomicilio() {
	var nvchPais = document.getElementById("nvchPais").value;
	var nvchRegion = document.getElementById("nvchRegion").value;
	var nvchProvincia = document.getElementById("nvchProvincia").value;
	var nvchDistrito = document.getElementById("nvchDistrito").value;
	var nvchDireccion = document.getElementById("nvchDireccion").value;
	var intIdTipoDomicilio = document.getElementById("tipo-domicilio").value;
	var validacion = true;
	$('#ListaDeDomicilios tr').each(function(){
        if($(this).find('td').eq(5).text() == 'Fiscal'){
            validacion = false;
        }
    });
	if(EsLetra("nvchPais") == false){
		return false;
	} else if(EsLetra("nvchRegion") == false) {
		return false;
	} else if(EsLetra("nvchProvincia") == false) {
		return false;
	} else if(EsLetra("nvchDistrito") == false) {
		return false;
	} else if(EsVacio("nvchDireccion") == false) {
		return false;
	} else if(validacion == false){
    	if (intIdTipoDomicilio == 1) {
	    	MensajeNormal("No puede haber más de un Domicilio Fiscal",2);
	    	return false;
    	}
    }
	$('#ListaDeDomicilios').append('<tr>'+
		'<td>'+'<input type="hidden" name="nvchPais[]" value="'+
		nvchPais+'"/>'+nvchPais+'</td>'+
		'<td>'+'<input type="hidden" name="nvchRegion[]" value="'+
		nvchRegion+'"/>'+nvchRegion+'</td>'+
		'<td>'+'<input type="hidden" name="nvchProvincia[]" value="'+
		nvchProvincia+'"/>'+nvchProvincia+'</td>'+
		'<td>'+'<input type="hidden" name="nvchDistrito[]" value="'+
		nvchDistrito+'"/>'+nvchDistrito+'</td>'+
		'<td>'+'<input type="hidden" name="nvchDireccion[]" value="'+
		nvchDireccion+'"/>'+nvchDireccion+'</td>'+
		'<td>'+'<input type="hidden" name="intIdTipoDomicilio[]" value="'+
		intIdTipoDomicilio+'"/>'+$("#tipo-domicilio option:selected").html()+'</td>'+
		'<td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>'+
		'</tr>');
	RestablecerValidacion('nvchPais',1);
	RestablecerValidacion('nvchRegion',1);
	RestablecerValidacion('nvchProvincia',1);
	RestablecerValidacion('nvchDistrito',1);
	RestablecerValidacion('nvchDireccion',1);
}
/* FIN - Listar Domicilios según Ingresa */
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
/* INICIO - Mostrar Domicilios del Empleado Seleccionado */
function MostrarDomicilio(intIdEmpleado,tipolistado) {
	var funcion = "MD";
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdEmpleado:intIdEmpleado,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeDomicilios").html(datos);
	   }
	  });
}
/* FIN - Mostrar Domicilios del Empleado Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Comunicaciones del Empleado Seleccionado */
function MostrarComunicacion(intIdEmpleado,tipolistado) {
	var funcion = "MC";
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdEmpleado:intIdEmpleado,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeComunicaciones").html(datos);
	   }
	  });
}
/* FIN - Mostrar Comunicaciones del Empleado Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Insertar Comunicacion Nueva */
function AgregarComunicacion_II() {
	if(EsVacio("nvchMedio") == false){
		return false;
	} else if(EsVacio("nvchLugar") == false) {
		return false;
	}
	var intIdEmpleado = document.getElementById("intIdEmpleado").value;
	var nvchMedio = document.getElementById("nvchMedio").value;
	var nvchLugar = document.getElementById("nvchLugar").value;
	var intIdTipoComunicacion = document.getElementById("tipo-comunicacion").value;
	var tipolistado = "I";
	var funcion = "IC";
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdEmpleado:intIdEmpleado,
	   		nvchMedio:nvchMedio,
	   		nvchLugar:nvchLugar,
	   		intIdTipoComunicacion:intIdTipoComunicacion,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		MensajeNormal("Se agregó correctamente la nueva Comunicación",1);
	   		MostrarComunicacion(intIdEmpleado,tipolistado);
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
/* INICIO - Insertar Domicilio Nuevo */
function AgregarDomicilio_II() {
	var intIdEmpleado = document.getElementById("intIdEmpleado").value;
	var nvchPais = document.getElementById("nvchPais").value;
	var nvchRegion = document.getElementById("nvchRegion").value;
	var nvchProvincia = document.getElementById("nvchProvincia").value;
	var nvchDistrito = document.getElementById("nvchDistrito").value;
	var nvchDireccion = document.getElementById("nvchDireccion").value;
	var intIdTipoDomicilio = document.getElementById("tipo-domicilio").value;
	var validacion = true;
	$('#ListaDeDomicilios tr').each(function(){
        if($(this).find('td').eq(5).text() == 'Fiscal'){
            validacion = false;
        }
    });
	if(EsLetra("nvchPais") == false){
		return false;
	} else if(EsLetra("nvchRegion") == false) {
		return false;
	} else if(EsLetra("nvchProvincia") == false) {
		return false;
	} else if(EsLetra("nvchDistrito") == false) {
		return false;
	} else if(EsVacio("nvchDireccion") == false) {
		return false;
	} else if(validacion == false){
    	if (intIdTipoDomicilio == 1) {
	    	MensajeNormal("No puede haber más de un Domicilio Fiscal",2);
	    	return false;
    	}
    }
	var tipolistado = "I";
	var funcion = "ID";
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdEmpleado:intIdEmpleado,
	   		nvchPais:nvchPais,
	   		nvchRegion:nvchRegion,
	   		nvchProvincia:nvchProvincia,
	   		nvchDistrito:nvchDistrito,
	   		nvchDireccion:nvchDireccion,
	   		intIdTipoDomicilio:intIdTipoDomicilio,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		MensajeNormal("Se agregó correctamente el nuevo Domicilio",1);
	   		MostrarDomicilio(intIdEmpleado,tipolistado);
	   		RestablecerValidacion('nvchPais',1);
			RestablecerValidacion('nvchRegion',1);
			RestablecerValidacion('nvchProvincia',1);
			RestablecerValidacion('nvchDistrito',1);
			RestablecerValidacion('nvchDireccion',1);
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Insertar Domicilio Nuevo */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Actualizar Comunicacion Seleccionado */
function ActualizarComunicacion() {
	if(EsVacio("nvchMedio") == false){
		return false;
	} else if(EsVacio("nvchLugar") == false) {
		return false;
	}
	var intIdComunicacionEmpleado = document.getElementById("intIdComunicacionEmpleado").value;
	var intIdEmpleado = document.getElementById("intIdEmpleado").value;
	var nvchMedio = document.getElementById("nvchMedio").value;
	var nvchLugar = document.getElementById("nvchLugar").value;
	var intIdTipoComunicacion = document.getElementById("tipo-comunicacion").value;
	var tipolistado = "A";
	var accion = "I";
	var funcion = "AC";
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdComunicacionEmpleado:intIdComunicacionEmpleado,
	   		intIdEmpleado:intIdEmpleado,
	   		nvchMedio:nvchMedio,
	   		nvchLugar:nvchLugar,
	   		intIdTipoComunicacion:intIdTipoComunicacion,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		MensajeNormal("Se agregó correctamente la Comunicacion",1);
	   		MostrarComunicacion(intIdEmpleado,tipolistado);
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
/* INICIO - Actualizar Domicilio Seleccionado */
function ActualizarDomicilio() {
	var intIdDomicilioEmpleado = document.getElementById("intIdDomicilioEmpleado").value;
	var intIdEmpleado = document.getElementById("intIdEmpleado").value;
	var nvchPais = document.getElementById("nvchPais").value;
	var nvchRegion = document.getElementById("nvchRegion").value;
	var nvchProvincia = document.getElementById("nvchProvincia").value;
	var nvchDistrito = document.getElementById("nvchDistrito").value;
	var nvchDireccion = document.getElementById("nvchDireccion").value;
	var intIdTipoDomicilio = document.getElementById("tipo-domicilio").value;
	var validacion = true;
	$('#ListaDeDomicilios tr').each(function(){
        if($(this).find('td').eq(5).text() == 'Fiscal'){
            validacion = false;
        }
    });
	if(EsLetra("nvchPais") == false){
		return false;
	} else if(EsLetra("nvchRegion") == false) {
		return false;
	} else if(EsLetra("nvchProvincia") == false) {
		return false;
	} else if(EsLetra("nvchDistrito") == false) {
		return false;
	} else if(EsVacio("nvchDireccion") == false) {
		return false;
	} else if(validacion == false){
    	if (intIdTipoDomicilio == 1) {
	    	MensajeNormal("No puede haber más de un Domicilio Fiscal",2);
	    	return false;
    	}
    }
	var tipolistado = "A";
	var accion = "I";
	var funcion = "AD";
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdDomicilioEmpleado:intIdDomicilioEmpleado,
	   		intIdEmpleado:intIdEmpleado,
	   		nvchPais:nvchPais,
	   		nvchRegion:nvchRegion,
	   		nvchProvincia:nvchProvincia,
	   		nvchDistrito:nvchDistrito,
	   		nvchDireccion:nvchDireccion,
	   		intIdTipoDomicilio:intIdTipoDomicilio,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		MensajeNormal("Se modificó correctamente el Domicilio",1);
	   		MostrarDomicilio(intIdEmpleado,tipolistado);
	   		BotonesDomicilio(accion);
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
}
/* FIN - Actualizar Domicilio Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Domicilio Seleccionado */
function SeleccionarDomicilio(seleccion) {
	var intIdDomicilioEmpleado = $(seleccion).attr("iddcl");
	var funcion = "SD";
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdDomicilioEmpleado:intIdDomicilioEmpleado,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#nvchPais").val(datos.nvchPais);
	   	$("#nvchRegion").val(datos.nvchRegion);
	   	$("#nvchProvincia").val(datos.nvchProvincia);
	   	$("#nvchDistrito").val(datos.nvchDistrito);
	   	$("#nvchDireccion").val(datos.nvchDireccion);
	   	$("#tipo-domicilio").val(datos.intIdTipoDomicilio);
	   	$("#intIdDomicilioEmpleado").val(datos.intIdDomicilioEmpleado);
	   	BotonesDomicilio('A');
	   }
	  });
}
/* FIN - Mostrar Domicilio Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Comunicacion Seleccionado */
function SeleccionarComunicacion(seleccion) {
	var intIdComunicacionEmpleado = $(seleccion).attr("idccl");
	var funcion = "SC";
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdComunicacionEmpleado:intIdComunicacionEmpleado,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#nvchMedio").val(datos.nvchMedio);
	   	$("#nvchLugar").val(datos.nvchLugar);
	   	$("#tipo-comunicacion").val(datos.intIdTipoComunicacion);
	   	$("#intIdComunicacionEmpleado").val(datos.intIdComunicacionEmpleado);
	   	BotonesComunicacion('A');
	   }
	  });
}
/* FIN - Mostrar Comunicacion Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Comunicacion Seleccionado */
function EliminarDomicilio(seleccion) {
	var intIdDomicilioEmpleado = $(seleccion).attr("iddcl");
	var funcion = "ED";
	var tipolistado = "T";
	var intIdEmpleado = $("#intIdEmpleado").val();
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdDomicilioEmpleado:intIdDomicilioEmpleado,funcion:funcion},
	   success:function(datos)
	   {
	   	 if(datos=="ok"){
	   	 	MensajeNormal("Se eliminó correctamente el Domicilio",1);
	   	 	MostrarDomicilio(intIdEmpleado,tipolistado);
	   	 }
	   }
	  });
}

/* FIN - Eliminar Comunicacion Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Comunicacion Seleccionado */

function EliminarComunicacion(seleccion) {
	var intIdComunicacionEmpleado = $(seleccion).attr("idccl");
	var funcion = "EC";
	var tipolistado = "T";
	var intIdEmpleado = $("#intIdEmpleado").val();
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdComunicacionEmpleado:intIdComunicacionEmpleado,funcion:funcion},
	   success:function(datos)
	   {
	   	 if(datos=="ok"){
	   	 	MensajeNormal("Se eliminó correctamente la Comunicación",1);
	   	 	MostrarComunicacion(intIdEmpleado,tipolistado);
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
function BotonesDomicilio(accion) {
	if(accion == "I"){
		RestablecerValidacion('nvchPais',1);
		RestablecerValidacion('nvchRegion',1);
		RestablecerValidacion('nvchProvincia',1);
		RestablecerValidacion('nvchDistrito',1);
		RestablecerValidacion('nvchDireccion',1);
		$("#btn-agregar-domicilio").show();
		$("#btn-actualizar-domicilio").hide();
		$("#btn-cancelar-domicilio").hide();
	} else if (accion == "A") {
		RestablecerValidacion('nvchPais',2);
		RestablecerValidacion('nvchRegion',2);
		RestablecerValidacion('nvchProvincia',2);
		RestablecerValidacion('nvchDistrito',2);
		RestablecerValidacion('nvchDireccion',2);
		$("#btn-agregar-domicilio").hide();
		$("#btn-actualizar-domicilio").show();
		$("#btn-cancelar-domicilio").show();
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function AccionCabecerasTabla(intIdTipoPersona) {
	if(intIdTipoPersona == "1"){
		$(".ListaDNI").hide();
  	  	$(".ListaRUC").show();
  	  	$(".ListaRazonSocial").show();
  	  	$(".ListaApellidoPaterno").hide();
  	  	$(".ListaApellidoMaterno").hide();
  	  	$(".ListaNombres").hide();
	} else if (intIdTipoPersona == "2") {
		$(".ListaDNI").show();
  	  	$(".ListaRUC").show();
  	  	$(".ListaRazonSocial").hide();
  	  	$(".ListaApellidoPaterno").show();
  	  	$(".ListaApellidoMaterno").show();
  	  	$(".ListaNombres").show();
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////