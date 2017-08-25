<?php 
require_once '../conexion/bd_conexion.php';
class DetalleOrdenCompra
{	
  /* INICIO - Atributos de Detalle Orden Compra*/
  private $intIdOperacionOrdenCompra;
  private $intIdOrdenCompra;
  private $intIdProducto;
  private $dtmFechaSolicitud;
  private $intCantidad;
  private $intCantidadPendiente;
  private $dcmPrecio;
  
  public function IdOperacionOrdenCompra($intIdOperacionOrdenCompra){ $this->intIdOperacionOrdenCompra = $intIdOperacionOrdenCompra; }
  public function IdOrdenCompra($intIdOrdenCompra){ $this->intIdOrdenCompra = $intIdOrdenCompra; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function FechaSolicitud($dtmFechaSolicitud){ $this->dtmFechaSolicitud = $dtmFechaSolicitud; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function CantidadPendiente($intCantidadPendiente){ $this->intCantidadPendiente = $intCantidadPendiente; }
  public function Precio($dcmPrecio){ $this->dcmPrecio = $dcmPrecio; }
  /* FIN - Atributos de Detalle Orden Compra */

  /* INICIO - Métodos de Detalle Orden Compra */
  public function InsertarDetalleOrdenCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->intIdProducto as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarDetalleOrdenCompra(:intIdOrdenCompra,
      	:intIdProducto,:dtmFechaSolicitud,:intCantidad,:intCantidadPendiente,:dcmPrecio)');
      $sql_comando->execute(array(
        ':intIdOrdenCompra' => $this->intIdOrdenCompra, 
        ':intIdProducto' => $value,
        ':dtmFechaSolicitud' => $this->dtmFechaSolicitud,
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

  public function InsertarDetalleOrdenCompra_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarDetalleOrdenCompra(:intIdOrdenCompra,
      	:intIdProducto,:dtmFechaSolicitud,:intCantidad,:intCantidadPendiente,:dcmPrecio)');
      $sql_comando->execute(array(
        ':intIdOrdenCompra' => $this->intIdOrdenCompra, 
        ':intIdProducto' => $this->intIdProducto,
        ':dtmFechaSolicitud' => $this->dtmFechaSolicitud,
        ':intCantidad' => $this->intCantidad,
        ':intCantidadPendiente' => $this->intCantidad,
        ':dcmPrecio' => $this->dcmPrecio));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarDetalleOrdenCompra($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleOrdenCompra(:intIdOrdenCompra)');
      $sql_comando -> execute(array(':intIdOrdenCompra' => $this->intIdOrdenCompra));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdOperacionOrdenCompra'] == $fila['intIdOperacionOrdenCompra'] && $tipolistado == "A"){
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
          <button type="button" idooc="'.$fila['intIdOperacionOrdenCompra'].'" class="btn btn-xs btn-warning" onclick="SeleccionarDetalleOrdenCompra(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" idooc="'.$fila['intIdOperacionOrdenCompra'].'" class="btn btn-xs btn-danger" onclick="EliminarDetalleOrdenCompra(this)">
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

  public function SeleccionarDetalleOrdenCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarDetalleOrdenCompra(:intIdOperacionOrdenCompra)');
      $sql_comando -> execute(array(':intIdOperacionOrdenCompra' => $this->intIdOperacionOrdenCompra));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdOperacionOrdenCompra'] = $fila['intIdOperacionOrdenCompra'];
      $salida['intIdOrdenCompra'] = $fila['intIdOrdenCompra'];
      $salida['intIdProducto'] = $fila['intIdProducto'];
      $salida['nvchNombre'] = $fila['nvchNombre'];
      $salida['nvchDescripcion'] = $fila['nvchDescripcion'];
      $salida['dtmFechaSolicitud'] = $fila['dtmFechaSolicitud'];
      $salida['intCantidad'] = $fila['intCantidad'];
      $salida['dcmPrecio'] = $fila['dcmPrecio'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarDetalleOrdenCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarDetalleOrdenCompra(:intIdOperacionOrdenCompra,
        :intIdOrdenCompra,:intIdProducto,:dtmFechaSolicitud,:intCantidad,:dcmPrecio)');
      $sql_comando->execute(array(
        ':intIdOperacionOrdenCompra' => $this->intIdOperacionOrdenCompra,
        ':intIdOrdenCompra' => $this->intIdOrdenCompra, 
        ':intIdProducto' => $this->intIdProducto, 
        ':dtmFechaSolicitud' => $this->dtmFechaSolicitud,
        ':intCantidad' => $this->intCantidad,
        ':dcmPrecio' => $this->dcmPrecio));
      $_SESSION['intIdOperacionOrdenCompra'] = $this->intIdOperacionOrdenCompra;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarDetalleOrdenCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarDetalleOrdenCompra(:intIdOperacionOrdenCompra)');
      $sql_comando -> execute(array(':intIdOperacionOrdenCompra' => $this->intIdOperacionOrdenCompra));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarProductoOrdenCompra($busqueda,$x,$y,$tipofuncion)
  {
  	try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ListarProductoOrdenCompra(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
      	echo 
      	'<tr>
        <td><input type="hidden" name="SintIdProducto['.$fila['intIdProducto'].']" value="'.$fila['intIdProducto'].'"/>'.$fila['intIdProducto'].'</td>
        <td><input type="hidden" name="SnvchNombre['.$fila['intIdProducto'].']" value="'.$fila['nvchNombre'].'"/>'.$fila['nvchNombre'].'</td>
        <td><input type="hidden" name="SnvchDescripcion['.$fila['intIdProducto'].']" value="'.$fila['nvchDescripcion'].'"/>'.$fila['nvchDescripcion'].'</td>
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
         '<button type="button" idsprt="'.$fila['intIdProducto'].'" class="btn btn-xs btn-warning" onclick="AgregarDetalleOrdenCompra_II(this)">
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

  public function PaginarProductosOrdenCompra($busqueda,$x,$y)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL PAGINARPRODUCTOORDENCOMPRA(:busqueda)');
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
  /* FIN - Métodos de Detalle Orden Compra */
}
?>