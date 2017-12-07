<?php
// class_numero_a_texto.php
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