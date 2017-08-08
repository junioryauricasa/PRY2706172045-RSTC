<?php
session_start();
require_once '../conexion/bd_conexion.php';
$_SESSION['intIdHistory'] = 0; //guardar variable de session para ser sombreado

class HistorialAcceso
{
  /* INICIO - Atributos de Producto*/
  private $intIdHistory;
  private $intIdUser;
  private $dateDateAccesso;
  private $nvchIpAccesso;
  private $nvchBrowser;
  
  public function intIdHistory($intIdHistory){ $this->intIdHistory = $intIdHistory; }
  public function intIdUser($intIdUser){ $this->intIdUser = $intIdUser; }
  public function dateDateAccesso($dateDateAccesso){ $this->dateDateAccesso = $dateDateAccesso; }
  public function nvchIpAccesso($nvchIpAccesso){ $this->nvchIpAccesso = $nvchIpAccesso; }
  public function nvchBrowser($nvchBrowser){ $this->nvchBrowser = $nvchBrowser; }
  /* FIN - Atributos de Producto */

 
  public function ListarHistorialAccesos($busqueda,$x,$y,$tipolistado)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de producto por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarhistorialacceso_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarhistorialacceso_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de producto por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarhistorialacceso(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdHistory"] == $_SESSION['intIdHistory'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }

        echo '
	        <td>'.$fila["intIdHistory"].'</td>
	        <td>'.$fila["intIdUser"].'</td>
	        <td>'.$fila["dateDateAccesso"].'</td> 
          <td>'.$fila["nvchIpAccesso"].'</td> 
	        <td>'.$fila["nvchBrowser"].'</td>
	        </tr>';
        $i++;
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarHistorialAccesos($busqueda,$x,$y,$tipolistado)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
	  //$sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda)');
	  $sql_comando = $sql_conectar->prepare('CALL buscarhistorialacceso_ii(:busqueda)');
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
  /* FIN - Métodos de Producto */
}

switch($_POST['funcion']){
  case "L":
    $historialacceso = new HistorialAcceso();
    $historialacceso->ListarHistorialAccesos($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $historialacceso = new HistorialAcceso();
    $historialacceso->PaginarHistorialAccesos($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
}