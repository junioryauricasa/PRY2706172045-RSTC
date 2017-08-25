<?php 
require_once '../conexion/bd_conexion.php';
require_once 'clases_ordencompra/class_formulario_ordencompra.php';
class OrdenCompra{
  /* INICIO - Atributos de Orden Compra*/
  private $intIdOrdenCompra;
  private $intIdUsuario;
  private $intIdProveedor;
  private $dtmFechaCreacion;
  
  public function IdOrdenCompra($intIdOrdenCompra){ $this->intIdOrdenCompra = $intIdOrdenCompra; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdProveedor($intIdProveedor){ $this->intIdProveedor = $intIdProveedor; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  /* FIN - Atributos de Orden Compra */

  /* INICIO - Métodos de Orden Compra */
  public function InsertarOrdenCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarOrdenCompra(@intIdOrdenCompra,:intIdUsuario,
      	:intIdProveedor,:dtmFechaCreacion)');
      $sql_comando->execute(array(
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdProveedor' => $this->intIdProveedor,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdOrdenCompra as intIdOrdenCompra");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdOrdenCompra'] = $salida->intIdOrdenCompra;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarOrdenCompra($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarOrdenCompra(:intIdOrdenCompra)');
      $sql_comando -> execute(array(':intIdOrdenCompra' => $this->intIdOrdenCompra));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioOrdenCompra = new FormularioOrdenCompra();
      $FormularioOrdenCompra->IdOrdenCompra($fila['intIdOrdenCompra']);
      $FormularioOrdenCompra->IdUsuario($fila['intIdUsuario']);
      $FormularioOrdenCompra->IdProveedor($fila['intIdProveedor']);
      $FormularioOrdenCompra->NombreUsuario($fila['NombreUsuario']);
      $FormularioOrdenCompra->NombreProveedor($fila['NombreProveedor']);
      $FormularioOrdenCompra->FechaCreacion($fila['dtmFechaCreacion']);
      $FormularioOrdenCompra->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ListarProveedorOrdenCompra($busqueda,$x,$y)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ListarProveedorOrdenCompra(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo 
        '<tr>
        <td>'.$fila['IdentificadorProveedor'].'</td>
        <td>'.$fila['NombreProveedor'].'</td>';
        if($fila['intIdTipoPersona'] == 1){
          echo '<td>Persona Jurídica</td>';
        } else if($fila['intIdTipoPersona'] == 2){
          echo '<td>Persona Natural</td>';
        }
        echo 
        '<td> 
          <button type="button" idsprd="'.$fila['intIdProveedor'].'" class="btn btn-xs btn-warning" onclick="SeleccionarProveedor(this)">
            <i class="fa fa-edit"></i> Seleccionar
          </button>
        </td>
        </tr>';
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function SeleccionarProveedorOrdenCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarproveedor(:intIdProveedor)');
      $sql_comando -> execute(array(':intIdProveedor' => $this->intIdProveedor));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $salida['intIdProveedor'] = $fila['intIdProveedor'];
      $salida['nvchRUC'] = $fila['nvchRUC'];
      $salida['nvchDNI'] = $fila['nvchDNI'];
      $salida['nvchRazonSocial'] = $fila['nvchRazonSocial'];
      $salida['nvchApellidoPaterno'] = $fila['nvchApellidoPaterno'];
      $salida['nvchApellidoMaterno'] = $fila['nvchApellidoMaterno'];
      $salida['nvchNombres'] = $fila['nvchNombres'];
      $salida['intIdTipoPersona'] = $fila['intIdTipoPersona'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarOrdenCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ActualizarOrdenCompra(:intIdOrdenCompra,:intIdUsuario,
      	:intIdProveedor,:dtmFechaCreacion)');
      $sql_comando->execute(array(
        ':intIdOrdenCompra' => $this->intIdOrdenCompra,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdProveedor' => $this->intIdProveedor,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion));
      $_SESSION['intIdOrdenCompra'] = $this->intIdOrdenCompra;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarOrdenCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL EliminarOrdenCompra(:intIdOrdenCompra)');
      $sql_comando -> execute(array(':intIdOrdenCompra' => $this->intIdOrdenCompra));
      $_SESSION['intIdOrdenCompra'] = $this->intIdOrdenCompra;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarOrdenesCompra($busqueda,$x,$y,$tipolistado)
  {
    try{
      $salida = "";
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de Proveedor por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarordencompra_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarordencompra_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Proveedor por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarordencompra(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdOrdenCompra"] == $_SESSION['intIdOrdenCompra'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo
        '<td>'.$fila["intIdOrdenCompra"].'</td>
        <td>'.$fila["NombreProveedor"].'</td>
        <td>'.$fila["NombreUsuario"].'</td>
        <td>'.$fila["dtmFechaCreacion"].'</td>
        <td> 
          <button type="submit" id="'.$fila["intIdOrdenCompra"].'" class="btn btn-xs btn-warning btn-mostrar-ordencompra">
            <i class="fa fa-edit"></i> Ver Detalle
          </button>
          <button type="submit" id="'.$fila["intIdOrdenCompra"].'" class="btn btn-xs btn-danger btn-eliminar-ordencompra">
            <i class="fa fa-trash"></i> Eliminar
          </button>
          <button type="submit" id="'.$fila["intIdOrdenCompra"].'" class="btn btn-xs btn-default btn-download-report">
            <i class="fa fa-download"></i> Reporte
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

  public function PaginarOrdenesCompra($busqueda,$x,$y,$tipolistado)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarordencompra_ii(:busqueda)');
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

  public function PaginarProveedoresOrdenCompra($busqueda,$x,$y)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL PAGINARPROVEEDORORDENCOMPRA(:busqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda));
      $cantidad = $sql_comando -> rowCount();
      $numpaginas = ceil($cantidad / $y);
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
                <a idprd="'.($x-1).'" class="page-link" aria-label="Previous" onclick="PaginacionProveedores(this)">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

          if($x==$i){
            $output.=  '<li class="page-item active"><a idprd="'.$i.'" class="page-link" onclick="PaginacionProveedores(this)">'.($i+1).'</a></li>';
          }
          else
          {
            $output.=  '<li class="page-item"><a idprd="'.$i.'" class="page-link" onclick="PaginacionProveedores(this)">'.($i+1).'</a></li>';
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
                <a idprd="'.($x+1).'" class="page-link" aria-label="Next" onclick="PaginacionProveedores(this)">
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
                <a class="page-link" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
        $output .= 
            '<li class="page-item">
                <a class="page-link" aria-label="Next">
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
  /* FIN - Métodos de Orden Compra */
}
?>