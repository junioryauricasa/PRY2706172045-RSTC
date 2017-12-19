USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARUBIGEOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INSERTARUBIGEOPRODUCTO(
	IN _intIdProducto INT,
    IN _intIdSucursal VARCHAR(100),
    IN _nvchUbicacion VARCHAR(100),
    IN _intCantidadUbigeo INT
    )
	BEGIN
		INSERT INTO tb_ubigeo_producto
		(intIdProducto,intIdSucursal,nvchUbicacion,intCantidadUbigeo)
		VALUES
		(_intIdProducto,_intIdSucursal,_nvchUbicacion,_intCantidadUbigeo);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARUBIGEOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARUBIGEOPRODUCTO(
	IN _intIdUbigeoProducto INT,
	IN _intIdProducto INT,
    IN _intIdSucursal INT,
    IN _nvchUbicacion VARCHAR(100),
    IN _intCantidadUbigeo INT
    )
	BEGIN
		UPDATE tb_ubigeo_producto
		SET
		intIdProducto = _intIdProducto,
		intIdSucursal = _intIdSucursal,
		nvchUbicacion = _nvchUbicacion,
		intCantidadUbigeo = _intCantidadUbigeo
		WHERE 
		intIdUbigeoProducto = _intIdUbigeoProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARUBIGEOPRODUCTO_II;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARUBIGEOPRODUCTO_II(
	IN _intIdProducto INT,
    IN _intIdSucursal INT,
    IN _nvchUbicacion VARCHAR(100),
    IN _intCantidadUbigeo INT
    )
	BEGIN
		UPDATE tb_ubigeo_producto
		SET
		nvchUbicacion = _nvchUbicacion,
		intCantidadUbigeo = _intCantidadUbigeo,
		intCantidadInicial = _intCantidadUbigeo,
		intEstado = 1
		WHERE
		intIdProducto = _intIdProducto AND
		intIdSucursal = _intIdSucursal;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARUBIGEOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARUBIGEOPRODUCTO(
    	IN _intIdUbigeoProducto INT
    )
	BEGIN
		SELECT * FROM tb_ubigeo_producto
		WHERE 
		intIdUbigeoProducto = _intIdUbigeoProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARUBIGEOPRODUCTO_II;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARUBIGEOPRODUCTO_II(
    	IN _intIdProducto INT,
    	IN _intIdSucursal INT
    )
	BEGIN
		SELECT * FROM tb_ubigeo_producto
		WHERE 
		intIdProducto = _intIdProducto AND
		intIdSucursal = _intIdSucursal;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARUBIGEOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ELIMINARUBIGEOPRODUCTO(
    	IN _intIdUbigeoProducto INT
    )
	BEGIN
		DELETE FROM tb_ubigeo_producto
		WHERE 
		intIdUbigeoProducto = _intIdUbigeoProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARUBIGEOSPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARUBIGEOSPRODUCTO(
    	IN _intIdProducto INT
    )
	BEGIN
		SELECT UP.*,S.nvchNombre AS NombreSucursal FROM tb_ubigeo_producto UP
		LEFT JOIN tb_sucursal S ON UP.intIdSucursal = S.intIdSucursal
		WHERE 
		UP.intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;