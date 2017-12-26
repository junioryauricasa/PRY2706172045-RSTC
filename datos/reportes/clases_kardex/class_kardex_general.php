<?php
require_once '../conexion/bd_conexion.php';
class KardexGeneral
{
  /* INICIO - Métodos de KardexGeneral */
  public function ListarKardexGeneral($busqueda,$x,$y,$tipolistado,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda,$intIdSucursal)
  {
    try{
      if($intIdTipoMoneda == 1)
          $nvchSimbolo = "S/.";
        else if ($intIdTipoMoneda == 2)
          $nvchSimbolo = "US$";
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto(:busqueda,:x,:y,:TipoBusqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y, ':TipoBusqueda' => 'C'));
      $j = $x + 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $sql_conexion_kgp = new Conexion_BD();
        $sql_conectar_kgp = $sql_conexion_kgp->Conectar();
        $sql_comando_kgp = $sql_conectar_kgp->prepare('CALL KardexGeneral(:intIdTipoMoneda,:intIdProducto,
          :intIdSucursal)');
        $sql_comando_kgp -> execute(array(':intIdTipoMoneda' => $intIdTipoMoneda,':intIdProducto' => $fila['intIdProducto'],':intIdSucursal' => $intIdSucursal));
        $fila_kgp = $sql_comando_kgp -> fetch(PDO::FETCH_ASSOC);
          echo 
          '<tr>
            <td class="heading" data-th="ID" style="width: 25px !important">'.$j.'</td>
            <td style="width: 100px; text-align: center">'.$fila_kgp["FechaMovimiento"].'</td>
            <td style="width: 140px; text-align: center">'.$fila["nvchCodigo"].'</td>
            <td style="width: 450px">'.$fila["nvchDescripcion"].'</td>
            <td style="width: 100px; text-align: center">'.$fila_kgp["Entrada"].'</td>
            <td style="width: 120px; text-align: center">'.$fila_kgp["Salida"].'</td>
            <td style="width: 120px; text-align: center">'.$fila_kgp["Stock"].'</td>
            <td style="width: 120px; text-align: center">'.$nvchSimbolo.' '.number_format($fila_kgp["SaldoValorizado"],2,'.',',').'</td> 
          </tr>';
          $j++;
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }

  public function TotalKardexValorizado($busqueda,$dtmFechaInicial,$dtmFechaFinal,$intIdTipoMoneda,$intIdSucursal)
  {
    try{
      $TotalSaldoValorizado = 0.00;
      if($intIdTipoMoneda == 1)
          $nvchSimbolo = "S/.";
        else if ($intIdTipoMoneda == 2)
          $nvchSimbolo = "US$";
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda,:TipoBusqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda, ':TipoBusqueda' => 'C'));
      $j = 1;
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
        $sql_conexion_kgp = new Conexion_BD();
        $sql_conectar_kgp = $sql_conexion_kgp->Conectar();
        $sql_comando_kgp = $sql_conectar_kgp->prepare('CALL KardexGeneral(:intIdTipoMoneda,:intIdProducto,
          :intIdSucursal)');
        $sql_comando_kgp -> execute(array(':intIdTipoMoneda' => $intIdTipoMoneda,':intIdProducto' => $fila['intIdProducto'],':intIdSucursal' => $intIdSucursal));
        $fila_kgp = $sql_comando_kgp -> fetch(PDO::FETCH_ASSOC);
        $TotalSaldoValorizado += $fila_kgp["SaldoValorizado"];
      }
      echo $nvchSimbolo.' '.number_format($TotalSaldoValorizado,2,'.',',');
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
      $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda,:TipoBusqueda)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':TipoBusqueda' => 'C'));
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