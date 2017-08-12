<?php
session_start();
require_once '../conexion/bd_conexion.php';
try{
	$file = $_FILES["nvchDireccionImg"];
	$extension = pathinfo($_FILES["nvchDireccionImg"]['name'], PATHINFO_EXTENSION);
	$nvchDireccionImg = "img-producto-id-".$_SESSION["intIdProducto"].".".$extension;
	$ruta_origen = $file["tmp_name"];
	$carpeta = "imgproducto/";
	$ruta_destino = $carpeta.$nvchDireccionImg;

	move_uploaded_file($ruta_origen, $ruta_destino);
    $sql_conexion = new Conexion_BD();
    $sql_conectar = $sql_conexion->Conectar();
    $sql_comando = $sql_conectar->prepare('CALL insertarimagenproducto(:intIdProducto,:nvchDireccionImg)');
    $sql_comando->execute(array(
    ':intIdProducto' => $_SESSION["intIdProducto"],
    ':nvchDireccionImg' => $nvchDireccionImg));
    echo "ok";
}
catch(PDPException $e){
	echo $e->getMessage();
}
?>