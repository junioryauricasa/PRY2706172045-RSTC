<?php 
session_start();
require_once 'class_proveedor.php';
require_once 'class_domicilio_proveedor.php';
require_once 'class_comunicacion_proveedor.php';
require_once 'class_formulario_proveedor.php';
if(empty($_SESSION['intIdProveedor'])){
  $_SESSION['intIdProveedor'] = 0;
}

switch($_POST['funcion']){
  case "I":
    $Proveedor = new Proveedor();
    $Proveedor->DNI($_POST['nvchDNI']);
    $Proveedor->RUC($_POST['nvchRUC']);
    $Proveedor->RazonSocial($_POST['nvchRazonSocial']);
    $Proveedor->ApellidoPaterno($_POST['nvchApellidoPaterno']);
    $Proveedor->ApellidoMaterno($_POST['nvchApellidoMaterno']);
    $Proveedor->Nombres($_POST['nvchNombres']);
    $Proveedor->IdTipoPersona($_POST['intIdTipoPersona']);
    $Proveedor->InsertarProveedor();
    $DomicilioProveedor = new DomicilioProveedor();
    $DomicilioProveedor->IdProveedor($_SESSION['intIdProveedor']);
    $DomicilioProveedor->Pais($_POST['nvchPais']);
    $DomicilioProveedor->Region($_POST['nvchRegion']);
    $DomicilioProveedor->Provincia($_POST['nvchProvincia']);
    $DomicilioProveedor->Distrito($_POST['nvchDistrito']);
    $DomicilioProveedor->Direccion($_POST['nvchDireccion']);
    $DomicilioProveedor->IdTipoDomicilio($_POST['intIdTipoDomicilio']);
    $DomicilioProveedor->InsertarDomicilioProveedor();
    $ComunicacionProveedor = new ComunicacionProveedor();
    $ComunicacionProveedor->IdProveedor($_SESSION['intIdProveedor']);
    $ComunicacionProveedor->Medio($_POST['nvchMedio']);
    $ComunicacionProveedor->Lugar($_POST['nvchLugar']);
    $ComunicacionProveedor->IdTipoComunicacion($_POST['intIdTipoComunicacion']);
    $ComunicacionProveedor->InsertarComunicacionProveedor();
    break;
  case "A":
    $Proveedor = new Proveedor();
    $Proveedor->IdProveedor($_POST['intIdProveedor']);
    $Proveedor->DNI($_POST['nvchDNI']);
    $Proveedor->RUC($_POST['nvchRUC']);
    $Proveedor->RazonSocial($_POST['nvchRazonSocial']);
    $Proveedor->ApellidoPaterno($_POST['nvchApellidoPaterno']);
    $Proveedor->ApellidoMaterno($_POST['nvchApellidoMaterno']);
    $Proveedor->Nombres($_POST['nvchNombres']);
    $Proveedor->IdTipoPersona($_POST['intIdTipoPersona']);
    $Proveedor->ActualizarProveedor();
    break;
  case "M":
    $Proveedor = new Proveedor();
    $Proveedor->IdProveedor($_POST['intIdProveedor']);
    $Proveedor->MostrarProveedor($_POST['funcion']);
    break;
  case "E":
    $Proveedor = new Proveedor();
    $Proveedor->IdProveedor($_POST['intIdProveedor']);
    $Proveedor->EliminarProveedor();
    break;
  case "L":
    $Proveedor = new Proveedor();
    $Proveedor->ListarProveedores($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $Proveedor = new Proveedor();
    $Proveedor->PaginarProveedores($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "F":
    $FormularioProveedor = new FormularioProveedor();
    $FormularioProveedor->ConsultarFormulario($_POST['funcion']);
    break;
  case "MD":
    $DomicilioProveedor = new DomicilioProveedor();
    $DomicilioProveedor->IdProveedor($_POST['intIdProveedor']);
    $DomicilioProveedor->MostrarDomicilioProveedor();
    break;
  case "MC":
    $ComunicacionProveedor = new ComunicacionProveedor();
    $ComunicacionProveedor->IdProveedor($_POST['intIdProveedor']);
    $ComunicacionProveedor->MostrarComunicacionProveedor();
    break;
}
?>