<?php 
require_once '../conexion/bd_conexion.php';
class DetalleCotizacion
{	
  /* INICIO - Atributos de Detalle Cotizacion*/
  private $intIdOperacionCotizacion;
  private $intIdCotizacion;
  private $intIdProducto;
  private $dtmFechaRealizada;
  private $intCantidad;
  private $dcmPrecio;
  
  public function IdOperacionCotizacion($intIdOperacionCotizacion){ $this->intIdOperacionCotizacion = $intIdOperacionCotizacion; }
  public function IdCotizacion($intIdCotizacion){ $this->intIdCotizacion = $intIdCotizacion; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function FechaRealizada($dtmFechaRealizada){ $this->dtmFechaRealizada = $dtmFechaRealizada; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function Precio($dcmPrecio){ $this->dcmPrecio = $dcmPrecio; }
  /* FIN - Atributos de Detalle Cotizacion */

  /* INICIO - Métodos de Detalle Cotizacion */
  public function InsertarDetalleCotizacion()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->intIdProducto as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarDetalleCotizacion(:intIdCotizacion,
      	:intIdProducto,:dtmFechaRealizada,:intCantidad,:dcmPrecio)');
      $sql_comando->execute(array(
        ':intIdCotizacion' => $this->intIdCotizacion, 
        ':intIdProducto' => $value,
        ':dtmFechaRealizada' => $this->dtmFechaRealizada,
        ':intCantidad' => $this->intCantidad[$key],
        ':dcmPrecio' => $this->dcmPrecio[$key]));
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
      	:intIdProducto,:dtmFechaRealizada,:intCantidad,:dcmPrecio)');
      $sql_comando->execute(array(
        ':intIdCotizacion' => $this->intIdCotizacion, 
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
        if($_SESSION['intIdOperacionCotizacion'] == $fila['intIdOperacionCotizacion'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
      	echo 
      	'<td><input type="hidden" name="intIdProducto[]" value="'.$fila['intIdProducto'].'"/>'.$fila['intIdProducto'].'</td>
        <td><input type="hidden" name="nvchNombre[]" value="'.$fila['nvchNombre'].'"/>'.$fila['nvchNombre'].'</td>
        <td><input type="hidden" name="nvchDescripcion[]" value="'.$fila['nvchDescripcion'].'"/>'.$fila['nvchDescripcion'].'</td>
        <td><input type="hidden" name="dcmPrecio[]" value="'.$fila['dcmPrecio'].'"/>'.$fila['dcmPrecio'].'</td>
        <td><input type="hidden" name="intCantidad[]" value="'.$fila['intCantidad'].'"/>'.$fila['intCantidad'].'</td>
        <td> 
          <button type="button" idov="'.$fila['intIdOperacionCotizacion'].'" class="btn btn-xs btn-warning" onclick="SeleccionarDetalleCotizacion(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" idov="'.$fila['intIdOperacionCotizacion'].'" class="btn btn-xs btn-danger" onclick="EliminarDetalleCotizacion(this)">
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
      $salida['nvchNombre'] = $fila['nvchNombre'];
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

  public function ListarProductoCotizacion($busqueda,$x,$y,$tipofuncion,$TipoBusqueda)
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
        <td><input type="hidden" name="SnvchNombre['.$fila['intIdProducto'].']" value="'.$fila['nvchNombre'].'"/>'.$fila['nvchNombre'].'</td>
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
         '<button type="button" idsprt="'.$fila['intIdProducto'].'" class="btn btn-xs btn-warning" onclick="AgregarDetalleCotizacion_II(this)">
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

  public function PaginarProductosCotizacion($busqueda,$x,$y,$TipoBusqueda)
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
  /* FIN - Métodos de Detalle Cotizacion */
}
?>