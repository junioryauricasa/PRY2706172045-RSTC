USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARCODIGOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INSERTARCODIGOPRODUCTO(
	IN _intIdProducto INT,
    IN _nvchCodigo VARCHAR(100),
    IN _dtmFechaInicio DATETIME,
    IN _dtmFechaFinal DATETIME,
	IN _intIdTipoCodigoProducto INT
    )
	BEGIN
		INSERT INTO tb_codigo_producto
		(intIdProducto,nvchCodigo,dtmFechaInicio,dtmFechaFinal,intIdTipoCodigoProducto)
		VALUES
		(_intIdProducto,_nvchCodigo,_dtmFechaInicio,_dtmFechaFinal,_intIdTipoCodigoProducto);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARCODIGOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARCODIGOPRODUCTO(
	IN _intIdCodigoProducto INT,
	IN _intIdProducto INT,
    IN _nvchCodigo VARCHAR(100),
    IN _dtmFechaInicio DATETIME,
    IN _dtmFechaFinal DATETIME,
	IN _intIdTipoCodigoProducto INT
    )
	BEGIN
		UPDATE tb_codigo_producto
		SET
		intIdProducto = _intIdProducto,
		nvchCodigo = _nvchCodigo,
		dtmFechaInicio = _dtmFechaInicio,
		dtmFechaFinal = _dtmFechaFinal,
		intIdTipoCodigoProducto = _intIdTipoCodigoProducto
		WHERE 
		intIdCodigoProducto = _intIdCodigoProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARCODIGOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARCODIGOPRODUCTO(
    	IN _intIdCodigoProducto INT
    )
	BEGIN
		SELECT * FROM tb_codigo_producto
		WHERE 
		intIdCodigoProducto = _intIdCodigoProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARCODIGOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ELIMINARCODIGOPRODUCTO(
    	IN _intIdCodigoProducto INT
    )
	BEGIN
		DELETE FROM tb_codigo_producto
		WHERE 
		intIdCodigoProducto = _intIdCodigoProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARCODIGOSPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARCODIGOSPRODUCTO(
    	IN _intIdProducto INT
    )
	BEGIN
		SELECT CP.*,TC.nvchNombre AS NombreTipoCodigo FROM tb_codigo_producto CP
		LEFT JOIN tb_tipo_codigo_producto TCP ON CP.intIdTipoCodigoProducto = TCP.intIdTipoCodigoProducto
		WHERE 
		intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;