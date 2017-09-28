USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE INSERTARORDENCOMPRA(
	OUT _intIdOrdenCompra INT,
	IN _intIdUsuario INT,
	IN _intIdProveedor INT,
	IN _nvchAtencion VARCHAR(250),
	IN _intIdTipoMoneda INT,
	IN _intIdTipoPago INT,
	IN _dtmFechaCreacion DATETIME,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		INSERT INTO tb_orden_compra 
		(intIdUsuario,intIdProveedor,nvchAtencion,intIdTipoMoneda,intIdTipoPago,dtmFechaCreacion,nvchObservacion)
		VALUES
		(_intIdUsuario,_intIdProveedor,_nvchAtencion,_intIdTipoMoneda,_intIdTipoPago,_dtmFechaCreacion,_nvchObservacion);
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
	IN _intIdUsuario INT,
	IN _intIdProveedor INT,
	IN _nvchAtencion VARCHAR(250),
	IN _intIdTipoMoneda INT,
	IN _intIdTipoPago INT,
	IN _dtmFechaCreacion DATETIME,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		UPDATE tb_orden_compra
		SET
		intIdUsuario = _intIdUsuario,
		intIdProveedor = _intIdProveedor,
		nvchAtencion = _nvchAtencion,
		intIdTipoMoneda = _intIdTipoMoneda,
		intIdTipoPago = _intIdTipoPago,
		dtmFechaCreacion = _dtmFechaCreacion,
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
			CASE 
				WHEN P.intIdTipoPersona = 1 THEN P.nvchRazonSocial
				WHEN P.intIdTipoPersona = 2 THEN CONCAT(P.nvchNombres,' ',P.nvchApellidoPaterno,' ',P.nvchApellidoMaterno)
			END AS NombreProveedor,
		U.nvchUsername as NombreUsuario
	    FROM tb_orden_compra OC 
		LEFT JOIN tb_usuario U ON OC.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_proveedor P ON OC.intIdProveedor = P.intIdProveedor
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
		SELECT OC.*,U.nvchUsername as NombreUsuario, 
			CASE 
				WHEN P.intIdTipoPersona = 1 THEN P.nvchRazonSocial
				WHEN P.intIdTipoPersona = 2 THEN CONCAT(P.nvchNombres,' ',P.nvchApellidoPaterno,' ',P.nvchApellidoMaterno)
			END AS NombreProveedor FROM tb_orden_compra OC 
		LEFT JOIN tb_usuario U ON OC.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_proveedor P ON OC.intIdProveedor = P.intIdProveedor
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
		IN _y INT
    )
	BEGIN
		SELECT OC.*,U.nvchUsername as NombreUsuario, 
			CASE 
				WHEN P.intIdTipoPersona = 1 THEN P.nvchRazonSocial
				WHEN P.intIdTipoPersona = 2 THEN CONCAT(P.nvchNombres,' ',P.nvchApellidoPaterno,' ',P.nvchApellidoMaterno)
			END AS NombreProveedor FROM tb_orden_compra OC 
		LEFT JOIN tb_usuario U ON OC.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_proveedor P ON OC.intIdProveedor = P.intIdProveedor
		WHERE 
		OC.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		P.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		P.nvchNombres LIKE CONCAT(_elemento,'%') OR
		P.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		P.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%') OR
		OC.dtmFechaCreacion LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARORDENCOMPRA_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARORDENCOMPRA_II(
    	IN _elemento VARCHAR(250)
    )
	BEGIN
		SELECT OC.*,U.nvchUsername as NombreUsuario, 
			CASE 
				WHEN P.intIdTipoPersona = 1 THEN P.nvchRazonSocial
				WHEN P.intIdTipoPersona = 2 THEN CONCAT(P.nvchNombres,' ',P.nvchApellidoPaterno,' ',P.nvchApellidoMaterno)
			END AS NombreProveedor FROM tb_orden_compra OC 
		LEFT JOIN tb_usuario U ON OC.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_proveedor P ON OC.intIdProveedor = P.intIdProveedor
		WHERE 
		OC.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		P.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		P.nvchNombres LIKE CONCAT(_elemento,'%') OR
		P.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		P.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%') OR
		OC.dtmFechaCreacion LIKE CONCAT(_elemento,'%');
    END 
$$
DELIMITER ;