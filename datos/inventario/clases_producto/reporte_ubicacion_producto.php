<?php
session_start();
require_once '../../conexion/bd_conexion.php';
$intIdComprobante = $_GET['intIdComprobante'];
ob_start();
  ?>
  <!DOCTYPE HTML>
  <html>
  <head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <title>Reporte de ubigeo de almacén del comprobante</title>
  </head>

  <style>
    *{
      font-size: 10px !important;
    }
    table{
      font-size: 10px !important
    }

    table#tabladetalle {
      border-collapse: collapse;
    }
    table#tablageneral {
      border: 2px solid black;
      border-collapse: collapse;
    }
    tr#primerdetalle>td, tr#cuartodetalle>td, tr#quintodetalle>td, td.celdatotales{
      border: 2px solid black;
    }
    table#tablacontactos {
      border: 2px solid black;
    }
    tr>td{
      padding: 0px;
    }
    tr.segundodetalle>td{
      border-left: 2px solid black;
      border-right: 2px solid black;
    }
    tr.ultimodetalle>td{
      border-bottom: 2px solid black; 
      border-left: 2px solid black;
      border-right: 2px solid black;
    }

    @page { 
      margin: 100px 30px 60px 30px; 
    }
    header { 
      position: fixed; 
      top: -100px; 
      left: 0px; 
      right: 0px; 
      /*background-color: gray; */
      height: 100px; 
    }
    div.content{
      margin-top: 60px;
      margin-bottom: 100px
    }
    footer { 
      position: fixed; 
      bottom: -60px; 
      left: 0px; 
      right: 0px; 
      /*background-color: black;*/ 
      height: 60px; 
    }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
  </style>

  <body>
 
  <!-- INICIO header pdf -->
  <header class="" id="header" style="text-align: center">
    <img style="width: 90%;" alt="logo resteco azul" src="../../imagenes/header-comprobantes.PNG">
  </header>
  <!-- END header pdf -->


  <div style="text-align: center;">
    <div id="header">
      <div style="text-align: right;">
          <span style="font-weight: bold; font-family: Calibri; font-size: 11px">
            Fecha Generada: <?php echo date("Y-m-d H:i:s"); ?>
          </span>
          <br>
          <span style="font-weight: bold; font-family: Calibri; font-size: 11px">
            Generado por: <?php echo $_SESSION['NombresApellidos']; ?>
          </span>
      </div>
    </div>
  
  <br>
  <div class="cuerpo">
      <span style="font-weight: bold; font-size: 16px !important; text-transform: uppercase;">reporte ubigeo de productos</span>
      <br>
      <div style="text-align: left; font-family: Calibri;">


          <br>

          <table style="text-align: center; width: 100%;" border="1"
           cellpadding="1" cellspacing="0">
              <thead>
                <tr style="text-transform: uppercase;">
                  <th style="font-family: Calibri; width: 7%"><small>Ítem</small></th>
                  <th style="font-family: Calibri; width: 15%"><small>Código</small></th>
                  <th style="font-family: Calibri; "><small>Descripción</small></th>
                  <th style="font-family: Calibri; "><small>Ubic. Huancayo</small></th>
                  <th style="font-family: Calibri; width: 10%"><small>CANT.</small></th>
                  <th style="font-family: Calibri; "><small>Ubic. San Jeronimo</small></th>
                  <th style="font-family: Calibri; width: 50px"><small>CANT.</small></th>
                </tr>
              </thead>
              <tbody style="font-size: small;">
              <?php
                $sql_conexion = new Conexion_BD();
                $sql_conectar = $sql_conexion->Conectar();
                $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleComprobante(:intIdComprobante)');
                $sql_comando -> execute(array(':intIdComprobante' => $intIdComprobante));
                $j = 1;
                while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                { 
                  $sql_conexion_ubigeo = new Conexion_BD();
                  $sql_conectar_ubigeo = $sql_conexion_ubigeo->Conectar();
                  $sql_comando_ubigeo = $sql_conectar_ubigeo->prepare('CALL BUSCARUBIGEOPRODUCTO_III(:intIdProducto)');
                  $sql_comando_ubigeo -> execute(array(':intIdProducto' => $fila['intIdProducto']));
                  $fila_ub = $sql_comando_ubigeo -> fetch(PDO::FETCH_ASSOC);
                  echo 
                  '<tr>
                      <td style="font-family: Calibri;"><small>'.$j.'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["nvchCodigo"].'</small></td>
                      <td style="font-family: Calibri; text-align: left; padding-left: 5px"><small>'.$fila["nvchDescripcion"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila_ub["UbicacionHuancayo"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila_ub["CantidadHuancayo"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila_ub["UbicacionSanJeronimo"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila_ub["CantidadSanJeronimo"].'</small></td>  
                  </tr>';
                  $j++;
                }
              ?>
            </tbody>
          </table>
          <br>
          <div style="text-align: right;"><small></small></div>
      </div>
  </div>
</div>

    <footer>
      <!--img style="width: 100%; " alt="" src="../../imagenes/footer-comprobantes.PNG"-->
      <!--img style="height: 40px " alt="" src="../../imagenes/footer-comprobantes.PNG"-->

      <!-- INICIO - Paginador footer -->
      <span style="background-color: gray">
          <script type='text/php'>
            if ( isset($pdf) ) { 
              $font = Font_Metrics::get_font('helvetica', 'normal');
              $size = 9;
              $y = $pdf->get_height() - 24;
              $x = $pdf->get_width() - 15 - Font_Metrics::get_text_width('1/1', $font, $size);
              $pdf->page_text($x, $y, '{PAGE_NUM}/{PAGE_COUNT}', $font, $size);
            } 
          </script>
      </span>
      <!--script type='text/php'>
        if ( isset($pdf) ) { 
          $font = Font_Metrics::get_font('helvetica', 'normal');
          $size = 9;
          $y = $pdf->get_height() - 24;
          $x = $pdf->get_width() - 30 - Font_Metrics::get_text_width('1/1', $font, $size);
          $pdf->page_text($x, $y, 'pag {PAGE_NUM}/{PAGE_COUNT}', $font, $size);
        } 
      </script-->
      <!-- END - paginador footer -->

    </footer>

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
    //$dompdf->stream($filename.".pdf");
    
    //$dompdf->stream($filename.".pdf"); //descargar automaticamente
    $dompdf->stream($filename.".pdf", array("Attachment" => false)); //previsualizar

  }

  $filename = 'Reporte_Ubigeo_Comprobante';
  $dompdf = new DOMPDF();
  $html = utf8_decode(ob_get_clean());
  //pdf_create($html,$filename,'A4','landscape');
  pdf_create($html,$filename,'A4','portraid');
?>