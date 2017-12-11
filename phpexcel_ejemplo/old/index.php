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
$i = 3;
$fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("PLATAFORMA RESTECO")
->setLastModifiedBy("PLATFORM")
->setTitle("REPORTE EXCEL PRODUCTOS")
->setSubject("REPORTE EXCEL PRODUCTOS")
->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Pruebas de Excel");

$TituloDocumento = 'Reporte Productos';
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $TituloDocumento);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("A1")->getFont()->setSize(26); // tamaño de fuente
$objPHPExcel->setActiveSheetIndex(0) ->mergeCells('A1:E1'); //CONBINAR CELDAS
$objPHPExcel->setActiveSheetIndex(0) ->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // alinemaiento Horizontal 
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Alinemiento vertical
// funcion Background celda
function cellColor($cells,$color){
    global $objPHPExcel;

    $objPHPExcel->setActiveSheetIndex(0)->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
    ));
}
cellColor('A3:E3', 'b2b2b2'); // Ejecutnado la funcion

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:E3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE); //color de texto

// INICIO - dar border phpexcel
$estiloBorderThin = array( 
  'borders' => array(
    'outline' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);
$estiloBorderMedium = array( 
  'borders' => array(
    'outline' => array(
      'style' => PHPExcel_Style_Border::BORDER_MEDIUM
    )
  )
);

$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($estiloBorderThin);
// END - dar border phpexcel




while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC)){
	// Agregar Informacion
	if($i == 3){
		$objPHPExcel->setActiveSheetIndex()->getColumnDimension('A')->setWidth(18);//ancho de las celda
		$objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setWidth(75);
		$objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->setActiveSheetIndex()
		->setCellValue('A3', 'CÓDIGO')
		->setCellValue('B3', 'DESCRIPCIÓN')
		->setCellValue('C3', 'PRECIO VENTA 1')
		->setCellValue('D3', 'PRECIO VENTA 2')
		->setCellValue('E3', 'PRECIO VENTA 3');
		}
	if($i > 3){
	$objPHPExcel->setActiveSheetIndex()
	->setCellValue('A'.$i, $fila['nvchCodigo'])
	->setCellValue('B'.$i, $fila['nvchDescripcion'])
	->setCellValue('C'.$i, $fila['dcmPrecioVenta1'])
	->setCellValue('D'.$i, $fila['dcmPrecioVenta2'])
	->setCellValue('E'.$i, $fila['dcmPrecioVenta3']);
	}	

	$objPHPExcel->setActiveSheetIndex(0) ->getStyle('A3:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Alienamiento central horizontal encabezado de columnas
	$i++;
}

$objPHPExcel->setActiveSheetIndex()
->setCellValue('C'.$i, '=SUM(C2:C'.($i-1).')')
->setCellValue('D'.$i, '=SUM(D2:D'.($i-1).')')
->setCellValue('E'.$i, '=SUM(E2:E'.($i-1).')');


$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->getFont()->setBold(true); //TEXTO DE FILA DE CLEDAS EN NEGRITA

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