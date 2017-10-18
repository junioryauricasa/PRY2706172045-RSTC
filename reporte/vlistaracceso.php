<?php 
	ob_start();
	session_start();
	ini_set("memory_limit", "128M"); //aumentamos la memoria disponible para DOMPDF
	/*
	  ------------------------------
	  Autor: Junior Yauricasa
	  Fecha: 15-06-2017
	  Descripcion: 
	    1.- Redireccionar al INDEX a cualquier usuario que quiera acceder a este enlace directamente sin iniciar session
	  ------------------------------
	*/
	if(!isset($_SESSION['user_session']))
	{
	    header("Location: ../index");
	}

	$nombreReporte = "Historial de Accesso Completo"; //titulo del reporte
	include 'RegCreatReport.php'; //registro de creacion de reporte;
	include 'querySQL4report.php'; //incluyendo funciones
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $nombreReporte; ?></title>	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

	<style>
		@font-face {
		    font-family: 'Elegance';
		    font-weight: normal;
		    font-style: normal;
		    font-variant: normal;
		    src: url("http://eclecticgeek.com/dompdf/fonts/Elegance.ttf") format("truetype");
		}
		p{
			font-size: 13px !important;
			text-align: justify;
		}
		table{
			font-size: 11px ;
		}
		h1{
			font-family: Elegance, sans-serif;
		}
	</style>

</head>
<body class="container">
	<div style="display: inline-block;">
	<table width="100%">
		<tr>
			<td><img src="logo.JPG" alt="" width="200px"></td>
			<td class="text-right">
				<?php include('_include/info_header.php'); ?>
			</td>
		</tr>
	</table>
	<br>
		<h3 class="text-center"><?php echo $nombreReporte; ?></h3>
	</div>
	<p>
		Reporte comprendido con los inicios de sesión de los diferentes usuarios de la plataforma <b>resteco SFT</b> sirvase a lecturar la informacion comprendida a continuación haciendo enfasis en los datos los cuales son captadas a cada instante por la plataforma, esta información no puede ser actualizada o eliminada, bajo ninguna circunstancia.
	</p>
	<p>
		<!-- seccion de ayuda -->
		<b>Nota. </b> En caso de dudas le recomendamos ir a la seccion de ayuda al usuario, podra encontrar informacion referente a esta sección o comuniquese con su administrador.
	</p>
<br>
<table class="table table-bordered table-sm">
  <thead>
    <tr>
	    <th>#Código</th>
	    <th>Usuario / Correo</th>
	    <th>Tipo Usuario</th>
	    <th>Estado Actual</th>
	    <th>Fecha</th>
	    <th>Dispositivo</th>
	    <th>IP Registrada</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    	echo users_HistoryAccessAll4Report();
    ?>
  </tbody>
</table>
</body>
</html>

<?php 
	require_once('dompdf/dompdf_config.inc.php');
	$dompdf = new DOMPDF();
	$dompdf->set_paper('A4', 'landscape'); //Adicionar esto para hojas horizontales.
	$dompdf -> load_html(ob_get_clean());
	$dompdf -> render();
	$pdf = $dompdf -> output();
	$filename = 'nombre.pdf';
	//$dompdf -> stream($filename, array("Attachment" => 0)); //parmetro ultimo 0=view / 1=download
	$dompdf -> stream( $filename, array('Attachment' => false)); // evitar descargar el archivo
	exit(0);
 ?>