USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDETALLEGUIAINTERNAENTRADA;
DELIMITER $$
	CREATE PROCEDURE INSERTARDETALLEGUIAINTERNAENTRADA(
	IN _intIdGuiaInternaEntrada INT,
    IN _intIdOperacionOrdenCompra INT,
    IN _dtmFechaEntrada DATETIME,
    IN _intCantidad INT
    )
	BEGIN
		INSERT INTO tb_detalle_guia_interna_entrada
		(intIdGuiaInternaEntrada,intIdOperacionOrdenCompra,dtmFechaEntrada,intCantidad)
		VALUES
		(_intIdGuiaInternaEntrada,_intIdOperacionOrdenCompra,_dtmFechaEntrada,_intCantidad);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDETALLEGUIAINTERNAENTRADA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDETALLEGUIAINTERNAENTRADA(
	IN _intIdOperacionGuiaInternaEntrada INT,
	IN _intIdGuiaInternaEntrada INT,
    IN _intIdOperacionOrdenCompra INT,
    IN _dtmFechaEntrada DATETIME,
    IN _intCantidad INT
    )
	BEGIN
		UPDATE tb_detalle_guia_interna_entrada
		SET
		intIdGuiaInternaEntrada = _intIdGuiaInternaEntrada,
		intIdOperacionOrdenCompra = _intIdOperacionOrdenCompra,
		dtmFechaEntrada = _dtmFechaEntrada,
		intCantidad = _intCantidad
		WHERE 
		intIdOperacionOrdenCompra = _intIdOperacionOrdenCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARDETALLEGUIAINTERNAENTRADA;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARDETALLEGUIAINTERNAENTRADA(
    	IN _intIdOperacionOrdenCompra INT
    )
	BEGIN
		SELECT * FROM tb_detalle_guia_interna_entrada
		WHERE 
		intIdOperacionOrdenCompra = _intIdOperacionOrdenCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDETALLEGUIAINTERNAENTRADA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLEGUIAINTERNAENTRADA(
    	IN _intIdOperacionOrdenCompra INT
    )
	BEGIN
		DELETE FROM tb_domicilio_proveedor
		WHERE 
		intIdOperacionOrdenCompra = _intIdOperacionOrdenCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDETALLEGUIAINTERNAENTRADA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDETALLEGUIAINTERNAENTRADA(
    	IN _intIdGuiaInternaEntrada INT
    )
	BEGIN
		SELECT DGIE.*,P.nvchNombre AS NombreProducto, P.nvchDescripcion AS DescripcionProducto
		FROM tb_detalle_guia_interna_entrada DGIE
		LEFT JOIN tb_detalle_orden_compra DOC ON DGIE.intIdOperacionOrdenCompra = DOC.intIdOperacionOrdenCompra
		LEFT JOIN tb_producto P ON DOC.intIdProducto = P.intIdProducto
		WHERE 
		intIdGuiaInternaEntrada = _intIdGuiaInternaEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDETALLESGUIAINTERNAENTRADA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLESGUIAINTERNAENTRADA(
    	IN _intIdGuiaInternaEntrada INT
    )
	BEGIN
		DELETE FROM tb_detalle_guia_interna_entrada
		WHERE 
		intIdGuiaInternaEntrada = _intIdGuiaInternaEntrada;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS DESCONTARDETALLEORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE DESCONTARDETALLEORDENCOMPRA(
	IN _intIdOperacionOrdenCompra INT,
	IN _intCantidadPendiente INT
    )
	BEGIN
		UPDATE tb_detalle_orden_compra
		SET
		intCantidadPendiente = _intCantidadPendiente
		WHERE 
		intIdOperacionOrdenCompra = _intIdOperacionOrdenCompra;
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