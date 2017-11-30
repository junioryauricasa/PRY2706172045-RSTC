<?php
session_start();
require_once 'clases_equipo/class_cotizacion_equipo.php';
if(empty($_SESSION['intIdCotizacionEquipo'])){
  $_SESSION['intIdCotizacionEquipo'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $CotizacionEquipo = new CotizacionEquipo();
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $CotizacionEquipo->FechaCreacion($dtmFechaCreacion);
    $CotizacionEquipo->IdTipoVenta($_POST['intIdTipoVenta']);
    $CotizacionEquipo->IdPlantillaCotizacion($_POST['intIdPlantillaCotizacion']);
    $CotizacionEquipo->IdUsuario($_POST['intIdUsuario']);
    $CotizacionEquipo->IdCliente($_POST['intIdCliente']);
    $CotizacionEquipo->ClienteProveedor($_POST['nvchClienteProveedor']);
    $CotizacionEquipo->DNIRUC($_POST['nvchDNIRUC']);
    $CotizacionEquipo->Direccion($_POST['nvchDireccion']);
    $CotizacionEquipo->Atencion($_POST['nvchAtencion']);
    $CotizacionEquipo->Garantia($_POST['nvchGarantia']);
    $CotizacionEquipo->FormaPago($_POST['nvchFormaPago']);
    $CotizacionEquipo->LugarEntrega($_POST['nvchLugarEntrega']);
    $CotizacionEquipo->TiempoEntrega($_POST['nvchTiempoEntrega']);
    $CotizacionEquipo->DiasValidez($_POST['nvchDiasValidez']);
    $CotizacionEquipo->PrecioVenta($_POST['dcmPrecioVenta']);
    $CotizacionEquipo->Observacion($_POST['nvchObservacion']);
    $CotizacionEquipo->InsertarCotizacionEquipo();
    break;
  case "A":
    $CotizacionEquipo = new CotizacionEquipo();
    $CotizacionEquipo->IdCotizacionEquipo($_POST['intIdCotizacionEquipo']);
    $CotizacionEquipo->FechaCreacion($_POST['dtmFechaCreacion']);
    $CotizacionEquipo->IdTipoVenta($_POST['intIdTipoVenta']);
    $CotizacionEquipo->IdPlantillaCotizacion($_POST['intIdPlantillaCotizacion']);
    $CotizacionEquipo->IdUsuario($_POST['intIdUsuario']);
    $CotizacionEquipo->IdCliente($_POST['intIdCliente']);
    $CotizacionEquipo->ClienteProveedor($_POST['nvchClienteProveedor']);
    $CotizacionEquipo->DNIRUC($_POST['nvchDNIRUC']);
    $CotizacionEquipo->Direccion($_POST['nvchDireccion']);
    $CotizacionEquipo->Atencion($_POST['nvchAtencion']);
    $CotizacionEquipo->Garantia($_POST['nvchGarantia']);
    $CotizacionEquipo->FormaPago($_POST['nvchFormaPago']);
    $CotizacionEquipo->LugarEntrega($_POST['nvchLugarEntrega']);
    $CotizacionEquipo->TiempoEntrega($_POST['nvchTiempoEntrega']);
    $CotizacionEquipo->DiasValidez($_POST['nvchDiasValidez']);
    $CotizacionEquipo->PrecioVenta($_POST['dcmPrecioVenta']);
    $CotizacionEquipo->Observacion($_POST['nvchObservacion']);
    $CotizacionEquipo->ActualizarCotizacionEquipo();
    break;
  case "M":
    $CotizacionEquipo = new CotizacionEquipo();
    $CotizacionEquipo->IdCotizacionEquipo($_POST['intIdCotizacionEquipo']);
    $CotizacionEquipo->MostrarCotizacionEquipo();
    break;
  case "E":
    $CotizacionEquipo = new CotizacionEquipo();
    $CotizacionEquipo->IdCotizacionEquipo($_POST['intIdCotizacionEquipo']);
    $CotizacionEquipo->EliminarCotizacionEquipo();
    break;
  case "L":
    $CotizacionEquipo = new CotizacionEquipo();
    $CotizacionEquipo->ListarCotizacionEquipo($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'];
    break;
  case "LTE":
    $CotizacionEquipo = new CotizacionEquipo();
    $CotizacionEquipo->IdTipoVenta($_POST['intIdTipoVenta']);
    $CotizacionEquipo->ListarTipoEquipo();
    break;
  case "P":
    $CotizacionEquipo = new CotizacionEquipo();
    $CotizacionEquipo->PaginarCotizacionEquipo($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
}
?>