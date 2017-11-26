<?php 
    /* 
      Ejemeplo de paginador 
      Pagina 1 de 2
    */
?>
<html>
  <head>
  <style>
      @page { 
          margin: 0px 0px; 
      }
      #header { 
          position: fixed; 
          left: 0px; 
          top: -180px; 
          right: 0px; 
          background-color: orange; 
          text-align: center; 
      }
      #footer { 
          position: fixed; 
          left: 0px; 
          bottom: -180px; 
          right: 0px;  
          background-color: lightblue; 
      }
      #footer .page:after { 
          content: counter(page, upper-roman); 
      }
  </style>
  </head>
  <body>
  
    <div id="header">
      cabecera
    </div>

    <div class="content">
      
    </div>

    <div id="footer">
      <script type="text/php">
          if(isset($pdf)){
              $font = Font_Metrics::get_font("helvetica");
              $pdf->page_text(
                72, 
                18, 
                "Página: {PAGE_NUM} de {PAGE_COUNT}",
                $font, 
                10, 
                array(0,0,0)
              );
          }
      </script>
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