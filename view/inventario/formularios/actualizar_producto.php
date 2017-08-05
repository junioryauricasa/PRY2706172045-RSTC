      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Producto</h3>
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
                        <label>Nombre:</label>
                        <input type="text" name="nvchNombre" class="form-control select2" placeholder="Ingrese nombre del producto" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Precio:</label>
                        <input type="text" name="dcmPrecio" class="form-control select2" placeholder="Ingrese precio del producto" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="text" name="intCantidad" class="form-control select2" placeholder="Ingrese cantidad del producto" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Imagen:</label>
                        <input type="text" name="nvchDireccionImg" class="form-control select2" placeholder="Ingrese imagen del producto" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Descripción:</label>
                        <input type="text" name="nvchDescripcion" class="form-control select2" placeholder="Ingrese descripción del producto" value="">
                      </div>
                    </div>
            </div>
          </div>
          <div class="box-footer clearfix">
              <input type="hidden" name="funcion" value="A" />
              <input type="submit" id="btn-editar-producto" class="btn btn-sm btn-info btn-flat pull-left" value="Editar Producto">
              <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
          </div>              
        </form>
      </div>