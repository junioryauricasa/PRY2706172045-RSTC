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
      $contar = $sql_comando -> rowCount();
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

  public function ListarProductos()
  {

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
    $producto->ListarProducto();
    break;

}
/*
  require_once '../conexion/bd_conexion.php';
    $output = array();
    $idproducto = $_POST['producto_idproducto'];
    try{
      $sql_resultado_seleccionar=$bd_conexion->prepare('SELECT * FROM tb_producto WHERE intIdProducto=:idproducto');
      $sql_resultado_seleccionar->execute(array(':idproducto' => $idproducto));
      $fila = $sql_resultado_seleccionar -> fetch(PDO::FETCH_ASSOC);
      $contar = $sql_resultado_seleccionar -> rowCount();

      $output['intIdProducto'] = $fila['intIdProducto'];
      $output['nvchNombre'] = $fila['nvchNombre'];
      $output['dcmPrecio'] = $fila['dcmPrecio'];
      $output['intCantidad'] = $fila['intCantidad'];
      $output['nvchDireccionImg'] = $fila['nvchDireccionImg'];
      $output['nvchDescripcion'] = $fila['nvchDescripcion'];
      //echo json_encode($output);
      echo '
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Registro de Producto</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form method="POST">
          <div class="box-body">
            <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control select2" placeholder="Ingrese nombre del producto" value="'.$output['nvchNombre'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Precio:</label>
                        <input type="text" name="precio" class="form-control select2" placeholder="Ingrese precio del producto" value="'.$output['dcmPrecio'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="text" name="cantidad" class="form-control select2" placeholder="Ingrese cantidad del producto" value="'.$output['intCantidad'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Imagen:</label>
                        <input type="text" name="direccionimg" class="form-control select2" placeholder="Ingrese imagen del producto" value="'.$output['nvchDireccionImg'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Descripción:</label>
                        <input type="text" name="descripcion" class="form-control select2" placeholder="Ingrese descripción del producto" value="'.$output['nvchDescripcion'].'">
                      </div>
                    </div>
          </div>
          <div class="box-footer">
              <input type="submit" name="regNuevoProducto" class="btn btn-sm btn-info btn-flat pull-left" value="Guardar">
              <input type="reset" class="btn btn-sm btn-info btn-flat pull-left" value="Limpiar">
          </div>              
        </form>
      </div>';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
?>
*/