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

	$nombreReporte = "Listado de Usuarios"; //titulo del reporte

	include 'RegCreatReport.php'; //registro de creacion de reporte;
	include 'querySQL4report.php'; //incluyendo funciones
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $nombreReporte; ?></title>	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

	<!--icon-->
  	<link rel="icon" href="../dist/img/icons/025-pie-chart.png" type="image/png" sizes="16x16">

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
		<table width="100%" style="position: fixed;">
			<tr>
				<td><img src="logo.JPG" alt="" width="200px"></td>
				<td class="text-right">
					<?php include('_include/info_header.php'); ?>
				</td>
			</tr>
		</table>
	</div>
	<div>
		<h3 class="text-center" style="margin-top: 55px">
			<?php echo $nombreReporte; ?>
		</h3>
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam laboriosam voluptatibus, ratione deleniti, eligendi aspernatur rem a velit accusantium obcaecati sed magni ipsam repellat praesentium distinctio veniam similique repellendus nam!
	</p>
	</div>
<br>
<table class="table table-bordered table-sm">
  <thead>
    <tr>
      <th>#Cod</th>
      <th>Usuario</th>
      <th>e-Mail</th>
      <th>Tipo</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    	echo users_data();
    ?>
  </tbody>
</table>
</body>
</html> 

<?php 
	require_once('dompdf/dompdf_config.inc.php');
	$dompdf = new DOMPDF();
	$dompdf->set_paper("A4", "portraid"); //portaid or landscape
	$dompdf -> load_html(ob_get_clean());
	$dompdf -> render();
	$pdf = $dompdf -> output();
	$filename = 'nombre.pdf';
	$dompdf -> stream($filename, array("Attachment" => 0));
 ?>
