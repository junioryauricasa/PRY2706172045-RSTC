<?php
/*
	------------------------------
	Autor: Junior Yauricasa
	Fecha: 23-06-2017
	Descripcion: 
		1.- Declaracion de variables de connecion para mysql
		2.- Test coneccion db descommentar para testear
	------------------------------
*/

$host = '166.62.72.130';
$user = 'restecoadmindb';
$pass = 'restecoadmin123';
$db = 'db_resteco';

$con = mysqli_connect($host, $user, $pass, $db) or die("Error " . mysqli_error($con));

/*
	2.- test coneccion db descommentar para testear
*/

/*
if(!$con){
	echo 'error de conneccion con '.$db;
}else if($con){
	echo 'Conneccion exitosa con '.$db;
}
*/


?>