<?php 

//Consulta usuarios TABLA AJAX
function users_data2()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "db_resteco");  
    $sql = "SELECT * FROM tb_usuario";  
    //$result = mysqli_query($conn, $sql);  
    $result = mysqli_query($con, $sql);
    /*
    $output .= '<thead>
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
	            <tbody>';
	*/
    while($row = mysqli_fetch_array($result))  
    {       
    $output .= '
    <tr>
        <td>'.$row["intUserId"].'</td>
        <td>'.$row["nvchUserName"].'</td>
        <td>'.$row["nchUserMail"].'</td> 
        <td>'.$row["nvchUserPassword"].'</td>
        <td>'.$row["intIdEmpleado"].'</td>
        <td>'.$row["intTypeUser"].'</td>
        <td>'.$row["bitUserEstado"].'</td>
        <td> 
          <button type="submit" id="'.$row["intUserId"].'" class="btn btn-xs btn-warning btn-mostrar-usuario">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="submit" id="'.$row["intUserId"].'" class="btn btn-xs btn-danger btn-eliminar-usuario">
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