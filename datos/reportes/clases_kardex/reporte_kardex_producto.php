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
 ob_start();
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MOSTRARPRODUCTO(:intIdProducto)');
      $sql_comando -> execute(array(':intIdProducto' => $intIdProducto));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $nvchCodigo = $fila['nvchCodigo'];

      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL BUSCARKARDEXPRODUCTO_II(:busqueda,:intIdProducto,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdProducto' => $intIdProducto, 
          ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
      $j = 1;
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
    <img style="width: 100%;" alt="logo resteco azul" src="../../imagenes/header-comprobantes.PNG">
  </header>
  <!-- END header pdf -->

  <div style="text-align: center;">
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
        <th style="font-family: Calibri;"><small>Ubicacion</small></th>
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
    <tbody style="font-size: small;">
    <?php 
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($fila['dcmPrecioEntrada'] == "" || $fila['dcmPrecioEntrada'] == null) { $fila['dcmPrecioEntrada'] = 0.00; }
        if($fila['dcmTotalEntrada'] == "" || $fila['dcmTotalEntrada'] == null) { $fila['dcmTotalEntrada'] = 0.00; }
        if($fila['dcmPrecioSalida'] == "" || $fila['dcmPrecioSalida'] == null) { $fila['dcmPrecioSalida'] = 0.00; }
        if($fila['dcmTotalSalida'] == "" || $fila['dcmPrecioSalida'] == null) { $fila['dcmPrecioSalida'] = 0.00; }
        if($fila['intCantidadEntrada'] == "" || $fila['intCantidadEntrada'] == null) { $fila['intCantidadEntrada'] = 0; }
        if($fila['intCantidadSalida'] == "" || $fila['intCantidadSalida'] == null) { $fila['intCantidadSalida'] = 0; }
        
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
            $fila['dcmPrecioEntrada'] = number_format($fila['dcmPrecioEntrada']*$fila_moneda['dcmCambio2'],2,'.','');
            $fila['dcmTotalEntrada'] = number_format($fila['dcmTotalEntrada']*$fila_moneda['dcmCambio2'],2,'.',''); 
            $fila['dcmPrecioSalida'] = number_format($fila['dcmPrecioSalida']*$fila_moneda['dcmCambio2'],2,'.',''); 
            $fila['dcmTotalSalida'] = number_format($fila['dcmTotalSalida']*$fila_moneda['dcmCambio2'],2,'.','');
            $fila['dcmSaldoValorizado'] = number_format($fila['dcmSaldoValorizado']*$fila_moneda['dcmCambio2'],2,'.',''); 
          }
        } 
        else if ($intIdTipoMoneda == 2){
          $nvchSimbolo = "US$";
          if($fila['intIdTipoMoneda'] != 2){
            $fila['dcmPrecioEntrada'] = number_format($fila['dcmPrecioEntrada']/$fila_moneda['dcmCambio2'],2,'.','');
            $fila['dcmTotalEntrada'] = number_format($fila['dcmTotalEntrada']/$fila_moneda['dcmCambio2'],2,'.',''); 
            $fila['dcmPrecioSalida'] = number_format($fila['dcmPrecioSalida']/$fila_moneda['dcmCambio2'],2,'.',''); 
            $fila['dcmTotalSalida'] = number_format($fila['dcmTotalSalida']/$fila_moneda['dcmCambio2'],2,'.','');
            $fila['dcmSaldoValorizado'] = number_format($fila['dcmSaldoValorizado']/$fila_moneda['dcmCambio2'],2,'.','');
          }
        }

        echo 
        '
        <tr>
          <!--td class="heading" data-th="ID"></td-->
          <td style="font-family: Calibri;"><small>'.$j.'</small></td>
          <td><small>'.$fila["dtmFechaMovimiento"].'</small></td>';
        if($fila["intTipoDetalle"] == 1){
          echo '<td style="font-family: Calibri;"><small>Salida</small></td>';
        } else if($fila["intTipoDetalle"] == 2){
          echo '<td style="font-family: Calibri;"><small>Entrada</small></td>';
        } else {
          echo '<td style="font-family: Calibri;"><small>Inicial</small></td>';
        }
        echo 
        '   <td class="heading" data-th="ID"></td>
            <td style="font-family: Calibri;"><small>'.$fila["NombreComprobante"].'</small></td>
            <td style="font-family: Calibri;"><small>'.$fila["nvchSerie"].'</small></td>
            <td style="font-family: Calibri;"><small>'.$fila["nvchNumeracion"].'</small></td>
            <td style="font-family: Calibri;"><small>'.$fila["intCantidadEntrada"].'</small></td>
            <td style="font-family: Calibri;"><small>'.$fila["intCantidadSalida"].'</small></td>
            <td style="font-family: Calibri;"><small>'.$fila["intCantidadStock"].'</small></td>
            <td style="font-family: Calibri;"><small>'.$nvchSimbolo.' '.$fila["dcmPrecioEntrada"].'</small></td>
            <td style="font-family: Calibri;"><small>'.$nvchSimbolo.' '.$fila["dcmTotalEntrada"].'</small></td>
            <td style="font-family: Calibri;"><small>'.$nvchSimbolo.' '.$fila["dcmPrecioSalida"].'</small></td>
            <td style="font-family: Calibri;"><small>'.$nvchSimbolo.' '.$fila["dcmTotalSalida"].'</small></td>
            <td style="font-family: Calibri;"><small>'.$nvchSimbolo.' '.$fila["dcmSaldoValorizado"].'</small></td> 
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
  $filename = 'REPORTE KARDEX PRODUCTO'.$nvchCodigo;
  $dompdf = new DOMPDF();
  $html = utf8_decode(ob_get_clean());
  pdf_create($html,$filename,'A4','landscape');
?>