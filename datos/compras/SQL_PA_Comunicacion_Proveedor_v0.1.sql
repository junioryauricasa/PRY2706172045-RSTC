USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARCOMUNICACIONPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE INSERTARCOMUNICACIONPROVEEDOR(
	IN _intIdProveedor INT,
    IN _nvchMedio VARCHAR(100),
    IN _nvchLugar VARCHAR(550),
	IN _intIdTipoComunicacion INT
    )
	BEGIN
		INSERT INTO tb_comunicacion_proveedor
		(intIdProveedor,nvchMedio,nvchLugar,intIdTipoComunicacion)
		VALUES
		(_intIdProveedor,_nvchMedio,_nvchLugar,_intIdTipoComunicacion);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARCOMUNICACIONPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARCOMUNICACIONPROVEEDOR(
	IN _intIdComunicacionProveedor INT,
	IN _intIdProveedor INT,
    IN _nvchMedio VARCHAR(100),
    IN _nvchLugar VARCHAR(550),
	IN _intIdTipoComunicacion INT
    )
	BEGIN
		UPDATE tb_comunicacion_proveedor
		SET
		intIdProveedor = _intIdProveedor,
		nvchPais = _nvchPais,
		nvchRegion = _nvchRegion,
		nvchProvincia = _nvchProvincia,
		nvchDistrito = _nvchDistrito,
		nvchDireccion = _nvchDireccion
		WHERE 
		intIdComunicacionProveedor = _intIdComunicacionProveedor;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARCOMUNICACIONPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE ELIMINARCOMUNICACIONPROVEEDOR(
    	IN _intIdComunicacionProveedor INT
    )
	BEGIN
		DELETE FROM tb_comunicacion_proveedor
		WHERE 
		intIdComunicacionProveedor = _intIdComunicacionProveedor;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDOMICILIOSPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDOMICILIOSPROVEEDOR(
    	IN _intIdProveedor INT
    )
	BEGIN
		SELECT * FROM tb_comunicacion_proveedor
		WHERE 
		intIdProveedor = _intIdProveedor;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDOMICILIOSPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDOMICILIOSPROVEEDOR(
    	IN _intIdProveedor INT
    )
	BEGIN
		DELETE FROM tb_comunicacion_proveedor
		WHERE 
		intIdProveedor = _intIdProveedor;
    END 
$$
DELIMITER ;