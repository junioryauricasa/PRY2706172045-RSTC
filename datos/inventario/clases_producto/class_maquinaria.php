<?php
require_once '../conexion/bd_conexion.php';
class Maquinaria
{
  /* FIN - Atributos de Maquinaria */

  /* INICIO - Métodos de Maquinaria */
  public function InsertarMaquinaria($nvchDia,$nvchMes,$nvchAnio,$nvchNombres,$nvchAtencion,$nvchDireccion,$dcmPrecioVenta)
  {
    try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL insertarMaquinaria(@intIdMaquinaria,:nvchDia,:nvchMes,:nvchAnio,:nvchNombres,:nvchAtencion,
                    :nvchDireccion,:dcmPrecioVenta)');
      $sql_comando->execute(array(
        ':nvchDia' => $nvchDia,
        ':nvchMes' => $nvchMes,
        ':nvchAnio' => $nvchAnio,
        ':nvchNombres' => $nvchNombres,
        ':nvchAtencion' => $nvchAtencion,
        ':nvchDireccion' => $nvchDireccion,
        ':dcmPrecioVenta' => $dcmPrecioVenta));
      $sql_comando->closeCursor();
      $salidas = $sql_conectar->query("select @intIdMaquinaria as intIdMaquinaria");
      $salida = $salidas->fetchObject();
      $_SESSION['intIdMaquinaria'] = $salida->intIdMaquinaria;
      $_SESSION['RutaDefaultImg'] = "";
      echo "ok";
    }
    catch(PDPExceptions $e){
      echo $e->getMessage();
    }
  }

  public function ListarMaquinarias($busqueda,$x,$y,$tipolistado)
  {
    try{
      $residuo = 0;
      $cantidad = 0;
      $numpaginas = 0;
      $i = 0;
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      //Busqueda de Maquinaria por el comando LIMIT
      if($tipolistado == "N"){
        $busqueda = "";
        $sql_comando = $sql_conectar->prepare('CALL buscarMaquinaria_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $numpaginas = ceil($cantidad / $y);
        $x = ($numpaginas - 1) * $y;
        $i = 1;
      } else if ($tipolistado == "D"){
        $sql_comando = $sql_conectar->prepare('CALL buscarMaquinaria_ii(:busqueda)');
        $sql_comando -> execute(array(':busqueda' => $busqueda));
        $cantidad = $sql_comando -> rowCount();
        $residuo = $cantidad % $y;
        if($residuo == 0)
        {$x = $x - $y;}
      }
      //Busqueda de Maquinaria por el comando LIMIT
      $sql_comando = $sql_conectar->prepare('CALL buscarMaquinaria(:busqueda,:x,:y)');
      $sql_comando -> execute(array(':busqueda' => $busqueda,':x' => $x,':y' => $y));
      $numpaginas = ceil($cantidad / $y);
      while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
      {
          if($i == ($cantidad - $x) && $tipolistado == "N"){
            echo '<tr bgcolor="#BEE1EB">';
          } else if($fila["intIdMaquinaria"] == $_SESSION['intIdMaquinaria'] && $tipolistado == "E"){
            echo '<tr bgcolor="#B3E4C0">';
          }else {
            echo '<tr>';
          }
          echo 
          '
          <td class="heading" style="" data-th="ID"></td>
          <td align="left" data-th="Código">'.$fila["nvchDia"].'</td>
          <td align="right" data-th="Descripción">'.$fila["nvchMes"].'</td>
          <td align="right"data-th="Tipo de Moneda">'.$fila["nvchAnio"].'</td>
          <td align="right"data-th="Precio de Venta 1">'.$fila["nvchNombres"].'</td>
          <td align="right"data-th="Precio de Venta 1">'.$fila["dcmPrecioVenta"].'</td>
          <td align="right" data-th="Opciones"> 
            <button type="button" id="'.$fila["intIdMaquinaria"].'" class="btn btn-xs btn-danger btn-reporte-maquinaria">
              <i class="fa fa-trash"></i> Reporte
            </button>
          </td>  
          </tr>';
          $i++;
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }  
  }
}