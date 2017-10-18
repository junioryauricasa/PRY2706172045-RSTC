<!-- Informacion incluida en la seccion de cabecera de los reportes -->
<span id="spnFecha">
	Fecha:
	<?php
		/*
		  ------------------------------
		  Autor: Junior Yauricasa
		  Fecha: 13-07-2017
		  Descripcion: 
		    1.- campos requeridos dentro del archivo de reporte fecha y usuario que la genero
		  ------------------------------
		*/
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		 
		echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').", ".(date('h')-7).':'.date('i:s').' horas';
		//Salida: Viernes 24 de Febrero del 2012
	?>
</span>
<br>
<span>Reporte Generado Por: <?php echo $_SESSION['usr_name'];?></span>