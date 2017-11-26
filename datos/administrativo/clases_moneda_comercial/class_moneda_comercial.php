<?php
require_once '../conexion/bd_conexion.php';
require_once 'class_formulario_moneda_comercial.php';
class MonedaComercial
{
  /* INICIO - Atributos de MonedaComercial*/
  private $intIdMonedaComercial;
  private $intIdTipoCambio;
  private $dcmCambio1;
  private $dcmCambio2;
  private $dtmFechaCambio;
  
  public function IdMonedaComercial($intIdMonedaComercial){ $this->intIdMonedaComercial = $intIdMonedaComercial; }
  public function IdTipoCambio($intIdTipoCambio){ $this->intIdTipoCambio = $intIdTipoCambio; }
  public function Cambio1($dcmCambio1){ $this->dcmCambio1 = $dcmCambio1; }
  public function Cambio2($dcmCambio2){ $this->dcmCambio2 = $dcmCambio2; }
  public function FechaCambio($dtmFechaCambio){ $this->dtmFechaCambio = $dtmFechaCambio; }
  /* FIN - Atributos de MonedaComercial */

  /* INICIO - Métodos de MonedaComercial */
  public function InsertarMonedaComercial()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarMonedaComercial(@intIdMonedaComercial,:intIdTipoCambio,:dcmCambio1,:dcmCambio2,
        :dtmFechaCambio)');
      $sql_comando->execute(array(
        ':intIdTipoCambio' => $this->intIdTipoCambio,
        ':dcmCambio1' => $this->dcmCambio1,
        ':dcmCambio2' => $this->dcmCambio2,
        ':dtmFechaCambio' => $this->dtmFechaCambio));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdMonedaComercial as intIdMonedaComercial");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdMonedaComercial'] = $salida->intIdMonedaComercial;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarMonedaComercial($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarMonedaComercial(:intIdMonedaComercial)');
      $sql_comando -> execute(array(':intIdMonedaComercial' => $this->intIdMonedaComercial));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioMonedaComercial = new FormularioMonedaComercial();
      $FormularioMonedaComercial->IdMonedaComercial($fila['intIdMonedaComercial']);
      $FormularioMonedaComercial->IdTipoCambio($fila['intIdTipoCambio']);
      $FormularioMonedaComercial->Cambio1($fila['dcmCambio1']);
      $FormularioMonedaComercial->Cambio2($fila['dcmCambio2']);
      $FormularioMonedaComercial->FechaCambio(date('d/m/Y', strtotime($fila['dtmFechaCambio'])));
      $FormularioMonedaComercial->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function MostrarMonedaComercialFecha($nvchFecha){
    $dtmFechaCambio =  str_replace('/', '-', $nvchFecha);
    $dtmFechaCambio = date('Y-m-d', strtotime($dtmFechaCambio));
    $sql_conexion_moneda = new Conexion_BD();
    $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
    $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDACOMERCIALFECHA(:dtmFechaCambio)');
    $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
    $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
    echo $fila_moneda['dcmCambio2'];
  }

  public function ActualizarMonedaComercial()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarMonedaComercial(:intIdMonedaComercial,
        :intIdTipoCambio,:dcmCambio1,:dcmCambio2,:dtmFechaCambio)');
      $sql_comando->execute(array(
        ':intIdMonedaComercial' => $this->intIdMonedaComercial,
        ':intIdTipoCambio' => $this->intIdTipoCambio,
        ':dcmCambio1' => $this->dcmCambio1,
        ':dcmCambio2' => $this->dcmCambio2,
        ':dtmFechaCambio' => $this->dtmFechaCambio));
      $_SESSION['intIdMonedaComercial'] = $this->intIdMonedaComercial;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarMonedaComercial()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarMonedaComercial(:intIdMonedaComercial)');
      $sql_comando -> execute(array(':intIdMonedaComercial' => $this->intIdMonedaComercial));
      $_SESSION['intIdMonedaComercial'] = $this->intIdMonedaComercial;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarMonedaComercial($x,$y,$tipolistado,$TipoCambio)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de MonedaComercial por el comando LIMIT
      if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarMonedaComercial_ii(:TipoCambio)');
        $sql_comando -> execute(array(':TipoCambio' => $TipoCambio));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de MonedaComercial por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarMonedaComercial(:TipoCambio,:x,:y)');
      $sql_comando -> execute(array(':TipoCambio' => $TipoCambio, ':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
          if($fila["intIdMonedaComercial"] == $_SESSION['intIdMonedaComercial'] && $tipolistado == "N"){
            echo '<tr bgcolor="#BEE1EB">';
          } else if($fila["intIdMonedaComercial"] == $_SESSION['intIdMonedaComercial'] && $tipolistado == "E"){
            echo '<tr bgcolor="#B3E4C0">';
          }else {
            echo '
          <tr>
            ';
            }
            echo 
            ' <td class="heading" data-th="ID"></td>
              <td align="left" data-th="Fecha">'.date('d/m/Y', strtotime($fila['dtmFechaCambio'])).'</td>
              <td align="right" data-th="Cambio">'.$fila["dcmCambio1"].'</td>
              <td>'.$fila["dcmCambio2"].'</td>
              <td> 
                <button type="button" id="'.$fila["intIdMonedaComercial"].'" class="btn btn-xs btn-warning btn-mostrar-moneda-comercial" onclick="showmodalNuevaMonedaCom()">
                  <i class="fa fa-edit"></i> Editar
                </button>
                <button type="button" id="'.$fila["intIdMonedaComercial"].'" class="btn btn-xs btn-danger btn-eliminar-moneda-comercial">
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

  public function PaginarMonedaComercial($x,$y,$tipolistado,$TipoCambio)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarMonedaComercial_ii(:TipoCambio)');
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