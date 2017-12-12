<?php
  	$objPHPExcel->getActiveSheet()->toArray();
	
	// Cambiar el nombre de la hoja de trabajo
	$objPHPExcel->getActiveSheet()->setTitle('Datatypes');  
	// Establezca el índice de hoja activa en la primera hoja, de modo que Excel lo abra como la primera hoja
	$objPHPExcel->setActiveSheetIndex(0);

	$objPHPExcel->getActiveSheet()->setShowGridLines(false);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

/*
	Rangos con nombre
*/

// Definir rangos con nombre
$objPHPExcel->addNamedRange( new PHPExcel_NamedRange('PersonName', $objPHPExcel->getActiveSheet(), 'B1') );
// Renombrar rangos con nombre
$objPHPExcel->getNamedRange('PersonName')->setName('PersonFN');
// Agregue algunos datos a la hoja
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Firstname:')
                              ->setCellValue('B1', '=PersonFN');
// Rango de resolución
$objPHPExcel->getActiveSheet()->getCell('B1')->getCalculatedValue()l

/*
	Rangos con nombre
*/

// Definir rangos con nombre
$objPHPExcel->addNamedRange( new PHPExcel_NamedRange('PersonName', $objPHPExcel->getActiveSheet(), 'B1') );
// Renombrar rangos con nombre
$objPHPExcel->getNamedRange('PersonName')->setName('PersonFN');
// Agregue algunos datos a la hoja
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Firstname:')
                              ->setCellValue('B1', '=PersonFN');
// Rango de resolución
$objPHPExcel->getActiveSheet()->getCell('B1')->getCalculatedValue()l


/*

	Date/Time

	PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2 //2012-12-18
	PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME4 //3:06:11
	PHPExcel_Style_NumberFormat::FORMAT_DATE_DATETIME //18/12/12 3:06

*/  

$dateTimeNow = time();

$sheet = $objPHPExcel->getActiveSheet();
$sheet->setCellValue('A1', PHPExcel_Shared_Date::PHPToExcel( $dateTimeNow ));

$sheet->getStyle('A1')
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);  //2012-12-18


/*

	iterador

*/ 

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("05featuredemo.xlsx");

echo date('H:i:s') , " Iterate worksheets" , EOL;
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
	echo 'Worksheet - ' , $worksheet->getTitle() , EOL;

	foreach ($worksheet->getRowIterator() as $row) {
		echo '    Row number - ' , $row->getRowIndex() , EOL;

		$cellIterator = $row->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
		foreach ($cellIterator as $cell) {
			if (!is_null($cell)) {
				echo '        Cell - ' , $cell->getCoordinate() , ' - ' , $cell->getCalculatedValue() , EOL;
			}
		}
	}
}


/*
	Doc Properties
	Propiedades principales:
*/

$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Tasses.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
							 
$objPHPExcel->getProperties()->getCreator()
$objPHPExcel->getProperties()->getCreated()
$objPHPExcel->getProperties()->getLastModifiedBy()
$objPHPExcel->getProperties()->getModified()
$objPHPExcel->getProperties()->getTitle()
$objPHPExcel->getProperties()->getSubject()
$objPHPExcel->getProperties()->getDescription()
$objPHPExcel->getProperties()->getKeywords()



/*

	Propiedades extendidas (de aplicación)

*/

$objPHPExcel->getProperties()->getCategory()
$objPHPExcel->getProperties()->getCompany()
$objPHPExcel->getProperties()->getManager()

/*

	Propiedades personalizadas

*/

$customProperties = $objPHPExcel->getProperties()->getCustomProperties();
foreach($customProperties as $customProperty) {
	$propertyValue = $objPHPExcel->getProperties()->getCustomPropertyValue($customProperty);
	$propertyType = $objPHPExcel->getProperties()->getCustomPropertyType($customProperty);
	
	echo '    ' , $customProperty , ' - (' , $propertyType , ') - ';
	if ($propertyType == PHPExcel_DocumentProperties::PROPERTY_TYPE_DATE) {
		echo date('d-M-Y H:i:s',$propertyValue) , EOL;
	} elseif ($propertyType == PHPExcel_DocumentProperties::PROPERTY_TYPE_BOOLEAN) {
		echo (($propertyValue) ? 'TRUE' : 'FALSE') , EOL;
	} else {
		echo $propertyValue , EOL;
	}
}

