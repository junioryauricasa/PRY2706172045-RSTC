<?php 

//Consulta usuarios TABLA AJAX
function users_data2()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "db_resteco");  
    $sql = "SELECT * FROM tb_producto";  
    //$result = mysqli_query($conn, $sql);  
    $result = mysqli_query($con, $sql);
    /*$output .= '<thead>
              <tr>
                <th>#Código</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Imagen</th>
                <th>Descripción</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <tbody>';*/
    while($row = mysqli_fetch_array($result))  
    {       
    $output .= '
    <tr>
        <td>PRT'.$row["intIdProducto"].'</td>
        <td>'.$row["nvchNombre"].'</td>
        <td>'.$row["dcmPrecio"].'</td> 
        <td>'.$row["intCantidad"].'</td>
        <td>
            <img src="../../datos/inventario/imgproducto/'.$row["nvchDireccionImg"].'" height="50">
        </td>
        <td>'.$row["nvchDescripcion"].'</td>
        <td> 
          <button type="submit" id="'.$row["intIdProducto"].'" class="btn btn-xs btn-warning btn-mostrar-producto">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="submit" id="'.$row["intIdProducto"].'" class="btn btn-xs btn-danger btn-eliminar-producto">
            <i class="fa fa-edit"></i> Eliminar
          </button>
        </td>  
    </tr>
    ';  
    }
    //$output .= '</tbody>';
    return $output;  
}  

echo users_data2();

 ?>