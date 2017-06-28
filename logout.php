<?php
session_start();

if(isset($_SESSION['user_session'])) {
	session_destroy();
	unset($_SESSION['user_session']);
	unset($_SESSION['usr_name']);
	header("Location: index.php");
} else {
	header("Location: index.php");
}
?>