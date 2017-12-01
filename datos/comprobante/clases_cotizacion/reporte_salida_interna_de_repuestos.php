<?php
  session_start();
  require_once '../../conexion/bd_conexion.php';

  $year = date('Y') ;

  $intIdCotizacion = $_GET['intIdCotizacion'];
  ob_start();
  $sql_conexion = new Conexion_BD();
  $sql_conectar = $sql_conexion->Conectar();
  $sql_comando = $sql_conectar->prepare('CALL MostrarCotizacion(:intIdCotizacion)');
  $sql_comando -> execute(array(':intIdCotizacion' => $intIdCotizacion));
  $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

  $nvchSerie = $fila['nvchSerie'];
  $nvchNumeracion = $fila['nvchNumeracion'];
  $nvchAtencion = $fila['nvchAtencion'];
  $intDiasValidez = $fila['intDiasValidez'];
  $nvchTipo = $fila['nvchTipo'];
  $nvchModelo = $fila['nvchModelo'];
  $nvchMarca = $fila['nvchMarca'];
  $nvchHorometro = $fila['nvchHorometro'];
  
  $NombreUsuario = $fila['NombreUsuario'];
  $NombreCliente = $fila['NombreCliente'];
  $DNICliente = $fila['DNICliente'];
  $RUCCliente = $fila['RUCCliente'];
  $SimboloMoneda = $fila['SimboloMoneda'];
  $NombrePago = $fila['NombrePago'];
  $NombreVenta = $fila['NombreVenta'];

  $dtmFechaCreacion = $fila['dtmFechaCreacion'];
  $nvchObservacion = $fila['nvchObservacion'];
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type"
 content="text/html; charset=utf-8">
  <title>SALIDA INTERNA DE REPUESTOS</title>
  <script src="//use.edgefonts.net/brush-script-std.js"></script>

  <style>

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
  
</head>
<body>

    <!-- INICIO header pdf -->
    <header class="" id="header" style="">
      <img style="width: 100%;" alt="logo resteco azul" src="../../imagenes/header-comprobantes.PNG">
    </header>
    <!-- END header pdf -->

    <div class="container">

    <center>
        <span style="font-weight: bold; font-family: Arial;">
          SALIDA INTERNA DE REPUESTOS Nº RSA-0000001<?php //echo $nvchSerie.'-'.$nvchNumeracion; ?>/<?php echo $year; ?>
        </span>
    </center>
<br>

<small>
    <span style="font-weight: bold; font-family: Arial; text-align: left">
      DATOS DEL CLIENTE:
    </span>
</small>

<table id="tablageneral" style="text-align: left; width: 100% !important; padding-top: 10px" cellpadding="1" cellspacing="1">
  <tbody style="">
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important; padding-left: 5px"><small><small>Cliente</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small>: <?php //echo $; ?></small></small></td>

      <td style="font-weight: bold; font-family: Arial; width: 15% !important"><small><small>N° RUC / DNI</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small>: <?php //echo $; ?></small></small></td>
    </tr>

    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important; padding-left: 5px"><small><small>Atención</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small>: <?php //echo $; ?></small></small></td>

      <td style="font-weight: bold; font-family: Arial; width: 15% !important;"><small><small>Destino</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small><small>: <?php //echo $; ?></small></small></td>
    </tr>

    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important; padding-left: 5px"><small><small>Dirección</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small>: </small></small></td>

      <td style="font-weight: bold; font-family: Arial; width: 15% !important;"><small><small>Vendedor(a)</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small><small>: <?php //echo $; ?></small></small></td>
    </tr>

    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important; padding-left: 5px"><small><small>Solicitado por</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small>: <?php //echo $; ?></small></small></td>

      <td style="font-weight: bold; font-family: Arial; width: 15% !important;"><small><small></small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small><small></small></small></td>
    </tr>

    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important;padding-left: 5px; padding-bottom: 30px"><small><small>Observación</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%; padding-bottom: 30px"><small><small>: </small></small></td>

      <td style="font-weight: bold; font-family: Arial; width: 15% !important"><small><small></small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small></small></small></td>
    </tr>
  </tbody>
</table>

