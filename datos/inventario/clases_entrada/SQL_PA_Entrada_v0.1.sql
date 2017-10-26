USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARENTRADA;
DELIMITER $$
	CREATE PROCEDURE INSERTARENTRADA(
	OUT _intIdEntrada INT,
	IN _dtmFechaCreacion DATETIME,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(10),
	IN _nvchRazonSocial VARCHAR(150),
	IN _nvchRUC VARCHAR(15),
	IN _intIdUsuarioSolicitado INT,
	IN _intIdUsuario INT,
	IN _intIdSucursal INT,
	IN _bitEstado INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		INSERT INTO tb_entrada 
		(dtmFechaCreacion,nvchSerie,nvchNumeracion,nvchRazonSocial,nvchRUC,intIdUsuarioSolicitado,intIdUsuario,intIdSucursal,
			bitEstado,nvchObservacion)
		VALUES
		(_dtmFechaCreacion,_nvchSerie,_nvchNumeracion,_nvchRazonSocial,_nvchRUC,_intIdUsuarioSolicitado,_intIdUsuario,_intIdSucursal,
			_bitEstado,_nvchObservacion);
		SET _intIdEntrada = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARENTRADA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARENTRADA(
	IN _intIdEntrada INT,
	IN _dtmFechaCreacion DATETIME,
	IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(10),
	IN _nvchRazonSocial VARCHAR(150),
	IN _nvchRUC VARCHAR(15),
	IN _intIdUsuarioSolicitado INT,
	IN _intIdUsuario INT,
	IN _intIdSucursal INT,
	IN _bitEstado INT,
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		UPDATE tb_entrada
		SET
		dtmFechaCreacion = _dtmFechaCreacion,
		nvchSerie = _nvchSerie,
		nvchNumeracion = _nvchNumeracion,
		nvchRazonSocial = _nvchRazonSocial,
		nvchRUC = _nvchRUC,
		intIdUsuario = _intIdUsuario,
		intIdUsuarioSolicitado = _intIdUsuarioSolicitado,
		intIdSucursal = _intIdSucursal,
		bitEstado = _bitEstado,
		nvchObservacion = _nvchObservacion
		WHERE 
		intIdEntrada = _intIdEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARENTRADA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARENTRADA(
    	IN _intIdEntrada INT
    )
	BEGIN
		SELECT E.*,
		U.nvchUsername AS NombreUsuario
		FROM tb_entrada E
		LEFT JOIN tb_usuario U ON E.intIdUsuario = U.intIdUsuario
		WHERE 
		E.intIdEntrada = _intIdEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARENTRADA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARENTRADA(
    	IN _intIdEntrada INT
    )
	BEGIN
		DELETE FROM tb_entrada
		WHERE 
		intIdEntrada = _intIdEntrada;
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
		SELECT E.*,U.nvchUsername AS NombreUsuario
		FROM tb_entrada E
		LEFT JOIN tb_usuario U ON E.intIdUsuario = U.intIdUsuario
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
		SELECT E.*,U.nvchUsername AS NombreUsuario
		FROM tb_entrada E
		LEFT JOIN tb_usuario U ON E.intIdUsuario = U.intIdUsuario
		WHERE 
		E.nvchSerie LIKE CONCAT(_elemento,'%') OR
		E.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		E.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		E.nvchRUC LIKE CONCAT(_elemento,'%') OR
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
		SELECT E.*,U.nvchUsername AS NombreUsuario
		FROM tb_entrada E
		LEFT JOIN tb_usuario U ON E.intIdUsuario = U.intIdUsuario
		WHERE 
		E.nvchSerie LIKE CONCAT(_elemento,'%') OR
		E.nvchNumeracion LIKE CONCAT(_elemento,'%') OR
		E.nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		E.nvchRUC LIKE CONCAT(_elemento,'%') OR
		U.nvchUsername LIKE CONCAT(_elemento,'%');
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARUSUARIOS;
DELIMITER $$
	CREATE PROCEDURE LISTARUSUARIOS()
	BEGIN
		SELECT U.*, 
		CONCAT(U.nvchNombres,' ',U.nvchApellidoPaterno,' ',U.nvchApellidoMaterno) AS NombreUsuario 
		FROM tb_usuario U;
    END 
$$
DELIMITER ;