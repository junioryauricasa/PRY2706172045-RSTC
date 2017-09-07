USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE INSERTARCOTIZACION(
	OUT _intIdCotizacion INT,
	IN _nvchNumeracion VARCHAR(10),
	IN _intIdUsuario INT,
	IN _intIdCliente INT,
	IN _dtmFechaCreacion DATETIME
    )
	BEGIN
		INSERT INTO tb_cotizacion 
		(intIdUsuario,nvchNumeracion,intIdCliente,dtmFechaCreacion)
		VALUES
		(_intIdUsuario,_nvchNumeracion,_intIdCliente,_dtmFechaCreacion);
		SET _intIdCotizacion = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARCOTIZACION(
	IN _intIdCotizacion INT,
	IN _nvchNumeracion VARCHAR(10),
	IN _intIdUsuario INT,
	IN _intIdCliente INT,
	IN _dtmFechaCreacion DATETIME
    )
	BEGIN
		UPDATE tb_cotizacion
		SET
		nvchNumeracion = _nvchNumeracion,
		intIdUsuario = _intIdUsuario,
		intIdCliente = _intIdCliente,
		dtmFechaCreacion = _dtmFechaCreacion
		WHERE 
		intIdCotizacion = _intIdCotizacion;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE MOSTRARCOTIZACION(
    	IN _intIdCotizacion INT
    )
	BEGIN
		SELECT CT.*, 
			CASE 
				WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
				WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
			END AS NombreCliente,
		U.nvchUsername as NombreUsuario
	    FROM tb_cotizacion CT 
		LEFT JOIN tb_usuario U ON CT.intIdUsuario = U.intUserId
		LEFT JOIN tb_cliente C ON CT.intIdCliente = C.intIdCliente
		WHERE 
		CT.intIdCotizacion = _intIdCotizacion;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE ELIMINARCOTIZACION(
    	IN _intIdCotizacion INT
    )
	BEGIN
		DELETE FROM tb_cotizacion
		WHERE 
		intIdCotizacion = _intIdCotizacion;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE LISTARCOTIZACION(
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT CT.*,U.nvchUsername as NombreUsuario, 
			CASE 
				WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
				WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
			END AS NombreCliente FROM tb_cotizacion CT 
		LEFT JOIN tb_usuario U ON CT.intIdUsuario = U.intUserId
		LEFT JOIN tb_cliente C ON CT.intIdCliente = C.intIdCliente
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE TODOCOTIZACION()
	BEGIN
		SELECT * FROM tb_cotizacion;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE BUSCARCOTIZACION(
    	IN _elemento VARCHAR(250),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT CT.*,U.nvchUsername as NombreUsuario, 
			CASE 
				WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
				WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
			END AS NombreCliente FROM tb_cotizacion CT 
		LEFT JOIN tb_usuario U ON CT.intIdUsuario = U.intUserId
		LEFT JOIN tb_cliente C ON CT.intIdCliente = C.intIdCliente
		WHERE 
		CT.intIdCotizacion LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchNombres LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%') OR
		CT.dtmFechaCreacion LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARCOTIZACION_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARCOTIZACION_II(
    	IN _elemento VARCHAR(250)
    )
	BEGIN
		SELECT CT.*,U.nvchUsername as NombreUsuario, 
			CASE 
				WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
				WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
			END AS NombreCliente FROM tb_cotizacion CT 
		LEFT JOIN tb_usuario U ON CT.intIdUsuario = U.intUserId
		LEFT JOIN tb_cliente C ON CT.intIdCliente = C.intIdCliente
		WHERE 
		CT.intIdCotizacion LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchNombres LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%') OR
		CT.dtmFechaCreacion LIKE CONCAT(_elemento,'%');
    END 
$$
DELIMITER ;