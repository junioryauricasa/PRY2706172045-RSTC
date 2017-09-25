<?php
require_once '../conexion/bd_conexion.php';
require_once 'class_formulario_cliente.php';
class Cliente
{
  /* INICIO - Atributos de Cliente*/
  private $intIdCliente;
  private $nvchDNI;
  private $nvchRUC;
  private $nvchRazonSocial;
  private $nvchApellidoPaterno;
  private $nvchApellidoMaterno;
  private $nvchNombres;
  private $intIdTipoPersona;
  private $intIdTipoCliente;
  private $nvchObservacion;
  
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function DNI($nvchDNI){ $this->nvchDNI = $nvchDNI; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function ApellidoPaterno($nvchApellidoPaterno){ $this->nvchApellidoPaterno = $nvchApellidoPaterno; }
  public function ApellidoMaterno($nvchApellidoMaterno){ $this->nvchApellidoMaterno = $nvchApellidoMaterno; }
  public function Nombres($nvchNombres){ $this->nvchNombres = $nvchNombres; }
  public function IdTipoPersona($intIdTipoPersona){ $this->intIdTipoPersona = $intIdTipoPersona; }
  public function IdTipoCliente($intIdTipoCliente){ $this->intIdTipoCliente = $intIdTipoCliente; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
  /* FIN - Atributos de Cliente */

  /* INICIO - Métodos de Cliente */
  public function InsertarCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarCliente(@intIdCliente,:nvchDNI,:nvchRUC,:nvchRazonSocial,
      	:nvchApellidoPaterno,:nvchApellidoMaterno,:nvchNombres,:intIdTipoPersona,:intIdTipoCliente,:nvchObservacion)');
      $sql_comando->execute(array(
        ':nvchDNI' => $this->nvchDNI, 
        ':nvchRUC' => $this->nvchRUC,
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':nvchApellidoPaterno' => $this->nvchApellidoPaterno,
        ':nvchApellidoMaterno' => $this->nvchApellidoMaterno,
        ':nvchNombres' => $this->nvchNombres,
        ':intIdTipoPersona' => $this->intIdTipoPersona,
        ':intIdTipoCliente' => $this->intIdTipoCliente,
        ':nvchObservacion' => $this->nvchObservacion));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdCliente as intIdCliente");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdCliente'] = $salida->intIdCliente;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarCliente($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarCliente(:intIdCliente)');
      $sql_comando -> execute(array(':intIdCliente' => $this->intIdCliente));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $formularioCliente = new FormularioCliente();
      $formularioCliente->IdCliente($fila['intIdCliente']);
      $formularioCliente->DNI($fila['nvchDNI']);
      $formularioCliente->RUC($fila['nvchRUC']);
      $formularioCliente->RazonSocial($fila['nvchRazonSocial']);
      $formularioCliente->ApellidoPaterno($fila['nvchApellidoPaterno']);
      $formularioCliente->ApellidoMaterno($fila['nvchApellidoMaterno']);
      $formularioCliente->Nombres($fila['nvchNombres']);
      $formularioCliente->IdTipoPersona($fila['intIdTipoPersona']);
      $formularioCliente->IdTipoCliente($fila['intIdTipoCliente']);
      $formularioCliente->Observacion($fila['nvchObservacion']);
      $formularioCliente->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarCliente(:intIdCliente,:nvchDNI,:nvchRUC,
      	:nvchRazonSocial,:nvchApellidoPaterno,:nvchApellidoMaterno,:nvchNombres,:intIdTipoPersona,
        :intIdTipoCliente,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdCliente' => $this->intIdCliente,
        ':nvchDNI' => $this->nvchDNI, 
        ':nvchRUC' => $this->nvchRUC,
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':nvchApellidoPaterno' => $this->nvchApellidoPaterno,
        ':nvchApellidoMaterno' => $this->nvchApellidoMaterno,
        ':nvchNombres' => $this->nvchNombres,
        ':intIdTipoPersona' => $this->intIdTipoPersona,
        ':intIdTipoCliente' => $this->intIdTipoCliente,
        ':nvchObservacion' => $this->nvchObservacion));
      $_SESSION['intIdCliente'] = $this->intIdCliente;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarCliente(:intIdCliente)');
      $sql_comando -> execute(array(':intIdCliente' => $this->intIdCliente));
      $_SESSION['intIdCliente'] = $this->intIdCliente;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarClientees($busqueda,$x,$y,$tipolistado,$intIdTipoPersona)
  {
    try{
      $salida = "";
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de Cliente por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarCliente_ii(:busqueda,:intIdTipoPersona)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':intIdTipoPersona' => $intIdTipoPersona));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarCliente_ii(:busqueda,:intIdTipoPersona)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':intIdTipoPersona' => $intIdTipoPersona));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Cliente por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarCliente(:busqueda,:x,:y,:intIdTipoPersona)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':intIdTipoPersona' => $intIdTipoPersona));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdCliente"] == $_SESSION['intIdCliente'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        if($intIdTipoPersona == 2) { echo '<td>'.$fila["nvchDNI"].'</td>'; }
        echo '<td>'.$fila["nvchRUC"].'</td>';
        if($intIdTipoPersona == 1) { echo '<td>'.$fila["nvchRazonSocial"].'</td>'; }
        if($intIdTipoPersona == 2) {
        echo '<td>'.$fila["nvchApellidoPaterno"].'</td>
        <td>'.$fila["nvchApellidoMaterno"].'</td>
        <td>'.$fila["nvchNombres"].'</td>';
        }
        echo '<td> 
          <button type="submit" id="'.$fila["intIdCliente"].'" class="btn btn-xs btn-warning btn-mostrar-cliente">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="submit" id="'.$fila["intIdCliente"].'" class="btn btn-xs btn-danger btn-eliminar-cliente">
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

  public function PaginarClientees($busqueda,$x,$y,$tipolistado,$intIdTipoPersona)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarCliente_ii(:busqueda,:intIdTipoPersona)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':intIdTipoPersona' => $intIdTipoPersona));
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
          //$output = 'No s eencontraron nada';
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
  /* FIN - Métodos de Cliente */
}
?>