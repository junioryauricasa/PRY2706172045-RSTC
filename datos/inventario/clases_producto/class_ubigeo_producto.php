<?php
require_once '../conexion/bd_conexion.php';
class UbigeoProducto
{
  /* INICIO - Atributos de Ubigeo Proveedor*/
  private $intIdUbigeoProducto;
  private $intIdProducto;
  private $intIdSucursal;
  private $nvchUbicacion;
  private $intCantidadUbigeo;
  
  public function IdUbigeoProducto($intIdUbigeoProducto){ $this->intIdUbigeoProducto = $intIdUbigeoProducto; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function IdSucursal($intIdSucursal){ $this->intIdSucursal = $intIdSucursal; }
  public function Ubicacion($nvchUbicacion){ $this->nvchUbicacion = $nvchUbicacion; }
  public function CantidadUbigeo($intCantidadUbigeo){ $this->intCantidadUbigeo = $intCantidadUbigeo; }
  /* FIN - Atributos de Ubigeo Proveedor */

  /* INICIO - Métodos de Ubigeo Proveedor */
  public function InsertarUbigeoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->intIdSucursal as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarUbigeoProducto(:intIdProducto,:intIdSucursal,
      	:nvchUbicacion,:intCantidadUbigeo)');
      $sql_comando->execute(array(
        ':intIdProducto' => $this->intIdProducto, 
        ':intIdSucursal' => $value,
        ':nvchUbicacion' => $this->nvchUbicacion[$key],
        ':intCantidadUbigeo' => $this->intCantidadUbigeo[$key]));
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarUbigeoProducto_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarUbigeoProducto(:intIdProducto,:intIdSucursal,
        :nvchUbicacion,:intCantidadUbigeo)');
      $sql_comando->execute(array(
        ':intIdProducto' => $this->intIdProducto, 
        ':intIdSucursal' => $this->intIdSucursal,
        ':nvchUbicacion' => $this->nvchUbicacion,
        ':intCantidadUbigeo' => $this->intCantidadUbigeo));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarUbigeoProducto($tipolistado)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL mostrarubigeosproducto(:intIdProducto)');
      $sql_comando -> execute(array(':intIdProducto' => $this->intIdProducto));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION['intIdUbigeoProducto'] == $fila['intIdUbigeoProducto'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
      	echo '
            <td class="heading" data-th="ID"></td>
            <td>
              <input type="hidden" name="intIdSucursal[]" value="'.$fila['intIdSucursal'].'"/>'.$fila['NombreSucursal'].'
            </td>
            <td>
              <input type="hidden" name="nvchUbicacion[]" value="'.$fila['nvchUbicacion'].'"/>'.$fila['nvchUbicacion'].'
            </td>
            <td>
              <input type="hidden" name="intCantidadUbigeo[]" value="'.$fila['intCantidadUbigeo'].'"/>'.$fila['intCantidadUbigeo'].'
            </td>
            <td> 
              <button type="button" idup="'.$fila['intIdUbigeoProducto'].'" class="btn btn-xs btn-warning" onclick="SeleccionarUbigeo(this)">
                <i class="fa fa-edit"></i> Editar
              </button>
              <button type="button" idup="'.$fila['intIdUbigeoProducto'].'" class="btn btn-xs btn-danger" onclick="EliminarUbigeo(this)">
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

  public function SeleccionarUbigeoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarUbigeoProducto(:intIdUbigeoProducto)');
      $sql_comando -> execute(array(':intIdUbigeoProducto' => $this->intIdUbigeoProducto));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $salida['intIdUbigeoProducto'] = $fila['intIdUbigeoProducto'];
      $salida['intIdSucursal'] = $fila['intIdSucursal'];
      $salida['nvchUbicacion'] = $fila['nvchUbicacion'];
      $salida['intCantidadUbigeo'] = $fila['intCantidadUbigeo'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarUbigeoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarUbigeoProducto(:intIdUbigeoProducto,:intIdProducto,:intIdSucursal,
        :nvchUbicacion,:intCantidadUbigeo)');
      $sql_comando->execute(array(
        ':intIdUbigeoProducto' => $this->intIdUbigeoProducto,
        ':intIdProducto' => $this->intIdProducto, 
        ':intIdSucursal' => $this->intIdSucursal,
        ':nvchUbicacion' => $this->nvchUbicacion,
        ':intCantidadUbigeo' => $this->intCantidadUbigeo));
      $_SESSION['intIdUbigeoProducto'] = $this->intIdUbigeoProducto;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarUbigeoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarUbigeoProducto(:intIdUbigeoProducto)');
      $sql_comando -> execute(array(':intIdUbigeoProducto' => $this->intIdUbigeoProducto));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function VerDetalleUbigeoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MOSTRARUBIGEOSPRODUCTO(:intIdProducto)');
      $sql_comando -> execute(array(':intIdProducto' => $this->intIdProducto));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        echo '
        <tr bgcolor="#F9FAD4"> 
            <td class="heading" data-th="ID"></td>
            <td align="left" data-th="Sucursal">'.$fila['NombreSucursal'].'</td>
            <td align="right" data-th="Ubicación en Almacén">'.$fila['nvchUbicacion'].'</td>
            <td align="right" data-th="Cantidad">'.$fila['intCantidadUbigeo'].'</td>
        </tr>';
        $i++;
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }
  /* FIN - Métodos de Ubigeo Proveedor */
}
?>