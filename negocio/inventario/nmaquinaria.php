<script>
//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Insertar Producto */
$(document).on('click', '#btn-crear-maquinaria', function(){
	  var formData = $("#form-maquinaria").serialize();
	  var funcion = "IMQ";
	  var y = 10
  	  var x = 0;
  	  var tipolistado = "N";
	  $.ajax({
	   url: "../../datos/inventario/funcion_producto.php",
	   method: "POST",
	   data: formData,
	   success:function(datos)
	   {
	   	if (datos=="ok") {
	   		MensajeNormal("Se agregó correctamente el nuevo Producto",1);
	   		ListarMaquinaria(x,y,tipolistado);
		}
	   	else { alert(datos); }
	   }
	  });
	 return false;
});
/* FIN - Funcion Ajax - Insertar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Listar Producto */
function ListarMaquinaria(x,y,tipolistado) {
  var busqueda = "";
  var funcion = "LMQ";
  $.ajax({
      url:'../../datos/inventario/funcion_producto.php',
      method:"POST",
      data:{busqueda:busqueda,x:x,y:y,funcion:funcion,tipolistado:tipolistado},
      success:function(datos) {
          $("#ListaDeMaquinarias").html(datos);
      }
  });
}
/* FIN - Funcion Ajax - Listar Producto */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Funcion Ajax - Reporte Cotizacion */
$(document).on('click', '.btn-reporte-maquinaria', function(){
	var intIdMaquinaria = $(this).attr("id");
	var url = '../../datos/inventario/clases_producto/reporte_maquinaria.php?intIdMaquinaria='+intIdMaquinaria;
	window.open(url, '_blank');
});
/* FIN - Funcion Ajax - Reporte Cotizacion */
//////////////////////////////////////////////////////////////
</script>