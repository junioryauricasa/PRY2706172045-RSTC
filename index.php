<?php
/*
  ------------------------------
  Autor: Junior Yauricasa
  Fecha: 23-06-2017
  Descripcion: 
    1.- Login Usuario con verificacion de inicio de session (si existe user_session redirecciona hacia el panel de control de caso contrario no permite ingresar)
  ------------------------------
*/

session_start();

if (isset($_SESSION['user_session'])){
  //header("Location: admin/index");
  header("Location: view/default/");
}else 
if(isset($_SESSION['user_session'])!="") {
  header("Location: index");
}

include_once 'dbconnect.php'; //archivo de coneccion
include_once 'funciones/os-detected.php'; //detectar OS
//include_once 'funciones/ip-detected.php'; //detectar IP, descomentar esta parte cuando se implemente en red
include_once 'funciones/hour-ddetected.php'; //detectar hora


//Comprobar el envío el formulario
if (isset($_POST['login'])) {

  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['password']);

  $result = mysqli_query($con, "SELECT * FROM tb_usuario WHERE nchUserMail = '" . $email. "' and nvchUserPassword = '" . md5($password) . "'");

  if ($row = mysqli_fetch_array($result)) {
    //$_SESSION['usr_estado'] = $row['estado'];

    if($row['bitUserEstado']==1){ //Verificacion de estado activo = 1
      $_SESSION['user_session'] = $row['intUserId'];
      $_SESSION['usr_name'] = $row['nvchUserName'];
      
      $_SESSION['usr_photo'] = $row['nvchImgPerfil']; //foto usuario

      $_SESSION['user_typeuser'] = $row['intTypeUser'];

      // Verificando permisos del usuario
      if($_SESSION['user_typeuser'] == 0){
          $_SESSION['user_typeuser'] = "Usuario";
      }else 
      if ($_SESSION['user_typeuser'] == 1){
          $_SESSION['user_typeuser'] = "Administrador";
      }
      // END Verificando permisos del usuario     


        // INSERT History access
        $sql = "INSERT INTO tb_historyaccess (intIdHistory, intIdUser, dateDateAccesso, nvchIpAccesso, nvchBrowser) VALUES (NULL, '".$_SESSION['user_session']."', '".$datetimelogin."', '193.10.14.12', '".$ua."');";

        if (mysqli_query($con, $sql)){
          //header("Location: admin/index");
          header("Location: view/default/");
        }else 
        echo "algo sucedio mal";

    }else
    //$errormsg = "Esta cuenta esta desactivada, conversa con tu administrador";
    $errormsg = '
        <div class="alert alert-warning"  id="success-alert" style="margin-top: 20px">
               Se te removieron los permisos, conversa con tu administrador
        </div>
        ';
  } else {
    $errormsg = '
        <div class="alert alert-warning"  id="success-alert" style="margin-top: 20px">
              Revisa los datos!!!
        </div>
        ';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RestecoSFT | Acceso Control Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="admin/plugins/iCheck/square/blue.css">


  <!--
      logo icon
  -->
  <link rel="shortcut icon" type="image/png" href="admin/dist/img/icons/025-pie-chart.png"/>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <!--a href="#"><b>Resteco</b>SFT</a-->
    <a href="#">
      <img src="frameworks\dist\img/logoResteco-for_init.JPG" alt="" width="100%">
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <!--p class="login-box-msg">Login Resteco Platform</p-->

    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Ingrese Email" name="email" required="" autocomplete="off">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="password" required="" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!--div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Recordarme cuenta
            </label>
          </div>
        </div-->
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="login" class="col-xs-6 btn btn-primary btn-block btn-flat">Ingresar</button>
          <button type="reset" class="col-xs-6 btn btn-danger btn-block btn-flat">Limpiar campos</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!--
      span mensaje respuesta servidor despues de consulta
    -->
    <div class="col-12">
        <?php if (isset($errormsg)) { echo $errormsg; } ?>
    </div>

    <!--div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div-->
    <!-- /.social-auth-links -->

    <br>
    <a href="#">Olvide mi contraseña</a>
    <a href="#" class="text-center">Registrar nuevo cuenta</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });


/*
  ------------------------------
  Autor: Junior Yauricasa
  Fecha: 27-06-2017
  Descripcion: 
    1.- Alert autoclose
  ------------------------------
*/
$("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
/*
  END autoclose
*/

</script>
</body>
</html>