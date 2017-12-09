<!-- INICIO - Formulario Realizar Venta -->
<form id="form-comprobante" method="POST"></form>
  <div class="row">
    <div class="col-md-2">
      <div id="nvchFechaGroup" class="form-group">
        <label>Fecha:</label>
        <div id="groupFecha" class="input-group">
          <input type="text" id="nvchFecha" name="nvchFecha" class="form-control select2" placeholder="dd/mm/aaaa HH:mm:ss" maxlength="19" form="form-comprobante" readonly/>
          <input type="hidden" id="txtOpcionFecha" value="1">
        </div>
        <!--<span id="nvchFechaIcono" class="" aria-hidden=""></span>-->
        <div id="nvchFechaObs" class=""></div>
        <!--<script type="text/javascript">$("#nvchFecha").val(FechaActual());</script>-->
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>Lugar:</label>
        <select id="intIdSucursalC" name="intIdSucursal"  class="form-control select2" form="form-comprobante">
        <?php 
        require_once '../../datos/conexion/bd_conexion.php';
          try{
          $sql_conexion = new Conexion_BD();
          $sql_conectar = $sql_conexion->Conectar();
          $sql_comando = $sql_conectar->prepare('CALL mostrarsucursal()');
          $sql_comando->execute();
          while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
          {
            echo '<option value="'.$fila['intIdSucursal'].'">'.$fila['nvchNombre'].'</option>';
          }
        }catch(PDPExceptions $e){
          echo $e->getMessage();
        }?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>Tipo de Comprobante:</label>
        <select id="intIdTipoComprobante" name="intIdTipoComprobante" class="form-control select2" form="form-comprobante">
        <?php 
        require_once '../../datos/conexion/bd_conexion.php';
          try{
          $sql_conexion = new Conexion_BD();
          $sql_conectar = $sql_conexion->Conectar();
          $sql_comando = $sql_conectar->prepare('CALL mostrartipocomprobantetodos()');
          $sql_comando->execute();
          while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
          {
            echo '<option value="'.$fila['intIdTipoComprobante'].'">'.$fila['nvchNombre'].'</option>';
          }
        }catch(PDPExceptions $e){
          echo $e->getMessage();
        }?>
      </select>
      </div>
    </div>
    <div class="col-md-2">
      <div id="nvchSerieGroup" class="form-group">
        <label>Serie:</label>
        <input type="text" id="nvchSerie" name="nvchSerie" class="form-control select2" form="form-comprobante"
        onkeyup="EsVacio('nvchSerie')"
        maxlength="6"/>
        <span id="nvchSerieIcono" class="" aria-hidden=""></span>
        <div id="nvchSerieObs" class=""></div>
      </div>
    </div>
    <div class="col-md-2">
      <div id="nvchNumeracionGroup" class="form-group">
        <label>Numeración:</label>
        <input type="text" id="nvchNumeracion" name="nvchNumeracion" class="form-control select2" 
        form="form-comprobante" onkeypress="return EsNumeroEnteroTecla(event)" 
        onkeyup="EsNumeroEntero('nvchNumeracion')" maxlength="8"/>
        <span id="nvchNumeracionIcono" class="" aria-hidden=""></span>
        <div id="nvchNumeracionObs" class=""></div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>Seleccionar el Tipo de Venta:</label>
        <select id="intIdTipoVenta" name="intIdTipoVenta" onchange="ElegirTabla(this.value)" class="form-control select2" form="form-comprobante">
          <?php 
          require_once '../../datos/conexion/bd_conexion.php';
          try{
            $sql_conexion = new Conexion_BD();
            $sql_conectar = $sql_conexion->Conectar();
            $sql_comando = $sql_conectar->prepare('CALL mostrartipoventa()');
            $sql_comando->execute();
            while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
            {
              echo '<option value="'.$fila['intIdTipoVenta'].'">'.$fila['nvchNombre'].'</option>';
            }
          }catch(PDPExceptions $e){
            echo $e->getMessage();
          }?>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label>Tipo de Moneda:</label>
        <select id="intIdTipoMonedaC" name="intIdTipoMoneda" class="form-control select2" onchange="CambiarMoneda()" form="form-comprobante">
          <?php 
          require_once '../../datos/conexion/bd_conexion.php';
          try{
            $sql_conexion = new Conexion_BD();
            $sql_conectar = $sql_conexion->Conectar();
            $sql_comando = $sql_conectar->prepare('CALL mostrartipomoneda()');
            $sql_comando->execute();
            while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
            {
              echo '<option value="'.$fila['intIdTipoMoneda'].'">'.$fila['nvchNombre'].'</option>';
            }
          }catch(PDPExceptions $e){
            echo $e->getMessage();
          }?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>Forma de Pago:</label>
        <select id="intIdTipoPago" name="intIdTipoPago" class="form-control select2" form="form-comprobante">
          <?php 
          require_once '../../datos/conexion/bd_conexion.php';
          try{
            $sql_conexion = new Conexion_BD();
            $sql_conectar = $sql_conexion->Conectar();
            $sql_comando = $sql_conectar->prepare('CALL mostrartipopago()');
            $sql_comando->execute();
            while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
            {
              echo '<option value="'.$fila['intIdTipoPago'].'">'.$fila['nvchNombre'].'</option>';
            }
          }catch(PDPExceptions $e){
            echo $e->getMessage();
          }?>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label>DNI/RUC:</label>
        <input type="text" id="nvchNumDocumento" name="nvchDNIRUC" class="form-control select2" form="form-comprobante" readonly>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Razón Social/Nombres:</label>
        <input type="text" id="nvchDenominacion" name="nvchClienteProveedor" class="form-control select2" form="form-comprobante" readonly>
      </div>
    </div>   
    <div class="col-md-4">
      <div class="form-group">
        <label>Domicilio:</label>
        <input type="text" id="nvchDomicilio" name="nvchDireccion" class="form-control select2" form="form-comprobante" readonly>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>Tipo de Cliente:</label>
        <input type="text" id="TipoCliente" class="form-control select2" readonly>
        <input type="hidden" id="intIdTipoCliente">
      </div>
    </div>
  </div>


