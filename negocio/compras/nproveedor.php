<script>
var SNuevoProveedor = "";
//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Proveedor */
$(document).on('click', '#btn-form-crear-proveedor', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
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

function crear_nuevo_proveedor(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:'POST',
	   data:{funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	goToBox("#Formulario");
	   }
	  });
	 return false;
}


/* FIN - Funcion Ajax - Visualizar Formulario Crear Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Proveedor */
$(document).on('click', '#btn-crear-proveedor-nuevo', function(){
	  var formData = $("#form-proveedor").serialize();
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
	  } 
	  if(num_filas_domicilio == 0){
	  	MensajeNormal("Ingrese por lo menos un Domicilio Fiscal",2);
	  	return false;
	  }
	  $.ajax({
	   url: "../../datos/compras/funcion_proveedor.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="okok" || datos=="okokok") {
	   		MensajeNormal("Se agregó correctamente el nuevo Proveedor",1);
	   		$('#txt-busqueda').val("");
	   		AccionCabecerasTabla(intIdTipoPersona);
	   		ListarProveedor(x,y,tipolistado,intIdTipoPersona);
	   		PaginarProveedor(x,y,tipolistado,intIdTipoPersona);
	   		$("#lista-persona").val($("#tipo-persona").val());

	   		limpiarformProveedor();//limpiar formulario
	   		botonescrear();
	   		if(SNuevoProveedor == "I"){
	   		crear_nuevo_proveedor();
	   		ConsultarIdProveedor();
			}
			$("#btn-listaproveedores").click();
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});

function ConsultarIdProveedor(){
	var funcion = "Id";
	$.ajax({
	   url: "../../datos/compras/funcion_proveedor.php",
	   method: "POST",
	   data: {funcion:funcion},
	   success:function(datos)
	   {
	   	datos = datos.replace(/\s/g,'');
	   	SeleccionarProveedorS(datos);
   		$('#btntabbuscarproveedor').click();
		$('#formProveedor').modal('hide')
	   }
	  });
}
/* FIN - Funcion Ajax - Insertar Proveedor */
//////////////////////////////////////////////////////////////

/*	Función Limpiar Formulario de registro de cliente   */
//////////////////////////////////////////////////////////////
function limpiarformProveedor(){  

      //restablecer valores
      RestablecerValidacion("tipo-persona",1);
      RestablecerValidacion("intIdTipoPersona",1);
      RestablecerValidacion("nvchDNI",1);
      RestablecerValidacion("nvchRUC",1);
      RestablecerValidacion("nvchRazonSocial",1);
      RestablecerValidacion("nvchApellidoPaterno",1);
      RestablecerValidacion("nvchApellidoMaterno",1);
      RestablecerValidacion("nvchNombres",1);
      RestablecerValidacion("intIdTipoCliente",1);
      RestablecerValidacion("nvchObservacion",1);


      //persona
      $("#tipo-persona").val(1);
      $("#intIdTipoPersona").val("");
      $("#nvchDNI").val("");
      $("#nvchRUC").val("");
      $("#nvchRazonSocial").val("");
      $("#nvchApellidoPaterno").val("");
      $("#nvchApellidoMaterno").val("");
      $("#nvchNombres").val("");
      $("#intIdTipoCliente").val("");
      $("#nvchObservacion").val("");

      //domicilio
      $("#nvchPais").val("");
      $("#intIdDepartamento").val(1);
      $("#intIdProvincia").val(1);
      $("#intIdDistrito").val(1);
      $("#nvchDireccion").val("");
      $("#tipo-domicilio").val(1);
      $("#IdDomicilioCliente").val("");

      //comunicacion
      $("#nvchMedio").val("");
      $("#nvchLugar").val("");
      $("#tipo-comunicacion").val(1);
      $("#IdComunicacionCliente").val("");

      //limpiando tablas
      $("#ListaDeDomicilios").html("");//vacia tabla
      //limpiando tablas
      $("#ListaDeComunicaciones").html("");//vacia tabla
      
}
//////////////////////////////////////////////////////////////
/*	FIN * Función Limpiar Formulario de registro de cliente   */

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Proveedor */
$(document).on('click', '.btn-mostrar-proveedor', function(){
  	  var intIdProveedor = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:"POST",
	   data:{intIdProveedor:intIdProveedor,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	$("#tipo-persona").val($("#intIdTipoPersona").val());
	   	MostrarTipoPersona();
	   	MostrarDomicilio(intIdProveedor,tipolistado);
	   	MostrarComunicacion(intIdProveedor,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Proveedor */
$(document).on('click', '#btn-editar-proveedor-actualizar', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca-proveedor").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-proveedor").serialize();
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
	  }
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente el Proveedor",1);
	   		AccionCabecerasTabla(intIdTipoPersona);
	   		ListarProveedor(x,y,tipolistado,intIdTipoPersona);
	   		PaginarProveedor(x,y,tipolistado,intIdTipoPersona);
	   		$("#lista-persona").val($("#tipo-persona").val());
	   		$("#btn-form-proveedor-remove").click();
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
$(document).on('click', '.btn-eliminar-proveedor', function(){
	
	var idreg = $(this).attr("id");//pasando el id del modal -s variable

	$('.mi-modal').modal('show');//mostrando modal

	$(document).on('click', '.modal-btn-si', function(){
	  	  var intIdProveedor = idreg;
	  	  var y = document.getElementById("num-lista").value;
	  	  var x = $(".marca-proveedor").attr("idp") * y;
	  	  var tipolistado = "D";
	  	  var funcion = "E";
	  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
		  $.ajax({
		   url:"../../datos/compras/funcion_proveedor.php",
		   method:"POST",
		   data:{intIdProveedor:intIdProveedor,funcion:funcion},
		   success:function(datos)
		   {
		   	if (datos=="ok") { 
		   		MensajeNormal("Se Eliminó correctamente el Proveedor",1);
		   		$('.mi-modal').modal('hide');
		   		ListarProveedor(x,y,tipolistado,intIdTipoPersona);
		   		PaginarProveedor(x,y,tipolistado,intIdTipoPersona);
		   	}
		   	else { $("#resultadocrud").html(datos); }
		   }
		  });
		 return false;
	});

	$(document).on('click', '.modal-btn-no', function(){
		$('.mi-modal').modal('hide');
	});
});
/* FIN - Funcion Ajax - Eliminar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Proveedor */
$(document).on('change', '#num-lista', function(){
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
	  ListarProveedor(x,y,tipolistado,intIdTipoPersona);
});

$(document).on('change', '#lista-persona', function(){
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
  	  AccionCabecerasTabla(intIdTipoPersona);
	  ListarProveedor(x,y,tipolistado,intIdTipoPersona);
});

$(document).on('click', '.btn-pagina-proveedor', function(){
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(this).attr("idp") * y;
  	  var tipolistado = "T";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
	  ListarProveedor(x,y,tipolistado,intIdTipoPersona);
});

$(document).on('keyup', '#txt-busqueda', function(){
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var intIdTipoPersona = document.getElementById("lista-persona").value;
	  ListarProveedor(x,y,tipolistado,intIdTipoPersona);
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Proveedor */
function ListarProveedor(x,y,tipolistado,intIdTipoPersona) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  $.ajax({
      url:'../../datos/compras/funcion_proveedor.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
      intIdTipoPersona:intIdTipoPersona},
      success:function(datos) {
          $("#ListaDeProveedores").html(datos);
          PaginarProveedor((x/y),y,tipolistado,intIdTipoPersona);
      }
  });
}
/* FIN - Funcion Ajax - Listar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Proveedor */
function PaginarProveedor(x,y,tipolistado,intIdTipoPersona) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  $.ajax({
      url:'../../datos/compras/funcion_proveedor.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,
      intIdTipoPersona:intIdTipoPersona},
      success:function(datos) {
          $("#PaginacionDeProveedores").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Proveedor */
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
      	$("#nvchRUC").attr("onkeyup","EsNumeroEntero('nvchRUC')");
      	if($("#funcion").val() == "I")
			RestablecerValidacion("nvchRUC",1);
		else
			RestablecerValidacion("nvchRUC",2);
      } else if(tipo_persona == "2"){
      	$(".nvchDNI").show();
      	$(".nvchApellidoPaterno").show();
      	$(".nvchApellidoMaterno").show();
      	$(".nvchNombres").show();
      	$(".nvchRUC").show();
      	$(".nvchRazonSocial").hide();
      	$("#nvchRUC").attr("onkeyup","EsNumeroEnteroOp('nvchRUC')");
      	if($("#funcion").val() == "I")
			RestablecerValidacion("nvchRUC",1);
		else
			RestablecerValidacion("nvchRUC",2);
      }
}
/* FIN - Mostrar Campos de acuerdo al Tipo de Persona */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Domicilios según Ingresa */
function AgregarDomicilio() {
	var nvchPais = document.getElementById("nvchPais").value;
	var intIdDepartamento = document.getElementById("intIdDepartamento").value;
	var intIdProvincia = document.getElementById("intIdProvincia").value;
	var intIdDistrito = document.getElementById("intIdDistrito").value;
	var nvchDepartamento = $("#intIdDepartamento option:selected").html();
	var nvchProvincia = $("#intIdProvincia option:selected").html();
	var nvchDistrito = $("#intIdDistrito option:selected").html();
	var nvchDireccion = document.getElementById("nvchDireccion").value;
	var intIdTipoDomicilio = document.getElementById("tipo-domicilio").value;
	var validacion = true;
	$('#ListaDeDomicilios tr').each(function(){
        if($(this).find('td').eq(6).text().replace(/\s/g,'') == 'Fiscal'){
            validacion = false;
        }
    });
	if(EsLetra("nvchPais") == false){
		return false;
	} else if(EsVacio("nvchDireccion") == false) {
		return false;
	} else if(validacion == false){
    	if(intIdTipoDomicilio == 1){
	    	MensajeNormal("No puede haber más de un Domicilio Fiscal",2);
	    	return false;
    	}
    }
	$('#ListaDeDomicilios').append('<tr><td class="heading" data-th="ID"></td>'+
		'<td>'+'<input type="hidden" name="nvchPais[]" value="'+
		nvchPais+'"/>'+nvchPais+'</td>'+
		'<td>'+'<input type="hidden" name="intIdDepartamento[]" value="'+
		intIdDepartamento+'"/>'+nvchDepartamento+'</td>'+
		'<td>'+'<input type="hidden" name="intIdProvincia[]" value="'+
		intIdProvincia+'"/>'+nvchProvincia+'</td>'+
		'<td>'+'<input type="hidden" name="intIdDistrito[]" value="'+
		intIdDistrito+'"/>'+nvchDistrito+'</td>'+
		'<td>'+'<input type="hidden" name="nvchDireccion[]" value="'+
		nvchDireccion+'"/>'+nvchDireccion+'</td>'+
		'<td>'+'<input type="hidden" name="intIdTipoDomicilio[]" value="'+
		intIdTipoDomicilio+'"/>'+$("#tipo-domicilio option:selected").html()+'</td>'+
		'<td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>'+
		'</tr>');
	RestablecerValidacion('nvchPais',1);
	$("#intIdDepartamento").val(1);
	MostrarProvincia();
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
	$('#ListaDeComunicaciones').append('<tr><td class="heading" data-th="ID"></td>'+
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
/* INICIO - Mostrar Domicilios del Proveedor Seleccionado */
function MostrarDomicilio(intIdProveedor,tipolistado) {
	var funcion = "MD";
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:"POST",
	   data:{intIdProveedor:intIdProveedor,funcion:funcion,tipolistado:tipolistado},
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
function MostrarComunicacion(intIdProveedor,tipolistado) {
	var funcion = "MC";
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:"POST",
	   data:{intIdProveedor:intIdProveedor,funcion:funcion,tipolistado:tipolistado},
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
	if(EsVacio("nvchMedio") == false){
		return false;
	} else if(EsVacio("nvchLugar") == false) {
		return false;
	}
	var intIdProveedor = document.getElementById("intIdProveedor").value;
	var nvchMedio = document.getElementById("nvchMedio").value;
	var nvchLugar = document.getElementById("nvchLugar").value;
	var intIdTipoComunicacion = document.getElementById("tipo-comunicacion").value;
	var tipolistado = "I";
	var funcion = "IC";
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:"POST",
	   data:{intIdProveedor:intIdProveedor,
	   		nvchMedio:nvchMedio,
	   		nvchLugar:nvchLugar,
	   		intIdTipoComunicacion:intIdTipoComunicacion,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		MensajeNormal("Se agregó correctamente la nueva Comunicación",1);
	   		MostrarComunicacion(intIdProveedor,tipolistado);
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
	var intIdProveedor = document.getElementById("intIdProveedor").value;
	var nvchPais = document.getElementById("nvchPais").value;
	var intIdDepartamento = document.getElementById("intIdDepartamento").value;
	var intIdProvincia = document.getElementById("intIdProvincia").value;
	var intIdDistrito = document.getElementById("intIdDistrito").value;
	var nvchDepartamento = $("#intIdDepartamento option:selected").html();
	var nvchProvincia = $("#intIdProvincia option:selected").html();
	var nvchDistrito = $("#intIdDistrito option:selected").html();
	var nvchDireccion = document.getElementById("nvchDireccion").value;
	var intIdTipoDomicilio = document.getElementById("tipo-domicilio").value;
	var validacion = true;
	$('#ListaDeDomicilios tr').each(function(){
        if($(this).find('td').eq(6).text().replace(/\s/g,'') == 'Fiscal'){
            validacion = false;
        }
    });
	if(EsLetra("nvchPais") == false){
		return false;
	} else if(EsVacio("nvchDireccion") == false) {
		return false;
	} else if(validacion == false){
		if(intIdTipoDomicilio == 1){
	    	MensajeNormal("No puede haber más de un Domicilio Fiscal",2);
	    	return false;
    	}
    }
	var tipolistado = "I";
	var funcion = "ID";
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:"POST",
	   data:{intIdProveedor:intIdProveedor,
	   		nvchPais:nvchPais,
	   		intIdDepartamento:intIdDepartamento,
	   		intIdProvincia:intIdProvincia,
	   		intIdDistrito:intIdDistrito,
	   		nvchDireccion:nvchDireccion,
	   		intIdTipoDomicilio:intIdTipoDomicilio,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		MensajeNormal("Se agregó correctamente el nuevo Domicilio",1);
	   		MostrarDomicilio(intIdProveedor,tipolistado);
	   		$("#intIdDepartamento").val(1);
			MostrarProvincia();
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
	var intIdComunicacionProveedor = document.getElementById("intIdComunicacionProveedor").value;
	var intIdProveedor = document.getElementById("intIdProveedor").value;
	var nvchMedio = document.getElementById("nvchMedio").value;
	var nvchLugar = document.getElementById("nvchLugar").value;
	var intIdTipoComunicacion = document.getElementById("tipo-comunicacion").value;
	var tipolistado = "A";
	var accion = "I";
	var funcion = "AC";
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:"POST",
	   data:{intIdComunicacionProveedor:intIdComunicacionProveedor,
	   		intIdProveedor:intIdProveedor,
	   		nvchMedio:nvchMedio,
	   		nvchLugar:nvchLugar,
	   		intIdTipoComunicacion:intIdTipoComunicacion,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		MensajeNormal("Se agregó correctamente la Comunicacion",1);
	   		MostrarComunicacion(intIdProveedor,tipolistado);
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
	
	var intIdDomicilioProveedor = document.getElementById("intIdDomicilioProveedor").value;
	var intIdProveedor = document.getElementById("intIdProveedor").value;
	var nvchPais = document.getElementById("nvchPais").value;
	var intIdDepartamento = document.getElementById("intIdDepartamento").value;
	var intIdProvincia = document.getElementById("intIdProvincia").value;
	var intIdDistrito = document.getElementById("intIdDistrito").value;
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
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:"POST",
	   data:{intIdDomicilioProveedor:intIdDomicilioProveedor,
	   		intIdProveedor:intIdProveedor,
	   		nvchPais:nvchPais,
	   		intIdDepartamento:intIdDepartamento,
	   		intIdProvincia:intIdProvincia,
	   		intIdDistrito:intIdDistrito,
	   		nvchDireccion:nvchDireccion,
	   		intIdTipoDomicilio:intIdTipoDomicilio,
	   		funcion:funcion},
	   success:function(datos)
	   {
	   	if(datos == "ok"){
	   		MensajeNormal("Se modificó correctamente el Domicilio",1);
	   		MostrarDomicilio(intIdProveedor,tipolistado);
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
	var intIdDomicilioProveedor = $(seleccion).attr("iddcl");
	var funcion = "SD";
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:"POST",
	   data:{intIdDomicilioProveedor:intIdDomicilioProveedor,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#nvchPais").val(datos.nvchPais);
	   	$("#intIdDepartamento").val(datos.intIdDepartamento);
	   	MostrarProvincia_III(datos.intIdDepartamento,datos.intIdProvincia);
	   	MostrarDistrito_III(datos.intIdProvincia,datos.intIdDistrito);
	   	$("#nvchDireccion").val(datos.nvchDireccion);
	   	$("#tipo-domicilio").val(datos.intIdTipoDomicilio);
	   	$("#intIdDomicilioProveedor").val(datos.intIdDomicilioProveedor);
	   	BotonesDomicilio('A');
	   }
	  });
}
/* FIN - Mostrar Domicilio Seleccionado */
//////////////////////////////////////////////////////////////

/*	Función Mostrar botones formularios de cliente   */
///////////////////////////////////////////////////////////
function botonescrear(){
      $("#btn-agregar-domicilio").show();
      $("#btn-agregar-domicilio").hide();
      $("#btn-actualizar-domicilio").hide();
      $("#btn-cancelar-domicilio").hide();

      $("#btn-agregar-comunicacion").show();
      $("#btn-agregar-comunicacion").hide();
      $("#btn-actualizar-comunicacion").hide();
      $("#btn-cancelar-comunicacion").hide();

      //$("#intIdProveedor").val("");
      $("#btn-editar-proveedor-actualizar").hide();
      $("#btn-reset-actualizar").hide();
      $("#btn-crear-proveedor-nuevo").show();
      $("#btn-reset-nuevo").show();	  
}

function botonesactualizar(){
      $("#btn-agregar-domicilio").hide();
      $("#btn-agregar-domicilio").show();
      $("#btn-actualizar-domicilio").show();
      $("#btn-cancelar-domicilio").show();

      $("#btn-agregar-comunicacion").hide();
      $("#btn-agregar-comunicacion").show();
      $("#btn-actualizar-comunicacion").show();
      $("#btn-cancelar-comunicacion").show();

      $("#btn-editar-proveedor-actualizar").show();
      $("#btn-reset-actualizar").show();
      $("#btn-crear-proveedor-nuevo").hide();
      $("#btn-reset-nuevo").hide();
}
///////////////////////////////////////////////////////////
/*	END * Función Mostrar botones formularios de cliente   */

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Comunicacion Seleccionado */
function SeleccionarComunicacion(seleccion) {
	var intIdComunicacionProveedor = $(seleccion).attr("idcp");
	var funcion = "SC";
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:"POST",
	   data:{intIdComunicacionProveedor:intIdComunicacionProveedor,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#nvchMedio").val(datos.nvchMedio);
	   	$("#nvchLugar").val(datos.nvchLugar);
	   	$("#tipo-comunicacion").val(datos.intIdTipoComunicacion);
	   	$("#intIdComunicacionProveedor").val(datos.intIdComunicacionProveedor);
	   	BotonesComunicacion('A');
	   }
	  });
}
/* FIN - Mostrar Comunicacion Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Comunicacion Seleccionado */
function EliminarDomicilio(seleccion) {
	var intIdDomicilioProveedor = $(seleccion).attr("iddp");
	var funcion = "ED";
	var tipolistado = "T";
	var intIdProveedor = $("#intIdProveedor").val();
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:"POST",
	   data:{intIdDomicilioProveedor:intIdDomicilioProveedor,funcion:funcion},
	   success:function(datos)
	   {
	   	 if(datos=="ok"){
	   	 	MensajeNormal("Se eliminó correctamente el Domicilio",1);
	   	 	MostrarDomicilio(intIdProveedor,tipolistado);
	   	 }
	   }
	  });
}
/* FIN - Eliminar Comunicacion Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Comunicacion Seleccionado */
function EliminarComunicacion(seleccion) {
	var intIdComunicacionProveedor = $(seleccion).attr("idcp");
	var funcion = "EC";
	var tipolistado = "T";
	var intIdProveedor = $("#intIdProveedor").val();
	  $.ajax({
	   url:"../../datos/compras/funcion_proveedor.php",
	   method:"POST",
	   data:{intIdComunicacionProveedor:intIdComunicacionProveedor,funcion:funcion},
	   success:function(datos)
	   {
	   	 if(datos=="ok"){
	   	 	MensajeNormal("Se eliminó correctamente la Comunicación",1);
	   	 	MostrarComunicacion(intIdProveedor,tipolistado);
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


//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */


/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Producto para descargar reporte en excel*/
$(document).on('click', '#DescargarListaProveedorExcel', function(){
	  //alert('ingresaste a la funcion descargar');
	  var busqueda = $("#txt-busqueda").val();
	  //alert('Pasaste el txt');
	  //var tipo_persona = document.getElementById('lista-persona');
	  var tipo_persona = $("#lista-persona").val();

	  //alert('parametros> busqueda:'+busqueda+' && tipo_persona:'+tipo_persona);

	  var url = '../../datos/compras/clases_proveedor/reporteexcel.php?elemento='+busqueda+'&TipoPersona='+tipo_persona;
	  window.open(url);

});
/* FIN - Funcion Ajax - Mostrar Producto para descargar reporte en excel */
//////////////////////////////////////////////////////////////

</script>