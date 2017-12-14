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
$nvchSimbolo = "S/";
else if($intIdTipoMoneda == 2)
$nvchSimbolo = "$";

if($dtmFechaInicial = "1969-12-31 19:00:00")
$dtmFechaInicial = "-";

// Establecer propiedades
$i = 4; // contador de la fila desde dende se imprimira
$objPHPExcel = new PHPExcel();

// INICIO - Establecer propiedades de la hoja
////////////////////////////////////////////////////
$objPHPExcel->getProperties()
->setCreator("PLATAFORMA RESTECO")
->setLastModifiedBy("PLATFORM")
->setTitle("REPORTE EXCEL KARDEX PRODUCTO")
->setSubject("REPORTE EXCEL KARDEX PRODUCTO")
->setDescription("Reporte de Kardex de Producto.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Módulo Kardex");
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


$TituloDocumento = 'Reporte del Kardex del Producto '.$nvchCodigo;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', $TituloDocumento);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("A2")->getFont()->setSize(26); // tamaño de fuente
$objPHPExcel->setActiveSheetIndex(0) ->mergeCells('A2:N2'); //CONBINAR CELDAS
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
cellColor('A3:N3', '085c8c'); // Ejecutnado la funcion

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:N3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE); //color de texto

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
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('A')->setWidth(7);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(14);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(23);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(8);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setWidth(16);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('H')->setWidth(18);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('I')->setWidth(12);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('M')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('N')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()
->setCellValue('A3', 'ÍTEM')
->setCellValue('B3', 'FECHA')
->setCellValue('C3', 'MOVIMIENTO')
->setCellValue('D3', 'COMPROBANTE')
->setCellValue('E3', 'SERIE')
->setCellValue('F3', 'NUMERACIÓN')
->setCellValue('G3', 'CANT. ENTRADA ')
->setCellValue('H3', 'CANT. SALIDA')
->setCellValue('I3', 'STOCK')
->setCellValue('J3', 'PRECIO ENTRADA')
->setCellValue('K3', 'TOTAL ENTRADA')
->setCellValue('L3', 'PRECIO SALIDA')
->setCellValue('M3', 'TOTAL SALIDA')
->setCellValue('N3', 'SALDO VALORIZADO');
$objPHPExcel->getActiveSheet()->getStyle('A3:N3')->applyFromArray($estiloBorderMedium);
// END - dar border phpexcel
$objPHPExcel->setActiveSheetIndex(0) ->getStyle('A3:N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Alienamiento central horizontal encabezado de columnas
$j=1;
while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC)){
  // Agregar Informacion
  $objPHPExcel->setActiveSheetIndex()
  ->setCellValue('A'.$i, $j)
  ->setCellValue('B'.$i, $fila['FechaMovimiento'])
  ->setCellValue('C'.$i, $fila['TipoMovimiento'])
  ->setCellValue('D'.$i, $fila['TipoComprobante'])
  ->setCellValue('E'.$i, $fila['Serie'])
  ->setCellValue('F'.$i, $fila['Numeracion'])
  ->setCellValue('G'.$i, $fila['Entrada'])
  ->setCellValue('H'.$i, $fila['Salida'])
  ->setCellValue('I'.$i, $fila['Stock'])
  ->setCellValue('J'.$i, round($fila['PrecioEntrada'],2))
  ->setCellValue('K'.$i, round($fila['TotalEntrada'],2))
  ->setCellValue('L'.$i, round($fila['PrecioSalida'],2))
  ->setCellValue('M'.$i, round($fila['TotalSalida'],2))
  ->setCellValue('N'.$i, round($fila['SaldoValorizado'],2));

  // formato moneda
  $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getNumberFormat()->setFormatCode('_("'.$nvchSimbolo.'"* #,##0.00_);_("'.$nvchSimbolo.'"* \(#,##0.00\);_(@_)');
  $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->getNumberFormat()->setFormatCode('_("'.$nvchSimbolo.'"* #,##0.00_);_("'.$nvchSimbolo.'"* \(#,##0.00\);_(@_)');
  $objPHPExcel->getActiveSheet()->getStyle('L'.$i)->getNumberFormat()->setFormatCode('_("'.$nvchSimbolo.'"* #,##0.00_);_("'.$nvchSimbolo.'"* \(#,##0.00\);_(@_)');
  $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->getNumberFormat()->setFormatCode('_("'.$nvchSimbolo.'"* #,##0.00_);_("'.$nvchSimbolo.'"* \(#,##0.00\);_(@_)');
  $objPHPExcel->getActiveSheet()->getStyle('N'.$i)->getNumberFormat()->setFormatCode('_("'.$nvchSimbolo.'"* #,##0.00_);_("'.$nvchSimbolo.'"* \(#,##0.00\);_(@_)');
  //$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->getFont()->setBold(true); //TEXTO DE FILA DE CLEDAS EN NEGRITA
  $i++; $j++;
}

//dando formato a las celdas de resultado en valor moneda
$objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$i, '=SUM(N4:N'.($i-1).')');$objPHPExcel->getActiveSheet()->getStyle('N'.$i)->getNumberFormat()->setFormatCode('_("'.$nvchSimbolo.'"* #,##0.00_);_("'.$nvchSimbolo.'"* \(#,##0.00\);_(@_)');

// dando color a los resultados de cada columna
cellColor('N'.$i, '085c8c');


$objPHPExcel->setActiveSheetIndex(0)->getStyle('N'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE); // color al texto


// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Reporte Kardex Producto '.$nvchCodigo);

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReporteKardexProducto-'.date('dmy_hms').'_'.$nvchCodigo.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>