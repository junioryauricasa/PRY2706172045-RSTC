<script>
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

$(document).on('change', '#intIdSucursal', function(){
  var y = document.getElementById("num-lista").value;
  var x = $(".marca").attr("idp") * y;
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
/* FIN - Funcion Ajax - Buscar Kardex Realizada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Kardex */
function ListarKardex(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
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
      url:'../../datos/reportes/funcion_kardex_general.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,dtmFechaInicial:dtmFechaInicial,
        dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda,intIdSucursal:intIdSucursal},
      success:function(datos) {
	      $("#ListaDeKardex").html(datos);
	      PaginarKardex((x/y),y,tipolistado);
        TotalKardexValorizado();
      }
  });
}
/* FIN - Funcion Ajax - Listar Kardex */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Total Kardex Valorizado */
function TotalKardexValorizado() {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "TK";
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
      url:'../../datos/reportes/funcion_kardex_general.php',
      method:"POST",
      data:{busqueda:busqueda,funcion:funcion,dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,
            intIdTipoMoneda:intIdTipoMoneda,intIdSucursal:intIdSucursal},
      success:function(datos) {
          $("#TotalKardexValorizado").val(datos);
      }
  });
}
/* FIN - Funcion Ajax - Total Kardex Valorizado */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Reporte Kardex */
function ReporteKardex() {
  var busqueda = document.getElementById("txt-busqueda").value;
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
  var url = '../../datos/reportes/clases_kardex/reporte_kardex_general.php?busqueda='+busqueda+'&dtmFechaInicial='+
            dtmFechaInicial+'&dtmFechaFinal='+dtmFechaFinal+'&intIdTipoMoneda='+intIdTipoMoneda+'&intIdSucursal='+intIdSucursal;
  window.open(url, '_blank');
}
/* FIN - Funcion Ajax - Reporte Kardex */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Producto para descargar reporte en excel*/
function ReporteKardexExcel() {
  var busqueda = document.getElementById("txt-busqueda").value;
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
  var url = '../../datos/reportes/clases_kardex/reporte_kardex_general_excel.php?busqueda='+busqueda+'&dtmFechaInicial='+dtmFechaInicial+'&dtmFechaFinal='+dtmFechaFinal+'&intIdTipoMoneda='+intIdTipoMoneda+'&intIdSucursal='+intIdSucursal;
  window.location.href = url;
}
/* FIN - Funcion Ajax - Mostrar Producto para descargar reporte en excel */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Kardex */
function PaginarKardex(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";

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
      url:'../../datos/reportes/funcion_kardex_general.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,dtmFechaInicial:dtmFechaInicial,
        dtmFechaFinal:dtmFechaFinal},
      success:function(datos) {
          $("#PaginacionDeKardex").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Kardex */
//////////////////////////////////////////////////////////////
</script>