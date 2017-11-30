USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARCOTIZACIONEQUIPO;
DELIMITER $$
	CREATE PROCEDURE INSERTARCOTIZACIONEQUIPO(
	OUT _intIdCotizacionEquipo INT,
    IN _dtmFechaCreacion DATETIME,
    IN _intIdTipoVenta INT,
    IN _intIdPlantillaCotizacion INT,
    IN _intIdUsuario INT,
    IN _intIdCliente INT,
    IN _nvchClienteProveedor VARCHAR(350),
    IN _nvchDNIRUC VARCHAR(11),
	IN _nvchDireccion VARCHAR(450),
	IN _nvchAtencion VARCHAR(250),
	IN _nvchGarantia VARCHAR(250),
	IN _nvchFormaPago VARCHAR(250),
	IN _nvchLugarEntrega VARCHAR(250),
	IN _nvchTiempoEntrega VARCHAR(250),
	IN _nvchDiasValidez VARCHAR(50),
	In _intIdTipoMoneda INT,
	IN _dcmPrecioVenta DECIMAL(11,2),
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		INSERT INTO tb_cotizacion_equipo
		(dtmFechaCreacion,intIdTipoVenta,intIdPlantillaCotizacion,intIdUsuario,intIdCliente,nvchClienteProveedor,nvchDNIRUC,
		nvchDireccion,nvchAtencion,nvchGarantia,nvchFormaPago,nvchLugarEntrega,nvchTiempoEntrega,nvchDiasValidez,dcmPrecioVenta,
		intIdTipoMoneda,nvchObservacion)
		VALUES
		(_dtmFechaCreacion,_intIdTipoVenta,_intIdPlantillaCotizacion,_intIdUsuario,_intIdCliente,_nvchClienteProveedor,_nvchDNIRUC,
		_nvchDireccion,_nvchAtencion,_nvchGarantia,_nvchFormaPago,_nvchLugarEntrega,_nvchTiempoEntrega,_nvchDiasValidez,_dcmPrecioVenta,
		_intIdTipoMoneda,_nvchObservacion);
		SET _intIdCotizacionEquipo = LAST_INSERT_ID();
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARCOTIZACIONEQUIPO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARCOTIZACIONEQUIPO(
	IN _intIdCotizacionEquipo INT,
    IN _dtmFechaCreacion DATETIME,
    IN _intIdTipoVenta INT,
    IN _intIdPlantillaCotizacion INT,
    IN _intIdUsuario INT,
    IN _intIdCliente INT,
    IN _nvchClienteProveedor VARCHAR(350),
    IN _nvchDNIRUC VARCHAR(11),
	IN _nvchDireccion VARCHAR(450),
	IN _nvchAtencion VARCHAR(250),
	IN _nvchGarantia VARCHAR(250),
	IN _nvchFormaPago VARCHAR(250),
	IN _nvchLugarEntrega VARCHAR(250),
	IN _nvchTiempoEntrega VARCHAR(250),
	IN _nvchDiasValidez VARCHAR(50),
	In _intIdTipoMoneda INT,
	IN _dcmPrecioVenta DECIMAL(11,2),
	IN _nvchObservacion VARCHAR(2500)
    )
	BEGIN
		UPDATE tb_cotizacion_equipo
		SET
		dtmFechaCreacion = _dtmFechaCreacion,
		intIdTipoVenta = _intIdTipoVenta,
		intIdUsuario = _intIdUsuario,
		intIdCliente = _intIdCliente,
		nvchClienteProveedor = _nvchClienteProveedor,
		nvchDNIRUC = _nvchDNIRUC,
		nvchDireccion = _nvchDireccion,
		nvchAtencion = _nvchAtencion,
		nvchGarantia = _nvchGarantia,
		nvchFormaPago = _nvchFormaPago,
		nvchLugarEntrega = _nvchLugarEntrega,
		nvchTiempoEntrega = _nvchTiempoEntrega,
		nvchDiasValidez = _nvchDiasValidez,
		intIdTipoMoneda = _intIdTipoMoneda,
		dcmPrecioVenta = _dcmPrecioVenta,
		nvchObservacion = _nvchObservacion
		WHERE 
		intIdCotizacionEquipo = _intIdCotizacionEquipo;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARCOTIZACIONEQUIPO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARCOTIZACIONEQUIPO(
    	IN _intIdCotizacionEquipo INT
    )
	BEGIN
		SELECT * FROM tb_cotizacion_equipo 
		WHERE intIdCotizacionEquipo = _intIdCotizacionEquipo;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARCOTIZACIONEQUIPO;
DELIMITER $$
	CREATE PROCEDURE ELIMINARCOTIZACIONEQUIPO(
    	IN _intIdCotizacionEquipo INT
    )
	BEGIN
		DELETE FROM tb_cotizacion_equipo
		WHERE 
		intIdCotizacionEquipo = _intIdCotizacionEquipo;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARCOTIZACIONEQUIPO;
DELIMITER $$
	CREATE PROCEDURE BUSCARCOTIZACIONEQUIPO(
    	IN _elemento VARCHAR(500),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT * FROM tb_cotizacion_equipo
		WHERE 
		nvchClienteProveedor LIKE CONCAT(_elemento,'%') OR
		nvchDNIRUC LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARCOTIZACIONEQUIPO_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARCOTIZACIONEQUIPO_II(
    	IN _elemento VARCHAR(500)
    )
	BEGIN
		SELECT * FROM tb_cotizacion_equipo
		WHERE 
		nvchClienteProveedor LIKE CONCAT(_elemento,'%') OR
		nvchDNIRUC LIKE CONCAT(_elemento,'%');
    END 
$$
DELIMITER ;