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
  $descripcion = 'Lorem ipsum dolor sit amet, consectetur Aemo suaznabarso'; //56 carateres por linea de item

  include('class_numero_a_texto.php'); //incluir funcion
?>


<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type"
 content="text/html; charset=utf-8">
  <title style="text-transform: uppercase;">REPORTE COTIZACION POR SERVICIOS</title>
  <script src="//use.edgefonts.net/brush-script-std.js"></script>

  <style>
    table tr td {
      color: black;
      padding: 0.05em
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

 <!--img src="../../imagenes/background-factura.JPG" alt="" width="100%" style=""-->
 
 <div class="row" style="margin-top: -10px">
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
      <div class="" style="width: 100%; margin-top: 169px; text-align: left; z-index: 10;/*color: green*/">
          <p style="width: 85% !important; margin: 0 auto; font-size: 14px">
              <!--span>Fecha de Emisión……..de………………………..de 20……...</span-->
              <span style="margin-left: 110px !important;font-weight: bolder">20</span> 
              <span style="margin-left: 50px !important;font-weight: bolder">Enero</span>
              <span style="margin-left: 105px !important;font-weight: bolder"><?php echo $anio; ?></span>
          </p>
      </div>
  </div>

  <div class="row">
      <div class="" style="width: 100%; margin-top: 6px; text-align: left; z-index: 10">
          <table id="tablageneral" style="text-align: left; width: 86%; margin: 0 auto; border: solid 2px transparent">
            <tbody>
              <tr>
                <td style="font-weight: bold; font-family: Arial; width: 13% !important;">
                    <!--span>Señor(es):</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 42% !important; ">
                    <span style="margin-left: -5px;">carlos montana</span>
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 20% !important;">
                    <!--span>Forma de Pago:</span--> 
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 15% !important; ">
                    <span style="margin-left: -20px;">Efectivo</span>
                </td>
              </tr>
              <tr>
                <td style="font-weight: bold; font-family: Arial; width: 13% !important; ">
                    <!--span>RUC / DNI:</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 42% !important;"> 
                    <span style="margin-left: -5px">10750005760</span>
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 20% !important; ">
                    <!--span>Guía de remisión:</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 15% !important; ">
                    <span style="margin-left: -20px">GRUIA000000212</span>
                </td>
              </tr>
              <tr>
                <td style="font-weight: bold; font-family: Arial; width: 13% !important; ">
                    <!--span>Dirección:</span-->
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 42% !important; ">
                    <span style="margin-left: -5px">Psje Alamedas 123</span>
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 20% !important; ">
                    <!--span>Asesor de Ventas:</span--> 
                </td>
                <td style="font-weight: bold; font-family: Arial; width: 15% !important; ">
                    <span style="margin-left: -20px">Hector vivanco</span>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
  </div>

  <div class="row">
    <div class="" style="width: 100%; margin-top: 10px; text-align: left; z-index: 10">
        <table id="tabladetalle" style="text-align: left; width: 86%; z-index: 10; margin: 0 auto" cellpadding="3" cellspacing="1">
          <tbody>
            <tr id="primerdetalle" style="">
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 8% !important; height: 25px !important">
                  <small>
                    <small>
                        <!--span>ITEM</span-->
                    </small>
                  </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 16.67% !important; height: 25px !important">
                  <small>
                    <small>
                        <!--span>CÓDIGO</span-->
                    </small>
                  </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 50% !important; height: 25px !important">
                <small>
                    <small>
                        <!--span>DESCRIPCIÓN</span-->
                    </small>
                </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 11% !important; height: 25px !important">
                <small>
                    <small>
                        <!--span>CANT.</span-->
                  </small>
                </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 13.8% !important; height: 25px !important">
                  <small>
                    <small>
                        <!--span>P. UNIT.</span-->
                    </small>
                  </small>
              </td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 13,8% !important; height: 25px !important">
                  <small>
                    <small>
                        <!--span>P. TOTAL</span-->
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
            <tr class="segundodetalle" style="text-align: center; border-bottom: 0px solid; padding-top: -10px: ">
              <td style="width: 8% !important; font-size:x-small; padding:0px">
                <span>
                  <?php //echo $i; ?>
                </span>
              </td>
              <td style="width: 16.67% !important; font-size:x-small; padding:0px">
                <span>
                  20443881540
                </span>
              </td>
              <td style="width: 50% !important; font-size:x-small; padding:0px">
                <span>
                  <?php echo $descripcion; ?>
                </span>
              </td>
              <td style="width: 11% !important; font-size:x-small; padding:0px">
                <span>
                  <?php echo strlen($descripcion) ?>
                </span>
              </td>
              <td style="width: 13.8% !important; font-size:x-small; text-align: left padding:0px">
                <span>
                  
                </span>
              </td>
              <td style="width: 13.8% !important; font-size:x-small; text-align: left padding:0px">
                <span>
                  
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
              <td style="width: 8% !important; font-size:x-small;"><?php //echo $j ?></td>
              <td style="width: 16.67% !important; font-size:x-small;">
                <span>
                  20443881540
                </span>
              </td>
              <td style="width: 50% !important; max-width: 50% !important; font-size:x-small; text-align: left; padding-left: 7px; padding-right: 0px;word-wrap: break-word">
                <span>
                    <?php echo $descripcion; ?>
                </span>
              </td>
              <td style="width: 11% !important; font-size:x-small;">
                <span>
                  <?php echo strlen($descripcion) ?>
                </span>
              </td>
              <td style="width: 13.8% !important; font-size:x-small;">
                <span>
                  
                </span>
              </td>
              <td style="width: 13.8% !important; font-size:x-small;">
                <span>
                  
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

  <!-- table para el footer -->
  <div class="row" style=" padding-top: 15px; z-index: 10">
    <table style="text-align: left; width: 86%; margin: 0 auto; /*border: solid 2px*/">
      <!-- INICIO - row VALOR VENTA -->
      <tr>
        <td style="width: 8% !important; font-size:x-small; padding:0px"></td>
        <td style="width: 56.67% !important; font-size:x-small; padding:0px">
            <span>
                <?php 
                    $numero = 1000.45;
                    //convertir_a_letras(1900);
                    echo 'Ciento cicncuenta y nueve mil trescientos cuarenta y cinco soles';
                ?>      
            </span>
        </td>
        <td style="width: 11% !important; font-size:x-small;">
          <span></span>
        </td>
        <td style="width: 13.8% !important; font-size:x-small;"></td>
        <td style="width: 13.8% !important; font-size:x-small; text-align: right; padding-right: 7px;">
          <span>159345.20</span>
        </td>
      </tr>
      <!-- END - row VALOR VENTA -->

      <!-- INICIO - row IGV -->
      <tr>
        <td colspan="3"></td>
        <td style="width: 11% !important; font-size:x-small;">
          <span></span>
        </td>
        <td style="width: 13.8% !important; font-size:x-small; text-align: right; padding-right: 6px; padding-top: 10px">
          <span>159345.20</span>
        </td>
      </tr>
      <!-- END - row IGV -->

      <!-- INICIO - row TOTAL -->
      <tr>
        <td colspan="3"></td>
        <td style="width: 11% !important; font-size:x-small;">
          <span></span>
        </td>
        <td style="width: 13.8% !important; font-size:x-small; text-align: right; padding-right: 6px; padding-top: 10px">
          <span style="">159345.20</span>
        </td>
      </tr>
      <!-- END - row TOTAL -->
    </table>
  </div>
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
  $filename = 'REPORTE_FACTURA';
  $dompdf = new DOMPDF();
  $html = ob_get_clean();
  pdf_create($html,$filename,'A4','portrait');

?>