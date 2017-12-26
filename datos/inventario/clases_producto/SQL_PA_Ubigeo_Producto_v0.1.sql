USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARUBIGEOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE INSERTARUBIGEOPRODUCTO(
	IN _intIdProducto INT,
    IN _intIdSucursal VARCHAR(100),
    IN _nvchUbicacion VARCHAR(100),
    IN _intCantidadUbigeo INT
    )
	BEGIN
		INSERT INTO tb_ubigeo_producto
		(intIdProducto,intIdSucursal,nvchUbicacion,intCantidadUbigeo)
		VALUES
		(_intIdProducto,_intIdSucursal,_nvchUbicacion,_intCantidadUbigeo);
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARUBIGEOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARUBIGEOPRODUCTO(
	IN _intIdUbigeoProducto INT,
	IN _intIdProducto INT,
    IN _intIdSucursal INT,
    IN _nvchUbicacion VARCHAR(100),
    IN _intCantidadUbigeo INT
    )
	BEGIN
		UPDATE tb_ubigeo_producto
		SET
		intIdProducto = _intIdProducto,
		intIdSucursal = _intIdSucursal,
		nvchUbicacion = _nvchUbicacion,
		intCantidadUbigeo = _intCantidadUbigeo
		WHERE 
		intIdUbigeoProducto = _intIdUbigeoProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ACTUALIZARUBIGEOPRODUCTO_II;
DELIMITER $$
	CREATE PROCEDURE ACTUALIZARUBIGEOPRODUCTO_II(
	IN _intIdProducto INT,
    IN _intIdSucursal INT,
    IN _nvchUbicacion VARCHAR(100),
    IN _intCantidadUbigeo INT
    )
	BEGIN
		UPDATE tb_ubigeo_producto
		SET
		nvchUbicacion = _nvchUbicacion,
		intCantidadUbigeo = _intCantidadUbigeo,
		intCantidadInicial = _intCantidadUbigeo,
		intEstado = 1
		WHERE
		intIdProducto = _intIdProducto AND
		intIdSucursal = _intIdSucursal;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARUBIGEOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARUBIGEOPRODUCTO(
    	IN _intIdUbigeoProducto INT
    )
	BEGIN
		SELECT * FROM tb_ubigeo_producto
		WHERE 
		intIdUbigeoProducto = _intIdUbigeoProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARUBIGEOPRODUCTO_II;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARUBIGEOPRODUCTO_II(
    	IN _intIdProducto INT,
    	IN _intIdSucursal INT
    )
	BEGIN
		SELECT * FROM tb_ubigeo_producto
		WHERE 
		intIdProducto = _intIdProducto AND
		intIdSucursal = _intIdSucursal;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS ELIMINARUBIGEOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE ELIMINARUBIGEOPRODUCTO(
    	IN _intIdUbigeoProducto INT
    )
	BEGIN
		DELETE FROM tb_ubigeo_producto
		WHERE 
		intIdUbigeoProducto = _intIdUbigeoProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARUBIGEOSPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARUBIGEOSPRODUCTO(
    	IN _intIdProducto INT
    )
	BEGIN
		SELECT UP.*,S.nvchNombre AS NombreSucursal FROM tb_ubigeo_producto UP
		LEFT JOIN tb_sucursal S ON UP.intIdSucursal = S.intIdSucursal
		WHERE 
		UP.intIdProducto = _intIdProducto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARUBIGEOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE BUSCARUBIGEOPRODUCTO(
    	IN _elemento VARCHAR(500),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT P.*,UP.intCantidadUbigeo,UP.intIdUbigeoProducto,UP.nvchUbicacion,S.nvchNombre AS NombreSucursal,CP.nvchCodigo FROM tb_ubigeo_producto UP
		LEFT JOIN tb_producto P ON UP.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_sucursal S ON UP.intIdSucursal = S.intIdSucursal
		WHERE
		P.intIdProducto IN (
		SELECT P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%') OR 
		P.nvchDescripcion LIKE CONCAT(_elemento,'%')) AND CP.intIdTipoCodigoProducto = 1
		GROUP BY P.intIdProducto
		ORDER BY P.intIdProducto
		LIMIT _x,_y;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARUBIGEOPRODUCTO_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARUBIGEOPRODUCTO_II(
    	IN _elemento VARCHAR(500)
    )
	BEGIN
		SELECT P.*,UP.intCantidadUbigeo,UP.intIdUbigeoProducto,UP.nvchUbicacion,S.nvchNombre AS NombreSucursal,CP.nvchCodigo FROM tb_ubigeo_producto UP
		LEFT JOIN tb_producto P ON UP.intIdProducto = P.intIdProducto
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		LEFT JOIN tb_sucursal S ON UP.intIdSucursal = S.intIdSucursal
		WHERE
		P.intIdProducto IN (
		SELECT P.intIdProducto
		FROM tb_producto P
		LEFT JOIN tb_codigo_producto CP ON P.intIdProducto = CP.intIdProducto
		WHERE 
		CP.nvchCodigo LIKE CONCAT(_elemento,'%') OR 
		P.nvchDescripcion LIKE CONCAT(_elemento,'%')) AND CP.intIdTipoCodigoProducto = 1
		GROUP BY P.intIdProducto
		ORDER BY P.intIdProducto;
    	END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARUBIGEOPRODUCTO_III;
DELIMITER $$
	CREATE PROCEDURE BUSCARUBIGEOPRODUCTO_III(
    	IN _intIdProducto INT
    )
	BEGIN
		SELECT
		(SELECT nvchUbicacion FROM tb_ubigeo_producto 
		WHERE intIdSucursal = 1 AND intIdProducto = _intIdProducto) AS UbicacionHuancayo,
		SUM(CASE 
			WHEN UP.intIdSucursal = 1 THEN UP.intCantidadUbigeo
		END) AS CantidadHuancayo,
		(SELECT nvchUbicacion FROM tb_ubigeo_producto 
		WHERE intIdSucursal = 2 AND intIdProducto = _intIdProducto) AS UbicacionSanJeronimo,
		SUM(CASE 
			WHEN UP.intIdSucursal = 2 THEN UP.intCantidadUbigeo
		END) AS CantidadSanJeronimo
		FROM tb_ubigeo_producto UP
		WHERE
		UP.intIdProducto = _intIdProducto AND UP.nvchUbicacion IS NOT NULL
		GROUP BY UP.intIdProducto
		ORDER BY UP.intIdProducto;
    	END 
$$
DELIMITER ;