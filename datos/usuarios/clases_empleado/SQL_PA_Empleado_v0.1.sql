USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTAREMPLEADO;
DELIMITER $$
	CREATE PROCEDURE INSERTAREMPLEADO(
	OUT _intIdEmpleado INT,
	IN _nvchDNI CHAR(8),
	IN _nvchRUC CHAR(11),
    IN _nvchApellidoPaterno VARCHAR(120),
    IN _nvchApellidoMaterno VARCHAR(120),
	IN _nvchNombres VARCHAR(250),
	IN _nvchGenero VARCHAR(25),
	IN _nvchPais VARCHAR(150),
	IN _nvchRegion VARCHAR(150),
	IN _nvchProvincia VARCHAR(150),
	IN _nvchDistrito VARCHAR(150),
	IN _nvchDireccion VARCHAR(450),
	IN _intIdCargo INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		INSERT INTO tb_empleado 
		(nvchDNI,nvchRUC,nvchApellidoPaterno,nvchApellidoMaterno,nvchNombres,nvchGenero,nvchPais,
			nvchRegion,nvchProvincia,nvchDistrito,nvchDireccion,intIdCargo,nvchObservacion)
		VALUES
		(_nvchDNI,_nvchRUC,_nvchApellidoPaterno,_nvchApellidoMaterno,_nvchNombres,_nvchGenero,_nvchPais,
			_nvchRegion,_nvchProvincia,_nvchDistrito,_nvchDireccion,_intIdCargo,_nvchObservacion);
		SET _intIdEmpleado = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZAREMPLEADO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZAREMPLEADO(
	IN _intIdEmpleado INT,
	IN _nvchDNI CHAR(8),
	IN _nvchRUC CHAR(11),
    IN _nvchApellidoPaterno VARCHAR(120),
    IN _nvchApellidoMaterno VARCHAR(120),
	IN _nvchNombres VARCHAR(250),
	IN _nvchGenero VARCHAR(25),
	IN _nvchPais VARCHAR(150),
	IN _nvchRegion VARCHAR(150),
	IN _nvchProvincia VARCHAR(150),
	IN _nvchDistrito VARCHAR(150),
	IN _nvchDireccion VARCHAR(450),
	IN _intIdCargo INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		UPDATE tb_empleado
		SET
		nvchDNI = _nvchDNI,
		nvchRUC = _nvchRUC,
		nvchApellidoPaterno = _nvchApellidoPaterno,
		nvchApellidoMaterno = _nvchApellidoMaterno,
		nvchNombres = _nvchNombres,
		nvchGenero = _nvchGenero,
		nvchPais = _nvchPais,
		nvchRegion = _nvchRegion,
		nvchProvincia = _nvchProvincia,
		nvchDistrito = _nvchDistrito,
		nvchDireccion = _nvchDireccion,
		intIdCargo = _intIdCargo,
		nvchObservacion = _nvchObservacion
		WHERE 
		intIdEmpleado = _intIdEmpleado;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRAREMPLEADO;
DELIMITER $$
	CREATE PROCEDURE MOSTRAREMPLEADO(
    	IN _intIdEmpleado INT
    )
	BEGIN
		SELECT * FROM tb_empleado
		WHERE 
		intIdEmpleado = _intIdEmpleado;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINAREMPLEADO;
DELIMITER $$
	CREATE PROCEDURE ELIMINAREMPLEADO(
    	IN _intIdEmpleado INT
    )
	BEGIN
		DELETE FROM tb_comunicacion_empleado
		WHERE 
		intIdEmpleado = _intIdEmpleado;
		DELETE FROM tb_empleado
		WHERE 
		intIdEmpleado = _intIdEmpleado;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTAREMPLEADO;
DELIMITER $$
	CREATE PROCEDURE LISTAREMPLEADO(
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT * FROM tb_empleado
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOEMPLEADO;
DELIMITER $$
	CREATE PROCEDURE TODOEMPLEADO()
	BEGIN
		SELECT * FROM tb_empleado;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCAREMPLEADO;
DELIMITER $$
	CREATE PROCEDURE BUSCAREMPLEADO(
    	IN _elemento VARCHAR(250),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT * FROM tb_empleado
		WHERE 
		intIdEmpleado LIKE CONCAT(_elemento,'%') OR
		nvchDNI LIKE CONCAT(_elemento,'%') OR
		nvchRUC LIKE CONCAT(_elemento,'%') OR
		nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		nvchNombres LIKE CONCAT(_elemento,'%') OR
		nvchGenero LIKE CONCAT(_elemento,'%') OR
		nvchPais LIKE CONCAT(_elemento,'%') OR
		nvchRegion LIKE CONCAT(_elemento,'%') OR
		nvchProvincia LIKE CONCAT(_elemento,'%') OR
		nvchDistrito LIKE CONCAT(_elemento,'%') OR
		nvchDireccion LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCAREMPLEADO_II;
DELIMITER $$
	CREATE PROCEDURE BUSCAREMPLEADO_II(
    	IN _elemento VARCHAR(250)
    )
	BEGIN
		SELECT * FROM tb_empleado
		WHERE 
		intIdEmpleado LIKE CONCAT(_elemento,'%') OR
		nvchDNI LIKE CONCAT(_elemento,'%') OR
		nvchRUC LIKE CONCAT(_elemento,'%') OR
		nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		nvchNombres LIKE CONCAT(_elemento,'%') OR
		nvchGenero LIKE CONCAT(_elemento,'%') OR
		nvchPais LIKE CONCAT(_elemento,'%') OR
		nvchRegion LIKE CONCAT(_elemento,'%') OR
		nvchProvincia LIKE CONCAT(_elemento,'%') OR
		nvchDistrito LIKE CONCAT(_elemento,'%') OR
		nvchDireccion LIKE CONCAT(_elemento,'%');
    END 
$$
DELIMITER ;