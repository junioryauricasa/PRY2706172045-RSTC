//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Kardex */
$(document).on('click', '#btn-form-crear-kardex', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/reportes/funcion_kardex_producto.php",
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
/* FIN - Funcion Ajax - Visualizar Formulario Crear Kardex */
//////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Kardex */
$(document).on('click', '.btn-mostrar-kardex', function(){
  	  var intIdKardex = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/reportes/funcion_kardex_producto.php",
	   method:"POST",
	   data:{intIdKardex:intIdKardex,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	goToBox("#Formulario");
	   	$("#tipo-comprobante").val($("#intIdTipoComprobante").val());
	   	MostrarSeleccionComprobante($("#intIdTipoComprobante").val());
	   	MostrarDetalleKardex(intIdKardex,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Kardex */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Kardex Realizada */
$(document).on('change', '#num-lista', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarKardex(x,y,tipolistado);
});

$(document).on('keyup', '#txt-busqueda', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarKardex(x,y,tipolistado);
});

$(document).on('click', '.btn-pagina', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(this).attr("idp") * y;
  	var tipolistado = "T";
  	ListarKardex(x,y,tipolistado);
});

$(document).on('change', '#lista-tipo-moneda', function(){
    var y = document.getElementById("num-lista").value;
    var x = $(".marca").attr("idp") * y;
    var tipolistado = "T";
    ListarKardex(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Kardex Realizada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Kardex */
function ListarKardex(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  var intIdProducto = document.getElementById("intIdProducto").value;
  var intIdTipoMoneda = document.getElementById("lista-tipo-moneda").value;

  if(EsFecha("dtmFechaInicial") == false){
    var dtmFechaInicial = "";
  } else {
    var dtmFechaInicial = $("#dtmFechaInicial").val();
  }
  if(EsFecha("dtmFechaFinal") == false){
    var dtmFechaFinal = FechaActual();
  } else {
    var dtmFechaFinal = $("#dtmFechaFinal").val();
  }

  $.ajax({
      url:'../../datos/reportes/funcion_kardex_producto.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdProducto:intIdProducto,
          dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda},
      success:function(datos) {
	      $("#ListaDeKardex").html(datos);
	      PaginarKardex((x/y),y,tipolistado);
      }
  });
}
/* FIN - Funcion Ajax - Listar Kardex */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Kardex */
function PaginarKardex(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  var intIdProducto = document.getElementById("intIdProducto").value;

  if(EsFecha("dtmFechaInicial") == false){
    var dtmFechaInicial = "";
  } else {
    var dtmFechaInicial = $("#dtmFechaInicial").val();
  }
  if(EsFecha("dtmFechaFinal") == false){
    var dtmFechaFinal = FechaActual();
  } else {
    var dtmFechaFinal = $("#dtmFechaFinal").val();
  }
  
  $.ajax({
      url:'../../datos/reportes/funcion_kardex_producto.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdProducto:intIdProducto,
        dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal},
      success:function(datos) {
          $("#PaginacionDeKardex").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Kardex */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Ver Kardex del Producto */
function VerKardexProducto(seleccion) {
  var intIdProducto = $(seleccion).attr("id");
  $("#intIdProducto").val(intIdProducto);
  ListarKardex(0,10,"T");
}
/* FIN - Funcion Ajax - Ver Kardex del Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////-- PRODUCTO --/////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Producto */
$(document).on('change', '#num-lista-producto', function(){
  var y = document.getElementById("num-lista-producto").value;
  var x = 0;
  var tipolistado = "T";
  ListarProducto(x,y,tipolistado);
});

$(document).on('change', '#tipo-busqueda-producto', function(){
  var y = document.getElementById("num-lista-producto").value;
  var x = 0;
  var tipolistado = "T";
  ListarProducto(x,y,tipolistado);
});

$(document).on('click', '.btn-pagina-producto', function(){
  var y = document.getElementById("num-lista-producto").value;
  var x = $(this).attr("idp") * y;
  var tipolistado = "T";
  ListarProducto(x,y,tipolistado);
});

$(document).on('keyup', '#txt-busqueda-producto', function(){
  var y = document.getElementById("num-lista-producto").value;
  var x = 0;
  var tipolistado = "T";
  ListarProducto(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Producto */
function ListarProducto(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda-producto").value;
  var funcion = "LP";
  var TipoBusqueda = document.getElementById("tipo-busqueda-producto").value;
  $.ajax({
      url:'../../datos/reportes/funcion_kardex_producto.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,TipoBusqueda:TipoBusqueda},
      success:function(datos) {
          $("#ListaDeProductos").html(datos);
          PaginarProducto((x/y),y,tipolistado);
      }
  });
}
/* FIN - Funcion Ajax - Listar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Producto */
function PaginarProducto(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda-producto").value;
  var funcion = "PP";
  var TipoBusqueda = document.getElementById("tipo-busqueda-producto").value;
  $.ajax({
      url:'../../datos/reportes/funcion_kardex_producto.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,TipoBusqueda:TipoBusqueda},
      success:function(datos) {
          $("#PaginacionDeProductos").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////-- PRODUCTO --/////////////////////////////////////////////////