<?php
require_once '../conexion/bd_conexion.php';
require_once 'class_formulario_producto.php';
class Producto
{
  /* INICIO - Atributos de Producto*/
  private $intIdProducto;
  private $nvchCodigoProducto;
  private $nvchCodigoInventario;
  private $nvchNombre;
  private $nvchDescripcion;
  private $dcmPrecioCompra;
  private $dcmPrecioVenta;
  private $intCantidad;
  private $nvchDescuento;
  private $nvchDireccionImg;
  private $nvchSucursal;
  private $nvchGabinete;
  private $nvchCajon;
  private $dtmFechaIngreso;
  
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function CodigoProducto($nvchCodigoProducto){ $this->nvchCodigoProducto = $nvchCodigoProducto; }
  public function CodigoInventario($nvchCodigoInventario){ $this->nvchCodigoInventario = $nvchCodigoInventario; }
  public function Nombre($nvchNombre){ $this->nvchNombre = $nvchNombre; }
  public function Descripcion($nvchDescripcion){ $this->nvchDescripcion = $nvchDescripcion; }
  public function PrecioCompra($dcmPrecioCompra){ $this->dcmPrecioCompra = $dcmPrecioCompra; }
  public function PrecioVenta($dcmPrecioVenta){ $this->dcmPrecioVenta = $dcmPrecioVenta; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function Descuento($nvchDescuento){ $this->nvchDescuento = $nvchDescuento; }
  public function DireccionImg($nvchDireccionImg){ $this->nvchDireccionImg = $nvchDireccionImg; }
  public function Sucursal($nvchSucursal){ $this->nvchSucursal = $nvchSucursal; }
  public function Gabinete($nvchGabinete){ $this->nvchGabinete = $nvchGabinete; }
  public function Cajon($nvchCajon){ $this->nvchCajon = $nvchCajon; }
  public function FechaIngreso($dtmFechaIngreso){ $this->dtmFechaIngreso = $dtmFechaIngreso; }
  /* FIN - Atributos de Producto */

  /* INICIO - Métodos de Producto */
  public function InsertarProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarproducto(:nvchCodigoProducto,
        :nvchCodigoInventario,:nvchNombre,:nvchDescripcion,:dcmPrecioCompra,:dcmPrecioVenta,
        :intCantidad,:nvchDescuento,:nvchDireccionImg,:nvchSucursal,:nvchGabinete,:nvchCajon,
        :dtmFechaIngreso)');
      $sql_comando->execute(array(
        ':nvchCodigoProducto' => $this->nvchCodigoProducto, 
        ':nvchCodigoInventario' => $this->nvchCodigoInventario,
        ':nvchNombre' => $this->nvchNombre,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':dcmPrecioCompra' => $this->dcmPrecioCompra,
        ':dcmPrecioVenta' => $this->dcmPrecioVenta,
        ':intCantidad' => $this->intCantidad,
        ':nvchDescuento' => $this->nvchDescuento,
        ':nvchDireccionImg' => $this->nvchDireccionImg,
        ':nvchSucursal' => $this->nvchSucursal,
        ':nvchGabinete' => $this->nvchGabinete,
        ':nvchCajon' => $this->nvchCajon,
        ':dtmFechaIngreso' => $this->dtmFechaIngreso));
      $_SESSION['intIdProducto'] = $this->intIdProducto;
      $_SESSION['RutaDefaultImg'] = "";
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarProducto($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarproducto(:intIdProducto)');
      $sql_comando -> execute(array(':intIdProducto' => $this->intIdProducto));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $formularioproducto = new FormularioProducto();
      $formularioproducto->IdProducto($fila['intIdProducto']);
      $formularioproducto->CodigoProducto($fila['nvchCodigoProducto']);
      $formularioproducto->CodigoInventario($fila['nvchCodigoInventario']);
      $formularioproducto->Nombre($fila['nvchNombre']);
      $formularioproducto->Descripcion($fila['nvchDescripcion']);
      $formularioproducto->PrecioCompra($fila['dcmPrecioCompra']);
      $formularioproducto->PrecioVenta($fila['dcmPrecioVenta']);
      $formularioproducto->Cantidad($fila['intCantidad']);
      $formularioproducto->Descuento($fila['nvchDescuento']);
      $formularioproducto->DireccionImg($fila['nvchDireccionImg']);
      $formularioproducto->Sucursal($fila['nvchSucursal']);
      $formularioproducto->Gabinete($fila['nvchGabinete']);
      $formularioproducto->Cajon($fila['nvchCajon']);
      $formularioproducto->FechaIngreso($fila['dtmFechaIngreso']);
      $formularioproducto->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarproducto(:intIdProducto,
        :nvchCodigoProducto,:nvchCodigoInventario,:nvchNombre,:nvchDescripcion,:dcmPrecioCompra,
        :dcmPrecioVenta,:intCantidad,:nvchDescuento,:nvchDireccionImg,:nvchSucursal,:nvchGabinete,
        :nvchCajon,:dtmFechaIngreso)');
      $sql_comando->execute(array(
        ':intIdProducto' => $this->intIdProducto,
        ':nvchCodigoProducto' => $this->nvchCodigoProducto, 
        ':nvchCodigoInventario' => $this->nvchCodigoInventario,
        ':nvchNombre' => $this->nvchNombre,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':dcmPrecioCompra' => $this->dcmPrecioCompra,
        ':dcmPrecioVenta' => $this->dcmPrecioVenta,
        ':intCantidad' => $this->intCantidad,
        ':nvchDescuento' => $this->nvchDescuento,
        ':nvchDireccionImg' => $this->nvchDireccionImg,
        ':nvchSucursal' => $this->nvchSucursal,
        ':nvchGabinete' => $this->nvchGabinete,
        ':nvchCajon' => $this->nvchCajon,
        ':dtmFechaIngreso' => $this->dtmFechaIngreso));
      $_SESSION['intIdProducto'] = $this->intIdProducto;
      $_SESSION['RutaDefaultImg'] = "";
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarproducto(:intIdProducto)');
      $sql_comando -> execute(array(':intIdProducto' => $this->intIdProducto));
      $_SESSION['intIdProducto'] = $this->intIdProducto;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarProductos($busqueda,$x,$y,$tipolistado)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de producto por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de producto por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdProducto"] == $_SESSION['intIdProducto'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo 
        '<td>PRT'.$fila["intIdProducto"].'</td>
        <td>'.$fila["nvchCodigoProducto"].'</td>
        <td>'.$fila["nvchCodigoInventario"].'</td>
        <td>'.$fila["nvchNombre"].'</td>
        <td>'.$fila["nvchDescripcion"].'</td>
        <td>'.$fila["dcmPrecioCompra"].'</td>
        <td>'.$fila["dcmPrecioVenta"].'</td>
        <td>'.$fila["intCantidad"].'</td>
        <td>'.$fila["nvchDescuento"].'</td>
        <td>
          <img src="../../datos/inventario/imgproducto/'.$fila["nvchDireccionImg"].'" height="50">
        </td>
        <td> 
          <button type="submit" id="'.$fila["intIdProducto"].'" class="btn btn-xs btn-warning btn-mostrar-producto">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="submit" id="'.$fila["intIdProducto"].'" class="btn btn-xs btn-danger btn-eliminar-producto">
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

  public function PaginarProductos($busqueda,$x,$y,$tipolistado)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda)');
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

  public function FiltrarImagen($file)
  {
    try{
      
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }
  /* FIN - Métodos de Producto */
}