<?php
session_start();
require_once '../inventario/clases_producto/class_producto.php';
require_once 'clases_compra/class_compra.php';
require_once 'clases_compra/class_detalle_compra.php';
require_once 'clases_compra/class_formulario_compra.php';
require_once '../reportes/clases_kardex/class_kardex_producto.php';
if(empty($_SESSION['intIdCompra'])){
  $_SESSION['intIdCompra'] = 0;
}
if(empty($_SESSION['intIdOperacionCompra'])){
  $_SESSION['intIdOperacionCompra'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Compra = new Compra();
    $Compra->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $Compra->IdSucursal($_POST['intIdSucursal']);
    $Compra->Serie($_POST['nvchSerie']);
    $Compra->Numeracion($_POST['nvchNumeracion']);
    $Compra->IdUsuario($_SESSION['intIdUsuarioSesion']);
    $Compra->RUC($_POST['nvchRUC']);
    $Compra->RazonSocial($_POST['nvchRazonSocial']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Compra->FechaCreacion($dtmFechaCreacion);
    $Compra->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $Compra->IdTipoPago($_POST['intIdTipoPago']);
    $Compra->Observacion($_POST['nvchObservacion']);
    $Compra->InsertarCompra();
    $DetalleCompra = new DetalleCompra();
    $DetalleCompra->IdCompra($_SESSION['intIdCompra']);
    $DetalleCompra->IdProducto($_POST['intIdProducto']);
    $DetalleCompra->FechaCompra($dtmFechaCreacion);
    $DetalleCompra->PrecioUnitario($_POST['dcmPrecioUnitario']);
    $DetalleCompra->Cantidad($_POST['intCantidad']);
    $DetalleCompra->Total($_POST['dcmTotal']);
    $DetalleCompra->InsertarDetalleCompra();

    $Producto = new Producto();
    $Producto->ES_StockUbigeo($_POST['intIdProducto'],$_POST['intIdSucursal'],$_POST['intCantidad'],1);
    $Producto->ES_StockTotal($_POST['intIdProducto']);
    /*
    $KardexProducto = new KardexProducto();
    $KardexProducto->FechaMovimiento($dtmFechaCreacion);
    $KardexProducto->TipoDetalle(2);
    $KardexProducto->IdProducto($_POST['intIdProducto']);
    $KardexProducto->CantidadEntrada($_POST['intCantidad']);
    $KardexProducto->PrecioEntrada($_POST['dcmPrecioUnitario']);
    $KardexProducto->TotalEntrada($_POST['dcmTotal']);
    $KardexProducto->InsertarKardexProductoInicial();
    */
    break;
  case "A":
    $Compra = new Compra();
    $Compra->IdCompra($_POST['intIdCompra']);
    $Compra->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $Compra->IdSucursal($_POST['intIdSucursal']);
    $Compra->Serie($_POST['nvchSerie']);
    $Compra->Numeracion($_POST['nvchNumeracion']);
    $Compra->IdUsuario($_SESSION['intIdUsuarioSesion']);
    $Compra->RUC($_POST['nvchRUC']);
    $Compra->RazonSocial($_POST['nvchRazonSocial']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Compra->FechaCreacion($dtmFechaCreacion);
    $Compra->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $Compra->IdTipoPago($_POST['intIdTipoPago']);
    $Compra->Observacion($_POST['nvchObservacion']);
    $Compra->ActualizarCompra();
    break;
  case "M":
    $Compra = new Compra();
    $Compra->IdCompra($_POST['intIdCompra']);
    $Compra->MostrarCompra($_POST['funcion']);
    break;
  case "E":
    $Compra = new Compra();
    $Compra->IdCompra($_POST['intIdCompra']);
    $Compra->EliminarCompra();
    break;
  case "L":
    $Compra = new Compra();
    $Compra->ListarCompras($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoComprobante']);
    break;
  case "P":
    $Compra = new Compra();
    $Compra->PaginarCompras($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoComprobante']);
    break;
  case "ID":
    $DetalleCompra = new DetalleCompra();
    $DetalleCompra->IdCompra($_SESSION['intIdCompra']);
    $DetalleCompra->IdProducto($_POST['intIdProducto']);
    $DetalleCompra->FechaCompra($dtmFechaCreacion);
    $DetalleCompra->Codigo($_POST['nvchCodigo']);
    $DetalleCompra->Descripcion($_POST['nvchDescripcion']);
    $DetalleCompra->PrecioUnitario($_POST['dcmPrecioUnitario']);
    $DetalleCompra->Cantidad($_POST['intCantidad']);
    $DetalleCompra->Total($_POST['dcmTotal']);
    $DetalleCompra->InsertarDetalleCompra();
  case "AD":
    $DetalleCompra = new DetalleCompra();
    $DetalleCompra->IdOperacionCompra($_POST['intIdOperacionCompra']);
    $DetalleCompra->IdCompra($_SESSION['intIdCompra']);
    $DetalleCompra->IdProducto($_POST['intIdProducto']);
    $DetalleCompra->FechaCompra($dtmFechaCreacion);
    $DetalleCompra->Codigo($_POST['nvchCodigo']);
    $DetalleCompra->Descripcion($_POST['nvchDescripcion']);
    $DetalleCompra->PrecioUnitario($_POST['dcmPrecioUnitario']);
    $DetalleCompra->Cantidad($_POST['intCantidad']);
    $DetalleCompra->Total($_POST['dcmTotal']);
    $DetalleCompra->ActualizarDetalleCompra();
    break;
  case "MD":
    $DetalleCompra = new DetalleCompra();
    $DetalleCompra->IdCompra($_POST['intIdCompra']);
    $DetalleCompra->MostrarDetalleCompra($_POST['tipolistado']);
    break;
  case "SD":
    $DetalleCompra = new DetalleCompra();
    $DetalleCompra->IdOperacionCompra($_POST['intIdOperacionCompra']);
    $DetalleCompra->SeleccionarDetalleCompra();
    break;
  case "ED":
    $DetalleCompra = new DetalleCompra();
    $DetalleCompra->IdOperacionCompra($_POST['intIdOperacionCompra']);
    $DetalleCompra->EliminarDetalleCompra();
    break;
  case "MPT":
    $DetalleCompra = new DetalleCompra();
    $DetalleCompra->ListarProductoCompra($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda'],$_POST['intIdSucursal']);
    break;
  case "PPT":
    $DetalleCompra = new DetalleCompra();
    $DetalleCompra->PaginarProductosCompra($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda']);
    break;
  case "F":
    $FormularioCompra = new FormularioCompra();
    $FormularioCompra->ConsultarFormulario($_POST['funcion']);
    break;
  case "ES_P_SU":
    $Producto = new Producto();
    $Producto->ES_StockUbigeo($_POST['intIdProducto'],$_POST['intIdSucursal'],$_POST['intCantidad'],$_POST['TipoES']);
    break;
  case "ES_P_ST":
    $Producto = new Producto();
    $Producto->ES_StockTotal($_POST['intIdProducto'],$_POST['intCantidad'],$_POST['TipoES']);
    break;
}
?>