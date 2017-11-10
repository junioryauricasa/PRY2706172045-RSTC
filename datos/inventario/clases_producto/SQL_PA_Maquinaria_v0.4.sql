USE db_resteco;

DROP PROCEDURE IF EXISTS INSERTARMAQUINARIA;
DELIMITER $$
	CREATE PROCEDURE INSERTARMAQUINARIA(
	OUT _intIdMaquinaria INT,
    IN _nvchDia VARCHAR(2),
    IN _nvchMes VARCHAR(25),
    IN _nvchAnio VARCHAR(4),
    IN _nvchNombres VARCHAR(100),
    IN _nvchAtencion VARCHAR(100),
    IN _nvchDireccion VARCHAR(100),
    IN _dcmPrecioVenta DECIMAL(11,2)
    )
	BEGIN
		INSERT INTO tb_maquinaria
		(nvchDia,nvchMes,nvchAnio,nvchNombres,nvchAtencion,nvchDireccion,dcmPrecioVenta)
		VALUES
		(_nvchDia,_nvchMes,_nvchAnio,_nvchNombres,_nvchAtencion,_nvchDireccion,_dcmPrecioVenta);
		SET _intIdMaquinaria = LAST_INSERT_ID();
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARMAQUINARIA;
DELIMITER $$
	CREATE PROCEDURE BUSCARMAQUINARIA(
    	IN _elemento VARCHAR(500),
		IN _x INT,
		IN _y INT
    )
	BEGIN
		SELECT * FROM tb_maquinaria
		LIMIT _x,_y;
    END
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS BUSCARMAQUINARIA_II;
DELIMITER $$
	CREATE PROCEDURE BUSCARMAQUINARIA_II(
    	IN _elemento VARCHAR(500)
    )
	BEGIN
		SELECT * FROM tb_maquinaria;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARMAQUINARIA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARMAQUINARIA(
    	IN _intIdMaquinaria INT
    )
	BEGIN
		SELECT * FROM tb_maquinaria WHERE intIdMaquinaria = _intIdMaquinaria;
    END 
$$
DELIMITER ;