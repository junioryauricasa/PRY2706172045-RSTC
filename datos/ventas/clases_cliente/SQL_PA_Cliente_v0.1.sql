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
	IN _intIdTipoCliente INT,
	IN _nvchObservacion VARCHAR(800)
    )
	BEGIN
		INSERT INTO tb_cliente 
		(nvchDNI,nvchRUC,nvchRazonSocial,nvchApellidoPaterno,nvchApellidoMaterno,nvchNombres,intIdTipoPersona,
			intIdTipoCliente,nvchObservacion)
		VALUES
		(_nvchDNI,_nvchRUC,_nvchRazonSocial,_nvchApellidoPaterno,_nvchApellidoMaterno,_nvchNombres,_intIdTipoPersona,
			_intIdTipoCliente,_nvchObservacion);
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
	IN _intIdTipoCliente INT,
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
		intIdTipoCliente = _intIdTipoCliente,
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
		SELECT CL.*,TCL.intIdTipoCliente, TCL.nvchNombre AS TipoCliente,
		CONCAT(DCL.nvchDireccion,' ',DT.nvchDistrito,' - ',PR.nvchProvincia,' - ',DP.nvchDepartamento) AS nvchDomicilio
		FROM tb_cliente CL
		LEFT JOIN tb_tipo_cliente TCL ON CL.intIdTipoCliente = TCL.intIdTipoCliente
		LEFT JOIN tb_domicilio_cliente DCL ON CL.intIdCliente = DCL.intIdCliente
		LEFT JOIN tb_distritos DT ON DCL.intIdDistrito = DT.intIdDistrito
		LEFT JOIN tb_provincias PR ON DCL.intIdProvincia = PR.intIdProvincia
		LEFT JOIN tb_departamentos DP ON DCL.intIdDepartamento = DP.intIdDepartamento
		WHERE 
		DCL.intIdTipoDomicilio = 1 AND
		CL.intIdCliente = _intIdCliente;
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

DROP PROCEDURE IF EXISTS CONSULTARULTIMOIDCLIENTE;
DELIMITER $$
	CREATE PROCEDURE CONSULTARULTIMOIDCLIENTE()
	BEGIN
		SELECT * FROM tb_cliente
		ORDER BY intIdCliente DESC
		LIMIT 0,1;
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
		SELECT CL.*,TCL.nvchNombre AS TipoCliente FROM tb_cliente CL
		LEFT JOIN tb_tipo_cliente TCL ON TCL.intIdTipoCliente = CL.intIdTipoCliente
		WHERE 
		( CL.intIdCliente LIKE CONCAT(_elemento,'%') OR
		CL.nvchDNI LIKE CONCAT(_elemento,'%') OR
		CL.nvchRUC LIKE CONCAT(_elemento,'%') OR
		CL.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		CL.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		CL.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		CL.nvchNombres LIKE CONCAT(_elemento,'%') ) AND
		CL.intIdTipoPersona = _intIdTipoPersona
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
		SELECT CL.*,TCL.nvchNombre AS TipoCliente FROM tb_cliente CL
		LEFT JOIN tb_tipo_cliente TCL ON TCL.intIdTipoCliente = CL.intIdTipoCliente
		WHERE 
		( CL.intIdCliente LIKE CONCAT(_elemento,'%') OR
		CL.nvchDNI LIKE CONCAT(_elemento,'%') OR
		CL.nvchRUC LIKE CONCAT(_elemento,'%') OR
		CL.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		CL.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		CL.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		CL.nvchNombres LIKE CONCAT(_elemento,'%') ) AND
		CL.intIdTipoPersona = _intIdTipoPersona;
    END 
$$
DELIMITER ;