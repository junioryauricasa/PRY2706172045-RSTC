USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARVENTA;
DELIMITER $$
	CREATE PROCEDURE INSERTARVENTA(
	OUT _intIdVenta INT,
	IN _intIdTipoComprobante INT,
	IN _intIdSucursal INT,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(10),
	IN _intIdUsuario INT,
	IN _intIdCliente INT,
	IN _dtmFechaCreacion DATETIME,
	IN _intIdTipoMoneda INT,
	IN _intIdTipoPago INT,
	IN _bitEstado INT,
	IN _intIdTipoVenta INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		INSERT INTO tb_venta 
		(intIdTipoComprobante,intIdSucursal,nvchSerie,nvchNumeracion,intIdUsuario,intIdCliente,dtmFechaCreacion,intIdTipoMoneda,
			intIdTipoPago,bitEstado,intIdTipoVenta,nvchObservacion)
		VALUES
		(_intIdTipoComprobante,_intIdSucursal,_nvchSerie,_nvchNumeracion,_intIdUsuario,_intIdCliente,_dtmFechaCreacion,_intIdTipoMoneda,
			_intIdTipoPago,_bitEstado,_intIdTipoVenta,_nvchObservacion);
		SET _intIdVenta = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS INSERTARNUMERACIONVENTA;
DELIMITER $$
	CREATE PROCEDURE INSERTARNUMERACIONVENTA(
	IN _intIdVenta INT,
	IN _nvchNumeracion VARCHAR(10)
    )
	BEGIN
		UPDATE tb_venta
		SET
		nvchNumeracion = _nvchNumeracion
		WHERE 
		intIdVenta = _intIdVenta;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARVENTA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARVENTA(
	IN _intIdVenta INT,
	IN _intIdTipoComprobante INT,
	IN _intIdSucursal INT,
	IN _nvchNumeracion VARCHAR(10),
	IN _intIdUsuario INT,
	IN _intIdCliente INT,
	IN _dtmFechaCreacion DATETIME,
	IN _intIdTipoMoneda INT,
	IN _intIdTipoPago INT,
	IN _bitEstado INT,
	IN _intIdTipoVenta INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		UPDATE tb_venta
		SET
		intIdTipoComprobante = _intIdTipoComprobante,
		intIdSucursal = _intIdSucursal,
		nvchNumeracion = _nvchNumeracion,
		intIdUsuario = _intIdUsuario,
		intIdCliente = _intIdCliente,
		dtmFechaCreacion = _dtmFechaCreacion,
		intIdTipoMoneda = _intIdTipoMoneda,
		intIdTipoPago = _intIdTipoPago,
		bitEstado = _bitEstado,
		intIdTipoVenta = _intIdTipoVenta,
		nvchObservacion = _nvchObservacion
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
		C.nvchDNI AS DNICliente,
		C.nvchRUC AS RUCCliente,
		U.nvchUsername AS NombreUsuario,
		TMN.nvchSimbolo AS SimboloMoneda,
		TPG.nvchNombre AS NombrePago,
		TV.nvchNombre AS NombreVenta
	    FROM tb_venta V 
		LEFT JOIN tb_usuario U ON V.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON V.intIdCliente = C.intIdCliente
		LEFT JOIN tb_tipo_moneda TMN ON V.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_pago TPG ON V.intIdTipoPago = TPG.intIdTipoPago
		LEFT JOIN tb_tipo_venta TV ON V.intIdTipoVenta = TV.intIdTipoVenta
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
		SELECT V.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario, 
		CASE 
			WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
			WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
		END AS NombreCliente,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DV.dcmTotal)/1.18),2) AS ValorVenta,
		SUM(DV.dcmTotal) - ROUND((SUM(DV.dcmTotal)/1.18),2) AS IGVVenta,
		SUM(DV.dcmTotal) AS TotalVenta
		FROM tb_venta V 
		LEFT JOIN tb_usuario U ON V.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON V.intIdCliente = C.intIdCliente
		LEFT JOIN tb_detalle_venta DV ON V.intIdVenta = DV.intIdVenta
		LEFT JOIN tb_tipo_moneda TMN ON V.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE 
		(V.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchNombres LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%') OR
		V.dtmFechaCreacion LIKE CONCAT(_elemento,'%')) AND
		V.intIdTipoComprobante = _intIdTipoComprobante
		GROUP BY V.intIdVenta
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
		SELECT V.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario, 
		CASE 
			WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
			WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
		END AS NombreCliente,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DV.dcmTotal)/1.18),2) AS ValorVenta,
		SUM(DV.dcmTotal) - ROUND((SUM(DV.dcmTotal)/1.18),2) AS IGVVenta,
		SUM(DV.dcmTotal) AS TotalVenta
		FROM tb_venta V 
		LEFT JOIN tb_usuario U ON V.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON V.intIdCliente = C.intIdCliente
		LEFT JOIN tb_detalle_venta DV ON V.intIdVenta = DV.intIdVenta
		LEFT JOIN tb_tipo_moneda TMN ON V.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE 
		(V.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchNombres LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%') OR
		V.dtmFechaCreacion LIKE CONCAT(_elemento,'%')) AND
		V.intIdTipoComprobante = _intIdTipoComprobante
		GROUP BY V.intIdVenta;
    END 
$$
DELIMITER ;

USE db_resteco;

DROP PROCEDURE IF EXISTS LISTARULTIMASVENTAS;
DELIMITER $$
	CREATE PROCEDURE LISTARULTIMASVENTAS()
	BEGIN
		SELECT V.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		TC.nvchNombre AS NombreComprobante,
		CASE 
			WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
			WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
		END AS NombreCliente,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DV.dcmTotal)/1.18),2) AS ValorVenta,
		SUM(DV.dcmTotal) - ROUND((SUM(DV.dcmTotal)/1.18),2) AS IGVVenta,
		SUM(DV.dcmTotal) AS TotalVenta
		FROM tb_venta V
		LEFT JOIN tb_usuario U ON V.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON V.intIdCliente = C.intIdCliente
		LEFT JOIN tb_detalle_venta DV ON V.intIdVenta = DV.intIdVenta
		LEFT JOIN tb_tipo_moneda TMN ON V.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_comprobante TC ON V.intIdTipoComprobante = TC.intIdTipoComprobante
		GROUP BY V.intIdVenta DESC LIMIT 10;
    END
$$
DELIMITER ;