<?php 
              
    $nvbr_inicio = '';
    $nvbr_infogeneral = '';
    // inventario
    $nvbr_inventario = '';
    $nvbr_inventario_registroproducto = '';
    $nvbr_inventario_ubigeoproducto = '';
    // compras
    $nvbr_compras = '';
    $nvbr_compras_registroproveedores = '';
    $nvbr_compras_registrocompras = '';
    $nvbr_compras_ordenesporcompra = '';
    // ventas
    $nvbr_ventas = 'active';
    $nvbr_ventas_registroclientes = '';
    $nvbr_ventas_registroventas = '';
    $nvbr_ventas_registrocotizacion = 'active';
    // reportes
    $nvbr_reportes = '';
    $nvbr_reportes_kardexproducto = '';
    $nvbr_reportes_kardexgeneral = '';
    // administrativo
    $nvbr_administrativo = '';
    $nvbr_administrativo_cambiomonedatributaria = '';
    $nvbr_administrativo_cambiomonedacomercial = '';
    $nvbr_administrativo_numeraciondecomprobantes = '';
    $nvbr_administrativo_modulousuarios = '';
    $nvbr_administrativo_modulousuarios_registrousuario = '';
    $nvbr_administrativo_modulousuarios_historialusuarios = '';
    // equipos
    $nvbr_equipos = '';
    // cuentas
    $nvbr_cuentas = '';
    $nvbr_cuentas_miperfil = '';
    $nvbr_cuentas_cerrarsession = '';


    include('../_include/rstheader.php');
    require_once '../../datos/conexion/bd_conexion.php';
