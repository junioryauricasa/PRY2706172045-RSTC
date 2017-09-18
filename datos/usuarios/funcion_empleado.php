<?php 
session_start();
require_once 'clases_empleado/class_empleado.php';
require_once 'clases_empleado/class_comunicacion_empleado.php';
require_once 'clases_empleado/class_formulario_empleado.php';
if(empty($_SESSION['intIdEmpleado'])){
  $_SESSION['intIdEmpleado'] = 0;
}
if(empty($_SESSION['intIdDomicilioEmpleado'])){
  $_SESSION['intIdDomicilioEmpleado'] = 0;
}
if(empty($_SESSION['intIdComunicacionEmpleado'])){
  $_SESSION['intIdComunicacionEmpleado'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Empleado = new Empleado();
    $Empleado->DNI($_POST['nvchDNI']);
    $Empleado->RUC($_POST['nvchRUC']);
    $Empleado->ApellidoPaterno($_POST['nvchApellidoPaterno']);
    $Empleado->ApellidoMaterno($_POST['nvchApellidoMaterno']);
    $Empleado->Nombres($_POST['nvchNombres']);
    $Empleado->Observacion($_POST['nvchObservacion']);
    $Empleado->InsertarEmpleado();
    $ComunicacionEmpleado = new ComunicacionEmpleado();
    $ComunicacionEmpleado->IdEmpleado($_SESSION['intIdEmpleado']);
    $ComunicacionEmpleado->Medio($_POST['nvchMedio']);
    $ComunicacionEmpleado->Lugar($_POST['nvchLugar']);
    $ComunicacionEmpleado->IdTipoComunicacion($_POST['intIdTipoComunicacion']);
    $ComunicacionEmpleado->InsertarComunicacionEmpleado();
    break;
  case "ID":
  	$DomicilioEmpleado = new DomicilioEmpleado();
    $DomicilioEmpleado->IdEmpleado($_POST['intIdEmpleado']);
    $DomicilioEmpleado->Pais($_POST['nvchPais']);
    $DomicilioEmpleado->Region($_POST['nvchRegion']);
    $DomicilioEmpleado->Provincia($_POST['nvchProvincia']);
    $DomicilioEmpleado->Distrito($_POST['nvchDistrito']);
    $DomicilioEmpleado->Direccion($_POST['nvchDireccion']);
    $DomicilioEmpleado->IdTipoDomicilio($_POST['intIdTipoDomicilio']);
    $DomicilioEmpleado->InsertarDomicilioEmpleado_II();
  	break;
  case "IC":
  	$ComunicacionEmpleado = new ComunicacionEmpleado();
    $ComunicacionEmpleado->IdEmpleado($_POST['intIdEmpleado']);
    $ComunicacionEmpleado->Medio($_POST['nvchMedio']);
    $ComunicacionEmpleado->Lugar($_POST['nvchLugar']);
    $ComunicacionEmpleado->IdTipoComunicacion($_POST['intIdTipoComunicacion']);
    $ComunicacionEmpleado->InsertarComunicacionEmpleado_II();
  	break;
  case "A":
    $Empleado = new Empleado();
    $Empleado->IdEmpleado($_POST['intIdEmpleado']);
    $Empleado->DNI($_POST['nvchDNI']);
    $Empleado->RUC($_POST['nvchRUC']);
    $Empleado->ApellidoPaterno($_POST['nvchApellidoPaterno']);
    $Empleado->ApellidoMaterno($_POST['nvchApellidoMaterno']);
    $Empleado->Nombres($_POST['nvchNombres']);
    $Empleado->Observacion($_POST['nvchObservacion']);
    $Empleado->ActualizarEmpleado();
    break;
  case "M":
    $Empleado = new Empleado();
    $Empleado->IdEmpleado($_POST['intIdEmpleado']);
    $Empleado->MostrarEmpleado($_POST['funcion']);
    break;
  case "E":
    $Empleado = new Empleado();
    $Empleado->IdEmpleado($_POST['intIdEmpleado']);
    $Empleado->EliminarEmpleado();
    break;
  case "L":
    $Empleado = new Empleado();
    $Empleado->ListarEmpleados($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $Empleado = new Empleado();
    $Empleado->PaginarEmpleados($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "F":
    $FormularioEmpleado = new FormularioEmpleado();
    $FormularioEmpleado->ConsultarFormulario($_POST['funcion']);
    break;
  case "AC":
    $ComunicacionEmpleado = new ComunicacionEmpleado();
    $ComunicacionEmpleado->IdComunicacionEmpleado($_POST['intIdComunicacionEmpleado']);
    $ComunicacionEmpleado->IdEmpleado($_POST['intIdEmpleado']);
    $ComunicacionEmpleado->Medio($_POST['nvchMedio']);
    $ComunicacionEmpleado->Lugar($_POST['nvchLugar']);
    $ComunicacionEmpleado->IdTipoComunicacion($_POST['intIdTipoComunicacion']);
    $ComunicacionEmpleado->ActualizarComunicacionEmpleado();
    break;
  case "MC":
    $ComunicacionEmpleado = new ComunicacionEmpleado();
    $ComunicacionEmpleado->IdEmpleado($_POST['intIdEmpleado']);
    $ComunicacionEmpleado->MostrarComunicacionEmpleado($_POST['tipolistado']);
    break;
  case "SC":
    $ComunicacionEmpleado = new ComunicacionEmpleado();
    $ComunicacionEmpleado->IdComunicacionEmpleado($_POST['intIdComunicacionEmpleado']);
    $ComunicacionEmpleado->SeleccionarComunicacionEmpleado();
    break;
  case "EC":
    $ComunicacionEmpleado = new ComunicacionEmpleado();
    $ComunicacionEmpleado->IdComunicacionEmpleado($_POST['intIdComunicacionEmpleado']);
    $ComunicacionEmpleado->EliminarComunicacionEmpleado();
    break;
}
?>