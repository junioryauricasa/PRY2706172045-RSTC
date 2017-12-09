<script>
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
	var intIdSucursal = document.getElementById("intIdSucursal").value;
	var nvchSucursal = $("#intIdSucursal option:selected").html().replace(/\s/g,'');
	if(EsVacio("nvchUbicacion") == false){
		return false;
	}
	if(EsNumeroEntero("intCantidadUbigeo") == false){
		return false;
	}
	var validacion = true;
	$('#ListaDeUbicaciones tr').each(function(){
        if($(this).find('td').eq(1).text().replace(/\s/g,'') == nvchSucursal){
            validacion = false;
        }
    });
    if(validacion == false){
    	MensajeNormal("No puede haber más de una Ubicación de la Sucursal seleccionada",2);
    	return false;
    }
	var intIdProducto = document.getElementById("intIdProducto").value;
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
	   	if(datos == "okokokok"){
	   		MensajeNormal("Se agregó correctamente el Ubigeo del Producto",1);
	   		MostrarUbigeo(intIdProducto,tipolistado);
	   		ListarProducto(x,y,$("#tipo-busqueda").val());
	   		PaginarProducto(x,y,$("#tipo-busqueda").val());
	   	} else {
	   		alert(datos);
	   	}
	   }
	  });
	RestablecerValidacion("nvchUbicacion",1);
	RestablecerValidacion("intCantidadUbigeo",1);
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

function showmodaldetalles(){
  $('#modal-detalleproductos').modal('show');
}
</script>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-detalleproductos">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><i class="fa fa-book" style=""></i>
          Detalle de la ubicación del Producto: <b><span id="CodigoProducto"></span></b>
      </h4>
    </div>
    <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
              <div id="TablaDetalleUbigeo">
                  <div class="table-responsive">
                    <table class="rwd-table ExcelTable2007" width="100%">
                      <thead>
                        <tr>
                          <th class="heading" style="width: 25px">&nbsp;</th>
                          <th>Sucursal</th>
                          <th>Ubicación en el Almacén</th>
                          <th>Cantidad</th>
                        </tr>
                      </thead>
                      <tbody id="DetalleUbigeo">
                      </tbody>
                    </table>
                  </div>
              </div>
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" onclick="LimpiarDetalleUbigeo()" class="btn btn-danger btn-flat">Limpiar Detalles</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>