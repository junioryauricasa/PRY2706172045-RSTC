<?php
  session_start();
  require_once '../../conexion/bd_conexion.php';

  $year = date('Y') ;

  $intIdOrdenCompra = $_GET['intIdOrdenCompra'];
  ob_start();
  $sql_conexion = new Conexion_BD();
  $sql_conectar = $sql_conexion->Conectar();
  $sql_comando = $sql_conectar->prepare('CALL MostrarOrdenCompra(:intIdOrdenCompra)');
  $sql_comando -> execute(array(':intIdOrdenCompra' => $intIdOrdenCompra));
  $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

  $nvchSerie = $fila['nvchSerie'];
  $nvchNumeracion = $fila['nvchNumeracion'];
  $nvchAtencion = $fila['nvchAtencion'];
  $nvchRazonSocial = $fila['nvchRazonSocial'];
  $nvchRUC = $fila['nvchRUC'];
  $nvchNombreDe = $fila['nvchNombreDe'];
  $NombreUsuario = $fila['NombreUsuario'];
  $SimboloMoneda = $fila['SimboloMoneda'];
  $NombrePago = $fila['NombrePago'];

  $dtmFechaCreacion = $fila['dtmFechaCreacion'];
  $nvchObservacion = $fila['nvchObservacion'];
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type"
 content="text/html; charset=utf-8">
  <title style="text-transform: uppercase;">REPORTE ORDEN DE COMPRA</title>
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
            ORDEN DE COMPRA  Nº RSA-RSA-<?php echo $nvchSerie.'-'.$nvchNumeracion; ?>/<?php echo $year; ?>
        </span>
    </center>
<br>

<center style="text-align: left"><span style="font-weight: bold; font-family: Arial;">DATOS PROVEEDOR:</span></center>

<table id="tablageneral" style="text-align: left; width: 100%; padding-top: 5px" cellpadding="1" cellspacing="1">
  <tbody>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 71px; padding-left: 5px"><small><small>Razón Social</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 220px;"><small><?php echo $nvchRazonSocial; ?></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small>Forma de Pago</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 230px;"><small><?php echo $NombrePago; ?></small></td>
    </tr>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 71px;padding-left: 5px"><small><small>RUC</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 220px;"><small><?php echo $nvchRUC; ?></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small>Moneda</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 230px;"><small><?php echo $SimboloMoneda; ?></small></td>
    </tr>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 71px;padding-left: 5px"><small><small>Atención</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 220px;"><small><?php echo $nvchAtencion; ?></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small></small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small></small></small></td>
      <td style="width: 230px;"><small></small></td>
    </tr>
  </tbody>
</table>

<center style="text-align: left; padding-top: 5px"><span style="font-weight: bold; font-family: Arial;">DATOS DE ENTREGA:</span></center>
<table id="tablageneral" style="text-align: left; width: 100%;" cellpadding="1" cellspacing="1">
  <tbody>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 20% !important; padding-left: 5px"><small><small>A nombre de:</small></small></td>
      <td style="font-family: Arial; width: 80% !important;"><small><small>: <?php echo $nvchNombreDe; ?></small></small></td>
    </tr>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 20% !important; padding-left: 5px"><small><small>Con Atención</small></small></td>
      <td style="font-family: Arial; width: 80% !important;"><small><small>:</small></small></td>
    </tr>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 20% !important;;padding-left: 5px"><small><small>Dirección de entrega</small></small></td>
      <td style="font-family: Arial; width: 80% !important;"><small><small>:</small></small></td>
    </tr>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 20% !important;padding-left: 5px; padding-bottom: 20px"><small><small>Observación</small></small></td>
      <td style="font-family: Arial; width: 80% !important; padding-bottom: 20px"><small><small>: <?php echo $nvchObservacion; ?></small></small></td>
    </tr>
  </tbody>
</table>

