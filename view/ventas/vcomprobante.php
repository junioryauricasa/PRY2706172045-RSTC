<?php 
include('../_include/rstheader.php');
require_once '../../datos/conexion/bd_conexion.php';
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <?php require_once '../../negocio/ventas/nventa.php'; ?>
    <?php require_once '../../negocio/ventas/ndetalleventa.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <!--<script type="text/javascript" src="../../negocio/ventas/nventa.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/ventas/ndetalleventa.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/nvalidaciones.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/nestilos.js"></script>-->
    <style>
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
    </style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Registro de Ventas
        <small>Módulo de Ventas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../default/index">Inicio</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Fixed</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- TABLE: LATEST USERS -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#formRealizarVenta" data-toggle="tab" aria-expanded="true">Realizar Venta</a></li>
          <li class=""><a href="#formListarVenta" data-toggle="tab" aria-expanded="false">Lista de Ventas</a></li>
        </ul>
        <div class="tab-content">
          <!-- INICIO - Formulario Realizar Venta -->
          <form id="form-venta" method="POST"></form>
          <div class="tab-pane active" id="formRealizarVenta">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Fecha Actual:</label>
                  <input type="text" id="nvchFecha" name="nvchFecha" class="form-control select2" readonly form="form-venta"/>
                  <script type="text/javascript">$("#nvchFecha").val(FechaActual());</script>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo de Moneda:</label>
                  <select id="intIdTipoMoneda" name="intIdTipoMoneda" class="form-control select2" form="form-venta">
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
                  <label>Tipo de Comprobante:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="intIdTipoComprobante" name="intIdTipoComprobante"  class="form-control select2" form="form-venta">
                  <?php 
                    try{
                    $sql_conexion = new Conexion_BD();
                    $sql_conectar = $sql_conexion->Conectar();
                    $sql_comando = $sql_conectar->prepare('CALL mostrartipocomprobante(:intTipoDetalle)');
                    $sql_comando->execute(array(':intTipoDetalle' => 1));
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
                  <label>Lugar de Venta:</label>
                  <select onchange="MostrarSeleccionComprobante()" id="intIdSucursal" name="intIdSucursal"  class="form-control select2" form="form-venta">
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
                  <label>Serie:</label>
                  <input type="text" id="nvchSerie" name="nvchSerie" class="form-control select2" readonly form="form-venta"/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Numeración:</label>
                  <input type="text" id="nvchNumeracion" name="nvchNumeracion" class="form-control select2" readonly form="form-venta"/>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Seleccionar el Tipo de Venta:</label>
                    <select id="tipo-venta" name="intIdTipoVenta" onchange="MostrarTipoVenta()" class="form-control select2">
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
            </div>
            <div class="table-responsive">
              <table class="table table-hover table-condensed">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Precio Unit.</th>
                  <th>Total</th>
                  <th>Opción</th>
                </tr>
                </thead>
                <tbody id="ListaDeProductosComprar">
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Forma de Pago:</label>
                  <select id="tipo-pago" name="intIdTipoPago" class="form-control select2" form="form-venta">
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
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label>Observación y/o Datos Adicionales (Opcional):</label>
                  <textarea id="nvchObservacion" class="form-control select2" maxlength="800" name="nvchObservacion" form="form-venta" rows="6"></textarea>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN - Formulario Realizar Venta -->

          <!-- INICIO - Formulario Listar Venta -->
          <div class="tab-pane" id="formListarVenta">
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
                      $sql_comando->execute(array(':intTipoDetalle' => 1));
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
                    <label class="text-left">Total de Ventas:</label>
                    <input type="text" id="TotalVentas" class="form-control select2" placeholder="0.00" readonly>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover table-condensed">
                <thead>
                <tr>
                  <th class="listaNumFactura">Número de Factura</th>
                  <th class="listaNumBoletaVenta">Número de Boleta</th>
                  <th class="listaNumNotaCredito">Número de Nota de Crédito</th>
                  <th class="listaNumGuiaRemision">Número de Guía de Remisión</th>
                  <th>Cliente</th>
                  <th>Usuario que Generó</th>
                  <th>Fecha de Creación</th>
                  <th>Valor de Venta</th>
                  <th>IGV</th>
                  <th>Venta Total</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="ListaDeVentas">
                  <script>ListarVenta(0,10,"T");</script>
                </tbody>
              </table>
              <script>AccionCabecerasTablaComprobante(1);</script>
            </div>
            <hr>
            <div class="text-center">
              <nav aria-label="...">
                <ul id="PaginacionDeVenta" class="pagination">
                  <script>PaginarVenta(0,10,"T");</script>
                </ul>
              </nav>
            </div>
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
</style>
<?php include('../_include/rstfooter.php'); ?>