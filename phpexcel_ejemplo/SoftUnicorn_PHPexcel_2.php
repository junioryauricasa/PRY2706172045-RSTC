<?php
error_reporting(E_ALL);
include_once 'Classes/PHPExcel.php';
	////////////////////////CONEXION//////////////////////////////
	///localhost, nombre del servidor<br />
	///root, nombre de la cuenta de usuario<br />
	/// '' contraseña, sino tiene deje vacio
	///BD, nombre de la base de datos
	$conexion = mysql_connect('localhost','root','');
	mysql_select_db('test',$conexion);

	/////////////////////////////////////////////////////////////
	$objXLS = new PHPExcel();
	$objSheet = $objXLS->setActiveSheetIndex(0);
	////////////////////TITULOS///////////////////////////
	$objSheet->setCellValue('A1', 'ID');
	$objSheet->setCellValue('B1', 'Nombre');
	$objSheet->setCellValue('C1', 'Apellido');

	$numero=1;
	$can=mysql_query("SELECT * FROM alumnos");
	while($dato=mysql_fetch_array($can)){
		$numero++;
		$objSheet->setCellValue('A'.$numero, $dato['id']);
		$objSheet->setCellValue('B'.$numero, $dato['Nombre']);
		$objSheet->setCellValue('C'.$numero, $dato['Apellido']);
	}
	
	$objXLS->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
	$objXLS->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
	$objXLS->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
	$objXLS->getActiveSheet()->setTitle('REGIONES');
	$objXLS->setActiveSheetIndex(0);
	$objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5');
	$objWriter->save(__DIR__ . "\Regiones.xls");
	echo 'Archivo Guardado en '.(__DIR__ . "\Regiones.xls");

?>
