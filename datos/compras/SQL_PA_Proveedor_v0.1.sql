USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE INSERTARPROVEEDOR(
	OUT _intIdProveedor INT,
	IN _nvchDNI CHAR(8),
	IN _nvchRUC CHAR(11),
    IN _nvchRazonSocial VARCHAR(250),
    IN _nvchApellidoPaterno VARCHAR(120),
    IN _nvchApellidoMaterno VARCHAR(120),
	IN _nvchNombres VARCHAR(250),
	IN _intIdTipoPersona INT
    )
	BEGIN
		INSERT INTO tb_proveedor 
		(nvchDNI,nvchRUC,nvchRazonSocial,nvchApellidoPaterno,nvchApellidoMaterno,nvchNombres,intIdTipoPersona)
		VALUES
		(_nvchDNI,_nvchRUC,_nvchRazonSocial,_nvchApellidoPaterno,_nvchApellidoMaterno,_nvchNombres,_intIdTipoPersona);
		SET _intIdProveedor = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARPROVEEDOR(
	IN _intIdProveedor INT,
	IN _nvchDNI CHAR(8),
	IN _nvchRUC CHAR(11),
    IN _nvchRazonSocial VARCHAR(250),
    IN _nvchApellidoPaterno VARCHAR(120),
    IN _nvchApellidoMaterno VARCHAR(120),
	IN _nvchNombres VARCHAR(250),
	IN _intIdTipoPersona INT
    )
	BEGIN
		UPDATE tb_proveedor
		SET
		nvchDNI = _nvchDNI,
		nvchRUC = _nvchRUC,
		nvchRazonSocial = _nvchRazonSocial,
		nvchApellidoPaterno = _nvchApellidoPaterno,
		nvchApellidoMaterno = _nvchApellidoMaterno,
		nvchNombres = _nvchNombres,
		intIdTipoPersona = _intIdTipoPersona
		WHERE 
		intIdProveedor = _intIdProveedor;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE MOSTRARPROVEEDOR(
    	IN _intIdProveedor INT
    )
	BEGIN
		SELECT * FROM tb_proveedor
		WHERE 
		intIdProveedor = _intIdProveedor;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE ELIMINARPROVEEDOR(
    	IN _intIdProveedor INT
    )
	BEGIN
		DELETE FROM tb_proveedor
		WHERE 
		intIdProveedor = _intIdProveedor;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE LISTARPROVEEDOR(
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT * FROM tb_proveedor
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE TODOPROVEEDOR()
	BEGIN
		SELECT * FROM tb_proveedor;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE BUSCARPROVEEDOR(
    	IN _elemento VARCHAR(250),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT * FROM tb_proveedor
		WHERE 
		intIdProveedor LIKE CONCAT(_elemento,'%') OR
		nvchDNI LIKE CONCAT(_elemento,'%') OR
		nvchRUC LIKE CONCAT(_elemento,'%') OR
		nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		nvchNombres LIKE CONCAT(_elemento,'%') OR
		intIdTipoPersona LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARPROVEEDOR_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARPROVEEDOR_II(
    	IN _elemento VARCHAR(250)
    )
	BEGIN
		SELECT * FROM tb_proveedor
		WHERE 
		intIdProveedor LIKE CONCAT(_elemento,'%') OR
		nvchDNI LIKE CONCAT(_elemento,'%') OR
		nvchRUC LIKE CONCAT(_elemento,'%') OR
		nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		nvchNombres LIKE CONCAT(_elemento,'%') OR
		intIdTipoPersona LIKE CONCAT(_elemento,'%');
    END 
$$
DELIMITER ;