<?php
session_start();
require_once 'clases_producto/class_producto.php';
require_once 'clases_salida/class_salida.php';
require_once 'clases_salida/class_detalle_salida.php';
require_once 'clases_salida/class_formulario_salida.php';
if(empty($_SESSION['intIdSalida'])){
  $_SESSION['intIdSalida'] = 0;
}
if(empty($_SESSION['intIdOperacionSalida'])){
  $_SESSION['intIdOperacionSalida'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Salida = new Salida();
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Salida->FechaCreacion($dtmFechaCreacion);
    $Salida->Serie($_POST['nvchSerie']);
    $Salida->Numeracion($_POST['nvchNumeracion']);
    $Salida->RazonSocial($_POST['nvchRazonSocial']);
    $Salida->RUC($_POST['nvchRUC']);
    $Salida->Atencion($_POST['nvchAtencion']);
    $Salida->Destino($_POST['nvchDestino']);
    $Salida->Direccion($_POST['nvchDireccion']);
    $Salida->IdUsuario($_SESSION['intIdUsuarioSesion']);
    $Salida->Observacion($_POST['nvchObservacion']);
    $Salida->IdSucursal($_POST['intIdSucursal']);
    $Salida->InsertarSalida();
    $DetalleSalida = new DetalleSalida();
    $DetalleSalida->IdSalida($_SESSION['intIdSalida']);
    $DetalleSalida->FechaSalida($dtmFechaCreacion);
    $DetalleSalida->IdProducto($_POST['intIdProducto']);
    $DetalleSalida->Codigo($_POST['nvchCodigo']);
    $DetalleSalida->Descripcion($_POST['nvchDescripcion']);
    $DetalleSalida->Cantidad($_POST['intCantidad']);
    $DetalleSalida->InsertarDetalleSalida();

    $Producto = new Producto();
    $Producto->ES_StockUbigeo($_POST['intIdProducto'],$_POST['intIdSucursal'],$_POST['intCantidad'],0);
    $Producto->ES_StockTotal($_POST['intIdProducto']);
    break;
  case "A":
    $Salida = new Salida();
    $Salida->IdSalida($_POST['intIdSalida']);
    $Salida->IdTipoComprobante($_POST['intIdTipoComprobante']);
    $Salida->IdSucursal($_POST['intIdSucursal']);
    $Salida->Serie($_POST['nvchSerie']);
    $Salida->Numeracion($_POST['nvchNumeracion']);
    $Salida->IdUsuario($_SESSION['intIdUsuarioSesion']);
    $Salida->RUC($_POST['nvchRUC']);
    $Salida->RazonSocial($_POST['nvchRazonSocial']);
    $dtmFechaCreacion = date("Y-m-d H:i:s");
    $Salida->FechaCreacion($dtmFechaCreacion);
    $Salida->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $Salida->IdTipoPago($_POST['intIdTipoPago']);
    $Salida->Observacion($_POST['nvchObservacion']);
    $Salida->ActualizarSalida();
    break;
  case "M":
    $Salida = new Salida();
    $Salida->IdSalida($_POST['intIdSalida']);
    $Salida->MostrarSalida($_POST['funcion']);
    break;
  case "E":
    $Salida = new Salida();
    $Salida->IdSalida($_POST['intIdSalida']);
    $Salida->EliminarSalida();
    break;
  case "L":
    $Salida = new Salida();
    $Salida->ListarSalidas($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoComprobante']);
    break;
  case "P":
    $Salida = new Salida();
    $Salida->PaginarSalidas($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoComprobante']);
    break;
  case "ID":
    $DetalleSalida = new DetalleSalida();
    $DetalleSalida->IdSalida($_SESSION['intIdSalida']);
    $DetalleSalida->IdProducto($_POST['intIdProducto']);
    $DetalleSalida->FechaSalida($dtmFechaCreacion);
    $DetalleSalida->Codigo($_POST['nvchCodigo']);
    $DetalleSalida->Descripcion($_POST['nvchDescripcion']);
    $DetalleSalida->PrecioUnitario($_POST['dcmPrecioUnitario']);
    $DetalleSalida->Cantidad($_POST['intCantidad']);
    $DetalleSalida->Total($_POST['dcmTotal']);
    $DetalleSalida->InsertarDetalleSalida();
  case "AD":
    $DetalleSalida = new DetalleSalida();
    $DetalleSalida->IdOperacionSalida($_POST['intIdOperacionSalida']);
    $DetalleSalida->IdSalida($_SESSION['intIdSalida']);
    $DetalleSalida->IdProducto($_POST['intIdProducto']);
    $DetalleSalida->FechaSalida($dtmFechaCreacion);
    $DetalleSalida->Codigo($_POST['nvchCodigo']);
    $DetalleSalida->Descripcion($_POST['nvchDescripcion']);
    $DetalleSalida->PrecioUnitario($_POST['dcmPrecioUnitario']);
    $DetalleSalida->Cantidad($_POST['intCantidad']);
    $DetalleSalida->Total($_POST['dcmTotal']);
    $DetalleSalida->ActualizarDetalleSalida();
    break;
  case "MD":
    $DetalleSalida = new DetalleSalida();
    $DetalleSalida->IdSalida($_POST['intIdSalida']);
    $DetalleSalida->MostrarDetalleSalida($_POST['tipolistado']);
    break;
  case "SD":
    $DetalleSalida = new DetalleSalida();
    $DetalleSalida->IdOperacionSalida($_POST['intIdOperacionSalida']);
    $DetalleSalida->SeleccionarDetalleSalida();
    break;
  case "ED":
    $DetalleSalida = new DetalleSalida();
    $DetalleSalida->IdOperacionSalida($_POST['intIdOperacionSalida']);
    $DetalleSalida->EliminarDetalleSalida();
    break;
  case "MPT":
    $DetalleSalida = new DetalleSalida();
    $DetalleSalida->ListarProductoSalida($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda'],$_POST['intIdSucursal']);
    break;
  case "PPT":
    $DetalleSalida = new DetalleSalida();
    $DetalleSalida->PaginarProductosSalida($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['TipoBusqueda']);
    break;
  case "F":
    $FormularioSalida = new FormularioSalida();
    $FormularioSalida->ConsultarFormulario($_POST['funcion']);
    break;
}
?>