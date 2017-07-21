<h1 class="page-header">Producto</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Producto&a=Crud">Nuevo Producto</a>
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

<div class="table-responsive">  
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="width:80px;">Cod.</th>
                <th style="width:180px;">Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th style="width:120px;">IMG</th>
                <th style="width:120px;">Descripcion</th>
                <th style="width:60px;">Ubicacion</th>
                <th style="width:60px;">Opciones</th>
            </tr>
        </thead>
        
        <!--tr>
            <td colspan="8" class="text-center">
                <a href="?c=Alumno&a=excel">Exportar a Excel</a>
            </td>
        </tr-->
        
        <?php foreach($this->model->Listar() as $r): ?>
            <tr>
                <td><?php echo $r->__GET('intIdProducto'); ?></td>
                <td><?php echo $r->__GET('nvchNombre'); ?></td>
                <td><?php echo $r->__GET('dcmPrecio'); ?></td>
                <td><?php echo $r->__GET('intCantidad'); ?></td>
                <td>
                    <?php if($r->__GET('nvchDireccionImg') != ''): ?>
                        <img src="uploads/<?php echo $r->__GET('nvchDireccionImg'); ?>" height="100px" />
                    <?php endif; ?> 
                </td>
                <!--td>
                    <?php //echo $r->__GET('Sexo') == 1 ? 'Hombre' : 'Mujer'; ?>
                </td-->
                <td><?php echo $r->__GET('nvchDescripcion'); ?></td>
                <td><?php echo $r->__GET('intIdUbigeoProducto'); ?></td>
                <td>
                    <a href="?c=Producto&a=Crud&intIdProducto=<?php echo $r->intIdProducto; ?>">Editar</a>
                    <br>
                    <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Producto&a=Eliminar&intIdProducto=<?php echo $r->intIdProducto; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        
        <tfoot>
            <tr>
                <td colspan="8" class="text-center">
                    <a href="?c=Producto&a=excel">Exportar a Excel</a>
                </td>
            </tr>
        </tfoot>
    </table> 
</div>