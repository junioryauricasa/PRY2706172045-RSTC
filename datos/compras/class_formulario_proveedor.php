<?php 
class FormularioProveedor
{
  private $intIdProveedor;
  private $nchDNI;
  private $nchRUC;
  private $nvchRazonSocial;
  private $nvchApellidoPaterno;
  private $nvchApellidoMaterno;
  private $nvchNombres;
  private $intIdTipoPersona;

  public function IdProveedor($intIdProveedor){ $this->intIdProveedor = $intIdProveedor; }
  public function DNI($nchDNI){ $this->nchDNI = $nchDNI; }
  public function RUC($nchRUC){ $this->nchRUC = $nchRUC; }
  public function RazonSocial($nvchRazonSocial){ $this->nvchRazonSocial = $nvchRazonSocial; }
  public function ApellidoPaterno($nvchApellidoPaterno){ $this->nvchApellidoPaterno = $nvchApellidoPaterno; }
  public function ApellidoMaterno($nvchApellidoMaterno){ $this->nvchApellidoMaterno = $nvchApellidoMaterno; }
  public function Nombres($nvchNombres){ $this->nvchNombres = $nvchNombres; }
  public function IdTipoPersona($intIdTipoPersona){ $this->intIdTipoPersona = $intIdTipoPersona; }

  function ConsultarFormulario($funcion)
  {
  ?> 
      <div class="box box-default">
        <div class="box-header with-border">
          <?php if($funcion == "F"){ ?>
          <h3 class="box-title">Nuevo Producto</h3>
          <?php } else if($funcion == "M") {?>
          <h3 class="box-title">Editar Producto</h3>
          <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form id="form-producto" method="POST">
          <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Tipo de Persona:</label>
                    <input type="text" name="intIdTipoPersona" class="form-control select2" placeholder="Ingrese la cantidad" value="<?php echo $this->intIdTipoPersona; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>DNI:</label>
                    <input type="text" name="nchDNI" class="form-control select2" placeholder="Ingrese código del producto" value="<?php echo $this->nchDNI; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>RUC:</label>
                    <input type="text" name="nchRUC" class="form-control select2" placeholder="Ingrese código de inventario" value="<?php echo $this->nchRUC; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Razón Social:</label>
                    <input type="text" name="nvchRazonSocial" class="form-control select2" placeholder="Ingrese nombre del producto" value="<?php echo $this->nvchRazonSocial; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Apellido Paterno:</label>
                    <input type="text" name="nvchApellidoPaterno" class="form-control select2" placeholder="Ingrese la descripción" value="<?php echo $this->nvchApellidoPaterno; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Apellido Materno: S/.</label>
                    <input type="text" name="nvchApellidoMaterno" class="form-control select2" placeholder="Ingrese el precio de compra" value="<?php echo $this->nvchApellidoMaterno; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Nombres: S/.</label>
                    <input type="text" name="nvchNombres" class="form-control select2" placeholder="Ingrese el precio de venta" value="<?php echo $this->nvchNombres; ?>" required>
                  </div>
                </div>
            </div>
          </div>
      <div class="box-header with-border">
      </div>
      <div class="box-header with-border">
        <h3 class="box-title">Ubigeo</h3>
      </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Sucursal:</label>
                    <input type="text" name="nvchSucursal" class="form-control select2" placeholder="Ingrese la sucursal (Ubigeo)" value="<?php echo $this->nvchSucursal; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Gabinete:</label>
                    <input type="text" name="nvchGabinete" class="form-control select2" placeholder="Ingrese el gabinete (Ubigeo)" value="<?php echo $this->nvchGabinete; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Cajon:</label>
                    <input type="text" name="nvchCajon" class="form-control select2" placeholder="Ingrese el cajón (Ubigeo)" value="<?php echo $this->nvchCajon; ?>" required>
                  </div>
                </div>
            </div>
        </div>  
          <div class="box-footer clearfix">
              <?php if($funcion == "F"){ ?>
              <input type="hidden" name="funcion" value="I" />
              <?php } else if($funcion == "M") { ?>
              <input type="hidden" name="funcion" value="A" />
              <?php } ?>
              <input type="hidden" name="intIdProveedor" value="<?php echo $this->intIdProveedor; ?>" />
              <input type="hidden" name="dtmFechaIngreso" value="<?php echo $this->dtmFechaIngreso; ?>" />
              <?php if($funcion == "F"){ ?>
              <input type="submit" id="btn-crear-producto" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Producto">
              <?php } else if($funcion == "M") { ?>
              <input type="submit" id="btn-editar-producto" class="btn btn-sm btn-info btn-flat pull-left" value="Editar Producto">
              <?php } ?>
              <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px" required="">
          </div>              
        </form>
        <div id="resultadocrud"></div>
      </div>
<?php
  }
}
?>