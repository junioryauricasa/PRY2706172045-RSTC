<?php 
require_once '../conexion/bd_conexion.php';
class DetalleVenta
{	
  /* INICIO - Atributos de Detalle Orden Compra*/
  private $intIdOperacionVenta;
  private $intIdVenta;
  private $intIdProducto;
  private $dtmFechaRealizada;
  private $intCantidad;
  private $dcmPrecio;
  private $dcmDescuento;
  private $dcmPrecioUnitario;
  private $dcmTotal;
  private $intIdTipoVenta;
  private $nvchDescripcionServicio;
  
  public function IdOperacionVenta($intIdOperacionVenta){ $this->intIdOperacionVenta = $intIdOperacionVenta; }
  public function IdVenta($intIdVenta){ $this->intIdVenta = $intIdVenta; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function FechaRealizada($dtmFechaRealizada){ $this->dtmFechaRealizada = $dtmFechaRealizada; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function Precio($dcmPrecio){ $this->dcmPrecio = $dcmPrecio; }
  public function Descuento($dcmDescuento){ $this->dcmDescuento = $dcmDescuento; }
  public function PrecioUnitario($dcmPrecioUnitario){ $this->dcmPrecioUnitario = $dcmPrecioUnitario; }
  public function Total($dcmTotal){ $this->dcmTotal = $dcmTotal; }
  public function IdTipoVenta($intIdTipoVenta){ $this->intIdTipoVenta = $intIdTipoVenta; }
  public function DescripcionServicio($nvchDescripcionServicio){ $this->nvchDescripcionServicio = $nvchDescripcionServicio; }
  /* FIN - Atributos de Detalle Orden Compra */

  /* INICIO - Métodos de Detalle Orden Compra */
  public function InsertarDetalleVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->intCantidad as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarDetalleVenta(:intIdVenta,
      	:intIdProducto,:dtmFechaRealizada,:intCantidad,:dcmPrecio,:dcmDescuento,:dcmPrecioUnitario,
        :dcmTotal,:intIdTipoVenta,:nvchDescripcionServicio)');
      if($this->intIdTipoVenta == 1){
          $sql_comando->execute(array(
          ':intIdVenta' => $this->intIdVenta, 
          ':intIdProducto' => $this->intIdProducto[$key],
          ':dtmFechaRealizada' => $this->dtmFechaRealizada,
          ':intCantidad' => $value,
          ':dcmPrecio' => $this->dcmPrecio[$key],
          ':dcmDescuento' => $this->dcmDescuento[$key],
          ':dcmPrecioUnitario' => $this->dcmPrecioUnitario[$key],
          ':dcmTotal' => $this->dcmTotal[$key],
          ':intIdTipoVenta' => $this->intIdTipoVenta,
          ':nvchDescripcionServicio' => ''));
        } else if($this->intIdTipoVenta == 2){
          $sql_comando->execute(array(
          ':intIdVenta' => $this->intIdVenta,
          ':intIdProducto' => 1,
          ':dtmFechaRealizada' => $this->dtmFechaRealizada,
          ':intCantidad' => $value,
          ':dcmPrecio' => 0.00,
          ':dcmDescuento' => 0.00,
          ':dcmPrecioUnitario' => $this->dcmPrecioUnitario[$key],
          ':dcmTotal' => $this->dcmTotal[$key],
          ':intIdTipoVenta' => $this->intIdTipoVenta,
          ':nvchDescripcionServicio' => $this->nvchDescripcionServicio[$key]));
        }
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarDetalleVenta_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarDetalleVenta(:intIdVenta,
      	:intIdProducto,:dtmFechaRealizada,:intCantidad,:dcmPrecio)');
      $sql_comando->execute(array(
        ':intIdVenta' => $this->intIdVenta, 
        ':intIdProducto' => $this->intIdProducto,
        ':dtmFechaRealizada' => $this->dtmFechaRealizada,
        ':intCantidad' => $this->intCantidad,
        ':dcmPrecio' => $this->dcmPrecio));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarDetalleVenta($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleVenta(:intIdVenta)');
      $sql_comando -> execute(array(':intIdVenta' => $this->intIdVenta));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($fila['intIdTipoVenta'] == 1){
          echo
          '<tr>
              <td class="heading" data-th="ID"></td>
              <td>'.$i.'</td>
              <td>'.$fila['CodigoProducto'].'</td>
              <td>'.$fila['DescripcionProducto'].'</td>
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
              <td>C'.$i.'</td>
              <td>'.$fila['nvchDescripcionServicio'].'</td>
              <td>'.$fila['intCantidad'].'</td>
              <td>'.$fila['nvchSimbolo'].' '.$fila['dcmPrecioUnitario'].'</td>
              <td>'.$fila['nvchSimbolo'].' '.$fila['dcmTotal'].'</td>
          </tr>';
          $i++;
        }
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function SeleccionarDetalleVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarDetalleVenta(:intIdOperacionVenta)');
      $sql_comando -> execute(array(':intIdOperacionVenta' => $this->intIdOperacionVenta));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdOperacionVenta'] = $fila['intIdOperacionVenta'];
      $salida['intIdVenta'] = $fila['intIdVenta'];
      $salida['intIdProducto'] = $fila['intIdProducto'];
      $salida['nvchDescripcion'] = $fila['nvchDescripcion'];
      $salida['dtmFechaRealizada'] = $fila['dtmFechaRealizada'];
      $salida['intCantidad'] = $fila['intCantidad'];
      $salida['dcmPrecio'] = $fila['dcmPrecio'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarDetalleVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarDetalleVenta(:intIdOperacionVenta,
        :intIdVenta,:intIdProducto,:dtmFechaRealizada,:intCantidad,:dcmPrecio)');
      $sql_comando->execute(array(
        ':intIdOperacionVenta' => $this->intIdOperacionVenta,
        ':intIdVenta' => $this->intIdVenta, 
        ':intIdProducto' => $this->intIdProducto, 
        ':dtmFechaRealizada' => $this->dtmFechaRealizada,
        ':intCantidad' => $this->intCantidad,
        ':dcmPrecio' => $this->dcmPrecio));
      $_SESSION['intIdOperacionVenta'] = $this->intIdOperacionVenta;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarDetalleVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarDetalleVenta(:intIdOperacionVenta)');
      $sql_comando -> execute(array(':intIdOperacionVenta' => $this->intIdOperacionVenta));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Detalle Orden Compra */
}
?>