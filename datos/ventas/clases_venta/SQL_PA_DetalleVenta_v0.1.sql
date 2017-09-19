USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDETALLEVENTA;
DELIMITER $$
	CREATE PROCEDURE INSERTARDETALLEVENTA(
	IN _intIdVenta INT,
	IN _intIdProducto INT,
	IN _dtmFechaRealizada DATETIME,
	IN _intCantidad INT,
	IN _intCantidadPendiente INT,
	IN _dcmPrecio DECIMAL(11,2)
    )
	BEGIN
		INSERT INTO tb_detalle_venta 
		(intIdVenta,intIdProducto,dtmFechaRealizada,intCantidad,intCantidadPendiente,dcmPrecio)
		VALUES
		(_intIdVenta,_intIdProducto,_dtmFechaRealizada,_intCantidad,_intCantidadPendiente,_dcmPrecio);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDETALLEVENTA;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDETALLEVENTA(
	IN _intIdOperacionVenta INT,
	IN _intIdVenta INT,
	IN _intIdProducto INT,
	IN _dtmFechaRealizada DATETIME,
	IN _intCantidad INT,
	IN _dcmPrecio DECIMAL(11,2)
    )
	BEGIN
		UPDATE tb_detalle_venta
		SET
		intIdVenta = _intIdVenta,
		intIdProducto = _intIdProducto,
		dtmFechaRealizada = _dtmFechaRealizada,
		intCantidad = _intCantidad,
		dcmPrecio = _dcmPrecio
		WHERE 
		intIdOperacionVenta = _intIdOperacionVenta;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARDETALLEVENTA;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARDETALLEVENTA(
    	IN _intIdOperacionVenta INT
    )
	BEGIN
		SELECT DV.*,CP.nvchCodigo,P.nvchDescripcion,P.intCantidad AS CantidadProducto FROM tb_detalle_venta DV
		LEFT JOIN tb_producto P ON DV.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		DV.intIdOperacionVenta = _intIdOperacionVenta;
    END 
$$
DELIMITER ;


DROP PROCEDURE IF EXISTS ELIMINARDETALLEVENTA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLEVENTA(
    	IN _intIdOperacionVenta INT
    )
	BEGIN
		DELETE FROM tb_detalle_venta
		WHERE 
		intIdOperacionVenta = _intIdOperacionVenta;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDETALLESVENTA;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLESVENTA(
    	IN _intIdVenta INT
    )
	BEGIN
		DELETE FROM tb_detalle_venta
		WHERE 
		intIdVenta = _intIdVenta;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDETALLEVENTA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDETALLEVENTA(
    	IN _intIdVenta INT
    )
	BEGIN
		SELECT DV.*,CP.nvchCodigo,P.nvchDescripcion FROM tb_detalle_venta DV
		LEFT JOIN tb_producto P ON DV.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE
		DV.intIdVenta = _intIdVenta AND CP.intIdTipoCodigoProducto = 1;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODODETALLEVENTA;
DELIMITER $$
	CREATE PROCEDURE TODODETALLEVENTA()
	BEGIN
		SELECT * FROM tb_detalle_venta;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARCLIENTEVENTA;
DELIMITER $$
	CREATE PROCEDURE LISTARCLIENTEVENTA(
		IN _elemento VARCHAR(600),
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT intIdCliente,
			CASE 
				WHEN intIdTipoPersona = 1 THEN nvchRUC
				WHEN intIdTipoPersona = 2 THEN nvchDNI
			END AS IdentificadorCliente, 
			CASE 
				WHEN intIdTipoPersona = 1 THEN nvchRazonSocial
				WHEN intIdTipoPersona = 2 THEN CONCAT(nvchNombres,' ',nvchApellidoPaterno,' ',nvchApellidoMaterno)
			END AS NombreCliente,
		intIdTipoPersona 
		FROM tb_cliente 
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

DROP PROCEDURE IF EXISTS LISTARPRODUCTOVENTA;
DELIMITER $$
	CREATE PROCEDURE LISTARPRODUCTOVENTA(
		IN _elemento VARCHAR(600),
    	IN _x INT,
		IN _y INT
    )
	BEGIN
	IF(_TipoBusqueda = "T") THEN
		SELECT P.*, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		(P.intIdProducto LIKE CONCAT(_elemento,'%') OR
		P.nvchDescripcion LIKE CONCAT(_elemento,'%') OR
		P.nvchUnidadMedida LIKE CONCAT(_elemento,'%') OR
		P.intCantidad LIKE CONCAT(_elemento,'%') OR
		P.dcmPrecioVenta1 LIKE CONCAT(_elemento,'%') OR
		P.dcmPrecioVenta2 LIKE CONCAT(_elemento,'%') OR
		P.dcmPrecioVenta3 LIKE CONCAT(_elemento,'%') OR
		P.dtmFechaIngreso LIKE CONCAT(_elemento,'%')) AND
		CP.intIdTipoCodigoProducto = 1
		LIMIT _x,_y;
	END IF;
	IF(_TipoBusqueda = "C") THEN
		SELECT P.*, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
	END IF;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS PAGINARCLIENTEVENTA;
DELIMITER $$
	CREATE PROCEDURE PAGINARCLIENTEVENTA(
		IN _elemento VARCHAR(600)
    )
	BEGIN
		SELECT intIdCliente,
			CASE 
				WHEN intIdTipoPersona = 1 THEN nvchRUC
				WHEN intIdTipoPersona = 2 THEN nvchDNI
			END AS IdentificadorCliente, 
			CASE 
				WHEN intIdTipoPersona = 1 THEN nvchRazonSocial
				WHEN intIdTipoPersona = 2 THEN CONCAT(nvchNombres,' ',nvchApellidoPaterno,' ',nvchApellidoMaterno)
			END AS NombreCliente 
		FROM tb_cliente 
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

DROP PROCEDURE IF EXISTS PAGINARPRODUCTOVENTA;
DELIMITER $$
	CREATE PROCEDURE PAGINARPRODUCTOVENTA(
		IN _elemento VARCHAR(600)
    )
	BEGIN
	IF(_TipoBusqueda = "T") THEN
		SELECT P.*, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		(P.intIdProducto LIKE CONCAT(_elemento,'%') OR
		P.nvchDescripcion LIKE CONCAT(_elemento,'%') OR
		P.nvchUnidadMedida LIKE CONCAT(_elemento,'%') OR
		P.intCantidad LIKE CONCAT(_elemento,'%') OR
		P.dcmPrecioVenta1 LIKE CONCAT(_elemento,'%') OR
		P.dcmPrecioVenta2 LIKE CONCAT(_elemento,'%') OR
		P.dcmPrecioVenta3 LIKE CONCAT(_elemento,'%') OR
		P.dtmFechaIngreso LIKE CONCAT(_elemento,'%')) AND
		CP.intIdTipoCodigoProducto = 1;
	END IF;
	IF(_TipoBusqueda = "C") THEN
		SELECT P.*, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%');
	END IF;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS InsertarCotizacionVenta;
DELIMITER $$
	CREATE PROCEDURE InsertarCotizacionVenta(
    	IN _nvchNumeracion VARCHAR(25)
    )
	BEGIN
		SELECT DCT.*,CP.nvchCodigo,P.nvchDescripcion FROM tb_cotizacion CT
		LEFT JOIN tb_detalle_cotizacion DCT ON CT.intIdCotizacion = DCT.intIdCotizacion
		LEFT JOIN tb_producto P ON DCT.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE
		CT.nvchNumeracion = _nvchNumeracion AND CP.intIdTipoCodigoProducto = 1;
    END 
$$
DELIMITER ;