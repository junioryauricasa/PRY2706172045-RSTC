USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INSERTARPRODUCTO(
	OUT _intIdProducto INT,
    	IN _nvchNombre VARCHAR(250),
	IN _dcmPrecio DECIMAL(11,2),
	IN _intCantidad INT,
	IN _nvchDireccionImg VARCHAR(450),
	IN _nvchDescripcion VARCHAR(500)
    )
	BEGIN
		INSERT INTO tb_producto 
		(nvchNombre,dcmPrecio,intCantidad,nvchDireccionImg,nvchDescripcion)
		VALUES(_nvchNombre,_dcmPrecio,_intCantidad,_nvchDireccionImg,_nvchDescripcion);
		SET _intIdProducto = LAST_INSERT_ID();
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARPRODUCTO(
	IN _intIdProducto INT,
    	IN _nvchNombre VARCHAR(250),
	IN _dcmPrecio DECIMAL(11,2),
	IN _intCantidad INT,
	IN _nvchDireccionImg VARCHAR(450),
	IN _nvchDescripcion VARCHAR(500)
    )
	BEGIN
		UPDATE tb_producto
		SET
		nvchNombre = _nvchNombre,
		dcmPrecio = _dcmPrecio,
		intCantidad = _intCantidad,
		nvchDireccionImg = _nvchDireccionImg,
		nvchDescripcion = _nvchDescripcion
		WHERE intIdProducto = _intIdProducto;
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
		nvchNombre LIKE CONCAT(_elemento,'%') OR 
		dcmPrecio LIKE CONCAT(_elemento,'%') OR 
		intCantidad LIKE CONCAT(_elemento,'%') OR 
		nvchDescripcion LIKE CONCAT(_elemento,'%')
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
		nvchNombre LIKE CONCAT(_elemento,'%') OR 
		dcmPrecio LIKE CONCAT(_elemento,'%') OR 
		intCantidad LIKE CONCAT(_elemento,'%') OR 
		nvchDescripcion LIKE CONCAT(_elemento,'%');
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