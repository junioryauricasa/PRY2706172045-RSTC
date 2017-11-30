<?php
  session_start();
  require_once '../../conexion/bd_conexion.php';

  $year = date('Y') ;

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

  $nvchDNIRUC = $fila['nvchDNIRUC'];
  $nvchClienteProveedor = $fila['nvchClienteProveedor'];
  $nvchDireccion = $fila['nvchDireccion'];

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
    tr>td{
      padding: 0px;
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

    @page { 
      margin: 100px 30px 60px 30px; 
    }
    header { 
      position: fixed; 
      top: -100px; 
      left: 0px; 
      right: 0px; 
      /*background-color: gray; */
      height: 100px; 
    }
    div.content{
      margin-top: 60px;
      margin-bottom: 100px
    }
    footer { 
      position: fixed; 
      bottom: -60px; 
      left: 0px; 
      right: 0px; 
      /*background-color: black;*/ 
      height: 60px; 
    }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
  </style>
  
</head>
<body>
    
    <!-- INICIO header pdf -->
    <header class="" id="header" style="">
      <img style="width: 100%;" alt="logo resteco azul" src="../../imagenes/header-comprobantes.PNG">
    </header>
    <!-- END header pdf -->
    
    <div class="content" style="padding-top: -65px">
        <center>
            <span style="font-weight: bold; font-family: Arial;">
              COTIZACIÓN DE REPUESTOS Nº RSA-<?php echo $nvchSerie.'-'.$nvchNumeracion; ?>/<?php echo $year; ?>
            </span>
        </center>

        <table id="tablageneral" style="text-align: left; width: 100%;" cellpadding="1" cellspacing="1">
          <tbody style="padding: 5px">
            <tr>
              <td style="font-weight: bold; font-family: Arial; width: 71px;"><small><small style="padding-left: 3px">Señor (es)</small></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
              <td style="width: 220px;"><small style="padding-left: 5px"><?php echo $nvchClienteProveedor; ?></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small style="padding-left: 3px">Fecha</small></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
              <td style="width: 230px;"><small style="padding-left: 5px"><?php echo $dtmFechaCreacion; ?></small></td>
            </tr>
            <tr>
              <td style="font-weight: bold; font-family: Arial; width: 71px;"><small><small style="padding-left: 3px">DNI o RUC</small></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
              <td style="width: 220px;"><small><?php echo $nvchDNIRUC; ?></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small style="padding-left: 3px">Moneda</small></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
              <td style="width: 230px;"><small><?php echo $SimboloMoneda; ?></small></td>
            </tr>
            <tr>
              <td style="font-weight: bold; font-family: Arial; width: 71px;"><small><small style="padding-left: 3px">Dirección</small></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
              <td style="width: 220px; font-size:xx-small;"><?php echo $nvchDireccion; ?></td>
              <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small style="padding-left: 3px">Forma de Pago</small></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
              <td style="width: 230px;"><small><?php echo $NombrePago; ?></small></td>
            </tr>
            <tr>
              <td style="font-weight: bold; font-family: Arial; width: 71px;"><small><small style="padding-left: 3px">Atención</small></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
              <td style="width: 220px;"><small><?php echo $nvchAtencion; ?></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small style="padding-left: 3px">Validéz de Oferta</small></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
              <td style="width: 230px;"><small><?php echo $intDiasValidez.' Días'; ?></small></td>
            </tr>
            <tr>
              <td style="font-weight: bold; font-family: Arial; width: 71px;"><small><small style="padding-left: 3px">Teléfono</small></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
              <td style="width: 220px;"></td>
              <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small style="padding-left: 3px">Asesor de Ventas</small></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
              <td style="width: 230px;"><small><?php echo $NombreUsuario; ?></small></td>
            </tr>
            <tr>
              <td style="font-weight: bold; font-family: Arial; width: 71px;"><small><small style="padding-left: 3px">E-mail:</small></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small>:</small></small></td>
              <td style="width: 220px;"></td>
              <td style="font-weight: bold; font-family: Arial; width: 120px;"><small><small></small></small></td>
              <td style="font-weight: bold; font-family: Arial; width: 0px;"><small><small></small></small></td>
              <td style="width: 230px;"><small><?php //echo $; ?></small></td>
            </tr>
          </tbody>
        </table>

        <!--small><span style="text-align: left; font-weight: bold; font-family: Arial;">Estimado Cliente:</span><br-->
        <span style="font-family: Arial; font-size: 14px">Atendiendo a su solicitud de cotización nos es grato alcanzarle nuestra mejor oferta en los repuestos solicitados, que a continuación detallamos:</span></small>

        <br>

        <table id="tabladetalle" style="text-align: left; width: 100%; height: 130px;" cellpadding="3" cellspacing="1">
          <tbody style="font-size: 14px !important">
            <tr id="primerdetalle">
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 22px;"><small><small>ÍTEM</small></small></td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 77px;"><small><small>CÓDIGO</small></small></td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 179px;"><small><small>DESCRIPCIÓN</small></small></td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 17px;"><small><small>CANT.</small></small></td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 76px;"><small><small>P.VTA.</small></small></td>
              <td style="font-weight: bold; font-family: Arial; text-align: center; width: 50px;"><small><small>DCTO%</small></small></td>
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
            <tr class="segundodetalle" style="/*text-align: center*/; border-bottom: 0px solid">
              <td style="width: 22px; font-size:x-small; text-align: center"><?php echo $i; ?></td>
              <td style="width: 77px; font-size:x-small; text-align: center"><?php echo $fila['CodigoProducto']; ?></td>
              <td style="width: 179px; font-size:x-small; text-align: left"><span style="padding-left: 5px"><?php echo $fila['DescripcionProducto']; ?></span></td>
              <td style="width: 17px; font-size:x-small; text-align: center"><?php echo $fila['intCantidad']; ?></td>
              <td style="width: 76px; font-size:x-small;"><span style="padding-left: 3px"><?php echo $SimboloMoneda.' '.$fila['dcmPrecio']; ?></span></td>
              <td style="width: 50px; font-size:x-small; text-align: center"><?php echo round($fila['dcmDescuento'],0).'%'; ?></td>
              <td style="width: 81px; font-size:x-small;"><span style="padding-left: 3px"><?php echo $SimboloMoneda.' '.$fila['dcmPrecioUnitario']; ?></span></td>
              <td style="width: 86px; font-size:x-small;"><span style="padding-left: 3px; padding-left: 3px"><?php echo $SimboloMoneda.' '.$fila['dcmTotal']; ?></span></td>
            </tr>
            <?php
                $i++;
              }
              for($j = $i ; $j <= 22; $j++){
                if($j == 22) {
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
            </tr>
          </tbody>
        </table>

        <br>

        <!-- INICIO - Tabla de informacion de contacto -->
        <table id="tablacontactos" style="text-align: left; width: 100%; ">
          <tbody>
            <tr>
              <td style="font-family: Arial; font-weight: bold; width: 111px;" colspan="3">
                <small><small>NUMEROS DE CTA CTE – BCP:</small></small>
              </td>
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
              <td style="font-family: Arial; width: 147px;"><small><small>#964523815</small></small></td>
            </tr>
            <tr>
              <td style="font-family: Arial; font-weight: bold; width: 111px;" colspan="3"><small><small>CORREO ELECTRÓNICO</small></small></td>
              <td style="font-family: Arial; width: 8px;"></td>
              <td style="font-family: Arial; font-weight: bold; width: 147px;"><small><small>DIRECCION:</small></small></td>
              <td style="font-family: Arial; width: 8px;"><small><small></small></small></td>
              <td style="font-family: Arial; width: 147px;"><small><small></small></small></td>
            </tr>
            <tr>
              <td style="font-family: Arial; width: 111px;" colspan="3"><small><small>ventas.repuestos@resteco.com.pe</small></small></td>
              <td style="font-family: Arial; width: 8px;"></td>
              <td style="font-family: Arial; width: 108px;"><small><small>Av. Mariscal Castilla N° 2775 El</small></small></td>
              <td style="font-family: Arial; width: 8px;"><small><small> Tambo – </small></small></td>
              <td style="font-family: Arial; width: 147px;"><small><small>Huancayo</small></small></td>
            </tr>
            <tr>
              <td style="font-family: Arial; font-weight: bold; width: 111px;" colspan="3"><small><small>PAGINA WEB</small></small></td>
              <td style="font-family: Arial; width: 8px;"></td>
              <td style="font-family: Arial; font-weight: bold; width: 147px;"><small><small></small></small></td>
              <td style="font-family: Arial; width: 8px;"><small><small></small></small></td>
              <td style="font-family: Arial; width: 147px;"><small><small></small></small></td>
            </tr>
            <tr>
              <td style="font-family: Arial; width: 111px;" colspan="3"><small><small>www.resteco.com.pe</small></small></td>
              <td style="font-family: Arial; width: 8px;"></td>
              <td style="font-family: Arial; width: 108px;"><small><small></small></small></td>
              <td style="font-family: Arial; width: 8px;"><small><small></small></small></td>
              <td style="font-family: Arial; width: 147px;"><small><small></small></small></td>
            </tr>

          </tbody>
        </table>
        <!-- INICIO - Tabla de informacion de contacto -->

    </div>

    <footer>
      <img style="width: 100%; " alt="" src="../../imagenes/footer-comprobantes.PNG">
      <!--img style="height: 40px " alt="" src="../../imagenes/footer-comprobantes.PNG"-->

      <!-- INICIO - Paginador footer -->
      <span style="background-color: gray">
          <script type='text/php'>
            if ( isset($pdf) ) { 
              $font = Font_Metrics::get_font('helvetica', 'normal');
              $size = 9;
              $y = $pdf->get_height() - 24;
              $x = $pdf->get_width() - 15 - Font_Metrics::get_text_width('1/1', $font, $size);
              $pdf->page_text($x, $y, '{PAGE_NUM}/{PAGE_COUNT}', $font, $size);
            } 
          </script>
      </span>
      <!--script type='text/php'>
        if ( isset($pdf) ) { 
          $font = Font_Metrics::get_font('helvetica', 'normal');
          $size = 9;
          $y = $pdf->get_height() - 24;
          $x = $pdf->get_width() - 30 - Font_Metrics::get_text_width('1/1', $font, $size);
          $pdf->page_text($x, $y, 'pag {PAGE_NUM}/{PAGE_COUNT}', $font, $size);
        } 
      </script-->
      <!-- END - paginador footer -->

    </footer>

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
    $dompdf->stream($filename.".pdf", array("Attachment" => false)); //descargar automaticamente
    //$dompdf->stream($filename.".pdf", array("Attachment" => false)); //previsualizar
  }
  $filename = 'Reporte_Cotizacion_Repuesto';
  $dompdf = new DOMPDF();
  $html = ob_get_clean();
  pdf_create($html,$filename,'A4','portrait');
?>