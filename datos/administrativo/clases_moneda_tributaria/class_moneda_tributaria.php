<?php
require_once '../conexion/bd_conexion.php';
require_once 'class_formulario_moneda_tributaria.php';
class MonedaTributaria
{
  /* INICIO - Atributos de MonedaTributaria*/
  private $intIdMonedaTributaria;
  private $intIdTipoCambio;
  private $dcmCambio1;
  private $dcmCambio2;
  private $dtmFechaCambio;
  
  public function IdMonedaTributaria($intIdMonedaTributaria){ $this->intIdMonedaTributaria = $intIdMonedaTributaria; }
  public function IdTipoCambio($intIdTipoCambio){ $this->intIdTipoCambio = $intIdTipoCambio; }
  public function Cambio1($dcmCambio1){ $this->dcmCambio1 = $dcmCambio1; }
  public function Cambio2($dcmCambio2){ $this->dcmCambio2 = $dcmCambio2; }
  public function FechaCambio($dtmFechaCambio){ $this->dtmFechaCambio = $dtmFechaCambio; }
  /* FIN - Atributos de MonedaTributaria */

  /* INICIO - Métodos de MonedaTributaria */
  public function InsertarMonedaTributaria()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarMonedaTributaria(@intIdMonedaTributaria,:intIdTipoCambio,:dcmCambio1,:dcmCambio2,
        :dtmFechaCambio)');
      $sql_comando->execute(array(
        ':intIdTipoCambio' => $this->intIdTipoCambio,
        ':dcmCambio1' => $this->dcmCambio1,
        ':dcmCambio2' => $this->dcmCambio2,
        ':dtmFechaCambio' => $this->dtmFechaCambio));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdMonedaTributaria as intIdMonedaTributaria");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdMonedaTributaria'] = $salida->intIdMonedaTributaria;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarMonedaTributaria($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarMonedaTributaria(:intIdMonedaTributaria)');
      $sql_comando -> execute(array(':intIdMonedaTributaria' => $this->intIdMonedaTributaria));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioMonedaTributaria = new FormularioMonedaTributaria();
      $FormularioMonedaTributaria->IdMonedaTributaria($fila['intIdMonedaTributaria']);
      $FormularioMonedaTributaria->IdTipoCambio($fila['intIdTipoCambio']);
      $FormularioMonedaTributaria->Cambio1($fila['dcmCambio1']);
      $FormularioMonedaTributaria->Cambio2($fila['dcmCambio2']);
      $FormularioMonedaTributaria->FechaCambio(date('d/m/Y', strtotime($fila['dtmFechaCambio'])));
      $FormularioMonedaTributaria->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarMonedaTributaria()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarMonedaTributaria(:intIdMonedaTributaria,
        :intIdTipoCambio,:dcmCambio1,:dcmCambio2,:dtmFechaCambio)');
      $sql_comando->execute(array(
        ':intIdMonedaTributaria' => $this->intIdMonedaTributaria,
        ':intIdTipoCambio' => $this->intIdTipoCambio,
        ':dcmCambio1' => $this->dcmCambio1,
        ':dcmCambio2' => $this->dcmCambio2,
        ':dtmFechaCambio' => $this->dtmFechaCambio));
      $_SESSION['intIdMonedaTributaria'] = $this->intIdMonedaTributaria;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarMonedaTributaria()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarMonedaTributaria(:intIdMonedaTributaria)');
      $sql_comando -> execute(array(':intIdMonedaTributaria' => $this->intIdMonedaTributaria));
      $_SESSION['intIdMonedaTributaria'] = $this->intIdMonedaTributaria;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarMonedaTributaria($x,$y,$tipolistado,$TipoCambio)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de MonedaTributaria por el comando LIMIT
      if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarMonedaTributaria_ii(:TipoCambio)');
        $sql_comando -> execute(array(':TipoCambio' => $TipoCambio));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de MonedaTributaria por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarMonedaTributaria(:TipoCambio,:x,:y)');
      $sql_comando -> execute(array(':TipoCambio' => $TipoCambio, ':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
          if($fila["intIdMonedaTributaria"] == $_SESSION['intIdMonedaTributaria'] && $tipolistado == "N"){
            echo '<tr bgcolor="#BEE1EB">';
          } else if($fila["intIdMonedaTributaria"] == $_SESSION['intIdMonedaTributaria'] && $tipolistado == "E"){
            echo '<tr bgcolor="#B3E4C0">';
          }else {
            echo '<tr>';
          }
          echo 
          '
              <td class="heading" data-th="ID"></td>
              <td>'.date('d/m/Y', strtotime($fila['dtmFechaCambio'])).'</td>
              <td>'.$fila["dcmCambio1"].'</td>
              <td>'.$fila["dcmCambio2"].'</td>
              <td> 
                <button type="button" id="'.$fila["intIdMonedaTributaria"].'" class="btn btn-xs btn-warning btn-mostrar-moneda-tributaria">
                  <i class="fa fa-edit"></i> Editar
                </button>
                <button type="button" id="'.$fila["intIdMonedaTributaria"].'" class="btn btn-xs btn-danger btn-eliminar-moneda-tributaria">
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

  public function PaginarMonedaTributaria($x,$y,$tipolistado,$TipoCambio)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarMonedaTributaria_ii(:TipoCambio)');
      $sql_comando -> execute(array(':TipoCambio' => $TipoCambio));
      $cantidad = $sql_comando -> rowCount();
      $numpaginas = ceil($cantidad / $y);
      if($tipolistado == "D")
      { $x = $numpaginas - 1; }
      else if($tipolistado == "E" || $tipolistado == "N")
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
}
?>