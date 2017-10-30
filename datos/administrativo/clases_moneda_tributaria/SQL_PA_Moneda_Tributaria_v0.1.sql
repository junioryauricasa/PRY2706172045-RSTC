USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARMONEDATRIBUTARIA;
DELIMITER $$
	CREATE PROCEDURE INSERTARMONEDATRIBUTARIA(
	OUT _intIdMonedaTributaria INT,
	IN _intIdTipoCambio INT,
	IN _dcmCambio1 DECIMAL(10,6),
	IN _dcmCambio2 DECIMAL(10,6),
    IN _dtmFechaCambio DATETIME
    )
	BEGIN
		INSERT INTO tb_cambio_moneda_tributaria (intIdTipoCambio,dcmCambio1,dcmCambio2,dtmFechaCambio)
		VALUES (_intIdTipoCambio,_dcmCambio1,_dcmCambio2,_dtmFechaCambio);
    	SET _intIdMonedaTributaria = LAST_INSERT_ID();
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARMONEDATRIBUTARIA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARMONEDATRIBUTARIA(
	IN _intIdMonedaTributaria INT,
	IN _intIdTipoCambio INT,
	IN _dcmCambio1 DECIMAL(10,6),
	IN _dcmCambio2 DECIMAL(10,6),
    IN _dtmFechaCambio DATETIME
    )
	BEGIN
		UPDATE tb_cambio_moneda_tributaria
		SET
			intIdTipoCambio = _intIdTipoCambio,
			dcmCambio1 = _dcmCambio1,
			dcmCambio2 = _dcmCambio2,
			dtmFechaCambio = _dtmFechaCambio
		WHERE intIdMonedaTributaria = _intIdMonedaTributaria;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARMONEDATRIBUTARIA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARMONEDATRIBUTARIA(
    	IN _intIdMonedaTributaria INT
    )
	BEGIN
		SELECT * FROM tb_cambio_moneda_tributaria 
		WHERE 
		intIdMonedaTributaria = _intIdMonedaTributaria;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARMONEDATRIBUTARIAFECHA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARMONEDATRIBUTARIAFECHA(
    	IN _dtmFechaCambio DATETIME
    )
	BEGIN
		SELECT * FROM tb_cambio_moneda_tributaria 
		WHERE 
		dtmFechaCambio = _dtmFechaCambio;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARMONEDATRIBUTARIA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARMONEDATRIBUTARIA(
    	IN _intIdMonedaTributaria INT
    )
	BEGIN
		DELETE FROM tb_cambio_moneda_tributaria 
		WHERE 
		intIdMonedaTributaria = _intIdMonedaTributaria;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOMONEDATRIBUTARIA;
DELIMITER $$
	CREATE PROCEDURE TODOMONEDATRIBUTARIA()
	BEGIN
		SELECT * FROM tb_cambio_moneda_tributaria;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARMONEDATRIBUTARIA;
DELIMITER $$
	CREATE PROCEDURE BUSCARMONEDATRIBUTARIA(
    	IN _intIdTipoCambio INT,
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT TCMT.* FROM tb_cambio_moneda_tributaria TCMT
		LEFT JOIN tb_tipo_cambio_moneda TCM ON TCMT.intIdTipoCambio = TCM.intIdTipoCambio
		WHERE 
		TCMT.intIdTipoCambio = _intIdTipoCambio
		ORDER BY dtmFechaCambio DESC
		LIMIT _x,_y;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARMONEDATRIBUTARIA_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARMONEDATRIBUTARIA_II(
    	IN _intIdTipoCambio INT
    )
	BEGIN
		SELECT TCMT.* FROM tb_cambio_moneda_tributaria TCMT
		LEFT JOIN tb_tipo_cambio_moneda TCM ON TCMT.intIdTipoCambio = TCM.intIdTipoCambio
		WHERE 
		TCMT.intIdTipoCambio = _intIdTipoCambio
		ORDER BY dtmFechaCambio DESC;
    	END 
$$
DELIMITER ;