<?php
session_start();
require_once 'clases_entrada/class_entrada.php';
require_once 'clases_entrada/class_detalle_entrada.php';
require_once 'clases_entrada/class_formulario_entrada.php';
if(empty($_SESSION['intIdEntrada'])){
  $_SESSION['intIdEntrada'] = 0;
}
if(empty($_SESSION['intIdOperacionEntrada'])){
  $_SESSION['intIdOperacionEntrada'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Entrada = new Entrada();
    $Entrada->IdOrdenCompra($_POST['intIdOrdenCompra']);
    $Entrada->IdUsuario($_SESSION['user_session']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Entrada->FechaCreacion($dtmFechaCreacion);
    $Entrada->InsertarEntrada();
    $DetalleEntrada = new DetalleEntrada();
    $DetalleEntrada->IdEntrada($_SESSION['intIdEntrada']);
    $DetalleEntrada->IdOperacionOrdenCompra($_POST['intIdOperacionOrdenCompra']);
    $dtmFechaEntrada = $dtmFechaCreacion;
    $DetalleEntrada->FechaEntrada($dtmFechaEntrada);
    $DetalleEntrada->Cantidad($_POST['intCantidad']);
    $DetalleEntrada->InsertarDetalleEntrada();
    break;
  case "A":
    $Entrada = new Entrada();
    $Entrada->IdEntrada($_POST['intIdEntrada']);
    $Entrada->IdOrdenCompra($_POST['IdOrdenCompra']);
    $Entrada->IdUsuario($_SESSION['user_session']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Entrada->FechaCreacion($dtmFechaCreacion);
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
    $Entrada->ListarEntrada($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $Entrada = new Entrada();
    $Entrada->PaginarEntrada($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "ID":
    $DetalleEntrada = new DetalleEntrada();
    $DetalleEntrada->IdEntrada($_POST['intIdEntrada']);
    $DetalleEntrada->IdOperacionOrdenCompra($_POST['intIdOperacionOrdenCompra']);
    $dtmFechaEntrada = date("Y-m-d H:i:s");
    $DetalleEntrada->FechaEntrada($dtmFechaEntrada);
    $DetalleEntrada->Cantidad($_POST['intCantidad']);
    $DetalleEntrada->InsertarDetalleEntrada();
  case "AD":
    $DetalleEntrada = new DetalleEntrada();
    $DetalleEntrada->IdOperacionEntrada($_POST['intIdOperacionEntrada']);
    $DetalleEntrada->IdEntrada($_POST['intIdEntrada']);
    $DetalleEntrada->IdOperacionOrdenCompra($_POST['intIdOperacionOrdenCompra']);
    $dtmFechaEntrada = date("Y-m-d H:i:s");
    $DetalleEntrada->FechaEntrada($dtmFechaEntrada);
    $DetalleEntrada->Cantidad($_POST['intCantidad']);
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
  case "LOC":
    $Entrada = new Entrada();
    $Entrada->ListarOrdenCompra($_POST['busqueda'],$_POST['x'],$_POST['y']);
    break;
  case "POC":
    $Entrada = new Entrada();
    $Entrada->PaginarOrdenCompra($_POST['busqueda'],$_POST['x'],$_POST['y']);
    break;
  case "SOC":
    $Entrada = new Entrada();
    $Entrada->IdOrdenCompra($_POST['intIdOrdenCompra']);
    $Entrada->SeleccionarOrdenCompra();
    break;
  case "F":
    $FormularioEntrada = new FormularioEntrada();
    $FormularioEntrada->ConsultarFormulario($_POST['funcion']);
    break;
}
?>