<div id="tablaRepuestos">
<div class="row">
  <div class="col-md-12">
    <!-- Comentar-->
    <div class="table-responsive" style="max-height: 310px; overflow-y: visible;" id="scrool-slim">
      <table class="ExcelTable2007 rwd-table" width="100%">
        <thead>
        <tr>
          <th class="heading" width="25px">&nbsp;</th>
          <th style="width: 110px" >Código</th>
          <th>Descripción</th>
          <th style="width: 110px" class="filaPrecio">Precio Lista</th>
          <th style="width: 110px" class="filaDescuento">Desc. (%)</th>
          <th style="width: 110px" >Precio Unit.</th>
          <th style="width: 110px" >Cantidad</th>
          <th style="width: 110px" >Total</th>
          <th style="width: 25px !important" class="opcion-columna-nuevo"></th>
        </tr>
        </thead>
        <tbody id="ListaDeProductosVender">
          <tr>
            <td class="heading" data-th="ID">1</td>
            <td>
                <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-comprobante" />
                <input style="width: 110px !important" type="hidden" id="intIdProducto1" name="intIdProducto[]" form="form-comprobante" />
                <input style="width: 110px !important" type="text" class="buscar" id="nvchCodigo1" name="nvchCodigo[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>
                <div class="result" id="result1">
            </td>
            <td>
                <input type="text" style="width: 100%" id="nvchDescripcion1" name="nvchDescripcion[]" form="form-comprobante" class="" readonly/>
            </td>
            <td class="filaPrecio">
                <input type="text" id="dcmPrecio1" name="dcmPrecio[]" form="form-comprobante" class="" readonly />
                <input type="hidden" id="dcmDescuentoVenta21" form="form-comprobante" readonly />
                <input type="hidden" id="dcmDescuentoVenta31" form="form-comprobante" readonly />
            </td>
            <td class="filaDescuento">
                <input style="max-width: 105px !important" type="text" id="dcmDescuento1" name="dcmDescuento[]" form="form-comprobante" class="" idsprt="1" 
                onkeyup="CalcularPrecioTotal(this)"/>
            </td>
            <td>
                <input style="max-width: 105px !important"  type="text" id="dcmPrecioUnitario1" name="dcmPrecioUnitario[]" form="form-comprobante" onkeyup="CalcularPrecioTotal(this)" idsprt="1" class="txtPrecioUnitario" readonly="true" />
            </td>
            <td>
                <input type="text" id="intCantidad1" name="intCantidad[]" form="form-comprobante" idsprt="1"
              onkeyup="CalcularPrecioTotal(this)" class=""/>
            </td>
            <td>
                <input type="text" id="dcmTotal1" name="dcmTotal[]" form="form-comprobante" class="" readonly/>
            </td>
            <td style="width: 25px !important" >
                <button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">
                    <i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i> 
                </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- FIN Tabla - Repuestos -->

