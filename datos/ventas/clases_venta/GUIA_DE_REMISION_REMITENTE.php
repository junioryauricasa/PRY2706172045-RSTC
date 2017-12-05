<?php
  session_start();
  require_once '../../conexion/bd_conexion.php';

  $anio = date('y'); // anio en 2 digitos

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

  //variable de impresion
  $descripcion = 'Lorem ipsum dolor sit amet, consectetur Aemo suaznabarso'; //56 carateres por linea de item
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


// FUNCIONES DE CONVERSION DE NUMEROS A LETRAS.
function centimos()
{
  global $importe_parcial;
 
  //$importe_parcial = number_format($importe_parcial, 2, ".", "") * 100;
  $importe_parcial = number_format($importe_parcial,2,".","");
 
  if ($importe_parcial > 0)
    $num_letra = " con ".decena_centimos($importe_parcial);
  else
    $num_letra = "";
 
  return $num_letra;
}
 
function unidad_centimos($numero)
{
  switch ($numero)
  {
    case 9:
    {
      $num_letra = "nueve céntimos";
      break;
    }
    case 8:
    {
      $num_letra = "ocho céntimos";
      break;
    }
    case 7:
    {
      $num_letra = "siete céntimos";
      break;
    }
    case 6:
    {
      $num_letra = "seis céntimos";
      break;
    }
    case 5:
    {
      $num_letra = "cinco céntimos";
      break;
    }
    case 4:
    {
      $num_letra = "cuatro céntimos";
      break;
    }
    case 3:
    {
      $num_letra = "tres céntimos";
      break;
    }
    case 2:
    {
      $num_letra = "dos céntimos";
      break;
    }
    case 1:
    {
      $num_letra = "un céntimo";
      break;
    }
  }
  return $num_letra;
}
 
function decena_centimos($numero)
{
  if ($numero >= 10)
  {
    if ($numero >= 90 && $numero <= 99)
    {
        if ($numero == 90)
          return "noventa céntimos";
        else if ($numero == 91)
          return "noventa y un céntimos";
        else
          return "noventa y ".unidad_centimos($numero - 90);
    }
    if ($numero >= 80 && $numero <= 89)
    {
      if ($numero == 80)
        return "ochenta céntimos";
      else if ($numero == 81)
        return "ochenta y un céntimos";
      else
        return "ochenta y ".unidad_centimos($numero - 80);
    }
    if ($numero >= 70 && $numero <= 79)
    {
      if ($numero == 70)
        return "setenta céntimos";
      else if ($numero == 71)
        return "setenta y un céntimos";
      else
        return "setenta y ".unidad_centimos($numero - 70);
    }
    if ($numero >= 60 && $numero <= 69)
    {
      if ($numero == 60)
        return "sesenta céntimos";
      else if ($numero == 61)
        return "sesenta y un céntimos";
      else
        return "sesenta y ".unidad_centimos($numero - 60);
    }
    if ($numero >= 50 && $numero <= 59)
    {
      if ($numero == 50)
        return "cincuenta céntimos";
      else if ($numero == 51)
        return "cincuenta y un céntimos";
      else
        return "cincuenta y ".unidad_centimos($numero - 50);
    }
    if ($numero >= 40 && $numero <= 49)
    {
      if ($numero == 40)
        return "cuarenta céntimos";
      else if ($numero == 41)
        return "cuarenta y un céntimos";
      else
        return "cuarenta y ".unidad_centimos($numero - 40);
    }
    if ($numero >= 30 && $numero <= 39)
    {
      if ($numero == 30)
        return "treinta céntimos";
      else if ($numero == 91)
        return "treinta y un céntimos";
      else
        return "treinta y ".unidad_centimos($numero - 30);
    }
    if ($numero >= 20 && $numero <= 29)
    {
      if ($numero == 20)
        return "veinte céntimos";
      else if ($numero == 21)
        return "veintiun céntimos";
      else
        return "veinti".unidad_centimos($numero - 20);
    }
    if ($numero >= 10 && $numero <= 19)
    {
      if ($numero == 10)
        return "diez céntimos";
      else if ($numero == 11)
        return "once céntimos";
      else if ($numero == 11)
        return "doce céntimos";
      else if ($numero == 11)
        return "trece céntimos";
      else if ($numero == 11)
        return "catorce céntimos";
      else if ($numero == 11)
        return "quince céntimos";
      else if ($numero == 11)
        return "dieciseis céntimos";
      else if ($numero == 11)
        return "diecisiete céntimos";
      else if ($numero == 11)
        return "dieciocho céntimos";
      else if ($numero == 11)
        return "diecinueve céntimos";
    }
  }
  else
    return unidad_centimos($numero);
}
 
