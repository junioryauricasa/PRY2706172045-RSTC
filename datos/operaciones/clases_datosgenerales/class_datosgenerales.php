<?php 
require_once '../conexion/bd_conexion.php';
class DatosGenerales{
  /* INICIO - Atributos de Departamento */
  private $intIdDepartamento;
  private $nvchDepartamento;

  private $intIdProvincia;
  private $nvchProvincia;

  private $intIdDistrito;
  private $nvchDistrito;

  public function IdDepartamento($intIdDepartamento){ $this->intIdDepartamento = $intIdDepartamento; }
  public function nvchDepartamento($nvchDepartamento){ $this->nvchDepartamento = $nvchDepartamento; }

  public function IdProvincia($intIdProvincia){ $this->intIdProvincia = $intIdProvincia; }
  public function nvchProvincia($nvchProvincia){ $this->nvchProvincia = $nvchProvincia; }

  public function IdDistrito($intIdDistrito){ $this->intIdDistrito = $intIdDistrito; }
  public function nvchDistrito($nvchDistrito){ $this->nvchDistrito = $nvchDistrito; }
  /* FIN - Atributos de Departamento */

  /* INICIO - Métodos de Departamento */
  public function MostrarProvincia()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarProvincia(:intIdDepartamento)');
      $sql_comando -> execute(array(':intIdDepartamento' => $this->intIdDepartamento));
    
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo '<option value="'.$fila['intIdProvincia'].'">'.$fila['nvchProvincia'].'</option>';
      }
    } catch(PDPExceptions $e){
      echo $e->getMessage();
    }

  }

  public function MostrarDistrito()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDistrito(:intIdProvincia)');
      $sql_comando -> execute(array(':intIdProvincia' => $this->intIdProvincia));

      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo '<option value="'.$fila['intIdDistrito'].'">'.$fila['nvchDistrito'].'</option>';
      }
    } catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function SeleccionarProvincia()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL SeleccionarProvincia(:intIdDepartamento)');
      $sql_comando -> execute(array(':intIdDepartamento' => $this->intIdDepartamento));
    
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      echo $fila['intIdProvincia'];

    } catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Departamento */
}
?>