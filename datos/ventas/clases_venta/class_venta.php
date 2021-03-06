<?php 
require_once '../conexion/bd_conexion.php';
require_once 'clases_venta/class_formulario_venta.php';
class Venta{
  /* INICIO - Atributos de Orden Compra*/
  private $intIdVenta;
  private $intIdTipoComprobante;
  private $intIdSucursal;
  private $nvchSerie;
  private $nvchNumeracion;
  private $intIdUsuario;
  private $intIdCliente;
  private $dtmFechaCreacion;
  private $intIdTipoMoneda;
  private $intIdTipoPago;
  private $bitEstado;
  private $intIdTipoVenta;
  private $nvchObservacion;
  
  public function IdVenta($intIdVenta){ $this->intIdVenta = $intIdVenta; }
  public function IdTipoComprobante($intIdTipoComprobante){ $this->intIdTipoComprobante = $intIdTipoComprobante; }
  public function IdSucursal($intIdSucursal){ $this->intIdSucursal = $intIdSucursal; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function IdTipoPago($intIdTipoPago){ $this->intIdTipoPago = $intIdTipoPago; }
  public function Estado($bitEstado){ $this->bitEstado = $bitEstado; }
  public function IdTipoVenta($intIdTipoVenta){ $this->intIdTipoVenta = $intIdTipoVenta; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
  /* FIN - Atributos de Orden Compra */

  /* INICIO - Métodos de Orden Compra */
  public function InsertarVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarVenta(@intIdVenta,:intIdTipoComprobante,:intIdSucursal,
        :nvchSerie,:nvchNumeracion,:intIdUsuario,:intIdCliente,:dtmFechaCreacion,:intIdTipoMoneda,:intIdTipoPago,
        :bitEstado,:intIdTipoVenta,
        :nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdTipoComprobante' => $this->intIdTipoComprobante,
        ':intIdSucursal' => $this->intIdSucursal,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdCliente' => $this->intIdCliente,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':intIdTipoPago' => $this->intIdTipoPago,
        ':bitEstado' => 1,
        ':intIdTipoVenta' => $this->intIdTipoVenta,
        ':nvchObservacion' => $this->nvchObservacion));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdVenta as intIdVenta");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdVenta'] = $salida->intIdVenta;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarVenta($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarVenta(:intIdVenta)');
      $sql_comando -> execute(array(':intIdVenta' => $this->intIdVenta));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioVenta = new FormularioVenta();
      $FormularioVenta->IdVenta($fila['intIdVenta']);
      $FormularioVenta->IdTipoComprobante($fila['intIdTipoComprobante']);
      $FormularioVenta->Serie($fila['nvchSerie']);
      $FormularioVenta->Numeracion($fila['nvchNumeracion']);
      $FormularioVenta->IdUsuario($fila['intIdUsuario']);
      $FormularioVenta->IdCliente($fila['intIdCliente']);
      $FormularioVenta->FechaCreacion($fila['dtmFechaCreacion']);
      $FormularioVenta->IdTipoMoneda($fila['intIdTipoMoneda']);
      $FormularioVenta->IdTipoPago($fila['intIdTipoPago']);
      $FormularioVenta->Estado($fila['bitEstado']);
      $FormularioVenta->IdTipoVenta($fila['intIdTipoVenta']);

      $FormularioVenta->NombreUsuario($fila['NombreUsuario']);
      $FormularioVenta->NombreCliente($fila['NombreCliente']);
      $FormularioVenta->DNICliente($fila['DNICliente']);
      $FormularioVenta->RUCCliente($fila['RUCCliente']);
      $FormularioVenta->SimboloMoneda($fila['SimboloMoneda']);
      $FormularioVenta->NombrePago($fila['NombrePago']);
      $FormularioVenta->NombreVenta($fila['NombreVenta']);

      $FormularioVenta->Observacion($fila['nvchObservacion']);
      $FormularioVenta->MostrarDetalle();
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ListarClienteVenta($busqueda,$x,$y,$intIdTipoPersona)
  {
    try{
      if($busqueda != "" || $busqueda != null) {
        $sql_conexion = new Conexion_BD();
        $sql_conectar = $sql_conexion->Conectar();
        $sql_comando = $sql_conectar->prepare('CALL BUSCARCLIENTE(:busqueda,:x,:y,:intIdTipoPersona)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':intIdTipoPersona' => $intIdTipoPersona));
        while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
        {
          echo '
          <tr>
            <td class="heading" data-th="ID"></td>
          ';
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
            <button type="button" idscli="'.$fila['intIdCliente'].'" class="btn btn-xs btn-success" onclick="SeleccionarCliente(this)">
              <i class="fa fa-edit"></i> Seleccionar
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

  public function SeleccionarClienteVenta()
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
      $salida['intIdTipoCliente'] = $fila['intIdTipoCliente'];
      $salida['TipoCliente'] = $fila['TipoCliente'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ActualizarVenta(:intIdVenta,:nvchNumFactura,
        :nvchNumBoletaVenta,:intIdUsuario,:intIdCliente,:dtmFechaCreacion,:intIdTipoComprobante)');
      $sql_comando->execute(array(
        ':intIdVenta' => $this->intIdVenta,
        ':nvchNumFactura' => $this->nvchNumFactura,
        ':nvchNumBoletaVenta' => $this->nvchNumBoletaVenta,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdCliente' => $this->intIdCliente,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':intIdTipoComprobante' => $this->intIdTipoComprobante));
      $_SESSION['intIdVenta'] = $this->intIdVenta;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL EliminarVenta(:intIdVenta)');
      $sql_comando -> execute(array(':intIdVenta' => $this->intIdVenta));
      $_SESSION['intIdVenta'] = $this->intIdVenta;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarVentas($busqueda,$x,$y,$tipolistado,$intIdTipoComprobante,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
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
        $sql_comando = $sql_conectar->prepare('CALL buscarVenta_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,
          ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarVenta_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,
          ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Cliente por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarVenta(:busqueda,:x,:y,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
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
            $fila['TotalVenta'] = round($fila['TotalVenta']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVVenta'] = round($fila['IGVVenta']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorVenta'] = round($fila['ValorVenta']*$fila_moneda['dcmCambio2'],2); 
            $fila['SimboloMoneda'] = "S/.";
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalVenta'] = round($fila['TotalVenta']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVVenta'] = round($fila['IGVVenta']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorVenta'] = round($fila['ValorVenta']/$fila_moneda['dcmCambio2'],2);
            $fila['SimboloMoneda'] = "US$";
          }
        }

        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdVenta"] == $_SESSION['intIdVenta'] && $tipolistado == "E"){
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
        <td>'.$fila["SimboloMoneda"].' '.$fila["ValorVenta"].'</td>
        <td>'.$fila["SimboloMoneda"].' '.$fila["IGVVenta"].'</td>
        <td>'.$fila["SimboloMoneda"].' '.$fila["TotalVenta"].'</td>
        <td> 
          <button type="submit" id="'.$fila["intIdVenta"].'" class="btn btn-xs btn-warning btn-mostrar-venta">
            <i class="fa fa-edit"></i> Ver Detalle
          </button>
          <button type="submit" id="'.$fila["intIdVenta"].'" class="btn btn-xs btn-danger btn-anular-venta">
            <i class="fa fa-trash"></i> Anular
          </button>
          <button type="submit" id="'.$fila["intIdVenta"].'" class="btn btn-xs btn-default btn-download-report">
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

  public function TotalVentas($busqueda,$intIdTipoComprobante,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
  {
    try{
      $TotalVentas = 0.00;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarVenta_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
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
            $fila['TotalVenta'] = round($fila['TotalVenta']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVVenta'] = round($fila['IGVVenta']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorVenta'] = round($fila['ValorVenta']*$fila_moneda['dcmCambio2'],2); 
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalVenta'] = round($fila['TotalVenta']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVVenta'] = round($fila['IGVVenta']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorVenta'] = round($fila['ValorVenta']/$fila_moneda['dcmCambio2'],2);
          }
        }
        $TotalVentas += $fila['TotalVenta'];
      }
      if($intIdTipoMoneda == 1){
        $SimboloMoneda = "S/.";
      } else if($intIdTipoMoneda == 2){
        $SimboloMoneda = "US$";
      }
      echo $SimboloMoneda.' '.$TotalVentas;
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarVentas($busqueda,$x,$y,$tipolistado,$intIdTipoComprobante,$dtmFechaInicial,$dtmFechaFinal)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarVenta_ii(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal)');
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

  public function PaginarClientesVenta($busqueda,$x,$y,$intIdTipoPersona)
  {
    try{
        if($busqueda != "" || $busqueda != null) {
        $sql_conexion = new Conexion_BD();
        $sql_conectar = $sql_conexion->Conectar();
        $sql_comando = $sql_conectar->prepare('CALL BUSCARCLIENTE_II(:busqueda,:intIdTipoPersona)');
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
      }
      else {
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