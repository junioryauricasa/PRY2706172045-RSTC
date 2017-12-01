<!DOCTYPE HTML>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>REPORTE EJEMPLO</title>
  <script src="//use.edgefonts.net/brush-script-std.js"></script>
  <style>
    @page { margin: 180px 50px; }
    #header { 
      position: fixed; 
      left: 0px; 
      top: -180px; 
      right: 0px; 
      height: 150px; 
      background-color: orange; 
      text-align: center; 
    }
    #footer { 
      position: fixed; 
      left: 0px; 
      bottom: -180px; 
      right: 0px; 
      height: 150px; 
      background-color: lightblue; 
    }
    #footer .page:after { 
      content: counter(page, upper-roman); 
    }
  </style>
</head> 

<?php 
    if (isset($pdf)) 
    {
        $font = Font_Metrics::get_font("helvetica", "bold");
        $pdf->page_text(72, 18, "Página: {PAGE_NUM} de {PAGE_COUNT}",
        $font, 12, array(0,0,0));
    }
?>

<body>

  <div id="header">
    <h1>Reporte de Cotizacion</h1>
  </div>  
  <div id="content">
  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae officiis ducimus impedit repellat, quidem harum facilis perspiciatis unde eligendi incidunt placeat necessitatibus ipsa cumque perferendis quas? Explicabo amet nemo officiis.  
  </div>
  <div id="footer">
    <p class="page">Pág </p>
  </div>

</body>

</html>
<?php
  require_once("../../../frameworks/dompdf/dompdf_config.inc.php");
  spl_autoload_register('DOMPDF_autoload');
  function pdf_create($html, $filename, $paper, $orientation, $stream=TRUE)
  {
    $dompdf = new DOMPDF();
    $dompdf->set_paper($paper,$orientation);
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream($filename.".pdf", array("Attachment" => false)); //descargar automaticamente
    //$dompdf->stream($filename.".pdf", array("Attachment" => false)); //previsualizar
  }
  $filename = 'TITULO_DEL_REPORTE';
  $dompdf = new DOMPDF();
  $html = ob_get_clean();
  pdf_create($html,$filename,'A4','portrait');
?>