# Leyendo archivos

	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	$objPHPExcel = $objReader->load("templates/template_1.xlsx");

	$data = array(array('title' => 'Excel for dummies', 'price'=> 17.99, 'quantity'	=> 2),
				  array('title' => 'PHP for dummies', 'price'=> 15.99, 'quantity' => 1),
				  array('title' => 'Inside OOP', 'price'=> 12.95, 'quantity' => 1));

	$baseRow = 4;
	foreach($data as $r => $dataRow) {
		$row = $baseRow + $r;
		$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
	
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $r+1)
		                              ->setCellValue('B'.$row, $dataRow['title'])
		                              ->setCellValue('C'.$row, $dataRow['price'])
		                              ->setCellValue('D'.$row, $dataRow['quantity'])
		                              ->setCellValue('E'.$row, '=C'.$row.'*D'.$row);
	}
	$objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);


/*

	PHPExcel: Estilos
	Establecer fuente predeterminada
*/

$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);


/*
	Establecer Fuente
*/

$sheet->getStyle('B1')->getFont()->setName('Candara');
$sheet->getStyle('B1')->getFont()->setSize(20);
$sheet->getStyle('B1')->getFont()->setBold(true);
$sheet->getStyle('B1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$sheet->getStyle('D1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$sheet->getStyle('D13')->getFont()->setBold(true);


/*
	Establecer alineaciones
*/

$sheet->getStyle('D11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$sheet->getStyle('A18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
$sheet->getStyle('A18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('B5')->getAlignment()->setShrinkToFit(true);

/*
	Agregar texto enriquecido
*/

$objRichText = new PHPExcel_RichText();
$objRichText->createText('This invoice is ');

$objPayable = $objRichText->createTextRun('payable within thirty days after the end of the month');
$objPayable->getFont()->setBold(true);
$objPayable->getFont()->setItalic(true);
$objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_DARKGREEN ) );

$objRichText->createText(', unless specified otherwise on the invoice.');
$objPHPExcel->getActiveSheet()->getCell('A18')->setValue($objRichText);


/*
	Comentarios
*/

$sheet->getComment('E13')->setAuthor('PHPExcel');
$objCommentRichText = $sheet->getComment('E13')->getText()->createTextRun('PHPExcel:');
$objCommentRichText->getFont()->setBold(true);
$sheet->getComment('E13')->getText()->createTextRun("\r\n");
$sheet->getComment('E13')->getText()->createTextRun('some text....');
$sheet->getComment('E13')->setWidth('100pt');
$sheet->getComment('E13')->setHeight('100pt');
$sheet->getComment('E13')->setMarginLeft('150pt');
$sheet->getComment('E13')->getFillColor()->setRGB('EEEEEE');


/*
	Estilos compartidos
*/

$sharedStyle = new PHPExcel_Style();
$sharedStyle1->applyFromArray(
  array('fill'  => array(
  	                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color'	=> array('argb' => 'FFCCFFCC')
                  ),
        'borders' => array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
                    )
    ));
    
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle, "A1:T100");



/*
	Estilo duplicado
*/
$style = new PHPExcel_Style();
$style->getFont()->setSize(20);
$coord = PHPExcel_Cell::stringFromColumnIndex($col) . $row;
$worksheet->setCellValue($coord, $str);


// Copia el estilo a esa celda
$worksheet->duplicateStyle($style, $coord);

/*
	Fusionar y separar celdas
*/
$objPHPExcel->getActiveSheet()->mergeCells('A28:B28');      
$objPHPExcel->getActiveSheet()->unmergeCells('A28:B28');


/*
	Agregar hipervinculo a la hoja
*/
$objPHPExcel->getActiveSheet()->setCellValue('E26', 'www.phpexcel.net');
$objPHPExcel->getActiveSheet()->getCell('E26')->getHyperlink()->setUrl('http://www.phpexcel.net');
$objPHPExcel->getActiveSheet()->getCell('E26')->getHyperlink()->setTooltip('Navigate to website');
$objPHPExcel->getActiveSheet()->getStyle('E26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

/*
	insertar y eliminar filas y columnas
*/
$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

/*
	inserting and removing rows and columns
*/
$objPHPExcel->getActiveSheet()->insertNewRowBefore(6, 10);
$objPHPExcel->getActiveSheet()->removeRow(6, 10);
$objPHPExcel->getActiveSheet()->insertNewColumnBefore('E', 5);
$objPHPExcel->getActiveSheet()->removeColumn('E', 5);

/*
	Establecer la orientación y el tamaño de la página
*/
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);