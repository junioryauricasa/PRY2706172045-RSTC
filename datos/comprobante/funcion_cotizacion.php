<?php 
session_start();
require_once '../inventario/clases_producto/class_producto.php';
require_once '../ventas/clases_cliente/class_cliente.php';
require_once '../numeraciones/class_numeraciones.php';
require_once 'clases_cotizacion/class_cotizacion.php';
require_once 'clases_cotizacion/class_detalle_cotizacion.php';
if(empty($_SESSION['intIdCotizacion'])){
  $_SESSION['intIdCotizacion'] = 0;
}
if(empty($_SESSION['intIdDetalleCotizacion'])){
  $_SESSION['intIdDetalleCotizacion'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Cotizacion = new Cotizacion();
    $dtmFechaCreacion = str_replace('/', '-', $_POST['nvchFecha']);
    $dtmFechaCreacion = date('Y-m-d H:i:s', strtotime($dtmFechaCreacion));
    $Cotizacion->FechaCreacion($dtmFechaCreacion);
    $Cotizacion->IdUsuario($_SESSION['intIdUsuarioSesion']);
    $Cotizacion->IdCliente($_POST['intIdCliente']);
    $Cotizacion->DNIRUC($_POST['nvchDNIRUC']);
    $Cotizacion->ClienteProveedor($_POST['nvchClienteProveedor']);
    $Cotizacion->Direccion($_POST['nvchDireccion']);
    $Cotizacion->Atencion($_POST['nvchAtencion']);
    $Cotizacion->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $Cotizacion->IdTipoPago($_POST['intIdTipoPago']);
    $Cotizacion->DiasValidez($_POST['intDiasValidez']);
    $Cotizacion->IdTipoVenta($_POST['intIdTipoVenta']);
    $Cotizacion->Tipo($_POST['nvchTipo']);
    $Cotizacion->Modelo($_POST['nvchModelo']);
    $Cotizacion->Marca($_POST['nvchMarca']);
    $Cotizacion->Horometro($_POST['nvchHorometro']);
    $Cotizacion->Observacion($_POST['nvchObservacion']);
    $Cotizacion->InsertarCotizacion();
    $DetalleCotizacion = new DetalleCotizacion();
    if($_POST['intIdTipoVenta'] == 1) {
        $DetalleCotizacion->IdCotizacion($_SESSION['intIdCotizacion']);
        $DetalleCotizacion->IdTipoVenta($_POST['intIdTipoVenta']);
        $DetalleCotizacion->FechaRealizada($dtmFechaCreacion);
        $DetalleCotizacion->IdProducto($_POST['intIdProducto']);
        $DetalleCotizacion->Codigo($_POST['nvchCodigo']);
        $DetalleCotizacion->Descripcion($_POST['nvchDescripcion']);
        $DetalleCotizacion->Precio($_POST['dcmPrecio']);
        $DetalleCotizacion->Descuento($_POST['dcmDescuento']);
        $DetalleCotizacion->PrecioUnitario($_POST['dcmPrecioUnitario']);
        $DetalleCotizacion->Cantidad($_POST['intCantidad']);
        $DetalleCotizacion->Total($_POST['dcmTotal']);
    } else if($_POST['intIdTipoVenta'] == 2) {
        $DetalleCotizacion->IdCotizacion($_SESSION['intIdCotizacion']);
        $DetalleCotizacion->IdTipoVenta($_POST['intIdTipoVenta']);
        $DetalleCotizacion->FechaRealizada($dtmFechaCreacion);
        $DetalleCotizacion->Descripcion($_POST['nvchDescripcionS']);
        $DetalleCotizacion->PrecioUnitario($_POST['dcmPrecioUnitarioS']);
        $DetalleCotizacion->Cantidad($_POST['intCantidadS']);
        $DetalleCotizacion->Total($_POST['dcmTotalS']);
    }
    $DetalleCotizacion->InsertarDetalleCotizacion($_POST['funcion']);
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
    $Cotizacion->Serie($_POST['nvchSerie']);
    $Cotizacion->Numeracion($_POST['nvchNumeracion']);
    $dtmFechaCreacion = str_replace('/', '-', $_POST['nvchFecha']);
    $dtmFechaCreacion = date('Y-m-d H:i:s', strtotime($dtmFechaCreacion));
    $Cotizacion->FechaCreacion($dtmFechaCreacion);
    $Cotizacion->IdUsuario($_SESSION['intIdUsuarioSesion']);
    $Cotizacion->IdCliente($_POST['intIdCliente']);
    $Cotizacion->DNIRUC($_POST['nvchDNIRUC']);
    $Cotizacion->ClienteProveedor($_POST['nvchClienteProveedor']);
    $Cotizacion->Direccion($_POST['nvchDireccion']);
    $Cotizacion->Atencion($_POST['nvchAtencion']);
    $Cotizacion->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $Cotizacion->IdTipoPago($_POST['intIdTipoPago']);
    $Cotizacion->DiasValidez($_POST['intDiasValidez']);
    $Cotizacion->IdTipoVenta($_POST['intIdTipoVenta']);
    $Cotizacion->Tipo($_POST['nvchTipo']);
    $Cotizacion->Modelo($_POST['nvchModelo']);
    $Cotizacion->Marca($_POST['nvchMarca']);
    $Cotizacion->Horometro($_POST['nvchHorometro']);
    $Cotizacion->Observacion($_POST['nvchObservacion']);
    $Cotizacion->ActualizarCotizacion();
    $DetalleCotizacion = new DetalleCotizacion();
    if($_POST['intIdTipoVenta'] == 1) {
        $DetalleCotizacion->IdCotizacion($_POST['intIdCotizacion']);
        $DetalleCotizacion->IdTipoVenta($_POST['intIdTipoVenta']);
        $DetalleCotizacion->FechaRealizada($dtmFechaCreacion);
        $DetalleCotizacion->IdProducto($_POST['intIdProducto']);
        $DetalleCotizacion->Codigo($_POST['nvchCodigo']);
        $DetalleCotizacion->Descripcion($_POST['nvchDescripcion']);
        $DetalleCotizacion->Precio($_POST['dcmPrecio']);
        $DetalleCotizacion->Descuento($_POST['dcmDescuento']);
        $DetalleCotizacion->PrecioUnitario($_POST['dcmPrecioUnitario']);
        $DetalleCotizacion->Cantidad($_POST['intCantidad']);
        $DetalleCotizacion->Total($_POST['dcmTotal']);
    } else if($_POST['intIdTipoVenta'] == 2) {
        $DetalleCotizacion->IdCotizacion($_POST['intIdCotizacion']);
        $DetalleCotizacion->IdTipoVenta($_POST['intIdTipoVenta']);
        $DetalleCotizacion->FechaRealizada($dtmFechaCreacion);
        $DetalleCotizacion->Descripcion($_POST['nvchDescripcionS']);
        $DetalleCotizacion->PrecioUnitario($_POST['dcmPrecioUnitarioS']);
        $DetalleCotizacion->Cantidad($_POST['intCantidadS']);
        $DetalleCotizacion->Total($_POST['dcmTotalS']);
    }
    $DetalleCotizacion->InsertarDetalleCotizacion($_POST['funcion']);
    break;
  case "ADCT":
    $DetalleCotizacion = new DetalleCotizacion();
    $DetalleCotizacion->IdOperacionCotizacion($_POST['intIdOperacionCotizacion']);
    $dtmFechaRealizada = date("Y-m-d H:i:s");
    $DetalleCotizacion->IdCotizacion($_SESSION['intIdCotizacion']);
    $DetalleCotizacion->IdProducto($_POST['intIdProducto']);
    $DetalleCotizacion->FechaRealizada($dtmFechaCreacion);
    $DetalleCotizacion->Cantidad($_POST['intCantidad']);
    $DetalleCotizacion->CantidadDisponible($_POST['intCantidadDisponible']);
    $DetalleCotizacion->Precio($_POST['dcmPrecio']);
    $DetalleCotizacion->Descuento($_POST['dcmDescuento']);
    $DetalleCotizacion->PrecioUnitario($_POST['dcmPrecioUnitario']);
    $DetalleCotizacion->Total($_POST['dcmTotal']);
    $DetalleCotizacion->InsertarDetalleCotizacion();
    break;
  case "M":
    $Cotizacion = new Cotizacion();
    $Cotizacion->IdCotizacion($_POST['intIdCotizacion']);
    $Cotizacion->MostrarCotizacion($_POST['funcion']);
    break;
  case "MDCT":
    $DetalleCotizacion = new DetalleCotizacion();
    $DetalleCotizacion->IdCotizacion($_POST['intIdCotizacion']);
    $DetalleCotizacion->MostrarDetalleCotizacion($_POST['intIdTipoVenta']);
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
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Cotizacion->ListarCotizaciones($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],
            $dtmFechaInicial,$dtmFechaFinal,$_POST['intIdTipoMoneda']);
    break;
  case "TCT":
    $Cotizacion = new Cotizacion();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Cotizacion->TotalCotizaciones($_POST['busqueda'],$dtmFechaInicial,$dtmFechaFinal,$_POST['intIdTipoMoneda']);
    break;
  case "P":
    $Cotizacion = new Cotizacion();
    $dtmFechaInicial = str_replace('/', '-', $_POST['dtmFechaInicial']);
    $dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
    $dtmFechaFinal = str_replace('/', '-', $_POST['dtmFechaFinal']);
    $dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
    $Cotizacion->PaginarCotizaciones($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],
            $dtmFechaInicial,$dtmFechaFinal);
    break;
  case "SCL":
    $Cliente = new Cliente();
    $Cliente->IdCliente($_POST['intIdCliente']);
    $Cliente->SeleccionarClienteComprobante();
    break;
  case "MCL":
    $Cliente = new Cliente();
    $Cliente->ListarClienteComprobante($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['intIdTipoPersona'],"T","T","T");
    break;
  case "PCL":
    $Cliente = new Cliente();
    $Cliente->PaginarClientes($_POST['busqueda'],$_POST['x'],$_POST['y'],'V',$_POST['intIdTipoPersona'],"T","T","T");
    break;
  case "MPT":
    $DetalleCotizacion = new DetalleCotizacion();
    $DetalleCotizacion->ListarProductoCotizacion($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipofuncion'],$_POST['TipoBusqueda'],
        $_POST['intIdTipoMoneda']);
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