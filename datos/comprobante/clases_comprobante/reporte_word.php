 <?php
 /*
require_once '../../../frameworks/phpword/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;*/
/*
require_once '../../conexion/bd_conexion.php';
$ValorVenta = 0.00;
$IGVVenta = 0.00;
$TotalVenta = 0.00;
$sql_conexion = new Conexion_BD();
$sql_conectar = $sql_conexion->Conectar();
$sql_comando = $sql_conectar->prepare('CALL MostrarDetalleComprobante(:intIdComprobante)');
$sql_comando -> execute(array(':intIdComprobante' => 31));
$i = 1;
$templateWord = new TemplateProcessor('factura.docx');
$phpWord = new PhpWord('factura.docx');
$section = $phpword->addSection();
while($fila = $sql_comando -> fetch(PDO::FETCH_ASSOC))
{
  $section ->addText($fila['nvchCodigo'] ."\t". $fila['nvchDescripcion'] ."\t". $fila['dcmPrecio'] ."\t". $fila['dcmTotal']);
}
$temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
$templateWord->saveAs($temp_file);
header("Content-Disposition: attachment; filename=prueba.docx; charset=iso-8859-1");
echo file_get_contents($temp_file);
unlink($temp_file);    
*/
/*
$phpWord = new PhpWord();
$section = $phpWord->addSection();
$event_lists = 'event_lists';
$section->addTextBreak();
header("Content-Disposition: attachment; filename=prueba.docx; charset=iso-8859-1");
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save("php://output");
*/
require_once 'vendor/autoload.php';
\PhpOffice\PhpWord\Autoloader::register();
//$section = $templateWord->addSection();
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$section = $phpWord->addSection();
$section -> addText("ptm");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReporteKardexGeneral.docx"');
header('Cache-Control: max-age=0');
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
ob_clean();
$objWriter->save("php://output");
unlink("php://output");
exit;
?>