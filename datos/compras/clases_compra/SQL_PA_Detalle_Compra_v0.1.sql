USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDETALLECOMPRA;
DELIMITER $$
	CREATE PROCEDURE INSERTARDETALLECOMPRA(
	IN _intIdCompra INT,
    IN _dtmFechaCompra DATETIME,
    IN _intIdProducto INT,
    IN _dcmPrecioUnitario DECIMAL(11,2),
    IN _intCantidad INT,
    IN _dcmTotal DECIMAL(11,2)
    )
	BEGIN
		INSERT INTO tb_detalle_compra
		(intIdCompra,dtmFechaCompra,intIdProducto,dcmPrecioUnitario,intCantidad,dcmTotal)
		VALUES
		(_intIdCompra,_dtmFechaCompra,_intIdProducto,_dcmPrecioUnitario,_intCantidad,_dcmTotal);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDETALLECOMPRA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDETALLECOMPRA(
	IN _intIdOperacionCompra INT,
	IN _intIdCompra INT,
    IN _dtmFechaCompra DATETIME,
    IN _intIdProducto INT,
    IN _dcmPrecioUnitario DECIMAL(11,2),
    IN _intCantidad INT,
    IN _dcmTotal DECIMAL(11,2)
    )
	BEGIN
		UPDATE tb_detalle_compra
		SET
		intIdCompra = _intIdCompra,
		dtmFechaCompra = _dtmFechaCompra,
		intIdProducto = _intIdProducto,
		dcmPrecioUnitario = _dcmPrecioUnitario,
		intCantidad = _intCantidad,
		dcmTotal = _dcmTotal
		WHERE 
		intIdOperacionCompra = _intIdOperacionCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARDETALLECOMPRA;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARDETALLECOMPRA(
    	IN _intIdOperacionCompra INT
    )
	BEGIN
		SELECT * FROM tb_detalle_compra
		WHERE 
		intIdOperacionCompra = _intIdOperacionCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDETALLECOMPRA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLECOMPRA(
    	IN _intIdOperacionCompra INT
    )
	BEGIN
		DELETE FROM tb_detalle_compra
		WHERE 
		intIdOperacionCompra = _intIdOperacionCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDETALLECOMPRA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDETALLECOMPRA(
    	IN _intIdCompra INT
    )
	BEGIN
		SELECT DC.*, CP.nvchCodigo, P.nvchDescripcion
		FROM tb_detalle_compra DC
		LEFT JOIN tb_producto P ON DC.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		intIdCompra = _intIdCompra AND CP.intIdTipoCodigoProducto = 1;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS INGRESARCANTIDADPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INGRESARCANTIDADPRODUCTO(
	IN _intIdProducto INT,
	IN _intCantidad INT
    )
	BEGIN
		UPDATE tb_producto
		SET
		intCantidad = _intCantidad
		WHERE 
		intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;