<?php
session_start();
require_once 'class_formulario_producto.php';
if(empty($_SESSION['intIdProducto'])){
  $_SESSION['intIdProducto'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $producto = new Producto();
    $producto->CodigoProducto($_POST['nvchCodigoProducto']);
    $producto->CodigoInventario($_POST['nvchCodigoInventario']);
    $producto->Nombre($_POST['nvchNombre']);
    $producto->Descripcion($_POST['nvchDescripcion']);
    $producto->PrecioCompra($_POST['dcmPrecioCompra']);
    $producto->PrecioVenta($_POST['dcmPrecioVenta']);
    $producto->Cantidad($_POST['intCantidad']);
    $producto->Descuento($_POST['nvchDescuento']);
    $nvchDireccionImg = pathinfo($_POST['nvchDireccionImg'],PATHINFO_BASENAME);
    $producto->DireccionImg($nvchDireccionImg);
    $producto->Sucursal($_POST['nvchSucursal']);
    $producto->Gabinete($_POST['nvchGabinete']);
    $producto->Cajon($_POST['nvchCajon']);
    $dtmFechaIngreso = date("Y-m-d H:i:s");
    $producto->FechaIngreso($dtmFechaIngreso);
    $producto->InsertarProducto();
    break;
  case "A":
    $producto = new Producto();
    $producto->IdProducto($_POST['intIdProducto']);
    $producto->CodigoProducto($_POST['nvchCodigoProducto']);
    $producto->CodigoInventario($_POST['nvchCodigoInventario']);
    $producto->Nombre($_POST['nvchNombre']);
    $producto->Descripcion($_POST['nvchDescripcion']);
    $producto->PrecioCompra($_POST['dcmPrecioCompra']);
    $producto->PrecioVenta($_POST['dcmPrecioVenta']);
    $producto->Cantidad($_POST['intCantidad']);
    $producto->Descuento($_POST['nvchDescuento']);
    $nvchDireccionImg = pathinfo($_POST['nvchDireccionImg'],PATHINFO_BASENAME);
    $producto->DireccionImg($nvchDireccionImg);
    $producto->Sucursal($_POST['nvchSucursal']);
    $producto->Gabinete($_POST['nvchGabinete']);
    $producto->Cajon($_POST['nvchCajon']);
    $producto->FechaIngreso($_POST['dtmFechaIngreso']);
    $producto->ActualizarProducto();
    break;
  case "M":
    $producto = new Producto();
    $producto->IdProducto($_POST['intIdProducto']);
    $producto->MostrarProducto($_POST['funcion']);
    break;
  case "E":
    $producto = new Producto();
    $producto->IdProducto($_POST['intIdProducto']);
    $producto->EliminarProducto();
    break;
  case "L":
    $producto = new Producto();
    $producto->ListarProductos($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $producto = new Producto();
    $producto->PaginarProductos($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "F":
    $formularioproducto = new FormularioProducto();
    $formularioproducto->ConsultarFormulario($_POST['funcion']);
    break;
}
?>