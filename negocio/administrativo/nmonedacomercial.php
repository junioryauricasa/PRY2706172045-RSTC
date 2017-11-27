<script>
//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Cliente */
$(document).on('click', '#btn-form-crear-moneda-comercial', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/administrativo/funcion_moneda_comercial.php",
	   method:'POST',
	   data:{funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	$("#dtmFechaCambio").val(FechaActual());
	   	goToBox("#Formulario");
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Visualizar Formulario Crear Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Cliente */
$(document).on('click', '#btn-crear-moneda-comercial', function(){
	  var formData = $("#form-moneda-comercial").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
	  var x = 0;
	  var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/administrativo/funcion_moneda_comercial.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se generó correctamente la Moneda Comercial",1);
	   		$("#btn-form-moneda-comercial-remove").click();
	   		ListarMonedaComercial(x,y,tipolistado);
	   		PaginarMonedaComercial(x,y,tipolistado);
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Cliente */
//////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Cliente */
$(document).on('click', '.btn-mostrar-moneda-comercial', function(){
  	  var intIdMonedaComercial = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/administrativo/funcion_moneda_comercial.php",
	   method:"POST",
	   data:{intIdMonedaComercial:intIdMonedaComercial,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	goToBox("#Formulario");
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Cliente */
$(document).on('click', '#btn-editar-moneda-comercial', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-moneda-comercial").serialize();
  	  var TipoCambio = document.getElementById("intIdTipoCambio").value;
	  $.ajax({
	   url:"../../datos/administrativo/funcion_moneda_comercial.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente la Moneda Comercial",1);
	   		$("#btn-form-moneda-comercial-remove").click();
	   		ListarMonedaComercial(x,y,tipolistado);
	   		PaginarMonedaComercial(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Actualizar Cliente */
//////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Eliminar Cliente */
$(document).on('click', '.btn-eliminar-moneda-comercial', function(){
	
	var idreg = $(this).attr("id");

	$('.mi-modal').modal('show');//mostrando modal
	
	$(document).on('click', '.modal-btn-si', function(){
  	  var intIdMonedaComercial = idreg;
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/administrativo/funcion_moneda_comercial.php",
	   method:"POST",
	   data:{intIdMonedaComercial:intIdMonedaComercial,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se Eliminó correctamente la Moneda Comercial",1);
	   		$('.mi-modal').modal('hide');
	   		ListarMonedaComercial(x,y,tipolistado);
	   		PaginarMonedaComercial((x/y),y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
			   }

		  });
	});

	$(document).on('click', '.modal-btn-no', function(){
		$('.mi-modal').modal('hide');
	});
});
/* FIN - Funcion Ajax - Eliminar Cliente */
//////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar MonedaComercial Realizada */
$(document).on('change', '#lista-tipo-cambio', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarMonedaComercial(x,y,tipolistado);
});

$(document).on('change', '#num-lista', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarMonedaComercial(x,y,tipolistado);
});


$(document).on('click', '.btn-pagina', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(this).attr("idp") * y;
  	var tipolistado = "T";
  	ListarMonedaComercial(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar MonedaComercial Realizada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Cliente */
function ListarMonedaComercial(x,y,tipolistado) {
  var funcion = "L";
  var TipoCambio = document.getElementById("lista-tipo-cambio").value;
  $.ajax({
      url:'../../datos/administrativo/funcion_moneda_comercial.php',
      method:"POST",
      data:{x:x,y:y,funcion:funcion,tipolistado:tipolistado,TipoCambio:TipoCambio},
      success:function(datos) {
          $("#ListaDeMonedaComercial").html(datos);
          PaginarMonedaComercial((x/y),y,tipolistado);
      }
  });
}
/* FIN - Funcion Ajax - Listar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Cliente */
function PaginarMonedaComercial(x,y,tipolistado) {
  var funcion = "P";
  var TipoCambio = document.getElementById("lista-tipo-cambio").value;
  $.ajax({
      url:'../../datos/administrativo/funcion_moneda_comercial.php',
      method:"POST",
      data:{x:x,y:y,funcion:funcion,tipolistado:tipolistado,TipoCambio:TipoCambio},
      success:function(datos) {
          $("#PaginacionDeMonedaComercial").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Cliente */
//////////////////////////////////////////////////////////////
</script>