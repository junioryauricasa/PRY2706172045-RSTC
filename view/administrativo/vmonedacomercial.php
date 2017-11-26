<?php 
		include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <?php require_once '../../negocio/administrativo/nmonedacomercial.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <!--<script type="text/javascript" src="../../negocio/administrativo/nmonedacomercial.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/nvalidaciones.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/nestilos.js"></script>-->
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
        Administrar Cambios de Moneda Comercial
        <small>Módulo Administrativo</small>
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
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Registro de Cambios de Monedas</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Mostrar:</label>
                <br>
                <select id="num-lista" name="num-lista"  class="form-control select2" >
                      <option value="10">Seleccionar</option>
                      <option value="10">Ver 10 Resultados</option>
                      <option value="25">Ver 25 Resultados</option>
                      <option value="50">Ver 50 Resultados</option>
                      <option value="100">Ver 100 Resultados</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Tipo de Cambio:</label>
                <br>
                <select id="lista-tipo-cambio" name="lista-tipo-cambio"  class="form-control select2">
                  <?php 
                    require_once '../../datos/conexion/bd_conexion.php';
                    try{
                    $sql_conexion = new Conexion_BD();
                    $sql_conectar = $sql_conexion->Conectar();
                    $sql_comando = $sql_conectar->prepare('CALL mostrartipocambio()');
                    $sql_comando->execute();
                    while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                    {
                      echo '<option value="'.$fila['intIdTipoCambio'].'">'.$fila['nvchDescripcion'].'</option>';
                    }
                  }catch(PDPExceptions $e){
                    echo $e->getMessage();
                  }?>
                </select>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="ExcelTable2007 rwd-table" width="100%">
              <thead>
              <tr>
                <th class="heading" width="25px">&nbsp;</th>
                <th>Fecha</th>
                <th>Valor EstadoUnidense</th>
                <th>Valor Sol</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <tbody id="ListaDeMonedaComercial">
                <script>ListarMonedaComercial(0,10,"T");</script>
              </tbody>
            </table>
          </div>
          <hr>
          <div class="text-center">
            <nav aria-label="...">
              <ul id="PaginacionDeMonedaComercial" class="pagination">
                <script>PaginarMonedaComercial(0,10,"T");</script>
              </ul>
            </nav>
          </div>
        </div>
        <div class="box-footer clearfix">     
          <!--button type="button" id="btn-form-crear-moneda-comercial" class="btn btn-sm btn-info btn-flat pull-left">Agregar Moneda Comercial</button-->
          <!-- Modal for New moneda tributaria -->
          <button type="button" id="btn-form-crear-moneda-comercial" class="btn btn-sm btn-danger btn-flat pull-left" onclick="showmodalNuevaMonedaCom()">Nueva Moneda Comercial</button>

          <!-- script for modal -->
          <script type="text/javascript">
                function showmodalNuevaMonedaCom(){
                  $('#nuevamonedacomercial').modal('show'); // abrira el modal seleccionado
                }
          </script>
        
          <!-- INICIO modal -->
          <div class="modal fade" id="nuevamonedacomercial" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="result"></div>
                  <div id="formulario-crud"></div>
                  <!--div id="resultadocrud"></div-->
              </div>
            </div>
          </div>
          <!-- END modal -->


        <!-- INICIO modal confirmar -->
        <div class="modal fade mi-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
              </div>
              <div class="modal-body">
                Estas seguro de eliminar registro?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default modal-btn-si" id="">Si</button>
                <button type="button" class="btn btn-primary modal-btn-no" id="">No</button>
              </div>
            </div>
          </div>
        </div>
        <!-- END modal confirmar -->


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