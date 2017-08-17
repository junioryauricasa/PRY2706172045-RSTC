<?php
session_start();
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
      $sql_comando = $sql_conectar->prepare('CALL insertarComunicacionProveedor(:intIdProveedor,:nvchMedio,
      	:nvchLugar,:intIdTipoDomicilio)');
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

  public function MostrarComunicacionProveedor($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarComunicacionProveedor(:intIdProveedor)');
      $sql_comando -> execute(array(':intIdProveedor' => $this->intIdProveedor));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
      	echo
      	'<tr>
        <td>'.$fila['nvchMedio'].'</td>
        <td>'.$fila['nvchLugar'].'</td>
        <td>'.$fila['nvchIdTipoDomicilio'].'</td>
        <td> 
          <button type="submit" idcp="'.$fila['intIdComunicacionProveedor'].'" class="btn btn-xs btn-warning btn-mostrar-proveedor">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="submit" idcp="'.$fila['intIdComunicacionProveedor'].'" class="btn btn-xs btn-danger btn-eliminar-proveedor">
            <i class="fa fa-edit"></i> Eliminar
          </button>
        </td>
        </tr>';
      }
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
      	:intIdProveedor,:nvchPais,:nvchRegion,:nvchProvincia,:nvchDistrito,:nvchDireccion,:intIdTipoDomicilio)');
      $sql_comando->execute(array(
        ':intIdComunicacionProveedor' => $this->intIdComunicacionProveedor,
        ':intIdProveedor' => $this->intIdProveedor, 
        ':nvchPais' => $this->nvchPais,
        ':nvchRegion' => $this->nvchRegion,
        ':nvchProvincia' => $this->nvchProvincia,
        ':nvchDistrito' => $this->nvchDistrito,
        ':nvchDireccion' => $this->nvchDireccion,
        ':intIdTipoDomicilio' => $this->intIdTipoDomicilio));
      $_SESSION['intIdComunicacionProveedor'] = $salida->intIdComunicacionProveedor;
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