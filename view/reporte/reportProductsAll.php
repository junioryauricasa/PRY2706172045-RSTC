<?php 
	ob_start();
	session_start();
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

	include_once 'querySQL4report.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte Usuarios</title>	
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
			<td><img src="logo.JPG" alt="" width="130px"></td>
			<td class="text-right">
				<span id="spnFecha">
					Fecha:
					<?php
						/*
						  ------------------------------
						  Autor: Junior Yauricasa
						  Fecha: 13-07-2017
						  Descripcion: 
						    1.- campos requeridos dentro del archivo de reporte fecha y usuario que la genero
						  ------------------------------
						*/
						$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
						$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
						 
						echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').", ".(date('H')-7).':'.date('i:s');
						//Salida: Viernes 24 de Febrero del 2012
					?>
				</span>
				<br>
				<span>Generado Por: <?php echo $_SESSION['usr_name'];?></span>
			</td>
		</tr>
	</table>
	<br>
		<h3 class="text-center">Reporte de usuarios</h3>
	</div>
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam laboriosam voluptatibus, ratione deleniti, eligendi aspernatur rem a velit accusantium obcaecati sed magni ipsam repellat praesentium distinctio veniam similique repellendus nam!
	</p>
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
	$dompdf -> load_html(ob_get_clean());
	$dompdf -> render();
	$pdf = $dompdf -> output();
	$filename = 'nombre.pdf';
	$dompdf -> stream($filename, array("Attachment" => 0));

 ?>