<br>
<table id="tabladetalle" style="text-align: left; width: 100%; height: 100px;" cellpadding="3" cellspacing="1">
  <tbody>
    <tr id="primerdetalle">
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 7% !important;"><small><small>ÍTEM</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 7% !important;"><small><small>CANT.</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 20% !important;"><small><small>CÓDIGO</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 66% !important;"><small><small>DESCRIPCIÓN</small></small></td>
    </tr>
    <?php
      $ValorCotizacion = 0.00;
      $IGVCotizacion = 0.00;
      $TotalCotizacion = 0.00;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleCotizacion(:intIdCotizacion)');
      $sql_comando -> execute(array(':intIdCotizacion' => $intIdCotizacion));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $TotalCotizacion += $fila['dcmTotal'];
    ?>
    <tr class="segundodetalle" style="text-align: center; border-bottom: 0px solid">
      <td style="width: 7% !important; font-size:x-small;"><?php echo $i; ?></td>
      <td style="width: 7% !important; font-size:x-small;"><?php //echo $fila['']; ?></td>
      <td style="width: 20% !important; font-size:x-small;"><?php //echo $fila['']; ?></td>
      <td style="width: 66% !important; font-size:x-small; text-align: left"><?php //echo $fila['']; ?></td>
    </tr>
    <?php
        $i++;
      }
      for($j = $i ; $j <= 20; $j++){
        if($j == 20) {
          echo '<tr class="ultimodetalle" style="text-align: center; color:white;">';
        } else {
          echo '<tr class="segundodetalle" style="text-align: center; color:white;">';
        }
    ?>
      <td style="width: 7% !important; font-size:x-small;">|</td>
      <td style="width: 7% !important; font-size:x-small;">|</td>
      <td style="width: 20% !important; font-size:x-small;">|</td>
      <td style="width: 66% !important; font-size:x-small;">|</td>
    </tr>
    <?php
      }
      $ValorCotizacion = number_format($TotalCotizacion/1.18,2,'.','');
      $IGVCotizacion = $TotalCotizacion - $ValorCotizacion;
    ?>
    
    <!--tr id="cuartodetalle">
      <td colspan="2" style="font-weight: bold; text-align: right; font-family: Arial; width: 50px;">
        <small><small>IGV 18%</small></small>
      </td-->
      <!--td style="width: 86px; text-align: center;">
        <small><small>
          <?php echo $SimboloMoneda.' '.$IGVCotizacion; ?>    
        </small></small>
      </td>
    </tr-->
    <!--tr id="quintodetalle">
      <td colspan="2" style="font-weight: bold; text-align: right; font-family: Arial; width: 50px;">
        <small><small>TOTAL</small></small>
      </td>
      <td style="width: 86px; text-align: center;">
        <small><small>
          <?php echo $SimboloMoneda.' '.$TotalCotizacion; ?>    
        </small></small>
      </td>
    </tr-->
  </tbody>
</table>
<br>  

<style>
    * {
        box-sizing: border-box;
    }
    .row::after {
        content: "";
        clear: both;
        display: table;
    }
    [class*="col-"] {
        float: left;
    }
    .col-1 {width: 8.33%;}
    .col-2 {width: 16.66%;}
    .col-3 {width: 25%;}
    .col-4 {width: 33.33%;}
    .col-5 {width: 41.66%;}
    .col-6 {width: 50%;}
    .col-7 {width: 58.33%;}
    .col-8 {width: 66.66%;}
    .col-9 {width: 75%;}
    .col-10 {width: 83.33%;}
    .col-11 {width: 91.66%;}
    .col-12 {width: 100%;}


    .centered {text-align:center}
    .fixed-bottom {position:fixed;bottom:55px;width:100%;}
</style>

<div class="row">
<div class="col-6">
 <table id="tablacontactos" style="width: 100%; padding: 5px; margin-right: 5px">
  <tbody>
    <tr style="font-family: Arial; font-weight: bold;">
      <td style="width: 100% !important; text-align: center !important;" colspan="7">
          <small style="">
            ENTREGADO POR
          </small>
      </td>
      <td style=""></td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important" colspan="3">
        <small>
          <small>
              NOMBRES
          </small>
        </small>
      </td>
      <td style="font-family: Arial; font-weight: bold; width: 70% !important" colspan="3">
        <small>
          <small>
              :           
          </small>
        </small>
      </td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important" colspan="3">
        <small>
          <small>
            DNI
          </small>
        </small>
      </td>
      <td style="font-family: Arial; width: 70% !important">
        <small>
          <small>
             :
          </small>
        </small>
      </td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important; padding-bottom: 40px" colspan="3">
        <small>
            <small>
              FIRMA
            </small>
        </small>
      </td>
      <td style="font-family: Arial; width: 70% !important; padding-bottom: 40px">
        <small>
          <small>
              :
          </small>
        </small>
      </td>
    </tr>
  </tbody>
 </table> 
</div>
<div class="col-6">
<table id="tablacontactos" style="width: 100%; padding: 5px; margin-left: 5px">
  <tbody>
    <tr style="font-family: Arial; font-weight: bold;">
      <td style="width: 100% !important; text-align: center !important;" colspan="7">
          <small style="">
            RECEPCIONADO POR
          </small>
      </td>
      <td style=""></td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important" colspan="3">
        <small>
          <small>
              NOMBRES
          </small>
        </small>
      </td>
      <td style="font-family: Arial; font-weight: bold; width: 70% !important" colspan="3">
        <small>
          <small>
              :           
          </small>
        </small>
      </td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important" colspan="3">
        <small>
          <small>
            DNI
          </small>
        </small>
      </td>
      <td style="font-family: Arial; width: 70% !important">
        <small>
          <small>
             :
          </small>
        </small>
      </td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important; padding-bottom: 40px" colspan="3">
        <small>
            <small>
              FIRMA
            </small>
        </small>
      </td>
      <td style="font-family: Arial; width: 70% !important; padding-bottom: 40px">
        <small>
          <small>
              :
          </small>
        </small>
      </td>
    </tr>
  </tbody>
</table>  
</div>
</div>

    </div>

    <footer>
      <img style="width: 100%; " alt="" src="../../imagenes/footer-comprobantes.PNG">
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
    //$dompdf->stream($filename.".pdf"); //descargar automaticamente
    $dompdf->stream($filename.".pdf", array("Attachment" => false)); //previsualizar
  }
  $filename = 'SALIDA_INTERNA_DE_REPUESTOS';
  $dompdf = new DOMPDF();
  $html = ob_get_clean();
  pdf_create($html,$filename,'A4','portrait');

?>