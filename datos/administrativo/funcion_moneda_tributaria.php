<?php
session_start();
require_once 'clases_moneda_tributaria/class_moenda_tributaria.php';
require_once 'clases_moneda_tributaria/class_formulario_moneda_tributaria.php';
if(empty($_SESSION['intIdMonedaTributaria'])){
  $_SESSION['intIdMonedaTributaria'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $MonedaTributaria = new MonedaTributaria();
    $MonedaTributaria->Cambio1($_POST['dcmCambio1']);
    $MonedaTributaria->Cambio2($_POST['dcmCambio2']);
    $MonedaTributaria->FechaCambio($_POST['dtmFechaCambio']);
    $MonedaTributaria->InsertarMonedaTributaria();
    break;
  case "A":
    $MonedaTributaria = new MonedaTributaria();
    $MonedaTributaria->IdMonedaTributaria($_POST['intIdMonedaTributaria']);
    $MonedaTributaria->Cambio1($_POST['dcmCambio1']);
    $MonedaTributaria->Cambio2($_POST['dcmCambio2']);
    $MonedaTributaria->FechaCambio($_POST['dtmFechaCambio']);
    $MonedaTributaria->ActualizarMonedaTributaria();
    break;
  case "M":
    $MonedaTributaria = new MonedaTributaria();
    $MonedaTributaria->IdMonedaTributaria($_POST['intIdMonedaTributaria']);
    $MonedaTributaria->MostrarMonedaTributaria($_POST['funcion']);
    break;
  case "E":
    $MonedaTributaria = new MonedaTributaria();
    $MonedaTributaria->IdMonedaTributaria($_POST['intIdMonedaTributaria']);
    $MonedaTributaria->EliminarMonedaTributaria();
    break;
  case "L":
    $MonedaTributaria = new MonedaTributaria();
    $MonedaTributaria->ListarMonedaTributaria($_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['TipoCambio']);
    break;
  case "P":
    $MonedaTributaria = new MonedaTributaria();
    $MonedaTributaria->PaginarMonedaTributaria($_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['TipoCambio']);
    break;
  case "F":
    $FormularioMonedaTributaria = new FormularioMonedaTributaria();
    $FormularioMonedaTributaria->ConsultarFormulario($_POST['funcion']);
    break;
}
?>