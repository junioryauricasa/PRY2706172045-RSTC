<?php
session_start();

if(isset($_SESSION['user_session'])) {
	session_destroy();
	unset($_SESSION['user_session']);
	unset($_SESSION['usr_name']);
	unset($_SESSION['user_typeuser']);

	header("Location: index");
} else {
	header("Location: index");
}
?>
