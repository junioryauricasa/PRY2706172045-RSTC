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
  private $intIdUsuarioSolicitado;
  private $intIdCliente;
  private $IntIdProveedor;
  private $nvchClienteProveedor;
  private $nvchDNIRUC;
  private $nvchDireccion;
  private $nvchAtencion;
  private $nvchDestino;
  private $dtmFechaTraslado;
  private $nvchPuntoPartida;
  private $nvchPuntoLlegada;
  private $intIdComprobanteReferencia;
  private $intIdTipoMoneda;
  private $intIdTipoPago;
  private $intIdTipoVenta;
  private $intDescontarGR;
  private $intEstado;
  private $nvchObservacion;
  
  public function IdComprobante($intIdComprobante){ $this->intIdComprobante = $intIdComprobante; }
  public function IdTipoComprobante($intIdTipoComprobante){ $this->intIdTipoComprobante = $intIdTipoComprobante; }
  public function TipoDetalle($intTipoDetalle){ $this->intTipoDetalle = $intTipoDetalle; }
  public function IdSucursal($intIdSucursal){ $this->intIdSucursal = $intIdSucursal; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdUsuarioSolicitado($intIdUsuarioSolicitado){ $this->intIdUsuarioSolicitado = $intIdUsuarioSolicitado; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function IdProveedor($intIdProveedor){ $this->intIdProveedor = $intIdProveedor; }
  public function ClienteProveedor($nvchClienteProveedor){ $this->nvchClienteProveedor = $nvchClienteProveedor; }
  public function DNIRUC($nvchDNIRUC){ $this->nvchDNIRUC = $nvchDNIRUC; }
  public function Direccion($nvchDireccion){ $this->nvchDireccion = $nvchDireccion; }
  public function Atencion($nvchAtencion){ $this->nvchAtencion = $nvchAtencion; }
  public function Destino($nvchDestino){ $this->nvchDestino = $nvchDestino; }
  public function FechaTraslado($dtmFechaTraslado){ $this->dtmFechaTraslado = $dtmFechaTraslado; }
  public function PuntoPartida($nvchPuntoPartida){ $this->nvchPuntoPartida = $nvchPuntoPartida; }
  public function PuntoLlegada($nvchPuntoLlegada){ $this->nvchPuntoLlegada = $nvchPuntoLlegada; }
  public function IdComprobanteReferencia($intIdComprobanteReferencia){ $this->intIdComprobanteReferencia = $intIdComprobanteReferencia; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function IdTipoPago($intIdTipoPago){ $this->intIdTipoPago = $intIdTipoPago; }
  public function IdTipoVenta($intIdTipoVenta){ $this->intIdTipoVenta = $intIdTipoVenta; }
  public function DescontarGR($intDescontarGR){ $this->intDescontarGR = $intDescontarGR; }
  public function Estado($intEstado){ $this->intEstado = $intEstado; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
  /* FIN - Atributos de Orden Compra */

  /* INICIO - Métodos de Orden Compra */
  public function InsertarComprobante()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarComprobante(@intIdComprobante,:intIdTipoComprobante,:intTipoDetalle,:intIdSucursal,
        :dtmFechaCreacion,:nvchSerie,:nvchNumeracion,:intIdUsuario,:intIdUsuarioSolicitado,:intIdCliente,
        :intIdProveedor,:nvchClienteProveedor,:nvchDNIRUC,:nvchDireccion,:nvchAtencion,:nvchDestino,
        :dtmFechaTraslado,:nvchPuntoPartida,:nvchPuntoLlegada,:intIdComprobanteReferencia,
        :intIdTipoMoneda,:intIdTipoPago,:intIdTipoVenta,:intDescontarGR,:intEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdTipoComprobante' => $this->intIdTipoComprobante,
        ':intTipoDetalle' => $this->intTipoDetalle,
        ':intIdSucursal' => $this->intIdSucursal,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':intIdUsuario' => $this->intIdUsuario,
        ':intIdUsuarioSolicitado' => $this->intIdUsuarioSolicitado,
        ':intIdCliente' => $this->intIdCliente,
        ':intIdProveedor' => $this->intIdProveedor,
        ':nvchClienteProveedor' => $this->nvchClienteProveedor,
        ':nvchDNIRUC' => $this->nvchDNIRUC,
        ':nvchDireccion' => $this->nvchDireccion,
        ':nvchAtencion' => $this->nvchAtencion,
        ':nvchDestino' => $this->nvchDestino,
        ':dtmFechaTraslado' => $this->dtmFechaTraslado,
        ':nvchPuntoPartida' => $this->nvchPuntoPartida,
        ':nvchPuntoLlegada' => $this->nvchPuntoLlegada,
        ':intIdComprobanteReferencia' => $this->intIdComprobanteReferencia,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':intIdTipoPago' => $this->intIdTipoPago,
        ':intIdTipoVenta' => $this->intIdTipoVenta,
        ':intDescontarGR' => $this->intDescontarGR,
        ':intEstado' => 1,
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

      $salida['intIdComprobante'] = $fila['intIdComprobante'];
      $salida['intTipoDetalle'] = $fila['intTipoDetalle'];
      $salida['dtmFechaCreacion'] = date('d/m/Y H:i:s', strtotime($fila['dtmFechaCreacion']));
      $salida['intIdSucursal'] = $fila['intIdSucursal'];
      $salida['intIdTipoComprobante'] = $fila['intIdTipoComprobante'];
      $salida['nvchSerie'] = $fila['nvchSerie'];
      $salida['nvchNumeracion'] = $fila['nvchNumeracion'];
      $salida['intIdTipoVenta'] = $fila['intIdTipoVenta'];
      $salida['intIdTipoMoneda'] = $fila['intIdTipoMoneda'];
      $salida['intIdTipoPago'] = $fila['intIdTipoPago'];

      $salida['nvchDNIRUC'] = $fila['nvchDNIRUC'];
      $salida['nvchClienteProveedor'] = $fila['nvchClienteProveedor'];
      $salida['nvchDireccion'] = $fila['nvchDireccion'];
      $salida['nvchAtencion'] = $fila['nvchAtencion'];
      $salida['nvchDestino'] = $fila['nvchDestino'];
      $salida['dtmFechaTraslado'] = date('d/m/Y H:i:s', strtotime($fila['dtmFechaTraslado']));
      $salida['nvchPuntoPartida'] = $fila['nvchPuntoPartida'];
      $salida['nvchPuntoLlegada'] = $fila['nvchPuntoLlegada'];
      $salida['intIdComprobanteReferencia'] = $fila['intIdComprobanteReferencia'];
      $salida['TipoCliente'] = $fila['TipoCliente'];
      $salida['intIdTipoCliente'] = $fila['intIdTipoCliente'];
      $salida['intDescontarGR'] = $fila['intDescontarGR'];

      $salida['intIdCliente'] = $fila['intIdCliente'];
      $salida['intIdProveedor'] = $fila['intIdProveedor'];
      $salida['intIdUsuarioSolicitado'] = $fila['intIdUsuarioSolicitado'];
      $salida['nvchObservacion'] = $fila['nvchObservacion'];
      echo json_encode($salida);
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
      $sql_comando = $sql_conectar->prepare('CALL ActualizarComprobante(:intIdComprobante,:intIdTipoComprobante,:intTipoDetalle,:intIdSucursal,
        :dtmFechaCreacion,:nvchSerie,:nvchNumeracion,:intIdUsuario,:intIdUsuarioSolicitado,:intIdCliente,
        :intIdProveedor,:nvchClienteProveedor,:nvchDNIRUC,:nvchDireccion,:nvchAtencion,:nvchDestino,
        :dtmFechaTraslado,:nvchPuntoPartida,:nvchPuntoLlegada,:intIdComprobanteReferencia,
        :intIdTipoMoneda,:intIdTipoPago,:intIdTipoVenta,:intDescontarGR,:intEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdComprobante' => $this->intIdComprobante,
        ':intIdTipoComprobante' => $this->intIdTipoComprobante,
        ':intTipoDetalle' => $this->intTipoDetalle,
        ':intIdSucursal' => $this->intIdSucursal,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':intIdUsuario' => $this->intIdUsuario,
        ':intIdUsuarioSolicitado' => $this->intIdUsuarioSolicitado,
        ':intIdCliente' => $this->intIdCliente,
        ':intIdProveedor' => $this->intIdProveedor,
        ':nvchClienteProveedor' => $this->nvchClienteProveedor,
        ':nvchDNIRUC' => $this->nvchDNIRUC,
        ':nvchDireccion' => $this->nvchDireccion,
        ':nvchAtencion' => $this->nvchAtencion,
        ':nvchDestino' => $this->nvchDestino,
        ':dtmFechaTraslado' => $this->dtmFechaTraslado,
        ':nvchPuntoPartida' => $this->nvchPuntoPartida,
        ':nvchPuntoLlegada' => $this->nvchPuntoLlegada,
        ':intIdComprobanteReferencia' => $this->intIdComprobanteReferencia,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':intIdTipoPago' => $this->intIdTipoPago,
        ':intIdTipoVenta' => $this->intIdTipoVenta,
        ':intDescontarGR' => $this->intDescontarGR,
        ':intEstado' => 1,
        ':nvchObservacion' => $this->nvchObservacion));
      $_SESSION['intIdComprobante'] = $this->intIdComprobante;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function AnularComprobante()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL AnularComprobante(:intIdComprobante)');
      $sql_comando -> execute(array(':intIdComprobante' => $this->intIdComprobante));
      $_SESSION['intIdComprobante'] = $this->intIdComprobante;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarComprobantes($busqueda,$x,$y,$tipolistado,$intIdTipoComprobante,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda,$intTipoDetalle)
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
        $sql_comando = $sql_conectar->prepare('CALL buscarComprobante_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal,:intTipoDetalle)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,
          ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal,':intTipoDetalle' => $intTipoDetalle));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } 
      //Busqueda de Cliente por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarComprobante(:busqueda,:x,:y,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal,:intTipoDetalle)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y, ':intIdTipoComprobante' => $intIdTipoComprobante,
        ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal,':intTipoDetalle' => $intTipoDetalle));
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
        } else if($fila["intEstado"] == 0){
          echo '<tr bgcolor="#F09C9C">';
        } else {
          echo '<tr>';
        }
        echo
        '
        <td class="heading" data-th="ID"></td>
        <td>'.$fila["nvchSerie"].'</td>
        <td>'.$fila["nvchNumeracion"].'</td>
        <td>'.$fila["NombreComprobante"].'</td>';
        if($intTipoDetalle == 1)
          echo '<td>'.$fila["NombreCliente"].'</td>';
        else if($intTipoDetalle == 2)
          echo '<td>'.$fila["NombreProveedor"].'</td>';
        echo
        '<td>'.$fila["NombreUsuario"].'</td>
        <td>'.$fila["dtmFechaCreacion"].'</td>';
        if($fila['intIdTipoComprobante'] != 3 && $fila['intIdTipoComprobante'] != 7){
          echo
          '<td>'.$fila["SimboloMoneda"].' '.number_format($fila["ValorComprobante"],2,'.',',').'</td>
          <td>'.$fila["SimboloMoneda"].' '.number_format($fila["IGVComprobante"],2,'.',',').'</td>
          <td>'.$fila["SimboloMoneda"].' '.number_format($fila["TotalComprobante"],2,'.',',').'</td>';
        }
        else {
          echo
          '<td> - </td>
          <td> - </td>
          <td> - </td>';
        }
        echo
        '<td class="text-center"> 
          <button type="button" id="'.$fila["intIdComprobante"].'" class="btn btn-xs btn-warning btn-mostrar-comprobante">
            <i class="fa fa-edit"></i></button>
          <button type="button" id="'.$fila["intIdComprobante"].'" class="btn btn-xs btn-danger btn-anular-comprobante">
            <i class="fa fa-trash"></i></button> ';
        if($fila['intTipoDetalle'] == 1 || $fila['intIdTipoComprobante'] == 10 || $fila['intIdTipoComprobante'] == 4){  
        echo 
        '<button type="button" id="'.$fila["intIdComprobante"].'" idcr="'.$fila["intIdTipoComprobante"].'" 
        idtv="'.$fila['intIdTipoVenta'].'" class="btn btn-xs btn-default btn-reporte-comprobante">
            <i class="fa fa-download"></i></button>';
        }
        echo '
        <button type="button" id="'.$fila["intIdComprobante"].'" idtv="'.$fila['intIdTipoVenta'].'" class="btn btn-xs btn-success btn-ubigeo-comprobante">
            <i class="fa fa-download"></i></button>
        </td>
        </tr>';
        $i++;
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function TotalComprobantes($busqueda,$intIdTipoComprobante,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda,$intTipoDetalle)
  {
    try{
      $TotalComprobantes = 0.00;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarComprobante_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal,:intTipoDetalle)');
      $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,
        ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal,':intTipoDetalle' => $intTipoDetalle));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($fila['intEstado'] == 1){
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
      }
      if($intIdTipoMoneda == 1){
        $SimboloMoneda = "S/.";
      } else if($intIdTipoMoneda == 2){
        $SimboloMoneda = "US$";
      }
      echo $SimboloMoneda.' '.number_format($TotalComprobantes,2,'.',',');
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarComprobantes($busqueda,$x,$y,$tipolistado,$intIdTipoComprobante,$dtmFechaInicial,$dtmFechaFinal,$intTipoDetalle)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarComprobante_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal,:intTipoDetalle)');
      $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,
        ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal,':intTipoDetalle' => $intTipoDetalle));
      $cantidad = $sql_comando -> rowCount();
      $numpaginas = ceil($cantidad / $y);
      if($tipolistado == "N" || $tipolistado == "D")
      { $x = $numpaginas - 1; }
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
                <a idp="'.($x-1).'" class="page-link btn-pagina-comprobante" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

        if($x==$i){
          $output.=  '<li class="page-item active"><a idp="'.$i.'" class="page-link btn-pagina-comprobante marca-comprobante">'.($i+1).'</a></li>';
        }
        else
        {
          $output.=  '<li class="page-item"><a idp="'.$i.'" class="page-link btn-pagina-comprobante">'.($i+1).'</a></li>';
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
                <a idp="'.($x+1).'" class="page-link btn-pagina-comprobante" aria-label="Next">
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
                <a class="page-link btn-pagina-comprobante" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
        $output .= 
            '<li class="page-item">
                <a class="page-link btn-pagina-comprobante" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </li>';
      }
      echo $output;
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarVentasComprobante($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal)
  {
    try{
      if($tipolistado == "V" && $busqueda == ""){
        $output = "";
        $output .= 
            '<li class="page-item">
                <a class="page-link btn-pagina-venta" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
        $output .= 
            '<li class="page-item">
                <a class="page-link btn-pagina-venta" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </li>';
      echo $output;
      return false;
      }
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarcomprobante_venta_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
      $cantidad = $sql_comando -> rowCount();
      $ipaginas = ceil($cantidad / $y);
      if($tipolistado == "N" || $tipolistado == "D")
      { $x = $ipaginas - 1; }
      //else if($tipolistado == "E")
      //{ $x = $x / $y; }
      $output = "";
      for($i = 0; $i < $ipaginas; $i++){
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
                <a idp="'.($x-1).'" class="page-link btn-pagina-venta" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

          if($x==$i){
            $output.=  '<li class="page-item active"><a idp="'.$i.'" class="page-link btn-pagina-venta marca-venta">'.($i+1).'</a></li>';
          }
          else
          {
            $output.=  '<li class="page-item"><a idp="'.$i.'" class="page-link btn-pagina-venta">'.($i+1).'</a></li>';
          }

        if($i==($ipaginas-1))
        {
          if($x==($ipaginas-1))
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
                <a idp="'.($x+1).'" class="page-link btn-pagina-venta" aria-label="Next">
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
                <a class="page-link btn-pagina-venta" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
        $output .= 
            '<li class="page-item">
                <a class="page-link btn-pagina-venta" aria-label="Next">
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

  public function ListarVentasComprobante($busqueda,$x,$y,$dtmFechaInicial,$dtmFechaFinal)
  {
    try{
      if($busqueda != "" || $busqueda != null) {
        $sql_conexion = new Conexion_BD();
        $sql_conectar = $sql_conexion->Conectar();
        $sql_comando = $sql_conectar->prepare('CALL buscarComprobante_venta(:busqueda,:x,:y,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':dtmFechaInicial' => $dtmFechaInicial,
                      ':dtmFechaFinal' => $dtmFechaFinal));
        while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
        {
          echo '
          <tr>
            <td class="heading" data-th="ID"></td>
            <td>'.$fila["nvchSerie"].'</td>
            <td>'.$fila["nvchNumeracion"].'</td>
            <td>'.$fila["NombreCliente"].'</td>
            <td>'.$fila["NombreUsuario"].'</td>
            <td>'.$fila["dtmFechaCreacion"].'</td>
            <td>'.$fila["NombreVenta"].'</td>
            <td> 
              <button type="button" idscli="'.$fila["intIdCliente"].'" idtv="'.$fila['intIdTipoVenta'].'" 
              idv="'.$fila["intIdComprobante"].'" nv="'.$fila["NombreVenta"].'" idtm="'.$fila['intIdTipoMoneda'].'"
              class="btn btn-xs btn-warning" 
              onclick="InsertarVenta(this)">
                <i class="fa fa-edit"></i> Elegir
              </button>
            </td>
          </tr>';
        }
      } else {
        echo "";
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function InsertarVentaComprobante($intIdComprobante,$i,$intIdTipoVenta)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleComprobante(:intIdComprobante)');
      $sql_comando -> execute(array(':intIdComprobante' => $intIdComprobante));
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
      $readonly = "readonly";
      //$readonly = "";
      $filaEliminar = '<td>'.
          '<button type="button" style="width: 25px !important" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit" data-toggle="tooltip" title="Eliminar!"></i></button>'.
        '</td>';
        if($intIdTipoVenta == 1){
          echo
          '<tr>
            <td class="heading" data-th="ID">'.$i.'</td> '.
            '<td><input type="hidden" name="fila[]" value="'.$i.'" form="form-comprobante" />'.
                '<input type="hidden" id="intIdProducto'.$i.'" name="intIdProducto[]" form="form-comprobante" value="'.$fila['intIdProducto'].'" />'.
                '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigo'.$i.'" name="nvchCodigo[]" value="'.$fila['nvchCodigo'].'" form="form-comprobante" '.$readonly.' />'.
                '<div class="result" id="result'.$i.'">'.
            '</td>'.
            '<td><input type="text" style="width: 100% !important" id="nvchDescripcion'.$i.'" name="nvchDescripcion[]" form="form-comprobante" value="'.$fila['nvchDescripcion'].'" readonly/></td>';
            if($fila['intTipoDetalle'] == 1 && $fila['intIdTipoComprobante'] < 3){
            echo
            '<td class="filaPrecio">'.
              '<input type="text" id="dcmPrecio'.$i.'" name="dcmPrecio[]" form="form-comprobante" value="'.$fila['dcmPrecio'].'" readonly />'.
            '</td>'.
            '<td class="filaDescuento"><input type="text" style="max-width: 105px !important" id="dcmDescuento'.$i.'" name="dcmDescuento[]" form="form-comprobante" idsprt="'.$i.'"'.
              'onkeyup="CalcularPrecioTotal(this)" value="'.$fila['dcmDescuento'].'" '.$readonly.' /></td>';
            }
            echo
            '<td class="filaPrecioUnitario"><input type="text" style="max-width: 105px !important" id="dcmPrecioUnitario'.$i.'" name="dcmPrecioUnitario[]" form="form-comprobante" value="'.$fila['dcmPrecioUnitario'].'"';
            if($fila['intTipoDetalle'] == 1 && $fila['intIdTipoComprobante'] < 3)
              echo 'readonly/></td>';
            else 
              echo '/></td>';
            echo '<td><input type="text" id="intCantidad'.$i.'" name="intCantidad[]" form="form-comprobante" idsprt="'.$i.'"'.
              'onkeyup="CalcularPrecioTotal(this)" value="'.$fila['intCantidad'].'" /></td>'.
            '<td class="filaTotal"><input type="text" id="dcmTotal'.$i.'" name="dcmTotal[]" form="form-comprobante" value="'.$fila['dcmTotal'].'" readonly/></td>'.$filaEliminar;
          '</tr>';
              $i++;
        } else if($intIdTipoVenta == 3){
          echo
          '<tr>'.
          '<td class="heading" data-th="ID">'.$i.'</td>'.
          '<td><input type="hidden" style="width: 110px !important" name="fila[]" value="'.$i.'" form="form-comprobante" />'.
              '<input type="hidden" style="width: 110px !important" id="intIdProductoM'.$i.'" name="intIdProductoM[]" value="'.$fila['intIdProducto'].'" form="form-comprobante" />'.
              '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigoM'.$i.'" name="nvchCodigoM[]" value="'.$fila['nvchCodigo'].'" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)" '.$readonly.'/>'.
              '<div class="result" id="resultM'.$i.'">'.
          '</td>'.
          '<td>'.
            '<input style="width: 110px !important" type="hidden" name="fila[]" value="'.$i.'" form="form-comprobante" />'.
            '<textarea id="nvchDescripcionM'.$i.'" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionM[]" form="form-comprobante" rows="4" '.$readonly.'>'.$fila['nvchDescripcion'].'</textarea>'.
          '</td>'.
          '<td class="filaPrecioUnitario">'.
            '<input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioM'.$i.'" name="dcmPrecioUnitarioM[]" value="'.$fila['dcmPrecioUnitario'].'" idsprt="'.$i.'" form="form-comprobante" onkeyup="CalcularPrecioTotalM(this)" '.$readonly.'/>'.
          '</td>'.
          '<td>'.
            '<input type="text" id="intCantidadM'.$i.'" name="intCantidadM[]" idsprt="'.$i.'" form="form-comprobante" value="'.$fila['intCantidad'].'" onkeyup="CalcularPrecioTotalM(this)"/>'.
          '</td>'.
          '<td class="filaTotal">'.
            '<input type="text" id="dcmTotalM'.$i.'" value="'.$fila['dcmTotal'].'" name="dcmTotalM[]" form="form-comprobante" readonly/>'.
          '</td>'.$filaEliminar.
        '</tr>';
        $i++;
        } else if($intIdTipoVenta == 4){
          echo
          '<tr>'.
          '<td class="heading" data-th="ID">'.$i.'</td>'.
          '<td><input type="hidden" style="width: 110px !important" name="fila[]" value="'.$i.'" form="form-comprobante" />'.
              '<input type="hidden" style="width: 110px !important" id="intIdProductoI'.$i.'" name="intIdProductoI[]" value="'.$fila['intIdProducto'].'" form="form-comprobante" />'.
              '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigoI'.$i.'" name="nvchCodigoI[]" value="'.$fila['nvchCodigo'].'" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)" '.$readonly.'/>'.
              '<div class="result" id="resultM'.$i.'">'.
          '</td>'.
          '<td>'.
            '<input style="width: 110px !important" type="hidden" name="fila[]" value="'.$i.'" form="form-comprobante" />'.
            '<textarea id="nvchDescripcionI'.$i.'" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionI[]" form="form-comprobante" rows="4" '.$readonly.'>'.$fila['nvchDescripcion'].'</textarea>'.
          '</td>'.
          '<td class="filaPrecioUnitario">'.
            '<input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioI'.$i.'" name="dcmPrecioUnitarioI[]" value="'.$fila['dcmPrecioUnitario'].'" idsprt="'.$i.'" form="form-comprobante" onkeyup="CalcularPrecioTotalI(this)" '.$readonly.'/>'.
          '</td>'.
          '<td>'.
            '<input type="text" id="intCantidadI'.$i.'" name="intCantidadI[]" idsprt="'.$i.'" form="form-comprobante" value="'.$fila['intCantidad'].'" onkeyup="CalcularPrecioTotalI(this)"/>'.
          '</td>'.
          '<td class="filaTotal">'.
            '<input type="text" id="dcmTotalI'.$i.'" value="'.$fila['dcmTotal'].'" name="dcmTotalI[]" form="form-comprobante" readonly/>'.
          '</td>'.$filaEliminar.
        '</tr>';
        $i++;
        }  
      }
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }    
  }
  /* FIN - Métodos de Orden Compra */
}
?>