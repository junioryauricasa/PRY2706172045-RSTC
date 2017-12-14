<?php
session_start();
require_once '../../conexion/bd_conexion.php';
$busqueda = $_GET['busqueda'];
$intIdProducto = $_GET['intIdProducto'];
$dtmFechaInicial = str_replace('/', '-', $_GET['dtmFechaInicial']);
$dtmFechaInicial = date('Y-m-d H:i:s', strtotime($dtmFechaInicial));
$dtmFechaFinal = str_replace('/', '-', $_GET['dtmFechaFinal']);
$dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
$intIdTipoMoneda = $_GET['intIdTipoMoneda'];
$intIdSucursal = $_GET['intIdSucursal'];
 ob_start();
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MOSTRARPRODUCTO(:intIdProducto)');
      $sql_comando -> execute(array(':intIdProducto' => $intIdProducto));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $nvchCodigo = $fila['nvchCodigo'];

      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL KardexProducto_II(:intIdProducto,:intIdTipoMoneda,:intIdSucursal)');
      $sql_comando -> execute(array(':intIdProducto' => $intIdProducto,':intIdTipoMoneda' => $intIdTipoMoneda,':intIdSucursal' => $intIdSucursal));
      $j = 1;
      if($intIdTipoMoneda == 1)
        $nvchSimbolo = "S/.";
      else if($intIdTipoMoneda == 2)
        $nvchSimbolo = "US$";

      if($dtmFechaInicial = "1969-12-31 19:00:00")
        $dtmFechaInicial = "-";
  ?>
  <!DOCTYPE HTML>
  <html>
  <head>
    <meta content="text/html; charset=ISO-8859-1"
   http-equiv="content-type">
    <title>REPORTE KARDEX PRODUCTO</title>

  <style>
    table, th, tr>td{
      border: solid 1px black;
      font-size: 11px
    }

    table#tabladetalle {
      border-collapse: collapse;
    }
    table#tablageneral {
      border: 2px solid black;
      border-collapse: collapse;
    }
    tr#primerdetalle>td, tr#cuartodetalle>td, tr#quintodetalle>td, td.celdatotales{
      border: 1px solid black;
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
    <img style="width: 100%;" alt="logo resteco azul" src="../../imagenes/header-kardex.PNG">
  </header>
  <!-- END header pdf -->

  <div style="text-align: center; margin-top: -30px">
  <div style="text-align: left;"><big
   style="font-family: Calibri;"><big><span
   style="font-weight: bold;"></span></big></big>
  <br style="font-family: Calibri;">
  <div style="text-align: right;">
      <span style="font-weight: bold; font-family: Calibri; font-size: 11px"><br>Fecha Generada:</span>
      <span style="font-family: Calibri; font-size: 11px"><?php echo date("Y-m-d H:i:s"); ?></span>
      <br style="font-family: Calibri;">
      <span style="font-weight: bold; font-family: Calibri; font-size: 11px">Generado por:</span>
      <span style="font-family: Calibri; font-size: 11px"><?php echo $_SESSION['NombresApellidos']; ?><br><br></span></div>
      <big style="font-family: Calibri;"><big><span style="font-weight: bold;"></span></big></big></div>
      <big style="font-family: Calibri;">
        <big>
          <span style="font-weight: bold; font-size: 14px">
          REPORTE KARDEX DEL PRODUCTO
          <?php echo $nvchCodigo; ?>
          </span>
        </big>
      </big>
  <div style="text-align: left; font-family: Calibri;">
    <span style="font-weight: bold; font-size: 11px">Fecha de Inicio:</span>
    <span style="font-size: 11px"><?php echo $dtmFechaInicial; ?></span>
    <br>
    <span style="font-weight: bold;; font-size: 11px">Fecha Final:</span>
    <span style="font-size: 11px"><?php echo $dtmFechaFinal; ?></span><br>
  
  <!--table style="text-align: center; width: 100%;" border="1"
   cellpadding="1" cellspacing="0"-->
  <table style="text-align: center; width: 100%;" border="1" cellpadding="1" cellspacing="0">
    <thead>
      <tr>
        <th style="font-family: Calibri;"><small>Ítem</small></th>
        <th style="font-family: Calibri;"><small>Fecha</small></th>
        <th style="font-family: Calibri;"><small>Movimiento</small></th>
        <th style="font-family: Calibri;"><small>Comprobante</small></th>
        <th style="font-family: Calibri;"><small>Serie</small></th>
        <th style="font-family: Calibri;"><small>Numeración</small></th>
        <!--<th style="font-family: Calibri;"><small>Ubicacion</small></th>-->
        <th style="font-family: Calibri;"><small>Cant. Entrada</small></th>
        <th style="font-family: Calibri;"><small>Cant. Salida</small></th>
        <th style="font-family: Calibri;"><small>Stock</small></th>
        <th style="font-family: Calibri;"><small>Precio Entrada</small></th>
        <th style="font-family: Calibri;"><small>Total Entrada</small></th>
        <th style="font-family: Calibri;"><small>Precio Salida</small></th>
        <th style="font-family: Calibri;"><small>Total Salida</small></th>
        <th style="font-family: Calibri;"><small>Saldo Valorizado</small></th>
      </tr>
    </thead>
    <tbody style="font-size: small;">
    <?php 
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo 
        '
        <tr>
          <!--td class="heading" data-th="ID"></td-->
          <td style="font-family: Calibri;"><small>'.$j.'</small></td>
          <td style="font-family: Calibri;"><small>'.$fila["FechaMovimiento"].'</small></td>
          <td style="font-family: Calibri;"><small>'.$fila["TipoMovimiento"].'</small></td>
          <td style="font-family: Calibri;"><small>'.$fila["TipoComprobante"].'</small></td>
          <td style="font-family: Calibri;"><small>'.$fila["Serie"].'</small></td>
          <td style="font-family: Calibri;"><small>'.$fila["Numeracion"].'</small></td>
          <td style="font-family: Calibri;"><small>'.$fila["Entrada"].'</small></td>
          <td style="font-family: Calibri;"><small>'.$fila["Salida"].'</small></td>
          <td style="font-family: Calibri;"><small>'.$fila["Stock"].'</small></td>
          <td style="font-family: Calibri;"><small>'.$nvchSimbolo.' '.$fila["PrecioEntrada"].'</small></td>
          <td style="font-family: Calibri;"><small>'.$nvchSimbolo.' '.$fila["TotalEntrada"].'</small></td>
          <td style="font-family: Calibri;"><small>'.$nvchSimbolo.' '.$fila["PrecioSalida"].'</small></td>
          <td style="font-family: Calibri;"><small>'.$nvchSimbolo.' '.$fila["TotalSalida"].'</small></td>
          <td style="font-family: Calibri;"><small>'.$nvchSimbolo.' '.$fila["SaldoValorizado"].'</small></td> 
        </tr>';
        $j++;
      }
    ?>
  </tbody>
</table>
<br>
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
    $dompdf->stream($filename.".pdf", array("Attachment" => false)); //previsualizar
  }
  $filename = 'Reporte_Kardex_Producto_'.$nvchCodigo;
  $dompdf = new DOMPDF();
  $html = utf8_decode(ob_get_clean());
  pdf_create($html,$filename,'A4','landscape');
?>