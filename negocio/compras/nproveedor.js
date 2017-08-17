//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Proveedor */
$(document).on('click', '#btn-form-crear-proveedor', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/compras/class_proveedor.php",
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
$(document).on('click', '#btn-crear-proveedor', function(){
	  var formData = $("#form-proveedor").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/compras/class_proveedor.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		$("#resultadocrud").html("<script>alert('Se Agregó correctamente')</script>");
	   		$('#txt-busqueda').val("");
	   		ListarProveedor(x,y,tipolistado);
	   		PaginarProveedor(x,y,tipolistado);
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
$(document).on('click', '.btn-mostrar-proveedor', function(){
  	  var intIdProveedor = $(this).attr("id");
  	  var funcion = "M";
	  $.ajax({
	   url:"../../datos/compras/class_proveedor.php",
	   method:"POST",
	   data:{intIdProveedor:intIdProveedor,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Proveedor */
$(document).on('click', '#btn-editar-proveedor', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-proveedor").serialize();
	  $.ajax({
	   url:"../../datos/compras/class_proveedor.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		$("#resultadocrud").html("<script>alert('Se Actualizó correctamente')</script>");
	   		ListarProveedor(x,y,tipolistado);
	   		PaginarProveedor(x,y,tipolistado);
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
  	  var intIdProveedor = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/compras/class_proveedor.php",
	   method:"POST",
	   data:{intIdProveedor:intIdProveedor,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") { 
	   		$("#resultadocrud").html("<script>alert('Se Eliminó correctamente')</script>");
	   		ListarProveedor(x,y,tipolistado);
	   		PaginarProveedor(x,y,tipolistado);
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

function ListarProveedor(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  $.ajax({
      url:'../../datos/compras/class_proveedor.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#ListaDeProveedores").html(datos);
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
	  $.ajax({
	   url:"../../datos/compras/class_proveedor.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeProveedores").html(datos);
	   	PaginarProveedor(x,y,tipolistado);
	   }
	  });
	 return false;
});

/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Proveedor */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Proveedor */

function PaginarProveedor(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  $.ajax({
      url:'../../datos/compras/class_proveedor.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#PaginacionDeProveedores").html(datos);
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
	  $.ajax({
	   url:"../../datos/compras/class_proveedor.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeProveedores").html(datos);
	   	PaginarProveedor((x/y),y,tipolistado);
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
	  $.ajax({
	   url:"../../datos/compras/class_proveedor.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
	   success:function(datos)
	   {
	   	$("#ListaDeProveedores").html(datos);
	   	PaginarProveedor(x,y,tipolistado);
	   }
	  });
	 return false;
});

/* FIN - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Proveedor II */
//////////////////////////////////////////////////////////////