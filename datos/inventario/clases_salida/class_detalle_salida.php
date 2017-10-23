<?php
require_once '../conexion/bd_conexion.php';
class DetalleSalida
{
	/* INICIO - Atributos de Guia Interna Salida */
	private $intIdOperacionSalida;
	private $intIdSalida;
	private $dtmFechaSalida;
  private $intIdProducto;
  private $nvchCodigo;
  private $nvchDescripcion;
	private $intCantidad;

	public function IdOperacionSalida($intIdOperacionSalida){ $this->intIdOperacionSalida = $intIdOperacionSalida; }
	public function IdSalida($intIdSalida){ $this->intIdSalida = $intIdSalida; }
	public function FechaSalida($dtmFechaSalida){ $this->dtmFechaSalida = $dtmFechaSalida; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function Codigo($nvchCodigo){ $this->nvchCodigo = $nvchCodigo; }
  public function Descripcion($nvchDescripcion){ $this->nvchDescripcion = $nvchDescripcion; }
	public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
	/* FIN - Atributos de Guia Interna Salida */

	/* INICIO - Métodos de Guia Interna Salida */
	public function InsertarDetalleSalida()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->intIdProducto as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL InsertarDetalleSalida(
      	:intIdSalida,:dtmFechaSalida,:intIdProducto,:nvchCodigo,:nvchDescripcion,:intCantidad)');
      $sql_comando->execute(array(
        ':intIdSalida' => $this->intIdSalida, 
        ':dtmFechaSalida' => $this->dtmFechaSalida,
        ':intIdProducto' => $value,
        ':nvchCodigo' => $this->nvchCodigo[$key],
        ':nvchDescripcion' => $this->nvchDescripcion[$key],
        ':intCantidad' => $this->intCantidad[$key]));
      //$this->IngresarCantidadProducto($value,$this->intCantidad[$key]);
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarDetalleSalida_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL InsertarDetalleSalida(:intIdSalida,:dtmFechaSalida,:intIdProducto,
        :nvchCodigo,:nvchDescripcion,:intCantidad)');
      $sql_comando->execute(array(
        ':intIdSalida' => $this->intIdSalida, 
        ':dtmFechaSalida' => $this->dtmFechaSalida,
        ':intIdProducto' => $this->intIdProducto,
        ':nvchCodigo' => $this->nvchCodigo,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':intCantidad' => $this->intCantidad));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarDetalleSalida($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleSalida(:intIdSalida)');
      $sql_comando -> execute(array(':intIdSalida' => $this->intIdSalida));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdOperacionSalida'] == $fila['intIdOperacionSalida'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
      	echo 
      	'<td>'.$i.'</td>
        <td><input type="hidden" name="intCantidad[]" value="'.$fila['intCantidad'].'"/>'.$fila['intCantidad'].'</td>
        <td>'.$fila['nvchCodigo'].'</td>
        <td>'.$fila['nvchDescripcion'].'</td>
        <td> 
          <button type="button" iddgie="'.$fila['intIdOperacionSalida'].'" class="btn btn-xs btn-warning" onclick="SeleccionarComunicacion(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" iddgie="'.$fila['intIdOperacionSalida'].'" class="btn btn-xs btn-danger" onclick="EliminarComunicacion(this)">
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

  public function SeleccionarDetalleSalida()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarDetalleSalida(:intIdOperacionSalida)');
      $sql_comando -> execute(array(':intIdOperacionSalida' => $this->intIdOperacionSalida));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdOperacionSalida'] = $fila['intIdOperacionSalida'];
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

  public function ActualizarDetalleSalida()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarDetalleSalida(:intIdOperacionSalida,
        :intIdSalida,:dtmFechaSalida,:intIdProducto,:nvchDescripcion,:dcmPrecioUnitario,:intCantidad,:dcmTotal)');
      $sql_comando->execute(array(
      	':intIdOperacionSalida' => $this->intOperacionIdSalida,
        ':intIdSalida' => $this->intIdSalida,
        ':dtmFechaSalida' => $this->dtmFechaSalida,
        ':intIdProducto' => $this->intIdProducto,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':intCantidad' => $this->intCantidad));
      $_SESSION['intIdOperacionSalida'] = $this->intIdOperacionSalida;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function EliminarDetalleSalida()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarDetalleSalida(:intIdOperacionSalida)');
      $sql_comando -> execute(array(':intIdOperacionSalida' => $this->intIdOperacionSalida));
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

  public function ListarProductoSalida($busqueda,$x,$y,$TipoBusqueda,$intIdSucursal)
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

  public function PaginarProductosSalida($busqueda,$x,$y,$TipoBusqueda)
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

}/* FIN - Métodos de Guia Interna Salida */
?>