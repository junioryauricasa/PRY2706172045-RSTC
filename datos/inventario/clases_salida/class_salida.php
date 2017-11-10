<?php
require_once '../conexion/bd_conexion.php';
require_once 'clases_salida/class_formulario_salida.php';
class Salida
{
	/* INICIO - Atributos de Guia Interna Salida */
	private $intIdSalida;
  private $dtmFechaCreacion;
  private $intIdCliente;
  private $nvchSerie;
  private $nvchNumeracion;
  private $nvchRazonSocial;
  private $nvchRUC;
  private $nvchAtencion;
  private $nvchDestino;
  private $nvchDireccion;
  private $intTipoPersona;
  private $intIdUsuarioSolicitado;
  private $intIdClienteSolicitado;
	private $intIdUsuario;
  private $intIdSucursal;
  private $intIdTipoMoneda;
  private $bitEstado;
  private $nvchObservacion;

	public function IdSalida($intIdSalida){ $this->intIdSalida = $intIdSalida; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function Atencion($nvchAtencion){ $this->nvchAtencion = $nvchAtencion; }
  public function Destino($nvchDestino){ $this->nvchDestino = $nvchDestino; }
  public function Direccion($nvchDireccion){ $this->nvchDireccion = $nvchDireccion; }
  public function TipoPersona($intTipoPersona){ $this->intTipoPersona = $intTipoPersona; }
  public function IdUsuarioSolicitado($intIdUsuarioSolicitado){ $this->intIdUsuarioSolicitado = $intIdUsuarioSolicitado; }
  public function IdClienteSolicitado($intIdClienteSolicitado){ $this->intIdClienteSolicitado = $intIdClienteSolicitado; }
	public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdSucursal($intIdSucursal){ $this->intIdSucursal = $intIdSucursal; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function Estado($bitEstado){ $this->bitEstado = $bitEstado; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
	/* FIN - Atributos de Guia Interna Salida */

  /* INICIO - Métodos de Guia Interna Salida */
  public function InsertarSalida()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarSalida(@intIdSalida,:dtmFechaCreacion,:intIdCliente,
        :nvchSerie,:nvchNumeracion,:nvchRazonSocial,:nvchRUC,:nvchAtencion,:nvchDestino,:nvchDireccion,:intTipoPersona,
        :intIdUsuarioSolicitado,:intIdClienteSolicitado,:intIdUsuario,:intIdSucursal,:intIdTipoMoneda,:bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':intIdCliente' => $this->intIdCliente,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':nvchRUC' => $this->nvchRUC,
        ':nvchAtencion' => $this->nvchAtencion,
        ':nvchDestino' => $this->nvchDestino,
        ':nvchDireccion' => $this->nvchDireccion,
        ':intTipoPersona' => $this->intTipoPersona,
        ':intIdUsuarioSolicitado' => $this->intIdUsuarioSolicitado,
        ':intIdClienteSolicitado' => $this->intIdClienteSolicitado,
        ':intIdUsuario' => $this->intIdUsuario,
        ':intIdSucursal' => $this->intIdSucursal,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':bitEstado' => 1,
        ':nvchObservacion' => $this->nvchObservacion));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdSalida as intIdSalida");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdSalida'] = $salida->intIdSalida;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarSalida($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarSalida(:intIdSalida)');
      $sql_comando -> execute(array(':intIdSalida' => $this->intIdSalida));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioSalida = new FormularioSalida();
      $FormularioSalida->IdSalida($fila['intIdSalida']);
      $FormularioSalida->FechaCreacion($fila['dtmFechaCreacion']);
      $FormularioSalida->IdCliente($fila['intIdCliente']);
      $FormularioSalida->Serie($fila['nvchSerie']);
      $FormularioSalida->Numeracion($fila['nvchNumeracion']);
      $FormularioSalida->RazonSocial($fila['nvchRazonSocial']);
      $FormularioSalida->RUC($fila['nvchRUC']);
      $FormularioSalida->Atencion($fila['nvchAtencion']);
      $FormularioSalida->Destino($fila['nvchDestino']);
      $FormularioSalida->Direccion($fila['nvchDireccion']);
      $FormularioSalida->IdUsuarioSolicitado($fila['intIdUsuarioSolicitado']);
      $FormularioSalida->IdClienteSolicitado($fila['intIdClienteSolicitado']);
      $FormularioSalida->IdUsuario($fila['intIdUsuario']);
      $FormularioSalida->IdSucursal($fila['intIdSucursal']);
      $FormularioSalida->Estado($fila['bitEstado']);
      $FormularioSalida->Observacion($fila['nvchObservacion']);
      $FormularioSalida->MostrarDetalle();
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarSalida()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ActualizarSalida(:intIdSalida,:dtmFechaCreacion,:intIdCliente,
        :nvchSerie,:nvchNumeracion,:nvchRazonSocial,:nvchRUC,:nvchAtencion,:nvchDestino,:nvchDireccion,:intIdUsuario,
        :intIdUsuarioSolicitado,:intIdClienteSolicitado,:nvchObservacion,:bitEstado,:intIdSucursal)');
      $sql_comando->execute(array(
        ':intIdSalida' => $this->intIdSalida,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':intIdCliente' => $this->intIdCliente,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':nvchRUC' => $this->nvchRUC,
        ':nvchAtencion' => $this->nvchAtencion,
        ':nvchDestino' => $this->nvchDestino,
        ':nvchDireccion' => $this->nvchDireccion,
        ':intIdUsuarioSolicitado' => $this->intIdUsuarioSolicitado,
        ':intIdClienteSolicitado' => $this->intIdClienteSolicitado,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdSucursal' => $this->intIdSucursal,
        ':bitEstado' => 1,
        ':nvchObservacion' => $this->nvchObservacion));
      $_SESSION['intIdSalida'] = $this->intIdSalida;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarSalida()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL EliminarSalida(:intIdSalida)');
      $sql_comando -> execute(array(':intIdSalida' => $this->intIdSalida));
      $_SESSION['intIdSalida'] = $this->intIdSalida;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarSalidas($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
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
        $sql_comando = $sql_conectar->prepare('CALL buscarSalida_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, 
          ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarSalida_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, 
          ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Cliente por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarSalida(:busqueda,:x,:y,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':dtmFechaInicial' => $dtmFechaInicial, 
          ':dtmFechaFinal' => $dtmFechaFinal));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $dtmFechaCambio =  date('Y-m-d', strtotime($fila['dtmFechaCreacion']));
        $sql_conexion_moneda = new Conexion_BD();
        $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
        $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDACOMERCIALFECHA(:dtmFechaCambio)');
        $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
        $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
        if($intIdTipoMoneda == 1){
          if($fila['intIdTipoMoneda'] != 1) {
            $fila['TotalSalida'] = round($fila['TotalSalida']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVSalida'] = round($fila['IGVSalida']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorSalida'] = round($fila['ValorSalida']*$fila_moneda['dcmCambio2'],2); 
            $fila['SimboloMoneda'] = "S/.";
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalSalida'] = round($fila['TotalSalida']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVSalida'] = round($fila['IGVSalida']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorSalida'] = round($fila['ValorSalida']/$fila_moneda['dcmCambio2'],2);
            $fila['SimboloMoneda'] = "US$";
          }
        }
        
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdSalida"] == $_SESSION['intIdSalida'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo
        '   <td class="heading" data-th="ID"></td>
            <td>'.$fila["nvchSerie"].'-'.$fila["nvchNumeracion"].'</td>
            <td>'.$fila["nvchRazonSocial"].'</td>
            <td>'.$fila["NombreUsuario"].'</td>
            <td>'.$fila["dtmFechaCreacion"].'</td>
            <td>'.$fila["SimboloMoneda"].' '.$fila["ValorSalida"].'</td>
            <td>'.$fila["SimboloMoneda"].' '.$fila["IGVSalida"].'</td>
            <td>'.$fila["SimboloMoneda"].' '.$fila["TotalSalida"].'</td>
            <td> 
              <button type="submit" id="'.$fila["intIdSalida"].'" class="btn btn-xs btn-warning btn-mostrar-salida">
                <i class="fa fa-edit"></i> Ver Detalle
              </button>
              <button type="submit" id="'.$fila["intIdSalida"].'" class="btn btn-xs btn-danger btn-anular-salida">
                <i class="fa fa-trash"></i> Anular
              </button>
              <button type="submit" id="'.$fila["intIdSalida"].'" class="btn btn-xs btn-default btn-download-report">
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

  public function TotalSalidas($busqueda,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
  {
    try{
      $TotalSalidas = 0.00;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarSalida_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial,
        ':dtmFechaFinal' => $dtmFechaFinal));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $dtmFechaCambio =  date('Y-m-d', strtotime($fila['dtmFechaCreacion']));
        $sql_conexion_moneda = new Conexion_BD();
        $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
        $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDACOMERCIALFECHA(:dtmFechaCambio)');
        $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
        $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
        if($intIdTipoMoneda == 1){
          if($fila['intIdTipoMoneda'] != 1) {
            $fila['TotalSalida'] = round($fila['TotalSalida']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVSalida'] = round($fila['IGVSalida']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorSalida'] = round($fila['ValorSalida']*$fila_moneda['dcmCambio2'],2); 
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalSalida'] = round($fila['TotalSalida']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVSalida'] = round($fila['IGVSalida']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorSalida'] = round($fila['ValorSalida']/$fila_moneda['dcmCambio2'],2);
          }
        }
        $TotalSalidas += $fila['TotalSalida'];
      }
      if($intIdTipoMoneda == 1){
        $SimboloMoneda = "S/.";
      } else if($intIdTipoMoneda == 2){
        $SimboloMoneda = "US$";
      }
      echo $SimboloMoneda.' '.$TotalSalidas;
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarSalidas($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarSalida_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, 
          ':dtmFechaFinal' => $dtmFechaFinal));
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
	/* FIN - Métodos de Guia Interna Salida */
}
?>