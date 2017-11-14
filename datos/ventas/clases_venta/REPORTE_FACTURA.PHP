<?php
  session_start();
  require_once '../../conexion/bd_conexion.php';
  $intIdCotizacion = $_GET['intIdCotizacion'];
  ob_start();
  $sql_conexion = new Conexion_BD();
  $sql_conectar = $sql_conexion->Conectar();
  $sql_comando = $sql_conectar->prepare('CALL MostrarCotizacion(:intIdCotizacion)');
  $sql_comando -> execute(array(':intIdCotizacion' => $intIdCotizacion));
  $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

  $nvchSerie = $fila['nvchSerie'];
  $nvchNumeracion = $fila['nvchNumeracion'];
  $nvchAtencion = $fila['nvchAtencion'];
  $intDiasValidez = $fila['intDiasValidez'];
  $nvchTipo = $fila['nvchTipo'];
  $nvchModelo = $fila['nvchModelo'];
  $nvchMarca = $fila['nvchMarca'];
  $nvchHorometro = $fila['nvchHorometro'];
  
  $NombreUsuario = $fila['NombreUsuario'];
  $NombreCliente = $fila['NombreCliente'];
  $DNICliente = $fila['DNICliente'];
  $RUCCliente = $fila['RUCCliente'];
  $SimboloMoneda = $fila['SimboloMoneda'];
  $NombrePago = $fila['NombrePago'];
  $NombreVenta = $fila['NombreVenta'];

  $dtmFechaCreacion = $fila['dtmFechaCreacion'];
  $nvchObservacion = $fila['nvchObservacion'];
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type"
 content="text/html; charset=utf-8">
  <title style="text-transform: uppercase;">REPORTE COTIZACION POR SERVICIOS</title>
  <script src="//use.edgefonts.net/brush-script-std.js"></script>

  <style>
    table#tabladetalle {
      border-collapse: collapse;
    }
    table#tablageneral {
      border: 2px solid black;
      border-collapse: collapse;
    }
    tr#primerdetalle>td, tr#cuartodetalle>td, tr#quintodetalle>td, td.celdatotales{
      border: 2px solid black;
    }
    table#tablacontactos {
      border: 2px solid black;
    }
    tr.segundodetalle>td{
      border-left: 2px solid black;
      border-right: 2px solid black;
    }
    tr.ultimodetalle>td{
      border-bottom: 2px solid black; 
      border-left: 2px solid black;
      border-right: 2px solid black;
    }

    /* font para eslogan */
    #letterlogan{
      font-family: brush-script-std, sans-serif;
      font-size: 13px !important;
    }
  </style>
  
</head>

<style>
    @page {
      margin: 0;
    }

    img{
        background-image: url(../../imagenes/background-factura.PNG);
        /* Set rules to fill background */
        min-height: 100%;
        min-width: 1024px;
        
        /* Set up proportionate scaling */
        width: 100%;
        height: auto;
        
        /* Set up positioning */
        position: fixed;
        top: 0;
        left: 0;
    }
</style>

<style>
    .row::after {
        content: "";
        clear: both;
        display: table;
    }
    [class*="col-"] {
        float: left;
    }
    .col-1 {width: 8.33%;}
    .col-2 {width: 16.66%;}
    .col-3 {width: 25%;}
    .col-4 {width: 33.33%;}
    .col-5 {width: 41.66%;}
    .col-6 {width: 50%;}
    .col-7 {width: 58.33%;}
    .col-8 {width: 66.66%;}
    .col-9 {width: 75%;}
    .col-10 {width: 83.33%;}
    .col-11 {width: 91.66%;}
    .col-12 {width: 100%;}


    .centered {text-align:center}
    .fixed-bottom {position:fixed;bottom:55px;width:100%;}
</style>
<body>



  <div class="row" style="margin-top: 57px">
    <div class="" style="width: 53% !important; height: 100px; float: left; border: solid 2px transparent; ">
    </div>
    <div class="" style="width: 47% !important; height: 135px; float: left; border: solid 2px transparent; color: transparent;">
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: -8px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 22px; padding-top: -10px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: 10px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 11px; padding-top: -14px; color: black !important; text-align: center">20443881540</h1>
    </div>
  </div>
  
  <div class="row">
      <div class="" style="width: 100%; margin-top: 225px; text-align: left; z-index: 10">
          <p style="width: 85% !important; margin: 0 auto; font-size: 14px">
              <span>Fecha de Emisión……..de………………………..de 20……...</span>
          </p>
      </div>
  </div>

  <div class="row">
      <div class="" style="width: 100%; margin-top: 4px; text-align: left; z-index: 10">
<table id="tablageneral" style="text-align: left; width: 86%; margin: 0 auto; border: solid 2px transparent">
  <tbody>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 13% !important; padding-top: -3px;">
          Señor(es):
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 42% !important; padding-top: -3px;">
          
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 20% !important; padding-top: -3px;">
          Condición de Pago: 
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important; padding-top: -3px;">
          
      </td>
    </tr>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 13% !important; padding-top: -3px;">
          RUC / DNI:
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 42% !important; padding-top: -3px;"> 
          
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 20% !important; padding-top: -3px;">
          Vendedor:
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important; padding-top: -3px;">
          
      </td>
    </tr>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 13% !important; padding-top: -3px;">
          Dirección:
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 42% !important; padding-top: -3px;">
          
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 20% !important; padding-top: -3px;">
          Guía de remisión: 
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important; padding-top: -3px;">
          
      </td>
    </tr>
  </tbody>
