USE db_resteco;

/*
	LISTAR historial acceso
*/
DROP PROCEDURE IF EXISTS MOSTRARHISTORIALACCESO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARHISTORIALACCESO(
    	IN _intIdHistory INT
    )
	BEGIN
		SELECT * FROM tb_historyaccess 
		WHERE 
		intIdHistory = _intIdHistory;
    	END 
$$
DELIMITER ;


/*

*/
DROP PROCEDURE IF EXISTS LISTARHISTORIALACCESO;
DELIMITER $$
	CREATE PROCEDURE LISTARHISTORIALACCESO(IN _x INT,IN _y INT)
	BEGIN
		SELECT * FROM tb_historyaccess  
 		LIMIT _x,_y;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOHISTORIALACCESO;
DELIMITER $$
	CREATE PROCEDURE TODOHISTORIALACCESO()
	BEGIN
		SELECT * FROM tb_historyaccess;
    	END 
$$
DELIMITER ;
/*
*/

DROP PROCEDURE IF EXISTS BUSCARHISTORIALACCESO;
DELIMITER $$
	CREATE PROCEDURE BUSCARHISTORIALACCESO(
    	IN _elemento VARCHAR(500),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT * FROM tb_historyaccess 
		WHERE 
			intIdHistory LIKE CONCAT('%',_elemento,'%') OR 
			intIdUser LIKE CONCAT('%',_elemento,'%') OR 
			dateDateAccesso LIKE CONCAT('%',_elemento,'%') OR 
			nvchIpAccesso LIKE CONCAT('%',_elemento,'%') OR 
			nvchBrowser LIKE CONCAT('%',_elemento,'%') 
		LIMIT _x,_y;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARHISTORIALACCESO_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARHISTORIALACCESO_II(
    	IN _elemento VARCHAR(500)
    )
	BEGIN
		SELECT * FROM tb_historyaccess 
		WHERE 
			intIdHistory LIKE CONCAT('%',_elemento,'%') OR 
			intIdUser LIKE CONCAT('%',_elemento,'%') OR 
			dateDateAccesso LIKE CONCAT('%',_elemento,'%') OR 
			nvchIpAccesso LIKE CONCAT('%',_elemento,'%') OR 
			nvchBrowser LIKE CONCAT('%',_elemento,'%');
    	END 
$$
DELIMITER ;