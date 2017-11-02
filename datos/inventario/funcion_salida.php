<?php
session_start();
require_once 'clases_producto/class_producto.php';
require_once 'clases_salida/class_salida.php';
require_once 'clases_salida/class_detalle_salida.php';
require_once 'clases_salida/class_formulario_salida.php';
require_once '../numeraciones/class_numeraciones.php';
require_once '../reportes/clases_kardex/class_kardex_producto.php';
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
    $Salida->IdCliente($_POST['intIdCliente']);
    $Salida->Serie($_POST['nvchSerie']);
    $Salida->Numeracion($_POST['nvchNumeracion']);
    $Salida->RazonSocial($_POST['nvchRazonSocial']);
    $Salida->RUC($_POST['nvchRUC']);
    $Salida->Atencion($_POST['nvchAtencion']);
    $Salida->Destino($_POST['nvchDestino']);
    $Salida->Direccion($_POST['nvchDireccion']);
    $Salida->TipoPersona($_POST['intTipoPersona']);
    $Salida->IdUsuarioSolicitado($_POST['intIdUsuarioSolicitado']);
    $Salida->IdClienteSolicitado($_POST['intIdClienteSolicitado']);
    $Salida->IdUsuario($_SESSION['intIdUsuarioSesion']);
    $Salida->IdSucursal($_POST['intIdSucursal']);
    $Salida->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $Salida->Observacion($_POST['nvchObservacion']);
    $Salida->InsertarSalida();

    $DetalleSalida = new DetalleSalida();
    $DetalleSalida->IdSalida($_SESSION['intIdSalida']);
    $DetalleSalida->FechaSalida($dtmFechaCreacion);
    $DetalleSalida->IdProducto($_POST['intIdProducto']);
    $DetalleSalida->Codigo($_POST['nvchCodigo']);
    $DetalleSalida->Descripcion($_POST['nvchDescripcion']);
    $DetalleSalida->PrecioUnitario($_POST['dcmPrecioUnitario']);
    $DetalleSalida->Cantidad($_POST['intCantidad']);
    $DetalleSalida->Total($_POST['dcmTotal']);
    $DetalleSalida->InsertarDetalleSalida();

    $Producto = new Producto();
    $Producto->ES_StockUbigeo($_POST['intIdProducto'],$_POST['intIdSucursal'],$_POST['intCantidad'],0);
    $Producto->ES_StockTotal($_POST['intIdProducto']);

    $KardexProducto = new KardexProducto();
    $KardexProducto->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $KardexProducto->FechaMovimiento($dtmFechaCreacion);
    $KardexProducto->IdComprobante($_SESSION['intIdSalida']);
    $KardexProducto->IdTipoComprobante(10);
    $KardexProducto->TipoDetalle(1);
    $KardexProducto->Serie($_POST['nvchSerie']);
    $KardexProducto->Numeracion($_POST['nvchNumeracion']);
    $KardexProducto->IdProducto($_POST['intIdProducto']);
    $KardexProducto->CantidadSalida($_POST['intCantidad']);
    $KardexProducto->PrecioSalida($_POST['dcmPrecioUnitario']);
    $KardexProducto->TotalSalida($_POST['dcmTotal']);
    $KardexProducto->InsertarKardexProducto();

    $Numeraciones = new Numeraciones();
    $Numeraciones->ActualizarNumeracion(10,$_POST['intIdSucursal'],$_POST['nvchNumeracion']);
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
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Salida->ListarSalidas($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$dtmFechaInicial,$dtmFechaFinal,
        $_POST['intIdTipoMoneda']);
    break;
  case "TS":
    $Salida = new Salida();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Salida->TotalSalidas($_POST['busqueda'],$dtmFechaInicial,$dtmFechaFinal,$_POST['intIdTipoMoneda']);
    break;
  case "P":
    $Salida = new Salida();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Salida->PaginarSalidas($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$dtmFechaInicial,$dtmFechaFinal);
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
  case "NCPR":
    $Numeraciones = new Numeraciones();
    $Numeraciones->NumeracionAlgoritmica($_POST['intIdTipoComprobante'],$_POST['intIdSucursal']);
    break;
}
?>