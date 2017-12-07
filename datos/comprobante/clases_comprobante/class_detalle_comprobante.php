<?php 
require_once '../conexion/bd_conexion.php';
class DetalleComprobante
{	
  /* INICIO - Atributos de Detalle Orden Compra*/
  private $intIdDetalleComprobante;
  private $intIdComprobante;
  private $intIdTipoVenta;
  private $intTipoDetalle;
  private $dtmFechaRealizada;
  private $intIdProducto;
  private $nvchCodigo;
  private $nvchDescripcion;
  private $dcmPrecio;
  private $dcmDescuento;
  private $dcmPrecioUnitario;
  private $intCantidad;
  private $dcmTotal;
  
  public function IdDetalleComprobante($intIdDetalleComprobante){ $this->intIdDetalleComprobante = $intIdDetalleComprobante; }
  public function IdComprobante($intIdComprobante){ $this->intIdComprobante = $intIdComprobante; }
  public function IdTipoVenta($intIdTipoVenta){ $this->intIdTipoVenta = $intIdTipoVenta; }
  public function TipoDetalle($intTipoDetalle){ $this->intTipoDetalle = $intTipoDetalle; }
  public function FechaRealizada($dtmFechaRealizada){ $this->dtmFechaRealizada = $dtmFechaRealizada; }
  public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
  public function Codigo($nvchCodigo){ $this->nvchCodigo = $nvchCodigo; }
  public function Descripcion($nvchDescripcion){ $this->nvchDescripcion = $nvchDescripcion; }
  public function Precio($dcmPrecio){ $this->dcmPrecio = $dcmPrecio; }
  public function Descuento($dcmDescuento){ $this->dcmDescuento = $dcmDescuento; }
  public function PrecioUnitario($dcmPrecioUnitario){ $this->dcmPrecioUnitario = $dcmPrecioUnitario; }
  public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
  public function Total($dcmTotal){ $this->dcmTotal = $dcmTotal; }
  /* FIN - Atributos de Detalle Orden Compra */

