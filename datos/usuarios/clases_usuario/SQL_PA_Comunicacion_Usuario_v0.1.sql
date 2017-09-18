USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARCOMUNICACIONUSUARIO;
DELIMITER $$
	CREATE PROCEDURE INSERTARCOMUNICACIONUSUARIO(
	IN _intIdUsuario INT,
    IN _nvchMedio VARCHAR(100),
    IN _nvchLugar VARCHAR(550),
	IN _intIdTipoComunicacion INT
    )
	BEGIN
		INSERT INTO tb_comunicacion_usuario
		(intIdUsuario,nvchMedio,nvchLugar,intIdTipoComunicacion)
		VALUES
		(_intIdUsuario,_nvchMedio,_nvchLugar,_intIdTipoComunicacion);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARCOMUNICACIONUSUARIO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARCOMUNICACIONUSUARIO(
	IN _intIdComunicacionUsuario INT,
	IN _intIdUsuario INT,
    IN _nvchMedio VARCHAR(100),
    IN _nvchLugar VARCHAR(550),
	IN _intIdTipoComunicacion INT
    )
	BEGIN
		UPDATE tb_comunicacion_usuario
		SET
		intIdUsuario = _intIdUsuario,
		nvchMedio = _nvchMedio,
		nvchLugar = _nvchLugar,
		intIdTipoComunicacion = _intIdTipoComunicacion
		WHERE 
		intIdComunicacionUsuario = _intIdComunicacionUsuario;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARCOMUNICACIONUSUARIO;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARCOMUNICACIONUSUARIO(
    	IN _intIdComunicacionUsuario INT
    )
	BEGIN
		SELECT * FROM tb_comunicacion_usuario
		WHERE 
		intIdComunicacionUsuario = _intIdComunicacionUsuario;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARCOMUNICACIONUSUARIO;
DELIMITER $$
	CREATE PROCEDURE ELIMINARCOMUNICACIONUSUARIO(
    	IN _intIdComunicacionUsuario INT
    )
	BEGIN
		DELETE FROM tb_comunicacion_usuario
		WHERE 
		intIdComunicacionUsuario = _intIdComunicacionUsuario;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARCOMUNICACIONESUSUARIO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARCOMUNICACIONESUSUARIO(
    	IN _intIdUsuario INT
    )
	BEGIN
		SELECT CU.*,TC.nvchNombre AS NombreTC FROM tb_comunicacion_usuario CU
		LEFT JOIN tb_tipo_comunicacion TC ON CU.intIdTipoComunicacion = TC.intIdTipoComunicacion
		WHERE 
		intIdUsuario = _intIdUsuario;
    END 
$$
DELIMITER ;