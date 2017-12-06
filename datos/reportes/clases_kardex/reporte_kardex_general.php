<?php
session_start();
require_once '../../conexion/bd_conexion.php';
$busqueda = $_GET['busqueda'];
$dtmFechaInicial = str_replace('/', '-', $_GET['dtmFechaInicial']);
$dtmFechaInicial = date('Y-m-d H:i:s', strtotime($dtmFechaInicial));
$dtmFechaFinal = str_replace('/', '-', $_GET['dtmFechaFinal']);
$dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
$intIdTipoMoneda = $_GET['intIdTipoMoneda'];
 ob_start();
  $sql_conexion = new Conexion_BD();
  $sql_conectar = $sql_conexion->Conectar();
  $sql_comando = $sql_conectar->prepare('CALL BUSCARKardexGeneral_II(:busqueda,:dtmFechaInicial,
    :dtmFechaFinal)');
  $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
  $j = 1;
  ?>
  <!DOCTYPE HTML>
  <html>
  <head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <title>REPORTE KARDEX GENERAL</title>
  </head>

  <style>
    table{
      font-size: 11px !important
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
  <header class="" id="header" style="">
    <img style="width: 100%;" alt="logo resteco azul" src="../../imagenes/header-comprobantes.PNG">
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
      <span style="font-weight: bold; font-size: 16px">REPORTE KARDEX GENERAL</span>
      <br>
      <div style="text-align: left; font-family: Calibri;">
          <span style="font-weight: bold; font-size: 11px">
            Fecha de Inicio: <?php echo $dtmFechaInicial; ?>
          </span>
          <br>
          <span style="font-weight: bold; font-size: 11px">
            Fecha Final: <?php echo $dtmFechaFinal; ?>
          </span>
          
          <br>
          <br>

          <table style="text-align: center; width: 100%;" border="1"
           cellpadding="1" cellspacing="0">
              <thead>
                <tr>
                  <th style="font-family: Calibri; width: 5%"><small>Ítem</small></th>
                  <th style="font-family: Calibri; width: 15%"><small>Fecha</small></th>
                  <th style="font-family: Calibri; width: 15%"><small>Cód Producto</small></th>
                  <th style="font-family: Calibri; "><small>Descripción</small></th>
                  <th style="font-family: Calibri; width: 5%"><small>Entrada</small></th>
                  <th style="font-family: Calibri; width: 5%"><small>Salida</small></th>
                  <th style="font-family: Calibri; width: 5%"><small>Stock</small></th>
                  <th style="font-family: Calibri; width: 10%"><small>Valorizado</small></th>
                </tr>
              </thead>
              <tbody style="font-size: small;">
              <?php 
                while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                {
                  if($fila['CantidadEntradaTotal'] == "" || $fila['CantidadEntradaTotal'] == null) { $fila['CantidadEntradaTotal'] = 0; }
                  if($fila['CantidadSalidaTotal'] == "" || $fila['CantidadSalidaTotal'] == null) { $fila['CantidadSalidaTotal'] = 0; }

                  $nvchSimbolo = "";
                  $dtmFechaCambio =  date('Y-m-d', strtotime($fila['dtmFechaMovimiento']));
                  $sql_conexion_moneda = new Conexion_BD();
                  $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
                  $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDATRIBUTARIAFECHA(:dtmFechaCambio)');
                  $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
                  $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
                  if($intIdTipoMoneda == 1){
                    $nvchSimbolo = "S/.";
                    if($fila['intIdTipoMoneda'] != 1) {
                      $fila["dcmSaldoValorizado"] = number_format($fila["dcmSaldoValorizado"]*$fila_moneda['dcmCambio2'],2,'.','');
                    }
                  } 
                  else if ($intIdTipoMoneda == 2){
                    $nvchSimbolo = "US$";
                    if($fila['intIdTipoMoneda'] != 2){
                      $fila["dcmSaldoValorizado"] = number_format($fila["dcmSaldoValorizado"]/$fila_moneda['dcmCambio2'],2,'.','');
                    }
                  }

                  if(!is_numeric($fila['dcmSaldoValorizado'])){
                    $fila["dcmSaldoValorizado"] = number_format(0.00,2,'.','');
                  }
                  
                  echo 
                  '<tr>
                      <td style="font-family: Calibri;"><small>'.$j.'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["dtmFechaMovimiento"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["nvchCodigo"].'</small></td>
                      <td style="font-family: Calibri; text-align: left; padding: 3px "><small>'.$fila["nvchDescripcion"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["CantidadEntradaTotal"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["CantidadSalidaTotal"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["intCantidadStock"].'</small></td>
                      <td style="font-family: Calibri; text-align: right; padding-right: 3px"><small>'.$nvchSimbolo.' '.$fila["dcmSaldoValorizado"].'</small>
                      </td> 
                  </tr>';
                  $j++;
                }
              ?>
            </tbody>
          </table>
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

  $filename = 'REPORTE KARDEX GENERAL';
  $dompdf = new DOMPDF();
  $html = utf8_decode(ob_get_clean());
  //pdf_create($html,$filename,'A4','landscape');
  pdf_create($html,$filename,'A4','portraid');
?>