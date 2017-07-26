<?php
$host="localhost";
$user="root";
$pwd="";
$dbname="db_resteco";

$link=mysql_connect($host,$user,$pwd);
$db = mysql_select_db($dbname,$link);
if(!$db) die("Error en la coneccion de la DB.......");

?>