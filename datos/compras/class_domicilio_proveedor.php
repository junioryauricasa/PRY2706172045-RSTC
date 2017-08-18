<?php
//session_start();
require_once '../conexion/bd_conexion.php';
class DomicilioProveedor
{
  /* INICIO - Atributos de Domicilio Proveedor*/
  private $intIdDomicilioProveedor;
  private $intIdProveedor;
  private $nvchPais;
  private $nvchRegion;
  private $nvchProvincia;
  private $nvchDistrito;
  private $nvchDireccion;
  private $intIdTipoDomicilio;
  
  public function IdDomicilioProveedor($intIdDomicilioProveedor){ $this->intIdDomicilioProveedor = $intIdDomicilioProveedor; }
  public function IdProveedor($intIdProveedor){ $this->intIdProveedor = $intIdProveedor; }
  public function Pais($nvchPais){ $this->nvchPais = $nvchPais; }
  public function Region($nvchRegion){ $this->nvchRegion = $nvchRegion; }
  public function Provincia($nvchProvincia){ $this->nvchProvincia = $nvchProvincia; }
  public function Distrito($nvchDistrito){ $this->nvchDistrito = $nvchDistrito; }
  public function Direccion($nvchDireccion){ $this->nvchDireccion = $nvchDireccion; }
  public function IdTipoDomicilio($intIdTipoDomicilio){ $this->intIdTipoDomicilio = $intIdTipoDomicilio; }
  /* FIN - Atributos de Domicilio Proveedor */

  /* INICIO - Métodos de Domicilio Proveedor */
  public function InsertarDomicilioProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->nvchPais as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertardomicilioproveedor(:intIdProveedor,:nvchPais,
      	:nvchRegion,:nvchProvincia,:nvchDistrito,:nvchDireccion,:intIdTipoDomicilio)');
      $sql_comando->execute(array(
        ':intIdProveedor' => $this->intIdProveedor, 
        ':nvchPais' => $value,
        ':nvchRegion' => $this->nvchRegion[$key],
        ':nvchProvincia' => $this->nvchProvincia[$key],
        ':nvchDistrito' => $this->nvchDistrito[$key],
        ':nvchDireccion' => $this->nvchDireccion[$key],
        ':intIdTipoDomicilio' => $this->intIdTipoDomicilio[$key]));
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarDomicilioProveedor($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrardomicilioproveedor(:intIdProveedor)');
      $sql_comando -> execute(array(':intIdProveedor' => $this->intIdProveedor));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
      	echo
      	'<tr>
        <td>'.$fila['nvchPais'].'</td>
        <td>'.$fila['nvchRegion'].'</td>
        <td>'.$fila['nvchProvincia'].'</td>
        <td>'.$fila['nvchDistrito'].'</td>
        <td>'.$fila['nvchDireccion'].'</td>
        <td>'.$fila['intIdTipoDomicilio'].'</td>
        <td> 
          <button type="submit" iddp="'.$fila['intIdDomicilioProveedor'].'" class="btn btn-xs btn-warning btn-editar-domicilio-proveedor">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="submit" iddp="'.$fila['intIdDomicilioProveedor'].'" class="btn btn-xs btn-danger btn-eliminar-domicilio-proveedor">
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

  public function ActualizarDomicilioProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizardomicilioproveedor(:intIdDomicilioProveedor,
      	:intIdProveedor,:nvchPais,:nvchRegion,:nvchProvincia,:nvchDistrito,:nvchDireccion,:intIdTipoDomicilio)');
      $sql_comando->execute(array(
        ':intIdDomicilioProveedor' => $this->intIdDomicilioProveedor,
        ':intIdProveedor' => $this->intIdProveedor, 
        ':nvchPais' => $this->nvchPais,
        ':nvchRegion' => $this->nvchRegion,
        ':nvchProvincia' => $this->nvchProvincia,
        ':nvchDistrito' => $this->nvchDistrito,
        ':nvchDireccion' => $this->nvchDireccion,
        ':intIdTipoDomicilio' => $this->intIdTipoDomicilio));
      $_SESSION['intIdDomicilioProveedor'] = $salida->intIdDomicilioProveedor;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarDomicilioProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminardomicilioproveedor(:intIdDomicilioProveedor)');
      $sql_comando -> execute(array(':intIdDomicilioProveedor' => $this->intIdDomicilioProveedor));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Domicilio Proveedor */
}
?>