<?php 
require_once '../conexion/bd_conexion.php';
require_once 'class_formulario_empleado.php';
class Empleado
{
  /* INICIO - Atributos de Empleado*/
  private $intIdEmpleado;
  private $nvchDNI;
  private $nvchRUC;
  private $nvchApellidoPaterno;
  private $nvchApellidoMaterno;
  private $nvchNombres;
  private $nvchGenero;
  private $nvchPais;
  private $nvchRegion;
  private $nvchProvincia;
  private $nvchDistrito;
  private $nvchDireccion;
  private $intIdCargo;
  private $nvchObservacion;

  public function IdEmpleado($intIdEmpleado){ $this->intIdEmpleado = $intIdEmpleado; }
  public function DNI($nvchDNI){ $this->nvchDNI = $nvchDNI; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function ApellidoPaterno($nvchApellidoPaterno){ $this->nvchApellidoPaterno = $nvchApellidoPaterno; }
  public function ApellidoMaterno($nvchApellidoMaterno){ $this->nvchApellidoMaterno = $nvchApellidoMaterno; }
  public function Nombres($nvchNombres){ $this->nvchNombres = $nvchNombres; }
  public function Genero($Genero){ $this->nvchGenero = $nvchGenero; }
  public function Pais($nvchPais){ $this->nvchPais = $nvchPais; }
  public function Region($nvchRegion){ $this->nvchRegion = $nvchRegion; }
  public function Provincia($nvchProvincia){ $this->nvchProvincia = $nvchProvincia; }
  public function Distrito($nvchDistrito){ $this->nvchDistrito = $nvchDistrito; }
  public function Direccion($nvchDireccion){ $this->nvchDireccion = $nvchDireccion; }
  public function IdCargo($intIdCargo){ $this->intIdCargo = $intIdCargo; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
  /* INICIO - Atributos de Empleado*/

  /* INICIO - Métodos de Empleado */
  public function InsertarEmpleado()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarEmpleado(@intIdEmpleado,:nvchDNI,:nvchRUC,
      	:nvchApellidoPaterno,:nvchApellidoMaterno,:nvchNombres,:nvchGenero,:nvchPais,:nvchRegion,:nvchProvincia,
      	:nvchDistrito,:nvchDireccion,:intIdCargo,:nvchObservacion)');
      $sql_comando->execute(array(
        ':nvchDNI' => $this->nvchDNI,
        ':nvchRUC' => $this->nvchRUC,
        ':nvchApellidoPaterno' => $this->nvchApellidoPaterno,
        ':nvchApellidoMaterno' => $this->nvchApellidoMaterno,
        ':nvchNombres' => $this->nvchNombres,
        ':nvchGenero' => $this->nvchGenero,
        ':nvchPais' => $this->nvchPais,
        ':nvchRegion' => $this->nvchRegion,
        ':nvchProvincia' => $this->nvchProvincia,
        ':nvchDistrito' => $this->nvchDistrito,
        ':nvchDireccion' => $this->nvchDireccion,
        ':intIdCargo' => $this->intIdCargo,
        ':nvchObservacion' => $this->nvchObservacion));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdEmpleado as intIdEmpleado");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdEmpleado'] = $salida->intIdEmpleado;
      $_SESSION['RutaDefaultImg'] = "";
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarEmpleado($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarEmpleado(:intIdEmpleado)');
      $sql_comando -> execute(array(':intIdEmpleado' => $this->intIdEmpleado));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioEmpleado = new FormularioEmpleado();
      $FormularioEmpleado->IdEmpleado($fila['intIdEmpleado']);
      $FormularioEmpleado->DNI($fila['nvchDNI']);
      $FormularioEmpleado->RUC($fila['nvchRUC']);
      $FormularioEmpleado->ApellidoPaterno($fila['nvchApellidoPaterno']);
      $FormularioEmpleado->ApellidoMaterno($fila['nvchApellidoMaterno']);
      $FormularioEmpleado->Nombres($fila['nvchNombres']);
      $FormularioEmpleado->Genero($fila['nvchGenero']);
      $FormularioEmpleado->Pais($fila['nvchPais']);
	    $FormularioEmpleado->Region($fila['nvchRegion']);
	    $FormularioEmpleado->Provincia($fila['nvchProvincia']);
	    $FormularioEmpleado->Distrito($fila['nvchDistrito']);
	    $FormularioEmpleado->Direccion($fila['nvchDireccion']);
      $FormularioEmpleado->IdCargo($fila['intIdCargo']);
      $FormularioEmpleado->Observacion($fila['nvchObservacion']);
      $FormularioEmpleado->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarEmpleado()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarEmpleado(:intIdEmpleado,:nvchDNI,:nvchRUC,
      	:nvchApellidoPaterno,:nvchApellidoMaterno,:nvchNombres,nvchGenero,:nvchPais,:nvchRegion,:nvchProvincia,
      	:nvchDistrito,:nvchDireccion,:intIdCargo,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdEmpleado' => $this->intIdEmpleado,
        ':nvchDNI' => $this->nvchDNI,
        ':nvchRUC' => $this->nvchRUC,
        ':nvchApellidoPaterno' => $this->nvchApellidoPaterno,
        ':nvchApellidoMaterno' => $this->nvchApellidoMaterno,
        ':nvchNombres' => $this->nvchNombres,
        ':nvchGenero' => $this->nvchGenero,
        ':nvchPais' => $this->nvchPais,
        ':nvchRegion' => $this->nvchRegion,
        ':nvchProvincia' => $this->nvchProvincia,
        ':nvchDistrito' => $this->nvchDistrito,
        ':nvchDireccion' => $this->nvchDireccion,
        ':intIdCargo' => $this->intIdCargo,
        ':nvchObservacion' => $this->nvchObservacion));
      $_SESSION['intIdEmpleado'] = $this->intIdEmpleado;
      $_SESSION['RutaDefaultImg'] = "";
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarEmpleado()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarEmpleado(:intIdEmpleado)');
      $sql_comando -> execute(array(':intIdEmpleado' => $this->intIdEmpleado));
      $_SESSION['intIdEmpleado'] = $this->intIdEmpleado;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarEmpleados($busqueda,$x,$y,$tipolistado)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de Empleado por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarEmpleado_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarEmpleado_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Empleado por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarEmpleado(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($fila["nvchCodigo"]!=""){
          if($i == ($cantidad - $x) && $tipolistado == "N"){
            echo '<tr bgcolor="#BEE1EB">';
          } else if($fila["intIdEmpleado"] == $_SESSION['intIdEmpleado'] && $tipolistado == "E"){
            echo '<tr bgcolor="#B3E4C0">';
          }else {
            echo '<tr>';
          }
          echo 
          '<td>'.$fila["nvchDNI"].'</td>
          <td>'.$fila["nvchRUC"].'</td>
          <td>'.$fila["nvchApellidoPaterno"].'</td>
          <td>'.$fila["nvchApellidoMaterno"].'</td>
          <td>'.$fila["nvchNombres"].'</td>
          <td>
            <img src="../../datos/inventario/imgEmpleado/'.$fila["nvchDireccionImg"].'" height="50">
          </td>
          <td> 
            <button type="submit" id="'.$fila["intIdEmpleado"].'" class="btn btn-xs btn-warning btn-mostrar-empleado">
              <i class="fa fa-edit"></i> Editar
            </button>
            <button type="submit" id="'.$fila["intIdEmpleado"].'" class="btn btn-xs btn-danger btn-eliminar-empleado">
              <i class="fa fa-edit"></i> Eliminar
            </button>
          </td>  
          </tr>';
          $i++;
        }
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarEmpleados($busqueda,$x,$y,$tipolistado)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarEmpleado_ii(:busqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda));
      $cantidad = $sql_comando -> rowCount();
      $numpaginas = ceil($cantidad / $y);
      if($tipolistado == "N" || $tipolistado == "D")
      { $x = $numpaginas - 1; }
      else if($tipolistado == "E")
      { $x = $x / $y; }
      $output = "";
      for($i = 0; $i < $numpaginas; $i++){
        if($i==0)
        {
          if($x==0)
          {
            $output .= 
            '<li class="page-item disabled">
                <a class="page-link" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          } else {
            $output .= 
            '<li class="page-item">
                <a idp="'.($x-1).'" class="page-link btn-pagina" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

          if($x==$i){
            $output.=  '<li class="page-item active"><a idp="'.$i.'" class="page-link btn-pagina marca">'.($i+1).'</a></li>';
          }
          else
          {
            $output.=  '<li class="page-item"><a idp="'.$i.'" class="page-link btn-pagina">'.($i+1).'</a></li>';
          }

        if($i==($numpaginas-1))
        {
          if($x==($numpaginas-1))
          {
            $output .= 
            '<li class="page-item disabled">
                <a class="page-link" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </li>';
          } else {
            $output .= 
            '<li class="page-item">
                <a idp="'.($x+1).'" class="page-link btn-pagina" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </li>';
          }
        }
      }
      if($output == ""){
        $output .= 
            '<li class="page-item">
                <a class="page-link btn-pagina" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
        $output .= 
            '<li class="page-item">
                <a class="page-link btn-pagina" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </li>';
      }
      echo $output;
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }
  /* FIN - Métodos de Empleado*/
}
?>