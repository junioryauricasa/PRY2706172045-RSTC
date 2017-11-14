<?php 
require_once '../conexion/bd_conexion.php';
class Comprobante{
  /* INICIO - Atributos de Orden Compra*/
  private $intIdComprobante;
  private $intIdTipoComprobante;
  private $intTipoDetalle;
  private $intIdSucursal;
  private $dtmFechaCreacion;
  private $nvchSerie;
  private $nvchNumeracion;
  private $intIdUsuario;
  private $intIdCliente;
  private $IntIdProveedor;
  private $nvchClienteProveedor;
  private $nvchDNIRUC;
  private $nvchDireccion;
  private $intIdTipoMoneda;
  private $intIdTipoPago;
  private $intIdTipoVenta;
  private $bitEstado;
  private $nvchObservacion;
  
  public function IdComprobante($intIdComprobante){ $this->intIdComprobante = $intIdComprobante; }
  public function IdTipoComprobante($intIdTipoComprobante){ $this->intIdTipoComprobante = $intIdTipoComprobante; }
  public function TipoDetalle($intTipoDetalle){ $this->intTipoDetalle = $intTipoDetalle; }
  public function IdSucursal($intIdSucursal){ $this->intIdSucursal = $intIdSucursal; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function IdProveedor($intIdProveedor){ $this->intIdProveedor = $intIdProveedor; }
  public function ClienteProveedor($nvchClienteProveedor){ $this->nvchClienteProveedor = $nvchClienteProveedor; }
  public function DNIRUC($nvchDNIRUC){ $this->nvchDNIRUC = $nvchDNIRUC; }
  public function Direccion($nvchDireccion){ $this->nvchDireccion = $nvchDireccion; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function IdTipoPago($intIdTipoPago){ $this->intIdTipoPago = $intIdTipoPago; }
  public function IdTipoVenta($intIdTipoVenta){ $this->intIdTipoVenta = $intIdTipoVenta; }
  public function Estado($bitEstado){ $this->bitEstado = $bitEstado; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
  /* FIN - Atributos de Orden Compra */

  /* INICIO - Métodos de Orden Compra */
  public function InsertarComprobante()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarComprobante(@intIdComprobante,:intIdTipoComprobante,:intTipoDetalle,:intIdSucursal,
        :dtmFechaCreacion,:nvchSerie,:nvchNumeracion,:intIdUsuario,:intIdCliente,:intIdProveedor,:nvchClienteProveedor,:nvchDNIRUC,
        :nvchDireccion,:intIdTipoMoneda,:intIdTipoPago,:intIdTipoVenta,:bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdTipoComprobante' => $this->intIdTipoComprobante,
        ':intTipoDetalle' => $this->intTipoDetalle,
        ':intIdSucursal' => $this->intIdSucursal,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':intIdUsuario' => $this->intIdUsuario,
        ':intIdCliente' => $this->intIdCliente,
        ':intIdProveedor' => $this->intIdProveedor,
        ':nvchClienteProveedor' => $this->nvchClienteProveedor,
        ':nvchDNIRUC' => $this->nvchDNIRUC,
        ':nvchDireccion' => $this->nvchDireccion,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':intIdTipoPago' => $this->intIdTipoPago,
        ':intIdTipoVenta' => $this->intIdTipoVenta,
        ':bitEstado' => 1,
        ':nvchObservacion' => $this->nvchObservacion));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdComprobante as intIdComprobante");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdComprobante'] = $salida->intIdComprobante;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarComprobante()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarComprobante(:intIdComprobante)');
      $sql_comando -> execute(array(':intIdComprobante' => $this->intIdComprobante));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioComprobante = new FormularioComprobante();
      $FormularioComprobante->IdComprobante($fila['intIdComprobante']);
      $FormularioComprobante->IdTipoComprobante($fila['intIdTipoComprobante']);
      $FormularioComprobante->IdSucursal($fila['intIdSucursal']);
      $FormularioComprobante->FechaCreacion($fila['dtmFechaCreacion']);
      $FormularioComprobante->Serie($fila['nvchSerie']);
      $FormularioComprobante->Numeracion($fila['nvchNumeracion']);
      $FormularioComprobante->IdUsuario($fila['intIdUsuario']);
      $FormularioComprobante->IdCliente($fila['intIdCliente']);
      $FormularioComprobante->IdProveedor($fila['intIdProveedor']);
      $FormularioComprobante->ClienteProveedor($fila['nvchClienteProveedor']);
      $FormularioComprobante->DNIRUC($fila['nvchDNIRUC']);
      $FormularioComprobante->Direccion($fila['nvchDireccion']);
      $FormularioComprobante->IdTipoMoneda($fila['intIdTipoMoneda']);
      $FormularioComprobante->IdTipoPago($fila['intIdTipoPago']);
      $FormularioComprobante->IdTipoVenta($fila['intIdTipoVenta']);
      $FormularioComprobante->Estado($fila['bitEstado']);

      $FormularioComprobante->NombreUsuario($fila['NombreUsuario']);
      $FormularioComprobante->SimboloMoneda($fila['NombreMoneda']);
      $FormularioComprobante->NombrePago($fila['NombrePago']);
      $FormularioComprobante->NombreVenta($fila['NombreVenta']);

      $FormularioComprobante->Observacion($fila['nvchObservacion']);
      $FormularioComprobante->MostrarDetalle();
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarComprobante()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ActualizarComprobante(:intIdComprobante,:intIdTipoComprobante,:intIdSucursal,
        :dtmFechaCreacion,:nvchSerie,:nvchNumeracion,:intIdUsuario,:intIdCliente,:intIdProveedor,:nvchClienteProveedor,:nvchDNIRUC,
        :nvchDireccion,:intIdTipoMoneda,:intIdTipoPago,:intIdTipoVenta,:bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdComprobante' => $this->intIdComprobante,
        ':intIdTipoComprobante' => $this->intIdTipoComprobante,
        ':intTipoDetalle' => $this->intTipoDetalle,
        ':intIdSucursal' => $this->intIdSucursal,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':intIdUsuario' => $this->intIdUsuario,
        ':intIdCliente' => $this->intIdCliente,
        ':intIdProveedor' => $this->intIdProveedor,
        ':nvchClienteProveedor' => $this->nvchClienteProveedor,
        ':nvchDNIRUC' => $this->nvchDNIRUC,
        ':nvchDireccion' => $this->nvchDireccion,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':intIdTipoPago' => $this->intIdTipoPago,
        ':intIdTipoVenta' => $this->intIdTipoVenta,
        ':bitEstado' => 1,
        ':nvchObservacion' => $this->nvchObservacion));
      $_SESSION['intIdComprobante'] = $this->intIdComprobante;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarComprobante()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL EliminarComprobante(:intIdComprobante)');
      $sql_comando -> execute(array(':intIdComprobante' => $this->intIdComprobante));
      $_SESSION['intIdComprobante'] = $this->intIdComprobante;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarComprobantes($busqueda,$x,$y,$tipolistado,$intIdTipoComprobante,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
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
        $sql_comando = $sql_conectar->prepare('CALL buscarComprobante_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,
          ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarComprobante_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,
          ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Cliente por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarComprobante(:busqueda,:x,:y,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
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
            $fila['TotalComprobante'] = round($fila['TotalComprobante']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVComprobante'] = round($fila['IGVComprobante']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorComprobante'] = round($fila['ValorComprobante']*$fila_moneda['dcmCambio2'],2); 
            $fila['SimboloMoneda'] = "S/.";
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalComprobante'] = round($fila['TotalComprobante']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVComprobante'] = round($fila['IGVComprobante']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorComprobante'] = round($fila['ValorComprobante']/$fila_moneda['dcmCambio2'],2);
            $fila['SimboloMoneda'] = "US$";
          }
        }

        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdComprobante"] == $_SESSION['intIdComprobante'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo
        '
        <td class="heading" data-th="ID"></td>
        <td>'.$fila["nvchSerie"].'-'.$fila["nvchNumeracion"].'</td>
        <td>'.$fila["NombreCliente"].'</td>
        <td>'.$fila["NombreUsuario"].'</td>
        <td>'.$fila["dtmFechaCreacion"].'</td>
        <td>'.$fila["SimboloMoneda"].' '.$fila["ValorComprobante"].'</td>
        <td>'.$fila["SimboloMoneda"].' '.$fila["IGVComprobante"].'</td>
        <td>'.$fila["SimboloMoneda"].' '.$fila["TotalComprobante"].'</td>
        <td> 
          <button type="submit" id="'.$fila["intIdComprobante"].'" class="btn btn-xs btn-warning btn-mostrar-Comprobante">
            <i class="fa fa-edit"></i> Ver Detalle
          </button>
          <button type="submit" id="'.$fila["intIdComprobante"].'" class="btn btn-xs btn-danger btn-anular-Comprobante">
            <i class="fa fa-trash"></i> Anular
          </button>
          <button type="submit" id="'.$fila["intIdComprobante"].'" class="btn btn-xs btn-default btn-download-report">
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

  public function TotalComprobantes($busqueda,$intIdTipoComprobante,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
  {
    try{
      $TotalComprobantes = 0.00;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarComprobante_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
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
            $fila['TotalComprobante'] = round($fila['TotalComprobante']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVComprobante'] = round($fila['IGVComprobante']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorComprobante'] = round($fila['ValorComprobante']*$fila_moneda['dcmCambio2'],2); 
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalComprobante'] = round($fila['TotalComprobante']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVComprobante'] = round($fila['IGVComprobante']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorComprobante'] = round($fila['ValorComprobante']/$fila_moneda['dcmCambio2'],2);
          }
        }
        $TotalComprobantes += $fila['TotalComprobante'];
      }
      if($intIdTipoMoneda == 1){
        $SimboloMoneda = "S/.";
      } else if($intIdTipoMoneda == 2){
        $SimboloMoneda = "US$";
      }
      echo $SimboloMoneda.' '.$TotalComprobantes;
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarComprobantes($busqueda,$x,$y,$tipolistado,$intIdTipoComprobante,$dtmFechaInicial,$dtmFechaFinal)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarComprobante_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
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
  /* FIN - Métodos de Orden Compra */
}
?>