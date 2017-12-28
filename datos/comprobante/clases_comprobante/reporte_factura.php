<?php
  session_start();
  require_once '../../conexion/bd_conexion.php';

  $intIdComprobante = $_GET['intIdComprobante'];
  ob_start();
  $sql_conexion = new Conexion_BD();
  $sql_conectar = $sql_conexion->Conectar();
  $sql_comando = $sql_conectar->prepare('CALL MostrarComprobante(:intIdComprobante)');
  $sql_comando -> execute(array(':intIdComprobante' => $intIdComprobante));
  $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

  $nvchSerie = $fila['nvchSerie'];
  $nvchNumeracion = $fila['nvchNumeracion'];
  $NombreUsuario = $fila['NombreUsuario'];
  $nvchClienteProveedor = $fila['nvchClienteProveedor'];
  $nvchDireccion = $fila['nvchDireccion'];
  $nvchDNIRUC = $fila['nvchDNIRUC'];
  $nvchSimbolo = $fila['SimboloMoneda'];
  $NombrePago = $fila['NombrePago'];
  $NombreVenta = $fila['NombreVenta'];
  $intIdTipoVenta = $fila['intIdTipoVenta'];
  $dtmFechaCreacion = $fila['dtmFechaCreacion'];
  $nvchObservacion = $fila['nvchObservacion'];
  $nvchAnio = date('y', strtotime($fila['dtmFechaCreacion'])); // anio en 2 digitos
  $nvchDia = date('d', strtotime($fila['dtmFechaCreacion']));
  $numMes = Round(date('m', strtotime($fila['dtmFechaCreacion'])));
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  $nvchMes = $meses[$numMes-1];
  //variable de impresion
  $descripcion = 'Lorem ipsum dolor sit amet, consectetur Aemo suaznabarso'; //56 carateres por linea de item


  // Tipo de moneda 

  $tipoMoneda = 0;

  if($tipoMoneda == 0){
    $tipoMoneda = 3.5;
    $simboloMoneda = ' DOLARES';
    $simboloMoneda1 = ' USD ';
  }else
  if($tipoMoneda == 1){
    $tipoMoneda = 1;
    $simboloMoneda = ' SOLES';
    $simboloMoneda1 = ' S/. ';
  }

  include('class_numero_a_texto.php'); //incluir funcion
?>


<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type"
 content="text/html; charset=utf-8">
  <title style="text-transform: uppercase;">Factura</title>
  <script src="//use.edgefonts.net/brush-script-std.js"></script>

  <style>
    table tr td {
      /*color: black;
      padding: 0.05em*/
      padding: 0px !important
    }
    table#tabladetalle {
      /*border-collapse: collapse;
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
      border-right: 0px solid black;*/
    }

    /* font para eslogan #letterlogan, */
    * {
      /*
      font-family: Lucida Console,Lucida Sans Typewriter,monaco,Bitstream Vera Sans Mono,monospace; 
      font-size: 12px !important;
      */
      font-family: Consolas, monaco, monospace !important;
      font-size: 9px !important;
      padding: 0px !important
      
    }
    #tabladetalle tr{
        border: 1px solid black;
        border-collapse: collapse;
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
      /*font-size: 12px; fuente importante considerar*/
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

