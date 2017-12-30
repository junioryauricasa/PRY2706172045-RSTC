<?php 
session_start();
require_once '../inventario/clases_producto/class_producto.php';
require_once '../ventas/clases_cliente/class_cliente.php';
require_once '../compras/clases_proveedor/class_proveedor.php';
require_once 'clases_cotizacion/class_cotizacion.php';
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
    if($_POST['intIdTipoComprobante'] == 4)
        $_POST['intTipoDetalle'] = 2;
    if($_POST['intIdTipoComprobante'] == 8)
        $_POST['intTipoDetalle'] = 1;
    $Comprobante->TipoDetalle($_POST['intTipoDetalle']);
    $Comprobante->IdSucursal($_POST['intIdSucursal']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Comprobante->FechaCreacion($dtmFechaCreacion);
    $Comprobante->Serie($_POST['nvchSerie']);
    $Comprobante->Numeracion($_POST['nvchNumeracion']);
    $Comprobante->IdUsuario($_SESSION['intIdUsuarioSesion']);
    if($_POST['intIdTipoComprobante'] == 9 || $_POST['intIdTipoComprobante'] == 10)
        $Comprobante->IdUsuarioSolicitado($_POST['intIdUsuarioSolicitado']);
    $Comprobante->Atencion($_POST['nvchAtencion']);
    $Comprobante->Destino($_POST['nvchDestino']);
    $dtmFechaTraslado = str_replace('/', '-', $_POST['dtmFechaTraslado']);
    $dtmFechaTraslado = date('Y-m-d', strtotime($dtmFechaTraslado));
    $Comprobante->FechaTraslado($dtmFechaTraslado);
    $Comprobante->PuntoPartida($_POST['nvchPuntoPartida']);
    $Comprobante->PuntoLlegada($_POST['nvchPuntoLlegada']);
    if($_POST['intIdTipoComprobante'] == 3 || $_POST['intIdTipoComprobante'] == 7 || 
        $_POST['intIdTipoComprobante'] == 4 || $_POST['intIdTipoComprobante'] == 8)
        $Comprobante->IdComprobanteReferencia($_POST['intIdComprobanteReferencia']);
    $Comprobante->IdCliente($_POST['intIdCliente']);
    $Comprobante->IdProveedor($_POST['intIdProveedor']);
    $Comprobante->ClienteProveedor($_POST['nvchClienteProveedor']);
    $Comprobante->DNIRUC($_POST['nvchDNIRUC']);
    $Comprobante->Direccion($_POST['nvchDireccion']);
    $Comprobante->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $Comprobante->IdTipoPago($_POST['intIdTipoPago']);
    $Comprobante->IdTipoVenta($_POST['intIdTipoVenta']);
    $Descontar = 1;
    if($_POST['intIdTipoComprobante'] == 3 || $_POST['intIdTipoComprobante'] == 7){
        $Comprobante->DescontarGR($_POST['intDescontarGR']);
        $Descontar = $_POST['intDescontarGR'];
    } else{
        $Comprobante->DescontarGR(1);
        $Descontar = 1;
    }
    $Comprobante->Observacion($_POST['nvchObservacion']);
    $Comprobante->InsertarComprobante();
    $DetalleComprobante = new DetalleComprobante();
    if($_POST['intIdTipoVenta'] == 1 || $_POST['intIdTipoVenta'] >=3) {
        $DetalleComprobante->IdComprobante($_SESSION['intIdComprobante']);
        $DetalleComprobante->IdTipoVenta($_POST['intIdTipoVenta']);
        $DetalleComprobante->TipoDetalle($_POST['intTipoDetalle']);
        $DetalleComprobante->FechaRealizada($dtmFechaCreacion);
        $DetalleComprobante->IdProducto($_POST['intIdProducto'.$_POST['Letra']]);
        $DetalleComprobante->Codigo($_POST['nvchCodigo'.$_POST['Letra']]);
        $DetalleComprobante->Descripcion($_POST['nvchDescripcion'.$_POST['Letra']]);
        if($_POST['intTipoDetalle'] == 1 && $_POST['intIdTipoComprobante'] < 3){
            $DetalleComprobante->Precio($_POST['dcmPrecio']);
            $DetalleComprobante->Descuento($_POST['dcmDescuento']);
        }
        $DetalleComprobante->PrecioUnitario($_POST['dcmPrecioUnitario'.$_POST['Letra']]);
        $DetalleComprobante->Cantidad($_POST['intCantidad'.$_POST['Letra']]);
        $DetalleComprobante->Total($_POST['dcmTotal'.$_POST['Letra']]);
        $DetalleComprobante->InsertarDetalleComprobante($_POST['funcion']);
        if($Descontar == 1){
        $Producto = new Producto();
        $Producto->ES_StockUbigeo($_POST['intIdProducto'.$_POST['Letra']],$_POST['intIdSucursal'],$_POST['intCantidad'.$_POST['Letra']],((int)$_POST['intTipoDetalle']-1));
        $Producto->ES_StockTotal($_POST['intIdProducto'.$_POST['Letra']]);
        }
    } else if($_POST['intIdTipoVenta'] == 2) {
        $DetalleComprobante->IdComprobante($_SESSION['intIdComprobante']);
        $DetalleComprobante->IdTipoVenta($_POST['intIdTipoVenta']);
        $DetalleComprobante->TipoDetalle($_POST['intTipoDetalle']);
        $DetalleComprobante->FechaRealizada($dtmFechaCreacion);
        $DetalleComprobante->Descripcion($_POST['nvchDescripcionS']);
        $DetalleComprobante->PrecioUnitario($_POST['dcmPrecioUnitarioS']);
        $DetalleComprobante->Cantidad($_POST['intCantidadS']);
        $DetalleComprobante->Total($_POST['dcmTotalS']);
        $DetalleComprobante->InsertarDetalleComprobante($_POST['funcion']);
    }
    $Numeraciones = new Numeraciones();
    $Numeraciones->ActualizarNumeracion($_POST['intIdTipoComprobante'],$_POST['intIdSucursal'],$_POST['nvchNumeracion']);
    break;
  case "A":
    $Descontar = 1;
    $Comprobante = new Comprobante();
    if($_POST['intIdTipoComprobante'] == 3 || $_POST['intIdTipoComprobante'] == 7){
        $Comprobante->DescontarGR($_POST['intDescontarGR']);
        $Descontar = $_POST['intDescontarGR'];
    } else{
        $Comprobante->DescontarGR(1);
        $Descontar = 1;
    }
    if($Descontar == 1){
    $Producto = new Producto();
    $Producto->RegresionCantidad($_POST['intIdComprobante']);
    }
    $Comprobante->IdComprobante($_POST['intIdComprobante']);
    $Comprobante->IdTipoComprobante($_POST['intIdTipoComprobante']);
    if($_POST['intIdTipoComprobante'] == 4)
        $_POST['intTipoDetalle'] = 2;
    if($_POST['intIdTipoComprobante'] == 8)
        $_POST['intTipoDetalle'] = 1;
    $Comprobante->TipoDetalle($_POST['intTipoDetalle']);
    $Comprobante->IdSucursal($_POST['intIdSucursal']);
    $dtmFechaCreacion = str_replace('/', '-', $_POST['nvchFecha']);
    $dtmFechaCreacion = date('Y-m-d H:i:s', strtotime($dtmFechaCreacion));
    $Comprobante->FechaCreacion($dtmFechaCreacion);
    $Comprobante->Serie($_POST['nvchSerie']);
    $Comprobante->Numeracion($_POST['nvchNumeracion']);
    $Comprobante->IdUsuario($_SESSION['intIdUsuarioSesion']);
    if($_POST['intIdTipoComprobante'] == 9 || $_POST['intIdTipoComprobante'] == 10)
        $Comprobante->IdUsuarioSolicitado($_POST['intIdUsuarioSolicitado']);
    $Comprobante->Atencion($_POST['nvchAtencion']);
    $Comprobante->Destino($_POST['nvchDestino']);
    $dtmFechaTraslado = str_replace('/', '-', $_POST['dtmFechaTraslado']);
    $dtmFechaTraslado = date('Y-m-d', strtotime($dtmFechaTraslado));
    $Comprobante->FechaTraslado($dtmFechaTraslado);
    $Comprobante->PuntoPartida($_POST['nvchPuntoPartida']);
    $Comprobante->PuntoLlegada($_POST['nvchPuntoLlegada']);
    if($_POST['intIdTipoComprobante'] == 3 || $_POST['intIdTipoComprobante'] == 7 || 
        $_POST['intIdTipoComprobante'] == 4 || $_POST['intIdTipoComprobante'] == 8)
        $Comprobante->IdComprobanteReferencia($_POST['intIdComprobanteReferencia']);
    $Comprobante->IdCliente($_POST['intIdCliente']);
    $Comprobante->IdProveedor($_POST['intIdProveedor']);
    $Comprobante->ClienteProveedor($_POST['nvchClienteProveedor']);
    $Comprobante->DNIRUC($_POST['nvchDNIRUC']);
    $Comprobante->Direccion($_POST['nvchDireccion']);
    $Comprobante->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $Comprobante->IdTipoPago($_POST['intIdTipoPago']);
    $Comprobante->IdTipoVenta($_POST['intIdTipoVenta']);
    $Comprobante->Observacion($_POST['nvchObservacion']);
    $Comprobante->ActualizarComprobante();
    $DetalleComprobante = new DetalleComprobante();
    if($_POST['intIdTipoVenta'] == 1 || $_POST['intIdTipoVenta'] >=3) {
        $DetalleComprobante->IdComprobante($_POST['intIdComprobante']);
        $DetalleComprobante->IdTipoVenta($_POST['intIdTipoVenta']);
        $DetalleComprobante->TipoDetalle($_POST['intTipoDetalle']);
        $DetalleComprobante->FechaRealizada($dtmFechaCreacion);
        $DetalleComprobante->IdProducto($_POST['intIdProducto'.$_POST['Letra']]);
        $DetalleComprobante->Codigo($_POST['nvchCodigo'.$_POST['Letra']]);
        $DetalleComprobante->Descripcion($_POST['nvchDescripcion'.$_POST['Letra']]);
        if($_POST['intTipoDetalle'] == 1 && $_POST['intIdTipoComprobante'] < 3){
            $DetalleComprobante->Precio($_POST['dcmPrecio']);
            $DetalleComprobante->Descuento($_POST['dcmDescuento']);
        }
        $DetalleComprobante->PrecioUnitario($_POST['dcmPrecioUnitario'.$_POST['Letra']]);
        $DetalleComprobante->Cantidad($_POST['intCantidad'.$_POST['Letra']]);
        $DetalleComprobante->Total($_POST['dcmTotal'.$_POST['Letra']]);
        $DetalleComprobante->InsertarDetalleComprobante($_POST['funcion']);
        if($Descontar == 1){
        $Producto->ES_StockUbigeo($_POST['intIdProducto'.$_POST['Letra']],$_POST['intIdSucursal'],$_POST['intCantidad'.$_POST['Letra']],((int)$_POST['intTipoDetalle']-1));
        $Producto->ES_StockTotal($_POST['intIdProducto'.$_POST['Letra']]);
        }
    } else if($_POST['intIdTipoVenta'] == 2) {
        $DetalleComprobante->IdComprobante($_POST['intIdComprobante']);
        $DetalleComprobante->IdTipoVenta($_POST['intIdTipoVenta']);
        $DetalleComprobante->TipoDetalle($_POST['intTipoDetalle']);
        $DetalleComprobante->FechaRealizada($dtmFechaCreacion);
        $DetalleComprobante->Descripcion($_POST['nvchDescripcionS']);
        $DetalleComprobante->PrecioUnitario($_POST['dcmPrecioUnitarioS']);
        $DetalleComprobante->Cantidad($_POST['intCantidadS']);
        $DetalleComprobante->Total($_POST['dcmTotalS']);
        $DetalleComprobante->InsertarDetalleComprobante($_POST['funcion']);
    }
    break;
  case "M":
    $Comprobante = new Comprobante();
    $Comprobante->IdComprobante($_POST['intIdComprobante']);
    $Comprobante->MostrarComprobante($_POST['funcion']);
    break;
  case "MDCR":
    $DetalleComprobante = new DetalleComprobante();
    $DetalleComprobante->IdComprobante($_POST['intIdComprobante']);
    $DetalleComprobante->MostrarDetalleComprobante($_POST['intIdTipoVenta']);
    break;
  case "E":
    $Comprobante = new Comprobante();
    $Comprobante->IdComprobante($_POST['intIdComprobante']);
    $Comprobante->AnularComprobante();
    break;
  case "L":
    $Comprobante = new Comprobante();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Comprobante->ListarComprobantes($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoComprobante'],
            $dtmFechaInicial,$dtmFechaFinal,$_POST['intIdTipoMoneda'],$_POST['intTipoDetalle']);
    break;
  case "TV":
    $Comprobante = new Comprobante();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Comprobante->TotalComprobantes($_POST['busqueda'],$_POST['intIdTipoComprobante'],$dtmFechaInicial,$dtmFechaFinal,$_POST['intIdTipoMoneda'],$_POST['intTipoDetalle']);
    break;
  case "P":
    $Comprobante = new Comprobante();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Comprobante->PaginarComprobantes($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoComprobante'],
            $dtmFechaInicial,$dtmFechaFinal,$_POST['intTipoDetalle']);
    break;
  case "SCL":
    $Cliente = new Cliente();
    $Cliente->IdCliente($_POST['intIdCliente']);
    $Cliente->SeleccionarClienteComprobante();
    break;
  case "MCL":
    $Cliente = new Cliente();
    $Cliente->ListarClienteComprobante($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['intIdTipoPersona'],"T","T","T");
    break;
  case "PCL":
    $Cliente = new Cliente();
    $Cliente->PaginarClientes($_POST['busqueda'],$_POST['x'],$_POST['y'],"V",$_POST['intIdTipoPersona'],"T","T","T");
    break;
  case "SPR":
    $Proveedor = new Proveedor();
    $Proveedor->IdProveedor($_POST['intIdProveedor']);
    $Proveedor->SeleccionarProveedorComprobante();
    break;
  case "MPR":
    $Proveedor = new Proveedor();
    $Proveedor->ListarProveedorComprobante($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['intIdTipoPersona']);
    break;
  case "PPR":
    $Proveedor = new Proveedor();
    $Proveedor->PaginarProveedores($_POST['busqueda'],$_POST['x'],$_POST['y'],"V",$_POST['intIdTipoPersona']);
    break;
  case "ICT":
    $Cotizacion = new Cotizacion();
    $Cotizacion->InsertarCotizacionComprobante($_POST['intIdCotizacion'],$_POST['intIdTipoMoneda'],$_POST['num'],$_POST['intIdTipoVenta']);
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
    $Cotizacion->PaginarCotizaciones($_POST['busqueda'],$_POST['x'],$_POST['y'],"V",$dtmFechaInicial,$dtmFechaFinal);
    break;
  case "IV":
    $Comprobante = new Comprobante();
    $Comprobante->InsertarVentaComprobante($_POST['intIdComprobante'],$_POST['num'],$_POST['intIdTipoVenta']);
    break;
  case "MV":
    $Comprobante = new Comprobante();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Comprobante->ListarVentasComprobante($_POST['busqueda'],$_POST['x'],$_POST['y'],$dtmFechaInicial,$dtmFechaFinal);
    break;
  case "PV":
    $Comprobante = new Comprobante();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Comprobante->PaginarVentasComprobante($_POST['busqueda'],$_POST['x'],$_POST['y'],"V",$dtmFechaInicial,$dtmFechaFinal);
    break;
  case "NCPR":
    $Numeraciones = new Numeraciones();
    $Numeraciones->NumeracionAlgoritmica($_POST['intIdTipoComprobante'],$_POST['intIdSucursal']);
    break;
}
?>