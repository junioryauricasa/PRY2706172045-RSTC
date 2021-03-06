DROP PROCEDURE IF EXISTS KARDEXPRODUCTO_II;
DELIMITER $$
	CREATE PROCEDURE KARDEXPRODUCTO_II(
		IN _intIdProducto INT,
		IN _intIdTipoMoneda INT,
		IN _intIdSucursal INT
	)
	BEGIN
		SET @Stock = 0;
		SET @PrecioPromedio = 0.00;
		SET @PrecioEntrada = 0.00;
		SET @SaldoValorizado = 0.00;
		SET @PrecioSalida = 0.00;
		SET @i = 1;
		IF (_intIdSucursal = "T") THEN
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
			WHEN P.intIdTipoMonedaCompra = _intIdTipoMoneda THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((P.dcmPrecioCompra),2)),2)
			WHEN P.intIdTipoMonedaCompra != _intIdTipoMoneda THEN 
				CASE 
					WHEN _intIdTipoMoneda = 1 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)*@Cambio),2)),2)
					WHEN _intIdTipoMoneda = 2 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)/@Cambio),2)),2)
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
		WHERE P.intIdProducto = _intIdProducto AND P.intCantidadInicial != 0
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
				WHEN CR.intIdTipoMoneda = _intIdTipoMoneda THEN @PrecioEntrada := 0.00 + ROUND((DCR.dcmPrecioUnitario),2)
				WHEN CR.intIdTipoMoneda != _intIdTipoMoneda THEN 
					CASE 
						WHEN _intIdTipoMoneda = 1 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)*@Cambio),2)
						WHEN _intIdTipoMoneda = 2 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)/@Cambio),2)
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
		WHERE DCR.intIdProducto = _intIdProducto AND CR.intDescontarGR != 0
		ORDER BY DCR.dtmFechaRealizada ASC) AS Comprobantes GROUP BY Comprobantes.FechaMovimiento,Comprobantes.Iden;

		ELSEIF (_intIdSucursal >= 1) THEN
		
		SELECT
		@Cambio := (SELECT dcmCambio2 FROM tb_cambio_moneda_tributaria WHERE dtmFechaCambio = DATE(P.dtmFechaIngreso)) AS CambioMoneda,
		P.dtmFechaIngreso AS FechaMovimiento, 
		'Entrada' AS TipoMovimiento, 
		'Apertura' AS TipoComprobante, 
		'-' AS Serie, '-' AS Numeracion, 
		UP.intCantidadInicial AS Entrada, 
		0 AS Salida,
		(@Stock := @Stock + UP.intCantidadInicial) AS Stock, 
		CASE
			WHEN P.intIdTipoMonedaCompra = _intIdTipoMoneda THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((P.dcmPrecioCompra),2)),2)
			WHEN P.intIdTipoMonedaCompra != _intIdTipoMoneda THEN 
				CASE 
					WHEN _intIdTipoMoneda = 1 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)*@Cambio),2)),2)
					WHEN _intIdTipoMoneda = 2 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)/@Cambio),2)),2)
				END
		END AS PrecioEntrada,
		(ROUND(@PrecioPromedio,2)) AS PrecioPromedio,
	 	@i AS CantidadEntradas,
		ROUND((@PrecioPromedio*UP.intCantidadInicial),2) AS TotalEntrada,
		0.00 AS PrecioSalida, 0.00 AS TotalSalida, 
		(@SaldoValorizado := ROUND((@SaldoValorizado + (@PrecioPromedio*UP.intCantidadInicial)),2)) AS SaldoValorizado,
		P.intIdTipoMonedaCompra AS TipoMoneda,
		0 AS Iden
		FROM tb_producto P
		LEFT JOIN tb_ubigeo_producto UP ON P.intIdProducto = UP.intIdProducto
		WHERE P.intIdProducto = _intIdProducto AND UP.intIdSucursal = _intIdSucursal AND UP.intEstado = 1
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
				WHEN CR.intIdTipoMoneda = _intIdTipoMoneda THEN @PrecioEntrada := 0.00 + ROUND((DCR.dcmPrecioUnitario),2)
				WHEN CR.intIdTipoMoneda != _intIdTipoMoneda THEN 
					CASE 
						WHEN _intIdTipoMoneda = 1 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)*@Cambio),2)
						WHEN _intIdTipoMoneda = 2 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)/@Cambio),2)
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
		WHERE DCR.intIdProducto = _intIdProducto AND CR.intIdSucursal = _intIdSucursal AND CR.intDescontarGR != 0
		ORDER BY DCR.dtmFechaRealizada ASC) AS Comprobantes GROUP BY Comprobantes.FechaMovimiento,Comprobantes.Iden;
		END IF;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS KARDEXPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE KARDEXPRODUCTO(
		IN _intIdProducto INT,
		IN _intIdTipoMoneda INT,
		IN _intIdSucursal INT,
		IN _x INT,
		IN _y INT
	)
	BEGIN
		SET @Stock = 0;
		SET @PrecioPromedio = 0.00;
		SET @PrecioEntrada = 0.00;
		SET @SaldoValorizado = 0.00;
		SET @PrecioSalida = 0.00;
		SET @i = 1;
		IF (_intIdSucursal = "T") THEN
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
			WHEN P.intIdTipoMonedaCompra = _intIdTipoMoneda THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((P.dcmPrecioCompra),2)),2)
			WHEN P.intIdTipoMonedaCompra != _intIdTipoMoneda THEN 
				CASE 
					WHEN _intIdTipoMoneda = 1 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)*@Cambio),2)),2)
					WHEN _intIdTipoMoneda = 2 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)/@Cambio),2)),2)
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
		WHERE P.intIdProducto = _intIdProducto AND P.intCantidadInicial != 0
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
				WHEN CR.intIdTipoMoneda = _intIdTipoMoneda THEN @PrecioEntrada := 0.00 + ROUND((DCR.dcmPrecioUnitario),2)
				WHEN CR.intIdTipoMoneda != _intIdTipoMoneda THEN 
					CASE 
						WHEN _intIdTipoMoneda = 1 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)*@Cambio),2)
						WHEN _intIdTipoMoneda = 2 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)/@Cambio),2)
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
		WHERE DCR.intIdProducto = _intIdProducto AND CR.intDescontarGR != 0
		ORDER BY DCR.dtmFechaRealizada ASC) AS Comprobantes GROUP BY Comprobantes.FechaMovimiento,Comprobantes.Iden
		LIMIT _x,_y;

		ELSEIF (_intIdSucursal >= 1) THEN
		
		SELECT
		@Cambio := (SELECT dcmCambio2 FROM tb_cambio_moneda_tributaria WHERE dtmFechaCambio = DATE(P.dtmFechaIngreso)) AS CambioMoneda,
		P.dtmFechaIngreso AS FechaMovimiento, 
		'Entrada' AS TipoMovimiento, 
		'Apertura' AS TipoComprobante, 
		'-' AS Serie, '-' AS Numeracion, 
		UP.intCantidadInicial AS Entrada, 
		0 AS Salida,
		(@Stock := @Stock + UP.intCantidadInicial) AS Stock, 
		CASE
			WHEN P.intIdTipoMonedaCompra = _intIdTipoMoneda THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((P.dcmPrecioCompra),2)),2)
			WHEN P.intIdTipoMonedaCompra != _intIdTipoMoneda THEN 
				CASE 
					WHEN _intIdTipoMoneda = 1 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)*@Cambio),2)),2)
					WHEN _intIdTipoMoneda = 2 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)/@Cambio),2)),2)
				END
		END AS PrecioEntrada,
		(ROUND(@PrecioPromedio,2)) AS PrecioPromedio,
	 	@i AS CantidadEntradas,
		ROUND((@PrecioPromedio*UP.intCantidadInicial),2) AS TotalEntrada,
		0.00 AS PrecioSalida, 0.00 AS TotalSalida, 
		(@SaldoValorizado := ROUND((@SaldoValorizado + (@PrecioPromedio*UP.intCantidadInicial)),2)) AS SaldoValorizado,
		P.intIdTipoMonedaCompra AS TipoMoneda,
		0 AS Iden
		FROM tb_producto P
		LEFT JOIN tb_ubigeo_producto UP ON P.intIdProducto = UP.intIdProducto
		WHERE P.intIdProducto = _intIdProducto AND UP.intIdSucursal = _intIdSucursal AND UP.intEstado = 1
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
				WHEN CR.intIdTipoMoneda = _intIdTipoMoneda THEN @PrecioEntrada := 0.00 + ROUND((DCR.dcmPrecioUnitario),2)
				WHEN CR.intIdTipoMoneda != _intIdTipoMoneda THEN 
					CASE 
						WHEN _intIdTipoMoneda = 1 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)*@Cambio),2)
						WHEN _intIdTipoMoneda = 2 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)/@Cambio),2)
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
		WHERE DCR.intIdProducto = _intIdProducto AND CR.intIdSucursal = _intIdSucursal AND CR.intDescontarGR != 0
		ORDER BY DCR.dtmFechaRealizada ASC) AS Comprobantes GROUP BY Comprobantes.FechaMovimiento,Comprobantes.Iden
		LIMIT _x,_y;
		END IF;
    END 