?>  
    <?php require_once '../../negocio/comprobante/ncotizacion.php'; ?>
    <?php require_once '../../negocio/comprobante/ndetallecotizacion.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <?php require_once '../../view/modals/vformCliente.php'; ?>
    <?php require_once '../../view/modals/vformProducto.php'; ?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Registro de Cotizaciones
        <small>Módulo de Ventas</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- TABLE: LATEST USERS -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#formRealizarCotizacion" id="btnFormRealizarCotizacion" data-toggle="tab" aria-expanded="true">Realizar Cotización</a></li>
          <li class=""><a href="#formListarCotizacion" id="btnFormListarCotizacion" data-toggle="tab" aria-expanded="false">Lista de Cotizaciones</a></li>
        </ul>
        <div class="tab-content">
          <!-- INICIO - Formulario Realizar Venta -->
          <form id="form-cotizacion" method="POST"></form>
          <div class="tab-pane active" id="formRealizarCotizacion">
            <div class="row" style="margin-top:20px; margin-bottom: 20px">
              <div class="col-md-12">
                <div class="" style="text-align: right;">
                  <button id="btn-crear-cotizacion" class="btn btn-sm btn-success btn-flat opcion-boton-nuevo"><i class="fa fa-check-square" aria-hidden="true"></i> Realizar Cotización</button>
                  <button id="btn-editar-cotizacion" class="btn btn-sm btn-success btn-flat opcion-boton-editar"><i class="fa fa-check-square" aria-hidden="true"></i> Modificar Cotización</button>
                  <button onclick="NuevaCotizacion();" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Cotización</button>
                  <!--
                  <input type="button" id="btn-crear-cotizacion" class="btn btn-md btn-primary opcion-boton-nuevo" value="Realizar Cotización" form="form-cotizacion">
                     <input type="button" id="btn-editar-cotizacion" class="btn btn-md btn-primary opcion-boton-editar" value="Modificar Cotización" form="form-cotizacion">
                    <input type="button" onclick="NuevaCotizacion()" class="btn btn-md btn-success" value="Nueva Cotización" form="form-cotizacion">
                -->
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2">
                <div id="nvchFechaGroup" class="form-group">
                  <label>Fecha:</label>
                  <div id="groupFecha" class="input-group">
                    <input type="text" id="nvchFecha" name="nvchFecha" class="form-control select2" placeholder="dd/mm/aaaa HH:mm:ss" maxlength="19" onkeyup="EsFechaHora('nvchFecha')" form="form-cotizacion" readonly/>
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
              <div id="nvchNumeracionCol" class="col-md-2">
                <div id="nvchNumeracionGroup" class="form-group">
                  <label>Numeración:</label>
                  <input type="text" id="nvchNumeracion" name="nvchNumeracion" class="form-control select2" 
                  form="form-cotizacion" readonly/>
                  <input type="hidden" id="nvchSerie" name="nvchSerie" class="form-control select2" form="form-cotizacion" readonly/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Seleccionar el Tipo de Venta:</label>
                  <select id="intIdTipoVenta" name="intIdTipoVenta" onchange="ElegirTabla(this.value)" class="form-control select2" form="form-cotizacion">
                    <?php try{
                      $sql_conexion = new Conexion_BD();
                      $sql_conectar = $sql_conexion->Conectar();
                      $sql_comando = $sql_conectar->prepare('CALL mostrartipoventacotizacion()');
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
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo de Moneda:</label>
                  <select id="intIdTipoMoneda" name="intIdTipoMoneda" class="form-control select2" onchange="CambiarMoneda()" form="form-cotizacion">
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
                  <select id="intIdTipoPago" name="intIdTipoPago" class="form-control select2" form="form-cotizacion">
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
              <div class="col-md-2">
                <div id="intDiasValidezGroup" class="form-group">
                  <label>Validez de Oferta:</label>
                  <input type="text" id="intDiasValidez" name="intDiasValidez" class="form-control select2" placeholder="Ingrese número de días" 
                  value="" onkeypress="return EsNumeroEnteroTecla(event)" 
                  onkeyup="EsNumeroEntero('intDiasValidez')" maxlength="3" form="form-cotizacion">
                  <span id="intDiasValidezIcono" class="" aria-hidden=""></span>
                  <div id="intDiasValidezObs" class=""></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div id="nvchAtencionGroup" class="form-group">
                  <label>Atención:</label>
                  <input type="text" id="nvchAtencion" name="nvchAtencion" class="form-control select2" placeholder="Ingrese Atención" 
                  value="" onkeyup="EsVacio('nvchAtencion')" maxlength="250" form="form-cotizacion">
                  <span id="nvchAtencionIcono" class="" aria-hidden=""></span>
                  <div id="nvchAtencionObs" class=""></div>
                </div>
              </div>
              <div class="col-md-2">
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
                  <input type="text" id="nvchNumDocumento" name="nvchDNIRUC" class="form-control select2" form="form-cotizacion" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Razón Social/Nombres:</label>
                  <input type="text" id="nvchDenominacion" name="nvchClienteProveedor" class="form-control select2" form="form-cotizacion" readonly>
                </div>
              </div>   
              <div class="col-md-4">
                <div class="form-group">
                  <label>Domicilio:</label>
                  <input type="text" id="nvchDomicilio" name="nvchDireccion" class="form-control select2" form="form-cotizacion" readonly>
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
              <div id="nvchTipoCol" class="col-md-3">
                <div id="nvchTipoGroup" class="form-group">
                  <label>Tipo:</label>
                  <input type="text" id="nvchTipo" name="nvchTipo" class="form-control select2" 
                  placeholder="Ingrese la Descripción" maxlength="25" 
                  onkeyup="EsVacio('nvchTipo')"  form="form-cotizacion" required>
                  <span id="nvchTipoIcono" class="" aria-hidden=""></span>
                  <div id="nvchTipoObs" class=""></div>
                </div>
              </div>
              <div id="nvchModeloCol" class="col-md-3">
                <div id="nvchModeloGroup" class="form-group">
                  <label>Modelo:</label>
                  <input type="text" id="nvchModelo" name="nvchModelo" class="form-control select2" 
                  placeholder="Ingrese la Descripción" maxlength="75" 
                  onkeyup="EsVacio('nvchModelo')"  form="form-cotizacion" required>
                  <span id="nvchModeloIcono" class="" aria-hidden=""></span>
                  <div id="nvchModeloObs" class=""></div>
                </div>
              </div>
              <div id="nvchMarcaCol" class="col-md-3">
                <div id="nvchMarcaGroup" class="form-group">
                  <label>Marca:</label>
                  <input type="text" id="nvchMarca" name="nvchMarca" class="form-control select2" 
                  placeholder="Ingrese la Descripción" maxlength="75" 
                  onkeyup="EsVacio('nvchMarca')"  form="form-cotizacion" required>
                  <span id="nvchMarcaIcono" class="" aria-hidden=""></span>
                  <div id="nvchMarcaObs" class=""></div>
                </div>
              </div>
              <div id="nvchHorometroCol" class="col-md-3">
                <div id="nvchHorometroGroup" class="form-group">
                  <label>Horómetro:</label>
                  <input type="text" id="nvchHorometro" name="nvchHorometro" class="form-control select2" 
                  placeholder="Ingrese la Descripción" maxlength="65" 
                  onkeyup="EsVacio('nvchHorometro')"  form="form-cotizacion" required>
                  <span id="nvchHorometroIcono" class="" aria-hidden=""></span>
                  <div id="nvchHorometroObs" class=""></div>
                </div>
              </div>
            </div>
            <script type="text/javascript">CamposMaquinaria(1);</script>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Agregar Fila:</label>
                  <input type="button" onclick="AgregarFila($('#intIdTipoVenta').val())" value="Agregar +" class="form-control select2 btn btn-md btn-primary btn-flat" />
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
                      <!--th class="heading" width="25px">&nbsp;</th-->
                      <th class="" width="25px" style="background: #a9c4e9">
                        <img src="../../datos/usuarios/imgperfil/excel-2007-header-left.gif" alt="" align="right" style="padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                      </th>
                      <th style="width: 110px" >Código</th>
                      <th>Descripción</th>
                      <th>Huancayo</th>
                      <th>San Jerónimo</th>
                      <!--
                      <th class="filaUbicacionHuancayo">Ubigeo</th>
                      <th class="filaCantidadHuancayo">Cantidad</th>
                      <th class="filaUbicacionSanJeronimo">Ubigeo</th>
                      <th class="filaCantidadSanJeronimo">Cantidad</th>-->
                      <th style="width: 110px" >Precio Lista</th>
                      <th style="width: 110px" >Desc. (%)</th>
                      <th style="width: 110px" >Precio Unit.</th>
                      <th style="width: var(--anchoCampoTableFooter) !important" >Cantidad</th>
                      <th style="width: var(--anchoCampoTableFooter) !important" >Total</th>
                      <th style="width: 25px !important" ></th>
                    </tr>
                    </thead>
                    <tbody id="ListaDeProductosVender">
                      <tr>
                        <td class="heading" data-th="ID">1</td>
                        <td>
                            <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-cotizacion" />
                            <input style="width: 110px !important" type="hidden" id="intIdProducto1" name="intIdProducto[]" form="form-cotizacion" />
                            <input style="width: 110px !important" type="text" class="buscar" id="nvchCodigo1" name="nvchCodigo[]" form="form-cotizacion" onkeydown="return TeclaSeleccionCodigo(event)"/>
                            <div class="result" id="result1">
                        </td>
                        <td>
                            <input type="text" style="width: 100%" id="nvchDescripcion1" name="nvchDescripcion[]" form="form-cotizacion" readonly/>
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
                        </td>-->
                        <td>
                            <input type="text" id="dcmPrecio1" name="dcmPrecio[]" form="form-cotizacion" readonly />
                            <input type="hidden" id="dcmDescuentoVenta21" form="form-cotizacion" readonly />
                            <input type="hidden" id="dcmDescuentoVenta31" form="form-cotizacion" readonly />
                        </td>
                        <td>
                            <input style="max-width: 105px !important" type="text" id="dcmDescuento1" name="dcmDescuento[]" form="form-cotizacion" idsprt="1" 
                          onkeyup="CalcularPrecioTotal(this)"/>
                        </td>
                        <td>
                            <input style="max-width: 105px !important"  type="text" id="dcmPrecioUnitario1" name="dcmPrecioUnitario[]" form="form-cotizacion" readonly/>
                        </td>
                        <td>
                            <input type="text" id="intCantidad1" name="intCantidad[]" form="form-cotizacion" idsprt="1"
                          onkeyup="CalcularPrecioTotal(this)"/>
                        </td>
                        <td>
                            <input type="text" id="dcmTotal1" name="dcmTotal[]" form="form-cotizacion" onkeydown="return TeclaAgregarFila(event)" readonly/>
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
                      <th style="width: 110px" >Precio Unit.</th>
                      <th style="width: 110px" >Cantidad</th>
                      <th style="width: 110px" >Total</th>
                      <th style="width: 25px !important" ></th>
                    </tr>
                    </thead>
                    <tbody id="ListaDeServiciosVender">
                      <tr>
                        <td class="heading" data-th="ID">1</td>
                        <td>
                          <input style="width: 110px !important" type="hidden" name="fila[]" value="1" form="form-cotizacion" />
                          <textarea id="nvchDescripcionS1" class="form-control select2 textoarea" maxlength="800" name="nvchDescripcionS[]" form="form-cotizacion" rows="4"></textarea>
                          <!--<input type="text" style="width: 100%" id="nvchDescripcionS1" name="nvchDescripcionS[]" form="form-cotizacion" />-->
                        </td>
                        <td>
                          <input style="max-width: 105px !important" type="text" id="dcmPrecioUnitarioS1" name="dcmPrecioUnitarioS[]" idsprt="1" form="form-cotizacion" onkeyup="CalcularPrecioTotalS(this)"/>
                        </td>
                        <td> 
                          <input type="text" id="intCantidadS1" name="intCantidadS[]" idsprt="1" form="form-cotizacion" 
                          onkeyup="CalcularPrecioTotalS(this)"/>           
                        </td>
                        <td>
                          <input type="text" id="dcmTotalS1" name="dcmTotalS[]" form="form-cotizacion" onkeydown="return TeclaAgregarFila(event)" readonly/>
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
              <script type="text/javascript">ElegirTabla(1);</script>
            </div>
            </div>
            <!-- FIN Tabla - Servicios -->
            

            <div class="row">
                <div class="col-md-12"> 
                  <div class="" style="overflow-x: hidden;">
                    <table class="" style="width:398px !important; float:right; ">
                    <tbody>
                      <!--
                      <tr>
                          <th>Valor de Venta:</th>
                          <td style="width: 120px !important">
                              <input type="text" id="ValorVenta" name="ValorVenta" class="form-control select2" value="S/. 0.00" readonly form="form-cotizacion"/>
                          </td>
                      </tr>
                      <tr>
                          <th>IGV (18%):</th>
                          <td style="width: 120px !important">
                              <input type="text" id="IGVVenta" name="IGVVenta" class="form-control select2" value="S/. 0.00" readonly form="form-cotizacion"/>
                          </td>
                      </tr>-->
                      <!--tr style="width: 110px !important">
                          <th>Venta Total</th>
                          <td style="width: 110px !important">
                              <input type="text" id="VentaTotal" name="VentaTotal" class="form-control select2" value="S/. 0.00" readonly form="form-cotizacion"/>
                          </td>
                      </tr-->
                      <thead>
                        
                      </thead>
                      <tr style="">
                        <td style="width: var(--anchoCampoTableFooter) !important; " class="text-center heading-back"><span> Venta Total </span></td>
                        <td style="width: var(--anchoCampoTableFooter) !important">
                            <input type="text" id="CotizacionTotal" name="CotizacionTotal" class="form-control select2" value="S/. 0.00" readonly form="form-cotizacion" style=""/>
                        </td>
                        <td style="width: 23px !important;"></td>
                      </tr>
                    </tbody>
                    </table>
                  </div>
                </div>
            </div>
            <br><br>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Observación y/o Datos Adicionales (Opcional):</label>
                  <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-cotizacion" rows="6" style="overflow: hidden;"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="hidden" name="funcion" id="funcionC" value="" form="form-cotizacion">
                  <input type="hidden" id="intTipoDetalle" name="intTipoDetalle" value="1" form="form-cotizacion">
                  <input type="hidden" id="intIdCotizacion" name="intIdCotizacion" value="" form="form-cotizacion">
                  <input type="hidden" id="intIdClienteC" name="intIdCliente" value="" form="form-cotizacion">
                  <div class="text-center">
                    <input type="button" id="btn-crear-cotizacion" class="btn btn-md btn-primary opcion-boton-nuevo" value="Realizar Cotización" form="form-cotizacion">
                     <input type="button" id="btn-editar-cotizacion" class="btn btn-md btn-primary opcion-boton-editar" value="Modificar Cotización" form="form-cotizacion">
                    <input type="button" onclick="NuevaCotizacion()" class="btn btn-md btn-success" value="Nueva Cotización" form="form-cotizacion">
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
          <!-- FIN - Formulario Realizar Venta -->

          <!-- INICIO - Formulario Listar Venta -->
          <div class="tab-pane" id="formListarCotizacion">
            <div class="pull-right">
              <!--Nueva Cotización-->
              <button class="btn btn-sm btn-primary btn-flat" onclick="NuevoCotizacion();" form="form-cotizacion"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Cotización
              </button>

              <!--Reporte PDF-->
              <button type="button" class="btn btn-sm btn-danger btn-flat" id="DescargarListaCotizacionPDF" onclick=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Reporte PDF</button> 

              <!--Reporte Excel-->
              <button type="button" class="btn btn-sm btn-success btn-flat" id="DescargarListaCotizacionExcel" onclick=""><i class="fa fa-file-excel-o" aria-hidden="true"></i> Reporte Excel</button> 
            </div>

            <div class="row">
              <?php include '../campos/cmbNumLista.php'; ?>
              <div class="col-md-2">
                <div class="form-group">
                    <label class="text-left">Ingresar Búsqueda:</label>
                    <input type="text" name="txt-busqueda" id="txt-busqueda" class="form-control select2" placeholder="Ingrese Búsqueda" value="">
                </div>
              </div>
              <!--
              <div class="col-md-8">
                <div class="text-right">
                  <div class="form-group">
                    <input type="button" onclick="NuevaCotizacion()" class="btn btn-md btn-primary" form="form-cotizacion" value="Nueva Cotización"/>
                  </div>
                </div>
              </div>
              -->
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
                    <label class="text-left">Total de Cotizaciones:</label>
                    <input type="text" id="TotalCotizacion" class="form-control select2" placeholder="0.00" readonly>
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
                  <!--<th>Serie</th>-->
                  <th>Numeración</th>
                  <th>Tipo Cotizac.</th>
                  <th>Cliente</th>
                  <th>Usuario que Generó</th>
                  <th>Fecha de Creación</th>
                  <th>Valor de Venta</th>
                  <th>IGV</th>
                  <th>Venta Total</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="ListaDeCotizaciones">
                  <script>ListarCotizacion(0,10,"T");</script>
                </tbody>
              </table>
            </div>
            <hr>
            <div class="text-center">
              <nav aria-label="...">
                <ul id="PaginacionDeCotizacion" class="pagination">
                  <script>PaginarCotizacion(0,10,"T");</script>
                </ul>
              </nav>
            </div>
            <script type="text/javascript">TotalCotizacion();</script>
          </div>
          <!-- FIN - Formulario Listar Venta -->
        </div>
      </div>
    </section>
  </div>
<script>
  $('#modalcust').modal({
    keyboard: false
  });
</script>
<style>
  input{
    padding: 2px 3px;
  }
  select{
    padding: 3px;
  }

  .heading-back{
    background: rgba(212,228,239,1);
    background: -moz-linear-gradient(top, rgba(212,228,239,1) 0%, rgba(212,228,239,1) 11%, rgba(212,228,239,1) 31%, rgba(183,195,204,1) 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(212,228,239,1)), color-stop(11%, rgba(212,228,239,1)), color-stop(31%, rgba(212,228,239,1)), color-stop(100%, rgba(183,195,204,1)));
    background: -webkit-linear-gradient(top, rgba(212,228,239,1) 0%, rgba(212,228,239,1) 11%, rgba(212,228,239,1) 31%, rgba(183,195,204,1) 100%);
    background: -o-linear-gradient(top, rgba(212,228,239,1) 0%, rgba(212,228,239,1) 11%, rgba(212,228,239,1) 31%, rgba(183,195,204,1) 100%);
    background: -ms-linear-gradient(top, rgba(212,228,239,1) 0%, rgba(212,228,239,1) 11%, rgba(212,228,239,1) 31%, rgba(183,195,204,1) 100%);
    background: linear-gradient(to bottom, rgba(212,228,239,1) 0%, rgba(212,228,239,1) 11%, rgba(212,228,239,1) 31%, rgba(183,195,204,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d4e4ef', endColorstr='#b7c3cc', GradientType=0 );
    font-weight: bolder;
  }
  
  textarea.textoarea:first-line { font-weight: bold; }
  .pagination a {
      margin: 0 4px; /* 0 is for top and bottom. Feel free to change it */
  }
  hr { 
      display: block;
      margin-top: 0.5em;
      margin-bottom: 0.5em;
      margin-left: auto;
      margin-right: auto;
      border-style: inset;
      border-width: 1px;
  }
  .result
  {
      position: absolute;
      z-index: 1;
      width:1200px;
      /*
      padding:10px;
      */
      display:none;
      margin-top:-1px;
      border-top:0px;
      overflow:hidden;
      border:1px #CCC solid;
      background-color: white;
  }
  .show
  {
      padding:10px;
      border-bottom:1px solid #000000;
      font-size:15px; 
      /*height:50px;*/
  }
  .show:hover
  {
      background:#4c66a4;
      color:#FFF;
      cursor:pointer;
  }
</style>
<?php include('../_include/rstfooter.php'); ?>