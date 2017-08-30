<?php
require_once '../conexion/bd_conexion.php';
class CodigoProducto
{
  /* INICIO - Atributos de Comunicacion Proveedor*/
  private $intIdCodigoProducto;
  private $intIdProducto;
  private $nvchCodigo;
  private $dtmFechaInicio;
  private $dtmFechaFinal;
  private $intIdTipoCodigoProducto;
  
  public function IdCodigoProducto($intIdCodigoProducto){ $this->intIdCodigoProducto = $intIdCodigoProducto; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function Codigo($nvchCodigo){ $this->nvchCodigo = $nvchCodigo; }
  public function FechaInicio($dtmFechaInicio){ $this->dtmFechaInicio = $dtmFechaInicio; }
  public function FechaFinal($dtmFechaFinal){ $this->dtmFechaFinal = $dtmFechaFinal; }
  public function IdTipoCodigoProducto($intIdTipoCodigoProducto){ $this->intIdTipoCodigoProducto = $intIdTipoCodigoProducto; }
  /* FIN - Atributos de Comunicacion Proveedor */

  /* INICIO - Métodos de Comunicacion Proveedor */
  public function InsertarCodigoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->nvchCodigo as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarCodigoProducto(:intIdProducto,:nvchCodigo,
      	:dtmFechaInicio,:dtmFechaFinal,:intIdTipoCodigoProducto)');
      $sql_comando->execute(array(
        ':intIdProducto' => $this->intIdProducto, 
        ':nvchCodigo' => $value,
        ':dtmFechaInicio' => $this->dtmFechaInicio,
        ':dtmFechaFinal' => $this->dtmFechaFinal,
        ':intIdTipoCodigoProducto' => $this->intIdTipoCodigoProducto[$key]));
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarCodigoProducto_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarCodigoProducto(:intIdProducto,:nvchCodigo,
        :dtmFechaInicio,:dtmFechaFinal,:intIdTipoCodigoProducto)');
      $sql_comando->execute(array(
        ':intIdProducto' => $this->intIdProducto, 
        ':nvchCodigo' => $this->nvchCodigo,
        ':dtmFechaInicio' => $this->dtmFechaInicio,
        ':dtmFechaFinal' => $this->dtmFechaFinal,
        ':intIdTipoCodigoProducto' => $this->intIdTipoCodigoProducto));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarCodigoProducto($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarcodigosproducto(:intIdProducto)');
      $sql_comando -> execute(array(':intIdProducto' => $this->intIdProducto));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdCodigoProducto'] == $fila['intIdCodigoProducto'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
      	echo '<td><input type="hidden" name="nvchCodigo[]" value="'.$fila['nvchCodigo'].'"/>'.$fila['nvchCodigo'].'</td>
        <td><input type="hidden" name="dtmFechaInicio[]" value="'.$fila['dtmFechaInicio'].'"/>'.$fila['dtmFechaInicio'].'</td>
        <td><input type="hidden" name="dtmFechaFinal[]" value="'.$fila['dtmFechaFinal'].'"/>'.$fila['dtmFechaFinal'].'</td>
        <td><input type="hidden" name="intIdTipoCodigoProducto[]" value="'.$fila['intIdTipoCodigoProducto'].'"/>'.$fila['NombreTipoCodigo'].'</td>
        <td> 
          <button type="button" idcp="'.$fila['intIdCodigoProducto'].'" class="btn btn-xs btn-warning" onclick="SeleccionarCodigo(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" idcp="'.$fila['intIdCodigoProducto'].'" class="btn btn-xs btn-danger" onclick="EliminarCodigo(this)">
            <i class="fa fa-edit"></i> Eliminar
          </button>
        </td>
        </tr>';
        $i++;
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function SeleccionarCodigoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarCodigoProducto(:intIdCodigoProducto)');
      $sql_comando -> execute(array(':intIdCodigoProducto' => $this->intIdCodigoProducto));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdCodigoProducto'] = $fila['intIdCodigoProducto'];
      $salida['nvchCodigo'] = $fila['nvchCodigo'];
      $salida['dtmFechaInicio'] = $fila['dtmFechaInicio'];
      $salida['dtmFechaFinal'] = $fila['dtmFechaFinal'];
      $salida['intIdTipoCodigoProducto'] = $fila['intIdTipoCodigoProducto'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarCodigoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarCodigoProducto(:intIdCodigoProducto,:intIdProducto,:nvchCodigo,
        :dtmFechaInicio,:dtmFechaFinal,:intIdTipoCodigoProducto)');
      $sql_comando->execute(array(
        ':intIdCodigoProducto' => $this->intIdCodigoProducto,
        ':intIdProducto' => $this->intIdProducto, 
        ':nvchCodigo' => $this->nvchCodigo,
        ':dtmFechaInicio' => $this->dtmFechaInicio,
        ':dtmFechaFinal' => $this->dtmFechaFinal,
        ':intIdTipoCodigoProducto' => $this->intIdTipoCodigoProducto));
      $_SESSION['intIdCodigoProducto'] = $this->intIdCodigoProducto;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarCodigoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarCodigoProducto(:intIdCodigoProducto)');
      $sql_comando -> execute(array(':intIdCodigoProducto' => $this->intIdCodigoProducto));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Comunicacion Proveedor */
}
?>