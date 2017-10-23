USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARKARDEX;
DELIMITER $$
	CREATE PROCEDURE INSERTARKARDEX(
	OUT _intIdMovimiento INT,
    IN _dtmFechaMovimiento DATETIME,
    IN _intTipoDetalle INT,
    IN _intIdComprobante INT,
    IN _intIdTipoComprobante INT,
    IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(8),
	IN _intIdProducto INT,
	IN _intCantidadEntrada INT,
	IN _intCantidadSalida INT,
	IN _intCantidadStock INT,
	IN _dcmPrecioEntrada DECIMAL(11,2),
	IN _dcmTotalEntrada DECIMAL(11,2),
	IN _dcmPrecioSalida DECIMAL(11,2),
	IN _dcmTotalSalida DECIMAL(11,2),
	IN _dcmSaldoValorizado DECIMAL(11,2)
    )
	BEGIN
		INSERT INTO tb_kardex 
		(dtmFechaMovimiento,intTipoDetalle,intIdComprobante,intIdTipoComprobante,nvchSerie,nvchNumeracion,intIdProducto,
			intCantidadEntrada,intCantidadSalida,intCantidadStock,dcmPrecioEntrada,dcmTotalEntrada,dcmPrecioSalida,
			dcmTotalSalida,dcmSaldoValorizado)
		VALUES
		(_dtmFechaMovimiento,_intTipoDetalle,_intIdComprobante,_intIdTipoComprobante,_nvchSerie,_nvchNumeracion,_intIdProducto,
			_intCantidadEntrada,_intCantidadSalida,_intCantidadStock,_dcmPrecioEntrada,_dcmTotalEntrada,_dcmPrecioSalida,
			_dcmTotalSalida,_dcmSaldoValorizado);
		SET _intIdMovimiento = LAST_INSERT_ID();
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARKARDEX;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARKARDEX(
	IN _intIdMovimiento INT,
    IN _dtmFechaMovimiento DATETIME,
    IN _intTipoDetalle INT,
    IN _intIdComprobante INT,
    IN _intIdTipoComprobante INT,
    IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(8),
	IN _intIdProducto INT,
	IN _intCantidadEntrada INT,
	IN _intCantidadSalida INT,
	IN _intCantidadStock INT,
	IN _dcmPrecioEntrada DECIMAL(11,2),
	IN _dcmTotalEntrada DECIMAL(11,2),
	IN _dcmPrecioSalida DECIMAL(11,2),
	IN _dcmTotalSalida DECIMAL(11,2),
	IN _dcmSaldoValorizado DECIMAL(11,2)
    )
	BEGIN
		UPDATE tb_kardex
		SET
		nvchDescripcion = _nvchDescripcion,
		nvchUnidadMedida = _nvchUnidadMedida,
		intCantidad = _intCantidad,
		intCantidadMinima = _intCantidadMinima,
		nvchDireccionImg = _nvchDireccionImg,
		dcmPrecioVenta1 = _dcmPrecioVenta1,
		dcmPrecioVenta2 = _dcmPrecioVenta2,
		dcmPrecioVenta3 = _dcmPrecioVenta3,
		dcmDescuentoVenta2 = _dcmDescuentoVenta2,
		dcmDescuentoVenta3 = _dcmDescuentoVenta3,
		intIdTipoMoneda = _intIdTipoMoneda,
		dtmFechaIngreso = _dtmFechaIngreso,
		nvchObservacion = _nvchObservacion
		WHERE 
		intIdMovimiento = _intIdMovimiento;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARULTIMOKARDEX;
DELIMITER $$
	CREATE PROCEDURE MOSTRARULTIMOKARDEX(
		IN _intIdProducto INT
		)
	BEGIN
		SELECT * FROM tb_kardex
		WHERE intIdProducto = _intIdProducto
		ORDER BY intIdMovimiento DESC
		LIMIT 1;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS PROMEDIOPRECIOSALIDA;
DELIMITER $$
	CREATE PROCEDURE PROMEDIOPRECIOSALIDA(
		IN _intIdProducto INT
		)
	BEGIN
		SELECT AVG(dcmPrecioEntrada) AS PromedioSalida FROM tb_kardex
		WHERE intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARKARDEX;
DELIMITER $$
	CREATE PROCEDURE ELIMINARKARDEX(
    	IN _intIdMovimiento INT
    )
	BEGIN
		DELETE FROM tb_kardex
		WHERE 
		intIdMovimiento = _intIdMovimiento;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARKARDEX;
DELIMITER $$
	CREATE PROCEDURE BUSCARKARDEX(
    	IN _elemento VARCHAR(500),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT K.*, TC.nvchNombre AS NombreComprobante FROM tb_kardex K
		LEFT JOIN tb_tipo_comprobante TC ON K.intIdTipoComprobante = TC.intIdTipoComprobante

		LIMIT _x,_y;
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARKARDEX_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARKARDEX_II(
    	IN _elemento VARCHAR(500)
    )
	BEGIN
		SELECT K.*, TC.nvchNombre AS NombreComprobante FROM tb_kardex K
		LEFT JOIN tb_tipo_comprobante TC ON K.intIdTipoComprobante = TC.intIdTipoComprobante;
    END 
$$
DELIMITER ;