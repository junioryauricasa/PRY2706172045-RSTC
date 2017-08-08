<?php
session_start();
require_once '../conexion/bd_conexion.php';
//$_SESSION['intIdProducto'] = 0;
$_SESSION['intUserId'] = 0;

class Usuario
{
  /* INICIO - Atributos de Producto*/
  private $intUserId;
  private $nvchUserName;
  private $nchUserMail;
  private $nvchUserPassword;
  private $intIdEmpleado;
  private $intTypeUser;
  private $bitUserEstado;
  
  public function intUserId($intUserId){ $this->intUserId = $intUserId; }
  public function nvchUserName($nvchUserName){ $this->nvchUserName = $nvchUserName; }
  public function dcmPrecio($nchUserMail){ $this->nchUserMail = $nchUserMail; }
  public function intCantidad($nvchUserPassword){ $this->nvchUserPassword = $nvchUserPassword; }
  public function intIdEmpleado($intIdEmpleado){ $this->intIdEmpleado = $intIdEmpleado; }
  public function intTypeUser($intTypeUser){ $this->intTypeUser = $intTypeUser; }
  public function bitUserEstado($bitUserEstado){ $this->bitUserEstado = $bitUserEstado; }
  /* FIN - Atributos de Producto */

  /* INICIO - Métodos de Producto */
  public function InsertarUsuario()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarusuario(:nvchNombre,:dcmPrecio,
        :intCantidad,:nvchDireccionImg,:nvchDescripcion)');
      $sql_comando->execute(array(':nvchNombre' => $this->nvchNombre, 
        ':dcmPrecio' => $this->dcmPrecio,
        ':intCantidad' => $this->intCantidad,
        ':nvchDireccionImg' => $this->nvchDireccionImg,
        ':nvchDescripcion' => $this->nvchDescripcion));
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function MostrarUsuario()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarusuario(:intUserId)');
      $sql_comando -> execute(array(':intUserId' => $this->intUserId));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      echo '
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Editar usuario</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-editar-usuario" method="POST">
          <div class="box-body">
            <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nvchUserName" class="form-control select2" placeholder="Ingrese nombre del usuario" value="'.$fila['nvchUserName'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Precio:</label>
                        <input type="text" name="nchUserMail" class="form-control select2" placeholder="Ingrese precio del usuario" value="'.$fila['nchUserMail'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="text" name="nvchUserPassword" class="form-control select2" placeholder="Ingrese cantidad del usuario" value="'.$fila['nvchUserPassword'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Imagen:</label>
                        <input type="text" name="intIdEmpleado" class="form-control select2" placeholder="Ingrese imagen del usuario" value="'.$fila['intIdEmpleado'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Tipo Usuario:</label>
                        <input type="text" name="intTypeUser" class="form-control select2" placeholder="Ingrese descripción del usuario" value="'.$fila['intTypeUser'].'">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Tipo Usuario:</label>
                        <input type="text" name="bitUserEstado" class="form-control select2" placeholder="Ingrese descripción del usuario" value="'.$fila['bitUserEstado'].'">
                      </div>
                    </div>
            </div>
          </div>
          <div class="box-footer clearfix">
              <input type="hidden" name="funcion" value="A" />
              <input type="hidden" name="intUserId" value="'.$fila['intUserId'].'" />
              <input type="submit" id="btn-editar-usuario" class="btn btn-sm btn-info btn-flat pull-left" value="Editar usuario">
              <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
          </div>              
        </form>
        <div id="resultadocrud"></div>
      </div>';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarUsuario()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarusuario(:intUserId,:nvchUserName,:nchUserMail,
        :nvchUserPassword,:intIdEmpleado,:intTypeUser,:bitUserEstado)');
      $sql_comando->execute(array(
      	':intUserId' => $this->intUserId,
        ':nvchUserName' => $this->nvchUserName, 
        ':nchUserMail' => $this->nchUserMail,
        ':nvchUserPassword' => $this->nvchUserPassword,
        ':intIdEmpleado' => $this->intIdEmpleado,
        ':intTypeUser' => $this->intTypeUser,
    	':bitUserEstado' => $this->bitUserEstado));
      $_SESSION['intUserId'] = $this->intUserId;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarUsuario()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarusuario(:intUserId)');
      $sql_comando -> execute(array(':intUserId' => $this->intUserId));
      $_SESSION['intUserId'] = $this->intUserId;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarUsuario($busqueda,$x,$y,$tipolistado)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de producto por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarusuario_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarusuario_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de producto por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarusuario(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intUserId"] == $_SESSION['intUserId'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo '
        <td>'.$fila["intUserId"].'</td>
        <td>'.$fila["nvchUserName"].'</td>
        <td>'.$fila["nchUserMail"].'</td> 
        <td>'.$fila["nvchUserPassword"].'</td>
        <td>'.$fila["intIdEmpleado"].'</td>
        <td>'.$fila["intTypeUser"].'</td>
        <td>'.$fila["bitUserEstado"].'</td>
        <td> 
          <button type="submit" id="'.$fila["intUserId"].'" class="btn btn-xs btn-warning btn-mostrar-usuario">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="submit" id="'.$fila["intUserId"].'" class="btn btn-xs btn-danger btn-eliminar-usuario">
            <i class="fa fa-edit"></i> Eliminar
          </button>
        </td>  
        </tr>';
        $i++;
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarUsuarios($busqueda,$x,$y,$tipolistado)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
	  //$sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda)');
	  $sql_comando = $sql_conectar->prepare('CALL buscarusuario_ii(:busqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda));
      $cantidad = $sql_comando -> rowCount();
      $numpaginas = ceil($cantidad / $y);
      if($tipolistado == "N" || $tipolistado == "D")
      { $x = $numpaginas - 1; }
      else if($tipolistado == "E")
      { $x = $x / $y; }
      $output = "";
      for($i = 0; $i < $numpaginas; $i++){
        if($i==0)
        {
          //$output = 'No s eencontraron nada';
          if($x==0)
          {
            $output .= 
            '<li class="page-item disabled">
                <a class="page-link" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          } else {
            $output .= 
            '<li class="page-item">
                <a idp="'.($x-1).'" class="page-link btn-pagina" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

          if($x==$i){
            $output.=  '<li class="page-item active"><a idp="'.$i.'" class="page-link btn-pagina marca">'.($i+1).'</a></li>';
          }
          else
          {
            $output.=  '<li class="page-item"><a idp="'.$i.'" class="page-link btn-pagina">'.($i+1).'</a></li>';
          }

        if($i==($numpaginas-1))
        {
          if($x==($numpaginas-1))
          {
            $output .= 
            '<li class="page-item disabled">
                <a class="page-link" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </li>';
          } else {
            $output .= 
            '<li class="page-item">
                <a idp="'.($x+1).'" class="page-link btn-pagina" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </li>';
          }
        }
      }
      if($output == ""){
        $output .= 
            '<li class="page-item">
                <a class="page-link btn-pagina" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
        $output .= 
            '<li class="page-item">
                <a class="page-link btn-pagina" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </li>';
      }
      echo $output;
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }
  /* FIN - Métodos de Producto */
}

switch($_POST['funcion']){
  case "I":
    $usuario = new Usuario();
    $usuario->nvchUserName($_POST['nvchUserName']);
    $usuario->nchUserMail($_POST['nchUserMail']);
    $usuario->nvchUserPassword($_POST['nvchUserPassword']);
    $usuario->intIdEmpleado($_POST['intIdEmpleado']);
    $usuario->intTypeUser($_POST['intTypeUser']);
    $usuario->bitUserEstado($_POST['bitUserEstado']);
    $usuario->InsertarUsuario();
    break;
  case "A":
    $usuario = new Usuario();
    $usuario->intUserId($_POST['intUserId']);
    $usuario->nvchUserName($_POST['nvchUserName']);
    $usuario->nchUserMail($_POST['dcmPrecnchUserMailio']);
    $usuario->nvchUserPassword($_POST['nvchUserPassword']);
    $usuario->intIdEmpleado($_POST['intIdEmpleado']);
    $usuario->intTypeUser($_POST['intTypeUser']);
    $usuario->bitUserEstado($_POST['bitUserEstado']);
    $usuario->ActualizarUsuario();
    break;
  case "M":
    $usuario = new Usuario();
    $usuario->intUserId($_POST['intUserId']);
    $usuario->MostrarUsuario();
    break;
  case "E":
    $usuario = new Usuario();
    $usuario->intUserId($_POST['intUserId']);
    $usuario->EliminarUsuario();
    break;
  case "L":
    $usuario = new Usuario();
    $usuario->ListarUsuarios($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $usuario = new Usuario();
    $usuario->PaginarUsuarios($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
}