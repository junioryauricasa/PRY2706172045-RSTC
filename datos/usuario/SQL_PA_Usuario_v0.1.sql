USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARUSUARIO;
DELIMITER $$
	CREATE PROCEDURE INSERTARUSUARIO(
	IN _nvchUserName VARCHAR(50),
	IN _nchUserMail VARCHAR(25),
	IN _nvchUserPassword VARCHAR(1000),
	IN _intIdEmpleado INT(11),
	IN _intTypeUser INT(11),
	IN _bitUserEstado INT(11)
    )
	BEGIN
		INSERT INTO tb_usuario(
			nvchUserName,
			nchUserMail,
			nvchUserPassword,
			intIdEmpleado,
			intTypeUser,
			bitUserEstado
			)
		VALUES(
			_nvchUserName,
			_nchUserMail,
			_nvchUserPassword,
			_intIdEmpleado,
			_intTypeUser,
			_bitUserEstado
			);
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARUSUARIO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARUSUARIO(
	IN _intUserId INT(11),
	IN _nvchUserName VARCHAR(50),
	IN _nchUserMail VARCHAR(25),
	IN _nvchUserPassword VARCHAR(1000),
	IN _intIdEmpleado INT(11),
	IN _intTypeUser INT(11),
	IN _bitUserEstado INT(11)
    )
	BEGIN
		UPDATE tb_usuario
		SET
			nvchUserName = _nvchUserName,
			nchUserMail = _nchUserMail,
			nvchUserPassword = _nvchUserPassword,
			intIdEmpleado = _intIdEmpleado,
			intTypeUser = _intTypeUser,
			bitUserEstado = _bitUserEstado 
		WHERE intUserId = _intUserId;
    	END 
$$
DELIMITER ;


/*
	LISTAR USUARIO
*/

DROP PROCEDURE IF EXISTS MOSTRARUSUARIO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARUSUARIO(
    	IN _intUserId INT
    )
	BEGIN
		SELECT * FROM tb_usuario 
		WHERE 
		intUserId = _intUserId;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARUSUARIO;
DELIMITER $$
	CREATE PROCEDURE ELIMINARUSUARIO(
    	IN _intUserId INT
    )
	BEGIN
		DELETE FROM tb_usuario 
		WHERE 
		intUserId = _intUserId;
    	END 
$$
DELIMITER ;


/*

*/
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
/*
*/

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
			intUserId LIKE CONCAT(_elemento,'%') OR 
			nvchUserName LIKE CONCAT(_elemento,'%') OR 
			nchUserMail LIKE CONCAT(_elemento,'%') OR 
			intIdEmpleado LIKE CONCAT(_elemento,'%') OR 
			intTypeUser LIKE CONCAT(_elemento,'%') OR 
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
			intUserId LIKE CONCAT(_elemento,'%') OR 
			nvchUserName LIKE CONCAT(_elemento,'%') OR 
			nchUserMail LIKE CONCAT(_elemento,'%') OR 
			intIdEmpleado LIKE CONCAT(_elemento,'%') OR 
			intTypeUser LIKE CONCAT(_elemento,'%') OR 
			bitUserEstado LIKE CONCAT(_elemento,'%');
    	END 
$$
DELIMITER ;