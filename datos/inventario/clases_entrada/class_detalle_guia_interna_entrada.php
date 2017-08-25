<?php
require_once '../conexion/bd_conexion.php';
class DetalleGuiaInternaEntrada
{
	/* INICIO - Atributos de Guia Interna Entrada */
	private $intIdOperacionGuiaInternaEntrada;
	private $intIdGuiaInternaEntrada;
	private $intIdOperacionOrdenCompra;
	private $dtmFechaEntrada;
	private $intCantidad;

	public function IdOperacionGuiaInternaEntrada($intIdOperacionGuiaInternaEntrada){ $this->intIdOperacionGuiaInternaEntrada = $intIdOperacionGuiaInternaEntrada; }
	public function IdGuiaInternaEntrada($intIdGuiaInternaEntrada){ $this->intIdGuiaInternaEntrada = $intIdGuiaInternaEntrada; }
	public function IdOperacionOrdenCompra($intIdOperacionOrdenCompra){ $this->intIdOperacionOrdenCompra = $intIdOperacionOrdenCompra; }
	public function FechaEntrada($dtmFechaEntrada){ $this->dtmFechaEntrada = $dtmFechaEntrada; }
	public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
	/* FIN - Atributos de Guia Interna Entrada */

	/* INICIO - Métodos de Guia Interna Entrada */
	public function InsertarDetalleGuiaInternaEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->intIdOperacionOrdenCompra as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL InsertarDetalleGuiaInternaEntrada(
      	:intIdGuiaInternaEntrada,:intIdOperacionOrdenCompra,:dtmFechaEntrada,:intCantidad)');
      $sql_comando->execute(array(
        ':intIdGuiaInternaEntrada' => $this->intIdGuiaInternaEntrada, 
        ':intIdOperacionOrdenCompra' => $value,
        ':dtmFechaEntrada' => $this->dtmFechaEntrada,
        ':intCantidad' => $this->intCantidad[$key]));
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarDetalleGuiaInternaEntrada_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL InsertarDetalleGuiaInternaEntrada(:intIdGuiaInternaEntrada,:intIdOperacionOrdenCompra,:dtmFechaEntrada,:intCantidad)');
      $sql_comando->execute(array(
        ':intIdGuiaInternaEntrada' => $this->intIdGuiaInternaEntrada, 
        ':intIdOperacionOrdenCompra' => $this->intIdOperacionOrdenCompra,
        ':dtmFechaEntrada' => $this->dtmFechaEntrada,
        ':intCantidad' => $this->intCantidad));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarDetalleGuiaInternaEntrada($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleGuiaInternaEntrada(:intIdGuiaInternaEntrada)');
      $sql_comando -> execute(array(':intIdGuiaInternaEntrada' => $this->intIdGuiaInternaEntrada));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdOperacionGuiaInternaEntrada'] == $fila['intIdOperacionGuiaInternaEntrada'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
      	echo 
      	'<td>'.$fila['intIdOperacionGuiaInternaEntrada'].'</td>
      	<td>'.$fila['NombreProducto'].'</td>
        <td>'.$fila['DescripcionProducto'].'</td>
        <td><input type="hidden" name="intCantidad[]" value="'.$fila['intCantidad'].'"/>'.$fila['intCantidad'].'</td>
        <td> 
          <button type="button" iddgie="'.$fila['intIdOperacionGuiaInternaEntrada'].'" class="btn btn-xs btn-warning" onclick="SeleccionarComunicacion(this)">
            <i class="fa fa-edit"></i> Editar
          </button>
          <button type="button" iddgie="'.$fila['intIdOperacionGuiaInternaEntrada'].'" class="btn btn-xs btn-danger" onclick="EliminarComunicacion(this)">
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

  public function SeleccionarDetalleGuiaInternaEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarDetalleGuiaInternaEntrada(:intIdOperacionGuiaInternaEntrada)');
      $sql_comando -> execute(array(':intIdOperacionGuiaInternaEntrada' => $this->intIdOperacionGuiaInternaEntrada));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdOperacionGuiaInternaEntrada'] = $fila['intIdOperacionGuiaInternaEntrada'];
      $salida['NombreProducto'] = $fila['NombreProducto'];
      $salida['DescripcionProducto'] = $fila['DescripcionProducto'];
      $salida['intCantidad'] = $fila['intCantidad'];
      echo json_encode($salida);
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarDetalleGuiaInternaEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarDetalleGuiaInternaEntrada(:intIdOperacionGuiaInternaEntrada,
        :intIdGuiaInternaEntrada,:intIdOperacionOrdenCompra,:dtmFechaEntrada,:intCantidad)');
      $sql_comando->execute(array(
      	':intIdOperacionGuiaInternaEntrada' => $this->intOperacionIdGuiaInternaEntrada,
        ':intIdGuiaInternaEntrada' => $this->intIdGuiaInternaEntrada,
        ':intIdOperacionOrdenCompra' => $this->intIdOperacionOrdenCompra, 
        ':dtmFechaEntrada' => $this->dtmFechaEntrada,
        ':intCantidad' => $this->intCantidad));
      $_SESSION['intIdOperacionGuiaInternaEntrada'] = $this->intIdOperacionGuiaInternaEntrada;
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function EliminarDetalleGuiaInternaEntrada()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarDetalleGuiaInternaEntrada(:intIdOperacionGuiaInternaEntrada)');
      $sql_comando -> execute(array(':intIdOperacionGuiaInternaEntrada' => $this->intIdOperacionGuiaInternaEntrada));
      echo 'ok';
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Guia Interna Entrada */
}
?>