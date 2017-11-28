USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE INSERTARCOTIZACION(
	OUT _intIdCotizacion INT,
	IN _dtmFechaCreacion DATETIME,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(10),
	IN _intIdUsuario INT,
	IN _intIdCliente INT,
	IN _nvchClienteProveedor VARCHAR(350),
	IN _nvchDNIRUC VARCHAR(11),
	IN _nvchDireccion VARCHAR(450),
	IN _nvchAtencion VARCHAR(250),
	IN _intIdTipoMoneda INT,
	IN _intIdTipoPago INT,
	IN _intDiasValidez INT,
	IN _intIdTipoVenta INT,
	IN _nvchTipo VARCHAR(25),
	IN _nvchModelo VARCHAR(75),
	IN _nvchMarca VARCHAR(75),
	IN _nvchHorometro VARCHAR(65),
	IN _bitEstado INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		INSERT INTO tb_cotizacion 
		(dtmFechaCreacion,nvchSerie,nvchNumeracion,intIdUsuario,intIdCliente,nvchClienteProveedor,nvchDNIRUC,nvchDireccion,
			nvchAtencion,intIdTipoMoneda,intIdTipoPago,intDiasValidez,intIdTipoVenta,nvchTipo,nvchModelo,nvchMarca,nvchHorometro,
			bitEstado,nvchObservacion)
		VALUES
		(_dtmFechaCreacion,_nvchSerie,_nvchNumeracion,_intIdUsuario,_intIdCliente,_nvchClienteProveedor,_nvchDNIRUC,_nvchDireccion,
			_nvchAtencion,_intIdTipoMoneda,_intIdTipoPago,_intDiasValidez,_intIdTipoVenta,_nvchTipo,_nvchModelo,_nvchMarca,
			_nvchHorometro,_bitEstado,_nvchObservacion);
		SET _intIdCotizacion = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS INSERTARNUMERACIONCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE INSERTARNUMERACIONCOTIZACION(
	IN _intIdCotizacion INT,
	IN _nvchNumeracion VARCHAR(10)
    )
	BEGIN
		UPDATE tb_cotizacion
		SET
		nvchNumeracion = _nvchNumeracion
		WHERE 
		intIdCotizacion = _intIdCotizacion;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARCOTIZACION(
	IN _intIdCotizacion INT,
	IN _dtmFechaCreacion DATETIME,
	IN _nvchNumeracion VARCHAR(10),
	IN _intIdUsuario INT,
	IN _intIdCliente INT,
	IN _nvchAtencion VARCHAR(250),
	IN _intIdTipoMoneda INT,
	IN _intIdTipoPago INT,
	IN _intDiasValidez INT,
	IN _intIdTipoVenta INT,
	IN _nvchTipo VARCHAR(25),
	IN _nvchModelo VARCHAR(75),
	IN _nvchMarca VARCHAR(75),
	IN _nvchHorometro VARCHAR(65),
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		UPDATE tb_cotizacion
		SET
		dtmFechaCreacion = _dtmFechaCreacion,
		nvchSerie = _nvchSerie,
		nvchNumeracion = _nvchNumeracion,
		intIdUsuario = _intIdUsuario,
		intIdCliente = _intIdCliente,
		nvchAtencion = _nvchAtencion,
		intIdTipoMoneda = _intIdTipoMoneda,
		intIdTipoPago = _intIdTipoPago,
		intDiasValidez = _intDiasValidez,
		intIdTipoVenta = _intIdTipoVenta,
		nvchTipo = _nvchTipo,
		nvchModelo = _nvchModelo,
		nvchMarca = _nvchMarca,
		nvchHorometro = _nvchHorometro,
		nvchObservacion = _nvchObservacion
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
		C.nvchDNI AS DNICliente,
		C.nvchRUC AS RUCCliente,
		CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		TMN.nvchSimbolo AS SimboloMoneda,
		TPG.nvchNombre AS NombrePago,
		TV.nvchNombre AS NombreVenta,
		TCL.nvchNombre AS TipoCliente,
		TCL.intIdTipoCliente
	    FROM tb_cotizacion CT 
		LEFT JOIN tb_usuario U ON CT.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON CT.intIdCliente = C.intIdCliente
		LEFT JOIN tb_tipo_cliente TCL ON C.intIdTipoCliente = TCL.intIdTipoCliente
		LEFT JOIN tb_tipo_moneda TMN ON CT.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_pago TPG ON CT.intIdTipoPago = TPG.intIdTipoPago
		LEFT JOIN tb_tipo_venta TV ON CT.intIdTipoVenta = TV.intIdTipoVenta
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
		LEFT JOIN tb_usuario U ON CT.intIdUsuario = U.intIdUsuario
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
		IN _y INT,
    	IN _dtmFechaInicial DATETIME,
    	IN _dtmFechaFinal DATETIME
    )
	BEGIN
		SELECT CT.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) as NombreUsuario, 
		CASE 
			WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
			WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
		END AS NombreCliente,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DCT.dcmTotal)/1.18),2) AS ValorCotizacion,
		SUM(DCT.dcmTotal) - ROUND((SUM(DCT.dcmTotal)/1.18),2) AS IGVCotizacion,
		SUM(DCT.dcmTotal) AS TotalCotizacion
		FROM tb_cotizacion CT 
		LEFT JOIN tb_usuario U ON CT.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON CT.intIdCliente = C.intIdCliente
		LEFT JOIN tb_detalle_cotizacion DCT ON CT.intIdCotizacion = DCT.intIdCotizacion
		LEFT JOIN tb_tipo_moneda TMN ON CT.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE
		(CT.nvchSerie LIKE CONCAT(_elemento,'%') OR 
		CT.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchNombres LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%') OR
		CT.dtmFechaCreacion LIKE CONCAT(_elemento,'%')) AND
		(CT.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY CT.intIdCotizacion
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARCOTIZACION_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARCOTIZACION_II(
    	IN _elemento VARCHAR(250),
    	IN _dtmFechaInicial DATETIME,
    	IN _dtmFechaFinal DATETIME
    )
	BEGIN
		SELECT CT.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) as NombreUsuario, 
		CASE 
			WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
			WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
		END AS NombreCliente,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DCT.dcmTotal)/1.18),2) AS ValorCotizacion,
		SUM(DCT.dcmTotal) - ROUND((SUM(DCT.dcmTotal)/1.18),2) AS IGVCotizacion,
		SUM(DCT.dcmTotal) AS TotalCotizacion
		FROM tb_cotizacion CT 
		LEFT JOIN tb_usuario U ON CT.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON CT.intIdCliente = C.intIdCliente
		LEFT JOIN tb_detalle_cotizacion DCT ON CT.intIdCotizacion = DCT.intIdCotizacion
		LEFT JOIN tb_tipo_moneda TMN ON CT.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE
		(CT.nvchSerie LIKE CONCAT(_elemento,'%') OR
		CT.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchNombres LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%') OR
		CT.dtmFechaCreacion LIKE CONCAT(_elemento,'%')) AND
		(CT.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY CT.intIdCotizacion;
    END 
$$
DELIMITER ;