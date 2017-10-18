<?php
session_start();
require_once '../conexion/bd_conexion.php';
try{
    if($_FILES["SeleccionImagen"]['tmp_name'] != ""){
        if(!empty($_SESSION['RutaDefaultImg']))
        if($_SESSION['RutaDefaultImg']!="")
        { unlink($_SESSION['RutaDefaultImg']); }
    
        $extension = pathinfo($_FILES["SeleccionImagen"]['name'], PATHINFO_EXTENSION);
        $now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
        $ruta_destino = "imgperfil/".$now->format("YmdHisu").".".$extension;
        move_uploaded_file($_FILES["SeleccionImagen"]['tmp_name'], $ruta_destino);
        $ruta = '../../datos/usuarios/'.$ruta_destino;
        $_SESSION['RutaDefaultImg'] = $ruta_destino;
        echo $ruta;
    } else {
        echo "blank";
    }
}
catch(PDPException $e){
	echo $e->getMessage();
}
?>