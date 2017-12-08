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

/*
DROP PROCEDURE IF EXISTS PRUEBAKARDEX;
DELIMITER $$
	CREATE PROCEDURE PRUEBAKARDEX(
		IN _intIdProducto INT
	)
	BEGIN
		SET @Stock = 0;
		SET @PrecioPromedio = 0.00;
		SET @SaldoValorizado = 0.00;
		SET @PrecioSalida = 0.00;
		SET @i = 1;
		SELECT dtmFechaIngreso AS FechaMovimiento, 'Entrada' AS TipoMovimiento, 'Apertura' AS TipoComprobante, 
		'-' AS Serie, '-' AS Numeracion, intCantidadInicial AS Entrada , 0 AS Salida,
		(@Stock := @Stock + intCantidadInicial) AS Stock, 
		(@PrecioPromedio := ROUND((@PrecioPromedio + (dcmPrecioCompra/1.18)),2)) AS PrecioEntrada,
		(ROUND(@PrecioPromedio,2)) AS PrecioPromedio,
	 	@i AS CantidadEntradas,
		ROUND((@PrecioPromedio*intCantidadInicial),2) AS TotalEntrada,
		0.00 AS PrecioSalida, 0.00 AS TotalSalida, 
		(@SaldoValorizado := ROUND((@SaldoValorizado + (@PrecioPromedio*intCantidadInicial)),2)) AS SaldoValorizado,
		intIdTipoMonedaCompra AS TipoMoneda,
		0 AS Iden
		FROM tb_producto
		WHERE intIdProducto = _intIdProducto
		UNION
		SELECT * FROM (
		SELECT dtmFechaCreacion AS FechaMovimiento,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN 'Salida'
			WHEN CR.intTipoDetalle = 2 THEN 'Entrada'
		END AS TipoMovimiento,
		TCR.nvchNombre AS TipoComprobante,
		CR.nvchSerie AS Serie,
		CR.nvchNumeracion AS Numeracion,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN DCR.intCantidad
		END AS Entrada,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN DCR.intCantidad
			WHEN DCR.intTipoDetalle = 2 THEN 0
		END AS Salida,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN @Stock := @Stock - DCR.intCantidad
			WHEN DCR.intTipoDetalle = 2 THEN @Stock := @Stock + DCR.intCantidad
		END AS Stock,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN ROUND((DCR.dcmPrecioUnitario/1.18),2)
		END AS PrecioEntrada,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN @PrecioPromedio := @PrecioPromedio + ROUND((DCR.dcmPrecioUnitario/1.18),2)
		END AS PrecioPromedio,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN @i := @i + 1
		END AS CantidadEntradas,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN ROUND((ROUND((DCR.dcmPrecioUnitario/1.18),2) * DCR.intCantidad),2)
		END AS TotalEntrada,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN @PrecioSalida := 0.00 + ROUND((@PrecioPromedio / @i),2)
			WHEN DCR.intTipoDetalle = 2 THEN 0
		END AS PrecioSalida,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN @PrecioSalida := ROUND((@PrecioSalida * DCR.intCantidad),2)
			WHEN DCR.intTipoDetalle = 2 THEN 0
		END AS TotalSalida,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN ROUND((@SaldoValorizado := @SaldoValorizado - @PrecioSalida),2)
			WHEN DCR.intTipoDetalle = 2 THEN ROUND((@SaldoValorizado := @SaldoValorizado + ROUND((ROUND((DCR.dcmPrecioUnitario/1.18),2) * DCR.intCantidad),2)),2)
		END AS SaldoValorizado,
		CR.intIdTipoMoneda AS TipoMoneda,
		CR.intIdComprobante AS Iden
		FROM tb_comprobante CR
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		WHERE DCR.intIdProducto = _intIdProducto
		ORDER BY DCR.dtmFechaRealizada ASC) AS Comprobantes GROUP BY Comprobantes.Iden;
    END 
$$
DELIMITER ;
*/
@PrecioPromedio := ROUND((@PrecioPromedio + (ROUND((P.dcmPrecioCompra/1.18),2)*CB.dcmCambio2)),2)

