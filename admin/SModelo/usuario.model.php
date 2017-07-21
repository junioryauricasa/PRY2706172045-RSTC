<?php
class UsuarioModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=db_resteco', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tb_usuario");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$per = new Usuario();
			
				$per->__SET('intUserId', $r->intUserId);
				$per->__SET('nvchUserName', $r->nvchUserName);
				$per->__SET('nchUserMail', $r->nchUserMail);
				$per->__SET('nvchUserPassword', $r->nvchUserPassword);
				$per->__SET('intIdEmpleado', $r->intIdEmpleado);
				$per->__SET('intTypeUser', $r->intTypeUser);
				$per->__SET('bitUserEstado', $r->bitUserEstado);
				
				$result[] = $per;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM tb_usuario WHERE intUserId = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$per = new Usuario();

			$per->__SET('intUserId', $r->intUserId);
			$per->__SET('nvchUserName', $r->nvchUserName);
			$per->__SET('nchUserMail', $r->nchUserMail);
			$per->__SET('nvchUserPassword', $r->nvchUserPassword);
			$per->__SET('intIdEmpleado', $r->intIdEmpleado);
			$per->__SET('intTypeUser', $r->intTypeUser);
			$per->__SET('bitUserEstado', $r->bitUserEstado);

			return $per;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM tb_usuario WHERE intUserId = ?");
			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Usuario $data)
	{
		try 
		{
			$sql = "UPDATE tb_usuario SET 
						nvchUserName = ?,
						nchUserMail  = ?,
						nvchUserPassword  = ?, 
						intIdEmpleado  = ?, 
						intTypeUser  = ?, 
						bitUserEstado  = ?  
				    WHERE intUserId = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nvchUserName'), 
					$data->__GET('nchUserMail'), 
					$data->__GET('nvchUserPassword'),
					$data->__GET('intIdEmpleado'),
					$data->__GET('intTypeUser'),
					$data->__GET('bitUserEstado'),

					$data->__GET('intUserId')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Usuario $data)
	{
		try 
		{
		$sql = "INSERT INTO tb_usuario (nvchUserName,nchUserMail,nvchUserPassword,intIdEmpleado,intTypeUser,bitUserEstado) VALUES (?, ?, ?, ?, ?, ?)";

		//$sql = "INSERT INTO tb_usuario (nvchUserName,nchUserMail) VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nvchUserName'), 
				$data->__GET('nchUserMail'),
				$data->__GET('nvchUserPassword'),
				$data->__GET('intIdEmpleado'),
				$data->__GET('intTypeUser'),
				$data->__GET('bitUserEstado')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}


//TABLAS ADICIONALES
//Consulta usuarios TABLA
 function USERS_TABLE()  
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
            <a href="?action=editar&intUserId='.$row['intUserId'].'" class="btn btn-xs btn-warning btnedit" data-toggle="tooltip" title="Actualizar Registro"><span class="glyphicon glyphicon-pencil"></span></a>

            <a onclick="return confirm("Seguro deseas eliminar este registro?");" href="?action=eliminar&intUserId='.$row['intUserId'].'" class="btn btn-xs btn-danger btnedit" data-toggle="tooltip" title="Eliminar Registro"><span class="glyphicon glyphicon-trash"></span></a>
          </td>  
      </tr>  
      ';  
      }  
      return $output;  
 }  