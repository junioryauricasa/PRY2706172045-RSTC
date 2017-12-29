<div id="lista-personaCol" class="col-md-3">
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
<script type="text/javascript">$("#lista-personaCol").hide();</script>