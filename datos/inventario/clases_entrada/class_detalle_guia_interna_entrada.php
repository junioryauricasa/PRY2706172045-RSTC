<?php
require_once '../conexion/bd_conexion.php';
class DetalleGuiaInternaEntrada
{
	/* INICIO - Atributos de Guia Interna Entrada */
	private $intIdOperacionGuiaInternaEntrada;
	private $intIdGuiaInternaEntrada;
	private $intIdProducto;
	private $dtmFechaEntrada;
	private $intCantidad;

	public function IdOperacionGuiaInternaEntrada($intIdOperacionGuiaInternaEntrada){ $this->intIdOperacionGuiaInternaEntrada = $intIdOperacionGuiaInternaEntrada; }
	public function IdGuiaInternaEntrada($intIdGuiaInternaEntrada){ $this->intIdGuiaInternaEntrada = $intIdGuiaInternaEntrada; }
	public function IdProducto($intIdProducto){ $this->intIdProducto = $intIdProducto; }
	public function FechaEntrada($dtmFechaEntrada){ $this->dtmFechaEntrada = $dtmFechaEntrada; }
	public function Cantidad($intCantidad){ $this->intCantidad = $intCantidad; }
	/* FIN - Atributos de Guia Interna Entrada */

	/* INICIO - Métodos de Guia Interna Entrada */
	
	/* FIN - Métodos de Guia Interna Entrada */
}
?>