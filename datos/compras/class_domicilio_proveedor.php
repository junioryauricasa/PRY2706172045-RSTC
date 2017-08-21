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

  public function InsertarDomicilioProveedor_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertardomicilioproveedor(:intIdProveedor,:nvchPais,
        :nvchRegion,:nvchProvincia,:nvchDistrito,:nvchDireccion,:intIdTipoDomicilio)');
      $sql_comando->execute(array(
        ':intIdProveedor' => $this->intIdProveedor, 
        ':nvchPais' => $this->nvchPais,
        ':nvchRegion' => $this->nvchRegion,
        ':nvchProvincia' => $this->nvchProvincia,
        ':nvchDistrito' => $this->nvchDistrito,
        ':nvchDireccion' => $this->nvchDireccion,
        ':intIdTipoDomicilio' => $this->intIdTipoDomicilio));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarDomicilioProveedor($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrardomiciliosproveedor(:intIdProveedor)');
      $sql_comando -> execute(array(':intIdProveedor' => $this->intIdProveedor));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdDomicilioProveedor'] == $fila['intIdDomicilioProveedor'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
        echo '<td><input type="hidden" name="nvchPais[]" value="'.$fila['nvchPais'].'"/>'.$fila['nvchPais'].'</td>
        <td><input type="hidden" name="nvchRegion[]" value="'.$fila['nvchRegion'].'"/>'.$fila['nvchRegion'].'</td>
        <td><input type="hidden" name="nvchProvincia[]" value="'.$fila['nvchProvincia'].'"/>'.$fila['nvchProvincia'].'</td>
        <td><input type="hidden" name="nvchDistrito[]" value="'.$fila['nvchDistrito'].'"/>'.$fila['nvchDistrito'].'</td>
        <td><input type="hidden" name="nvchDireccion[]" value="'.$fila['nvchDireccion'].'"/>'.$fila['nvchDireccion'].'</td>
        <td><input type="hidden" name="intIdTipoDomicilio[]" value="'.$fila['intIdTipoDomicilio'].'"/>'.$fila['NombreTD'].'</td>
        <td> 
          <button type="button" iddp="'.$fila['intIdDomicilioProveedor'].'" class="btn btn-xs btn-warning" onclick="SeleccionarDomicilio(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" iddp="'.$fila['intIdDomicilioProveedor'].'" class="btn btn-xs btn-danger" onclick="EliminarDomicilio(this)">
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

  public function SeleccionarDomicilioProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionardomicilioproveedor(:intIdDomicilioProveedor)');
      $sql_comando -> execute(array(':intIdDomicilioProveedor' => $this->intIdDomicilioProveedor));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdDomicilioProveedor'] = $fila['intIdDomicilioProveedor'];
      $salida['nvchPais'] = $fila['nvchPais'];
      $salida['nvchRegion'] = $fila['nvchRegion'];
      $salida['nvchProvincia'] = $fila['nvchProvincia'];
      $salida['nvchDistrito'] = $fila['nvchDistrito'];
      $salida['nvchDireccion'] = $fila['nvchDireccion'];
      $salida['intIdTipoDomicilio'] = $fila['intIdTipoDomicilio'];
      echo json_encode($salida);
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
      $_SESSION['intIdDomicilioProveedor'] = $this->intIdDomicilioProveedor;
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