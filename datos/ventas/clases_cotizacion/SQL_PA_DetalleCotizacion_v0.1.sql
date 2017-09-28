USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDETALLECOTIZACION;
DELIMITER $$
	CREATE PROCEDURE INSERTARDETALLECOTIZACION(
	IN _intIdCotizacion INT,
	IN _intIdProducto INT,
	IN _dtmFechaRealizada DATETIME,
	IN _intCantidad INT,
	IN _intCantidadDisponible INT,
	IN _dcmPrecio DECIMAL(11,2),
	IN _dcmDescuento DECIMAL(11,2),
	IN _dcmPrecioUnitario DECIMAL(11,2),
	IN _dcmTotal DECIMAL(11,2),
	IN _intIdTipoVenta INT,
	IN _nvchDescripcionServicio VARCHAR(500)
    )
	BEGIN
		INSERT INTO tb_detalle_cotizacion 
		(intIdCotizacion,intIdProducto,dtmFechaRealizada,intCantidad,intCantidadDisponible,dcmPrecio,dcmDescuento,
			dcmPrecioUnitario,dcmTotal,intIdTipoVenta,nvchDescripcionServicio)
		VALUES
		(_intIdCotizacion,_intIdProducto,_dtmFechaRealizada,_intCantidad,_intCantidadDisponible,_dcmPrecio,_dcmDescuento,
			_dcmPrecioUnitario,_dcmTotal,_intIdTipoVenta,_nvchDescripcionServicio);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDETALLECOTIZACION;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDETALLECOTIZACION(
	IN _intIdOperacionCotizacion INT,
	IN _intIdCotizacion INT,
	IN _intIdProducto INT,
	IN _dtmFechaRealizada DATETIME,
	IN _intCantidad INT,
	IN _intCantidadDisponible INT,
	IN _dcmPrecio DECIMAL(11,2),
	IN _dcmDescuento DECIMAL(11,2),
	IN _dcmPrecioUnitario DECIMAL(11,2),
	IN _dcmTotal DECIMAL(11,2),
	IN _intIdTipoVenta INT,
	IN _nvchDescripcionServicio VARCHAR(500)
    )
	BEGIN
		UPDATE tb_detalle_cotizacion
		SET
		intIdCotizacion = _intIdCotizacion,
		intIdProducto = _intIdProducto,
		dtmFechaRealizada = _dtmFechaRealizada,
		intCantidad = _intCantidad,
		intCantidadDisponible = _intCantidadDisponible,
		dcmPrecio = _dcmPrecio,
		dcmDescuento = _dcmDescuento,
		dcmPrecioUnitario = _dcmPrecioUnitario,
		dcmTotal = _dcmTotal,
		intIdTipoVenta = _intIdTipoVenta,
		nvchDescripcionServicio = _nvchDescripcionServicio
		WHERE 
		intIdOperacionCotizacion = _intIdOperacionCotizacion;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARDETALLECOTIZACION;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARDETALLECOTIZACION(
    	IN _intIdOperacionCotizacion INT
    )
	BEGIN
		SELECT DCT.*,CP.nvchCodigo,P.nvchDescripcion,P.intCantidad AS CantidadProducto FROM tb_detalle_cotizacion DCT
		LEFT JOIN tb_producto P ON DCT.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		DCT.intIdOperacionCotizacion = _intIdOperacionCotizacion;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDETALLECOTIZACION;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLECOTIZACION(
    	IN _intIdOperacionCotizacion INT
    )
	BEGIN
		DELETE FROM tb_detalle_cotizacion
		WHERE 
		intIdOperacionCotizacion = _intIdOperacionCotizacion;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDETALLESCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLESCOTIZACION(
    	IN _intIdCotizacion INT
    )
	BEGIN
		DELETE FROM tb_detalle_cotizacion
		WHERE 
		intIdCotizacion = _intIdCotizacion;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDETALLECOTIZACION;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDETALLECOTIZACION(
    	IN _intIdCotizacion INT
    )
	BEGIN
		SELECT DCT.*,CP.nvchCodigo AS CodigoProducto ,P.nvchDescripcion AS DescripcionProducto FROM tb_detalle_cotizacion DCT
		LEFT JOIN tb_producto P ON DCT.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE
		DCT.intIdCotizacion = _intIdCotizacion AND CP.intIdTipoCodigoProducto = 1;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODODETALLECOTIZACION;
DELIMITER $$
	CREATE PROCEDURE TODODETALLECOTIZACION()
	BEGIN
		SELECT * FROM tb_detalle_cotizacion;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARCLIENTECOTIZACION;
DELIMITER $$
	CREATE PROCEDURE LISTARCLIENTECOTIZACION(
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

DROP PROCEDURE IF EXISTS LISTARPRODUCTOCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE LISTARPRODUCTOCOTIZACION(
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
		P.nvchNombre LIKE CONCAT(_elemento,'%') OR
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

DROP PROCEDURE IF EXISTS PAGINARCLIENTECOTIZACION;
DELIMITER $$
	CREATE PROCEDURE PAGINARCLIENTECOTIZACION(
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

DROP PROCEDURE IF EXISTS PAGINARPRODUCTOCOTIZACION;
DELIMITER $$
	CREATE PROCEDURE PAGINARPRODUCTOCOTIZACION(
		IN _elemento VARCHAR(600)
    )
	BEGIN
	IF(_TipoBusqueda = "T") THEN
		SELECT P.*, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		(P.intIdProducto LIKE CONCAT(_elemento,'%') OR
		P.nvchNombre LIKE CONCAT(_elemento,'%') OR
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