<?php
session_start();
require_once 'clases_kardex/class_kardex_producto.php';
if(empty($_SESSION['intIdMovimiento'])){
  $_SESSION['intIdMovimiento'] = 0;
}
if(empty($_SESSION['intIdProducto'])){
  $_SESSION['intIdProducto'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $KardexProducto = new KardexProducto();
    $dtmFechaIngreso = date("Y-m-d H:i:s");
    $KardexProducto->FechaMovimiento($dtmFechaIngreso);
    $KardexProducto->IdComprobante($_POST['intIdComprobante']);
    $KardexProducto->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $KardexProducto->TipoDetalle($_POST['intTipoDetalle']);
    $KardexProducto->Serie($_POST['nvchSerie']);
    $KardexProducto->Numeracion($_POST['nvchNumeracion']);
    $KardexProducto->IdProducto($_POST['intIdProducto']);
    $KardexProducto->CantidadEntrada($_POST['intCantidadEntrada']);
    $KardexProducto->PrecioUnitarioEntrada($_POST['dcmPrecioUnitarioEntrada']);
    $KardexProducto->TotalEntrada($_POST['dcmTotalEntrada']);
    $KardexProducto->CantidaSalida($_POST['intCantidaSalida']);
    $KardexProducto->PrecioUnitariSalida($_POST['dcmPrecioUnitariSalida']);
    $KardexProducto->TotaSalida($_POST['dcmTotalSalida']);
    $KardexProducto->CantidadExistencia($_POST['intCantidadExistencia']);
    $KardexProducto->PrecioUnitarioExistencia($_POST['dcmPrecioUnitarioExistencia']);
    $KardexProducto->TotalExistencia($_POST['dcmTotalExistencia']);
    $KardexProducto->InsertarKardexProducto();
    break;
  case "A":
    $KardexProducto = new KardexProducto();
    $KardexProducto->IdMovimiento($_POST['intIdMovimiento']);
    $dtmFechaIngreso = date("Y-m-d H:i:s");
    $KardexProducto->FechaMovimiento($dtmFechaIngreso);
    $KardexProducto->IdComprobante($_POST['intIdComprobante']);
    $KardexProducto->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $KardexProducto->TipoDetalle($_POST['intTipoDetalle']);
    $KardexProducto->Serie($_POST['nvchSerie']);
    $KardexProducto->Numeracion($_POST['nvchNumeracion']);
    $KardexProducto->IdProducto($_POST['intIdProducto']);
    $KardexProducto->CantidadEntrada($_POST['intCantidadEntrada']);
    $KardexProducto->PrecioUnitarioEntrada($_POST['dcmPrecioUnitarioEntrada']);
    $KardexProducto->TotalEntrada($_POST['dcmTotalEntrada']);
    $KardexProducto->CantidaSalida($_POST['intCantidaSalida']);
    $KardexProducto->PrecioUnitariSalida($_POST['dcmPrecioUnitariSalida']);
    $KardexProducto->TotaSalida($_POST['dcmTotalSalida']);
    $KardexProducto->CantidadExistencia($_POST['intCantidadExistencia']);
    $KardexProducto->PrecioUnitarioExistencia($_POST['dcmPrecioUnitarioExistencia']);
    $KardexProducto->TotalExistencia($_POST['dcmTotalExistencia']);
    $KardexProducto->ActualizarKardexProducto();
    break;
  case "M":
    $KardexProducto = new KardexProducto();
    $KardexProducto->IdKardexProducto($_POST['intIdMovimiento']);
    $KardexProducto->MostrarKardexProducto($_POST['funcion']);
    break;
  case "E":
    $KardexProducto = new KardexProducto();
    $KardexProducto->IdKardexProducto($_POST['intIdMovimiento']);
    $KardexProducto->EliminarKardexProducto();
    break;
  case "L":
    $KardexProducto = new KardexProducto();
    $KardexProducto->IdProducto($_POST['intIdProducto']);
    $KardexProducto->ListarKardexProducto($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $KardexProducto = new KardexProducto();
    $KardexProducto->IdProducto($_POST['intIdProducto']);
    $KardexProducto->PaginarKardexProducto($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "LP":
    $KardexProducto = new KardexProducto();
    $KardexProducto->ListarProductos($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['TipoBusqueda']);
    break;
  case "PP":
    $KardexProducto = new KardexProducto();
    $KardexProducto->PaginarProductos($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['TipoBusqueda']);
    break;
}
?>