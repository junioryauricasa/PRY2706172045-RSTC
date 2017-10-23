<?php
require_once '../conexion/bd_conexion.php';
require_once 'class_formulario_kardex.php';
class Kardex
{
  /* INICIO - Atributos de Kardex*/
  private $intIdMovimiento;
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
  /* FIN - Atributos de Kardex */

  /* INICIO - Métodos de Kardex */
  public function InsertarKardex()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();

      foreach ($this->intIdProducto as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL mostrarultimoKardex(:intIdProducto)');
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
        //$this->dcmTotalEntrada[$key] = round(($this->dcmTotalEntrada[$key] / 1.18),2);
        $intCantidadStock = $intCantidadStock + $this->intCantidadEntrada[$key];
        $dcmSaldoValorizado = $dcmSaldoValorizado + $this->dcmTotalEntrada[$key];
      }

      $sql_comando = $sql_conectar->prepare('CALL insertarKardex(@intIdMovimiento,:dtmFechaMovimiento,
        :intTipoDetalle,:intIdComprobante,:intIdTipoComprobante,:nvchSerie,:nvchNumeracion,:intIdProducto,
        :intCantidadEntrada,:intCantidadSalida,:intCantidadStock,:dcmPrecioEntrada,:dcmTotalEntrada,:dcmPrecioSalida,
        :dcmTotalSalida,:dcmSaldoValorizado)');
      $sql_comando->execute(array(
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
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarKardex($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarKardex(:intIdMovimiento)');
      $sql_comando -> execute(array(':intIdMovimiento' => $this->intIdMovimiento));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioKardex = new FormularioKardex();
      $FormularioKardex->IdKardex($fila['intIdMovimiento']);
      $FormularioKardex->Descripcion($fila['nvchDescripcion']);
      $FormularioKardex->UnidadMedida($fila['nvchUnidadMedida']);
      $FormularioKardex->Cantidad($fila['intCantidad']);
      $FormularioKardex->CantidadMinima($fila['intCantidadMinima']);
      $FormularioKardex->DireccionImg($fila['nvchDireccionImg']);
      $FormularioKardex->PrecioVenta1($fila['dcmPrecioVenta1']);
      $FormularioKardex->PrecioVenta2($fila['dcmPrecioVenta2']);
      $FormularioKardex->PrecioVenta3($fila['dcmPrecioVenta3']);
      $FormularioKardex->DescuentoVenta2($fila['dcmDescuentoVenta2']);
      $FormularioKardex->DescuentoVenta3($fila['dcmDescuentoVenta3']);
      $FormularioKardex->IdTipoMoneda($fila['intIdTipoMoneda']);
      $FormularioKardex->FechaIngreso($fila['dtmFechaIngreso']);
      $FormularioKardex->Observacion($fila['nvchObservacion']);
      $FormularioKardex->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarKardex()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarKardex(:intIdMovimiento,:nvchDescripcion,
        :nvchUnidadMedida,:intCantidad,:intCantidadMinima,:nvchDireccionImg,:dcmPrecioVenta1,:dcmPrecioVenta2,
        :dcmPrecioVenta3,:dcmDescuentoVenta2,:dcmDescuentoVenta3,:intIdTipoMoneda,:dtmFechaIngreso,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdMovimiento' => $this->intIdMovimiento,
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

  public function EliminarKardex()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarKardex(:intIdMovimiento)');
      $sql_comando -> execute(array(':intIdMovimiento' => $this->intIdMovimiento));
      $_SESSION['intIdMovimiento'] = $this->intIdMovimiento;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarKardex($busqueda,$x,$y,$tipolistado)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de Kardex por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarKardex_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarKardex_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Kardex por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarKardex(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      $j = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo 
        '<tr>
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
        <td>'.$fila["dcmPrecioEntrada"].'</td>
        <td>'.$fila["dcmTotalEntrada"].'</td>
        <td>'.$fila["dcmPrecioSalida"].'</td>
        <td>'.$fila["dcmTotalSalida"].'</td>
        <td>'.$fila["dcmSaldoValorizado"].'</td>
        <td> 
          <button type="button" id="'.$fila["intIdMovimiento"].'" class="btn btn-xs btn-warning btn-mostrar-kardex">
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

  public function PaginarKardex($busqueda,$x,$y,$tipolistado)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarKardex_ii(:busqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda));
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
  /* FIN - Métodos de Kardex */
}