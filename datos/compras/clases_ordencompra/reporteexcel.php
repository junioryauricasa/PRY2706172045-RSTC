<?php 
	require_once '../../conexion/bd_conexion.php';
  // ~elemento=busqueda&lista-tipo-moneda=lista_tipo_moneda&dtmFechaInicial=dtmFechaInicial&dtmFechaFinal=dtmFechaFinal;
	
    $elemento = $_GET['elemento'];
  	$lista_tipo_moneda = $_GET['listatipomoneda'];
    $dtmFechaInicial = $_GET['dtmFechaInicial'];
    $dtmFechaFinal = $_GET['dtmFechaFinal'];


    $tipo = isset($_REQUEST['t']) ? $_REQUEST['t'] : 'EXCEL';
    $extension = $tipo == 'EXCEL' ? '.xls' : '.doc';
    $NombreArchivo = 'ReporteOrdenDeCompra_'.$elemento;

    header("Content-type: application/vnd.ms-$tipo");
    header("Content-Disposition: attachment; filename=$NombreArchivo$extension");
    header("Pragma: no-cache");
    header("Expires: 0");
    // end sentencias apra el excel
    
    try{

      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL BUSCARORDENCOMPRA_II(:elemento,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':elemento' => $elemento, ':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal));

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
              $fila['TotalOrdenCompra'] = round($fila['TotalOrdenCompra']*$fila_moneda['dcmCambio2'],2);
              $fila['IGVOrdenCompra'] = round($fila['IGVOrdenCompra']*$fila_moneda['dcmCambio2'],2); 
              $fila['ValorOrdenCompra'] = round($fila['ValorOrdenCompra']*$fila_moneda['dcmCambio2'],2); 
              $fila['SimboloMoneda'] = "S/.";
            }
          } 
          else if ($intIdTipoMoneda == 2){
            if($fila['intIdTipoMoneda'] != 2){
              $fila['TotalOrdenCompra'] = round($fila['TotalOrdenCompra']/$fila_moneda['dcmCambio2'],2);
              $fila['IGVOrdenCompra'] = round($fila['IGVOrdenCompra']/$fila_moneda['dcmCambio2'],2);
              $fila['ValorOrdenCompra'] = round($fila['ValorOrdenCompra']/$fila_moneda['dcmCambio2'],2);
              $fila['SimboloMoneda'] = "US$";
            }
          }

          if($i == ($cantidad - $x) && $tipolistado == "N"){
            echo '<tr bgcolor="#BEE1EB">';
          } else if($fila["intIdOrdenCompra"] == $_SESSION['intIdOrdenCompra'] && $tipolistado == "E"){
            echo '<tr bgcolor="#B3E4C0">';
          }else {
            echo '<tr>';
          }
          echo
          '
              <td style="text-align:left;" style="border: solid 1px black">'.$fila["nvchSerie"].'</td>
              <td style="text-align:left;" style="border: solid 1px black">'.$fila["nvchNumeracion"].'</td>
              <td style="text-align:left;" style="border: solid 1px black">'.$fila["nvchRazonSocial"].'</td>
              <td style="text-align:left;" style="border: solid 1px black">'.$fila["NombreUsuario"].'</td>
              <td style="text-align:left;" style="border: solid 1px black">'.$fila["dtmFechaCreacion"].'</td>
              <td style="text-align:left;" style="border: solid 1px black">'.$fila["SimboloMoneda"].' '.$fila["ValorOrdenCompra"].'</td>
              <td style="text-align:left;" style="border: solid 1px black">'.$fila["SimboloMoneda"].' '.$fila["IGVOrdenCompra"].'</td>
              <td style="text-align:left;" style="border: solid 1px black">'.$fila["SimboloMoneda"].' '.$fila["TotalOrdenCompra"].'</td>
          </tr>';
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