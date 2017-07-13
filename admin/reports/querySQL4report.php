<?php 

//include ('../dbconnect.php');

/*
  ------------------------------
  Autor: Junior Yauricasa
  Fecha: 12-07-2017
  Descripcion: 
    1.- Creacion de funciones para uso de reportes y tables.
    2.- Declaracion de variables de connecion para mysql

  NOTA: Colocar toda consulta aqui e invocar desde donde corresponda
  ------------------------------
*/


//Consulta usurios REPORTE 
 function users_data()  
 {  
      $output = '';  
      $con = mysqli_connect("localhost", "root", "", "db_resteco");  
      $sql = "SELECT * FROM tb_user";  
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
           $row["bitUserEstado"] = 'Deshabilitado'; 
        }else
        if($row["bitUserEstado"] == 1){
           $row["bitUserEstado"] = 'Habilitado'; 
        }


      $output .= '
      <tr>  
          <td>USR'.$row["intUserId"].'</td>  
          <td>'.$row["nvchUserName"].'</td>  
          <td>'.$row["nchUserMail"].'</td>  
          <td>'.$row["intTypeUser"].'</td>  
          <td>'.$row["bitUserEstado"].'</td>  
      </tr>  
      ';  
      }  
      return $output;  
 }  

//Consulta usuarios TABLA
 function users_data2()  
 {  
      $output = '';  
      $con = mysqli_connect("localhost", "root", "", "db_resteco");  
      $sql = "SELECT * FROM tb_user";  
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
           $row["bitUserEstado"] = 'Deshabilitado'; 
        }else
        if($row["bitUserEstado"] == 1){
           $row["bitUserEstado"] = 'Habilitado'; 
        }


      $output .= '
      <tr>  
          <td>USR'.$row["intUserId"].'</td>  
          <td>'.$row["nvchUserName"].'</td>  
          <td>'.$row["nchUserMail"].'</td>  
          <td>'.$row["intTypeUser"].'</td>  
          <td>'.$row["bitUserEstado"].'</td>  
          <td> editar /eliminar /actualizar</td>  
      </tr>  
      ';  
      }  
      return $output;  
 }  


 ?>