<?php 
		include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <?php require_once '../../negocio/equipo/ncotizacionequipo.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <?php require_once '../../view/modals/vformCliente.php'; ?>
    <style>
      .pagination a {
          margin: 0 4px;
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
    </style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Cotización de Equipos
        <small>Módulo de Equipos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Estatico</li>
      </ol>
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
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Fecha Actual:</label>
                  <input type="text" id="nvchFecha" name="nvchFecha" class="form-control select2" readonly form="form-cotizacion"/>
                  <script type="text/javascript">$("#nvchFecha").val(FechaActual());</script>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Seleccionar el Tipo de Equipo:</label>
                  <select id="intIdTipoVenta" name="intIdTipoVenta" onchange="ListarTipoEquipo(this.value)" class="form-control select2" form="form-cotizacion">
                    <?php try{
                      $sql_conexion = new Conexion_BD();
                      $sql_conectar = $sql_conexion->Conectar();
                      $sql_comando = $sql_conectar->prepare('CALL mostrartipoventacotizacionequipo()');
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
              <div class="col-md-5">
                <div class="form-group">
                  <label>Seleccionar Plantilla:</label>
                  <select id="intIdPlantillaCotizacion" name="intIdPlantillaCotizacion"  class="form-control select2" form="form-comprobante">
                  <?php try{
                      $sql_conexion = new Conexion_BD();
                      $sql_conectar = $sql_conexion->Conectar();
                      $sql_comando = $sql_conectar->prepare('CALL mostrarplantillacotizacion(:intIdTipoVenta)');
                      $sql_comando->execute(array(':intIdTipoVenta' => 3));
                      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                      {
                        echo '<option value="'.$fila['intIdPlantillaCotizacion'].'">'.$fila['nvchNombre'].'</option>';
                      }
                    }catch(PDPExceptions $e){
                      echo $e->getMessage();
                    }?>
                </select>
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
              <div class="col-md-3">
                <div id="nvchAtencionGroup" class="form-group">
                  <label>Atención:</label>
                  <input type="text" id="nvchAtencion" name="nvchAtencion" class="form-control select2" placeholder="Ingrese Atención" 
                  value="" onkeyup="EsVacio('nvchAtencion')" maxlength="250" form="form-cotizacion" required>
                  <span id="nvchAtencionIcono" class="" aria-hidden=""></span>
                  <div id="nvchAtencionObs" class=""></div>
                </div>
              </div>
              <div class="col-md-3">
                <div id="nvchGarantiaGroup" class="form-group">
                  <label>Garantía:</label>
                  <input type="text" id="nvchGarantia" name="nvchGarantia" class="form-control select2" 
                  placeholder="Ingrese la Garantía" maxlength="25" 
                  onkeyup="EsVacio('nvchGarantia')"  form="form-cotizacion" required>
                  <span id="nvchGarantiaIcono" class="" aria-hidden=""></span>
                  <div id="nvchGarantiaObs" class=""></div>
                </div>
              </div>
              <div class="col-md-3">
                <div id="nvchFormaPagoGroup" class="form-group">
                  <label>Forma de Pago:</label>
                  <input type="text" id="nvchFormaPago" name="nvchFormaPago" class="form-control select2" 
                  placeholder="Ingrese la Forma de Pago" maxlength="75" 
                  onkeyup="EsVacio('nvchFormaPago')"  form="form-cotizacion" required>
                  <span id="nvchFormaPagoIcono" class="" aria-hidden=""></span>
                  <div id="nvchFormaPagoObs" class=""></div>
                </div>
              </div>
              <div class="col-md-3">
                <div id="nvchLugarEntregaGroup" class="form-group">
                  <label>Lugar de Entrega:</label>
                  <input type="text" id="nvchLugarEntrega" name="nvchLugarEntrega" class="form-control select2" 
                  placeholder="Ingrese el Lugar de Entrega" maxlength="75" 
                  onkeyup="EsVacio('nvchMarca')"  form="form-cotizacion" required>
                  <span id="nvchLugarEntregaIcono" class="" aria-hidden=""></span>
                  <div id="nvchLugarEntregaObs" class=""></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div id="nvchTiempoEntregaGroup" class="form-group">
                  <label>Tiempo de Entrega:</label>
                  <input type="text" id="nvchTiempoEntrega" name="nvchTiempoEntrega" class="form-control select2" 
                  placeholder="Ingrese el Tiempo de Entrega" maxlength="65" 
                  onkeyup="EsVacio('nvchTiempoEntrega')"  form="form-cotizacion" required>
                  <span id="nvchTiempoEntregaIcono" class="" aria-hidden=""></span>
                  <div id="nvchTiempoEntregaObs" class=""></div>
                </div>
              </div>
              <div class="col-md-2">
                <div id="nvchDiasValidezGroup" class="form-group">
                  <label>Validez de Oferta:</label>
                  <input type="text" id="nvchDiasValidez" name="nvchDiasValidez" class="form-control select2" placeholder="Ingrese número de días" 
                  value="" onkeyup="EsVacio('nvchDiasValidez')" maxlength="3" form="form-cotizacion" required>
                  <span id="nvchDiasValidezIcono" class="" aria-hidden=""></span>
                  <div id="nvchDiasValidezObs" class=""></div>
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
                  <input type="hidden" name="funcion" value="I" form="form-cotizacion">
                  <input type="hidden" id="intIdCliente" name="intIdCliente" value="" form="form-cotizacion">
                  <div class="text-center">
                    <input type="button" id="btn-crear-cotizacion" class="btn btn-md btn-primary opcion-boton-nuevo" value="Realizar Cotización de Equipo" form="form-cotizacion">
                    <input type="button" onclick="NuevaCotizacion()" class="btn btn-md btn-success" value="Nueva Cotización de Equipo" form="form-cotizacion">
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
          <div class="tab-pane" id="formListarCotizacion">
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
              <div class="col-md-8">
                <div class="text-right">
                  <div class="form-group">
                    <input type="button" onclick="NuevaCotizacion()" class="btn btn-md btn-primary" form="form-comprobante" value="Nueva Cotización de Equipo"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="ExcelTable2007 rwd-table" width="100%">
                <thead>
                <tr>
                  <th class="heading" width="25px">&nbsp;</th>
                  <th>Plantilla</th>
                  <th>Cliente</th>
                  <th>Fecha de Creación</th>
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
  <style>
    input{
      padding: 2px 3px;
    }
    select{
      padding: 3px;
    }
  </style>
<?php include('../_include/rstfooter.php'); ?>