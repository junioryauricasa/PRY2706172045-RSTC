<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_resteco";

/*	Para Generar reportes	*/
require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();
use PhpOffice\PhpWord\TemplateProcessor;
$templateWord = new TemplateProcessor('test.docx'); // Formato de donde sacara la plantilla

//$OC_Id = $_GET['OCID'];
$OC_Id = 12;

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
		SELECT OC.*, 
			CASE 
				WHEN P.intIdTipoPersona = 1 THEN P.nvchRazonSocial
				WHEN P.intIdTipoPersona = 2 THEN CONCAT(P.nvchNombres,' ',P.nvchApellidoPaterno,' ',P.nvchApellidoMaterno)
			END AS NombreProveedor,
		U.nvchUsername as NombreUsuario
	    FROM tb_orden_compra OC 
		LEFT JOIN tb_usuario U ON OC.intIdUsuario = U.intUserId
		LEFT JOIN tb_proveedor P ON OC.intIdProveedor = P.intIdProveedor
		WHERE 
		OC.intIdOrdenCompra = ".$OC_Id.";
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {		 
		/* datos proveedor */
		$Fecha = date("d/m/Y", strtotime($row["dtmFechaCreacion"]));
		$NumOrden = $row["intIdOrdenCompra"];
		$RazonSocial = $row["NombreProveedor"];
		$RUC = '10234554657';
		$FrmDePago = 'Efectivo';
		$Moneda = 'Soles';
		$Atencion = 'Juan Mesada Carrillo';
		/* Datos entrega */
		$ANombreDe = 'resta';
		$ConAtencion = 'resta';
		$DireccionEntrega = 'Direcion Entrega';
		$Observacion = 'resta';

		// --- Asignar Variables
		//$templateWord->setValue('VariableEnPlantilla',$variablePHP);
		$templateWord->setValue('Fecha',$Fecha);
		$templateWord->setValue('NumOrden',$NumOrden);
		$templateWord->setValue('RazonSocial',$RazonSocial);
		$templateWord->setValue('RUC',$RUC);
		$templateWord->setValue('FrmDePago',$FrmDePago);
		$templateWord->setValue('Moneda',$Moneda);
		$templateWord->setValue('Atencion',$Atencion);
		/* Datos entrega */
		$templateWord->setValue('ANombreDe',$ANombreDe);
		$templateWord->setValue('ConAtencion',$ConAtencion);
		$templateWord->setValue('DireccionEntrega',$DireccionEntrega);
		$templateWord->setValue('Observacion',$Observacion);		
		/* solicitado por */
		$NombresApellidos = $row["NombreUsuario"];
		$DNI = '75000576';

}
		$sql1="
			SELECT DOC.*,P.nvchNombre,P.nvchDescripcion FROM tb_detalle_orden_compra DOC
			LEFT JOIN tb_producto P ON DOC.intIdProducto = P.intIdProducto
			WHERE 
			intIdOrdenCompra = ".$OC_Id.";
		";
		$result1 = $conn->query($sql1);

		if ($result1->num_rows > 0) {
		    while($row1 = $result1->fetch_assoc()) {	
				/* Listado productos */
				$Item = 1;		//contador de ID
				$Codigo = $row1['intIdProducto'];
				$Descripcion = $row1['nvchDescripcion'];
				$Cant = $row1['intCantidad'];
				$PrcUnit = $row1['dcmPrecio'];
				$Ttl = number_format($Cant*$PrcUnit,2);

				/* Listado productos */
				$templateWord->setValue('Item',$Item);
				$templateWord->setValue('Codigo',$Codigo);
				$templateWord->setValue('Descripcion',$Descripcion);
				$templateWord->setValue('Cant',$Cant);
				$templateWord->setValue('PrcUnit',$PrcUnit);
				$templateWord->setValue('Ttl',$Ttl);
				/* Listado productos */

			}
		}

		/* solicitado por (esto a al footer)*/
		$templateWord->setValue('NombresApellidos',$NombresApellidos);
		$templateWord->setValue('DNI',$DNI);

		// --- Guardamos el documento
		$templateWord->saveAs('OrdenDeCompraGenerado.docx');
		header("Content-Disposition: attachment; filename=OrdenDeCompraGenerado.docx; charset=iso-8859-1");
		echo file_get_contents('OrdenDeCompraGenerado.docx');

    
    echo "";
} else {
	    echo "SIN resultados";
  }
$conn->close();

?>