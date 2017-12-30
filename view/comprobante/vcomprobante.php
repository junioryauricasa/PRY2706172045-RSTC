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

            <div class="row" style="margin-top:20px; margin-bottom: 20px">
              <div class="col-md-12">
                <div class="" style="text-align: right;">
                  <input type="button" id="btn-crear-comprobante" class="btn btn-sm btn-primary btn-flat opcion-boton-nuevo" value="Realizar <?php echo $lblTituloSingular; ?>" form="form-comprobante">
                  <input type="button" id="btn-editar-comprobante" class="btn btn-sm btn-primary btn-flat opcion-boton-editar" value="Modificar <?php echo $lblTituloSingular; ?>" form="form-comprobante">
                  <input type="button" onclick="NuevoComprobante(); <?php if($intTipoDetalle == 1) echo 'MostrarSeleccionComprobante();' ?>" class="btn btn-sm btn-success btn-flat " value="Nueva <?php echo $lblTituloSingular; ?>" form="form-comprobante">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2">
                <div id="nvchFechaGroup" class="form-group">
                  <label>Fecha:</label>
                  <div id="groupFecha" class="input-group">
                    <input type="text" id="nvchFecha" name="nvchFecha" class="form-control select2" placeholder="dd/mm/aaaa HH:mm:ss" maxlength="19" onkeyup="EsFechaHora('nvchFecha')" form="form-comprobante" readonly/>
                    <span class="input-group-btn">
                      <button class="btn btn-success" type="button" onclick="OpcionFecha($('#txtOpcionFecha').val())">
                        <i class="fa fa-edit" data-toggle="tooltip" title="" id="iconOpFecha" data-original-title="Modificar"></i>
                      </button>
                    </span>
                    <input type="hidden" id="txtOpcionFecha" value="1">
                  </div>
                  <!--<span id="nvchFechaIcono" class="" aria-hidden=""></span>-->
                  <div id="nvchFechaObs" class=""></div>
                  <!--<script type="text/javascript">$("#nvchFecha").val(FechaActual());</script>-->
                </div>
              </div>
              <script type="text/javascript">IniciarHora();</script>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Lugar de <?php echo $lblTituloSingular; ?>:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="intIdSucursalC" name="intIdSucursal"  class="form-control select2" form="form-comprobante">
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
                  <select onchange="MostrarSeleccionComprobante()" id="intIdTipoComprobante" name="intIdTipoComprobante"  class="form-control select2" form="form-comprobante">
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
                  <label>Tipo de <?php echo $lblTituloSingular; ?>:</label>
                  <!--label>Seleccionar el Tipo de <?php echo $lblTituloSingular; ?>:</label-->
                  <select id="intIdTipoVenta" name="intIdTipoVenta" onchange="ElegirTabla(this.value)" class="form-control select2" form="form-comprobante">
                    <?php try{
                      $sql_conexion = new Conexion_BD();
                      $sql_conectar = $sql_conexion->Conectar();
                      if($intTipoDetalle == 1)
                        $sql_comando = $sql_conectar->prepare('CALL mostrartipoventa()');
                      else if($intTipoDetalle == 2)
                        $sql_comando = $sql_conectar->prepare('CALL mostrartipoventacompras()');
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
              <div id="intIdUsuarioSolicitadoCol" class="col-md-3">
                <div class="form-group">
                  <label>Usuario que Solicitó:</label>
                  <select id="intIdUsuarioSolicitado" name="intIdUsuarioSolicitado"  class="form-control select2"
                  form="form-comprobante">
                  <?php 
                    try{
                        $sql_conexion = new Conexion_BD();
                        $sql_conectar = $sql_conexion->Conectar();
                        $sql_comando = $sql_conectar->prepare('CALL listarusuarios()');
                        $sql_comando->execute();
                        while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                        {
                          echo '<option value="'.$fila['intIdUsuario'].'">'.$fila['NombreUsuario'].'</option>';
                        }
                      }catch(PDPExceptions $e){
                        echo $e->getMessage();
                  }?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div id="nvchAtencionCol" class="col-md-3">
                <div id="nvchAtencionGroup" class="form-group">
                  <label>Atención:</label>
                  <input type="text" id="nvchAtencion" name="nvchAtencion" class="form-control select2" placeholder="Ingrese Atención" value="" onkeyup="EsVacioOp('nvchAtencion')" maxlength="150" 
                  form="form-comprobante">
                  <span id="nvchAtencionIcono" class="" aria-hidden=""></span>
                  <div id="nvchAtencionObs" class=""></div>
                </div>
              </div>
              <div id="nvchDestinoCol" class="col-md-3">
                <div id="nvchDestinoGroup" class="form-group">
                  <label>Destino:</label>
                  <input type="text" id="nvchDestino" name="nvchDestino" class="form-control select2" placeholder="Ingrese Destino" value="" onkeyup="EsVacioOp('nvchDestino')" maxlength="500" 
                  form="form-comprobante">
                  <span id="nvchDestinoIcono" class="" aria-hidden=""></span>
                  <div id="nvchDestinoObs" class=""></div>
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
              <div id="dtmFechaTrasladoCol" class="col-md-2">
                <div id="dtmFechaTrasladoGroup" class="form-group">
                  <label>Fecha de Traslado:</label>
                  <input type="text" id="dtmFechaTraslado" name="dtmFechaTraslado" class="form-control select2" placeholder="Ingrese Punto de Partida" value="" onkeyup="EsFecha('dtmFechaTraslado')" 
                  maxlength="500" form="form-comprobante">
                  <span id="dtmFechaTrasladoIcono" class="" aria-hidden=""></span>
                  <div id="dtmFechaTrasladoObs" class=""></div>
                  <script type="text/javascript">$("#dtmFechaTraslado").val(FechaActual());</script>
                </div>
              </div>
              <div id="nvchPuntoPartidaCol" class="col-md-3">
                <div id="nvchPuntoPartidaGroup" class="form-group">
                  <label>Punto de Partida:</label>
                  <input type="text" id="nvchPuntoPartida" name="nvchPuntoPartida" class="form-control select2" placeholder="Ingrese Punto de Partida" value="" onkeyup="EsVacio('nvchPuntoPartida')" 
                  maxlength="500" form="form-comprobante">
                  <span id="nvchPuntoPartidaIcono" class="" aria-hidden=""></span>
                  <div id="nvchPuntoPartidaObs" class=""></div>
                </div>
              </div>
              <div id="nvchPuntoLlegadaCol" class="col-md-3">
                <div id="nvchPuntoLlegadaGroup" class="form-group">
                  <label>Punto de Llegada:</label>
                  <input type="text" id="nvchPuntoLlegada" name="nvchPuntoLlegada" class="form-control select2" placeholder="Ingrese Punto de Llegada" value="" onkeyup="EsVacio('nvchPuntoLlegada')" 
                  maxlength="500" form="form-comprobante">
                  <span id="nvchPuntoLlegadaIcono" class="" aria-hidden=""></span>
                  <div id="nvchPuntoLlegadaObs" class=""></div>
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
              <?php if($intTipoDetalle == 1) { ?>
              <div id="btnAgregarCotizacion" class="col-md-2 opcion-boton-nuevo">
                <div class="form-group">
                  <label>Seleccionar Cotización:</label>
                  <input type="button" onclick="formCotizacion()" value="Agregar +" class="form-control select2 btn btn-md btn-primary btn-flat" />
                </div>
              </div>
               <div id="btnDescontarGR" class="col-md-2 opcion-boton-nuevo">
                <div class="form-group">
                  <label>¿ Descontar ?:</label>
                  <select id="intDescontarGR" name="intDescontarGR" class="form-control select2"
                  form="form-comprobante">
                  <option value="0">No</option>
                  <option value="1">Sí</option>
                  </select>
                </div>
              </div>
              <div id="btnAgregarVenta" class="col-md-2 opcion-boton-nuevo">
                <div class="form-group">
                  <label>Seleccionar Venta:</label>
                  <input type="button" onclick="formComprobanteVenta()" value="Agregar +" class="form-control select2 btn btn-md btn-primary btn-flat" />
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
                      <div>
                      <tr class="txtTotales">
                          <th>Valor de <?php echo $lblTituloSingular; ?></th>
                          <td style="width: 120px !important">
                              <input type="text" id="ValorComprobante" name="ValorComprobante" style="text-align: right;" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/>
                          </td>
                      </tr>
                      <tr class="txtTotales">
                          <th>IGV (18%)</th>
                          <td style="width: 120px !important">
                              <input type="text" id="IGVComprobante" name="IGVComprobante" style="text-align: right;" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/>
                          </td>
                      </tr>
                      <tr class="txtTotales">
                          <th><?php echo $lblTituloSingular; ?> Total</th>
                          <td style="width: 120px !important">
                              <input type="text" id="ComprobanteTotal" name="ComprobanteTotal" style="text-align: right;" class="form-control select2" value="S/. 0.00" readonly form="form-comprobante"/>
                          </td>
                      </tr>
                      </div>
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
                  <textarea id="nvchObservacion" style="resize: vertical;" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-comprobante" rows="6"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="hidden" id="intIdComprobante" name="intIdComprobante" value="" form="form-comprobante">
                  <input type="hidden" id="intIdComprobanteReferencia" name="intIdComprobanteReferencia" value="" form="form-comprobante">
                  <input type="hidden" id="intTipoDetalle" name="intTipoDetalle" value="<?php echo $intTipoDetalle; ?>" form="form-comprobante">
                  <input type="hidden" id="intIdTipoComprobanteI" name="intIdTipoComprobanteI" value="<?php echo $intIdTipoComprobante; ?>" form="form-comprobante">
                  <input type="hidden" name="funcion" id="funcionC" value="" form="form-comprobante">
                  <input type="hidden" name="Letra" id="Letra" value="" form="form-comprobante">
                  <input type="hidden" name="Tabla" id="Tabla" value="" form="form-comprobante">
                  <input type="hidden" id="intIdProveedorC" name="intIdProveedor" value="" form="form-comprobante">
                  <input type="hidden" id="intIdClienteC" name="intIdCliente" value="" form="form-comprobante">
                  <div class="text-center">
                    
                  </div>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group" id="resultadocrud">
                </div>
              </div>
            </div>
            <script type="text/javascript">HabilitacionOpciones(1);</script>
          </div>
          <script type="text/javascript">MostrarSeleccionComprobante();</script>
          <!-- FIN - Formulario Realizar Venta -->

          <!-- INICIO - Formulario Listar Venta -->
          <div class="tab-pane" id="formListarComprobante">
            <div class="row" style="margin-top:20px; margin-bottom: 20px">
              <div class="col-md-12">
                <div class="" style="text-align: right;">
                  <button type="button" id="DescargarListaComprobanteExcel" class="btn btn-sm btn-success btn-flat" onclick=""><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar Reporte EXCEL</button> 
                </div>
              </div>
            </div>

            <div class="row">
              <?php include '../campos/cmbNumLista.php'; ?>
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
                    <option value="T">Todos los Comprobantes</option>
                    <?php 
                      try{
                      $sql_conexion = new Conexion_BD();
                      $sql_conectar = $sql_conexion->Conectar();
                      $sql_comando;
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
                    <input type="button" onclick="NuevoComprobante(); <?php if($intTipoDetalle == 1) echo 'MostrarSeleccionComprobante();' ?>" class="btn btn-md btn-primary" form="form-comprobante" value="Nueva <?php echo $lblTituloSingular; ?>"/>
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
                  <!--th class="heading" width="25px">&nbsp;</th-->
                  <th class="" width="25px" style="background: #a9c4e9">
                    <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                  </th>
                  <th>Serie</th>
                  <th>Numeración</th>
                  <th>Tipo Comprob.</th>
                  <!--
                  <th class="listaNumFactura">Número de Factura</th>
                  <th class="listaNumBoletaVenta">Número de Boleta</th>
                  <th class="listaNumNotaCredito">Número de Nota de Crédito</th>
                  <th class="listaNumGuiaRemision">Número de Guía de Remisión</th>
                  -->
                  <?php if($intTipoDetalle == 1) { ?>
                  <th>Cliente</th>
                  <?php } else if($intTipoDetalle == 2) { ?>
                  <th>Proveedor</th>
                  <?php } ?>
                  <th>Generado por </th>
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

            <br>
            <!--button type="button" id="DescargarListaComprobanteExcel" class="btn btn-sm btn-success btn-flat" onclick=""><i class="fa fa-download" aria-hidden="true"></i> Agregar Proveedor</button-->
            
            <script type="text/javascript">TotalComprobante();</script>
          </div>
          <!-- FIN - Formulario Listar Venta -->
        </div>
      </div>