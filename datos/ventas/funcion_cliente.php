<?php 
session_start();
require_once 'clases_cliente/class_cliente.php';
require_once 'clases_cliente/class_domicilio_cliente.php';
require_once 'clases_cliente/class_comunicacion_cliente.php';
require_once 'clases_cliente/class_formulario_cliente.php';
if(empty($_SESSION['intIdCliente'])){
  $_SESSION['intIdCliente'] = 0;
}
if(empty($_SESSION['intIdDomicilioCliente'])){
  $_SESSION['intIdDomicilioCliente'] = 0;
}
if(empty($_SESSION['intIdComunicacionCliente'])){
  $_SESSION['intIdComunicacionCliente'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Cliente = new Cliente();
    $Cliente->DNI($_POST['nvchDNI']);
    $Cliente->RUC($_POST['nvchRUC']);
    $Cliente->RazonSocial($_POST['nvchRazonSocial']);
    $Cliente->ApellidoPaterno($_POST['nvchApellidoPaterno']);
    $Cliente->ApellidoMaterno($_POST['nvchApellidoMaterno']);
    $Cliente->Nombres($_POST['nvchNombres']);
    $Cliente->IdTipoPersona($_POST['intIdTipoPersona']);
    $Cliente->IdTipoCliente($_POST['intIdTipoCliente']);
    $Cliente->Observacion($_POST['nvchObservacion']);
    $Cliente->InsertarCliente();
    $DomicilioCliente = new DomicilioCliente();
    $DomicilioCliente->IdCliente($_SESSION['intIdCliente']);
    $DomicilioCliente->Pais($_POST['nvchPais']);
    $DomicilioCliente->IdDepartamento($_POST['intIdDepartamento']);
    $DomicilioCliente->IdProvincia($_POST['intIdProvincia']);
    $DomicilioCliente->IdDistrito($_POST['intIdDistrito']);
    $DomicilioCliente->Direccion($_POST['nvchDireccion']);
    $DomicilioCliente->IdTipoDomicilio($_POST['intIdTipoDomicilio']);
    $DomicilioCliente->InsertarDomicilioCliente();
    if(!empty($_POST['nvchMedio'])){
        $ComunicacionCliente = new ComunicacionCliente();
        $ComunicacionCliente->IdCliente($_SESSION['intIdCliente']);
        $ComunicacionCliente->Medio($_POST['nvchMedio']);
        $ComunicacionCliente->Lugar($_POST['nvchLugar']);
        $ComunicacionCliente->IdTipoComunicacion($_POST['intIdTipoComunicacion']);
        $ComunicacionCliente->InsertarComunicacionCliente();
    }
    break;
  case "ID":
  	$DomicilioCliente = new DomicilioCliente();
    $DomicilioCliente->IdCliente($_POST['intIdCliente']);
    $DomicilioCliente->Pais($_POST['nvchPais']);
    $DomicilioCliente->Region($_POST['nvchRegion']);
    $DomicilioCliente->Provincia($_POST['nvchProvincia']);
    $DomicilioCliente->Distrito($_POST['nvchDistrito']);
    $DomicilioCliente->Direccion($_POST['nvchDireccion']);
    $DomicilioCliente->IdTipoDomicilio($_POST['intIdTipoDomicilio']);
    $DomicilioCliente->InsertarDomicilioCliente_II();
  	break;
  case "IC":
  	$ComunicacionCliente = new ComunicacionCliente();
    $ComunicacionCliente->IdCliente($_POST['intIdCliente']);
    $ComunicacionCliente->Medio($_POST['nvchMedio']);
    $ComunicacionCliente->Lugar($_POST['nvchLugar']);
    $ComunicacionCliente->IdTipoComunicacion($_POST['intIdTipoComunicacion']);
    $ComunicacionCliente->InsertarComunicacionCliente_II();
  	break;
  case "A":
    $Cliente = new Cliente();
    $Cliente->IdCliente($_POST['intIdCliente']);
    $Cliente->DNI($_POST['nvchDNI']);
    $Cliente->RUC($_POST['nvchRUC']);
    $Cliente->RazonSocial($_POST['nvchRazonSocial']);
    $Cliente->ApellidoPaterno($_POST['nvchApellidoPaterno']);
    $Cliente->ApellidoMaterno($_POST['nvchApellidoMaterno']);
    $Cliente->Nombres($_POST['nvchNombres']);
    $Cliente->IdTipoPersona($_POST['intIdTipoPersona']);
    $Cliente->IdTipoCliente($_POST['intIdTipoCliente']);
    $Cliente->Observacion($_POST['nvchObservacion']);
    $Cliente->ActualizarCliente();
    break;
  case "M":
    $Cliente = new Cliente();
    $Cliente->IdCliente($_POST['intIdCliente']);
    $Cliente->MostrarCliente($_POST['funcion']);
    break;
  case "E":
    $Cliente = new Cliente();
    $Cliente->IdCliente($_POST['intIdCliente']);
    $Cliente->EliminarCliente();
    break;
  case "L":
    $Cliente = new Cliente();
    $Cliente->ListarClientees($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoPersona']);
    break;
  case "P":
    $Cliente = new Cliente();
    $Cliente->PaginarClientees($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado'],$_POST['intIdTipoPersona']);
    break;
  case "F":
    $FormularioCliente = new FormularioCliente();
    $FormularioCliente->ConsultarFormulario($_POST['funcion']);
    break;
  case "AD":
    $DomicilioCliente = new DomicilioCliente();
    $DomicilioCliente->IdDomicilioCliente($_POST['intIdDomicilioCliente']);
    $DomicilioCliente->IdCliente($_POST['intIdCliente']);
    $DomicilioCliente->Pais($_POST['nvchPais']);
    $DomicilioCliente->IdDepartamento($_POST['intIdDepartamento']);
    $DomicilioCliente->IdProvincia($_POST['intIdProvincia']);
    $DomicilioCliente->IdDistrito($_POST['intIdDistrito']);
    $DomicilioCliente->Direccion($_POST['nvchDireccion']);
    $DomicilioCliente->IdTipoDomicilio($_POST['intIdTipoDomicilio']);
    $DomicilioCliente->ActualizarDomicilioCliente();
    break;
  case "AC":
    $ComunicacionCliente = new ComunicacionCliente();
    $ComunicacionCliente->IdComunicacionCliente($_POST['intIdComunicacionCliente']);
    $ComunicacionCliente->IdCliente($_POST['intIdCliente']);
    $ComunicacionCliente->Medio($_POST['nvchMedio']);
    $ComunicacionCliente->Lugar($_POST['nvchLugar']);
    $ComunicacionCliente->IdTipoComunicacion($_POST['intIdTipoComunicacion']);
    $ComunicacionCliente->ActualizarComunicacionCliente();
    break;
  case "MD":
    $DomicilioCliente = new DomicilioCliente();
    $DomicilioCliente->IdCliente($_POST['intIdCliente']);
    $DomicilioCliente->MostrarDomicilioCliente($_POST['tipolistado']);
    break;
  case "MC":
    $ComunicacionCliente = new ComunicacionCliente();
    $ComunicacionCliente->IdCliente($_POST['intIdCliente']);
    $ComunicacionCliente->MostrarComunicacionCliente($_POST['tipolistado']);
    break;
  case "SD":
    $DomicilioCliente = new DomicilioCliente();
    $DomicilioCliente->IdDomicilioCliente($_POST['intIdDomicilioCliente']);
    $DomicilioCliente->SeleccionarDomicilioCliente();
    break;
  case "SC":
    $ComunicacionCliente = new ComunicacionCliente();
    $ComunicacionCliente->IdComunicacionCliente($_POST['intIdComunicacionCliente']);
    $ComunicacionCliente->SeleccionarComunicacionCliente();
    break;
  case "ED":
    $DomicilioCliente = new DomicilioCliente();
    $DomicilioCliente->IdDomicilioCliente($_POST['intIdDomicilioCliente']);
    $DomicilioCliente->EliminarDomicilioCliente();
    break;
  case "EC":
    $ComunicacionCliente = new ComunicacionCliente();
    $ComunicacionCliente->IdComunicacionCliente($_POST['intIdComunicacionCliente']);
    $ComunicacionCliente->EliminarComunicacionCliente();
    break;
}
?>