USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE INSERTARORDENCOMPRA(
	OUT _intIdOrdenCompra INT,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(8),
	IN _nvchRazonSocial VARCHAR(125),
	IN _nvchRUC VARCHAR(20),
	IN _nvchAtencion VARCHAR(250),
	IN _intIdTipoMoneda INT,
	IN _intIdTipoPago INT,
	IN _nvchNombreDe VARCHAR(90),
	IN _intIdUsuario INT,
	IN _intIdDireccionEmpresa INT,
	IN _dtmFechaCreacion DATETIME,
	IN _intEstado INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		INSERT INTO tb_orden_compra 
		(nvchSerie,nvchNumeracion,nvchRazonSocial,nvchRUC,nvchAtencion,intIdTipoMoneda,intIdTipoPago,nvchNombreDe
			,intIdUsuario,intIdDireccionEmpresa,dtmFechaCreacion,intEstado,nvchObservacion)
		VALUES
		(_nvchSerie,_nvchNumeracion,_nvchRazonSocial,_nvchRUC,_nvchAtencion,_intIdTipoMoneda,_intIdTipoPago,_nvchNombreDe
			,_intIdUsuario,_intIdDireccionEmpresa,_dtmFechaCreacion,_intEstado,_nvchObservacion);
		SET _intIdOrdenCompra = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS INSERTARNUMERACIONORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE INSERTARNUMERACIONORDENCOMPRA(
	IN _intIdOrdenCompra INT,
	IN _nvchNumeracion VARCHAR(10)
    )
	BEGIN
		UPDATE tb_orden_compra
		SET
		nvchNumeracion = _nvchNumeracion
		WHERE 
		intIdOrdenCompra = _intIdOrdenCompra;
    END 
$$
DELIMITER ;


DROP PROCEDURE IF EXISTS ACTUALIZARORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARORDENCOMPRA(
	IN _intIdOrdenCompra INT,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(8),
	IN _nvchRazonSocial VARCHAR(125),
	IN _nvchRUC VARCHAR(20),
	IN _nvchAtencion VARCHAR(250),
	IN _intIdTipoMoneda INT,
	IN _intIdTipoPago INT,
	IN _nvchNombreDe VARCHAR(90),
	IN _intIdUsuario INT,
	IN _intIdDireccionEmpresa INT,
	IN _dtmFechaCreacion DATETIME,
	IN _intEstado INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		UPDATE tb_orden_compra
		SET
		nvchSerie = _nvchSerie,
		nvchNumeracion = _nvchNumeracion,
		nvchRazonSocial = _nvchRazonSocial,
		nvchRUC = _nvchRUC,
		nvchAtencion = _nvchAtencion,
		intIdTipoMoneda = _intIdTipoMoneda,
		intIdTipoPago = _intIdTipoPago,
		nvchNombreDe = _nvchNombreDe,
		intIdUsuario = _intIdUsuario,
		intIdDireccionEmpresa = _intIdDireccionEmpresa,
		dtmFechaCreacion = _dtmFechaCreacion,
		intEstado = _intEstado,
		nvchObservacion = _nvchObservacion
		WHERE 
		intIdOrdenCompra = _intIdOrdenCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARORDENCOMPRA(
    	IN _intIdOrdenCompra INT
    )
	BEGIN
		SELECT OC.*,
		U.nvchUsername AS NombreUsuario,
		TMN.nvchSimbolo AS SimboloMoneda,
		TPG.nvchNombre AS NombrePago
	    FROM tb_orden_compra OC 
		LEFT JOIN tb_usuario U ON OC.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_tipo_moneda TMN ON OC.intIdTipoMoneda = TMN.intIdTipoMoneda
		LEFT JOIN tb_tipo_pago TPG ON OC.intIdTipoPago = TPG.intIdTipoPago
		WHERE
		OC.intIdOrdenCompra = _intIdOrdenCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARORDENCOMPRA(
    	IN _intIdOrdenCompra INT
    )
	BEGIN
		DELETE FROM tb_orden_compra
		WHERE 
		intIdOrdenCompra = _intIdOrdenCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE LISTARORDENCOMPRA(
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT OC.*,U.nvchUsername AS NombreUsuario
		FROM tb_orden_compra OC 
		LEFT JOIN tb_usuario U ON OC.intIdUsuario = U.intIdUsuario
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE TODOORDENCOMPRA()
	BEGIN
		SELECT * FROM tb_orden_compra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE BUSCARORDENCOMPRA(
    	IN _elemento VARCHAR(250),
		IN _x INT,
		IN _y INT,
		IN _dtmFechaInicial DATETIME,
		IN _dtmFechaFinal DATETIME
    )
	BEGIN
		SELECT OC.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DOC.dcmTotal)/1.18),2) AS ValorOrdenCompra,
		SUM(DOC.dcmTotal) - ROUND((SUM(DOC.dcmTotal)/1.18),2) AS IGVOrdenCompra,
		SUM(DOC.dcmTotal) AS TotalOrdenCompra
		FROM tb_orden_compra OC
		LEFT JOIN tb_usuario U ON OC.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_detalle_orden_compra DOC ON OC.intIdOrdenCompra = DOC.intIdOrdenCompra
		LEFT JOIN tb_tipo_moneda TMN ON OC.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE
		(OC.nvchSerie LIKE CONCAT(_elemento,'%') OR
		OC.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		OC.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		OC.nvchRUC LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		(OC.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY OC.intIdOrdenCompra
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARORDENCOMPRA_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARORDENCOMPRA_II(
    	IN _elemento VARCHAR(250),
		IN _dtmFechaInicial DATETIME,
		IN _dtmFechaFinal DATETIME
    )
	BEGIN
		SELECT OC.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario,
		TMN.nvchSimbolo AS SimboloMoneda,
		ROUND((SUM(DOC.dcmTotal)/1.18),2) AS ValorOrdenCompra,
		SUM(DOC.dcmTotal) - ROUND((SUM(DOC.dcmTotal)/1.18),2) AS IGVOrdenCompra,
		SUM(DOC.dcmTotal) AS TotalOrdenCompra
		FROM tb_orden_compra OC
		LEFT JOIN tb_usuario U ON OC.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_detalle_orden_compra DOC ON OC.intIdOrdenCompra = DOC.intIdOrdenCompra
		LEFT JOIN tb_tipo_moneda TMN ON OC.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE
		(OC.nvchSerie LIKE CONCAT(_elemento,'%') OR
		OC.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		OC.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		OC.nvchRUC LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')) AND
		(OC.dtmFechaCreacion BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		GROUP BY OC.intIdOrdenCompra;
    END 
$$
DELIMITER ;