<?php
require_once '../conexion/bd_conexion.php';
require_once 'clases_entrada/class_formulario_entrada.php';
class Entrada
{
	/* INICIO - Atributos de Guia Interna Entrada */
	private $intIdEntrada;
  private $intIdTipoComprobante;
  private $intIdSucursal;
  private $nvchSerie;
  private $nvchNumeracion;
	private $intIdUsuario;
  private $nvchRUC;
  private $nvchRazonSocial;
	private $dtmFechaCreacion;
  private $intIdTipoMoneda;
  private $intIdTipoPago;
  private $bitEstado;
  private $nvchObservacion;

	public function IdEntrada($intIdEntrada){ $this->intIdEntrada = $intIdEntrada; }
  public function IdTipoComprobante($intIdTipoComprobante){ $this->intIdTipoComprobante = $intIdTipoComprobante; }
  public function IdSucursal($intIdSucursal){ $this->intIdSucursal = $intIdSucursal; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
	public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
	public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function IdTipoPago($intIdTipoPago){ $this->intIdTipoPago = $intIdTipoPago; }
  public function Estado($bitEstado){ $this->bitEstado = $bitEstado; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
	/* FIN - Atributos de Guia Interna Entrada */

  /* INICIO - Métodos de Guia Interna Entrada */
  public function InsertarEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarEntrada(@intIdEntrada,:intIdTipoComprobante,:intIdSucursal,
        :nvchSerie,:nvchNumeracion,:intIdUsuario,:nvchRUC,:nvchRazonSocial,:dtmFechaCreacion,:intIdTipoMoneda,:intIdTipoPago,
        :bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
      	':intIdTipoComprobante' => $this->intIdTipoComprobante,
        ':intIdSucursal' => $this->intIdSucursal,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':nvchRUC' => $this->nvchRUC,
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':intIdTipoPago' => $this->intIdTipoPago,
        ':bitEstado' => 1,
        ':nvchObservacion' => $this->nvchObservacion));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdEntrada as intIdEntrada");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdEntrada'] = $salida->intIdEntrada;
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
      $FormularioEntrada->IdTipoComprobante($fila['intIdTipoComprobante']);
      $FormularioEntrada->Serie($fila['nvchSerie']);
      $FormularioEntrada->Numeracion($fila['nvchNumeracion']);
      $FormularioEntrada->IdUsuario($fila['intIdUsuario']);
      $FormularioEntrada->RUC($fila['nvchRUC']);
      $FormularioEntrada->RazonSocial($fila['nvchRazonSocial']);
      $FormularioEntrada->FechaCreacion($fila['dtmFechaCreacion']);
      $FormularioEntrada->IdTipoMoneda($fila['intIdTipoMoneda']);
      $FormularioEntrada->IdTipoPago($fila['intIdTipoPago']);
      $FormularioEntrada->Estado($fila['bitEstado']);

      $FormularioEntrada->NombreUsuario($fila['NombreUsuario']);
      $FormularioEntrada->NombrePago($fila['NombrePago']);
      $FormularioEntrada->SimboloMoneda($fila['SimboloMoneda']);

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
      $sql_comando = $sql_conectar->prepare('CALL ActualizarEntrada(:intIdEntrada,:intIdTipoComprobante,:intIdSucursal,
        :nvchSerie,:nvchNumeracion,:intIdUsuario,:nvchRUC,:nvchRazonSocial,:dtmFechaCreacion,:intIdTipoMoneda,:intIdTipoPago,
        :bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdEntrada' => $this->intIdEntrada,
        ':intIdTipoComprobante' => $this->intIdTipoComprobante,
        ':intIdSucursal' => $this->intIdSucursal,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':nvchRUC' => $this->nvchRUC,
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':intIdTipoPago' => $this->intIdTipoPago,
        ':bitEstado' => $this->bitEstado,
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

  public function ListarEntradas($busqueda,$x,$y,$tipolistado,$intIdTipoComprobante)
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
        $sql_comando = $sql_conectar->prepare('CALL buscarEntrada_ii(:busqueda,:intIdTipoComprobante)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarEntrada_ii(:busqueda,:intIdTipoComprobante)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Cliente por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarEntrada(:busqueda,:x,:y,:intIdTipoComprobante)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y, ':intIdTipoComprobante' => $intIdTipoComprobante));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdEntrada"] == $_SESSION['intIdEntrada'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo
        '<td>'.$fila["nvchSerie"].'-'.$fila["nvchNumeracion"].'</td>
        <td>'.$fila["nvchRazonSocial"].'</td>
        <td>'.$fila["NombreUsuario"].'</td>
        <td>'.$fila["dtmFechaCreacion"].'</td>
        <td> 
          <button type="submit" id="'.$fila["intIdEntrada"].'" class="btn btn-xs btn-warning btn-mostrar-entrada">
            <i class="fa fa-edit"></i> Ver Detalle
          </button>
          <button type="submit" id="'.$fila["intIdEntrada"].'" class="btn btn-xs btn-danger btn-anular-entrada">
            <i class="fa fa-trash"></i> Anular
          </button>
          <button type="submit" id="'.$fila["intIdEntrada"].'" class="btn btn-xs btn-default btn-download-report">
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

  public function PaginarEntradas($busqueda,$x,$y,$tipolistado,$intIdTipoComprobante)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarEntrada_ii(:busqueda,:intIdTipoComprobante)');
      $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante));
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