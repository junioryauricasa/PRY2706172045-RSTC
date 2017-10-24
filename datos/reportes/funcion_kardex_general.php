<?php
session_start();
require_once 'clases_kardex/class_kardex_general.php';
if(empty($_SESSION['intIdMovimiento'])){
  $_SESSION['intIdMovimiento'] = 0;
}
switch($_POST['funcion']){
  case "L":
    $KardexGeneral = new KardexGeneral();
    $KardexGeneral->ListarKardexGeneral($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $KardexGeneral = new KardexGeneral();
    $KardexGeneral->PaginarKardexGeneral($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
}
?>