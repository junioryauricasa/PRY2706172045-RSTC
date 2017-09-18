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
	  var num_filas_comunicacion = document.getElementById('ListaDeComunicaciones').rows.length;
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
	  if(num_filas_comunicacion == 0){
	  	MensajeNormal("Ingresar por lo menos una Comunicación",2);
	  	return false;
	  }
	  $.ajax({
	   url: "../../datos/usuario/funcion_empleado.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okok") {
	   		MensajeNormal("Se agregó correctamente el nuevo Empleado",1);
	   		$('#txt-busqueda').val("");
	   		ListarEmpleado(x,y,tipolistado);
	   		PaginarEmpleado(x,y,tipolistado);
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
	  var num_filas_comunicacion = document.getElementById('ListaDeComunicaciones').rows.length;
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
	  if(num_filas_comunicacion == 0){
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
	   		ListarEmpleado(x,y,tipolistado);
	   		PaginarEmpleado(x,y,tipolistado);
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
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{intIdEmpleado:intIdEmpleado,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") { 
	   		MensajeNormal("Se Eliminó correctamente el Empleado",1);
	   		ListarEmpleado(x,y,tipolistado);
	   		PaginarEmpleado(x,y,tipolistado);
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

function ListarEmpleado(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  $.ajax({
      url:'../../datos/usuario/funcion_empleado.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
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
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeEmpleados").html(datos);
	   	PaginarEmpleado(x,y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Empleado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Empleado */
function PaginarEmpleado(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  $.ajax({
      url:'../../datos/usuario/funcion_empleado.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
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
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeEmpleados").html(datos);
	   	PaginarEmpleado((x/y),y,tipolistado);
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
	  $.ajax({
	   url:"../../datos/usuario/funcion_empleado.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeEmpleados").html(datos);
	   	PaginarEmpleado(x,y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Empleado II */
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
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////