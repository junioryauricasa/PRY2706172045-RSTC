<script>
var intTipoDetalle = 0;
var intIdTipoComprobante = 0;
function TipoLetra(){
      var intIdTipoVenta = $("#intIdTipoVenta").val();
      var Letra = "";
      switch(intIdTipoVenta){
        case "1":
          Letra = "";
          break;
        case "2":
          Letra = "S";
          break;
        case "3":
          Letra = "M";
          break;
        case "4":
          Letra = "I";
          break;
      }
      $("#Letra").val(Letra);
      return Letra;
    }

    function TipoTabla(){
      var intIdTipoVenta = $("#intIdTipoVenta").val();
      var Tabla = "";
      switch(intIdTipoVenta){
        case "1":
          Tabla = "Productos";
          break;
        case "2":
          Tabla = "Servicios";
          break;
        case "3":
          Tabla = "Maquinarias";
          break;
        case "4":
          Tabla = "Implementos";
          break;
      }
      $("#Tabla").val(Tabla);
      return Tabla;
    }

function CambiarMoneda(){
  var intIdTipoVenta = $("#intIdTipoVenta").val();
  var intIdTipoMoneda = $("#intIdTipoMonedaC").val();
  var dcmDescuento = 0.00;
  var intCantidad = 0;
  var dcmPrecio = 0.00;
  var dcmPrecioUnitario = 0.00;
  var dcmTotal = 0.00;

  Number(dcmPrecio);
  Number(dcmPrecioUnitario);
  Number(dcmTotal);
  Number(dcmDescuento);
  Number(intCantidad);

  var Letra = TipoLetra();
  var Tabla = TipoTabla();

  var funcion = "MF";
  var nvchFecha = $("#nvchFecha").val();
  var intIdTipoComprobante = $("#intIdTipoComprobante").val();
    $.ajax({
     url:"../../datos/administrativo/funcion_moneda_comercial.php",
     method:"POST",
     data:{funcion:funcion,nvchFecha:nvchFecha},
     success:function(datos)
     {
      if(intIdTipoVenta == 1){
        if(intIdTipoComprobante < 5){
          $('table tbody#ListaDeProductosVender tr').each(function() {
              $(this).find("td input[name='fila[]']").each(function() {
                if($("#dcmPrecio"+this.value).val() != ""){
                  dcmPrecio = $("#dcmPrecio"+this.value).val();
                  dcmDescuento = $("#dcmDescuento"+this.value).val();
                  intCantidad = $("#intCantidad"+this.value).val();
                  Number(datos);

                  if(intIdTipoMoneda == 1) {
                    dcmPrecio = (dcmPrecio * datos).toFixed(2);
                  } else if(intIdTipoMoneda == 2){
                    dcmPrecio = (dcmPrecio / datos).toFixed(2);
                  }

                  $("#dcmPrecio"+this.value).val(dcmPrecio);

                  if($("#dcmDescuento"+this.value).val() != ""){
                      dcmPrecioUnitario = (dcmPrecio - (dcmPrecio*(dcmDescuento/100))).toFixed(2);
                    $("#dcmPrecioUnitario"+this.value).val(dcmPrecioUnitario);
                  }
                  if($("#intCantidad"+this.value).val() != ""){
                    dcmTotal = (dcmPrecioUnitario * intCantidad).toFixed(2);
                    $("#dcmTotal"+this.value).val(dcmTotal);
                  }
              }
              }); 
          });
        } else if (intIdTipoComprobante >= 5){
          $('table tbody#ListaDe'+Tabla+'Vender tr').each(function() {
              $(this).find("td input[name='fila[]']").each(function() {
                if($("#dcmPrecioUnitario"+Letra+this.value).val() != ""){
                  dcmPrecioUnitario = $("#dcmPrecioUnitario"+Letra+this.value).val();
                intCantidad = $("#intCantidad"+Letra+this.value).val();
                Number(datos);
                if($("#dcmPrecioUnitario"+Letra+this.value).val() != ""){
                    if(intIdTipoMoneda == 1){
                      dcmPrecioUnitario = (dcmPrecioUnitario * datos).toFixed(2);
                    } else if(intIdTipoMoneda == 2){
                      dcmPrecioUnitario = (dcmPrecioUnitario / datos).toFixed(2);
                    }
                    $("#dcmPrecioUnitario"+Letra+this.value).val(dcmPrecioUnitario);
                  }

                  if($("#intCantidad"+Letra+this.value).val() != ""){
                    dcmTotal = (dcmPrecioUnitario * intCantidad).toFixed(2);
                    $("#dcmTotal"+Letra+this.value).val(dcmTotal);
                  }
              }
              }); 
          });
        }
      } else if(intIdTipoVenta >= 2){
      $('table tbody#ListaDe'+Tabla+'Vender tr').each(function() {
          $(this).find("td input[name='fila[]']").each(function() {
            if($("#dcmPrecioUnitario"+Letra+this.value).val() != ""){
            dcmPrecioUnitario = $("#dcmPrecioUnitario"+Letra+this.value).val();
            intCantidad = $("#intCantidad"+Letra+this.value).val();
            Number(datos);
            if($("#dcmPrecioUnitario"+Letra+this.value).val() != ""){
                if(intIdTipoMoneda == 1){
                  dcmPrecioUnitario = (dcmPrecioUnitario * datos).toFixed(2);
                } else if(intIdTipoMoneda == 2){
                  dcmPrecioUnitario = (dcmPrecioUnitario / datos).toFixed(2);
                }
                $("#dcmPrecioUnitario"+Letra+this.value).val(dcmPrecioUnitario);
              }

              if($("#intCantidad"+Letra+this.value).val() != ""){
                dcmTotal = (dcmPrecioUnitario * intCantidad).toFixed(2);
                $("#dcmTotal"+Letra+this.value).val(dcmTotal);
              }
            }
          }); 
      });
      }
      CalcularTotal();
     }
    });
}

