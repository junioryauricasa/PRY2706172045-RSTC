<?php
require_once '../conexion/bd_conexion.php';
require_once 'class_formulario_producto.php';
class Producto
{
  /* INICIO - Atributos de Producto*/
  private $intIdProducto;
  private $nvchNombre;
  private $nvchDescripcion;
  private $nvchUnidadMedida;
  private $intCantidad;
  private $nvchDireccionImg;
  private $dcmPrecioVenta1;
  private $dcmPrecioVenta2;
  private $dcmPrecioVenta3;
  private $dtmFechaIngreso;
  
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function Nombre($nvchNombre){ $this->nvchNombre = $nvchNombre; }
  public function Descripcion($nvchDescripcion){ $this->nvchDescripcion = $nvchDescripcion; }
  public function UnidadMedida($nvchUnidadMedida){ $this->nvchUnidadMedida = $nvchUnidadMedida; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function DireccionImg($nvchDireccionImg){ $this->nvchDireccionImg = $nvchDireccionImg; }
  public function PrecioVenta1($dcmPrecioVenta1){ $this->dcmPrecioVenta1 = $dcmPrecioVenta1; }
  public function PrecioVenta2($dcmPrecioVenta2){ $this->dcmPrecioVenta2 = $dcmPrecioVenta2; }
  public function PrecioVenta3($dcmPrecioVenta3){ $this->dcmPrecioVenta3 = $dcmPrecioVenta3; }
  public function Sucursal($nvchSucursal){ $this->nvchSucursal = $nvchSucursal; }
  public function Ubicacion($nvchUbicacion){ $this->nvchUbicacion = $nvchUbicacion; }
  public function FechaIngreso($dtmFechaIngreso){ $this->dtmFechaIngreso = $dtmFechaIngreso; }
  /* FIN - Atributos de Producto */

  /* INICIO - Métodos de Producto */
  public function InsertarProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarproducto(:nvchNombre,:nvchDescripcion,
        :nvchUnidadMedida,:intCantidad,:nvchDireccionImg,:dcmPrecioVenta1,:dcmPrecioVenta2,
        :dcmPrecioVenta3,:nvchSucursal,:nvchUbicacion,:dtmFechaIngreso)');
      $sql_comando->execute(array(
        ':nvchNombre' => $this->nvchNombre,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':nvchUnidadMedida' => $this->nvchUnidadMedida,
        ':intCantidad' => $this->intCantidad,
        ':nvchDireccionImg' => $this->nvchDireccionImg,
        ':dcmPrecioVenta1' => $this->dcmPrecioVenta1,
        ':dcmPrecioVenta2' => $this->dcmPrecioVenta2,
        ':dcmPrecioVenta3' => $this->dcmPrecioVenta3,
        ':nvchSucursal' => $this->nvchSucursal,
        ':nvchUbicacion' => $this->nvchUbicacion,
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

      $FormularioProducto = new FormularioProducto();
      $FormularioProducto->IdProducto($fila['intIdProducto']);
      $FormularioProducto->Nombre($fila['nvchNombre']);
      $FormularioProducto->Descripcion($fila['nvchDescripcion']);
      $FormularioProducto->UnidadMedida($fila['nvchUnidadMedida']);
      $FormularioProducto->Cantidad($fila['intCantidad']);
      $FormularioProducto->DireccionImg($fila['nvchDireccionImg']);
      $FormularioProducto->PrecioVenta1($fila['dcmPrecioVenta1']);
      $FormularioProducto->PrecioVenta2($fila['dcmPrecioVenta2']);
      $FormularioProducto->PrecioVenta3($fila['dcmPrecioVenta3']);
      $FormularioProducto->Sucursal($fila['nvchSucursal']);
      $FormularioProducto->Ubicacion($fila['nvchUbicacion']);
      $FormularioProducto->FechaIngreso($fila['dtmFechaIngreso']);
      $FormularioProducto->ConsultarFormulario($funcion);
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
      $sql_comando = $sql_conectar->prepare('CALL actualizarproducto(:intIdProducto,:nvchNombre,:nvchDescripcion,
        :nvchUnidadMedida,:intCantidad,:nvchDireccionImg,:dcmPrecioVenta1,:dcmPrecioVenta2,:dcmPrecioVenta3,
        :nvchSucursal,:nvchUbicacion,:dtmFechaIngreso)');
      $sql_comando->execute(array(
        ':intIdProducto' => $this->intIdProducto,
        ':nvchNombre' => $this->nvchNombre,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':nvchUnidadMedida' => $this->nvchUnidadMedida,
        ':intCantidad' => $this->intCantidad,
        ':nvchDireccionImg' => $this->nvchDireccionImg,
        ':dcmPrecioVenta1' => $this->dcmPrecioVenta1,
        ':dcmPrecioVenta2' => $this->dcmPrecioVenta2,
        ':dcmPrecioVenta3' => $this->dcmPrecioVenta3,
        ':nvchSucursal' => $this->nvchSucursal,
        ':nvchUbicacion' => $this->nvchUbicacion,
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
  /* FIN - Métodos de Producto */
}