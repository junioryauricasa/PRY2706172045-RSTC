<?php
session_start();
require_once 'clases_usuario/class_usuario.php';
require_once 'clases_usuario/class_comunicacion_usuario.php';
require_once 'clases_usuario/class_formulario_usuario.php';
if(empty($_SESSION['intIdUsuario'])){
  $_SESSION['intIdUsuario'] = 0;
}
if(empty($_SESSION['intIdComunicacionUsuario'])){
  $_SESSION['intIdComunicacionUsuario'] = 0;
}
switch($_POST['funcion']){
  case "I":
    $Usuario = new Usuario();
    $Usuario->DNI($_POST['nvchDNI']);
    $Usuario->RUC($_POST['nvchRUC']);
    $Usuario->ApellidoPaterno($_POST['nvchApellidoPaterno']);
    $Usuario->ApellidoMaterno($_POST['nvchApellidoMaterno']);
    $Usuario->Nombres($_POST['nvchNombres']);
    $Usuario->Genero($_POST['nvchGenero']);
    $Usuario->UserName($_POST['nvchUserName']);
    $Usuario->UserPassword($_POST['nvchUserPassword']);
    $Usuario->IdTipoUsuario($_POST['intIdTipoUsuario']);
    $Usuario->ImgPerfil($_POST['nvchImgPerfil']);
    $Usuario->UserEstado($_POST['bitUserEstado']);
    $Usuario->Pais($_POST['nvchPais']);
    $Usuario->IdDepartamento($_POST['intIdDepartamento']);
    $Usuario->IdProvincia($_POST['intIdProvincia']);
    $Usuario->IdDistrito($_POST['intIdDistrito']);
    $Usuario->Direccion($_POST['nvchDireccion']);
    $Usuario->Observacion($_POST['nvchObservacion']);
    $Usuario->InsertarUsuario();
    break;
  case "A":
    $Usuario = new Usuario();
    $Usuario->IdUsuario($_POST['intIdUsuario']);
    $Usuario->DNI($_POST['nvchDNI']);
    $Usuario->RUC($_POST['nvchRUC']);
    $Usuario->ApellidoPaterno($_POST['nvchApellidoPaterno']);
    $Usuario->ApellidoMaterno($_POST['nvchApellidoMaterno']);
    $Usuario->Nombres($_POST['nvchNombres']);
    $Usuario->Genero($_POST['nvchGenero']);
    $Usuario->UserName($_POST['nvchUserName']);
    $Usuario->IdTipoUsuario($_POST['intIdTipoUsuario']);
    $Usuario->ImgPerfil($_POST['nvchImgPerfil']);
    $Usuario->UserEstado($_POST['bitUserEstado']);
    $Usuario->Pais($_POST['nvchPais']);
    $Usuario->Region($_POST['nvchRegion']);
    $Usuario->Provincia($_POST['nvchProvincia']);
    $Usuario->Distrito($_POST['nvchDistrito']);
    $Usuario->Direccion($_POST['nvchDireccion']);
    $Usuario->Observacion($_POST['nvchObservacion']);
    $Usuario->ActualizarUsuario();
    break;
  case "M":
    $Usuario = new Usuario();
    $Usuario->IdUsuario($_POST['intIdUsuario']);
    $Usuario->MostrarUsuario($_POST['funcion']);
    break;
  case "E":
    $Usuario = new Usuario();
    $Usuario->IdUsuario($_POST['intIdUsuario']);
    $Usuario->EliminarUsuario();
    break;
  case "L":
    $Usuario = new Usuario();
    $Usuario->ListarUsuarios($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $Usuario = new Usuario();
    $Usuario->PaginarUsuarios($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "F":
    $FormularioUsuario = new FormularioUsuario();
    $FormularioUsuario->ConsultarFormulario($_POST['funcion']);
    break;
  case "AC":
    $ComunicacionUsuario = new ComunicacionUsuario();
    $ComunicacionUsuario->IdComunicacionUsuario($_POST['intIdComunicacionUsuario']);
    $ComunicacionUsuario->IdUsuario($_POST['intIdUsuario']);
    $ComunicacionUsuario->Medio($_POST['nvchMedio']);
    $ComunicacionUsuario->Lugar($_POST['nvchLugar']);
    $ComunicacionUsuario->IdTipoComunicacion($_POST['intIdTipoComunicacion']);
    $ComunicacionUsuario->ActualizarComunicacionUsuario();
    break;
  case "MC":
    $ComunicacionUsuario = new ComunicacionUsuario();
    $ComunicacionUsuario->IdUsuario($_POST['intIdUsuario']);
    $ComunicacionUsuario->MostrarComunicacionUsuario($_POST['tipolistado']);
    break;
  case "SC":
    $ComunicacionUsuario = new ComunicacionUsuario();
    $ComunicacionUsuario->IdComunicacionUsuario($_POST['intIdComunicacionUsuario']);
    $ComunicacionUsuario->SeleccionarComunicacionUsuario();
    break;
  case "EC":
    $ComunicacionUsuario = new ComunicacionUsuario();
    $ComunicacionUsuario->IdComunicacionUsuario($_POST['intIdComunicacionUsuario']);
    $ComunicacionUsuario->EliminarComunicacionUsuario();
    break;
}
?>