//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Ubigeo Departamento - Provincia - Distrito */
function MostrarProvincia(){
	var intIdDepartamento = $("#intIdDepartamento").val();
	var funcion = "MP";

	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdDepartamento:intIdDepartamento},
	   success:function(datos)
	   {
	   	$("#intIdProvincia").html(datos);
	   }
	  });
	
	funcion = "SP";

	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdDepartamento:intIdDepartamento},
	   success:function(datos)
	   {
	   	MostrarDistrito_II(datos);
	   }
	  });
}

function MostrarDistrito(){
	var intIdProvincia = $("#intIdProvincia").val();
	var funcion = "MD";
	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdProvincia:intIdProvincia},
	   success:function(datos)
	   {
	   	$("#intIdDistrito").html(datos);
	   }
	  });
}

function MostrarProvincia_II(intIdDepartamento){
	var funcion = "MP";
	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdDepartamento:intIdDepartamento},
	   success:function(datos)
	   {
	   	$("#intIdProvincia").html(datos);
	   }
	  });
}

function MostrarDistrito_II(intIdProvincia){
	var funcion = "MD";
	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdProvincia:intIdProvincia},
	   success:function(datos)
	   {
	   	$("#intIdDistrito").html(datos);
	   }
	  });
}

function MostrarProvincia_III(intIdDepartamento,intIdProvincia){
	var funcion = "MP";
	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdDepartamento:intIdDepartamento},
	   success:function(datos)
	   {
	   	$("#intIdProvincia").html(datos);
	   	$("#intIdProvincia").val(intIdProvincia);
	   }
	  });
}

function MostrarDistrito_III(intIdProvincia,intIdDistrito){
	var funcion = "MD";
	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdProvincia:intIdProvincia},
	   success:function(datos)
	   {
	   	$("#intIdDistrito").html(datos);
	   	$("#intIdDistrito").val(intIdDistrito);
	   }
	  });
}
/* FIN - Mostrar Ubigeo Departamento - Provincia - Distrito */
//////////////////////////////////////////////////////////////