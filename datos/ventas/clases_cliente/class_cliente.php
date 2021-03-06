<?php
require_once '../conexion/bd_conexion.php';
require_once 'class_formulario_cliente.php';
class Cliente
{
  /* INICIO - Atributos de Cliente*/
  private $intIdCliente;
  private $nvchDNI;
  private $nvchRUC;
  private $nvchRazonSocial;
  private $nvchApellidoPaterno;
  private $nvchApellidoMaterno;
  private $nvchNombres;
  private $intIdTipoPersona;
  private $intIdTipoCliente;
  private $dtmFechaNacimiento;
  private $nvchGustos;
  private $nvchObservacion;
  
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function DNI($nvchDNI){ $this->nvchDNI = $nvchDNI; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function ApellidoPaterno($nvchApellidoPaterno){ $this->nvchApellidoPaterno = $nvchApellidoPaterno; }
  public function ApellidoMaterno($nvchApellidoMaterno){ $this->nvchApellidoMaterno = $nvchApellidoMaterno; }
  public function Nombres($nvchNombres){ $this->nvchNombres = $nvchNombres; }
  public function IdTipoPersona($intIdTipoPersona){ $this->intIdTipoPersona = $intIdTipoPersona; }
  public function IdTipoCliente($intIdTipoCliente){ $this->intIdTipoCliente = $intIdTipoCliente; }
  public function FechaNacimiento($dtmFechaNacimiento){ $this->dtmFechaNacimiento = $dtmFechaNacimiento; }
  public function Gustos($nvchGustos){ $this->nvchGustos = $nvchGustos; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
  /* FIN - Atributos de Cliente */

  /* INICIO - Métodos de Cliente */
  public function InsertarCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarCliente(@intIdCliente,:nvchDNI,:nvchRUC,:nvchRazonSocial,
      	:nvchApellidoPaterno,:nvchApellidoMaterno,:nvchNombres,:intIdTipoPersona,:intIdTipoCliente,:dtmFechaNacimiento,:nvchGustos,
        :nvchObservacion)');
      $sql_comando->execute(array(
        ':nvchDNI' => $this->nvchDNI, 
        ':nvchRUC' => $this->nvchRUC,
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':nvchApellidoPaterno' => $this->nvchApellidoPaterno,
        ':nvchApellidoMaterno' => $this->nvchApellidoMaterno,
        ':nvchNombres' => $this->nvchNombres,
        ':intIdTipoPersona' => $this->intIdTipoPersona,
        ':intIdTipoCliente' => $this->intIdTipoCliente,
        ':dtmFechaNacimiento' => $this->dtmFechaNacimiento,
        ':nvchGustos' => $this->nvchGustos,
        ':nvchObservacion' => $this->nvchObservacion));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdCliente as intIdCliente");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdCliente'] = $salida->intIdCliente;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarCliente($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarCliente(:intIdCliente)');
      $sql_comando -> execute(array(':intIdCliente' => $this->intIdCliente));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $formularioCliente = new FormularioCliente();
      $formularioCliente->IdCliente($fila['intIdCliente']);
      $formularioCliente->DNI($fila['nvchDNI']);
      $formularioCliente->RUC($fila['nvchRUC']);
      $formularioCliente->RazonSocial($fila['nvchRazonSocial']);
      $formularioCliente->ApellidoPaterno($fila['nvchApellidoPaterno']);
      $formularioCliente->ApellidoMaterno($fila['nvchApellidoMaterno']);
      $formularioCliente->Nombres($fila['nvchNombres']);
      $formularioCliente->IdTipoPersona($fila['intIdTipoPersona']);
      $formularioCliente->IdTipoCliente($fila['intIdTipoCliente']);
      $formularioCliente->Observacion($fila['nvchObservacion']);
      if($fila['dtmFechaNacimiento'] != NULL)
        $fila['dtmFechaNacimiento'] = date('d/m/Y', strtotime($fila['dtmFechaNacimiento']));
      else
        $fila['dtmFechaNacimiento'] = "";
      $formularioCliente->FechaNacimiento($fila['dtmFechaNacimiento']);
      $formularioCliente->Gustos($fila['nvchGustos']);
      $formularioCliente->ConsultarFormulario($funcion);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ListarClienteComprobante($busqueda,$x,$y,$intIdTipoPersona,$intIdDepartamento,$intIdProvincia,$intIdDistrito)
  {
    try{
      if($busqueda != "" || $busqueda != null) {
        $sql_conexion = new Conexion_BD();
        $sql_conectar = $sql_conexion->Conectar();
        $sql_comando = $sql_conectar->prepare('CALL BUSCARCLIENTE(:busqueda,:x,:y,:intIdTipoPersona,:intIdDepartamento,:intIdProvincia,
        :intIdDistrito)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':intIdTipoPersona' => $intIdTipoPersona,
          ':intIdDepartamento' => $intIdDepartamento,':intIdProvincia' => $intIdProvincia,':intIdDistrito' => $intIdDistrito));
        $j = $x + 1;
        while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
        {
          echo '
          <tr>
            <td class="heading" data-th="ID">'.$j.'</td>
            <td>'.$fila["DNIRUC"].'</td>
            <td>'.$fila["NombreCliente"].'</td>
            <td>'.$fila["TipoCliente"].'</td>
            <td> 
                <button type="button" idscli="'.$fila['intIdCliente'].'" class="btn btn-xs btn-success" onclick="SeleccionarCliente(this)">
                  <i class="fa fa-edit"></i> Seleccionar
                </button>
            </td>
          </tr>';
          $j++;
        /*
          if($intIdTipoPersona == 2) { 
            echo '<td>'.$fila["nvchDNI"].'</td>'; 
          }
          echo '<td>'.$fila["nvchRUC"].'</td>';
          if($intIdTipoPersona == 1) { 
            echo '<td>'.$fila["nvchRazonSocial"].'</td>'; 
          }
          if($intIdTipoPersona == 2) {
          echo '<td>'.$fila["nvchApellidoPaterno"].'</td>
          <td>'.$fila["nvchApellidoMaterno"].'</td>
          <td>'.$fila["nvchNombres"].'</td>';
          }*/
        }
      } else {
        echo "";
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function SeleccionarClienteComprobante()
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
      $salida['intIdTipoCliente'] = $fila['intIdTipoCliente'];
      $salida['nvchDomicilio'] = $fila['nvchDomicilio'];
      $salida['TipoCliente'] = $fila['TipoCliente'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }
  
  public function ActualizarCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarCliente(:intIdCliente,:nvchDNI,:nvchRUC,
      	:nvchRazonSocial,:nvchApellidoPaterno,:nvchApellidoMaterno,:nvchNombres,:intIdTipoPersona,
        :intIdTipoCliente,:dtmFechaNacimiento,:nvchGustos,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdCliente' => $this->intIdCliente,
        ':nvchDNI' => $this->nvchDNI, 
        ':nvchRUC' => $this->nvchRUC,
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':nvchApellidoPaterno' => $this->nvchApellidoPaterno,
        ':nvchApellidoMaterno' => $this->nvchApellidoMaterno,
        ':nvchNombres' => $this->nvchNombres,
        ':intIdTipoPersona' => $this->intIdTipoPersona,
        ':intIdTipoCliente' => $this->intIdTipoCliente,
        ':dtmFechaNacimiento' => $this->dtmFechaNacimiento,
        ':nvchGustos' => $this->nvchGustos,
        ':nvchObservacion' => $this->nvchObservacion));
      $_SESSION['intIdCliente'] = $this->intIdCliente;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarCliente()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarCliente(:intIdCliente)');
      $sql_comando -> execute(array(':intIdCliente' => $this->intIdCliente));
      $_SESSION['intIdCliente'] = $this->intIdCliente;
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ConsultarUltimoId(){
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL CONSULTARULTIMOIDCliente()');
      $sql_comando -> execute();
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      echo $fila['intIdCliente'];
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarClientes($busqueda,$x,$y,$tipolistado,$intIdTipoPersona,$intIdDepartamento,$intIdProvincia,$intIdDistrito)
  {
    try{
      $salida = "";
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $j = $x + 1;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de Cliente por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarCliente_ii(:busqueda,:intIdTipoPersona,:intIdDepartamento,:intIdProvincia,
        :intIdDistrito)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':intIdTipoPersona' => $intIdTipoPersona,
          ':intIdDepartamento' => $intIdDepartamento,':intIdProvincia' => $intIdProvincia,':intIdDistrito' => $intIdDistrito));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
        $j = $x + 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarCliente_ii(:busqueda,:intIdTipoPersona,:intIdDepartamento,:intIdProvincia,
        :intIdDistrito)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':intIdTipoPersona' => $intIdTipoPersona,
          ':intIdDepartamento' => $intIdDepartamento,':intIdProvincia' => $intIdProvincia,':intIdDistrito' => $intIdDistrito));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Cliente por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarCliente(:busqueda,:x,:y,:intIdTipoPersona,:intIdDepartamento,:intIdProvincia,
        :intIdDistrito)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':intIdTipoPersona' => $intIdTipoPersona,
        ':intIdDepartamento' => $intIdDepartamento,':intIdProvincia' => $intIdProvincia,':intIdDistrito' => $intIdDistrito));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdCliente"] == $_SESSION['intIdCliente'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        /*
        if($intIdTipoPersona == 2) { 
            echo '<td>'.$fila["nvchDNI"].'</td>'; 
        }
            echo '<td>'.$fila["nvchRUC"].'</td>';

        if($intIdTipoPersona == 1) { 
            echo '<td>'.$fila["nvchRazonSocial"].'</td>'; }
        if($intIdTipoPersona == 2) {
            echo '<td>'.$fila["nvchApellidoPaterno"].'</td>
            <td>'.$fila["nvchApellidoMaterno"].'</td>
            <td>'.$fila["nvchNombres"].'</td>';
        }*/
        echo 
        '<td class="heading" data-th="ID">'.$j.'</td>
        <td>'.$fila["DNIRUC"].'</td>
        <td>'.$fila["NombreCliente"].'</td>
        <td>'.$fila["TipoCliente"].'</td> 
        <td> 
          <button type="button" id="'.$fila["intIdCliente"].'" class="btn btn-xs btn-warning btn-mostrar-cliente" onclick="verformulario()">
            <i class="fa fa-edit" data-toggle="tooltip" title="Editar"></i> Editar 
          </button>
          <button type="button" id="'.$fila["intIdCliente"].'" class="btn btn-xs btn-danger btn-eliminar-cliente">
            <i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i> Eliminar
          </button>
        </td>
        </tr>';
        $i++; $j++;
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarClientes($busqueda,$x,$y,$tipolistado,$intIdTipoPersona,$intIdDepartamento,$intIdProvincia,$intIdDistrito)
  {
    try{
      if($tipolistado == "V" && $busqueda == ""){
        $output = ""; 
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
        echo $output;
        return false;
      }
      $btnEvento = "";
      $btnPagina = "";
      if($tipolistado == "V"){
        $btnEvento = 'onclick="PaginacionClientes(this)"';
        $btnPagina = '';
      }
      else{
        $btnEvento = '';
        $btnPagina = 'btn-pagina-cliente';
      }
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarCliente_ii(:busqueda,:intIdTipoPersona,:intIdDepartamento,:intIdProvincia,
        :intIdDistrito)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':intIdTipoPersona' => $intIdTipoPersona,
        ':intIdDepartamento' => $intIdDepartamento,':intIdProvincia' => $intIdProvincia,':intIdDistrito' => $intIdDistrito));
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
                <a idp="'.($x-1).'" class="page-link '.$btnPagina.'" '.$btnEvento.' aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

          if($x==$i){
            $output.=  '<li class="page-item active"><a idp="'.$i.'" class="page-link '.$btnPagina.' marca-cliente" '.$btnEvento.'>'.($i+1).'</a></li>';
          }
          else
          {
            $output.=  '<li class="page-item"><a idp="'.$i.'" class="page-link '.$btnPagina.'" '.$btnEvento.'>'.($i+1).'</a></li>';
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
                <a idp="'.($x+1).'" class="page-link '.$btnPagina.'" aria-label="Next" '.$btnEvento.'>
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
                <a class="page-link '.$btnPagina.'" '.$btnEvento.' aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
        $output .= 
            '<li class="page-item">
                <a class="page-link '.$btnPagina.'" '.$btnEvento.' aria-label="Next">
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
  /* FIN - Métodos de Cliente */
}
?>