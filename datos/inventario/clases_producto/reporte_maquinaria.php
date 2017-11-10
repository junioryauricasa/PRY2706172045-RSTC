<?php
require_once '../../../frameworks/phpword/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;

$templateWord = new TemplateProcessor('plantilla_120B.docx');

$intIdMaquinaria = $_GET['intIdMaquinaria'];
require_once '../../conexion/bd_conexion.php';
$sql_conexion = new Conexion_BD();
$sql_conectar = $sql_conexion->Conectar();
$sql_comando = $sql_conectar->prepare('CALL MostrarMaquinaria(:intIdMaquinaria)');
$sql_comando -> execute(array(':intIdMaquinaria' => $intIdMaquinaria));
$fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);

$dia = $fila['nvchDia'];
$mes = $fila['nvchMes'];
$anio = $fila['nvchAnio'];
$nombre_cliente = $fila['nvchNombres'];
$atencion_cliente = $fila['nvchAtencion'];
$direccion_cliente = $fila['nvchDireccion'];
$telefono_cliente = "984312867";
$venta_total = $fila['dcmPrecioVenta'];
$valor_venta = round($fila['dcmPrecioVenta']/1.18,2);
$igv = $venta_total - $valor_venta;

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

$templateWord->saveAs($temp_file);
header("Content-Disposition: attachment; filename=documento_120A.docx; charset=iso-8859-1");
echo file_get_contents($temp_file);
unlink($temp_file);    
?>