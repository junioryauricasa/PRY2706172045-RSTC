<?php
//session_start();
require_once '../conexion/bd_conexion.php';
class ComunicacionEmpleado
{
  /* INICIO - Atributos de Comunicacion Empleado*/
  private $intIdComunicacionEmpleado;
  private $intIdEmpleado;
  private $nvchMedio;
  private $nvchLugar;
  private $intIdTipoComunicacion;
  
  public function IdComunicacionEmpleado($intIdComunicacionEmpleado){ $this->intIdComunicacionEmpleado = $intIdComunicacionEmpleado; }
  public function IdEmpleado($intIdEmpleado){ $this->intIdEmpleado = $intIdEmpleado; }
  public function Medio($nvchMedio){ $this->nvchMedio = $nvchMedio; }
  public function Lugar($nvchLugar){ $this->nvchLugar = $nvchLugar; }
  public function IdTipoComunicacion($intIdTipoComunicacion){ $this->intIdTipoComunicacion = $intIdTipoComunicacion; }
  /* FIN - Atributos de Comunicacion Empleado */

  /* INICIO - Métodos de Comunicacion Empleado */
  public function InsertarComunicacionEmpleado()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->nvchMedio as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarcomunicacionEmpleado(:intIdEmpleado,:nvchMedio,
      	:nvchLugar,:intIdTipoComunicacion)');
      $sql_comando->execute(array(
        ':intIdEmpleado' => $this->intIdEmpleado, 
        ':nvchMedio' => $value,
        ':nvchLugar' => $this->nvchLugar[$key],
        ':intIdTipoComunicacion' => $this->intIdTipoComunicacion[$key]));
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarComunicacionEmpleado_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarcomunicacionEmpleado(:intIdEmpleado,:nvchMedio,
        :nvchLugar,:intIdTipoComunicacion)');
      $sql_comando->execute(array(
        ':intIdEmpleado' => $this->intIdEmpleado, 
        ':nvchMedio' => $this->nvchMedio,
        ':nvchLugar' => $this->nvchLugar,
        ':intIdTipoComunicacion' => $this->intIdTipoComunicacion));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarComunicacionEmpleado($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarComunicacionesEmpleado(:intIdEmpleado)');
      $sql_comando -> execute(array(':intIdEmpleado' => $this->intIdEmpleado));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdComunicacionEmpleado'] == $fila['intIdComunicacionEmpleado'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
      	echo '<td><input type="hidden" name="nvchMedio[]" value="'.$fila['nvchMedio'].'"/>'.$fila['nvchMedio'].'</td>
        <td><input type="hidden" name="nvchLugar[]" value="'.$fila['nvchLugar'].'"/>'.$fila['nvchLugar'].'</td>
        <td><input type="hidden" name="intIdTipoComunicacion[]" value="'.$fila['intIdTipoComunicacion'].'"/>'.$fila['NombreTC'].'</td>
        <td> 
          <button type="button" idccl="'.$fila['intIdComunicacionEmpleado'].'" class="btn btn-xs btn-warning" onclick="SeleccionarComunicacion(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" idccl="'.$fila['intIdComunicacionEmpleado'].'" class="btn btn-xs btn-danger" onclick="EliminarComunicacion(this)">
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

  public function SeleccionarComunicacionEmpleado()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarcomunicacionEmpleado(:intIdComunicacionEmpleado)');
      $sql_comando -> execute(array(':intIdComunicacionEmpleado' => $this->intIdComunicacionEmpleado));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdComunicacionEmpleado'] = $fila['intIdComunicacionEmpleado'];
      $salida['nvchMedio'] = $fila['nvchMedio'];
      $salida['nvchLugar'] = $fila['nvchLugar'];
      $salida['intIdTipoComunicacion'] = $fila['intIdTipoComunicacion'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarComunicacionEmpleado()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarComunicacionEmpleado(:intIdComunicacionEmpleado,
        :intIdEmpleado,:nvchMedio,:nvchLugar,:intIdTipoComunicacion)');
      $sql_comando->execute(array(
        ':intIdComunicacionEmpleado' => $this->intIdComunicacionEmpleado,
        ':intIdEmpleado' => $this->intIdEmpleado, 
        ':nvchMedio' => $this->nvchMedio,
        ':nvchLugar' => $this->nvchLugar,
        ':intIdTipoComunicacion' => $this->intIdTipoComunicacion));
      $_SESSION['intIdComunicacionEmpleado'] = $this->intIdComunicacionEmpleado;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarComunicacionEmpleado()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarComunicacionEmpleado(:intIdComunicacionEmpleado)');
      $sql_comando -> execute(array(':intIdComunicacionEmpleado' => $this->intIdComunicacionEmpleado));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Comunicacion Empleado */
}
?>