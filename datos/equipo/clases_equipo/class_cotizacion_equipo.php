<?php
require_once '../conexion/bd_conexion.php';
class CotizacionEquipo
{
  /* INICIO - Atributos de Comunicacion Proveedor*/
  private $intIdCotizacionEquipo;
  private $dtmFechaCreacion;
  private $intIdTipoVenta;
  private $intIdPlantillaCotizacion;
  private $intIdUsuario;
  private $intIdCliente;
  private $nvchClienteProveedor;
  private $nvchDNIRUC;
  private $nvchDireccion;
  private $nvchAtencion;
  private $nvchGarantia;
  private $nvchFormaPago;
  private $nvchLugarEntrega;
  private $nvchTiempoEntrega;
  private $nvchDiasValidez;
  private $intIdTipoMoneda;
  private $dcmPrecioVenta;
  private $nvchObservacion;
  
  public function IdCotizacionEquipo($intIdCotizacionEquipo){ $this->intIdCotizacionEquipo = $intIdCotizacionEquipo; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function IdTipoVenta($intIdTipoVenta){ $this->intIdTipoVenta = $intIdTipoVenta; }
  public function IdPlantillaCotizacion($intIdPlantillaCotizacion){ $this->intIdPlantillaCotizacion = $intIdPlantillaCotizacion; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function ClienteProveedor($nvchClienteProveedor){ $this->nvchClienteProveedor = $nvchClienteProveedor; }
  public function DNIRUC($nvchDNIRUC){ $this->nvchDNIRUC = $nvchDNIRUC; }
  public function Atencion($nvchAtencion){ $this->nvchAtencion = $nvchAtencion; }
  public function Direccion($nvchDireccion){ $this->nvchDireccion = $nvchDireccion; }
  public function Garantia($nvchGarantia){ $this->nvchGarantia = $nvchGarantia; }
  public function FormaPago($nvchFormaPago){ $this->nvchFormaPago = $nvchFormaPago; }
  public function LugarEntrega($nvchLugarEntrega){ $this->nvchLugarEntrega = $nvchLugarEntrega; }
  public function TiempoEntrega($nvchTiempoEntrega){ $this->nvchTiempoEntrega = $nvchTiempoEntrega; }
  public function DiasValidez($nvchDiasValidez){ $this->nvchDiasValidez = $nvchDiasValidez; }
  public function IdTipoMoneda($intIdTipoMoneda){ $this->intIdTipoMoneda = $intIdTipoMoneda; }
  public function PrecioVenta($dcmPrecioVenta){ $this->dcmPrecioVenta = $dcmPrecioVenta; }
  public function Observacion($nvchObservacion){ $this->nvchObservacion = $nvchObservacion; }
  /* FIN - Atributos de Comunicacion Proveedor */

  /* INICIO - Métodos de Comunicacion Proveedor */
  public function InsertarCotizacionEquipo()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarCotizacionEquipo(@intIdCotizacionEquipo,:dtmFechaCreacion,:intIdTipoVenta,
        :intIdPlantillaCotizacion,:intIdUsuario,:intIdCliente,:nvchClienteProveedor,:nvchDNIRUC,:nvchDireccion,:nvchAtencion,:nvchGarantia,
        :nvchFormaPago,:nvchLugarEntrega,:nvchTiempoEntrega,:nvchDiasValidez,:intIdTipoMoneda,:dcmPrecioVenta,:nvchObservacion)');
      $sql_comando->execute(array(
        ':dtmFechaCreacion' => $this->dtmFechaCreacion,
        ':intIdTipoVenta' => $this->intIdTipoVenta, 
        ':intIdPlantillaCotizacion' => $this->intIdPlantillaCotizacion,
        ':intIdUsuario' => $this->intIdUsuario,
        ':intIdCliente' => $this->intIdCliente,
        ':nvchClienteProveedor' => $this->nvchClienteProveedor,
        ':nvchDNIRUC' => $this->nvchDNIRUC,
        ':nvchDireccion' => $this->nvchDireccion,
        ':nvchAtencion' => $this->nvchAtencion,
        ':nvchGarantia' => $this->nvchGarantia,
        ':nvchFormaPago' => $this->nvchFormaPago,
        ':nvchLugarEntrega' => $this->nvchLugarEntrega,
        ':nvchTiempoEntrega' => $this->nvchTiempoEntrega,
        ':nvchDiasValidez' => $this->nvchDiasValidez,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':dcmPrecioVenta' => $this->dcmPrecioVenta,
        ':nvchObservacion' => $this->nvchObservacion));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdCotizacionEquipo as intIdCotizacionEquipo");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdCotizacionEquipo'] = $salida->intIdCotizacionEquipo;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarCotizacionEquipo()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarCotizacionEquipo(:intIdCotizacionEquipo)');
      $sql_comando -> execute(array(':intIdCotizacionEquipo' => $this->intIdCotizacionEquipo));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdCotizacionEquipo'] = $fila['intIdCotizacionEquipo'];
      $salida['dtmFechaCreacion'] = $fila['dtmFechaCreacion'];
      $salida['intIdTipoVenta'] = $fila['intIdTipoVenta'];
      $salida['intIdPlantillaCotizacion'] = $fila['intIdPlantillaCotizacion'];
      $salida['intIdUsuario'] = $fila['intIdUsuario'];
      $salida['intIdCliente'] = $fila['intIdCliente'];
      $salida['nvchDNIRUC'] = $fila['nvchDNIRUC'];
      $salida['nvchClienteProveedor'] = $fila['nvchClienteProveedor'];
      $salida['nvchDireccion'] = $fila['nvchDireccion'];
      $salida['TipoCliente'] = $fila['TipoCliente'];
      $salida['intIdTipoCliente'] = $fila['intIdTipoCliente'];
      $salida['nvchAtencion'] = $fila['nvchAtencion'];
      $salida['nvchGarantia'] = $fila['nvchGarantia'];
      $salida['nvchFormaPago'] = $fila['nvchFormaPago'];
      $salida['nvchLugarEntrega'] = $fila['nvchLugarEntrega'];
      $salida['nvchTiempoEntrega'] = $fila['nvchTiempoEntrega'];
      $salida['nvchDiasValidez'] = $fila['nvchDiasValidez'];
      $salida['intIdTipoMoneda'] = $fila['intIdTipoMoneda'];
      $salida['dcmPrecioVenta'] = $fila['dcmPrecioVenta'];
      $salida['nvchObservacion'] = $fila['nvchObservacion'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarCotizacionEquipo()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare(':intIdCotizacionEquipo,:dtmFechaCreacion,:intIdTipoVenta,
        :intIdPlantillaCotizacion,:intIdUsuario,:intIdCliente,:nvchClienteProveedor,:nvchDNIRUC,:nvchDireccion,:nvchAtencion,:nvchGarantia,
        :nvchFormaPago,:nvchLugarEntrega,:nvchTiempoEntrega,:nvchDiasValidez,:intIdTipoMoneda,:dcmPrecioVenta,:nvchObservacion)');
      $sql_comando->execute(array(
        ':intIdCotizacionEquipo' => $this->intIdCotizacionEquipo,
        ':intIdTipoVenta' => $this->intIdTipoVenta, 
        ':dtmFechaCreacion' => $this->$dtmFechaCreacion,
        ':intIdPlantillaCotizacion' => $this->intIdPlantillaCotizacion,
        ':intIdUsuario' => $this->intIdUsuario,
        ':intIdCliente' => $this->intIdCliente,
        ':nvchClienteProveedor' => $this->nvchClienteProveedor,
        ':nvchDNIRUC' => $this->nvchDNIRUC,
        ':nvchDireccion' => $this->nvchDireccion,
        ':nvchAtencion' => $this->nvchAtencion,
        ':nvchGarantia' => $this->nvchGarantia,
        ':nvchFormaPago' => $this->nvchFormaPago,
        ':nvchLugarEntrega' => $this->nvchLugarEntrega,
        ':nvchTiempoEntrega' => $this->nvchTiempoEntrega,
        ':nvchDiasValidez' => $this->nvchDiasValidez,
        ':intIdTipoMoneda' => $this->intIdTipoMoneda,
        ':dcmPrecioVenta' => $this->dcmPrecioVenta,
        ':nvchObservacion' => $this->nvchObservacion));
      $_SESSION['intIdCotizacionEquipo'] = $this->intIdCotizacionEquipo;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarCotizacionEquipo()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarCotizacionEquipo(:intIdCotizacionEquipo)');
      $sql_comando -> execute(array(':intIdCotizacionEquipo' => $this->intIdCotizacionEquipo));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function ListarTipoEquipo()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarplantillacotizacion(:intIdTipoVenta)');
      $sql_comando->execute(array(':intIdTipoVenta' => $this->intIdTipoVenta));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo '<option value="'.$fila['intIdPlantillaCotizacion'].'">'.$fila['nvchNombre'].'</option>';
      }
    }catch(PDPExceptions $e){
      echo $e->getMessage();
    }  
  }

