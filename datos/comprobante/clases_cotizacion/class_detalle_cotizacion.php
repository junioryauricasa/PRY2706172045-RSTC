<?php 
require_once '../conexion/bd_conexion.php';
class DetalleCotizacion
{	
  /* INICIO - Atributos de Detalle Cotizacion*/
  private $intIdOperacionCotizacion;
  private $intIdCotizacion;
  private $intIdTipoVenta;
  private $dtmFechaRealizada;
  private $intIdProducto;
  private $nvchCodigo;
  private $nvchDescripcion;
  private $dcmPrecio;
  private $dcmDescuento;
  private $dcmPrecioUnitario;
  private $intCantidad;
  private $dcmTotal;
  
  
  public function IdOperacionCotizacion($intIdOperacionCotizacion){ $this->intIdOperacionCotizacion = $intIdOperacionCotizacion; }
  public function IdCotizacion($intIdCotizacion){ $this->intIdCotizacion = $intIdCotizacion; }
  public function IdTipoVenta($intIdTipoVenta){ $this->intIdTipoVenta = $intIdTipoVenta; }
  public function FechaRealizada($dtmFechaRealizada){ $this->dtmFechaRealizada = $dtmFechaRealizada; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function Codigo($nvchCodigo){ $this->nvchCodigo = $nvchCodigo; }
  public function Descripcion($nvchDescripcion){ $this->nvchDescripcion = $nvchDescripcion; }
  public function Precio($dcmPrecio){ $this->dcmPrecio = $dcmPrecio; }
  public function Descuento($dcmDescuento){ $this->dcmDescuento = $dcmDescuento; }
  public function PrecioUnitario($dcmPrecioUnitario){ $this->dcmPrecioUnitario = $dcmPrecioUnitario; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function Total($dcmTotal){ $this->dcmTotal = $dcmTotal; }
  /* FIN - Atributos de Detalle Cotizacion */

  /* INICIO - Métodos de Detalle Cotizacion */
  public function InsertarDetalleCotizacion()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->intCantidad as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarDetalleCotizacion(:intIdCotizacion,:intIdTipoVenta,
      	:dtmFechaRealizada,:intIdProducto,:nvchCodigo,:nvchDescripcion,:dcmPrecio,:dcmDescuento,:dcmPrecioUnitario,
        :intCantidad,:dcmTotal)');
        if($this->intIdTipoVenta == 1){
          $sql_comando->execute(array(
          ':intIdCotizacion' => $this->intIdCotizacion,
          ':intIdTipoVenta' => $this->intIdTipoVenta,
          ':dtmFechaRealizada' => $this->dtmFechaRealizada,
          ':intIdProducto' => $this->intIdProducto[$key],
          ':nvchCodigo' => $this->nvchCodigo[$key],
          ':nvchDescripcion' => $this->nvchDescripcion[$key],
          ':dcmPrecio' => $this->dcmPrecio[$key],
          ':dcmDescuento' => $this->dcmDescuento[$key],
          ':dcmPrecioUnitario' => $this->dcmPrecioUnitario[$key],
          ':intCantidad' => $value,
          ':dcmTotal' => $this->dcmTotal[$key]));
        } else if($this->intIdTipoVenta == 2){
          $sql_comando->execute(array(
          ':intIdCotizacion' => $this->intIdCotizacion,
          ':intIdTipoVenta' => $this->intIdTipoVenta,
          ':dtmFechaRealizada' => $this->dtmFechaRealizada,
          ':intIdProducto' => 0,
          ':nvchCodigo' => '',
          ':nvchDescripcion' => $this->nvchDescripcion[$key],
          ':dcmPrecio' => 0.00,
          ':dcmDescuento' => 0.00,
          ':dcmPrecioUnitario' => $this->dcmPrecioUnitario[$key],
          ':intCantidad' => $value,
          ':dcmTotal' => $this->dcmTotal[$key]));
        }
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarDetalleCotizacion_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarDetalleCotizacion(:intIdCotizacion,
        :intIdProducto,:dtmFechaRealizada,:intCantidad,:dcmPrecio,:dcmDescuento,:dcmPrecioUnitario,
        :dcmTotal)');
      $sql_comando->execute(array(
        ':intIdCotizacion' => $this->intIdCotizacion, 
        ':intIdProducto' => $this->intIdProducto,
        ':dtmFechaRealizada' => $this->dtmFechaRealizada,
        ':intCantidad' => $this->intCantidad,
        ':dcmPrecio' => $this->dcmPrecio,
        ':dcmDescuento' => $this->dcmDescuento,
        ':dcmPrecioUnitario' => $this->dcmPrecioUnitario,
        ':dcmTotal' => $this->dcmTotal));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarDetalleCotizacion($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleCotizacion(:intIdCotizacion)');
      $sql_comando -> execute(array(':intIdCotizacion' => $this->intIdCotizacion));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($fila['intIdTipoVenta'] == 1){
          echo
        	'<tr>
            <td class="heading" data-th="ID">'.$i.'</td> '.
            '<td><input type="hidden" name="fila[]" value="'.$i.'" form="form-venta" />'.
                '<input type="hidden" id="intIdProducto'.$i.'" name="intIdProducto[]" form="form-venta" value="'.$fila['intIdProducto'].'" />'.
                '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigo'.$i.'" name="nvchCodigo[]" form="form-venta" value="'.$fila['nvchCodigo'].'" readonly/>'.
                '<div class="result" id="result'.$i.'">'.
            '</td>'.
            '<td><input type="text" style="width: 100% !important" id="nvchDescripcion'.$i.'" name="nvchDescripcion[]" form="form-venta" value="'.$fila['nvchDescripcion'].'" readonly/></td>'.
            '<td>'.
              '<input type="text" id="dcmPrecio'.$i.'" name="dcmPrecio[]" form="form-venta" value="'.$fila['dcmPrecio'].'" readonly />'.
            '</td>'.
            '<td><input type="text" style="max-width: 105px !important" id="dcmDescuento'.$i.'" name="dcmDescuento[]" form="form-venta" idsprt="'.$i.'"'.
              'onkeyup="CalcularPrecioTotal(this)" value="'.$fila['dcmDescuento'].'" readonly/></td>'.
            '<td><input type="text" style="max-width: 105px !important" id="dcmPrecioUnitario'.$i.'" name="dcmPrecioUnitario[]" form="form-venta" value="'.$fila['dcmPrecioUnitario'].'" readonly/></td>'.
            '<td><input type="text" id="intCantidad'.$i.'" name="intCantidad[]" form="form-venta" idsprt="'.$i.'"'.
              'onkeyup="CalcularPrecioTotal(this)" value="'.$fila['intCantidad'].'" readonly/></td>'.
            '<td><input type="text" id="dcmTotal'.$i.'" name="dcmTotal[]" form="form-venta" value="'.$fila['dcmTotal'].'" readonly/></td>'.
          '</tr>';
          $i++;
        } else if($fila['intIdTipoVenta'] == 2){
          echo
          '<tr>
            <td class="heading" data-th="ID">'.$i.'</td>
            <td>'.$i.'</td>
            <td>'.$fila['intCantidad'].'</td>
            <td>'.$fila['nvchDescripcionServicio'].'</td>
            <td>'.$fila['dcmPrecioUnitario'].'</td>
            <td>'.$fila['dcmTotal'].'</td>
          </tr>';
          $i++;
        }
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function SeleccionarDetalleCotizacion()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarDetalleCotizacion(:intIdOperacionCotizacion)');
      $sql_comando -> execute(array(':intIdOperacionCotizacion' => $this->intIdOperacionCotizacion));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdOperacionCotizacion'] = $fila['intIdOperacionCotizacion'];
      $salida['intIdCotizacion'] = $fila['intIdCotizacion'];
      $salida['intIdProducto'] = $fila['intIdProducto'];
      $salida['nvchDescripcion'] = $fila['nvchDescripcion'];
      $salida['dtmFechaRealizada'] = $fila['dtmFechaRealizada'];
      $salida['intCantidad'] = $fila['intCantidad'];
      $salida['dcmPrecio'] = $fila['dcmPrecio'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarDetalleCotizacion()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarDetalleCotizacion(:intIdOperacionCotizacion,
        :intIdCotizacion,:intIdProducto,:dtmFechaRealizada,:intCantidad,:dcmPrecio)');
      $sql_comando->execute(array(
        ':intIdOperacionCotizacion' => $this->intIdOperacionCotizacion,
        ':intIdCotizacion' => $this->intIdCotizacion, 
        ':intIdProducto' => $this->intIdProducto, 
        ':dtmFechaRealizada' => $this->dtmFechaRealizada,
        ':intCantidad' => $this->intCantidad,
        ':dcmPrecio' => $this->dcmPrecio));
      $_SESSION['intIdOperacionCotizacion'] = $this->intIdOperacionCotizacion;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarDetalleCotizacion()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarDetalleCotizacion(:intIdOperacionCotizacion)');
      $sql_comando -> execute(array(':intIdOperacionCotizacion' => $this->intIdOperacionCotizacion));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarProductoCotizacion($busqueda,$x,$y,$tipofuncion,$TipoBusqueda,$intIdTipoMoneda)
  {
  	try{
      if($busqueda != "" || $busqueda != null) {
      $i=1;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto(:busqueda,:x,:y,:TipoBusqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':TipoBusqueda' => $TipoBusqueda));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $dtmFechaCambio =  date("Y-m-d");
        $sql_conexion_moneda = new Conexion_BD();
        $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
        $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDACOMERCIALFECHA(:dtmFechaCambio)');
        $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
        $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
        if($intIdTipoMoneda == 1){
          if($fila['intIdTipoMonedaVenta'] != 1) {
            $fila['dcmPrecioVenta1'] = round($fila['dcmPrecioVenta1']*$fila_moneda['dcmCambio2'],2); 
            $fila['nvchSimbolo'] = "S/.";
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMonedaVenta'] != 2){
            $fila['dcmPrecioVenta1'] = round($fila['dcmPrecioVenta1']/$fila_moneda['dcmCambio2'],2);
            $fila['nvchSimbolo'] = "US$";
          }
        }
      	echo 
      	'
        <tr>
        <td class="heading" data-th="ID"></td>
        <td><input type="hidden" name="SnvchCodigo['.$fila['intIdProducto'].']" value="'.$fila['nvchCodigo'].'"/>'.$fila['nvchCodigo'].'</td>
        <td><input type="hidden" name="SnvchDescripcion['.$fila['intIdProducto'].']" value="'.$fila['nvchDescripcion'].'"/>'.$fila['nvchDescripcion'].'</td>
        <td><input type="hidden" name="SnvchSimbolo['.$fila['intIdProducto'].']" value="'.$fila['nvchSimbolo'].'"/>'.$fila['nvchSimbolo'].'</td>
        <td><input type="hidden" name="SdcmPrecioVenta1['.$fila['intIdProducto'].']" value="'.$fila['dcmPrecioVenta1'].'"/>
        <input type="hidden" name="SdcmDescuentoVenta2['.$fila['intIdProducto'].']" value="'.$fila['dcmDescuentoVenta2'].'"/>
        <input type="hidden" name="SdcmDescuentoVenta3['.$fila['intIdProducto'].']" value="'.$fila['dcmDescuentoVenta3'].'"/>'.$fila['dcmPrecioVenta1'].'</td>';
          $sql_conexion_cantidad = new Conexion_BD();
          $sql_conectar_cantidad = $sql_conexion_cantidad->Conectar();
          $sql_comando_cantidad = $sql_conectar_cantidad->prepare('CALL CANTIDADTOTALPRODUCTO(:intIdProducto)');
          $sql_comando_cantidad -> execute(array(':intIdProducto' => $fila['intIdProducto']));
          $fila_cantidad = $sql_comando_cantidad -> fetch(PDO::FETCH_ASSOC);
          if($fila_cantidad["CantidadTotal"] == "" || $fila_cantidad["CantidadTotal"] == NULL){
            echo '<td>0</td>';
          } else {
            echo '<td><input type="hidden" name="SCantidadTotal['.$fila['intIdProducto'].']" value="'.$fila_cantidad["CantidadTotal"].'"/>'.$fila_cantidad["CantidadTotal"].'</td>';
          }
        echo 
        '<td>
          <button onclick="VerDetalleUbigeo(this)" type="button" codigo="'.$fila["nvchCodigo"].'" id="'.$fila["intIdProducto"].'" class="btn btn-xs btn-success">
            <i class="fa fa-edit"></i> Ver Detalle
          </button>
        </td>
        <td>
          <button onclick="VerImagenProducto(this)" type="button" imagen="'.$fila["nvchDireccionImg"].'" class="btn btn-xs btn-primary">
            <i class="fa fa-search"></i> Ver 
          </button>
        </td>
        <td><input type="text" idsprt="'.$fila['intIdProducto'].'" onkeypress="return EsDecimalTecla(event)" onkeyup="CalcularPrecioTotal(this)" name="SdcmDescuento['.$fila['intIdProducto'].']" class="form-control select2" placeholder="Ingrese Porcentaje"></td>
        <td><input type="text" name="SdcmPrecioLista['.$fila['intIdProducto'].']" value="0.00" class="form-control select2" readonly/></td>
        <td><input type="text" idsprt="'.$fila['intIdProducto'].'" onkeypress="return EsNumeroEnteroTecla(event)" onkeyup="CalcularPrecioTotal(this)" name="SintCantidad['.$fila['intIdProducto'].']"  class="form-control select2" placeholder="Ingrese Cantidad"></td>
        <td><input type="text" name="SdcmTotal['.$fila['intIdProducto'].']" value="0.00" class="form-control select2" readonly/></td>
        <td>';
        if($tipofuncion == "F") {
        echo 
         '<button type="button" idsprt="'.$fila['intIdProducto'].'" class="btn btn-xs btn-warning" onclick="SeleccionarProducto(this)">
            <i class="fa fa-edit"></i> Elegir
          </button>';
        } else if ($tipofuncion == "M") {
        echo 
         '<button type="button" idsprt="'.$fila['intIdProducto'].'" class="btn btn-xs btn-warning" onclick="AgregarDetalleCotizacion_II(this)">
            <i class="fa fa-edit"></i> Agregar
          </button>';
        }
        echo 
        '</td>
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

  public function PaginarProductosCotizacion($busqueda,$x,$y,$TipoBusqueda)
  {
    try{
      if($busqueda != "" || $busqueda != null){
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda,:TipoBusqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda, ':TipoBusqueda' => $TipoBusqueda));
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
                <a idprt="'.($x-1).'" class="page-link" aria-label="Previous" onclick="PaginacionProductos(this)">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

          if($x==$i){
            $output.=  '<li class="page-item active"><a idprt="'.$i.'" class="page-link" onclick="PaginacionProductos(this)">'.($i+1).'</a></li>';
          }
          else
          {
            $output.=  '<li class="page-item"><a idprt="'.$i.'" class="page-link" onclick="PaginacionProductos(this)">'.($i+1).'</a></li>';
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
                <a idprt="'.($x+1).'" class="page-link" aria-label="Next" onclick="PaginacionProductos(this)">
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
  /* FIN - Métodos de Detalle Cotizacion */
}
?>