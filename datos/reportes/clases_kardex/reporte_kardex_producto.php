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
    <title>Reporte_Kardex_Producto</title>
  </head>
  <body>
  <div style="text-align: center;">
  <div style="text-align: left;"><big
   style="font-family: Calibri;"><big><span
   style="font-weight: bold;"></span></big></big><img
   style="width: 450px; height: 84px;" alt="Logo Resteco"
   src="../../imagenes/logo_resteco.jpg">&nbsp;&nbsp;&nbsp;
  <br style="font-family: Calibri;">
  <div style="text-align: right;"><span style="font-weight: bold; font-family: Calibri;"><br>Fecha Generada:</span><span style="font-family: Calibri;">
  <?php echo date("Y-m-d H:i:s"); ?></span><br style="font-family: Calibri;">
  <span style="font-weight: bold; font-family: Calibri;">Usuario que generó:</span><span style="font-family: Calibri;">
  <?php echo $_SESSION['NombresApellidos']; ?><br><br></span></div>
  <big style="font-family: Calibri;"><big><span style="font-weight: bold;"></span></big></big></div>
  <big style="font-family: Calibri;"><big><span style="font-weight: bold;">REPORTE KARDEX DEL PRODUCTO
  <?php echo $nvchCodigo; ?></span></big></big><br>
  <br>
  <div style="text-align: left; font-family: Calibri;"><span style="font-weight: bold;">Fecha de Inicio:</span>
  <?php echo $dtmFechaInicial; ?><br style="font-weight: bold;">
  <span style="font-weight: bold;">Fecha Final:</span>
  <?php echo $dtmFechaFinal; ?><br>
  <br>
  
  <!--table style="text-align: center; width: 100%;" border="1"
   cellpadding="1" cellspacing="0"-->
  <table border="1" class="ExcelTable2007 rwd-table" width="100%">
    <thead>
      <tr>
        <th class="heading" width="25px">&nbsp;</th>
        <th style="font-family: Calibri;"><small>Ítem</small></th>
        <th style="font-family: Calibri;"><small>Fecha</small></th>
        <th style="font-family: Calibri;"><small>Movimiento</small></th>
        <th style="font-family: Calibri;"><small>Comprobante</small></th>
        <th style="font-family: Calibri;"><small>Serie</small></th>
        <th style="font-family: Calibri;"><small>Numeración</small></th>
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
    $dompdf->stream($filename.".pdf");
  }
  $filename = 'Reporte_Kardex_Producto_'.$nvchCodigo;
  $dompdf = new DOMPDF();
  $html = utf8_decode(ob_get_clean());
  pdf_create($html,$filename,'A4','landscape');
?>