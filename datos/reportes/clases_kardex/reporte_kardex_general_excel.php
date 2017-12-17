<?php 
  /** Incluir la libreria PHPExcel */
  require_once '../../conexion/bd_conexion.php';
  require_once '../../../frameworks/PHPExcel-1.8/Classes/PHPExcel.php';

$busqueda = $_GET['busqueda'];
$dtmFechaInicial = str_replace('/', '-', $_GET['dtmFechaInicial']);
$dtmFechaInicial = date('Y-m-d H:i:s', strtotime($dtmFechaInicial));
$dtmFechaFinal = str_replace('/', '-', $_GET['dtmFechaFinal']);
$dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));
$intIdTipoMoneda = $_GET['intIdTipoMoneda'];
$intIdSucursal = $_GET['intIdSucursal'];

$sql_conexion = new Conexion_BD();
$sql_conectar = $sql_conexion->Conectar();
$sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda,:TipoBusqueda)');
$sql_comando -> execute(array(':busqueda' => $busqueda,':TipoBusqueda' => 'C'));
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


$TituloDocumento = 'Reporte del Kardex General';
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
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('A')->setWidth(7);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(85);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setWidth(12);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()
->setCellValue('A3', 'ÍTEM')
->setCellValue('B3', 'FECHA')
->setCellValue('C3', 'CÓD. PRODUCTO')
->setCellValue('D3', 'DESCRIPCIÓN')
->setCellValue('E3', 'ENTRADA')
->setCellValue('F3', 'SALIDA')
->setCellValue('G3', 'STOCK')
->setCellValue('H3', 'SALDO VALORIZADO');
$objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($estiloBorderMedium);
// END - dar border phpexcel
$objPHPExcel->setActiveSheetIndex(0) ->getStyle('A3:H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Alienamiento central horizontal encabezado de columnas
$j=1;
while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC)){
  // Agregar Informacion
  $sql_conexion_kgp = new Conexion_BD();
  $sql_conectar_kgp = $sql_conexion_kgp->Conectar();
  $sql_comando_kgp = $sql_conectar_kgp->prepare('CALL KardexGeneral(:intIdTipoMoneda,:intIdProducto,
    :intIdSucursal)');
  $sql_comando_kgp -> execute(array(':intIdTipoMoneda' => $intIdTipoMoneda,':intIdProducto' => $fila['intIdProducto'],':intIdSucursal' => $intIdSucursal));
  $fila_kgp = $sql_comando_kgp -> fetch(PDO::FETCH_ASSOC);
$objPHPExcel->setActiveSheetIndex()
  ->setCellValue('A'.$i, $j)
  ->setCellValue('B'.$i, $fila_kgp['FechaMovimiento'])
  ->setCellValue('C'.$i, $fila['nvchCodigo'])
  ->setCellValue('D'.$i, $fila['nvchDescripcion'])
  ->setCellValue('E'.$i, $fila_kgp['Entrada'])
  ->setCellValue('F'.$i, $fila_kgp['Salida'])
  ->setCellValue('G'.$i, $fila_kgp['Stock'])
  ->setCellValue('H'.$i, round($fila_kgp['SaldoValorizado'],2));
  $objPHPExcel->setActiveSheetIndex(0) ->getStyle('A'.$i.':C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->setActiveSheetIndex(0) ->getStyle('E'.$i.':H'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  // formato moneda
  $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getNumberFormat()->setFormatCode('_("'.$nvchSimbolo.'"* #,##0.00_);_("'.$nvchSimbolo.'"* \(#,##0.00\);_(@_)');
  //$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->getFont()->setBold(true); //TEXTO DE FILA DE CLEDAS EN NEGRITA
  $i++; $j++;
}

//dando formato a las celdas de resultado en valor moneda
$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$i, '=SUM(H4:H'.($i-1).')');$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getNumberFormat()->setFormatCode('_("'.$nvchSimbolo.'"* #,##0.00_);_("'.$nvchSimbolo.'"* \(#,##0.00\);');
cellColor('H'.$i, '085c8c');
// _(@_)
// dando color a los resultados de cada columna



$objPHPExcel->setActiveSheetIndex(0)->getStyle('H'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE); // color al texto


// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Reporte Kardex General');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReporteKardexGeneral-'.date('dmy_hms').'.xlsx');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>