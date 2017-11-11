<?php 
session_start();
require_once '../inventario/clases_producto/class_producto.php';
require_once 'clases_venta/class_venta.php';
require_once 'clases_venta/class_detalle_venta.php';
require_once 'clases_venta/class_formulario_venta.php';
require_once '../numeraciones/class_numeraciones.php';
require_once '../reportes/clases_kardex/class_kardex_producto.php';
if(empty($_SESSION['intIdVenta'])){
  $_SESSION['intIdVenta'] = 0;
}
if(empty($_SESSION['intIdOperacionVenta'])){
  $_SESSION['intIdOperacionVenta'] = 0;
}
if(empty($_SESSION['TotalVenta'])){
  $_SESSION['TotalVenta'] = 0;
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
        $DetalleVenta->Precio($_POST['dcmPrecio']);
        $DetalleVenta->Descuento($_POST['dcmDescuento']);
        $DetalleVenta->PrecioUnitario($_POST['dcmPrecioUnitario']);
        $DetalleVenta->Total($_POST['dcmTotal']);
        $DetalleVenta->IdTipoVenta($_POST['intIdTipoVenta']);
        $DetalleVenta->InsertarDetalleVenta();
        $Producto = new Producto();
        $Producto->ES_StockUbigeo($_POST['intIdProducto'],$_POST['intIdSucursal'],$_POST['intCantidad'],0);
        $Producto->ES_StockTotal($_POST['intIdProducto']);
        $KardexProducto = new KardexProducto();
        $KardexProducto->IdTipoMoneda($_POST['intIdTipoMoneda']);
        $KardexProducto->FechaMovimiento($dtmFechaCreacion);
        $KardexProducto->IdComprobante($_SESSION['intIdVenta']);
        $KardexProducto->IdTipoComprobante($_POST['intIdTipoComprobante']);
        $KardexProducto->TipoDetalle(1);
        $KardexProducto->Serie($_POST['nvchSerie']);
        $KardexProducto->Numeracion($_POST['nvchNumeracion']);
        $KardexProducto->IdProducto($_POST['intIdProducto']);
        $KardexProducto->CantidadSalida($_POST['intCantidad']);
        $KardexProducto->InsertarKardexProducto();
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
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Venta->ListarVentas($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoComprobante'],
            $dtmFechaInicial,$dtmFechaFinal,$_POST['intIdTipoMoneda']);
    break;
  case "TV":
    $Venta = new Venta();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Venta->TotalVentas($_POST['busqueda'],$_POST['intIdTipoComprobante'],$dtmFechaInicial,$dtmFechaFinal,$_POST['intIdTipoMoneda']);
    break;
  case "P":
    $Venta = new Venta();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Venta->PaginarVentas($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoComprobante'],
            $dtmFechaInicial,$dtmFechaFinal);
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
    $DetalleVenta->ListarProductoVenta($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda'],$_POST['intIdSucursal'],
        $_POST['intIdTipoMoneda']);
    break;
  case "PPT":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->PaginarProductosVenta($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda']);
    break;
  case "ICT":
    $DetalleVenta = new DetalleVenta();
    $DetalleVenta->InsertarCotizacion($_POST['intIdCotizacion'],$_POST['intIdTipoMoneda']);
    break;
  case "MCT":
    $DetalleVenta = new DetalleVenta();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $DetalleVenta->ListarCotizacionesVenta($_POST['busqueda'],$_POST['x'],$_POST['y'],$dtmFechaInicial,$dtmFechaFinal);
    break;
  case "PCT":
    $DetalleVenta = new DetalleVenta();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $DetalleVenta->PaginarCotizacionesVenta($_POST['busqueda'],$_POST['x'],$_POST['y'],$dtmFechaInicial,$dtmFechaFinal);
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