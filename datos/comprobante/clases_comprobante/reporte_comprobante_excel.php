<?php 
/** Incluir la libreria PHPExcel */
require_once '../../conexion/bd_conexion.php';
require_once '../../../frameworks/PHPExcel-1.8/Classes/PHPExcel.php';

$busqueda = $_GET['busqueda'];
$intIdTipoComprobante = $_GET['intIdTipoComprobante'];
$intIdTipoMoneda = $_GET['intIdTipoMoneda'];
$intTipoDetalle = $_GET['intTipoDetalle'];
$dtmFechaInicial = $_GET['dtmFechaInicial'];
$dtmFechaFinal = $_GET['dtmFechaFinal'];

$lblPersonaSingular = $_GET['lblPersonaSingular'];
$lblTituloSingular = $_GET['lblTituloSingular'];
$lblTituloPlural = $_GET['lblTituloPlural'];

$dtmFechaInicial = str_replace('/', '-', $dtmFechaInicial);
$dtmFechaInicial = date('Y-m-d', strtotime($dtmFechaInicial));
$dtmFechaFinal = str_replace('/', '-', $dtmFechaFinal);
$dtmFechaFinal = date('Y-m-d H:i:s', strtotime($dtmFechaFinal." 23:59:59"));

$nvchSimbolo = "";

if($intIdTipoMoneda == 1)
  $nvchSimbolo = "S/";
else
  $nvchSimbolo = "$";

// Crea un nuevo objeto PHPExcel
$sql_conexion = new Conexion_BD();
$sql_conectar = $sql_conexion->Conectar();
$sql_comando = $sql_conectar->prepare('CALL BUSCARCOMPROBANTE_II(:busqueda,:intIdTipoComprobante,:dtmFechaInicial,:dtmFechaFinal,:intTipoDetalle)');
$sql_comando -> execute(array(':busqueda' => $busqueda, ':intIdTipoComprobante' => $intIdTipoComprobante,':dtmFechaInicial' => $dtmFechaInicial, ':dtmFechaFinal' => $dtmFechaFinal, ':intTipoDetalle' => $intTipoDetalle));

// Establecer propiedades
$i = 4; // contador de la fila desde dende se imprimira
$objPHPExcel = new PHPExcel();

// INICIO - Establecer propiedades de la hoja
////////////////////////////////////////////////////
$objPHPExcel->getProperties()
->setCreator("PLATAFORMA RESTECO")
->setLastModifiedBy("PLATFORM")
->setTitle("REPORTE EXCEL ".strtoupper($lblTituloPlural))
->setSubject("REPORTE EXCEL ".strtoupper($lblTituloPlural))
->setDescription("Reporte de ".$lblTituloPlural." en Excel")
->setKeywords("Excel Office 2007 openxml php")
->setCategory($lblTituloPlural);
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


