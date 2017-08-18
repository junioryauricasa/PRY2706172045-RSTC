<?php
	// mysql connection
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "db_resteco";

	try {
	    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	    die("Error! " . $e->getMessage());
	}
?>