<?php
session_start();
require_once 'clases_datosgenerales/class_datosgenerales.php';
switch($_POST['funcion']){
  case "MP":
    $DatosGenerales = new DatosGenerales();
    $DatosGenerales->IdDepartamento($_POST['intIdDepartamento']);
    $DatosGenerales->MostrarProvincia();
    break;
  case "MD":
    $DatosGenerales = new DatosGenerales();
    $DatosGenerales->IdProvincia($_POST['intIdProvincia']);
    $DatosGenerales->MostrarDistrito();
    break;
  case "SP":
    $DatosGenerales = new DatosGenerales();
    $DatosGenerales->IdDepartamento($_POST['intIdDepartamento']);
    $DatosGenerales->SeleccionarProvincia();
    break;
  case "ES_P_SU":
    $DatosGenerales = new DatosGenerales();
    $DatosGenerales->IdSucursal($_POST['intIdSucursal']);
    $DatosGenerales->IdProducto($_POST['intIdProducto']);
    $DatosGenerales->CantidadProducto($_POST['intCantidad']);
    $DatosGenerales->ES_StockUbigeo($_POST['TipoES']);
    break;
  case "ES_P_ST":
    $DatosGenerales = new DatosGenerales();
    $DatosGenerales->IdProducto($_POST['intIdProducto']);
    $DatosGenerales->CantidadProducto($_POST['intCantidad']);
    $DatosGenerales->ES_StockTotal($_POST['TipoES']);
    break;
}
?>