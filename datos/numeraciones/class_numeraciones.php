<?php 
require_once '../conexion/bd_conexion.php';
class Numeraciones{
  /* INICIO - Atributos de Orden Compra*/
  private $nvchNumeracionTratada;
  private $intIdTipoOperacion;
  private $intIdTipoComprobante;
  
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdTipoOperacion($intIdTipoOperacion){ $this->intIdTipoOperacion = $intIdTipoOperacion; }
  public function intIdTipoComprobante($intIdTipoComprobante){ $this->intIdTipoComprobante = $intIdTipoComprobante; }
  /* FIN - Atributos de Orden Compra */

  /* INICIO - Métodos de Orden Compra */
  public function NumeracionSimpleInterna($Id)
  {
    $resultado = "";
    if ($Id >= 1 && $Id <= 9) {
      $resultado = "0000000".$Id;
      return $resultado;
    } else if ($Id >= 10 && $Id <= 99) {
      $resultado = "000000".$Id;
      return $resultado;
    } else if ($Id >= 100 && $Id <= 999) {
      $resultado = "00000".$Id;
      return $resultado;
    } else if ($Id >= 1000 && $Id <= 9999) {
      $resultado = "0000".$Id;
      return $resultado;
    } else if ($Id >= 10000 && $Id <= 99999) {
      $resultado = "000".$Id;
      return $resultado;
    } else if ($Id >= 100000 && $Id <= 999999) {
      $resultado = "00".$Id;
      return $resultado;
    } else if ($Id >= 1000000 && $Id <= 9999999) {
      $resultado = "0".$Id;
      return $resultado;
    } else if ($Id >= 10000000 && $Id <= 99999999) {
      $resultado = $Id;
      return $resultado;
    }
  }

  public function CalcularNumeracion($nvchNumeracion)
  {
    $resultado = "";
    $Id = (int)$nvchNumeracion;
    $Id++;
    if ($Id >= 1 && $Id <= 9) {
      $resultado = "0000000".$Id;
      return $resultado;
    } else if ($Id >= 10 && $Id <= 99) {
      $resultado = "000000".$Id;
      return $resultado;
    } else if ($Id >= 100 && $Id <= 999) {
      $resultado = "00000".$Id;
      return $resultado;
    } else if ($Id >= 1000 && $Id <= 9999) {
      $resultado = "0000".$Id;
      return $resultado;
    } else if ($Id >= 10000 && $Id <= 99999) {
      $resultado = "000".$Id;
      return $resultado;
    } else if ($Id >= 100000 && $Id <= 999999) {
      $resultado = "00".$Id;
      return $resultado;
    } else if ($Id >= 1000000 && $Id <= 9999999) {
      $resultado = "0".$Id;
      return $resultado;
    } else if ($Id >= 10000000 && $Id <= 99999999) {
      $resultado = $Id;
      return $resultado;
    }
  }

  public function NumeracionAlgoritmica($intIdTipoComprobante,$intIdSucursal)
  {
    try{
    $sql_conexion = new Conexion_BD();
    $sql_conectar = $sql_conexion->Conectar();
    $sql_comando = $sql_conectar->prepare('CALL MOSTRARSERIE(:intIdSucursal)');
    $sql_comando->execute(array(':intIdSucursal' => $intIdSucursal));
    $fila = $sql_comando->fetch(PDO::FETCH_ASSOC);
    $salida['nvchSerie'] = $fila['nvchSerie'];
    $intIdSerie = $fila['intIdSerie'];

    $sql_comando = $sql_conectar->prepare('CALL MOSTRARNUMERACION(:intIdTipoComprobante,:intIdSerie)');
    $sql_comando->execute(array(':intIdTipoComprobante' => $intIdTipoComprobante,
        ':intIdSerie' => $intIdSerie));
    $fila = $sql_comando->fetch(PDO::FETCH_ASSOC);
    $salida['nvchNumeracion'] = $fila['nvchNumeracion'];
    
    $salida['resultado'] = 'ok';
    echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      $salida['resultado'] = $e->getMessage();
      echo json_encode($salida);
    }
  }

  public function ActualizarNumeracion($intIdTipoComprobante,$intIdSucursal,$nvchNumeracion)
  {
    try{
    $nvchNumeracion = $this->CalcularNumeracion($nvchNumeracion);
    $sql_conexion = new Conexion_BD();
    $sql_conectar = $sql_conexion->Conectar();
    $sql_comando = $sql_conectar->prepare('CALL MOSTRARSERIE(:intIdSucursal)');
    $sql_comando->execute(array(':intIdSucursal' => $intIdSucursal));
    $fila = $sql_comando->fetch(PDO::FETCH_ASSOC);
    $salida['nvchSerie'] = $fila['nvchSerie'];
    $intIdSerie = $fila['intIdSerie'];

    $sql_comando = $sql_conectar->prepare('CALL ACTUALIZARNUMERACION(:intIdTipoComprobante,
      :intIdSerie,:nvchNumeracion)');
    $sql_comando->execute(array(
      ':intIdTipoComprobante' => $intIdTipoComprobante,
      ':intIdSerie' => $intIdSerie,
      ':nvchNumeracion' => $nvchNumeracion));
    echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Orden Compra */
}
?>