USE db_resteco;

DROP PROCEDURE IF EXISTS BUSCARKARDEXGENERAL;
DELIMITER $$
	CREATE PROCEDURE BUSCARKARDEXGENERAL(
    	IN _elemento VARCHAR(500),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT K.dtmFechaMovimiento,CP.nvchCodigo,K.intCantidadStock,K.dcmSaldoValorizado FROM tb_kardex K
		INNER JOIN (
		SELECT MAX(dtmFechaMovimiento) AS TopDate,intIdProducto,intCantidadStock,dcmSaldoValorizado FROM tb_kardex
		GROUP BY intIdProducto DESC) AS Grupo 
		ON Grupo.TopDate = K.dtmFechaMovimiento AND Grupo.intIdProducto = K.intIdProducto
		INNER JOIN tb_codigo_producto CP ON K.intIdProducto = CP.intIdProducto
		WHERE CP.intIdTipoCodigoProducto = 1
		LIMIT _x,_y;
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARKARDEXGENERAL_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARKARDEXGENERAL_II(
    	IN _elemento VARCHAR(500)
    )
	BEGIN
		SELECT K.dtmFechaMovimiento,CP.nvchCodigo,K.intCantidadStock,K.dcmSaldoValorizado FROM tb_kardex K
		INNER JOIN (
		SELECT MAX(dtmFechaMovimiento) AS TopDate,intIdProducto,intCantidadStock,dcmSaldoValorizado FROM tb_kardex
		GROUP BY intIdProducto DESC) AS Grupo 
		ON Grupo.TopDate = K.dtmFechaMovimiento AND Grupo.intIdProducto = K.intIdProducto
		INNER JOIN tb_codigo_producto CP ON K.intIdProducto = CP.intIdProducto
		WHERE CP.intIdTipoCodigoProducto = 1;
    END 
$$
DELIMITER ;