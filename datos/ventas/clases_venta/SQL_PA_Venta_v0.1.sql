USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARVENTA;
DELIMITER $$
	CREATE PROCEDURE INSERTARVENTA(
	OUT _intIdVenta INT,
	IN _nvchNumFactura VARCHAR(10),
	IN _nvchNumBoletaVenta VARCHAR(10),
	IN _intIdUsuario INT,
	IN _intIdCliente INT,
	IN _dtmFechaCreacion DATETIME,
	IN _intIdTipoComprobante INT
    )
	BEGIN
		INSERT INTO tb_venta 
		(intIdUsuario,nvchNumFactura,nvchNumBoletaVenta,intIdCliente,dtmFechaCreacion,intIdTipoComprobante)
		VALUES
		(_intIdUsuario,_nvchNumFactura,_nvchNumBoletaVenta,_intIdCliente,_dtmFechaCreacion,_intIdTipoComprobante);
		SET _intIdVenta = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARVENTA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARVENTA(
	IN _intIdVenta INT,
	IN _nvchNumFactura VARCHAR(10),
	IN _nvchNumBoletaVenta VARCHAR(10),
	IN _intIdUsuario INT,
	IN _intIdCliente INT,
	IN _dtmFechaCreacion DATETIME,
	IN _intIdTipoComprobante INT
    )
	BEGIN
		UPDATE tb_venta
		SET
		nvchNumFactura = _nvchNumFactura,
		nvchNumBoletaVenta = _nvchNumBoletaVenta,
		intIdUsuario = _intIdUsuario,
		intIdCliente = _intIdCliente,
		dtmFechaCreacion = _dtmFechaCreacion,
		intIdTipoComprobante = _intIdTipoComprobante
		WHERE 
		intIdVenta = _intIdVenta;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARVENTA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARVENTA(
    	IN _intIdVenta INT
    )
	BEGIN
		SELECT V.*, 
			CASE 
				WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
				WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
			END AS NombreCliente,
		U.nvchUsername as NombreUsuario
	    FROM tb_venta V 
		LEFT JOIN tb_usuario U ON V.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON V.intIdCliente = C.intIdCliente
		WHERE 
		V.intIdVenta = _intIdVenta;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARVENTA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARVENTA(
    	IN _intIdVenta INT
    )
	BEGIN
		DELETE FROM tb_venta
		WHERE 
		intIdVenta = _intIdVenta;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARVENTA;
DELIMITER $$
	CREATE PROCEDURE LISTARVENTA(
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT V.*,U.nvchUsername as NombreUsuario, 
			CASE 
				WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
				WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
			END AS NombreCliente FROM tb_venta V 
		LEFT JOIN tb_usuario U ON V.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON V.intIdCliente = C.intIdCliente
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOVENTA;
DELIMITER $$
	CREATE PROCEDURE TODOVENTA()
	BEGIN
		SELECT * FROM tb_venta;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARVENTA;
DELIMITER $$
	CREATE PROCEDURE BUSCARVENTA(
    	IN _elemento VARCHAR(250),
		IN _x INT,
		IN _y INT,
		IN _intIdTipoComprobante INT
    )
	BEGIN
		SELECT V.*,U.nvchUsername as NombreUsuario, 
			CASE 
				WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
				WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
			END AS NombreCliente FROM tb_venta V 
		LEFT JOIN tb_usuario U ON V.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON V.intIdCliente = C.intIdCliente
		WHERE 
		(V.intIdVenta LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchNombres LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%') OR
		V.dtmFechaCreacion LIKE CONCAT(_elemento,'%')) AND
		V.intIdTipoComprobante = _intIdTipoComprobante
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARVENTA_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARVENTA_II(
    	IN _elemento VARCHAR(250),
    	IN _intIdTipoComprobante INT
    )
	BEGIN
		SELECT V.*,U.nvchUsername as NombreUsuario, 
			CASE 
				WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
				WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
			END AS NombreCliente FROM tb_venta V 
		LEFT JOIN tb_usuario U ON V.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON V.intIdCliente = C.intIdCliente
		WHERE 
		(V.intIdVenta LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchNombres LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%') OR
		V.dtmFechaCreacion LIKE CONCAT(_elemento,'%')) AND
		V.intIdTipoComprobante = _intIdTipoComprobante;
    END 
$$
DELIMITER ;