<body style="margin-top: 50px">

 <!--img src="../../imagenes/background-factura.JPG" alt="" width="100%" style=""-->
 
 <div class="row" style="margin-top: -10px">
    <div class="" style="width: 53% !important; height: 100px; float: left; border: solid 2px transparent; ">
    </div>
    <div class="" style="width: 47% !important; height: 135px; float: left; border: solid 2px transparent; color: transparent;">
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: -8px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 22px; padding-top: -10px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'verdana'; font-weight: bolder; font-size: 24px; padding-top: 10px; color: transparent; height: 25px"></h1>
        <h1 style="font-family: 'Arial'; font-size: 11px; padding-top: -14px; text-align: center;">
            <span style="color: black; font-weight: 100">
              <?php echo $nvchSerie.' - '.$nvchNumeracion; ?>
            </span>
        </h1>
    </div>
  </div>
  
  <div class="row" style="">
      <div class="" style="width: 100%; margin-top: 169px; text-align: left; z-index: 10;/*color: green*/">
          <p style="width: 85% !important; margin: 0 auto; font-size: 14px">
              <!--span>Fecha de Emisión……..de………………………..de 20……...</span-->
              <span style="margin-left: 110px !important;"><?php echo $nvchDia; ?></span> 
              <span style="margin-left: 50px !important;"><?php echo $nvchMes ?></span>
              <span style="margin-left: 105px !important;"><?php echo $nvchAnio; ?></span>
          </p>
      </div>
  </div>

  <div class="row">
      <div class="" style="width: 100%; margin-top: 6px; text-align: left; z-index: 10">
          <table id="tablageneral" style="text-align: left; width: 86%; margin: 0 auto; border: solid 2px transparent">
            <tbody>
              <tr>
                <td style="/*font-weight: bold;*/ font-family: Arial; width: 10% !important; ">
                    <span style="text-transform: uppercase;">Señor(es):</span>
                </td>
                <td style="font-family: Arial; width: 52% !important; ">
                    <span style="margin-left: -5px;"><?php echo $nvchClienteProveedor; ?></span>
                </td>
                <td style="/*font-weight: bold;*/ font-family: Arial; width: 20% !important; ">
                    <span style="text-transform: uppercase;">Forma de Pago:</span> 
                </td>
                <td style="font-family: Arial; width: 15% !important; ">
                    <span style="margin-left: -20px; text-transform: uppercase;"><?php echo $NombrePago; ?></span>
                </td>
              </tr>
              <tr>
                <td style="/*font-weight: bold;*/ font-family: Arial; width: 10% !important; ">
                    <span style="text-transform: uppercase;">RUC / DNI:</span>
                </td>
                <td style="font-family: Arial; width: 52% !important;"> 
                    <span style="margin-left: -5px"><?php echo $nvchDNIRUC; ?></span>
                </td>
                <td style="/*font-weight: bold;*/ font-family: Arial; width: 20% !important; ">
                    <span style="text-transform: uppercase;">Guía de remisión:</span>
                </td>
                <td style="/*font-weight: bold;*/ font-family: Arial; width: 20% !important; ">
                    <span style="margin-left: -20px"></span>
                </td>
              </tr>
              <tr>
                <td style="/*font-weight: bold;*/ font-family: Arial; width: 10% !important; ">
                    <span style="text-transform: uppercase;">Dirección:</span>
                </td>
                <td style="font-family: Arial; width: 52% !important; ">
                    <span style="margin-left: -5px"><?php echo $nvchDireccion; ?></span>
                </td>
                <td style="/*font-weight: bold;*/ font-family: Arial; width: 20% !important; ">
                    <span style="text-transform: uppercase;">Asesor de Ventas:</span> 
                </td>
                <td style="font-family: Arial; width: 15% !important; ">
                    <span style="margin-left: -20px; text-transform: uppercase;"><?php echo $NombreUsuario; ?></span>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
  </div>

  <div class="row">
    <div class="" style="width: 100%; margin-top: 10px; z-index: 10;">
        <table id="tabladetalle" style="width: 86%; z-index: 10; margin: 0 auto; margin-bottom: 10px" cellpadding="" cellspacing="">
          <tbody style="border: solid 1px black;">
          <!--tbody style="border: dashed 1px black;"-->
            <tr id="primerdetalle" style="margin-bottom: 10px">
              <td style="font-family: Arial; text-align: center; width: 13,8% !important; height: 20px !important; border-bottom: solid 1px black; /*border-top: dashed 1px black;*/ border-right: solid 1px black">
                  <small>
                    <small>
                        <span>ITEM</span>
                    </small>
                  </small>
              </td>
              <td style="font-family: Arial; text-align: center; width: 13,8% !important; height: 20px !important; border-bottom: solid 1px black; /*border-top: dashed 1px black*/ border-right: solid 1px black">
                  <small>
                    <small>
                        <span>CÓDIGO</span>
                    </small>
                  </small>
              </td>
              <td style="font-family: Arial; text-align: center; width: 13,8% !important; height: 20px !important; border-bottom: solid 1px black; /*border-top: dashed 1px black*/ border-right: solid 1px black">
                <small>
                    <small>
                        <span>DESCRIPCIÓN</span>
                    </small>
                </small>
              </td>
              <td style="font-family: Arial; text-align: center; width: 13,8% !important; height: 20px !important; border-bottom: solid 1px black; /*border-top: dashed 1px black*/ border-right: solid 1px black">
                <small>
                    <small>
                        <span>CANT.</span>
                  </small>
                </small>
              </td>
              <td style="font-family: Arial; text-align: center; width: 13,8% !important; height: 20px !important; border-bottom: solid 1px black; /*border-top: dashed 1px black*/ border-right: solid 1px black">
                  <small>
                    <small>
                        <span>P. UNIT.</span>
                    </small>
                  </small>
              </td>
              <td style="font-family: Arial; text-align: center; width: 13,8% !important; height: 20px !important; border-bottom: solid 1px black; /*border-top: dashed 1px black*/ border-right: solid 1px black">
                  <small>
                    <small>
                        <span>P. TOTAL</span>
                    </small>
                  </small>
              </td>
            </tr>

            <?php
              $ValorVenta = 0.00;
              $IGVVenta = 0.00;
              $TotalVenta = 0.00;
              $sql_conexion = new Conexion_BD();
              $sql_conectar = $sql_conexion->Conectar();
              $sql_comando;
              if($intIdTipoVenta == 1 || $intIdTipoVenta >=3){
                $sql_comando = $sql_conectar->prepare('CALL MostrarDetalleComprobante(:intIdComprobante)');
                $sql_comando -> execute(array(':intIdComprobante' => $intIdComprobante));
              } else if($intIdTipoVenta == 2){
                $sql_comando = $sql_conectar->prepare('CALL MOSTRARDETALLEComprobanteSERVICIO(:intIdComprobante)');
                $sql_comando -> execute(array(':intIdComprobante' => $intIdComprobante));
              }
              $cantidad = $sql_comando -> rowCount();
              $i = 1;
              while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
              {
                $TotalVenta += $fila['dcmTotal'];
            ?>
            <tr class="segundodetalle" style="text-align: center; border-bottom: 0px solid; padding-top: -10px: ">
              <td style="width: 8% !important; font-size:x-small; padding:0px; border-right: solid 1px">
                <span style="color: black; font-weight: 100">
                  <?php echo $i; ?>
                </span>
              </td>
              <td style="width: 16.67% !important; font-size:x-small; padding:0px; border-right: solid 1px">
                <span style="color: black; font-weight: 100">
                  <?php echo $fila['nvchCodigo']; ?>
                </span>
              </td>
              <td style="width: 50% !important; font-size:x-small; padding:0px; text-align: left !important;  border-right: solid 1px">
                <span style="text-align: left !important; color: black; font-weight: 100; margin-left: 5px; text-transform: uppercase;">
                  <?php 
                      // Original >> str_replace(find,replace,string,count)
                      // echo $fila['nvchDescripcion']; 
                      echo str_replace('- ',' <br> <span>&nbsp;&nbsp;</span> - ', $fila['nvchDescripcion']); 
                  ?>
                </span>
              </td>
              <td style="width: 11% !important; font-size:x-small; padding:0px; border-right: solid 1px">
                <span>
                  <?php if($fila['intCantidad'] < 10) echo "0".$fila['intCantidad']; else echo $fila['intCantidad']; ?>
                </span>
              </td>
              <td style="width: 13.8% !important; font-size:x-small; text-align: right; padding:0px; border-right: solid 1px">
                <span>
                  <?php echo number_format($fila['dcmPrecioUnitario'],2,'.',','); ?>
                </span>
              </td>
              <td style="width: 13.8% !important; font-size:x-small; text-align: right; padding:0px; ">
                <span style="">
                  <?php echo number_format($fila['dcmTotal'],2,'.',','); ?>
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

              <td style="width: 8% !important; font-size:x-small; color:white; border-right: solid 1px black">
                <span>
                  |
                </span>
              </td>
              <td style="width: 16.67% !important; font-size:x-small; color:white; border-right: solid 1px black">
                <span>
                  |
                </span>
              </td>
              <td style="width: 50% !important; max-width: 50% !important; font-size:x-small; text-align: left; padding-left: 7px; padding-right: 0px;word-wrap: break-word; color:white; border-right: solid 1px black">
                <span>
                  |
                </span>
              </td>
              <td style="width: 11% !important; font-size:x-small; color:white; border-right: solid 1px black">
                <span>
                  |
                </span>
              </td>
              <td style="width: 13.8% !important; font-size:x-small; color:white; border-right: solid 1px black">
                <span>
                  |
                </span>
              </td>
              <td style="width: 13.8% !important; font-size:x-small; color:white">
                <span>
                  |
                </span>
              </td>
            </tr>
            <?php
              }
              $ValorVenta = number_format($TotalVenta/1.18,2,'.','');
              $IGVVenta = $TotalVenta - $ValorVenta;
            ?>
          </tbody>
        </table>
    </div>
  </div>

  <!-- table para el footer -->
  <div class="row" style="margin-top: -10px; z-index: 10">
    <table style="text-align: left; width: 86%; margin: 0 auto; /*border: solid 2px;*/ border-collapse: collapse;">
      <!-- INICIO - row VALOR VENTA -->
      <tr>
        <td colspan="" style="border: solid 0px; width: 77% !important">
            <span style="margin-left: 5px">
                <?php 
                    $numero = "1900";
                    //echo convertir_a_letras($numero);
                    //echo 'SON: Ciento cincuenta y nueve mil trescientos cuarenta y cinco soles';
                    //$letras = NumberToLetter::numToLetter(12345.67, 'colones', 'centimos');
                    $english_format_number = number_format($TotalVenta, 2, '.', ''); // dando formato primero

                    //echo 'SON: '.$monto_letras=numletras($english_format_number,4).' SOLES'; // nivoca a la funcion para impresion de letra en numeros

                    echo 'SON: '.$monto_letras=numletras($english_format_number,4).$simboloMoneda; // nivoca a la funcion para impresion de letra en numeros

                ?>  
            </span>
        </td>
        <td style="width: 11.5% !important; font-size:x-small; border: solid 1px;">
          <span style=" padding-right: 0px !important; text-align: right;">
            VALOR DE VENTA
          </span>
        </td>
        <td style="width: 11.5% !important; font-size:x-small; text-align: right; border: solid 1px;">
          <span style=" padding-right: 0px !important; text-align: right;">
            <?php echo $simboloMoneda1.number_format($ValorVenta, 2, '.', ','); ?>
          </span>
        </td>
      </tr>
      <!-- END - row VALOR VENTA -->

      <!-- INICIO - row IGV -->
      <tr>
        <td colspan="" style="border: solid 0px; width: 77% !important"></td>
        <td style="width: 11.5% !important; font-size:x-small; border: solid 1px;">
          <span style=" padding-right: 0px !important; text-align: right;">
            I.G.V.
          </span>
        </td>
        <td style="width: 11.5% !important; font-size:x-small; text-align: right; padding-top: 10px; border: solid 1px;">
          <span style=" padding-right: 0px !important; text-align: right;">
            <?php echo $simboloMoneda1.number_format($IGVVenta, 2, '.', ','); ?>
          </span>
        </td>
      </tr>
      <!-- END - row IGV -->

      <!-- INICIO - row TOTAL -->
      <tr>
        <td colspan="" style="border: solid 0px; width: 77% !important"></td>
        <td style="width: 11.5% !important; font-size:x-small; border: solid 1px">
          <span style=" padding-right: 0px !important; text-align: right;">
              TOTAL
          </span>
        </td>
        <td style="width: 11.5% !important; font-size:x-small; text-align: right; padding-top: 10px; border: solid 1px">
          <span style=" padding-right: 0px !important; text-align: right;">
            <?php 
             echo $simboloMoneda1.number_format($TotalVenta, 2, '.', ','); // formato con dos decimales
            ?>
          </span>
        </td>
      </tr>
      <!-- END - row TOTAL -->
    </table>
  </div>
<br>  

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