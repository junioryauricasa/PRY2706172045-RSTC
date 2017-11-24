<?php 
require_once '../conexion/bd_conexion.php';
class DetalleComprobante
{	
  /* INICIO - Atributos de Detalle Orden Compra*/
  private $intIdDetalleComprobante;
  private $intIdComprobante;
  private $intIdTipoVenta;
  private $intTipoDetalle;
  private $dtmFechaRealizada;
  private $intIdProducto;
  private $nvchCodigo;
  private $nvchDescripcion;
  private $dcmPrecio;
  private $dcmDescuento;
  private $dcmPrecioUnitario;
  private $intCantidad;
  private $dcmTotal;
  
  public function IdDetalleComprobante($intIdDetalleComprobante){ $this->intIdDetalleComprobante = $intIdDetalleComprobante; }
  public function IdComprobante($intIdComprobante){ $this->intIdComprobante = $intIdComprobante; }
  public function IdTipoVenta($intIdTipoVenta){ $this->intIdTipoVenta = $intIdTipoVenta; }
  public function TipoDetalle($intTipoDetalle){ $this->intTipoDetalle = $intTipoDetalle; }
  public function FechaRealizada($dtmFechaRealizada){ $this->dtmFechaRealizada = $dtmFechaRealizada; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function Codigo($nvchCodigo){ $this->nvchCodigo = $nvchCodigo; }
  public function Descripcion($nvchDescripcion){ $this->nvchDescripcion = $nvchDescripcion; }
  public function Precio($dcmPrecio){ $this->dcmPrecio = $dcmPrecio; }
  public function Descuento($dcmDescuento){ $this->dcmDescuento = $dcmDescuento; }
  public function PrecioUnitario($dcmPrecioUnitario){ $this->dcmPrecioUnitario = $dcmPrecioUnitario; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function Total($dcmTotal){ $this->dcmTotal = $dcmTotal; }
  /* FIN - Atributos de Detalle Orden Compra */

  /* INICIO - Métodos de Detalle Orden Compra */
  public function InsertarDetalleComprobante()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->intCantidad as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarDetalleComprobante(:intIdComprobante,
        :intIdTipoVenta,:intTipoDetalle,:dtmFechaRealizada,:intIdProducto,:nvchCodigo,:nvchDescripcion,:dcmPrecio,:dcmDescuento,
        :dcmPrecioUnitario,:intCantidad,:dcmTotal)');
      if($this->intIdTipoVenta == 1){
          $sql_comando->execute(array(
          ':intIdComprobante' => $this->intIdComprobante,
          ':intIdTipoVenta' => $this->intIdTipoVenta,
          ':intTipoDetalle' => $this->intTipoDetalle,
          ':dtmFechaRealizada' => $this->dtmFechaRealizada,
          ':intIdProducto' => $this->intIdProducto[$key],
          ':nvchCodigo' => $this->nvchCodigo[$key],
          ':nvchDescripcion' => $this->nvchDescripcion[$key],
          ':dcmPrecio' => $this->dcmPrecio[$key],
          ':dcmDescuento' => $this->dcmDescuento[$key],
          ':dcmPrecioUnitario' => $this->dcmPrecioUnitario[$key],
          ':intCantidad' => $value,
          ':dcmTotal' => $this->dcmTotal[$key]));
        } else if($this->intIdTipoVenta == 2){
          $sql_comando->execute(array(
          ':intIdComprobante' => $this->intIdComprobante,
          ':intIdTipoVenta' => $this->intIdTipoVenta, 
          ':intTipoDetalle' => $this->intTipoDetalle,
          ':dtmFechaRealizada' => $this->dtmFechaRealizada,
          ':intIdProducto' => 0,
          ':nvchCodigo' => '',
          ':nvchDescripcion' => $this->nvchDescripcion[$key],
          ':dcmPrecio' => 0.00,
          ':dcmDescuento' => 0.00,
          ':dcmPrecioUnitario' => $this->dcmPrecioUnitario[$key],
          ':intCantidad' => $value,
          ':dcmTotal' => $this->dcmTotal[$key]));
        }
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarDetalleComprobante($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleComprobante(:intIdComprobante)');
      $sql_comando -> execute(array(':intIdComprobante' => $this->intIdComprobante));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($fila['intCantidad'] < 10)
          $fila['intCantidad'] = "0".$fila['intCantidad'];
        if($fila['intIdTipoVenta'] == 1){
          echo
          '<tr>
            <td class="heading" data-th="ID">'.$i.'</td> '.
            '<td><input type="hidden" name="fila[]" value="'.$i.'" form="form-venta" />'.
                '<input type="hidden" id="intIdProducto'.$i.'" name="intIdProducto[]" form="form-venta" value="'.$fila['intIdProducto'].'" />'.
                '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigo'.$i.'" name="nvchCodigo[]" form="form-venta" value="'.$fila['nvchCodigo'].'" readonly/>'.
                '<div class="result" id="result'.$i.'">'.
            '</td>'.
            '<td><input type="text" style="width: 100% !important" id="nvchDescripcion'.$i.'" name="nvchDescripcion[]" form="form-venta" value="'.$fila['nvchDescripcion'].'" readonly/></td>';
            if($fila['intTipoDetalle'] == 1){
            echo
            '<td>'.
              '<input type="text" id="dcmPrecio'.$i.'" name="dcmPrecio[]" form="form-venta" value="'.$fila['dcmPrecio'].'" readonly />'.
            '</td>'.
            '<td><input type="text" style="max-width: 105px !important" id="dcmDescuento'.$i.'" name="dcmDescuento[]" form="form-venta" idsprt="'.$i.'"'.
              'onkeyup="CalcularPrecioTotal(this)" value="'.$fila['dcmDescuento'].'" readonly/></td>';
            }
            echo
            '<td><input type="text" style="max-width: 105px !important" id="dcmPrecioUnitario'.$i.'" name="dcmPrecioUnitario[]" form="form-venta" value="'.$fila['dcmPrecioUnitario'].'" readonly/></td>'.
            '<td><input type="text" id="intCantidad'.$i.'" name="intCantidad[]" form="form-venta" idsprt="'.$i.'"'.
              'onkeyup="CalcularPrecioTotal(this)" value="'.$fila['intCantidad'].'" readonly/></td>'.
            '<td><input type="text" id="dcmTotal'.$i.'" name="dcmTotal[]" form="form-venta" value="'.$fila['dcmTotal'].'" readonly/></td>'.
          '</tr>';
              $i++;
            } else if($fila['intIdTipoVenta'] == 2){
              echo
              '
              <tr>
              <td class="heading" data-th="ID">'.$i.'</td>
              <td>S'.$i.'</td>
              <td>'.$fila['nvchDescripcion'].'</td>
              <td>'.$fila['intCantidad'].'</td>
              <td>'.$fila['nvchSimbolo'].' '.$fila['dcmPrecioUnitario'].'</td>
              <td>'.$fila['nvchSimbolo'].' '.$fila['dcmTotal'].'</td>
          </tr>';
        /*
        if($fila['intIdTipoVenta'] == 1){
          echo
          '<tr>
              <td class="heading" data-th="ID"></td>
              <td>'.$i.'</td>
              <td>'.$fila['nvchCodigo'].'</td>
              <td>'.$fila['nvchDescripcion'].'</td>
              <td>'.$fila['intCantidad'].'</td>
              <td>'.$fila['nvchSimbolo'].' '.$fila['dcmPrecioUnitario'].'</td>
              <td>'.$fila['nvchSimbolo'].' '.$fila['dcmTotal'].'</td>
              </tr>';
              $i++;
            } else if($fila['intIdTipoVenta'] == 2){
              echo
              '
              <tr>
              <td class="heading" data-th="ID"></td>
              <td>'.$i.'</td>
              <td>S'.$i.'</td>
              <td>'.$fila['nvchDescripcion'].'</td>
              <td>'.$fila['intCantidad'].'</td>
              <td>'.$fila['nvchSimbolo'].' '.$fila['dcmPrecioUnitario'].'</td>
              <td>'.$fila['nvchSimbolo'].' '.$fila['dcmTotal'].'</td>
          </tr>';
          */
          $i++;
        }
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function EliminarDetalleComprobante()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarDetalleComprobante(:intIdDetalleComprobante)');
      $sql_comando -> execute(array(':intIdDetalleComprobante' => $this->intIdDetalleComprobante));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Detalle Orden Compra */
}
?>