</table>
      </div>
  </div>

  <div class="row">
    <div class="" style="width: 100%; margin-top: 7px; text-align: left; z-index: 10">
<table id="tabladetalle" style="text-align: left; width: 86%; z-index: 10; margin: 0 auto" cellpadding="3" cellspacing="1">
  <tbody>
    <tr id="primerdetalle" style="">
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 14.28% !important;"><small><small>CÓDIGO</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 50% !important;"><small><small>DESCRIPCIÓN</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 7.14% !important;"><small><small>CANT.</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 14.28% !important;"><small><small>P. UNIT.</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 14.28% !important;"><small><small>P. TOTAL</small></small></td>
    </tr>

    <?php
      $ValorCotizacion = 0.00;
      $IGVCotizacion = 0.00;
      $TotalCotizacion = 0.00;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleCotizacion(:intIdCotizacion)');
      $sql_comando -> execute(array(':intIdCotizacion' => $intIdCotizacion));
      $cantidad = $sql_comando -> rowCount();
      $i = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $TotalCotizacion += $fila['dcmTotal'];
    ?>
    <tr class="segundodetalle" style="text-align: center; border-bottom: 0px solid">
      <td style="width: 14.28% !important; font-size:x-small;"><?php echo $i; ?></td>
      <td style="width: 50% !important; font-size:x-small;"><?php //echo $fila['']; ?></td>
      <td style="width: 7.14% !important; font-size:x-small;"><?php //echo $fila['']; ?></td>
      <td style="width: 14.28% !important; font-size:x-small; text-align: left"><?php //echo $fila['']; ?></td>
      <td style="width: 14.28% !important; font-size:x-small; text-align: left"><?php //echo $fila['']; ?></td>
    </tr>
    <?php
        $i++;
      }
      for($j = $i ; $j <= 20; $j++){
        if($j == 20) {
          echo '<tr class="ultimodetalle" style="text-align: center; color:white;">';
        } else {
          echo '<tr class="segundodetalle" style="text-align: center; color:white;">';
        }
    ?>
      <td style="width: 14.28% !important; font-size:x-small;">|</td>
      <td style="width: 50% !important; font-size:x-small;">|</td>
      <td style="width: 7.14% !important; font-size:x-small;">|</td>
      <td style="width: 14.28% !important; font-size:x-small;">|</td>
      <td style="width: 14.28% !important; font-size:x-small;">|</td>
    </tr>
    <?php
      }
      $ValorCotizacion = number_format($TotalCotizacion/1.18,2,'.','');
      $IGVCotizacion = $TotalCotizacion - $ValorCotizacion;
    ?>
  </tbody>
</table>
    </div>
  </div>
<br>  

<style>
    * {
        box-sizing: border-box;
    }
    .row::after {
        content: "";
        clear: both;
        display: table;
    }
    [class*="col-"] {
        float: left;
    }
    .col-1 {width: 8.33%;}
    .col-2 {width: 16.66%;}
    .col-3 {width: 25%;}
    .col-4 {width: 33.33%;}
    .col-5 {width: 41.66%;}
    .col-6 {width: 50%;}
    .col-7 {width: 58.33%;}
    .col-8 {width: 66.66%;}
    .col-9 {width: 75%;}
    .col-10 {width: 83.33%;}
    .col-11 {width: 91.66%;}
    .col-12 {width: 100%;}


    .centered {text-align:center}
    .fixed-bottom {position:fixed;bottom:55px;width:100%;}
</style>

</body>

</html>
<?php
  require_once("../../../frameworks/dompdf/dompdf_config.inc.php");
  spl_autoload_register('DOMPDF_autoload');
  function pdf_create($html, $filename, $paper, $orientation, $stream=TRUE)
  {
    $dompdf = new DOMPDF();
    $dompdf->set_paper($paper,$orientation);
    $dompdf->load_html($html);
    $dompdf->render();
    //$dompdf->stream($filename.".pdf"); //descargar automaticamente
    $dompdf->stream($filename.".pdf", array("Attachment" => false)); //previsualizar
  }
  $filename = 'REPORTE_COTIZACION_POR_SERVICIOS';
  $dompdf = new DOMPDF();
  $html = ob_get_clean();
  pdf_create($html,$filename,'A4','portrait');

?>

  <!--div style="z-index: 100; width: 100%; margin: 0 auto; padding: 55px; text-align: center">
    <div class="row">
      <div class="" style="width: 61%; height: 100px; float: left; border: solid 2px transparent; ">
      </div>
      <div class="" style="width: 38%; height: 135px; float: left; border: solid 2px transparent; color: transparent;">
          <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: -8px; color: transparent; height: 25px"></h1>
          <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 22px; padding-top: -10px; color: transparent; height: 25px"></h1>
          <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: 10px; color: transparent; height: 25px"></h1>
          <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 10px; padding-top: -12px; color: black !important;">20443881540</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12" style="border: solid 2px green; margin-top: 150px;">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum labore, qui nulla aut! Consectetur maiores eveniet inventore sunt sequi quaerat unde, expedita officiis aut nostrum soluta omnis sit vitae, eum.    
      </div>
    </div>
  </div-->
