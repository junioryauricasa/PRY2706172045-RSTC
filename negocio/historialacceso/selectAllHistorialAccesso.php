<?php 

//Consulta usuarios TABLA AJAX
function users_data2()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "db_resteco");  
    $sql = "SELECT * FROM tb_historyaccess";  
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
        <td>'.$row["intIdHistory"].'</td>
        <td>'.$row["intIdUser"].'</td>
        <td>'.$row["dateDateAccesso"].'</td> 
        <td>'.$row["nvchIpAccesso"].'</td>
        <td>'.$row["nvchBrowser"].'</td>
    </tr>
    ';  
    }
    //$output .= '</tbody>';
    return $output;  
}  

echo users_data2();

 ?>