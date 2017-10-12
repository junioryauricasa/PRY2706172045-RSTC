<?php
require_once '../conexion/bd_conexion.php';
class DetalleEntrada
{
	/* INICIO - Atributos de Guia Interna Entrada */
	private $intIdOperacionEntrada;
	private $intIdEntrada;
	private $dtmFechaEntrada;
  private $intIdProducto;
  private $nvchDescripcion;
  private $dcmPrecioUnitario;
	private $intCantidad;
  private $dcmPrecio;

	public function IdOperacionEntrada($intIdOperacionEntrada){ $this->intIdOperacionEntrada = $intIdOperacionEntrada; }
	public function IdEntrada($intIdEntrada){ $this->intIdEntrada = $intIdEntrada; }
	public function FechaEntrada($dtmFechaEntrada){ $this->dtmFechaEntrada = $dtmFechaEntrada; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function Descripcion($nvchDescripcion){ $this->nvchDescripcion = $nvchDescripcion; }
  public function PrecioUnitario($dcmPrecioUnitario){ $this->dcmPrecioUnitario = $dcmPrecioUnitario; }
	public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function Total($dcmTotal){ $this->dcmTotal = $dcmTotal; }
	/* FIN - Atributos de Guia Interna Entrada */

	/* INICIO - Métodos de Guia Interna Entrada */
	public function InsertarDetalleEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->intIdProducto as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL InsertarDetalleEntrada(
      	:intIdEntrada,:dtmFechaEntrada,:intIdProducto,:nvchCodigo,:nvchDescripcion,:dcmPrecioUnitario,:intCantidad,
        :dcmTotal)');
      $sql_comando->execute(array(
        ':intIdEntrada' => $this->intIdEntrada, 
        ':dtmFechaEntrada' => $this->dtmFechaEntrada,
        ':intIdProducto' => $value,
        ':nvchCodigo' => $this->nvchCodigo[$key],
        ':nvchDescripcion' => $this->nvchDescripcion[$key],
        ':dcmPrecioUnitario' => $this->dcmPrecioUnitario[$key],
        ':intCantidad' => $this->intCantidad[$key],
        ':dcmTotal' => $this->dcmTotal[$key]));
      $this->IngresarCantidadProducto($value,$this->intCantidad[$key]);
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarDetalleEntrada_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL InsertarDetalleEntrada(:intIdEntrada,:dtmFechaEntrada,:intIdProducto,
        :nvchCodigo,:nvchDescripcion,:dcmPrecioUnitario,:intCantidad,:dcmTotal)');
      $sql_comando->execute(array(
        ':intIdEntrada' => $this->intIdEntrada, 
        ':dtmFechaEntrada' => $this->dtmFechaEntrada,
        ':intIdProducto' => $this->intIdProducto,
        ':nvchCodigo' => $this->nvchCodigo,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':dcmPrecioUnitario' => $this->dcmPrecioUnitario,
        ':intCantidad' => $this->intCantidad,
        ':dcmTotal' => $this->dcmTotal));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarDetalleEntrada($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleEntrada(:intIdEntrada)');
      $sql_comando -> execute(array(':intIdEntrada' => $this->intIdEntrada));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdOperacionEntrada'] == $fila['intIdOperacionEntrada'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
      	echo 
      	'<td>'.$fila['CodigoProducto'].'</td>
        <td>'.$fila['nvchCodigo'].'</td>
        <td>'.$fila['nvchDescripcion'].'</td>
        <td><input type="hidden" name="dcmPrecioUnitario[]" value="'.$fila['dcmPrecioUnitario'].'"/>'.$fila['dcmPrecioUnitario'].'</td>
        <td><input type="hidden" name="intCantidad[]" value="'.$fila['intCantidad'].'"/>'.$fila['intCantidad'].'</td>
        <td><input type="hidden" name="dcmTotal[]" value="'.$fila['dcmTotal'].'"/>'.$fila['dcmTotal'].'</td>
        <td> 
          <button type="button" iddgie="'.$fila['intIdOperacionEntrada'].'" class="btn btn-xs btn-warning" onclick="SeleccionarComunicacion(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" iddgie="'.$fila['intIdOperacionEntrada'].'" class="btn btn-xs btn-danger" onclick="EliminarComunicacion(this)">
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

  public function SeleccionarDetalleEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarDetalleEntrada(:intIdOperacionEntrada)');
      $sql_comando -> execute(array(':intIdOperacionEntrada' => $this->intIdOperacionEntrada));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdOperacionEntrada'] = $fila['intIdOperacionEntrada'];
      $salida['intIdProducto'] = $fila['intIdProducto'];
      $salida['CodigoProducto'] = $fila['CodigoProducto'];
      $salida['nvchCodigo'] = $fila['nvchCodigo'];
      $salida['nvchDescripcion'] = $fila['nvchDescripcion'];
      $salida['dcmPrecioUnitario'] = $fila['dcmPrecioUnitario'];
      $salida['intCantidad'] = $fila['intCantidad'];
      $salida['dcmTotal'] = $fila['dcmTotal'];
      echo json_encode($salida);
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarDetalleEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarDetalleEntrada(:intIdOperacionEntrada,
        :intIdEntrada,:dtmFechaEntrada,:intIdProducto,:nvchDescripcion,:dcmPrecioUnitario,:intCantidad,:dcmTotal)');
      $sql_comando->execute(array(
      	':intIdOperacionEntrada' => $this->intOperacionIdEntrada,
        ':intIdEntrada' => $this->intIdEntrada,
        ':dtmFechaEntrada' => $this->dtmFechaEntrada,
        ':intIdProducto' => $this->intIdProducto,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':dcmPrecioUnitario' => $this->dcmPrecioUnitario,
        ':intCantidad' => $this->intCantidad,
        ':dcmTotal' => $this->dcmTotal));
      $_SESSION['intIdOperacionEntrada'] = $this->intIdOperacionEntrada;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function EliminarDetalleEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarDetalleEntrada(:intIdOperacionEntrada)');
      $sql_comando -> execute(array(':intIdOperacionEntrada' => $this->intIdOperacionEntrada));
      echo 'ok';
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function IngresarCantidadProducto($intIdOperacionOrdenCompra,$intCantidadAumentar)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL SELECCIONARDETALLEORDENCOMPRA(:intIdOperacionOrdenCompra)');
      $sql_comando -> execute(array(':intIdOperacionOrdenCompra' => $intIdOperacionOrdenCompra));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $intIdProducto = $fila['intIdProducto'];
      $intCantidadIngresar = $fila['CantidadProducto'];
      $intCantidadIngresar = $intCantidadIngresar + $intCantidadAumentar;
      $sql_comando = $sql_conectar->prepare('CALL IngresarCantidadProducto(:intIdProducto,:intCantidad)');
      $sql_comando -> execute(array(
        ':intIdProducto' => $intIdProducto,
        ':intCantidad' => $intCantidadIngresar));
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function ListarProductoEntrada($busqueda,$x,$y,$TipoBusqueda,$intIdSucursal)
  {
    try{
      if($busqueda != "" || $busqueda != null) {
        $sql_conexion = new Conexion_BD();
        $sql_conectar = $sql_conexion->Conectar();
        $sql_comando = $sql_conectar->prepare('CALL buscarproducto(:busqueda,:x,:y,:TipoBusqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':TipoBusqueda' => $TipoBusqueda));
        while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
        {
          echo 
          '<tr>
          <td><input type="hidden" name="SCodigoProducto['.$fila['intIdProducto'].']" value="'.$fila['nvchCodigo'].'"/>'.$fila['nvchCodigo'].'</td>
          <td>
            <button onclick="VerDetalleUbigeo(this)" type="button" codigo="'.$fila["nvchCodigo"].'" id="'.$fila["intIdProducto"].'" class="btn btn-xs btn-success">
              <i class="fa fa-edit"></i> Ver Detalle
            </button>
          </td>
          <td>
            <button onclick="VerImagenProducto(this)" type="button" imagen="'.$fila["nvchDireccionImg"].'" class="btn btn-xs btn-primary">
              <i class="fa fa-search"></i> Ver 
            </button>
          </td>
          <td><input type="text" idsprt="'.$fila['intIdProducto'].'" name="SnvchCodigo['.$fila['intIdProducto'].']" value="" class="form-control select2"/></td>
          <td><input type="text" idsprt="'.$fila['intIdProducto'].'" name="SnvchDescripcion['.$fila['intIdProducto'].']" value="" class="form-control select2"/></td>
          <td><input type="text" idsprt="'.$fila['intIdProducto'].'" onkeypress="return EsDecimalTecla(event)" onkeyup="CalcularPrecioTotal(this)" name="SdcmPrecioUnitario['.$fila['intIdProducto'].']" value="" class="form-control select2"/></td>
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

  public function PaginarProductosEntrada($busqueda,$x,$y,$TipoBusqueda)
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

}/* FIN - Métodos de Guia Interna Entrada */
?>