<!-- INICIO Tabla - Repuestos -->
<div id="tablaRepuestos">
<div class="row">
  <div class="col-md-12">
    <!-- Comentar-->
    <div class="table-responsive" style="max-height: 310px; overflow-y: visible;" id="scrool-slim">
      <table class="ExcelTable2007 rwd-table" width="100%">
        <thead>
        <tr>
          <!--th class="heading" width="25px">&nbsp;</th-->
          <th class="" width="25px" style="background: #a9c4e9">
            <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
          </th>
          <th style="width: 110px" >Código</th>
          <th>Descripción</th>
          <th style="width: 7% !important">Huancayo</th>
          <th style="width: 8.5% !important">San Jerónimo</th>
          <?php if($intTipoDetalle == 1) { ?>
          <th style="width: 7% !important" class="filaPrecio">Precio Lista</th>
          <th style="width: 6% !important" class="filaDescuento">Desc. (%)</th>
          <?php } ?>
          <th style="width: 7% !important" class="filaPrecioUnitario">Precio Unit.</th>
          <th style="width: 4.32% !important" >Cant.</th>
          <th style="width: 7% !important" class="filaTotal">Total</th>
          <th style="width: 25px !important" class="opcion-columna-nuevo"></th>
        </tr>
        </thead>
        <tbody id="ListaDeProductosVender">
          <tr>
            <td class="heading" data-th="ID">1</td>
            <td>
                <input style="width: 100%" type="hidden" name="fila[]" value="1" form="form-comprobante" />
                <input style="width: 100%" type="hidden" id="intIdProducto1" name="intIdProducto[]" form="form-comprobante" />
                <input style="width: 100%" type="text" class="buscar" id="nvchCodigo1" name="nvchCodigo[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>
                <div class="result" id="result1">
            </td>
            <td>
                <input type="text" style="width: 100%" id="nvchDescripcion1" name="nvchDescripcion[]" form="form-comprobante" class="" readonly/>
            </td>
            <td class="filaUbigeoHuancayo">
                <input type="text" style="width: 100%" id="UbigeoHuancayo1" form="form-comprobante" class="" readonly/>
            </td>
            <td class="filaUbigeoSanJeronimo">
                <input type="text" style="width: 100%" id="UbigeoSanJeronimo1" form="form-comprobante" class="" readonly/>
            </td>
            <!--
            <td class="filaUbicacionHuancayo">
                <input type="text" style="width: 80%" id="UbicacionHuancayo1" name="UbicacionHuancayo[]" form="form-comprobante" class="" readonly/>
            </td>
            <td class="filaCantidadHuancayo">
                <input type="text" style="width: 70%" id="CantidadHuancayo1" name="CantidadHuancayo[]" form="form-comprobante" class="" readonly/>
            </td>
            <td class="filaUbicacionSanJeronimo">
                <input type="text" style="width: 80%" id="UbicacionHuancayo1" name="UbicacionSanJeronimo[]" form="form-comprobante" class="" readonly/>
            </td>
            <td class="filaCantidadSanJeronimo">
                <input type="text" style="width: 70%" id="CantidadSanJeronimo1" name="CantidadSanJeronimo[]" form="form-comprobante" class="" readonly/>
            </td>
            -->
            <?php if($intTipoDetalle == 1) { ?>
            <td class="filaPrecio">
                <input type="text" style="text-align: right; width: 100% !important" id="dcmPrecio1" name="dcmPrecio[]" form="form-comprobante" class="" readonly />
                <input type="hidden" style="text-align: right;  width: 100% !important" id="dcmDescuentoVenta21" form="form-comprobante" readonly />
                <input type="hidden" style="text-align: right;  width: 100% !important" id="dcmDescuentoVenta31" form="form-comprobante" readonly />
            </td>
            <td class="filaDescuento">
                <input style="width: 100% !important" type="text" id="dcmDescuento1" name="dcmDescuento[]" form="form-comprobante" class="" idsprt="1" 
                onkeyup="CalcularPrecioTotal(this)"/>
            </td>
            <?php } ?>
            <td class="filaPrecioUnitario">
                <input style="width: 100% !important; text-align: right !important;"  type="text" id="dcmPrecioUnitario1" name="dcmPrecioUnitario[]" form="form-comprobante" onkeyup="CalcularPrecioTotal(this)" idsprt="1" class="txtPrecioUnitario" <?php if($intTipoDetalle == 1) { ?> readonly="true" <?php } ?> />
            </td>
            <td>
                <input type="text" id="intCantidad1" name="intCantidad[]" style="text-align: right !important; width: 100% !important" form="form-comprobante" idsprt="1"
              onkeyup="CalcularPrecioTotal(this)" class=""/>
            </td>
            <td class="filaTotal">
                <input type="text" id="dcmTotal1" name="dcmTotal[]" class="" style="text-align: right !important; width: 100%" form="form-comprobante" readonly/>
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
          <!--th class="heading" width="25px">&nbsp;</th-->
          <th class="" width="25px" style="background: #a9c4e9">
            <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
          </th>
          <th>Descripción</th>
          <th style="width: 9% !important" >Precio Unit.</th>
          <th style="width: 5% !important" >Cantidad</th>
          <th style="width: 9% !important" >Total</th>
          <th style="width: 25px !important" class="opcion-columna-nuevo"></th>
        </tr>
        </thead>
        <tbody id="ListaDeServiciosVender">
          <tr>
            <td class="heading" data-th="ID">1</td>
            <td>
              <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-comprobante" />
              <textarea id="nvchDescripcionS1" style="resize: vertical;" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionS[]" form="form-comprobante" rows="4"></textarea>
              <!--<input type="text" style="width: 100%" id="nvchDescripcionS1" name="nvchDescripcionS[]" form="form-comprobante" />-->
            </td>
            <td>
              <input style="max-width: 100% !important; text-align: right !important;" type="text" id="dcmPrecioUnitarioS1" name="dcmPrecioUnitarioS[]" idsprt="1" form="form-comprobante" onkeyup="CalcularPrecioTotalS(this)" class=""/>
            </td>
            <td> 
              <input type="text" id="intCantidadS1" style="text-align: right !important; width: 100% !important" name="intCantidadS[]" idsprt="1" form="form-comprobante" 
              onkeyup="CalcularPrecioTotalS(this)" class=""/>           
            </td>
            <td>
              <input type="text" id="dcmTotalS1" style="text-align: right !important; width: 100% !important" name="dcmTotalS[]" form="form-comprobante" class="" readonly/>
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
          <!--th class="heading" width="25px">&nbsp;</th-->
          <th class="" width="25px" style="background: #a9c4e9">
            <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
          </th>
          <th style="width: 110px" >Código</th>
          <th>Descripción</th>
          <th style="width: 8.5% !important" >Huancayo</th>
          <th style="width: 8.5% !important" >San Jerónimo</th>
          <th style="width: 7.4% !important" class="filaPrecioUnitario">Precio Unit.</th>
          <th style="width: 5% !important" >Cant.</th>
          <th style="width: 8%" class="filaTotal">Total</th>
          <th style="width: 25px !important" class="opcion-columna-nuevo"></th>
        </tr>
        </thead>
        <tbody id="ListaDeMaquinariasVender">
          <tr>
            <td class="heading" data-th="ID">1</td>
            <td>
                <input style="width: 100% !important" type="hidden" name="fila[]" value="1" form="form-comprobante" />
                <input style="width: 100% !important" type="hidden" id="intIdProductoM1" name="intIdProductoM[]" form="form-comprobante" />
                <input style="width: 100% !important" type="text" class="buscar" id="nvchCodigoM1" name="nvchCodigoM[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>
                <div class="result" id="resultM1">
            </td>
            <td>
              <input style="width: 100% !important; resize: vertical;" type="hidden" name="fila[]" value="1" form="form-comprobante" />
              <textarea id="nvchDescripcionM1" style="resize: vertical;" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionM[]" form="form-comprobante" rows="4"></textarea>
            </td>
            <td class="filaUbigeoHuancayo">
                <input type="text" style="width: 100% !important; text-align: right;" id="UbigeoHuancayoM1" form="form-comprobante" class="" readonly/>
            </td>
            <td class="filaUbigeoSanJeronimo">
                <input type="text" style="width: 100% !important; text-align: right;" id="UbigeoSanJeronimoM1" form="form-comprobante" class="" readonly/>
            </td>
            <td class="filaPrecioUnitario">
              <input style="width: 100% !important; text-align: right;" type="text" id="dcmPrecioUnitarioM1" name="dcmPrecioUnitarioM[]" idsprt="1" form="form-comprobante" onkeyup="CalcularPrecioTotalM(this)"
              class="" />
            </td>
            <td> 
              <input type="text" id="intCantidadM1" name="intCantidadM[]" style="width: 100% !important; text-align: right;" idsprt="1" form="form-comprobante" 
              onkeyup="CalcularPrecioTotalM(this)" class=""/>           
            </td>
            <td class="filaTotal">
              <input type="text" id="dcmTotalM1" name="dcmTotalM[]" form="form-comprobante" style="width: 100% !important; text-align: right;" class="" readonly/>
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
            <!--th class="heading" width="25px">&nbsp;</th-->
            <th class="" width="25px" style="background: #a9c4e9">
              <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
            </th>
            <th style="width: 110px" >Código</th>
            <th style="" >Descripción</th>
            <th style="width: 8.5%" >Huancayo</th>
            <th style="width: 8.5%" >San Jerónimo</th>
            <th style="width: 8.5%" class="filaPrecioUnitario">Precio Unit.</th>
            <th style="width: 5%" >Cant.</th>
            <th style="width: 9% !important" class="filaTotal">Total</th>
            <th style="width: 25px !important" class="opcion-columna-nuevo"></th>
          </tr>
          </thead>
          <tbody id="ListaDeImplementosVender">
            <tr>
              <td class="heading" data-th="ID">1</td>
              <td>
                  <input style="width: 100% !important;" type="hidden" name="fila[]" value="1" form="form-comprobante" />
                  <input style="width: 100% !important;" type="hidden" id="intIdProductoI1" name="intIdProductoI[]" form="form-comprobante" />
                  <input style="width: 100% !important;" type="text" class="buscar" id="nvchCodigoI1" name="nvchCodigoI[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>
                  <div class="result" id="resultI1">
              </td>
              <td>
                <input style="width: 100% !important; text-align: right" type="hidden" name="fila[]" value="1" form="form-comprobante" />
                <textarea id="nvchDescripcionI1" style="resize: vertical;" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionI[]" form="form-comprobante" rows="4"></textarea>
              </td>
              <td class="filaUbigeoHuancayo">
                  <input type="text" style="width: 100%; text-align: right;" id="UbigeoHuancayoI1" form="form-comprobante" class="" readonly/>
              </td>
              <td class="filaUbigeoSanJeronimo">
                  <input type="text" style="width: 100%; text-align: right;" id="UbigeoSanJeronimoI1" form="form-comprobante" class="" readonly/>
              </td>
              <td class="filaPrecioUnitario">
                <input style="width: 100% !important; text-align: right;" type="text" id="dcmPrecioUnitarioI1" name="dcmPrecioUnitarioI[]" idsprt="1" form="form-comprobante" onkeyup="CalcularPrecioTotalI(this)"
                class="" />
              </td>
              <td> 
                <input type="text" id="intCantidadI1" name="intCantidadI[]" idsprt="1" form="form-comprobante"   style="text-align: right; width: 100% !important" onkeyup="CalcularPrecioTotalI(this)" class=""/>           
              </td>
              <td class="filaTotal">
                <input type="text" id="dcmTotalI1" name="dcmTotalI[]" style="text-align: right !important; width: 100% !important" form="form-comprobante" class="" readonly/>
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