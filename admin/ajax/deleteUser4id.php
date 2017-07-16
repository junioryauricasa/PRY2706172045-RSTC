<?php
    $q = intval($_GET['q']);

    $con = mysqli_connect('localhost','root','','db_resteco');
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }

    mysqli_select_db($con,"ajax_demo");
    $sql="DELETE FROM tb_usuario WHERE intUserId = ".$q."";
    $result = mysqli_query($con,$sql);

	if (mysqli_query($con, $sql)) {
	    echo "Registro eliminado exitosamente...!";
	    header ("Location: ../adminusers");
	} else {
	    echo "Arror al eliminar registro: " . mysqli_error($conn);
	}

	mysqli_close($con);
?>