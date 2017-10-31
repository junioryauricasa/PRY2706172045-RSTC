<?php
require_once '../frameworks/dompdf/autoload.inc.php';

	session_start();
	$nombreReporte = "Listado de Usuarios"; //titulo del reporte
	include 'querySQL4report.php'; //incluyendo funciones
$pagina = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $nombreReporte; ?></title>
	<!--icon-->
  	<link rel="icon" href="../frameworks/dist/img/icons/025-pie-chart.png" type="image/png" sizes="16x16">
  	<link rel="stylesheet" href="../../frameworks/bootstrap/css/bootstrap.min.css">

</head>
<body class="container">
	<div style="display: inline-block;">
		<table width="100%" style="position: fixed;">
			<tr>
				<td><img src="logo.JPG" alt="" width="200px"></td>
				<td class="text-right">
					<?php include("_include/info_header.php"); ?>
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
      <th>Nombres</th>
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
</html>';
use Dompdf\Dompdf;
	$pagina = utf8_decode($pagina);
	$dompdf = new Dompdf();
	$dompdf->loadHtml($pagina);

// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');
	$dompdf->render();
	$dompdf->stream("usuarios.pdf");
 ?>