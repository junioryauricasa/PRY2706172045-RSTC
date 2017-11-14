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
  <title>SALIDA INTERNA DE REPUESTOS</title>
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
      border-radius: 10px !important
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
<body>
<table style="text-align: left; height: 119px; width: 772px;"
 border="0" cellpadding="1" cellspacing="1">
  <tbody>
    <tr>
      <td style="width: 246px;" rowspan="2">
        <!--img style="width: 224px; height: 57px;" alt="logo_resteco_azul" src="../../imagenes/logo_resteco_azul.png"><br>
        <span id="letterlogan">¡18 Años Liderando el Sector Agrícola!</span-->
        <img style="width: 274px;" alt="logo resteco azul" src="../../imagenes/logoresteco.PNG">
      </td>
      <td style="width: 270px;" rowspan="2"></td>
      <td style="width: 103px;" rowspan="2">
        <img style="width: 111px; height: 85px;" alt="" src="../../imagenes/logo_resteco_cnh.jpg">
      </td>
      <td style="width: 110px;">
        <img style="width: 110px; height: 42px;" alt="logo_resteco_construction" src="../../imagenes/logo_resteco_case_construction.png">
      </td>
    </tr>
    <tr>
      <td style="width: 120px;">
        <img style="width: 129px; height: 48px;" alt="logo_resteco_agriculture" src="../../imagenes/logo_resteco_case_agriculture.png">
      </td>
    </tr>
  </tbody>
</table>

<table id="tablageneral" style="text-align: left; width: 100%;" cellpadding="1" cellspacing="1">
  <tbody>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 60% !important; padding: 10px; text-align: center; padding-bottom: -10px">
        <small>
            <small>
                SALIDA INTERNA DE REPUESTOS
            </small>
        </small>
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 20% !important; padding-left: 5px; border: solid 2px black; text-align: right;">
             Fecha:
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 20% !important; padding-left: 5px; border: solid 2px black">
      </td>
    </tr>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 60% !important; padding: 10px">
        <small>
            <small>
            </small>
        </small>
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 20% !important; padding-left: 5px; border: solid 2px black; text-align: right;">
            N° Documento: 
      </td>
      <td style="font-weight: bold; font-family: Arial; width: 20% !important; padding-left: 5px; border: solid 2px black">
      </td>
    </tr>
  </tbody>
</table>

<br>
<small>
    <small>
        DATOS DEL CLIENTE:
    </small>
</small>
<table id="tablageneral" style="text-align: left; width: 100% !important;" cellpadding="1" cellspacing="1">
  <tbody style="">
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important; padding-left: 5px"><small><small>Cliente</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small>: <?php //echo $; ?></small></small></td>

      <td style="font-weight: bold; font-family: Arial; width: 15% !important"><small><small>N° RUC / DNI</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small>: <?php //echo $; ?></small></small></td>
    </tr>

    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important; padding-left: 5px"><small><small>Atención</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small>: <?php //echo $; ?></small></small></td>

      <td style="font-weight: bold; font-family: Arial; width: 15% !important;"><small><small>Destino</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small><small>: <?php //echo $; ?></small></small></td>
    </tr>

    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important; padding-left: 5px"><small><small>Dirección</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small>: </small></small></td>

      <td style="font-weight: bold; font-family: Arial; width: 15% !important;"><small><small>Vendedor(a)</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small><small>: <?php //echo $; ?></small></small></td>
    </tr>

    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important; padding-left: 5px"><small><small>Solicitado por</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small>: <?php //echo $; ?></small></small></td>

      <td style="font-weight: bold; font-family: Arial; width: 15% !important;"><small><small></small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small><small></small></small></td>
    </tr>

    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 15% !important;padding-left: 5px; padding-bottom: 50px"><small><small>Observación</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%; padding-bottom: 50px"><small><small>: </small></small></td>

      <td style="font-weight: bold; font-family: Arial; width: 15% !important"><small><small></small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 35%;"><small><small></small></small></td>
    </tr>
  </tbody>
</table>

<br>
<table id="tabladetalle" style="text-align: left; width: 100%; height: 100px;" cellpadding="3" cellspacing="1">
  <tbody>
    <tr id="primerdetalle">
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 7% !important;"><small><small>ÍTEM</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 7% !important;"><small><small>CANT.</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 20% !important;"><small><small>CÓDIGO</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 66% !important;"><small><small>DESCRIPCIÓN</small></small></td>
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
      <td style="width: 7% !important; font-size:x-small;"><?php echo $i; ?></td>
      <td style="width: 7% !important; font-size:x-small;"><?php //echo $fila['']; ?></td>
      <td style="width: 20% !important; font-size:x-small;"><?php //echo $fila['']; ?></td>
      <td style="width: 66% !important; font-size:x-small; text-align: left"><?php //echo $fila['']; ?></td>
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
      <td style="width: 7% !important; font-size:x-small;">|</td>
      <td style="width: 7% !important; font-size:x-small;">|</td>
      <td style="width: 20% !important; font-size:x-small;">|</td>
      <td style="width: 66% !important; font-size:x-small;">|</td>
    </tr>
    <?php
      }
      $ValorCotizacion = number_format($TotalCotizacion/1.18,2,'.','');
      $IGVCotizacion = $TotalCotizacion - $ValorCotizacion;
    ?>
    
    <!--tr id="cuartodetalle">
      <td colspan="2" style="font-weight: bold; text-align: right; font-family: Arial; width: 50px;">
        <small><small>IGV 18%</small></small>
      </td-->
      <!--td style="width: 86px; text-align: center;">
        <small><small>
          <?php echo $SimboloMoneda.' '.$IGVCotizacion; ?>    
        </small></small>
      </td>
    </tr-->
    <!--tr id="quintodetalle">
      <td colspan="2" style="font-weight: bold; text-align: right; font-family: Arial; width: 50px;">
        <small><small>TOTAL</small></small>
      </td>
      <td style="width: 86px; text-align: center;">
        <small><small>
          <?php echo $SimboloMoneda.' '.$TotalCotizacion; ?>    
        </small></small>
      </td>
    </tr-->
  </tbody>
