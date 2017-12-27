USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INSERTARPRODUCTO(
	OUT _intIdProducto INT,
	IN _intIdTipoVenta INT,
    IN _nvchDescripcion VARCHAR(2500),
    IN _nvchUnidadMedida VARCHAR(50),
    IN _intCantidad INT,
    IN _intCantidadMinima INT,
    IN _nvchDireccionImg VARCHAR(450),
    IN _dcmPrecioCompra DECIMAL(11,2),
    IN _intIdTipoMonedaCompra INT,
	IN _dcmPrecioVenta1 DECIMAL(11,2),
	IN _dcmPrecioVenta2 DECIMAL(11,2),
	IN _dcmPrecioVenta3 DECIMAL(11,2),
	IN _dcmDescuentoVenta2 DECIMAL(11,2),
	IN _dcmDescuentoVenta3 DECIMAL(11,2),
	IN _intIdTipoMonedaVenta INT,
	IN _dtmFechaIngreso DATETIME,
	IN _nvchObservacion VARCHAR(800)
    )
	BEGIN
		INSERT INTO tb_producto 
		(intIdTipoVenta,nvchDescripcion,nvchUnidadMedida,intCantidad,intCantidadMinima,nvchDireccionImg,dcmPrecioCompra,intIdTipoMonedaCompra,
		dcmPrecioVenta1,dcmPrecioVenta2,dcmPrecioVenta3,dcmDescuentoVenta2,dcmDescuentoVenta3,intIdTipoMonedaVenta,dtmFechaIngreso,
		nvchObservacion)
		VALUES
		(_intIdTipoVenta,_nvchDescripcion,_nvchUnidadMedida,_intCantidad,_intCantidadMinima,_nvchDireccionImg,_dcmPrecioCompra,_intIdTipoMonedaCompra,
		_dcmPrecioVenta1,_dcmPrecioVenta2,_dcmPrecioVenta3,_dcmDescuentoVenta2,_dcmDescuentoVenta3,_intIdTipoMonedaVenta,_dtmFechaIngreso,
		_nvchObservacion);
		SET _intIdProducto = LAST_INSERT_ID();
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARPRODUCTO(
	IN _intIdProducto INT,
	IN _intIdTipoVenta INT,
    IN _nvchDescripcion VARCHAR(2500),
    IN _nvchUnidadMedida VARCHAR(50),
    IN _intCantidadMinima INT,
    IN _nvchDireccionImg VARCHAR(450),
    IN _dcmPrecioCompra DECIMAL(11,2),
    IN _intIdTipoMonedaCompra INT,
	IN _dcmPrecioVenta1 DECIMAL(11,2),
	IN _dcmPrecioVenta2 DECIMAL(11,2),
	IN _dcmPrecioVenta3 DECIMAL(11,2),
	IN _dcmDescuentoVenta2 DECIMAL(11,2),
	IN _dcmDescuentoVenta3 DECIMAL(11,2),
	IN _intIdTipoMonedaVenta INT,
	IN _dtmFechaIngreso DATETIME,
	IN _nvchObservacion VARCHAR(800)
    )
	BEGIN
		UPDATE tb_producto
		SET
		intIdTipoVenta = _intIdTipoVenta,
		nvchDescripcion = _nvchDescripcion,
		nvchUnidadMedida = _nvchUnidadMedida,
		intCantidadMinima = _intCantidadMinima,
		nvchDireccionImg = _nvchDireccionImg,
		dcmPrecioCompra = _dcmPrecioCompra,
		intIdTipoMonedaCompra = _intIdTipoMonedaCompra,
		dcmPrecioVenta1 = _dcmPrecioVenta1,
		dcmPrecioVenta2 = _dcmPrecioVenta2,
		dcmPrecioVenta3 = _dcmPrecioVenta3,
		dcmDescuentoVenta2 = _dcmDescuentoVenta2,
		dcmDescuentoVenta3 = _dcmDescuentoVenta3,
		intIdTipoMonedaVenta = _intIdTipoMonedaVenta,
		dtmFechaIngreso = _dtmFechaIngreso,
		nvchObservacion = _nvchObservacion
		WHERE 
		intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARPRODUCTO(
    	IN _intIdProducto INT
    )
	BEGIN
		SELECT P.*,CP.nvchCodigo FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		P.intIdProducto = _intIdProducto AND
		CP.intIdTipoCodigoProducto = 1;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ELIMINARPRODUCTO(
    	IN _intIdProducto INT
    )
	BEGIN
		DELETE FROM tb_codigo_producto
		WHERE 
		intIdProducto = _intIdProducto;
		DELETE FROM tb_ubigeo_producto
		WHERE 
		intIdProducto = _intIdProducto;
		DELETE FROM tb_producto
		WHERE 
		intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE LISTARPRODUCTO(
    	IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT * FROM tb_producto
 		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS TODOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE TODOPRODUCTO()
	BEGIN
		SELECT * FROM tb_producto;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS CONSULTARULTIMOIDPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE CONSULTARULTIMOIDPRODUCTO()
	BEGIN
		SELECT * FROM tb_producto
		ORDER BY intIdProducto DESC
		LIMIT 0,1;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE BUSCARPRODUCTO(
    	IN _elemento VARCHAR(500),
		IN _x INT,
		IN _y INT,
		IN _TipoBusqueda VARCHAR(2)
    )
	BEGIN
	IF(_TipoBusqueda = "T") THEN
		SELECT P.*,TMN.nvchSimbolo,TMN.nvchNombre AS NombreMoneda, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		WHERE 
		(P.nvchDescripcion LIKE CONCAT(_elemento,'%') OR
		P.nvchUnidadMedida LIKE CONCAT(_elemento,'%') OR
		P.intCantidad LIKE CONCAT(_elemento,'%') OR
		P.dtmFechaIngreso LIKE CONCAT(_elemento,'%')) AND
		CP.intIdTipoCodigoProducto = 1
		ORDER BY P.intIdProducto
		LIMIT _x,_y;
	END IF;
	IF(_TipoBusqueda = "C") THEN
		SELECT P.*,TMN.nvchSimbolo,TMN.nvchNombre AS NombreMoneda, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		WHERE
		P.intIdProducto IN (
		SELECT P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%')) AND CP.intIdTipoCodigoProducto = 1
		ORDER BY P.intIdProducto
		LIMIT _x,_y;
	END IF;
    END
$$
DELIMITER ;
/*
DROP PROCEDURE IF EXISTS BUSCARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE BUSCARPRODUCTO(
    	IN _elemento VARCHAR(500),
		IN _x INT,
		IN _y INT,
		IN _TipoBusqueda VARCHAR(2)
    )
	BEGIN
		SELECT P.*,TMN.nvchSimbolo,TMN.nvchNombre AS NombreMoneda,
		CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		WHERE
		P.intIdProducto IN (
		SELECT P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%') OR 
		P.nvchDescripcion LIKE CONCAT(_elemento,'%')) AND CP.intIdTipoCodigoProducto = 1
		ORDER BY P.intIdProducto
		LIMIT _x,_y;
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARPRODUCTO_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARPRODUCTO_II(
    	IN _elemento VARCHAR(500),
    	IN _TipoBusqueda VARCHAR(2)
    )
	BEGIN
		SELECT P.*,TMN.nvchSimbolo,TMN.nvchNombre AS NombreMoneda,
		CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		WHERE
		P.intIdProducto IN (
		SELECT P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%') OR 
		P.nvchDescripcion LIKE CONCAT(_elemento,'%')) AND CP.intIdTipoCodigoProducto = 1
		ORDER BY P.intIdProducto;
    END 
$$
DELIMITER ;
*/
DROP PROCEDURE IF EXISTS BUSCARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE BUSCARPRODUCTO(
    	IN _elemento VARCHAR(500),
		IN _x INT,
		IN _y INT,
		IN _TipoBusqueda VARCHAR(2)
    )
	BEGIN
		SELECT P.*,TMN.nvchSimbolo,TMN.nvchNombre AS NombreMoneda,
		SUM(CASE 
			WHEN UP.intIdSucursal = 1 THEN UP.intCantidadUbigeo
		END) AS CantidadHuancayo,
		SUM(CASE 
			WHEN UP.intIdSucursal = 2 THEN UP.intCantidadUbigeo
		END) AS CantidadSanJeronimo,
		(SELECT dtmFechaRealizada FROM tb_detalle_comprobante WHERE intIdProducto = P.intIdProducto LIMIT 1) AS ExisteMovimiento,
		CP.*
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
		ORDER BY P.intIdProducto
		LIMIT _x,_y;
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARPRODUCTO_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARPRODUCTO_II(
    	IN _elemento VARCHAR(500),
    	IN _TipoBusqueda VARCHAR(2)
    )
	BEGIN
		SELECT P.*,TMN.nvchSimbolo,TMN.nvchNombre AS NombreMoneda,
		SUM(CASE 
			WHEN UP.intIdSucursal = 1 THEN UP.intCantidadUbigeo
		END) AS CantidadHuancayo,
		SUM(CASE 
			WHEN UP.intIdSucursal = 2 THEN UP.intCantidadUbigeo
		END) AS CantidadSanJeronimo,
		CP.*
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
		ORDER BY P.intIdProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARPRODUCTO_III;
DELIMITER $$
	CREATE PROCEDURE BUSCARPRODUCTO_III(
    	IN _elemento VARCHAR(500),
    	IN _intIdTipoVenta INT
    )
	BEGIN
		SELECT P.*,TMN.nvchSimbolo,TMN.nvchNombre AS NombreMoneda,
		(SELECT nvchUbicacion FROM tb_ubigeo_producto 
		WHERE intIdSucursal = 1 AND intIdProducto = P.intIdProducto) AS UbicacionHuancayo,
		(SELECT nvchUbicacion FROM tb_ubigeo_producto 
		WHERE intIdSucursal = 2 AND intIdProducto = P.intIdProducto) AS UbicacionSanJeronimo,
		SUM(CASE 
			WHEN UP.intIdSucursal = 1 THEN UP.intCantidadUbigeo
		END) AS CantidadHuancayo,
		SUM(CASE 
			WHEN UP.intIdSucursal = 2 THEN UP.intCantidadUbigeo
		END) AS CantidadSanJeronimo,
		CP.*
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
		P.nvchDescripcion LIKE CONCAT(_elemento,'%') AND
		P.intIdTipoVenta = _intIdTipoVenta) AND CP.intIdTipoCodigoProducto = 1
		AND P.intIdTipoVenta = _intIdTipoVenta
		GROUP BY P.intIdProducto
		ORDER BY P.intIdProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS INSERTARIMAGENPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INSERTARIMAGENPRODUCTO(
	IN _intIdProducto INT,
	IN _nvchDireccionImg VARCHAR(450)
    )
	BEGIN
		UPDATE tb_producto
		SET
		nvchDireccionImg = _nvchDireccionImg 
		WHERE 
		intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS CANTIDADUBIGEO;
DELIMITER $$
CREATE PROCEDURE CANTIDADUBIGEO(
	IN _intIdProducto INT
    )
	BEGIN
		SELECT 
		SUM(CASE 
			WHEN intIdSucursal = 1 THEN intCantidadUbigeo
		END) AS CantidadHuancayo,
		SUM(CASE 
			WHEN intIdSucursal = 2 THEN intCantidadUbigeo
		END) AS CantidadSanJeronimo
		FROM tb_ubigeo_producto WHERE intIdProducto = _intIdProducto 
		GROUP BY intIdProducto;
	END
$$
DELIMITER ;

,
CASE 
	WHEN intIdSucursal = 2 THEN intCantidadUbigeo
END AS CantidadSanJeronimo

SELECT 
	(SELECT SUM(intCantidadUbigeo) FROM tb_ubigeo_producto 
	WHERE intIdProducto = _intIdProducto AND intIdSucursal = 1) AS CantidadHuancayo,
	(SELECT SUM(intCantidadUbigeo) FROM tb_ubigeo_producto 
	WHERE intIdProducto = _intIdProducto AND intIdSucursal = 2) AS CantidadSanJeronimo
FROM tb_ubigeo_producto WHERE intIdProducto = _intIdProducto GROUP BY intIdProducto;

DROP PROCEDURE IF EXISTS BUSCARPRODUCTOCODIGO;
DELIMITER $$
	CREATE PROCEDURE BUSCARPRODUCTOCODIGO(
    	IN _elemento VARCHAR(500)
    )
	BEGIN
		SELECT CP.nvchCodigo
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		WHERE
		P.intIdProducto IN (
		SELECT P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMonedaVenta = TMN.intIdTipoMoneda
		WHERE 
		CP.nvchCodigo LIKE CONCAT('A23','%')) AND CP.intIdTipoCodigoProducto = 1;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS CANTIDADUBIGEOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE CANTIDADUBIGEOPRODUCTO(
    	IN _intIdProducto INT,
    	IN _intIdSucursal INT
    )
	BEGIN
		SELECT SUM(UP.intCantidadUbigeo) AS CantidadUbigeo
		FROM tb_producto P
		LEFT JOIN tb_ubigeo_producto UP ON P.intIdProducto = UP.intIdProducto
		WHERE 
		P.intIdProducto = _intIdProducto AND UP.intIdSucursal = _intIdSucursal;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS CANTIDADINICIALUBIGEO;
DELIMITER $$
	CREATE PROCEDURE CANTIDADINICIALUBIGEO(
    	IN _intIdProducto INT,
    	IN _intIdSucursal INT
    )
	BEGIN
		UPDATE tb_ubigeo_producto
		SET
		intCantidadInicial = intCantidadUbigeo,
		intEstado = 1
		WHERE 
		intIdProducto = _intIdProducto AND
		intIdSucursal = _intIdSucursal;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS CANTIDADINICIALPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE CANTIDADINICIALPRODUCTO(
    	IN _intIdProducto INT
    )
	BEGIN
		UPDATE tb_producto
		SET
		intCantidadInicial = (SELECT SUM(intCantidadInicial) FROM tb_ubigeo_producto WHERE intIdProducto = _intIdProducto)
		WHERE 
		intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS CANTIDADTOTALPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE CANTIDADTOTALPRODUCTO(
    	IN _intIdProducto INT
    )
	BEGIN
		SELECT SUM(UP.intCantidadUbigeo) AS CantidadTotal
		FROM tb_producto P
		LEFT JOIN tb_ubigeo_producto UP ON P.intIdProducto = UP.intIdProducto
		WHERE 
		P.intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ES_STOCKUBIGEO;
DELIMITER $$
	CREATE PROCEDURE ES_STOCKUBIGEO(
		IN _intIdUbigeoProducto INT,
    	IN _intCantidadUbigeo INT
    )
	BEGIN
		UPDATE tb_ubigeo_producto
		SET
		intCantidadUbigeo = _intCantidadUbigeo
		WHERE 
		intIdUbigeoProducto = _intIdUbigeoProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ES_STOCKTOTAL;
DELIMITER $$
	CREATE PROCEDURE ES_STOCKTOTAL(
		IN _intIdProducto INT,
    	IN _intCantidad INT
    )
	BEGIN
		UPDATE tb_producto
		SET
		intCantidad = _intCantidad
		WHERE 
		intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTARCANTIDADMINIMA;
DELIMITER $$
	CREATE PROCEDURE LISTARCANTIDADMINIMA()
	BEGIN
		SELECT CP.nvchCodigo,P.nvchDescripcion,UP.intCantidadUbigeo,S.nvchNombre,P.nvchDireccionImg
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON CP.intIdProducto = P.intIdProducto
		LEFT JOIN tb_ubigeo_producto UP ON UP.intIdProducto = P.intIdProducto
		LEFT JOIN tb_sucursal S ON S.intIdSucursal = UP.intIdSucursal
		WHERE  
		UP.intCantidadUbigeo <= P.intCantidadMinima AND CP.intIdTipoCodigoProducto = 1;
    END 
$$
DELIMITER ;