USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARENTRADA;
DELIMITER $$
	CREATE PROCEDURE INSERTARENTRADA(
	OUT _intIdEntrada INT,
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
		INSERT INTO tb_entrada 
		(intIdTipoComprobante,intIdSucursal,nvchSerie,nvchNumeracion,intIdUsuario,nvchRUC,nvchRazonSocial,dtmFechaCreacion,
			intIdTipoMoneda,intIdTipoPago,bitEstado,nvchObservacion)
		VALUES
		(_intIdTipoComprobante,_intIdSucursal,_nvchSerie,_nvchNumeracion,_intIdUsuario,_nvchRUC,_nvchRazonSocial,_dtmFechaCreacion,
			_intIdTipoMoneda,_intIdTipoPago,_bitEstado,_nvchObservacion);
		SET _intIdEntrada = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARENTRADA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARENTRADA(
	IN _intIdEntrada INT,
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
		UPDATE tb_entrada
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
		intIdEntrada = _intIdEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARENTRADA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARENTRADA(
    	IN _intIdEntrada INT
    )
	BEGIN
		SELECT E.*,U.nvchUsername AS NombreUsuario
		FROM tb_entrada E
		LEFT JOIN tb_usuario U ON E.intIdUsuario = U.intIdUsuario
		WHERE 
		E.intIdEntrada = _intIdEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARENTRADA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARENTRADA(
    	IN _intIdEntrada INT
    )
	BEGIN
		DELETE FROM tb_entrada
		WHERE 
		intIdEntrada = _intIdEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARENTRADA;
DELIMITER $$
	CREATE PROCEDURE LISTARENTRADA(
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT E.*,U.nvchUsername AS NombreUsuario
		FROM tb_entrada E
		LEFT JOIN tb_usuario U ON E.intIdUsuario = U.intIdUsuario
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARENTRADA;
DELIMITER $$
	CREATE PROCEDURE BUSCARENTRADA(
    	IN _elemento VARCHAR(600),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT E.*,U.nvchUsername AS NombreUsuario
		FROM tb_entrada E
		LEFT JOIN tb_usuario U ON E.intIdUsuario = U.intIdUsuario
		WHERE 
		E.nvchSerie LIKE CONCAT(_elemento,'%') OR
		E.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		E.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		E.nvchRUC LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARENTRADA_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARENTRADA_II(
    	IN _elemento VARCHAR(600)
    )
	BEGIN
		SELECT E.*,U.nvchUsername AS NombreUsuario
		FROM tb_entrada E
		LEFT JOIN tb_usuario U ON E.intIdUsuario = U.intIdUsuario
		WHERE 
		E.nvchSerie LIKE CONCAT(_elemento,'%') OR
		E.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		E.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		E.nvchRUC LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%');
    END 
$$
DELIMITER ;