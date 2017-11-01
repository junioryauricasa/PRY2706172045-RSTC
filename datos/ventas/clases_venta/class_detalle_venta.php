<?php 
require_once '../conexion/bd_conexion.php';
class DetalleVenta
{	
  /* INICIO - Atributos de Detalle Orden Compra*/
  private $intIdOperacionVenta;
  private $intIdVenta;
  private $intIdProducto;
  private $dtmFechaRealizada;
  private $intCantidad;
  private $dcmPrecio;
  private $dcmDescuento;
  private $dcmPrecioUnitario;
  private $dcmTotal;
  private $intIdTipoVenta;
  private $nvchDescripcionServicio;
  
  public function IdOperacionVenta($intIdOperacionVenta){ $this->intIdOperacionVenta = $intIdOperacionVenta; }
  public function IdVenta($intIdVenta){ $this->intIdVenta = $intIdVenta; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function FechaRealizada($dtmFechaRealizada){ $this->dtmFechaRealizada = $dtmFechaRealizada; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function Precio($dcmPrecio){ $this->dcmPrecio = $dcmPrecio; }
  public function Descuento($dcmDescuento){ $this->dcmDescuento = $dcmDescuento; }
  public function PrecioUnitario($dcmPrecioUnitario){ $this->dcmPrecioUnitario = $dcmPrecioUnitario; }
  public function Total($dcmTotal){ $this->dcmTotal = $dcmTotal; }
  public function IdTipoVenta($intIdTipoVenta){ $this->intIdTipoVenta = $intIdTipoVenta; }
  public function DescripcionServicio($nvchDescripcionServicio){ $this->nvchDescripcionServicio = $nvchDescripcionServicio; }
  /* FIN - Atributos de Detalle Orden Compra */

  /* INICIO - Métodos de Detalle Orden Compra */
  public function InsertarDetalleVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->intCantidad as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarDetalleVenta(:intIdVenta,
      	:intIdProducto,:dtmFechaRealizada,:intCantidad,:dcmPrecio,:dcmDescuento,:dcmPrecioUnitario,
        :dcmTotal,:intIdTipoVenta,:nvchDescripcionServicio)');
      if($this->intIdTipoVenta == 1){
          $sql_comando->execute(array(
          ':intIdVenta' => $this->intIdVenta, 
          ':intIdProducto' => $this->intIdProducto[$key],
          ':dtmFechaRealizada' => $this->dtmFechaRealizada,
          ':intCantidad' => $value,
          ':dcmPrecio' => $this->dcmPrecio[$key],
          ':dcmDescuento' => $this->dcmDescuento[$key],
          ':dcmPrecioUnitario' => $this->dcmPrecioUnitario[$key],
          ':dcmTotal' => $this->dcmTotal[$key],
          ':intIdTipoVenta' => $this->intIdTipoVenta,
          ':nvchDescripcionServicio' => ''));
        } else if($this->intIdTipoVenta == 2){
          $sql_comando->execute(array(
          ':intIdVenta' => $this->intIdVenta,
          ':intIdProducto' => 1,
          ':dtmFechaRealizada' => $this->dtmFechaRealizada,
          ':intCantidad' => $value,
          ':dcmPrecio' => 0.00,
          ':dcmDescuento' => 0.00,
          ':dcmPrecioUnitario' => $this->dcmPrecioUnitario[$key],
          ':dcmTotal' => $this->dcmTotal[$key],
          ':intIdTipoVenta' => $this->intIdTipoVenta,
          ':nvchDescripcionServicio' => $this->nvchDescripcionServicio[$key]));
        }
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarDetalleVenta_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarDetalleVenta(:intIdVenta,
      	:intIdProducto,:dtmFechaRealizada,:intCantidad,:dcmPrecio)');
      $sql_comando->execute(array(
        ':intIdVenta' => $this->intIdVenta, 
        ':intIdProducto' => $this->intIdProducto,
        ':dtmFechaRealizada' => $this->dtmFechaRealizada,
        ':intCantidad' => $this->intCantidad,
        ':dcmPrecio' => $this->dcmPrecio));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarDetalleVenta($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleVenta(:intIdVenta)');
      $sql_comando -> execute(array(':intIdVenta' => $this->intIdVenta));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($fila['intIdTipoVenta'] == 1){
          echo
          '<tr>
          <td>'.$i.'</td>
          <td>'.$fila['CodigoProducto'].'</td>
          <td>'.$fila['DescripcionProducto'].'</td>
          <td>'.$fila['intCantidad'].'</td>
          <td>'.$fila['nvchSimbolo'].' '.$fila['dcmPrecioUnitario'].'</td>
          <td>'.$fila['nvchSimbolo'].' '.$fila['dcmTotal'].'</td>
          </tr>';
          $i++;
        } else if($fila['intIdTipoVenta'] == 2){
          echo
          '<tr>
          <td>'.$i.'</td>
          <td>C'.$i.'</td>
          <td>'.$fila['nvchDescripcionServicio'].'</td>
          <td>'.$fila['intCantidad'].'</td>
          <td>'.$fila['nvchSimbolo'].' '.$fila['dcmPrecioUnitario'].'</td>
          <td>'.$fila['nvchSimbolo'].' '.$fila['dcmTotal'].'</td>
          </tr>';
          $i++;
        }
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function SeleccionarDetalleVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarDetalleVenta(:intIdOperacionVenta)');
      $sql_comando -> execute(array(':intIdOperacionVenta' => $this->intIdOperacionVenta));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdOperacionVenta'] = $fila['intIdOperacionVenta'];
      $salida['intIdVenta'] = $fila['intIdVenta'];
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

  public function ActualizarDetalleVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarDetalleVenta(:intIdOperacionVenta,
        :intIdVenta,:intIdProducto,:dtmFechaRealizada,:intCantidad,:dcmPrecio)');
      $sql_comando->execute(array(
        ':intIdOperacionVenta' => $this->intIdOperacionVenta,
        ':intIdVenta' => $this->intIdVenta, 
        ':intIdProducto' => $this->intIdProducto, 
        ':dtmFechaRealizada' => $this->dtmFechaRealizada,
        ':intCantidad' => $this->intCantidad,
        ':dcmPrecio' => $this->dcmPrecio));
      $_SESSION['intIdOperacionVenta'] = $this->intIdOperacionVenta;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarDetalleVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarDetalleVenta(:intIdOperacionVenta)');
      $sql_comando -> execute(array(':intIdOperacionVenta' => $this->intIdOperacionVenta));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarProductoVenta($busqueda,$x,$y,$TipoBusqueda,$intIdSucursal,$intIdTipoMoneda)
  {
  	try{
      if($busqueda != "" || $busqueda != null) {
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
          '<tr>
          <td><input type="hidden" name="SnvchCodigo['.$fila['intIdProducto'].']" value="'.$fila['nvchCodigo'].'"/>'.$fila['nvchCodigo'].'</td>
          <td><input type="hidden" name="SnvchDescripcion['.$fila['intIdProducto'].']" value="'.$fila['nvchDescripcion'].'"/>'.$fila['nvchDescripcion'].'</td>
          <td><input type="hidden" name="SnvchSimbolo['.$fila['intIdProducto'].']" value="'.$fila['nvchSimbolo'].'"/>'.$fila['nvchSimbolo'].'</td>
          <td><input type="hidden" name="SdcmPrecioVenta1['.$fila['intIdProducto'].']" value="'.$fila['dcmPrecioVenta1'].'"/>
          <input type="hidden" name="SdcmDescuentoVenta2['.$fila['intIdProducto'].']" value="'.$fila['dcmDescuentoVenta2'].'"/><input type="hidden" name="SdcmPrecioVenta2['.$fila['intIdProducto'].']" value="'.$fila['dcmPrecioVenta2'].'"/>
          <input type="hidden" name="SdcmDescuentoVenta3['.$fila['intIdProducto'].']" value="'.$fila['dcmDescuentoVenta3'].'"/><input type="hidden" name="SdcmPrecioVenta3['.$fila['intIdProducto'].']" value="'.$fila['dcmPrecioVenta3'].'"/>'.$fila['dcmPrecioVenta1'].'</td>
          <td><input type="hidden" name="SCantidadTotal['.$fila['intIdProducto'].']" value="'.$fila['intCantidad'].'"/>'.$fila['intCantidad'].'</td>';
          $sql_conexion_cantidad = new Conexion_BD();
          $sql_conectar_cantidad = $sql_conexion_cantidad->Conectar();
          $sql_comando_cantidad = $sql_conectar_cantidad->prepare('CALL CANTIDADUBIGEOPRODUCTO(:intIdProducto,:intIdSucursal)');
          $sql_comando_cantidad -> execute(array(':intIdProducto' => $fila['intIdProducto'], 'intIdSucursal' => $intIdSucursal));
          $fila_cantidad = $sql_comando_cantidad -> fetch(PDO::FETCH_ASSOC);
          if($fila_cantidad["CantidadUbigeo"] == "" || $fila_cantidad["CantidadUbigeo"] == NULL){
            echo '<td>0</td>';
          } else {
            echo '<td><input type="hidden" name="SCantidadUbigeo['.$fila['intIdProducto'].']" value="'.$fila_cantidad["CantidadUbigeo"].'"/>'.$fila_cantidad["CantidadUbigeo"].'</td>';
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
          <td>
          <button type="button" idsprt="'.$fila['intIdProducto'].'" class="btn btn-xs btn-warning" onclick="SeleccionarProducto(this)">
              <i class="fa fa-edit"></i> Elegir
          </button>'; 
          '</td>
          </tr>';
        }
      } else {
        echo "";
      }
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function PaginarProductosVenta($busqueda,$x,$y,$TipoBusqueda)
  {
    try{
      if($busqueda != "" || $busqueda != null) {
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
              $output.=  '<li class="page-item active"><a idprt="'.$i.'" class="page-link pa-producto" onclick="PaginacionProductos(this)">'.($i+1).'</a></li>';
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

  public function ListarCotizacionesVenta($busqueda,$x,$y)
  {
    try{
      if($busqueda != "" || $busqueda != null) {
        $sql_conexion = new Conexion_BD();
        $sql_conectar = $sql_conexion->Conectar();
        $sql_comando = $sql_conectar->prepare('CALL buscarCotizacion(:busqueda,:x,:y)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
        while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
        {
          echo '<tr>
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

  public function PaginarCotizacionesVenta($busqueda,$x,$y)
  {
    try{
        if($busqueda != "" || $busqueda != null) {
        $sql_conexion = new Conexion_BD();
        $sql_conectar = $sql_conexion->Conectar();
        $sql_comando = $sql_conectar->prepare('CALL buscarCotizacion_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
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
                  <a idct="'.($x-1).'" class="page-link" aria-label="Previous" onclick="PaginacionCotizaciones(this)">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Anterior</span>
                  </a>
              </li>';
            }
          }

            if($x==$i){
              $output.=  '<li class="page-item active"><a idct="'.$i.'" class="page-link" onclick="PaginacionCotizaciones(this)">'.($i+1).'</a></li>';
            }
            else
            {
              $output.=  '<li class="page-item"><a idct="'.$i.'" class="page-link" onclick="PaginacionCotizaciones(this)">'.($i+1).'</a></li>';
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
                  <a idct="'.($x+1).'" class="page-link" aria-label="Next" onclick="PaginacionCotizaciones(this)">
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

  public function InsertarCotizacion($intIdCotizacion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL InsertarCotizacionVenta(:intIdCotizacion)');
      $sql_comando -> execute(array(':intIdCotizacion' => $intIdCotizacion));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo '<tr> 
        <td><input type="hidden" name="intIdProducto[]" value="'.$fila['intIdProducto'].'"/>'.$fila['nvchCodigo'].'</td>
        <td>'.$fila['nvchDescripcion'].'</td>
        <td><input type="hidden" name="intCantidad[]" value="'.$fila['intCantidad'].'"/><input type="hidden" name="intCantidad[]" value="'.$fila['intCantidadD'].'"/>'.$fila['intCantidad'].'</td>
        <td><input type="hidden" name="dcmPrecio[]" value="'.$fila['dcmPrecio'].'"/><input type="hidden" name="dcmDescuento[]" value="'.$fila['dcmDescuento'].'"/><input type="hidden" name="dcmPrecioUnitario[]" value="'.$fila['dcmPrecioUnitario'].'"/>'.$fila['dcmPrecioUnitario'].'</td>
        <td><input type="hidden" name="dcmTotal[]" value="'.$fila['dcmTotal'].'"/>'.$fila['dcmTotal'].'</td>
        <td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>
        </tr>';
      }
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }    
  }

  public function Salida_StockUbigeo($intIdProducto,$intIdSucursal,$intCantidad)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL InsertarCotizacionVenta(:intIdCotizacion)');
      $sql_comando -> execute(array(':intIdCotizacion' => $intIdCotizacion));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo '<tr> 
        <td><input type="hidden" name="intIdProducto[]" value="'.$fila['intIdProducto'].'"/>'.$fila['nvchCodigo'].'</td>
        <td>'.$fila['nvchDescripcion'].'</td>
        <td><input type="hidden" name="intCantidad[]" value="'.$fila['intCantidad'].'"/>'.$fila['intCantidad'].'</td>
        <td><input type="hidden" name="dcmPrecio[]" value="'.$fila['dcmPrecio'].'"/><input type="hidden" name="dcmDescuento[]" value="'.$fila['dcmDescuento'].'"/><input type="hidden" name="dcmPrecioUnitario[]" value="'.$fila['dcmPrecioUnitario'].'"/>'.$fila['dcmPrecioUnitario'].'</td>
        <td><input type="hidden" name="dcmTotal[]" value="'.$fila['dcmTotal'].'"/>'.$fila['dcmTotal'].'</td>
        <td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>
        </tr>';
      }
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }    
  }
  /* FIN - Métodos de Detalle Orden Compra */
}
?>