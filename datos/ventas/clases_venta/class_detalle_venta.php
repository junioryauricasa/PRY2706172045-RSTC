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
  private $intCantidadPendiente;
  private $dcmPrecio;
  
  public function IdOperacionVenta($intIdOperacionVenta){ $this->intIdOperacionVenta = $intIdOperacionVenta; }
  public function IdVenta($intIdVenta){ $this->intIdVenta = $intIdVenta; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function FechaRealizada($dtmFechaRealizada){ $this->dtmFechaRealizada = $dtmFechaRealizada; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function CantidadPendiente($intCantidadPendiente){ $this->intCantidadPendiente = $intCantidadPendiente; }
  public function Precio($dcmPrecio){ $this->dcmPrecio = $dcmPrecio; }
  /* FIN - Atributos de Detalle Orden Compra */

  /* INICIO - Métodos de Detalle Orden Compra */
  public function InsertarDetalleVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->intIdProducto as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarDetalleVenta(:intIdVenta,
      	:intIdProducto,:dtmFechaRealizada,:intCantidad,:intCantidadPendiente,:dcmPrecio)');
      $sql_comando->execute(array(
        ':intIdVenta' => $this->intIdVenta, 
        ':intIdProducto' => $value,
        ':dtmFechaRealizada' => $this->dtmFechaRealizada,
        ':intCantidad' => $this->intCantidad[$key],
        ':intCantidadPendiente' => $this->intCantidad[$key],
        ':dcmPrecio' => $this->dcmPrecio[$key]));
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
      	:intIdProducto,:dtmFechaRealizada,:intCantidad,:intCantidadPendiente,:dcmPrecio)');
      $sql_comando->execute(array(
        ':intIdVenta' => $this->intIdVenta, 
        ':intIdProducto' => $this->intIdProducto,
        ':dtmFechaRealizada' => $this->dtmFechaRealizada,
        ':intCantidad' => $this->intCantidad,
        ':intCantidadPendiente' => $this->intCantidad,
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
        if($_SESSION['intIdOperacionVenta'] == $fila['intIdOperacionVenta'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
      	echo 
      	'<td><input type="hidden" name="intIdProducto[]" value="'.$fila['intIdProducto'].'"/>'.$fila['intIdProducto'].'</td>
        <td><input type="hidden" name="nvchDescripcion[]" value="'.$fila['nvchDescripcion'].'"/>'.$fila['nvchDescripcion'].'</td>
        <td><input type="hidden" name="dcmPrecio[]" value="'.$fila['dcmPrecio'].'"/>'.$fila['dcmPrecio'].'</td>
        <td><input type="hidden" name="intCantidad[]" value="'.$fila['intCantidad'].'"/>'.$fila['intCantidad'].'</td>
        <td> 
          <button type="button" idov="'.$fila['intIdOperacionVenta'].'" class="btn btn-xs btn-warning" onclick="SeleccionarDetalleVenta(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" idov="'.$fila['intIdOperacionVenta'].'" class="btn btn-xs btn-danger" onclick="EliminarDetalleVenta(this)">
            <i class="fa fa-edit"></i> Eliminar
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

  public function ListarProductoVenta($busqueda,$x,$y,$tipofuncion,$TipoBusqueda)
  {
  	try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto(:busqueda,:x,:y,:TipoBusqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':TipoBusqueda' => $TipoBusqueda));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
      	echo 
      	'<tr>
        <td><input type="hidden" name="SnvchCodigo['.$fila['intIdProducto'].']" value="'.$fila['nvchCodigo'].'"/>'.$fila['nvchCodigo'].'</td>
        <td><input type="hidden" name="SnvchDescripcion['.$fila['intIdProducto'].']" value="'.$fila['nvchDescripcion'].'"/>'.$fila['nvchDescripcion'].'</td>
        <td><input type="hidden" name="SdcmPrecioVenta1['.$fila['intIdProducto'].']" value="'.$fila['dcmPrecioVenta1'].'"/>'.$fila['dcmPrecioVenta1'].'</td>
        <td><input type="hidden" name="SdcmPrecioVenta2['.$fila['intIdProducto'].']" value="'.$fila['dcmPrecioVenta2'].'"/>'.$fila['dcmPrecioVenta2'].'</td>
        <td><input type="hidden" name="SdcmPrecioVenta3['.$fila['intIdProducto'].']" value="'.$fila['dcmPrecioVenta3'].'"/>'.$fila['dcmPrecioVenta3'].'</td>
        <td><input type="text" name="SdcmPrecio['.$fila['intIdProducto'].']" class="form-control select2" placeholder="Ingrese Precio"></td>
        <td><input type="text" name="SintCantidad['.$fila['intIdProducto'].']" class="form-control select2" placeholder="Ingrese Cantidad"></td>
        <td>';
        if($tipofuncion == "F") {
        echo 
         '<button type="button" idsprt="'.$fila['intIdProducto'].'" class="btn btn-xs btn-warning" onclick="SeleccionarProducto(this)">
            <i class="fa fa-edit"></i> Seleccionar
          </button>';
        } else if ($tipofuncion == "M") {
        echo 
         '<button type="button" idsprt="'.$fila['intIdProducto'].'" class="btn btn-xs btn-warning" onclick="AgregarDetalleVenta_II(this)">
            <i class="fa fa-edit"></i> Agregar
          </button>';
        }
        echo 
        '</td>
        </tr>';
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function PaginarProductosVenta($busqueda,$x,$y,$TipoBusqueda)
  {
    try{
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
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function InsertarCotizacion($nvchNumeracionCotizacion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL InsertarCotizacionVenta(:nvchNumeracion)');
      $sql_comando -> execute(array(':nvchNumeracion' => $nvchNumeracionCotizacion));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo '<tr> 
        <td><input type="hidden" name="intIdProducto[]" value="'.$fila['intIdProducto'].'"/>'.$fila['intIdProducto'].'</td>
        <td>'.$fila['nvchDescripcion'].'</td>
        <td><input type="hidden" name="dcmPrecio[]" value="'.$fila['dcmPrecio'].'"/>'.$fila['dcmPrecio'].'</td>
        <td><input type="hidden" name="intCantidad[]" value="'.$fila['intCantidad'].'"/>'.$fila['intCantidad'].'</td>
        <td><button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Eliminar</button></td>
        </tr>';
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }
  /* FIN - Métodos de Detalle Orden Compra */
}
?>