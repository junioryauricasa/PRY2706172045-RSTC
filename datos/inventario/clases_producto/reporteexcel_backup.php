<?php 
	require_once '../../conexion/bd_conexion.php';

	$busqueda = $_GET['busqueda'];
	$tipo = isset($_REQUEST['t']) ? $_REQUEST['t'] : 'EXCEL';
    $extension = $tipo == 'EXCEL' ? '.xls' : '.doc';
    $NombreArchivo = 'ReporteProductos_'.$busqueda;

    header("Content-type: application/vnd.ms-$tipo");
    header("Content-Disposition: attachment; filename=$NombreArchivo$extension");
    header("Pragma: no-cache");
    header("Expires: 0");
    // end sentencias apra el excel
 	//http://localhost/proyectos/PRY2706172045-RSTC/datos/inventario/clases_producto/reporteexcel.php
    
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto_II(:busqueda,:TipoBusqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda, ':TipoBusqueda' => 'C'));

      echo '
        <h1>Reporte de Productos - ';?> <?php echo $busqueda; echo '</h1>
        <table>
            <thead>
                <tr>
                    <th style="text-align:left;" style="border: solid 1px black">';?> CODIGO <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> DESCRIPCION <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> SIMBOLO <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> PRECIO DE VENTA 1 <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> PRECIO DE VENTA 2 <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> PRECIO DE VENTA 3 <?php echo '</th>
                    <th style="text-align:left;" style="border: solid 1px black">';?> STOCK <?php echo '</th>
                </tr>
            </thead>
            <tbody>
      ';

      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
          echo 
          '
		        <tr>
	              	<td style="border: solid 1px black">'.utf8_decode($fila["nvchCodigo"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["nvchDescripcion"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["nvchSimbolo"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["dcmPrecioVenta1"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["dcmPrecioVenta2"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["dcmPrecioVenta3"]).'</td>
	                <td style="border: solid 1px black">'.utf8_decode($fila["intCantidad"]).'</td>
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