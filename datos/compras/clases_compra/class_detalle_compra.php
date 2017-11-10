<?php
require_once '../conexion/bd_conexion.php';
class DetalleCompra
{
	/* INICIO - Atributos de Guia Interna Compra */
	private $intIdOperacionCompra;
	private $intIdCompra;
	private $dtmFechaCompra;
  private $intIdProducto;
  private $dcmPrecioUnitario;
	private $intCantidad;
  private $dcmPrecio;

	public function IdOperacionCompra($intIdOperacionCompra){ $this->intIdOperacionCompra = $intIdOperacionCompra; }
	public function IdCompra($intIdCompra){ $this->intIdCompra = $intIdCompra; }
	public function FechaCompra($dtmFechaCompra){ $this->dtmFechaCompra = $dtmFechaCompra; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function PrecioUnitario($dcmPrecioUnitario){ $this->dcmPrecioUnitario = $dcmPrecioUnitario; }
	public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function Total($dcmTotal){ $this->dcmTotal = $dcmTotal; }
	/* FIN - Atributos de Guia Interna Compra */

	/* INICIO - Métodos de Guia Interna Compra */
	public function InsertarDetalleCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->intIdProducto as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL InsertarDetalleCompra(
      	:intIdCompra,:dtmFechaCompra,:intIdProducto,:dcmPrecioUnitario,:intCantidad,
        :dcmTotal)');
      $sql_comando->execute(array(
        ':intIdCompra' => $this->intIdCompra, 
        ':dtmFechaCompra' => $this->dtmFechaCompra,
        ':intIdProducto' => $value,
        ':dcmPrecioUnitario' => $this->dcmPrecioUnitario[$key],
        ':intCantidad' => $this->intCantidad[$key],
        ':dcmTotal' => $this->dcmTotal[$key]));
      //$this->IngresarCantidadProducto($value,$this->intCantidad[$key]);
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarDetalleCompra_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL InsertarDetalleCompra(:intIdCompra,:dtmFechaCompra,:intIdProducto,:dcmPrecioUnitario,:intCantidad,:dcmTotal)');
      $sql_comando->execute(array(
        ':intIdCompra' => $this->intIdCompra, 
        ':dtmFechaCompra' => $this->dtmFechaCompra,
        ':intIdProducto' => $this->intIdProducto,
        ':dcmPrecioUnitario' => $this->dcmPrecioUnitario,
        ':intCantidad' => $this->intCantidad,
        ':dcmTotal' => $this->dcmTotal));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarDetalleCompra($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleCompra(:intIdCompra)');
      $sql_comando -> execute(array(':intIdCompra' => $this->intIdCompra));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdOperacionCompra'] == $fila['intIdOperacionCompra'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
      	echo 
      	'<td>'.$i.'</td>
        <td>'.$fila['nvchCodigo'].'</td>
        <td>'.$fila['nvchDescripcion'].'</td>
        <td>'.$fila['intCantidad'].'</td>
        <td>'.$fila['nvchSimbolo'].' '.$fila['dcmPrecioUnitario'].'</td>
        <td>'.$fila['nvchSimbolo'].' '.$fila['dcmTotal'].'</td>
        </tr>';
        $i++;
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function SeleccionarDetalleCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarDetalleCompra(:intIdOperacionCompra)');
      $sql_comando -> execute(array(':intIdOperacionCompra' => $this->intIdOperacionCompra));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdOperacionCompra'] = $fila['intIdOperacionCompra'];
      $salida['intIdProducto'] = $fila['intIdProducto'];
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

  public function ActualizarDetalleCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarDetalleCompra(:intIdOperacionCompra,
        :intIdCompra,:dtmFechaCompra,:intIdProducto,:dcmPrecioUnitario,:intCantidad,:dcmTotal)');
      $sql_comando->execute(array(
      	':intIdOperacionCompra' => $this->intOperacionIdCompra,
        ':intIdCompra' => $this->intIdCompra,
        ':dtmFechaCompra' => $this->dtmFechaCompra,
        ':intIdProducto' => $this->intIdProducto,
        ':dcmPrecioUnitario' => $this->dcmPrecioUnitario,
        ':intCantidad' => $this->intCantidad,
        ':dcmTotal' => $this->dcmTotal));
      $_SESSION['intIdOperacionCompra'] = $this->intIdOperacionCompra;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function EliminarDetalleCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarDetalleCompra(:intIdOperacionCompra)');
      $sql_comando -> execute(array(':intIdOperacionCompra' => $this->intIdOperacionCompra));
      echo 'ok';
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function ListarProductoCompra($busqueda,$x,$y,$TipoBusqueda,$intIdSucursal)
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
              <td class="heading" data-th="ID"></td>
              <td><input type="hidden" name="SnvchCodigo['.$fila['intIdProducto'].']" value="'.$fila['nvchCodigo'].'"/>'.$fila['nvchCodigo'].'</td>
              <td><input type="hidden" name="SnvchDescripcion['.$fila['intIdProducto'].']" value="'.$fila['nvchDescripcion'].'"/>'.$fila['nvchDescripcion'].'</td>
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
              <td><input type="text" idsprt="'.$fila['intIdProducto'].'" onkeypress="return EsDecimalTecla(event)" 
                onkeyup="CalcularPrecioTotal(this)" name="SdcmPrecioUnitario['.$fila['intIdProducto'].']" class="form-control select2"
                placeholder="Ingrese Precio"/></td>
              <td><input type="text" idsprt="'.$fila['intIdProducto'].'" onkeypress="return EsNumeroEnteroTecla(event)" 
                onkeyup="CalcularPrecioTotal(this)" name="SintCantidad['.$fila['intIdProducto'].']"  class="form-control select2" 
                placeholder="Ingrese Cantidad"></td>
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

  public function PaginarProductosCompra($busqueda,$x,$y,$TipoBusqueda)
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

}/* FIN - Métodos de Guia Interna Compra */
?>