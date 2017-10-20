<?php
session_start();
require_once 'clases_kardex/class_kardex.php';
require_once 'clases_kardex/class_formulario_kardex.php';
if(empty($_SESSION['intIdMovimiento'])){
  $_SESSION['intIdMovimiento'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Kardex = new Kardex();
    $dtmFechaIngreso = date("Y-m-d H:i:s");
    $Kardex->FechaMovimiento($dtmFechaIngreso);
    $Kardex->IdComprobante($_POST['intIdComprobante']);
    $Kardex->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $Kardex->TipoDetalle($_POST['intTipoDetalle']);
    $Kardex->Serie($_POST['nvchSerie']);
    $Kardex->Numeracion($_POST['nvchNumeracion']);
    $Kardex->IdProducto($_POST['intIdProducto']);
    $Kardex->CantidadEntrada($_POST['intCantidadEntrada']);
    $Kardex->PrecioUnitarioEntrada($_POST['dcmPrecioUnitarioEntrada']);
    $Kardex->TotalEntrada($_POST['dcmTotalEntrada']);
    $Kardex->CantidaSalida($_POST['intCantidaSalida']);
    $Kardex->PrecioUnitariSalida($_POST['dcmPrecioUnitariSalida']);
    $Kardex->TotaSalida($_POST['dcmTotalSalida']);
    $Kardex->CantidadExistencia($_POST['intCantidadExistencia']);
    $Kardex->PrecioUnitarioExistencia($_POST['dcmPrecioUnitarioExistencia']);
    $Kardex->TotalExistencia($_POST['dcmTotalExistencia']);
    $Kardex->InsertarKardex();
    break;
  case "A":
    $Kardex = new Kardex();
    $Kardex->IdMovimiento($_POST['intIdMovimiento']);
    $dtmFechaIngreso = date("Y-m-d H:i:s");
    $Kardex->FechaMovimiento($dtmFechaIngreso);
    $Kardex->IdComprobante($_POST['intIdComprobante']);
    $Kardex->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $Kardex->TipoDetalle($_POST['intTipoDetalle']);
    $Kardex->Serie($_POST['nvchSerie']);
    $Kardex->Numeracion($_POST['nvchNumeracion']);
    $Kardex->IdProducto($_POST['intIdProducto']);
    $Kardex->CantidadEntrada($_POST['intCantidadEntrada']);
    $Kardex->PrecioUnitarioEntrada($_POST['dcmPrecioUnitarioEntrada']);
    $Kardex->TotalEntrada($_POST['dcmTotalEntrada']);
    $Kardex->CantidaSalida($_POST['intCantidaSalida']);
    $Kardex->PrecioUnitariSalida($_POST['dcmPrecioUnitariSalida']);
    $Kardex->TotaSalida($_POST['dcmTotalSalida']);
    $Kardex->CantidadExistencia($_POST['intCantidadExistencia']);
    $Kardex->PrecioUnitarioExistencia($_POST['dcmPrecioUnitarioExistencia']);
    $Kardex->TotalExistencia($_POST['dcmTotalExistencia']);
    $Kardex->ActualizarKardex();
    break;
  case "M":
    $Kardex = new Kardex();
    $Kardex->IdKardex($_POST['intIdMovimiento']);
    $Kardex->MostrarKardex($_POST['funcion']);
    break;
  case "E":
    $Kardex = new Kardex();
    $Kardex->IdKardex($_POST['intIdMovimiento']);
    $Kardex->EliminarKardex();
    break;
  case "L":
    $Kardex = new Kardex();
    $Kardex->ListarKardex($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $Kardex = new Kardex();
    $Kardex->PaginarKardex($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "F":
    $FormularioKardex = new FormularioKardex();
    $FormularioKardex->ConsultarFormulario($_POST['funcion']);
    break;
}
?>