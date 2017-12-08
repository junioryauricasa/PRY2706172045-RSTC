<?php 
	require_once '../../conexion/bd_conexion.php';

	$elemento = $_GET['elemento'];
	$intIdTipoComprobante = $_GET['intIdTipoComprobante'];
	$intIdTipoMoneda = $_GET['intIdTipoMoneda'];
	$intTipoDetalle = $_GET['intTipoDetalle'];
	$dtmFechaInicial = $_GET['dtmFechaInicial'];
	$dtmFechaFinal = $_GET['dtmFechaFinal'];

	$tipo = isset($_REQUEST['t']) ? $_REQUEST['t'] : 'EXCEL';
    $extension = $tipo == 'EXCEL' ? '.xls' : '.doc';
    $NombreArchivo = 'ReporteComprobante_'.$elemento;

    header("Content-type: application/vnd.ms-$tipo");
    header("Content-Disposition: attachment; filename=$NombreArchivo$extension");
    header("Pragma: no-cache");
    header("Expires: 0");
    // end sentencias apra el excel
 	//http://localhost/proyectos/PRY2706172045-RSTC/datos/inventario/clases_producto/reporteexcel.php
    
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL BUSCARCOMPROBANTE_II(:elemento,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal,:intTipoDetalle)');
      $sql_comando -> execute(array(':elemento' => $elemento, ':intIdTipoComprobante' => $intIdTipoComprobante,':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal, ':intTipoDetalle' => $intTipoDetalle));

      echo '
        <h1>Reporte de Comprobante</h1>
        <table>
            <thead>
                <tr>
                    <th style="text-align:left;" style="border: solid 1px black">';?> SERIE <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> NUMERACION <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> TIPO COMPROBANTE <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> PROVEEDOR <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> GENERADO POR <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> FECHA DE CREACION <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> VALOR DE COMPRA <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> IGV <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> COMPRA TOTAL <?php echo '</th>
                </tr>
            </thead>
            <tbody>
      ';

      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
          echo 
          '
		        <tr>
	              	<td style="border: solid 1px black">'.utf8_decode($fila["nvchSerie"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["nvchNumeracion"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["intIdTipoComprobante"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["nvchNombres"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["nvchUsername"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["dtmFechaCreacion"]).'</td>
	                <td style="border: solid 1px black">TIPO COMPROBNTE</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["IGVComprobante"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["TotalComprobante"]).'</td>
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