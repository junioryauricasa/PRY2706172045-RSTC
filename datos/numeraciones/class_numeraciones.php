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
      $resultado = "001-00000".$Id;
      return $resultado;
    } else if ($Id >= 10 && $Id <= 99) {
      $resultado = "001-0000".$Id;
      return $resultado;
    } else if ($Id >= 100 && $Id <= 999) {
      $resultado = "001-000".$Id;
      return $resultado;
    } else if ($Id >= 1000 && $Id <= 9999) {
      $resultado = "001-00".$Id;
      return $resultado;
    } else if ($Id >= 10000 && $Id <= 99999) {
      $resultado = "001-0".$Id;
      return $resultado;
    } else if ($Id >= 100000 && $Id <= 999999) {
      $resultado = "001-".$Id;
      return $resultado;
    }
  }
  /* FIN - Métodos de Orden Compra */
}
?>