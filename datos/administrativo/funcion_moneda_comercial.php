<?php
session_start();
require_once 'clases_moneda_comercial/class_moneda_comercial.php';
require_once 'clases_moneda_comercial/class_formulario_moneda_comercial.php';
if(empty($_SESSION['intIdMonedaComercial'])){
  $_SESSION['intIdMonedaComercial'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $MonedaComercial = new MonedaComercial();
    $MonedaComercial->IdTipoCambio($_POST['intIdTipoCambio']);
    $MonedaComercial->Cambio1($_POST['dcmCambio1']);
    $MonedaComercial->Cambio2($_POST['dcmCambio2']);
    $dtmFechaCambio = str_replace('/', '-', $_POST['dtmFechaCambio']);
    $MonedaComercial->FechaCambio(date('Y-m-d', strtotime($dtmFechaCambio)));
    $MonedaComercial->InsertarMonedaComercial();
    break;
  case "A":
    $MonedaComercial = new MonedaComercial();
    $MonedaComercial->IdMonedaComercial($_POST['intIdMonedaComercial']);
    $MonedaComercial->IdTipoCambio($_POST['intIdTipoCambio']);
    $MonedaComercial->Cambio1($_POST['dcmCambio1']);
    $MonedaComercial->Cambio2($_POST['dcmCambio2']);
    $dtmFechaCambio = str_replace('/', '-', $_POST['dtmFechaCambio']);
    $MonedaComercial->FechaCambio(date('Y-m-d', strtotime($dtmFechaCambio)));
    $MonedaComercial->ActualizarMonedaComercial();
    break;
  case "M":
    $MonedaComercial = new MonedaComercial();
    $MonedaComercial->IdMonedaComercial($_POST['intIdMonedaComercial']);
    $MonedaComercial->MostrarMonedaComercial($_POST['funcion']);
    break;
  case "MF":
    $MonedaComercial = new MonedaComercial();
    $MonedaComercial->MostrarMonedaComercialFecha($_POST['nvchFecha']);
    break;
  case "E":
    $MonedaComercial = new MonedaComercial();
    $MonedaComercial->IdMonedaComercial($_POST['intIdMonedaComercial']);
    $MonedaComercial->EliminarMonedaComercial();
    break;
  case "L":
    $MonedaComercial = new MonedaComercial();
    $MonedaComercial->ListarMonedaComercial($_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['TipoCambio']);
    break;
  case "P":
    $MonedaComercial = new MonedaComercial();
    $MonedaComercial->PaginarMonedaComercial($_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['TipoCambio']);
    break;
  case "F":
    $FormularioMonedaComercial = new FormularioMonedaComercial();
    $FormularioMonedaComercial->ConsultarFormulario($_POST['funcion']);
    break;
}
?>