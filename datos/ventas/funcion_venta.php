<?php 
session_start();
require_once '../inventario/clases_producto/class_producto.php';
require_once 'clases_venta/class_venta.php';
require_once 'clases_venta/class_detalle_venta.php';
require_once 'clases_venta/class_formulario_venta.php';
require_once '../numeraciones/class_numeraciones.php';
require_once '../reportes/clases_kardex/class_kardex.php';
if(empty($_SESSION['intIdVenta'])){
  $_SESSION['intIdVenta'] = 0;
}
if(empty($_SESSION['intIdOperacionVenta'])){
  $_SESSION['intIdOperacionVenta'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Venta = new Venta();
    $Venta->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $Venta->IdSucursal($_POST['intIdSucursal']);
    $Venta->Serie($_POST['nvchSerie']);
    $Venta->Numeracion($_POST['nvchNumeracion']);
    $Venta->IdUsuario($_SESSION['intIdUsuarioSesion']);
    $Venta->IdCliente($_POST['intIdCliente']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Venta->FechaCreacion($dtmFechaCreacion);
    $Venta->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $Venta->IdTipoPago($_POST['intIdTipoPago']);
    $Venta->IdTipoVenta($_POST['intIdTipoVenta']);
    $Venta->Observacion($_POST['nvchObservacion']);
    $Venta->InsertarVenta();
    $DetalleVenta = new DetalleVenta();
    if($_POST['intIdTipoVenta'] == 1) {
        $DetalleVenta->IdVenta($_SESSION['intIdVenta']);
        $DetalleVenta->IdProducto($_POST['intIdProducto']);
        $DetalleVenta->FechaRealizada($dtmFechaCreacion);
        $DetalleVenta->Cantidad($_POST['intCantidad']);
        $DetalleVenta->CantidadDisponible($_POST['intCantidadDisponible']);
        $DetalleVenta->Precio($_POST['dcmPrecio']);
        $DetalleVenta->Descuento($_POST['dcmDescuento']);
        $DetalleVenta->PrecioUnitario($_POST['dcmPrecioUnitario']);
        $DetalleVenta->Total($_POST['dcmTotal']);
        $DetalleVenta->IdTipoVenta($_POST['intIdTipoVenta']);
        $DetalleVenta->InsertarDetalleVenta();
        $Producto = new Producto();
        $Producto->ES_StockUbigeo($_POST['intIdProducto'],$_POST['intIdSucursal'],$_POST['intCantidad'],0);
        $Producto->ES_StockTotal($_POST['intIdProducto']);
    } else if($_POST['intIdTipoVenta'] == 2) {
        $DetalleVenta->IdVenta($_SESSION['intIdVenta']);
        $DetalleVenta->FechaRealizada($dtmFechaCreacion);
        $DetalleVenta->Cantidad($_POST['intCantidad']);
        $DetalleVenta->PrecioUnitario($_POST['dcmPrecioUnitario']);
        $DetalleVenta->Total($_POST['dcmTotal']);
        $DetalleVenta->IdTipoVenta($_POST['intIdTipoVenta']);
        $DetalleVenta->DescripcionServicio($_POST['nvchDescripcionServicio']);
        $DetalleVenta->InsertarDetalleVenta();
    }
    $Numeraciones = new Numeraciones();
    $Numeraciones->ActualizarNumeracion($_POST['intIdTipoComprobante'],$_POST['intIdSucursal'],$_POST['nvchNumeracion']);

    $Kardex = new Kardex();
    $Kardex->FechaMovimiento($dtmFechaCreacion);
    $Kardex->IdComprobante($_SESSION['intIdVenta']);
    $Kardex->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $Kardex->TipoDetalle(1);
    $Kardex->Serie($_POST['nvchSerie']);
    $Kardex->Numeracion($_POST['nvchNumeracion']);
    $Kardex->CantidadEntrada($_SESSION['intCantidadSalida']);
    $Kardex->PrecioUnitarioEntrada($_SESSION['dcmPrecioUnitarioSalida']);
    $Kardex->TotalEntrada($_SESSION['dcmTotalSalida']);
    $Kardex->InsertarKardex();
    break;
  case "M":
    $Venta = new Venta();
    $Venta->IdVenta($_POST['intIdVenta']);
    $Venta->MostrarVenta($_POST['funcion']);
    break;
  case "MDV":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->IdVenta($_POST['intIdVenta']);
    $DetalleVenta->MostrarDetalleVenta($_POST['tipolistado']);
    break;
  case "E":
    $Venta = new Venta();
    $Venta->IdVenta($_POST['intIdVenta']);
    $Venta->EliminarVenta();
    break;
  case "L":
    $Venta = new Venta();
    $Venta->ListarVentas($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoComprobante']);
    break;
  case "P":
    $Venta = new Venta();
    $Venta->PaginarVentas($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoComprobante']);
    break;
  case "SCL":
    $Venta = new Venta();
    $Venta->IdCliente($_POST['intIdCliente']);
    $Venta->SeleccionarClienteVenta();
    break;
  case "MCL":
    $Venta = new Venta();
    $Venta->ListarClienteVenta($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['intIdTipoPersona']);
    break;
  case "PCL":
    $Venta = new Venta();
    $Venta->PaginarClientesVenta($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['intIdTipoPersona']);
    break;
  case "MPT":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->ListarProductoVenta($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda'],$_POST['intIdSucursal']);
    break;
  case "PPT":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->PaginarProductosVenta($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda']);
    break;
  case "ICT":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->InsertarCotizacion($_POST['intIdCotizacion']);
    break;
  case "MCT":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->ListarCotizacionesVenta($_POST['busqueda'],$_POST['x'],$_POST['y']);
    break;
  case "PCT":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->PaginarCotizacionesVenta($_POST['busqueda'],$_POST['x'],$_POST['y']);
    break;
  case "NCPR":
    $Numeraciones = new Numeraciones();
    $Numeraciones->NumeracionAlgoritmica($_POST['intIdTipoComprobante'],$_POST['intIdSucursal']);
    break;
  case "F":
    $FormularioVenta = new FormularioVenta();
    $FormularioVenta->ConsultarFormulario($_POST['funcion']);
    break;
}
?>