USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARCOMUNICACIONCLIENTE;
DELIMITER $$
	CREATE PROCEDURE INSERTARCOMUNICACIONCLIENTE(
	IN _intIdCliente INT,
    IN _nvchMedio VARCHAR(100),
    IN _nvchLugar VARCHAR(550),
	IN _intIdTipoComunicacion INT
    )
	BEGIN
		INSERT INTO tb_comunicacion_cliente
		(intIdCliente,nvchMedio,nvchLugar,intIdTipoComunicacion)
		VALUES
		(_intIdCliente,_nvchMedio,_nvchLugar,_intIdTipoComunicacion);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARCOMUNICACIONCLIENTE;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARCOMUNICACIONCLIENTE(
	IN _intIdComunicacionCliente INT,
	IN _intIdCliente INT,
    IN _nvchMedio VARCHAR(100),
    IN _nvchLugar VARCHAR(550),
	IN _intIdTipoComunicacion INT
    )
	BEGIN
		UPDATE tb_comunicacion_cliente
		SET
		intIdCliente = _intIdCliente,
		nvchMedio = _nvchMedio,
		nvchLugar = _nvchLugar,
		intIdTipoComunicacion = _intIdTipoComunicacion
		WHERE 
		intIdComunicacionCliente = _intIdComunicacionCliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARCOMUNICACIONCLIENTE;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARCOMUNICACIONCLIENTE(
    	IN _intIdComunicacionCliente INT
    )
	BEGIN
		SELECT * FROM tb_comunicacion_cliente
		WHERE 
		intIdComunicacionCliente = _intIdComunicacionCliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARCOMUNICACIONCLIENTE;
DELIMITER $$
	CREATE PROCEDURE ELIMINARCOMUNICACIONCLIENTE(
    	IN _intIdComunicacionCliente INT
    )
	BEGIN
		DELETE FROM tb_comunicacion_cliente
		WHERE 
		intIdComunicacionCliente = _intIdComunicacionCliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARCOMUNICACIONESCLIENTE;
DELIMITER $$
	CREATE PROCEDURE MOSTRARCOMUNICACIONESCLIENTE(
    	IN _intIdCliente INT
    )
	BEGIN
		SELECT CC.*,TC.nvchNombre AS NombreTC FROM tb_comunicacion_cliente CC
		LEFT JOIN tb_tipo_comunicacion TC ON CC.intIdTipoComunicacion = TC.intIdTipoComunicacion
		WHERE 
		intIdCliente = _intIdCliente;
    END 
$$
DELIMITER ;