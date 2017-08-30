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
    $Producto->Nombre($_POST['nvchNombre']);
    $Producto->Descripcion($_POST['nvchDescripcion']);
    $Producto->UnidadMedida($_POST['nvchUnidadMedida']);
    $Producto->Cantidad($_POST['intCantidad']);
    $nvchDireccionImg = pathinfo($_POST['nvchDireccionImg'],PATHINFO_BASENAME);
    $Producto->DireccionImg($nvchDireccionImg);
    $Producto->PrecioVenta1($_POST['dcmPrecioVenta1']);
    $Producto->PrecioVenta2($_POST['dcmPrecioVenta2']);
    $Producto->PrecioVenta3($_POST['dcmPrecioVenta3']);
    $dtmFechaIngreso = date("Y-m-d H:i:s");
    $Producto->FechaIngreso($dtmFechaIngreso);
    $Producto->InsertarProducto();
    $CodigoProducto = new CodigoProducto();
    $CodigoProducto->IdProducto($_SESSION['intIdProducto']);
    $CodigoProducto->Codigo($_POST['nvchCodigo']);
    $CodigoProducto->FechaInicio($dtmFechaIngreso);
    $CodigoProducto->FechaFinal('0000-00-00 00:00:00');
    $CodigoProducto->IdTipoCodigoProducto($_POST['intIdTipoCodigoProducto']);
    $CodigoProducto->InsertarCodigoProducto();
    $UbigeoProducto = new UbigeoProducto();
    $UbigeoProducto->IdProducto($_SESSION['intIdProducto']);
    $UbigeoProducto->Sucursal($_POST['nvchSucursal']);
    $UbigeoProducto->Ubicacion($_POST['nvchUbicacion']);
    $UbigeoProducto->CantidadUbigeo($_POST['intCantidadUbigeo']);
    $UbigeoProducto->InsertarUbigeoProducto();
    break;
  case "ICP":
    $CodigoProducto = new CodigoProducto();
    $CodigoProducto->IdProducto($_POST['intIdProducto']);
    $CodigoProducto->Codigo($_POST['nvchCodigo']);
    $dtmFechaInicio = date("Y-m-d H:i:s");
    $CodigoProducto->FechaInicio($dtmFechaInicio);
    $CodigoProducto->FechaFinal('0000-00-00 00:00:00');
    $CodigoProducto->IdTipoCodigoProducto($_POST['intIdTipoCodigoProducto']);
    $CodigoProducto->InsertarCodigoProducto_II();
    break;
  case "IUP":
    $UbigeoProducto = new UbigeoProducto();
    $UbigeoProducto->IdProducto($_POST['intIdProducto']);
    $UbigeoProducto->Sucursal($_POST['nvchSucursal']);
    $UbigeoProducto->Ubicacion($_POST['nvchUbicacion']);
    $UbigeoProducto->CantidadUbigeo($_POST['intCantidadUbigeo']);
    $UbigeoProducto->InsertarUbigeoProducto_II();
    break;
  case "A":
    $Producto = new Producto();
    $Producto->IdProducto($_POST['intIdProducto']);
    $Producto->Nombre($_POST['nvchNombre']);
    $Producto->Descripcion($_POST['nvchDescripcion']);
    $Producto->UnidadMedida($_POST['nvchUnidadMedida']);
    $Producto->Cantidad($_POST['intCantidad']);
    $nvchDireccionImg = pathinfo($_POST['nvchDireccionImg'],PATHINFO_BASENAME);
    $Producto->DireccionImg($nvchDireccionImg);
    $Producto->PrecioVenta1($_POST['dcmPrecioVenta1']);
    $Producto->PrecioVenta2($_POST['dcmPrecioVenta2']);
    $Producto->PrecioVenta3($_POST['dcmPrecioVenta3']);
    $dtmFechaIngreso = date("Y-m-d H:i:s");
    $Producto->FechaIngreso($dtmFechaIngreso);
    $Producto->ActualizarProducto();
    break;
  case "ACP":
    $CodigoProducto = new CodigoProducto();
    $CodigoProducto->IdCodigoProducto($_POST['intIdCodigoProducto']);
    $CodigoProducto->IdProducto($_POST['intIdProducto']);
    $CodigoProducto->Codigo($_POST['nvchCodigo']);
    $dtmFechaInicio = date("Y-m-d H:i:s");
    $CodigoProducto->FechaInicio($dtmFechaInicio);
    $CodigoProducto->FechaFinal('0000-00-00 00:00:00');
    $CodigoProducto->IdTipoCodigoProducto($_POST['intIdTipoCodigoProducto']);
    $CodigoProducto->ActualizarCodigoProducto();
    break;
  case "AUP":
    $UbigeoProducto = new UbigeoProducto();
    $UbigeoProducto->IdUbigeoProducto($_POST['intIdUbigeoProducto']);
    $UbigeoProducto->IdProducto($_POST['intIdProducto']);
    $UbigeoProducto->Sucursal($_POST['nvchSucursal']);
    $UbigeoProducto->Ubicacion($_POST['nvchUbicacion']);
    $UbigeoProducto->CantidadUbigeo($_POST['intCantidadUbigeo']);
    $UbigeoProducto->ActualizarUbigeoProducto();
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
}
?>