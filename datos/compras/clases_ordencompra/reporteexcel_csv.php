<?php 
  /*
    Descripción: Exporta sin mensaje de alerta pero no logra mandar el formato con estilos para u vizualizzacion
  */

	require_once '../../conexion/bd_conexion.php';
  // ~elemento=busqueda&lista-tipo-moneda=lista_tipo_moneda&dtmFechaInicial=dtmFechaInicial&dtmFechaFinal=dtmFechaFinal;
	
    $elemento = $_GET['elemento'];
  	$intIdTipoMoneda = $_GET['intIdTipoMoneda'];
    $dtmFechaInicial = $_GET['dtmFechaInicial'];
    $dtmFechaFinal = $_GET['dtmFechaFinal'];

    //echo '<br>CALL BUSCARORDENCOMPRA_II('.$elemento.','.$dtmFechaInicial.','.$dtmFechaFinal.')';

    // INICIO - SENTENCIAS PARA EXCEL
    $now = date("d-m-Y_H:i:s");
    $tipo = isset($_REQUEST['t']) ? $_REQUEST['t'] : 'EXCEL';
    $extension = $tipo == 'EXCEL' ? '.xls' : '.doc';
    $NombreArchivo = 'ReporteOrdenDeCompra_'.$elemento;
    header("Content-type: application/vnd.ms-$tipo");
    //header("Content-Disposition: attachment; filename=$NombreArchivo$now$extension"); //exportacion a la antigua
    header("Content-Disposition: attachment; filename=$NombreArchivo$now.csv");
    header("Pragma: no-cache");
    header("Expires: 0");
    // INICIO - SENTENCIAS PARA EXCEL
    
    try{

      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL BUSCARORDENCOMPRA_II(:elemento,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':elemento' => 'resteco', ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));

      /*
      echo '
        <h1>Reporte de Orden de Compra</h1>
        <table>
            <thead>
                <tr>
                    <th style="text-align:left;" style="border: solid 1px black !important">';?> SERIE <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> NUMERACON <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> PROVEEDOR <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> USUARIO <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> FECHA DE CREACION <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> VALOR DE COMPRA <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> IGV <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> TOTAL COMPRA <?php echo '</th>
                </tr>
            </thead>
            <tbody>
      ';
      */

      echo "Reporte de Orden de Compra \n";
      echo "\n";
      echo "SERIE;NUMERACON;PROVEEDOR;USUARIO;FECHA DE CREACION;VALOR DE COMPRA;IGV;TOTAL COMPRA \n";

      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {   
        $dtmFechaCambio =  date('Y-m-d', strtotime($fila['dtmFechaCreacion']));
        $sql_conexion_moneda = new Conexion_BD();
        $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
        $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDACOMERCIALFECHA(:dtmFechaCambio)');
        $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
        $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
        if($intIdTipoMoneda == 1){
          if($fila['intIdTipoMoneda'] != 1) {
            $fila['TotalComprobante'] = round($fila['TotalComprobante']*$fila_moneda['dcmCambio2'],2);
            $fila['IGVComprobante'] = round($fila['IGVComprobante']*$fila_moneda['dcmCambio2'],2); 
            $fila['ValorComprobante'] = round($fila['ValorComprobante']*$fila_moneda['dcmCambio2'],2); 
            $fila['SimboloMoneda'] = "S/.";
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['TotalComprobante'] = round($fila['TotalComprobante']/$fila_moneda['dcmCambio2'],2);
            $fila['IGVComprobante'] = round($fila['IGVComprobante']/$fila_moneda['dcmCambio2'],2);
            $fila['ValorComprobante'] = round($fila['ValorComprobante']/$fila_moneda['dcmCambio2'],2);
            $fila['SimboloMoneda'] = "US$";
          }
        }
        echo 
          '
            <tr>
                  <td style="border: solid 1px black">'.utf8_decode($fila["nvchSerie"]).'</td>
                  <td style="border: solid 1px black">'.utf8_decode($fila["nvchNumeracion"]).'</td>';
              
                  if($fila["intIdTipoComprobante"] == 1){
                    $fila["nvchNombre"] = 'Factura';
                  }else if($fila["intIdTipoComprobante"] == 2){
                    $fila["nvchNombre"] = 'Boleta de Venta';
                  }else if($fila["intIdTipoComprobante"] == 3){
                    $fila["nvchNombre"] = 'Guia de Remision';
                  }else if($fila["intIdTipoComprobante"] == 4){
                    $fila["nvchNombre"] = 'Nota de Credito';
                  }else if($fila["intIdTipoComprobante"] == 5){
                    $fila["nvchNombre"] = 'Factura';
                  }else if($fila["intIdTipoComprobante"] == 6){
                    $fila["nvchNombre"] = 'Boleta de Venta';
                  }else if($fila["intIdTipoComprobante"] == 7){
                    $fila["nvchNombre"] = 'Guia de Remision';
                  }else if($fila["intIdTipoComprobante"] == 8){
                    $fila["nvchNombre"] = 'Nota de Credito';
                  }else if($fila["intIdTipoComprobante"] == 9){
                    $fila["nvchNombre"] = 'Guia Interna de Salida';
                  }else if($fila["intIdTipoComprobante"] == 10){
                    $fila["nvchNombre"] = 'Guia Interna de Entrada';
                  }

                  echo '
                  <td style="border: solid 1px black">'.utf8_decode($fila["nvchNombre"]).'</td>';
                  if($intTipoDetalle == 1)
                    echo '<td style="border: solid 1px black">'.utf8_decode($fila["NombreCliente"]).'</td>';
                  else if($intTipoDetalle == 2)
                    echo '<td style="border: solid 1px black">'.utf8_decode($fila["NombreProveedor"]).'</td>';
                  echo
                  '<td style="border: solid 1px black">'.utf8_decode($fila["NombreUsuario"]).'</td>
                  <td style="border: solid 1px black">'.utf8_decode($fila["dtmFechaCreacion"]).'</td>
                  <td style="border: solid 1px black">'.$fila["SimboloMoneda"].' '.$fila["ValorComprobante"].'</td>
                  <td style="border: solid 1px black">'.$fila["SimboloMoneda"].' '.$fila["IGVComprobante"].'</td>
                  <td style="border: solid 1px black">'.$fila["SimboloMoneda"].' '.$fila["TotalComprobante"].'</td>
            </tr>
          ';
      }

      echo '
            </tbody>
        </table>
      ';
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
?>