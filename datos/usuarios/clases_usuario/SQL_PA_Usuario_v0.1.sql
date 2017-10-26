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
	IN _nvchImgPerfil VARCHAR(500),
	IN _bitUserEstado INT,
	IN _nvchPais VARCHAR(150),
    IN _intIdDepartamento INT,
    IN _intIdProvincia INT,
	IN _intIdDistrito INT,
	IN _nvchDireccion VARCHAR(450),
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		INSERT INTO tb_usuario(nvchDNI,nvchRUC,nvchApellidoPaterno,nvchApellidoMaterno,nvchNombres,nvchGenero,nvchUserName,
			nvchUserPassword,intIdTipoUsuario,nvchImgPerfil,bitUserEstado,nvchPais,intIdDepartamento,intIdProvincia,intIdDistrito,nvchDireccion,
			nvchObservacion)
		VALUES(_nvchDNI,_nvchRUC,_nvchApellidoPaterno,_nvchApellidoMaterno,_nvchNombres,_nvchGenero,_nvchUserName,_nvchUserPassword,
			_intIdTipoUsuario,_nvchImgPerfil,_bitUserEstado,_nvchPais,_intIdDepartamento,_intIdProvincia,_intIdDistrito,_nvchDireccion,_nvchObservacion);
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
	IN _intIdTipoUsuario INT,
	IN _nvchImgPerfil VARCHAR(500),
	IN _bitUserEstado INT,
	IN _nvchPais VARCHAR(150),
    IN _intIdDepartamento INT,
    IN _intIdProvincia INT,
	IN _intIdDistrito INT,
	IN _nvchDireccion VARCHAR(450),
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		UPDATE tb_usuario
		SET
			nvchDNI = _nvchDNI,
			nvchRUC = _nvchRUC,
			nvchApellidoPaterno = _nvchApellidoPaterno,
			nvchApellidoMaterno = _nvchApellidoMaterno,
			nvchNombres = _nvchNombres,
			nvchGenero = _nvchGenero,
			nvchUserName = _nvchUserName,
			intIdTipoUsuario = _intIdTipoUsuario,
			nvchImgPerfil = _nvchImgPerfil,
			bitUserEstado = _bitUserEstado,
			nvchPais = _nvchPais,
			intIdDepartamento = _intIdDepartamento,
			intIdProvincia = _intIdProvincia,
			intIdDistrito = _intIdDistrito,
			nvchDireccion = _nvchDireccion,
			nvchObservacion = _nvchObservacion
		WHERE intIdUsuario = _intIdUsuario;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARUSUARIOPERFIL;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARUSUARIOPERFIL(
	IN _intIdUsuario INT,
	IN _nvchDNI VARCHAR(8),
	IN _nvchRUC VARCHAR(11),
    IN _nvchApellidoPaterno VARCHAR(120),
    IN _nvchApellidoMaterno VARCHAR(120),
	IN _nvchNombres VARCHAR(250),
	IN _nvchGenero VARCHAR(25),
	IN _nvchPais VARCHAR(150),
    IN _intIdDepartamento INT,
    IN _intIdProvincia INT,
	IN _intIdDistrito INT,
	IN _nvchDireccion VARCHAR(450)
    )
	BEGIN
		UPDATE tb_usuario
		SET
			nvchDNI = _nvchDNI,
			nvchRUC = _nvchRUC,
			nvchApellidoPaterno = _nvchApellidoPaterno,
			nvchApellidoMaterno = _nvchApellidoMaterno,
			nvchNombres = _nvchNombres,
			nvchGenero = _nvchGenero,
			nvchPais = _nvchPais,
			intIdDepartamento = _intIdDepartamento,
			intIdProvincia = _intIdProvincia,
			intIdDistrito = _intIdDistrito,
			nvchDireccion = _nvchDireccion
		WHERE intIdUsuario = _intIdUsuario;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARIMAGENPERFIL;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARIMAGENPERFIL(
	IN _intIdUsuario INT,
	IN _nvchImgPerfil VARCHAR(500)
    )
	BEGIN
		UPDATE tb_usuario
		SET
			nvchImgPerfil = _nvchImgPerfil
		WHERE intIdUsuario = _intIdUsuario;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARPASSWORD;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARPASSWORD(
	IN _intIdUsuario INT,
	IN _nvchUserPassword VARCHAR(1000),
    )
	BEGIN
		UPDATE tb_usuario
		SET
		nvchUserPassword = _nvchUserPassword,
		WHERE 
		intIdUsuario = _intIdUsuario;
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
		SELECT U.*,
		CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombresApellidos,
		TU.nvchNombre AS NombreTipoUsuario
		FROM tb_usuario U
		LEFT JOIN tb_tipo_usuario TU ON U.intIdTipoUsuario = TU.intIdTipoUsuario
		WHERE 
			U.nvchDNI LIKE CONCAT(_elemento,'%') OR
			U.nvchRUC LIKE CONCAT(_elemento,'%') OR
			U.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			U.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
			U.nvchNombres LIKE CONCAT(_elemento,'%') OR
			U.nvchGenero LIKE CONCAT(_elemento,'%') OR
			U.nvchUserName LIKE CONCAT(_elemento,'%') OR
			TU.nvchNombre LIKE CONCAT(_elemento,'%')
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
		SELECT U.*,
		CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombresApellidos,
		TU.nvchNombre AS NombreTipoUsuario
		FROM tb_usuario U
		LEFT JOIN tb_tipo_usuario TU ON U.intIdTipoUsuario = TU.intIdTipoUsuario
		WHERE 
			U.nvchDNI LIKE CONCAT(_elemento,'%') OR
			U.nvchRUC LIKE CONCAT(_elemento,'%') OR
			U.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			U.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
			U.nvchNombres LIKE CONCAT(_elemento,'%') OR
			U.nvchGenero LIKE CONCAT(_elemento,'%') OR
			U.nvchUserName LIKE CONCAT(_elemento,'%') OR
			TU.nvchNombre LIKE CONCAT(_elemento,'%');
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

DROP PROCEDURE IF EXISTS VERIFICARPASSWORDPERFIL;
DELIMITER $$
	CREATE PROCEDURE VERIFICARPASSWORDPERFIL(
	IN _intIdUsuario INT,
	IN _nvchUserPasswordAnt VARCHAR(1000)
    )
	BEGIN
		SELECT * FROM tb_usuario
		WHERE
		intIdUsuario = _intIdUsuario AND nvchUserPassword = _nvchUserPasswordAnt;
    END 
$$
DELIMITER ;