  public function ListarCotizacionEquipo($busqueda,$x,$y,$tipolistado)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de CotizacionEquipo por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarCotizacionEquipo_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarCotizacionEquipo_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de CotizacionEquipo por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarCotizacionEquipo(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($i == ($cantidad - $x) && $tipolistado == "N"){
          echo '<tr bgcolor="#BEE1EB">';
        } else if($fila["intIdCotizacionEquipo"] == $_SESSION['intIdCotizacionEquipo'] && $tipolistado == "E"){
          echo '<tr bgcolor="#B3E4C0">';
        }else {
          echo '<tr>';
        }
        echo 
        '
            <td class="heading" style="" data-th="ID"></td>
            <td align="left" data-th="Código">'.$fila["NombrePlantilla"].'</td>
            <td align="right" data-th="Descripción">'.$fila["nvchClienteProveedor"].'</td>
            <td align="right"data-th="Tipo de Moneda Venta">'.$fila["NombreUsuario"].'</td>
            <td align="right" data-th="Cant. Total" style="text-align:center">'.$fila["dtmFechaCreacion"].'</td>
            <td align="right" data-th="Opciones" style="text-align:center"> 
              <button type="button" id="'.$fila["intIdCotizacionEquipo"].'" class="btn btn-xs btn-warning btn-mostrar-cotizacion" data-toggle="tooltip" title="Editar">
                <i class="fa fa-edit"></i>
              </button>
              <button type="button" id="'.$fila["intIdCotizacionEquipo"].'" class="btn btn-xs btn-danger btn-eliminar-cotizacion" data-toggle="tooltip" title="Eliminar">
                <i class="fa fa-trash"></i>
              </button>
              <button type="button" id="'.$fila["intIdCotizacionEquipo"].'" class="btn btn-xs btn-default btn-reporte-cotizacion">
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

  public function PaginarCotizacionEquipo($busqueda,$x,$y,$tipolistado)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarCotizacionEquipo_ii(:busqueda)');
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

  
  /* FIN - Métodos de Comunicacion Proveedor */
}
?>