<?php
session_start();
require_once 'clases_kardex/class_kardex_general.php';
if(empty($_SESSION['intIdMovimiento'])){
  $_SESSION['intIdMovimiento'] = 0;
}
switch($_POST['funcion']){
  case "L":
    $KardexGeneral = new KardexGeneral();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $KardexGeneral->ListarKardexGeneral($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$dtmFechaInicial,$dtmFechaFinal,
    	$_POST['intIdTipoMoneda']);
    break;
  case "P":
    $KardexGeneral = new KardexGeneral();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $KardexGeneral->PaginarKardexGeneral($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$dtmFechaInicial,$dtmFechaFinal);
    break;
}
?>