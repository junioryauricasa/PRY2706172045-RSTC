<?php
require_once '../conexion/bd_conexion.php';
class FormularioGuiaInternaEntrada
{
  private $intIdGuiaInternaEntrada;
  private $intIdOrdenCompra;
  private $intIdUsuario;
  private $NombreUsuario;
  private $NombreProveedor;
  private $dtmFechaCreacion;

  public function IdGuiaInternaEntrada($intIdGuiaInternaEntrada){ $this->intIdGuiaInternaEntrada = $intIdGuiaInternaEntrada; }
  public function IdOrdenCompra($intIdOrdenCompra){ $this->intIdOrdenCompra = $intIdOrdenCompra; }
  public function IdUsuario($intIdUsuario){ $this->intIdUsuario = $intIdUsuario; }
  public function NombreUsuario($NombreUsuario){ $this->NombreUsuario = $NombreUsuario; }
  public function NombreProveedor($NombreProveedor){ $this->NombreProveedor = $NombreProveedor; }
  public function FechaCreacion($dtmFechaCreacion){ $this->dtmFechaCreacion = $dtmFechaCreacion; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nueva Guia Interna Entrada</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Guia Interna Entrada</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-guiainternaentrada" method="POST">
        <div class="box-body">
        <?php if($funcion == "M") { ?>
        <div class="box-header with-border">
          <h3 class="box-title">Datos Generales de la Guia Interna de Entrada</h3>
        </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Usuario que Realizo:</label>
                <input type="text" value="<?php echo $this->NombreUsuario; ?>" required />
                <input type="hidden" value="<?php echo $this->intIdUsuario; ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Proveedor Relacionado:</label>
                <input type="text" value="<?php echo $this->NombreProveedor; ?>" required />
              </div>
            </div>
          </div>
        <div class="box-header with-border">
        </div>
        <?php } ?>
        <div id="form-busqueda-ordencompra">
          <div class="box-header with-border">
            <h3 class="box-title">Lista de Ordenes de Compra</h3>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Ingrese Búsqueda:</label>
                <input type="text" id="BusquedaOrdenCompra" class="form-control select2" placeholder="Ingrese Búsqueda" required>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-condensed">
              <thead>
              <tr>
                <th>Código</th>
                <th>Usuario</th>
                <th>Proveedor</th>
                <th>Fecha de Creación</th>
                <th>Opcion</th>
              </tr>
              </thead>
              <tbody id="ListaDeOrdenesCompra">
              <script>ListarOrdenCompra(0,5);</script>
              </tbody>
            </table>
          </div>
          <hr>
          <div class="text-center">
            <nav aria-label="...">
              <ul id="PaginacionDeOrdenesCompra" class="pagination">
                <script>PaginarOrdenCompra(0,5);</script>
              </ul>
            </nav>
          </div>
          <input type="hidden" name="intIdOrdenCompra" id="intIdOrdenCompra" value="<?php echo $this->intIdOrdenCompra; ?>" />
        </div>
        <div id="form-productosordencompra">
          <div class="box-header with-border">
            <h3 class="box-title">Productos del Orden de Compra Seleccionado</h3>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-condensed">
              <thead>
              <tr>
                <th>Código</th>
                <th>Nombre del Producto</th>
                <th>Descripcion del Producto</th>
                <th>Cantidad</th>
                <th>Cantidad Pendiente</th>
                <th>Cantidad Ingreso</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <tbody id="ListaDeDetallesOrdenCompra">
              </tbody>
            </table>
          </div>
          <?php if($funcion == "F"){ ?>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <input type="button" onclick="AccionOrdenCompra('C')" class="btn btn-sm btn-danger btn-flat" value="Cancelar Selección" />
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
        <?php if($funcion == "F"){ ?>
        <script>AccionOrdenCompra('C');</script>
        <?php } else if ($funcion == "M") {?>
        <script>AccionOrdenCompra('S');</script>
        <?php } ?>
          <div class="box-header with-border">
          </div>
          <div class="box-header with-border">
            <h3 class="box-title">Detalles de la Guia Interna de Entrada</h3>
          </div>
            <div class="table-responsive">
              <table class="table table-hover table-condensed">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Nombre del Producto</th>
                  <th>Descripcion del Producto</th>
                  <th>Cantidad</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="ListaDeDetallesGuiasInternaEntrada">
                </tbody>
              </table>
            </div>
        </div>
        <div class="box-footer clearfix">
            <?php if($funcion == "F"){ ?>
            <input type="hidden" name="funcion" value="I" />
            <?php } else if($funcion == "M") { ?>
            <input type="hidden" name="funcion" value="A" />
            <?php } ?>
            <input type="hidden" name="intIdGuiaInternaEntrada" id="intIdGuiaInternaEntrada" value="<?php echo $this->intIdGuiaInternaEntrada; ?>" />
            <?php if($funcion == "F"){ ?>
            <input type="submit" id="btn-crear-guiainternaentrada" class="btn btn-sm btn-info btn-flat pull-left" value="Crear GuiaInternaEntrada">
            <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px" required="">
            <?php } ?>
        </div>              
        </form>
        <div id="resultadocrud"></div>
    </div>
<?php
  }
}
?>