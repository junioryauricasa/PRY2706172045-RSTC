<?php
//session_start();
require_once '../../datos/conexion/bd_conexion.php';
  
	function ContarUsuarios()
	{
	  $sql_conexion = new Conexion_BD();
	  $sql_conectar = $sql_conexion->Conectar();
	  $busqueda = "";
	  $sql_comando = $sql_conectar->prepare('CALL buscarusuario_ii(:busqueda)');
	  $sql_comando -> execute(array(':busqueda' => $busqueda));
	  $cantidad = $sql_comando -> rowCount();
	  echo $cantidad; 
	}

	function ContarProductos()
	{
	  $sql_conexion = new Conexion_BD();
	  $sql_conectar = $sql_conexion->Conectar();
	  $busqueda = "";
	  $sql_comando = $sql_conectar->prepare('CALL buscarproducto_ii(:busqueda)');
	  $sql_comando -> execute(array(':busqueda' => $busqueda));
	  $cantidad = $sql_comando -> rowCount();
	  echo $cantidad; 
	}

	function ContarClientes()
	{
	  /*
	  $sql_conexion = new Conexion_BD();
	  $sql_conectar = $sql_conexion->Conectar();
	  $busqueda = "";
	  $sql_comando = $sql_conectar->prepare('CALL buscarclientes_ii(:busqueda)');
	  $sql_comando -> execute(array(':busqueda' => $busqueda));
	  $cantidad = $sql_comando -> rowCount();
	  echo $cantidad; 
	  */
	}

	function ContarEmpleados()
	{
	  /*
	  $sql_conexion = new Conexion_BD();
	  $sql_conectar = $sql_conexion->Conectar();
	  $busqueda = "";
	  $sql_comando = $sql_conectar->prepare('CALL buscarempleados_ii(:busqueda)');
	  $sql_comando -> execute(array(':busqueda' => $busqueda));
	  $cantidad = $sql_comando -> rowCount();
	  echo $cantidad; 
	  */
	}

?>