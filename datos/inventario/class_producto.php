<?php
session_start();
require_once '../conexion/bd_conexion.php';
class Producto
{
  /* INICIO - Atributos de Producto*/
  private $intIdProducto;
  private $nvchNombre;
  private $dcmPrecio;
  private $intCantidad;
  private $nvchDireccionImg;
  private $nvchDescripcion;
  
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function Nombre($nvchNombre){ $this->nvchNombre = $nvchNombre; }
  public function Precio($dcmPrecio){ $this->dcmPrecio = $dcmPrecio; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function DireccionImg($nvchDireccionImg){ $this->nvchDireccionImg = $nvchDireccionImg; }
  public function Descripcion($nvchDescripcion){ $this->nvchDescripcion = $nvchDescripcion; }
  /* FIN - Atributos de Producto */

  /* INICIO - Métodos de Producto */
  public function InsertarProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarproducto(:nvchNombre,:dcmPrecio,
        :intCantidad,:nvchDireccionImg,:nvchDescripcion)');
      $sql_comando->execute(array(':nvchNombre' => $this->nvchNombre, 
        ':dcmPrecio' => $this->dcmPrecio,
        ':intCantidad' => $this->intCantidad,
        ':nvchDireccionImg' => $this->nvchDireccionImg,
        ':nvchDescripcion' => $this->nvchDescripcion));
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function MostrarProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarproducto(:intIdProducto)');
      $sql_comando -> execute(array(':intIdProducto' => $this->intIdProducto));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      echo '<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Producto</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-editar-producto" method="POST">
          <div class="box-body">
            <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nvchNombre" class="form-control select2" placeholder="Ingrese nombre del producto" value="'.$fila['nvchNombre'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Precio:</label>
                        <input type="text" name="dcmPrecio" class="form-control select2" placeholder="Ingrese precio del producto" value="'.$fila['dcmPrecio'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="text" name="intCantidad" class="form-control select2" placeholder="Ingrese cantidad del producto" value="'.$fila['intCantidad'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Imagen:</label>
                        <input type="text" name="nvchDireccionImg" class="form-control select2" placeholder="Ingrese imagen del producto" value="'.$fila['nvchDireccionImg'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Descripción:</label>
                        <input type="text" name="nvchDescripcion" class="form-control select2" placeholder="Ingrese descripción del producto" value="'.$fila['nvchDescripcion'].'">
                      </div>
                    </div>
            </div>
          </div>
          <div class="box-footer clearfix">
              <input type="hidden" name="funcion" value="A" />
              <input type="hidden" name="intIdProducto" value="'.$fila['intIdProducto'].'" />
              <input type="submit" id="btn-editar-producto" class="btn btn-sm btn-info btn-flat pull-left" value="Editar Producto">
              <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
          </div>              
        </form>
        <div id="resultadocrud"></div>
      </div>';
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
      $sql_comando = $sql_conectar->prepare('CALL actualizarproducto(:intIdProducto,:nvchNombre,:dcmPrecio,
        :intCantidad,:nvchDireccionImg,:nvchDescripcion)');
      $sql_comando->execute(array(':intIdProducto' => $this->intIdProducto,
        ':nvchNombre' => $this->nvchNombre, 
        ':dcmPrecio' => $this->dcmPrecio,
        ':intCantidad' => $this->intCantidad,
        ':nvchDireccionImg' => $this->nvchDireccionImg,
        ':nvchDescripcion' => $this->nvchDescripcion));
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
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarProductos($busqueda,$x,$y,$tipolistado)
  {
    try{
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de producto por el comando LIMIT
      if($tipolistado == "N"){
        $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      }
      //Busqueda de producto por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr>';
        }
        echo '<td>PRT'.$fila["intIdProducto"].'</td>
        <td>'.$fila["nvchNombre"].'</td>
        <td>'.$fila["dcmPrecio"].'</td> 
        <td>'.$fila["intCantidad"].'</td>
        <td>
            <img src="../../datos/inventario/imgproducto/'.$fila["nvchDireccionImg"].'" height="50">
        </td>
        <td>'.$fila["nvchDescripcion"].'</td>
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
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda));
      $cantidad = $sql_comando -> rowCount();
      $numpaginas = ceil($cantidad / $y);
      if($tipolistado == "N")
        { $x = $numpaginas - 1; }
      $output = "";
      for($i = 0; $i < $numpaginas; $i++){
        if($i==0)
        {
          //$output = 'No s eencontraron nada';
          if($x==0)
          {
            $output .= 
            '<li class="page-item disabled">
                <a class="page-link btn-pagina" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          } else {
            $output .= 
            '<li class="page-item">
                <a idp="'.$i.'" class="page-link btn-pagina" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

          if($x==$i){
            $output.=  '<li class="page-item active"><a idp="'.$i.'" class="page-link btn-pagina">'.($i+1).'</a></li>';
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
                <a class="page-link btn-pagina" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </li>';
          } else {
            $output .= 
            '<li class="page-item">
                <a idp="'.$i.'" class="page-link btn-pagina" aria-label="Next">
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

switch($_POST['funcion']){
  case "I":
    $producto = new Producto();
    $producto->Nombre($_POST['nvchNombre']);
    $producto->Precio($_POST['dcmPrecio']);
    $producto->Cantidad($_POST['intCantidad']);
    $producto->DireccionImg($_POST['nvchDireccionImg']);
    $producto->Descripcion($_POST['nvchDescripcion']);
    $producto->InsertarProducto();
    break;
  case "A":
    $producto = new Producto();
    $producto->IdProducto($_POST['intIdProducto']);
    $producto->Nombre($_POST['nvchNombre']);
    $producto->Precio($_POST['dcmPrecio']);
    $producto->Cantidad($_POST['intCantidad']);
    $producto->DireccionImg($_POST['nvchDireccionImg']);
    $producto->Descripcion($_POST['nvchDescripcion']);
    $producto->ActualizarProducto();
    break;
  case "M":
    $producto = new Producto();
    $producto->IdProducto($_POST['intIdProducto']);
    $producto->MostrarProducto();
    break;
  case "E":
    $producto = new Producto();
    $producto->IdProducto($_POST['intIdProducto']);
    $producto->EliminarProducto();
    break;
  case "L":
    $producto = new Producto();
    $producto->ListarProductos($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $producto = new Producto();
    $producto->PaginarProductos($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
}