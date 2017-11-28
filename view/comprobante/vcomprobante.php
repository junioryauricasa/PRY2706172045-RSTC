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
              <div class="col-md-2">
                <div class="form-group">
                  <label>Lugar de <?php echo $lblTituloSingular; ?>:</label>
                  <select <?php if($intTipoDetalle == 1 || $intIdTipoComprobante == 9 || $intIdTipoComprobante == 10) { ?> onchange="MostrarSeleccionComprobante()" <?php } ?> id="intIdSucursal" name="intIdSucursal"  class="form-control select2" form="form-comprobante">
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
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo de Comprobante:</label>
                  <select <?php if($intTipoDetalle == 1 || $intIdTipoComprobante != 0) echo 'onchange="MostrarSeleccionComprobante()"'; ?> id="intIdTipoComprobante" name="intIdTipoComprobante"  class="form-control select2" form="form-comprobante">
                  <?php 
                    try{
                    $sql_conexion = new Conexion_BD();
                    $sql_conectar = $sql_conexion->Conectar();
                    $sql_comando;
                    if($intIdTipoComprobante == 0){
                      $sql_comando = $sql_conectar->prepare('CALL mostrartipocomprobante(:intTipoDetalle)');
                      $sql_comando->execute(array(':intTipoDetalle' => $intTipoDetalle));
                    }
                    else if ($intIdTipoComprobante != 0){
                      $sql_comando = $sql_conectar->prepare('CALL mostrartipocomprobante_es(:intTipoDetalle,:intIdTipoComprobante)');
                      $sql_comando->execute(array(':intTipoDetalle' => $intTipoDetalle, ':intIdTipoComprobante' => $intIdTipoComprobante));
                    }
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
                  onkeypress="return EsNumeroEnteroTecla(event)" onkeyup="EsNumeroEntero('nvchSerie')"
                  maxlength="4" <?php if($intTipoDetalle == 1 || $intIdTipoComprobante == 9 || $intIdTipoComprobante == 10) echo 'readonly'; ?>/>
                  <span id="nvchSerieIcono" class="" aria-hidden=""></span>
                  <div id="nvchSerieObs" class=""></div>
                </div>
              </div>
              <div class="col-md-2">
                <div id="nvchNumeracionGroup" class="form-group">
                  <label>Numeración:</label>
                  <input type="text" id="nvchNumeracion" name="nvchNumeracion" class="form-control select2" 
                  form="form-comprobante" onkeypress="return EsNumeroEnteroTecla(event)" 
                  onkeyup="EsNumeroEntero('nvchNumeracion')" maxlength="8" <?php if($intTipoDetalle == 1 || $intIdTipoComprobante == 9 || $intIdTipoComprobante == 10) echo 'readonly'; ?>/>
                  <span id="nvchNumeracionIcono" class="" aria-hidden=""></span>
                  <div id="nvchNumeracionObs" class=""></div>
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
              <?php if($intTipoDetalle == 1 || $intIdTipoComprobante == 9 || $intIdTipoComprobante == 10) { ?><script type="text/javascript">MostrarSeleccionComprobante();</script><?php } ?>
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
                  <label>Seleccionar <?php echo $lblPersonaSingular; ?>:</label>
                  <input type="button" class="form-control select2 btn btn-md btn-primary btn-flat" value="Buscar" onclick="form<?php echo $lblPersonaSingular;?>()">
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
              <?php if($intTipoDetalle == 1) {?>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo de Cliente:</label>
                  <input type="text" id="TipoCliente" class="form-control select2" readonly>
                  <input type="hidden" id="intIdTipoCliente">
                </div>
              </div>
              <?php } ?>
            </div>
            <div class="row">
              <div class="col-md-2 opcion-boton-nuevo">
                <div class="form-group">
                  <label>Agregar Fila:</label>
                  <input type="button" onclick="AgregarFila($('#intIdTipoVenta').val())" value="Agregar +" class="form-control select2 btn btn-md btn-primary btn-flat" />
                </div>
              </div>
              <?php if($intTipoDetalle == 1 && $intIdTipoComprobante == 0) { ?>
              <div class="col-md-2 opcion-boton-nuevo">
                <div class="form-group">
                  <label>Seleccionar Cotización:</label>
                  <input type="button" onclick="formCotizacion()" value="Agregar +" class="form-control select2 btn btn-md btn-primary btn-flat" />
                </div>
              </div>
              <?php } ?>
            </div>

            <?php require_once '../comprobante/vtablacomprobante.php' ?>

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
                  <input type="hidden" id="intIdTipoComprobanteI" name="intIdTipoComprobanteI" value="<?php echo $intIdTipoComprobante; ?>" form="form-comprobante">
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
                  <?php if($intTipoDetalle == 1) { ?>
                  <th>Cliente</th>
                  <?php } else if($intTipoDetalle == 2) { ?>
                  <th>Proveedor</th>
                  <?php } ?>
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