<?php
	$bd_hostname = 'localhost';
	$bd_basededatos = 'db_resteco';
	$bd_username = 'root';
	$bd_password = '';

	try{
	  $bd_conexion = new PDO("mysql:host={$bd_hostname};dbname={$bd_basededatos}",$bd_username,$bd_password);
	  $bd_conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 }
	 catch(PDOException $e){
	  echo $e->getMessage();
	 }
?>