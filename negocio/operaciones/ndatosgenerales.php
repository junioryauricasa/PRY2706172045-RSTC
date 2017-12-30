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
	   	if(reporteFuncionCliente == 0)
	   		$("#intIdProvincia").html(datos);
	   	else {
	   		$("#intIdProvincia").html('<option value="T">GENERAL</option>');
	   		$("#intIdProvincia").append(datos);
	   	}
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
	    if(reporteFuncionCliente == 0)
	   		$("#intIdDistrito").html(datos);
	   	else {
	   		$("#intIdDistrito").html('<option value="T">GENERAL</option>');
	   		$("#intIdDistrito").append(datos);
	   	}
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
	   	if(reporteFuncionCliente == 0)
	   		$("#intIdProvincia").html(datos);
	   	else {
	   		$("#intIdProvincia").html('<option value="T">GENERAL</option>');
	   		$("#intIdProvincia").append(datos);
	   	}
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
	   	if(reporteFuncionCliente == 0)
	   		$("#intIdDistrito").html(datos);
	   	else {
	   		$("#intIdDistrito").html('<option value="T">GENERAL</option>');
	   		$("#intIdDistrito").append(datos);
	   	}
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
	   	if(reporteFuncionCliente == 0)
	   		$("#intIdProvincia").html(datos);
	   	else {
	   		$("#intIdProvincia").html('<option value="T">GENERAL</option>');
	   		$("#intIdProvincia").append(datos);
	   	}
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
	   	if(reporteFuncionCliente == 0)
	   		$("#intIdDistrito").html(datos);
	   	else {
	   		$("#intIdDistrito").html('<option value="T">GENERAL</option>');
	   		$("#intIdDistrito").append(datos);
	   	}
	   	$("#intIdDistrito").val(intIdDistrito);
	   }
	  });
}
/* FIN - Mostrar Ubigeo Departamento - Provincia - Distrito */
//////////////////////////////////////////////////////////////
</script>