<?php 
  /*
    Reporte con paginador en el footer 
    1/2
  */
?>
<html>
  <head>
  <style>
      @page { 
          margin: 25px;
      }
          /* Forms para header y footer */
      #header { 
        left: 0px; 
        top: 0px; 
        right: 0px;
        text-align: center; 
      }
      
      /*
      #footer { 
        position: fixed; 
        left: 0px; 
        bottom: 0px; 
        right: 0px;
        height: 130px;
        text-align: center; 
      }
      */
      #footer {
          position: fixed;
          bottom: 0;
          width: 100%;
          text-align: right;
          /*
          border-top: 1px solid gray;
          */
          height: 20px
      }
      #footer .page:after { content: counter(page, upper-roman); }
  </style>
  </head>
  <body>
  
    <div id="header">
      cabecera
    </div>

    <div class="content">
    </div>

    <div id="footer">
      <script type='text/php'>
        if ( isset($pdf) ) { 
          $font = Font_Metrics::get_font('helvetica', 'normal');
          $size = 9;
          $y = $pdf->get_height() - 24;
          $x = $pdf->get_width() - 15 - Font_Metrics::get_text_width('1/1', $font, $size);
          $pdf->page_text($x, $y, '{PAGE_NUM}/{PAGE_COUNT}', $font, $size);
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