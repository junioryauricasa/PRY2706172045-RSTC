<?php
session_start();
require_once '../../conexion/bd_conexion.php';
$busqueda = $_GET['busqueda'];
$intIdTipoComprobante = $_GET['intIdTipoComprobante'];
$intIdTipoMoneda = $_GET['intIdTipoMoneda'];
$intTipoDetalle = $_GET['intTipoDetalle'];
$dtmFechaInicial = $_GET['dtmFechaInicial'];
$dtmFechaFinal = $_GET['dtmFechaFinal'];

$lblPersonaSingular = $_GET['lblPersonaSingular'];
$lblTituloSingular = $_GET['lblTituloSingular'];
$lblTituloPlural = $_GET['lblTituloPlural'];

$dtmFechaInicial = str_replace('/', '-', $dtmFechaInicial);
$dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
$dtmFechaFinal = str_replace('/', '-', $dtmFechaFinal);
$dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));

$nvchSimbolo = "";

if($intIdTipoMoneda == 1)
  $nvchSimbolo = "S/.";
else
  $nvchSimbolo = "US$";

ob_start();
$sql_conexion = new Conexion_BD();
$sql_conectar = $sql_conexion->Conectar();
$sql_comando = $sql_conectar->prepare('CALL BUSCARCOMPROBANTE_II(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal,:intTipoDetalle)');
$sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal, ':intTipoDetalle' => $intTipoDetalle));
  $j = 1;
  ?>
  <!DOCTYPE HTML>
  <html>
  <head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <title>Reporte de <?php echo $lblTituloPlural; ?> PDF</title>
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
            Fecha Generada: <?php echo date("d/m/Y H:i:s"); ?>
          </span>
          <br>
          <span style="font-weight: bold; font-family: Calibri; font-size: 11px">
            Generado por: <?php echo $_SESSION['NombresApellidos']; ?>
          </span>
      </div>
    </div>
  
  <br>
  <div class="cuerpo">
      <span style="font-weight: bold; font-size: 16px">REPORTE DE COMPROBANTES DE <?php echo strtoupper($lblTituloPlural); ?></span>
      <br>
      <div style="text-align: left; font-family: Calibri;">
          <br>
          <?php
          $nClienteProveedor;
          if($intTipoDetalle == 1)
            $nClienteProveedor = 'Cliente';
          else if($intTipoDetalle == 2)
            $nClienteProveedor = 'Proveedor'; 
          ?>
          <table style="text-align: center; width: 100%;" border="1"
           cellpadding="1" cellspacing="0">
              <thead>
                <tr>
                  <th style="font-family: Calibri; width: 3%;"><small>Ítem</small></th>
                  <th style="font-family: Calibri; width: 2%;"><small>Serie</small></th>
                  <th style="font-family: Calibri; width: 4%;"><small>Numeración</small></th>
                  <th style="font-family: Calibri; width: 9%;"><small>Tipo de Comprob.</small></th>
                  <th style="font-family: Calibri; width: 10%;"><small>Nombre del <?php echo $nClienteProveedor; ?></small></th>
                  <th style="font-family: Calibri; width: 10%;"><small>Generado Por</small></th>
                  <th style="font-family: Calibri; width: 7%;"><small>Fecha.</small></th>
                  <th style="font-family: Calibri; width: 8%;"><small>Valor de <?php echo $lblTituloSingular; ?></small></th>
                  <th style="font-family: Calibri; width: 7%;"><small>IGV</small></th>
                  <th style="font-family: Calibri; width: 8%;"><small><?php echo $lblTituloSingular; ?> Total</small></th>
                </tr>
              </thead>
              <tbody style="font-size: small;">
              <?php
                $SumTotalComprobante = 0.00;
                while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                { 
                  $ClienteProveedor;
                  $ValorComprobante; $IGVComprobante; $TotalComprobante;
                  $dtmFechaCambio =  date('Y-m-d', strtotime($fila['dtmFechaCreacion']));
                  $sql_conexion_moneda = new Conexion_BD();
                  $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
                  $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDACOMERCIALFECHA(:dtmFechaCambio)');
                  $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
                  $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
                  if($intIdTipoMoneda == 1){
                    if($fila['intIdTipoMoneda'] != 1) {
                      $fila['TotalComprobante'] = number_format($fila['TotalComprobante']*$fila_moneda['dcmCambio2'],2,'.','');
                      $fila['IGVComprobante'] = number_format($fila['IGVComprobante']*$fila_moneda['dcmCambio2'],2,'.',''); 
                      $fila['ValorComprobante'] = number_format($fila['ValorComprobante']*$fila_moneda['dcmCambio2'],2,'.',''); 
                      $fila['SimboloMoneda'] = "S/.";
                    }
                  } 
                  else if ($intIdTipoMoneda == 2){
                    if($fila['intIdTipoMoneda'] != 2){
                      $fila['TotalComprobante'] = number_format($fila['TotalComprobante']/$fila_moneda['dcmCambio2'],2,'.','');
                      $fila['IGVComprobante'] = number_format($fila['IGVComprobante']/$fila_moneda['dcmCambio2'],2,'.','');
                      $fila['ValorComprobante'] = number_format($fila['ValorComprobante']/$fila_moneda['dcmCambio2'],2,'.','');
                      $fila['SimboloMoneda'] = "US$";
                    }
                  }
                  if($intTipoDetalle == 1)
                    $ClienteProveedor = $fila["NombreCliente"];
                  else if($intTipoDetalle == 2)
                    $ClienteProveedor = $fila["NombreProveedor"];
                  if($fila['intIdTipoComprobante'] != 3 && $fila['intIdTipoComprobante'] != 7){
                    $ValorComprobante = $fila["SimboloMoneda"].' '.number_format($fila["ValorComprobante"],2,'.',',');
                    $IGVComprobante = $fila["SimboloMoneda"].' '.number_format($fila["IGVComprobante"],2,'.',',');
                    $TotalComprobante = $fila["SimboloMoneda"].' '.number_format($fila["TotalComprobante"],2,'.',',');
                  }
                  else {
                    $ValorComprobante = "-";
                    $IGVComprobante = "-";
                    $TotalComprobante = "-";
                  }

                  echo 
                  '<tr>
                      <td style="font-family: Calibri;"><small>'.$j.'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["nvchSerie"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["nvchNumeracion"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["NombreComprobante"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$ClienteProveedor.'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["NombreUsuario"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.date('d/m/Y H:i:s', strtotime($fila['dtmFechaCreacion'])).'</small></td>
                      <td style="font-family: Calibri; text-align: right; padding-right: 2px;"><small>'.$ValorComprobante.'</small></td>
                      <td style="font-family: Calibri; text-align: right; padding-right: 2px;"><small>'.$IGVComprobante.'</small></td>
                      <td style="font-family: Calibri; text-align: right; padding-right: 2px;"><small>'.$TotalComprobante.'</small></td>
                  </tr>';
                  $SumTotalComprobante += $fila["TotalComprobante"];
                  $j++;
                }
              ?>
            </tbody>
          </table>
          <div style="text-align: right; padding-top: 4px"><small>Total <?php echo $lblTituloSingular; ?>: <?php echo $nvchSimbolo.' '.number_format($SumTotalComprobante,2,'.',','); ?></small></div>
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

  $filename = 'Reporte'.$lblTituloSingular.'-'.date('d-m-Y_h:i:s').'_'.$busqueda;
  $dompdf = new DOMPDF();
  $html = utf8_decode(ob_get_clean());
  //pdf_create($html,$filename,'A4','landscape');
  pdf_create($html,$filename,'A4','landscape');
?>