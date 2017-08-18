USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDOMICILIOPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE INSERTARDOMICILIOPROVEEDOR(
	IN _intIdProveedor INT,
    IN _nvchPais VARCHAR(150),
    IN _nvchRegion VARCHAR(150),
    IN _nvchProvincia VARCHAR(150),
	IN _nvchDistrito VARCHAR(150),
	IN _nvchDireccion VARCHAR(450),
	IN _intIdTipoDomicilio INT
    )
	BEGIN
		INSERT INTO tb_domicilio_proveedor
		(intIdProveedor,nvchPais,nvchRegion,nvchProvincia,nvchDistrito,nvchDireccion,intIdTipoDomicilio)
		VALUES
		(_intIdProveedor,_nvchPais,_nvchRegion,_nvchProvincia,_nvchDistrito,_nvchDireccion,_intIdTipoDomicilio);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDOMICILIOPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDOMICILIOPROVEEDOR(
	IN _intIdDomicilioProveedor INT,
	IN _intIdProveedor INT,
    IN _nvchPais VARCHAR(150),
    IN _nvchRegion VARCHAR(150),
    IN _nvchProvincia VARCHAR(150),
	IN _nvchDistrito VARCHAR(150),
	IN _nvchDireccion VARCHAR(450),
	IN _intIdTipoDomicilio INT
    )
	BEGIN
		UPDATE tb_domicilio_proveedor
		SET
		intIdProveedor = _intIdProveedor,
		nvchPais = _nvchPais,
		nvchRegion = _nvchRegion,
		nvchProvincia = _nvchProvincia,
		nvchDistrito = _nvchDistrito,
		nvchDireccion = _nvchDireccion
		WHERE 
		intIdDomicilioProveedor = _intIdDomicilioProveedor;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDOMICILIOPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDOMICILIOPROVEEDOR(
    	IN _intIdComunicacionProveedor INT
    )
	BEGIN
		DELETE FROM tb_domicilio_proveedor
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
		SELECT * FROM tb_domicilio_proveedor
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
		DELETE FROM tb_domicilio_proveedor
		WHERE 
		intIdProveedor = _intIdProveedor;
    END 
$$
DELIMITER ;