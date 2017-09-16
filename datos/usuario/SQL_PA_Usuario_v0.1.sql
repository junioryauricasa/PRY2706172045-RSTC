USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARUSUARIO;
DELIMITER $$
	CREATE PROCEDURE INSERTARUSUARIO(
	OUT _intIdUsuario INT,
	IN _nvchDNI VARCHAR(8),
	IN _nvchRUC VARCHAR(11),
    IN _nvchApellidoPaterno VARCHAR(120),
    IN _nvchApellidoMaterno VARCHAR(120),
	IN _nvchNombres VARCHAR(250),
	IN _nvchGenero VARCHAR(25),
	IN _nvchUserName VARCHAR(50),
	IN _nvchUserPassword VARCHAR(1000),
	IN _intIdTipoUsuario INT,
	IN _bitUserEstado INT,
	IN _nvchPais VARCHAR(150),
    IN _nvchRegion VARCHAR(150),
    IN _nvchProvincia VARCHAR(150),
	IN _nvchDistrito VARCHAR(150),
	IN _nvchDireccion VARCHAR(450),
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		INSERT INTO tb_usuario(nvchDNI,nvchRUC,nvchApellidoPaterno,nvchApellidoMaterno,nvchNombres,nvchGenero,nvchUserName,
			nvchUserPassword,intIdTipoUsuario,bitUserEstado,nvchPais,nvchRegion,nvchProvincia,nvchDistrito,nvchDireccion,
			nvchObservacion)
		VALUES(_nvchDNI,_nvchRUC,_nvchApellidoPaterno,_nvchApellidoMaterno,_nvchNombres,_nvchGenero,_nvchUserName,_nvchUserPassword,
			_intIdTipoUsuario,_bitUserEstado,_nvchPais,_nvchRegion,_nvchProvincia,_nvchDistrito,_nvchDireccion,_nvchObservacion);
    	SET _intIdUsuario = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARUSUARIO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARUSUARIO(
	IN _intIdUsuario INT,
	IN _nvchDNI VARCHAR(8),
	IN _nvchRUC VARCHAR(11),
    IN _nvchApellidoPaterno VARCHAR(120),
    IN _nvchApellidoMaterno VARCHAR(120),
	IN _nvchNombres VARCHAR(250),
	IN _nvchGenero VARCHAR(25),
	IN _nvchUserName VARCHAR(50),
	IN _nvchUserPassword VARCHAR(1000),
	IN _intIdTipoUsuario INT,
	IN _bitUserEstado INT,
	IN _nvchPais VARCHAR(150),
    IN _nvchRegion VARCHAR(150),
    IN _nvchProvincia VARCHAR(150),
	IN _nvchDistrito VARCHAR(150),
	IN _nvchDireccion VARCHAR(450),
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		UPDATE tb_usuario
		SET
			nvchDNI = _nvchDNI,
			nvchRUC = _nvchRUC,
			nvchRazonSocial = _nvchRazonSocial,
			nvchApellidoPaterno = _nvchApellidoPaterno,
			nvchApellidoMaterno = _nvchApellidoMaterno,
			nvchNombres = _nvchNombres,
			nvchGenero = _nvchGenero,
			nvchUserName = _nvchUserName,
			nvchUserPassword = _nvchUserPassword,
			intIdTipoUsuario = _intIdTipoUsuario,
			bitUserEstado = _bitUserEstado,
			nvchPais = _nvchPais,
			nvchRegion = _nvchRegion,
			nvchProvincia = _nvchProvincia,
			nvchDistrito = _nvchDistrito,
			nvchDireccion = _nvchDireccion
		WHERE intIdUsuario = _intIdUsuario;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARUSUARIO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARUSUARIO(
    	IN _intIdUsuario INT
    )
	BEGIN
		SELECT * FROM tb_usuario 
		WHERE 
		intIdUsuario = _intIdUsuario;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARUSUARIO;
DELIMITER $$
	CREATE PROCEDURE ELIMINARUSUARIO(
    	IN _intIdUsuario INT
    )
	BEGIN
		DELETE FROM tb_usuario 
		WHERE 
		intIdUsuario = _intIdUsuario;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARUSUARIO;
DELIMITER $$
	CREATE PROCEDURE LISTARUSUARIO(IN _x INT,IN _y INT)
	BEGIN
		SELECT * FROM tb_usuario  
 		LIMIT _x,_y;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOUSUARIO;
DELIMITER $$
	CREATE PROCEDURE TODOUSUARIO()
	BEGIN
		SELECT * FROM tb_usuario;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARUSUARIO;
DELIMITER $$
	CREATE PROCEDURE BUSCARUSUARIO(
    	IN _elemento VARCHAR(500),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT * FROM tb_usuario 
		WHERE 
			nvchDNI LIKE CONCAT(_elemento,'%') OR
			nvchRUC LIKE CONCAT(_elemento,'%') OR
			nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
			nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
			nvchNombres LIKE CONCAT(_elemento,'%') OR
			nvchGenero LIKE CONCAT(_elemento,'%') OR
			nvchUserName LIKE CONCAT(_elemento,'%') OR
			nvchUserPassword LIKE CONCAT(_elemento,'%') OR
			bitUserEstado LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARUSUARIO_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARUSUARIO_II(
    	IN _elemento VARCHAR(500)
    )
	BEGIN
		SELECT * FROM tb_usuario 
		WHERE 
			nvchDNI LIKE CONCAT(_elemento,'%') OR
			nvchRUC LIKE CONCAT(_elemento,'%') OR
			nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
			nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
			nvchNombres LIKE CONCAT(_elemento,'%') OR
			nvchGenero LIKE CONCAT(_elemento,'%') OR
			nvchUserName LIKE CONCAT(_elemento,'%') OR
			nvchUserPassword LIKE CONCAT(_elemento,'%') OR
			bitUserEstado LIKE CONCAT(_elemento,'%');
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS INSERTARIMAGENUSUARIO;
DELIMITER $$
	CREATE PROCEDURE INSERTARIMAGENUSUARIO(
	IN _intIdUsuario INT,
	IN _nvchImgPerfil VARCHAR(250)
    )
	BEGIN
		UPDATE tb_usuario
		SET
			nvchImgPerfil = _nvchImgPerfil 
		WHERE intIdUsuario = _intIdUsuario;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS VERIFICARUSUARIO;
DELIMITER $$
	CREATE PROCEDURE VERIFICARUSUARIO(
	IN _nvchUserName VARCHAR(50)
    )
	BEGIN
		SELECT * FROM tb_usuario
		WHERE
		nvchUserName = _nvchUserName;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS VERIFICARPASSWORD;
DELIMITER $$
	CREATE PROCEDURE VERIFICARPASSWORD(
	IN _nvchUserName VARCHAR(50),
	IN _nvchUserPassword VARCHAR(1000)
    )
	BEGIN
		SELECT * FROM tb_usuario
		WHERE
		nvchUserName = _nvchUserName AND nvchUserPassword = _nvchUserPassword;
    END 
$$
DELIMITER ;