<?php
require_once '../conexion/bd_conexion.php';
class KardexProducto
{
  /* INICIO - Atributos de KardexProducto*/
  private $intIdMovimiento;
  private $intIdTipoMoneda;
  private $dtmFechaMovimiento;
  private $intTipoDetalle;
  private $intIdComprobante;
  private $intIdTipoComprobante;
  private $nvchSerie;
  private $nvchNumeracion;
  private $intIdProducto;
  private $intCantidadEntrada;
  private $intCantidadSalida;
  private $intCantidadStock;
  private $dcmPrecioEntrada;
  private $dcmTotalEntrada;
  private $dcmPrecioSalida;
  private $dcmTotalSalida;
  private $dcmSaldoValorizado;
  
  public function IdMovimiento($intIdMovimiento){ $this->intIdMovimiento = $intIdMovimiento; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function FechaMovimiento($dtmFechaMovimiento){ $this->dtmFechaMovimiento = $dtmFechaMovimiento; }
  public function TipoDetalle($intTipoDetalle){ $this->intTipoDetalle = $intTipoDetalle; }
  public function IdComprobante($intIdComprobante){ $this->intIdComprobante = $intIdComprobante; }
  public function IdTipoComprobante($intIdTipoComprobante){ $this->intIdTipoComprobante = $intIdTipoComprobante; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function CantidadEntrada($intCantidadEntrada){ $this->intCantidadEntrada = $intCantidadEntrada; }
  public function CantidadSalida($intCantidadSalida){ $this->intCantidadSalida = $intCantidadSalida; }
  public function CantidadStock($intCantidadStock){ $this->intCantidadStock = $intCantidadStock; }
  public function PrecioEntrada($dcmPrecioEntrada){ $this->dcmPrecioEntrada = $dcmPrecioEntrada; }
  public function TotalEntrada($dcmTotalEntrada){ $this->dcmTotalEntrada = $dcmTotalEntrada; }
  public function PrecioSalida($dcmPrecioSalida){ $this->dcmPrecioSalida = $dcmPrecioSalida; }
  public function TotalSalida($dcmTotalSalida){ $this->dcmTotalSalida = $dcmTotalSalida; }
  public function SaldoValorizado($dcmSaldoValorizado){ $this->dcmSaldoValorizado = $dcmSaldoValorizado; }
  /* FIN - Atributos de KardexProducto */

  /* INICIO - Métodos de KardexProducto */
  public function InsertarKardexProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();

      foreach ($this->intIdProducto as $key => $value) {
      if($value != ""){
        $sql_comando = $sql_conectar->prepare('CALL mostrarultimoKardexProducto(:intIdProducto)');
        $sql_comando -> execute(array(':intIdProducto' => $value));
        $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

        $intCantidadStock = $fila['intCantidadStock'];
        $dcmSaldoValorizado = $fila['dcmSaldoValorizado'];
        if($this->intTipoDetalle == 1){
          $intCantidadStock = $intCantidadStock - $this->intCantidadSalida[$key];
          $sql_comando = $sql_conectar->prepare('CALL PROMEDIOPRECIOSALIDA(:intIdProducto)');
          $sql_comando -> execute(array(':intIdProducto' => $value));
          $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
          $this->dcmPrecioSalida = $fila['PromedioSalida'];
          $this->dcmTotalSalida = $fila['PromedioSalida'] * $this->intCantidadSalida[$key];
          $dcmSaldoValorizado = $dcmSaldoValorizado - $this->dcmTotalSalida;
        } else if($this->intTipoDetalle == 2){
          $this->dcmPrecioEntrada[$key] = round(($this->dcmPrecioEntrada[$key] / 1.18),2);
          $this->dcmTotalEntrada[$key] = $this->intCantidadEntrada[$key] * $this->dcmPrecioEntrada[$key];
          $intCantidadStock = $intCantidadStock + $this->intCantidadEntrada[$key];
          $dcmSaldoValorizado = $dcmSaldoValorizado + $this->dcmTotalEntrada[$key];
        }

        $sql_comando = $sql_conectar->prepare('CALL insertarKardexProducto(@intIdMovimiento,:intIdTipoMoneda,:dtmFechaMovimiento,
          :intTipoDetalle,:intIdComprobante,:intIdTipoComprobante,:nvchSerie,:nvchNumeracion,:intIdProducto,
          :intCantidadEntrada,:intCantidadSalida,:intCantidadStock,:dcmPrecioEntrada,:dcmTotalEntrada,:dcmPrecioSalida,
          :dcmTotalSalida,:dcmSaldoValorizado)');
        $sql_comando->execute(array(
          ':intIdTipoMoneda' => $this->intIdTipoMoneda,
          ':dtmFechaMovimiento' => $this->dtmFechaMovimiento,
          ':intTipoDetalle' => $this->intTipoDetalle,
          ':intIdComprobante' => $this->intIdComprobante,
          ':intIdTipoComprobante' => $this->intIdTipoComprobante,
          ':nvchSerie' => $this->nvchSerie,
          ':nvchNumeracion' => $this->nvchNumeracion,
          ':intIdProducto' => $value,
          ':intCantidadEntrada' => $this->intCantidadEntrada[$key],
          ':intCantidadSalida' => $this->intCantidadSalida[$key],
          ':intCantidadStock' => $intCantidadStock,
          ':dcmPrecioEntrada' => $this->dcmPrecioEntrada[$key],
          ':dcmTotalEntrada' => $this->dcmTotalEntrada[$key],
          ':dcmPrecioSalida' => $this->dcmPrecioSalida,
          ':dcmTotalSalida' => $this->dcmTotalSalida,
          ':dcmSaldoValorizado' => $dcmSaldoValorizado));
        $sql_comando->closeCursor();
        $salidas = $sql_conectar->query("select @intIdMovimiento as intIdMovimiento");
        $salida = $salidas->fetchObject();
        $_SESSION['intIdMovimiento'] = $salida->intIdMovimiento;
      }
    }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarKardexProductoInicial()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();

      $sql_comando = $sql_conectar->prepare('CALL mostrarproducto(:intIdProducto)');
      $sql_comando -> execute(array(':intIdProducto' => $this->intIdProducto));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $dtmFechaMovimiento = $fila['dtmFechaIngreso'];
      $intIdTipoMoneda = $fila['intIdTipoMonedaCompra'];
      $intCantidadEntrada = $fila['intCantidad'];
      $intCantidadStock = $intCantidadEntrada;
      $dcmPrecioEntrada = round(($fila['dcmPrecioCompra'] / 1.18),2);
      $dcmTotalEntrada = $intCantidadEntrada * $dcmPrecioEntrada;
      $dcmSaldoValorizado = $dcmTotalEntrada;

      $sql_comando = $sql_conectar->prepare('CALL insertarKardexProducto(@intIdMovimiento,:intIdTipoMoneda,:dtmFechaMovimiento,
        :intTipoDetalle,:intIdComprobante,:intIdTipoComprobante,:nvchSerie,:nvchNumeracion,:intIdProducto,
        :intCantidadEntrada,:intCantidadSalida,:intCantidadStock,:dcmPrecioEntrada,:dcmTotalEntrada,:dcmPrecioSalida,
        :dcmTotalSalida,:dcmSaldoValorizado)');
      $sql_comando->execute(array(
        ':intIdTipoMoneda' => $intIdTipoMoneda,
        ':dtmFechaMovimiento' => $dtmFechaMovimiento,
        ':intTipoDetalle' => 2,
        ':intIdComprobante' => $this->intIdComprobante,
        ':intIdTipoComprobante' => $this->intIdTipoComprobante,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':intIdProducto' => $this->intIdProducto,
        ':intCantidadEntrada' => $intCantidadEntrada,
        ':intCantidadSalida' => $this->intCantidadSalida,
        ':intCantidadStock' => $intCantidadStock,
        ':dcmPrecioEntrada' => $dcmPrecioEntrada,
        ':dcmTotalEntrada' => $dcmTotalEntrada,
        ':dcmPrecioSalida' => $this->dcmPrecioSalida,
        ':dcmTotalSalida' => $this->dcmTotalSalida,
        ':dcmSaldoValorizado' => $dcmSaldoValorizado));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdMovimiento as intIdMovimiento");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdMovimiento'] = $salida->intIdMovimiento;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarKardexProducto($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarKardexProducto(:intIdMovimiento)');
      $sql_comando -> execute(array(':intIdMovimiento' => $this->intIdMovimiento));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioKardexProducto = new FormularioKardexProducto();
      $FormularioKardexProducto->IdMovimiento($fila['intIdMovimiento']);
      $FormularioKardexProducto->IdTipoMoneda($fila['intIdTipoMoneda']);
      $FormularioKardexProducto->Descripcion($fila['nvchDescripcion']);
      $FormularioKardexProducto->UnidadMedida($fila['nvchUnidadMedida']);
      $FormularioKardexProducto->Cantidad($fila['intCantidad']);
      $FormularioKardexProducto->CantidadMinima($fila['intCantidadMinima']);
      $FormularioKardexProducto->DireccionImg($fila['nvchDireccionImg']);
      $FormularioKardexProducto->PrecioVenta1($fila['dcmPrecioVenta1']);
      $FormularioKardexProducto->PrecioVenta2($fila['dcmPrecioVenta2']);
      $FormularioKardexProducto->PrecioVenta3($fila['dcmPrecioVenta3']);
      $FormularioKardexProducto->DescuentoVenta2($fila['dcmDescuentoVenta2']);
      $FormularioKardexProducto->DescuentoVenta3($fila['dcmDescuentoVenta3']);
      $FormularioKardexProducto->IdTipoMoneda($fila['intIdTipoMoneda']);
      $FormularioKardexProducto->FechaIngreso($fila['dtmFechaIngreso']);
      $FormularioKardexProducto->Observacion($fila['nvchObservacion']);
      $FormularioKardexProducto->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarKardexProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarKardexProducto(:intIdMovimiento,:intIdTipoMoneda,:nvchDescripcion,
        :nvchUnidadMedida,:intCantidad,:intCantidadMinima,:nvchDireccionImg,:dcmPrecioVenta1,:dcmPrecioVenta2,
        :dcmPrecioVenta3,:dcmDescuentoVenta2,:dcmDescuentoVenta3,:intIdTipoMoneda,:dtmFechaIngreso,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdMovimiento' => $this->intIdMovimiento,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':nvchUnidadMedida' => $this->nvchUnidadMedida,
        ':intCantidad' => 0,
        ':intCantidadMinima' => $this->intCantidadMinima,
        ':nvchDireccionImg' => $this->nvchDireccionImg,
        ':dcmPrecioVenta1' => $this->dcmPrecioVenta1,
        ':dcmPrecioVenta2' => $this->dcmPrecioVenta2,
        ':dcmPrecioVenta3' => $this->dcmPrecioVenta3,
        ':dcmDescuentoVenta2' => $this->dcmDescuentoVenta2,
        ':dcmDescuentoVenta3' => $this->dcmDescuentoVenta3,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':dtmFechaIngreso' => $this->dtmFechaIngreso,
        ':nvchObservacion' => $this->nvchObservacion));
      $_SESSION['intIdMovimiento'] = $this->intIdMovimiento;
      $_SESSION['RutaDefaultImg'] = "";
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarKardexProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarKardexProducto(:intIdMovimiento)');
      $sql_comando -> execute(array(':intIdMovimiento' => $this->intIdMovimiento));
      $_SESSION['intIdMovimiento'] = $this->intIdMovimiento;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarKardexProducto($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de KardexProducto por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL BUSCARKARDEXPRODUCTO_II(:busqueda,:intIdProducto,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdProducto' => $this->intIdProducto, 
          ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL BUSCARKARDEXPRODUCTO_II(:busqueda,:intIdProducto,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdProducto' => $this->intIdProducto, 
          ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de KardexProducto por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL BUSCARKARDEXPRODUCTO(:busqueda,:x,:y,:intIdProducto,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y, ':intIdProducto' => $this->intIdProducto, 
        ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
      $numpaginas = ceil($cantidad / $y);
      $j = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($fila['dcmPrecioEntrada'] == "" || $fila['dcmPrecioEntrada'] == null) { $fila['dcmPrecioEntrada'] = 0.00; }
        if($fila['dcmTotalEntrada'] == "" || $fila['dcmTotalEntrada'] == null) { $fila['dcmTotalEntrada'] = 0.00; }
        if($fila['dcmPrecioSalida'] == "" || $fila['dcmPrecioSalida'] == null) { $fila['dcmPrecioSalida'] = 0.00; }
        if($fila['dcmTotalSalida'] == "" || $fila['dcmPrecioSalida'] == null) { $fila['dcmPrecioSalida'] = 0.00; }
        if($fila['intCantidadEntrada'] == "" || $fila['intCantidadEntrada'] == null) { $fila['intCantidadEntrada'] = 0; }
        if($fila['intCantidadSalida'] == "" || $fila['intCantidadSalida'] == null) { $fila['intCantidadSalida'] = 0; }
        
        $nvchSimbolo = "";
        $dtmFechaCambio =  date('Y-m-d', strtotime($fila['dtmFechaMovimiento']));
        $sql_conexion_moneda = new Conexion_BD();
        $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
        $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDATRIBUTARIAFECHA(:dtmFechaCambio)');
        $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
        $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
        if($intIdTipoMoneda == 1){
          $nvchSimbolo = "S/.";
          if($fila['intIdTipoMoneda'] != 1) {
            $fila['dcmPrecioEntrada'] = number_format($fila['dcmPrecioEntrada']*$fila_moneda['dcmCambio2'],2,'.','');
            $fila['dcmTotalEntrada'] = number_format($fila['dcmTotalEntrada']*$fila_moneda['dcmCambio2'],2,'.',''); 
            $fila['dcmPrecioSalida'] = number_format($fila['dcmPrecioSalida']*$fila_moneda['dcmCambio2'],2,'.',''); 
            $fila['dcmTotalSalida'] = number_format($fila['dcmTotalSalida']*$fila_moneda['dcmCambio2'],2,'.','');
            $fila['dcmSaldoValorizado'] = number_format($fila['dcmSaldoValorizado']*$fila_moneda['dcmCambio2'],2,'.',''); 
          }
        } 
        else if ($intIdTipoMoneda == 2){
          $nvchSimbolo = "US$";
          if($fila['intIdTipoMoneda'] != 2){
            $fila['dcmPrecioEntrada'] = number_format($fila['dcmPrecioEntrada']/$fila_moneda['dcmCambio2'],2,'.','');
            $fila['dcmTotalEntrada'] = number_format($fila['dcmTotalEntrada']/$fila_moneda['dcmCambio2'],2,'.',''); 
            $fila['dcmPrecioSalida'] = number_format($fila['dcmPrecioSalida']/$fila_moneda['dcmCambio2'],2,'.',''); 
            $fila['dcmTotalSalida'] = number_format($fila['dcmTotalSalida']/$fila_moneda['dcmCambio2'],2,'.','');
            $fila['dcmSaldoValorizado'] = number_format($fila['dcmSaldoValorizado']/$fila_moneda['dcmCambio2'],2,'.','');
          }
        }

        echo 
        '<tr>
            <td class="heading" data-th="ID"></td>
            <td>'.$j.'</td>
            <td>'.$fila["dtmFechaMovimiento"].'</td>';
            if($fila["intTipoDetalle"] == 1){
              echo '<td>Salida</td>';
            } else if($fila["intTipoDetalle"] == 2){
              echo '<td>Entrada</td>';
            } else {
              echo '<td>Inicial</td>';
            }
            echo 
            '<td>'.$fila["NombreComprobante"].'</td>
            <td>'.$fila["nvchSerie"].'</td>
            <td>'.$fila["nvchNumeracion"].'</td>
            <td>'.$fila["intCantidadEntrada"].'</td>
            <td>'.$fila["intCantidadSalida"].'</td>
            <td>'.$fila["intCantidadStock"].'</td>
            <td>'.$nvchSimbolo.' '.$fila["dcmPrecioEntrada"].'</td>
            <td>'.$nvchSimbolo.' '.$fila["dcmTotalEntrada"].'</td>
            <td>'.$nvchSimbolo.' '.$fila["dcmPrecioSalida"].'</td>
            <td>'.$nvchSimbolo.' '.$fila["dcmTotalSalida"].'</td>
            <td>'.$nvchSimbolo.' '.$fila["dcmSaldoValorizado"].'</td>
            <td> 
              <button type="button" id="'.$fila["intIdMovimiento"].'" class="btn btn-xs btn-warning btn-mostrar-KardexProducto">
                <i class="fa fa-edit"></i> Ver Detalle
              </button>
            </td>  
        </tr>';
        $j++;
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarKardexProducto($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL BUSCARKARDEXPRODUCTO_ii(:busqueda,:intIdProducto,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdProducto' => $this->intIdProducto, 
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

  public function ListarProductos($busqueda,$x,$y,$tipolistado,$TipoBusqueda)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de producto por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda,:TipoBusqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':TipoBusqueda' => $TipoBusqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda,:TipoBusqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':TipoBusqueda' => $TipoBusqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de producto por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto(:busqueda,:x,:y,:TipoBusqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y, ':TipoBusqueda' => $TipoBusqueda));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($fila["nvchCodigo"]!=""){
          if($i == ($cantidad - $x) && $tipolistado == "N"){
            echo '<tr bgcolor="#BEE1EB">';
          } else if($fila["intIdProducto"] == $_SESSION['intIdProducto'] && $tipolistado == "E"){
            echo '<tr bgcolor="#B3E4C0">';
          }else {
            echo '<tr>';
          }
          echo 
          '
              <td class="heading" data-th="ID" width="25px"></td>
              <td>'.$fila["nvchCodigo"].'</td>
              <td>'.$fila["nvchDescripcion"].'</td>
              <td>'.$fila["nvchSimbolo"].'</td>
              <td>'.$fila["dcmPrecioVenta1"].'</td>
              <td>'.$fila["dcmPrecioVenta2"].'</td>
              <td>'.$fila["dcmPrecioVenta3"].'</td>
              <td>'.$fila["intCantidad"].'</td>
              <td>
                <button onclick="VerDetalleUbigeo(this);showmodaldetalles()" type="button" codigo="'.$fila["nvchCodigo"].'" id="'.$fila["intIdProducto"].'" class="btn btn-xs btn-success">
                  <i class="fa fa-edit"></i> Ver Detalle
                </button>
              </td>
              <td>
                <button onclick="VerImagenProducto(this)" type="button" imagen="'.$fila["nvchDireccionImg"].'" class="btn btn-xs btn-primary">
                  <i class="fa fa-search"></i> Ver 
                </button>
              </td>
              <td> 
                <button type="button" id="'.$fila["intIdProducto"].'" class="btn btn-xs btn-warning" onclick="VerKardexProducto(this)">
                  <i class="fa fa-edit"></i> Ver Kardex
                </button>
              </td>  
          </tr>';
          $i++;
        }
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarProductos($busqueda,$x,$y,$tipolistado,$TipoBusqueda)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda,:TipoBusqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':TipoBusqueda' => $TipoBusqueda));
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
  /* FIN - Métodos de KardexProducto */
}