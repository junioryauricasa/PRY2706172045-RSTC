<?php
	$nvchUserName = $_POST['nombre'];
	$nchUserMail = $_POST['correo'];
	$nvchUserPassword = md5($nvchUserPassword) = $_POST['passw'];

	include '../../dbconnect.php';

	// Create connection
	// Check connection
	if (!$con) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "INSERT INTO tb_usuario (nvchUserName, nchUserMail, nvchUserPassword) VALUES ('$nvchUserName', '$nchUserMail', '$nvchUserPassword');";

	if (mysqli_query($con, $sql)) {
	    echo "Registro creado Exitosamente";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($con);
	}

	mysqli_close($con);
?>