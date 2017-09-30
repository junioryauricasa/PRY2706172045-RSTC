USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDETALLEORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE INSERTARDETALLEORDENCOMPRA(
	IN _intIdOrdenCompra INT,
	IN _dtmFechaSolicitud DATETIME,
	IN _nvchCodigo VARCHAR(65),
	IN _nvchDescripcion VARCHAR(125),
	IN _intCantidad INT,
	IN _dcmPrecio DECIMAL(11,2),
	IN _dcmTotal DECIMAL(11,2)
    )
	BEGIN
		INSERT INTO tb_detalle_orden_compra 
		(intIdOrdenCompra,dtmFechaSolicitud,nvchCodigo,nvchDescripcion,intCantidad,dcmPrecio,dcmTotal)
		VALUES
		(_intIdOrdenCompra,_dtmFechaSolicitud,_nvchCodigo,_nvchDescripcion,_intCantidad,_dcmPrecio,_dcmTotal);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDETALLEORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDETALLEORDENCOMPRA(
	IN _intIdOperacionOrdenCompra INT,
	IN _dtmFechaSolicitud DATETIME,
	IN _nvchCodigo VARCHAR(65),
	IN _nvchDescripcion VARCHAR(125),
	IN _intCantidad INT,
	IN _dcmPrecio DECIMAL(11,2),
	IN _dcmTotal DECIMAL(11,2)
    )
	BEGIN
		UPDATE tb_detalle_orden_compra
		SET
		intIdOrdenCompra = _intIdOrdenCompra,
		dtmFechaSolicitud = _dtmFechaSolicitud,
		nvchCodigo = _nvchCodigo,
		nvchDescripcion = _nvchDescripcion,
		intCantidad = _intCantidad,
		dcmPrecio = _dcmPrecio,
		dcmTotal = _dcmTotal
		WHERE 
		intIdOperacionOrdenCompra = _intIdOperacionOrdenCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARDETALLEORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARDETALLEORDENCOMPRA(
    	IN _intIdOperacionOrdenCompra INT
    )
	BEGIN
		SELECT DOC.*,P.nvchDescripcion,P.intCantidad AS CantidadProducto FROM tb_detalle_orden_compra DOC
		LEFT JOIN tb_producto P ON DOC.intIdProducto = P.intIdProducto
		WHERE 
		intIdOperacionOrdenCompra = _intIdOperacionOrdenCompra;
    END 
$$
DELIMITER ;


DROP PROCEDURE IF EXISTS ELIMINARDETALLEORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLEORDENCOMPRA(
    	IN _intIdOperacionOrdenCompra INT
    )
	BEGIN
		DELETE FROM tb_detalle_orden_compra
		WHERE 
		intIdOperacionOrdenCompra = _intIdOperacionOrdenCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDETALLEORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDETALLEORDENCOMPRA(
    	IN _intIdOrdenCompra INT
    )
	BEGIN
		SELECT * FROM tb_detalle_orden_compra DOC
		WHERE
		DOC.intIdOrdenCompra = _intIdOrdenCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODODETALLEORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE TODODETALLEORDENCOMPRA()
	BEGIN
		SELECT * FROM tb_detalle_orden_compra;
    END 
$$
DELIMITER ;