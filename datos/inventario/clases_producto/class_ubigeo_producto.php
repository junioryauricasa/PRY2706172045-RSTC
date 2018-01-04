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
      $sql_comando = $sql_conectar->prepare('CALL ActualizarUbigeoProducto_II(:intIdProducto,:intIdSucursal,
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

  public function InsertarUbigeoProducto_III()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MOSTRARSUCURSAL()');
      $sql_comando->execute();
      $sql_conexion_ubigeo = new Conexion_BD();
      $sql_conectar_ubigeo = $sql_conexion_ubigeo->Conectar();
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC)){
        $sql_comando_ubigeo = $sql_conectar_ubigeo->prepare('CALL insertarUbigeoProducto(:intIdProducto,:intIdSucursal,
        :nvchUbicacion,:intCantidadUbigeo)');
        $sql_comando_ubigeo->execute(array(
        ':intIdProducto' => $this->intIdProducto, 
        ':intIdSucursal' => $fila['intIdSucursal'],
        ':nvchUbicacion' => '',
        ':intCantidadUbigeo' => 0));
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

   public function ListarUbigeoProductos($busqueda,$x,$y,$tipolistado)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $j = $x + 1;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de producto por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarubigeoproducto_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':TipoBusqueda' => $TipoBusqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
        $j = $x + 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarubigeoproducto_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':TipoBusqueda' => $TipoBusqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      $nvchCodigo;
      $z = 0;
      //Busqueda de producto por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarubigeoproducto(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        if($fila["nvchCodigo"]!=""){
          if($i == ($cantidad - $x) && $tipolistado == "N"){
            echo '<tr bgcolor="#BEE1EB">';
            $color="#BEE1EB";
          } else if($fila["intIdUbigeoProducto"] == $_SESSION['intIdUbigeoProducto'] && $tipolistado == "E"){
            echo '<tr bgcolor="#B3E4C0">';
            $color="#B3E4C0";
          }else {
            echo '<tr>';
            $color="";
          }
          if($intIdProducto != $fila['intIdProducto']){
          $intIdProducto = $fila['intIdProducto'];
          echo 
          '<td class="heading PRT'.$intIdProducto.'" style="" data-th="Ítem" rowspan="" bgcolor="">'.$j.'</td>
          <td align="left" class="PRT'.$intIdProducto.'" data-th="Código" rowspan="" bgcolor="">'.$fila["nvchCodigo"].'</td>
          <td align="right" class="PRT'.$intIdProducto.'" data-th="Descripción" rowspan="" bgcolor="">'.$fila["nvchDescripcion"].'</td>';
          $j++; $z=1;
          }
          echo '<script>$(".PRT'.$intIdProducto.'").attr("rowspan","'.$z.'");</script>';
          echo '<script>$(".PRT'.$intIdProducto.'").attr("bgcolor","'.$color.'");</script>';
          echo
          '<td align="right" data-th="Tipo de Moneda Venta">'.$fila["NombreSucursal"].'</td>
          <td align="right" data-th="Tipo de Moneda Venta">'.$fila["nvchUbicacion"].'</td>
          <td align="right" data-th="Precio de Venta 1" style="text-align:center">'.$fila["intCantidad"].'</td>
          <td align="right" data-th="Imágen" style="text-align:center">
            <button onclick="VerImagenProducto(this)" type="button" imagen="'.$fila["nvchDireccionImg"].'" class="btn btn-xs btn-primary">
              <i class="fa fa-search"></i> Ver 
            </button>
          </td>
          <td align="right" data-th="Opciones" style="text-align:center"> 
            <button type="button" id="'.$fila["intIdUbigeoProducto"].'" class="btn btn-xs btn-warning btn-mostrar-ubigeo-producto" data-toggle="tooltip" title="Editar">
              <i class="fa fa-edit"></i>
            </button>
          </td>  
          </tr>';
          $i++; $z++;
        }
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }      
  }

  public function PaginarUbigeoProductos($busqueda,$x,$y,$tipolistado)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarubigeoproducto_ii(:busqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda));
      $cantidad = $sql_comando -> rowCount();
      $numpaginas = ceil($cantidad / $y);
      if($tipolistado == "N" || $tipolistado == "D")
      { $x = $numpaginas - 1; }
      else if($tipolistado == "E")
      { $x = $x; }
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
                <a idp="'.($x-1).'" class="page-link btn-pagina-ubigeo" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

          if($x==$i){
            $output.=  '<li class="page-item active"><a idp="'.$i.'" class="page-link btn-pagina-ubigeo marca-ubigeo">'.($i+1).'</a></li>';
          }
          else
          {
            $output.=  '<li class="page-item"><a idp="'.$i.'" class="page-link btn-pagina-ubigeo">'.($i+1).'</a></li>';
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
                <a idp="'.($x+1).'" class="page-link btn-pagina-ubigeo" aria-label="Next">
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
                <a class="page-link btn-pagina-ubigeo" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
        $output .= 
            '<li class="page-item">
                <a class="page-link btn-pagina-ubigeo" aria-label="Next">
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
              <button type="button" idup="'.$fila['intIdUbigeoProducto'].'" class="btn btn-xs btn-warning" onclick="SeleccionarUbigeo(this)" data-toggle="tooltip" title="" data-original-title="Editar">
                <i class="fa fa-edit"></i> 
              </button>
              <button type="button" idup="'.$fila['intIdUbigeoProducto'].'" class="btn btn-xs btn-danger" onclick="EliminarUbigeo(this)" data-toggle="tooltip" title="" data-original-title="Eliminar">
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

  public function SeleccionarUbigeoProducto()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL seleccionarUbigeoProducto(:intIdUbigeoProducto)');
      $sql_comando -> execute(array(':intIdUbigeoProducto' => $this->intIdUbigeoProducto));
      $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

      $salida['intIdUbigeoProducto'] = $fila['intIdUbigeoProducto'];
      $salida['intIdProducto'] = $fila['intIdProducto'];
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
      //echo 'Se actualizo correctamente el UBIGEO..!!';
      
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