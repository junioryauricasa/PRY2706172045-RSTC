<?php
require_once '../datos/conexion/bd_conexion.php';
/*
$busqueda = $_POST['busqueda'];
$intIdProducto = $_POST['intIdProducto'];
$dtmFechaInicial = $_POST['dtmFechaInicial'];
$dtmFechaFinal = $_POST['dtmFechaFinal'];
$intIdTipoMoneda = $_POST['intIdTipoMoneda'];
*/
$busqueda = '';
$intIdProducto = 1;
$dtmFechaInicial = '';
$dtmFechaFinal = '2017-10-31 23:59:59';
$intIdTipoMoneda = 1;
 ob_start();
 session_start();
ini_set("memory_limit", "128M");
$sql_conexion = new Conexion_BD();
$sql_conectar = $sql_conexion->Conectar();
$sql_comando = $sql_conectar->prepare('CALL BUSCARKARDEXPRODUCTO_II(:busqueda,:intIdProducto,:dtmFechaInicial,:dtmFechaFinal)');
$sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdProducto' => $intIdProducto, 
    ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
$j = 1;

    $nombreReporte = "Kardex del Producto";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $nombreReporte; ?></title>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

  <style>
    @font-face {
        font-family: 'Elegance';
        font-weight: normal;
        font-style: normal;
        font-variant: normal;
        src: url("http://eclecticgeek.com/dompdf/fonts/Elegance.ttf") format("truetype");
    }
    p{
      font-size: 13px !important;
      text-align: justify;
    }
    table{
      font-size: 11px ;
    }
    h1{
      font-family: Elegance, sans-serif;
    }
  </style>

</head>
<body class="container">
  <div style="display: inline-block;">
  <table width="100%">
    <tr>
      <td><img src="logo.JPG" alt="" width="200px"></td>
      <td class="text-right">
        <?php include('_include/info_header.php'); ?>
      </td>
    </tr>
  </table>
  <br>
    <h3 class="text-center"><?php echo $nombreReporte; ?></h3>
  </div>
  <p>
    Reporte Kardex <b>resteco SFT</b>
  </p>
  <p>
    <!-- seccion de ayuda -->
    <b>Nota. </b> En caso de dudas le recomendamos ir a la seccion de ayuda al usuario, podra encontrar informacion referente a esta sección o comuniquese con su administrador.
  </p>
<br>
<table class="table table-bordered table-sm">
  <thead>
    <tr>
      <th>Ítem</th>
      <th>Fecha</th>
      <th>Tipo de Mov.</th>
      <th>Tipo Comprobante</th>
      <th>Serie</th>
      <th>Numeración</th>
      <th>Cantidad Entrada</th>
      <th>Cantidad Salida</th>
      <th>Stock</th>
      <th>Precio Uni. Entrada</th>
      <th>Total Entrada</th>
      <th>Precio Uni. Salida</th>
      <th>Total Salida</th>
      <th>Saldo Valorizado</th>
    </tr>
  </thead>
  <tbody>
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
        '<tr>
        <td>'.$j.'</td>
        <td>'.$fila["dtmFechaMovimiento"].'</td>';
        if($fila["intTipoDetalle"] == 1){
          echo '<td>Salida</td>';
        } else if($fila["intTipoDetalle"] == 2){
          echo '<td>Entrada</td>';
        } else {
          echo '<td>Inicial</td>';
        }
        echo 
        '<td>'.$fila["NombreComprobante"].'</td>
        <td>'.$fila["nvchSerie"].'</td>
        <td>'.$fila["nvchNumeracion"].'</td>
        <td>'.$fila["intCantidadEntrada"].'</td>
        <td>'.$fila["intCantidadSalida"].'</td>
        <td>'.$fila["intCantidadStock"].'</td>
        <td>'.$nvchSimbolo.' '.$fila["dcmPrecioEntrada"].'</td>
        <td>'.$nvchSimbolo.' '.$fila["dcmTotalEntrada"].'</td>
        <td>'.$nvchSimbolo.' '.$fila["dcmPrecioSalida"].'</td>
        <td>'.$nvchSimbolo.' '.$fila["dcmTotalSalida"].'</td>
        <td>'.$nvchSimbolo.' '.$fila["dcmSaldoValorizado"].'</td> 
        </tr>';
        $j++;
      }
    ?>
  </tbody>
</table>
</body>
</html>
  <?php
  	require_once('dompdf/dompdf_config.inc.php');
      $dompdf = new DOMPDF();
      $dompdf->set_paper('A4', 'landscape'); //Adicionar esto para hojas horizontales.
      $dompdf->load_html(ob_get_clean());
      $dompdf->render();
      $pdf = $dompdf -> output();
      $filename = 'reporte_kardex_producto.pdf';
      $dompdf -> stream( $filename, array('Attachment' => false)); // evitar descargar el archivo
      exit(0);
  ?>