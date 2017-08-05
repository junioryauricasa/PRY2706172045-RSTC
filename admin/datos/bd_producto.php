<?php
  session_start();
  require_once '../../dbconnect2.php';
  /*if(isset($_POST['boton-agregar-paciente']))
  {*/
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

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Buscar producto:</label> <br>
                        <select class="selectpicker" data-live-search="true">
                          <option data-tokens="User1">selecciona</option>
                          <option data-tokens="User1">Junior Yauricasa</option>
                          <option data-tokens="User2">Hector Vvanco</option>
                          <option data-tokens="User3">Luis Sanchez</option>
                        </select>
                      </div>
                    </div>

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
                      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>     
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Disabled Result</label>
                        <select class="form-control select2" style="width: 100%;">
                          <option selected="selected">Alabama</option>
                          <option>Alaska</option>
                          <option disabled="disabled">California (disabled)</option>
                          <option>Delaware</option>
                          <option>Tennessee</option>
                          <option>Texas</option>
                          <option>Washington</option>
                        </select>
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
  /*}*/
?>