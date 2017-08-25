<?php
require_once '../conexion/bd_conexion.php';
require_once 'class_formulario_proveedor.php';
class Proveedor
{
  /* INICIO - Atributos de Proveedor*/
  private $intIdProveedor;
  private $nvchDNI;
  private $nvchRUC;
  private $nvchRazonSocial;
  private $nvchApellidoPaterno;
  private $nvchApellidoMaterno;
  private $nvchNombres;
  private $intIdTipoPersona;
  
  public function IdProveedor($intIdProveedor){ $this->intIdProveedor = $intIdProveedor; }
  public function DNI($nvchDNI){ $this->nvchDNI = $nvchDNI; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function ApellidoPaterno($nvchApellidoPaterno){ $this->nvchApellidoPaterno = $nvchApellidoPaterno; }
  public function ApellidoMaterno($nvchApellidoMaterno){ $this->nvchApellidoMaterno = $nvchApellidoMaterno; }
  public function Nombres($nvchNombres){ $this->nvchNombres = $nvchNombres; }
  public function IdTipoPersona($intIdTipoPersona){ $this->intIdTipoPersona = $intIdTipoPersona; }
  /* FIN - Atributos de Proveedor */

  /* INICIO - Métodos de Proveedor */
  public function InsertarProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarproveedor(@intIdProveedor,:nvchDNI,:nvchRUC,:nvchRazonSocial,
      	:nvchApellidoPaterno,:nvchApellidoMaterno,:nvchNombres,:intIdTipoPersona)');
      $sql_comando->execute(array(
        ':nvchDNI' => $this->nvchDNI, 
        ':nvchRUC' => $this->nvchRUC,
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':nvchApellidoPaterno' => $this->nvchApellidoPaterno,
        ':nvchApellidoMaterno' => $this->nvchApellidoMaterno,
        ':nvchNombres' => $this->nvchNombres,
        ':intIdTipoPersona' => $this->intIdTipoPersona));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdProveedor as intIdProveedor");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdProveedor'] = $salida->intIdProveedor;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarProveedor($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarproveedor(:intIdProveedor)');
      $sql_comando -> execute(array(':intIdProveedor' => $this->intIdProveedor));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $formularioproveedor = new FormularioProveedor();
      $formularioproveedor->IdProveedor($fila['intIdProveedor']);
      $formularioproveedor->DNI($fila['nvchDNI']);
      $formularioproveedor->RUC($fila['nvchRUC']);
      $formularioproveedor->RazonSocial($fila['nvchRazonSocial']);
      $formularioproveedor->ApellidoPaterno($fila['nvchApellidoPaterno']);
      $formularioproveedor->ApellidoMaterno($fila['nvchApellidoMaterno']);
      $formularioproveedor->Nombres($fila['nvchNombres']);
      $formularioproveedor->IdTipoPersona($fila['intIdTipoPersona']);
      $formularioproveedor->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarproveedor(:intIdProveedor,:nvchDNI,:nvchRUC,
      	:nvchRazonSocial,:nvchApellidoPaterno,:nvchApellidoMaterno,:nvchNombres,:intIdTipoPersona)');
      $sql_comando->execute(array(
        ':intIdProveedor' => $this->intIdProveedor,
        ':nvchDNI' => $this->nvchDNI, 
        ':nvchRUC' => $this->nvchRUC,
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':nvchApellidoPaterno' => $this->nvchApellidoPaterno,
        ':nvchApellidoMaterno' => $this->nvchApellidoMaterno,
        ':nvchNombres' => $this->nvchNombres,
        ':intIdTipoPersona' => $this->intIdTipoPersona));
      $_SESSION['intIdProveedor'] = $this->intIdProveedor;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarproveedor(:intIdProveedor)');
      $sql_comando -> execute(array(':intIdProveedor' => $this->intIdProveedor));
      $_SESSION['intIdProveedor'] = $this->intIdProveedor;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarProveedores($busqueda,$x,$y,$tipolistado)
  {
    try{
      $salida = "";
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de Proveedor por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarproveedor_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarproveedor_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Proveedor por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarproveedor(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdProveedor"] == $_SESSION['intIdProveedor'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo
        '<td>'.$fila["intIdProveedor"].'</td>
        <td>'.$fila["nvchDNI"].'</td>
        <td>'.$fila["nvchRUC"].'</td>
        <td>'.$fila["nvchRazonSocial"].'</td>
        <td>'.$fila["nvchApellidoPaterno"].'</td>
        <td>'.$fila["nvchApellidoMaterno"].'</td>
        <td>'.$fila["nvchNombres"].'</td>
        <td> 
          <button type="submit" id="'.$fila["intIdProveedor"].'" class="btn btn-xs btn-warning btn-mostrar-proveedor">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="submit" id="'.$fila["intIdProveedor"].'" class="btn btn-xs btn-danger btn-eliminar-proveedor">
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

  public function PaginarProveedores($busqueda,$x,$y,$tipolistado)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarProveedor_ii(:busqueda)');
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
  /* FIN - Métodos de Proveedor */
}
?>