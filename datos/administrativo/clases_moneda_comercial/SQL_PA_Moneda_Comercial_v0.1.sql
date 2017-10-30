USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARMONEDACOMERCIAL;
DELIMITER $$
	CREATE PROCEDURE INSERTARMONEDACOMERCIAL(
	OUT _intIdMonedaComercial INT,
	IN _intIdTipoCambio INT,
	IN _dcmCambio1 DECIMAL(10,6),
	IN _dcmCambio2 DECIMAL(10,6),
    IN _dtmFechaCambio DATETIME
    )
	BEGIN
		INSERT INTO tb_cambio_moneda_comercial (intIdTipoCambio,dcmCambio1,dcmCambio2,dtmFechaCambio)
		VALUES (_intIdTipoCambio,_dcmCambio1,_dcmCambio2,_dtmFechaCambio);
    	SET _intIdMonedaComercial = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARMONEDACOMERCIAL;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARMONEDACOMERCIAL(
	IN _intIdMonedaComercial INT,
	IN _intIdTipoCambio INT,
	IN _dcmCambio1 DECIMAL(10,6),
	IN _dcmCambio2 DECIMAL(10,6),
    IN _dtmFechaCambio DATETIME
    )
	BEGIN
		UPDATE tb_cambio_moneda_comercial
		SET
			intIdTipoCambio = _intIdTipoCambio,
			dcmCambio1 = _dcmCambio1,
			dcmCambio2 = _dcmCambio2,
			dtmFechaCambio = _dtmFechaCambio
		WHERE intIdMonedaComercial = _intIdMonedaComercial;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARMONEDACOMERCIAL;
DELIMITER $$
	CREATE PROCEDURE MOSTRARMONEDACOMERCIAL(
    	IN _intIdMonedaComercial INT
    )
	BEGIN
		SELECT * FROM tb_cambio_moneda_comercial 
		WHERE 
		intIdMonedaComercial = _intIdMonedaComercial;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARMONEDACOMERCIAL;
DELIMITER $$
	CREATE PROCEDURE ELIMINARMONEDACOMERCIAL(
    	IN _intIdMonedaComercial INT
    )
	BEGIN
		DELETE FROM tb_cambio_moneda_comercial 
		WHERE 
		intIdMonedaComercial = _intIdMonedaComercial;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOMONEDACOMERCIAL;
DELIMITER $$
	CREATE PROCEDURE TODOMONEDACOMERCIAL()
	BEGIN
		SELECT * FROM tb_cambio_moneda_comercial;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARMONEDACOMERCIAL;
DELIMITER $$
	CREATE PROCEDURE BUSCARMONEDACOMERCIAL(
    	IN _intIdTipoCambio INT,
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT TCMC.* FROM tb_cambio_moneda_comercial TCMC
		LEFT JOIN tb_tipo_cambio_moneda TCM ON TCMC.intIdTipoCambio = TCM.intIdTipoCambio
		WHERE 
		TCMC.intIdTipoCambio = _intIdTipoCambio
		ORDER BY dtmFechaCambio DESC
		LIMIT _x,_y;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARMONEDACOMERCIAL_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARMONEDACOMERCIAL_II(
    	IN _intIdTipoCambio INT
    )
	BEGIN
		SELECT TCMC.* FROM tb_cambio_moneda_comercial TCMC
		LEFT JOIN tb_tipo_cambio_moneda TCM ON TCMC.intIdTipoCambio = TCM.intIdTipoCambio
		WHERE 
		TCMC.intIdTipoCambio = _intIdTipoCambio
		ORDER BY dtmFechaCambio DESC;
    	END 
$$
DELIMITER ;