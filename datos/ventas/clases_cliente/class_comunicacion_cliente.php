<?php
//session_start();
require_once '../conexion/bd_conexion.php';
class ComunicacionCliente
{
  /* INICIO - Atributos de Comunicacion Cliente*/
  private $intIdComunicacionCliente;
  private $intIdCliente;
  private $nvchMedio;
  private $nvchLugar;
  private $intIdTipoComunicacion;
  
  public function IdComunicacionCliente($intIdComunicacionCliente){ $this->intIdComunicacionCliente = $intIdComunicacionCliente; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function Medio($nvchMedio){ $this->nvchMedio = $nvchMedio; }
  public function Lugar($nvchLugar){ $this->nvchLugar = $nvchLugar; }
  public function IdTipoComunicacion($intIdTipoComunicacion){ $this->intIdTipoComunicacion = $intIdTipoComunicacion; }
  /* FIN - Atributos de Comunicacion Cliente */

  /* INICIO - Métodos de Comunicacion Cliente */
  public function InsertarComunicacionCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->nvchMedio as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarcomunicacionCliente(:intIdCliente,:nvchMedio,
      	:nvchLugar,:intIdTipoComunicacion)');
      $sql_comando->execute(array(
        ':intIdCliente' => $this->intIdCliente, 
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

  public function InsertarComunicacionCliente_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarcomunicacionCliente(:intIdCliente,:nvchMedio,
        :nvchLugar,:intIdTipoComunicacion)');
      $sql_comando->execute(array(
        ':intIdCliente' => $this->intIdCliente, 
        ':nvchMedio' => $this->nvchMedio,
        ':nvchLugar' => $this->nvchLugar,
        ':intIdTipoComunicacion' => $this->intIdTipoComunicacion));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarComunicacionCliente($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarComunicacionesCliente(:intIdCliente)');
      $sql_comando -> execute(array(':intIdCliente' => $this->intIdCliente));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdComunicacionCliente'] == $fila['intIdComunicacionCliente'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
      	echo '
            <td class="heading" data-th="ID"></td>
            <td><input type="hidden" name="nvchMedio[]" value="'.$fila['nvchMedio'].'"/>'.$fila['nvchMedio'].'</td>
            <td><input type="hidden" name="nvchLugar[]" value="'.$fila['nvchLugar'].'"/>'.$fila['nvchLugar'].'</td>
            <td><input type="hidden" name="intIdTipoComunicacion[]" value="'.$fila['intIdTipoComunicacion'].'"/>'.$fila['NombreTC'].'</td>
            <td> 
              <button type="button" idccl="'.$fila['intIdComunicacionCliente'].'" class="btn btn-xs btn-warning" onclick="SeleccionarComunicacion(this)">
                <i class="fa fa-edit"></i> Editar
              </button>
              <button type="button" idccl="'.$fila['intIdComunicacionCliente'].'" class="btn btn-xs btn-danger" onclick="EliminarComunicacion(this)">
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

  public function SeleccionarComunicacionCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarcomunicacionCliente(:intIdComunicacionCliente)');
      $sql_comando -> execute(array(':intIdComunicacionCliente' => $this->intIdComunicacionCliente));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdComunicacionCliente'] = $fila['intIdComunicacionCliente'];
      $salida['nvchMedio'] = $fila['nvchMedio'];
      $salida['nvchLugar'] = $fila['nvchLugar'];
      $salida['intIdTipoComunicacion'] = $fila['intIdTipoComunicacion'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarComunicacionCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarComunicacionCliente(:intIdComunicacionCliente,
        :intIdCliente,:nvchMedio,:nvchLugar,:intIdTipoComunicacion)');
      $sql_comando->execute(array(
        ':intIdComunicacionCliente' => $this->intIdComunicacionCliente,
        ':intIdCliente' => $this->intIdCliente, 
        ':nvchMedio' => $this->nvchMedio,
        ':nvchLugar' => $this->nvchLugar,
        ':intIdTipoComunicacion' => $this->intIdTipoComunicacion));
      $_SESSION['intIdComunicacionCliente'] = $this->intIdComunicacionCliente;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarComunicacionCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarComunicacionCliente(:intIdComunicacionCliente)');
      $sql_comando -> execute(array(':intIdComunicacionCliente' => $this->intIdComunicacionCliente));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Comunicacion Cliente */
}
?>