<?php 
require_once '../conexion/bd_conexion.php';
class DetalleOrdenCompra
{	
  /* INICIO - Atributos de Detalle Orden Compra*/
  private $intIdOperacionOrdenCompra;
  private $intIdOrdenCompra;
  private $dtmFechaSolicitud;
  private $nvchCodigo;
  private $nvchDescripcion;
  private $intCantidad;
  private $dcmPrecio;
  private $dcmTotal;
  
  public function IdOperacionOrdenCompra($intIdOperacionOrdenCompra){ $this->intIdOperacionOrdenCompra = $intIdOperacionOrdenCompra; }
  public function IdOrdenCompra($intIdOrdenCompra){ $this->intIdOrdenCompra = $intIdOrdenCompra; }
  public function FechaSolicitud($dtmFechaSolicitud){ $this->dtmFechaSolicitud = $dtmFechaSolicitud; }
  public function Codigo($nvchCodigo){ $this->nvchCodigo = $nvchCodigo; }
  public function Descripcion($nvchDescripcion){ $this->nvchDescripcion = $nvchDescripcion; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function Precio($dcmPrecio){ $this->dcmPrecio = $dcmPrecio; }
  public function Total($dcmTotal){ $this->dcmTotal = $dcmTotal; }
  /* FIN - Atributos de Detalle Orden Compra */

  /* INICIO - Métodos de Detalle Orden Compra */
  public function InsertarDetalleOrdenCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->nvchCodigo as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarDetalleOrdenCompra(:intIdOrdenCompra,
      	:dtmFechaSolicitud,:nvchCodigo,:nvchDescripcion,:intCantidad,:dcmPrecio,:dcmTotal)');
      $sql_comando->execute(array(
        ':intIdOrdenCompra' => $this->intIdOrdenCompra,
        ':dtmFechaSolicitud' => $this->dtmFechaSolicitud,
        ':nvchCodigo' => $value,
        ':nvchDescripcion' => $this->nvchDescripcion[$key],
        ':intCantidad' => $this->intCantidad[$key],
        ':dcmPrecio' => $this->dcmPrecio[$key],
        ':dcmTotal' => $this->dcmTotal[$key]));
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
      	:dtmFechaSolicitud,:nvchCodigo,:nvchDescripcion,:intCantidad,:dcmPrecio,:dcmTotal)');
      $sql_comando->execute(array(
        ':intIdOrdenCompra' => $this->intIdOrdenCompra,
        ':dtmFechaSolicitud' => $this->dtmFechaSolicitud,
        ':nvchCodigo' => $this->nvchCodigo,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':intCantidad' => $this->intCantidad,
        ':dcmPrecio' => $this->dcmPrecio,
        ':dcmTotal' => $this->dcmTotal));
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
      	'
        <td class="heading" data-th="ID"></td>
        <td>'.$i.'</td>
        <td><input type="hidden" name="nvchCodigo[]" value="'.$fila['nvchCodigo'].'"/>'.$fila['nvchCodigo'].'</td>
        <td><input type="hidden" name="nvchDescripcion[]" value="'.$fila['nvchDescripcion'].'"/>'.$fila['nvchDescripcion'].'</td>
        <td><input type="hidden" name="intCantidad[]" value="'.$fila['intCantidad'].'"/>'.$fila['intCantidad'].'</td>
        <td><input type="hidden" name="dcmPrecio[]" style="text-align: right;" value="'.$fila['dcmPrecio'].'"/>'.$fila['nvchSimbolo'].' '.$fila['dcmPrecio'].'</td>
        <td><input type="hidden" name="dcmTotal[]" style="text-align: right;" value="'.$fila['dcmTotal'].'"/>'.$fila['nvchSimbolo'].' '.$fila['dcmTotal'].'</td>
        <td> 
          <button type="button" idooc="'.$fila['intIdOperacionOrdenCompra'].'" class="btn btn-xs btn-warning" onclick="SeleccionarDetalleOrdenCompra(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" idooc="'.$fila['intIdOperacionOrdenCompra'].'" class="btn btn-xs btn-danger" onclick="EliminarDetalleOrdenCompra(this)" id="eliminar-detalle-orden-de-compra">
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
      $salida['dtmFechaSolicitud'] = $fila['dtmFechaSolicitud'];
      $salida['nvchCodigo'] = $fila['nvchCodigo'];
      $salida['nvchDescripcion'] = $fila['nvchDescripcion'];
      $salida['intCantidad'] = $fila['intCantidad'];
      $salida['dcmPrecio'] = $fila['dcmPrecio'];
      $salida['dcmTotal'] = $fila['dcmTotal'];
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
        :intIdOrdenCompra,:dtmFechaSolicitud,:nvchCodigo,:nvchDescripcion,:intCantidad,:dcmPrecio,:dcmTotal)');
      $sql_comando->execute(array(
        ':intIdOperacionOrdenCompra' => $this->intIdOperacionOrdenCompra,
        ':intIdOrdenCompra' => $this->intIdOrdenCompra,
        ':dtmFechaSolicitud' => $this->dtmFechaSolicitud,
        ':nvchCodigo' => $this->nvchCodigo,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':intCantidad' => $this->intCantidad,
        ':dcmPrecio' => $this->dcmPrecio,
        ':dcmTotal' => $this->dcmTotal));
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

  public function ListarProductoOrdenCompra($busqueda,$x,$y,$tipofuncion,$TipoBusqueda)
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
        <td>
          <button onclick="VerImagenProducto(this)" type="button" imagen="'.$fila["nvchDireccionImg"].'" class="btn btn-xs btn-primary">
            <i class="fa fa-search"></i> Ver 
          </button>
        </td>
        <td><input type="text" name="SdcmPrecio['.$fila['intIdProducto'].']" onkeypress="return EsDecimalTecla(event)" class="form-control select2" placeholder="Ingrese Precio"/></td>
        <td><input type="text" name="SintCantidad['.$fila['intIdProducto'].']" onkeypress="return EsNumeroEnteroTecla(event)" class="form-control select2" placeholder="Ingrese Cantidad"></td>
        <td>';
        if($tipofuncion == "F") {
        echo 
         '<button type="button" idsprt="'.$fila['intIdProducto'].'" class="btn btn-xs btn-warning" onclick="SeleccionarProducto(this)">
            <i class="fa fa-edit"></i> Elegir
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

  public function PaginarProductosOrdenCompra($busqueda,$x,$y,$TipoBusqueda)
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
  /* FIN - Métodos de Detalle Orden Compra */
}
?>