$$
DELIMITER ;

select * from
(select cr.*,cr.intIdComprobante AS Iden,cr.dtmFechaCreacion as fecha from tb_comprobante cr where cr.inttipodetalle=1 
	or 
cr.intidcomprobante=4 order by cr.dtmfechacreacion,cr.intIdComprobante ASC) 
as d group by fecha,Iden order by fecha desc;

DROP PROCEDURE IF EXISTS KARDEXGENERAL;
DELIMITER $$
	CREATE PROCEDURE KARDEXGENERAL(
		IN _intIdTipoMoneda INT,
		IN _intIdProducto INT,
		IN _intIdSucursal INT
	)
	BEGIN
		SET @Stock = 0;
		SET @PrecioPromedio = 0.00;
		SET @PrecioEntrada = 0.00;
		SET @SaldoValorizado = 0.00;
		SET @PrecioSalida = 0.00;
		SET @i = 1;
		SET @intIdProducto = 0;
		
		IF(_intIdSucursal = "T") THEN

		SELECT * FROM (
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
			WHEN P.intIdTipoMonedaCompra = _intIdTipoMoneda THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((P.dcmPrecioCompra),2)),2)
			WHEN P.intIdTipoMonedaCompra != _intIdTipoMoneda THEN 
				CASE 
					WHEN _intIdTipoMoneda = 1 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)*@Cambio),2)),2)
					WHEN _intIdTipoMoneda = 2 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)/@Cambio),2)),2)
				END
		END AS PrecioEntrada,
		(ROUND(@PrecioPromedio,2)) AS PrecioPromedio,
			@i AS CantidadEntradas,
		ROUND((@PrecioPromedio*intCantidadInicial),2) AS TotalEntrada,
		0.00 AS PrecioSalida, 0.00 AS TotalSalida, 
		(@SaldoValorizado := ROUND((@SaldoValorizado + (@PrecioPromedio*intCantidadInicial)),2)) AS SaldoValorizado,
		intIdTipoMonedaCompra AS TipoMoneda,
		'0' AS Iden,
		P.intIdProducto
		FROM tb_producto P
		WHERE P.intIdProducto = _intIdProducto AND P.intCantidadInicial != 0
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
				WHEN CR.intIdTipoMoneda = _intIdTipoMoneda THEN @PrecioEntrada := 0.00 + ROUND((DCR.dcmPrecioUnitario),2)
				WHEN CR.intIdTipoMoneda != _intIdTipoMoneda THEN 
					CASE 
						WHEN _intIdTipoMoneda = 1 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)*@Cambio),2)
						WHEN _intIdTipoMoneda = 2 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)/@Cambio),2)
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
		CR.intIdComprobante AS Iden,
		DCR.intIdProducto
		FROM tb_comprobante CR
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		WHERE DCR.intIdProducto = _intIdProducto AND CR.intDescontarGR != 0
		ORDER BY DCR.dtmFechaRealizada ASC) AS Comprobantes GROUP BY Comprobantes.FechaMovimiento,Comprobantes.Iden)
		AS KardexGeneral GROUP BY KardexGeneral.FechaMovimiento,KardexGeneral.Iden ORDER BY KardexGeneral.FechaMovimiento DESC LIMIT 1;

		ELSEIF(_intIdSucursal >= 1) THEN

		SELECT * FROM (
		SELECT
		@Cambio := (SELECT dcmCambio2 FROM tb_cambio_moneda_tributaria WHERE dtmFechaCambio = DATE(P.dtmFechaIngreso)) AS CambioMoneda,
		dtmFechaIngreso AS FechaMovimiento, 
		'Entrada' AS TipoMovimiento, 
		'Apertura' AS TipoComprobante, 
		'-' AS Serie, '-' AS Numeracion, 
		UP.intCantidadInicial AS Entrada, 
		0 AS Salida,
		(@Stock := @Stock + UP.intCantidadInicial) AS Stock, 
		CASE
			WHEN P.intIdTipoMonedaCompra = _intIdTipoMoneda THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((P.dcmPrecioCompra),2)),2)
			WHEN P.intIdTipoMonedaCompra != _intIdTipoMoneda THEN 
				CASE 
					WHEN _intIdTipoMoneda = 1 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)*@Cambio),2)),2)
					WHEN _intIdTipoMoneda = 2 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)/@Cambio),2)),2)
				END
		END AS PrecioEntrada,
		(ROUND(@PrecioPromedio,2)) AS PrecioPromedio,
			@i AS CantidadEntradas,
		ROUND((@PrecioPromedio*UP.intCantidadInicial),2) AS TotalEntrada,
		0.00 AS PrecioSalida, 0.00 AS TotalSalida, 
		(@SaldoValorizado := ROUND((@SaldoValorizado + (@PrecioPromedio*UP.intCantidadInicial)),2)) AS SaldoValorizado,
		intIdTipoMonedaCompra AS TipoMoneda,
		'0' AS Iden,
		P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_ubigeo_producto UP ON P.intIdProducto = UP.intIdProducto
		WHERE P.intIdProducto = _intIdProducto AND UP.intIdSucursal = _intIdSucursal AND UP.intEstado = 1
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
				WHEN CR.intIdTipoMoneda = _intIdTipoMoneda THEN @PrecioEntrada := 0.00 + ROUND((DCR.dcmPrecioUnitario),2)
				WHEN CR.intIdTipoMoneda != _intIdTipoMoneda THEN 
					CASE 
						WHEN _intIdTipoMoneda = 1 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)*@Cambio),2)
						WHEN _intIdTipoMoneda = 2 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)/@Cambio),2)
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
		CR.intIdComprobante AS Iden,
		DCR.intIdProducto
		FROM tb_comprobante CR
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		WHERE DCR.intIdProducto = _intIdProducto AND CR.intIdSucursal = _intIdSucursal AND CR.intDescontarGR != 0
		ORDER BY DCR.dtmFechaRealizada ASC) AS Comprobantes GROUP BY Comprobantes.FechaMovimiento,Comprobantes.Iden)
		AS KardexGeneral GROUP BY KardexGeneral.FechaMovimiento,KardexGeneral.Iden ORDER BY KardexGeneral.FechaMovimiento DESC LIMIT 1;

		END IF;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS KARDEXGENERAL_II;
