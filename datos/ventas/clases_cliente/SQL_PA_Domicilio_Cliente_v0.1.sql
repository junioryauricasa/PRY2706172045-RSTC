USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDOMICILIOCLIENTE;
DELIMITER $$
	CREATE PROCEDURE INSERTARDOMICILIOCLIENTE(
	IN _intIdCliente INT,
    IN _nvchPais VARCHAR(150),
    IN _nvchRegion VARCHAR(150),
    IN _nvchProvincia VARCHAR(150),
	IN _nvchDistrito VARCHAR(150),
	IN _nvchDireccion VARCHAR(450),
	IN _intIdTipoDomicilio INT
    )
	BEGIN
		INSERT INTO tb_domicilio_cliente
		(intIdCliente,nvchPais,nvchRegion,nvchProvincia,nvchDistrito,nvchDireccion,intIdTipoDomicilio)
		VALUES
		(_intIdCliente,_nvchPais,_nvchRegion,_nvchProvincia,_nvchDistrito,_nvchDireccion,_intIdTipoDomicilio);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDOMICILIOCLIENTE;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDOMICILIOCLIENTE(
	IN _intIdDomicilioCliente INT,
	IN _intIdCliente INT,
    IN _nvchPais VARCHAR(150),
    IN _nvchRegion VARCHAR(150),
    IN _nvchProvincia VARCHAR(150),
	IN _nvchDistrito VARCHAR(150),
	IN _nvchDireccion VARCHAR(450),
	IN _intIdTipoDomicilio INT
    )
	BEGIN
		UPDATE tb_domicilio_cliente
		SET
		intIdCliente = _intIdCliente,
		nvchPais = _nvchPais,
		nvchRegion = _nvchRegion,
		nvchProvincia = _nvchProvincia,
		nvchDistrito = _nvchDistrito,
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
		SELECT DC.*,TP.nvchNombre as NombreTD FROM tb_domicilio_cliente DC
		LEFT JOIN tb_tipo_domicilio TP ON DC.intIdTipoDomicilio = TP.intIdTipoDomicilio
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