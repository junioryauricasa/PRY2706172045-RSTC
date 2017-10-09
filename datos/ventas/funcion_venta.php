<?php 
session_start();
require_once 'clases_venta/class_venta.php';
require_once 'clases_venta/class_detalle_venta.php';
require_once 'clases_venta/class_formulario_venta.php';
require_once '../numeraciones/class_numeraciones.php';
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
    } else if($_POST['intIdTipoVenta'] == 2) {
        $DetalleVenta->IdVenta($_SESSION['intIdVenta']);
        $DetalleVenta->FechaRealizada($dtmFechaCreacion);
        $DetalleVenta->Cantidad($_POST['intCantidad']);
        $DetalleVenta->PrecioUnitario($_POST['dcmPrecioUnitario']);
        $DetalleVenta->Total($_POST['dcmTotal']);
        $DetalleVenta->IdTipoVenta($_POST['intIdTipoVenta']);
        $DetalleVenta->DescripcionServicio($_POST['nvchDescripcionServicio']);
    }
    $DetalleVenta->InsertarDetalleVenta();
    $Numeraciones = new Numeraciones();
    $Numeraciones->ActualizarNumeracion($_POST['intIdTipoComprobante'],$_POST['intIdSucursal'],$_POST['nvchNumeracion']);
    break;
  case "IDV":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->IdVenta($_POST['intIdVenta']);
    $DetalleVenta->IdProducto($_POST['intIdProducto']);
    $dtmFechaRealizada = date("Y-m-d H:i:s");
    $DetalleVenta->FechaRealizada($dtmFechaRealizada);
    $DetalleVenta->Cantidad($_POST['intCantidad']);
    $DetalleVenta->Precio($_POST['dcmPrecio']);
    $DetalleVenta->InsertarDetalleVenta_II();
    break;
  case "A":
    $Venta = new Venta();
    $Venta->IdVenta($_POST['intIdVenta']);
    $Venta->NumFactura($_POST['nvchNumFactura']);
    $Venta->NumBoletaVenta($_POST['nvchNumBoletaVenta']);
    $Venta->IdUsuario($_POST['intIdUsuario']);
    $Venta->IdCliente($_POST['intIdCliente']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Venta->FechaCreacion($dtmFechaCreacion);
    $Venta->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $Venta->ActualizarVenta();
    break;
  case "ADV":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->IdOperacionVenta($_POST['intIdOperacionVenta']);
    $DetalleVenta->IdVenta($_POST['intIdVenta']);
    $DetalleVenta->IdProducto($_POST['intIdProducto']);
    $dtmFechaRealizada = date("Y-m-d H:i:s");
    $DetalleVenta->FechaRealizada($dtmFechaRealizada);
    $DetalleVenta->Cantidad($_POST['intCantidad']);
    $DetalleVenta->Precio($_POST['dcmPrecio']);
    $DetalleVenta->ActualizarDetalleVenta();
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
  case "SDV":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->IdOperacionVenta($_POST['intIdOperacionVenta']);
    $DetalleVenta->SeleccionarDetalleVenta();
    break;
  case "E":
    $Venta = new Venta();
    $Venta->IdVenta($_POST['intIdVenta']);
    $Venta->EliminarVenta();
    break;
  case "EDV":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->IdOperacionVenta($_POST['intIdOperacionVenta']);
    $DetalleVenta->EliminarDetalleVenta();
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
  case "PPV":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->PaginarProductosVenta($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda']);
    break;
  case "ICT":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->InsertarCotizacion($_POST['nvchNumeracionCotizacion']);
    break;
  case "LCT":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->ListarCotizacionVenta();
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