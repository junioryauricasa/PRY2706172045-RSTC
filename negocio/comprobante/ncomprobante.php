<script>
//////////////////////////////////////////////////////////////
/* INICIO - Operaciones de Comprobante */
	  var numprtst = 0; Number(numprtst);
    var numprt = 0; Number(numprt);
    var num = 2;
    var nums = 2;
    var numm = 2;
    var numi = 2;
    var numfila = 0;
    $(document).on('keyup', '.buscar', function(evt){
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if(charCode == 40 || charCode == 38)
        return false;

      $(this).closest('tr').find("input[name='fila[]']").each(function() {
         numfila = this.value;
      });

      var search = $(this).val();
      search = search.replace(/\s/g,'');
      var funcion = "BP"
      if(search != '')
      {
        var intIdTipoMoneda = $("#intIdTipoMoneda").val();
        $.ajax({
          type: "POST",
          url: "../../datos/inventario/funcion_producto.php",
          data: {search:search,funcion:funcion,intIdTipoMoneda:intIdTipoMoneda},
          cache: false,
          success: function(html)
          {
            $("#result"+numfila).html(html).show();
            numprt = $("#result"+numfila+" li").length;
            numprtst = 0;
            $(".result li:eq("+numprtst+")").css("background","#4C66A4");
            $(".result li:eq("+numprtst+")").css("color","#FFFFFF");
          }
        });
      }
      else {
        $("#result"+numfila).html("").hide();
      }
      return false; 
    });

    $(document).on('click', '.result', function(e){
      var clicked = $(e.target);
      if(!clicked.find('.nvchCodigo').html()) {
        $("#formProducto").modal("show");
      } else {
        var nvchCodigo = clicked.find('.nvchCodigo').html();
        var intIdProducto = clicked.find('.intIdProducto').val();
        nvchCodigo = nvchCodigo.replace(/\s/g,'');
        intIdProducto = intIdProducto.replace(/\s/g,'');
        $('#nvchCodigo'+numfila).val(nvchCodigo);
        $(".result").html("").hide();
        InsertarProductoElegido(intIdProducto,numfila);
      }
      numfila = 0;
    });

    $(document).on('click', '.buscar', function(){
      $(".result").html("").hide();
    });

    $(document).on('click', function(e){
      var clicked = $(e.target);
      if (!clicked.hasClass("buscar")){
        $(".result").html("").hide();
      }
    });

    $(document).on('click', '.buscar', function(){
      $(".result").html("").hide();
    });

    $(document).on('click', function(e){
      var clicked = $(e.target);
      if (!clicked.hasClass("buscar")){
        $(".result").html("").hide();
      }
    });

    function TeclaSeleccionCodigo(evt){
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if($(".result").is(":visible")){
        switch(charCode){
          case 13:
              var nvchCodigo = $(".result li:eq("+numprtst+")").find('.nvchCodigo').html();
              var intIdProducto = $(".result li:eq("+numprtst+")").find('.intIdProducto').val();
              nvchCodigo = nvchCodigo.replace(/\s/g,'');
              intIdProducto = intIdProducto.replace(/\s/g,'');
              $('#nvchCodigo'+numfila).val(nvchCodigo);
              $('#nvchCodigo'+numfila).blur();
              $(".result").html("").hide();
              InsertarProductoElegido(intIdProducto,numfila);
            break;
          case 38:
              $(".result li:eq("+numprtst+")").css("background","#FFFFFF");
              $(".result li:eq("+numprtst+")").css("color","#000000");

              if(numprtst + 1 <= numprt && numprtst > 0)
                numprtst--;
              
              $(".result li:eq("+numprtst+")").css("background","#4C66A4");
              $(".result li:eq("+numprtst+")").css("color","#FFFFFF");
            break;
          case 40:
              $(".result li:eq("+numprtst+")").css("background","#FFFFFF");
              $(".result li:eq("+numprtst+")").css("color","#000000");

              if(numprtst < numprt-1)
                numprtst++;

              $(".result li:eq("+numprtst+")").css("background","#4C66A4");
              $(".result li:eq("+numprtst+")").css("color","#FFFFFF");
              return false;
            break;
        }
      }
    }

    function InsertarProductoElegido(intIdProducto,id){
      var funcion = "SP";
      var intIdTipoMoneda = $("#intIdTipoMoneda").val();
      $.ajax({
       url:"../../datos/inventario/funcion_producto.php",
       method:"POST",
       data:{intIdProducto:intIdProducto,funcion:funcion,intIdTipoMoneda:intIdTipoMoneda},
       dataType:"json",
       success:function(datos)
       {
        $("#intIdProducto"+id).val(datos.intIdProducto);
        $("#dcmPrecio"+id).val(datos.dcmPrecioVenta1);
        $("#nvchDescripcion"+id).val(datos.nvchDescripcion);
        $("#dcmDescuentoVenta2"+id).val(datos.dcmDescuentoVenta2);
        $("#dcmDescuentoVenta3"+id).val(datos.dcmDescuentoVenta3);
       }
      });
    }

    function AgregarFila(intIdTipoVenta){
    var intTipoDetalle = $("#intTipoDetalle").val();
    var intIdTipoComprobante = $("#intIdTipoComprobanteI").val();
    var camposVender = '';
    var readonlyVender = '';
    if(intTipoDetalle == 1 && intIdTipoComprobante == 0){
    	camposVender ='<td>'+
			            '<input type="text" id="dcmPrecio'+num+'" name="dcmPrecio[]" form="form-comprobante" readonly />'+
			            '<input type="hidden" id="dcmDescuentoVenta2'+num+'" form="form-comprobante" readonly />'+
			            '<input type="hidden" id="dcmDescuentoVenta3'+num+'" form="form-comprobante" readonly />'+
			          '</td>'+
			          '<td><input type="text" style="max-width: 105px !important" id="dcmDescuento'+num+'" name="dcmDescuento[]" form="form-comprobante" idsprt="'+num+'"'+
			            'onkeyup="CalcularPrecioTotal(this)"/></td>';
      readonlyVender = 'readonly';
	}
    if(intIdTipoVenta == 1){
        $('#ListaDeProductosVender').append(
        '<tr>'+
          '<td class="heading" data-th="ID"></td>'+
          '<td><input type="hidden" style="width: 110px !important" name="fila[]" value="'+num+'" form="form-comprobante" />'+
              '<input type="hidden" style="width: 110px !important" id="intIdProducto'+num+'" name="intIdProducto[]" form="form-comprobante" />'+
              '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigo'+num+'" name="nvchCodigo[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>'+
              '<div class="result" id="result'+num+'">'+
          '</td>'+
          '<td><input type="text" style="width: 100% !important" id="nvchDescripcion'+num+'" name="nvchDescripcion[]" form="form-comprobante" readonly/></td>'+
          camposVender+
          '<td><input type="text" style="max-width: 105px !important" id="dcmPrecioUnitario'+num+'" name="dcmPrecioUnitario[]" form="form-comprobante" onkeyup="CalcularPrecioTotal(this)" idsprt="'+num+'" '+readonlyVender+' /></td>'+
          '<td><input type="text" id="intCantidad'+num+'" name="intCantidad[]" form="form-comprobante" idsprt="'+num+'"'+
            'onkeyup="CalcularPrecioTotal(this)"/></td>'+
          '<td><input type="text" id="dcmTotal'+num+'" name="dcmTotal[]" form="form-comprobante" readonly/></td>'+
          '<td>'+
            '<button type="button" style="width: 25px !important" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit" data-toggle="tooltip" title="Eliminar!"></i></button>'+
          '</td>'+
        '</tr>');
        num++;
      } else if(intIdTipoVenta == 2){
        $('#ListaDeServiciosVender').append(
        '<tr>'+
          '<td class="heading" data-th="ID"></td>'+
          '<td>'+
            '<input style="width: 110px !important" type="hidden" name="fila[]" value="'+nums+'" form="form-comprobante" />'+
            '<textarea id="nvchDescripcionS'+nums+'" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionS[]" form="form-comprobante" rows="4"></textarea>'+
          '</td>'+
          '<td>'+
            '<input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioS'+nums+'" name="dcmPrecioUnitarioS[]" idsprt="'+nums+'" form="form-comprobante" onkeyup="CalcularPrecioTotalS(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="intCantidadS'+nums+'" name="intCantidadS[]" idsprt="'+nums+'" form="form-comprobante" onkeyup="CalcularPrecioTotalS(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="dcmTotalS'+nums+'" name="dcmTotalS[]" form="form-comprobante" readonly/>'+
          '</td>'+
          '<td style="width: 25px !important" >'+
            '<button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">'+
                '<i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i>' +
            '</button>'+
          '</td>'+
        '</tr>');
        nums++;
      } else if(intIdTipoVenta == 3){
        $('#ListaDeMaquinariasVender').append(
        '<tr>'+
          '<td class="heading" data-th="ID"></td>'+
          '<td><input type="hidden" style="width: 110px !important" name="fila[]" value="'+num+'" form="form-comprobante" />'+
              '<input type="hidden" style="width: 110px !important" id="intIdProductoM'+num+'" name="intIdProducto[]" form="form-comprobante" />'+
              '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigoM'+num+'" name="nvchCodigoM[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>'+
              '<div class="result" id="resultM'+num+'">'+
          '</td>'+
          '<td>'+
            '<input style="width: 110px !important" type="hidden" name="fila[]" value="'+numm+'" form="form-comprobante" />'+
            '<textarea id="nvchDescripcionM'+numm+'" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionM[]" form="form-comprobante" rows="4"></textarea>'+
          '</td>'+
          '<td>'+
            '<input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioM'+numm+'" name="dcmPrecioUnitarioM[]" idsprt="'+numm+'" form="form-comprobante" onkeyup="CalcularPrecioTotalM(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="intCantidadM'+numm+'" name="intCantidadM[]" idsprt="'+numm+'" form="form-comprobante" onkeyup="CalcularPrecioTotalM(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="dcmTotalM'+numm+'" name="dcmTotalM[]" form="form-comprobante" readonly/>'+
          '</td>'+
          '<td style="width: 25px !important" >'+
            '<button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">'+
                '<i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i>' +
            '</button>'+
          '</td>'+
        '</tr>');
        numm++;
      } else if(intIdTipoVenta == 4){
        $('#ListaDeImplementosVender').append(
        '<tr>'+
          '<td class="heading" data-th="ID"></td>'+
          '<td><input type="hidden" style="width: 110px !important" name="fila[]" value="'+num+'" form="form-comprobante" />'+
              '<input type="hidden" style="width: 110px !important" id="intIdProductoI'+num+'" name="intIdProducto[]" form="form-comprobante" />'+
              '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigoI'+num+'" name="nvchCodigoI[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>'+
              '<div class="result" id="resultI'+num+'">'+
          '</td>'+
          '<td>'+
            '<input style="width: 110px !important" type="hidden" name="fila[]" value="'+numi+'" form="form-comprobante" />'+
            '<textarea id="nvchDescripcionI'+numi+'" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionI[]" form="form-comprobante" rows="4"></textarea>'+
          '</td>'+
          '<td>'+
            '<input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioI'+numi+'" name="dcmPrecioUnitarioI[]" idsprt="'+numi+'" form="form-comprobante" onkeyup="CalcularPrecioTotalI(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="intCantidadI'+numi+'" name="intCantidadI[]" idsprt="'+numi+'" form="form-comprobante" onkeyup="CalcularPrecioTotalI(this)"/>'+
          '</td>'+
          '<td>'+
            '<input type="text" id="dcmTotalI'+numi+'" name="dcmTotalI[]" form="form-comprobante" readonly/>'+
          '</td>'+
          '<td style="width: 25px !important" >'+
            '<button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">'+
                '<i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i>' +
            '</button>'+
          '</td>'+
        '</tr>');
        numi++;
      }
    }

    function formCliente(){
      $("#formCliente").modal("show");
    }

    function formProveedor(){
      $("#formProveedor").modal("show");
    }

    function formCotizacion(){
      $("#formCotizacion").modal("show");
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
/* FIN - Operaciones de Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Limpiear campos del Comprobante */
function LimpiarCampos(){
	$("#nvchFecha").val(FechaActual());
	$("#nvchNumDocumento").val("");
	$("#nvchDenominacion").val("");
	$("#nvchDomicilio").val("");
	$("#TipoCliente").val("");
	$("#intIdTipoCliente").val("");
	$("#intIdCliente").val("");
	$("#intIdProveedor").val("");
	$("#nvchSerie").val("");
	$("#nvchNumeracion").val("");
	$("#intIdSucursal").val(1);
	if($("#intTipoDetalle").val() == 1 && $("#intIdTipoComprobanteI").val() == 0)
		$("#intIdTipoComprobante").val(1);
	else if($("#intTipoDetalle").val() == 2 && $("#intIdTipoComprobanteI").val() == 0)
		$("#intIdTipoComprobante").val(5);
  else if($("#intTipoDetalle").val() == 1 && $("#intIdTipoComprobanteI").val() == 9)
    $("#intIdTipoComprobante").val(9);
  else if($("#intTipoDetalle").val() == 2 && $("#intIdTipoComprobanteI").val() == 10)
    $("#intIdTipoComprobante").val(10);
	$("#intIdTipoVenta").val(1);
  $("#intIdTipoVenta").change();
	$("#intIdTipoMoneda").val(1);
	$("#intIdTipoPago").val(1);
	$("#ListaDeProductosVender").html("");
	$("#ListaDeServiciosVender").html("");
	$("#ListaDeMaquinariasVender").html("");
	HabilitacionOpciones(1);
	AgregarFila(1);
	AgregarFila(2);
	AgregarFila(3);
	$("#ValorComprobante").val("S/. 0.00");
	$("#IGVComprobante").val("S/. 0.00");
	$("#ComprobanteTotal").val("S/. 0.00"); 
	$("#nvchObservacion").val("");
	if($("#intTipoDetalle").val() != 2)
		MostrarSeleccionComprobante();
}
/* FIN - Funcion Ajax - Limpiear campos del Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Limpiear campos del Comprobante */
function HabilitacionOpciones(accion){
	if(accion == 1){
		$('#intIdSucursal').attr("disabled", false);
		$('#intIdTipoComprobante').attr("disabled", false);
		$('#intIdTipoVenta').attr("disabled", false);
		$('#intIdTipoPago').attr("disabled", false);
		$('.opcion-boton-nuevo').show();
		$('.opcion-columna-nuevo').show();
	} else {
		$('#intIdSucursal').attr("disabled", true);
		$('#intIdTipoComprobante').attr("disabled", true);
		$('#intIdTipoVenta').attr("disabled", true);
		$('#intIdTipoPago').attr("disabled", true);
		$('.opcion-boton-nuevo').hide();
		$('.opcion-columna-nuevo').hide();
	}
}
/* FIN - Funcion Ajax - Limpiear campos del Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Formulario de Realizar Venta */
function NuevoComprobante(){
	LimpiarCampos();
	$("#btnFormRealizarComprobante").click();
}
/* FIN - Funcion Ajax - Formulario de Realizar Venta */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Cliente */
$(document).on('click', '#btn-form-crear-comprobante', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
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
/* FIN - Funcion Ajax - Visualizar Formulario Crear Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Cliente */
$(document).on('click', '#btn-crear-comprobante', function(){
	var intIdTipoVenta = $("#intIdTipoVenta").val();
  var intTipoDetalle = $("#intTipoDetalle").val();
	if(intTipoDetalle == 1){
    if(intIdTipoVenta == 1){
  	  var num_filas_detalle_comprobante = document.getElementById('ListaDeProductosVender').rows.length;
  	  var intIdCliente = $("#intIdCliente").val();
  	  if(intIdCliente == "" || intIdCliente == null){
  	  	MensajeNormal("Seleccionar a un Cliente",2);
  	  	return false;
  	  } else if(num_filas_detalle_comprobante == 0){
  	  	MensajeNormal("Ingresar por lo menos elegir un Producto",2);
  	  	return false;
  	  }
  	} else if(intIdTipoVenta == 2){
  	  var num_filas_detalle_comprobante = document.getElementById('ListaDeServiciosVender').rows.length;
  	  var intIdCliente = $("#intIdCliente").val();
  	  if(intIdCliente == "" || intIdCliente == null){
  	  	MensajeNormal("Seleccionar a un Cliente",2);
  	  	return false;
  	  } else if(num_filas_detalle_comprobante == 0){
  	  	MensajeNormal("Ingresar por lo menos ingresar un Servicio",2);
  	  	return false;
  	  }
  	}
  } else if(intTipoDetalle == 2){
    if(intIdTipoVenta == 1){
      var num_filas_detalle_comprobante = document.getElementById('ListaDeProductosVender').rows.length;
      var intIdProveedor = $("#intIdProveedor").val();
      if(intIdProveedor == "" || intIdProveedor == null){
        MensajeNormal("Seleccionar a un Proveedor",2);
        return false;
      } else if(num_filas_detalle_comprobante == 0){
        MensajeNormal("Ingresar por lo menos elegir un Producto",2);
        return false;
      }
    } else if(intIdTipoVenta == 2){
      var num_filas_detalle_comprobante = document.getElementById('ListaDeServiciosVender').rows.length;
      var intIdProveedor = $("#intIdProveedor").val();
      if(intIdProveedor == "" || intIdProveedor == null){
        MensajeNormal("Seleccionar a un Proveedor",2);
        return false;
      } else if(num_filas_detalle_comprobante == 0){
        MensajeNormal("Ingresar por lo menos ingresar un Servicio",2);
        return false;
      }
    }
  }
	  var formData = $("#form-comprobante").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
  	  var intIdTipoComprobante = document.getElementById("intIdTipoComprobante").value;
	  $.ajax({
	   url: "../../datos/comprobante/funcion_comprobante.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
      datos = datos.replace(/\s/g,'');
	   	if (datos=="okokokokokok" || datos=="okokok") {
        if(intTipoDetalle == 1)
	   		  MensajeNormal("Se generó correctamente la Venta",1);
        else
          MensajeNormal("Se generó correctamente la Compra",1);
	   		$("#lista-comprobante").val(intIdTipoComprobante);
	   		AccionCabecerasTablaComprobante(intIdTipoComprobante);
	   		$('#txt-busqueda').val("");
	   		LimpiarCampos();
	   		$("#btnFormListarComprobante").click();
	   		ListarComprobante(x,y,tipolistado);
	   		PaginarComprobante(x,y,tipolistado);
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
$(document).on('click', '.btn-mostrar-comprobante', function(){
  	  var intIdComprobante = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:{intIdComprobante:intIdComprobante,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	$("#nvchFecha").val(datos.dtmFechaCreacion);
	   	$("#intIdSucursal").val(datos.intIdSucursal);
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

		$("#intIdCliente").val(datos.intIdCliente);
		$("#intIdProveedor").val(datos.intIdProveedor);
		
		$("textarea#nvchObservacion").val(datos.nvchObservacion);
		HabilitacionOpciones(2);
		ElegirTabla(datos.intIdTipoVenta);
		MostrarDetalleComprobante(datos.intIdComprobante,datos.intIdTipoVenta);
		/*if(datos.intIdTipoVenta == 1)

		else if(datos.intIdTipoVenta == 2)

		else if(datos.intIdTipoVenta == 3)
		*/		
		/*$("#ListaDeProductosVender").html("");
		$("#ListaDeServiciosVender").html("");
		$("#ListaDeMaquinariasVender").html("");
		AgregarFila(1);
		AgregarFila(2);
		AgregarFila(3);*/
		//$("#nvchObservacion").val("");

	   	$("#btnFormRealizarComprobante").click();
	   	//MostrarSeleccionComprobante($("#intIdTipoComprobante").val());
	   	//MostrarDetalleComprobante(intIdComprobante,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Cliente */
$(document).on('click', '#btn-editar-comprobante', function(){
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-comprobante").serialize();
  	  var intIdTipoComprobante = document.getElementById("tipo-comprobante").value;
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente el Comprobante",1);
	   		/*
	   		$("#lista-comprobante").val($("#tipo-comprobante").val());
	   		AccionCabecerasTablaComprobante(intIdTipoComprobante);
	   		$("#btn-form-comprobante-remove").click();
	   		*/
	   		ListarComprobante(x,y,tipolistado);
	   		PaginarComprobante(x,y,tipolistado);
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
$(document).on('click', '.btn-eliminar-comprobante', function(){
  	  var intIdComprobante = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:{intIdComprobante:intIdComprobante,funcion:funcion},
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se anuló correctamente el Comprobante",1);
	   		ListarComprobante(x,y,tipolistado);
	   		PaginarComprobante((x/y),y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function AccionCabecerasTablaComprobante(intIdTipoComprobante) {
	if(intIdTipoComprobante == "1"){
		$(".listaNumFactura").show();
  	  	$(".listaNumBoletaVenta").hide();
  	  	$(".listaNumNotaCredito").hide();
  	  	$(".listaNumGuiaRemision").hide();
	} else if (intIdTipoComprobante == "2") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").show();
  	  	$(".listaNumNotaCredito").hide();
  	  	$(".listaNumGuiaRemision").hide();
	} else if (intIdTipoComprobante == "3") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").hide();
  	  	$(".listaNumNotaCredito").hide();
  	  	$(".listaNumGuiaRemision").show();
	} else if (intIdTipoComprobante == "4") {
		$(".listaNumFactura").hide();
  	  	$(".listaNumBoletaVenta").hide();
  	  	$(".listaNumNotaCredito").show();
  	  	$(".listaNumGuiaRemision").hide();
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Venta Realizada */
$(document).on('change', '#lista-comprobante', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  	AccionCabecerasTablaComprobante(intIdTipoComprobante);
  	ListarComprobante(x,y,tipolistado);
});

$(document).on('change', '#num-lista', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarComprobante(x,y,tipolistado);
});

$(document).on('keyup', '#txt-busqueda', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarComprobante(x,y,tipolistado);
});

$(document).on('click', '#btnBuscar', function(){
	var y = document.getElementById("num-lista").value;
  	var x = 0;
  	var tipolistado = "T";
  	ListarComprobante(x,y,tipolistado);
});

$(document).on('click', '.btn-pagina', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(this).attr("idp") * y;
  	var tipolistado = "T";
  	ListarComprobante(x,y,tipolistado);
});

$(document).on('change', '#lista-tipo-moneda', function(){
  	var y = document.getElementById("num-lista").value;
  	var x = $(".marca").attr("idp") * y;
  	var tipolistado = "T";
  	ListarComprobante(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Venta Realizada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Cliente */
function ListarComprobante(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  var intIdTipoMoneda = document.getElementById("lista-tipo-moneda").value;
  var intTipoDetalle = $("#intTipoDetalle").val();
  
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
      url:'../../datos/comprobante/funcion_comprobante.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdTipoComprobante:intIdTipoComprobante,
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda,intTipoDetalle:intTipoDetalle},
      success:function(datos) {
          $("#ListaDeComprobantes").html(datos);
          PaginarComprobante((x/y),y,tipolistado);
          TotalComprobante();
      }
  });
}
/* FIN - Funcion Ajax - Listar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Total Ventas */
function TotalComprobante() {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "TV";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  var intIdTipoMoneda = document.getElementById("lista-tipo-moneda").value;
  var intTipoDetalle = $("#intTipoDetalle").val();
  
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
      url:'../../datos/comprobante/funcion_comprobante.php',
      method:"POST",
      data:{busqueda:busqueda,funcion:funcion,intIdTipoComprobante:intIdTipoComprobante,
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intIdTipoMoneda:intIdTipoMoneda,intTipoDetalle:intTipoDetalle},
      success:function(datos) {
          $("#TotalComprobante").val(datos);
      }
  });
}
/* FIN - Funcion Ajax - Total Ventas */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Cliente */
function PaginarComprobante(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  var intIdTipoComprobante = document.getElementById("lista-comprobante").value;
  var intTipoDetalle = $("#intTipoDetalle").val();

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
      url:'../../datos/comprobante/funcion_comprobante.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,intIdTipoComprobante:intIdTipoComprobante,
      		dtmFechaInicial:dtmFechaInicial,dtmFechaFinal:dtmFechaFinal,intTipoDetalle:intTipoDetalle},
      success:function(datos) {
          $("#PaginacionDeComprobante").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Paginar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
function AccionSeleccionClientes(funcion) {
	  if(funcion == 'S'){
	  	$("#TablaDeClientes").show();
      	$("#DatosDelCliente").hide();
	  } else if(funcion == 'M'){
	  	$("#TablaDeClientes").hide();
      	$("#DatosDelCliente").show();
	  }
}
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Ocultar Botones */
function AccionCabecerasTabla(intIdTipoPersona) {
	if(intIdTipoPersona == "1"){
		$(".ListaDNI").hide();
  	  	$(".ListaRUC").show();
  	  	$(".ListaRazonSocial").show();
  	  	$(".ListaApellidoPaterno").hide();
  	  	$(".ListaApellidoMaterno").hide();
  	  	$(".ListaNombres").hide();
	} else if (intIdTipoPersona == "2") {
		$(".ListaDNI").show();
  	  	$(".ListaRUC").show();
  	  	$(".ListaRazonSocial").hide();
  	  	$(".ListaApellidoPaterno").show();
  	  	$(".ListaApellidoMaterno").show();
  	  	$(".ListaNombres").show();
	}
}
/* FIN - Ocultar Botones */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Cliente */
$(document).on('change', '#lista-persona', function(){
	var intIdTipoPersona = document.getElementById("lista-persona").value;
  var intTipoDetalle = $("#intTipoDetalle").val();
	AccionCabecerasTabla(intIdTipoPersona);
	var y = 5;
	var x = 0;
  if(intTipoDetalle == 1)
	   ListarClientesSeleccion(x,y);
  else if(intTipoDetalle == 2)
     ListarProveedoresSeleccion(x,y);
});

$(document).on('keyup', '#BusquedaCliente', function(){
	var y = 5;
	var x = 0;
	ListarClientesSeleccion(x,y);
});

$(document).on('keyup', '#BusquedaProveedor', function(){
  var y = 5;
  var x = 0;
  ListarProveedoresSeleccion(x,y);
});

function PaginacionClientes(seleccion) {
	var y = 5;
	var x = $(seleccion).attr("idp") * y;
	ListarClientesSeleccion(x,y);
}

function PaginacionProveedores(seleccion) {
  var y = 5;
  var x = $(seleccion).attr("idp") * y;
  ListarProveedoresSeleccion(x,y);
}
/* FIN - Funcion Ajax - Buscar Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Clientes para la Selección */
function ListarClientesSeleccion(x,y) {
	var busqueda = document.getElementById("BusquedaCliente").value;
	var funcion = "MCL";
	var intIdTipoPersona = document.getElementById("lista-persona").value;
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#ListaDeClientesSeleccion").html(datos);
	   	PaginarClientesSeleccion((x/y),y,intIdTipoPersona);
	   }
	  });
}

function ListarProveedoresSeleccion(x,y) {
  var busqueda = document.getElementById("BusquedaProveedor").value;
  var funcion = "MPR";
  var intIdTipoPersona = document.getElementById("lista-persona").value;
    $.ajax({
     url:"../../datos/comprobante/funcion_comprobante.php",
     method:"POST",
     data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
     success:function(datos)
     {
      $("#ListaDeProveedoresSeleccion").html(datos);
      PaginarProveedoresSeleccion((x/y),y,intIdTipoPersona);
     }
    });
}
/* FIN - Listar Clientes para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Paginar Clientes para la Selección */
function PaginarClientesSeleccion(x,y,intIdTipoPersona) {
	var busqueda = document.getElementById("BusquedaCliente").value;
	var funcion = "PCL";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
	   success:function(datos)
	   {
	   	$("#PaginacionDeClientes").html(datos);
	   }
	  });
}

function PaginarProveedoresSeleccion(x,y,intIdTipoPersona) {
  var busqueda = document.getElementById("BusquedaProveedor").value;
  var funcion = "PPR";
    $.ajax({
     url:"../../datos/comprobante/funcion_comprobante.php",
     method:"POST",
     data:{busqueda:busqueda,funcion:funcion,x:x,y:y,intIdTipoPersona:intIdTipoPersona},
     success:function(datos)
     {
      $("#PaginacionDeProveedores").html(datos);
     }
    });
}
/* FIN - Paginar Clientes para la Selección */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Cliente */
function SeleccionarCliente(seleccion) {
	var intIdCliente = $(seleccion).attr("idscli");
	var funcion = "SCL";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:{intIdCliente:intIdCliente,funcion:funcion},
	   dataType:"json",
	   success:function(datos)
	   {
	   	if(datos.intIdTipoPersona == 1){
	   	 $("#nvchNumDocumento").val(datos.nvchRUC);
	   	 $("#nvchDenominacion").val(datos.nvchRazonSocial);
	   	} else if(datos.intIdTipoPersona == 2){
	   	 $("#nvchNumDocumento").val(datos.nvchDNI);
	   	 $("#nvchDenominacion").val(datos.nvchNombres + " " + datos.nvchApellidoPaterno + " " + datos.nvchApellidoMaterno);
	   	}
	   	$("#intIdCliente").val(datos.intIdCliente);
	   	$("#TipoCliente").val(datos.TipoCliente);
	   	$("#intIdTipoCliente").val(datos.intIdTipoCliente);
	   	$("#nvchDomicilio").val(datos.nvchDomicilio);
	   	$("#intIdCliente").val(datos.intIdCliente);
	   	$("#formCliente").modal("hide");
	   }
	  });
}

/////////////////////////////////////////////////////////////////////////////
// INICIO - funcion creada para autoselecionar cliente despues de su registro
function SeleccionarClienteS(intIdCliente) {
  var funcion = "SCL";
    $.ajax({
     url:"../../datos/comprobante/funcion_comprobante.php",
     method:"POST",
     data:{intIdCliente:intIdCliente,funcion:funcion},
     dataType:"json",
     success:function(datos)
     {
      if(datos.intIdTipoPersona == 1){
       $("#nvchNumDocumento").val(datos.nvchRUC);
       $("#nvchDenominacion").val(datos.nvchRazonSocial);
      } else if(datos.intIdTipoPersona == 2){
       $("#nvchNumDocumento").val(datos.nvchDNI);
       $("#nvchDenominacion").val(datos.nvchNombres + " " + datos.nvchApellidoPaterno + " " + datos.nvchApellidoMaterno);
      }
      $("#intIdCliente").val(datos.intIdCliente);
      $("#TipoCliente").val(datos.TipoCliente);
      $("#intIdTipoCliente").val(datos.intIdTipoCliente);
      $("#nvchDomicilio").val(datos.nvchDomicilio);
      $("#intIdCliente").val(datos.intIdCliente);
      $("#formCliente").modal("hide");
     }
    });
}
// END - funcion creada para autoselecionar cliente despues de su registro
/////////////////////////////////////////////////////////////////////////////


function SeleccionarProveedor(seleccion) {
  var intIdProveedor = $(seleccion).attr("idspro");
  var funcion = "SPR";
    $.ajax({
     url:"../../datos/comprobante/funcion_comprobante.php",
     method:"POST",
     data:{intIdProveedor:intIdProveedor,funcion:funcion},
     dataType:"json",
     success:function(datos)
     {
      if(datos.intIdTipoPersona == 1){
       $("#nvchNumDocumento").val(datos.nvchRUC);
       $("#nvchDenominacion").val(datos.nvchRazonSocial);
      } else if(datos.intIdTipoPersona == 2){
       $("#nvchNumDocumento").val(datos.nvchDNI);
       $("#nvchDenominacion").val(datos.nvchNombres + " " + datos.nvchApellidoPaterno + " " + datos.nvchApellidoMaterno);
      }
      $("#intIdProveedor").val(datos.intIdProveedor);
      $("#nvchDomicilio").val(datos.nvchDomicilio);
      $("#formProveedor").modal("hide");
     }
    });
}

function SeleccionarProveedorS(intIdProveedor) {
  var funcion = "SPR";
    $.ajax({
     url:"../../datos/comprobante/funcion_comprobante.php",
     method:"POST",
     data:{intIdProveedor:intIdProveedor,funcion:funcion},
     dataType:"json",
     success:function(datos)
     {
      if(datos.intIdTipoPersona == 1){
       $("#nvchNumDocumento").val(datos.nvchRUC);
       $("#nvchDenominacion").val(datos.nvchRazonSocial);
      } else if(datos.intIdTipoPersona == 2){
       $("#nvchNumDocumento").val(datos.nvchDNI);
       $("#nvchDenominacion").val(datos.nvchNombres + " " + datos.nvchApellidoPaterno + " " + datos.nvchApellidoMaterno);
      }
      $("#intIdProveedor").val(datos.intIdProveedor);
      $("#nvchDomicilio").val(datos.nvchDomicilio);
      $("#formProveedor").modal("hide");
     }
    });
}
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Cliente */
function MostrarSeleccionCliente(intIdTipoPersona) {
	  AccionSeleccionClientes('M');
	  if(intIdTipoPersona == 1){
	  	$(".nvchDNI").hide();
      	$(".nvchApellidoPaterno").hide();
      	$(".nvchApellidoMaterno").hide();
      	$(".nvchNombres").hide();
      	$(".nvchRUC").show();
      	$(".nvchRazonSocial").show();
	  } else if(intIdTipoPersona == 2){
	  	$(".nvchDNI").show();
      	$(".nvchApellidoPaterno").show();
      	$(".nvchApellidoMaterno").show();
      	$(".nvchNombres").show();
      	$(".nvchRUC").show();
      	$(".nvchRazonSocial").hide();
	  }
}
function MostrarSeleccionProveedor(intIdTipoPersona) {
    AccionSeleccionClientes('M');
    if(intIdTipoPersona == 1){
      $(".nvchDNI").hide();
        $(".nvchApellidoPaterno").hide();
        $(".nvchApellidoMaterno").hide();
        $(".nvchNombres").hide();
        $(".nvchRUC").show();
        $(".nvchRazonSocial").show();
    } else if(intIdTipoPersona == 2){
      $(".nvchDNI").show();
        $(".nvchApellidoPaterno").show();
        $(".nvchApellidoMaterno").show();
        $(".nvchNombres").show();
        $(".nvchRUC").show();
        $(".nvchRazonSocial").hide();
    }
}
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Comprobante */
$(document).on('change', '#lugar-comprobante', function(){
	
});
/* FIN - Funcion Ajax - Comprobante */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Seleccion del Cliente */
function MostrarSeleccionComprobante() {
	  var intIdTipoComprobante = $("#intIdTipoComprobante").val();
	  var intIdSucursal = $("#intIdSucursal").val();
	  var funcion = "NCPR";
	  $.ajax({
	   url:"../../datos/comprobante/funcion_comprobante.php",
	   method:"POST",
	   data:{funcion:funcion,intIdTipoComprobante:intIdTipoComprobante,intIdSucursal:intIdSucursal},
	   dataType:"json",
	   success:function(datos)
	   { 
	   	 if(datos.resultado == "ok"){
		   	$("#nvchSerie").val(datos.nvchSerie);
		   	$("#nvchNumeracion").val(datos.nvchNumeracion);
	   	 } else {
	   	 	alert(datos);
	   	 }
	   }
	  });
}
/* FIN - Seleccion del Cliente */
//////////////////////////////////////////////////////////////
</script>