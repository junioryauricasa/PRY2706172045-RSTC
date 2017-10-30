USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARMONEDACOMERCIAL;
DELIMITER $$
	CREATE PROCEDURE INSERTARMONEDACOMERCIAL(
	OUT _intIdMonedaTributaria INT,
	IN _dcmCambio1 DECIMAL(10,6),
	IN _dcmCambio2 DECIMAL(10,6),
    IN _dtmFechaCambio DATETIME
    )
	BEGIN
		INSERT INTO tb_cambio_moneda_tributaria (dcmCambio1,dcmCambio2,dtmFechaCambio)
		VALUES (_dcmCambio1,_dcmCambio2,_dtmFechaCambio);
    	SET _intIdMonedaTributaria = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARMONEDACOMERCIAL;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARMONEDACOMERCIAL(
	IN _intIdMonedaTributaria INT,
	IN _dcmCambio1 DECIMAL(10,6),
	IN _dcmCambio2 DECIMAL(10,6),
    IN _dtmFechaCambio DATETIME
    )
	BEGIN
		UPDATE tb_cambio_moneda_tributaria
		SET
			dcmCambio1 = _dcmCambio1,
			dcmCambio2 = _dcmCambio2,
			dtmFechaCambio = _dtmFechaCambio
		WHERE intIdMonedaTributaria = _intIdMonedaTributaria;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARMONEDACOMERCIAL;
DELIMITER $$
	CREATE PROCEDURE MOSTRARMONEDACOMERCIAL(
    	IN _intIdMonedaTributaria INT
    )
	BEGIN
		SELECT * FROM tb_cambio_moneda_tributaria 
		WHERE 
		intIdMonedaTributaria = _intIdMonedaTributaria;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARMONEDACOMERCIAL;
DELIMITER $$
	CREATE PROCEDURE ELIMINARMONEDACOMERCIAL(
    	IN _intIdMonedaTributaria INT
    )
	BEGIN
		DELETE FROM tb_cambio_moneda_tributaria 
		WHERE 
		intIdMonedaTributaria = _intIdMonedaTributaria;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOMONEDACOMERCIAL;
DELIMITER $$
	CREATE PROCEDURE TODOMONEDACOMERCIAL()
	BEGIN
		SELECT * FROM tb_cambio_moneda_tributaria;
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
		SELECT TCMT.* FROM tb_cambio_moneda_tributaria TCMT
		LEFT JOIN tb_tipo_cambio TCM ON TCMT.intIdTipoCambio = TCM.intIdTipoCambio
		WHERE 
		TCMT.intIdTipoCambio = _intIdTipoCambio
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
		SELECT TCMT.* FROM tb_cambio_moneda_tributaria TCMT
		LEFT JOIN tb_tipo_cambio TCM ON TCMT.intIdTipoCambio = TCM.intIdTipoCambio
		WHERE 
		TCMT.intIdTipoCambio = _intIdTipoCambio;
    	END 
$$
DELIMITER ;