$TituloDocumento = 'Reporte de '.$lblTituloPlural;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', $TituloDocumento);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("A2")->getFont()->setSize(26); // tamaño de fuente
$objPHPExcel->setActiveSheetIndex(0) ->mergeCells('A2:J2'); //CONBINAR CELDAS
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
cellColor('A3:J3', '085c8c'); // Ejecutnado la funcion

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:J3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE); //color de texto

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
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('A')->setWidth(8);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setWidth(10);//ancho de las celda
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(14);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(25);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(40);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setWidth(32);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->setActiveSheetIndex()
->setCellValue('A3', 'ÍTEM')
->setCellValue('B3', 'SERIE')
->setCellValue('C3', 'NUMERACIÓN')
->setCellValue('D3', 'TIPO. DE COMPROB.')
->setCellValue('E3', 'NOMBRE DEL '.strtoupper($lblPersonaSingular))
->setCellValue('F3', 'GENERADO POR')
->setCellValue('G3', 'FECHA')
->setCellValue('H3', 'VALOR DE '.strtoupper($lblTituloSingular))
->setCellValue('I3', 'IGV')
->setCellValue('J3', strtoupper($lblTituloSingular).' TOTAL');
$objPHPExcel->getActiveSheet()->getStyle('A3:J3')->applyFromArray($estiloBorderMedium);
// END - dar border phpexcel
$objPHPExcel->setActiveSheetIndex(0) ->getStyle('A3:H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Alienamiento central horizontal encabezado de columnas
$j=1;
while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC)){
$ClienteProveedor;
$ValorComprobante; $IGVComprobante; $TotalComprobante;
$dtmFechaCambio =  date('Y-m-d', strtotime($fila['dtmFechaCreacion']));
$sql_conexion_moneda = new Conexion_BD();
$sql_conectar_moneda = $sql_conexion_moneda->Conectar();
$sql_comando_moneda = $sql_conectar_moneda->prepare('CALL MOSTRARMONEDACOMERCIALFECHA(:dtmFechaCambio)');
$sql_comando_moneda -> execute(array(':dtmFechaCambio' => $dtmFechaCambio));
$fila_moneda = $sql_comando_moneda -> fetch(PDO::FETCH_ASSOC);
if($intIdTipoMoneda == 1){
  if($fila['intIdTipoMoneda'] != 1) {
    $fila['TotalComprobante'] = number_format($fila['TotalComprobante']*$fila_moneda['dcmCambio2'],2,'.','');
    $fila['IGVComprobante'] = number_format($fila['IGVComprobante']*$fila_moneda['dcmCambio2'],2,'.',''); 
    $fila['ValorComprobante'] = number_format($fila['ValorComprobante']*$fila_moneda['dcmCambio2'],2,'.',''); 
    $fila['SimboloMoneda'] = "S/.";
  }
} 
else if ($intIdTipoMoneda == 2){
  if($fila['intIdTipoMoneda'] != 2){
    $fila['TotalComprobante'] = number_format($fila['TotalComprobante']/$fila_moneda['dcmCambio2'],2,'.','');
    $fila['IGVComprobante'] = number_format($fila['IGVComprobante']/$fila_moneda['dcmCambio2'],2,'.','');
    $fila['ValorComprobante'] = number_format($fila['ValorComprobante']/$fila_moneda['dcmCambio2'],2,'.','');
    $fila['SimboloMoneda'] = "US$";
  }
}
if($intTipoDetalle == 1)
  $ClienteProveedor = $fila["NombreCliente"];
else if($intTipoDetalle == 2)
  $ClienteProveedor = $fila["NombreProveedor"];
if($fila['intIdTipoComprobante'] != 3 && $fila['intIdTipoComprobante'] != 7){
  $ValorComprobante = $fila["SimboloMoneda"].' '.number_format($fila["ValorComprobante"],2,'.',',');
  $IGVComprobante = $fila["SimboloMoneda"].' '.number_format($fila["IGVComprobante"],2,'.',',');
  $TotalComprobante = $fila["SimboloMoneda"].' '.number_format($fila["TotalComprobante"],2,'.',',');
}
else {
  $ValorComprobante = "-";
  $IGVComprobante = "-";
  $TotalComprobante = "-";
}
  // Agregar Informacion
  $objPHPExcel->setActiveSheetIndex()
  ->setCellValue('A'.$i, $j)
  ->setCellValue('B'.$i, $fila['nvchSerie'])
  ->setCellValue('C'.$i, $fila['nvchNumeracion'])
  ->setCellValue('D'.$i, $fila['NombreComprobante'])
  ->setCellValue('E'.$i, $ClienteProveedor)
  ->setCellValue('F'.$i, $fila['NombreUsuario'])
  ->setCellValue('G'.$i, date('d/m/Y H:i:s', strtotime($fila['dtmFechaCreacion'])))
  ->setCellValue('H'.$i, number_format($fila["ValorComprobante"],2,'.',''))
  ->setCellValue('I'.$i, number_format($fila["IGVComprobante"],2,'.',''))
  ->setCellValue('J'.$i, number_format($fila["TotalComprobante"],2,'.',''));
  $objPHPExcel->setActiveSheetIndex(0) ->getStyle('A'.$i.':C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  // formato moneda
  $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getNumberFormat()->setFormatCode('_("'.$nvchSimbolo.'"* #,##0.00_);_("'.$nvchSimbolo.'"* \(#,##0.00\);_(@_)');
  $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getNumberFormat()->setFormatCode('_("'.$nvchSimbolo.'"* #,##0.00_);_("'.$nvchSimbolo.'"* \(#,##0.00\);_(@_)');
  $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getNumberFormat()->setFormatCode('_("'.$nvchSimbolo.'"* #,##0.00_);_("'.$nvchSimbolo.'"* \(#,##0.00\);_(@_)');
  //$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->getFont()->setBold(true); //TEXTO DE FILA DE CLEDAS EN NEGRITA
  $i++; $j++;
}
$objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$i, '=SUM(J4:J'.($i-1).')');$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getNumberFormat()->setFormatCode('_("'.$nvchSimbolo.'"* #,##0.00_);_("'.$nvchSimbolo.'"* \(#,##0.00\);');
cellColor('J'.$i, '085c8c');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('J'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
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
$objPHPExcel->getActiveSheet()->setTitle('Reporte '.$lblTituloSingular);

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte'.$lblTituloSingular.'-'.date('d-m-Y_h:i:s').'_'.$busqueda.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>