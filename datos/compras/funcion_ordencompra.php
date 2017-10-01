<?php 
session_start();
require_once 'clases_ordencompra/class_ordencompra.php';
require_once 'clases_ordencompra/class_detalle_ordencompra.php';
require_once 'clases_ordencompra/class_formulario_ordencompra.php';
if(empty($_SESSION['intIdOrdenCompra'])){
  $_SESSION['intIdOrdenCompra'] = 0;
}
if(empty($_SESSION['intIdOperacionOrdenCompra'])){
  $_SESSION['intIdOperacionOrdenCompra'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $OrdenCompra = new OrdenCompra();
    $OrdenCompra->IdUsuario($_SESSION['intIdUsuarioSesion']);
    $OrdenCompra->RUC($_POST['nvchRUC']);
    $OrdenCompra->RazonSocial($_POST['nvchRazonSocial']);
    $OrdenCompra->Atencion($_POST['nvchAtencion']);
    $OrdenCompra->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $OrdenCompra->IdTipoPago($_POST['intIdTipoPago']);
    //$OrdenCompra->NombreDe($_POST['nvchNombreDe']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $OrdenCompra->FechaCreacion($dtmFechaCreacion);
    $OrdenCompra->Observacion($_POST['nvchObservacion']);
    $OrdenCompra->InsertarOrdenCompra();
    $DetalleOrdenCompra = new DetalleOrdenCompra();
    $DetalleOrdenCompra->IdOrdenCompra($_SESSION['intIdOrdenCompra']);
    $DetalleOrdenCompra->FechaSolicitud($dtmFechaCreacion);
    $DetalleOrdenCompra->Codigo($_POST['nvchCodigo']);
    $DetalleOrdenCompra->Descripcion($_POST['nvchDescripcion']);
    $DetalleOrdenCompra->Cantidad($_POST['intCantidad']);
    $DetalleOrdenCompra->Precio($_POST['dcmPrecio']);
    $DetalleOrdenCompra->Total($_POST['dcmTotal']);
    $DetalleOrdenCompra->InsertarDetalleOrdenCompra();
    break;
  case "IDOC":
    $DetalleOrdenCompra = new DetalleOrdenCompra();
    $DetalleOrdenCompra->IdOrdenCompra($_POST['intIdOrdenCompra']);
    $DetalleOrdenCompra->IdProducto($_POST['intIdProducto']);
    $DetalleOrdenCompra->FechaSolicitud($dtmFechaCreacion);
    $DetalleOrdenCompra->Codigo($_POST['nvchCodigo']);
    $DetalleOrdenCompra->Descripcion($_POST['nvchDescripcion']);
    $DetalleOrdenCompra->Cantidad($_POST['intCantidad']);
    $DetalleOrdenCompra->Precio($_POST['dcmPrecio']);
    $DetalleOrdenCompra->Total($_POST['dcmTotal']);
    $DetalleOrdenCompra->InsertarDetalleOrdenCompra_II();
    break;
  case "A":
    $OrdenCompra = new OrdenCompra();
    $OrdenCompra->IdOrdenCompra($_POST['intIdOrdenCompra']);
    $OrdenCompra->IdUsuario($_POST['intIdUsuario']);
    $OrdenCompra->FechaCreacion($_POST['dtmFechaCreacion']);
    $OrdenCompra->ActualizarOrdenCompra();
    break;
  case "ADOC":
    $DetalleOrdenCompra = new DetalleOrdenCompra();
    $DetalleOrdenCompra->IdOperacionOrdenCompra($_POST['intIdOperacionOrdenCompra']);
    $DetalleOrdenCompra->IdOrdenCompra($_POST['intIdOrdenCompra']);
    $DetalleOrdenCompra->IdProducto($_POST['intIdProducto']);
    $dtmFechaSolicitud = date("Y-m-d H:i:s");
    $DetalleOrdenCompra->FechaSolicitud($dtmFechaSolicitud);
    $DetalleOrdenCompra->Cantidad($_POST['intCantidad']);
    $DetalleOrdenCompra->Precio($_POST['dcmPrecio']);
    $DetalleOrdenCompra->ActualizarDetalleOrdenCompra();
    break;
  case "M":
    $OrdenCompra = new OrdenCompra();
    $OrdenCompra->IdOrdenCompra($_POST['intIdOrdenCompra']);
    $OrdenCompra->MostrarOrdenCompra($_POST['funcion']);
    break;
  case "MDOC":
    $DetalleOrdenCompra = new DetalleOrdenCompra();
    $DetalleOrdenCompra->IdOrdenCompra($_POST['intIdOrdenCompra']);
    $DetalleOrdenCompra->MostrarDetalleOrdenCompra($_POST['tipolistado']);
    break;
  case "SDOC":
    $DetalleOrdenCompra = new DetalleOrdenCompra();
    $DetalleOrdenCompra->IdOperacionOrdenCompra($_POST['intIdOperacionOrdenCompra']);
    $DetalleOrdenCompra->SeleccionarDetalleOrdenCompra();
    break;
  case "E":
    $OrdenCompra = new OrdenCompra();
    $OrdenCompra->IdOrdenCompra($_POST['intIdOrdenCompra']);
    $OrdenCompra->EliminarOrdenCompra();
    break;
  case "EDOC":
    $DetalleOrdenCompra = new DetalleOrdenCompra();
    $DetalleOrdenCompra->IdOperacionOrdenCompra($_POST['intIdOperacionOrdenCompra']);
    $DetalleOrdenCompra->EliminarDetalleOrdenCompra();
    break;
  case "L":
    $OrdenCompra = new OrdenCompra();
    $OrdenCompra->ListarOrdenesCompra($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $OrdenCompra = new OrdenCompra();
    $OrdenCompra->PaginarOrdenesCompra($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "SPD":
    $OrdenCompra = new OrdenCompra();
    $OrdenCompra->IdProveedor($_POST['intIdProveedor']);
    $OrdenCompra->SeleccionarProveedorOrdenCompra();
    break;
  case "MPD":
    $OrdenCompra = new OrdenCompra();
    $OrdenCompra->ListarProveedorOrdenCompra($_POST['busqueda'],$_POST['x'],$_POST['y']);
    break;
  case "PPD":
    $OrdenCompra = new OrdenCompra();
    $OrdenCompra->PaginarProveedoresOrdenCompra($_POST['busqueda'],$_POST['x'],$_POST['y']);
    break;
  case "MPT":
    $DetalleOrdenCompra = new DetalleOrdenCompra();
    $DetalleOrdenCompra->ListarProductoOrdenCompra($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipofuncion'],$_POST['TipoBusqueda']);
    break;
  case "PPT":
    $DetalleOrdenCompra = new DetalleOrdenCompra();
    $DetalleOrdenCompra->PaginarProductosOrdenCompra($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda']);
    break;
  case "F":
    $FormularioOrdenCompra = new FormularioOrdenCompra();
    $FormularioOrdenCompra->ConsultarFormulario($_POST['funcion']);
    break;
}
?>