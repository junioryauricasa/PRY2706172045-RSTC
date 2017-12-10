<?php
/** Incluir la libreria PHPExcel */
require_once 'PHPExcel-1.8/Classes/PHPExcel.php';
require_once '../../datos/conexion/bd_conexion.php';
// Crea un nuevo objeto PHPExcel
$sql_conexion = new Conexion_BD();
$sql_conectar = $sql_conexion->Conectar();
$sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda,:TipoBusqueda)');
$sql_comando -> execute(array(':busqueda' => '', ':TipoBusqueda' => 'C'));
$cantidad = $sql_comando -> rowCount();

// Establecer propiedades
$i = 1;
$fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Cattivo")
->setLastModifiedBy("Cattivo")
->setTitle("Documento Excel de Prueba")
->setSubject("Documento Excel de Prueba")
->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Pruebas de Excel");
while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC)){

// Agregar Informacion
if($i == 1){
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('A')->setWidth(18);//ancho de las celda
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setWidth(75);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(20);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(20);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(20);
	$objPHPExcel->setActiveSheetIndex()
	->setCellValue('A1', 'CÓDIGO')
	->setCellValue('B1', 'DESCRIPCIÓN')
	->setCellValue('C1', 'PRECIO VENTA 1')
	->setCellValue('D1', 'PRECIO VENTA 2')
	->setCellValue('E1', 'PRECIO VENTA 3');
	}
if($i > 1){
$objPHPExcel->setActiveSheetIndex()
->setCellValue('A'.$i, $fila['nvchCodigo'])
->setCellValue('B'.$i, $fila['nvchDescripcion'])
->setCellValue('C'.$i, $fila['dcmPrecioVenta1'])
->setCellValue('D'.$i, $fila['dcmPrecioVenta2'])
->setCellValue('E'.$i, $fila['dcmPrecioVenta3']);
}	
 $i++;
}
$objPHPExcel->setActiveSheetIndex()
->setCellValue('C'.$i, '=SUM(C2:C'.($i-1).')')
->setCellValue('D'.$i, '=SUM(D2:D'.($i-1).')')
->setCellValue('E'.$i, '=SUM(E2:E'.($i-1).')');

$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true); //FILA DE CLEDAS EN NEGRITA


// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Tecnologia Simple');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pruebaReal.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>