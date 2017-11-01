<?php
require_once '../conexion/bd_conexion.php';
class DomicilioProveedor
{
  /* INICIO - Atributos de Domicilio Proveedor*/
  private $intIdDomicilioProveedor;
  private $intIdProveedor;
  private $nvchPais;
  private $intIdDepartamento;
  private $intIdProvincia;
  private $intIdDistrito;
  private $nvchDireccion;
  private $intIdTipoDomicilio;
  
  public function IdDomicilioProveedor($intIdDomicilioProveedor){ $this->intIdDomicilioProveedor = $intIdDomicilioProveedor; }
  public function IdProveedor($intIdProveedor){ $this->intIdProveedor = $intIdProveedor; }
  public function Pais($nvchPais){ $this->nvchPais = $nvchPais; }
  public function IdDepartamento($intIdDepartamento){ $this->intIdDepartamento = $intIdDepartamento; }
  public function IdProvincia($intIdProvincia){ $this->intIdProvincia = $intIdProvincia; }
  public function IdDistrito($intIdDistrito){ $this->intIdDistrito = $intIdDistrito; }
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
      $sql_comando = $sql_conectar->prepare('CALL insertardomicilioProveedor(:intIdProveedor,:nvchPais,
        :intIdDepartamento,:intIdProvincia,:intIdDistrito,:nvchDireccion,:intIdTipoDomicilio)');
      $sql_comando->execute(array(
        ':intIdProveedor' => $this->intIdProveedor, 
        ':nvchPais' => $value,
        ':intIdDepartamento' => $this->intIdDepartamento[$key],
        ':intIdProvincia' => $this->intIdProvincia[$key],
        ':intIdDistrito' => $this->intIdDistrito[$key],
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
      $sql_comando = $sql_conectar->prepare('CALL insertardomicilioProveedor(:intIdProveedor,:nvchPais,
        :intIdDepartamento,:intIdProvincia,:intIdDistrito,:nvchDireccion,:intIdTipoDomicilio)');
      $sql_comando->execute(array(
        ':intIdProveedor' => $this->intIdProveedor, 
        ':nvchPais' => $this->nvchPais,
        ':intIdDepartamento' => $this->intIdDepartamento,
        ':intIdProvincia' => $this->intIdProvincia,
        ':intIdDistrito' => $this->intIdDistrito,
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
      $sql_comando = $sql_conectar->prepare('CALL mostrardomiciliosProveedor(:intIdProveedor)');
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
        echo '<td>'.$fila['nvchPais'].'</td>
        <td>'.$fila['nvchDepartamento'].'</td>
        <td>'.$fila['nvchProvincia'].'</td>
        <td>'.$fila['nvchDistrito'].'</td>
        <td>'.$fila['nvchDireccion'].'</td>
        <td>'.$fila['NombreTD'].'</td>
        <td> 
          <button type="button" iddcl="'.$fila['intIdDomicilioProveedor'].'" class="btn btn-xs btn-warning" onclick="SeleccionarDomicilio(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" iddcl="'.$fila['intIdDomicilioProveedor'].'" class="btn btn-xs btn-danger" onclick="EliminarDomicilio(this)">
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
      $sql_comando = $sql_conectar->prepare('CALL seleccionardomicilioProveedor(:intIdDomicilioProveedor)');
      $sql_comando -> execute(array(':intIdDomicilioProveedor' => $this->intIdDomicilioProveedor));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdDomicilioProveedor'] = $fila['intIdDomicilioProveedor'];
      $salida['nvchPais'] = $fila['nvchPais'];
      $salida['intIdDepartamento'] = $fila['intIdDepartamento'];
      $salida['intIdProvincia'] = $fila['intIdProvincia'];
      $salida['intIdDistrito'] = $fila['intIdDistrito'];
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
      $sql_comando = $sql_conectar->prepare('CALL actualizardomicilioProveedor(:intIdDomicilioProveedor,
        :intIdProveedor,:nvchPais,:intIdDepartamento,:intIdProvincia,:intIdDistrito,:nvchDireccion,:intIdTipoDomicilio)');
      $sql_comando->execute(array(
        ':intIdDomicilioProveedor' => $this->intIdDomicilioProveedor,
        ':intIdProveedor' => $this->intIdProveedor, 
        ':nvchPais' => $this->nvchPais,
        ':intIdDepartamento' => $this->intIdDepartamento,
        ':intIdProvincia' => $this->intIdProvincia,
        ':intIdDistrito' => $this->intIdDistrito,
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
      $sql_comando = $sql_conectar->prepare('CALL eliminardomicilioProveedor(:intIdDomicilioProveedor)');
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