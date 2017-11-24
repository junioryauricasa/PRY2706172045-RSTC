<?php 
include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <?php require_once '../../negocio/compras/nproveedor.php'; ?>
    <?php require_once '../../negocio/operaciones/ndatosgenerales.php'; ?>
    <?php require_once '../../negocio/operaciones/nvalidaciones.php'; ?>
    <?php require_once '../../negocio/operaciones/nestilos.php'; ?>
    <!--<script type="text/javascript" src="../../negocio/compras/nproveedor.js"></script>-->
    <!--<script type="text/javascript" src="../../negocio/operaciones/ndatosgenerales.js"></script>-->
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
        Registro de Proveedores
        <small>Módulo de Compras</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li>Fixed</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
              <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Relación de Proveedores</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab">Registro de Proveedor</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                
                <!-- Main content -->
                <section class="content">
                  <!-- TABLE: LATEST USERS -->
                  <div class="">
                    <h3 class="box-title">Registro de Proveedores</h3>
                    <div class="box-body">
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
                            <label>Tipo Persona:</label>
                            <br>
                            <select id="lista-persona" name="lista-persona"  class="form-control select2">
                              <?php 
                                require_once '../../datos/conexion/bd_conexion.php';
                                try{
                                $sql_conexion = new Conexion_BD();
                                $sql_conectar = $sql_conexion->Conectar();
                                $sql_comando = $sql_conectar->prepare('CALL mostrartipopersona()');
                                $sql_comando->execute();
                                while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
                                {
                                  echo '<option value="'.$fila['intIdTipoPersona'].'">'.$fila['nvchNombre'].'</option>';
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
                            <th class="ListaDNI">DNI</th>
                            <th class="ListaRUC">RUC</th>
                            <th class="ListaRazonSocial">Razón Social</th>
                            <th class="ListaApellidoPaterno">Apellido Paterno</th>
                            <th class="ListaApellidoMaterno">Apellido Materno</th>
                            <th class="ListaNombres">Nombres</th>
                            <th>Opciones</th>
                          </tr>
                          </thead>
                          <tbody id="ListaDeProveedores">
                            <script>ListarProveedor(0,10,"T",1);</script>
                          </tbody>
                        </table>
                        <script>AccionCabecerasTabla("1");</script>
                      </div>
                      <br>
                      <div class="text-center">
                        <nav aria-label="...">
                          <ul id="PaginacionDeProveedores" class="pagination">
                            <script>PaginarProveedor(0,10,"T",1);</script>
                          </ul>
                        </nav>
                      </div>
                      <button type="button" id="btn-form-crear-proveedor" class="btn btn-sm btn-info btn-flat pull-left">Agregar Proveedor</button>
                    </div>    
                    
                  </div>
                  <div id="formulario-crud"></div>
                  <div id="resultadocrud"></div>
                </section>
                <!-- /.content -->
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                The European languages are members of the same family. Their separate existence is a myth.
                For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                in their grammar, their pronunciation and their most common words. Everyone realizes why a
                new common language would be desirable: one could refuse to pay expensive translators. To
                achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                words. If several languages coalesce, the grammar of the resulting language is more simple
                and regular than that of the individual languages.
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- Scripts DataTable -->
<script>
  // Modal
  $('#modalcust').modal({
    keyboard: false
  });
</script>
<!-- ENd Scripts DataTable -->
<style>
  input{
    padding: 2px 3px;
  }
  select{
    padding: 3px;
  }
</style>
<?php include('../_include/rstfooter.php'); ?>