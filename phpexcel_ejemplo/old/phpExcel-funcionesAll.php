<?php 
//Creating a new PHPExcel Object.
$this->PHPExcel = new PHPExcel();

//Creating a new sheet:
$this->activeSheet = $this->PHPExcel->createSheet();

//Getting the active Sheet:
$this->activeSheet = $this->PHPExcel->getActiveSheet();


//Setting the active sheet:
$this->PHPExcel->setActiveSheetIndex(2);


//Renaming a worksheet:
$this->activeSheet->setTitle($title);


/*

Text can be added to a cell using setCellValue($colRow, $data)
$colRow - The column and row to write to (i.e. 'A2')
$data - The data to write

*/
$this->activeSheet
        ->setCellValue($colRow, $data);       
        
$this->activeSheet
    ->setCellValue("B1", $data) 
    ->setCellValue("B2", $data); 
    ->setCellValue("B5", $data); 


$this->activeSheet->setCellValueByColumnAndRow($column, $row, $data);  

$this->activeSheet->setCellValueExplicit($coord, $value, $dataType);  
$this->activeSheet->setCellValueExplicitByColumnAndRow($col, $row, $value, $dataType); 


/*

Writing from arrays

A 2-dimensional array can be written to the current sheet usng fromArray($twoDimArray)

$twoDimArray - the 2D array to be written
$useWhenNull - what to use if there is a null value
$topLeftCorner - where the top left corner should be.

*/

$this->activeSheet->fromArray($sheet);  
$this->activeSheet->fromArray($sheet, "", $colRow);  

// Or the array can be written manually by looping through the array and calling setCellValue

foreach($rows as $row => $columns) 
{
    foreach($columns as $column => $data) {
        $this->activeSheet->setCellValue($column.$row, $data);
    }
}


/*

Formatting Cells

Setting column width
A single column:

*/


$this->activeSheet
        ->getColumnDimension($colString)
        ->setWidth($width);


/*
	Default width for all columns on a sheet:
*/
$this->activeSheet
    ->getDefaultColumnDimension()
    ->setWidth($width);


/*
	Auto size
*/
$this->activeSheet
    ->getColumnDimension("A")
    ->setAutoSize(true);

/*

	Setting row height
	A single row:

	Default row height for an entire sheet:
*/
$this->activeSheet
    ->getDefaultRowDimension()
    ->setRowHeight($height);

/*

	Styling Cells

*/
    
$this->activeSheet
        ->getStyle("B1")
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        
$styleArray = array(
        'font' => array(
            'bold' => true,
        )
    );
    
$this->activeSheet
        ->getStyle("B1:F1")
        ->applyFromArray(array("font" => array( "bold" => true)));
->getStyle("D1:D20")->getAlignment()->setWrapText(true);

/*
	Setting default styles for the active sheet
*/

$this->activeSheet
        ->getDefaultStyle()
        ->applyFromArray($this->defaultStyle);



/*
	Setting file properties
*/

$this->PHPExcel->getProperties()->setCreator("");
$this->PHPExcel->getProperties()->setLastModifiedBy("");
$this->PHPExcel->getProperties()->setTitle("");
$this->PHPExcel->getProperties()->setSubject("");
$this->PHPExcel->getProperties()->setDescription("..");
$this->PHPExcel->getProperties()->setKeywords("");
$this->PHPExcel->getProperties()->setCategory("");



?>