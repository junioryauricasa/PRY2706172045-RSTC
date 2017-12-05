USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARKARDEXPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INSERTARKARDEXPRODUCTO(
	OUT _intIdMovimiento INT,
	IN _intIdTipoMoneda INT,
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
		(dtmFechaMovimiento,intIdTipoMoneda,intTipoDetalle,intIdComprobante,intIdTipoComprobante,nvchSerie,nvchNumeracion,intIdProducto,
			intCantidadEntrada,intCantidadSalida,intCantidadStock,dcmPrecioEntrada,dcmTotalEntrada,dcmPrecioSalida,
			dcmTotalSalida,dcmSaldoValorizado)
		VALUES
		(_dtmFechaMovimiento,_intIdTipoMoneda,_intTipoDetalle,_intIdComprobante,_intIdTipoComprobante,_nvchSerie,_nvchNumeracion,_intIdProducto,
			_intCantidadEntrada,_intCantidadSalida,_intCantidadStock,_dcmPrecioEntrada,_dcmTotalEntrada,_dcmPrecioSalida,
			_dcmTotalSalida,_dcmSaldoValorizado);
		SET _intIdMovimiento = LAST_INSERT_ID();
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARKARDEXPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARKARDEXPRODUCTO(
	IN _intIdMovimiento INT,
	IN _intIdTipoMoneda INT,
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
		intIdTipoMoneda = _intIdTipoMoneda,
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

DROP PROCEDURE IF EXISTS MOSTRARULTIMOKARDEXPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARULTIMOKARDEXPRODUCTO(
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

DROP PROCEDURE IF EXISTS BUSCARKARDEXPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE BUSCARKARDEXPRODUCTO(
    	IN _elemento VARCHAR(500),
		IN _x INT,
		IN _y INT,
		IN _intIdProducto INT,
		IN _dtmFechaInicial DATETIME,
		IN _dtmFechaFinal DATETIME
    )
	BEGIN
		SELECT K.*, TC.nvchNombre AS NombreComprobante FROM tb_kardex K
		LEFT JOIN tb_tipo_comprobante TC ON K.intIdTipoComprobante = TC.intIdTipoComprobante
		WHERE intIdProducto = _intIdProducto AND
		(K.dtmFechaMovimiento BETWEEN _dtmFechaInicial AND _dtmFechaFinal)
		LIMIT _x,_y;
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARKARDEXPRODUCTO_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARKARDEXPRODUCTO_II(
    	IN _elemento VARCHAR(500),
    	IN _intIdProducto INT,
    	IN _dtmFechaInicial DATETIME,
    	IN _dtmFechaFinal DATETIME
    )
	BEGIN
		SELECT K.*, TC.nvchNombre AS NombreComprobante FROM tb_kardex K
		LEFT JOIN tb_tipo_comprobante TC ON K.intIdTipoComprobante = TC.intIdTipoComprobante
		WHERE intIdProducto = _intIdProducto AND
		(K.dtmFechaMovimiento BETWEEN _dtmFechaInicial AND _dtmFechaFinal);
    END 
$$
DELIMITER ;


SELECT dtmFechaIngreso AS FechaMovimiento, 'Entrada' AS TipoMovimiento, 'Apertura' AS TipoComprobante, 
		'-' AS Serie, '-' AS Numeracion, intCantidad AS Entrada , 0 AS Salida,
		(intCantidad + 0) AS Stock, dcmPrecioCompra AS PrecioEntrada, (dcmPrecioCompra*intCantidad) AS TotalEntrada,
		0.00 AS PrecioSalida, 0.00 AS TotalSalida, (dcmPrecioCompra*intCantidad) AS SaldoValorizado
		FROM tb_producto
		WHERE intIdProducto = 23
		UNION
SELECT dtmFechaCreacion AS FechaMovimiento, 
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN 'Salida'
			WHEN CR.intTipoDetalle = 2 THEN 'Entrada'
		END AS TipoMovimiento,
		TCR.nvchNombre AS TipoComprobante,
		CR.nvchSerie AS Serie,
		CR.nvchNumeracion AS Numeracion,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN 0
			WHEN CR.intTipoDetalle = 2 THEN SUM(DCR.intCantidad)
		END AS Entrada,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN SUM(DCR.intCantidad)
			WHEN CR.intTipoDetalle = 2 THEN 0
		END AS Salida,
		(SUM(DCR.intCantidad) + UlimoStock) AS Stock,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN 0
			WHEN CR.intTipoDetalle = 2 THEN SUM(DCR.dcmPrecioUnitario)
		END AS PrecioEntrada,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN 0
			WHEN CR.intTipoDetalle = 2 THEN SUM(DCR.dcmPrecioUnitario) * SUM(DCR.intCantidad)
		END AS TotalEntrada,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN SUM(DCR.dcmPrecioUnitario)
			WHEN CR.intTipoDetalle = 2 THEN 0
		END AS PrecioSalida,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN SUM(DCR.dcmPrecioUnitario) * SUM(DCR.intCantidad)
			WHEN CR.intTipoDetalle = 2 THEN 0
		END AS TotalSalida,
		SUM(DCR.dcmPrecioUnitario) * SUM(DCR.intCantidad) AS SaldoValorizado
		FROM tb_comprobante CR
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		WHERE DCR.intIdProducto = 23
		GROUP BY CR.intIdComprobante;

		DEFAULT SELECT COUNT(*) FROM tb_detalle_comprobante WHERE intIdComprobante = 23


DECLARE i INT DEFAULT 3;
WHILE i<5 DO
  SELECT COUNT(*) FROM tb_detalle_comprobante WHERE intIdComprobante = 23;
  SET i=i+1;
END WHILE;

DROP PROCEDURE IF EXISTS PRUEBAKARDEX;
DELIMITER $$
	CREATE PROCEDURE PRUEBAKARDEX()
	BEGIN
		SET @@Stock = 0;
		SELECT dtmFechaIngreso AS FechaMovimiento, 'Entrada' AS TipoMovimiento, 'Apertura' AS TipoComprobante, 
		'-' AS Serie, '-' AS Numeracion, intCantidad AS Entrada , 0 AS Salida,
		(@@Stock := intCantidad) AS Stock, (@@PrecioPromedio := 1000+125) AS PrecioEntrada, (dcmPrecioCompra*intCantidad) AS TotalEntrada,
		0.00 AS PrecioSalida, 0.00 AS TotalSalida, (@@SaldoValorizado := dcmPrecioCompra*intCantidad) AS SaldoValorizado
		FROM tb_producto
		WHERE intIdProducto = 23
		UNION
		SELECT dtmFechaCreacion AS FechaMovimiento,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN 'Salida'
			WHEN CR.intTipoDetalle = 2 THEN 'Entrada'
		END AS TipoMovimiento,
		TCR.nvchNombre AS TipoComprobante,
		CR.nvchSerie AS Serie,
		CR.nvchNumeracion AS Numeracion,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN 0
			WHEN CR.intTipoDetalle = 2 THEN DCR.intCantidad
		END AS Entrada,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN DCR.intCantidad
			WHEN CR.intTipoDetalle = 2 THEN 0
		END AS Salida,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN @Stock := @Stock - DCR.intCantidad
			WHEN CR.intTipoDetalle = 2 THEN @Stock := @Stock + DCR.intCantidad
		END AS Stock,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN 0
			WHEN CR.intTipoDetalle = 2 THEN DCR.dcmPrecioUnitario
		END AS PrecioEntrada,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN 0
			WHEN CR.intTipoDetalle = 2 THEN DCR.dcmPrecioUnitario * DCR.intCantidad
		END AS TotalEntrada,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN DCR.dcmPrecioUnitario
			WHEN CR.intTipoDetalle = 2 THEN 0
		END AS PrecioSalida,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN DCR.dcmPrecioUnitario * DCR.intCantidad
			WHEN CR.intTipoDetalle = 2 THEN 0
		END AS TotalSalida,
		DCR.dcmPrecioUnitario * DCR.intCantidad AS SaldoValorizado
		FROM tb_comprobante CR
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		WHERE DCR.intIdProducto = 23
		GROUP BY CR.intIdComprobante;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ej;
CREATE procedure ej (IN val int)     
  begin
    define i int;
    set i = 0;
    while i<5 do
      INSERT INTO prueba VALUES (i);
      set i=i+1;
    end while;
  end$$
delimiter ;