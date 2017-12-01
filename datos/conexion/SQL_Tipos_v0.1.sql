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

DROP PROCEDURE IF EXISTS MOSTRARTIPOCOMPROBANTE;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOCOMPROBANTE(
		IN _inTipoDetalle INT)
	BEGIN
		SELECT * FROM tb_tipo_comprobante
		WHERE intTipoDetalle = _inTipoDetalle
		LIMIT 4;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOCOMPROBANTE_ES;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOCOMPROBANTE_ES(
		IN _inTipoDetalle INT,
		IN _intIdTipoComprobante INT
		)
	BEGIN
		SELECT * FROM tb_tipo_comprobante
		WHERE intTipoDetalle = _inTipoDetalle
		AND intIdTipoComprobante = _intIdTipoComprobante;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOCODIGOPRODUCTO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOCODIGOPRODUCTO()
	BEGIN
		SELECT * FROM tb_tipo_codigo_producto;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOMONEDA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOMONEDA()
	BEGIN
		SELECT * FROM tb_tipo_moneda;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOCLIENTE;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOCLIENTE()
	BEGIN
		SELECT * FROM tb_tipo_cliente;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOPAGO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOPAGO()
	BEGIN
		SELECT * FROM tb_tipo_pago;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOVENTA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOVENTA()
	BEGIN
		SELECT * FROM tb_tipo_venta;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOVENTACOTIZACION;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOVENTACOTIZACION()
	BEGIN
		SELECT * FROM tb_tipo_venta
		LIMIT 2;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOVENTACOMPRAS;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOVENTACOMPRAS()
	BEGIN
		SELECT * FROM tb_tipo_venta
		WHERE intIdTipoVenta != 2;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOVENTACOTIZACIONEQUIPO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOVENTACOTIZACIONEQUIPO()
	BEGIN
		SELECT * FROM tb_tipo_venta
		LIMIT 2,2;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARSUCURSAL;
DELIMITER $$
	CREATE PROCEDURE MOSTRARSUCURSAL()
	BEGIN
		SELECT * FROM tb_sucursal;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDEPARTAMENTO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDEPARTAMENTO()
	BEGIN
		SELECT * FROM tb_departamentos;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARPROVINCIA;
DELIMITER $$
	CREATE PROCEDURE MOSTRARPROVINCIA(
		IN _intIdDepartamento INT
		)
	BEGIN
		SELECT * FROM tb_provincias
		WHERE intIdDepartamento = _intIdDepartamento;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARDISTRITO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARDISTRITO(
		IN _intIdProvincia INT
		)
	BEGIN
		SELECT * FROM tb_distritos
		WHERE intIdProvincia = _intIdProvincia;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS SELECCIONARPROVINCIA;
DELIMITER $$
	CREATE PROCEDURE SELECCIONARPROVINCIA(
		IN _intIdDepartamento INT
		)
	BEGIN
		SELECT * FROM tb_provincias
		WHERE intIdDepartamento = _intIdDepartamento
		LIMIT 1;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARTIPOCAMBIO;
DELIMITER $$
	CREATE PROCEDURE MOSTRARTIPOCAMBIO()
	BEGIN
		SELECT * FROM tb_tipo_cambio_moneda;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARAUTOR;
DELIMITER $$
	CREATE PROCEDURE MOSTRARAUTOR()
	BEGIN
		SELECT * FROM tb_autor;
    END 
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS MOSTRARPLANTILLACOTIZACION;
DELIMITER $$
	CREATE PROCEDURE MOSTRARPLANTILLACOTIZACION(
		IN _intIdTipoVenta INT
		)
	BEGIN
		SELECT * FROM tb_plantilla_cotizacion
		WHERE intIdTipoVenta = _intIdTipoVenta;
    END 
$$
DELIMITER ;