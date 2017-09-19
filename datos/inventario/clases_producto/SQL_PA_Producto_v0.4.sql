USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INSERTARPRODUCTO(
	OUT _intIdProducto INT,
    IN _nvchDescripcion VARCHAR(500),
    IN _nvchUnidadMedida VARCHAR(50),
    IN _intCantidad INT,
    IN _intCantidadMinima INT,
    IN _nvchDireccionImg VARCHAR(450),
	IN _dcmPrecioVenta1 DECIMAL(11,2),
	IN _dcmPrecioVenta2 DECIMAL(11,2),
	IN _dcmPrecioVenta3 DECIMAL(11,2),
	IN _dcmDescuentoVenta2 DECIMAL(11,2),
	IN _dcmDescuentoVenta3 DECIMAL(11,2),
	IN _intIdTipoMoneda INT,
	IN _dtmFechaIngreso DATETIME,
	IN _nvchObservacion VARCHAR(800)
    )
	BEGIN
		INSERT INTO tb_producto 
		(nvchDescripcion,nvchUnidadMedida,intCantidad,intCantidadMinima,nvchDireccionImg,dcmPrecioVenta1,dcmPrecioVenta2,
		dcmPrecioVenta3,dcmDescuentoVenta2,dcmDescuentoVenta3,intIdTipoMoneda,dtmFechaIngreso,nvchObservacion)
		VALUES
		(_nvchDescripcion,_nvchUnidadMedida,_intCantidad,_intCantidadMinima,_nvchDireccionImg,_dcmPrecioVenta1,_dcmPrecioVenta2,
		_dcmPrecioVenta3,_dcmDescuentoVenta2,_dcmDescuentoVenta3,_intIdTipoMoneda,_dtmFechaIngreso,_nvchObservacion);
		SET _intIdProducto = LAST_INSERT_ID();
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARPRODUCTO(
	IN _intIdProducto INT,
    IN _nvchDescripcion VARCHAR(500),
    IN _nvchUnidadMedida VARCHAR(50),
    IN _intCantidad INT,
    IN _intCantidadMinima INT,
    IN _nvchDireccionImg VARCHAR(450),
	IN _dcmPrecioVenta1 DECIMAL(11,2),
	IN _dcmPrecioVenta2 DECIMAL(11,2),
	IN _dcmPrecioVenta3 DECIMAL(11,2),
	IN _dcmDescuentoVenta2 DECIMAL(11,2),
	IN _dcmDescuentoVenta3 DECIMAL(11,2),
	IN _intIdTipoMoneda INT,
	IN _dtmFechaIngreso DATETIME,
	IN _nvchObservacion VARCHAR(800)
    )
	BEGIN
		UPDATE tb_producto
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
		SELECT * FROM tb_producto
		WHERE 
		intIdProducto = _intIdProducto;
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
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE 
		(P.nvchDescripcion LIKE CONCAT(_elemento,'%') OR
		P.nvchUnidadMedida LIKE CONCAT(_elemento,'%') OR
		P.intCantidad LIKE CONCAT(_elemento,'%') OR
		P.dtmFechaIngreso LIKE CONCAT(_elemento,'%')) AND
		CP.intIdTipoCodigoProducto = 1
		LIMIT _x,_y;
	END IF;
	IF(_TipoBusqueda = "C") THEN
		SELECT P.*,TMN.nvchSimbolo,TMN.nvchNombre AS NombreMoneda, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE
		P.intIdProducto IN (
		SELECT P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%')) AND CP.intIdTipoCodigoProducto = 1
		LIMIT _x,_y;
	END IF;
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
	IF(_TipoBusqueda = "T") THEN
		SELECT P.*,TMN.nvchSimbolo,TMN.nvchNombre AS NombreMoneda, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE 
		(P.nvchDescripcion LIKE CONCAT(_elemento,'%') OR
		P.nvchUnidadMedida LIKE CONCAT(_elemento,'%') OR
		P.intCantidad LIKE CONCAT(_elemento,'%') OR
		P.dtmFechaIngreso LIKE CONCAT(_elemento,'%')) AND
		CP.intIdTipoCodigoProducto = 1;
	END IF;
	IF(_TipoBusqueda = "C") THEN
		SELECT P.*,TMN.nvchSimbolo,TMN.nvchNombre AS NombreMoneda, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE
		P.intIdProducto IN (
		SELECT P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%')) AND CP.intIdTipoCodigoProducto = 1;
	END IF;
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
	IN _intIdProducto INT,
	IN _nvchSucursal VARCHAR(500)
    )
	BEGIN
		SELECT UP.nvchSucursal,SUM(UP.intCantidadUbigeo) AS CantidadUbigeo
		FROM tb_producto P
		LEFT JOIN tb_ubigeo_producto UP ON P.intIdProducto = UP.intIdProducto
		WHERE 
		P.intIdProducto = _intIdProducto AND UP.nvchSucursal = _nvchSucursal
		GROUP BY UP.nvchSucursal,UP.intIdProducto;
	END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARPRODUCTOCODIGO;
DELIMITER $$
	CREATE PROCEDURE BUSCARPRODUCTOCODIGO(
    	IN _elemento VARCHAR(500)
    )
	BEGIN
		SELECT CP.nvchCodigo
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE
		P.intIdProducto IN (
		SELECT P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_tipo_moneda TMN ON P.intIdTipoMoneda = TMN.intIdTipoMoneda
		WHERE 
		CP.nvchCodigo LIKE CONCAT('A23','%')) AND CP.intIdTipoCodigoProducto = 1;
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