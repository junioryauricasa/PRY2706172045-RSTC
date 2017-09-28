USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARGUIAINTERNAENTRADA;
DELIMITER $$
	CREATE PROCEDURE INSERTARGUIAINTERNAENTRADA(
	OUT _intIdGuiaInternaEntrada INT,
	IN _intIdOrdenCompra INT,
	IN _intIdUsuario INT,
	IN _dtmFechaCreacion DATETIME
    )
	BEGIN
		INSERT INTO tb_guia_interna_entrada 
		(intIdOrdenCompra,intIdUsuario,dtmFechaCreacion)
		VALUES
		(_intIdOrdenCompra,_intIdUsuario,_dtmFechaCreacion);
		SET _intIdGUIAINTERNAENTRADA = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARGUIAINTERNAENTRADA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARGUIAINTERNAENTRADA(
	IN _intIdGuiaInternaEntrada INT,
	IN _intIdOrdenCompra INT,
	IN _intIdUsuario INT,
	IN _dtmFechaCreacion DATETIME
    )
	BEGIN
		UPDATE tb_guia_interna_entrada
		SET
		intIdOrdenCompra = _intIdOrdenCompra, 
		intIdUsuario = _intIdUsuario,
		dtmFechaCreacion = _dtmFechaCreacion
		WHERE 
		intIdGuiaInternaEntrada = _intIdGuiaInternaEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARGUIAINTERNAENTRADA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARGUIAINTERNAENTRADA(
    	IN _intIdGuiaInternaEntrada INT
    )
	BEGIN
		SELECT GIE.*,U.nvchUsername AS NombreUsuario, 
		CASE 
			WHEN P.intIdTipoPersona = 1 THEN P.nvchRazonSocial
			WHEN P.intIdTipoPersona = 2 THEN CONCAT(P.nvchNombres,' ',P.nvchApellidoPaterno,' ',P.nvchApellidoMaterno)
		END AS NombreProveedor, 
		P.*, OC.*
		FROM tb_guia_interna_entrada GIE
		LEFT JOIN tb_usuario U ON GIE.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_orden_compra OC ON GIE.intIdOrdenCompra = OC.intIdOrdenCompra
		LEFT JOIN tb_proveedor P ON OC.intIdProveedor = P.intIdProveedor
		WHERE 
		GIE.intIdGuiaInternaEntrada = _intIdGuiaInternaEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARGUIAINTERNAENTRADA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARGUIAINTERNAENTRADA(
    	IN _intIdGuiaInternaEntrada INT
    )
	BEGIN
		DELETE FROM tb_orden_compra
		WHERE 
		intIdGuiaInternaEntrada = _intIdGuiaInternaEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARGUIAINTERNAENTRADA;
DELIMITER $$
	CREATE PROCEDURE LISTARGUIAINTERNAENTRADA(
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT GIE.*,U.nvchUsername AS NombreUsuario, 
		CASE 
			WHEN P.intIdTipoPersona = 1 THEN P.nvchRazonSocial
			WHEN P.intIdTipoPersona = 2 THEN CONCAT(P.nvchNombres,' ',P.nvchApellidoPaterno,' ',P.nvchApellidoMaterno)
		END AS NombreProveedor, 
		P.*, OC.*
		FROM tb_guia_interna_entrada GIE
		LEFT JOIN tb_usuario U ON GIE.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_orden_compra OC ON GIE.intIdOrdenCompra = OC.intIdOrdenCompra
		LEFT JOIN tb_proveedor P ON OC.intIdProveedor = P.intIdProveedor
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARGUIAINTERNAENTRADA;
DELIMITER $$
	CREATE PROCEDURE BUSCARGUIAINTERNAENTRADA(
    	IN _elemento VARCHAR(600),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT GIE.*,U.nvchUsername AS NombreUsuario, 
		CASE 
			WHEN P.intIdTipoPersona = 1 THEN P.nvchRazonSocial
			WHEN P.intIdTipoPersona = 2 THEN CONCAT(P.nvchNombres,' ',P.nvchApellidoPaterno,' ',P.nvchApellidoMaterno)
		END AS NombreProveedor, 
		P.*, OC.*
		FROM tb_guia_interna_entrada GIE
		LEFT JOIN tb_usuario U ON GIE.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_orden_compra OC ON GIE.intIdOrdenCompra = OC.intIdOrdenCompra
		LEFT JOIN tb_proveedor P ON OC.intIdProveedor = P.intIdProveedor
		WHERE 
		GIE.intIdGuiaInternaEntrada LIKE CONCAT(_elemento,'%') OR
		P.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		P.nvchNombres LIKE CONCAT(_elemento,'%') OR
		P.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		P.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%') OR
		GIE.dtmFechaCreacion LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARGUIAINTERNAENTRADA_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARGUIAINTERNAENTRADA_II(
    	IN _elemento VARCHAR(600)
    )
	BEGIN
		SELECT GIE.*,U.nvchUsername AS NombreUsuario, 
		CASE 
			WHEN P.intIdTipoPersona = 1 THEN P.nvchRazonSocial
			WHEN P.intIdTipoPersona = 2 THEN CONCAT(P.nvchNombres,' ',P.nvchApellidoPaterno,' ',P.nvchApellidoMaterno)
		END AS NombreProveedor, 
		P.*, OC.*
		FROM tb_guia_interna_entrada GIE
		LEFT JOIN tb_usuario U ON GIE.intIdUsuario = U.intIdUsuario
		LEFT JOIN tb_orden_compra OC ON GIE.intIdOrdenCompra = OC.intIdOrdenCompra
		LEFT JOIN tb_proveedor P ON OC.intIdProveedor = P.intIdProveedor
		WHERE 
		GIE.intIdGUIAINTERNAENTRADA LIKE CONCAT(_elemento,'%') OR
		P.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		P.nvchNombres LIKE CONCAT(_elemento,'%') OR
		P.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		P.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%') OR
		GIE.dtmFechaCreacion LIKE CONCAT(_elemento,'%');
    END 
$$
DELIMITER ;