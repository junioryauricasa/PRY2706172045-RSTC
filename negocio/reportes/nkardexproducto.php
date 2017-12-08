<script>
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

$(document).on('click', '#btnBuscar', function(){
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

$(document).on('change', '#intIdSucursal', function(){
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
  var intIdSucursal = $("#intIdSucursal").val();

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
          dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda,
          intIdSucursal:intIdSucursal},
      success:function(datos) {
	      $("#ListaDeKardex").html(datos);
	      PaginarKardex((x/y),y,tipolistado);
      }
  });
}
/* FIN - Funcion Ajax - Listar Kardex */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Reporte Kardex */
function ReporteKardex() {
  var busqueda = document.getElementById("txt-busqueda").value;
  var intIdProducto = document.getElementById("intIdProducto").value;
  var intIdTipoMoneda = document.getElementById("lista-tipo-moneda").value;
  var intIdSucursal = $("#intIdSucursal").val();

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
  var url = '../../datos/reportes/clases_kardex/reporte_kardex_producto.php?intIdProducto='+intIdProducto+
            '&busqueda='+busqueda+'&dtmFechaInicial='+dtmFechaInicial+'&dtmFechaFinal='+dtmFechaFinal+
            '&intIdTipoMoneda='+intIdTipoMoneda;
  window.open(url, '_blank');
}
/* FIN - Funcion Ajax - Reporte Kardex */
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
        dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdSucursal:intIdSucursal},
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

//////////////////////////////////////////////////////////////
/* INICIO - Ver Imagen */
function VerImagenProducto(seleccion) {
  var nvchDireccionImg = $(seleccion).attr("imagen");
  $("#CuadroImagenHeader").css("background-color", "#78909c");
    $("#CuadroImagenTitulo").css("color", "#FFFFFF");
    $("#CuadroImagenFooter").css("background-color", "#cfd8dc");
    $("#CuadroImagenTitulo").html("Imágen del Producto");
  
  //$("#DireccionImgProducto").html("<img class='img-responsive center-block' alt='' src='../../datos/inventario/imgproducto/"+nvchDireccionImg+"' />");

  /* Mostrara una imagen nula si el producto no posee imagen */
  if(!nvchDireccionImg){
    $("#DireccionImgProducto").html("<img class='img-responsive center-block' style='width: 400px' src='../../datos/inventario/imgproducto/productosinfoto.png'/>");
  }else{
    $("#DireccionImgProducto").html("<img class='img-responsive center-block' style='width: 400px' src='../../datos/inventario/imgproducto/"+nvchDireccionImg+"' />");
  }
  
  $("#CuadroImagen").modal("show");
}
/* FIN - Ver Imagen */
//////////////////////////////////////////////////////////////



//////////////////////////////////////////////-- PRODUCTO --/////////////////////////////////////////////////





