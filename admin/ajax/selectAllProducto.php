<?php 

//Consulta usuarios TABLA AJAX
function users_data2()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "db_resteco");  
    $sql = "SELECT * FROM tb_producto";  
    //$result = mysqli_query($conn, $sql);  
    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       
    $output .= '
    <tr>  
        <td>PRT'.$row["intIdProducto"].'</td>
        <td>'.$row["nvchNombre"].'</td>
        <td>'.$row["dcmPrecio"].'</td> 
        <td>'.$row["intCantidad"].'</td>
        <td>
            <img src="uploads/'.$row["nvchDireccionImg"].'" height="50">
        </td>
        <td>'.$row["nvchDescripcion"].'</td>
        <td> 
          <button type="submit" onclick="showUser(this.'.$row["intIdProducto"].')" id_cust="5" class="btn btn-xs btn-warning btnedit">
            <i class="fa fa-edit"></i> Editar
          </button>

          <a href="ajax/deleteUser4id.php?q='.$row["intIdProducto"].'" class="btn btn-xs btn-danger btnedit">
              <i class="fa fa-remove"></i> Eliminar
          </a>
        </td>  
    </tr>  
    ';  
    }  
    return $output;  
}  

echo users_data2();

 ?>