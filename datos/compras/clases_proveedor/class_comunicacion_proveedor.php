<?php
require_once '../conexion/bd_conexion.php';
class ComunicacionProveedor
{
  /* INICIO - Atributos de Comunicacion Proveedor*/
  private $intIdComunicacionProveedor;
  private $intIdProveedor;
  private $nvchMedio;
  private $nvchLugar;
  private $intIdTipoComunicacion;
  
  public function IdComunicacionProveedor($intIdComunicacionProveedor){ $this->intIdComunicacionProveedor = $intIdComunicacionProveedor; }
  public function IdProveedor($intIdProveedor){ $this->intIdProveedor = $intIdProveedor; }
  public function Medio($nvchMedio){ $this->nvchMedio = $nvchMedio; }
  public function Lugar($nvchLugar){ $this->nvchLugar = $nvchLugar; }
  public function IdTipoComunicacion($intIdTipoComunicacion){ $this->intIdTipoComunicacion = $intIdTipoComunicacion; }
  /* FIN - Atributos de Comunicacion Proveedor */

  /* INICIO - Métodos de Comunicacion Proveedor */
  public function InsertarComunicacionProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->nvchMedio as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarcomunicacionproveedor(:intIdProveedor,:nvchMedio,
      	:nvchLugar,:intIdTipoComunicacion)');
      $sql_comando->execute(array(
        ':intIdProveedor' => $this->intIdProveedor, 
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

  public function InsertarComunicacionProveedor_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarcomunicacionproveedor(:intIdProveedor,:nvchMedio,
        :nvchLugar,:intIdTipoComunicacion)');
      $sql_comando->execute(array(
        ':intIdProveedor' => $this->intIdProveedor, 
        ':nvchMedio' => $this->nvchMedio,
        ':nvchLugar' => $this->nvchLugar,
        ':intIdTipoComunicacion' => $this->intIdTipoComunicacion));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarComunicacionProveedor($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarComunicacionesProveedor(:intIdProveedor)');
      $sql_comando -> execute(array(':intIdProveedor' => $this->intIdProveedor));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdComunicacionProveedor'] == $fila['intIdComunicacionProveedor'] && $tipolistado == "A"){
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
              <button type="button" idcp="'.$fila['intIdComunicacionProveedor'].'" class="btn btn-xs btn-warning" onclick="SeleccionarComunicacion(this)">
                <i class="fa fa-edit"></i> Editar
              </button>
              <button type="button" idcp="'.$fila['intIdComunicacionProveedor'].'" class="btn btn-xs btn-danger" onclick="EliminarComunicacion(this)">
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

  public function SeleccionarComunicacionProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarcomunicacionproveedor(:intIdComunicacionProveedor)');
      $sql_comando -> execute(array(':intIdComunicacionProveedor' => $this->intIdComunicacionProveedor));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdComunicacionProveedor'] = $fila['intIdComunicacionProveedor'];
      $salida['nvchMedio'] = $fila['nvchMedio'];
      $salida['nvchLugar'] = $fila['nvchLugar'];
      $salida['intIdTipoComunicacion'] = $fila['intIdTipoComunicacion'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarComunicacionProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarComunicacionProveedor(:intIdComunicacionProveedor,
        :intIdProveedor,:nvchMedio,:nvchLugar,:intIdTipoComunicacion)');
      $sql_comando->execute(array(
        ':intIdComunicacionProveedor' => $this->intIdComunicacionProveedor,
        ':intIdProveedor' => $this->intIdProveedor, 
        ':nvchMedio' => $this->nvchMedio,
        ':nvchLugar' => $this->nvchLugar,
        ':intIdTipoComunicacion' => $this->intIdTipoComunicacion));
      $_SESSION['intIdComunicacionProveedor'] = $this->intIdComunicacionProveedor;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarComunicacionProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarComunicacionProveedor(:intIdComunicacionProveedor)');
      $sql_comando -> execute(array(':intIdComunicacionProveedor' => $this->intIdComunicacionProveedor));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Comunicacion Proveedor */
}
?>