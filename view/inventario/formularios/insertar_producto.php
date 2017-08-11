      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Nuevo Producto</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-crear-producto" method="POST">
          <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Código del Producto:</label>
                    <input type="text" name="nvchCodigoProducto" class="form-control select2" placeholder="Ingrese código del producto" value="" required="">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Código de Inventario:</label>
                    <input type="text" name="nvchCodigoInventario" class="form-control select2" placeholder="Ingrese código de inventario" value="" required="">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Descripción:</label>
                    <input type="text" name="nvchDescripcion" class="form-control select2" placeholder="Ingrese descripción del producto" value="" required="">
                  </div>
                </div>
                <!--
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" name="nvchNombre" class="form-control select2" placeholder="Ingrese nombre del producto" value="" required="">
                  </div>
                </div>
                -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Precio: S/.</label>
                    <input type="text" name="dcmPrecio" class="form-control select2" placeholder="Ingrese precio del producto" value="" required="">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Cantidad:</label>
                    <input type="text" name="intCantidad" class="form-control select2" placeholder="Ingrese cantidad del producto" value="" required="">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Imagen:</label>
                    <input type="file" name="nvchDireccionImg" id="nvchDireccionImg" accept=".png, .jpg, .jpeg">
                    <img id="resultadoimagen" style="width: 100px; height: 100px;" />
                    <!--<input type="text" name="nvchDireccionImg" class="form-control select2" placeholder="Ingrese imagen del producto" value="" required="">-->
                  </div>
                </div>
            </div>
          </div>
          <div class="box-footer clearfix">
              <input type="hidden" name="funcion" value="I" />
              <input type="submit" id="btn-crear-producto" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Producto">
              <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px" required="">
          </div>              
        </form>
      </div>