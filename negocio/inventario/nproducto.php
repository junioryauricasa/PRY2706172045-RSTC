<script>

function DescripcionProducto(intIdTipoVenta){
	if(intIdTipoVenta == 1){
		$("#nvchDescripcionCol").show();
		$("#nvchDescripcionRCol").hide();
	} else {
		$("#nvchDescripcionCol").hide();
		$("#nvchDescripcionRCol").show();
	}
	RestablecerValidacion('nvchDescripcion',1);
	RestablecerValidacion('nvchDescripcionR',1);
}

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

function ValidacionProducto(){
	  var num_filas_codigo = document.getElementById('ListaDeCodigos').rows.length;
	  var num_filas_ubicacion = document.getElementById('ListaDeUbicaciones').rows.length;
	  var intIdTipoVenta = $("#intIdTipoProducto").val();
	  $("#funcion").val("I");
	  if(intIdTipoVenta == 1){
		if(EsVacio("nvchDescripcion") == false){
		  	goToBox("#nvchDescripcionGroup");
		  	return false;
		  }
	  } else {
	  	if(EsVacio("nvchDescripcionR") == false){
		  	goToBox("#nvchDescripcionRGroup");
		  	return false;
		  }
	  }

	  if(EsNumeroEntero("intCantidadMinima") == false){
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
	  return true;
}

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Producto */
$(document).on('click', '#btn-crear-producto', function(){
	  var resultado = ValidacionProducto();
	  if(resultado == false){
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
	   	if (datos == "okokokokokokok") {
	   		MensajeNormal("Se agregó correctamente el nuevo Producto",1);
	   		$("#btn-form-producto-remove").click();
	   		$("#tipo-busqueda").val("C");
	   		$('#txt-busqueda').val("");
	   		ListarProducto(x,y,tipolistado);
	   		PaginarProducto(x,y,tipolistado);
	   		botonesRegistrar();
	   		limpiarformProducto();
	   		$('#btnListarProducto').click();
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
	   	limpiarformProducto();
	   	$("#intIdTipoProducto").val(datos.intIdTipoVenta);
	   	$("#intIdTipoProducto").change();
	   	if(datos.intIdTipoVenta == 1)
	   		$("#nvchDescripcion").val(datos.nvchDescripcion);
	   	else
	   		$("#nvchDescripcionR").val(datos.nvchDescripcion);
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
	   	botonesActualizar();
	   	$('#btnFormProducto').click();
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Mostrar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Actualizar Producto */
$(document).on('click', '#btn-editar-producto', function(){
	  var num_filas_codigo = document.getElementById('ListaDeCodigos').rows.length;
	  var num_filas_ubicacion = document.getElementById('ListaDeUbicaciones').rows.length;
	  var intIdTipoVenta = $("#intIdTipoProducto").val();
	  $("#funcion").val("A");
	  if(intIdTipoVenta == 1){
		if(EsVacio("nvchDescripcion") == false){
		  	goToBox("#nvchDescripcionGroup");
		  	return false;
		  }
	  } else {
	  	if(EsVacio("nvchDescripcionR") == false){
		  	goToBox("#nvchDescripcionRGroup");
		  	return false;
		  }
	  }

	  if(EsNumeroEntero("intCantidadMinima") == false){
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
	   		limpiarformProducto();
	   		botonesRegistrar();
	   		$('#btnListarProducto').click();
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
	var idreg = $(this).attr("id");
	$('.mi-modal').modal('show');//mostrando modal
	$(document).on('click', '.modal-btn-si', function(){
		  	  var intIdProducto = idreg;
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
			   		$('.mi-modal').modal('hide');
			   		ListarProducto(x,y,tipolistado);
			   		PaginarProducto(x,y,tipolistado);
			   	}
			   	else { $("#resultadocrud").html(datos); }
			   }
		  });
	});
	$(document).on('click', '.modal-btn-no', function(){
		$('.mi-modal').modal('hide');
	});
});
/* FIN - Funcion Ajax - Eliminar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Buscar Producto */
$(document).on('change', '#num-lista', function(){
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  ListarProducto(x,y,tipolistado);
});

$(document).on('change', '#tipo-busqueda', function(){
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  ListarProducto(x,y,tipolistado);
});

$(document).on('click', '.btn-pagina', function(){
  	  var y = document.getElementById("num-lista").value;
  	  var x = $(this).attr("idp") * y;
  	  var tipolistado = "T";
  	  ListarProducto(x,y,tipolistado);
});

$(document).on('keyup', '#txt-busqueda', function(){
  	  var y = document.getElementById("num-lista").value;
  	  var x = 0;
  	  var tipolistado = "T";
  	  ListarProducto(x,y,tipolistado);
});
/* FIN - Funcion Ajax - Buscar Producto */
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
          PaginarProducto((x/y),y,tipolistado);
      }
  });
}
/* FIN - Funcion Ajax - Listar Producto */
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
		var texto = $(this).find('td').eq(2).text().replace(/\s/g,'');
        if(texto == 'Principal'){
            validacion = false;
        }
    });
    if(EsVacio("nvchCodigo") == false){
		return false;
	} else if(validacion == false){
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
	RestablecerValidacion("nvchCodigo",1);
}
/* FIN - Listar Códigos según Ingresa */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Listar Ubicaciones según Ingresa */
function AgregarUbigeo() {
	var intIdSucursal = document.getElementById("intIdSucursal").value;
	var nvchSucursal = "";
	if(intIdSucursal == 1)
		nvchSucursal = "Huancayo";
	else
		nvchSucursal = "San Jerónimo";
	if(EsVacio("nvchUbicacion") == false){
		return false;
	}
	if(EsNumeroEntero("intCantidadUbigeo") == false){
		return false;
	}
	var validacion = true;
	$('#ListaDeUbicaciones tr').each(function(){
        if($(this).find('td').eq(1).text() == nvchSucursal){
            validacion = false;
        }
    });
    if(validacion == false){
    	MensajeNormal("No puede haber más de una Ubicación de la Sucursal seleccionada",2);
    	return false;
    }
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
	RestablecerValidacion("nvchUbicacion",1);
	RestablecerValidacion("intCantidadUbigeo",1);
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
/*
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
*/
//////////////////////////////////////////////////////////////
/*	FIN - Función Mostrar Formulario de registro de producto   */


/*	Función Limpiar Formulario de registro de producto   */
//////////////////////////////////////////////////////////////
function limpiarformProducto(){
      //$("#formulario-crud").html(datos);
      RestablecerValidacion("nvchDescripcion",1); // 1 = desaparece validacion y 2 = se mntienen el estilo de validacion pero no valor
      RestablecerValidacion("nvchDescripcionR",1);
      RestablecerValidacion("intCantidad",1);
      RestablecerValidacion("intCantidadMinima",1);
      RestablecerValidacion("dcmPrecioCompra",1);
      RestablecerValidacion("dcmPrecioVenta1",1);
      RestablecerValidacion("dcmPrecioVenta2",1);
      RestablecerValidacion("dcmPrecioVenta3",1);
      RestablecerValidacion("dcmDescuentoVenta2",1);
      RestablecerValidacion("dcmDescuentoVenta3",1);
      $("#dcmDescuentoVenta2").val("7");
      $("#dcmDescuentoVenta3").val("15");
      $("#nvchObservacion").val("");
      $("#nvchDireccionImg").val("");
      $("#resultadoimagen").attr("src","../../datos/inventario/imgproducto/productosinfoto.png");
      $("#intIdTipoMonedaCompra").val(1);
      $("#intIdTipoMonedaVenta").val(1);
      $("#intIdProducto").val("");
      $("#intIdTipoProducto").val(1);
      $("#intIdTipoProducto").change();
      $("#dtmFechaIngreso").val("");
      //imprime las tablas vacias
      $("#ListaDeCodigos").html("");  //vacia las filas de la tabla
      $("#ListaDeUbicaciones").html("");  //vacia las filas de la tabla
      botonesRegistrar();
    }
//////////////////////////////////////////////////////////////
/*	FIN - unción Limpiar Formulario de registro de producto  */


function botonesRegistrar(){
	$("#lblTituloFormulario").html("Nuevo Producto");
	$("#btn-crear-producto").show();
	$("#btn-editar-producto").hide();
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
	$("#lblTituloFormulario").html("Modificar Producto");
	$("#btn-crear-producto").hide();
	$("#btn-editar-producto").show();
	$("#btn-agregar-codigo-nuevo").hide();
    $("#btn-agregar-codigo-mostrar").show();
    $("#btn-actualizar-codigo").hide();
    $("#btn-cancelar-codigo").hide();

    $("#btn-agregar-ubigeo-nuevo").hide();
    $("#btn-agregar-ubigeo-mostrar").show();
    $("#btn-actualizar-ubigeo").hide();
    $("#btn-cancelar-ubigeo").hide();
}


//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Mostrar Producto para descargar reporte en excel*/
$(document).on('click', '#DescargarListaProductoExcel', function(){
	  var busqueda = $("#txt-busqueda").val();
	  var url = '../../datos/inventario/clases_producto/reporteexcel.php?busqueda='+busqueda;
	  window.open(url);
});
/* FIN - Funcion Ajax - Mostrar Producto para descargar reporte en excel */
//////////////////////////////////////////////////////////////


</script>