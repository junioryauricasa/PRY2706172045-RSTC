<script>
//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Cliente */
$(document).on('click', '#btn-form-crear-moneda-tributaria', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/administrativo/funcion_moneda_tributaria.php",
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
$(document).on('click', '#btn-crear-moneda-tributaria', function(){
	  var formData = $("#form-moneda-tributaria").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
	  var x = 0;
	  var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/administrativo/funcion_moneda_tributaria.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se generó correctamente la Moneda Tributaria",1);
	   		$("#btn-form-moneda-tributaria-remove").click();
	   		ListarMonedaTributaria(x,y,tipolistado);
	   		PaginarMonedaTributaria(x,y,tipolistado);
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
$(document).on('click', '.btn-mostrar-moneda-tributaria', function(){
  	  var intIdMonedaTributaria = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/administrativo/funcion_moneda_tributaria.php",
	   method:"POST",
	   data:{intIdMonedaTributaria:intIdMonedaTributaria,funcion:funcion},
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
$(document).on('click', '#btn-editar-moneda-tributaria', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-moneda-tributaria").serialize();
  	  var TipoCambio = document.getElementById("intIdTipoCambio").value;
	  $.ajax({
	   url:"../../datos/administrativo/funcion_moneda_tributaria.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente la Moneda Tributaria",1);
	   		$("#btn-form-moneda-tributaria-remove").click();
	   		ListarMonedaTributaria(x,y,tipolistado);
	   		PaginarMonedaTributaria(x,y,tipolistado);
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
$(document).on('click', '.btn-eliminar-moneda-tributaria', function(){
	
	var idreg = $('.btn-eliminar-moneda-tributaria').attr("id");

	$('.mi-modal').modal('show');//mostrando modal
	
	$(document).on('click', '.modal-btn-si', function(){
	  	  var intIdMonedaTributaria = idreg;
	  	  var y = document.getElementById("num-lista").value;
	  	  var x = $(".marca").attr("idp") * y;
	  	  var tipolistado = "D";
	  	  var funcion = "E";
		  $.ajax({
			   url:"../../datos/administrativo/funcion_moneda_tributaria.php",
			   method:"POST",
			   data:{intIdMonedaTributaria:intIdMonedaTributaria,funcion:funcion},
			   success:function(datos)
			   {
			   	if (datos=="ok") {
			   		//alert('el codigo es: '+intIdMonedaTributaria);
			   		MensajeNormal("Se Eliminó correctamente la Moneda Tributaria",1);
			   		$('.mi-modal').modal('hide');
			   		ListarMonedaTributaria(x,y,tipolistado);
			   		PaginarMonedaTributaria((x/y),y,tipolistado);
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
/* INICIO - Funcion Ajax - Buscar MonedaTributaria Realizada */
$(document).on('change', '#lista-tipo-cambio', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarMonedaTributaria(x,y,tipolistado);
});

$(document).on('change', '#num-lista', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarMonedaTributaria(x,y,tipolistado);
});


$(document).on('click', '.btn-pagina', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(this).attr("idp") * y;
  	var tipolistado = "T";
  	ListarMonedaTributaria(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar MonedaTributaria Realizada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Cliente */
function ListarMonedaTributaria(x,y,tipolistado) {
  var funcion = "L";
  var TipoCambio = document.getElementById("lista-tipo-cambio").value;
  $.ajax({
      url:'../../datos/administrativo/funcion_moneda_tributaria.php',
      method:"POST",
      data:{x:x,y:y,funcion:funcion,tipolistado:tipolistado,TipoCambio:TipoCambio},
      success:function(datos) {
          $("#ListaDeMonedaTributaria").html(datos);
          PaginarMonedaTributaria((x/y),y,tipolistado);
      }
  });
}
/* FIN - Funcion Ajax - Listar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Cliente */
function PaginarMonedaTributaria(x,y,tipolistado) {
  var funcion = "P";
  var TipoCambio = document.getElementById("lista-tipo-cambio").value;
  $.ajax({
      url:'../../datos/administrativo/funcion_moneda_tributaria.php',
      method:"POST",
      data:{x:x,y:y,funcion:funcion,tipolistado:tipolistado,TipoCambio:TipoCambio},
      success:function(datos) {
          $("#PaginacionDeMonedaTributaria").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Cliente */
//////////////////////////////////////////////////////////////
</script>