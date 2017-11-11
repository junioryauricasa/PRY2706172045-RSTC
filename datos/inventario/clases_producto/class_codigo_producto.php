<?php
require_once '../conexion/bd_conexion.php';
class CodigoProducto
{
  /* INICIO - Atributos de Comunicacion Proveedor*/
  private $intIdCodigoProducto;
  private $intIdProducto;
  private $nvchCodigo;
  private $intIdTipoCodigoProducto;
  
  public function IdCodigoProducto($intIdCodigoProducto){ $this->intIdCodigoProducto = $intIdCodigoProducto; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function Codigo($nvchCodigo){ $this->nvchCodigo = $nvchCodigo; }
  public function IdTipoCodigoProducto($intIdTipoCodigoProducto){ $this->intIdTipoCodigoProducto = $intIdTipoCodigoProducto; }
  /* FIN - Atributos de Comunicacion Proveedor */

  /* INICIO - Métodos de Comunicacion Proveedor */
  public function InsertarCodigoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      foreach ($this->nvchCodigo as $key => $value) {
      $sql_comando = $sql_conectar->prepare('CALL insertarCodigoProducto(:intIdProducto,:nvchCodigo,:intIdTipoCodigoProducto)');
      $sql_comando->execute(array(
        ':intIdProducto' => $this->intIdProducto, 
        ':nvchCodigo' => $value,
        ':intIdTipoCodigoProducto' => $this->intIdTipoCodigoProducto[$key]));
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function InsertarCodigoProducto_II()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarCodigoProducto(:intIdProducto,:nvchCodigo,
        :intIdTipoCodigoProducto)');
      $sql_comando->execute(array(
        ':intIdProducto' => $this->intIdProducto, 
        ':nvchCodigo' => $this->nvchCodigo,
        ':intIdTipoCodigoProducto' => $this->intIdTipoCodigoProducto));
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarCodigoProducto($tipolistado)
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
        if($_SESSION['intIdCodigoProducto'] == $fila['intIdCodigoProducto'] && $tipolistado == "A"){
          echo '<tr bgcolor="#B3E4C0">';
        } else if($cantidad == $i && $tipolistado == "I"){
          echo '<tr bgcolor="#BEE1EB">';
        } else {
          echo '<tr bgcolor="#F7FCCF">';
        }
      	echo '
            <td class="heading" data-th="ID"></td>
            <td>
                <input type="hidden" name="nvchCodigo[]" value="'.$fila['nvchCodigo'].'"/>'.$fila['nvchCodigo'].'
            </td>
            <td>
                <input type="hidden" name="intIdTipoCodigoProducto[]" value="'.$fila['intIdTipoCodigoProducto'].'"/>'.$fila['NombreTipoCodigo'].'
            </td>
            <td> 
              <button type="button" idcp="'.$fila['intIdCodigoProducto'].'" class="btn btn-xs btn-warning" onclick="SeleccionarCodigo(this)" data-toggle="tooltip" title="Editar">
                <i class="fa fa-edit"></i>
              </button>
              <button type="button" idcp="'.$fila['intIdCodigoProducto'].'" class="btn btn-xs btn-danger" onclick="EliminarCodigo(this)" data-toggle="tooltip" title="Eliminar">
                <i class="fa fa-trash"></i>
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

  public function SeleccionarCodigoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarCodigoProducto(:intIdCodigoProducto)');
      $sql_comando -> execute(array(':intIdCodigoProducto' => $this->intIdCodigoProducto));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
      $salida['intIdCodigoProducto'] = $fila['intIdCodigoProducto'];
      $salida['nvchCodigo'] = $fila['nvchCodigo'];
      $salida['intIdTipoCodigoProducto'] = $fila['intIdTipoCodigoProducto'];
      echo json_encode($salida);
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function ActualizarCodigoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL actualizarCodigoProducto(:intIdCodigoProducto,:intIdProducto,
        :nvchCodigo,:intIdTipoCodigoProducto)');
      $sql_comando->execute(array(
        ':intIdCodigoProducto' => $this->intIdCodigoProducto,
        ':intIdProducto' => $this->intIdProducto, 
        ':nvchCodigo' => $this->nvchCodigo,
        ':intIdTipoCodigoProducto' => $this->intIdTipoCodigoProducto));
      $_SESSION['intIdCodigoProducto'] = $this->intIdCodigoProducto;
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }

  public function EliminarCodigoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarCodigoProducto(:intIdCodigoProducto)');
      $sql_comando -> execute(array(':intIdCodigoProducto' => $this->intIdCodigoProducto));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Comunicacion Proveedor */
}
?>