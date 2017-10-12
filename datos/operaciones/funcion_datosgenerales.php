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
}
?>