<!-- INICIO Tabla - Repuestos -->
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
          <?php if($intTipoDetalle == 1 && $intIdTipoComprobante == 0) { ?>
          <th style="width: 110px" >Precio Lista</th>
          <th style="width: 110px" >Desc. (%)</th>
          <?php } ?>
          <th style="width: 110px" >Precio Unit.</th>
          <th style="width: 110px" >Cantidad</th>
          <th style="width: 110px" >Total</th>
          <th style="width: 25px !important" class="opcion-columna-nuevo"></th>
        </tr>
        </thead>
        <tbody id="ListaDeProductosVender">
          <tr>
            <td class="heading" data-th="ID"></td>
            <td>
                <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-comprobante" />
                <input style="width: 110px !important" type="hidden" id="intIdProducto1" name="intIdProducto[]" form="form-comprobante" />
                <input style="width: 110px !important" type="text" class="buscar" id="nvchCodigo1" name="nvchCodigo[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>
                <div class="result" id="result1">
            </td>
            <td>
                <input type="text" style="width: 100%" id="nvchDescripcion1" name="nvchDescripcion[]" form="form-comprobante" class="" readonly/>
            </td>
            <?php if($intTipoDetalle == 1 && $intIdTipoComprobante == 0) { ?>
            <td>
                <input type="text" id="dcmPrecio1" name="dcmPrecio[]" form="form-comprobante" class="" readonly />
                <input type="hidden" id="dcmDescuentoVenta21" form="form-comprobante" readonly />
                <input type="hidden" id="dcmDescuentoVenta31" form="form-comprobante" readonly />
            </td>
            <td>
                <input style="max-width: 105px !important" type="text" id="dcmDescuento1" name="dcmDescuento[]" form="form-comprobante" class="" idsprt="1" 
                onkeyup="CalcularPrecioTotal(this)"/>
            </td>
            <?php } ?>
            <td>
                <input style="max-width: 105px !important"  type="text" id="dcmPrecioUnitario1" name="dcmPrecioUnitario[]" form="form-comprobante" onkeyup="CalcularPrecioTotal(this)" idsprt="1" class="" <?php if($intTipoDetalle == 1 && $intIdTipoComprobante == 0) { ?> readonly <?php } ?> />
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
            <td class="heading" data-th="ID"></td>
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
            <td class="heading" data-th="ID"></td>
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
            <td class="heading" data-th="ID"></td>
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
              <input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioI1" name="dcmPrecioUnitarioI[]" idsprt="1" form="form-comprobante" onkeyup="CalcularPrecioTotalM(this)" class=""/>
            </td>
            <td> 
              <input type="text" id="intCantidadI1" name="intCantidadI[]" idsprt="1" form="form-comprobante" 
              onkeyup="CalcularPrecioTotalM(this)" class=""/>           
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