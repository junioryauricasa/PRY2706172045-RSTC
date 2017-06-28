<?php
session_start();

if(isset($_SESSION['user_session'])!="") {
	header("Location: index.php");
}

include_once 'dbconnect.php';

//Comprobar de envío el formulario
if (isset($_POST['login'])) {

	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$result = mysqli_query($con, "SELECT * FROM tb_user WHERE nchUserMail = '" . $email. "' and nvchUserPassword = '" . md5($password) . "'");

	if ($row = mysqli_fetch_array($result)) {
		//$_SESSION['usr_estado'] = $row['estado'];

		if($row['bitUserEstado']==1){ //Verificacion de estado activo = 1
			$_SESSION['user_session'] = $row['intUserId'];
			$_SESSION['usr_name'] = $row['nchUserMail'];
			
			header("Location: admin/index.php");
		}else
		//$errormsg = "Esta cuenta esta desactivada, conversa con tu administrador";
		$errormsg = "Se te removieron los permisos, conversa con tu administrador";
	} else {
		$errormsg = "Revisa los datos!!!";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inicio de session</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />

	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- add header -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php" style="font-family: 'Lobster', cursive;">devHuayra</a>
		</div>
		<!-- menu items -->
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="login.php">Login</a></li>
				<li><a href="register.php">Registro</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<fieldset>
					<legend>Login</legend>
					<!--div class="form-group clearfix">
						<img src="http://www.iconsfind.com/wp-content/uploads/2016/10/20161014_58006bff8b1de.png" alt="" width="200px" class="img-responsive img-circle" style="margin:0 auto">
					</div-->

					<div class="form-group">
						<label for="name">E-mail</label>
						<input type="email" name="email" placeholder="Ingresar Email" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="name">Contraseña</label>
						<input type="password" name="password" placeholder="Ingresar Contraseña" required class="form-control" />
					</div>

					<div class="form-group">
						<input type="submit" name="login" value="Iniciar Sesion" class="btn btn-primary" />
						<input type="reset" value="Limpiar" class="btn btn-default" >
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		No tienes cuenta? <a href="register.php">Regitrate aqui</a>
		</div>
	</div>
</div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
