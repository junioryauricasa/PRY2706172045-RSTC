USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARSALIDA;
DELIMITER $$
	CREATE PROCEDURE INSERTARSALIDA(
	OUT _intIdSalida INT,
	IN _dtmFechaCreacion DATETIME,
	IN _intIdCliente INT,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(10),
	IN _nvchRazonSocial VARCHAR(150),
	IN _nvchRUC VARCHAR(15),
	IN _nvchAtencion VARCHAR(150),
	IN _nvchDestino VARCHAR(150),
	IN _nvchDireccion VARCHAR(150),
	IN _intTipoPersona INT,
	IN _intIdUsuarioSolicitado INT,
	IN _intIdClienteSolicitado INT,
	IN _intIdUsuario INT,
	IN _intIdSucursal INT,
	IN _intIdTipoMoneda INT,
	IN _bitEstado INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		INSERT INTO tb_salida 
		(dtmFechaCreacion,intIdCliente,nvchSerie,nvchNumeracion,nvchRazonSocial,nvchRUC,nvchAtencion,nvchDestino,nvchDireccion,
		intTipoPersona,intIdUsuarioSolicitado,intIdClienteSolicitado,intIdUsuario,intIdSucursal,intIdTipoMoneda,bitEstado,nvchObservacion)
		VALUES
		(_dtmFechaCreacion,_intIdCliente,_nvchSerie,_nvchNumeracion,_nvchRazonSocial,_nvchRUC,_nvchAtencion,_nvchDestino,_nvchDireccion,
		_intTipoPersona,_intIdUsuarioSolicitado,_intIdClienteSolicitado,_intIdUsuario,_intIdSucursal,_intIdTipoMoneda,_bitEstado,_nvchObservacion);
		SET _intIdSalida = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARSALIDA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARSALIDA(
	IN _intIdSalida INT,
	IN _dtmFechaCreacion DATETIME,
	IN _intIdCliente INT,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(10),
	IN _nvchRazonSocial VARCHAR(150),
	IN _nvchRUC VARCHAR(15),
	IN _nvchAtencion VARCHAR(150),
	IN _nvchDestino VARCHAR(150),
	IN _nvchDireccion VARCHAR(150),
	IN _intTipoPersona INT,
	IN _intIdUsuarioSolicitado INT,
	IN _intIdClienteSolicitado INT,
	IN _intIdUsuario INT,
	IN _intIdSucursal INT,
	IN _bitEstado INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		UPDATE tb_salida
		SET
		dtmFechaCreacion = _dtmFechaCreacion,
		intIdCliente = _intIdCliente,
		nvchSerie = _nvchSerie,
		nvchNumeracion = _nvchNumeracion,
		nvchRazonSocial = _nvchRazonSocial,
		nvchRUC = _nvchRUC,
		nvchAtencion = _nvchAtencion,
		nvchDestino = _nvchDestino,
		nvchDireccion = _nvchDireccion,
		intIdUsuario = _intIdUsuario,
		intIdUsuarioSolicitado = _intIdUsuarioSolicitado,
		intIdClienteSolicitado = _intIdClienteSolicitado,
		intIdSucursal = _intIdSucursal,
		bitEstado = _bitEstado,
		nvchObservacion = _nvchObservacion
		WHERE 
		intIdSalida = _intIdSalida;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARSALIDA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARSALIDA(
    	IN _intIdSalida INT
    )
	BEGIN
		SELECT S.*,
		U.nvchUsername AS NombreUsuario
		FROM tb_salida S
		LEFT JOIN tb_usuario U ON S.intIdUsuario = U.intIdUsuario
		WHERE 
		S.intIdSalida = _intIdSalida;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARSALIDA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARSALIDA(
    	IN _intIdSalida INT
    )
	BEGIN
		DELETE FROM tb_salida
		WHERE 
		intIdSalida = _intIdSalida;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARSALIDA;
DELIMITER $$
	CREATE PROCEDURE LISTARSALIDA(
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT S.*,U.nvchUsername AS NombreUsuario
		FROM tb_salida S
		LEFT JOIN tb_usuario U ON S.intIdUsuario = U.intIdUsuario
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARSALIDA;
DELIMITER $$
	CREATE PROCEDURE BUSCARSALIDA(
    	IN _elemento VARCHAR(600),
		IN _x INT,
		IN _y INT,
		IN _dtmFechaInicial DATETIME,
		IN _dtmFechaFinal DATETIME
    )
	BEGIN
		SELECT S.*,
		CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DS.dcmTotal)/1.18),2) AS ValorSalida,
		SUM(DS.dcmTotal) - ROUND((SUM(DS.dcmTotal)/1.18),2) AS IGVSalida,
		SUM(DS.dcmTotal) AS TotalSalida
		FROM tb_salida S
		LEFT JOIN tb_usuario U ON S.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_detalle_salida DS ON S.intIdSalida = DS.intIdSalida
		LEFT JOIN tb_tipo_moneda TMN ON S.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE 
		(S.nvchSerie LIKE CONCAT(_elemento,'%') OR
		S.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		S.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		S.nvchRUC LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		(S.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY S.intIdSalida
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARSALIDA_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARSALIDA_II(
    	IN _elemento VARCHAR(600),
		IN _dtmFechaInicial DATETIME,
		IN _dtmFechaFinal DATETIME
    )
	BEGIN
		SELECT S.*,
		CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DS.dcmTotal)/1.18),2) AS ValorSalida,
		SUM(DS.dcmTotal) - ROUND((SUM(DS.dcmTotal)/1.18),2) AS IGVSalida,
		SUM(DS.dcmTotal) AS TotalSalida
		FROM tb_salida S
		LEFT JOIN tb_usuario U ON S.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_detalle_salida DS ON S.intIdSalida = DS.intIdSalida
		LEFT JOIN tb_tipo_moneda TMN ON S.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE 
		(S.nvchSerie LIKE CONCAT(_elemento,'%') OR
		S.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		S.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		S.nvchRUC LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		(S.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY S.intIdSalida;
    END 
$$
DELIMITER ;