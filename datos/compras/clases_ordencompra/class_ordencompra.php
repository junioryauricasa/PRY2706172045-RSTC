<?php 
require_once '../conexion/bd_conexion.php';
require_once '../numeraciones/class_numeraciones.php';
require_once 'clases_ordencompra/class_formulario_ordencompra.php';
class OrdenCompra{
  /* INICIO - Atributos de Orden Compra*/
  private $intIdOrdenCompra;
  private $nvchSerie;
  private $nvchNumeracion;
  private $nvchRazonSocial;
  private $nvchRUC;
  private $nvchAtencion;
  private $intIdTipoMoneda;
  private $intIdTipoPago;
  private $nvchNombreDe;
  private $intIdUsuario;
  private $intIdDireccionEmpresa;
  private $dtmFechaCreacion;
  private $nvchObservacion;
  
  public function IdOrdenCompra($intIdOrdenCompra){ $this->intIdOrdenCompra = $intIdOrdenCompra; }
  public function Serie($nvchSerie){ $this->nvchSerie = $nvchSerie; }
  public function Numeracion($nvchNumeracion){ $this->nvchNumeracion = $nvchNumeracion; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function RUC($nvchRUC){ $this->nvchRUC = $nvchRUC; }
  public function Atencion($nvchAtencion){ $this->nvchAtencion = $nvchAtencion; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function IdTipoPago($intIdTipoPago){ $this->intIdTipoPago = $intIdTipoPago; }
  public function NombreDe($nvchNombreDe){ $this->nvchNombreDe = $nvchNombreDe; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function intIdDireccionEmpresa($intIdDireccionEmpresa){ $this->intIdDireccionEmpresa = $intIdDireccionEmpresa; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
  /* FIN - Atributos de Orden Compra */

  /* INICIO - Métodos de Orden Compra */
  public function InsertarOrdenCompra()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarOrdenCompra(@intIdOrdenCompra,:nvchSerie,:nvchNumeracion,
        :nvchRazonSocial,:nvchRUC,:nvchAtencion,:intIdTipoMoneda,:intIdTipoPago,:nvchNombreDe,:intIdUsuario,
        :intIdDireccionEmpresa,:dtmFechaCreacion,:nvchObservacion)');
      $sql_comando->execute(array(
        ':nvchSerie' => '0001',
        ':nvchNumeracion' => '', 
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':nvchRUC' => $this->nvchRUC,
        ':nvchAtencion' => $this->nvchAtencion,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':intIdTipoPago' => $this->intIdTipoPago,
        ':nvchNombreDe' => 'RESTECO S.A.',
        ':intIdUsuario' => $this->intIdUsuario,
        ':intIdDireccionEmpresa' => 1,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':nvchObservacion' => $this->nvchObservacion));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdOrdenCompra AS intIdOrdenCompra");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdOrdenCompra'] = $salida->intIdOrdenCompra;
      $Numeraciones = new Numeraciones();
      $nvchNumeracion = $Numeraciones -> NumeracionSimpleInterna($_SESSION['intIdOrdenCompra']);
      $sql_comando = $sql_conectar->prepare('CALL InsertarNumeracionOrdenCompra(:intIdOrdenCompra,:nvchNumeracion)');
      $sql_comando->execute(array(
        ':intIdOrdenCompra' => $_SESSION['intIdOrdenCompra'],
        ':nvchNumeracion' => $nvchNumeracion));
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
      $FormularioOrdenCompra->Serie($fila['nvchSerie']);
      $FormularioOrdenCompra->Numeracion($fila['nvchNumeracion']);
      $FormularioOrdenCompra->RazonSocial($fila['nvchRazonSocial']);
      $FormularioOrdenCompra->RUC($fila['nvchRUC']);
      $FormularioOrdenCompra->Atencion($fila['nvchAtencion']);
      $FormularioOrdenCompra->IdTipoMoneda($fila['intIdTipoMoneda']);
      $FormularioOrdenCompra->IdTipoPago($fila['intIdTipoPago']);
      $FormularioOrdenCompra->NombreDe($fila['nvchNombreDe']);
      $FormularioOrdenCompra->IdUsuario($fila['intIdUsuario']);
      $FormularioOrdenCompra->IdDireccionEmpresa($fila['intIdDireccionEmpresa']);

      $FormularioOrdenCompra->NombreUsuario($fila['NombreUsuario']);
      $FormularioOrdenCompra->SimboloMoneda($fila['SimboloMoneda']);
      $FormularioOrdenCompra->NombrePago($fila['NombrePago']);

      $FormularioOrdenCompra->FechaCreacion($fila['dtmFechaCreacion']);
      $FormularioOrdenCompra->Observacion($fila['nvchObservacion']);
      $FormularioOrdenCompra->MostrarDetalle();
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
      $sql_comando = $sql_conectar->prepare('CALL ActualizarOrdenCompra(:intIdOrdenCompra,:nvchSerie,:nvchNumeracion,
        :nvchRazonSocial,:nvchRUC,:nvchAtencion,:intIdTipoMoneda,:intIdTipoPago,:nvchNombreDe,:intIdUsuario,
        :intIdDireccionEmpresa,:dtmFechaCreacion,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdOrdenCompra' => $this->intIdOrdenCompra,
        ':nvchSerie' => $this->nvchSerie, 
        ':nvchNumeracion' => $this->nvchNumeracion, 
        ':nvchRazonSocial' => $this->nvchRazonSocial,
        ':nvchRUC' => $this->nvchRUC,
        ':nvchAtencion' => $this->nvchAtencion,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':intIdTipoPago' => $this->intIdTipoPago,
        ':nvchNombreDe' => $this->nvchNombreDe,
        ':intIdUsuario' => $this->intIdUsuario,
        ':intIdDireccionEmpresa' => $this->intIdDireccionEmpresa,
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':nvchObservacion' => $this->nvchObservacion));
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

  public function ListarOrdenesCompra($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
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
        $sql_comando = $sql_conectar->prepare('CALL buscarordencompra_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, 
          ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarordencompra_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, 
          ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Proveedor por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarordencompra(:busqueda,:x,:y,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y,':dtmFechaInicial' => $dtmFechaInicial, 
        ':dtmFechaFinal' => $dtmFechaFinal));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $dtmFechaCambio =  date('Y-m-d', strtotime($fila['dtmFechaCreacion']));
        $sql_conexion_moneda = new Conexion_BD();
        $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
        $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDACOMERCIALFECHA(:dtmFechaCambio)');
        $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
        $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
        if($intIdTipoMoneda == 1){
          if($fila['intIdTipoMoneda'] != 1) {
            $fila['TotalOrdenCompra'] = round($fila['TotalOrdenCompra']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVOrdenCompra'] = round($fila['IGVOrdenCompra']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorOrdenCompra'] = round($fila['ValorOrdenCompra']*$fila_moneda['dcmCambio2'],2); 
            $fila['SimboloMoneda'] = "S/.";
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalOrdenCompra'] = round($fila['TotalOrdenCompra']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVOrdenCompra'] = round($fila['IGVOrdenCompra']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorOrdenCompra'] = round($fila['ValorOrdenCompra']/$fila_moneda['dcmCambio2'],2);
            $fila['SimboloMoneda'] = "US$";
          }
        }

        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdOrdenCompra"] == $_SESSION['intIdOrdenCompra'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo
        '<td>'.$fila["nvchSerie"].'-'.$fila["nvchNumeracion"].'</td>
        <td>'.$fila["nvchRazonSocial"].'</td>
        <td>'.$fila["NombreUsuario"].'</td>
        <td>'.$fila["dtmFechaCreacion"].'</td>
        <td>'.$fila["SimboloMoneda"].' '.$fila["ValorOrdenCompra"].'</td>
        <td>'.$fila["SimboloMoneda"].' '.$fila["IGVOrdenCompra"].'</td>
        <td>'.$fila["SimboloMoneda"].' '.$fila["TotalOrdenCompra"].'</td>
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

  public function TotalOrdenCompra($busqueda,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
  {
    try{
      $TotalOrdenCompra = 0.00;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarordencompra_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $dtmFechaCambio =  date('Y-m-d', strtotime($fila['dtmFechaCreacion']));
        $sql_conexion_moneda = new Conexion_BD();
        $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
        $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDACOMERCIALFECHA(:dtmFechaCambio)');
        $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
        $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
        if($intIdTipoMoneda == 1){
          if($fila['intIdTipoMoneda'] != 1) {
            $fila['TotalOrdenCompra'] = round($fila['TotalOrdenCompra']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVOrdenCompra'] = round($fila['IGVOrdenCompra']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorOrdenCompra'] = round($fila['ValorOrdenCompra']*$fila_moneda['dcmCambio2'],2); 
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalOrdenCompra'] = round($fila['TotalOrdenCompra']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVOrdenCompra'] = round($fila['IGVOrdenCompra']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorOrdenCompra'] = round($fila['ValorOrdenCompra']/$fila_moneda['dcmCambio2'],2);
          }
        }
        $TotalOrdenCompra += $fila['TotalOrdenCompra'];
      }
      if($intIdTipoMoneda == 1){
        $SimboloMoneda = "S/.";
      } else if($intIdTipoMoneda == 2){
        $SimboloMoneda = "US$";
      }
      echo $SimboloMoneda.' '.$TotalOrdenCompra;
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarOrdenesCompra($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarordencompra_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));
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
  /* FIN - Métodos de Orden Compra */
}
?>