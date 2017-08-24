USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INSERTARPRODUCTO(
	IN _nvchCodigoProducto VARCHAR(25),
	IN _nvchCodigoInventario VARCHAR(10),
    IN _nvchNombre VARCHAR(250),
    IN _nvchDescripcion VARCHAR(500),
    IN _dcmPrecioCompra DECIMAL(11,2),
	IN _dcmPrecioVenta DECIMAL(11,2),
	IN _intCantidad INT,
	IN _nvchDescuento VARCHAR(450),
	IN _nvchDireccionImg VARCHAR(450),
	IN _nvchSucursal VARCHAR(250),
	IN _nvchGabinete VARCHAR(250),
	IN _nvchCajon VARCHAR(250),
	IN _dtmFechaIngreso DATETIME
    )
	BEGIN
		INSERT INTO tb_producto 
		(nvchCodigoProducto,nvchCodigoInventario,nvchNombre,nvchDescripcion,dcmPrecioCompra,
		dcmPrecioVenta,intCantidad,nvchDescuento,nvchDireccionImg,nvchSucursal,nvchGabinete,nvchCajon,dtmFechaIngreso)
		VALUES
		(_nvchCodigoProducto,_nvchCodigoInventario,_nvchNombre,_nvchDescripcion,_dcmPrecioCompra,
		_dcmPrecioVenta,_intCantidad,_nvchDescuento,_nvchDireccionImg,_nvchSucursal,_nvchGabinete,_nvchCajon,_dtmFechaIngreso);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARPRODUCTO(
	IN _intIdProducto INT,
    IN _nvchCodigoProducto VARCHAR(25),
	IN _nvchCodigoInventario VARCHAR(10),
    IN _nvchNombre VARCHAR(250),
    IN _nvchDescripcion VARCHAR(500),
    IN _dcmPrecioCompra DECIMAL(11,2),
	IN _dcmPrecioVenta DECIMAL(11,2),
	IN _intCantidad INT,
	IN _nvchDescuento VARCHAR(450),
	IN _nvchDireccionImg VARCHAR(450),
	IN _nvchSucursal VARCHAR(250),
	IN _nvchGabinete VARCHAR(250),
	IN _nvchCajon VARCHAR(250),
	IN _dtmFechaIngreso DATETIME
    )
	BEGIN
		UPDATE tb_producto
		SET
		nvchCodigoProducto = _nvchCodigoProducto,
		nvchCodigoInventario = _nvchCodigoInventario,
		nvchNombre = _nvchNombre,
		nvchDescripcion = _nvchDescripcion,
		dcmPrecioCompra = _dcmPrecioCompra,
		dcmPrecioVenta = _dcmPrecioVenta,
		intCantidad = _intCantidad,
		nvchDescuento = _nvchDescuento,
		nvchDireccionImg = _nvchDireccionImg,
		nvchSucursal = _nvchSucursal,
		nvchGabinete = _nvchGabinete,
		nvchCajon = _nvchCajon,
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
	IN _y INT
    )
	BEGIN
		SELECT * FROM tb_producto 
		WHERE 
		intIdProducto LIKE CONCAT(_elemento,'%') OR
		nvchCodigoProducto LIKE CONCAT(_elemento,'%') OR
		nvchCodigoInventario LIKE CONCAT(_elemento,'%') OR
		nvchNombre LIKE CONCAT(_elemento,'%') OR
		nvchDescripcion LIKE CONCAT(_elemento,'%') OR
		dcmPrecioCompra LIKE CONCAT(_elemento,'%') OR
		dcmPrecioVenta LIKE CONCAT(_elemento,'%') OR
		intCantidad LIKE CONCAT(_elemento,'%') OR
		nvchDescuento LIKE CONCAT(_elemento,'%') OR
		nvchSucursal LIKE CONCAT(_elemento,'%') OR
		nvchGabinete LIKE CONCAT(_elemento,'%') OR 
		nvchCajon LIKE CONCAT(_elemento,'%') OR 
		dtmFechaIngreso LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARPRODUCTO_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARPRODUCTO_II(
    	IN _elemento VARCHAR(500)
    )
	BEGIN
		SELECT * FROM tb_producto 
		WHERE 
		intIdProducto LIKE CONCAT(_elemento,'%') OR
		nvchCodigoProducto LIKE CONCAT(_elemento,'%') OR
		nvchCodigoInventario LIKE CONCAT(_elemento,'%') OR
		nvchNombre LIKE CONCAT(_elemento,'%') OR
		nvchDescripcion LIKE CONCAT(_elemento,'%') OR
		dcmPrecioCompra LIKE CONCAT(_elemento,'%') OR
		dcmPrecioVenta LIKE CONCAT(_elemento,'%') OR
		intCantidad LIKE CONCAT(_elemento,'%') OR
		nvchDescuento LIKE CONCAT(_elemento,'%') OR
		nvchSucursal LIKE CONCAT(_elemento,'%') OR
		nvchGabinete LIKE CONCAT(_elemento,'%') OR 
		nvchCajon LIKE CONCAT(_elemento,'%') OR 
		dtmFechaIngreso LIKE CONCAT(_elemento,'%');
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