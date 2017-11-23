<!-- TABLE: LATEST USERS -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#formRealizarComprobante" id="btnFormRealizarComprobante" data-toggle="tab" aria-expanded="true">Realizar <?php echo $lblTituloSingular; ?></a></li>
          <li class=""><a href="#formListarComprobante" id="btnFormListarComprobante" data-toggle="tab" aria-expanded="false">Lista de <?php echo $lblTituloPlural; ?></a></li>
        </ul>
        <div class="tab-content">
          <!-- INICIO - Formulario Realizar Venta -->
          <form id="form-comprobante" method="POST"></form>
          <div class="tab-pane active" id="formRealizarComprobante">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Fecha Actual:</label>
                  <input type="text" id="nvchFecha" name="nvchFecha" class="form-control select2" readonly form="form-comprobante"/>
                  <script type="text/javascript">$("#nvchFecha").val(FechaActual());</script>
                </div>
              </div>
              <?php if($intTipoDetalle != 2) { ?> 
              <div class="col-md-2">
                <div class="form-group">
                  <label>Lugar de <?php echo $lblTituloSingular; ?>:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="intIdSucursal" name="intIdSucursal"  class="form-control select2" form="form-comprobante">
                  <?php 
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
              <?php } ?>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo de Comprobante:</label>
                  <select <?php if($intTipoDetalle != 2) echo 'onchange="MostrarSeleccionComprobante()"'; ?> id="intIdTipoComprobante" name="intIdTipoComprobante"  class="form-control select2" form="form-comprobante">
                  <?php 
                    try{
                    $sql_conexion = new Conexion_BD();
                    $sql_conectar = $sql_conexion->Conectar();
                    $sql_comando = $sql_conectar->prepare('CALL mostrartipocomprobante(:intTipoDetalle)');
                    $sql_comando->execute(array(':intTipoDetalle' => $intTipoDetalle));
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
                <div class="form-group">
                  <label>Serie:</label>
                  <input type="text" id="nvchSerie" name="nvchSerie" class="form-control select2" form="form-comprobante"
                  <?php if($intTipoDetalle != 2) echo 'readonly'; ?>/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Numeración:</label>
                  <input type="text" id="nvchNumeracion" name="nvchNumeracion" class="form-control select2" form="form-comprobante" <?php if($intTipoDetalle != 2) echo 'readonly'; ?>/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Seleccionar el Tipo de Venta:</label>
                  <select id="intIdTipoVenta" name="intIdTipoVenta" onchange="ElegirTabla(this.value)" class="form-control select2" form="form-comprobante">
                    <?php try{
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
              <?php if($intTipoDetalle != 2) { ?><script type="text/javascript">MostrarSeleccionComprobante();</script><?php } ?>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo de Moneda:</label>
                  <select id="intIdTipoMoneda" name="intIdTipoMoneda" class="form-control select2" onchange="CambiarMoneda()" form="form-comprobante">
                    <?php try{
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
                    <?php try{
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
              <div class="col-md-2 opcion-boton-nuevo">
                <div class="form-group">
                  <label>Seleccionar Cliente:</label>
                  <input type="button" class="form-control select2 btn btn-md btn-primary btn-flat" value="Buscar" onclick="formCliente()">
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
            <div class="row">
              <div class="col-md-2 opcion-boton-nuevo">
                <div class="form-group">
                  <label>Agregar Fila:</label>
                  <input type="button" onclick="AgregarFila($('#intIdTipoVenta').val())" value="Agregar +" class="form-control select2 btn btn-md btn-primary btn-flat" />
                </div>
              </div>
              <div class="col-md-2 opcion-boton-nuevo">
                <div class="form-group">
                  <label>Seleccionar Cotización:</label>
                  <input type="button" onclick="formCotizacion()" value="Agregar +" class="form-control select2 btn btn-md btn-primary btn-flat" />
                </div>
              </div>
            </div>

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
                      <th style="width: 110px" >Precio Lista</th>
                      <th style="width: 110px" >Desc. (%)</th>
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
                            <input style="width: 110px !important" type="text" class="buscar " id="nvchCodigo1" name="nvchCodigo[]" form="form-comprobante" onkeydown="return TeclaSeleccionCodigo(event)"/>
                            <div class="result" id="result1">
                        </td>
                        <td>
                            <input type="text" style="width: 100%" id="nvchDescripcion1" name="nvchDescripcion[]" form="form-comprobante" class="" readonly/>
                        </td>
                        <td>
                            <input type="text" id="dcmPrecio1" name="dcmPrecio[]" form="form-comprobante" class="" readonly />
                            <input type="hidden" id="dcmDescuentoVenta21" form="form-comprobante" readonly />
                            <input type="hidden" id="dcmDescuentoVenta31" form="form-comprobante" readonly />
                        </td>
                        <td>
                            <input style="max-width: 105px !important" type="text" id="dcmDescuento1" name="dcmDescuento[]" form="form-comprobante" class="" idsprt="1" 
                          onkeyup="CalcularPrecioTotal(this)"/>
                        </td>
                        <td>
                            <input style="max-width: 105px !important"  type="text" id="dcmPrecioUnitario1" name="dcmPrecioUnitario[]" form="form-comprobante" class="" readonly/>
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
                          <textarea id="nvchDescripcionM1" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionM[]" form="form-comprobante" rows="4"></textarea>
                          <!--<input type="text" style="width: 100%" id="nvchDescripcionS1" name="nvchDescripcionS[]" form="form-comprobante" />-->
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
            <script type="text/javascript">ElegirTabla(1);</script>

            <div class="row">
              <div class="col-md-9">
              </div>
              <div class="col-md-3">
                <div class="row col-lg-12">
                  <table border="1" class="ExcelTable2007 rwd-table" width="100%">
                    <tbody>
                      <tr>
                          <th>Valor de <?php echo $lblTituloSingular; ?></th>
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
                          <th><?php echo $lblTituloSingular; ?> Total</th>
                          <td style="width: 120px !important">
                              <input type="text" id="ComprobanteTotal" name="ComprobanteTotal" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/>
                          </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <!--div class="form-group">
                  <label>Valor de Venta:</label>
                  <input type="text" id="ValorVenta" name="ValorVenta" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/><br>
                  <label>IGV (18%):</label>
                  <input type="text" id="IGVVenta" name="IGVVenta" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/><br>
                  <label>Venta Total:</label>
                  <input type="text" id="VentaTotal" name="VentaTotal" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/>
                </div-->
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
                  <input type="hidden" id="intTipoDetalle" name="intTipoDetalle" value="<?php echo $intTipoDetalle; ?>" form="form-comprobante">
                  <input type="hidden" name="funcion" value="I" form="form-comprobante">
                  <input type="hidden" id="intIdProveedor" name="intIdProveedor" value="" form="form-comprobante">
                  <input type="hidden" id="intIdCliente" name="intIdCliente" value="" form="form-comprobante">
                  <div class="text-center">
                    <input type="button" id="btn-crear-comprobante" class="btn btn-md btn-primary opcion-boton-nuevo" value="Realizar <?php echo $lblTituloSingular; ?>" form="form-comprobante">
                    <input type="button" onclick="NuevoComprobante()" class="btn btn-md btn-success" value="Nueva <?php echo $lblTituloSingular; ?>" form="form-comprobante">
                  </div>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group" id="resultadocrud">
                </div>
              </div>
            </div>
          </div>
          <!-- FIN - Formulario Realizar Venta -->

          <!-- INICIO - Formulario Listar Venta -->
          <div class="tab-pane" id="formListarComprobante">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Mostrar:</label>
                  <br>
                  <select id="num-lista" name="num-lista"  class="form-control select2">
                    <option value="10">Ver 10 Resultados</option>
                    <option value="25">Ver 25 Resultados</option>
                    <option value="50">Ver 50 Resultados</option>
                    <option value="100">Ver 100 Resultados</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                    <label class="text-left">Ingresar Búsqueda:</label>
                    <input type="text" name="txt-busqueda" id="txt-busqueda" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo Comprobante:</label>
                  <br>
                  <select id="lista-comprobante" name="lista-comprobante"  class="form-control select2">
                    <?php 
                      try{
                      $sql_conexion = new Conexion_BD();
                      $sql_conectar = $sql_conexion->Conectar();
                      $sql_comando = $sql_conectar->prepare('CALL mostrartipocomprobante(:intTipoDetalle)');
                      $sql_comando->execute(array(':intTipoDetalle' => $intTipoDetalle));
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
              <div class="col-md-6">
              <div class="text-right">
                <div class="form-group">
                  <input type="button" onclick="NuevoComprobante()" class="btn btn-md btn-primary" form="form-comprobante" value="Nueva <?php echo $lblTituloSingular; ?>"/>
                </div>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo Moneda:</label>
                  <br>
                  <select id="lista-tipo-moneda" class="form-control select2">
                    <?php 
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
                    <label class="text-left">Fecha Inicial:</label>
                    <input type="text" id="dtmFechaInicial" class="form-control select2" placeholder="dd/mm/aaaa" value="">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                    <label class="text-left">Fecha Final:</label>
                    <input type="text" id="dtmFechaFinal" class="form-control select2" placeholder="dd/mm/aaaa" value="">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                    <label class="text-left">Opción:</label>
                    <input type="button" id="btnBuscar" class="form-control select2 btn btn-md btn-primary btn-flat" value="Realizar Búsqueda">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                    <label class="text-left">Total de <?php echo $lblTituloPlural; ?>:</label>
                    <input type="text" id="TotalComprobante" class="form-control select2" placeholder="0.00" readonly>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="ExcelTable2007 rwd-table" width="100%">
                <thead>
                <tr>
                  <th class="heading" width="25px">&nbsp;</th>
                  <th class="listaNumFactura">Número de Factura</th>
                  <th class="listaNumBoletaVenta">Número de Boleta</th>
                  <th class="listaNumNotaCredito">Número de Nota de Crédito</th>
                  <th class="listaNumGuiaRemision">Número de Guía de Remisión</th>
                  <th>Cliente</th>
                  <th>Usuario que Generó</th>
                  <th>Fecha de Creación</th>
                  <th>Valor de <?php echo $lblTituloSingular; ?></th>
                  <th>IGV</th>
                  <th><?php echo $lblTituloSingular; ?> Total</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="ListaDeComprobantes">
                  <script>ListarComprobante(0,10,"T");</script>
                </tbody>
              </table>
              <script>AccionCabecerasTablaComprobante(1);</script>
            </div>
            <hr>
            <div class="text-center">
              <nav aria-label="...">
                <ul id="PaginacionDeComprobante" class="pagination">
                  <script>PaginarComprobante(0,10,"T");</script>
                </ul>
              </nav>
            </div>
            <script type="text/javascript">TotalComprobante();</script>
            <!--
            <div class="row">
              
            </div>
            -->
          </div>
          <!-- FIN - Formulario Listar Venta -->
        </div>
      </div>