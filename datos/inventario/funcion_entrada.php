<?php
session_start();
require_once 'clases_producto/class_producto.php';
require_once 'clases_entrada/class_entrada.php';
require_once 'clases_entrada/class_detalle_entrada.php';
require_once 'clases_entrada/class_formulario_entrada.php';
require_once '../numeraciones/class_numeraciones.php';
require_once '../reportes/clases_kardex/class_kardex_producto.php';
if(empty($_SESSION['intIdEntrada'])){
  $_SESSION['intIdEntrada'] = 0;
}
if(empty($_SESSION['intIdOperacionEntrada'])){
  $_SESSION['intIdOperacionEntrada'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Entrada = new Entrada();
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Entrada->FechaCreacion($dtmFechaCreacion);
    $Entrada->Serie($_POST['nvchSerie']);
    $Entrada->Numeracion($_POST['nvchNumeracion']);
    $Entrada->RazonSocial($_POST['nvchRazonSocial']);
    $Entrada->RUC($_POST['nvchRUC']);
    $Entrada->IdUsuarioSolicitado($_POST['intIdUsuarioSolicitado']);
    $Entrada->IdUsuario($_SESSION['intIdUsuarioSesion']);
    $Entrada->IdSucursal($_POST['intIdSucursal']);
    $Entrada->Observacion($_POST['nvchObservacion']);
    $Entrada->InsertarEntrada();

    $DetalleEntrada = new DetalleEntrada();
    $DetalleEntrada->IdEntrada($_SESSION['intIdEntrada']);
    $DetalleEntrada->FechaEntrada($dtmFechaCreacion);
    $DetalleEntrada->IdProducto($_POST['intIdProducto']);
    $DetalleEntrada->Codigo($_POST['nvchCodigo']);
    $DetalleEntrada->Descripcion($_POST['nvchDescripcion']);
    $DetalleEntrada->Cantidad($_POST['intCantidad']);
    $DetalleEntrada->InsertarDetalleEntrada();

    $Producto = new Producto();
    $Producto->ES_StockUbigeo($_POST['intIdProducto'],$_POST['intIdSucursal'],$_POST['intCantidad'],1);
    $Producto->ES_StockTotal($_POST['intIdProducto']);

    $KardexProducto = new KardexProducto();
    $KardexProducto->FechaMovimiento($dtmFechaCreacion);
    $KardexProducto->IdComprobante($_SESSION['intIdVenta']);
    $KardexProducto->IdTipoComprobante(9);
    $KardexProducto->TipoDetalle(2);
    $KardexProducto->Serie($_POST['nvchSerie']);
    $KardexProducto->Numeracion($_POST['nvchNumeracion']);
    $KardexProducto->IdProducto($_POST['intIdProducto']);
    $KardexProducto->CantidadEntrada($_POST['intCantidad']);
    $KardexProducto->PrecioEntrada($_POST['dcmPrecioUnitario']);
    $KardexProducto->TotalEntrada($_POST['dcmTotal']);
    $KardexProducto->InsertarKardexProducto();

    $Numeraciones = new Numeraciones();
    $Numeraciones->ActualizarNumeracion(9,$_POST['intIdSucursal'],$_POST['nvchNumeracion']);
    break;
  case "A":
    $Entrada = new Entrada();
    $Entrada->IdEntrada($_POST['intIdEntrada']);
    $Entrada->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $Entrada->IdSucursal($_POST['intIdSucursal']);
    $Entrada->Serie($_POST['nvchSerie']);
    $Entrada->Numeracion($_POST['nvchNumeracion']);
    $Entrada->IdUsuario($_SESSION['intIdUsuarioSesion']);
    $Entrada->RUC($_POST['nvchRUC']);
    $Entrada->RazonSocial($_POST['nvchRazonSocial']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Entrada->FechaCreacion($dtmFechaCreacion);
    $Entrada->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $Entrada->IdTipoPago($_POST['intIdTipoPago']);
    $Entrada->Observacion($_POST['nvchObservacion']);
    $Entrada->ActualizarEntrada();
    break;
  case "M":
    $Entrada = new Entrada();
    $Entrada->IdEntrada($_POST['intIdEntrada']);
    $Entrada->MostrarEntrada($_POST['funcion']);
    break;
  case "E":
    $Entrada = new Entrada();
    $Entrada->IdEntrada($_POST['intIdEntrada']);
    $Entrada->EliminarEntrada();
    break;
  case "L":
    $Entrada = new Entrada();
    $Entrada->ListarEntradas($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $Entrada = new Entrada();
    $Entrada->PaginarEntradas($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "ID":
    $DetalleEntrada = new DetalleEntrada();
    $DetalleEntrada->IdEntrada($_SESSION['intIdEntrada']);
    $DetalleEntrada->IdProducto($_POST['intIdProducto']);
    $DetalleEntrada->FechaEntrada($dtmFechaCreacion);
    $DetalleEntrada->Codigo($_POST['nvchCodigo']);
    $DetalleEntrada->Descripcion($_POST['nvchDescripcion']);
    $DetalleEntrada->PrecioUnitario($_POST['dcmPrecioUnitario']);
    $DetalleEntrada->Cantidad($_POST['intCantidad']);
    $DetalleEntrada->Total($_POST['dcmTotal']);
    $DetalleEntrada->InsertarDetalleEntrada();
  case "AD":
    $DetalleEntrada = new DetalleEntrada();
    $DetalleEntrada->IdOperacionEntrada($_POST['intIdOperacionEntrada']);
    $DetalleEntrada->IdEntrada($_SESSION['intIdEntrada']);
    $DetalleEntrada->IdProducto($_POST['intIdProducto']);
    $DetalleEntrada->FechaEntrada($dtmFechaCreacion);
    $DetalleEntrada->Codigo($_POST['nvchCodigo']);
    $DetalleEntrada->Descripcion($_POST['nvchDescripcion']);
    $DetalleEntrada->PrecioUnitario($_POST['dcmPrecioUnitario']);
    $DetalleEntrada->Cantidad($_POST['intCantidad']);
    $DetalleEntrada->Total($_POST['dcmTotal']);
    $DetalleEntrada->ActualizarDetalleEntrada();
    break;
  case "MD":
    $DetalleEntrada = new DetalleEntrada();
    $DetalleEntrada->IdEntrada($_POST['intIdEntrada']);
    $DetalleEntrada->MostrarDetalleEntrada($_POST['tipolistado']);
    break;
  case "SD":
    $DetalleEntrada = new DetalleEntrada();
    $DetalleEntrada->IdOperacionEntrada($_POST['intIdOperacionEntrada']);
    $DetalleEntrada->SeleccionarDetalleEntrada();
    break;
  case "ED":
    $DetalleEntrada = new DetalleEntrada();
    $DetalleEntrada->IdOperacionEntrada($_POST['intIdOperacionEntrada']);
    $DetalleEntrada->EliminarDetalleEntrada();
    break;
  case "MPT":
    $DetalleEntrada = new DetalleEntrada();
    $DetalleEntrada->ListarProductoEntrada($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda'],$_POST['intIdSucursal']);
    break;
  case "PPT":
    $DetalleEntrada = new DetalleEntrada();
    $DetalleEntrada->PaginarProductosEntrada($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda']);
    break;
  case "F":
    $FormularioEntrada = new FormularioEntrada();
    $FormularioEntrada->ConsultarFormulario($_POST['funcion']);
    break;
  case "NCPR":
    $Numeraciones = new Numeraciones();
    $Numeraciones->NumeracionAlgoritmica($_POST['intIdTipoComprobante'],$_POST['intIdSucursal']);
    break;
}
?>