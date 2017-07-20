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
            <button type="submit" id_cust="5" class="btn btn-xs btn-warning btnedit"><i class="fa fa-edit"></i></button>
            <button type="submit" id_cust="5" class="btn btn-xs btn-danger btnedit"><i class="fa fa-remove"></i></button>
          </td>  
      </tr>  
      ';  
      }  
      return $output;  
 }  

//Consulta historial de acceso TABLA
 function users_HistoryAccess()  
 {  
      $output = '';  
      $con = mysqli_connect("localhost", "root", "", "db_resteco");  
      $sql = "
        SELECT 
          intIdHistory,
          nvchUserName,
          nchUserMail,
          intTypeUser,
          bitUserEstado,
          nvchBrowser,
          nvchIpAccesso,
          dateDateAccesso 
        FROM 
          tb_historyaccess
        inner join tb_usuario
        WHERE tb_usuario.intUserId = tb_historyaccess.intIdUser
      ";  
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
          <td>HSTACC'.$row["intIdHistory"].'</td>  
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
            '.$row["dateDateAccesso"].'
          </td>  
          <td>
              '.$row["nvchBrowser"].'
          </td> 
          <td>
              '.$row["nvchIpAccesso"].'
          </td>
      </tr>  
      ';  
      }  
      return $output;  
 } 

//Consulta historial de acceso TABLA
 function users_HistoryAccessAll4Report()  
 {  
      $output = '';  
      $con = mysqli_connect("localhost", "root", "", "db_resteco");  
      $sql = "
        SELECT 
          intIdHistory,
          nvchUserName,
          nchUserMail,
          intTypeUser,
          bitUserEstado,
          nvchBrowser,
          nvchIpAccesso,
          dateDateAccesso 
        FROM 
          `tb_historyaccess`
        inner join tb_usuario
        WHERE tb_usuario.intUserId = tb_historyaccess.intIdUser 
        ORDER BY `tb_historyaccess`.`intIdHistory` DESC
      ";  
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
          <td>HSTACC'.$row["intIdHistory"].'</td>  
          <td>'.$row["nvchUserName"].' / '.$row["nchUserMail"].'</td>
          <td>'.$row["intTypeUser"].'</td>  
          <td>'.$row["bitUserEstado"].'</td> 
          <td>'.$row["dateDateAccesso"].'</td>  
          <td>'.$row["nvchBrowser"].'</td> 
          <td>'.$row["nvchIpAccesso"].'</td>
      </tr>  
      ';  
      }  
      return $output;  
 } 