USE db_resteco;

DROP PROCEDURE IF EXISTS MOSTRARHISTORIALACCESO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARHISTORIALACCESO(
    	IN _intIdHistorialAcceso INT
    )
	BEGIN
		SELECT * FROM tb_historial_acceso 
		WHERE 
		intIdHistorialAcceso = _intIdHistorialAcceso;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARHISTORIALACCESO;
DELIMITER $$
	CREATE PROCEDURE LISTARHISTORIALACCESO(IN _x INT,IN _y INT)
	BEGIN
		SELECT * FROM tb_historial_acceso  
 		LIMIT _x,_y;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOHISTORIALACCESO;
DELIMITER $$
	CREATE PROCEDURE TODOHISTORIALACCESO()
	BEGIN
		SELECT * FROM tb_historial_acceso;
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
		SELECT * FROM tb_historial_acceso 
		WHERE 
			intIdHistorialAcceso LIKE CONCAT('%',_elemento,'%') OR 
			intIdUsuario LIKE CONCAT('%',_elemento,'%') OR 
			dtmFechaAcceso LIKE CONCAT('%',_elemento,'%') OR 
			nvchIpOrigen LIKE CONCAT('%',_elemento,'%') OR 
			nvchNavegador LIKE CONCAT('%',_elemento,'%') 
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
		SELECT * FROM tb_historial_acceso 
		WHERE 
			intIdHistorialAcceso LIKE CONCAT('%',_elemento,'%') OR 
			intIdUsuario LIKE CONCAT('%',_elemento,'%') OR 
			dtmFechaAcceso LIKE CONCAT('%',_elemento,'%') OR 
			nvchIpOrigen LIKE CONCAT('%',_elemento,'%') OR 
			nvchNavegador LIKE CONCAT('%',_elemento,'%');
    	END 
$$
DELIMITER ;