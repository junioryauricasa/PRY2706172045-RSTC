<?php
session_start();
require_once 'clases_producto/class_producto.php';
require_once 'clases_producto/class_codigo_producto.php';
require_once 'clases_producto/class_ubigeo_producto.php';
require_once 'clases_producto/class_formulario_producto.php';
if(empty($_SESSION['intIdProducto'])){
  $_SESSION['intIdProducto'] = 0;
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
    $CodigoProducto->IdProveedor($_POST['intIdProveedor']);
    $CodigoProducto->Pais($_POST['nvchPais']);
    $CodigoProducto->Region($_POST['nvchRegion']);
    $CodigoProducto->Provincia($_POST['nvchProvincia']);
    $CodigoProducto->Distrito($_POST['nvchDistrito']);
    $CodigoProducto->Direccion($_POST['nvchDireccion']);
    $CodigoProducto->IdTipoDomicilio($_POST['intIdTipoDomicilio']);
    $CodigoProducto->InsertarCodigoProducto_II();
    break;
  case "IUP":
    $UbigeoProducto = new UbigeoProducto();
    $UbigeoProducto->IdProveedor($_POST['intIdProveedor']);
    $UbigeoProducto->Pais($_POST['nvchPais']);
    $UbigeoProducto->Region($_POST['nvchRegion']);
    $UbigeoProducto->Provincia($_POST['nvchProvincia']);
    $UbigeoProducto->Distrito($_POST['nvchDistrito']);
    $UbigeoProducto->Direccion($_POST['nvchDireccion']);
    $UbigeoProducto->IdTipoDomicilio($_POST['intIdTipoDomicilio']);
    $UbigeoProducto->InsertarCodigoProducto_II();
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
  case "M":
    $Producto = new Producto();
    $Producto->IdProducto($_POST['intIdProducto']);
    $Producto->MostrarProducto($_POST['funcion']);
    break;
  case "E":
    $Producto = new Producto();
    $Producto->IdProducto($_POST['intIdProducto']);
    $Producto->EliminarProducto();
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