<?php
  session_start();
  require_once '../../conexion/bd_conexion.php';

  $anio = date('y'); // anio en 2 digitos

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

  //variable de impresion
  $descripcion = 'Lorem ipsum dolor si itt amet, consectetur Aeznabarso orem ipsum dolor si itt amet itt amettt'; //56 carateres por linea de item

  include('class_numero_a_texto.php'); //incluir funcion
?>


<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type"
 content="text/html; charset=utf-8">
  <title style="text-transform: uppercase;">GUIA DE REMISION REMITENTE</title>
  <script src="//use.edgefonts.net/brush-script-std.js"></script>

  <style>
    table tr td {
      color: black;
      padding: 0.035em
    }
    table#tabladetalle {
      border-collapse: collapse;
    }
    table#tablageneral {
      border: 0px solid black;
      border-collapse: collapse;
    }
    tr#primerdetalle>td, tr#cuartodetalle>td, tr#quintodetalle>td, td.celdatotales{
      border: 0px solid black;
    }
    table#tablacontactos {
      border: 0px solid black;
    }
    tr.segundodetalle>td{
      border-left: 0px solid black;
      border-right: 0px solid black;
    }
    tr.ultimodetalle>td{
      border-bottom: 0px solid black; 
      border-left: 0px solid black;
      border-right: 0px solid black;
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

    span{
      /*color: green;*/
      font-size: 12px; /*fuente importante considerar*/
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

<body>

 <img src="../../imagenes/GUIA_DE_REMISION_REMITENTE.PNG" alt="" width="100%" style="">
 
 <div class="row" style="margin-top: 25px">
    <div class="" style="width: 53% !important; height: 100px; float: left; border: solid 2px transparent; ">
    </div>
    <div class="" style="width: 47% !important; height: 135px; float: left; border: solid 2px transparent; color: transparent;">
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: -8px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 22px; padding-top: -10px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: 10px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 11px; padding-top: -14px; text-align: center; font-weight: bolder">
            <span>
              20443881540
            </span>
        </h1>
    </div>
  </div>
  
  <div class="row" style="">
      <div class="" style="width: 100%; margin-top: 190px; text-align: left; z-index: 10;/*color: green*/">
          <p style="width: 85% !important; margin: 0 auto; font-size: 14px">
              <!--span>Fecha de Emisión……..de………………………..de 20……...</span-->
              <span style="margin-left: 110px !important;font-weight: bolder">20</span> 
              <span style="margin-left: 50px !important;font-weight: bolder">Enero</span>
              <span style="margin-left: 105px !important;font-weight: bolder"><?php echo $anio; ?></span>
          </p>
      </div>
  </div>

  <div class="row">
      <div class="" style="width: 100%; margin-top: 23px; text-align: left; z-index: 10">
          <table id="tablageneral" style="text-align: left; width: 86%; margin: 0 auto;">
            <tbody>
              <tr>
                <td style="font-weight: bold; font-family: Arial; width: 13% !important;">
                    <!--span>Señor(es):</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 42% !important; ">
                    <span style="margin-left: -5px;">Pablo de la juan nepumusenos krispin </span>
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 20% !important;">
                    <!--span>Forma de Pago:</span--> 
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 15% !important; ">
                    <span style="margin-left: 0px; text-align: right;">GRUIA000000212</span>
                </td>
              </tr>
              <tr style=";">
                <td style="font-weight: bold; font-family: Arial; width: 13% !important; ">
                    <!--span>RUC / DNI:</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 42% !important;"> 
                    <span style="margin-left: -5px; margin-top: 10px">10750005760</span>
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 20% !important; ">
                    <!--span>Guía de remisión:</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 15% !important; ">
                    <span style="margin-left: 40px; text-align: right; margin-top: 10px">12/12/2017</span>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
  </div>

  <div class="row">
      <div class="" style="width: 100%; margin-top: 25px; text-align: left; z-index: 10">
          <table id="tablageneral" style="text-align: left; width: 86%; margin: 0 auto;">
            <tbody>
              <tr>
                <td style="font-weight: bold; font-family: Arial; text-align: center; width: 11% !important; height: 25px !important">
                    <span style="">Pablo de la juan nepumusenos krispin </span>
                </td>
                <td style="font-weight: bold; font-family: Arial; text-align: center; width: 11% !important; height: 25px !important">
                    <span style="">Pablo de la juan nepumusenos krispin </span>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
  </div>

  <div class="row">
    <div class="" style="width: 100%; margin-top: -25px; text-align: left; z-index: 10">
        <table id="tabladetalle" style="text-align: left; width: 86%; z-index: 10; margin: 0 auto" cellpadding="3" cellspacing="1">
          <tbody>
            <tr id="primerdetalle" style="">
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 7.89% !important; height: 10px !important">
                  <small>
                    <small>
                        <!--span>ITEM</span-->
                    </small>
                  </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 10.53% !important; height: 15px !important">
                <small>
                    <small>
                        <!--span>CANT.</span-->
                  </small>
                </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 13.15% !important; height: 25px !important">
                  <small>
                    <small>
                        <!--span>CÓDIGO</span-->
                    </small>
                  </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 68.42% !important; height: 50px !important">
                <small>
                    <small>
                        <!--span>DESCRIPCIÓN</span-->
                    </small>
                </small>
              </td>
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
            <tr class="segundodetalle" style="text-align: center; border-bottom: -30px solid; padding-top: -10px: ">
              <td style="width: 7.89% !important; font-size:x-small; padding: 0px">
                <span>
                  <?php //echo $i; ?>
                </span>
              </td>
              <td style="width: 10.53% !important; font-size:x-small; padding: 0px">
                <span>
                  20443881540
                </span>
              </td>
              <td style="width: 13.15% !important; font-size:x-small; padding: 0px">
                <span>
                  <?php echo strlen($descripcion) ?>
                </span>
              </td>
              <td style="width: 68.42% !important; font-size:x-small; padding: 0px">
                <span>
                  <?php echo $descripcion; ?>
                </span>
              </td>
            </tr>

            <?php
                $i++;
              }
              for($j = $i ; $j <= 32; $j++){
                if($j == 32) {
                  echo '<tr class="ultimodetalle" style="text-align: center; color:white;">';
                } else {
                  echo '<tr class="segundodetalle" style="text-align: center; color:white;">';
                }
            ?>
              <td style="width: 7.89% !important; font-size:x-small;">
                <span>
                  <?php //echo $j ?>
                </span>
              </td>
              <td style="width: 10.53% !important; font-size:x-small; text-align: left; padding-right: 0px;word-wrap: break-word">
                <span>
                  12
                </span>
              </td>
              <td style="width: 13.15% !important; font-size:x-small; text-align: left; padding-right: 0px;word-wrap: break-word">
                <span>
                    <?php echo '20443881540';//echo strlen($descripcion) ?>
                </span>
              </td>
              <td style="width: 68.42% !important; font-size:x-small; text-align: left">
                <span style="">
                    <?php echo $descripcion; ?>
                </span>
              </td>
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

  <!-- INICIO - table MOTIVO DE TRASADO -->
  <div class="row" style=" padding-top: 5px; z-index: 10">
    <table  id="tabladetalle" style="text-align: left; width: 86%; z-index: 10; margin: 0 auto" cellpadding="3" cellspacing="1">
      <tr>
        <td>
          <span style="font-weight: bolder; /*color: red*/; padding-left: 165px">
            X
          </span>
        </td>
      </tr>
    </table>
  </div>
  <!-- END - table MOTIVO DE TRASADO -->

  <!-- INICIO - table MOTIVO DE TRASADO -->
  <!--div class="row" style=" padding-top: -5px; z-index: 10">
    <table style="text-align: left; width: 86%; margin: 0 auto; /*border: solid 2px*/">
      <tr style="text-align: right; padding-top: 0px ">
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span>
             primero
          </span>
        </td>
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span>
             primero
          </span>
        </td>
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span style="">
              primero
          </span>
        </td>
      </tr>
      <tr style="text-align: right; padding-top: 0px ">
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span>
            primero
          </span>
        </td>
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span>
             primero
          </span>
        </td>
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span style="">
             primero
          </span>
        </td>
      </tr>
      <tr style="text-align: right; padding-top: 0px ">
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span>
            primero
          </span>
        </td>
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span>
            primero
          </span>
        </td>
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span style="">
             primero
          </span>
        </td>
      </tr>
      <tr style="text-align: right; padding-top: 0px ">
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span>
            primero
          </span>
        </td>
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span>
            primero
          </span>
        </td>
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span style="">
            primero
          </span>
        </td>
      </tr>
        <tr style="text-align: right; padding-top: 0px ">
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span>
           primero
          </span>
        </td>
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span>
            primero
          </span>
        </td>
        <td style="font-size:x-small; text-align: right; padding-right: 0px;word-wrap: break-word">
          <span style="">
            primero
          </span>
        </td>
      </tr>
    </table>
  </div-->
  <!-- END - table MOTIVO DE TRASADO -->

  <!-- INICIO - table DATOS DEL TRNSPORTISTA -->
  <div class="row" style=" margin-top: 80px; z-index: 10">
    <table style="text-align: left; width: 86%; margin: 0 auto; /*border: solid 2px*/">
      <tr>
        <td style="width: 60%;text-align: right;">
          <span style=" padding-right: 5px">
            Nombre de razon social
          </span>
        </td>
        <td style="width: 40%;text-align: right;">
          <span style=" padding-right: 5px">
            Vehiculo
          </span>
        </td>
      </tr>
      <tr>
        <td style="width: 60%;text-align: right;">
          <span style=" padding-right: 5px">
            RUC
          </span>
        </td>
        <td style="width: 40%;text-align: right;">
          <span style=" padding-right: 5px">
            Placa N
          </span>
        </td>
      </tr>
      <tr>
        <td style="width: 60%;text-align: right;">
          <span style=" padding-right: 5px">
            Dirección
          </span>
        </td>
        <td style="width: 40%;text-align: right;">
          <span style=" padding-right: 5px">
            Conducto
          </span>
        </td>
      </tr>
      <tr>
        <td style="width: 60%;text-align: right;">
          <span style=" padding-right: 5px">
            telefono
          </span>
        </td>
        <td style="width: 40%;text-align: right;">
          <span style=" padding-right: 5px">
            Licencia Conductor
          </span>
        </td>
      </tr>
    </table>
  </div>
  <!-- END - table DATOS DEL TRNSPORTISTA -->

  <!-- INICIO - tabla despachado por -->
  <div class="row" style=" margin-top: 20px; z-index: 10">
    <table style="text-align: left; width: 86%; margin: 0 auto; /*border: solid 2px*/">
      <tr>
        <td style="width: 58%;text-align: right; padding-top: 0px; font-size:x-small;">
          <span style="font-size:x-small; padding-right: 5px">
          </span>
        </td>
        <td style="width: 38%;text-align: right; padding-top: 0px; font-size:x-small;">
          <span style="font-size:x-small; padding-right: 5px">
            Nombre
          </span>
        </td>
      </tr>
      <tr>
        <td style="width: 58%;text-align: right; padding-top: 0px; font-size:x-small;">
          <span style="font-size:x-small; padding-right: 5px">
          </span>
        </td>
        <td style="width: 38%;text-align: right; padding-top: 0px; font-size:x-small;">
          <span style="font-size:x-small; padding-right: 5px">
            DNI
          </span>
        </td>
      </tr>
      <tr>
        <td style="width: 58%;text-align: right; padding-top: 0px; font-size:x-small;">
          <span style="font-size:x-small; padding-right: 5px">
          </span>
        </td>
        <td style="width: 38%;text-align: right; padding-top: 0px; font-size:x-small;">
          <span style="font-size:x-small; padding-right: 5px">
            Fecha
          </span>
        </td>
      </tr>
    </table>
  </div>
  <!-- END - tabla despachado por -->

<br>  

<!--style>
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
</style-->

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
  $filename = 'GUIA DE REMISION REMITENTE';
  $dompdf = new DOMPDF();
  $html = ob_get_clean();
  pdf_create($html,$filename,'A4','portrait');

?>