DELIMITER $$
	CREATE PROCEDURE KARDEXGENERAL_II(
		IN _intIdTipoMoneda INT,
		IN _intIdProducto INT,
		IN _intIdSucursal INT
	)
	BEGIN
		SET @Stock = 0;
		SET @PrecioPromedio = 0.00;
		SET @PrecioEntrada = 0.00;
		SET @SaldoValorizado = 0.00;
		SET @PrecioSalida = 0.00;
		SET @i = 1;
		SET @intIdProducto = 0;
		
		IF(_intIdSucursal = "T") THEN

		SELECT * FROM (
		SELECT
		@Cambio := (SELECT dcmCambio2 FROM tb_cambio_moneda_tributaria WHERE dtmFechaCambio = DATE(P.dtmFechaIngreso)) AS CambioMoneda,
		P.dtmFechaIngreso AS FechaMovimiento, 
		'Entrada' AS TipoMovimiento, 
		'Apertura' AS TipoComprobante, 
		'-' AS Serie, '-' AS Numeracion, 
		intCantidadInicial AS Entrada, 
		0 AS Salida,
		(@Stock := @Stock + intCantidadInicial) AS Stock, 
		CASE
			WHEN P.intIdTipoMonedaCompra = _intIdTipoMoneda THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((P.dcmPrecioCompra),2)),2)
			WHEN P.intIdTipoMonedaCompra != _intIdTipoMoneda THEN 
				CASE 
					WHEN _intIdTipoMoneda = 1 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)*@Cambio),2)),2)
					WHEN _intIdTipoMoneda = 2 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)/@Cambio),2)),2)
				END
		END AS PrecioEntrada,
		(ROUND(@PrecioPromedio,2)) AS PrecioPromedio,
			@i AS CantidadEntradas,
		ROUND((@PrecioPromedio*intCantidadInicial),2) AS TotalEntrada,
		0.00 AS PrecioSalida, 0.00 AS TotalSalida, 
		(@SaldoValorizado := ROUND((@SaldoValorizado + (@PrecioPromedio*intCantidadInicial)),2)) AS SaldoValorizado,
		intIdTipoMonedaCompra AS TipoMoneda,
		'0' AS Iden,
		P.intIdProducto
		FROM tb_producto P
		WHERE P.intIdProducto = _intIdProducto AND P.intCantidadInicial != 0
		UNION
		SELECT * FROM (
		SELECT
		@Cambio := (SELECT dcmCambio2 FROM tb_cambio_moneda_tributaria WHERE dtmFechaCambio = DATE(CR.dtmFechaCreacion)) AS CambioMoneda, 
		CR.dtmFechaCreacion AS FechaMovimiento,
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
				WHEN CR.intIdTipoMoneda = _intIdTipoMoneda THEN @PrecioEntrada := 0.00 + ROUND((DCR.dcmPrecioUnitario),2)
				WHEN CR.intIdTipoMoneda != _intIdTipoMoneda THEN 
					CASE 
						WHEN _intIdTipoMoneda = 1 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)*@Cambio),2)
						WHEN _intIdTipoMoneda = 2 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)/@Cambio),2)
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
		CR.intIdComprobante AS Iden,
		DCR.intIdProducto
		FROM tb_comprobante CR
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		WHERE DCR.intIdProducto = _intIdProducto AND  CR.intDescontarGR != 0
		ORDER BY DCR.dtmFechaRealizada ASC) AS Comprobantes GROUP BY Comprobantes.FechaMovimiento,Comprobantes.Iden)
		AS KardexGeneral GROUP BY KardexGeneral.FechaMovimiento,KardexGeneral.Iden ORDER BY KardexGeneral.FechaMovimiento DESC LIMIT 1;

		ELSEIF(_intIdSucursal >= 1) THEN

		SELECT * FROM (
		SELECT
		@Cambio := (SELECT dcmCambio2 FROM tb_cambio_moneda_tributaria WHERE dtmFechaCambio = DATE(P.dtmFechaIngreso)) AS CambioMoneda,
		P.dtmFechaIngreso AS FechaMovimiento, 
		'Entrada' AS TipoMovimiento, 
		'Apertura' AS TipoComprobante, 
		'-' AS Serie, '-' AS Numeracion, 
		UP.intCantidadInicial AS Entrada, 
		0 AS Salida,
		(@Stock := @Stock + UP.intCantidadInicial) AS Stock, 
		CASE
			WHEN P.intIdTipoMonedaCompra = _intIdTipoMoneda THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((P.dcmPrecioCompra),2)),2)
			WHEN P.intIdTipoMonedaCompra != _intIdTipoMoneda THEN 
				CASE 
					WHEN _intIdTipoMoneda = 1 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)*@Cambio),2)),2)
					WHEN _intIdTipoMoneda = 2 THEN ROUND((@PrecioPromedio := @PrecioPromedio + ROUND((ROUND((P.dcmPrecioCompra),2)/@Cambio),2)),2)
				END
		END AS PrecioEntrada,
		(ROUND(@PrecioPromedio,2)) AS PrecioPromedio,
			@i AS CantidadEntradas,
		ROUND((@PrecioPromedio*UP.intCantidadInicial),2) AS TotalEntrada,
		0.00 AS PrecioSalida, 0.00 AS TotalSalida, 
		(@SaldoValorizado := ROUND((@SaldoValorizado + (@PrecioPromedio*UP.intCantidadInicial)),2)) AS SaldoValorizado,
		intIdTipoMonedaCompra AS TipoMoneda,
		'0' AS Iden,
		P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_ubigeo_producto UP ON P.intIdProducto = UP.intIdProducto
		WHERE P.intIdProducto = _intIdProducto AND UP.intIdSucursal = _intIdSucursal AND UP.intEstado = 1
		UNION
		SELECT * FROM (
		SELECT
		@Cambio := (SELECT dcmCambio2 FROM tb_cambio_moneda_tributaria WHERE dtmFechaCambio = DATE(CR.dtmFechaCreacion)) AS CambioMoneda, 
		CR.dtmFechaCreacion AS FechaMovimiento,
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
				WHEN CR.intIdTipoMoneda = _intIdTipoMoneda THEN @PrecioEntrada := 0.00 + ROUND((DCR.dcmPrecioUnitario),2)
				WHEN CR.intIdTipoMoneda != _intIdTipoMoneda THEN 
					CASE 
						WHEN _intIdTipoMoneda = 1 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)*@Cambio),2)
						WHEN _intIdTipoMoneda = 2 THEN @PrecioEntrada := 0.00 + ROUND((ROUND((DCR.dcmPrecioUnitario),2)/@Cambio),2)
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
		CR.intIdComprobante AS Iden,
		DCR.intIdProducto
		FROM tb_comprobante CR
		LEFT JOIN tb_tipo_comprobante TCR ON CR.intIdTipoComprobante = TCR.intIdTipoComprobante
		LEFT JOIN tb_detalle_comprobante DCR ON CR.intIdComprobante = DCR.intIdComprobante
		WHERE DCR.intIdProducto = _intIdProducto AND CR.intIdSucursal = _intIdSucursal AND CR.intDescontarGR != 0
		ORDER BY DCR.dtmFechaRealizada ASC) AS Comprobantes GROUP BY Comprobantes.FechaMovimiento,Comprobantes.Iden)
		AS KardexGeneral GROUP BY KardexGeneral.FechaMovimiento,KardexGeneral.Iden ORDER BY KardexGeneral.FechaMovimiento DESC LIMIT 1;

		END IF;
    END 
$$
DELIMITER ;