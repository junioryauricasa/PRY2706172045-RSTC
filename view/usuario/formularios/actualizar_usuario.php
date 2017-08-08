      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Usuario</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-crear-usuario" method="POST">
          <div class="box-body">
            <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nvchUserName" class="form-control select2" placeholder="Ingrese nombre del usuario" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Correo:</label>
                        <input type="text" name="nchUserMail" class="form-control select2" placeholder="Ingrese correo" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Contraseña:</label>
                        <input type="text" name="nvchUserPassword" class="form-control select2" placeholder="Ingrese contraseña" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Empleado:</label>
                        <input type="text" name="intIdEmpleado" class="form-control select2" placeholder="Id empleado" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Tipo Usuario:</label>
                        <input type="text" name="intTypeUser" class="form-control select2" placeholder="Tipo de usuario" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Estado:</label>
                        <input type="text" name="bitUserEstado" class="form-control select2" placeholder="estado del usuario" value="">
                      </div>
                    </div>
            </div>
          </div>
          <div class="box-footer clearfix">
              <input type="hidden" name="funcion" value="A" />
              <input type="submit" id="btn-editar-usuario" class="btn btn-sm btn-info btn-flat pull-left" value="Editar Usuario">
              <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
          </div>              
        </form>
      </div>