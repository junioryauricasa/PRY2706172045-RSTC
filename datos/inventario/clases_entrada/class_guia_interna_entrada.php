<?php
require_once '../conexion/bd_conexion.php';
require_once 'clases_entrada/class_formulario_entrada.php';
class GuiaInternaEntrada
{
	/* INICIO - Atributos de Guia Interna Entrada */
	private $intIdGuiaInternaEntrada;
	private $intIdOrdenCompra;
	private $intIdUsuario;
	private $dtmFechaCreacion;

	public function IdGuiaInternaEntrada($intIdGuiaInternaEntrada){ $this->intIdGuiaInternaEntrada = $intIdGuiaInternaEntrada; }
	public function IdOrdenCompra($intIdOrdenCompra){ $this->intIdOrdenCompra = $intIdOrdenCompra; }
	public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
	public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
	/* FIN - Atributos de Guia Interna Entrada */

  /* INICIO - Métodos de Guia Interna Entrada */
  public function InsertarGuiaInternaEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarGuiaInternaEntrada(@intIdGuiaInternaEntrada,
      	:intIdOrdenCompra,:intIdUsuario,:dtmFechaCreacion)');
      $sql_comando->execute(array(
      	':intIdOrdenCompra' => $this->intIdOrdenCompra,
        ':intIdUsuario' => $this->intIdUsuario,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdGuiaInternaEntrada as intIdGuiaInternaEntrada");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdGuiaInternaEntrada'] = $salida->intIdGuiaInternaEntrada;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarGuiaInternaEntrada($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarGuiaInternaEntrada(:intIdGuiaInternaEntrada)');
      $sql_comando -> execute(array(':intIdGuiaInternaEntrada' => $this->intIdGuiaInternaEntrada));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioGuiaInternaEntrada = new FormularioGuiaInternaEntrada();
      $FormularioGuiaInternaEntrada->IdGuiaInternaEntrada($fila['intIdGuiaInternaEntrada']);
      $FormularioGuiaInternaEntrada->IdUsuario($fila['intIdUsuario']);
      $FormularioGuiaInternaEntrada->IdOrdenCompra($fila['intIdOrdenCompra']);
      $FormularioGuiaInternaEntrada->NombreUsuario($fila['NombreUsuario']);
      $FormularioGuiaInternaEntrada->NombreProveedor($fila['NombreProveedor']);
      $FormularioGuiaInternaEntrada->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarGuiaInternaEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ActualizarGuiaInternaEntrada(:intIdGuiaInternaEntrada,:intIdUsuario,
      	:dtmFechaCreacion)');
      $sql_comando->execute(array(
        ':intIdGuiaInternaEntrada' => $this->intIdGuiaInternaEntrada,
        ':intIdOrdenCompra' => $this->intIdOrdenCompra,
        ':intIdUsuario' => $this->intIdUsuario,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion));
      $_SESSION['intIdGuiaInternaEntrada'] = $this->intIdGuiaInternaEntrada;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarGuiaInternaEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL EliminarGuiaInternaEntrada(:intIdGuiaInternaEntrada)');
      $sql_comando -> execute(array(':intIdGuiaInternaEntrada' => $this->intIdGuiaInternaEntrada));
      $_SESSION['intIdGuiaInternaEntrada'] = $this->intIdGuiaInternaEntrada;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarGuiaInternaEntrada($busqueda,$x,$y,$tipolistado)
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
        $sql_comando = $sql_conectar->prepare('CALL buscarGuiaInternaEntrada_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarGuiaInternaEntrada_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Proveedor por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarGuiaInternaEntrada(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdGuiaInternaEntrada"] == $_SESSION['intIdGuiaInternaEntrada'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo
        '<td>'.$fila["intIdGuiaInternaEntrada"].'</td>
        <td>'.$fila["NombreProveedor"].'</td>
        <td>'.$fila["NombreUsuario"].'</td>
        <td>'.$fila["dtmFechaCreacion"].'</td>
        <td> 
          <button type="submit" id="'.$fila["intIdGuiaInternaEntrada"].'" class="btn btn-xs btn-warning btn-mostrar-guiainternaentrada">
            <i class="fa fa-edit"></i> Ver Detalle
          </button>
          <button type="submit" id="'.$fila["intIdGuiaInternaEntrada"].'" class="btn btn-xs btn-danger btn-eliminar-guiainternaentrada">
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

  public function PaginarGuiaInternaEntrada($busqueda,$x,$y,$tipolistado)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarGuiaInternaEntrada_ii(:busqueda)');
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

  public function ListarOrdenCompra($busqueda,$x,$y)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL BUSCARORDENCOMPRA(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo 
        '<tr>
        <td>'.$fila['intIdOrdenCompra'].'</td>
        <td>'.$fila['NombreUsuario'].'</td>
        <td>'.$fila['NombreProveedor'].'</td>
        <td>'.$fila['dtmFechaCreacion'].'</td>
        <td> 
          <button type="button" idoc="'.$fila['intIdOrdenCompra'].'" class="btn btn-xs btn-warning" onclick="SeleccionarOrdenCompra(this)">
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

  public function PaginarOrdenCompra($busqueda,$x,$y)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL BUSCARORDENCOMPRA_II(:busqueda)');
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
                <a idpoc="'.($x-1).'" class="page-link" aria-label="Previous" onclick="PaginacionOrdenesCompra(this)">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

          if($x==$i){
            $output.=  '<li class="page-item active"><a idpoc="'.$i.'" class="page-link" onclick="PaginacionOrdenesCompra(this)">'.($i+1).'</a></li>';
          }
          else
          {
            $output.=  '<li class="page-item"><a idpoc="'.$i.'" class="page-link" onclick="PaginacionOrdenesCompra(this)">'.($i+1).'</a></li>';
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
                <a idpoc="'.($x+1).'" class="page-link" aria-label="Next" onclick="PaginacionOrdenesCompra(this)">
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
    catch(PDPException $e){
      echo $e->getMessage();
    }  
  }

  public function SeleccionarOrdenCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MOSTRARDETALLEORDENCOMPRA(:intIdOrdenCompra)');
      $sql_comando -> execute(array(':intIdOrdenCompra' => $this->intIdOrdenCompra));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo 
        '<tr>
        <td>'.$fila['intIdOperacionOrdenCompra'].'</td>
        <td><input type="hidden" name="SnvchNombre['.$fila['intIdOperacionOrdenCompra'].']" value="'.$fila['nvchNombre'].'"/>'.$fila['nvchNombre'].'</td>
        <td><input type="hidden" name="SnvchDescripcion['.$fila['intIdOperacionOrdenCompra'].']" value="'.$fila['nvchDescripcion'].'"/>'.$fila['nvchDescripcion'].'</td>
        <td><input type="hidden" name="SintCantidadO['.$fila['intIdOperacionOrdenCompra'].']" value="'.$fila['intCantidad'].'"/>'.$fila['intCantidad'].'</td>
        <td><input type="text" name="SintCantidad['.$fila['intIdOperacionOrdenCompra'].']" class="form-control select2" placeholder="Ingrese Cantidad"></td>
        <td> 
          <button type="button" idooc="'.$fila['intIdOperacionOrdenCompra'].'" class="btn btn-xs btn-warning" onclick="AgregarDetalleGuiaInternaEntrada(this)">
            <i class="fa fa-edit"></i> Ingresar
          </button>
        </td>
        </tr>';
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
	/* FIN - Métodos de Guia Interna Entrada */
}
?>