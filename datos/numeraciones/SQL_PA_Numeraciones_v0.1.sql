USE db_resteco;

DROP PROCEDURE IF EXISTS MOSTRARSERIE;
DELIMITER $$
	CREATE PROCEDURE MOSTRARSERIE(
		IN _intIdSucursal INT
    )
	BEGIN
		SELECT * FROM tb_serie
		WHERE intIdSucursal = _intIdSucursal;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARNUMERACION;
DELIMITER $$
	CREATE PROCEDURE MOSTRARNUMERACION(
		IN _intIdTipoComprobante INT,
		IN _intIdSerie INT
    )
	BEGIN
		SELECT * FROM tb_numeracion
		WHERE 
		intIdTipoComprobante = _intIdTipoComprobante AND
		intIdSerie = _intIdSerie;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARNUMERACION;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARNUMERACION(
		IN _intIdTipoComprobante INT,
		IN _intIdSerie INT,
		IN _nvchNumeracion VARCHAR(8)
    )
	BEGIN
		UPDATE tb_numeracion
		SET
		nvchNumeracion = _nvchNumeracion
		WHERE 
		intIdTipoComprobante = _intIdTipoComprobante AND
		intIdSerie = _intIdSerie;
    END 
$$
DELIMITER ;