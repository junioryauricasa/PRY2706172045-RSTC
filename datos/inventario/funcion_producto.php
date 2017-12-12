<?php
session_start();
require_once 'clases_producto/class_producto.php';
require_once 'clases_producto/class_maquinaria.php';
require_once 'clases_producto/class_codigo_producto.php';
require_once 'clases_producto/class_ubigeo_producto.php';
require_once 'clases_producto/class_formulario_producto.php';
require_once '../reportes/clases_kardex/class_kardex_producto.php';
if(empty($_SESSION['intIdProducto'])){
  $_SESSION['intIdProducto'] = 0;
}
if(empty($_SESSION['intIdCodigoProducto'])){
  $_SESSION['intIdCodigoProducto'] = 0;
}
if(empty($_SESSION['intIdUbigeoProducto'])){
  $_SESSION['intIdUbigeoProducto'] = 0;
}
if(empty($_SESSION['intIdMaquinaria'])){
  $_SESSION['intIdMaquinaria'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Producto = new Producto();
    $Producto->IdTipoVenta($_POST['intIdTipoProducto']);
    if($_POST['intIdTipoProducto']==1)
        $Producto->Descripcion($_POST['nvchDescripcion']);
    else
        $Producto->Descripcion($_POST['nvchDescripcionR']);
    $Producto->UnidadMedida($_POST['nvchUnidadMedida']);
    $Producto->CantidadMinima($_POST['intCantidadMinima']);
    $nvchDireccionImg = pathinfo($_POST['nvchDireccionImg'],PATHINFO_BASENAME);
    $Producto->DireccionImg($nvchDireccionImg);
    $Producto->PrecioCompra($_POST['dcmPrecioCompra']);
    $Producto->IdTipoMonedaCompra($_POST['intIdTipoMonedaCompra']);
    $Producto->PrecioVenta1($_POST['dcmPrecioVenta1']);
    $Producto->PrecioVenta2($_POST['dcmPrecioVenta2']);
    $Producto->PrecioVenta3($_POST['dcmPrecioVenta3']);
    $Producto->DescuentoVenta2($_POST['dcmDescuentoVenta2']);
    $Producto->DescuentoVenta3($_POST['dcmDescuentoVenta3']);
    $Producto->IdTipoMonedaVenta($_POST['intIdTipoMonedaVenta']);
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
    $Producto->AumentarStockTotal_II($_SESSION['intIdProducto']);
    $Producto->CantidadInicial($_SESSION['intIdProducto']);
    $Producto->CantidadInicialUbigeo($_SESSION['intIdProducto'],1);
    $Producto->CantidadInicialUbigeo($_SESSION['intIdProducto'],2);
    //$KardexProducto = new KardexProducto();
    //$KardexProducto->IdProducto($_SESSION['intIdProducto']);
    //$KardexProducto->InsertarKardexProductoInicial();
    break;
  case "IMQ":
    $Maquinaria = new Maquinaria();
    $Maquinaria->InsertarMaquinaria($_POST['nvchDia'],$_POST['nvchMes'],$_POST['nvchAnio'],$_POST['nvchNombres'],
                                    $_POST['nvchAtencion'],$_POST['nvchDireccion'],$_POST['dcmPrecioVenta']);
    break;
  case "LMQ":
    $Maquinaria = new Maquinaria();
    $Maquinaria->ListarMaquinarias($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "ICP":
    $CodigoProducto = new CodigoProducto();
    $CodigoProducto->IdProducto($_POST['intIdProducto']);
    $CodigoProducto->Codigo($_POST['nvchCodigo']);
    $CodigoProducto->IdTipoCodigoProducto($_POST['intIdTipoCodigoProducto']);
    $CodigoProducto->InsertarCodigoProducto_II();
    break;
  case "SP":
    $Producto = new Producto();
    $Producto->IdProducto($_POST['intIdProducto']);
    $Producto->SeleccionarProducto($_POST['intIdTipoMoneda']);
    break;
  case "IUP":
    $UbigeoProducto = new UbigeoProducto();
    $UbigeoProducto->IdProducto($_POST['intIdProducto']);
    $UbigeoProducto->IdSucursal($_POST['intIdSucursal']);
    $UbigeoProducto->Ubicacion($_POST['nvchUbicacion']);
    $UbigeoProducto->CantidadUbigeo($_POST['intCantidadUbigeo']);
    $UbigeoProducto->InsertarUbigeoProducto_II();
    $Producto = new Producto();
    $Producto->CantidadInicialUbigeo($_POST['intIdProducto'],$_POST['intIdSucursal']);
    $Producto->AumentarStockTotal_II($_POST['intIdProducto']);
    $Producto->CantidadInicial($_SESSION['intIdProducto']);
    break;
  case "A":
    $Producto = new Producto();
    $Producto->IdProducto($_POST['intIdProducto']);
    $Producto->IdTipoVenta($_POST['intIdTipoProducto']);
    if($_POST['intIdTipoProducto'] == 1)
        $Producto->Descripcion($_POST['nvchDescripcion']);
    else
        $Producto->Descripcion($_POST['nvchDescripcionR']);
    $Producto->UnidadMedida($_POST['nvchUnidadMedida']);
    $Producto->CantidadMinima($_POST['intCantidadMinima']);
    $nvchDireccionImg = pathinfo($_POST['nvchDireccionImg'],PATHINFO_BASENAME);
    $Producto->DireccionImg($nvchDireccionImg);
    $Producto->PrecioCompra($_POST['dcmPrecioCompra']);
    $Producto->IdTipoMonedaCompra($_POST['intIdTipoMonedaCompra']);
    $Producto->PrecioVenta1($_POST['dcmPrecioVenta1']);
    $Producto->PrecioVenta2($_POST['dcmPrecioVenta2']);
    $Producto->PrecioVenta3($_POST['dcmPrecioVenta3']);
    $Producto->DescuentoVenta2($_POST['dcmDescuentoVenta2']);
    $Producto->DescuentoVenta3($_POST['dcmDescuentoVenta3']);
    $Producto->IdTipoMonedaVenta($_POST['intIdTipoMonedaVenta']);
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
    $Producto->AumentarStockTotal_II($_POST['intIdProducto']);
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
  case "Id":
    $Producto = new Producto();
    $Producto->ConsultarUltimoId();
    break;
  case "BP":
    $Producto = new Producto();
    $Producto->BuscarProducto($_POST['search'],$_POST['intIdTipoMoneda']);
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