DROP PROCEDURE IF EXISTS BUSCARPRODUCTO_NOMOVIMIENTO;
DELIMITER $$
	CREATE PROCEDURE BUSCARPRODUCTO_NOMOVIMIENTO(
    	IN _elemento VARCHAR(500),
		IN _TipoBusqueda VARCHAR(2)
    )
	BEGIN
		SELECT * FROM(SELECT P.nvchDescripcion,P.dcmPrecioVenta1,P.dtmFechaIngreso,TMN.nvchSimbolo,TMN.nvchNombre AS NombreMoneda,
		SUM(CASE 
			WHEN UP.intIdSucursal = 1 THEN UP.intCantidadUbigeo
		END) AS CantidadHuancayo,
		SUM(CASE 
			WHEN UP.intIdSucursal = 2 THEN UP.intCantidadUbigeo
		END) AS CantidadSanJeronimo,
		(SELECT dtmFechaRealizada FROM tb_detalle_comprobante WHERE intIdProducto = P.intIdProducto LIMIT 1) AS ExisteMovimiento,
		CP.nvchCodigo
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		LEFT JOIN tb_ubigeo_producto UP ON P.intIdProducto = UP.intIdProducto
		WHERE
		P.intIdProducto IN (
		SELECT P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%') OR 
		P.nvchDescripcion LIKE CONCAT(_elemento,'%')) AND CP.intIdTipoCodigoProducto = 1
		GROUP BY P.intIdProducto
		ORDER BY P.intIdProducto) AS ProductoNoMovimiento WHERE ProductoNoMovimiento.ExisteMovimiento IS NULL;
    END
$$
DELIMITER ;