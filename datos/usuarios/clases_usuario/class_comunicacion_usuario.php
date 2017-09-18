<?php
//session_start();
require_once '../conexion/bd_conexion.php';
class ComunicacionUsuario
{
  /* INICIO - Atributos de Comunicacion Usuario*/
  private $intIdComunicacionUsuario;
  private $intIdUsuario;
  private $nvchMedio;
  private $nvchLugar;
  private $intIdTipoComunicacion;
  
  public function IdComunicacionUsuario($intIdComunicacionUsuario){ $this->intIdComunicacionUsuario = $intIdComunicacionUsuario; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function Medio($nvchMedio){ $this->nvchMedio = $nvchMedio; }
  public function Lugar($nvchLugar){ $this->nvchLugar = $nvchLugar; }
  public function IdTipoComunicacion($intIdTipoComunicacion){ $this->intIdTipoComunicacion = $intIdTipoComunicacion; }
  /* FIN - Atributos de Comunicacion Usuario */

  /* INICIO - Métodos de Comunicacion Usuario */
  public function InsertarComunicacionUsuario()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->nvchMedio as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarcomunicacionUsuario(:intIdUsuario,:nvchMedio,
      	:nvchLugar,:intIdTipoComunicacion)');
      $sql_comando->execute(array(
        ':intIdUsuario' => $this->intIdUsuario, 
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

  public function InsertarComunicacionUsuario_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarcomunicacionUsuario(:intIdUsuario,:nvchMedio,
        :nvchLugar,:intIdTipoComunicacion)');
      $sql_comando->execute(array(
        ':intIdUsuario' => $this->intIdUsuario, 
        ':nvchMedio' => $this->nvchMedio,
        ':nvchLugar' => $this->nvchLugar,
        ':intIdTipoComunicacion' => $this->intIdTipoComunicacion));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarComunicacionUsuario($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarComunicacionesUsuario(:intIdUsuario)');
      $sql_comando -> execute(array(':intIdUsuario' => $this->intIdUsuario));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdComunicacionUsuario'] == $fila['intIdComunicacionUsuario'] && $tipolistado == "A"){
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
          <button type="button" idcu="'.$fila['intIdComunicacionUsuario'].'" class="btn btn-xs btn-warning" onclick="SeleccionarComunicacion(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" idcu="'.$fila['intIdComunicacionUsuario'].'" class="btn btn-xs btn-danger" onclick="EliminarComunicacion(this)">
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

  public function SeleccionarComunicacionUsuario()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarcomunicacionUsuario(:intIdComunicacionUsuario)');
      $sql_comando -> execute(array(':intIdComunicacionUsuario' => $this->intIdComunicacionUsuario));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdComunicacionUsuario'] = $fila['intIdComunicacionUsuario'];
      $salida['nvchMedio'] = $fila['nvchMedio'];
      $salida['nvchLugar'] = $fila['nvchLugar'];
      $salida['intIdTipoComunicacion'] = $fila['intIdTipoComunicacion'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarComunicacionUsuario()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarComunicacionUsuario(:intIdComunicacionUsuario,
        :intIdUsuario,:nvchMedio,:nvchLugar,:intIdTipoComunicacion)');
      $sql_comando->execute(array(
        ':intIdComunicacionUsuario' => $this->intIdComunicacionUsuario,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':nvchMedio' => $this->nvchMedio,
        ':nvchLugar' => $this->nvchLugar,
        ':intIdTipoComunicacion' => $this->intIdTipoComunicacion));
      $_SESSION['intIdComunicacionUsuario'] = $this->intIdComunicacionUsuario;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarComunicacionUsuario()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarComunicacionUsuario(:intIdComunicacionUsuario)');
      $sql_comando -> execute(array(':intIdComunicacionUsuario' => $this->intIdComunicacionUsuario));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Comunicacion Usuario */
}
?>