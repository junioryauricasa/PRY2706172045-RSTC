USE db_resteco;

DROP PROCEDURE IF EXISTS MOSTRARTIPOCLIENTE;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOCLIENTE()
	BEGIN
		SELECT * FROM tb_tipo_cliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOCOMUNICACION;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOCOMUNICACION()
	BEGIN
		SELECT * FROM tb_tipo_comunicacion;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPODOMICILIO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPODOMICILIO()
	BEGIN
		SELECT * FROM tb_tipo_domicilio;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOPERSONA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOPERSONA()
	BEGIN
		SELECT * FROM tb_tipo_persona;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOUSUARIO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOUSUARIO()
	BEGIN
		SELECT * FROM tb_tipo_usuario;
    END 
$$
DELIMITER ;