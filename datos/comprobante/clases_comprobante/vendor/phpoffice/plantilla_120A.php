<?php
require_once dirname(__FILE__).'/phpword/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
/*
$phpWord = new PhpWord();
$section = $phpWord->createSection();   

$section->addImage('resteco.png', array('width'=>210, 'height'=>210, 'align'=>'center'));
*/
$templateWord = new TemplateProcessor('plantilla_120B.docx');
 
$dia = '23';
$mes = "Noviembre";
$anio = "2017";
$nombre_cliente = "DEVHUAYRA S.A.C.";
$atencion_cliente = "Hector Vivanco";
$direccion_cliente = "Calle Real 945";
$telefono_cliente = "984312867";
$valor_venta = "900";
$igv = "162";
$venta_total = "1062";
// --- Asignamos valores a la plantilla
$templateWord->setValue('dia',$dia);
$templateWord->setValue('mes',$mes);
$templateWord->setValue('anio',$anio);
$templateWord->setValue('nombre_cliente',$nombre_cliente);
$templateWord->setValue('atencion_cliente',$atencion_cliente);
$templateWord->setValue('direccion_cliente',$direccion_cliente);
$templateWord->setValue('telefono_cliente',$telefono_cliente);
$templateWord->setValue('valor_venta',$valor_venta);
$templateWord->setValue('igv',$igv);
$templateWord->setValue('venta_total',$venta_total);
$temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
// --- Guardamos el documento
$templateWord->saveAs($temp_file);
header("Content-Disposition: attachment; filename=plantilla_120A.docx; charset=iso-8859-1");
echo file_get_contents($temp_file); // or echo file_get_contents($temp_file);
unlink($temp_file);    
?>