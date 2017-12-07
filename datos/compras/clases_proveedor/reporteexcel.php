<?php 
	require_once '../../conexion/bd_conexion.php';

	$elemento = $_GET['elemento'];
	$TipoPersona = $_GET['TipoPersona'];

	$tipo = isset($_REQUEST['t']) ? $_REQUEST['t'] : 'EXCEL';
    $extension = $tipo == 'EXCEL' ? '.xls' : '.doc';
    $NombreArchivo = 'ReporteProveedor_'.$elemento;

    header("Content-type: application/vnd.ms-$tipo");
    header("Content-Disposition: attachment; filename=$NombreArchivo$extension");
    header("Pragma: no-cache");
    header("Expires: 0");
    // end sentencias apra el excel
 	//http://localhost/proyectos/PRY2706172045-RSTC/datos/inventario/clases_producto/reporteexcel.php
    
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL BUSCARPROVEEDOR_II(:elemento,:TipoPersona)');
      $sql_comando -> execute(array(':elemento' => $elemento, ':TipoPersona' => $TipoPersona));

      echo '
        <h1>Reporte de Proveedores</h1>
        <table>
            <thead>
                <tr>
                    <th style="text-align:left;" style="border: solid 1px black">';?> CODIGO <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> DNI <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> RUC <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> RAZON SOCIAL <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> AP. PATERNO <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> AP. MATERNO <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> NOMBRES <?php echo '</th>
                </tr>
            </thead>
            <tbody>
      ';

      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
          echo 
          '
		        <tr>
	              	<td style="border: solid 1px black">'.utf8_decode($fila["intIdProveedor"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["nvchDNI"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["nvchRUC"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["nvchRazonSocial"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["nvchApellidoPaterno"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["nvchApellidoMaterno"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["nvchNombres"]).'</td>
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