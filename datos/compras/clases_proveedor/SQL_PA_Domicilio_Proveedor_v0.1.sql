USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDOMICILIOPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE INSERTARDOMICILIOPROVEEDOR(
	IN _intIdProveedor INT,
    IN _nvchPais VARCHAR(150),
    IN _intIdDepartamento INT,
    IN _intIdProvincia INT,
	IN _intIdDistrito INT,
	IN _nvchDireccion VARCHAR(450),
	IN _intIdTipoDomicilio INT
    )
	BEGIN
		INSERT INTO tb_domicilio_proveedor
		(intIdProveedor,nvchPais,intIdDepartamento,intIdProvincia,intIdDistrito,nvchDireccion,intIdTipoDomicilio)
		VALUES
		(_intIdProveedor,_nvchPais,_intIdDepartamento,_intIdProvincia,_intIdDistrito,_nvchDireccion,_intIdTipoDomicilio);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDOMICILIOPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDOMICILIOPROVEEDOR(
	IN _intIdDomicilioProveedor INT,
	IN _intIdProveedor INT,
    IN _nvchPais VARCHAR(150),
    IN _intIdDepartamento INT,
    IN _intIdProvincia INT,
	IN _intIdDistrito INT,
	IN _nvchDireccion VARCHAR(450),
	IN _intIdTipoDomicilio INT
    )
	BEGIN
		UPDATE tb_domicilio_proveedor
		SET
		intIdProveedor = _intIdProveedor,
		nvchPais = _nvchPais,
		intIdDepartamento = _intIdDepartamento,
		intIdProvincia = _intIdProvincia,
		intIdDistrito = _intIdDistrito,
		nvchDireccion = _nvchDireccion,
		intIdTipoDomicilio = _intIdTipoDomicilio
		WHERE 
		intIdDomicilioProveedor = _intIdDomicilioProveedor;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARDOMICILIOPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARDOMICILIOPROVEEDOR(
    	IN _intIdDomicilioProveedor INT
    )
	BEGIN
		SELECT * FROM tb_domicilio_proveedor
		WHERE 
		intIdDomicilioProveedor = _intIdDomicilioProveedor;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDOMICILIOPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDOMICILIOPROVEEDOR(
    	IN _intIdDomicilioProveedor INT
    )
	BEGIN
		DELETE FROM tb_domicilio_proveedor
		WHERE 
		intIdDomicilioProveedor = _intIdDomicilioProveedor;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDOMICILIOSPROVEEDOR;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDOMICILIOSPROVEEDOR(
    	IN _intIdProveedor INT
    )
	BEGIN
		SELECT DPR.*,TP.nvchNombre AS NombreTD,DP.nvchDepartamento,P.nvchProvincia,DT.nvchDistrito 
		FROM tb_domicilio_proveedor DPR
		LEFT JOIN tb_tipo_domicilio TP ON DPR.intIdTipoDomicilio = TP.intIdTipoDomicilio
		LEFT JOIN tb_departamentos DP ON DPR.intIdDepartamento = DP.intIdDepartamento
		LEFT JOIN tb_provincias P ON DPR.intIdProvincia = P.intIdProvincia 
		LEFT JOIN tb_distritos DT ON DPR.intIdDistrito = DT.intIdDistrito 
		WHERE 
		DPR.intIdProveedor = _intIdProveedor;
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