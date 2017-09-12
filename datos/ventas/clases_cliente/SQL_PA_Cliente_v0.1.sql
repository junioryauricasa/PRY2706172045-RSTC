USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARCLIENTE;
DELIMITER $$
	CREATE PROCEDURE INSERTARCLIENTE(
	OUT _intIdCliente INT,
	IN _nvchDNI CHAR(8),
	IN _nvchRUC CHAR(11),
    IN _nvchRazonSocial VARCHAR(250),
    IN _nvchApellidoPaterno VARCHAR(120),
    IN _nvchApellidoMaterno VARCHAR(120),
	IN _nvchNombres VARCHAR(250),
	IN _intIdTipoPersona INT,
	IN _nvchObservacion VARCHAR(800)
    )
	BEGIN
		INSERT INTO tb_cliente 
		(nvchDNI,nvchRUC,nvchRazonSocial,nvchApellidoPaterno,nvchApellidoMaterno,nvchNombres,intIdTipoPersona,
			nvchObservacion)
		VALUES
		(_nvchDNI,_nvchRUC,_nvchRazonSocial,_nvchApellidoPaterno,_nvchApellidoMaterno,_nvchNombres,_intIdTipoPersona,
			_nvchObservacion);
		SET _intIdCliente = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARCLIENTE;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARCLIENTE(
	IN _intIdCliente INT,
	IN _nvchDNI CHAR(8),
	IN _nvchRUC CHAR(11),
    IN _nvchRazonSocial VARCHAR(250),
    IN _nvchApellidoPaterno VARCHAR(120),
    IN _nvchApellidoMaterno VARCHAR(120),
	IN _nvchNombres VARCHAR(250),
	IN _intIdTipoPersona INT,
	IN _nvchObservacion VARCHAR(800)
    )
	BEGIN
		UPDATE tb_cliente
		SET
		nvchDNI = _nvchDNI,
		nvchRUC = _nvchRUC,
		nvchRazonSocial = _nvchRazonSocial,
		nvchApellidoPaterno = _nvchApellidoPaterno,
		nvchApellidoMaterno = _nvchApellidoMaterno,
		nvchNombres = _nvchNombres,
		intIdTipoPersona = _intIdTipoPersona,
		nvchObservacion = _nvchObservacion
		WHERE 
		intIdCliente = _intIdCliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARCLIENTE;
DELIMITER $$
	CREATE PROCEDURE MOSTRARCLIENTE(
    	IN _intIdCliente INT
    )
	BEGIN
		SELECT * FROM tb_cliente
		WHERE 
		intIdCliente = _intIdCliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARCLIENTE;
DELIMITER $$
	CREATE PROCEDURE ELIMINARCLIENTE(
    	IN _intIdCliente INT
    )
	BEGIN
		DELETE FROM tb_comunicacion_cliente
		WHERE 
		intIdCliente = _intIdCliente;
		DELETE FROM tb_domicilio_cliente
		WHERE 
		intIdCliente = _intIdCliente;
		DELETE FROM tb_cliente
		WHERE 
		intIdCliente = _intIdCliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARCLIENTE;
DELIMITER $$
	CREATE PROCEDURE LISTARCLIENTE(
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT * FROM tb_cliente
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOCLIENTE;
DELIMITER $$
	CREATE PROCEDURE TODOCLIENTE()
	BEGIN
		SELECT * FROM tb_cliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARCLIENTE;
DELIMITER $$
	CREATE PROCEDURE BUSCARCLIENTE(
    	IN _elemento VARCHAR(250),
		IN _x INT,
		IN _y INT,
		IN _intIdTipoPersona INT
    )
	BEGIN
		SELECT * FROM tb_cliente
		WHERE 
		( intIdCliente LIKE CONCAT(_elemento,'%') OR
		nvchDNI LIKE CONCAT(_elemento,'%') OR
		nvchRUC LIKE CONCAT(_elemento,'%') OR
		nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		nvchNombres LIKE CONCAT(_elemento,'%') ) AND
		intIdTipoPersona = _intIdTipoPersona
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARCLIENTE_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARCLIENTE_II(
    	IN _elemento VARCHAR(250),
    	IN _intIdTipoPersona INT
    )
	BEGIN
		SELECT * FROM tb_cliente
		WHERE 
		( intIdCliente LIKE CONCAT(_elemento,'%') OR
		nvchDNI LIKE CONCAT(_elemento,'%') OR
		nvchRUC LIKE CONCAT(_elemento,'%') OR
		nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		nvchNombres LIKE CONCAT(_elemento,'%') ) AND
		intIdTipoPersona = _intIdTipoPersona;
    END 
$$
DELIMITER ;