<?php
class Conexion_BD
{
	private $bd_hostname = '166.62.72.130';
	private $bd_basededatos = 'db_resteco';
	private $bd_username = 'restecoadmindb';
	private $bd_password = 'restecoadmin123';

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
date_default_timezone_set("America/Lima");
?>