<?php 

	/*
		Autor: junior yauricasa
		Fecha: 02 julio 2017
		Descripcion: 
		1.- funcion para obtener la ip
		2.- funcion corre en hosting, sale error en servidor local

	*/

	// IP compartido
	// echo "IP Share: ".$_SERVER['HTTP_CLIENT_IP']."</br>";
	
	// IP Proxy
	$ipproxy = "IP Proxy: ".$_SERVER['HTTP_X_FORWARDED_FOR']."</br>";

	// IP Acceso
	$ipacceso = "IP Acceso: ".$_SERVER['REMOTE_ADDR']."</br>";

	return $ipall = $ipproxy.''.$ipacceso;

 ?>