function CalcularTotal(){
  var intIdTipoMoneda = $("#intIdTipoMonedaC").val();
  var nvchSimbolo = "";

  if(intIdTipoMoneda == 1){
    nvchSimbolo = "S/.";
  } else if (intIdTipoMoneda == 2){
    nvchSimbolo = "US$";
  }

  var ComprobanteTotal = 0.00;
  var IGVComprobante = 0.00;
  var ValorComprobante = 0.00;
  Number(IGVComprobante);
  Number(ComprobanteTotal);
  Number(ValorComprobante);

  var Letra = TipoLetra();
  var Tabla = TipoTabla();

  $('table tbody#ListaDe'+Tabla+'Vender tr').each(function() {
        $(this).find("td input[name='dcmTotal"+Letra+"[]']").each(function() {
            ComprobanteTotal = ComprobanteTotal + Number(this.value);
        }); 
    });
    ValorComprobante = (ComprobanteTotal / 1.18).toFixed(2);
    IGVComprobante = (ComprobanteTotal - ValorComprobante).toFixed(2);
    ComprobanteTotal = ComprobanteTotal.toFixed(2);
  $("#ValorComprobante").val(nvchSimbolo + ' ' + ValorComprobante);
    $("#IGVComprobante").val(nvchSimbolo + ' ' + IGVComprobante);
  $("#ComprobanteTotal").val(nvchSimbolo + ' ' + ComprobanteTotal);
}

function MostrarDetalleComprobante(intIdComprobante,intIdTipoVenta) {
  var funcion = "MDCR";
    $.ajax({
     url:"../../datos/comprobante/funcion_comprobante.php",
     method:"POST",
     data:{intIdComprobante:intIdComprobante,funcion:funcion,intIdTipoVenta:intIdTipoVenta},
     success:function(datos)
     {
      if(intIdTipoVenta == 1){
        $("#ListaDeProductosVender").html(datos);
        num = document.getElementById('ListaDeProductosVender').rows.length + 1;
        $("#ListaDeProductosVender input").attr("readonly",true);
      } else if(intIdTipoVenta == 2){
        $("#ListaDeServiciosVender").html(datos);
        nums = document.getElementById('ListaDeServiciosVender').rows.length + 1;
        $("#ListaDeServiciosVender input").attr("readonly",true);
      } else if(intIdTipoVenta == 3){
        $("#ListaDeMaquinariasVender").html(datos);
        numm = document.getElementById('ListaDeMaquinariasVender').rows.length + 1;
        $("#ListaDeMaquinariasVender input").attr("readonly",true);
      } else if(intIdTipoVenta == 4){
        $("#ListaDeImplementosVender").html(datos);
        numi = document.getElementById('ListaDeImplementosVender').rows.length + 1;
        $("#ListaDeImplementosVender input").attr("readonly",true);
      }
      CamposTabla(intTipoDetalle,intIdTipoComprobante);
      CalcularTotal();
     }
    });
}

