<?php
require_once '../conexion/bd_conexion.php';
class DomicilioCliente
{
  /* INICIO - Atributos de Domicilio Cliente*/
  private $intIdDomicilioCliente;
  private $intIdCliente;
  private $nvchPais;
  private $intIdDepartamento;
  private $intIdProvincia;
  private $intIdDistrito;
  private $nvchDireccion;
  private $intIdTipoDomicilio;
  
  public function IdDomicilioCliente($intIdDomicilioCliente){ $this->intIdDomicilioCliente = $intIdDomicilioCliente; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function Pais($nvchPais){ $this->nvchPais = $nvchPais; }
  public function IdDepartamento($intIdDepartamento){ $this->intIdDepartamento = $intIdDepartamento; }
  public function IdProvincia($intIdProvincia){ $this->intIdProvincia = $intIdProvincia; }
  public function IdDistrito($intIdDistrito){ $this->intIdDistrito = $intIdDistrito; }
  public function Direccion($nvchDireccion){ $this->nvchDireccion = $nvchDireccion; }
  public function IdTipoDomicilio($intIdTipoDomicilio){ $this->intIdTipoDomicilio = $intIdTipoDomicilio; }
  /* FIN - Atributos de Domicilio Cliente */

  /* INICIO - Métodos de Domicilio Cliente */
  public function InsertarDomicilioCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->nvchPais as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertardomicilioCliente(:intIdCliente,:nvchPais,
      	:intIdDepartamento,:intIdProvincia,:intIdDistrito,:nvchDireccion,:intIdTipoDomicilio)');
      $sql_comando->execute(array(
        ':intIdCliente' => $this->intIdCliente, 
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

  public function InsertarDomicilioCliente_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertardomicilioCliente(:intIdCliente,:nvchPais,
        :intIdDepartamento,:intIdProvincia,:intIdDistrito,:nvchDireccion,:intIdTipoDomicilio)');
      $sql_comando->execute(array(
        ':intIdCliente' => $this->intIdCliente, 
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

  public function MostrarDomicilioCliente($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrardomiciliosCliente(:intIdCliente)');
      $sql_comando -> execute(array(':intIdCliente' => $this->intIdCliente));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdDomicilioCliente'] == $fila['intIdDomicilioCliente'] && $tipolistado == "A"){
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
          <button type="button" iddcl="'.$fila['intIdDomicilioCliente'].'" class="btn btn-xs btn-warning" onclick="SeleccionarDomicilio(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" iddcl="'.$fila['intIdDomicilioCliente'].'" class="btn btn-xs btn-danger" onclick="EliminarDomicilio(this)">
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

  public function SeleccionarDomicilioCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionardomicilioCliente(:intIdDomicilioCliente)');
      $sql_comando -> execute(array(':intIdDomicilioCliente' => $this->intIdDomicilioCliente));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdDomicilioCliente'] = $fila['intIdDomicilioCliente'];
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

  public function ActualizarDomicilioCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizardomicilioCliente(:intIdDomicilioCliente,
      	:intIdCliente,:nvchPais,:intIdDepartamento,:intIdProvincia,:intIdDistrito,:nvchDireccion,:intIdTipoDomicilio)');
      $sql_comando->execute(array(
        ':intIdDomicilioCliente' => $this->intIdDomicilioCliente,
        ':intIdCliente' => $this->intIdCliente, 
        ':nvchPais' => $this->nvchPais,
        ':intIdDepartamento' => $this->intIdDepartamento,
        ':intIdProvincia' => $this->intIdProvincia,
        ':intIdDistrito' => $this->intIdDistrito,
        ':nvchDireccion' => $this->nvchDireccion,
        ':intIdTipoDomicilio' => $this->intIdTipoDomicilio));
      $_SESSION['intIdDomicilioCliente'] = $this->intIdDomicilioCliente;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarDomicilioCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminardomicilioCliente(:intIdDomicilioCliente)');
      $sql_comando -> execute(array(':intIdDomicilioCliente' => $this->intIdDomicilioCliente));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Domicilio Cliente */
}
?>