//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Ubicaciones del Producto Seleccionado */
function MostrarUbigeo(intIdProducto,tipolistado) {
  var funcion = "MUP";
    $.ajax({
     url:"../../datos/inventario/funcion_producto.php",
     method:"POST",
     data:{intIdProducto:intIdProducto,funcion:funcion,tipolistado:tipolistado},
     success:function(datos)
     {
      $("#ListaDeUbicaciones").html(datos);
     }
    });
}
/* FIN - Mostrar Ubicaciones del Producto Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Insertar Ubigeo Nueva */
function AgregarUbigeo_II() {
  if(EsVacio("nvchUbicacion") == false){
    return false;
  }
  if(EsNumeroEntero("intCantidadUbigeo") == false){
    return false;
  }
  var intIdProducto = document.getElementById("intIdProducto").value;
  var intIdSucursal = document.getElementById("intIdSucursal").value;
  var nvchUbicacion = document.getElementById("nvchUbicacion").value;
  var intCantidadUbigeo = document.getElementById("intCantidadUbigeo").value;
  var tipolistado = "I";
  var funcion = "IUP";
  var y = document.getElementById("num-lista").value;
    var x = $(".marca").attr("idp") * y;
    $.ajax({
     url:"../../datos/inventario/funcion_producto.php",
     method:"POST",
     data:{intIdProducto:intIdProducto,
        intIdSucursal:intIdSucursal,
        nvchUbicacion:nvchUbicacion,
        intCantidadUbigeo:intCantidadUbigeo,
        funcion:funcion},
     success:function(datos)
     {
      datos = datos.replace(/\s/g,''); 
      if(datos == "okok"){
        MensajeNormal("Se agregó correctamente el Ubigeo del Producto",1);
        MostrarUbigeo(intIdProducto,tipolistado);
        ListarProducto(x,y,$("#tipo-busqueda").val());
        PaginarProducto(x,y,$("#tipo-busqueda").val());
      } else {
        alert(datos);
      }
     }
    });
}
/* FIN - Insertar Ubigeo Nueva */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Actualizar Ubigeo Seleccionado */
function ActualizarUbigeo() {
  if(EsVacio("nvchUbicacion") == false){
    return false;
  }
  if(EsNumeroEntero("intCantidadUbigeo") == false){
    return false;
  }
  var intIdUbigeoProducto = document.getElementById("intIdUbigeoProducto").value;
  var intIdProducto = document.getElementById("intIdProducto").value;
  var intIdSucursal = document.getElementById("intIdSucursal").value;
  var nvchUbicacion = document.getElementById("nvchUbicacion").value;
  var intCantidadUbigeo = document.getElementById("intCantidadUbigeo").value;
  var tipolistado = "A";
  var accion = "I";
  var funcion = "AUP";
  var y = document.getElementById("num-lista").value;
    var x = $(".marca").attr("idp") * y;
    $.ajax({
     url:"../../datos/inventario/funcion_producto.php",
     method:"POST",
     data:{intIdUbigeoProducto:intIdUbigeoProducto,
        intIdProducto:intIdProducto,
        intIdSucursal:intIdSucursal,
        nvchUbicacion:nvchUbicacion,
        intCantidadUbigeo:intCantidadUbigeo,
        funcion:funcion},
     success:function(datos)
     {
      datos = datos.replace(/\s/g,''); 
      if(datos == "okok"){
        MensajeNormal("Se modificó correctamente el Ubigeo del Producto",1);
        MostrarUbigeo(intIdProducto,tipolistado);
        BotonesUbigeo(accion);
        ListarProducto(x,y,$("#tipo-busqueda").val());
        PaginarProducto(x,y,$("#tipo-busqueda").val());
      } else {
        alert(datos);
      }
     }
    });
}
/* FIN - Actualizar Ubigeo Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Mostrar Ubigeo Seleccionado */
function SeleccionarUbigeo(seleccion) {
  var intIdUbigeoProducto = $(seleccion).attr("idup");
  var funcion = "SUP";
    $.ajax({
     url:"../../datos/inventario/funcion_producto.php",
     method:"POST",
     data:{intIdUbigeoProducto:intIdUbigeoProducto,funcion:funcion},
     dataType:"json",
     success:function(datos)
     {
      $("#intIdUbigeoProducto").val(datos.intIdUbigeoProducto);
      $("#intIdSucursal").val(datos.intIdSucursal);
      $("#nvchUbicacion").val(datos.nvchUbicacion);
      $("#intCantidadUbigeo").val(datos.intCantidadUbigeo);
      BotonesUbigeo('A');
     }
    });
}
/* FIN - Mostrar Ubigeo Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Ubigeo Seleccionado */
function EliminarUbigeo(seleccion) {
  var intIdUbigeoProducto = $(seleccion).attr("idup");
  var intIdProducto = document.getElementById("intIdProducto").value;
  var funcion = "EUP";
  var tipolistado = "T";
    $.ajax({
     url:"../../datos/inventario/funcion_producto.php",
     method:"POST",
     data:{intIdUbigeoProducto:intIdUbigeoProducto,funcion:funcion},
     success:function(datos)
     {
       datos = datos.replace(/\s/g,''); //quita los espacios del FLAG OK
       if(datos=="ok"){
        MensajeNormal("Se eliminó correctamente el Ubigeo del Producto",1);
        MostrarUbigeo(intIdProducto,tipolistado);
        ListarProducto(x,y,$("#tipo-busqueda").val());
        PaginarProducto(x,y,$("#tipo-busqueda").val());
       } else {
        alert(datos);
       }
     }
    });
}
/* FIN - Eliminar Ubigeo Seleccionado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function BotonesUbigeo(accion) {
  if(accion == "I"){
    RestablecerValidacion("nvchUbicacion",1);
    RestablecerValidacion("intCantidadUbigeo",1);
    $("#btn-agregar-ubigeo-mostrar").show();
    $("#btn-actualizar-ubigeo").hide();
    $("#btn-cancelar-ubigeo").hide();

  } else if (accion == "A") {
    RestablecerValidacion("nvchUbicacion",2);
    RestablecerValidacion("intCantidadUbigeo",2);
    $("#btn-agregar-ubigeo-mostrar").hide();
    $("#btn-actualizar-ubigeo").show();
    $("#btn-cancelar-ubigeo").show();

  }
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ver Detalle del Ubigeo del Producto Solicitado */
function VerDetalleUbigeo(seleccion) {
  var nvchCodigo = $(seleccion).attr("codigo");
  var intIdProducto = $(seleccion).attr("id");
  var funcion = "VDU";
    $.ajax({
     url:"../../datos/inventario/funcion_producto.php",
     method:"POST",
     data:{intIdProducto:intIdProducto,funcion:funcion},
     success:function(datos)
     {
      $("#CodigoProducto").html(nvchCodigo);
      $("#DetalleUbigeo").html(datos);
      goToBox("#TablaDetalleUbigeo");
     }
    });
}
/* FIN - Ver Detalle del Ubigeo del Producto Solicitado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ver Detalle del Ubigeo del Producto Solicitado */
function LimpiarDetalleUbigeo() {
    $("#CodigoProducto").html("");
    $("#DetalleUbigeo").html("");
}
/* FIN - Ver Detalle del Ubigeo del Producto Solicitado */
//////////////////////////////////////////////////////////////

</script>