@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((DCR.dcmPrecioUnitario/1.18),2)*CB.dcmCambio2),2)
DROP PROCEDURE IF EXISTS PRUEBAKARDEX;  
DELIMITER $$
	CREATE PROCEDURE PRUEBAKARDEX(
		IN _intIdProducto INT,
		IN _intIdTipoMoneda INT
	)
	BEGIN
		SET @Stock = 0;
		SET @PrecioPromedio = 0.00;
		SET @PrecioEntrada = 0.00;
		SET @SaldoValorizado = 0.00;
		SET @PrecioSalida = 0.00;
		SET @i = 1;
		SELECT P.dtmFechaIngreso AS FechaMovimiento, 
		'Entrada' AS TipoMovimiento, 
		'Apertura' AS TipoComprobante, 
		'-' AS Serie, '-' AS Numeracion, 
		P.intCantidadInicial AS Entrada, 
		0 AS Salida,
		(@Stock := @Stock + P.intCantidadInicial) AS Stock,
		CASE
			WHEN P.intIdTipoMonedaCompra = _intIdTipoMoneda THEN ROUND((@PrecioPromedio := @PrecioPromedio + (P.dcmPrecioCompra/1.18)),2)
			WHEN P.intIdTipoMonedaCompra != _intIdTipoMoneda THEN 
				CASE 
					WHEN _intIdTipoMoneda = 1 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra/1.18),2)*CB.dcmCambio2),2)),2)
					WHEN _intIdTipoMoneda = 2 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra/1.18),2)/CB.dcmCambio2),2)),2)
				END
		END AS PrecioEntrada,
		(ROUND(@PrecioPromedio,2)) AS PrecioPromedio,
	 	@i AS CantidadEntradas,
		ROUND((@PrecioPromedio*P.intCantidadInicial),2) AS TotalEntrada,
		0.00 AS PrecioSalida, 0.00 AS TotalSalida, 
		(@SaldoValorizado := ROUND((@SaldoValorizado + (@PrecioPromedio*P.intCantidadInicial)),2)) AS SaldoValorizado,
		0 AS Iden,
		CB.dcmCambio2
		FROM tb_producto P
		LEFT JOIN tb_cambio_moneda_tributaria CB ON DATE(P.dtmFechaIngreso) = CB.dtmFechaCambio 
		WHERE P.intIdProducto = _intIdProducto
		UNION
		SELECT * FROM (
		SELECT CR.dtmFechaCreacion AS FechaMovimiento,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN 'Salida'
			WHEN CR.intTipoDetalle = 2 THEN 'Entrada'
		END AS TipoMovimiento,
		TCR.nvchNombre AS TipoComprobante,
		CR.nvchSerie AS Serie,
		CR.nvchNumeracion AS Numeracion,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN DCR.intCantidad
		END AS Entrada,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN DCR.intCantidad
			WHEN DCR.intTipoDetalle = 2 THEN 0
		END AS Salida,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN @Stock := @Stock - DCR.intCantidad
			WHEN DCR.intTipoDetalle = 2 THEN @Stock := @Stock + DCR.intCantidad
		END AS Stock,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN
				CASE
				WHEN CR.intIdTipoMoneda = _intIdTipoMoneda THEN ROUND((DCR.dcmPrecioUnitario/1.18),2)
				WHEN CR.intIdTipoMoneda != _intIdTipoMoneda THEN 
					CASE 
						WHEN _intIdTipoMoneda = 1 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario/1.18),2)*CB.dcmCambio2),2)
						WHEN _intIdTipoMoneda = 2 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario/1.18),2)/CB.dcmCambio2),2)
					END
				END
		END AS PrecioEntrada,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN ROUND((@PrecioPromedio := @PrecioPromedio + @PrecioEntrada),2)
		END AS PrecioPromedio,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN @i := @i + 1
		END AS CantidadEntradas,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN ROUND((ROUND((DCR.dcmPrecioUnitario/1.18),2) * DCR.intCantidad),2)
		END AS TotalEntrada,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN @PrecioSalida := 0.00 + ROUND((@PrecioPromedio / @i),2)
			WHEN DCR.intTipoDetalle = 2 THEN 0
		END AS PrecioSalida,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN @PrecioSalida := ROUND((@PrecioSalida * DCR.intCantidad),2)
			WHEN DCR.intTipoDetalle = 2 THEN 0
		END AS TotalSalida,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN ROUND((@SaldoValorizado := @SaldoValorizado - @PrecioSalida),2)
			WHEN DCR.intTipoDetalle = 2 THEN ROUND((@SaldoValorizado := @SaldoValorizado + @PrecioEntrada),2)
		END AS SaldoValorizado,
		CR.intIdComprobante AS Iden,
		CB.dcmCambio2
		FROM tb_detalle_comprobante DCR
		LEFT JOIN tb_comprobante CR ON CR.intIdComprobante = DCR.intIdComprobante
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		RIGHT JOIN tb_cambio_moneda_tributaria CB ON Date_Format(DCR.dtmFechaRealizada,'%Y-%m-%d 00:00:00') = CB.dtmFechaCambio 
		WHERE DCR.intIdProducto = _intIdProducto
		ORDER BY DCR.dtmFechaRealizada ASC) AS Comprobantes GROUP BY Comprobantes.Iden;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS PRUEBAKARDEX;
