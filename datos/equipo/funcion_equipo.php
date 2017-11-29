<?php
session_start();
require_once 'clases_equipo/class_equipo.php';
if(empty($_SESSION['intIdCotizacionEquipo'])){
  $_SESSION['intIdCotizacionEquipo'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $CotizacionEquipo = new CotizacionEquipo();
    $CotizacionEquipo->IdTipoCambio($_POST['intIdTipoCambio']);
    $dtmFechaCambio = str_replace('/', '-', $_POST['dtmFechaCambio']);
    $CotizacionEquipo->FechaCambio(date('Y-m-d', strtotime($dtmFechaCambio)));
    $CotizacionEquipo->InsertarCotizacionEquipo();
    break;
  case "A":
    $CotizacionEquipo = new CotizacionEquipo();
    $CotizacionEquipo->IdCotizacionEquipo($_POST['intIdCotizacionEquipo']);
    $CotizacionEquipo->IdTipoCambio($_POST['intIdTipoCambio']);
    $CotizacionEquipo->Cambio1($_POST['dcmCambio1']);
    $CotizacionEquipo->Cambio2($_POST['dcmCambio2']);
    $dtmFechaCambio = str_replace('/', '-', $_POST['dtmFechaCambio']);
    $CotizacionEquipo->FechaCambio(date('Y-m-d', strtotime($dtmFechaCambio)));
    $CotizacionEquipo->ActualizarCotizacionEquipo();
    break;
  case "M":
    $CotizacionEquipo = new CotizacionEquipo();
    $CotizacionEquipo->IdCotizacionEquipo($_POST['intIdCotizacionEquipo']);
    $CotizacionEquipo->MostrarCotizacionEquipo($_POST['funcion']);
    break;
  case "E":
    $CotizacionEquipo = new CotizacionEquipo();
    $CotizacionEquipo->IdCotizacionEquipo($_POST['intIdCotizacionEquipo']);
    $CotizacionEquipo->EliminarCotizacionEquipo();
    break;
  case "L":
    $CotizacionEquipo = new CotizacionEquipo();
    $CotizacionEquipo->ListarCotizacionEquipo($_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['TipoCambio']);
    break;
  case "P":
    $CotizacionEquipo = new CotizacionEquipo();
    $CotizacionEquipo->PaginarCotizacionEquipo($_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['TipoCambio']);
    break;
}
?>