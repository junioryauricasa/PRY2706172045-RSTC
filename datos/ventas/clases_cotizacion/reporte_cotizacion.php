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
  <title>REPORTE COTIZACION REPUESTOS</title>
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
<center><span style="font-weight: bold; font-family: Arial;">COTIZACIÓN DE REPUESTOS Nº RSA-000/2017</span></center>
<br>
<table id="tablageneral" style="text-align: left; width: 700px;" cellpadding="1" cellspacing="1">
  <tbody>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 71px;"><small><small>Señor (es)</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 220px;"><small><?php echo $NombreCliente; ?></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small>Fecha</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 230px;"><small><?php echo $dtmFechaCreacion; ?></small></td>
    </tr>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 71px;"><small><small>DNI o RUC</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 220px;"><small><?php echo $DNICliente; ?></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small>Moneda</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 230px;"><small><?php echo $SimboloMoneda; ?></small></td>
    </tr>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 71px;"><small><small>Dirección</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 220px;"></td>
      <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small>Forma de Pago</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 230px;"><small><?php echo $NombrePago; ?></small></td>
    </tr>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 71px;"><small><small>Atención</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 220px;"><small><?php echo $nvchAtencion; ?></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small>Vendedor</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 230px;"><small><?php echo $NombreUsuario; ?></small></td>
    </tr>
    <tr>
      <td style="font-weight: bold; font-family: Arial; width: 71px;"><small><small>Teléfono</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 220px;"></td>
      <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small>Validéz de Oferta</small></small></td>
      <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="width: 230px;"><small><?php echo $intDiasValidez.' Días'; ?></small></td>
    </tr>
  </tbody>
</table>
<br>
<small><span style="text-align: left; font-weight: bold; font-family: Arial;">Estimado Cliente:</span><br>
<span style="font-family: Arial;">Atendiendo a su solicitud de cotización nos es grato alcanzarle nuestra mejor oferta en los repuestos solicitados, que a continuación detallamos:</span></small>
<br><br>
<table id="tabladetalle" style="text-align: left; width: 683px; height: 130px;" cellpadding="3" cellspacing="1">
  <tbody>
    <tr id="primerdetalle">
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 22px;"><small><small>ÍTEM</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 77px;"><small><small>CÓDIGO</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 179px;"><small><small>DESCRIPCIÓN</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 17px;"><small><small>CANT.</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 76px;"><small><small>P.VTA.</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 50px;"><small><small>Dcto%</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 81px;"><small><small>P.UNIT</small></small></td>
      <td style="font-weight: bold; font-family: Arial; text-align: center; width: 86px;"><small><small>TOTAL</small></small></td>
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
      <td style="width: 22px; font-size:x-small;"><?php echo $i; ?></td>
      <td style="width: 77px; font-size:x-small;"><?php echo $fila['CodigoProducto']; ?></td>
      <td style="width: 179px; font-size:x-small;"><?php echo $fila['DescripcionProducto']; ?></td>
      <td style="width: 17px; font-size:x-small;"><?php echo $fila['intCantidad']; ?></td>
      <td style="width: 76px; font-size:x-small;"><?php echo $SimboloMoneda.' '.$fila['dcmPrecio']; ?></td>
      <td style="width: 50px; font-size:x-small;"><?php echo round($fila['dcmDescuento'],0).'%'; ?></td>
      <td style="width: 81px; font-size:x-small;"><?php echo $SimboloMoneda.' '.$fila['dcmPrecioUnitario']; ?></td>
      <td style="width: 86px; font-size:x-small;"><?php echo $SimboloMoneda.' '.$fila['dcmTotal']; ?></td>
    </tr>
    <?php
        $i++;
      }
      for($j = $i ; $j <= 16; $j++){
        if($j == 16) {
          echo '<tr class="ultimodetalle" style="text-align: center; color:white;">';
        } else {
          echo '<tr class="segundodetalle" style="text-align: center; color:white;">';
        }
    ?>
      <td style="width: 22px; font-size:x-small;">|</td>
      <td style="width: 77px; font-size:x-small;">|</td>
      <td style="width: 179px; font-size:x-small;">|</td>
      <td style="width: 17px; font-size:x-small;">|</td>
      <td style="width: 76px; font-size:x-small;">|</td>
      <td style="width: 50px; font-size:x-small;">|</td>
      <td style="width: 81px; font-size:x-small;">|</td>
      <td style="width: 86px; font-size:x-small;">|</td>
    </tr>
    <?php
      }
      $ValorCotizacion = number_format($TotalCotizacion/1.18,2,'.','');
      $IGVCotizacion = $TotalCotizacion - $ValorCotizacion;
    ?>
    <tr id="tercerdetalle">
      <td id="celdainfo" style="vertical-align: top; width: 179px;" colspan="5" rowspan="3">
        <small>
          <small>
            <span style="font-family: Arial;">
                * La fecha de entrega será de acuerdo a los ítems disponibles en stock, en caso de importación la entrega será en 30 días calendario.
            </span>
          </small>
        </small>
      </td>

      <td class="celdatotales" colspan="2" style="font-weight: bold; text-align: right; font-family: Arial; width: 50px;">
          <small>
            <small>
              TOTAL
            </small>
          </small>
      </td>
      <td class="celdatotales" style="width: 86px; text-align: center;">
          <small><small>
            <?php echo $SimboloMoneda.' '.$TotalCotizacion; ?>       
          </small></small>
      </td>

      <!--td class="celdatotales" colspan="2" style="font-weight: bold; text-align: right; font-family: Arial; width: 50px;">
          <small>
            <small>
              SUBTOTAL
            </small>
          </small>
      </td>
      <td class="celdatotales" style="width: 86px; text-align: center;">
          <small><small>
            <?php echo $SimboloMoneda.' '.$ValorCotizacion; ?>    
          </small></small>
      </td-->
    </tr>
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

