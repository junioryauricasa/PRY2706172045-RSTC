<?php
require_once '../conexion/bd_conexion.php';
class KardexGeneral
{
  /* INICIO - Métodos de KardexGeneral */
  public function ListarKardexGeneral($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda,$intIdSucursal)
  {
    try{
      /*
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de KardexGeneral por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL BUSCARKardexGeneral_II(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':dtmFechaInicial' => $dtmFechaInicial,
          ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL BUSCARKardexGeneral_II(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
        $sql_comando -> execute(array(':busqueda' => $busqueda, ':dtmFechaInicial' => $dtmFechaInicial,
          ':dtmFechaFinal' => $dtmFechaFinal));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de KardexGeneral por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL BUSCARKardexGeneral(:busqueda,:x,:y,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y, ':dtmFechaInicial' => $dtmFechaInicial,
        ':dtmFechaFinal' => $dtmFechaFinal));
      $numpaginas = ceil($cantidad / $y);*/
      if($intIdTipoMoneda == 1)
          $nvchSimbolo = "S/.";
        else if ($intIdTipoMoneda == 2)
          $nvchSimbolo = "US$";
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda,:TipoBusqueda)');
      $sql_comando -> execute(array(':busqueda' => '', ':TipoBusqueda' => 'C'));
      $j = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
      $sql_conexion_kgp = new Conexion_BD();
      $sql_conectar_kgp = $sql_conexion_kgp->Conectar();
      $sql_comando_kgp = $sql_conectar_kgp->prepare('CALL KardexGeneral(:intIdTipoMoneda,:intIdProducto,
        :intIdSucursal)');
      $sql_comando_kgp -> execute(array(':intIdTipoMoneda' => $intIdTipoMoneda,':intIdProducto' => $fila['intIdProducto'],':intIdSucursal' => $intIdSucursal));
      $fila_kgp = $sql_comando_kgp -> fetch(PDO::FETCH_ASSOC);
        /*
        if($fila['CantidadEntradaTotal'] == "" || $fila['CantidadEntradaTotal'] == null) { $fila['CantidadEntradaTotal'] = 0; }
        if($fila['CantidadSalidaTotal'] == "" || $fila['CantidadSalidaTotal'] == null) { $fila['CantidadSalidaTotal'] = 0; }

        $nvchSimbolo = "";
        $dtmFechaCambio =  date('Y-m-d', strtotime($fila['dtmFechaMovimiento']));
        $sql_conexion_moneda = new Conexion_BD();
        $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
        $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDATRIBUTARIAFECHA(:dtmFechaCambio)');
        $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
        $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
        if($intIdTipoMoneda == 1){
          $nvchSimbolo = "S/.";
          if($fila['intIdTipoMoneda'] != 1) {
            $fila["dcmSaldoValorizado"] = number_format($fila["dcmSaldoValorizado"]*$fila_moneda['dcmCambio2'],2,'.','');
          }
        } 
        else if ($intIdTipoMoneda == 2){
          $nvchSimbolo = "US$";
          if($fila['intIdTipoMoneda'] != 2){
            $fila["dcmSaldoValorizado"] = number_format($fila["dcmSaldoValorizado"]/$fila_moneda['dcmCambio2'],2,'.','');
          }
        }

        if(!is_numeric($fila['dcmSaldoValorizado'])){
          $fila["dcmSaldoValorizado"] = number_format(0.00,2,'.','');
        }
        */
        echo 
        '<tr>
          <td class="heading" data-th="ID" style="width: 25px !important">'.$j.'</td>
          <td style="width: 100px; text-align: center">'.$fila_kgp["FechaMovimiento"].'</td>
          <td style="width: 140px; text-align: center">'.$fila["nvchCodigo"].'</td>
          <td style="width: 450px">'.$fila["nvchDescripcion"].'</td>
          <td style="width: 100px; text-align: center">'.$fila_kgp["Entrada"].'</td>
          <td style="width: 120px; text-align: center">'.$fila_kgp["Salida"].'</td>
          <td style="width: 120px; text-align: center">'.$fila_kgp["Stock"].'</td>
          <td style="width: 120px; text-align: center">'.$nvchSimbolo.' '.$fila_kgp["SaldoValorizado"].'</td> 
        </tr>';
        $j++;
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function TotalKardexValorizado($busqueda,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda)
  {
    try{
      $TotalSaldoValorizado = 0.00;
      $SimboloMoneda = "";
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL BUSCARKardexGeneral_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, 
        ':dtmFechaFinal' => $dtmFechaFinal));
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $dtmFechaCambio =  date('Y-m-d', strtotime($fila['dtmFechaMovimiento']));
        $sql_conexion_moneda = new Conexion_BD();
        $sql_conectar_moneda = $sql_conexion_moneda->Conectar();
        $sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDATRIBUTARIAFECHA(:dtmFechaCambio)');
        $sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
        $fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
        if($intIdTipoMoneda == 1){
          if($fila['intIdTipoMoneda'] != 1) {
            $fila['dcmSaldoValorizado'] = round($fila['dcmSaldoValorizado']*$fila_moneda['dcmCambio2'],2);
          }
        } 
        else if ($intIdTipoMoneda == 2){
          if($fila['intIdTipoMoneda'] != 2){
            $fila['dcmSaldoValorizado'] = round($fila['dcmSaldoValorizado']/$fila_moneda['dcmCambio2'],2);
          }
        }
        $TotalSaldoValorizado += $fila['dcmSaldoValorizado'];
      }
      if($intIdTipoMoneda == 1){
        $SimboloMoneda = "S/.";
      } else if($intIdTipoMoneda == 2){
        $SimboloMoneda = "US$";
      }
      echo $SimboloMoneda.' '.$TotalSaldoValorizado;
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function PaginarKardexGeneral($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal)
  {
    try{
      if($tipolistado == "N")
      { $busqueda = ""; }
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL BUSCARKardexGeneral_ii(:busqueda,:dtmFechaInicial,:dtmFechaFinal)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':dtmFechaInicial' => $dtmFechaInicial, 
        ':dtmFechaFinal' => $dtmFechaFinal));
      $cantidad = $sql_comando -> rowCount();
      $numpaginas = ceil($cantidad / $y);
      if($tipolistado == "N" || $tipolistado == "D")
      { $x = $numpaginas - 1; }
      else if($tipolistado == "E")
      { $x = $x / $y; }
      $output = "";
      for($i = 0; $i < $numpaginas; $i++){
        if($i==0)
        {
          if($x==0)
          {
            $output .= 
            '<li class="page-item disabled">
                <a class="page-link" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          } else {
            $output .= 
            '<li class="page-item">
                <a idp="'.($x-1).'" class="page-link btn-pagina" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
          }
        }

          if($x==$i){
            $output.=  '<li class="page-item active"><a idp="'.$i.'" class="page-link btn-pagina marca">'.($i+1).'</a></li>';
          }
          else
          {
            $output.=  '<li class="page-item"><a idp="'.$i.'" class="page-link btn-pagina">'.($i+1).'</a></li>';
          }

        if($i==($numpaginas-1))
        {
          if($x==($numpaginas-1))
          {
            $output .= 
            '<li class="page-item disabled">
                <a class="page-link" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </li>';
          } else {
            $output .= 
            '<li class="page-item">
                <a idp="'.($x+1).'" class="page-link btn-pagina" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </li>';
          }
        }
      }
      if($output == ""){
        $output .= 
            '<li class="page-item">
                <a class="page-link btn-pagina" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
            </li>';
        $output .= 
            '<li class="page-item">
                <a class="page-link btn-pagina" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </li>';
      }
      echo $output;
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }
  /* FIN - Métodos de KardexGeneral */
}