USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARCOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE INSERTARCOMPROBANTE(
	OUT _intIdComprobante INT,
	IN _intIdTipoComprobante INT,
	IN _intTipoDetalle INT,
	IN _intIdSucursal INT,
	IN _dtmFechaCreacion DATETIME,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(10),
	IN _intIdUsuario INT,
	IN _intIdCliente INT,
	IN _intIdProveedor INT,
	IN _nvchClienteProveedor VARCHAR(350),
	IN _nvchDNIRUC VARCHAR(11),
	IN _nvchDireccion VARCHAR(450),
	IN _intIdTipoMoneda INT,
	IN _intIdTipoPago INT,
	IN _intIdTipoVenta INT,
	IN _intEstado INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		INSERT INTO tb_comprobante
		(intIdTipoComprobante,intTipoDetalle,intIdSucursal,dtmFechaCreacion,nvchSerie,nvchNumeracion,intIdUsuario,intIdCliente,intIdProveedor,
			nvchClienteProveedor,nvchDNIRUC,nvchDireccion,intIdTipoMoneda,intIdTipoPago,intIdTipoVenta,intEstado,nvchObservacion)
		VALUES
		(_intIdTipoComprobante,_intTipoDetalle,_intIdSucursal,_dtmFechaCreacion,_nvchSerie,_nvchNumeracion,_intIdUsuario,_intIdCliente,_intIdProveedor,
			_nvchClienteProveedor,_nvchDNIRUC,_nvchDireccion,_intIdTipoMoneda,_intIdTipoPago,_intIdTipoVenta,_intEstado,_nvchObservacion);
		SET _intIdComprobante = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS INSERTARNUMERACIONCOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE INSERTARNUMERACIONCOMPROBANTE(
	IN _intIdComprobante INT,
	IN _nvchNumeracion VARCHAR(10)
    )
	BEGIN
		UPDATE tb_comprobante
		SET
		nvchNumeracion = _nvchNumeracion
		WHERE 
		intIdVenta = _intIdVenta;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARCOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARCOMPROBANTE(
	IN _intIdComprobante INT,
	IN _intIdTipoComprobante INT,
	IN _intTipoDetalle INT,
	IN _intIdSucursal INT,
	IN _dtmFechaCreacion DATETIME,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(10),
	IN _intIdUsuario INT,
	IN _intIdCliente INT,
	IN _intIdProveedor INT,
	IN _nvchClienteProveedor VARCHAR(350),
	IN _nvchDNIRUC VARCHAR(11),
	IN _nvchDireccion VARCHAR(450),
	IN _intIdTipoMoneda INT,
	IN _intIdTipoPago INT,
	IN _intIdTipoVenta INT,
	IN _intEstado INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		UPDATE tb_venta
		SET
		intIdComprobante = _intIdComprobante,
		intIdTipoComprobante = _intIdTipoComprobante,
		intTipoDetalle = _intTipoDetalle,
		intIdSucursal = _intIdSucursal,
		dtmFechaCreacion = _dtmFechaCreacion,
		nvchSerie = _nvchSerie,
		nvchNumeracion = _nvchNumeracion,
		intIdUsuario = _intIdUsuario,
		intIdCliente = _intIdCliente,
		intIdProveedor = _intIdProveedor,
		nvchClienteProveedor = _nvchClienteProveedor,
		nvchDNIRUC = _nvchDNIRUC,
		nvchDireccion = _nvchDireccion,
		intIdTipoMoneda = _intIdTipoMoneda,
		intIdTipoPago = _intIdTipoPago,
		intIdTipoVenta = _intIdTipoVenta,
		intEstado = _intEstado,
		nvchObservacion = _nvchObservacion
		WHERE 
		intIdComprobante = _intIdComprobante;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARCOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE MOSTRARCOMPROBANTE(
    	IN _intIdComprobante INT
    )
	BEGIN
		SELECT CR.*,
		CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		TMN.nvchNombre AS NombreMoneda,
		TPG.nvchNombre AS NombrePago,
		TV.nvchNombre AS NombreVenta,
		TCL.nvchNombre AS TipoCliente,
		TCL.intIdTipoCliente
	    FROM tb_comprobante CR
		LEFT JOIN tb_usuario U ON CR.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON CR.intIdCliente = C.intIdCliente
		LEFT JOIN tb_tipo_cliente TCL ON C.intIdTipoCliente = TCL.intIdTipoCliente
		LEFT JOIN tb_tipo_moneda TMN ON CR.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_pago TPG ON CR.intIdTipoPago = TPG.intIdTipoPago
		LEFT JOIN tb_tipo_venta TV ON CR.intIdTipoVenta = TV.intIdTipoVenta
		WHERE 
		CR.intIdComprobante = _intIdComprobante;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ANULARCOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE ANULARCOMPROBANTE(
    	IN _intIdComprobante INT
    )
	BEGIN
		UPDATE tb_comprobante
		SET
		intEstado = 0
		WHERE 
		intIdComprobante = _intIdComprobante;
    END 
$$
DELIMITER;

DROP PROCEDURE IF EXISTS LISTARCOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE LISTARCOMPROBANTE(
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

DROP PROCEDURE IF EXISTS BUSCARCOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE BUSCARCOMPROBANTE(
    	IN _elemento VARCHAR(250),
		IN _x INT,
		IN _y INT,
		IN _intIdTipoComprobante INT,
		IN _dtmFechaInicial DATETIME,
		IN _dtmFechaFinal DATETIME,
		IN _intTipoDetalle INT
    )
	BEGIN
	IF (_intTipoDetalle = 1 AND _intIdTipoComprobante != "T") THEN
		SELECT CR.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		CASE 
			WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
			WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
		END AS NombreCliente,
		TCR.nvchNombre AS NombreComprobante,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DCR.dcmTotal)/1.18),2) AS ValorComprobante,
		SUM(DCR.dcmTotal) - ROUND((SUM(DCR.dcmTotal)/1.18),2) AS IGVComprobante,
		SUM(DCR.dcmTotal) AS TotalComprobante
		FROM tb_comprobante CR
		LEFT JOIN tb_usuario U ON CR.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON CR.intIdCliente = C.intIdCliente
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		LEFT JOIN tb_tipo_moneda TMN ON CR.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		WHERE 
		(CR.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchNombres LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		CR.intIdTipoComprobante = _intIdTipoComprobante AND
		(CR.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY CR.intIdComprobante
		LIMIT _x,_y;
	ELSEIF (_intTipoDetalle = 1 AND _intIdTipoComprobante = "T") THEN
		SELECT CR.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		CASE 
			WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
			WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
		END AS NombreCliente,
		TCR.nvchNombre AS NombreComprobante,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DCR.dcmTotal)/1.18),2) AS ValorComprobante,
		SUM(DCR.dcmTotal) - ROUND((SUM(DCR.dcmTotal)/1.18),2) AS IGVComprobante,
		SUM(DCR.dcmTotal) AS TotalComprobante
		FROM tb_comprobante CR
		LEFT JOIN tb_usuario U ON CR.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON CR.intIdCliente = C.intIdCliente
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		LEFT JOIN tb_tipo_moneda TMN ON CR.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		WHERE 
		(CR.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchNombres LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		CR.intTipoDetalle = _intTipoDetalle AND
		(CR.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY CR.intIdComprobante
		LIMIT _x,_y;
	ELSEIF (_intTipoDetalle = 2 AND _intIdTipoComprobante != "T") THEN
		SELECT CR.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		CASE 
			WHEN PRO.intIdTipoPersona = 1 THEN PRO.nvchRazonSocial
			WHEN PRO.intIdTipoPersona = 2 THEN CONCAT(PRO.nvchNombres,' ',PRO.nvchApellidoPaterno,' ',PRO.nvchApellidoMaterno)
		END AS NombreProveedor,
		TCR.nvchNombre AS NombreComprobante,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DCR.dcmTotal)/1.18),2) AS ValorComprobante,
		SUM(DCR.dcmTotal) - ROUND((SUM(DCR.dcmTotal)/1.18),2) AS IGVComprobante,
		SUM(DCR.dcmTotal) AS TotalComprobante
		FROM tb_comprobante CR
		LEFT JOIN tb_usuario U ON CR.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_proveedor PRO ON CR.intIdProveedor = PRO.intIdProveedor
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		LEFT JOIN tb_tipo_moneda TMN ON CR.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		WHERE 
		(CR.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		PRO.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		PRO.nvchNombres LIKE CONCAT(_elemento,'%') OR
		PRO.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		PRO.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		CR.intIdTipoComprobante = _intIdTipoComprobante AND
		(CR.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY CR.intIdComprobante
		LIMIT _x,_y;
	ELSEIF (_intTipoDetalle = 2 AND _intIdTipoComprobante = "T") THEN
		SELECT CR.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		CASE 
			WHEN PRO.intIdTipoPersona = 1 THEN PRO.nvchRazonSocial
			WHEN PRO.intIdTipoPersona = 2 THEN CONCAT(PRO.nvchNombres,' ',PRO.nvchApellidoPaterno,' ',PRO.nvchApellidoMaterno)
		END AS NombreProveedor,
		TCR.nvchNombre AS NombreComprobante,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DCR.dcmTotal)/1.18),2) AS ValorComprobante,
		SUM(DCR.dcmTotal) - ROUND((SUM(DCR.dcmTotal)/1.18),2) AS IGVComprobante,
		SUM(DCR.dcmTotal) AS TotalComprobante
		FROM tb_comprobante CR
		LEFT JOIN tb_usuario U ON CR.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_proveedor PRO ON CR.intIdProveedor = PRO.intIdProveedor
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		LEFT JOIN tb_tipo_moneda TMN ON CR.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		WHERE 
		(CR.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		PRO.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		PRO.nvchNombres LIKE CONCAT(_elemento,'%') OR
		PRO.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		PRO.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		CR.intTipoDetalle = _intTipoDetalle AND
		(CR.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY CR.intIdComprobante
		LIMIT _x,_y;
	END IF;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARCOMPROBANTE_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARCOMPROBANTE_II(
    	IN _elemento VARCHAR(250),
    	IN _intIdTipoComprobante INT,
    	IN _dtmFechaInicial DATETIME,
    	IN _dtmFechaFinal DATETIME,
    	IN _intTipoDetalle INT
    )
	BEGIN
	IF (_intTipoDetalle = 1 AND _intIdTipoComprobante != "T") THEN
		SELECT CR.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		CASE 
			WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
			WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
		END AS NombreCliente,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DCR.dcmTotal)/1.18),2) AS ValorComprobante,
		SUM(DCR.dcmTotal) - ROUND((SUM(DCR.dcmTotal)/1.18),2) AS IGVComprobante,
		SUM(DCR.dcmTotal) AS TotalComprobante
		FROM tb_comprobante CR
		LEFT JOIN tb_usuario U ON CR.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON CR.intIdCliente = C.intIdCliente
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		LEFT JOIN tb_tipo_moneda TMN ON CR.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		WHERE 
		(CR.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchNombres LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		CR.intIdTipoComprobante = _intIdTipoComprobante AND
		(CR.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY CR.intIdComprobante;
	ELSEIF (_intTipoDetalle = 1 AND _intIdTipoComprobante = "T") THEN
		SELECT CR.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		CASE 
			WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
			WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
		END AS NombreCliente,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DCR.dcmTotal)/1.18),2) AS ValorComprobante,
		SUM(DCR.dcmTotal) - ROUND((SUM(DCR.dcmTotal)/1.18),2) AS IGVComprobante,
		SUM(DCR.dcmTotal) AS TotalComprobante
		FROM tb_comprobante CR
		LEFT JOIN tb_usuario U ON CR.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON CR.intIdCliente = C.intIdCliente
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		LEFT JOIN tb_tipo_moneda TMN ON CR.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		WHERE 
		(CR.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		C.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		C.nvchNombres LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		C.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		CR.intTipoDetalle = _intTipoDetalle AND
		(CR.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY CR.intIdComprobante;
	ELSEIF (_intTipoDetalle = 2 AND _intIdTipoComprobante != "T") THEN
		SELECT CR.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		CASE 
			WHEN PRO.intIdTipoPersona = 1 THEN PRO.nvchRazonSocial
			WHEN PRO.intIdTipoPersona = 2 THEN CONCAT(PRO.nvchNombres,' ',PRO.nvchApellidoPaterno,' ',PRO.nvchApellidoMaterno)
		END AS NombreProveedor,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DCR.dcmTotal)/1.18),2) AS ValorComprobante,
		SUM(DCR.dcmTotal) - ROUND((SUM(DCR.dcmTotal)/1.18),2) AS IGVComprobante,
		SUM(DCR.dcmTotal) AS TotalComprobante
		FROM tb_comprobante CR
		LEFT JOIN tb_usuario U ON CR.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_proveedor PRO ON CR.intIdProveedor = PRO.intIdProveedor
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		LEFT JOIN tb_tipo_moneda TMN ON CR.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		WHERE 
		(CR.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		PRO.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		PRO.nvchNombres LIKE CONCAT(_elemento,'%') OR
		PRO.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		PRO.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		CR.intIdTipoComprobante = _intIdTipoComprobante AND
		(CR.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY CR.intIdComprobante;
	ELSEIF (_intTipoDetalle = 2 AND _intIdTipoComprobante = "T") THEN
		SELECT CR.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		CASE 
			WHEN PRO.intIdTipoPersona = 1 THEN PRO.nvchRazonSocial
			WHEN PRO.intIdTipoPersona = 2 THEN CONCAT(PRO.nvchNombres,' ',PRO.nvchApellidoPaterno,' ',PRO.nvchApellidoMaterno)
		END AS NombreProveedor,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DCR.dcmTotal)/1.18),2) AS ValorComprobante,
		SUM(DCR.dcmTotal) - ROUND((SUM(DCR.dcmTotal)/1.18),2) AS IGVComprobante,
		SUM(DCR.dcmTotal) AS TotalComprobante
		FROM tb_comprobante CR
		LEFT JOIN tb_usuario U ON CR.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_proveedor PRO ON CR.intIdProveedor = PRO.intIdProveedor
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		LEFT JOIN tb_tipo_moneda TMN ON CR.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		WHERE 
		(CR.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		PRO.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		PRO.nvchNombres LIKE CONCAT(_elemento,'%') OR
		PRO.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		PRO.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		CR.intTipoDetalle = _intTipoDetalle AND
		(CR.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY CR.intIdComprobante;
	END IF;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARULTIMOSCOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE LISTARULTIMOSCOMPROBANTE()
	BEGIN
		SELECT V.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		TC.nvchNombre AS NombreComprobante,
		CASE 
			WHEN C.intIdTipoPersona = 1 THEN C.nvchRazonSocial
			WHEN C.intIdTipoPersona = 2 THEN CONCAT(C.nvchNombres,' ',C.nvchApellidoPaterno,' ',C.nvchApellidoMaterno)
		END AS NombreCliente,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DCR.dcmTotal)/1.18),2) AS ValorVenta,
		SUM(DCR.dcmTotal) - ROUND((SUM(DCR.dcmTotal)/1.18),2) AS IGVVenta,
		SUM(DCR.dcmTotal) AS TotalVenta
		FROM tb_venta V
		LEFT JOIN tb_usuario U ON V.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_cliente C ON V.intIdCliente = C.intIdCliente
		LEFT JOIN tb_detalle_venta DV ON V.intIdVenta = DCR.intIdVenta
		LEFT JOIN tb_tipo_moneda TMN ON V.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_comprobante TC ON V.intIdTipoComprobante = TC.intIdTipoComprobante
		GROUP BY CR.intIdComprobante DESC LIMIT 10;
    END
$$
DELIMITER ;