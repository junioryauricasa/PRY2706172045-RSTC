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

if (isset($_SESSION['intIdUsuario'])){
  header("Location: view/default/");
}else if(isset($_SESSION['intIdUsuario'])!="") {
  header("Location: index");
}

include_once 'datos/conexion/bd_conexion.php';
include_once 'funciones/os-detected.php';
include_once 'funciones/hour-ddetected.php';

//Comprobar el envío el formulario
if (isset($_POST['login'])) {

  $nvchUserName = $_POST['nvchUserName'];
  $nvchUserPassword = $_POST['nvchUserPassword'];

  try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL VERIFICARUSUARIO(:nvchUserName)');
      $sql_comando->execute(array(':nvchUserName' => $nvchUserName));
      $cantidad = $sql_comando -> rowCount();
      if($cantidad >= 1) {
        $sql_comando = $sql_conectar->prepare('CALL VERIFICARPASSWORD(:nvchUserPassword)');
        $sql_comando->execute(array(':nvchUserName' => $nvchUserName,
              ':nvchUserPassword' => hash('sha256', $nvchUserPassword)));
        $cantidad = $sql_comando -> rowCount();
        if($cantidad >= 1) {
          if($row['bitUserEstado']==1){
            $_SESSION['intIdUsuario'] = $row['intUserId'];
            $_SESSION['nvchUserName'] = $row['nvchUserName'];
            $_SESSION['nvchImgPerfil'] = $row['nvchImgPerfil'];
            $_SESSION['intIdTipoUsuario'] = $row['intIdTipoUsuario'];

            if($_SESSION['intIdTipoUsuario'] == 1){
                $_SESSION['NombrePermiso'] = "Administrador";
            } else if ($_SESSION['intIdTipoUsuario'] == 2){
                $_SESSION['NombrePermiso'] = "Vendedor";
            } else if ($_SESSION['intIdTipoUsuario'] == 3){
                $_SESSION['NombrePermiso'] = "Almacenero";
            } 
            header("Location: view/default/");
            }
        } else {

        }
      } else {

      }
      echo "ok";
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
    }

  $result = mysqli_query($con, "SELECT * FROM tb_usuario WHERE nvchUserName = '" . $email. "' and nvchUserPassword = '" . hash('sha256', $password) . "'");

  if ($row = mysqli_fetch_array($result)) {

    if($row['bitUserEstado']==1){
      $_SESSION['intIdUsuario'] = $row['intUserId'];
      $_SESSION['nvchUserName'] = $row['nvchUserName'];
      $_SESSION['nvchImgPerfil'] = $row['nvchImgPerfil'];
      $_SESSION['intIdTipoUsuario'] = $row['intIdTipoUsuario'];

      // Verificando permisos del usuario
      if($_SESSION['intIdTipoUsuario'] == 1){
          $_SESSION['NombrePermiso'] = "Administrador";
      } else if ($_SESSION['intIdTipoUsuario'] == 2){
          $_SESSION['NombrePermiso'] = "Vendedor";
      } else if ($_SESSION['intIdTipoUsuario'] == 3){
          $_SESSION['NombrePermiso'] = "Almacenero";
      }
      // END Verificando permisos del usuario     


        // INSERT History access
        $sql = "INSERT INTO tb_historyaccess (intIdHistory, intIdUser, dateDateAccesso, nvchIpAccesso, nvchBrowser) VALUES (NULL, '".$_SESSION['user_session']."', '".$datetimelogin."', '193.10.14.12', '".$ua."');";

        if (mysqli_query($con, $sql)){
          //header("Location: frameworks/index");
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
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="frameworks/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="frameworks/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="frameworks/plugins/iCheck/square/blue.css">
  <link rel="shortcut icon" type="image/png" href="frameworks/dist/img/icons/025-pie-chart.png"/>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#">
      <img src="frameworks\dist\img/logoResteco-for_init.JPG" alt="" width="100%">
    </a>
  </div>
  <div class="login-box-body">
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Ingrese Usuario" name="nvchUserName" required="" autocomplete="off">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="nvchUserPassword" required="" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" name="login" class="col-xs-6 btn btn-primary btn-block btn-flat">Ingresar</button>
          <button type="reset" class="col-xs-6 btn btn-danger btn-block btn-flat">Limpiar campos</button>
        </div>
      </div>
    </form>
    <div class="col-12">
        <?php if (isset($errormsg)) { echo $errormsg; } ?>
    </div>
    <br>
    <!--
    <a href="#">Olvide mi contraseña</a>
    <a href="#" class="text-center">Registrar nuevo cuenta</a>
    -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="frameworks/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="frameworks/bootstrap/js/bootstrap.min.js"></script>
<script src="frameworks/plugins/iCheck/icheck.min.js"></script>
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