function unidad($numero)
{
  switch ($numero)
  {
    case 9:
    {
      $num = "nueve";
      break;
    }
    case 8:
    {
      $num = "ocho";
      break;
    }
    case 7:
    {
      $num = "siete";
      break;
    }
    case 6:
    {
      $num = "seis";
      break;
    }
    case 5:
    {
      $num = "cinco";
      break;
    }
    case 4:
    {
      $num = "cuatro";
      break;
    }
    case 3:
    {
      $num = "tres";
      break;
    }
    case 2:
    {
      $num = "dos";
      break;
    }
    case 1:
    {
      $num = "uno";
      break;
    }
  }
  return $num;
}
 
function decena($numero)
{
  if ($numero >= 90 && $numero <= 99)
  {
    $num_letra = "noventa ";
 
    if ($numero > 90)
      $num_letra = $num_letra."y ".unidad($numero - 90);
  }
  else if ($numero >= 80 && $numero <= 89)
  {
    $num_letra = "ochenta ";
 
    if ($numero > 80)
      $num_letra = $num_letra."y ".unidad($numero - 80);
  }
  else if ($numero >= 70 && $numero <= 79)
  {
      $num_letra = "setenta ";
 
    if ($numero > 70)
      $num_letra = $num_letra."y ".unidad($numero - 70);
  }
  else if ($numero >= 60 && $numero <= 69)
  {
    $num_letra = "sesenta ";
 
    if ($numero > 60)
      $num_letra = $num_letra."y ".unidad($numero - 60);
  }
  else if ($numero >= 50 && $numero <= 59)
  {
    $num_letra = "cincuenta ";
 
    if ($numero > 50)
      $num_letra = $num_letra."y ".unidad($numero - 50);
  }
  else if ($numero >= 40 && $numero <= 49)
  {
    $num_letra = "cuarenta ";
 
    if ($numero > 40)
      $num_letra = $num_letra."y ".unidad($numero - 40);
  }
  else if ($numero >= 30 && $numero <= 39)
  {
    $num_letra = "treinta ";
 
    if ($numero > 30)
      $num_letra = $num_letra."y ".unidad($numero - 30);
  }
  else if ($numero >= 20 && $numero <= 29)
  {
    if ($numero == 20)
      $num_letra = "veinte ";
    else
      $num_letra = "veinti".unidad($numero - 20);
  }
  else if ($numero >= 10 && $numero <= 19)
  {
    switch ($numero)
    {
      case 10:
      {
        $num_letra = "diez ";
        break;
      }
      case 11:
      {
        $num_letra = "once ";
        break;
      }
      case 12:
      {
        $num_letra = "doce ";
        break;
      }
      case 13:
      {
        $num_letra = "trece ";
        break;
      }
      case 14:
      {
        $num_letra = "catorce ";
        break;
      }
      case 15:
      {
        $num_letra = "quince ";
        break;
      }
      case 16:
      {
        $num_letra = "dieciseis ";
        break;
      }
      case 17:
      {
        $num_letra = "diecisiete ";
        break;
      }
      case 18:
      {
        $num_letra = "dieciocho ";
        break;
      }
      case 19:
      {
        $num_letra = "diecinueve ";
        break;
      }
    }
  }
  else
    $num_letra = unidad($numero);
 
  return $num_letra;
}
 
function centena($numero)
{
  if ($numero >= 100)
  {
    if ($numero >= 900 & $numero <= 999)
    {
      $num_letra = "novecientos ";
 
      if ($numero > 900)
        $num_letra = $num_letra.decena($numero - 900);
    }
    else if ($numero >= 800 && $numero <= 899)
    {
      $num_letra = "ochocientos ";
 
      if ($numero > 800)
        $num_letra = $num_letra.decena($numero - 800);
    }
    else if ($numero >= 700 && $numero <= 799)
    {
      $num_letra = "setecientos ";
 
      if ($numero > 700)
        $num_letra = $num_letra.decena($numero - 700);
    }
    else if ($numero >= 600 && $numero <= 699)
    {
      $num_letra = "seiscientos ";
 
      if ($numero > 600)
        $num_letra = $num_letra.decena($numero - 600);
    }
    else if ($numero >= 500 && $numero <= 599)
    {
      $num_letra = "quinientos ";
 
      if ($numero > 500)
        $num_letra = $num_letra.decena($numero - 500);
    }
    else if ($numero >= 400 && $numero <= 499)
    {
      $num_letra = "cuatrocientos ";
 
      if ($numero > 400)
        $num_letra = $num_letra.decena($numero - 400);
    }
    else if ($numero >= 300 && $numero <= 399)
    {
      $num_letra = "trescientos ";
 
      if ($numero > 300)
        $num_letra = $num_letra.decena($numero - 300);
    }
    else if ($numero >= 200 && $numero <= 299)
    {
      $num_letra = "doscientos ";
 
      if ($numero > 200)
        $num_letra = $num_letra.decena($numero - 200);
    }
    else if ($numero >= 100 && $numero <= 199)
    {
      if ($numero == 100)
        $num_letra = "cien ";
      else
        $num_letra = "ciento ".decena($numero - 100);
    }
  }
  else
    $num_letra = decena($numero);
 
  return $num_letra;
}
 