</table>
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

<div class="row">
<div class="col-6">
 <table id="tablacontactos" style="width: 100%; padding: 5px; margin-right: 5px">
  <tbody>
    <tr style="font-family: Arial; font-weight: bold;">
      <td style="width: 100% !important; text-align: center !important;" colspan="7">
          <small style="">
            ENTREGADO POR
          </small>
      </td>
      <td style=""></td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important" colspan="3">
        <small>
          <small>
              NOMBRES
          </small>
        </small>
      </td>
      <td style="font-family: Arial; font-weight: bold; width: 70% !important" colspan="3">
        <small>
          <small>
              :           
          </small>
        </small>
      </td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important" colspan="3">
        <small>
          <small>
            DNI
          </small>
        </small>
      </td>
      <td style="font-family: Arial; width: 70% !important">
        <small>
          <small>
             :
          </small>
        </small>
      </td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important; padding-bottom: 40px" colspan="3">
        <small>
            <small>
              FIRMA
            </small>
        </small>
      </td>
      <td style="font-family: Arial; width: 70% !important; padding-bottom: 40px">
        <small>
          <small>
              :
          </small>
        </small>
      </td>
    </tr>
  </tbody>
 </table> 
</div>
<div class="col-6">
<table id="tablacontactos" style="width: 100%; padding: 5px; margin-left: 5px">
  <tbody>
    <tr style="font-family: Arial; font-weight: bold;">
      <td style="width: 100% !important; text-align: center !important;" colspan="7">
          <small style="">
            RECEPCIONADO POR
          </small>
      </td>
      <td style=""></td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important" colspan="3">
        <small>
          <small>
              NOMBRES
          </small>
        </small>
      </td>
      <td style="font-family: Arial; font-weight: bold; width: 70% !important" colspan="3">
        <small>
          <small>
              :           
          </small>
        </small>
      </td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important" colspan="3">
        <small>
          <small>
            DNI
          </small>
        </small>
      </td>
      <td style="font-family: Arial; width: 70% !important">
        <small>
          <small>
             :
          </small>
        </small>
      </td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 30% !important; padding-bottom: 40px" colspan="3">
        <small>
            <small>
              FIRMA
            </small>
        </small>
      </td>
      <td style="font-family: Arial; width: 70% !important; padding-bottom: 40px">
        <small>
          <small>
              :
          </small>
        </small>
      </td>
    </tr>
  </tbody>
</table>  
</div>
</div>

<br>

<div class="centered fixed-bottom">
<table style="width: 100%; "
 border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td style="text-align: center; width: 95px;">
        <img style="width: 100%; " alt="" src="../../imagenes/case-agriculture.PNG">
      </td>
      <td style="text-align: center; width: 95px;">
        <img style="width: 100%; " alt="" src="../../imagenes/logo_resteco_newholland.png">
      </td>
      <td style="text-align: center; width: 95px;">
        <img style="width: 100%; " alt="" src="../../imagenes/logo_resteco_ford.png">
      </td>
      <td style="text-align: center; width: 75px;">
        <img style="width: 100%; " alt="" src="../../imagenes/logo_resteco_massey.png">
      </td>
      <td style="text-align: center; width: 95px;">
        <img style="width: 100%; " alt="" src="../../imagenes/logo_resteco_john.png">
      </td>
      <td style="text-align: center; width: 95px;">
        <img style="width: 100%;" alt="" src="../../imagenes/logo_resteco_lapina.png">
      </td>
      <td style="text-align: center; width: 95px;">
        <img style="width: 100%; " alt="" src="../../imagenes/logo_resteco_jumil.png">
      </td>
    </tr>
    <tr style="width: 100%; text-align: center;  padding-top: 6px !important">
      <td style="text-align: center; width: 95px;">
      </td>
      <td style="text-align: center; width: 95px;">
      </td>
      <td style="text-align: center; width: 95px;">
        <img style="width: 100%;" alt="" src="../../imagenes/bepco-logo.png">
      </td>
      <td style="text-align: center; width: 95px;">
        <img style="width: 100%;" alt="" src="../../imagenes/CARRARO-logo.png">
      </td>
      <td style="text-align: center; width: 40px;">
        <img style="height: 30px" alt="" src="../../imagenes/ZF_Logo.jpg">
      </td>
      <td style="text-align: center; width: 95px;">
      </td>
      <td style="text-align: center; width: 95px;">
      </td>
    </tr>
  </tbody>
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
  $filename = 'SALIDA_INTERNA_DE_REPUESTOS';
  $dompdf = new DOMPDF();
  $html = ob_get_clean();
  pdf_create($html,$filename,'A4','portrait');

?>