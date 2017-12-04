<?php
require_once '../conexion/bd_conexion.php';
class FormularioMonedaTributaria
{
  private $intIdMonedaTributaria;
  private $intIdTipoCambio;
  private $dcmCambio1;
  private $dcmCambio2;
  private $dtmFechaCambio;

  public function IdMonedaTributaria($intIdMonedaTributaria){ $this->intIdMonedaTributaria = $intIdMonedaTributaria; }
  public function IdTipoCambio($intIdTipoCambio){ $this->intIdTipoCambio = $intIdTipoCambio; }
  public function Cambio1($dcmCambio1){ $this->dcmCambio1 = $dcmCambio1; }
  public function Cambio2($dcmCambio2){ $this->dcmCambio2 = $dcmCambio2; }
  public function FechaCambio($dtmFechaCambio){ $this->dtmFechaCambio = $dtmFechaCambio; }

  function ConsultarFormulario($funcion)
  {
  ?>  

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">
                 <?php if($funcion == "F"){ ?>
                  Nueva Moneda Tributaria
                  <?php } else if($funcion == "M") {?>
                  Editar Moneda Tributaria
                  <?php } ?>
            </h4>
        </div>
        <div class="modal-body">
              <div id="Formulario" class="">
                <div class="">
                </div>
                <form id="form-moneda-tributaria" method="POST">
                  <div class="">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Tipo de Cambio:</label>
                          <br>
                          <select id="intIdTipoCambio" name="intIdTipoCambio"  class="form-control select2">
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
                      <div class="col-md-6">
                        <div id="dcmCambio1Group" class="form-group">
                          <label>Valor Monetario EstadoUnidense:</label>
                          <input type="text" id="dcmCambio1" name="dcmCambio1" class="form-control select2" placeholder="Ingrese Cambio 1" 
                          value="<?php echo $this->dcmCambio1; ?>" onkeypress="return EsDecimalTecla(event)" 
                          onkeyup="EsDecimal('dcmCambio1')" maxlength="50" required>
                          <span id="dcmCambio1Icono" class="" aria-hidden=""></span>
                          <div id="dcmCambio1Obs" class=""></div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div id="dcmCambio2Group" class="form-group">
                          <label>Valor Monetario Sol:</label>
                          <input type="text" id="dcmCambio2" name="dcmCambio2" class="form-control select2" placeholder="Ingrese Cambio 2" 
                          value="<?php echo $this->dcmCambio2; ?>" onkeypress="return EsDecimalTecla(event)" 
                          onkeyup="EsDecimal('dcmCambio2')" maxlength="50">
                          <span id="dcmCambio2Icono" class="" aria-hidden=""></span>
                          <div id="dcmCambio2Obs" class=""></div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div id="dtmFechaCambioGroup" class="form-group">
                          <label>Fecha:</label>
                          <input type="text" id="dtmFechaCambio" name="dtmFechaCambio" class="form-control select2" placeholder="dd/mm/aaaa" value="<?php echo $this->dtmFechaCambio; ?>" onkeyup="EsFecha('dtmFechaCambio')" maxlength="10">
                          <span id="dtmFechaCambioIcono" class="" aria-hidden=""></span>
                          <div id="dtmFechaCambioObs" class=""></div>
                        </div>
                      </div>
                    </div>
                </div>
                <br>
                <div class="clearfix">
                    <?php if($funcion == "F"){ ?>
                    <input type="hidden" name="funcion" value="I" />
                    <?php } else if($funcion == "M") { ?>
                    <input type="hidden" name="funcion" value="A" />
                    <?php } ?>
                    <input type="hidden" name="intIdMonedaTributaria" id="intIdMonedaTributaria" value="<?php echo $this->intIdMonedaTributaria; ?>" />
                    <?php if($funcion == "F"){ ?>
                    <input type="button" id="btn-crear-moneda-tributaria" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Moneda Tributaria">
                    <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
                    <?php } else if($funcion == "M") { ?>
                    <input type="button" id="btn-editar-moneda-tributaria" class="btn btn-sm btn-warning btn-flat pull-left" value="Editar Moneda Tributaria"> 
                    <input type="reset" class="btn btn-sm btn-danger btn-flat pull-left" value="Limpiar" style="margin: 0px 5px">
                    <?php } ?>

                    <!-- btn cerrar -->
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left" id="btn-form-moneda-tributaria-remove" data-dismiss="modal">Cerrar Formulario</button>
                    
                </div>              
                </form>
                <div id="resultadocrud"></div>
              </div>

        </div>


<?php
  }
}
?>