<table id="tablacontactos" style="text-align: left; width: 449px; ">
  <tbody>
    <tr style="font-family: Arial; font-weight: bold;">
      <td style="text-align: center; width: 147px;" colspan="7">
        <small><small>REPRESENTACIONES SERVICIOS TÉCNICOS COMERCIALES S.A.</small></small></td>
      </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 111px;" colspan="3">
        <small><small>NROS CTA. CTE. -BCP</small></small></td>
      <td style="font-family: Arial; width: 8px;"></td>
      <td style="font-family: Arial; font-weight: bold; width: 147px;" colspan="3">
        <small><small>NROS DE TELÉFONO</small></small>
      </td>
    </tr>
    <tr>
      <td style="font-family: Arial; width: 72px;"><small><small>Soles</small></small></td>
      <td style="font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="font-family: Arial; width: 111px;"><small><small>355-2161968-0-16</small></small></td>
      <td style="font-family: Arial; width: 8px;"></td>
      <td style="font-family: Arial; width: 108px;"><small><small>Teléfono fijo</small></small></td>
      <td style="font-family: Arial; width: 8px;"><small><small>:</small></small></td>
      <td style="font-family: Arial; width: 147px;"><small><small>064 - 252406</small></small></td>
    </tr>
    <tr>
      <td style="font-family: Arial; width: 72px;"><small><small>Dolares</small></small></td>
      <td style="font-family: Arial; width: 0px;"><small><small>:</small></small></td>
      <td style="font-family: Arial; width: 111px;"><small><small>355-2174158-1-58</small></small></td>
      <td style="font-family: Arial; width: 8px;"><big></big></td>
      <td style="font-family: Arial; width: 108px;"><small><small>Cel.Repuestos</small></small></td>
      <td style="font-family: Arial; width: 8px;"><small><small>:</small></small></td>
      <td style="font-family: Arial; width: 147px;"><small><small>964523815 - #807424</small></small></td>
    </tr>
    <tr>
      <td style="font-family: Arial; font-weight: bold; width: 111px;" colspan="3"><small><small>CORREO ELECTRÓNICO</small></small></td>
      <td style="font-family: Arial; width: 8px;"></td>
      <td style="font-family: Arial; width: 108px;"><small><small>Cel. Servicios</small></small></td>
      <td style="font-family: Arial; width: 8px;"><small><small>:</small></small></td>
      <td style="font-family: Arial; width: 147px;"><small><small>964648504 - #345400</small></small></td>
    </tr>
    <tr>
      <td style="font-family: Arial; width: 111px;" colspan="3"><small><small>resteco_nh@hotmail.com</small></small></td>
      <td style="font-family: Arial; width: 8px;"></td>
      <td style="font-family: Arial; width: 108px;"><small><small>Cel. Maquinarias</small></small></td>
      <td style="font-family: Arial; width: 8px;"><small><small>:</small></small></td>
      <td style="font-family: Arial; width: 147px;"><small><small>942087405 - #070364</small></small></td>
    </tr>
  </tbody>
</table>
<br>
<table style="text-align: left; width: 710px;"
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
    $dompdf->stream($filename.".pdf"); //descargar automaticamente
    //$dompdf->stream($filename.".pdf", array("Attachment" => false)); //previsualizar
  }
  $filename = 'REPORTE_COTIZACION_REPUESTOS';
  $dompdf = new DOMPDF();
  $html = ob_get_clean();
  pdf_create($html,$filename,'A4','portrait');

?>