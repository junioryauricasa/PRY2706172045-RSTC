<?php 

  /*
	Autor: junior yauricasa
	Fecha: 02 julio 2017
	Descripcion: 
	1.- Script obtener fecha
  */
  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  $datetimelogin= $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').", ".(date('h')-7).':'.date('i:s').' horas';
  /*
    END script obtener fecha
  */

 ?>