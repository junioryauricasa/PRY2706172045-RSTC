<?php
	class Producto
	{
		private $intIdProducto;
		private $nvchNombre;
		private $dcmPrecio;
		private $intCantidad;
		private $nvchDireccionImg;
		private $nvchDescripcion;
		private $intIdUbigeoProducto;

		public function __GET($k){ return $this->$k; }
		public function __SET($k, $v){ return $this->$k = $v; }
	}
?>