<!-- INICIO Tabla - Servicios -->
<div id="tablaServicios">
<div class="row">
  <div class="col-md-12">
    <!-- Comentar-->
    <div class="table-responsive" style="max-height: 310px; overflow-y: visible;">
      <table class="ExcelTable2007 rwd-table" width="100%">
        <thead>
        <tr>
          <th class="heading" width="25px">&nbsp;</th>
          <th>Descripción</th>
          <th style="width: 110px" >Precio Unit.</th>
          <th style="width: 110px" >Cantidad</th>
          <th style="width: 110px" >Total</th>
          <th style="width: 25px !important" class="opcion-columna-nuevo"></th>
        </tr>
        </thead>
        <tbody id="ListaDeServiciosVender">
          <tr>
            <td class="heading" data-th="ID">1</td>
            <td>
              <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-comprobante" />
              <textarea id="nvchDescripcionS1" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionS[]" form="form-comprobante" rows="4"></textarea>
              <!--<input type="text" style="width: 100%" id="nvchDescripcionS1" name="nvchDescripcionS[]" form="form-comprobante" />-->
            </td>
            <td>
              <input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioS1" name="dcmPrecioUnitarioS[]" idsprt="1" form="form-comprobante" onkeyup="CalcularPrecioTotalS(this)" class=""/>
            </td>
            <td> 
              <input type="text" id="intCantidadS1" name="intCantidadS[]" idsprt="1" form="form-comprobante" 
              onkeyup="CalcularPrecioTotalS(this)" class=""/>           
            </td>
            <td>
              <input type="text" id="dcmTotalS1" name="dcmTotalS[]" form="form-comprobante" class="" readonly/>
            </td>
            <td style="width: 25px !important" >
              <button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">
                  <i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i> 
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- FIN Tabla - Servicios -->

<!-- INICIO Tabla - Maquinarias -->
<div id="tablaMaquinarias">
<div class="row">
  <div class="col-md-12">
    <!-- Comentar-->
    <div class="table-responsive" style="max-height: 310px; overflow-y: visible;">
      <table class="ExcelTable2007 rwd-table" width="100%">
        <thead>
        <tr>
          <th class="heading" width="25px">&nbsp;</th>
          <th style="width: 110px" >Código</th>
          <th>Descripción</th>
          <th style="width: 110px" >Precio Unit.</th>
          <th style="width: 110px" >Cantidad</th>
          <th style="width: 110px" >Total</th>
          <th style="width: 25px !important" class="opcion-columna-nuevo"></th>
        </tr>
        </thead>
        <tbody id="ListaDeMaquinariasVender">
          <tr>
            <td class="heading" data-th="ID">1</td>
            <td>
                <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-comprobante" />
                <input style="width: 110px !important" type="hidden" id="intIdProductoM1" name="intIdProductoM[]" form="form-comprobante" />
                <input style="width: 110px !important" type="text" class="buscar" id="nvchCodigoM1" name="nvchCodigoM[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>
                <div class="result" id="resultM1">
            </td>
            <td>
              <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-comprobante" />
              <textarea id="nvchDescripcionM1" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionM[]" form="form-comprobante" rows="4"></textarea>
            </td>
            <td>
              <input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioM1" name="dcmPrecioUnitarioM[]" idsprt="1" form="form-comprobante" onkeyup="CalcularPrecioTotalM(this)" class=""/>
            </td>
            <td> 
              <input type="text" id="intCantidadM1" name="intCantidadM[]" idsprt="1" form="form-comprobante" 
              onkeyup="CalcularPrecioTotalM(this)" class=""/>           
            </td>
            <td>
              <input type="text" id="dcmTotalM1" name="dcmTotalM[]" form="form-comprobante" class="" readonly/>
            </td>
            <td style="width: 25px !important" >
              <button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">
                  <i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i> 
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- FIN Tabla - Maquinarias -->

