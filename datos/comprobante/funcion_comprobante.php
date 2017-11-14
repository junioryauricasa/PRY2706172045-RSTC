<?php 
session_start();
require_once '../inventario/clases_producto/class_producto.php';
require_once '../ventas/clases_cliente/class_cliente.php';
require_once '../compras/clases_proveedor/class_proveedor.php';
require_once '../ventas/clases_cotizacion/class_cotizacion.php';
require_once 'clases_comprobante/class_comprobante.php';
require_once 'clases_comprobante/class_detalle_comprobante.php';
require_once '../numeraciones/class_numeraciones.php';
require_once '../reportes/clases_kardex/class_kardex_producto.php';
if(empty($_SESSION['intIdComprobante'])){
  $_SESSION['intIdComprobante'] = 0;
}
if(empty($_SESSION['intIdDetalleComprobante'])){
  $_SESSION['intIdDetalleComprobante'] = 0;
}
if(empty($_SESSION['TotalVenta'])){
  $_SESSION['TotalVenta'] = 0;
}
if(empty($_SESSION['TotalCompra'])){
  $_SESSION['TotalCompra'] = 0;
} 
switch($_POST['funcion']){
  case "I":
    $Comprobante = new Comprobante();
    $Comprobante->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $Comprobante->IdSucursal($_POST['intIdSucursal']);
    $Comprobante->Serie($_POST['nvchSerie']);
    $Comprobante->Numeracion($_POST['nvchNumeracion']);
    $Comprobante->IdUsuario($_SESSION['intIdUsuarioSesion']);
    $Comprobante->IdCliente($_POST['intIdCliente']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Comprobante->FechaCreacion($dtmFechaCreacion);
    $Comprobante->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $Comprobante->IdTipoPago($_POST['intIdTipoPago']);
    $Comprobante->IdTipoVenta($_POST['intIdTipoVenta']);
    $Comprobante->Observacion($_POST['nvchObservacion']);
    $Comprobante->InsertarComprobante();
    $DetalleComprobante = new DetalleComprobante();
    if($_POST['intIdTipoComprobante'] == 1) {
        $DetalleComprobante->IdComprobante($_SESSION['intIdComprobante']);
        $DetalleComprobante->IdProducto($_POST['intIdProducto']);
        $DetalleComprobante->FechaRealizada($dtmFechaCreacion);
        $DetalleComprobante->Cantidad($_POST['intCantidad']);
        $DetalleComprobante->Precio($_POST['dcmPrecio']);
        $DetalleComprobante->Descuento($_POST['dcmDescuento']);
        $DetalleComprobante->PrecioUnitario($_POST['dcmPrecioUnitario']);
        $DetalleComprobante->Total($_POST['dcmTotal']);
        $DetalleComprobante->IdTipoComprobante($_POST['intIdTipoComprobante']);
        $DetalleComprobante->InsertarDetalleComprobante();
        $Producto = new Producto();
        $Producto->ES_StockUbigeo($_POST['intIdProducto'],$_POST['intIdSucursal'],$_POST['intCantidad'],0);
        $Producto->ES_StockTotal($_POST['intIdProducto']);
        $KardexProducto = new KardexProducto();
        $KardexProducto->IdTipoMoneda($_POST['intIdTipoMoneda']);
        $KardexProducto->FechaMovimiento($dtmFechaCreacion);
        $KardexProducto->IdComprobante($_SESSION['intIdComprobante']);
        $KardexProducto->IdTipoComprobante($_POST['intIdTipoComprobante']);
        $KardexProducto->TipoDetalle(1);
        $KardexProducto->Serie($_POST['nvchSerie']);
        $KardexProducto->Numeracion($_POST['nvchNumeracion']);
        $KardexProducto->IdProducto($_POST['intIdProducto']);
        $KardexProducto->CantidadSalida($_POST['intCantidad']);
        $KardexProducto->InsertarKardexProducto();
    } else if($_POST['intIdTipoComprobante'] == 2) {
        $DetalleComprobante->IdComprobante($_SESSION['intIdComprobante']);
        $DetalleComprobante->FechaRealizada($dtmFechaCreacion);
        $DetalleComprobante->Cantidad($_POST['intCantidad']);
        $DetalleComprobante->PrecioUnitario($_POST['dcmPrecioUnitario']);
        $DetalleComprobante->Total($_POST['dcmTotal']);
        $DetalleComprobante->IdTipoComprobante($_POST['intIdTipoComprobante']);
        $DetalleComprobante->DescripcionServicio($_POST['nvchDescripcionServicio']);
        $DetalleComprobante->InsertarDetalleComprobante();
    }
    $Numeraciones = new Numeraciones();
    $Numeraciones->ActualizarNumeracion($_POST['intIdTipoComprobante'],$_POST['intIdSucursal'],$_POST['nvchNumeracion']);
    break;
  case "M":
    $Comprobante = new Comprobante();
    $Comprobante->IdComprobante($_POST['intIdComprobante']);
    $Comprobante->MostrarComprobante($_POST['funcion']);
    break;
  case "MDV":
    $DetalleComprobante = new DetalleComprobante();
    $DetalleComprobante->IdComprobante($_POST['intIdComprobante']);
    $DetalleComprobante->MostrarDetalleComprobante($_POST['tipolistado']);
    break;
  case "E":
    $Comprobante = new Comprobante();
    $Comprobante->IdComprobante($_POST['intIdComprobante']);
    $Comprobante->EliminarComprobante();
    break;
  case "L":
    $Comprobante = new Comprobante();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Comprobante->ListarComprobantes($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoComprobante'],
            $dtmFechaInicial,$dtmFechaFinal,$_POST['intIdTipoMoneda']);
    break;
  case "TV":
    $Comprobante = new Comprobante();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Comprobante->TotalComprobantes($_POST['busqueda'],$_POST['intIdTipoComprobante'],$dtmFechaInicial,$dtmFechaFinal,$_POST['intIdTipoMoneda']);
    break;
  case "P":
    $Comprobante = new Comprobante();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Comprobante->PaginarComprobantes($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoComprobante'],
            $dtmFechaInicial,$dtmFechaFinal);
    break;
  case "SCL":
    $Comprobante = new Comprobante();
    $Comprobante->IdCliente($_POST['intIdCliente']);
    $Comprobante->SeleccionarClienteComprobante();
    break;
  case "MCL":
    $Cliente = new Cliente();
    $Cliente->ListarClienteComprobante($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['intIdTipoPersona']);
    break;
  case "PCL":
    $Cliente = new Cliente();
    $Cliente->PaginarClientes($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['intIdTipoPersona']);
    break;
  case "ICT":
    $Cotizacion = new Cotizacion();
    $Cotizacion->InsertarCotizacion($_POST['intIdCotizacion'],$_POST['intIdTipoMoneda'],$_POST['num']);
    break;
  case "MCT":
    $Cotizacion = new Cotizacion();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Cotizacion->ListarCotizacionesComprobante($_POST['busqueda'],$_POST['x'],$_POST['y'],$dtmFechaInicial,$dtmFechaFinal);
    break;
  case "PCT":
    $Cotizacion = new Cotizacion();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Cotizacion->PaginarCotizaciones($_POST['busqueda'],$_POST['x'],$_POST['y'],$dtmFechaInicial,$dtmFechaFinal);
    break;
  case "NCPR":
    $Numeraciones = new Numeraciones();
    $Numeraciones->NumeracionAlgoritmica($_POST['intIdTipoComprobante'],$_POST['intIdSucursal']);
    break;
}
?>