function ElegirTabla(intIdTipoVenta){
  if(intIdTipoVenta == 1){
    $("#tablaRepuestos").show();
    $("#tablaServicios").hide();
    $("#tablaMaquinarias").hide();
    $("#tablaImplementos").hide();
    CalcularTotal();
  } else if(intIdTipoVenta == 2) {
    $("#tablaRepuestos").hide();
    $("#tablaServicios").show();
    $("#tablaMaquinarias").hide();
    $("#tablaImplementos").hide();
    CalcularTotal();
  } else if(intIdTipoVenta == 3) {
    $("#tablaRepuestos").hide();
    $("#tablaServicios").hide();
    $("#tablaMaquinarias").show();
    $("#tablaImplementos").hide();
    CalcularTotal();
  } else if(intIdTipoVenta == 4) {
    $("#tablaRepuestos").hide();
    $("#tablaServicios").hide();
    $("#tablaMaquinarias").hide();
    $("#tablaImplementos").show();
    CalcularTotal();
  }
}

$(document).on('click', '.btn-mostrar-comprobante', function(){
var intIdComprobante = $(this).attr("id");
var funcion = "M";
var tipolistado = "T";
  if(intIdComprobante != 0){
    $.ajax({
     url:"../../datos/comprobante/funcion_comprobante.php",
     method:"POST",
     data:{intIdComprobante:intIdComprobante,funcion:funcion},
     dataType:"json",
     success:function(datos)
     {
      $("#intIdComprobante").val(datos.intIdComprobante);
      $("#nvchFecha").val(datos.dtmFechaCreacion);
      $("#intIdSucursalC").val(datos.intIdSucursal);
      $("#intIdTipoComprobante").val(datos.intIdTipoComprobante);
      $("#nvchSerie").val(datos.nvchSerie);
      $("#nvchNumeracion").val(datos.nvchNumeracion);
      $("#intIdTipoVenta").val(datos.intIdTipoVenta);
      $("#intIdTipoMoneda").val(datos.intIdTipoMoneda);
      $("#intIdTipoPago").val(datos.intIdTipoPago);
      $("#nvchNumDocumento").val(datos.nvchDNIRUC);
      $("#nvchDenominacion").val(datos.nvchClienteProveedor);
      $("#nvchDomicilio").val(datos.nvchDireccion);
      $("#TipoCliente").val(datos.TipoCliente);
      $("#intIdTipoCliente").val(datos.intIdTipoCliente);
      $("#intIdClienteC").val(datos.intIdCliente);
      $("#intIdProveedorC").val(datos.intIdProveedor);
      $("#intIdUsuarioSolicitado").val(datos.intIdUsuarioSolicitado); // Guías Internas
      $("#nvchAtencion").val(datos.nvchAtencion); // Guía Interna de Salida
      $("#nvchDestino").val(datos.nvchDestino); // Guía Interna de Salida
      $("#nvchPuntoPartida").val(datos.nvchPuntoPartida);
      $("#nvchPuntoLlegada").val(datos.nvchPuntoLlegada);
      $("#intIdComprobanteReferencia").val(datos.intIdComprobanteReferencia);
      $("#intDescontarGR").val(datos.intDescontarGR);
      $("#dtmFechaTraslado").val(datos.dtmFechaTraslado);
      $("textarea#nvchObservacion").val(datos.nvchObservacion);

      $('#intIdSucursalC').attr("disabled", true);
      $('#intIdTipoComprobante').attr("disabled", true);
      $('#intIdTipoVenta').attr("disabled", true);
      $('#intIdTipoPago').attr("disabled", true);
      $("#nvchSerie").attr("readonly",true);
      $("#nvchNumeracion").attr("readonly",true);
      if((datos.intTipoDetalle == 1 && datos.intIdTipoComprobante != 8) || datos.intIdTipoComprobante == 4)
        $("#TipoClienteCol").show();
      else
        $("#TipoClienteCol").hide();

      ElegirTabla(datos.intIdTipoVenta);
      MostrarDetalleComprobante(datos.intIdComprobante,datos.intIdTipoVenta);
      intTipoDetalle = datos.intTipoDetalle;
      intIdTipoComprobante = datos.intIdTipoComprobante;
      //CamposTabla(datos.intTipoDetalle,datos.intIdTipoComprobante);
      CamposComprobante(datos.intIdTipoComprobante);
      $("#formComprobante").modal("show");
      if((datos.intTipoDetalle == 1 && datos.intIdTipoComprobante != 8) || datos.intIdTipoComprobante == 4)
        $("#lblTituloComprobante").html("Detalles del Comprobante de Venta");
      else 
        $("#lblTituloComprobante").html("Detalles del Comprobante de Compra");
     }
    });
  } else {
      MensajeNormal('La Apertura no tiene Comprobante',1);
  }
  return false;
});

