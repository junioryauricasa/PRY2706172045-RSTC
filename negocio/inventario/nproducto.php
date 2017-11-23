<script>
//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Visualizar Formulario Crear Producto */
$(document).on('click', '#btn-form-crear-producto', function(){
	  var funcion = "F";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
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
/* FIN - Funcion Ajax - Visualizar Formulario Crear Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Producto */
$(document).on('click', '#btn-crear-producto', function(){
	  var num_filas_codigo = document.getElementById('ListaDeCodigos').rows.length;
	  var num_filas_ubicacion = document.getElementById('ListaDeUbicaciones').rows.length;
	  $("#funcion").val("I");
	  if(EsVacio("nvchDescripcion") == false){
	  	goToBox("#nvchDescripcionGroup");
	  	return false;
	  } else if(EsNumeroEntero("intCantidadMinima") == false){
	  	goToBox("#intCantidadMinimaGroup");
	  	return false;
	  } else if(EsDecimal("dcmPrecioCompra") == false){
	  	goToBox("#dcmPrecioCompraGroup");
	  	return false;
	  } else if(EsDecimal("dcmPrecioVenta1") == false){
	  	goToBox("#dcmPrecioVenta1Group");
	  	return false;
	  } else if(EsDecimal("dcmPrecioVenta2") == false){
	  	goToBox("#dcmPrecioVenta2Group");
	  	return false;
	  } else if(EsDecimal("dcmPrecioVenta3") == false){
	  	goToBox("#dcmPrecioVenta3Group");
	  	return false;
	  } else if(EsDecimal("dcmDescuentoVenta2") == false){
	  	goToBox("#dcmDescuentoVenta2Group");
	  	return false;
	  } else if(EsDecimal("dcmDescuentoVenta3") == false){
	  	goToBox("#dcmDescuentoVenta3Group");
	  	return false;
	  } else if(num_filas_codigo == 0){
	  	MensajeNormal("Ingrese por lo menos un Código de Producto",2);
	  	return false;
	  } else if(num_filas_ubicacion == 0){
	  	MensajeNormal("Ingresar por lo menos una Ubicación del Producto",2);
	  	return false;
	  }
	  var formData = $("#form-producto").serialize();
	  var funcion = "I";
	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/inventario/funcion_producto.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	datos = datos.replace(/\s/g,''); //quitando espacio
	   	if (datos == "okokokokok") {
	   	//if (datos == "ok") {
	   		MensajeNormal("Se agregó correctamente el nuevo Producto",1);
	   		$("#btn-form-producto-remove").click();
	   		$("#tipo-busqueda").val("C");
	   		$('#txt-busqueda').val("");
	   		ListarProducto(x,y,tipolistado);
	   		PaginarProducto(x,y,tipolistado);
	   		$('#modal-showmodalcreateproduct').modal('hide');
		}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Producto */
$(document).on('click', '.btn-mostrar-producto', function(){
	var intIdProducto = $(this).attr("id");
   	var funcion = "M";
    var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,funcion:funcion},
	   dataType:'json',
	   success:function(datos)
	   {
	   	//$("#formulario-crud").html(datos);
	   	$("#nvchDescripcion").val(datos.nvchDescripcion);
	   	//alert(datos);
	   	$("#nvchObservacion").val(datos.nvchObservacion);
		$("#nvchUnidadMedida").val(datos.nvchUnidadMedida);
		$("#intCantidad").val(datos.intCantidad);
		$("#intCantidadMinima").val(datos.intCantidadMinima);
		$("#nvchDireccionImg").val(datos.nvchDireccionImg);
		$("#resultadoimagen").attr("src","../../datos/inventario/imgproducto/"+datos.nvchDireccionImg);
		$("#dcmPrecioCompra").val(datos.dcmPrecioCompra);
		$("#intIdTipoMonedaCompra").val(datos.intIdTipoMonedaCompra);
		$("#dcmPrecioVenta1").val(datos.dcmPrecioVenta1);
		$("#dcmPrecioVenta2").val(datos.dcmPrecioVenta2);
		$("#dcmPrecioVenta3").val(datos.dcmPrecioVenta3);
		$("#dcmDescuentoVenta2").val(datos.dcmDescuentoVenta2);
		$("#dcmDescuentoVenta3").val(datos.dcmDescuentoVenta3);
		$("#intIdTipoMonedaVenta").val(datos.intIdTipoMonedaVenta);
		$("#intIdProducto").val(datos.intIdProducto);
		$("#dtmFechaIngreso").val(datos.dtmFechaIngreso);
		
		$("#btn-agregar-codigo-nuevo").hide();
	    $("#btn-agregar-codigo-mostrar").show();
	    $("#btn-actualizar-codigo").show();
	    $("#btn-cancelar-codigo").show();

	    $("btn-agregar-ubigeo-nuevo").hide();
	    $("btn-agregar-ubigeo-mostrar").show();
	    $("btn-actualizar-ubigeo").show();
	    $("btn-cancelar-ubigeo").show();
		//imprime las tablas
	   	MostrarCodigo(intIdProducto,tipolistado);
	   	MostrarUbigeo(intIdProducto,tipolistado);
	   	//goToBox("#Formulario");
	   	showmodalcreateproduct();
	   	botonesActualizar();
	   }
	  });
	 return false;
  	  /* 
  	  var intIdProducto = $(this).attr("id");
  	  var funcion = "M";
  	  var tipolistado = "T";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,funcion:funcion},
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	$("#tipo-moneda").val($("#intIdTipoMonedaVenta").val());
	   	MostrarCodigo(intIdProducto,tipolistado);
	   	MostrarUbigeo(intIdProducto,tipolistado);
	   	goToBox("#Formulario");
	   }
	  });
	 return false;
	 */
});
/* FIN - Funcion Ajax - Mostrar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Producto */
$(document).on('click', '#btn-editar-producto', function(){
	  var num_filas_codigo = document.getElementById('ListaDeCodigos').rows.length;
	  var num_filas_ubicacion = document.getElementById('ListaDeUbicaciones').rows.length;
	  $("#funcion").val("A");
	  if(EsVacio("nvchDescripcion") == false){
	  	goToBox("#nvchDescripcionGroup");
	  	return false;
	  } else if(EsNumeroEntero("intCantidadMinima") == false){
	  	goToBox("#intCantidadMinimaGroup");
	  	return false;
	  } else if(EsDecimal("dcmPrecioCompra") == false){
	  	goToBox("#dcmPrecioCompraGroup");
	  	return false;
	  } else if(EsDecimal("dcmPrecioVenta1") == false){
	  	goToBox("#dcmPrecioVenta1Group");
	  	return false;
	  } else if(EsDecimal("dcmPrecioVenta2") == false){
	  	goToBox("#dcmPrecioVenta2Group");
	  	return false;
	  } else if(EsDecimal("dcmPrecioVenta3") == false){
	  	goToBox("#dcmPrecioVenta3Group");
	  	return false;
	  } else if(EsDecimal("dcmDescuentoVenta2") == false){
	  	goToBox("#dcmDescuentoVenta2Group");
	  	return false;
	  } else if(EsDecimal("dcmDescuentoVenta3") == false){
	  	goToBox("#dcmDescuentoVenta3Group");
	  	return false;
	  } else if(num_filas_codigo == 0){
	  	MensajeNormal("Ingrese por lo menos un Código de Producto",2);
	  	return false;
	  } else if(num_filas_ubicacion == 0){
	  	MensajeNormal("Ingresar por lo menos una Ubicación del Producto",2);
	  	return false;
	  }
  	  var funcion = "A";
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "E";
  	  var formData = $("#form-producto").serialize();
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:formData,
	   success:function(datos)
	   {
	   	datos = datos.replace(/\s/g,''); //quitando espacio
	   	if (datos=="ok") {
	   		MensajeNormal("Se modificó correctamente el Producto",1);
	   		$("#btn-form-producto-remove").click();
	   		ListarProducto(x,y,tipolistado);
	   		PaginarProducto(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Actualizar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Eliminar Producto */
$(document).on('click', '.btn-eliminar-producto', function(){
  	  var intIdProducto = $(this).attr("id");
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(".marca").attr("idp") * y;
  	  var tipolistado = "D";
  	  var funcion = "E";
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{intIdProducto:intIdProducto,funcion:funcion},
	   success:function(datos)
	   {
	   	datos = datos.replace(/\s/g,''); //quitando espacio
	   	if (datos=="ok") { 
	   		MensajeNormal("Se eliminó correctamente el Producto",1);
	   		ListarProducto(x,y,tipolistado);
	   		PaginarProducto(x,y,tipolistado);
	   	}
	   	else { $("#resultadocrud").html(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Eliminar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Producto */
function ListarProducto(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "L";
  var TipoBusqueda = document.getElementById("tipo-busqueda").value;
  $.ajax({
      url:'../../datos/inventario/funcion_producto.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,TipoBusqueda:TipoBusqueda},
      success:function(datos) {
          $("#ListaDeProductos").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Listar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Producto */
$(document).on('change', '#num-lista', function(){
  	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var funcion = "L";
  	  var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,TipoBusqueda:TipoBusqueda},
	   success:function(datos)
	   {
	   	$("#ListaDeProductos").html(datos);
	   	PaginarProducto(x,y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Cambiar Número de Elementos de Lista Producto */
$(document).on('change', '#tipo-busqueda', function(){
  	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  var funcion = "L";
  	  var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,TipoBusqueda:TipoBusqueda},
	   success:function(datos)
	   {
	   	$("#ListaDeProductos").html(datos);
	   	PaginarProducto(x,y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Número de Elementos de Lista Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Paginar Producto */
function PaginarProducto(x,y,tipolistado) {
  var busqueda = document.getElementById("txt-busqueda").value;
  var funcion = "P";
  var TipoBusqueda = document.getElementById("tipo-busqueda").value;
  $.ajax({
      url:'../../datos/inventario/funcion_producto.php',
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
/* INICIO - Funcion Ajax - Cambiar Página de Lista Producto */
$(document).on('click', '.btn-pagina', function(){
      var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(this).attr("idp") * y;
  	  var funcion = "L";
  	  var tipolistado = "T";
  	  var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,TipoBusqueda:TipoBusqueda},
	   success:function(datos)
	   {
	   	$("#ListaDeProductos").html(datos);
	   	PaginarProducto((x/y),y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Cambiar Página de Lista Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Producto II */
$(document).on('keyup', '#txt-busqueda', function(){
	  var busqueda = document.getElementById("txt-busqueda").value;
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var funcion = "L";
  	  var tipolistado = "T";
  	  var TipoBusqueda = document.getElementById("tipo-busqueda").value;
	  $.ajax({
	   url:"../../datos/inventario/funcion_producto.php",
	   method:"POST",
	   data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado,TipoBusqueda:TipoBusqueda},
	   success:function(datos)
	   {
	   	$("#ListaDeProductos").html(datos);
	   	PaginarProducto(x,y,tipolistado);
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Buscar Elemento Ingresa de la Lista del Producto II */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Seleccion de imagen del producto */
$(document).on('change', '#SeleccionImagen', function(){
        var formData = new FormData($("#form-producto")[0]);
        var ruta = "../../datos/inventario/proceso_guardar_imagen.php";
        var anteriorImagen = document.getElementById("nvchDireccionImg").value;
        $.ajax({
            url: ruta,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos)
            {
            	if(datos=="blank"){
            		document.getElementById("resultadoimagen").src = anteriorImagen;
		        	document.getElementById("nvchDireccionImg").value = anteriorImagen;
            	}
            	else {
			        document.getElementById("resultadoimagen").src = datos;
			        document.getElementById("nvchDireccionImg").value = datos;
		    	}	
			}
        });
});
/* FIN - Funcion Ajax - Seleccion de imagen del producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Códigos según Ingresa */
function AgregarCodigo() {
	var nvchCodigo = document.getElementById("nvchCodigo").value;	
	var intIdTipoCodigoProducto = document.getElementById("tipo-codigo-producto").value;
	var validacion = true;
	$('#ListaDeCodigos tr').each(function(){
        if($(this).find('td').eq(1).text() == 'Principal'){
            validacion = false;
        }
    });
    if(EsVacio("nvchCodigo") == false){
		return false;
	}
    else if(validacion == false){
    	if (intIdTipoCodigoProducto == 1) {
	    	MensajeNormal("No puede haber más de un Código Principal",2);
	    	return false;
    	}
    }
	$('#ListaDeCodigos').append('<tr><td class="heading" data-th="ID"></td>'+
		'<td>'+'<input type="hidden" name="nvchCodigo[]" value="'
		+nvchCodigo+'"/>'+nvchCodigo+'</td>'+
		'<td>'+'<input type="hidden" name="intIdTipoCodigoProducto[]" value="'
		+intIdTipoCodigoProducto+'"/>'+$("#tipo-codigo-producto option:selected").html()+'</td>'+
		'<td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>'+
		'</tr>');
}
/* FIN - Listar Códigos según Ingresa */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Ubicaciones según Ingresa */
function AgregarUbigeo() {
	if(EsVacio("nvchUbicacion") == false){
		return false;
	}
	if(EsNumeroEntero("intCantidadUbigeo") == false){
		return false;
	}
	var intIdSucursal = document.getElementById("intIdSucursal").value;
	var NombreSucursal = $("#intIdSucursal option:selected").html()
	var nvchUbicacion = document.getElementById("nvchUbicacion").value;
	var intCantidadUbigeo = document.getElementById("intCantidadUbigeo").value;
	$('#ListaDeUbicaciones').append('<tr><td class="heading" data-th="ID"></td>'+
		'<td>'+'<input type="hidden" name="intIdSucursal[]" value="'
		+intIdSucursal+'"/>'+NombreSucursal+'</td>'+
		'<td>'+'<input type="hidden" name="nvchUbicacion[]" value="'
		+nvchUbicacion+'"/>'+nvchUbicacion+'</td>'+
		'<td>'+'<input type="hidden" name="intCantidadUbigeo[]" value="'
		+intCantidadUbigeo+'"/>'+intCantidadUbigeo+'</td>'+
		'<td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>'+
		'</tr>');
}
/* FIN - Listar Ubicaciones según Ingresa */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Eliminar Fila Seleccionada */
function EliminarFila(btn) {
	var fila = btn.parentNode.parentNode;
  	fila.parentNode.removeChild(fila);
}
/* FIN - Eliminar Fila Seleccionada */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Calcular Precios */
function CalcularPrecios(dcmPrecioVenta1) {
	var dcmDescuentoVenta2 = $("#dcmDescuentoVenta2").val();
	var dcmDescuentoVenta3 = $("#dcmDescuentoVenta3").val();
	var dcmPrecioVenta2 = dcmPrecioVenta1 - (dcmPrecioVenta1*(dcmDescuentoVenta2/100));
	var dcmPrecioVenta3 = dcmPrecioVenta1 - (dcmPrecioVenta1*(dcmDescuentoVenta3/100));
	$("#dcmPrecioVenta2").val(dcmPrecioVenta2.toFixed(2));
	$("#dcmPrecioVenta3").val(dcmPrecioVenta3.toFixed(2));
}
/* FIN - Calcular Precios */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Calcular Precios */
function CalcularPrecioVenta2(dcmDescuentoVenta2) {
	var dcmPrecioVenta1 = $("#dcmPrecioVenta1").val();
	var dcmDescuentoVenta2 = $("#dcmDescuentoVenta2").val();
	var dcmPrecioVenta2 = dcmPrecioVenta1 - (dcmPrecioVenta1*(dcmDescuentoVenta2/100));
	$("#dcmPrecioVenta2").val(dcmPrecioVenta2.toFixed(2));
}
/* FIN - Calcular Precios */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Calcular Precios */
function CalcularPrecioVenta3(dcmDescuentoVenta3) {
	var dcmPrecioVenta1 = $("#dcmPrecioVenta1").val();
	var dcmDescuentoVenta3 = $("#dcmDescuentoVenta3").val();
	var dcmPrecioVenta3 = dcmPrecioVenta1 - (dcmPrecioVenta1*(dcmDescuentoVenta3/100));
	$("#dcmPrecioVenta3").val(dcmPrecioVenta3.toFixed(2));
}
/* FIN - Calcular Precios */
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


/*	
	Función Mostrar Formulario de registro de producto 
	Descripción:  ir a la siguente página y muestra la interfaz
*/
//////////////////////////////////////////////////////////////
function mostrar(){
	$("button#btn-form-crear-producto").toggleClass("esconder");
}
//////////////////////////////////////////////////////////////
/*	FIN - Función Mostrar Formulario de registro de producto   */


/*	Función Mostrar Formulario de registro de producto   */
//////////////////////////////////////////////////////////////
function ver_formulario(){
	$("li#li_show_table_products").removeClass("active");
	$("a#show_table_products").attr("aria-expanded","false");
	$("#tab_1").removeClass("active");

	$("li#li_ver_editar_formulario").addClass("active");
	$("a#ver_editar_formulario").attr("aria-expanded","true");
	$("#tab_2").addClass("active");	

	$("#btn-agregar-codigo-mostrar").hide();
	$("#btn-agregar-codigo-nuevo").show();

	$("#ListaDeUbicaciones").reload();

}
//////////////////////////////////////////////////////////////
/*	FIN - Función Mostrar Formulario de registro de producto   */


/*	Función Limpiar Formulario de registro de producto   */
//////////////////////////////////////////////////////////////
function limpiarformProducto(){
      //$("#formulario-crud").html(datos);
      $("#nvchDescripcion").val("");
      //alert(datos);
      $("#nvchObservacion").val("");
      $("#nvchUnidadMedida").val("");
      $("#intCantidad").val("");
      $("#intCantidadMinima").val("");
      $("#nvchDireccionImg").val("");
      $("#resultadoimagen").attr("src","../../datos/inventario/imgproducto/productosinfoto.png");
      $("#dcmPrecioCompra").val("");
      $("#intIdTipoMonedaCompra").val(1);
      $("#dcmPrecioVenta1").val("");
      $("#dcmPrecioVenta2").val("");
      $("#dcmPrecioVenta3").val("");
      $("#dcmDescuentoVenta2").val("");
      $("#dcmDescuentoVenta3").val("");
      $("#intIdTipoMonedaVenta").val(1);
      $("#intIdProducto").val("");
      $("#dtmFechaIngreso").val("");
      //imprime las tablas vacias
      $("#ListaDeCodigos").html("");  //vacia las filas de la tabla
      $("#ListaDeUbicaciones").html("");  //vacia las filas de la tabla
      botonesRegistrar();
    }
//////////////////////////////////////////////////////////////
/*	FIN - unción Limpiar Formulario de registro de producto  */
function botonesRegistrar(){
	$("#btn-agregar-codigo-nuevo").show();
    $("#btn-agregar-codigo-mostrar").hide();
    $("#btn-actualizar-codigo").hide();
    $("#btn-cancelar-codigo").hide();

    $("#btn-agregar-ubigeo-nuevo").show();
    $("#btn-agregar-ubigeo-mostrar").hide();
    $("#btn-actualizar-ubigeo").hide();
    $("#btn-cancelar-ubigeo").hide(); 
}
function botonesActualizar(){
	$("#btn-agregar-codigo-nuevo").hide();
    $("#btn-agregar-codigo-mostrar").show();
    $("#btn-actualizar-codigo").hide();
    $("#btn-cancelar-codigo").hide();

    $("#btn-agregar-ubigeo-nuevo").hide();
    $("#btn-agregar-ubigeo-mostrar").show();
    $("#btn-actualizar-ubigeo").hide();
    $("#btn-cancelar-ubigeo").hide();
}

</script>