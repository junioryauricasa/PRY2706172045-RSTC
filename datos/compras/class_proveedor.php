<?php
session_start();
require_once '../conexion/bd_conexion.php';
require_once 'class_formulario_proveedor.php';
if(empty($_SESSION['intIdProveedor'])){
  $_SESSION['intIdProveedor'] = 0;
}
class Proveedor
{
  /* INICIO - Atributos de Proveedor*/
  private $intIdProveedor;
  private $nchDNI;
  private $nchRUC;
  private $nvchRazonSocial;
  private $nvchApellidoPaterno;
  private $nvchApellidoMaterno;
  private $nvchNombres;
  private $intIdTipoPersona;
  
  public function IdProveedor($intIdProveedor){ $this->intIdProveedor = $intIdProveedor; }
  public function DNI($nchDNI){ $this->nchDNI = $nchDNI; }
  public function RUC($nchRUC){ $this->nchRUC = $nchRUC; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function ApellidoPaterno($nvchApellidoPaterno){ $this->nvchApellidoPaterno = $nvchApellidoPaterno; }
  public function ApellidoMaterno($nvchApellidoMaterno){ $this->nvchApellidoMaterno = $nvchApellidoMaterno; }
  public function Nombres($nvchNombres){ $this->nvchNombres = $nvchNombres; }
  public function IdTipoPersona($intIdTipoPersona){ $this->intIdTipoPersona = $intIdTipoPersona; }
  /* FIN - Atributos de Proveedor */

  /* INICIO - Métodos de Proveedor */
  public function InsertarProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarProveedor(:nvchCodigoProveedor,
        :nvchCodigoInventario,:nvchNombre,:nvchDescripcion,:dcmPrecioCompra,:dcmPrecioVenta,
        :intCantidad,:nvchDescuento,:nvchDireccionImg,:nvchSucursal,:nvchGabinete,:nvchCajon,
        :dtmFechaIngreso)');
      $sql_comando->execute(array(
        ':nvchCodigoProveedor' => $this->nvchCodigoProveedor, 
        ':nvchCodigoInventario' => $this->nvchCodigoInventario,
        ':nvchNombre' => $this->nvchNombre,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':dcmPrecioCompra' => $this->dcmPrecioCompra,
        ':dcmPrecioVenta' => $this->dcmPrecioVenta,
        ':intCantidad' => $this->intCantidad,
        ':nvchDescuento' => $this->nvchDescuento,
        ':nvchDireccionImg' => $this->nvchDireccionImg,
        ':nvchSucursal' => $this->nvchSucursal,
        ':nvchGabinete' => $this->nvchGabinete,
        ':nvchCajon' => $this->nvchCajon,
        ':dtmFechaIngreso' => $this->dtmFechaIngreso));
      $_SESSION['intIdProveedor'] = $this->intIdProveedor;
      $_SESSION['RutaDefaultImg'] = "";
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarProveedor($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarProveedor(:intIdProveedor)');
      $sql_comando -> execute(array(':intIdProveedor' => $this->intIdProveedor));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $formularioProveedor = new FormularioProveedor();
      $formularioProveedor->IdProveedor($fila['intIdProveedor']);
      $formularioProveedor->CodigoProveedor($fila['nvchCodigoProveedor']);
      $formularioProveedor->CodigoInventario($fila['nvchCodigoInventario']);
      $formularioProveedor->Nombre($fila['nvchNombre']);
      $formularioProveedor->Descripcion($fila['nvchDescripcion']);
      $formularioProveedor->PrecioCompra($fila['dcmPrecioCompra']);
      $formularioProveedor->PrecioVenta($fila['dcmPrecioVenta']);
      $formularioProveedor->Cantidad($fila['intCantidad']);
      $formularioProveedor->Descuento($fila['nvchDescuento']);
      $formularioProveedor->DireccionImg($fila['nvchDireccionImg']);
      $formularioProveedor->Sucursal($fila['nvchSucursal']);
      $formularioProveedor->Gabinete($fila['nvchGabinete']);
      $formularioProveedor->Cajon($fila['nvchCajon']);
      $formularioProveedor->FechaIngreso($fila['dtmFechaIngreso']);
      $formularioProveedor->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarProveedor(:intIdProveedor,
        :nvchCodigoProveedor,:nvchCodigoInventario,:nvchNombre,:nvchDescripcion,:dcmPrecioCompra,
        :dcmPrecioVenta,:intCantidad,:nvchDescuento,:nvchDireccionImg,:nvchSucursal,:nvchGabinete,
        :nvchCajon,:dtmFechaIngreso)');
      $sql_comando->execute(array(
        ':intIdProveedor' => $this->intIdProveedor,
        ':nvchCodigoProveedor' => $this->nvchCodigoProveedor, 
        ':nvchCodigoInventario' => $this->nvchCodigoInventario,
        ':nvchNombre' => $this->nvchNombre,
        ':nvchDescripcion' => $this->nvchDescripcion,
        ':dcmPrecioCompra' => $this->dcmPrecioCompra,
        ':dcmPrecioVenta' => $this->dcmPrecioVenta,
        ':intCantidad' => $this->intCantidad,
        ':nvchDescuento' => $this->nvchDescuento,
        ':nvchDireccionImg' => $this->nvchDireccionImg,
        ':nvchSucursal' => $this->nvchSucursal,
        ':nvchGabinete' => $this->nvchGabinete,
        ':nvchCajon' => $this->nvchCajon,
        ':dtmFechaIngreso' => $this->dtmFechaIngreso));
      $_SESSION['intIdProveedor'] = $this->intIdProveedor;
      $_SESSION['RutaDefaultImg'] = "";
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarProveedor()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarProveedor(:intIdProveedor)');
      $sql_comando -> execute(array(':intIdProveedor' => $this->intIdProveedor));
      $_SESSION['intIdProveedor'] = $this->intIdProveedor;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarProveedors($busqueda,$x,$y,$tipolistado)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de Proveedor por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarProveedor_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarProveedor_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Proveedor por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarProveedor(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdProveedor"] == $_SESSION['intIdProveedor'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo 
        '<td>PRT'.$fila["intIdProveedor"].'</td>
        <td>'.$fila["nvchCodigoProveedor"].'</td>
        <td>'.$fila["nvchCodigoInventario"].'</td>
        <td>'.$fila["nvchNombre"].'</td>
        <td>'.$fila["nvchDescripcion"].'</td>
        <td>'.$fila["dcmPrecioCompra"].'</td>
        <td>'.$fila["dcmPrecioVenta"].'</td>
        <td>'.$fila["intCantidad"].'</td>
        <td>'.$fila["nvchDescuento"].'</td>
        <td>
          <img src="../../datos/inventario/imgProveedor/'.$fila["nvchDireccionImg"].'" height="50">
        </td>
        <td> 
          <button type="submit" id="'.$fila["intIdProveedor"].'" class="btn btn-xs btn-warning btn-mostrar-Proveedor">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="submit" id="'.$fila["intIdProveedor"].'" class="btn btn-xs btn-danger btn-eliminar-Proveedor">
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

  public function PaginarProveedors($busqueda,$x,$y,$tipolistado)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarProveedor_ii(:busqueda)');
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

  public function FiltrarImagen($file)
  {
    try{
      
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }
  /* FIN - Métodos de Proveedor */
}

switch($_POST['funcion']){
  case "I":
    $Proveedor = new Proveedor();
    $Proveedor->CodigoProveedor($_POST['nvchCodigoProveedor']);
    $Proveedor->CodigoInventario($_POST['nvchCodigoInventario']);
    $Proveedor->Nombre($_POST['nvchNombre']);
    $Proveedor->Descripcion($_POST['nvchDescripcion']);
    $Proveedor->PrecioCompra($_POST['dcmPrecioCompra']);
    $Proveedor->PrecioVenta($_POST['dcmPrecioVenta']);
    $Proveedor->Cantidad($_POST['intCantidad']);
    $Proveedor->Descuento($_POST['nvchDescuento']);
    $nvchDireccionImg = pathinfo($_POST['nvchDireccionImg'],PATHINFO_BASENAME);
    $Proveedor->DireccionImg($nvchDireccionImg);
    $Proveedor->Sucursal($_POST['nvchSucursal']);
    $Proveedor->Gabinete($_POST['nvchGabinete']);
    $Proveedor->Cajon($_POST['nvchCajon']);
    $dtmFechaIngreso = date("Y-m-d H:i:s");
    $Proveedor->FechaIngreso($dtmFechaIngreso);
    $Proveedor->InsertarProveedor();
    break;
  case "A":
    $Proveedor = new Proveedor();
    $Proveedor->IdProveedor($_POST['intIdProveedor']);
    $Proveedor->CodigoProveedor($_POST['nvchCodigoProveedor']);
    $Proveedor->CodigoInventario($_POST['nvchCodigoInventario']);
    $Proveedor->Nombre($_POST['nvchNombre']);
    $Proveedor->Descripcion($_POST['nvchDescripcion']);
    $Proveedor->PrecioCompra($_POST['dcmPrecioCompra']);
    $Proveedor->PrecioVenta($_POST['dcmPrecioVenta']);
    $Proveedor->Cantidad($_POST['intCantidad']);
    $Proveedor->Descuento($_POST['nvchDescuento']);
    $nvchDireccionImg = pathinfo($_POST['nvchDireccionImg'],PATHINFO_BASENAME);
    $Proveedor->DireccionImg($nvchDireccionImg);
    $Proveedor->Sucursal($_POST['nvchSucursal']);
    $Proveedor->Gabinete($_POST['nvchGabinete']);
    $Proveedor->Cajon($_POST['nvchCajon']);
    $Proveedor->FechaIngreso($_POST['dtmFechaIngreso']);
    $Proveedor->ActualizarProveedor();
    break;
  case "M":
    $Proveedor = new Proveedor();
    $Proveedor->IdProveedor($_POST['intIdProveedor']);
    $Proveedor->MostrarProveedor($_POST['funcion']);
    break;
  case "E":
    $Proveedor = new Proveedor();
    $Proveedor->IdProveedor($_POST['intIdProveedor']);
    $Proveedor->EliminarProveedor();
    break;
  case "L":
    $Proveedor = new Proveedor();
    $Proveedor->ListarProveedors($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "P":
    $Proveedor = new Proveedor();
    $Proveedor->PaginarProveedors($_POST['busqueda'],$_POST['x'],$_POST['y'],$_POST['tipolistado']);
    break;
  case "F":
    $formularioProveedor = new FormularioProveedor();
    $formularioProveedor->ConsultarFormulario($_POST['funcion']);
    break;
}
?>