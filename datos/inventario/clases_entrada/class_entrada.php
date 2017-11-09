<?php
require_once '../conexion/bd_conexion.php';
require_once 'clases_entrada/class_formulario_entrada.php';
class Entrada
{
	/* INICIO - Atributos de Guia Interna Entrada */
	private $intIdEntrada;
  private $dtmFechaCreacion;
  private $nvchSerie;
  private $nvchNumeracion;
  private $nvchRazonSocial;
  private $nvchRUC;
  private $nvchAtencion;
  private $intIdUsuarioSolicitado;
	private $intIdUsuario;
	private $intIdSucursal;
  private $intIdTipoMoneda;
  private $bitEstado;
  private $nvchObservacion;

	public function IdEntrada($intIdEntrada){ $this->intIdEntrada = $intIdEntrada; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function IdUsuarioSolicitado($intIdUsuarioSolicitado){ $this->intIdUsuarioSolicitado = $intIdUsuarioSolicitado; }
	public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdSucursal($intIdSucursal){ $this->intIdSucursal = $intIdSucursal; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function Estado($bitEstado){ $this->bitEstado = $bitEstado; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
	/* FIN - Atributos de Guia Interna Entrada */

  /* INICIO - Métodos de Guia Interna Entrada */
  public function InsertarEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarEntrada(@intIdEntrada,:dtmFechaCreacion,
        :nvchSerie,:nvchNumeracion,:nvchRazonSocial,:nvchRUC,:intIdUsuarioSolicitado,:intIdUsuario,:intIdSucursal,
        :intIdTipoMoneda,:bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':nvchRUC' => $this->nvchRUC,
        ':intIdUsuarioSolicitado' => $this->intIdUsuarioSolicitado,
        ':intIdUsuario' => $this->intIdUsuario,
        ':intIdSucursal' => $this->intIdSucursal,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':bitEstado' => 1,
        ':nvchObservacion' => $this->nvchObservacion));
      $sql_comando->closeCursor();
      $Entradas = $sql_conectar->query("select @intIdEntrada as intIdEntrada");
      $Entrada = $Entradas->fetchObject();
      $_SESSION['intIdEntrada'] = $Entrada->intIdEntrada;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarEntrada($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarEntrada(:intIdEntrada)');
      $sql_comando -> execute(array(':intIdEntrada' => $this->intIdEntrada));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioEntrada = new FormularioEntrada();
      $FormularioEntrada->IdEntrada($fila['intIdEntrada']);
      $FormularioEntrada->FechaCreacion($fila['dtmFechaCreacion']);
      $FormularioEntrada->Serie($fila['nvchSerie']);
      $FormularioEntrada->Numeracion($fila['nvchNumeracion']);
      $FormularioEntrada->RazonSocial($fila['nvchRazonSocial']);
      $FormularioEntrada->RUC($fila['nvchRUC']);
      $FormularioEntrada->IdUsuarioSolicitado($fila['intIdUsuarioSolicitado']);
      $FormularioEntrada->IdUsuario($fila['intIdUsuario']);
      $FormularioEntrada->IdSucursal($fila['intIdSucursal']);
      $FormularioEntrada->Estado($fila['bitEstado']);
      $FormularioEntrada->Observacion($fila['nvchObservacion']);
      $FormularioEntrada->MostrarDetalle();
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ActualizarEntrada(:intIdEntrada,:dtmFechaCreacion,
        :nvchSerie,:nvchNumeracion,:nvchRazonSocial,:nvchRUC,:intIdUsuarioSolicitado,:intIdUsuario,:intIdSucursal,
        :bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdEntrada' => $this->intIdEntrada,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':nvchRUC' => $this->nvchRUC,
        ':intIdUsuarioSolicitado' => $this->intIdUsuarioSolicitado,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdSucursal' => $this->intIdSucursal,
        ':bitEstado' => 1,
        ':nvchObservacion' => $this->nvchObservacion));
      $_SESSION['intIdEntrada'] = $this->intIdEntrada;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL EliminarEntrada(:intIdEntrada)');
      $sql_comando -> execute(array(':intIdEntrada' => $this->intIdEntrada));
      $_SESSION['intIdEntrada'] = $this->intIdEntrada;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarEntradas($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
  {
    try{
      $Entrada = "";
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de Cliente por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarEntrada_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, 
          ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarEntrada_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, 
          ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Cliente por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarEntrada(:busqueda,:x,:y,:dtmFechaInicial,:dtmFechaFinal)');
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
            $fila['TotalEntrada'] = round($fila['TotalEntrada']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVEntrada'] = round($fila['IGVEntrada']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorEntrada'] = round($fila['ValorEntrada']*$fila_moneda['dcmCambio2'],2); 
            $fila['SimboloMoneda'] = "S/.";
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalEntrada'] = round($fila['TotalEntrada']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVEntrada'] = round($fila['IGVEntrada']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorEntrada'] = round($fila['ValorEntrada']/$fila_moneda['dcmCambio2'],2);
            $fila['SimboloMoneda'] = "US$";
          }
        }
        
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdEntrada"] == $_SESSION['intIdEntrada'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo
        '
            <td class="heading" data-th="ID"></td>
            <td align="left" data-th="Numeración">'.$fila["nvchSerie"].'-'.$fila["nvchNumeracion"].'</td>
            <td align="right" data-th="Cliente">'.$fila["nvchRazonSocial"].'</td>
            <td align="right"data-th="Usuario que Generó">'.$fila["NombreUsuario"].'</td>
            <td align="right" data-th="Fecha de Creación">'.$fila["dtmFechaCreacion"].'</td>
            <td align="right" data-th="Valor de Entrada">'.$fila["SimboloMoneda"].' '.$fila["ValorEntrada"].'</td>
            <td align="right"data-th="IGV">'.$fila["SimboloMoneda"].' '.$fila["IGVEntrada"].'</td>
            <td align="right" data-th="Total Entrada">'.$fila["SimboloMoneda"].' '.$fila["TotalEntrada"].'</td>
            <td align="right" data-th="Opciones"> 
              <button type="button" id="'.$fila["intIdEntrada"].'" class="btn btn-xs btn-warning btn-mostrar-entrada">
                <i class="fa fa-edit"></i> Ver Detalle
              </button>
              <button type="button" id="'.$fila["intIdEntrada"].'" class="btn btn-xs btn-danger btn-anular-entrada">
                <i class="fa fa-trash"></i> Anular
              </button>
              <button type="button" id="'.$fila["intIdEntrada"].'" class="btn btn-xs btn-default btn-download-report">
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

  public function TotalEntradas($busqueda,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
  {
    try{
      $TotalEntradas = 0.00;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarEntrada_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
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
            $fila['TotalEntrada'] = round($fila['TotalEntrada']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVEntrada'] = round($fila['IGVEntrada']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorEntrada'] = round($fila['ValorEntrada']*$fila_moneda['dcmCambio2'],2); 
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalEntrada'] = round($fila['TotalEntrada']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVEntrada'] = round($fila['IGVEntrada']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorEntrada'] = round($fila['ValorEntrada']/$fila_moneda['dcmCambio2'],2);
          }
        }
        $TotalEntradas += $fila['TotalEntrada'];
      }
      if($intIdTipoMoneda == 1){
        $SimboloMoneda = "S/.";
      } else if($intIdTipoMoneda == 2){
        $SimboloMoneda = "US$";
      }
      echo $SimboloMoneda.' '.$TotalEntradas;
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarEntradas($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarEntrada_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
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
	/* FIN - Métodos de Guia Interna Entrada */
}
?>