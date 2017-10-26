USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDOMICILIOCLIENTE;
DELIMITER $$
	CREATE PROCEDURE INSERTARDOMICILIOCLIENTE(
	IN _intIdCliente INT,
    IN _nvchPais VARCHAR(150),
    IN _intIdDepartamento INT,
    IN _intIdProvincia INT,
	IN _intIdDistrito INT,
	IN _nvchDireccion VARCHAR(450),
	IN _intIdTipoDomicilio INT
    )
	BEGIN
		INSERT INTO tb_domicilio_cliente
		(intIdCliente,nvchPais,intIdDepartamento,intIdProvincia,intIdDistrito,nvchDireccion,intIdTipoDomicilio)
		VALUES
		(_intIdCliente,_nvchPais,_intIdDepartamento,_intIdProvincia,_intIdDistrito,_nvchDireccion,_intIdTipoDomicilio);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDOMICILIOCLIENTE;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDOMICILIOCLIENTE(
	IN _intIdDomicilioCliente INT,
	IN _intIdCliente INT,
    IN _nvchPais VARCHAR(150),
    IN _intIdDepartamento INT,
    IN _intIdProvincia INT,
	IN _intIdDistrito INT,
	IN _nvchDireccion VARCHAR(450),
	IN _intIdTipoDomicilio INT
    )
	BEGIN
		UPDATE tb_domicilio_cliente
		SET
		intIdCliente = _intIdCliente,
		nvchPais = _nvchPais,
		intIdDepartamento = _intIdDepartamento,
		intIdProvincia = _intIdProvincia,
		intIdDistrito = _intIdDistrito,
		nvchDireccion = _nvchDireccion,
		intIdTipoDomicilio = _intIdTipoDomicilio
		WHERE 
		intIdDomicilioCliente = _intIdDomicilioCliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARDOMICILIOCLIENTE;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARDOMICILIOCLIENTE(
    	IN _intIdDomicilioCliente INT
    )
	BEGIN
		SELECT * FROM tb_domicilio_cliente
		WHERE 
		intIdDomicilioCliente = _intIdDomicilioCliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDOMICILIOCLIENTE;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDOMICILIOCLIENTE(
    	IN _intIdDomicilioCliente INT
    )
	BEGIN
		DELETE FROM tb_domicilio_cliente
		WHERE 
		intIdDomicilioCliente = _intIdDomicilioCliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDOMICILIOSCLIENTE;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDOMICILIOSCLIENTE(
    	IN _intIdCliente INT
    )
	BEGIN
		SELECT DC.*,TP.nvchNombre AS NombreTD,DP.nvchDepartamento,P.nvchProvincia,DT.nvchDistrito 
		FROM tb_domicilio_cliente DC
		LEFT JOIN tb_tipo_domicilio TP ON DC.intIdTipoDomicilio = TP.intIdTipoDomicilio
		LEFT JOIN tb_departamentos DP ON DC.intIdDepartamento = DP.intIdDepartamento
		LEFT JOIN tb_provincias P ON DC.intIdProvincia = P.intIdProvincia 
		LEFT JOIN tb_distritos DT ON DC.intIdDistrito = DT.intIdDistrito 
		WHERE 
		DC.intIdCliente = _intIdCliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDOMICILIOSCLIENTE;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDOMICILIOSCLIENTE(
    	IN _intIdCliente INT
    )
	BEGIN
		DELETE FROM tb_domicilio_cliente
		WHERE 
		intIdCliente = _intIdCliente;
    END 
$$
DELIMITER ;