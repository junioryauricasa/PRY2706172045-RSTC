<?php 

	mysql_connect('localhost','root','');
	mysql_select_db('db_resteco');

	$Accion = $_REQUEST['Accion'];
	if(is_callable($Accion)){
		$Accion();
	}

	function GetDepartamentos(){
		header('Content-Type: application/json');
		$Departamentos = array();
		$Consulta = mysql_query("SELECT * FROM departamentos");
		while ($Fila = mysql_fetch_assoc($Consulta)) {
			$Departamentos[] = $Fila;
		}
		echo json_encode($Departamentos);
	}

	function GetProvincias(){
		header('Content-Type: application/json');
		$Provincias = array();
		$Consulta = mysql_query("SELECT * FROM provincias WHERE IdDepartamento = ".$_REQUEST['IdDepartamento']);
		while ($Fila = mysql_fetch_assoc($Consulta)) {
			$Provincias[] = $Fila;
		}
		echo json_encode($Provincias);
	}

	function GetDistritos(){
		header('Content-Type: application/json');
		$Distritos = array();
		$Consulta = mysql_query("SELECT * FROM distritos WHERE IdProvincia = ".$_REQUEST['IdProvincia']);
		while ($Fila = mysql_fetch_assoc($Consulta)) {
			$Distritos[] = $Fila;
		}
		echo json_encode($Distritos);
	}

 ?>