<?php
class Conexion_BD
{
	public static $db = false;
	private $bd_hostname = 'localhost';
	private $bd_basededatos = 'db_resteco';
	private $bd_username = 'root';
	private $bd_password = '';


	public function Conectar()
	{
        try {
        	$strDSN = "mysql:host=$this->bd_hostname;dbname=$this->bd_basededatos;";  
            $username = $this->bd_username;
            $pass = $this->bd_password;
            $conn = new PDO($strDSN, $username, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
           echo $e->getMessage();
        }
	}
}
/*
	$bd_hostname = 'localhost';
	$bd_basededatos = 'db_resteco';
	$bd_username = 'root';
	$bd_password = '';

	try{
	  $bd_conexion = new PDO("mysql:host={$bd_hostname};dbname={$bd_basededatos}",$bd_username,$bd_password);
	  $bd_conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 }
	 catch(PDOException $e){
	  echo $e->getMessage();
	 }
*/
?>