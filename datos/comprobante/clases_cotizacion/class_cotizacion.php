<?php 
require_once '../conexion/bd_conexion.php';
require_once '../numeraciones/class_numeraciones.php';
class Cotizacion{
  /* INICIO - Atributos de Orden Compra*/
  private $intIdCotizacion;
  private $dtmFechaCreacion;
  private $nvchSerie;
  private $nvchNumeracion;
  private $intIdUsuario;
  private $intIdCliente;
  private $nvchClienteProveedor;
  private $nvchDNIRUC;
  private $nvchDireccion;
  private $nvchAtencion;
  private $intIdTipoMoneda;
  private $intIdTipoPago;
  private $intDiasValidez;
  private $intIdTipoVenta;
  private $nvchTipo;
  private $nvchModelo;
  private $nvchMarca;
  private $nvchHorometro;
  private $bitEstado;
  private $nvchObservacion;
  
  public function IdCotizacion($intIdCotizacion){ $this->intIdCotizacion = $intIdCotizacion; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function ClienteProveedor($nvchClienteProveedor){ $this->nvchClienteProveedor = $nvchClienteProveedor; }
  public function DNIRUC($nvchDNIRUC){ $this->nvchDNIRUC = $nvchDNIRUC; }
  public function Direccion($nvchDireccion){ $this->nvchDireccion = $nvchDireccion; }
  public function Atencion($nvchAtencion){ $this->nvchAtencion = $nvchAtencion; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function IdTipoPago($intIdTipoPago){ $this->intIdTipoPago = $intIdTipoPago; }
  public function DiasValidez($intDiasValidez){ $this->intDiasValidez = $intDiasValidez; }
  public function IdTipoVenta($intIdTipoVenta){ $this->intIdTipoVenta = $intIdTipoVenta; }
  public function Tipo($nvchTipo){ $this->nvchTipo = $nvchTipo; }
  public function Modelo($nvchModelo){ $this->nvchModelo = $nvchModelo; }
  public function Marca($nvchMarca){ $this->nvchMarca = $nvchMarca; }
  public function Horometro($nvchHorometro){ $this->nvchHorometro = $nvchHorometro; }
  public function Estado($bitEstado){ $this->bitEstado = $bitEstado; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
  /* FIN - Atributos de Orden Compra */

  /* INICIO - Métodos de Orden Compra */
  public function InsertarCotizacion()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarCotizacion(@intIdCotizacion,:dtmFechaCreacion,:nvchSerie,:nvchNumeracion,
        :intIdUsuario,:intIdCliente,:nvchClienteProveedor,:nvchDNIRUC,:nvchDireccion,:nvchAtencion,:intIdTipoMoneda,
        :intIdTipoPago,:intDiasValidez,:intIdTipoVenta,:nvchTipo,:nvchModelo,:nvchMarca,:nvchHorometro,
        :bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':nvchSerie' => '0001',
        ':nvchNumeracion' => '',
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdCliente' => $this->intIdCliente,
        ':nvchClienteProveedor' => $this->nvchClienteProveedor,
        ':nvchDNIRUC' => $this->nvchDNIRUC,
        ':nvchDireccion' => $this->nvchDireccion,
        ':nvchAtencion' => $this->nvchAtencion,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':intIdTipoPago' => $this->intIdTipoPago,
        ':intDiasValidez' => $this->intDiasValidez,
        ':intIdTipoVenta' => $this->intIdTipoVenta,
        ':nvchTipo' => $this->nvchTipo,
        ':nvchModelo' => $this->nvchModelo,
        ':nvchMarca' => $this->nvchMarca,
        ':nvchHorometro' => $this->nvchHorometro, 
        ':bitEstado' => 1,
        ':nvchObservacion' => $this->nvchObservacion));
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
      $FormularioCotizacion->Serie($fila['nvchSerie']);
      $FormularioCotizacion->Numeracion($fila['nvchNumeracion']);
      $FormularioCotizacion->IdUsuario($fila['intIdUsuario']);
      $FormularioCotizacion->IdCliente($fila['intIdCliente']);
      $FormularioCotizacion->Atencion($fila['nvchAtencion']);
      $FormularioCotizacion->IdTipoMoneda($fila['intIdTipoMoneda']);
      $FormularioCotizacion->IdTipoPago($fila['intIdTipoPago']);
      $FormularioCotizacion->DiasValidez($fila['intDiasValidez']);
      $FormularioCotizacion->IdTipoVenta($fila['intIdTipoVenta']);
      $FormularioCotizacion->Tipo($fila['nvchTipo']);
      $FormularioCotizacion->Modelo($fila['nvchModelo']);
      $FormularioCotizacion->Marca($fila['nvchMarca']);
      $FormularioCotizacion->Horometro($fila['nvchHorometro']);
      
      $FormularioCotizacion->NombreUsuario($fila['NombreUsuario']);
      $FormularioCotizacion->NombreCliente($fila['NombreCliente']);
      $FormularioCotizacion->DNICliente($fila['DNICliente']);
      $FormularioCotizacion->RUCCliente($fila['RUCCliente']);
      $FormularioCotizacion->SimboloMoneda($fila['SimboloMoneda']);
      $FormularioCotizacion->NombrePago($fila['NombrePago']);
      $FormularioCotizacion->NombreVenta($fila['NombreVenta']);

      $FormularioCotizacion->FechaCreacion($fila['dtmFechaCreacion']);
      $FormularioCotizacion->Observacion($fila['nvchObservacion']);
      //$FormularioCotizacion->ConsultarFormulario($funcion);
      $FormularioCotizacion->MostrarDetalle();
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
      $sql_comando = $sql_conectar->prepare('CALL ActualizarCotizacion(:intIdCotizacion,:dtmFechaCreacion,:nvchSerie,
        :nvchNumeracion,:intIdUsuario,:intIdCliente,:nvchClienteProveedor,:nvchDNIRUC,:nvchDireccion,:nvchAtencion,:intIdTipoMoneda,:intIdTipoPago,:intDiasValidez,:intIdTipoVenta,:nvchTipo,:nvchModelo,
        :nvchMarca,:nvchHorometro,:bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdCotizacion' => $this->intIdCotizacion,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':nvchSerie' => '0001',
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdCliente' => $this->intIdCliente,
        ':nvchAtencion' => $this->nvchAtencion,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':intIdTipoPago' => $this->intIdTipoPago,
        ':intDiasValidez' => $this->intDiasValidez,
        ':intIdTipoVenta' => $this->intIdTipoVenta,
        ':nvchTipo' => $this->nvchTipo,
        ':nvchModelo' => $this->nvchModelo,
        ':nvchMarca' => $this->nvchMarca,
        ':nvchHorometro' => $this->nvchHorometro, 
        ':bitEstado' => 1,
        ':nvchObservacion' => $this->nvchObservacion));
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

  public function ListarCotizaciones($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
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
        $sql_comando = $sql_conectar->prepare('CALL buscarCotizacion_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarCotizacion_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Cliente por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarCotizacion(:busqueda,:x,:y,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
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
            $fila['TotalCotizacion'] = round($fila['TotalCotizacion']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVCotizacion'] = round($fila['IGVCotizacion']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorCotizacion'] = round($fila['ValorCotizacion']*$fila_moneda['dcmCambio2'],2); 
            $fila['SimboloMoneda'] = "S/.";
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalCotizacion'] = round($fila['TotalCotizacion']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVCotizacion'] = round($fila['IGVCotizacion']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorCotizacion'] = round($fila['ValorCotizacion']/$fila_moneda['dcmCambio2'],2);
            $fila['SimboloMoneda'] = "US$";
          }
        }

        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdCotizacion"] == $_SESSION['intIdCotizacion'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo'
            <td class="heading" data-th="ID"></td>
            <td>'.$fila["nvchSerie"].'-'.$fila["nvchNumeracion"].'</td>
            <td>'.$fila["NombreCliente"].'</td>
            <td>'.$fila["NombreUsuario"].'</td>
            <td>'.$fila["dtmFechaCreacion"].'</td>
            <td>'.$fila["SimboloMoneda"].' '.$fila["ValorCotizacion"].'</td>
            <td>'.$fila["SimboloMoneda"].' '.$fila["IGVCotizacion"].'</td>
            <td>'.$fila["SimboloMoneda"].' '.$fila["TotalCotizacion"].'</td>
            <td> 
              <button type="button" id="'.$fila["intIdCotizacion"].'" class="btn btn-xs btn-warning btn-mostrar-cotizacion" data-toggle="tooltip" data-placement="top" title="Ver Detalle de Cotización">
                <i class="fa fa-edit"></i>
              </button>
              <button type="button" id="'.$fila["intIdCotizacion"].'" class="btn btn-xs btn-danger btn-anular-cotizacion" data-toggle="tooltip" data-placement="top" title="Anular Cotización">
                <i class="fa fa-trash"></i>
              </button>
              <button type="button" id="'.$fila["intIdCotizacion"].'" idtv="'.$fila["intIdTipoVenta"].'" class="btn btn-xs btn-default btn-reporte-cotizacion"  data-toggle="tooltip" data-placement="top" title="Descargar Reporte">
                <i class="fa fa-download"></i>
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

  public function TotalCotizaciones($busqueda,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
  {
    try{
      $TotalCotizaciones = 0.00;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarCotizacion_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $dtmFechaCambio =  date('Y-m-d', strtotime($fila['dtmFechaCreacion']));
        $sql_conexion_moneda = new Conexion_BD();
        $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
        $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDATRIBUTARIAFECHA(:dtmFechaCambio)');
        $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
        $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
        if($intIdTipoMoneda == 1){
          if($fila['intIdTipoMoneda'] != 1) {
            $fila['TotalCotizacion'] = round($fila['TotalCotizacion']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVCotizacion'] = round($fila['IGVCotizacion']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorCotizacion'] = round($fila['ValorCotizacion']*$fila_moneda['dcmCambio2'],2); 
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalCotizacion'] = round($fila['TotalCotizacion']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVCotizacion'] = round($fila['IGVCotizacion']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorCotizacion'] = round($fila['ValorCotizacion']/$fila_moneda['dcmCambio2'],2);
          }
        }
        $TotalCotizaciones += $fila['TotalCotizacion'];
      }
      if($intIdTipoMoneda == 1){
        $SimboloMoneda = "S/.";
      } else if($intIdTipoMoneda == 2){
        $SimboloMoneda = "US$";
      }
      echo $SimboloMoneda.' '.$TotalCotizaciones;
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarCotizaciones($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarCotizacion_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
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

  public function ListarCotizacionesVenta($busqueda,$x,$y,$dtmFechaInicial,$dtmFechaFinal)
  {
    try{
      if($busqueda != "" || $busqueda != null) {
        $sql_conexion = new Conexion_BD();
        $sql_conectar = $sql_conexion->Conectar();
        $sql_comando = $sql_conectar->prepare('CALL buscarCotizacion(:busqueda,:x,:y,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':dtmFechaInicial' => $dtmFechaInicial,
                      ':dtmFechaFinal' => $dtmFechaFinal));
        while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
        {
          echo '
          <tr>
            <td class="heading" data-th="ID"></td>
            <td>'.$fila["nvchSerie"].'-'.$fila["nvchNumeracion"].'</td>
            <td>'.$fila["NombreCliente"].'</td>
            <td>'.$fila["NombreUsuario"].'</td>
            <td>'.$fila["dtmFechaCreacion"].'</td>
            <td> 
              <button type="button" idct="'.$fila["intIdCotizacion"].'" class="btn btn-xs btn-warning" 
              onclick="InsertarCotizacion(this)">
                <i class="fa fa-edit"></i> Elegir
              </button>
              <button type="button" idct="'.$fila["intIdCotizacion"].'" class="btn btn-xs btn-default">
                <i class="fa fa-download"></i> Reporte
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

  public function InsertarCotizacionComprobante($intIdCotizacion,$intIdTipoMoneda,$num)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL InsertarCotizacionVenta(:intIdCotizacion)');
      $sql_comando -> execute(array(':intIdCotizacion' => $intIdCotizacion));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $dtmFechaCambio =  date('Y-m-d');
        $sql_conexion_moneda = new Conexion_BD();
        $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
        $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDACOMERCIALFECHA(:dtmFechaCambio)');
        $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
        $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);

        $sql_conexion_producto = new Conexion_BD();
        $sql_conectar_producto = $sql_conexion_producto->Conectar();
        $sql_comando_producto = $sql_conectar_producto->prepare('CALL MOSTRARPRODUCTO(:intIdProducto)');
        $sql_comando_producto -> execute(array(':intIdProducto' => $fila['intIdProducto']));
        $fila_producto = $sql_comando_producto -> fetch(PDO::FETCH_ASSOC);        

        if($intIdTipoMoneda == 1){
            if($fila_producto['intIdTipoMonedaVenta'] != 1) {
              $fila_producto['dcmPrecioVenta1'] = round($fila_producto['dcmPrecioVenta1']*$fila_moneda['dcmCambio2'],2); 
              $fila_producto['nvchSimbolo'] = "S/.";
            }
        } 
        else if($intIdTipoMoneda == 2){
            if($fila_producto['intIdTipoMonedaVenta'] != 2){
              $fila_producto['dcmPrecioVenta1'] = round($fila_producto['dcmPrecioVenta1']/$fila_moneda['dcmCambio2'],2);
              $fila_producto['nvchSimbolo'] = "US$";
            }
        }
        $dcmPrecioUnitario = number_format(($fila_producto['dcmPrecioVenta1'] - ($fila_producto['dcmPrecioVenta1']*($fila['dcmDescuento']/100))),2,'.','');
        $dcmTotal = number_format(($dcmPrecioUnitario * $fila['intCantidad']),2,'.','');
        echo '
        <tr>
        <td class="heading" data-th="ID"></td> '.
        '<td><input type="hidden" name="fila[]" value="'.$num.'" form="form-venta" />'.
            '<input type="hidden" id="intIdProducto'.$num.'" name="intIdProducto[]" form="form-venta" value="'.$fila_producto['intIdProducto'].'" />'.
            '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigo'.$num.'" name="nvchCodigo[]" form="form-venta" value="'.$fila_producto['nvchCodigo'].'" />'.
            '<div class="result" id="result'.$num.'">'.
        '</td>'.
        '<td><input type="text" style="width: 100% !important" id="nvchDescripcion'.$num.'" name="nvchDescripcion[]" form="form-venta" value="'.$fila_producto['nvchDescripcion'].'" readonly/></td>'.
        '<td>'.
          '<input type="text" id="dcmPrecio'.$num.'" name="dcmPrecio[]" form="form-venta" value="'.$fila_producto['dcmPrecioVenta1'].'" readonly />'.
          '<input type="hidden" id="dcmDescuentoVenta2'.$num.'" form="form-venta" value="'.$fila_producto['dcmDescuentoVenta2'].'" readonly />'.
          '<input type="hidden" id="dcmDescuentoVenta3'.$num.'" form="form-venta" value="'.$fila_producto['dcmDescuentoVenta3'].'" readonly />'.
        '</td>'.
        '<td><input type="text" style="max-width: 105px !important" id="dcmDescuento'.$num.'" name="dcmDescuento[]" form="form-venta" idsprt="'.$num.'"'.
          'onkeyup="CalcularPrecioTotal(this)" value="'.$fila['dcmDescuento'].'" /></td>'.
        '<td><input type="text" style="max-width: 105px !important" id="dcmPrecioUnitario'.$num.'" name="dcmPrecioUnitario[]" form="form-venta" value="'.$fila['dcmPrecioUnitario'].'" readonly/></td>'.
        '<td><input type="text" id="intCantidad'.$num.'" name="intCantidad[]" form="form-venta" idsprt="'.$num.'"'.
          'onkeyup="CalcularPrecioTotal(this)" value="'.$fila['intCantidad'].'"/></td>'.
        '<td><input type="text" id="dcmTotal'.$num.'" name="dcmTotal[]" form="form-venta" value="'.$fila['dcmTotal'].'" readonly/></td>'.
        '<td>'.
          '<button type="button" style="width: 25px !important" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit" data-toggle="tooltip" title="Eliminar!"></i></button>'.
        '</td>'.
      '</tr>';
      $num++;
      }
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }    
  }
  /* FIN - Métodos de Orden Compra */
}
?>