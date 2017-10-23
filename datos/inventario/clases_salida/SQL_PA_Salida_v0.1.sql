USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARENTRADA;
DELIMITER $$
	CREATE PROCEDURE INSERTARENTRADA(
	OUT _intIdSalida INT,
	IN _dtmFechaCreacion DATETIME,
	IN _intIdCliente INT,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(10),
	IN _nvchRazonSocial VARCHAR(150),
	IN _nvchRUC VARCHAR(15),
	IN _nvchAtencion VARCHAR(150),
	IN _nvchDestino VARCHAR(150),
	IN _nvchDireccion VARCHAR(150),
	IN _intIdUsuario INT,
	IN _nvchObservacion VARCHAR(2500),
	IN _bitEstado INT,
	IN _intIdSucursal INT
    )
	BEGIN
		INSERT INTO tb_salida 
		(dtmFechaCreacion,intIdCliente,nvchSerie,nvchNumeracion,nvchRazonSocial,nvchRUC,nvchAtencion,nvchDestino,nvchDireccion,intIdUsuario,
			nvchObservacion,bitEstado,intIdSucursal)
		VALUES
		(_dtmFechaCreacion,_intIdCliente,_nvchSerie,_nvchNumeracion,_nvchRazonSocial,_nvchRUC,_nvchAtencion,_nvchDestino,_nvchDireccion,
			_intIdUsuario,_nvchObservacion,_bitEstado,_intIdSucursal);
		SET _intIdSalida = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARENTRADA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARENTRADA(
	IN _intIdSalida INT,
	IN _dtmFechaCreacion DATETIME,
	IN _intIdCliente INT,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(10),
	IN _nvchRazonSocial VARCHAR(150),
	IN _nvchRUC VARCHAR(15),
	IN _nvchAtencion VARCHAR(150),
	IN _nvchDestino VARCHAR(150),
	IN _nvchDireccion VARCHAR(150),
	IN _intIdUsuario INT,
	IN _nvchObservacion VARCHAR(2500),
	IN _bitEstado INT,
	IN _intIdSucursal INT
    )
	BEGIN
		UPDATE tb_salida
		SET
		dtmFechaCreacion = _dtmFechaCreacion,
		intIdCliente = _intIdCliente,
		nvchSerie = _nvchSerie,
		nvchNumeracion = _nvchNumeracion,
		nvchRazonSocial = _nvchRazonSocial,
		nvchRUC = _nvchRUC,
		nvchAtencion = _nvchAtencion,
		nvchDestino = _nvchDestino,
		nvchDireccion = _nvchDireccion,
		intIdUsuario = _intIdUsuario,
		nvchObservacion = _nvchObservacion,
		bitEstado = _bitEstado,
		intIdSucursal = _intIdSucursal
		WHERE 
		intIdSalida = _intIdSalida;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARENTRADA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARENTRADA(
    	IN _intIdSalida INT
    )
	BEGIN
		SELECT S.*,
		U.nvchUsername AS NombreUsuario
		FROM tb_salida S
		LEFT JOIN tb_usuario U ON S.intIdUsuario = U.intIdUsuario
		WHERE 
		S.intIdSalida = _intIdSalida;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARENTRADA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARENTRADA(
    	IN _intIdSalida INT
    )
	BEGIN
		DELETE FROM tb_salida
		WHERE 
		intIdSalida = _intIdSalida;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARENTRADA;
DELIMITER $$
	CREATE PROCEDURE LISTARENTRADA(
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT S.*,U.nvchUsername AS NombreUsuario
		FROM tb_salida S
		LEFT JOIN tb_usuario U ON S.intIdUsuario = U.intIdUsuario
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARENTRADA;
DELIMITER $$
	CREATE PROCEDURE BUSCARENTRADA(
    	IN _elemento VARCHAR(600),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT S.*,U.nvchUsername AS NombreUsuario
		FROM tb_salida S
		LEFT JOIN tb_usuario U ON S.intIdUsuario = U.intIdUsuario
		WHERE 
		S.nvchSerie LIKE CONCAT(_elemento,'%') OR
		S.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		S.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		S.nvchRUC LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARENTRADA_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARENTRADA_II(
    	IN _elemento VARCHAR(600)
    )
	BEGIN
		SELECT S.*,U.nvchUsername AS NombreUsuario
		FROM tb_salida S
		LEFT JOIN tb_usuario U ON S.intIdUsuario = U.intIdUsuario
		WHERE 
		S.nvchSerie LIKE CONCAT(_elemento,'%') OR
		S.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		S.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		S.nvchRUC LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%');
    END 
$$
DELIMITER ;