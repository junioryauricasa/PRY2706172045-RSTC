DROP PROCEDURE IF EXISTS BUSCARPRODUCTO_NOMOVIMIENTO;
DELIMITER $$
	CREATE PROCEDURE BUSCARPRODUCTO_NOMOVIMIENTO(
    	IN _elemento VARCHAR(500),
		IN _TipoBusqueda VARCHAR(2)
    )
	BEGIN
		SELECT * FROM(SELECT P.nvchDescripcion,P.dcmPrecioVenta1,P.dtmFechaIngreso,TMN.nvchSimbolo,TMN.nvchNombre AS NombreMoneda,
		SUM(CASE 
			WHEN UP.intIdSucursal = 1 THEN UP.intCantidadUbigeo
		END) AS CantidadHuancayo,
		SUM(CASE 
			WHEN UP.intIdSucursal = 2 THEN UP.intCantidadUbigeo
		END) AS CantidadSanJeronimo,
		(SELECT dtmFechaRealizada FROM tb_detalle_comprobante WHERE intIdProducto = P.intIdProducto LIMIT 1) AS ExisteMovimiento,
		CP.nvchCodigo
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		LEFT JOIN tb_ubigeo_producto UP ON P.intIdProducto = UP.intIdProducto
		WHERE
		P.intIdProducto IN (
		SELECT P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%') OR 
		P.nvchDescripcion LIKE CONCAT(_elemento,'%')) AND CP.intIdTipoCodigoProducto = 1
		GROUP BY P.intIdProducto
		ORDER BY P.intIdProducto) AS ProductoNoMovimiento WHERE ProductoNoMovimiento.ExisteMovimiento IS NULL;
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARCLIENTE;
DELIMITER $$
	CREATE PROCEDURE BUSCARCLIENTE(
    	IN _elemento VARCHAR(250),
		IN _x INT,
		IN _y INT,
		IN _intIdTipoPersona INT,
		IN _intIdDepartamento INT,
		IN _intIdProvincia INT,
		IN _intIdDistrito INT
    )
	BEGIN
		IF(_intIdDepartamento = "T" AND (_intIdProvincia = "T" OR _intIdProvincia != "T") AND (_intIdDistrito = "T" OR _intIdDistrito != "T")) THEN
			SELECT CL.*,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRazonSocial
				WHEN CL.intIdTipoPersona = 2 THEN CONCAT(CL.nvchNombres,' ',CL.nvchApellidoPaterno,' ',CL.nvchApellidoMaterno)
			END AS NombreCliente,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRUC
				WHEN CL.intIdTipoPersona = 2 THEN
				CASE
					WHEN CL.nvchRUC = NULL OR CL.nvchRUC = '' THEN CL.nvchDNI
					WHEN CL.nvchRUC != NULL OR CL.nvchRUC != '' THEN CONCAT(CL.nvchRUC,' / ',CL.nvchDNI)
				END
			END AS DNIRUC
			,TCL.nvchNombre AS TipoCliente FROM tb_cliente CL
			LEFT JOIN tb_tipo_cliente TCL ON TCL.intIdTipoCliente = CL.intIdTipoCliente
			WHERE 
			(
			CL.nvchDNI LIKE CONCAT(_elemento,'%') OR
			CL.nvchRUC LIKE CONCAT(_elemento,'%') OR
			CL.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchNombres LIKE CONCAT(_elemento,'%') )
			LIMIT _x,_y;
		ELSEIF(_intIdDepartamento != "T" AND _intIdProvincia = "T" AND (_intIdDistrito = "T" OR _intIdDistrito != "T")) THEN
			SELECT CL.*,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRazonSocial
				WHEN CL.intIdTipoPersona = 2 THEN CONCAT(CL.nvchNombres,' ',CL.nvchApellidoPaterno,' ',CL.nvchApellidoMaterno)
			END AS NombreCliente,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRUC
				WHEN CL.intIdTipoPersona = 2 THEN
				CASE
					WHEN CL.nvchRUC = NULL OR CL.nvchRUC = '' THEN CL.nvchDNI
					WHEN CL.nvchRUC != NULL OR CL.nvchRUC != '' THEN CONCAT(CL.nvchRUC,' / ',CL.nvchDNI)
				END
			END AS DNIRUC
			,TCL.nvchNombre AS TipoCliente FROM tb_cliente CL
			LEFT JOIN tb_tipo_cliente TCL ON TCL.intIdTipoCliente = CL.intIdTipoCliente
			LEFT JOIN tb_domicilio_cliente DCL ON DCL.intIdCliente = CL.intIdCliente
			WHERE 
			(
			CL.nvchDNI LIKE CONCAT(_elemento,'%') OR
			CL.nvchRUC LIKE CONCAT(_elemento,'%') OR
			CL.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchNombres LIKE CONCAT(_elemento,'%') ) AND DCL.intIdTipoDomicilio = 1
			AND DCL.intIdDepartamento = _intIdDepartamento
			LIMIT _x,_y;
		ELSEIF(_intIdDepartamento != "T" AND _intIdProvincia != "T" AND _intIdDistrito = "T") THEN
			SELECT CL.*,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRazonSocial
				WHEN CL.intIdTipoPersona = 2 THEN CONCAT(CL.nvchNombres,' ',CL.nvchApellidoPaterno,' ',CL.nvchApellidoMaterno)
			END AS NombreCliente,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRUC
				WHEN CL.intIdTipoPersona = 2 THEN
				CASE
					WHEN CL.nvchRUC = NULL OR CL.nvchRUC = '' THEN CL.nvchDNI
					WHEN CL.nvchRUC != NULL OR CL.nvchRUC != '' THEN CONCAT(CL.nvchRUC,' / ',CL.nvchDNI)
				END
			END AS DNIRUC
			,TCL.nvchNombre AS TipoCliente FROM tb_cliente CL
			LEFT JOIN tb_tipo_cliente TCL ON TCL.intIdTipoCliente = CL.intIdTipoCliente
			LEFT JOIN tb_domicilio_cliente DCL ON DCL.intIdCliente = CL.intIdCliente
			WHERE 
			(
			CL.nvchDNI LIKE CONCAT(_elemento,'%') OR
			CL.nvchRUC LIKE CONCAT(_elemento,'%') OR
			CL.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchNombres LIKE CONCAT(_elemento,'%') ) AND DCL.intIdTipoDomicilio = 1
			AND DCL.intIdDepartamento = _intIdDepartamento AND DCL.intIdProvincia = _intIdProvincia
			LIMIT _x,_y;
		ELSEIF(_intIdDepartamento != "T" AND _intIdProvincia != "T" AND _intIdDistrito != "T") THEN
			SELECT CL.*,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRazonSocial
				WHEN CL.intIdTipoPersona = 2 THEN CONCAT(CL.nvchNombres,' ',CL.nvchApellidoPaterno,' ',CL.nvchApellidoMaterno)
			END AS NombreCliente,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRUC
				WHEN CL.intIdTipoPersona = 2 THEN
				CASE
					WHEN CL.nvchRUC = NULL OR CL.nvchRUC = '' THEN CL.nvchDNI
					WHEN CL.nvchRUC != NULL OR CL.nvchRUC != '' THEN CONCAT(CL.nvchRUC,' / ',CL.nvchDNI)
				END
			END AS DNIRUC
			,TCL.nvchNombre AS TipoCliente FROM tb_cliente CL
			LEFT JOIN tb_tipo_cliente TCL ON TCL.intIdTipoCliente = CL.intIdTipoCliente
			LEFT JOIN tb_domicilio_cliente DCL ON DCL.intIdCliente = CL.intIdCliente
			WHERE 
			(
			CL.nvchDNI LIKE CONCAT(_elemento,'%') OR
			CL.nvchRUC LIKE CONCAT(_elemento,'%') OR
			CL.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchNombres LIKE CONCAT(_elemento,'%') ) AND DCL.intIdTipoDomicilio = 1
			AND DCL.intIdDepartamento = _intIdDepartamento AND DCL.intIdProvincia = _intIdProvincia
			AND DCL.intIdDistrito = _intIdDistrito
			LIMIT _x,_y;
		END IF;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARCLIENTE_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARCLIENTE_II(
    	IN _elemento VARCHAR(250),
    	IN _intIdTipoPersona INT,
    	IN _intIdDepartamento INT,
		IN _intIdProvincia INT,
		IN _intIdDistrito INT
    )
	BEGIN
		IF(_intIdDepartamento = "T" AND (_intIdProvincia = "T" OR _intIdProvincia != "T") AND (_intIdDistrito = "T" OR _intIdDistrito != "T")) THEN
			SELECT CL.*,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRazonSocial
				WHEN CL.intIdTipoPersona = 2 THEN CONCAT(CL.nvchNombres,' ',CL.nvchApellidoPaterno,' ',CL.nvchApellidoMaterno)
			END AS NombreCliente,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRUC
				WHEN CL.intIdTipoPersona = 2 THEN
				CASE
					WHEN CL.nvchRUC = NULL OR CL.nvchRUC = '' THEN CL.nvchDNI
					WHEN CL.nvchRUC != NULL OR CL.nvchRUC != '' THEN CONCAT(CL.nvchRUC,' / ',CL.nvchDNI)
				END
			END AS DNIRUC
			,TCL.nvchNombre AS TipoCliente FROM tb_cliente CL
			LEFT JOIN tb_tipo_cliente TCL ON TCL.intIdTipoCliente = CL.intIdTipoCliente
			WHERE 
			(
			CL.nvchDNI LIKE CONCAT(_elemento,'%') OR
			CL.nvchRUC LIKE CONCAT(_elemento,'%') OR
			CL.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchNombres LIKE CONCAT(_elemento,'%') );
		ELSEIF(_intIdDepartamento != "T" AND _intIdProvincia = "T" AND (_intIdDistrito = "T" OR _intIdDistrito != "T")) THEN
			SELECT CL.*,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRazonSocial
				WHEN CL.intIdTipoPersona = 2 THEN CONCAT(CL.nvchNombres,' ',CL.nvchApellidoPaterno,' ',CL.nvchApellidoMaterno)
			END AS NombreCliente,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRUC
				WHEN CL.intIdTipoPersona = 2 THEN
				CASE
					WHEN CL.nvchRUC = NULL OR CL.nvchRUC = '' THEN CL.nvchDNI
					WHEN CL.nvchRUC != NULL OR CL.nvchRUC != '' THEN CONCAT(CL.nvchRUC,' / ',CL.nvchDNI)
				END
			END AS DNIRUC
			,TCL.nvchNombre AS TipoCliente FROM tb_cliente CL
			LEFT JOIN tb_tipo_cliente TCL ON TCL.intIdTipoCliente = CL.intIdTipoCliente
			LEFT JOIN tb_domicilio_cliente DCL ON DCL.intIdCliente = CL.intIdCliente
			WHERE 
			(
			CL.nvchDNI LIKE CONCAT(_elemento,'%') OR
			CL.nvchRUC LIKE CONCAT(_elemento,'%') OR
			CL.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchNombres LIKE CONCAT(_elemento,'%') ) AND DCL.intIdTipoDomicilio = 1
			AND DCL.intIdDepartamento = _intIdDepartamento;
		ELSEIF(_intIdDepartamento != "T" AND _intIdProvincia != "T" AND _intIdDistrito = "T") THEN
			SELECT CL.*,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRazonSocial
				WHEN CL.intIdTipoPersona = 2 THEN CONCAT(CL.nvchNombres,' ',CL.nvchApellidoPaterno,' ',CL.nvchApellidoMaterno)
			END AS NombreCliente,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRUC
				WHEN CL.intIdTipoPersona = 2 THEN
				CASE
					WHEN CL.nvchRUC = NULL OR CL.nvchRUC = '' THEN CL.nvchDNI
					WHEN CL.nvchRUC != NULL OR CL.nvchRUC != '' THEN CONCAT(CL.nvchRUC,' / ',CL.nvchDNI)
				END
			END AS DNIRUC
			,TCL.nvchNombre AS TipoCliente FROM tb_cliente CL
			LEFT JOIN tb_tipo_cliente TCL ON TCL.intIdTipoCliente = CL.intIdTipoCliente
			LEFT JOIN tb_domicilio_cliente DCL ON DCL.intIdCliente = CL.intIdCliente
			WHERE 
			(
			CL.nvchDNI LIKE CONCAT(_elemento,'%') OR
			CL.nvchRUC LIKE CONCAT(_elemento,'%') OR
			CL.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchNombres LIKE CONCAT(_elemento,'%') ) AND DCL.intIdTipoDomicilio = 1
			AND DCL.intIdDepartamento = _intIdDepartamento AND DCL.intIdProvincia = _intIdProvincia;
		ELSEIF(_intIdDepartamento != "T" AND _intIdProvincia != "T" AND _intIdDistrito != "T") THEN
			SELECT CL.*,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRazonSocial
				WHEN CL.intIdTipoPersona = 2 THEN CONCAT(CL.nvchNombres,' ',CL.nvchApellidoPaterno,' ',CL.nvchApellidoMaterno)
			END AS NombreCliente,
			CASE
				WHEN CL.intIdTipoPersona = 1 THEN CL.nvchRUC
				WHEN CL.intIdTipoPersona = 2 THEN
				CASE
					WHEN CL.nvchRUC = NULL OR CL.nvchRUC = '' THEN CL.nvchDNI
					WHEN CL.nvchRUC != NULL OR CL.nvchRUC != '' THEN CONCAT(CL.nvchRUC,' / ',CL.nvchDNI)
				END
			END AS DNIRUC
			,TCL.nvchNombre AS TipoCliente FROM tb_cliente CL
			LEFT JOIN tb_tipo_cliente TCL ON TCL.intIdTipoCliente = CL.intIdTipoCliente
			LEFT JOIN tb_domicilio_cliente DCL ON DCL.intIdCliente = CL.intIdCliente
			WHERE 
			(
			CL.nvchDNI LIKE CONCAT(_elemento,'%') OR
			CL.nvchRUC LIKE CONCAT(_elemento,'%') OR
			CL.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
			CL.nvchNombres LIKE CONCAT(_elemento,'%') ) AND DCL.intIdTipoDomicilio = 1
			AND DCL.intIdDepartamento = _intIdDepartamento AND DCL.intIdProvincia = _intIdProvincia
			AND DCL.intIdDistrito = _intIdDistrito;
		END IF;
    END 
$$
DELIMITER ;