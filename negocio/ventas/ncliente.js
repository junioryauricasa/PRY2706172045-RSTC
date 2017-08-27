//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Proveedor */
$(document).on('click', '#btn-form-crear-cliente', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:'POST',
	   data:{funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Visualizar Formulario Crear Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Proveedor */
$(document).on('click', '#btn-crear-cliente', function(){
	  var formData = $("#form-cliente").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
  	  var intIdTipoPersona = document.getElementById("tipo-persona").value;
	  $.ajax({
	   url: "../../datos/ventas/funcion_cliente.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okokok") {
	   		$("#resultadocrud").html("<script>alert('Se Agregó correctamente')</script>");
	   		$('#txt-busqueda').val("");
	   		ListarCliente(x,y,tipolistado,intIdTipoPersona);
	   		PaginarCliente(x,y,tipolistado,intIdTipoPersona);
	   		$("#lista-persona").val($("#tipo-persona").val());
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Proveedor */
$(document).on('click', '.btn-mostrar-cliente', function(){
  	  var intIdCliente = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{intIdCliente:intIdCliente,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	$("#tipo-persona").val($("#intIdTipoPersona").val());
	   	MostrarTipoPersona();
	   	MostrarDomicilio(intIdCliente,tipolistado);
	   	MostrarComunicacion(intIdCliente,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Proveedor */
$(document).on('click', '#btn-editar-cliente', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-cliente").serialize();
  	  var intIdTipoPersona = document.getElementById("tipo-persona").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		$("#resultadocrud").html("<script>alert('Se Actualizó correctamente')</script>");
	   		ListarCliente(x,y,tipolistado,intIdTipoPersona);
	   		PaginarCliente(x,y,tipolistado,intIdTipoPersona);
	   		$("#lista-persona").val($("#tipo-persona").val());
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Actualizar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Eliminar Proveedor */
$(document).on('click', '.btn-eliminar-cliente', function(){
  	  var intIdCliente = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{intIdCliente:intIdCliente,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") { 
	   		$("#resultadocrud").html("<script>alert('Se Eliminó correctamente')</script>");
	   		ListarCliente(x,y,tipolistado,intIdTipoPersona);
	   		PaginarCliente(x,y,tipolistado,intIdTipoPersona);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Proveedor */

function ListarCliente(x,y,tipolistado,intIdTipoPersona) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  $.ajax({
      url:'../../datos/ventas/funcion_cliente.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
      intIdTipoPersona:intIdTipoPersona},
      success:function(datos) {
          $("#ListaDeClientes").html(datos);
      }
  });
}

/* FIN - Funcion Ajax - Listar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Proveedor */
$(document).on('change', '#num-lista', function(){
  	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var funcion = "L";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
	   intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeClientes").html(datos);
	   	PaginarCliente(x,y,tipolistado,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Proveedor */
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
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
	   	intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeClientes").html(datos);
	   	PaginarCliente(x,y,tipolistado,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Proveedor */
function PaginarCliente(x,y,tipolistado,intIdTipoPersona) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  $.ajax({
      url:'../../datos/ventas/funcion_cliente.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
      intIdTipoPersona:intIdTipoPersona},
      success:function(datos) {
          $("#PaginacionDeClientes").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Página de Lista Proveedor */
$(document).on('click', '.btn-pagina', function(){
      var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(this).attr("idp") * y;
  	  var funcion = "L";
  	  var tipolistado = "T";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
	   	intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeClientes").html(datos);
	   	PaginarCliente((x/y),y,tipolistado,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Página de Lista Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Proveedor II */
$(document).on('keyup', '#txt-busqueda', function(){
	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var funcion = "L";
  	  var tipolistado = "T";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
	   	intIdTipoPersona,intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeClientes").html(datos);
	   	PaginarCliente(x,y,tipolistado,intIdTipoPersona);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Proveedor II */
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
	$('#ListaDeDomicilios').append('<tr>'+
		'<td>'+'<input type="hidden" name="nvchPais[]" value="'+
		document.getElementById("nvchPais").value+'"/>'+document.getElementById("nvchPais").value+'</td>'+
		'<td>'+'<input type="hidden" name="nvchRegion[]" value="'+
		document.getElementById("nvchRegion").value+'"/>'+document.getElementById("nvchRegion").value+'</td>'+
		'<td>'+'<input type="hidden" name="nvchProvincia[]" value="'+
		document.getElementById("nvchProvincia").value+'"/>'+document.getElementById("nvchProvincia").value+'</td>'+
		'<td>'+'<input type="hidden" name="nvchDistrito[]" value="'+
		document.getElementById("nvchDistrito").value+'"/>'+document.getElementById("nvchDistrito").value+'</td>'+
		'<td>'+'<input type="hidden" name="nvchDireccion[]" value="'+
		document.getElementById("nvchDireccion").value+'"/>'+document.getElementById("nvchDireccion").value+'</td>'+
		'<td>'+'<input type="hidden" name="intIdTipoDomicilio[]" value="'+
		document.getElementById("tipo-domicilio").value+'"/>'+$("#tipo-domicilio option:selected").html()+'</td>'+
		'<td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>'+
		'</tr>');
}
/* FIN - Listar Domicilios según Ingresa */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Comunicaciones según Ingresa */
function AgregarComunicacion() {
	$('#ListaDeComunicaciones').append('<tr>'+
		'<td>'+'<input type="hidden" name="nvchMedio[]" value="'
		+document.getElementById("nvchMedio").value+'"/>'+document.getElementById("nvchMedio").value+'</td>'+
		'<td>'+'<input type="hidden" name="nvchLugar[]" value="'
		+document.getElementById("nvchLugar").value+'"/>'+document.getElementById("nvchLugar").value+'</td>'+
		'<td>'+'<input type="hidden" name="intIdTipoComunicacion[]" value="'
		+document.getElementById("tipo-comunicacion").value+'"/>'+$("#tipo-comunicacion option:selected").html()+'</td>'+
		'<td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>'+
		'</tr>');
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
/* INICIO - Mostrar Domicilios del Proveedor Seleccionado */

function MostrarDomicilio(intIdCliente,tipolistado) {
	var funcion = "MD";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{intIdCliente:intIdCliente,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeDomicilios").html(datos);
	   }
	  });
}

/* FIN - Mostrar Domicilios del Proveedor Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Comunicaciones del Proveedor Seleccionado */

function MostrarComunicacion(intIdCliente,tipolistado) {
	var funcion = "MC";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{intIdCliente:intIdCliente,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeComunicaciones").html(datos);
	   }
	  });
}

/* FIN - Mostrar Comunicaciones del Proveedor Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Insertar Comunicacion Nueva */

function AgregarComunicacion_II() {
	var intIdCliente = document.getElementById("intIdCliente").value;
	var nvchMedio = document.getElementById("nvchMedio").value;
	var nvchLugar = document.getElementById("nvchLugar").value;
	var intIdTipoComunicacion = document.getElementById("tipo-comunicacion").value;
	var tipolistado = "I";
	var funcion = "IC";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{intIdCliente:intIdCliente,
	   		nvchMedio:nvchMedio,
	   		nvchLugar:nvchLugar,
	   		intIdTipoComunicacion:intIdTipoComunicacion,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		alert("Se insertó correctamente la comunicación");
	   		MostrarComunicacion(intIdCliente,tipolistado);
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
	var intIdCliente = document.getElementById("intIdCliente").value;
	var nvchPais = document.getElementById("nvchPais").value;
	var nvchRegion = document.getElementById("nvchRegion").value;
	var nvchProvincia = document.getElementById("nvchProvincia").value;
	var nvchDistrito = document.getElementById("nvchDistrito").value;
	var nvchDireccion = document.getElementById("nvchDireccion").value;
	var intIdTipoDomicilio = document.getElementById("tipo-domicilio").value;
	var tipolistado = "I";
	var funcion = "ID";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{intIdCliente:intIdCliente,
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
	   		alert("Se insertó correctamente el domicilio");
	   		MostrarDomicilio(intIdCliente,tipolistado);
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
	var intIdComunicacionCliente = document.getElementById("intIdComunicacionCliente").value;
	var intIdCliente = document.getElementById("intIdCliente").value;
	var nvchMedio = document.getElementById("nvchMedio").value;
	var nvchLugar = document.getElementById("nvchLugar").value;
	var intIdTipoComunicacion = document.getElementById("tipo-comunicacion").value;
	var tipolistado = "A";
	var accion = "I";
	var funcion = "AC";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{intIdComunicacionCliente:intIdComunicacionCliente,
	   		intIdCliente:intIdCliente,
	   		nvchMedio:nvchMedio,
	   		nvchLugar:nvchLugar,
	   		intIdTipoComunicacion:intIdTipoComunicacion,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		alert("Se modificó correctamente la comunicación");
	   		MostrarComunicacion(intIdCliente,tipolistado);
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
	var intIdDomicilioCliente = document.getElementById("intIdDomicilioCliente").value;
	var intIdCliente = document.getElementById("intIdCliente").value;
	var nvchPais = document.getElementById("nvchPais").value;
	var nvchRegion = document.getElementById("nvchRegion").value;
	var nvchProvincia = document.getElementById("nvchProvincia").value;
	var nvchDistrito = document.getElementById("nvchDistrito").value;
	var nvchDireccion = document.getElementById("nvchDireccion").value;
	var intIdTipoDomicilio = document.getElementById("tipo-domicilio").value;
	var tipolistado = "A";
	var accion = "I";
	var funcion = "AD";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{intIdDomicilioCliente:intIdDomicilioCliente,
	   		intIdCliente:intIdCliente,
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
	   		alert("Se modificó correctamente el domicilio");
	   		MostrarDomicilio(intIdCliente,tipolistado);
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
	var intIdDomicilioCliente = $(seleccion).attr("iddp");
	var funcion = "SD";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{intIdDomicilioCliente:intIdDomicilioCliente,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#nvchPais").val(datos.nvchPais);
	   	$("#nvchRegion").val(datos.nvchRegion);
	   	$("#nvchProvincia").val(datos.nvchProvincia);
	   	$("#nvchDistrito").val(datos.nvchDistrito);
	   	$("#nvchDireccion").val(datos.nvchDireccion);
	   	$("#tipo-domicilio").val(datos.intIdTipoDomicilio);
	   	$("#intIdDomicilioCliente").val(datos.intIdDomicilioCliente);
	   	BotonesDomicilio('A');
	   }
	  });
}

/* FIN - Mostrar Domicilio Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Comunicacion Seleccionado */

function SeleccionarComunicacion(seleccion) {
	var intIdComunicacionCliente = $(seleccion).attr("idcp");
	var funcion = "SC";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{intIdComunicacionCliente:intIdComunicacionCliente,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#nvchMedio").val(datos.nvchMedio);
	   	$("#nvchLugar").val(datos.nvchLugar);
	   	$("#tipo-comunicacion").val(datos.intIdTipoComunicacion);
	   	$("#intIdComunicacionCliente").val(datos.intIdComunicacionCliente);
	   	BotonesComunicacion('A');
	   }
	  });
}

/* FIN - Mostrar Comunicacion Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Comunicacion Seleccionado */

function EliminarDomicilio(seleccion) {
	var intIdDomicilioCliente = $(seleccion).attr("iddp");
	var funcion = "ED";
	var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{intIdDomicilioCliente:intIdDomicilioCliente,funcion:funcion},
	   success:function(datos)
	   {
	   	 if(datos=="ok"){
	   	 	alert("Se eliminó correctamente el Domicilio Seleccionado");
	   	 	MostrarDomicilio(intIdCliente,tipolistado);
	   	 }
	   }
	  });
}

/* FIN - Eliminar Comunicacion Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Comunicacion Seleccionado */

function EliminarComunicacion(seleccion) {
	var intIdComunicacionCliente = $(seleccion).attr("idcp");
	var funcion = "EC";
	var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/ventas/funcion_cliente.php",
	   method:"POST",
	   data:{intIdComunicacionCliente:intIdComunicacionCliente,funcion:funcion},
	   success:function(datos)
	   {
	   	 if(datos=="ok"){
	   	 	alert("Se eliminó correctamente la Comunicación Seleccionada");
	   	 	MostrarComunicacion(intIdCliente,tipolistado);
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
		$("#btn-agregar-comunicacion").show();
		$("#btn-actualizar-comunicacion").hide();
		$("#btn-cancelar-comunicacion").hide();
	} else if (accion == "A") {
		$("#btn-agregar-comunicacion").hide();
		$("#btn-actualizar-comunicacion").show();
		$("#btn-cancelar-comunicacion").show();
	}
}
function BotonesDomicilio(accion) {
	if(accion == "I"){
		$("#btn-agregar-domicilio").show();
		$("#btn-actualizar-domicilio").hide();
		$("#btn-cancelar-domicilio").hide();
	} else if (accion == "A") {
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