<script>
//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Ubigeo Departamento - Provincia - Distrito */
var reporteFuncionCliente = 0;
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

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Ubigeo Departamento - Provincia - Distrito */
var reporteFuncionCliente = 0;
function MostrarProvinciaB(){
	var intIdDepartamento = $("#intIdDepartamentoB").val();
	var funcion = "MP";

	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdDepartamento:intIdDepartamento},
	   success:function(datos)
	   {
	   		$("#intIdProvinciaB").html('<option value="T">GENERAL</option>');
	   		$("#intIdProvinciaB").append(datos);
	   }
	  });
	
	funcion = "SP";

	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdDepartamento:intIdDepartamento},
	   success:function(datos)
	   {
	   	MostrarDistrito_IIB(datos);
	   }
	  });
}

function MostrarDistritoB(){
	var intIdProvincia = $("#intIdProvinciaB").val();
	var funcion = "MD";
	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdProvincia:intIdProvincia},
	   success:function(datos)
	   {	
	   		$("#intIdDistritoB").html('<option value="T">GENERAL</option>');
	   		$("#intIdDistritoB").append(datos);
	   }
	  });
}

function MostrarProvincia_IIB(intIdDepartamento){
	var funcion = "MP";
	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdDepartamento:intIdDepartamento},
	   success:function(datos)
	   {
   		$("#intIdProvinciaB").html('<option value="T">GENERAL</option>');
   		$("#intIdProvinciaB").append(datos);
	   }
	  });
}

function MostrarDistrito_IIB(intIdProvincia){
	var funcion = "MD";
	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdProvincia:intIdProvincia},
	   success:function(datos)
	   {
   		$("#intIdDistritoB").html('<option value="T">GENERAL</option>');
   		$("#intIdDistritoB").append(datos);
	   }
	  });
}

function MostrarProvincia_IIIB(intIdDepartamento,intIdProvincia){
	var funcion = "MP";
	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdDepartamento:intIdDepartamento},
	   success:function(datos)
	   {
   		$("#intIdProvinciaB").html('<option value="T">GENERAL</option>');
   		$("#intIdProvinciaB").append(datos);
	   	$("#intIdProvinciaB").val(intIdProvincia);
	   }
	  });
}

function MostrarDistrito_IIIB(intIdProvincia,intIdDistrito){
	var funcion = "MD";
	$.ajax({
	   url:"../../datos/operaciones/funcion_datosgenerales.php",
	   method:'POST',
	   data:{funcion:funcion,intIdProvincia:intIdProvincia},
	   success:function(datos)
	   {
   		$("#intIdDistritoB").html('<option value="T">GENERAL</option>');
   		$("#intIdDistritoB").append(datos);
	   	$("#intIdDistritoB").val(intIdDistrito);
	   }
	  });
}
/* FIN - Mostrar Ubigeo Departamento - Provincia - Distrito */
//////////////////////////////////////////////////////////////
</script>