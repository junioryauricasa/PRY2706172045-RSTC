USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDETALLEENTRADA;
DELIMITER $$
	CREATE PROCEDURE INSERTARDETALLEENTRADA(
	IN _intIdSalida INT,
    IN _dtmFechaSalida DATETIME,
    IN _intIdProducto INT,
    IN _nvchCodigo VARCHAR(25),
    IN _nvchDescripcion VARCHAR(500),
    IN _intCantidad INT
    )
	BEGIN
		INSERT INTO tb_detalle_salida
		(intIdSalida,dtmFechaSalida,intIdProducto,nvchCodigo,nvchDescripcion,intCantidad)
		VALUES
		(_intIdSalida,_dtmFechaSalida,_intIdProducto,_nvchCodigo,_nvchDescripcion,_intCantidad);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDETALLEENTRADA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDETALLEENTRADA(
	IN _intIdOperacionSalida INT,
	IN _intIdSalida INT,
    IN _dtmFechaSalida DATETIME,
    IN _intIdProducto INT,
    IN _nvchCodigo VARCHAR(25),
    IN _nvchDescripcion VARCHAR(500),
    IN _intCantidad INT
    )
	BEGIN
		UPDATE tb_detalle_salida
		SET
		intIdSalida = _intIdSalida,
		dtmFechaSalida = _dtmFechaSalida,
		intIdProducto = _intIdProducto,
		nvchCodigo = _nvchCodigo,
		nvchDescripcion = _nvchDescripcion,
		intCantidad = _intCantidad
		WHERE 
		intIdOperacionSalida = _intIdOperacionSalida;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARDETALLEENTRADA;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARDETALLEENTRADA(
    	IN _intIdOperacionSalida INT
    )
	BEGIN
		SELECT * FROM tb_detalle_salida
		WHERE 
		intIdOperacionSalida = _intIdOperacionSalida;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDETALLEENTRADA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLEENTRADA(
    	IN _intIdOperacionSalida INT
    )
	BEGIN
		DELETE FROM tb_detalle_salida
		WHERE 
		intIdOperacionSalida = _intIdOperacionSalida;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDETALLEENTRADA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDETALLEENTRADA(
    	IN _intIdSalida INT
    )
	BEGIN
		SELECT DS.*, CP.nvchCodigo AS CodigoProducto
		FROM tb_detalle_salida DS
		LEFT JOIN tb_producto P ON DS.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		intIdSalida = _intIdSalida AND CP.intIdTipoCodigoProducto = 1;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS INGRESARCANTIDADPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INGRESARCANTIDADPRODUCTO(
	IN _intIdProducto INT,
	IN _intCantidad INT
    )
	BEGIN
		UPDATE tb_producto
		SET
		intCantidad = _intCantidad
		WHERE 
		intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;