USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARCOMPRA;
DELIMITER $$
	CREATE PROCEDURE INSERTARCOMPRA(
	OUT _intIdCompra INT,
	IN _intIdTipoComprobante INT,
	IN _intIdSucursal INT,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(10),
	IN _intIdUsuario INT,
	IN _nvchRUC VARCHAR(15),
	IN _nvchRazonSocial VARCHAR(15),
	IN _dtmFechaCreacion DATETIME,
	IN _intIdTipoMoneda INT,
	IN _intIdTipoPago INT,
	IN _bitEstado INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		INSERT INTO tb_compra 
		(intIdTipoComprobante,intIdSucursal,nvchSerie,nvchNumeracion,intIdUsuario,nvchRUC,nvchRazonSocial,dtmFechaCreacion,
			intIdTipoMoneda,intIdTipoPago,bitEstado,nvchObservacion)
		VALUES
		(_intIdTipoComprobante,_intIdSucursal,_nvchSerie,_nvchNumeracion,_intIdUsuario,_nvchRUC,_nvchRazonSocial,_dtmFechaCreacion,
			_intIdTipoMoneda,_intIdTipoPago,_bitEstado,_nvchObservacion);
		SET _intIdCompra = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARCOMPRA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARCOMPRA(
	IN _intIdCompra INT,
	IN _intIdTipoComprobante INT,
	IN _intIdSucursal INT,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(10),
	IN _intIdUsuario INT,
	IN _nvchRUC VARCHAR(15),
	IN _nvchRazonSocial VARCHAR(15),
	IN _dtmFechaCreacion DATETIME,
	IN _intIdTipoMoneda INT,
	IN _intIdTipoPago INT,
	IN _bitEstado INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		UPDATE tb_compra
		SET
		intIdTipoComprobante = _intIdTipoComprobante,
		intIdSucursal = _intIdSucursal,
		nvchNumeracion = _nvchNumeracion,
		intIdUsuario = _intIdUsuario,
		nvchRUC = _nvchRUC,
		nvchRazonSocial = _nvchRazonSocial,
		dtmFechaCreacion = _dtmFechaCreacion,
		intIdTipoMoneda = _intIdTipoMoneda,
		intIdTipoPago = _intIdTipoPago,
		bitEstado = _bitEstado,
		intIdTipoVenta = _intIdTipoVenta,
		nvchObservacion = _nvchObservacion
		WHERE 
		intIdCompra = _intIdCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARCOMPRA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARCOMPRA(
    	IN _intIdCompra INT
    )
	BEGIN
		SELECT C.*,
		U.nvchUsername AS NombreUsuario,
		TMN.nvchSimbolo AS SimboloMoneda,
		TPG.nvchNombre AS NombrePago
		FROM tb_compra C
		LEFT JOIN tb_usuario U ON C.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_tipo_moneda TMN ON C.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_pago TPG ON C.intIdTipoPago = TPG.intIdTipoPago
		WHERE 
		C.intIdCompra = _intIdCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARCOMPRA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARCOMPRA(
    	IN _intIdCompra INT
    )
	BEGIN
		DELETE FROM tb_compra
		WHERE 
		intIdCompra = _intIdCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARCOMPRA;
DELIMITER $$
	CREATE PROCEDURE LISTARCOMPRA(
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT C.*,U.nvchUsername AS NombreUsuario
		FROM tb_compra C
		LEFT JOIN tb_usuario U ON C.intIdUsuario = U.intIdUsuario
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARCOMPRA;
DELIMITER $$
	CREATE PROCEDURE BUSCARCOMPRA(
    	IN _elemento VARCHAR(600),
		IN _x INT,
		IN _y INT,
		IN _intIdTipoComprobante INT
    )
	BEGIN
		SELECT C.*,U.nvchUsername AS NombreUsuario
		FROM tb_compra C
		LEFT JOIN tb_usuario U ON C.intIdUsuario = U.intIdUsuario
		WHERE 
		(C.nvchSerie LIKE CONCAT(_elemento,'%') OR
		C.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchRUC LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		C.intIdTipoComprobante = _intIdTipoComprobante
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARCOMPRA_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARCOMPRA_II(
    	IN _elemento VARCHAR(600),
    	IN _intIdTipoComprobante INT
    )
	BEGIN
		SELECT C.*,U.nvchUsername AS NombreUsuario
		FROM tb_compra C
		LEFT JOIN tb_usuario U ON C.intIdUsuario = U.intIdUsuario
		WHERE 
		(C.nvchSerie LIKE CONCAT(_elemento,'%') OR
		C.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchRUC LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		C.intIdTipoComprobante = _intIdTipoComprobante;
    END 
$$
DELIMITER ;