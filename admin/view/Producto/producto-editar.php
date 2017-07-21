<h1 class="page-header">
    <?php echo $alm->__GET('intIdProducto') != null ? $alm->__GET('nvchNombre') : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Producto">Producto</a></li>
  <li class="active"><?php echo $alm->__GET('intIdProducto') != null ? $alm->__GET('nvchNombre') : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-producto" action="?c=Producto&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="intIdProducto" value="<?php echo $alm->__GET('intIdProducto'); ?>" />
    
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nvchNombre" value="<?php echo $alm->__GET('nvchNombre'); ?>" class="form-control" placeholder="Ingrese Producto" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <div class="form-group">
        <label>Precio</label>
        <input type="text" name="dcmPrecio" value="<?php echo $alm->__GET('dcmPrecio'); ?>" class="form-control" placeholder="Ingrese precio" data-validacion-tipo="requerido|min:10" />
    </div>
    
    <div class="form-group">
        <label>Cantidad</label>
        <input type="text" name="intCantidad" value="<?php echo $alm->__GET('intCantidad'); ?>" class="form-control" placeholder="Ingrese cantidad" data-validacion-tipo="requerido|email" />
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label>Imagen</label>
                <input type="hidden" name="nvchDireccionImg" value="<?php echo $alm->__GET('nvchDireccionImg'); ?>" />
                <input type="file" name="nvchDireccionImg" placeholder="Ingrese una imagen" />
            </div>     
        </div>
        <div class="col-xs-6">
            <?php if($alm->__GET('nvchDireccionImg') != ''): ?>
                <div class="img-thumbnail text-center">
                    <img src="uploads/<?php echo $alm->__GET('nvchDireccionImg'); ?>" style="width:50%;" />
                </div>
            <?php endif; ?>            
        </div>
    </div>
    
    <div class="form-group">
        <label>Descipcion</label>
        <!--select name="Sexo" class="form-control">
            <option <?php //echo $alm->__GET('Sexo') == 1 ? 'selected' : ''; ?> value="1">Masculino</option>
            <option <?php //echo $alm->__GET('Sexo') == 2 ? 'selected' : ''; ?> value="2">Femenino</option>
        </select-->
        <input type="text" name="nvchDescripcion" value="<?php echo $alm->__GET('nvchDescripcion'); ?>" class="form-control" placeholder="Ingrese Descripcion" data-validacion-tipo="requerido" />
    </div>
    
    <div class="form-group">
        <label>Ubicacion</label>
        <input readonly type="text" name="intIdUbigeoProducto" value="<?php echo $alm->__GET('intIdUbigeoProducto'); ?>" class="form-control datepicker" placeholder="Ingrese su ubicacion" data-validacion-tipo="requerido" />
    </div>

    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-producto").submit(function(){
            return $(this).validate();
        });
    })
</script>