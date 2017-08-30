<?php
require_once '../conexion/bd_conexion.php';
class UbigeoProducto
{
  /* INICIO - Atributos de Comunicacion Proveedor*/
  private $intIdUbigeoProducto;
  private $intIdProducto;
  private $nvchSucursal;
  private $nvchUbicacion;
  private $intCantidadUbigeo;
  
  public function IdUbigeoProducto($intIdUbigeoProducto){ $this->intIdUbigeoProducto = $intIdUbigeoProducto; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function Sucursal($nvchSucursal){ $this->nvchSucursal = $nvchSucursal; }
  public function Ubicacion($nvchUbicacion){ $this->nvchUbicacion = $nvchUbicacion; }
  public function CantidadUbigeo($intCantidadUbigeo){ $this->intCantidadUbigeo = $intCantidadUbigeo; }
  /* FIN - Atributos de Comunicacion Proveedor */

  /* INICIO - Métodos de Comunicacion Proveedor */
  public function InsertarUbigeoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->nvchSucursal as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarUbigeoProducto(:intIdProducto,:nvchSucursal,
      	:nvchUbicacion,:intCantidadUbigeo)');
      $sql_comando->execute(array(
        ':intIdProducto' => $this->intIdProducto, 
        ':nvchSucursal' => $value,
        ':nvchUbicacion' => $this->nvchUbicacion[$key],
        ':intCantidadUbigeo' => $this->intCantidadUbigeo[$key]));
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarUbigeoProducto_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarUbigeoProducto(:intIdProducto,:nvchSucursal,
        :nvchUbicacion,:intCantidadUbigeo)');
      $sql_comando->execute(array(
        ':intIdProducto' => $this->intIdProducto, 
        ':nvchSucursal' => $this->nvchSucursal,
        ':nvchUbicacion' => $this->nvchUbicacion,
        ':intCantidadUbigeo' => $this->intCantidadUbigeo));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarUbigeoProducto($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarubigeosproducto(:intIdProducto)');
      $sql_comando -> execute(array(':intIdProducto' => $this->intIdProducto));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdUbigeoProducto'] == $fila['intIdUbigeoProducto'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
      	echo '<td><input type="hidden" name="nvchSucursal[]" value="'.$fila['nvchSucursal'].'"/>'.$fila['nvchSucursal'].'</td>
        <td><input type="hidden" name="nvchUbicacion[]" value="'.$fila['nvchUbicacion'].'"/>'.$fila['nvchUbicacion'].'</td>
        <td><input type="hidden" name="intCantidadUbigeo[]" value="'.$fila['intCantidadUbigeo'].'"/>'.$fila['intCantidadUbigeo'].'</td>
        <td> 
          <button type="button" idcp="'.$fila['intIdUbigeoProducto'].'" class="btn btn-xs btn-warning" onclick="SeleccionarComunicacion(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" idcp="'.$fila['intIdUbigeoProducto'].'" class="btn btn-xs btn-danger" onclick="EliminarComunicacion(this)">
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

  public function SeleccionarUbigeoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarUbigeoProducto(:intIdUbigeoProducto)');
      $sql_comando -> execute(array(':intIdUbigeoProducto' => $this->intIdUbigeoProducto));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdUbigeoProducto'] = $fila['intIdUbigeoProducto'];
      $salida['nvchCodigo'] = $fila['nvchCodigo'];
      $salida['dtmFechaInicio'] = $fila['dtmFechaInicio'];
      $salida['dtmFechaFinal'] = $fila['dtmFechaFinal'];
      $salida['intCantidadUbigeo'] = $fila['intCantidadUbigeo'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarUbigeoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarUbigeoProducto(:intIdUbigeoProducto,:intIdProducto,:nvchSucursal,
        :nvchUbicacion,:intCantidadUbigeo)');
      $sql_comando->execute(array(
        ':intIdUbigeoProducto' => $this->intIdUbigeoProducto,
        ':intIdProducto' => $this->intIdProducto, 
        ':nvchSucursal' => $this->nvchSucursal,
        ':nvchUbicacion' => $this->nvchUbicacion,
        ':intCantidadUbigeo' => $this->intCantidadUbigeo));
      $_SESSION['intIdUbigeoProducto'] = $this->intIdUbigeoProducto;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarUbigeoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarUbigeoProducto(:intIdUbigeoProducto)');
      $sql_comando -> execute(array(':intIdUbigeoProducto' => $this->intIdUbigeoProducto));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Comunicacion Proveedor */
}
?>