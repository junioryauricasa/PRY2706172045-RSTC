<?php
require_once '../../../frameworks/phpword/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;

$intIdCotizacionEquipo = $_GET['intIdCotizacionEquipo'];
require_once '../../conexion/bd_conexion.php';
$sql_conexion = new Conexion_BD();
$sql_conectar = $sql_conexion->Conectar();
$sql_comando = $sql_conectar->prepare('CALL MostrarCotizacionEquipo(:intIdCotizacionEquipo)');
$sql_comando -> execute(array(':intIdCotizacionEquipo' => $intIdCotizacionEquipo));
$fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
$dtmFechaCreacion = $fila['dtmFechaCreacion'];
$nvchDia = date('d', strtotime($dtmFechaCreacion));
$numMes = Round(date('m', strtotime($dtmFechaCreacion)));

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$nvchMes = $meses[$numMes-1];
$nvchAnio = date('Y', strtotime($dtmFechaCreacion));
$nvchClienteProveedor = $fila['nvchClienteProveedor'];
$nvchDNIRUC = $fila['nvchDNIRUC'];
$nvchDireccion = $fila['nvchDireccion'];
$nvchAtencion = $fila['nvchAtencion'];
$nvchGarantia = $fila['nvchGarantia'];
$nvchFormaPago = $fila['nvchFormaPago'];
$nvchLugarEntrega = $fila['nvchLugarEntrega'];
$nvchTiempoEntrega = $fila['nvchTiempoEntrega'];
$nvchDiasValidez = $fila['nvchDiasValidez'];
$dcmPrecioVenta = $fila['dcmPrecioVenta'];

$nvchTelefono = "984312867";
$dcmValorVenta = round($dcmPrecioVenta/1.18,2);
$dcmIGVVenta = $dcmPrecioVenta - $dcmValorVenta;

$nvchWord = $fila['nvchWord'];

$templateWord = new TemplateProcessor('../plantillas/'.$nvchWord.'.docx');

// --- Asignamos valores a la plantilla
$templateWord->setValue('nvchDia',$nvchDia);
$templateWord->setValue('nvchMes',$nvchMes);
$templateWord->setValue('nvchAnio',$nvchAnio);
$templateWord->setValue('nvchDNIRUC',$nvchDNIRUC);
$templateWord->setValue('nvchClienteProveedor',$nvchClienteProveedor);
$templateWord->setValue('nvchDireccion',$nvchDireccion);
$templateWord->setValue('nvchAtencion',$nvchAtencion);
$templateWord->setValue('nvchTelefono',$nvchTelefono);
$templateWord->setValue('dcmValorVenta',$dcmValorVenta);
$templateWord->setValue('dcmIGVVenta',$dcmIGVVenta);
$templateWord->setValue('dcmPrecioVenta',$dcmPrecioVenta);
$templateWord->setValue('nvchGarantia',$nvchGarantia);
$templateWord->setValue('nvchFormaPago',$nvchFormaPago);
$templateWord->setValue('nvchLugarEntrega',$nvchLugarEntrega);
$templateWord->setValue('nvchTiempoEntrega',$nvchTiempoEntrega);
$templateWord->setValue('nvchDiasValidez',$nvchDiasValidez);
$temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');

$templateWord->saveAs($temp_file);
header("Content-Disposition: attachment; filename=documento_120A.docx; charset=iso-8859-1");
echo file_get_contents($temp_file);
unlink($temp_file);    
?>