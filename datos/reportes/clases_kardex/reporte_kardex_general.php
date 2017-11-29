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
    <title>Reporte_Kardex_Producto</title>
    
  </head>
  <style>
      @page { 
        margin: 20px 20px; 
      }
      table, tr, td{
        font-size: 11px
      }
      #header { 
        position: fixed; 
        left: 0px; 
        right: 0px; 
        /*height: 30px; 
        background-color: orange;*/ 
      }
  </style>
  <body>
 
  <div style="text-align: center;">
    <div id="header">
      <img style="height: 30px;" alt="Logo Resteco" src="../../imagenes/logo_resteco.jpg">
      &nbsp;&nbsp;&nbsp;
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

  
  

  <div class="cuerpo">
      <span style="font-weight: bold; font-size: 12px">REPORTE KARDEX GENERAL</span>
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
                      <td style="font-family: Calibri; text-align: left"><small>'.$fila["nvchDescripcion"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["CantidadEntradaTotal"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["CantidadSalidaTotal"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$fila["intCantidadStock"].'</small></td>
                      <td style="font-family: Calibri;"><small>'.$nvchSimbolo.' '.$fila["dcmSaldoValorizado"].'</small>
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

  $filename = 'Reporte_Kardex_General';
  $dompdf = new DOMPDF();
  $html = utf8_decode(ob_get_clean());
  //pdf_create($html,$filename,'A4','landscape');
  pdf_create($html,$filename,'A4','portraid');
?>