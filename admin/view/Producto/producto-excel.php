<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <table>
            <thead>
                <tr style="background:#eee;">
                    <th style="width:180px;">Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th style="width:120px;">Imagen</th>
                    <th style="width:120px;">Descripcion</th>
                    <th style="width:120px;">Ubigeo</th>
                </tr>
            </thead>
            <?php foreach($this->model->Listar() as $r): ?>
                <tr>
                    <td><?php echo $r->__GET('nvchNombre'); ?></td>
                    <td><?php echo $r->__GET('dcmPrecio'); ?></td>
                    <td><?php echo $r->__GET('intCantidad'); ?></td>
                    <td><?php echo $r->__GET('nvchDireccionImg'); ?></td>
                    <td><?php echo $r->__GET('nvchDescripcion'); ?></td>
                    <td><?php echo $r->__GET('intIdUbigeoProducto'); ?></td>
                </tr>
            <?php endforeach; ?>
        </table> 
    </body>
</html>