<br>
<table id="tabladetalle" style="text-align: left; width: 100% !important; height: 100px;" cellpadding="3" cellspacing="1">
  <tbody>
    <tr id="primerdetalle">
        <td style="font-weight: bold; font-family: Arial; text-align: center; width: 7% !important;">
          <small>
            <small>
              ÍTEM
            </small>
        </small>
        </td>
        <td style="font-weight: bold; font-family: Arial; text-align: center; width: 15% !important;">
            <small>
            <small>
              CÓDIGO
            </small>
            </small>
        </td>
        <td style="font-weight: bold; font-family: Arial; text-align: center; width: 45% !important;">
            <small>
              <small>
                DESCRIPCIÓN
              </small>
            </small>
        </td>
        <td style="font-weight: bold; font-family: Arial; text-align: center; width: 10% !important;">
            <small>
              <small>
                CANT.
              </small>
            </small>
        </td> 
        <td style="font-weight: bold; font-family: Arial; text-align: center; width: 10% !important;">
            <small>
              <small>
                P.UNIT
              </small>
            </small>
        </td>
        <td style="font-weight: bold; font-family: Arial; text-align: center; width: 13% !important;">
            <small>
              <small>
                P.TOTAL
              </small>
            </small>
        </td>
    </tr>
    <?php
      $ValorOrdenCompra = 0.00;
      $IGVOrdenCompra = 0.00;
      $TotalOrdenCompra = 0.00;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleOrdenCompra(:intIdOrdenCompra)');
      $sql_comando -> execute(array(':intIdOrdenCompra' => $intIdOrdenCompra));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $TotalOrdenCompra += $fila['dcmTotal'];
    ?>
    <tr class="segundodetalle" style="text-align: center; border-bottom: 0px solid">
      <td style="width: 7% !important; font-size:x-small;"><?php echo $i; ?></td>
      <td style="width: 15% !important; font-size:x-small;"><?php echo $fila['nvchCodigo']; ?></td>
      <td style="width: 45% !important; font-size:x-small; text-align: left"><?php echo $fila['nvchDescripcion']; ?></td>
      <td style="width: 10% !important; font-size:x-small;"><?php echo $fila['intCantidad']; ?></td>
      <td style="width: 10% !important; font-size:x-small;"><?php echo $SimboloMoneda.' '.$fila['dcmPrecio']; ?></td>
      <td style="width: 13% !important; font-size:x-small;"><?php echo $SimboloMoneda.' '.$fila['dcmTotal']; ?></td>
    </tr>
    <?php
        $i++;
      }
      for($j = $i ; $j <= 30; $j++){
        if($j == 30) {
          echo '<tr class="ultimodetalle" style="text-align: center; color:white;">';
        } else {
          echo '<tr class="segundodetalle" style="text-align: center; color:white;">';
        }
    ?>
      <td style="width: 7% !important; font-size:x-small;">|</td>
      <td style="width: 15% !important; font-size:x-small;">|</td>
      <td style="width: 45% !important; font-size:x-small;">|</td>
      <td style="width: 10% !important; font-size:x-small;">|</td>
      <td style="width: 10% !important; font-size:x-small;">|</td>
      <td style="width: 13% !important; font-size:x-small;">|</td>
    </tr>
    <?php
      }
      $ValorOrdenCompra = number_format($TotalOrdenCompra/1.18,2,'.','');
      $IGVOrdenCompra = $TotalOrdenCompra - $ValorOrdenCompra;
    ?>
    <tr>
      <td style="width: 7% !important; font-size:x-small;"></td>
      <td style="width: 15% !important; font-size:x-small;"></td>
      <td style="width: 45% !important; font-size:x-small;"></td>
      <td style="width: 10% !important; font-size:x-small;"></td>
      <td style="width: 10% !important; text-align: center; border: solid 2px black">
          <small>
            <small>
              TOTAL
            </small>
          </small>
      </td>
      <td class="celdatotales" style="text-align: center; width: 13% !important;">
          <small>
              <small>
                <?php echo $SimboloMoneda.' '.round($TotalOrdenCompra,2); ?>       
              </small>
          </small>
      </td>
    </tr>
  </tbody>
</table>
<br>
<table id="tablacontactos" style="width: 100%;">
  <tbody>
    <tr style="font-family: Arial; font-weight: bold;">
      <td style="width: 100% !important; text-align: center !important;" colspan="7">
          <small style="">
            SOLICITADO POR
          </small>
      </td>
      <td style=""></td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important" colspan="3">
        <small>
          <small>
              NOMBRES Y APELLIDOS
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
      <td style="font-family: Arial; font-weight: bold; width: 30% !important; padding-bottom: 20px" colspan="3">
        <small>
            <small>
              FIRMA
            </small>
        </small>
      </td>
      <td style="font-family: Arial; width: 70% !important; padding-bottom: 20px">
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
  $filename = 'REPORTE_ORDEN_DE_COMPRA';
  $dompdf = new DOMPDF();
  $html = ob_get_clean();
  pdf_create($html,$filename,'A4','portrait');

?>