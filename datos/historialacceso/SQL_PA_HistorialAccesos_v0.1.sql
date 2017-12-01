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
		SELECT HA.*,CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario 
		FROM tb_historial_acceso HA
		LEFT JOIN tb_usuario U ON HA.intIdUsuario = U.intIdUsuario
		WHERE 
			U.nvchNombres LIKE CONCAT(_elemento,'%') OR 
			U.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			U.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR 
			HA.nvchFechaAcceso LIKE CONCAT(_elemento,'%') OR 
			HA.nvchIpOrigen LIKE CONCAT(_elemento,'%') OR 
			HA.nvchNavegador LIKE CONCAT(_elemento,'%')
		ORDER BY HA.intIdHistorialAcceso DESC
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
		SELECT HA.*, CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario 
		FROM tb_historial_acceso HA
		LEFT JOIN tb_usuario U ON HA.intIdUsuario = U.intIdUsuario
		WHERE 
			U.nvchNombres LIKE CONCAT(_elemento,'%') OR 
			U.nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
			U.nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR 
			HA.nvchFechaAcceso LIKE CONCAT(_elemento,'%') OR 
			HA.nvchIpOrigen LIKE CONCAT(_elemento,'%') OR 
			HA.nvchNavegador LIKE CONCAT(_elemento,'%')
		ORDER BY HA.intIdHistorialAcceso DESC;
    	END 
$$
DELIMITER ;