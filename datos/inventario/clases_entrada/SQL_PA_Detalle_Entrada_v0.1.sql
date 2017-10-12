USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDETALLEENTRADA;
DELIMITER $$
	CREATE PROCEDURE INSERTARDETALLEENTRADA(
	IN _intIdEntrada INT,
    IN _dtmFechaEntrada DATETIME,
    IN _intIdProducto INT,
    IN _nvchCodigo VARCHAR(25),
    IN _nvchDescripcion VARCHAR(500),
    IN _dcmPrecioUnitario DECIMAL(11,2),
    IN _intCantidad INT,
    IN _dcmTotal DECIMAL(11,2)
    )
	BEGIN
		INSERT INTO tb_detalle_entrada
		(intIdEntrada,dtmFechaEntrada,intIdProducto,nvchCodigo,nvchDescripcion,dcmPrecioUnitario,intCantidad,dcmTotal)
		VALUES
		(_intIdEntrada,_dtmFechaEntrada,_intIdProducto,_nvchCodigo,_nvchDescripcion,_dcmPrecioUnitario,_intCantidad
			,_dcmTotal);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDETALLEENTRADA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDETALLEENTRADA(
	IN _intIdOperacionEntrada INT,
	IN _intIdEntrada INT,
    IN _dtmFechaEntrada DATETIME,
    IN _intIdProducto INT,
    IN _nvchCodigo VARCHAR(25),
    IN _nvchDescripcion VARCHAR(500),
    IN _dcmPrecioUnitario DECIMAL(11,2),
    IN _intCantidad INT,
    IN _dcmTotal DECIMAL(11,2)
    )
	BEGIN
		UPDATE tb_detalle_entrada
		SET
		intIdEntrada = _intIdEntrada,
		dtmFechaEntrada = _dtmFechaEntrada,
		intIdProducto = _intIdProducto,
		nvchCodigo = _nvchCodigo,
		nvchDescripcion = _nvchDescripcion,
		dcmPrecioUnitario = _dcmPrecioUnitario,
		intCantidad = _intCantidad,
		dcmTotal = _dcmTotal
		WHERE 
		intIdOperacionEntrada = _intIdOperacionEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARDETALLEENTRADA;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARDETALLEENTRADA(
    	IN _intIdOperacionEntrada INT
    )
	BEGIN
		SELECT * FROM tb_detalle_entrada
		WHERE 
		intIdOperacionEntrada = _intIdOperacionEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDETALLEENTRADA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLEENTRADA(
    	IN _intIdOperacionEntrada INT
    )
	BEGIN
		DELETE FROM tb_detalle_entrada
		WHERE 
		intIdOperacionEntrada = _intIdOperacionEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDETALLEENTRADA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDETALLEENTRADA(
    	IN _intIdEntrada INT
    )
	BEGIN
		SELECT DE.*, CP.nvchCodigo AS CodigoProducto
		FROM tb_detalle_entrada DE
		LEFT JOIN tb_producto P ON DE.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		intIdEntrada = _intIdEntrada AND CP.intIdTipoCodigoProducto = 1;
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