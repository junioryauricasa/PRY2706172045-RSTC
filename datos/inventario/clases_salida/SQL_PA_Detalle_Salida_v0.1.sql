USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDETALLESALIDA;
DELIMITER $$
	CREATE PROCEDURE INSERTARDETALLESALIDA(
	IN _intIdSalida INT,
    IN _dtmFechaSalida DATETIME,
    IN _intIdProducto INT,
    IN _nvchCodigo VARCHAR(25),
    IN _nvchDescripcion VARCHAR(500),
    IN _dcmPrecioUnitario DECIMAL(11,2),
    IN _intCantidad INT,
    IN _dcmTotal DECIMAL(11,2)
    )
	BEGIN
		INSERT INTO tb_detalle_salida
		(intIdSalida,dtmFechaSalida,intIdProducto,nvchCodigo,nvchDescripcion,dcmPrecioUnitario,intCantidad,dcmTotal)
		VALUES
		(_intIdSalida,_dtmFechaSalida,_intIdProducto,_nvchCodigo,_nvchDescripcion,_dcmPrecioUnitario,_intCantidad,_dcmTotal);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDETALLESALIDA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDETALLESALIDA(
	IN _intIdOperacionSalida INT,
	IN _intIdSalida INT,
    IN _dtmFechaSalida DATETIME,
    IN _intIdProducto INT,
    IN _nvchCodigo VARCHAR(25),
    IN _nvchDescripcion VARCHAR(500),
    IN _dcmPrecioUnitario DECIMAL(11,2),
    IN _intCantidad INT,
    IN _dcmTotal DECIMAL(11,2)
    )
	BEGIN
		UPDATE tb_detalle_salida
		SET
		intIdSalida = _intIdSalida,
		dtmFechaSalida = _dtmFechaSalida,
		intIdProducto = _intIdProducto,
		nvchCodigo = _nvchCodigo,
		nvchDescripcion = _nvchDescripcion,
		dcmPrecioUnitario = _dcmPrecioUnitario,
		intCantidad = _intCantidad,
		dcmTotal = _dcmTotal
		WHERE 
		intIdOperacionSalida = _intIdOperacionSalida;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARDETALLESALIDA;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARDETALLESALIDA(
    	IN _intIdOperacionSalida INT
    )
	BEGIN
		SELECT * FROM tb_detalle_salida
		WHERE 
		intIdOperacionSalida = _intIdOperacionSalida;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDETALLESALIDA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLESALIDA(
    	IN _intIdOperacionSalida INT
    )
	BEGIN
		DELETE FROM tb_detalle_salida
		WHERE 
		intIdOperacionSalida = _intIdOperacionSalida;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDETALLESALIDA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDETALLESALIDA(
    	IN _intIdSalida INT
    )
	BEGIN
		SELECT DS.*, CP.nvchCodigo AS CodigoProducto,TMN.nvchSimbolo
		FROM tb_detalle_salida DS
		LEFT JOIN tb_producto P ON DS.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_salida S ON DS.intIdSalida = S.intIdSalida
		LEFT JOIN tb_tipo_moneda TMN ON S.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE 
		DS.intIdSalida = _intIdSalida AND CP.intIdTipoCodigoProducto = 1;
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