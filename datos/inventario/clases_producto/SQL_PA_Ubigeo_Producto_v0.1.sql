USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARUBIGEOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INSERTARUBIGEOPRODUCTO(
	IN _intIdProducto INT,
    IN _nvchSucursal VARCHAR(100),
    IN _nvchUbicacion VARCHAR(100),
    IN _intCantidadUbigeo INT
    )
	BEGIN
		INSERT INTO tb_ubigeo_producto
		(intIdProducto,nvchSucursal,nvchUbicacion,intCantidadUbigeo)
		VALUES
		(_intIdProducto,_nvchSucursal,_nvchUbicacion,_intCantidadUbigeo);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARUBIGEOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARUBIGEOPRODUCTO(
	IN _intIdUbigeoProducto INT,
	IN _intIdProducto INT,
    IN _nvchSucursal VARCHAR(100),
    IN _nvchUbicacion VARCHAR(100),
    IN _intCantidadUbigeo INT
    )
	BEGIN
		UPDATE tb_ubigeo_producto
		SET
		intIdProducto = _intIdProducto,
		nvchSucursal = _nvchSucursal,
		nvchUbicacion = _nvchUbicacion,
		intCantidadUbigeo = _intCantidadUbigeo
		WHERE 
		intIdUbigeoProducto = _intIdUbigeoProducto;
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

DROP PROCEDURE IF EXISTS MOSTRARCODIGOSPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARCODIGOSPRODUCTO(
    	IN _intIdProducto INT
    )
	BEGIN
		SELECT * FROM tb_ubigeo_producto
		WHERE 
		intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;