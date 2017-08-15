<?php 
		include('../_include/rstheader.php');
?>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <script type="text/javascript" src="../../negocio/usuario/nusuario.js"></script>
    <script type="text/javascript" src="ajax/vusuario.js"></script>
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

<div class="content-wrapper" style="min-height: 1096px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Bienvenido al portal Resteco <?php echo $_SESSION['usr_name']; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Ejemplo </a></li>
            <li class="active">Perfil Usuario</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">          

          <div class="row">
            
            <div class="col-md-12">
                <div class="box box-info">
                  <img style="padding:100px;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Microsoft_logo_%282012%29.svg/1000px-Microsoft_logo_%282012%29.svg.png" alt="" width="100%">
                </div>
                <div class="box-footer clearfix">     
		            <a href="dashboard" class="btn btn-sm btn-danger btn-flat pull-left" style="margin: 0px 5px; border-radius: 3px">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Ver Dashboard
                </a>
		        </div>
            </div>

          </div>


        </section><!-- /.content -->
      </div>

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

<!-- For upload image -->
<script>
     $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario")[0]);
            var ruta = "ajax-imagen.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
     });
</script>
<!-- END For upload image -->

<?php include('../_include/rstfooter.php'); ?>