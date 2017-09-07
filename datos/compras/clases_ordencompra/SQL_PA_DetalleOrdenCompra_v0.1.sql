USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDETALLEORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE INSERTARDETALLEORDENCOMPRA(
	IN _intIdOrdenCompra INT,
	IN _intIdProducto INT,
	IN _dtmFechaSolicitud DATETIME,
	IN _intCantidad INT,
	IN _intCantidadPendiente INT,
	IN _dcmPrecio DECIMAL(11,2)
    )
	BEGIN
		INSERT INTO tb_detalle_orden_compra 
		(intIdOrdenCompra,intIdProducto,dtmFechaSolicitud,intCantidad,intCantidadPendiente,dcmPrecio)
		VALUES
		(_intIdOrdenCompra,_intIdProducto,_dtmFechaSolicitud,_intCantidad,_intCantidadPendiente,_dcmPrecio);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDETALLEORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDETALLEORDENCOMPRA(
	IN _intIdOperacionOrdenCompra INT,
	IN _intIdOrdenCompra INT,
	IN _intIdProducto INT,
	IN _dtmFechaSolicitud DATETIME,
	IN _intCantidad INT,
	IN _dcmPrecio DECIMAL(11,2)
    )
	BEGIN
		UPDATE tb_detalle_orden_compra
		SET
		intIdOrdenCompra = _intIdOrdenCompra,
		intIdProducto = _intIdProducto,
		dtmFechaSolicitud = _dtmFechaSolicitud,
		intCantidad = _intCantidad,
		dcmPrecio = _dcmPrecio
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

DROP PROCEDURE IF EXISTS ELIMINARDETALLESORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLESORDENCOMPRA(
    	IN _intIdOrdenCompra INT
    )
	BEGIN
		DELETE FROM tb_detalle_orden_compra
		WHERE 
		intIdOrdenCompra = _intIdOrdenCompra;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDETALLEORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDETALLEORDENCOMPRA(
    	IN _intIdOrdenCompra INT
    )
	BEGIN
		SELECT DOC.*,P.nvchDescripcion FROM tb_detalle_orden_compra DOC
		LEFT JOIN tb_producto P ON DOC.intIdProducto = P.intIdProducto
		WHERE
		intIdOrdenCompra = _intIdOrdenCompra;
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

DROP PROCEDURE IF EXISTS LISTARPROVEEDORORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE LISTARPROVEEDORORDENCOMPRA(
		IN _elemento VARCHAR(600),
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT intIdProveedor,
			CASE 
				WHEN intIdTipoPersona = 1 THEN nvchRUC
				WHEN intIdTipoPersona = 2 THEN nvchDNI
			END AS IdentificadorProveedor, 
			CASE 
				WHEN intIdTipoPersona = 1 THEN nvchRazonSocial
				WHEN intIdTipoPersona = 2 THEN CONCAT(nvchNombres,' ',nvchApellidoPaterno,' ',nvchApellidoMaterno)
			END AS NombreProveedor,
		intIdTipoPersona 
		FROM tb_proveedor 
		WHERE
		nvchDNI LIKE CONCAT(_elemento,'%') OR
		nvchRUC LIKE CONCAT(_elemento,'%') OR
		nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		nvchNombres LIKE CONCAT(_elemento,'%')
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARPRODUCTOORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE LISTARPRODUCTOORDENCOMPRA(
		IN _elemento VARCHAR(600),
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT * FROM tb_producto 
		WHERE
		nvchDescripcion LIKE CONCAT(_elemento,'%')
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS PAGINARPROVEEDORORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE PAGINARPROVEEDORORDENCOMPRA(
		IN _elemento VARCHAR(600)
    )
	BEGIN
		SELECT intIdProveedor,
			CASE 
				WHEN intIdTipoPersona = 1 THEN nvchRUC
				WHEN intIdTipoPersona = 2 THEN nvchDNI
			END AS IdentificadorProveedor, 
			CASE 
				WHEN intIdTipoPersona = 1 THEN nvchRazonSocial
				WHEN intIdTipoPersona = 2 THEN CONCAT(nvchNombres,' ',nvchApellidoPaterno,' ',nvchApellidoMaterno)
			END AS NombreProveedor 
		FROM tb_proveedor 
		WHERE
		nvchDNI LIKE CONCAT(_elemento,'%') OR
		nvchRUC LIKE CONCAT(_elemento,'%') OR
		nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		nvchNombres LIKE CONCAT(_elemento,'%');
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS PAGINARPRODUCTOORDENCOMPRA;
DELIMITER $$
	CREATE PROCEDURE PAGINARPRODUCTOORDENCOMPRA(
		IN _elemento VARCHAR(600)
    )
	BEGIN
		SELECT * FROM tb_producto 
		WHERE
		nvchDescripcion LIKE CONCAT(_elemento,'%');
    END 
$$
DELIMITER ;