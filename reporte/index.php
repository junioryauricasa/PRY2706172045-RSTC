<?php
ob_start();
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta content="text/html; charset=ISO-8859-1"
 http-equiv="content-type">
  <title>Reporte_Kardex_Producto</title>
  <style>
@page {
size: 21cm 29.7cm;
margin: 30mm 45mm 30mm 45mm; /* change the margins as you want them to be. */
}
  </style>
</head>
<body>
<div style="text-align: center;">
<div style="text-align: left;"><big
 style="font-family: Calibri;"><big><span
 style="font-weight: bold;"></span></big></big><img
 style="width: 450px; height: 84px;" alt="Logo Resteco"
 src="file:///C:/xampp/htdocs/PRY2706172045-RSTC/datos/imagenes/logo_resteco.jpg">&nbsp;&nbsp;&nbsp;
<br style="font-family: Calibri;">
<div style="text-align: right;"><span
 style="font-weight: bold; font-family: Calibri;">Fecha Generada:</span><span style="font-family: Calibri;">
[FechaActual]</span><br style="font-family: Calibri;">
<span style="font-weight: bold; font-family: Calibri;">Usuario que generó:</span><span style="font-family: Calibri;">
[NombresApellidos]</span></div>
<big style="font-family: Calibri;"><big><span style="font-weight: bold;"></span></big></big></div>
<big style="font-family: Calibri;"><big><span style="font-weight: bold;">REPORTE KARDEX DEL PRODUCTO
[nvchCodigo]</span></big></big><br>
<br>
<div style="text-align: left; font-family: Calibri;"><span style="font-weight: bold;">Fecha de Inicio:</span>
[dtmFechaInicial]<br style="font-weight: bold;">
<span style="font-weight: bold;">Fecha Final:</span>
[dtmFechaFinal]<br>
<br>
<table style="text-align: left; width: 100%;" border="1"
 cellpadding="2" cellspacing="0">
  <thead>
  	<tr>
      <th style="font-family: Calibri;"><small>Ítem</small></th>
      <th style="font-family: Calibri;"><small>Fecha</small></th>
      <th style="font-family: Calibri;"><small>Movimiento<br>
      </small></th>
      <th style="font-family: Calibri;"><small>Comprobante</small></th>
      <th style="font-family: Calibri;"><small>Serie</small></th>
      <th style="font-family: Calibri;"><small>Numeración</small></th>
      <th style="font-family: Calibri;"><small>Cantidad Entrada</small></th>
      <th style="font-family: Calibri;"><small>Cantidad Salida</small></th>
      <th style="font-family: Calibri;"><small>Stock</small></th>
      <th style="font-family: Calibri;"><small>Precio Entrada</small></th>
      <th style="font-family: Calibri;"><small>Total Entrada</small></th>
      <th style="font-family: Calibri;"><small>Precio Salida</small></th>
      <th style="font-family: Calibri;"><small>Total Salida</small></th>
      <th style="font-family: Calibri;"><small>Saldo Valorizado</small></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
      <td style="font-family: Calibri;"></td>
    </tr>
  </tbody>
</table>
<br>
</div>
</div>
</body>
</html>
<?php

	require_once("../frameworks/dompdf/dompdf_config.inc.php");
	spl_autoload_register('DOMPDF_autoload');
	function pdf_create($html, $filename, $paper, $orientation, $stream=TRUE)
	{
		$dompdf = new DOMPDF();
		$dompdf->set_paper($paper,$orientation);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream($filename.".pdf");
	}
	$filename = 'Reporte_Kardex_Producto';
	$dompdf = new DOMPDF();
	$html = ob_get_clean();
	pdf_create($html,$filename,'A4','portrait');
?>