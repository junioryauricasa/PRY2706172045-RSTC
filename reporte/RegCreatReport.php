<?php 
	include_once '../../dbconnect.php'; //archivo de coneccion
	/*
	  ------------------------------
	  Autor: Junior Yauricasa
	  Fecha: 25-07-2017
	  Descripcion: 
	    1.- Registrar cada generacion de PDF, guardando las variables correspondientes
	  ------------------------------
	*/
	if(!isset($_SESSION['intIdUsuarioSesion']))
	{
	    header("Location: ../index");
	}

	//Definiendo variables para la tb_creacion_reporte
	$iduser = $_SESSION['user_session'];
	$daytimegeneraterporte = date('d/m/Y').", ".(date('h')-7).':'.date('i:s').' horas'; //Formato 25/07/2017, 3:47:26 horas

	// INSERT History access
	$sql = "INSERT INTO tb_creacion_reporte (intidReporteCreado, intUserId, nvchNombreReporte, dtFechaCreacion) VALUES (NULL, '".$iduser."', '".$nombreReporte."', '".$daytimegeneraterporte."');";
	mysqli_query($con, $sql);
	//echo $sql;
	/*
	if (mysqli_query($con, $sql)){
	  	//header("Location: reportUserAll");
		echo "se registro la creacion del pdf";
	}else 
		echo "algo sucedio mal";
	}
	*/

 ?>