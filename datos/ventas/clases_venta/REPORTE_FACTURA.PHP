<?php
  session_start();
  require_once '../../conexion/bd_conexion.php';
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


<?php
  // INICIO  - Funcion de conversion de numero a texto
  class NumberToLetterConverter {
    private $UNIDADES = array(
          '',
          'UN ',
          'DOS ',
          'TRES ',
          'CUATRO ',
          'CINCO ',
          'SEIS ',
          'SIETE ',
          'OCHO ',
          'NUEVE ',
          'DIEZ ',
          'ONCE ',
          'DOCE ',
          'TRECE ',
          'CATORCE ',
          'QUINCE ',
          'DIECISEIS ',
          'DIECISIETE ',
          'DIECIOCHO ',
          'DIECINUEVE ',
          'VEINTE '
    );
    private $DECENAS = array(
          'VEINTI',
          'TREINTA ',
          'CUARENTA ',
          'CINCUENTA ',
          'SESENTA ',
          'SETENTA ',
          'OCHENTA ',
          'NOVENTA ',
          'CIEN '
    );
    private $CENTENAS = array(
          'CIENTO ',
          'DOSCIENTOS ',
          'TRESCIENTOS ',
          'CUATROCIENTOS ',
          'QUINIENTOS ',
          'SEISCIENTOS ',
          'SETECIENTOS ',
          'OCHOCIENTOS ',
          'NOVECIENTOS '
    );
    private $MONEDAS = array(
      array('country' => 'Colombia', 'currency' => 'COP', 'singular' => 'PESO COLOMBIANO', 'plural' => 'PESOS COLOMBIANOS', 'symbol', '$'),
      array('country' => 'Estados Unidos', 'currency' => 'USD', 'singular' => 'DÓLAR', 'plural' => 'DÓLARES', 'symbol', 'US$'),
      array('country' => 'El Salvador', 'currency' => 'USD', 'singular' => 'DÓLAR', 'plural' => 'DÓLARES', 'symbol', 'US$'),
      array('country' => 'Europa', 'currency' => 'EUR', 'singular' => 'EURO', 'plural' => 'EUROS', 'symbol', '€'),
      array('country' => 'México', 'currency' => 'MXN', 'singular' => 'PESO MEXICANO', 'plural' => 'PESOS MEXICANOS', 'symbol', '$'),
      array('country' => 'Perú', 'currency' => 'PEN', 'singular' => 'NUEVO SOL', 'plural' => 'NUEVOS SOLES', 'symbol', 'S/'),
      array('country' => 'Reino Unido', 'currency' => 'GBP', 'singular' => 'LIBRA', 'plural' => 'LIBRAS', 'symbol', '£'),
      array('country' => 'Argentina', 'currency' => 'ARS', 'singular' => 'PESO', 'plural' => 'PESOS', 'symbol', '$')
    );
      
      private $separator = '.';
      private $decimal_mark = ',';
      private $glue = ' CON ';
      /**
       * Evalua si el número contiene separadores o decimales
       * formatea y ejecuta la función conversora
       * @param $number número a convertir
       * @param $miMoneda clave de la moneda
       * @return string completo
       */
      public function to_word($number, $miMoneda = null) {
          if (strpos($number, $this->decimal_mark) === FALSE) {
            $convertedNumber = array(
              $this->convertNumber($number, $miMoneda, 'entero')
            );
          } else {
            $number = explode($this->decimal_mark, str_replace($this->separator, '', trim($number)));
            $convertedNumber = array(
              $this->convertNumber($number[0], $miMoneda, 'entero'),
              $this->convertNumber($number[1], $miMoneda, 'decimal'),
            );
          }
          return implode($this->glue, array_filter($convertedNumber));
      }
      /**
       * Convierte número a letras
       * @param $number
       * @param $miMoneda
       * @param $type tipo de dígito (entero/decimal)
       * @return $converted string convertido
       */
      private function convertNumber($number, $miMoneda = null, $type) {   
          
          $converted = '';
          if ($miMoneda !== null) {
              try {
                  
                  $moneda = array_filter($this->MONEDAS, function($m) use ($miMoneda) {
                      return ($m['currency'] == $miMoneda);
                  });
                  $moneda = array_values($moneda);
                  if (count($moneda) <= 0) {
                      throw new Exception("Tipo de moneda inválido");
                      return;
                  }
                  ($number < 2 ? $moneda = $moneda[0]['singular'] : $moneda = $moneda[0]['plural']);
              } catch (Exception $e) {
                  echo $e->getMessage();
                  return;
              }
          }else{
              $moneda = '';
          }
          if (($number < 0) || ($number > 999999999)) {
              return false;
          }
          $numberStr = (string) $number;
          $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
          $millones = substr($numberStrFill, 0, 3);
          $miles = substr($numberStrFill, 3, 3);
          $cientos = substr($numberStrFill, 6);
          if (intval($millones) > 0) {
              if ($millones == '001') {
                  $converted .= 'UN MILLON ';
              } else if (intval($millones) > 0) {
                  $converted .= sprintf('%sMILLONES ', $this->convertGroup($millones));
              }
          }
          
          if (intval($miles) > 0) {
              if ($miles == '001') {
                  $converted .= 'MIL ';
              } else if (intval($miles) > 0) {
                  $converted .= sprintf('%sMIL ', $this->convertGroup($miles));
              }
          }
          if (intval($cientos) > 0) {
              if ($cientos == '001') {
                  $converted .= 'UN ';
              } else if (intval($cientos) > 0) {
                  $converted .= sprintf('%s ', $this->convertGroup($cientos));
              }
          }
          $converted .= $moneda;
          return $converted;
      }
      /**
       * Define el tipo de representación decimal (centenas/millares/millones)
       * @param $n
       * @return $output
       */
      private function convertGroup($n) {
          $output = '';
          if ($n == '100') {
              $output = "CIEN ";
          } else if ($n[0] !== '0') {
              $output = $this->CENTENAS[$n[0] - 1];   
          }
          $k = intval(substr($n,1));
          if ($k <= 20) {
              $output .= $this->UNIDADES[$k];
          } else {
              if(($k > 30) && ($n[2] !== '0')) {
                  $output .= sprintf('%sY %s', $this->DECENAS[intval($n[1]) - 2], $this->UNIDADES[intval($n[2])]);
              } else {
                  $output .= sprintf('%s%s', $this->DECENAS[intval($n[1]) - 2], $this->UNIDADES[intval($n[2])]);
              }
          }
          return $output;
      }
  }

  // ENd  - Funcion de conversion de numero a texto
