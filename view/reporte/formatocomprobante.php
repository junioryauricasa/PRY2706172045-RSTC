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
	<div width="100%">
		<table>
			<thead>
				<tr>
					<th style="min-width: 65%; width:65%"></th>
					<th style="min-width: 35%; width:35%"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="color: red"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae, natus quod dolore officiis perspiciatis minus cupiditate id nostrum ratione quo fuga odit consequuntur labore a voluptatem nemo voluptatibus deserunt ipsa.</td>
					<td>
						<div style="border: solid 1px black; padding: 10px;">
								<p style=" text-align: center">R.U.C. N° 20443881540</p>
								<p style=" text-align: center">FACTURA</p>
								<br>
								<p style=" text-align: center">005- N° 0000000</p>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div>
		<p>
			Fecha de Emisión……..de………………………..de 20……...
		</p>
	</div>
	<div style="border-radius: 15px; border: solid 1px black; margin-bottom: 10px; padding: 10px">
		<table width="100%" >
			<thead>
				<tr>
					<th width="13,88%"></th>
					<th width="55%"></th>
					<th width="20%"></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Señor(es):</td>
					<td>Eduardo Pelagio Peres Suaznabar</td>
					<td>Condición de Pago:</td>
					<td>Contado</td>
				</tr>
				<tr>
					<td>RUC / DNI:</td>
					<td></td>
					<td>Vendedor:</td>
					<td>Juan lopez</td>
				</tr>
				<tr>
					<td>Dirección:</td>
					<td></td>
					<td>Guía de remisión:</td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>

	<table class="table table-bordered table-sm">
	  <thead>
	    <tr>
	      <th width="13,88%" style="text-align: center">CODIGO</th>
	      <th width="50%" style="text-align: center">DESCRIPCION</th>
	      <th width="9,72%" style="text-align: center">CANT.</th>
	      <th style="text-align: center">P. UNIT.</th>
	      <th style="text-align: center">P. TOTAL.</th>
	    </tr>
	  </thead>
	  <tbody>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
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