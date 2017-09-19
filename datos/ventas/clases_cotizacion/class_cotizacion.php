<?php 
require_once '../conexion/bd_conexion.php';
require_once '../numeraciones/class_numeraciones.php';
require_once 'clases_cotizacion/class_formulario_cotizacion.php';
class Cotizacion{
  /* INICIO - Atributos de Orden Compra*/
  private $intIdCotizacion;
  private $nvchNumeracion;
  private $intIdUsuario;
  private $intIdCliente;
  private $dtmFechaCreacion;
  private $nvchObservacion;
  
  public function IdCotizacion($intIdCotizacion){ $this->intIdCotizacion = $intIdCotizacion; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function Estado($bitEstado){ $this->bitEstado = $bitEstado; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
  /* FIN - Atributos de Orden Compra */

  /* INICIO - Métodos de Orden Compra */
  public function InsertarCotizacion()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarCotizacion(@intIdCotizacion,:nvchNumeracion,
        :intIdUsuario,:intIdCliente,:dtmFechaCreacion,:bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':nvchNumeracion' => '',
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdCliente' => $this->intIdCliente,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':bitEstado' => 1,
        ':nvchObservacion' => $this->nvchObservacio));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdCotizacion as intIdCotizacion");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdCotizacion'] = $salida->intIdCotizacion;
      $Numeraciones = new Numeraciones();
      $nvchNumeracion = $Numeraciones -> NumeracionSimpleInterna($_SESSION['intIdCotizacion']);
      $sql_comando = $sql_conectar->prepare('CALL InsertarNumeracionCotizacion(:intIdCotizacion,:nvchNumeracion)');
      $sql_comando->execute(array(
        ':intIdCotizacion' => $_SESSION['intIdCotizacion'],
        ':nvchNumeracion' => $nvchNumeracion));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarCotizacion($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarCotizacion(:intIdCotizacion)');
      $sql_comando -> execute(array(':intIdCotizacion' => $this->intIdCotizacion));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioCotizacion = new FormularioCotizacion();
      $FormularioCotizacion->IdCotizacion($fila['intIdCotizacion']);
      $FormularioCotizacion->Numeracion($fila['nvchNumeracion']);
      $FormularioCotizacion->IdUsuario($fila['intIdUsuario']);
      $FormularioCotizacion->IdCliente($fila['intIdCliente']);
      $FormularioCotizacion->NombreUsuario($fila['NombreUsuario']);
      $FormularioCotizacion->NombreCliente($fila['NombreCliente']);
      $FormularioCotizacion->FechaCreacion($fila['dtmFechaCreacion']);
      $FormularioCotizacion->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ListarClienteCotizacion($busqueda,$x,$y)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ListarClienteCotizacion(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo 
        '<tr>
        <td>'.$fila['IdentificadorCliente'].'</td>
        <td>'.$fila['NombreCliente'].'</td>';
        if($fila['intIdTipoPersona'] == 1){
          echo '<td>Persona Jurídica</td>';
        } else if($fila['intIdTipoPersona'] == 2){
          echo '<td>Persona Natural</td>';
        }
        echo 
        '<td> 
          <button type="button" idscli="'.$fila['intIdCliente'].'" class="btn btn-xs btn-warning" onclick="SeleccionarCliente(this)">
            <i class="fa fa-edit"></i> Seleccionar
          </button>
        </td>
        </tr>';
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function SeleccionarClienteCotizacion()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarCliente(:intIdCliente)');
      $sql_comando -> execute(array(':intIdCliente' => $this->intIdCliente));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $salida['intIdCliente'] = $fila['intIdCliente'];
      $salida['nvchRUC'] = $fila['nvchRUC'];
      $salida['nvchDNI'] = $fila['nvchDNI'];
      $salida['nvchRazonSocial'] = $fila['nvchRazonSocial'];
      $salida['nvchApellidoPaterno'] = $fila['nvchApellidoPaterno'];
      $salida['nvchApellidoMaterno'] = $fila['nvchApellidoMaterno'];
      $salida['nvchNombres'] = $fila['nvchNombres'];
      $salida['intIdTipoPersona'] = $fila['intIdTipoPersona'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarCotizacion()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ActualizarCotizacion(:intIdCotizacion,:nvchNumeracion,
        :intIdUsuario,:intIdCliente,:dtmFechaCreacion)');
      $sql_comando->execute(array(
        ':intIdCotizacion' => $this->intIdCotizacion,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdCliente' => $this->intIdCliente,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion));
      $_SESSION['intIdCotizacion'] = $this->intIdCotizacion;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarCotizacion()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL EliminarCotizacion(:intIdCotizacion)');
      $sql_comando -> execute(array(':intIdCotizacion' => $this->intIdCotizacion));
      $_SESSION['intIdCotizacion'] = $this->intIdCotizacion;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarCotizaciones($busqueda,$x,$y,$tipolistado)
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
        $sql_comando = $sql_conectar->prepare('CALL buscarCotizacion_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarCotizacion_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Cliente por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarCotizacion(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdCotizacion"] == $_SESSION['intIdCotizacion'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo
        '<td>'.$fila["nvchNumeracion"].'</td>
        <td>'.$fila["NombreCliente"].'</td>
        <td>'.$fila["NombreUsuario"].'</td>
        <td>'.$fila["dtmFechaCreacion"].'</td>
        <td> 
          <button type="submit" id="'.$fila["intIdCotizacion"].'" class="btn btn-xs btn-warning btn-mostrar-cotizacion">
            <i class="fa fa-edit"></i> Ver Detalle
          </button>
          <button type="submit" id="'.$fila["intIdCotizacion"].'" class="btn btn-xs btn-danger btn-anular-cotizacion">
            <i class="fa fa-trash"></i> Anular
          </button>
          <button type="submit" id="'.$fila["intIdCotizacion"].'" class="btn btn-xs btn-default btn-download-report">
            <i class="fa fa-download"></i> Reporte
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

  public function PaginarCotizaciones($busqueda,$x,$y,$tipolistado)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarCotizacion_ii(:busqueda)');
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

  public function PaginarClientesCotizacion($busqueda,$x,$y)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL PAGINARClienteCotizacion(:busqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda));
      $cantidad = $sql_comando -> rowCount();
      $numpaginas = ceil($cantidad / $y);
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
                <a idprd="'.($x-1).'" class="page-link" aria-label="Previous" onclick="PaginacionClientes(this)">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

          if($x==$i){
            $output.=  '<li class="page-item active"><a idprd="'.$i.'" class="page-link" onclick="PaginacionClientes(this)">'.($i+1).'</a></li>';
          }
          else
          {
            $output.=  '<li class="page-item"><a idprd="'.$i.'" class="page-link" onclick="PaginacionClientes(this)">'.($i+1).'</a></li>';
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
                <a idprd="'.($x+1).'" class="page-link" aria-label="Next" onclick="PaginacionClientes(this)">
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
                <a class="page-link" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
        $output .= 
            '<li class="page-item">
                <a class="page-link" aria-label="Next">
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
  /* FIN - Métodos de Orden Compra */
}
?>