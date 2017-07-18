<?php 

//Consulta usuarios TABLA AJAX
function users_data2()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "db_resteco");  
    $sql = "SELECT * FROM tb_usuario";  
    //$result = mysqli_query($conn, $sql);  
    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       
      if($row["intTypeUser"] == 0){
        $row["intTypeUser"] = 'Usuario';
      }else
      if($row["intTypeUser"] == 1){
        $row["intTypeUser"] = 'Administrador';
      }

      if($row["bitUserEstado"] == 0){
         $row["bitUserEstado"] = '<span class="label label-danger">Deshabilitado</span>'; 
      }else
      if($row["bitUserEstado"] == 1){
         $row["bitUserEstado"] = '<span class="label label-success">Habilitado</span>'; 
      }


    $output .= '
    <tr>  
        <td>USR'.$row["intUserId"].'</td>  
        <td>'.$row["nvchUserName"].'</td>  
        <td>
          <a target="_blank" class="btn btn-xs btn-default btnedit" href="
            https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&source=mailto&su=Mensaje+Resteco&to=%3C'.$row["nchUserMail"].'%3E
          ">
          <span class="fa fa-envelope"></span> 
          '
            .$row["nchUserMail"].
          '</a>
        </td>
        <td>'.$row["intTypeUser"].'</td>  
        <td>
            '.$row["bitUserEstado"].'
        </td>  
        <td> 
          <button type="submit" onclick="showUser(this.'.$row["intUserId"].')" id_cust="5" class="btn btn-xs btn-warning btnedit">
            <i class="fa fa-edit"></i> Editar
          </button>

          <a href="ajax/deleteUser4id.php?q='.$row["intUserId"].'" class="btn btn-xs btn-danger btnedit">
              <i class="fa fa-remove"></i> Eliminar
          </a>

          <input type="submit" class="btn btn-xs btn-info btnedit" onclick="pregunta('.$row["intUserId"].');" value="Eliminar">
        </td>  
    </tr>  
    ';  
    }  
    return $output;  
}  

echo users_data2();

 ?>



 <script>
   function pregunta($iduser){ 
    if (confirm('¿Estas seguro de eliminar el registro USR'+$iduser+'?')){ 
           window.location="ajax/deleteUser4id.php?q="+$iduser+"";
        } 
    } 
 </script>