  /* INICIO - Métodos de Detalle Orden Compra */
  public function InsertarDetalleComprobante($funcion)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      if($funcion == "A"){
        $sql_comando = $sql_conectar->prepare('CALL ELIMINARDETALLESCOMPROBANTE(:intIdComprobante)');
        $sql_comando->execute(array(':intIdComprobante' => $this->intIdComprobante));
      }
      $dcmPrecio = 0.00;
      $dcmDescuento = 0.00;
      foreach ($this->intCantidad as $key => $value) {
        if($this->dcmTotal[$key] != ""){
        $sql_comando = $sql_conectar->prepare('CALL insertarDetalleComprobante(:intIdComprobante,
          :intIdTipoVenta,:intTipoDetalle,:dtmFechaRealizada,:intIdProducto,:nvchCodigo,:nvchDescripcion,:dcmPrecio,:dcmDescuento,:dcmPrecioUnitario,:intCantidad,:dcmTotal)');
          if($this->intIdTipoVenta != 2){
            if($this->intIdTipoVenta >= 3){
              $dcmPrecio = 0.00;
              $dcmDescuento = 0.00;
            } else if($this->intIdTipoVenta == 1){
              $dcmPrecio = $this->dcmPrecio[$key];
              $dcmDescuento = $this->dcmDescuento[$key];
            }
            $sql_comando->execute(array(
            ':intIdComprobante' => $this->intIdComprobante,
            ':intIdTipoVenta' => $this->intIdTipoVenta,
            ':intTipoDetalle' => $this->intTipoDetalle,
            ':dtmFechaRealizada' => $this->dtmFechaRealizada,
            ':intIdProducto' => $this->intIdProducto[$key],
            ':nvchCodigo' => $this->nvchCodigo[$key],
            ':nvchDescripcion' => $this->nvchDescripcion[$key],
            ':dcmPrecio' => $dcmPrecio,
            ':dcmDescuento' => $dcmDescuento,
            ':dcmPrecioUnitario' => $this->dcmPrecioUnitario[$key],
            ':intCantidad' => $value,
            ':dcmTotal' => $this->dcmTotal[$key]));
          } else if ($this->intIdTipoVenta == 2) {
            $sql_comando->execute(array(
            ':intIdComprobante' => $this->intIdComprobante,
            ':intIdTipoVenta' => $this->intIdTipoVenta, 
            ':intTipoDetalle' => $this->intTipoDetalle,
            ':dtmFechaRealizada' => $this->dtmFechaRealizada,
            ':intIdProducto' => 0,
            ':nvchCodigo' => '',
            ':nvchDescripcion' => $this->nvchDescripcion[$key],
            ':dcmPrecio' => 0.00,
            ':dcmDescuento' => 0.00,
            ':dcmPrecioUnitario' => $this->dcmPrecioUnitario[$key],
            ':intCantidad' => $value,
            ':dcmTotal' => $this->dcmTotal[$key]));
          }
        }
      }
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function MostrarDetalleComprobante($intIdTipoVenta)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando;
      if($intIdTipoVenta == 1 || $intIdTipoVenta >=3){
        $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleComprobante(:intIdComprobante)');
        $sql_comando -> execute(array(':intIdComprobante' => $this->intIdComprobante));
      } else if($intIdTipoVenta == 2){
        $sql_comando = $sql_conectar->prepare('CALL MOSTRARDETALLEComprobanteSERVICIO(:intIdComprobante)');
        $sql_comando -> execute(array(':intIdComprobante' => $this->intIdComprobante));
      }
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $readonly = "readonly";
        $filaEliminar = "";
        if($_SESSION['intIdTipoUsuario']==1){
          $readonly = "";
          $filaEliminar = '<td>'.
              '<button type="button" style="width: 25px !important" onclick="EliminarFila(this)" class="btn btn-xs btn-danger"><i class="fa fa-edit" data-toggle="tooltip" title="Eliminar!"></i></button>'.
            '</td>';
        }
        $sql_conexion_producto = new Conexion_BD();
        $sql_conectar_producto = $sql_conexion_producto->Conectar();
        $sql_comando_producto = $sql_conectar_producto->prepare('CALL MOSTRARPRODUCTO(:intIdProducto)');
        $sql_comando_producto -> execute(array(':intIdProducto' => $fila['intIdProducto']));
        $fila_producto = $sql_comando_producto -> fetch(PDO::FETCH_ASSOC);
        if($intIdTipoVenta == 1){
          echo
          '<tr>
            <td class="heading" data-th="ID">'.$i.'</td> '.
            '<td><input type="hidden" name="fila[]" value="'.$i.'" form="form-comprobante" />'.
                '<input type="hidden" id="intIdProducto'.$i.'" name="intIdProducto[]" form="form-comprobante" value="'.$fila_producto['intIdProducto'].'" />'.
                '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigo'.$i.'" name="nvchCodigo[]" value="'.$fila_producto['nvchCodigo'].'" form="form-comprobante" '.$readonly.' />'.
                '<div class="result" id="result'.$i.'">'.
            '</td>'.
            '<td><input type="text" style="width: 100% !important" id="nvchDescripcion'.$i.'" name="nvchDescripcion[]" form="form-comprobante" value="'.$fila_producto['nvchDescripcion'].'" readonly/></td>';
            if($fila['intTipoDetalle'] == 1 && $fila['intIdTipoComprobante'] < 9){
            echo
            '<td>'.
              '<input type="text" id="dcmPrecio'.$i.'" name="dcmPrecio[]" form="form-comprobante" value="'.$fila_producto['dcmPrecioVenta1'].'" readonly />'.
              '<input type="hidden" id="dcmDescuentoVenta2'.$i.'" form="form-comprobante" value="'.$fila_producto['dcmDescuentoVenta2'].'" readonly />'.
              '<input type="hidden" id="dcmDescuentoVenta3'.$i.'" form="form-comprobante" value="'.$fila_producto['dcmDescuentoVenta3'].'" readonly />'.
            '</td>'.
            '<td><input type="text" style="max-width: 105px !important" id="dcmDescuento'.$i.'" name="dcmDescuento[]" form="form-comprobante" idsprt="'.$i.'"'.
              'onkeyup="CalcularPrecioTotal(this)" value="'.$fila['dcmDescuento'].'" '.$readonly.' /></td>';
            }
            echo
            '<td><input type="text" style="max-width: 105px !important" id="dcmPrecioUnitario'.$i.'" name="dcmPrecioUnitario[]" form="form-comprobante" value="'.$fila['dcmPrecioUnitario'].'" readonly/></td>'.
            '<td><input type="text" id="intCantidad'.$i.'" name="intCantidad[]" form="form-comprobante" idsprt="'.$i.'"'.
              'onkeyup="CalcularPrecioTotal(this)" value="'.$fila['intCantidad'].'" '.$readonly.' /></td>'.
            '<td><input type="text" id="dcmTotal'.$i.'" name="dcmTotal[]" form="form-comprobante" value="'.$fila['dcmTotal'].'" readonly/></td>'.$filaEliminar;
          '</tr>';
              $i++;
        } else if($intIdTipoVenta == 2){
              echo
              '<tr>'.
                '<td class="heading" data-th="ID">'.$i.'</td>'.
                '<td>'.
                  '<input style="width: 110px !important" type="hidden" name="fila[]" value="'.$i.'" form="form-comprobante" />'.
                  '<textarea id="nvchDescripcionS'.$i.'" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionS[]" form="form-comprobante" rows="4" '.$readonly.'>'.$fila['nvchDescripcion'].'</textarea>'.
                '</td>'.
                '<td>'.
                  '<input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioS'.$i.'" name="dcmPrecioUnitarioS[]" idsprt="'.$i.'" form="form-comprobante" onkeyup="CalcularPrecioTotalS(this)" value="'.$fila['dcmPrecioUnitario'].'" '.$readonly.'/>'.
                '</td>'.
                '<td>'.
                  '<input type="text" id="intCantidadS'.$i.'" name="intCantidadS[]" idsprt="'.$i.'" form="form-comprobante" value="'.$fila['intCantidad'].'" onkeyup="CalcularPrecioTotalS(this)" '.$readonly.'/>'.
                '</td>'.
                '<td>'.
                  '<input type="text" id="dcmTotalS'.$i.'" name="dcmTotalS[]" value="'.$fila['dcmTotal'].'" form="form-comprobante" readonly/>'.
                '</td>'.$filaEliminar;
              '</tr>';
              $i++;
        } else if($intIdTipoVenta == 3){
          echo
          '<tr>'.
          '<td class="heading" data-th="ID">'.$i.'</td>'.
          '<td><input type="hidden" style="width: 110px !important" name="fila[]" value="'.$i.'" form="form-comprobante" />'.
              '<input type="hidden" style="width: 110px !important" id="intIdProductoM'.$i.'" name="intIdProductoM[]" value="'.$fila_producto['intIdProducto'].'" form="form-comprobante" />'.
              '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigoM'.$i.'" name="nvchCodigoM[]" value="'.$fila_producto['nvchCodigo'].'" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)" '.$readonly.'/>'.
              '<div class="result" id="resultM'.$i.'">'.
          '</td>'.
          '<td>'.
            '<input style="width: 110px !important" type="hidden" name="fila[]" value="'.$i.'" form="form-comprobante" />'.
            '<textarea id="nvchDescripcionM'.$i.'" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionM[]" form="form-comprobante" rows="4" '.$readonly.'>'.$fila_producto['nvchDescripcion'].'</textarea>'.
          '</td>'.
          '<td>'.
            '<input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioM'.$i.'" name="dcmPrecioUnitarioM[]" value="'.$fila['dcmPrecioUnitario'].'" idsprt="'.$i.'" form="form-comprobante" onkeyup="CalcularPrecioTotalM(this)" '.$readonly.'/>'.
          '</td>'.
          '<td>'.
            '<input type="text" id="intCantidadM'.$i.'" name="intCantidadM[]" idsprt="'.$i.'" form="form-comprobante" value="'.$fila['intCantidad'].'" onkeyup="CalcularPrecioTotalM(this)" '.$readonly.'/>'.
          '</td>'.
          '<td>'.
            '<input type="text" id="dcmTotalM'.$i.'" value="'.$fila['dcmTotal'].'" name="dcmTotalM[]" form="form-comprobante" readonly/>'.
          '</td>'.$filaEliminar.
        '</tr>';
        $i++;
        } else if($intIdTipoVenta == 4){
          echo
          '<tr>'.
          '<td class="heading" data-th="ID">'.$i.'</td>'.
          '<td><input type="hidden" style="width: 110px !important" name="fila[]" value="'.$i.'" form="form-comprobante" />'.
              '<input type="hidden" style="width: 110px !important" id="intIdProductoI'.$i.'" name="intIdProductoI[]" value="'.$fila_producto['intIdProducto'].'" form="form-comprobante" />'.
              '<input type="text" style="width: 110px !important" class="buscar" id="nvchCodigoI'.$i.'" name="nvchCodigoI[]" value="'.$fila_producto['nvchCodigo'].'" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)" '.$readonly.'/>'.
              '<div class="result" id="resultM'.$i.'">'.
          '</td>'.
          '<td>'.
            '<input style="width: 110px !important" type="hidden" name="fila[]" value="'.$i.'" form="form-comprobante" />'.
            '<textarea id="nvchDescripcionI'.$i.'" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionI[]" form="form-comprobante" rows="4" '.$readonly.'>'.$fila_producto['nvchDescripcion'].'</textarea>'.
          '</td>'.
          '<td>'.
            '<input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioI'.$i.'" name="dcmPrecioUnitarioI[]" value="'.$fila['dcmPrecioUnitario'].'" idsprt="'.$i.'" form="form-comprobante" onkeyup="CalcularPrecioTotalI(this)" '.$readonly.'/>'.
          '</td>'.
          '<td>'.
            '<input type="text" id="intCantidadI'.$i.'" name="intCantidadI[]" idsprt="'.$i.'" form="form-comprobante" value="'.$fila['intCantidad'].'" onkeyup="CalcularPrecioTotalI(this)" '.$readonly.'/>'.
          '</td>'.
          '<td>'.
            '<input type="text" id="dcmTotalI'.$i.'" value="'.$fila['dcmTotal'].'" name="dcmTotalI[]" form="form-comprobante" readonly/>'.
          '</td>'.$filaEliminar.
        '</tr>';
        $i++;
        }
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }    
  }

  public function EliminarDetalleComprobante()
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL eliminarDetalleComprobante(:intIdDetalleComprobante)');
      $sql_comando -> execute(array(':intIdDetalleComprobante' => $this->intIdDetalleComprobante));
      echo 'ok';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }
  }
  /* FIN - Métodos de Detalle Orden Compra */
}
?>