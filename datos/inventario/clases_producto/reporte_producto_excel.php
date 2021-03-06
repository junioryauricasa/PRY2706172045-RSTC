<?php 
  /** Incluir la libreria PHPExcel */
  require_once '../../conexion/bd_conexion.php';
  require_once '../../../frameworks/PHPExcel-1.8/Classes/PHPExcel.php';

$busqueda = $_GET['busqueda']; // campo de ubsqueda

// Crea un nuevo objeto PHPExcel
$sql_conexion = new Conexion_BD();
$sql_conectar = $sql_conexion->Conectar();
$sql_comando = $sql_conectar->prepare('CALL buscarproducto_II(:busqueda,:TipoBusqueda)');
$sql_comando -> execute(array(':busqueda' => $busqueda, ':TipoBusqueda' => 'C'));

// Establecer propiedades
$i = 4; // contador de la fila desde dende se imprimira
$objPHPExcel = new PHPExcel();

// INICIO - Establecer propiedades de la hoja
////////////////////////////////////////////////////
$objPHPExcel->getProperties()
->setCreator("PLATAFORMA RESTECO")
->setLastModifiedBy("PLATFORM")
->setTitle("REPORTE EXCEL PRODUCTOS")
->setSubject("REPORTE EXCEL PRODUCTOS")
->setDescription("Reporte de Productos en Excel")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Inventario");
// END - Establecer propiedades de la hoja
////////////////////////////////////////////////////

// INICIO - Agregar imagen
////////////////////////////////////////////////////
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('test_img');
$objDrawing->setDescription('test_img');
$objDrawing->setPath('../../imagenes/logoresteco2.png');
$objDrawing->setCoordinates('A1');                      
//setOffsetX works properly
$objDrawing->setOffsetX(5); 
$objDrawing->setOffsetY(5);                
$objDrawing->setWidth(100); // ancho
$objDrawing->setHeight(70); //
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
// END - Agregar imagen
////////////////////////////////////////////////////

$objPHPExcel->getActiveSheet()->getRowDimension('A1')->setRowHeight(150);


// dando altura al fondo de una img
$objPHPExcel->setActiveSheetIndex(0)->getStyle("A1")->getFont()->setSize(26); // tamaño de fuente


$TituloDocumento = 'Reporte de Productos';
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', $TituloDocumento);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("A2")->getFont()->setSize(26); // tamaño de fuente
$objPHPExcel->setActiveSheetIndex(0) ->mergeCells('A2:H2'); //CONBINAR CELDAS
$objPHPExcel->setActiveSheetIndex(0) ->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // alinemaiento Horizontal 
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Alinemiento vertical

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
cellColor('A3:H3', '085c8c'); // Ejecutnado la funcion

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:H3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE); //color de texto

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
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setWidth(18);//ancho de las celda
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(75);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()
->setCellValue('A3', 'ÍTEM')
->setCellValue('B3', 'CÓDIGO')
->setCellValue('C3', 'DESCRIPCIÓN')
->setCellValue('D3', 'MONEDA')
->setCellValue('E3', 'PRECIO VENTA 1')
->setCellValue('F3', 'PRECIO VENTA 2')
->setCellValue('G3', 'PRECIO VENTA 3')
->setCellValue('H3', 'CANTIDAD TOTAL');
$objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($estiloBorderMedium);
// END - dar border phpexcel
$objPHPExcel->setActiveSheetIndex(0) ->getStyle('A3:H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Alienamiento central horizontal encabezado de columnas
$j=1;
while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC)){
  // Agregar Informacion
  $objPHPExcel->setActiveSheetIndex()
  ->setCellValue('A'.$i, $j)
  ->setCellValue('B'.$i, $fila['nvchCodigo'])
  ->setCellValue('C'.$i, $fila['nvchDescripcion'])
  ->setCellValue('D'.$i, $fila['nvchSimbolo'])
  ->setCellValue('E'.$i, number_format($fila['dcmPrecioVenta1'],2,'.',''))
  ->setCellValue('F'.$i, number_format($fila['dcmPrecioVenta2'],2,'.',''))
  ->setCellValue('G'.$i, number_format($fila['dcmPrecioVenta3'],2,'.',''))
  ->setCellValue('H'.$i, $fila['intCantidad']);
  // formato moneda
  $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getNumberFormat()->setFormatCode("#,##0.00");
  $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getNumberFormat()->setFormatCode("#,##0.00");
  $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getNumberFormat()->setFormatCode("#,##0.00");
  //$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->getFont()->setBold(true); //TEXTO DE FILA DE CLEDAS EN NEGRITA
  $i++; $j++;
}

//dando formato a las celdas de resultado en valor moneda
/*$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$i, '=SUM(D2:D'.($i-1).')');$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getNumberFormat()->setFormatCode("#,##0.00");
$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$i, '=SUM(E2:E'.($i-1).')');$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getNumberFormat()->setFormatCode("#,##0.00");
$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$i, '=SUM(F2:F'.($i-1).')');$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getNumberFormat()->setFormatCode("#,##0.00");


// dando color a los resultados de cada columna
cellColor('D'.$i, '085c8c');
cellColor('E'.$i, '085c8c');
cellColor('F'.$i, '085c8c');


$objPHPExcel->setActiveSheetIndex(0)->getStyle('D'.$i.':F'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE); // color al texto */


// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Reporte Producto');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReporteProducto-'.date('d-m-Y_h:i:s').'_'.$busqueda.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>