function CamposComprobante(intIdTipoComprobante){
  if(intIdTipoComprobante == 10 || intIdTipoComprobante == 9)
    $("#intIdUsuarioSolicitadoCol").show();
  else
    $("#intIdUsuarioSolicitadoCol").hide();
  if(intIdTipoComprobante == 9){
    $("#nvchAtencionCol").show();
    $("#nvchDestinoCol").show();
    $(".filaPrecio").hide();
    $(".filaDescuento").hide();
    $(".txtPrecioUnitario").attr("readonly",false);
  } else {
    $("#nvchAtencionCol").hide();
    $("#nvchDestinoCol").hide();
    $(".filaPrecio").show();
    $(".filaDescuento").show();
    $(".txtPrecioUnitario").attr("readonly",true);
  }
  if(intIdTipoComprobante == 1 || intIdTipoComprobante == 2)
    $("#btnAgregarCotizacion").show();
  else 
    $("#btnAgregarCotizacion").hide();
  if(intIdTipoComprobante == 3 || intIdTipoComprobante == 4)
    $("#btnAgregarVenta").show();
  else
    $("#btnAgregarVenta").hide();

  if(intIdTipoComprobante == 3 || intIdTipoComprobante == 7){
    $("#btnDescontarGR").show();
  } else {
    $("#btnDescontarGR").hide();
  }

  if(intIdTipoComprobante == 3){
    $("#dtmFechaTrasladoCol").show();
    $("#nvchPuntoPartidaCol").show();
    $("#nvchPuntoLlegadaCol").show();
  } else {
    $("#dtmFechaTrasladoCol").hide();
    $("#nvchPuntoPartidaCol").hide();
    $("#nvchPuntoLlegadaCol").hide();
  }
}

function CamposTabla(intTipoDetalle,intIdTipoComprobante){
  if((intTipoDetalle == 1 && intIdTipoComprobante == 9) || intTipoDetalle == 2 || intIdTipoComprobante == 3 ||
    intIdTipoComprobante == 4 || intIdTipoComprobante == 8){
      if(intIdTipoComprobante == 3 || intIdTipoComprobante == 7){
        $(".filaPrecio").hide();
        $(".filaDescuento").hide();
        $(".filaPrecioUnitario").hide();
        $(".filaTotal").hide();
        $(".txtTotales").hide();
      } else if(intIdTipoComprobante == 4 || intIdTipoComprobante == 8){
        $(".filaPrecio").hide();
        $(".filaDescuento").hide();
        $(".filaPrecioUnitario").show();
        $(".filaTotal").show();
        $(".txtTotales").show();
        $(".txtPrecioUnitario").attr("readonly",true);
      } else {
        $(".filaPrecio").hide();
        $(".filaDescuento").hide();
        $(".filaPrecioUnitario").show();
        $(".filaTotal").show();
        $(".txtTotales").show();
        $(".txtPrecioUnitario").attr("readonly",false);
      }
    } else {
      $(".filaPrecio").show();
      $(".filaDescuento").show();
      $(".filaPrecioUnitario").show();
      $(".filaTotal").show();
      $(".txtTotales").show();
      $(".txtPrecioUnitario").attr("readonly",true);
    }
}

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
  $("#lblTituloDetalleKardex").html("Kardex del Producto: "+$("#nvchCodigo").val());

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
function ReporteKardexPDF() {
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
            '&intIdTipoMoneda='+intIdTipoMoneda+'&intIdSucursal='+intIdSucursal;
  window.open(url);
}
/* FIN - Funcion Ajax - Reporte Kardex */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Producto para descargar reporte en excel*/
function ReporteKardexExcel() {
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
  var url = '../../datos/reportes/clases_kardex/reporte_kardex_producto_excel.php?intIdProducto='+
  intIdProducto+'&busqueda='+busqueda+'&dtmFechaInicial='+dtmFechaInicial+'&dtmFechaFinal='+
  dtmFechaFinal+'&intIdTipoMoneda='+intIdTipoMoneda+'&intIdSucursal='+intIdSucursal;
  window.location.href = url;
}
/* FIN - Funcion Ajax - Mostrar Producto para descargar reporte en excel */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Kardex */
function PaginarKardex(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
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
  var nvchCodigo = $(seleccion).attr("cod");
  $("#nvchCodigo").val(nvchCodigo);
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