function cien()
{
  global $importe_parcial;
 
  $parcial = 0; $car = 0;
 
  while (substr($importe_parcial, 0, 1) == 0)
    $importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
 
  if ($importe_parcial >= 1 && $importe_parcial <= 9.99)
    $car = 1;
  else if ($importe_parcial >= 10 && $importe_parcial <= 99.99)
    $car = 2;
  else if ($importe_parcial >= 100 && $importe_parcial <= 999.99)
    $car = 3;
 
  $parcial = substr($importe_parcial, 0, $car);
  $importe_parcial = substr($importe_parcial, $car);
 
  $num_letra = centena($parcial).centimos();
 
  return $num_letra;
}
 
function cien_mil()
{
  global $importe_parcial;
 
  $parcial = 0; $car = 0;
 
  while (substr($importe_parcial, 0, 1) == 0)
    $importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
 
  if ($importe_parcial >= 1000 && $importe_parcial <= 9999.99)
    $car = 1;
  else if ($importe_parcial >= 10000 && $importe_parcial <= 99999.99)
    $car = 2;
  else if ($importe_parcial >= 100000 && $importe_parcial <= 999999.99)
    $car = 3;
 
  $parcial = substr($importe_parcial, 0, $car);
  $importe_parcial = substr($importe_parcial, $car);
 
  if ($parcial > 0)
  {
    if ($parcial == 1)
      $num_letra = "mil ";
    else
      $num_letra = centena($parcial)." mil ";
  }
 
  return $num_letra;
}
 
 
function millon()
{
  global $importe_parcial;
 
  $parcial = 0; $car = 0;
 
  while (substr($importe_parcial, 0, 1) == 0)
    $importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
 
  if ($importe_parcial >= 1000000 && $importe_parcial <= 9999999.99)
    $car = 1;
  else if ($importe_parcial >= 10000000 && $importe_parcial <= 99999999.99)
    $car = 2;
  else if ($importe_parcial >= 100000000 && $importe_parcial <= 999999999.99)
    $car = 3;
 
  $parcial = substr($importe_parcial, 0, $car);
  $importe_parcial = substr($importe_parcial, $car);
 
  if ($parcial == 1)
    $num_letras = "un millón ";
  else
    $num_letras = centena($parcial)." millones ";
 
  return $num_letras;
}
 