<!-- INICIO Tabla - Implementos -->
<div id="tablaImplementos">
<div class="row">
  <div class="col-md-12">
    <!-- Comentar-->
    <div class="table-responsive" style="max-height: 310px; overflow-y: visible;">
      <table class="ExcelTable2007 rwd-table" width="100%">
        <thead>
        <tr>
          <th class="heading" width="25px">&nbsp;</th>
          <th style="width: 110px" >Código</th>
          <th>Descripción</th>
          <th style="width: 110px" >Precio Unit.</th>
          <th style="width: 110px" >Cantidad</th>
          <th style="width: 110px" >Total</th>
          <th style="width: 25px !important" class="opcion-columna-nuevo"></th>
        </tr>
        </thead>
        <tbody id="ListaDeImplementosVender">
          <tr>
            <td class="heading" data-th="ID">1</td>
            <td>
                <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-comprobante" />
                <input style="width: 110px !important" type="hidden" id="intIdProductoI1" name="intIdProductoI[]" form="form-comprobante" />
                <input style="width: 110px !important" type="text" class="buscar" id="nvchCodigoI1" name="nvchCodigoI[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>
                <div class="result" id="resultI1">
            </td>
            <td>
              <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-comprobante" />
              <textarea id="nvchDescripcionI1" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionI[]" form="form-comprobante" rows="4"></textarea>
            </td>
            <td>
              <input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioI1" name="dcmPrecioUnitarioI[]" idsprt="1" form="form-comprobante" onkeyup="CalcularPrecioTotalI(this)" class=""/>
            </td>
            <td> 
              <input type="text" id="intCantidadI1" name="intCantidadI[]" idsprt="1" form="form-comprobante" 
              onkeyup="CalcularPrecioTotalI(this)" class=""/>           
            </td>
            <td>
              <input type="text" id="dcmTotalI1" name="dcmTotalI[]" form="form-comprobante" class="" readonly/>
            </td>
            <td style="width: 25px !important" >
              <button type="button" onclick="EliminarFila(this)" class="btn btn-xs btn-danger">
                  <i class="fa fa-edit" data-toggle="tooltip" title="Eliminar"></i> 
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- FIN Tabla - Maquinarias -->
<script type="text/javascript">ElegirTabla(1);</script>


  <div class="row">
    <div class="col-md-9">
    </div>
    <div class="col-md-3">
      <div class="row col-lg-12">
        <table border="1" class="ExcelTable2007 rwd-table" width="100%">
          <tbody>
            <tr>
                <th>Valor</th>
                <td style="width: 120px !important">
                    <input type="text" id="ValorComprobante" name="ValorComprobante" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/>
                </td>
            </tr>
            <tr>
                <th>IGV (18%)</th>
                <td style="width: 120px !important">
                    <input type="text" id="IGVComprobante" name="IGVComprobante" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/>
                </td>
            </tr>
            <tr>
                <th>Total</th>
                <td style="width: 120px !important">
                    <input type="text" id="ComprobanteTotal" name="ComprobanteTotal" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <br><br>
  <div class="row">
    <div class="col-md-4">
      <div id="resultadocodigo"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label>Observación y/o Datos Adicionales (Opcional):</label>
        <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-comprobante" rows="6"></textarea>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <input type="hidden" id="intIdComprobante" name="intIdComprobante" value="" form="form-comprobante">
        <input type="hidden" id="intTipoDetalle" name="intTipoDetalle" value="" form="form-comprobante">
        <input type="hidden" id="intIdTipoComprobanteI" name="intIdTipoComprobanteI" value="" form="form-comprobante">
        <input type="hidden" name="funcion" id="funcionC" value="" form="form-comprobante">
        <input type="hidden" name="Letra" id="Letra" value="" form="form-comprobante">
        <input type="hidden" name="Tabla" id="Tabla" value="" form="form-comprobante">
        <input type="hidden" id="intIdProveedorC" name="intIdProveedor" value="" form="form-comprobante">
        <input type="hidden" id="intIdClienteC" name="intIdCliente" value="" form="form-comprobante">
      </div>
    </div>
    <div class="col-md-10">
      <div class="form-group" id="resultadocrud">
      </div>
    </div>
  </div>
<!-- FIN - Formulario Realizar Venta -->