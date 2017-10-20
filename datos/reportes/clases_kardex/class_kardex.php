<?php
require_once '../conexion/bd_conexion.php';
require_once 'class_formulario_kardex.php';
class Kardex
{
  /* INICIO - Atributos de Kardex*/
  private $intIdMovimiento;
  private $dtmFechaMovimiento;
  private $intIdComprobante;
  private $intIdTipoComprobante;
  private $intTipoDetalle;
  private $nvchSerie;
  private $nvchNumeracion;
  private $intIdProducto;
  private $intCantidadEntrada;
  private $dcmPrecioUnitarioEntrada;
  private $dcmTotalEntrada;
  private $intCantidadSalida;
  private $dcmPrecioUnitarioSalida;
  private $dcmTotalSalida;
  private $intCantidadExistencia;
  private $dcmPrecioUnitarioExistencia;
  private $dcmTotalExistencia;
  
  public function IdMovimiento($intIdMovimiento){ $this->intIdMovimiento = $intIdMovimiento; }
  public function FechaMovimiento($dtmFechaMovimiento){ $this->dtmFechaMovimiento = $dtmFechaMovimiento; }
  public function IdComprobante($intIdComprobante){ $this->intIdComprobante = $intIdComprobante; }
  public function IdTipoComprobante($intIdTipoComprobante){ $this->intIdTipoComprobante = $intIdTipoComprobante; }
  public function TipoDetalle($intTipoDetalle){ $this->intTipoDetalle = $intTipoDetalle; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function CantidadEntrada($intCantidadEntrada){ $this->intCantidadEntrada = $intCantidadEntrada; }
  public function PrecioUnitarioEntrada($dcmPrecioUnitarioEntrada){ $this->dcmPrecioUnitarioEntrada = $dcmPrecioUnitarioEntrada; }
  public function TotalEntrada($dcmTotalEntrada){ $this->dcmTotalEntrada = $dcmTotalEntrada; }
  public function CantidadSalida($intCantidadSalida){ $this->intCantidadSalida = $intCantidadSalida; }
  public function PrecioUnitarioSalida($dcmPrecioUnitarioSalida){ $this->dcmPrecioUnitarioSalida = $dcmPrecioUnitarioSalida; }
  public function TotalSalida($dcmTotalSalida){ $this->dcmTotalSalida = $dcmTotalSalida; }
  public function CantidadExistencia($intCantidadExistencia){ $this->intCantidadExistencia = $intCantidadExistencia; }
  public function PrecioUnitarioExistencia($dcmPrecioUnitarioExistencia){ $this->dcmPrecioUnitarioExistencia = $dcmPrecioUnitarioExistencia; }
  public function TotalExistencia($dcmTotalExistencia){ $this->dcmTotalExistencia = $dcmTotalExistencia; }
  /* FIN - Atributos de Kardex */

  /* INICIO - Métodos de Kardex */
  public function InsertarKardex()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();

      $sql_comando = $sql_conectar->prepare('CALL mostrarultimoKardex()');
      $sql_comando -> execute();
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $intCantidadExistencia = $fila['intCantidadExistencia'];
      $dcmPrecioUnitarioExistencia = $fila['dcmPrecioUnitarioExistencia'];
      $dcmTotalExistencia = $fila['dcmTotalExistencia'];

      

      if($this->intTipoDetalle == 1){
        $intCantidadExistencia = $intCantidadExistencia - $this->intCantidadSalida;
        $dcmPrecioUnitarioExistencia = $dcmPrecioUnitarioExistencia + $this->dcmPrecioUnitarioSalida;
        $dcmTotalExistencia = $dcmTotalExistencia + $this->dcmTotalSalida;
      } else if($this->intTipoDetalle == 2){
        $intCantidadExistencia = $intCantidadExistencia + $this->intCantidadEntrada;
        $dcmPrecioUnitarioExistencia = $dcmPrecioUnitarioExistencia - $this->dcmPrecioUnitarioEntrada;
        $dcmTotalExistencia = $dcmTotalExistencia - $this->dcmTotalEntrada;
      }

      $sql_comando = $sql_conectar->prepare('CALL insertarKardex(@intIdMovimiento,:dtmFechaMovimiento,
        :intIdComprobante,:intIdTipoComprobante,:intTipoDetalle,:nvchSerie,:nvchNumeracion,:intIdProducto,
        :intCantidadEntrada,:dcmPrecioUnitarioEntrada,:dcmTotalEntrada,:intCantidadSalida,:dcmPrecioUnitarioSalida,
        :dcmTotalSalida,:intCantidadExistencia,:dcmPrecioUnitarioExistencia,:dcmTotalExistencia)');
      $sql_comando->execute(array(
        ':dtmFechaMovimiento' => $this->dtmFechaMovimiento,
        ':intIdComprobante' => $this->intIdComprobante,
        ':intIdTipoComprobante' => $this->intIdTipoComprobante,
        ':intTipoDetalle' => $this->intTipoDetalle,
        ':nvchSerie' => $this->nvchSerie,
        ':nvchNumeracion' => $this->nvchNumeracion,
        ':intIdProducto' => $this->intIdProducto,
        ':intCantidadEntrada' => $this->intCantidadEntrada,
        ':dcmPrecioUnitarioEntrada' => $this->dcmPrecioUnitarioEntrada,
        ':dcmTotalEntrada' => $this->dcmTotalEntrada,
        ':intCantidadSalida' => $this->intCantidadSalida,
        ':dcmPrecioUnitarioSalida' => $this->dcmPrecioUnitarioSalida,
        ':dcmTotalSalida' => $this->dcmTotalSalida,
        ':intCantidadExistencia' => $intCantidadExistencia,
        ':dcmPrecioUnitarioExistencia' => $dcmPrecioUnitarioExistencia,
        ':dcmTotalExistencia' => $dcmTotalExistencia));
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
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo 
        '<tr>
        <td>'.$fila["intIdMovimiento"].'</td>
        <td>'.$fila["dtmFechaMovimiento"].'</td>
        <td>'.$fila["NombreComprobante"].'</td>';
        if($fila["intTipoDetalle"] == 1){
          echo '<td>Salida</td>';
        } else if($fila["intTipoDetalle"] == 2){
          echo '<td>Entrada</td>';
        } else {
          echo '<td>Inicial</td>';
        }
        echo 
        '<td>'.$fila["nvchSerie"].'</td>
        <td>'.$fila["nvchNumeracion"].'</td>
        <td>'.$fila["intCantidadEntrada"].'</td>
        <td>'.$fila["dcmPrecioUnitarioEntrada"].'</td>
        <td>'.$fila["dcmTotalEntrada"].'</td>
        <td>'.$fila["intCantidadSalida"].'</td>
        <td>'.$fila["dcmPrecioUnitarioSalida"].'</td>
        <td>'.$fila["dcmTotalSalida"].'</td>
        <td>'.$fila["intCantidadExistencia"].'</td>
        <td>'.$fila["dcmPrecioUnitarioExistencia"].'</td>
        <td>'.$fila["dcmTotalExistencia"].'</td>
        <td> 
          <button type="button" id="'.$fila["intIdMovimiento"].'" class="btn btn-xs btn-warning btn-mostrar-kardex">
            <i class="fa fa-edit"></i> Ver Detalle
          </button>
        </td>  
        </tr>';
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

  public function AumentarStockTotal($intIdMovimiento)
  {
    try{
      $intCantidad = 0;
      $sql_conexion_cantidad = new Conexion_BD();
      $sql_conectar_cantidad = $sql_conexion_cantidad->Conectar();
      $sql_comando_cantidad = $sql_conectar_cantidad->prepare('CALL CANTIDADTOTALKardex(:intIdMovimiento)');
      $sql_comando_cantidad -> execute(array(':intIdMovimiento' => $intIdMovimiento));
      $fila_cantidad = $sql_comando_cantidad -> fetch(PDO::FETCH_ASSOC);
      if($fila_cantidad["CantidadTotal"] == "" || $fila_cantidad["CantidadTotal"] == NULL){
        $intCantidad = 0;
      } else {
        $intCantidad = $fila_cantidad["CantidadTotal"];
      }

      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ES_STOCKTOTAL(:intIdMovimiento,:intCantidad)');
      $sql_comando -> execute(array(
        ':intIdMovimiento' => $intIdMovimiento,
        ':intCantidad' => $intCantidad));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ES_StockUbigeo($intIdMovimiento,$intIdSucursal,$intCantidad,$TipoES)
  {
    try{
      $sql_conexion_cantidad = new Conexion_BD();
      $sql_conectar_cantidad = $sql_conexion_cantidad->Conectar();
      foreach ($intIdMovimiento as $key => $value) {
        $sql_comando = $sql_conectar_cantidad->prepare('CALL seleccionarUbigeoKardex_II(:intIdMovimiento,:intIdSucursal)');
        $sql_comando -> execute(array(
          ':intIdMovimiento' => $value,
          ':intIdSucursal' => $intIdSucursal));
        $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
        $intCantidadFinal = 0;
        $intIdUbigeoKardex = $fila['intIdUbigeoKardex'];
        $intCantidadInicial = $fila['intCantidadUbigeo'];
        if($TipoES == 1){
          $intCantidadFinal = $intCantidadInicial + $intCantidad[$key];
        } else if($TipoES == 0){
          $intCantidadFinal = $intCantidadInicial - $intCantidad[$key];
        }

        $sql_comando = $sql_conectar_cantidad->prepare('CALL ES_STOCKUBIGEO(:intIdUbigeoKardex,:intCantidadUbigeo)');
        $sql_comando -> execute(array(':intIdUbigeoKardex' => $intIdUbigeoKardex, ':intCantidadUbigeo' => $intCantidadFinal));
      }
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ES_StockTotal($intIdMovimiento)
  {
  try{
      $intCantidad = 0;
      $sql_conexion_cantidad = new Conexion_BD();
      $sql_conectar_cantidad = $sql_conexion_cantidad->Conectar();
      foreach ($intIdMovimiento as $key => $value) {
      $sql_comando_cantidad = $sql_conectar_cantidad->prepare('CALL CANTIDADTOTALKardex(:intIdMovimiento)');
      $sql_comando_cantidad -> execute(array(':intIdMovimiento' => $value));
      $fila_cantidad = $sql_comando_cantidad -> fetch(PDO::FETCH_ASSOC);
      if($fila_cantidad["CantidadTotal"] == "" || $fila_cantidad["CantidadTotal"] == NULL){
        $intCantidad = 0;
      } else {
        $intCantidad = $fila_cantidad["CantidadTotal"];
      }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ES_STOCKTOTAL(:intIdMovimiento,:intCantidad)');
      $sql_comando -> execute(array(
        ':intIdMovimiento' => $value,
        ':intCantidad' => $intCantidad));
      }
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Kardex */
}