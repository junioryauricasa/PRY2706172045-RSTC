<?php 
require_once '../conexion/bd_conexion.php';
require_once 'clases_venta/class_formulario_venta.php';
class Venta{
  /* INICIO - Atributos de Orden Compra*/
  private $intIdVenta;
  private $nvchNumFactura;
  private $nvchNumBoletaVenta;
  private $intIdUsuario;
  private $intIdCliente;
  private $dtmFechaCreacion;
  private $intIdTipoComprobante;
  
  public function IdVenta($intIdVenta){ $this->intIdVenta = $intIdVenta; }
  public function NumFactura($nvchNumFactura){ $this->nvchNumFactura = $nvchNumFactura; }
  public function NumBoletaVenta($nvchNumBoletaVenta){ $this->nvchNumBoletaVenta = $nvchNumBoletaVenta; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function IdTipoComprobante($intIdTipoComprobante){ $this->intIdTipoComprobante = $intIdTipoComprobante; }
  /* FIN - Atributos de Orden Compra */

  /* INICIO - Métodos de Orden Compra */
  public function InsertarVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarVenta(@intIdVenta,:nvchNumFactura,
        :nvchNumBoletaVenta,:intIdUsuario,:intIdCliente,:dtmFechaCreacion,:intIdTipoComprobante)');
      $sql_comando->execute(array(
        ':nvchNumFactura' => $this->nvchNumFactura,
        ':nvchNumBoletaVenta' => $this->nvchNumBoletaVenta,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdCliente' => $this->intIdCliente,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':intIdTipoComprobante' => $this->intIdTipoComprobante));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdVenta as intIdVenta");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdVenta'] = $salida->intIdVenta;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarVenta($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarVenta(:intIdVenta)');
      $sql_comando -> execute(array(':intIdVenta' => $this->intIdVenta));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $FormularioVenta = new FormularioVenta();
      $FormularioVenta->IdVenta($fila['intIdVenta']);
      $FormularioVenta->NumFactura($fila['nvchNumFactura']);
      $FormularioVenta->NumBoletaVenta($fila['nvchNumBoletaVenta']);
      $FormularioVenta->IdUsuario($fila['intIdUsuario']);
      $FormularioVenta->IdCliente($fila['intIdCliente']);
      $FormularioVenta->NombreUsuario($fila['NombreUsuario']);
      $FormularioVenta->NombreCliente($fila['NombreCliente']);
      $FormularioVenta->FechaCreacion($fila['dtmFechaCreacion']);
      $FormularioVenta->IdTipoComprobante($fila['intIdTipoComprobante']);
      $FormularioVenta->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ListarClienteVenta($busqueda,$x,$y)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ListarClienteVenta(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo 
        '<tr>
        <td>'.$fila['IdentificadorCliente'].'</td>
        <td>'.$fila['NombreCliente'].'</td>';
        if($fila['intIdTipoPersona'] == 1){
          echo '<td>Persona Jurídica</td>';
        } else if($fila['intIdTipoPersona'] == 2){
          echo '<td>Persona Natural</td>';
        }
        if($fila['intIdTipoCliente'] == 1){
          echo '<td>Cliente Final</td>';
        } else if($fila['intIdTipoCliente'] == 2){
          echo '<td>Cliente Revendedor</td>';
        }
        echo 
        '<td> 
          <button type="button" idscli="'.$fila['intIdCliente'].'" class="btn btn-xs btn-warning" onclick="SeleccionarCliente(this)">
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

  public function SeleccionarClienteVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarCliente(:intIdCliente)');
      $sql_comando -> execute(array(':intIdCliente' => $this->intIdCliente));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $salida['intIdCliente'] = $fila['intIdCliente'];
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

  public function ActualizarVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL ActualizarVenta(:intIdVenta,:nvchNumFactura,
        :nvchNumBoletaVenta,:intIdUsuario,:intIdCliente,:dtmFechaCreacion,:intIdTipoComprobante)');
      $sql_comando->execute(array(
        ':intIdVenta' => $this->intIdVenta,
        ':nvchNumFactura' => $this->nvchNumFactura,
        ':nvchNumBoletaVenta' => $this->nvchNumBoletaVenta,
        ':intIdUsuario' => $this->intIdUsuario, 
        ':intIdCliente' => $this->intIdCliente,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':intIdTipoComprobante' => $this->intIdTipoComprobante));
      $_SESSION['intIdVenta'] = $this->intIdVenta;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarVenta()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL EliminarVenta(:intIdVenta)');
      $sql_comando -> execute(array(':intIdVenta' => $this->intIdVenta));
      $_SESSION['intIdVenta'] = $this->intIdVenta;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarVentas($busqueda,$x,$y,$tipolistado,$intIdTipoComprobante)
  {
    try{
      $salida = "";
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de Cliente por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarVenta_ii(:busqueda,:intIdTipoComprobante)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarVenta_ii(:busqueda,:intIdTipoComprobante)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Cliente por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarVenta(:busqueda,:x,:y,:intIdTipoComprobante)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y, ':intIdTipoComprobante' => $intIdTipoComprobante));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdVenta"] == $_SESSION['intIdVenta'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo
        '<td>'.$fila["intIdVenta"].'</td>
        <td>'.$fila["NombreCliente"].'</td>
        <td>'.$fila["NombreUsuario"].'</td>
        <td>'.$fila["dtmFechaCreacion"].'</td>
        <td> 
          <button type="submit" id="'.$fila["intIdVenta"].'" class="btn btn-xs btn-warning btn-mostrar-venta">
            <i class="fa fa-edit"></i> Ver Detalle
          </button>
          <button type="submit" id="'.$fila["intIdVenta"].'" class="btn btn-xs btn-danger btn-anular-venta">
            <i class="fa fa-trash"></i> Anular
          </button>
          <button type="submit" id="'.$fila["intIdVenta"].'" class="btn btn-xs btn-default btn-download-report">
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

  public function PaginarVentas($busqueda,$x,$y,$tipolistado,$intIdTipoComprobante)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarVenta_ii(:busqueda,:intIdTipoComprobante)');
      $sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante));
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

  public function PaginarClientesVenta($busqueda,$x,$y)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL PAGINARClienteVenta(:busqueda)');
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
                <a idprd="'.($x-1).'" class="page-link" aria-label="Previous" onclick="PaginacionClientes(this)">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

          if($x==$i){
            $output.=  '<li class="page-item active"><a idprd="'.$i.'" class="page-link" onclick="PaginacionClientes(this)">'.($i+1).'</a></li>';
          }
          else
          {
            $output.=  '<li class="page-item"><a idprd="'.$i.'" class="page-link" onclick="PaginacionClientes(this)">'.($i+1).'</a></li>';
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
                <a idprd="'.($x+1).'" class="page-link" aria-label="Next" onclick="PaginacionClientes(this)">
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