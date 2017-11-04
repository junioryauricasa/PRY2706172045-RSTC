<?php 
require_once '../conexion/bd_conexion.php';
require_once '../numeraciones/class_numeraciones.php';
require_once 'clases_cotizacion/class_formulario_cotizacion.php';
class Cotizacion{
  /* INICIO - Atributos de Orden Compra*/
  private $intIdCotizacion;
  private $nvchSerie;
  private $nvchNumeracion;
  private $intIdUsuario;
  private $intIdCliente;
  private $nvchAtencion;
  private $intIdTipoMoneda;
  private $intIdTipoPago;
  private $intDiasValidez;
  private $intIdTipoVenta;
  private $nvchTipo;
  private $nvchModelo;
  private $nvchMarca;
  private $nvchHorometro;
  private $dtmFechaCreacion;
  private $bitEstado;
  private $nvchObservacion;
  
  public function IdCotizacion($intIdCotizacion){ $this->intIdCotizacion = $intIdCotizacion; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function Atencion($nvchAtencion){ $this->nvchAtencion = $nvchAtencion; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function IdTipoPago($intIdTipoPago){ $this->intIdTipoPago = $intIdTipoPago; }
  public function DiasValidez($intDiasValidez){ $this->intDiasValidez = $intDiasValidez; }
  public function IdTipoVenta($intIdTipoVenta){ $this->intIdTipoVenta = $intIdTipoVenta; }
  public function Tipo($nvchTipo){ $this->nvchTipo = $nvchTipo; }
  public function Modelo($nvchModelo){ $this->nvchModelo = $nvchModelo; }
  public function Marca($nvchMarca){ $this->nvchMarca = $nvchMarca; }
  public function Horometro($nvchHorometro){ $this->nvchHorometro = $nvchHorometro; }
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
      $sql_comando = $sql_conectar->prepare('CALL insertarCotizacion(@intIdCotizacion,:nvchSerie,:nvchNumeracion,
        :intIdUsuario,:intIdCliente,:nvchAtencion,:intIdTipoMoneda,:intIdTipoPago,:intDiasValidez,:intIdTipoVenta,
        :nvchTipo,:nvchModelo,:nvchMarca,:nvchHorometro,:dtmFechaCreacion,:bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':nvchSerie' => '0001',
        ':nvchNumeracion' => '',
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
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
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

  public function ListarClienteCotizacion($busqueda,$x,$y,$intIdTipoPersona)
  {
    try{
      if($busqueda != "" || $busqueda != null){
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL BUSCARCLIENTE(:busqueda,:x,:y,:intIdTipoPersona)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':intIdTipoPersona' => $intIdTipoPersona));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo '<tr>';
        if($intIdTipoPersona == 2) { 
          echo '<td>'.$fila["nvchDNI"].'</td>'; 
        }
        echo '<td>'.$fila["nvchRUC"].'</td>';
        if($intIdTipoPersona == 1) { 
          echo '<td>'.$fila["nvchRazonSocial"].'</td>'; 
        }
        if($intIdTipoPersona == 2) {
        echo '<td>'.$fila["nvchApellidoPaterno"].'</td>
        <td>'.$fila["nvchApellidoMaterno"].'</td>
        <td>'.$fila["nvchNombres"].'</td>';
        }
        echo 
        '<td>'.$fila["TipoCliente"].'</td>
        <td> 
          <button type="button" idscli="'.$fila['intIdCliente'].'" class="btn btn-xs btn-warning" onclick="SeleccionarCliente(this)">
            <i class="fa fa-edit"></i> Seleccionar
          </button>
        </td>
        </tr>';
        }
        } else {
          echo "";
        }
      } catch(PDPExceptio $e){
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
      $salida['TipoCliente'] = $fila['TipoCliente'];
      $salida['intIdTipoCliente'] = $fila['intIdTipoCliente'];
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
        :intIdUsuario,:intIdCliente,:nvchAtencion,:intIdTipoMoneda,:intIdTipoPago,:intDiasValidez,
        :dtmFechaCreacion,:bitEstado,:nvchObservacion)');
      $sql_comando->execute(array(
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdCliente' => $this->intIdCliente,
        ':nvchAtencion' => $this->nvchAtencion,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':intIdTipoPago' => $this->intIdTipoPago,
        ':intDiasValidez' => $this->intDiasValidez,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
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
        echo
        '<td>'.$fila["nvchSerie"].'-'.$fila["nvchNumeracion"].'</td>
        <td>'.$fila["NombreCliente"].'</td>
        <td>'.$fila["NombreUsuario"].'</td>
        <td>'.$fila["dtmFechaCreacion"].'</td>
        <td>'.$fila["SimboloMoneda"].' '.$fila["ValorCotizacion"].'</td>
        <td>'.$fila["SimboloMoneda"].' '.$fila["IGVCotizacion"].'</td>
        <td>'.$fila["SimboloMoneda"].' '.$fila["TotalCotizacion"].'</td>
        <td> 
          <button type="button" id="'.$fila["intIdCotizacion"].'" class="btn btn-xs btn-warning btn-mostrar-cotizacion">
            <i class="fa fa-edit"></i> Ver Detalle
          </button>
          <button type="button" id="'.$fila["intIdCotizacion"].'" class="btn btn-xs btn-danger btn-anular-cotizacion">
            <i class="fa fa-trash"></i> Anular
          </button>
          <button type="button" id="'.$fila["intIdCotizacion"].'" class="btn btn-xs btn-default btn-reporte-cotizacion">
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

  public function PaginarClientesCotizacion($busqueda,$x,$y,$intIdTipoPersona)
  {
    try{
      if($busqueda != "" || $busqueda != null){
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarcliente_ii(:busqueda,:intIdTipoPersona)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':intIdTipoPersona' => $intIdTipoPersona));
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
      } else {
        $output = ""; 
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
          echo $output;
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }
  /* FIN - Métodos de Orden Compra */
}
?>