function convertir_a_letras($numero)
{
  global $importe_parcial;
 
  $importe_parcial = $numero;
 
  if ($numero < 1000000000)
  {
    if ($numero >= 1000000 && $numero <= 999999999.99)
      $num_letras = millon().cien_mil().cien();
    else if ($numero >= 1000 && $numero <= 999999.99)
      $num_letras = cien_mil().cien();
    else if ($numero >= 1 && $numero <= 999.99)
      $num_letras = cien();
    else if ($numero >= 0.01 && $numero <= 0.99)
    {
      if ($numero == 0.01)
        $num_letras = "un céntimo";
      else
        $num_letras = convertir_a_letras(($numero * 100)."/100")." céntimos";
    }
  }
  return $num_letras;
}

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
      padding: 0.05em
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
    }

    span{
      /*color: green;*/
      font-size: 12px; /*fuente importante considerar*/
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

 <img src="../../imagenes/GUIA_DE_REMISION_REMITENTE.PNG" alt="" width="100%" style="">
 
 <div class="row" style="margin-top: -10px">
    <div class="" style="width: 53% !important; height: 100px; float: left; border: solid 2px transparent; ">
    </div>
    <div class="" style="width: 47% !important; height: 135px; float: left; border: solid 2px transparent; color: transparent;">
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: -8px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 22px; padding-top: -10px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: 10px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 11px; padding-top: -14px; text-align: center; font-weight: bolder">
            <span>
              20443881540
            </span>
        </h1>
    </div>
  </div>
  
  <div class="row" style="">
      <div class="" style="width: 100%; margin-top: 169px; text-align: left; z-index: 10;/*color: green*/">
          <p style="width: 85% !important; margin: 0 auto; font-size: 14px">
              <!--span>Fecha de Emisión……..de………………………..de 20……...</span-->
              <span style="margin-left: 110px !important;font-weight: bolder">20</span> 
              <span style="margin-left: 50px !important;font-weight: bolder">Enero</span>
              <span style="margin-left: 105px !important;font-weight: bolder"><?php echo $anio; ?></span>
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
                    <span style="margin-left: -5px;">carlos montana</span>
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 20% !important;">
                    <!--span>Forma de Pago:</span--> 
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 15% !important; ">
                    <span style="margin-left: -20px;">Efectivo</span>
                </td>
              </tr>
              <tr>
                <td style="font-weight: bold; font-family: Arial; width: 13% !important; ">
                    <!--span>RUC / DNI:</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 42% !important;"> 
                    <span style="margin-left: -5px">10750005760</span>
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 20% !important; ">
                    <!--span>Guía de remisión:</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 15% !important; ">
                    <span style="margin-left: -20px">GRUIA000000212</span>
                </td>
              </tr>
              <tr>
                <td style="font-weight: bold; font-family: Arial; width: 13% !important; ">
                    <!--span>Dirección:</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 42% !important; ">
                    <span style="margin-left: -5px">Psje Alamedas 123</span>
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 20% !important; ">
                    <!--span>Asesor de Ventas:</span--> 
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 15% !important; ">
                    <span style="margin-left: -20px">Hector vivanco</span>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
  </div>

  <div class="row">
    <div class="" style="width: 100%; margin-top: 10px; text-align: left; z-index: 10">
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
              <td style="width: 8% !important; font-size:x-small; padding:0px">
                <span>
                  <?php //echo $i; ?>
                </span>
              </td>
              <td style="width: 16.67% !important; font-size:x-small; padding:0px">
                <span>
                  20443881540
                </span>
              </td>
              <td style="width: 50% !important; font-size:x-small; padding:0px">
                <span>
                  <?php echo $descripcion; ?>
                </span>
              </td>
              <td style="width: 11% !important; font-size:x-small; padding:0px">
                <span>
                  <?php echo strlen($descripcion) ?>
                </span>
              </td>
              <td style="width: 13.8% !important; font-size:x-small; text-align: left padding:0px">
                <span>
                  
                </span>
              </td>
              <td style="width: 13.8% !important; font-size:x-small; text-align: left padding:0px">
                <span>
                  
                </span>
              </td>
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
            ?>
              <td style="width: 8% !important; font-size:x-small;"><?php //echo $j ?></td>
              <td style="width: 16.67% !important; font-size:x-small;">
                <span>
                  20443881540
                </span>
              </td>
              <td style="width: 50% !important; max-width: 50% !important; font-size:x-small; text-align: left; padding-left: 7px; padding-right: 0px;word-wrap: break-word">
                <span>
                    <?php echo $descripcion; ?>
                </span>
              </td>
              <td style="width: 11% !important; font-size:x-small;">
                <span>
                  <?php echo strlen($descripcion) ?>
                </span>
              </td>
              <td style="width: 13.8% !important; font-size:x-small;">
                <span>
                  
                </span>
              </td>
              <td style="width: 13.8% !important; font-size:x-small;">
                <span>
                  
                </span>
              </td>
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

  <!-- table para el footer -->
  <div class="row" style=" padding-top: 15px; z-index: 10">
    <table style="text-align: left; width: 86%; margin: 0 auto; /*border: solid 2px*/">
      <!-- INICIO - row VALOR VENTA -->
      <tr>
        <td style="width: 8% !important; font-size:x-small; padding:0px"></td>
        <td style="width: 56.67% !important; font-size:x-small; padding:0px">
            <span>
                <?php 
                    $numero = 1000.45;
                    //convertir_a_letras(1900);
                    echo 'Ciento cicncuenta y nueve mil trescientos cuarenta y cinco soles';
                ?>      
            </span>
        </td>
        <td style="width: 11% !important; font-size:x-small;">
          <span></span>
        </td>
        <td style="width: 13.8% !important; font-size:x-small;"></td>
        <td style="width: 13.8% !important; font-size:x-small; text-align: right; padding-right: 7px;">
          <span>159345.20</span>
        </td>
      </tr>
      <!-- END - row VALOR VENTA -->

      <!-- INICIO - row IGV -->
      <tr>
        <td colspan="3"></td>
        <td style="width: 11% !important; font-size:x-small;">
          <span></span>
        </td>
        <td style="width: 13.8% !important; font-size:x-small; text-align: right; padding-right: 6px; padding-top: 10px">
          <span>159345.20</span>
        </td>
      </tr>
      <!-- END - row IGV -->

      <!-- INICIO - row TOTAL -->
      <tr>
        <td colspan="3"></td>
        <td style="width: 11% !important; font-size:x-small;">
          <span></span>
        </td>
        <td style="width: 13.8% !important; font-size:x-small; text-align: right; padding-right: 6px; padding-top: 10px">
          <span style="">159345.20</span>
        </td>
      </tr>
      <!-- END - row TOTAL -->
    </table>
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
  $filename = 'GUIA DE REMISION REMITENTE';
  $dompdf = new DOMPDF();
  $html = ob_get_clean();
  pdf_create($html,$filename,'A4','portrait');

?>