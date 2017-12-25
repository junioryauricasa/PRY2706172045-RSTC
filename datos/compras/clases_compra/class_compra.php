<?php
require_once '../conexion/bd_conexion.php';
require_once 'clases_compra/class_formulario_compra.php';
class Compra
{
	/* INICIO - Atributos de Guia Interna Compra */
	private $intIdCompra;
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

	public function IdCompra($intIdCompra){ $this->intIdCompra = $intIdCompra; }
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
	/* FIN - Atributos de Guia Interna Compra */

  /* INICIO - Métodos de Guia Interna Compra */
  public function InsertarCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarCompra(@intIdCompra,:intIdTipoComprobante,:intIdSucursal,
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
      $salidas = $sql_conectar->query("select @intIdCompra as intIdCompra");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdCompra'] = $salida->intIdCompra;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarCompra($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarCompra(:intIdCompra)');
      $sql_comando -> execute(array(':intIdCompra' => $this->intIdCompra));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioCompra = new FormularioCompra();
      $FormularioCompra->IdCompra($fila['intIdCompra']);
      $FormularioCompra->IdTipoComprobante($fila['intIdTipoComprobante']);
      $FormularioCompra->Serie($fila['nvchSerie']);
      $FormularioCompra->Numeracion($fila['nvchNumeracion']);
      $FormularioCompra->IdUsuario($fila['intIdUsuario']);
      $FormularioCompra->RUC($fila['nvchRUC']);
      $FormularioCompra->RazonSocial($fila['nvchRazonSocial']);
      $FormularioCompra->FechaCreacion($fila['dtmFechaCreacion']);
      $FormularioCompra->IdTipoMoneda($fila['intIdTipoMoneda']);
      $FormularioCompra->IdTipoPago($fila['intIdTipoPago']);
      $FormularioCompra->Estado($fila['bitEstado']);

      $FormularioCompra->NombreUsuario($fila['NombreUsuario']);
      $FormularioCompra->NombrePago($fila['NombrePago']);
      $FormularioCompra->SimboloMoneda($fila['SimboloMoneda']);

      $FormularioCompra->Observacion($fila['nvchObservacion']);
      $FormularioCompra->MostrarDetalle();
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ActualizarCompra(:intIdCompra,:intIdTipoComprobante,:intIdSucursal,
        :nvchSerie,:nvchNumeracion,:intIdUsuario,:nvchRUC,:nvchRazonSocial,:dtmFechaCreacion,:intIdTipoMoneda,:intIdTipoPago,
        :bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdCompra' => $this->intIdCompra,
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
      $_SESSION['intIdCompra'] = $this->intIdCompra;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL EliminarCompra(:intIdCompra)');
      $sql_comando -> execute(array(':intIdCompra' => $this->intIdCompra));
      $_SESSION['intIdCompra'] = $this->intIdCompra;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarCompras($busqueda,$x,$y,$tipolistado,$intIdTipoComprobante,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
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
        $sql_comando = $sql_conectar->prepare('CALL buscarCompra_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,
          ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarCompra_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,
          ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Cliente por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarCompra(:busqueda,:x,:y,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y, ':intIdTipoComprobante' => $intIdTipoComprobante,
        ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
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
            $fila['TotalCompra'] = round($fila['TotalCompra']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVCompra'] = round($fila['IGVCompra']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorCompra'] = round($fila['ValorCompra']*$fila_moneda['dcmCambio2'],2); 
            $fila['SimboloMoneda'] = "S/.";
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalCompra'] = round($fila['TotalCompra']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVCompra'] = round($fila['IGVCompra']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorCompra'] = round($fila['ValorCompra']/$fila_moneda['dcmCambio2'],2);
            $fila['SimboloMoneda'] = "US$";
          }
        }

        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdCompra"] == $_SESSION['intIdCompra'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo
        '
            <td class="heading" data-th="ID"></td>
            <td>'.$fila["nvchSerie"].'-'.$fila["nvchNumeracion"].'</td>
            <td>'.$fila["nvchRazonSocial"].'</td>
            <td>'.$fila["NombreUsuario"].'</td>
            <td>'.$fila["dtmFechaCreacion"].'</td>
            <td style="text-align: right;">'.$fila["SimboloMoneda"].'</td>
            <td style="text-align: right;">'.$fila["SimboloMoneda"].' '.$fila["ValorCompra"].'</td>
            <td style="text-align: right;">'.$fila["SimboloMoneda"].' '.$fila["IGVCompra"].'</td>
            <td style="text-align: right;">'.$fila["SimboloMoneda"].' '.$fila["TotalCompra"].'</td>
            <td> 
              <button type="submit" id="'.$fila["intIdCompra"].'" class="btn btn-xs btn-warning btn-mostrar-compra">
                <i class="fa fa-edit"></i> Ver Detalle
              </button>
              <button type="submit" id="'.$fila["intIdCompra"].'" class="btn btn-xs btn-danger btn-anular-compra">
                <i class="fa fa-trash"></i> Anular
              </button>
              <button type="submit" id="'.$fila["intIdCompra"].'" class="btn btn-xs btn-default btn-download-report">
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

  public function TotalCompras($busqueda,$intIdTipoComprobante,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
  {
    try{
      $TotalCompras = 0.00;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarCompra_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,
        ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
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
            $fila['TotalCompra'] = round($fila['TotalCompra']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVCompra'] = round($fila['IGVCompra']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorCompra'] = round($fila['ValorCompra']*$fila_moneda['dcmCambio2'],2); 
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalCompra'] = round($fila['TotalCompra']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVCompra'] = round($fila['IGVCompra']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorCompra'] = round($fila['ValorCompra']/$fila_moneda['dcmCambio2'],2);
          }
        }
        $TotalCompras += $fila['TotalCompra'];
      }
      if($intIdTipoMoneda == 1){
        $SimboloMoneda = "S/.";
      } else if($intIdTipoMoneda == 2){
        $SimboloMoneda = "US$";
      }
      echo $SimboloMoneda.' '.$TotalCompras;
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarCompras($busqueda,$x,$y,$tipolistado,$intIdTipoComprobante,$dtmFechaInicial,$dtmFechaFinal)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarCompra_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,
        ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
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
	/* FIN - Métodos de Guia Interna Compra */
}
?>