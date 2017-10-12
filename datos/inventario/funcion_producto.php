<?php
session_start();
require_once 'clases_producto/class_producto.php';
require_once 'clases_producto/class_codigo_producto.php';
require_once 'clases_producto/class_ubigeo_producto.php';
require_once 'clases_producto/class_formulario_producto.php';
if(empty($_SESSION['intIdProducto'])){
  $_SESSION['intIdProducto'] = 0;
}
if(empty($_SESSION['intIdCodigoProducto'])){
  $_SESSION['intIdCodigoProducto'] = 0;
}
if(empty($_SESSION['intIdUbigeoProducto'])){
  $_SESSION['intIdUbigeoProducto'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Producto = new Producto();
    $Producto->Descripcion($_POST['nvchDescripcion']);
    $Producto->UnidadMedida($_POST['nvchUnidadMedida']);
    $Producto->CantidadMinima($_POST['intCantidadMinima']);
    $nvchDireccionImg = pathinfo($_POST['nvchDireccionImg'],PATHINFO_BASENAME);
    $Producto->DireccionImg($nvchDireccionImg);
    $Producto->PrecioVenta1($_POST['dcmPrecioVenta1']);
    $Producto->PrecioVenta2($_POST['dcmPrecioVenta2']);
    $Producto->PrecioVenta3($_POST['dcmPrecioVenta3']);
    $Producto->DescuentoVenta2($_POST['dcmDescuentoVenta2']);
    $Producto->DescuentoVenta3($_POST['dcmDescuentoVenta3']);
    $Producto->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $dtmFechaIngreso = date("Y-m-d H:i:s");
    $Producto->FechaIngreso($dtmFechaIngreso);
    $Producto->Observacion($_POST['nvchObservacion']);
    $Producto->InsertarProducto();
    $CodigoProducto = new CodigoProducto();
    $CodigoProducto->IdProducto($_SESSION['intIdProducto']);
    $CodigoProducto->Codigo($_POST['nvchCodigo']);
    $CodigoProducto->IdTipoCodigoProducto($_POST['intIdTipoCodigoProducto']);
    $CodigoProducto->InsertarCodigoProducto();
    $UbigeoProducto = new UbigeoProducto();
    $UbigeoProducto->IdProducto($_SESSION['intIdProducto']);
    $UbigeoProducto->IdSucursal($_POST['intIdSucursal']);
    $UbigeoProducto->Ubicacion($_POST['nvchUbicacion']);
    $UbigeoProducto->CantidadUbigeo($_POST['intCantidadUbigeo']);
    $UbigeoProducto->InsertarUbigeoProducto();
    $Producto->AumentarStockTotal($_SESSION['intIdProducto']);
    break;
  case "ICP":
    $CodigoProducto = new CodigoProducto();
    $CodigoProducto->IdProducto($_POST['intIdProducto']);
    $CodigoProducto->Codigo($_POST['nvchCodigo']);
    $CodigoProducto->IdTipoCodigoProducto($_POST['intIdTipoCodigoProducto']);
    $CodigoProducto->InsertarCodigoProducto_II();
    break;
  case "IUP":
    $UbigeoProducto = new UbigeoProducto();
    $UbigeoProducto->IdProducto($_POST['intIdProducto']);
    $UbigeoProducto->IdSucursal($_POST['intIdSucursal']);
    $UbigeoProducto->Ubicacion($_POST['nvchUbicacion']);
    $UbigeoProducto->CantidadUbigeo($_POST['intCantidadUbigeo']);
    $UbigeoProducto->InsertarUbigeoProducto_II();
    $Producto = new Producto();
    $Producto->AumentarStockTotal($_POST['intIdProducto']);
    break;
  case "A":
    $Producto = new Producto();
    $Producto->IdProducto($_POST['intIdProducto']);
    $Producto->Descripcion($_POST['nvchDescripcion']);
    $Producto->UnidadMedida($_POST['nvchUnidadMedida']);
    $Producto->CantidadMinima($_POST['intCantidadMinima']);
    $nvchDireccionImg = pathinfo($_POST['nvchDireccionImg'],PATHINFO_BASENAME);
    $Producto->DireccionImg($nvchDireccionImg);
    $Producto->PrecioVenta1($_POST['dcmPrecioVenta1']);
    $Producto->PrecioVenta2($_POST['dcmPrecioVenta2']);
    $Producto->PrecioVenta3($_POST['dcmPrecioVenta3']);
    $Producto->DescuentoVenta2($_POST['dcmDescuentoVenta2']);
    $Producto->DescuentoVenta3($_POST['dcmDescuentoVenta3']);
    $Producto->IdTipoMoneda($_POST['intIdTipoMoneda']);
    $dtmFechaIngreso = date("Y-m-d H:i:s");
    $Producto->FechaIngreso($dtmFechaIngreso);
    $Producto->Observacion($_POST['nvchObservacion']);
    $Producto->ActualizarProducto();
    break;
  case "ACP":
    $CodigoProducto = new CodigoProducto();
    $CodigoProducto->IdCodigoProducto($_POST['intIdCodigoProducto']);
    $CodigoProducto->IdProducto($_POST['intIdProducto']);
    $CodigoProducto->Codigo($_POST['nvchCodigo']);
    $CodigoProducto->IdTipoCodigoProducto($_POST['intIdTipoCodigoProducto']);
    $CodigoProducto->ActualizarCodigoProducto();
    break;
  case "AUP":
    $UbigeoProducto = new UbigeoProducto();
    $UbigeoProducto->IdUbigeoProducto($_POST['intIdUbigeoProducto']);
    $UbigeoProducto->IdProducto($_POST['intIdProducto']);
    $UbigeoProducto->IdSucursal($_POST['intIdSucursal']);
    $UbigeoProducto->Ubicacion($_POST['nvchUbicacion']);
    $UbigeoProducto->CantidadUbigeo($_POST['intCantidadUbigeo']);
    $UbigeoProducto->ActualizarUbigeoProducto();
    $Producto = new Producto();
    $Producto->AumentarStockTotal($_POST['intIdProducto']);
    break;
  case "M":
    $Producto = new Producto();
    $Producto->IdProducto($_POST['intIdProducto']);
    $Producto->MostrarProducto($_POST['funcion']);
    break;
  case "MCP":
    $CodigoProducto = new CodigoProducto();
    $CodigoProducto->IdProducto($_POST['intIdProducto']);
    $CodigoProducto->MostrarCodigoProducto($_POST['tipolistado']);
    break;
  case "MUP":
    $UbigeoProducto = new UbigeoProducto();
    $UbigeoProducto->IdProducto($_POST['intIdProducto']);
    $UbigeoProducto->MostrarUbigeoProducto($_POST['tipolistado']);
    break;
  case "SCP":
    $CodigoProducto = new CodigoProducto();
    $CodigoProducto->IdCodigoProducto($_POST['intIdCodigoProducto']);
    $CodigoProducto->SeleccionarCodigoProducto();
    break;
  case "SUP":
    $UbigeoProducto = new UbigeoProducto();
    $UbigeoProducto->IdUbigeoProducto($_POST['intIdUbigeoProducto']);
    $UbigeoProducto->SeleccionarUbigeoProducto();
    break;
  case "E":
    $Producto = new Producto();
    $Producto->IdProducto($_POST['intIdProducto']);
    $Producto->EliminarProducto();
    break;
  case "ECP":
    $CodigoProducto = new CodigoProducto();
    $CodigoProducto->IdCodigoProducto($_POST['intIdCodigoProducto']);
    $CodigoProducto->EliminarCodigoProducto();
    break;
  case "EUP":
    $UbigeoProducto = new UbigeoProducto();
    $UbigeoProducto->IdUbigeoProducto($_POST['intIdUbigeoProducto']);
    $UbigeoProducto->EliminarUbigeoProducto();
    break;
  case "VDU":
    $UbigeoProducto = new UbigeoProducto();
    $UbigeoProducto->IdProducto($_POST['intIdProducto']);
    $UbigeoProducto->VerDetalleUbigeoProducto();
    break;
  case "L":
    $Producto = new Producto();
    $Producto->ListarProductos($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['TipoBusqueda']);
    break;
  case "P":
    $Producto = new Producto();
    $Producto->PaginarProductos($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['TipoBusqueda']);
    break;
  case "F":
    $FormularioProducto = new FormularioProducto();
    $FormularioProducto->ConsultarFormulario($_POST['funcion']);
    break;
  case "ES_P_SU":
    $Producto = new Producto();
    $Producto->ES_StockUbigeo($_POST['intIdProducto'],$_POST['intIdSucursal'],$_POST['intCantidad'],$_POST['TipoES']);
    break;
  case "ES_P_ST":
    $Producto = new Producto();
    $Producto->ES_StockTotal($_POST['intIdProducto'],$_POST['intCantidad'],$_POST['TipoES']);
    break;
}
?>