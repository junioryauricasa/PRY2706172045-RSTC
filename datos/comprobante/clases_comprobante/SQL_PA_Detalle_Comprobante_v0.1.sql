USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARDETALLECOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE INSERTARDETALLECOMPROBANTE(
	IN _intIdComprobante INT,
	IN _intIdTipoVenta INT,
	IN _intTipoDetalle INT,
	IN _dtmFechaRealizada DATETIME,
	IN _intIdProducto INT,
	IN _nvchCodigo VARCHAR(100),
	IN _nvchDescripcion VARCHAR(2500),
	IN _dcmPrecio DECIMAL(11,2),
	IN _dcmDescuento DECIMAL(11,2),
	IN _dcmPrecioUnitario DECIMAL(11,2),
	IN _intCantidad INT,
	IN _dcmTotal DECIMAL(11,2)
    )
	BEGIN
		INSERT INTO tb_detalle_comprobante 
		(intIdComprobante,intIdTipoVenta,intTipoDetalle,dtmFechaRealizada,intIdProducto,nvchCodigo,nvchDescripcion,dcmPrecio,dcmDescuento,
			dcmPrecioUnitario,intCantidad,dcmTotal)
		VALUES
		(_intIdComprobante,_intIdTipoVenta,_intTipoDetalle,_dtmFechaRealizada,_intIdProducto,_nvchCodigo,_nvchDescripcion,_dcmPrecio,_dcmDescuento,
			_dcmPrecioUnitario,_intCantidad,_dcmTotal);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARDETALLECOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARDETALLECOMPROBANTE(
	IN _intIdDetalleComprobante INT,
	IN _intIdComprobante INT,
	IN _intIdTipoVenta INT,
	IN _intTipoDetalle INT,
	IN _dtmFechaRealizada DATETIME,
	IN _intIdProducto INT,
	IN _nvchCodigo VARCHAR(100),
	IN _nvchDescripcion VARCHAR(2500),
	IN _dcmPrecio DECIMAL(11,2),
	IN _dcmDescuento DECIMAL(11,2),
	IN _dcmPrecioUnitario DECIMAL(11,2),
	IN _intCantidad INT,
	IN _dcmTotal DECIMAL(11,2)
    )
	BEGIN
		UPDATE tb_detalle_comprobante
		SET
		intIdComprobante = _intIdComprobante,
		intIdTipoVenta = _intIdTipoVenta,
		intTipoDetalle = _intTipoDetalle,
		dtmFechaRealizada = _dtmFechaRealizada,
		intIdProducto = _intIdProducto,
		nvchCodigo = _nvchCodigo,
		nvchDescripcion = _nvchDescripcion,
		dcmPrecio = _dcmPrecio,
		dcmDescuento = _dcmDescuento,
		dcmPrecioUnitario = _dcmPrecioUnitario,
		intCantidad = _intCantidad,
		dcmTotal = _dcmTotal
		WHERE 
		intIdDetalleComprobante = _intIdDetalleComprobante;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARDETALLECOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARDETALLECOMPROBANTE(
    	IN _intIdDetalleComprobante INT
    )
	BEGIN
		SELECT DCR.*,CP.nvchCodigo,P.nvchDescripcion,P.intCantidad AS CantidadProducto FROM tb_detalle_comprobante DCR
		LEFT JOIN tb_producto P ON DCR.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		DCR.intIdDetalleComprobante = _intIdDetalleComprobante;
    END 
$$
DELIMITER ;


DROP PROCEDURE IF EXISTS ELIMINARDETALLECOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLECOMPROBANTE(
    	IN _intIdDetalleComprobante INT
    )
	BEGIN
		DELETE FROM tb_detalle_comprobante
		WHERE 
		intIdDetalleComprobante = _intIdDetalleComprobante;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARDETALLESCOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE ELIMINARDETALLESCOMPROBANTE(
    	IN _intIdComprobante INT
    )
	BEGIN
		DELETE FROM tb_detalle_comprobante
		WHERE 
		intIdComprobante = _intIdComprobante;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDETALLECOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDETALLECOMPROBANTE(
    	IN _intIdComprobante INT
    )
	BEGIN
		SELECT DCR.*,CP.nvchCodigo AS CodigoProducto ,P.nvchDescripcion AS DescripcionProducto,TMN.nvchSimbolo, CR.intIdTipoComprobante
		FROM tb_detalle_comprobante DCR
		LEFT JOIN tb_comprobante CR ON CR.intIdComprobante = DCR.intIdComprobante
		LEFT JOIN tb_producto P ON DCR.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON CR.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE
		DCR.intIdComprobante = _intIdComprobante AND CP.intIdTipoCodigoProducto = 1;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDETALLECOMPROBANTESERVICIO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDETALLECOMPROBANTESERVICIO(
    	IN _intIdComprobante INT
    )
	BEGIN
		SELECT DCR.* FROM tb_detalle_comprobante DCR
		WHERE
		DCR.intIdComprobante = _intIdComprobante;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS INSERTARCOTIZACIONCOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE INSERTARCOTIZACIONCOMPROBANTE(
    	IN _intIdCotizacion INT
    )
	BEGIN
		SELECT DCT.*,CP.nvchCodigo,P.nvchDescripcion,CT.dtmFechaCreacion FROM tb_cotizacion CT
		LEFT JOIN tb_detalle_cotizacion DCT ON CT.intIdCotizacion = DCT.intIdCotizacion
		LEFT JOIN tb_producto P ON DCT.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE
		CT.intIdCotizacion = _intIdCotizacion AND CP.intIdTipoCodigoProducto = 1;
    END 
$$
DELIMITER ;