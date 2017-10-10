<?php
session_start();

if(isset($_SESSION['intIdUsuarioSesion'])) {
	session_destroy();
	unset($_SESSION['intIdUsuarioSesion']);
	unset($_SESSION['nvchUserName']);
	unset($_SESSION['intIdTipoUsuario']);

	header("Location: index");
} else {
	header("Location: index");
}
?>