?>

<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type"
 content="text/html; charset=utf-8">
  <title style="text-transform: uppercase;">REPORTE COTIZACION POR SERVICIOS</title>
  <script src="//use.edgefonts.net/brush-script-std.js"></script>

  <style>
    table tr td {
      color: black;
      padding: 0.045454545454545456em
    }
    table#tabladetalle {
      border-collapse: collapse;
    }
    table#tablageneral {
      border: 0px solid black;
      border-collapse: collapse;
    }
    tr#primerdetalle>td, tr#cuartodetalle>td, tr#quintodetalle>td, td.celdatotales{
      border: 0px solid black;
    }
    table#tablacontactos {
      border: 0px solid black;
    }
    tr.segundodetalle>td{
      border-left: 0px solid black;
      border-right: 0px solid black;
    }
    tr.ultimodetalle>td{
      border-bottom: 0px solid black; 
      border-left: 0px solid black;
      border-right: 0px solid black;
    }

    /* font para eslogan */
    #letterlogan{
      font-family: brush-script-std, sans-serif;
      font-size: 13px !important;
    }
  </style>
  
</head>

<style>
    @page {
      margin: 0;
    }

    img{
        background-image: url(../../imagenes/background-factura.PNG);
        /* Set rules to fill background */
        min-height: 100%;
        min-width: 1024px;
        
        /* Set up proportionate scaling */
        width: 100%;
        height: auto;
        
        /* Set up positioning */
        position: fixed;
        top: 0;
        left: 0;
    
</style>

<style>
    span{
      font-size: 12px;
      margin-top: 10px !important;
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

<body>

 <!--img src="../../imagenes/background-factura.JPG" alt=""-->
 
<body> 
 <div class="row" style="margin-top: 0px">
    <div class="" style="width: 53% !important; height: 100px; float: left; border: solid 2px transparent; ">
    </div>
    <div class="" style="width: 47% !important; height: 135px; float: left; border: solid 2px transparent; color: transparent;">
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: -8px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 22px; padding-top: -10px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: 10px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 11px; padding-top: -14px; color: black !important; text-align: center; color: green; font-weight: bolder">20443881540</h1>
    </div>
  </div>
  
  <div class="row">
      <div class="" style="width: 100%; margin-top: 179px; text-align: left; z-index: 10;color: green">
          <p style="width: 85% !important; margin: 0 auto; font-size: 14px">
              <!--span>Fecha de Emisión……..de………………………..de 20……...</span-->
              <span style="margin-left: 110px !important;font-weight: bolder">20</span> 
              <span style="margin-left: 50px !important;font-weight: bolder">Enero</span>
              <span style="margin-left: 105px !important;font-weight: bolder">17</span>
          </p>
      </div>
  </div>

  <div class="row">
      <div class="" style="width: 100%; margin-top: 6px; text-align: left; z-index: 10">
          <table id="tablageneral" style="text-align: left; width: 86%; margin: 0 auto; border: solid 2px transparent">
            <tbody>
              <tr>
                <td style="font-weight: bold; font-family: Arial; width: 13% !important;">
                    <!--span>Señor(es):</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 42% !important; ">
                    <span style="margin-left: -5px; color: green">carlos montana</span>
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 20% !important;">
                    <!--span>Forma de Pago:</span--> 
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 15% !important; ">
                    <span style="margin-left: -20px; color: green">Efectivo</span>
                </td>
              </tr>
              <tr>
                <td style="font-weight: bold; font-family: Arial; width: 13% !important; ">
                    <!--span>RUC / DNI:</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 42% !important;"> 
                    <span style="color: green; margin-left: -5px">10750005760</span>
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 20% !important; ">
                    <!--span>Guía de remisión:</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 15% !important; ">
                    <span style="color: green; margin-left: -20px">GRUIA000000212</span>
                </td>
              </tr>
              <tr>
                <td style="font-weight: bold; font-family: Arial; width: 13% !important; ">
                    <!--span>Dirección:</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 42% !important; ">
                    <span style="color: green; margin-left: -5px">Psje Alamedas 123</span>
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 20% !important; ">
                    <!--span>Asesor de Ventas:</span--> 
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 15% !important; ">
                    <span style="color: green; margin-left: -20px">Hector vivanco</span>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
  </div>

  <div class="row">
    <div class="" style="width: 100%; margin-top: 7px; text-align: left; z-index: 10">
        <table id="tabladetalle" style="text-align: left; width: 86%; z-index: 10; margin: 0 auto" cellpadding="3" cellspacing="1">
          <tbody>
            <tr id="primerdetalle" style="">
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 8% !important; height: 25px !important">
                  <small>
                    <small>
                        <!--span>ITEM</span-->
                    </small>
                  </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 16.67% !important; height: 25px !important">
                  <small>
                    <small>
                        <!--span>CÓDIGO</span-->
                    </small>
                  </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 50% !important; height: 25px !important">
                <small>
                    <small>
                        <!--span>DESCRIPCIÓN</span-->
                    </small>
                </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 11% !important; height: 25px !important">
                <small>
                    <small>
                        <!--span>CANT.</span-->
                  </small>
                </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 13.8% !important; height: 25px !important">
                  <small>
                    <small>
                        <!--span>P. UNIT.</span-->
                    </small>
                  </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 13,8% !important; height: 25px !important">
                  <small>
                    <small>
                        <!--span>P. TOTAL</span-->
                    </small>
                  </small>
              </td>
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
            <tr class="segundodetalle" style="text-align: center; border-bottom: 0px solid; padding-top: -10px: ">
              <td style="width: 8% !important; font-size:x-small; padding:0px"><?php echo $i; ?></td>
              <td style="width: 16.67% !important; font-size:x-small; padding:0px">123121231212</td>
              <td style="width: 50% !important; font-size:x-small; padding:0px">123121231212</td>
              <td style="width: 11% !important; font-size:x-small; padding:0px">123121231212</td>
              <td style="width: 13.8% !important; font-size:x-small; text-align: left padding:0px">123121231212</td>
              <td style="width: 13.8% !important; font-size:x-small; text-align: left padding:0px">123121231212</td>
            </tr>
            <?php
                $i++;
              }
              for($j = $i ; $j <= 32; $j++){
                if($j == 32) {
                  echo '<tr class="ultimodetalle" style="text-align: center; color:white;">';
                } else {
                  echo '<tr class="segundodetalle" style="text-align: center; color:white;">';
                }

                $descripcion = 'Lorem ipsum dolor sit amet, consectetur Aemo suaznabarso'; //56 carateres por linea de item
            ?>
              <td style="width: 8% !important; font-size:x-small;"><?php echo $j ?></td>
              <td style="width: 16.67% !important; font-size:x-small;">20443881540</td>
              <td style="width: 50% !important; max-width: 50% !important; font-size:x-small; text-align: left; padding-left: 3px; padding-right: 3px;word-wrap: break-word"><?php echo $descripcion; ?></td>
              <td style="width: 11% !important; font-size:x-small;"><?php echo strlen($descripcion) ?></td>
              <td style="width: 13.8% !important; font-size:x-small;">|</td>
              <td style="width: 13.8% !important; font-size:x-small;">|</td>
            </tr>
            <?php
              }
              $ValorCotizacion = number_format($TotalCotizacion/1.18,2,'.','');
              $IGVCotizacion = $TotalCotizacion - $ValorCotizacion;
            ?>
          </tbody>
        </table>
    </div>
  </div>
<br>  

<!--style>
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
</style-->

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
  $filename = 'REPORTE_COTIZACION_POR_SERVICIOS';
  $dompdf = new DOMPDF();
  $html = ob_get_clean();
  pdf_create($html,$filename,'A4','portrait');

?>

  <!--div style="z-index: 100; width: 100%; margin: 0 auto; padding: 55px; text-align: center">
    <div class="row">
      <div class="" style="width: 61%; height: 100px; float: left; border: solid 2px transparent; ">
      </div>
      <div class="" style="width: 38%; height: 135px; float: left; border: solid 2px transparent; color: transparent;">
          <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: -8px; color: transparent; height: 25px"></h1>
          <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 22px; padding-top: -10px; color: transparent; height: 25px"></h1>
          <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: 10px; color: transparent; height: 25px"></h1>
          <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 10px; padding-top: -12px; color: black !important;">20443881540</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12" style="border: solid 2px green; margin-top: 150px;">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum labore, qui nulla aut! Consectetur maiores eveniet inventore sunt sequi quaerat unde, expedita officiis aut nostrum soluta omnis sit vitae, eum.    
      </div>
    </div>
  </div-->
