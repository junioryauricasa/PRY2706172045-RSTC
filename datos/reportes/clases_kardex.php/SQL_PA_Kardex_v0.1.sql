USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARKARDEX;
DELIMITER $$
	CREATE PROCEDURE INSERTARKARDEX(
	OUT _intIdMovimiento INT,
    IN _dtmFechaMovimiento DATETIME,
    IN _intIdComprobante INT,
    IN _intIdTipoComprobante INT,
    IN _intTipoDetalle INT,
    IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(8),
	IN _intIdProducto INT,
	IN _intCantidadEntrada DECIMAL(11,2),
	IN _dcmPrecioUnitarioEntrada DECIMAL(11,2),
	IN _dcmTotalEntrada DECIMAL(11,2),
	IN _intCantidadSalida DECIMAL(11,2),
	IN _dcmPrecioUnitarioSalida DECIMAL(11,2),
	IN _dcmTotalSalida DECIMAL(11,2),
	IN _intCantidalExistencia DECIMAL(11,2),
	IN _dcmPrecioUnitarilExistencia DECIMAL(11,2),
	IN _dcmTotalExistencia DECIMAL(11,2)
    )
	BEGIN
		INSERT INTO tb_kardex 
		(dtmFechaMovimiento,intIdComprobante,intIdTipoComprobante,intTipoDetalle,nvchSerie,nvchNumeracion,intIdProducto,
			intCantidadEntrada,dcmPrecioUnitarioEntrada,dcmTotalEntrada,_intCantidadSalida,dcmPrecioUnitarioSalida,dcmTotalSalida,
			intCantidadExistencia,dcmPrecioUnitarilExistencia,dcmTotalExistencia)
		VALUES
		(_dtmFechaMovimiento,_intIdComprobante,_intIdTipoComprobante,_intTipoDetalle,_nvchSerie,_nvchNumeracion,_intIdProducto,
			_intCantidadEntrada,_dcmPrecioUnitarioEntrada,_dcmTotalEntrada,_intCantidadSalida,_dcmPrecioUnitarioSalida,_dcmTotalSalida,
			_intCantidadExistencia,_dcmPrecioUnitarilExistencia,_dcmTotalExistencia);
		SET _intIdMovimiento = LAST_INSERT_ID();
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARKARDEX;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARKARDEX(
	IN _intIdMovimiento INT,
    IN _dtmFechaMovimiento DATETIME,
    IN _intIdComprobante INT,
    IN _intIdTipoComprobante INT,
    IN _intTipoDetalle INT,
    IN _nvchSerie VARCHAR(4),
	IN _nvchNumeracion VARCHAR(8),
	IN _intIdProducto INT,
	IN _intCantidadEntrada DECIMAL(11,2),
	IN _dcmPrecioUnitarioEntrada DECIMAL(11,2),
	IN _dcmTotalEntrada DECIMAL(11,2),
	IN _intCantidadSalida DECIMAL(11,2),
	IN _dcmPrecioUnitarioSalida DECIMAL(11,2),
	IN _dcmTotalSalida DECIMAL(11,2),
	IN _intCantidalExistencia DECIMAL(11,2),
	IN _dcmPrecioUnitarilExistencia DECIMAL(11,2),
	IN _dcmTotalExistencia DECIMAL(11,2)
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

DROP PROCEDURE IF EXISTS MOSTRARKARDEX;
DELIMITER $$
	CREATE PROCEDURE MOSTRARKARDEX(
    	IN _intIdMovimiento INT
    )
	BEGIN
		SELECT * FROM tb_kardex
		WHERE 
		intIdMovimiento = _intIdMovimiento;
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
		SELECT * FROM tb_kardex
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
		SELECT * FROM tb_kardex;
    END 
$$
DELIMITER ;