DELIMITER $$
	CREATE PROCEDURE PRUEBAKARDEX(
		IN _intIdProducto INT,
		IN _intIdTipoMoneda INT
	)
	BEGIN
		SET @Stock = 0;
		SET @PrecioPromedio = 0.00;
		SET @PrecioEntrada = 0.00;
		SET @SaldoValorizado = 0.00;
		SET @PrecioSalida = 0.00;
		SET @i = 1;
		SELECT
		@Cambio := (SELECT dcmCambio2 FROM tb_cambio_moneda_tributaria WHERE dtmFechaCambio = DATE(P.dtmFechaIngreso)) AS CambioMoneda,
		dtmFechaIngreso AS FechaMovimiento, 
		'Entrada' AS TipoMovimiento, 
		'Apertura' AS TipoComprobante, 
		'-' AS Serie, '-' AS Numeracion, 
		intCantidadInicial AS Entrada, 
		0 AS Salida,
		(@Stock := @Stock + intCantidadInicial) AS Stock, 
		CASE
			WHEN P.intIdTipoMonedaCompra = _intIdTipoMoneda THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((P.dcmPrecioCompra/1.18),2)),2)
			WHEN P.intIdTipoMonedaCompra != _intIdTipoMoneda THEN 
				CASE 
					WHEN _intIdTipoMoneda = 1 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra/1.18),2)*@Cambio),2)),2)
					WHEN _intIdTipoMoneda = 2 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra/1.18),2)/@Cambio),2)),2)
				END
		END AS PrecioEntrada,
		(ROUND(@PrecioPromedio,2)) AS PrecioPromedio,
	 	@i AS CantidadEntradas,
		ROUND((@PrecioPromedio*intCantidadInicial),2) AS TotalEntrada,
		0.00 AS PrecioSalida, 0.00 AS TotalSalida, 
		(@SaldoValorizado := ROUND((@SaldoValorizado + (@PrecioPromedio*intCantidadInicial)),2)) AS SaldoValorizado,
		intIdTipoMonedaCompra AS TipoMoneda,
		0 AS Iden
		FROM tb_producto P
		WHERE intIdProducto = _intIdProducto
		UNION
		SELECT * FROM (
		SELECT
		@Cambio := (SELECT dcmCambio2 FROM tb_cambio_moneda_tributaria WHERE dtmFechaCambio = DATE(CR.dtmFechaCreacion)) AS CambioMoneda, 
		dtmFechaCreacion AS FechaMovimiento,
		CASE 
			WHEN CR.intTipoDetalle = 1 THEN 'Salida'
			WHEN CR.intTipoDetalle = 2 THEN 'Entrada'
		END AS TipoMovimiento,
		TCR.nvchNombre AS TipoComprobante,
		CR.nvchSerie AS Serie,
		CR.nvchNumeracion AS Numeracion,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN DCR.intCantidad
		END AS Entrada,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN DCR.intCantidad
			WHEN DCR.intTipoDetalle = 2 THEN 0
		END AS Salida,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN @Stock := @Stock - DCR.intCantidad
			WHEN DCR.intTipoDetalle = 2 THEN @Stock := @Stock + DCR.intCantidad
		END AS Stock,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN
				CASE
				WHEN CR.intIdTipoMoneda = _intIdTipoMoneda THEN @PrecioEntrada := 0.00 + ROUND((DCR.dcmPrecioUnitario/1.18),2)
				WHEN CR.intIdTipoMoneda != _intIdTipoMoneda THEN 
					CASE 
						WHEN _intIdTipoMoneda = 1 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario/1.18),2)*@Cambio),2)
						WHEN _intIdTipoMoneda = 2 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario/1.18),2)/@Cambio),2)
					END
				END
		END AS PrecioEntrada,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN ROUND((@PrecioPromedio := @PrecioPromedio + @PrecioEntrada),2)
		END AS PrecioPromedio,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN @i := @i + 1
		END AS CantidadEntradas,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN 0
			WHEN DCR.intTipoDetalle = 2 THEN @PrecioEntrada := ROUND((@PrecioEntrada * DCR.intCantidad),2)
		END AS TotalEntrada,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN @PrecioSalida := 0.00 + ROUND((@PrecioPromedio / @i),2)
			WHEN DCR.intTipoDetalle = 2 THEN 0
		END AS PrecioSalida,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN @PrecioSalida := ROUND((@PrecioSalida * DCR.intCantidad),2)
			WHEN DCR.intTipoDetalle = 2 THEN 0
		END AS TotalSalida,
		CASE 
			WHEN DCR.intTipoDetalle = 1 THEN ROUND((@SaldoValorizado := @SaldoValorizado - @PrecioSalida),2)
			WHEN DCR.intTipoDetalle = 2 THEN ROUND((@SaldoValorizado := @SaldoValorizado + @PrecioEntrada),2)
		END AS SaldoValorizado,
		CR.intIdTipoMoneda AS TipoMoneda,
		CR.intIdComprobante AS Iden
		FROM tb_comprobante CR
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		WHERE DCR.intIdProducto = _intIdProducto
		ORDER BY DCR.dtmFechaRealizada,DCR.intIdComprobante ASC) AS Comprobantes GROUP BY Comprobantes.Iden;
    END 
$$
DELIMITER ;