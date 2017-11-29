<?php
require_once '../conexion/bd_conexion.php';
class CotizacionEquipo
{
  /* INICIO - Atributos de Comunicacion Proveedor*/
  private $intIdCotizacionEquipo;
  private $intIdTipoEquipo;
  private $dtmFechaCreacion;
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
  
  public function IdCotizacionEquipo($intIdCotizacionEquipo){ $this->intIdCotizacionEquipo = $intIdCotizacionEquipo; }
  public function IdTipoEquipo($intIdTipoEquipo){ $this->intIdTipoEquipo = $intIdTipoEquipo; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }
  public function IdPlantillaCotizacion($intIdPlantillaCotizacion){ $this->intIdPlantillaCotizacion = $intIdPlantillaCotizacion; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function IdCliente($intIdCliente){ $this->intIdCliente = $intIdCliente; }
  public function ClienteProveedor($nvchClienteProveedor){ $this->nvchClienteProveedor = $nvchClienteProveedor; }
  public function DNIRUC($nvchDNIRUC){ $this->nvchDNIRUC = $nvchDNIRUC; }
  public function Direccion($nvchDireccion){ $this->nvchDireccion = $nvchDireccion; }
  public function Garantia($nvchGarantia){ $this->nvchGarantia = $nvchGarantia; }
  public function FormaPago($nvchFormaPago){ $this->nvchFormaPago = $nvchFormaPago; }
  public function LugarEntrega($nvchLugarEntrega){ $this->nvchLugarEntrega = $nvchLugarEntrega; }
  public function TiempoEntrega($nvchTiempoEntrega){ $this->nvchTiempoEntrega = $nvchTiempoEntrega; }
  public function DiasValidez($nvchDiasValidez){ $this->nvchDiasValidez = $nvchDiasValidez; }
  /* FIN - Atributos de Comunicacion Proveedor */

  /* INICIO - Métodos de Comunicacion Proveedor */
  public function InsertarCotizacionEquipo()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarCotizacionEquipo(@intIdCotizacionEquipo,:intIdTipoEquipo,:dtmFechaCreacion,
        :intIdPlantillaCotizacion,:intIdUsuario,:intIdCliente,:nvchClienteProveedor,:nvchDNIRUC,:nvchDireccion,:nvchAtencion,:nvchGarantia,
        :nvchFormaPago,:nvchLugarEntrega,:nvchTiempoEntrega,:nvchDiasValidez)');
      $sql_comando->execute(array(
        ':intIdTipoEquipo' => $this->intIdTipoEquipo, 
        ':dtmFechaCreacion' => $this->$dtmFechaCreacion,
        ':intIdPlantillaCotizacion' => $this->$intIdPlantillaCotizacion,
        ':intIdUsuario' => $this->$intIdUsuario,
        ':intIdCliente' => $this->$intIdCliente,
        ':nvchClienteProveedor' => $this->$nvchClienteProveedor,
        ':nvchDNIRUC' => $this->$nvchDNIRUC,
        ':nvchDireccion' => $this->$nvchDireccion,
        ':nvchAtencion' => $this->$nvchAtencion,
        ':nvchGarantia' => $this->$nvchGarantia,
        ':nvchFormaPago' => $this->$nvchFormaPago,
        ':nvchLugarEntrega' => $this->$nvchLugarEntrega,
        ':nvchTiempoEntrega' => $this->$nvchTiempoEntrega,
        ':nvchDiasValidez' => $this->$nvchDiasValidez));
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

  public function ListarCotizacionEquipo($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarcodigosproducto(:intIdProducto)');
      $sql_comando -> execute(array(':intIdProducto' => $this->intIdProducto));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdCotizacionEquipo'] == $fila['intIdCotizacionEquipo'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
        echo '
            <td class="heading" data-th="ID">'.$i.'</td>
            <td>'.$fila['NombrePlantilla'].'</td>
            <td>'.$fila['nvchClienteProveedor'].'</td>
            <td>'.$fila['dtmFechaCreacion'].'</td>
            <td> 
              <button type="button" id="'.$fila["intIdCotizacionEquipo"].'" class="btn btn-xs btn-warning btn-mostrar-cotizacion">
                <i class="fa fa-edit"></i> Ver Detalle
              </button>
              <button type="button" id="'.$fila["intIdCotizacionEquipo"].'" class="btn btn-xs btn-danger btn-anular-cotizacion">
                <i class="fa fa-trash"></i> Anular
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

  public function MostrarCotizacionEquipo()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarCotizacionEquipo(:intIdCotizacionEquipo)');
      $sql_comando -> execute(array(':intIdCotizacionEquipo' => $this->intIdCotizacionEquipo));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdCotizacionEquipo'] = $fila['intIdCotizacionEquipo'];
      $salida['nvchCodigo'] = $fila['nvchCodigo'];
      $salida['intIdTipoCotizacionEquipo'] = $fila['intIdTipoCotizacionEquipo'];
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
      $sql_comando = $sql_conectar->prepare('CALL actualizarCotizacionEquipo(:intIdCotizacionEquipo,:intIdProducto,
        :nvchCodigo,:intIdTipoCotizacionEquipo)');
      $sql_comando->execute(array(
        ':intIdCotizacionEquipo' => $this->intIdCotizacionEquipo,
        ':intIdProducto' => $this->intIdProducto, 
        ':nvchCodigo' => $this->nvchCodigo,
        ':intIdTipoCotizacionEquipo' => $this->intIdTipoCotizacionEquipo));
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
  /* FIN - Métodos de Comunicacion Proveedor */
}
?>