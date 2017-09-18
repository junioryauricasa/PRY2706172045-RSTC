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
	  if(EsVacio("nvchDescripcion") == false){
	  	goToBox("#nvchDescripcionGroup");
	  	return false;
	  } else if(EsNumeroEntero("intCantidadMinima") == false){
	  	goToBox("#intCantidadMinimaGroup");
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
	   	if (datos=="okokok") {
	   		MensajeNormal("Se agregó correctamente el nuevo Producto",1);
	   		$("#btn-form-producto-remove").click();
	   		$("#tipo-busqueda").val("T");
	   		$('#txt-busqueda').val("");
	   		ListarProducto(x,y,tipolistado);
	   		PaginarProducto(x,y,tipolistado);
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
	   success:function(datos)
	   {
	   	$("#formulario-crud").html(datos);
	   	$("#tipo-moneda").val($("#intIdTipoMoneda").val());
	   	MostrarCodigo(intIdProducto,tipolistado);
	   	MostrarUbigeo(intIdProducto,tipolistado);
	   	goToBox("#Formulario");
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
	  if(EsVacio("nvchDescripcion") == false){
	  	goToBox("#nvchDescripcionGroup");
	  	return false;
	  } else if(EsNumeroEntero("intCantidadMinima") == false){
	  	goToBox("#intCantidadMinimaGroup");
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
	$('#ListaDeCodigos').append('<tr>'+
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
	var nvchSucursal = document.getElementById("nvchSucursal").value;
	var nvchUbicacion = document.getElementById("nvchUbicacion").value;
	var intCantidadUbigeo = document.getElementById("intCantidadUbigeo").value;
	$('#ListaDeUbicaciones').append('<tr>'+
		'<td>'+'<input type="hidden" name="nvchSucursal[]" value="'
		+nvchSucursal+'"/>'+nvchSucursal+'</td>'+
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