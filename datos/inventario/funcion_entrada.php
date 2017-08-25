<?php
session_start();
require_once 'clases_entrada/class_guia_interna_entrada.php';
require_once 'clases_entrada/class_detalle_guia_interna_entrada.php';
require_once 'clases_entrada/class_formulario_entrada.php';
if(empty($_SESSION['intIdGuiaInternaEntrada'])){
  $_SESSION['intIdGuiaInternaEntrada'] = 0;
}
if(empty($_SESSION['intIdOperacionGuiaInternaEntrada'])){
  $_SESSION['intIdOperacionGuiaInternaEntrada'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $GuiaInternaEntrada = new GuiaInternaEntrada();
    $GuiaInternaEntrada->IdOrdenCompra($_POST['intIdOrdenCompra']);
    $GuiaInternaEntrada->IdUsuario($_SESSION['user_session']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $GuiaInternaEntrada->FechaCreacion($dtmFechaCreacion);
    $GuiaInternaEntrada->InsertarGuiaInternaEntrada();
    $DetalleGuiaInternaEntrada = new DetalleGuiaInternaEntrada();
    $DetalleGuiaInternaEntrada->IdGuiaInternaEntrada($_SESSION['intIdGuiaInternaEntrada']);
    $DetalleGuiaInternaEntrada->IdOperacionOrdenCompra($_POST['intIdOperacionOrdenCompra']);
    $dtmFechaEntrada = $dtmFechaCreacion;
    $DetalleGuiaInternaEntrada->FechaEntrada($dtmFechaEntrada);
    $DetalleGuiaInternaEntrada->Cantidad($_POST['intCantidad']);
    $DetalleGuiaInternaEntrada->InsertarDetalleGuiaInternaEntrada();
    break;
  case "A":
    $GuiaInternaEntrada = new GuiaInternaEntrada();
    $GuiaInternaEntrada->IdGuiaInternaEntrada($_POST['intIdGuiaInternaEntrada']);
    $GuiaInternaEntrada->IdOrdenCompra($_POST['IdOrdenCompra']);
    $GuiaInternaEntrada->IdUsuario($_SESSION['user_session']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $GuiaInternaEntrada->FechaCreacion($dtmFechaCreacion);
    $GuiaInternaEntrada->ActualizarGuiaInternaEntrada();
    break;
  case "M":
    $GuiaInternaEntrada = new GuiaInternaEntrada();
    $GuiaInternaEntrada->IdGuiaInternaEntrada($_POST['intIdGuiaInternaEntrada']);
    $GuiaInternaEntrada->MostrarGuiaInternaEntrada($_POST['funcion']);
    break;
  case "E":
    $GuiaInternaEntrada = new GuiaInternaEntrada();
    $GuiaInternaEntrada->IdGuiaInternaEntrada($_POST['intIdGuiaInternaEntrada']);
    $GuiaInternaEntrada->EliminarGuiaInternaEntrada();
    break;
  case "L":
    $GuiaInternaEntrada = new GuiaInternaEntrada();
    $GuiaInternaEntrada->ListarGuiaInternaEntrada($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $GuiaInternaEntrada = new GuiaInternaEntrada();
    $GuiaInternaEntrada->PaginarGuiaInternaEntrada($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "ID":
    $DetalleGuiaInternaEntrada = new DetalleGuiaInternaEntrada();
    $DetalleGuiaInternaEntrada->IdGuiaInternaEntrada($_POST['intIdGuiaInternaEntrada']);
    $DetalleGuiaInternaEntrada->IdOperacionOrdenCompra($_POST['intIdOperacionOrdenCompra']);
    $dtmFechaEntrada = date("Y-m-d H:i:s");
    $DetalleGuiaInternaEntrada->FechaEntrada($dtmFechaEntrada);
    $DetalleGuiaInternaEntrada->Cantidad($_POST['intCantidad']);
    $DetalleGuiaInternaEntrada->InsertarDetalleGuiaInternaEntrada();
  case "AD":
    $DetalleGuiaInternaEntrada = new DetalleGuiaInternaEntrada();
    $DetalleGuiaInternaEntrada->IdOperacionGuiaInternaEntrada($_POST['intIdOperacionGuiaInternaEntrada']);
    $DetalleGuiaInternaEntrada->IdGuiaInternaEntrada($_POST['intIdGuiaInternaEntrada']);
    $DetalleGuiaInternaEntrada->IdOperacionOrdenCompra($_POST['intIdOperacionOrdenCompra']);
    $dtmFechaEntrada = date("Y-m-d H:i:s");
    $DetalleGuiaInternaEntrada->FechaEntrada($dtmFechaEntrada);
    $DetalleGuiaInternaEntrada->Cantidad($_POST['intCantidad']);
    $DetalleGuiaInternaEntrada->ActualizarDetalleGuiaInternaEntrada();
    break;
  case "MD":
    $DetalleGuiaInternaEntrada = new DetalleGuiaInternaEntrada();
    $DetalleGuiaInternaEntrada->IdGuiaInternaEntrada($_POST['intIdGuiaInternaEntrada']);
    $DetalleGuiaInternaEntrada->MostrarDetalleGuiaInternaEntrada($_POST['tipolistado']);
    break;
  case "SD":
    $DetalleGuiaInternaEntrada = new DetalleGuiaInternaEntrada();
    $DetalleGuiaInternaEntrada->IdOperacionGuiaInternaEntrada($_POST['intIdOperacionGuiaInternaEntrada']);
    $DetalleGuiaInternaEntrada->SeleccionarDetalleGuiaInternaEntrada();
    break;
  case "ED":
    $DetalleGuiaInternaEntrada = new DetalleGuiaInternaEntrada();
    $DetalleGuiaInternaEntrada->IdOperacionGuiaInternaEntrada($_POST['intIdOperacionGuiaInternaEntrada']);
    $DetalleGuiaInternaEntrada->EliminarDetalleGuiaInternaEntrada();
    break;
  case "LOC":
    $GuiaInternaEntrada = new GuiaInternaEntrada();
    $GuiaInternaEntrada->ListarOrdenCompra($_POST['busqueda'],$_POST['x'],$_POST['y']);
    break;
  case "POC":
    $GuiaInternaEntrada = new GuiaInternaEntrada();
    $GuiaInternaEntrada->PaginarOrdenCompra($_POST['busqueda'],$_POST['x'],$_POST['y']);
    break;
  case "SOC":
    $GuiaInternaEntrada = new GuiaInternaEntrada();
    $GuiaInternaEntrada->IdOrdenCompra($_POST['intIdOrdenCompra']);
    $GuiaInternaEntrada->SeleccionarOrdenCompra();
    break;
  case "F":
    $FormularioGuiaInternaEntrada = new FormularioGuiaInternaEntrada();
    $FormularioGuiaInternaEntrada->ConsultarFormulario($_POST['funcion']);
    break;
}
?>