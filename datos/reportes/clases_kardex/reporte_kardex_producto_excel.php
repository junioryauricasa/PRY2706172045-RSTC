<?php 
  /** Incluir la libreria PHPExcel */
  require_once '../../conexion/bd_conexion.php';
  require_once '../../../frameworks/PHPExcel-1.8/Classes/PHPExcel.php';

$busqueda = $_GET['busqueda'];
$intIdProducto = $_GET['intIdProducto'];
$dtmFechaInicial = str_replace('/', '-', $_GET['dtmFechaInicial']);
$dtmFechaInicial = date('Y-m-d H:i:s', strtotime($dtmFechaInicial));
$dtmFechaFinal = str_replace('/', '-', $_GET['dtmFechaFinal']);
$dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
$intIdTipoMoneda = $_GET['intIdTipoMoneda'];
$intIdSucursal = $_GET['intIdSucursal'];
$sql_conexion = new Conexion_BD();
$sql_conectar = $sql_conexion->Conectar();
$sql_comando = $sql_conectar->prepare('CALL MOSTRARPRODUCTO(:intIdProducto)');
$sql_comando -> execute(array(':intIdProducto' => $intIdProducto));
$fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

$nvchCodigo = $fila['nvchCodigo'];

$sql_conexion = new Conexion_BD();
$sql_conectar = $sql_conexion->Conectar();
$sql_comando = $sql_conectar->prepare('CALL KardexProducto_II(:intIdProducto,:intIdTipoMoneda,:intIdSucursal)');
$sql_comando -> execute(array(':intIdProducto' => $intIdProducto,':intIdTipoMoneda' => $intIdTipoMoneda,':intIdSucursal' => $intIdSucursal));
$j = 1;
if($intIdTipoMoneda == 1)
  $nvchSimbolo = "S/.";
else if($intIdTipoMoneda == 2)
  $nvchSimbolo = "US$";

if($dtmFechaInicial = "1969-12-31 19:00:00")
  $dtmFechaInicial = "-";

// Establecer propiedades
$i = 3; // contador de la fila desde dende se imprimira
$fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
$objPHPExcel = new PHPExcel();

// INICIO - Establecer propiedades de la hoja
////////////////////////////////////////////////////
$objPHPExcel->getProperties()
->setCreator("PLATAFORMA RESTECO")
->setLastModifiedBy("PLATFORM")
->setTitle("REPORTE EXCEL PRODUCTOS")
->setSubject("REPORTE EXCEL PRODUCTOS")
->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Pruebas de Excel");
// END - Establecer propiedades de la hoja
////////////////////////////////////////////////////

// INICIO - Agregar imagen
////////////////////////////////////////////////////
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('test_img');
$objDrawing->setDescription('test_img');
$objDrawing->setPath('../../imagenes/new-microsoft-logo-SIZED-SQUARE-300x297.jpg');
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


$TituloDocumento = 'Reporte Productos';
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', $TituloDocumento);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("A2")->getFont()->setSize(26); // tamaño de fuente
$objPHPExcel->setActiveSheetIndex(0) ->mergeCells('A2:E2'); //CONBINAR CELDAS
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
cellColor('A3:E3', '085c8c'); // Ejecutnado la funcion

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

$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($estiloBorderMedium);
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
  ->setCellValue('C'.$i, round($fila['dcmPrecioVenta1'],2))
  ->setCellValue('D'.$i, round($fila['dcmPrecioVenta2'],2))
  ->setCellValue('E'.$i, round($fila['dcmPrecioVenta3'],2));

  // formato moneda
  $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getNumberFormat()->setFormatCode("#,##0.00");
  $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getNumberFormat()->setFormatCode("#,##0.00");
  $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getNumberFormat()->setFormatCode("#,##0.00");
  
  } 

  //$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->getFont()->setBold(true); //TEXTO DE FILA DE CLEDAS EN NEGRITA
  $objPHPExcel->setActiveSheetIndex(0) ->getStyle('A3:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Alienamiento central horizontal encabezado de columnas
  $i++;
}

//dando formato a las celdas de resultado en valor moneda
$objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$i, '=SUM(C2:C'.($i-1).')');$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getNumberFormat()->setFormatCode("#,##0.00");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$i, '=SUM(D2:D'.($i-1).')');$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getNumberFormat()->setFormatCode("#,##0.00");
$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$i, '=SUM(E2:E'.($i-1).')');$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getNumberFormat()->setFormatCode("#,##0.00");


// dando color a los resultados de cada columna
cellColor('C'.$i, '085c8c');
cellColor('D'.$i, '085c8c');
cellColor('E'.$i, '085c8c');


$objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.$i.':E'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE); // color al texto


// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Tecnologia Simple');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReporteExcel-'.date('dmy_hms').'_'.$busqueda.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>