<div id="formProducto" class="modal fade">
 <div class="modal-dialog modal-lg">
   <div class="modal-content">
    <div style="background-color: #78909c;"  class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 style="color: #FFFFFF;" class="modal-title">Formulario Producto</h4>
    </div>
    <div class="modal-body">
        <section class="content">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#formDatosProducto" data-toggle="tab" aria-expanded="true">Datos del Producto</a></li>
              <li><a href="#formPreciosProducto" data-toggle="tab" aria-expanded="true">Precios del Producto</a></li>
              <li><a href="#formCodigosProducto" data-toggle="tab" aria-expanded="true">Códigos del Producto</a></li>
              <li><a href="#formUbigeoProducto" data-toggle="tab" aria-expanded="true">Ubigeo del Producto</a></li>
            </ul>
            <form id="form-producto" method="POST">
            <div class="tab-content">
              <div class="tab-pane active" id="formDatosProducto">
                <div class="row">
                  <div class="col-md-4">
                    <div id="nvchDescripcionGroup" class="form-group">
                      <label>Descripción:</label>
                      <input type="text" id="nvchDescripcion" name="nvchDescripcion" class="form-control select2" 
                      placeholder="Ingrese la Descripción" value="" maxlength="850" 
                      onkeyup="EsVacio('nvchDescripcion')" required>
                      <span id="nvchDescripcionIcono" class="" aria-hidden=""></span>
                      <div id="nvchDescripcionObs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div id="intCantidadMinimaGroup" class="form-group">
                      <label>Cantidad Mínima:</label>
                      <input type="text" id="intCantidadMinima" name="intCantidadMinima" class="form-control select2" 
                      placeholder="Ingrese Cantidad Minima" value="" 
                      onkeypress="return EsNumeroEnteroTecla(event)" onkeyup="EsNumeroEntero('intCantidadMinima')" maxlength="11" required>
                      <span id="intCantidadMinimaIcono" class="" aria-hidden=""></span>
                      <div id="intCantidadMinimaObs" class=""></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Imagen:</label>
                      <input type="file" name="SeleccionImagen" id="SeleccionImagen" accept=".png, .jpg, .jpeg">
                      <img id="resultadoimagen" src="" style="width: 100px; height: 100px;" />
                      <input type="hidden" id="nvchDireccionImg" name="nvchDireccionImg" value="" />
                      <div id="operacionimagen"></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Observación y/o Datos Adicionales (Opcional):</label>
                      <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-producto" rows="6"></textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="formPreciosProducto">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Tipo de Moneda del Precio Compra:</label>
                      <select id="intIdTipoMonedaCompra" name="intIdTipoMonedaCompra" class="form-control select2" >
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
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <div id="dcmPrecioCompraGroup" class="form-group">
                      <label>Precio Compra:</label>
                      <input type="text" id="dcmPrecioCompra" name="dcmPrecioCompra" class="form-control select2" 
                      placeholder="Precio de Compra" value="" 
                      onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioCompra')" maxlength="15" required>
                      <span id="dcmPrecioCompraIcono" class="" aria-hidden=""></span>
                      <div id="dcmPrecioCompraObs" class=""></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Tipo de Moneda del Precio Venta:</label>
                      <select id="intIdTipoMonedaVenta" name="intIdTipoMonedaVenta" class="form-control select2" >
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
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <div id="dcmPrecioVenta1Group" class="form-group">
                      <label>Precio de Venta 1:</label>
                      <input type="text" id="dcmPrecioVenta1" name="dcmPrecioVenta1" class="form-control select2" 
                      placeholder="Precio de Venta 1" value="" 
                      onkeypress="return EsDecimalTecla(event)" onkeyup="EsDecimal('dcmPrecioVenta1')" maxlength="15" required>
                      <span id="dcmPrecioVenta1Icono" class="" aria-hidden=""></span>
                      <div id="dcmPrecioVenta1Obs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div id="dcmDescuentoVenta2Group" class="form-group">
                      <label>Descuento 2 (%):</label>
                      <input type="text" id="dcmDescuentoVenta2" name="dcmDescuentoVenta2" class="form-control select2" 
                      placeholder="Descuento 2" value="7" onkeypress="return EsDecimalTecla(event)" 
                      onkeyup="EsDecimal('dcmDescuentoVenta2')" maxlength="6" required>
                      <span id="dcmDescuentoVenta2Icono" class="" aria-hidden=""></span>
                      <div id="dcmDescuentoVenta2Obs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div id="dcmPrecioVenta2Group" class="form-group">
                      <label>Precio de Venta 2:</label>
                      <input type="text" id="dcmPrecioVenta2" name="dcmPrecioVenta2" class="form-control select2" 
                      placeholder="Precio de Venta 2" value="0.00" onkeypress="return EsDecimalTecla(event)" 
                      onkeyup="EsDecimal('dcmPrecioVenta2')" maxlength="15" readonly required>
                      <span id="dcmPrecioVenta2Icono" class="" aria-hidden=""></span>
                      <div id="dcmPrecioVenta2Obs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div id="dcmDescuentoVenta3Group" class="form-group">
                      <label>Descuento 3 (%):</label>
                      <input type="text" id="dcmDescuentoVenta3" name="dcmDescuentoVenta3" class="form-control select2" 
                      placeholder="Descuento 3" value="15" onkeypress="return EsDecimalTecla(event)" 
                      onkeyup="EsDecimal('dcmDescuentoVenta3')" maxlength="6" required>
                      <span id="dcmDescuentoVenta3Icono" class="" aria-hidden=""></span>
                      <div id="dcmDescuentoVenta3Obs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div id="dcmPrecioVenta3Group"  class="form-group">
                      <label>Precio de Venta 3:</label>
                      <input type="text" id="dcmPrecioVenta3" name="dcmPrecioVenta3" class="form-control select2" 
                      placeholder="Precio de Venta 3" value="" onkeypress="return EsDecimalTecla(event)" 
                      onkeyup="EsDecimal('dcmPrecioVenta3')" maxlength="15" readonly required>
                      <span id="dcmPrecioVenta3Icono" class="" aria-hidden=""></span>
                      <div id="dcmPrecioVenta3Obs" class=""></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="formCodigosProducto">
                <div class="row">
                  <div class="col-md-3">
                    <div id="nvchCodigoGroup" class="form-group">
                      <label>Código:</label>
                      <input type="text" id="nvchCodigo" class="form-control select2" 
                      placeholder="Ingrese Código" onkeyup="EsVacio('nvchCodigo')"
                      maxlength="85"/>
                      <span id="nvchCodigoIcono" class="" aria-hidden=""></span>
                      <div id="nvchCodigoObs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Tipo de Código:</label>
                      <select id="tipo-codigo-producto" class="form-control select2" >
                        <?php try{
                          $sql_conexion = new Conexion_BD();
                          $sql_conectar = $sql_conexion->Conectar();
                          $sql_comando = $sql_conectar->prepare('CALL mostrartipocodigoproducto()');
                          $sql_comando->execute();
                          while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                          {
                            echo '<option value="'.$fila['intIdTipoCodigoProducto'].'">'.$fila['nvchNombre'].'</option>';
                          }
                        }catch(PDPExceptions $e){
                          echo $e->getMessage();
                        }?>
                      </select>
                    </div>
                  </div>
                  <input type="hidden" id="intIdCodigoProducto" />
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                    <input type="button" id="btn-agregar-codigo" class="form-control select2 btn btn-success" value="Agregar Código" onclick="AgregarCodigo()"/>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="ExcelTable2007 rwd-table" width="100%">
                    <thead>
                    <tr>
                      <th class="heading" width="25px">&nbsp;</th>
                      <th>Código</th>
                      <th>Tipo</th>
                      <th>Opción</th>
                    </tr>
                    </thead>
                    <tbody id="ListaDeCodigos">
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane" id="formUbigeoProducto">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Sucursal:</label>
                      <select id="intIdSucursal" name="intIdSucursal" class="form-control select2" >
                        <?php try{
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
                  <div class="col-md-3">
                    <div id="nvchUbicacionGroup" class="form-group">
                      <label>Ubicación en el Almacén:</label>
                      <input type="text" id="nvchUbicacion" class="form-control select2" 
                      placeholder="Ingrese Ubicacion" onkeyup="EsVacio('nvchUbicacion')" maxlength="45">
                      <span id="nvchUbicacionIcono" class="" aria-hidden=""></span>
                      <div id="nvchUbicacionObs" class=""></div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div id="intCantidadUbigeoGroup" class="form-group">
                      <label>Cantidad:</label>
                      <input type="text" id="intCantidadUbigeo" class="form-control select2" 
                      placeholder="Ingrese Cantidad" onkeypress="return EsNumeroEnteroTecla(event)" onkeyup="EsNumeroEntero('intCantidadUbigeo')"
                      maxlength="11">
                      <span id="intCantidadUbigeoIcono" class="" aria-hidden=""></span>
                      <div id="intCantidadUbigeoObs" class=""></div>
                    </div>
                  </div>
                </div> 
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                    <input type="button" id="btn-agregar-ubigeo" class="form-control select2 btn btn-success" value="Agregar Ubigeo" onclick="AgregarUbigeo()"/>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="ExcelTable2007 rwd-table" width="100%">
                    <thead>
                    <tr>
                      <th class="heading" width="25px">&nbsp;</th>
                      <th>Sucursal</th>
                      <th>Ubicación en el Almacén</th>
                      <th>Cantidad</th>
                      <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody id="ListaDeUbicaciones">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </form>
          </div>
        </section>
    </div>
    <div style="background-color: #cfd8dc;"  class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
   </div>
 </div>
</div>