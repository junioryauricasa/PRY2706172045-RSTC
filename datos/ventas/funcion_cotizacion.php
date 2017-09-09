<?php 
session_start();
require_once 'clases_cotizacion/class_cotizacion.php';
require_once 'clases_cotizacion/class_detalle_cotizacion.php';
require_once 'clases_cotizacion/class_formulario_cotizacion.php';
if(empty($_SESSION['intIdCotizacion'])){
  $_SESSION['intIdCotizacion'] = 0;
}
if(empty($_SESSION['intIdOperacionCotizacion'])){
  $_SESSION['intIdOperacionCotizacion'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Cotizacion = new Cotizacion();
    //$Cotizacion->Numeracion($_POST['nvchNumeracion']);
    $Cotizacion->IdUsuario($_SESSION['user_session']);
    $Cotizacion->IdCliente($_POST['intIdCliente']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Cotizacion->FechaCreacion($dtmFechaCreacion);
    $Cotizacion->InsertarCotizacion();
    $DetalleCotizacion = new DetalleCotizacion();
    $DetalleCotizacion->IdCotizacion($_SESSION['intIdCotizacion']);
    $DetalleCotizacion->IdProducto($_POST['intIdProducto']);
    $DetalleCotizacion->FechaRealizada($dtmFechaCreacion);
    $DetalleCotizacion->Cantidad($_POST['intCantidad']);
    $DetalleCotizacion->Precio($_POST['dcmPrecio']);
    $DetalleCotizacion->InsertarDetalleCotizacion();
    break;
  case "IDCT":
    $DetalleCotizacion = new DetalleCotizacion();
    $DetalleCotizacion->IdCotizacion($_POST['intIdCotizacion']);
    $DetalleCotizacion->IdProducto($_POST['intIdProducto']);
    $dtmFechaRealizada = date("Y-m-d H:i:s");
    $DetalleCotizacion->FechaRealizada($dtmFechaRealizada);
    $DetalleCotizacion->Cantidad($_POST['intCantidad']);
    $DetalleCotizacion->Precio($_POST['dcmPrecio']);
    $DetalleCotizacion->InsertarDetalleCotizacion_II();
    break;
  case "A":
    $Cotizacion = new Cotizacion();
    $Cotizacion->IdCotizacion($_POST['intIdCotizacion']);
    $Cotizacion->Numeracion($_POST['nvchNumeracion']);
    $Cotizacion->IdUsuario($_POST['intIdUsuario']);
    $Cotizacion->IdCliente($_POST['intIdCliente']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Cotizacion->FechaCreacion($dtmFechaCreacion);
    $Cotizacion->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $Cotizacion->ActualizarCotizacion();
    break;
  case "ADCT":
    $DetalleCotizacion = new DetalleCotizacion();
    $DetalleCotizacion->IdOperacionCotizacion($_POST['intIdOperacionCotizacion']);
    $DetalleCotizacion->IdCotizacion($_POST['intIdCotizacion']);
    $DetalleCotizacion->IdProducto($_POST['intIdProducto']);
    $dtmFechaRealizada = date("Y-m-d H:i:s");
    $DetalleCotizacion->FechaRealizada($dtmFechaRealizada);
    $DetalleCotizacion->Cantidad($_POST['intCantidad']);
    $DetalleCotizacion->Precio($_POST['dcmPrecio']);
    $DetalleCotizacion->ActualizarDetalleCotizacion();
    break;
  case "M":
    $Cotizacion = new Cotizacion();
    $Cotizacion->IdCotizacion($_POST['intIdCotizacion']);
    $Cotizacion->MostrarCotizacion($_POST['funcion']);
    break;
  case "MDCT":
    $DetalleCotizacion = new DetalleCotizacion();
    $DetalleCotizacion->IdCotizacion($_POST['intIdCotizacion']);
    $DetalleCotizacion->MostrarDetalleCotizacion($_POST['tipolistado']);
    break;
  case "SDCT":
    $DetalleCotizacion = new DetalleCotizacion();
    $DetalleCotizacion->IdOperacionCotizacion($_POST['intIdOperacionCotizacion']);
    $DetalleCotizacion->SeleccionarDetalleCotizacion();
    break;
  case "E":
    $Cotizacion = new Cotizacion();
    $Cotizacion->IdCotizacion($_POST['intIdCotizacion']);
    $Cotizacion->EliminarCotizacion();
    break;
  case "EDCT":
    $DetalleCotizacion = new DetalleCotizacion();
    $DetalleCotizacion->IdOperacionCotizacion($_POST['intIdOperacionCotizacion']);
    $DetalleCotizacion->EliminarDetalleCotizacion();
    break;
  case "L":
    $Cotizacion = new Cotizacion();
    $Cotizacion->ListarCotizaciones($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $Cotizacion = new Cotizacion();
    $Cotizacion->PaginarCotizaciones($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "SCL":
    $Cotizacion = new Cotizacion();
    $Cotizacion->IdCliente($_POST['intIdCliente']);
    $Cotizacion->SeleccionarClienteCotizacion();
    break;
  case "MCL":
    $Cotizacion = new Cotizacion();
    $Cotizacion->ListarClienteCotizacion($_POST['busqueda'],$_POST['x'],$_POST['y']);
    break;
  case "PCL":
    $Cotizacion = new Cotizacion();
    $Cotizacion->PaginarClientesCotizacion($_POST['busqueda'],$_POST['x'],$_POST['y']);
    break;
  case "MPT":
    $DetalleCotizacion = new DetalleCotizacion();
    $DetalleCotizacion->ListarProductoCotizacion($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipofuncion'],$_POST['TipoBusqueda']);
    break;
  case "PPT":
    $DetalleCotizacion = new DetalleCotizacion();
    $DetalleCotizacion->PaginarProductosCotizacion($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda']);
    break;
  case "PPV":
    $DetalleCotizacion = new DetalleCotizacion();
    $DetalleCotizacion->PaginarProductosCotizacion($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda']);
    break;
  case "F":
    $FormularioCotizacion = new FormularioCotizacion();
    $FormularioCotizacion->ConsultarFormulario($_POST['funcion']);
    break;
}
?>