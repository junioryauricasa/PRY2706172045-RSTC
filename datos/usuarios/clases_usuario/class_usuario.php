<?php
require_once '../conexion/bd_conexion.php';
require_once 'class_formulario_usuario.php';
class Usuario
{
  /* INICIO - Atributos de Usuario*/
  private $intIdUsuario;
  private $nvchDNI;
  private $nvchRUC;
  private $nvchApellidoPaterno;
  private $nvchApellidoMaterno;
  private $nvchNombres;
  private $nvchGenero;
  private $nvchUserName;
  private $nvchUserPassword;
  private $intIdTipoUsuario;
  private $nvchImgPerfil;
  private $bitUserEstado;
  private $nvchPais;
  private $nvchRegion;
  private $nvchProvincia;
  private $nvchDistrito;
  private $nvchDireccion;
  private $nvchObservacion;
  
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function DNI($nvchDNI){ $this->nvchDNI = $nvchDNI; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function ApellidoPaterno($nvchApellidoPaterno){ $this->nvchApellidoPaterno = $nvchApellidoPaterno; }
  public function ApellidoMaterno($nvchApellidoMaterno){ $this->nvchApellidoMaterno = $nvchApellidoMaterno; }
  public function Nombres($nvchNombres){ $this->nvchNombres = $nvchNombres; }
  public function Genero($nvchGenero){ $this->nvchGenero = $nvchGenero; }
  public function UserName($nvchUserName){ $this->nvchUserName = $nvchUserName; }
  public function UserPassword($nvchUserPassword){ $this->nvchUserPassword = $nvchUserPassword; }
  public function IdTipoUsuario($intIdTipoUsuario){ $this->intIdTipoUsuario = $intIdTipoUsuario; }
  public function ImgPerfil($nvchImgPerfil){$this->nvchImgPerfil = $nvchImgPerfil; }
  public function UserEstado($bitUserEstado){ $this->bitUserEstado = $bitUserEstado; }
  public function Pais($nvchPais){ $this->nvchPais = $nvchPais; }
  public function Region($nvchRegion){ $this->nvchRegion = $nvchRegion; }
  public function Provincia($nvchProvincia){ $this->nvchProvincia = $nvchProvincia; }
  public function Distrito($nvchDistrito){ $this->nvchDistrito = $nvchDistrito; }
  public function Direccion($nvchDireccion){ $this->nvchDireccion = $nvchDireccion; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
  /* FIN - Atributos de Usuario */

  /* INICIO - Métodos de Usuario */
  public function InsertarUsuario()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('
      		CALL insertarusuario(@intIdUsuario,:nvchDNI,:nvchRUC,:nvchApellidoPaterno,:nvchApellidoMaterno,
          :nvchNombres,:nvchGenero,:nvchUserName,:nvchUserPassword,
          :intIdTipoUsuario,:nvchImgPerfil,:bitUserEstado,:nvchPais,:nvchRegion,:nvchProvincia,
        :nvchDistrito,:nvchDireccion,:nvchObservacion)');
      $sql_comando->execute(array(
        ':nvchDNI' => $this->nvchDNI,
        ':nvchRUC' => $this->nvchRUC,
        ':nvchApellidoPaterno' => $this->nvchApellidoPaterno,
        ':nvchApellidoMaterno' => $this->nvchApellidoMaterno,
        ':nvchNombres' => $this->nvchNombres,
        ':nvchGenero' => $this->nvchGenero,
      	':nvchUserName' => $this->nvchUserName, 
        ':nvchUserPassword' => hash('sha256', $this->nvchUserPassword),
        ':intIdTipoUsuario' => $this->intIdTipoUsuario,
        ':nvchImgPerfil' => $this->nvchImgPerfil,
        ':bitUserEstado' => $this->bitUserEstado,
        ':nvchPais' => $this->nvchPais,
        ':nvchRegion' => $this->nvchRegion,
        ':nvchProvincia' => $this->nvchProvincia,
        ':nvchDistrito' => $this->nvchDistrito,
        ':nvchDireccion' => $this->nvchDireccion,
        ':nvchObservacion' => $this->nvchObservacion));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdUsuario as intIdUsuario");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdUsuario'] = $salida->intIdUsuario;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function MostrarUsuario($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarusuario(:intIdUsuario)');
      $sql_comando -> execute(array(':intIdUsuario' => $this->intIdUsuario));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioUsuario = new FormularioUsuario();
      $FormularioUsuario->IdUsuario($fila['intIdUsuario']);
      $FormularioUsuario->DNI($fila['nvchDNI']);
      $FormularioUsuario->RUC($fila['nvchRUC']);
      $FormularioUsuario->ApellidoPaterno($fila['nvchApellidoPaterno']);
      $FormularioUsuario->ApellidoMaterno($fila['nvchApellidoMaterno']);
      $FormularioUsuario->Nombres($fila['nvchNombres']);
      $FormularioUsuario->Genero($fila['nvchGenero']);
      $FormularioUsuario->UserName($fila['nvchUserName']);
      $FormularioUsuario->IdTipoUsuario($fila['intIdTipoUsuario']);
      $FormularioUsuario->ImgPerfil($fila['nvchImgPerfil']);
      $FormularioUsuario->UserEstado($fila['bitUserEstado']);
      $FormularioUsuario->Pais($fila['nvchPais']);
      $FormularioUsuario->Region($fila['nvchRegion']);
      $FormularioUsuario->Provincia($fila['nvchProvincia']);
      $FormularioUsuario->Distrito($fila['nvchDistrito']);
      $FormularioUsuario->Direccion($fila['nvchDireccion']);
      $FormularioUsuario->Observacion($fila['nvchObservacion']);
      $FormularioUsuario->ConsultarFormulario($funcion);
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
      $sql_comando = $sql_conectar->prepare('CALL actualizarusuario(:intIdUsuario,:nvchDNI,:nvchRUC,:nvchApellidoPaterno,
        :nvchApellidoMaterno,:nvchNombres,:nvchGenero,:nvchUserName,:intIdTipoUsuario,:nvchImgPerfil,:bitUserEstado,
        :nvchPais,:nvchRegion,:nvchProvincia,:nvchDistrito,:nvchDireccion,:nvchObservacion)');
      $sql_comando->execute(array(
      	':intIdUsuario' => $this->intIdUsuario,
        ':nvchDNI' => $this->nvchDNI,
        ':nvchRUC' => $this->nvchRUC,
        ':nvchApellidoPaterno' => $this->nvchApellidoPaterno,
        ':nvchApellidoMaterno' => $this->nvchApellidoMaterno,
        ':nvchNombres' => $this->nvchNombres,
        ':nvchGenero' => $this->nvchGenero,
        ':nvchUserName' => $this->nvchUserName, 
        ':intIdTipoUsuario' => $this->intIdTipoUsuario,
        ':nvchImgPerfil' => $this->nvchImgPerfil,
        ':bitUserEstado' => $this->bitUserEstado,
        ':nvchPais' => $this->nvchPais,
        ':nvchRegion' => $this->nvchRegion,
        ':nvchProvincia' => $this->nvchProvincia,
        ':nvchDistrito' => $this->nvchDistrito,
        ':nvchDireccion' => $this->nvchDireccion,
        ':nvchObservacion' => $this->nvchObservacion));
      $_SESSION['intIdUsuario'] = $this->intIdUsuario;
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
      $sql_comando = $sql_conectar->prepare('CALL eliminarusuario(:intIdUsuario)');
      $sql_comando -> execute(array(':intIdUsuario' => $this->intIdUsuario));
      $_SESSION['intIdUsuario'] = $this->intIdUsuario;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarUsuarios($busqueda,$x,$y,$tipolistado)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de Usuario por el comando LIMIT
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
      //Busqueda de Usuario por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarusuario(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      { 
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdUsuario"] == $_SESSION['intIdUsuario'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }

		    if($fila["bitUserEstado"] == 0){
        	$fila["bitUserEstado"] = '<span class="label label-danger">Inhabilitado</span>';
        } else if ($fila["bitUserEstado"] == 1){
			     $fila["bitUserEstado"] = '<span class="label label-success">Habilitado</span>';
        }
        echo '
          <td>'.$fila["nvchDNI"].'</td>
          <td>'.$fila["NombresApellidos"].'</td>
	        <td>'.$fila["nvchUserName"].'</td>
	        <td>'.$fila["NombreTipoUsuario"].'</td>
	        <td>'.$fila["bitUserEstado"].'</td>
	        <td> 
	          <button type="submit" id="'.$fila["intIdUsuario"].'" class="btn btn-xs btn-warning btn-mostrar-usuario">
	            <i class="fa fa-edit"></i> Editar
	          </button>
	          <button type="submit" id="'.$fila["intIdUsuario"].'" class="btn btn-xs btn-danger btn-eliminar-usuario">
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
  	  //$sql_comando = $sql_conectar->prepare('CALL buscarUsuario_ii(:busqueda)');
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
          //$output = 'No se encontro nada';
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
  /* FIN - Métodos de Usuario */
}