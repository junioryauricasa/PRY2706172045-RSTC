USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INSERTARPRODUCTO(
	OUT _intIdProducto INT,
    IN _nvchNombre VARCHAR(250),
    IN _nvchDescripcion VARCHAR(500),
    IN _nvchUnidadMedida VARCHAR(50),
    IN _intCantidad INT,
    IN _nvchDireccionImg VARCHAR(450),
	IN _dcmPrecioVenta1 DECIMAL(11,2),
	IN _dcmPrecioVenta2 DECIMAL(11,2),
	IN _dcmPrecioVenta3 DECIMAL(11,2),
	IN _dtmFechaIngreso DATETIME
    )
	BEGIN
		INSERT INTO tb_producto 
		(nvchNombre,nvchDescripcion,nvchUnidadMedida,intCantidad,nvchDireccionImg,dcmPrecioVenta1,dcmPrecioVenta2,
		dcmPrecioVenta3,dtmFechaIngreso)
		VALUES
		(_nvchNombre,_nvchDescripcion,_nvchUnidadMedida,_intCantidad,_nvchDireccionImg,_dcmPrecioVenta1,_dcmPrecioVenta2,
		_dcmPrecioVenta3,_dtmFechaIngreso);
		SET _intIdProducto = LAST_INSERT_ID();
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARPRODUCTO(
	IN _intIdProducto INT,
    IN _nvchNombre VARCHAR(250),
    IN _nvchDescripcion VARCHAR(500),
    IN _nvchUnidadMedida VARCHAR(50),
    IN _intCantidad INT,
    IN _nvchDireccionImg VARCHAR(450),
	IN _dcmPrecioVenta1 DECIMAL(11,2),
	IN _dcmPrecioVenta2 DECIMAL(11,2),
	IN _dcmPrecioVenta3 DECIMAL(11,2),
	IN _dtmFechaIngreso DATETIME
    )
	BEGIN
		UPDATE tb_producto
		SET
		nvchNombre = _nvchNombre,
		nvchDescripcion = _nvchDescripcion,
		nvchUnidadMedida = _nvchUnidadMedida,
		intCantidad = _intCantidad,
		nvchDireccionImg = _nvchDireccionImg,
		dcmPrecioVenta1 = _dcmPrecioVenta1,
		dcmPrecioVenta2 = _dcmPrecioVenta2,
		dcmPrecioVenta3 = _dcmPrecioVenta3,
		dtmFechaIngreso = _dtmFechaIngreso
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
		SELECT P.*, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		(P.intIdProducto LIKE CONCAT(_elemento,'%') OR
		P.nvchNombre LIKE CONCAT(_elemento,'%') OR
		P.nvchDescripcion LIKE CONCAT(_elemento,'%') OR
		P.nvchUnidadMedida LIKE CONCAT(_elemento,'%') OR
		P.intCantidad LIKE CONCAT(_elemento,'%') OR
		P.dcmPrecioVenta1 LIKE CONCAT(_elemento,'%') OR
		P.dcmPrecioVenta2 LIKE CONCAT(_elemento,'%') OR
		P.dcmPrecioVenta3 LIKE CONCAT(_elemento,'%') OR
		P.dtmFechaIngreso LIKE CONCAT(_elemento,'%')) AND
		CP.intIdTipoCodigoProducto = 1
		LIMIT _x,_y;
	END IF;
	IF(_TipoBusqueda = "C") THEN
		SELECT P.*, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%')
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
		SELECT P.*, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		(P.intIdProducto LIKE CONCAT(_elemento,'%') OR
		P.nvchNombre LIKE CONCAT(_elemento,'%') OR
		P.nvchDescripcion LIKE CONCAT(_elemento,'%') OR
		P.nvchUnidadMedida LIKE CONCAT(_elemento,'%') OR
		P.intCantidad LIKE CONCAT(_elemento,'%') OR
		P.dcmPrecioVenta1 LIKE CONCAT(_elemento,'%') OR
		P.dcmPrecioVenta2 LIKE CONCAT(_elemento,'%') OR
		P.dcmPrecioVenta3 LIKE CONCAT(_elemento,'%') OR
		P.dtmFechaIngreso LIKE CONCAT(_elemento,'%')) AND
		CP.intIdTipoCodigoProducto = 1;
	END IF;
	IF(_TipoBusqueda = "C") THEN
		SELECT P.*, CP.*
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%');
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