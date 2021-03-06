<?php
session_start();
include_once 'datos/conexion/bd_conexion.php';
include_once 'funciones/os-detected.php';
include_once 'funciones/hour-ddetected.php';
if (isset($_SESSION['intIdUsuarioSesion'])){
  header("Location: view/default/");
} else if(isset($_SESSION['intIdUsuarioSesion'])!="") {
  header("Location: index");
}
if (isset($_POST['btnIngresar'])) {
  $nvchUserName = $_POST['nvchUserName'];
  $nvchUserPassword = $_POST['nvchUserPassword'];
  try{
      $sql_conexion = new Conexion_BD();
      $sql_conectar = $sql_conexion->Conectar();
      $sql_comando = $sql_conectar->prepare('CALL VERIFICARUSUARIO(:nvchUserName)');
      $sql_comando->execute(array(':nvchUserName' => $nvchUserName));
      $cantidad = $sql_comando -> rowCount();
      if($cantidad == 1) {
        $sql_comando = $sql_conectar->prepare('CALL VERIFICARPASSWORD(:nvchUserName,:nvchUserPassword)');
        $sql_comando->execute(array(':nvchUserName' => $nvchUserName,':nvchUserPassword' => hash('sha256', $nvchUserPassword)));
        $cantidad = $sql_comando -> rowCount();
        if($cantidad == 1) {
          $fila = $sql_comando -> fetch(PDO::FETCH_ASSOC);
          if($fila['bitUserEstado']==1){
            $_SESSION['intIdUsuarioSesion'] = $fila['intIdUsuario'];
            $_SESSION['NombresApellidos'] = $fila['nvchNombres']." ".$fila['nvchApellidoPaterno']." ".$fila['nvchApellidoMaterno'];
            $_SESSION['nvchUserName'] = $fila['nvchUserName'];
            $_SESSION['nvchImgPerfil'] = $fila['nvchImgPerfil'];
            $_SESSION['intIdTipoUsuario'] = $fila['intIdTipoUsuario'];

            if($_SESSION['intIdTipoUsuario'] == 1){
                $_SESSION['NombrePermiso'] = "Administrador";
            } else if ($_SESSION['intIdTipoUsuario'] == 2){
                $_SESSION['NombrePermiso'] = "Vendedor";
            } else if ($_SESSION['intIdTipoUsuario'] == 3){
                $_SESSION['NombrePermiso'] = "Almacenero";
            }

            $sql_comando = $sql_conectar->prepare('CALL INSERTARHISTORIALACCESO(:intIdUsuario,:dtmFechaAcceso,:nvchFechaAcceso,
              :nvchIpOrigen,:nvchNavegador)');
            $sql_comando->execute(array(':intIdUsuario' => $_SESSION['intIdUsuarioSesion'],
                  ':dtmFechaAcceso' => date("Y-m-d H:i:s"),
                  ':nvchFechaAcceso' => $datetimelogin,
                  ':nvchIpOrigen' => getHostByName(getHostName()),
                  ':nvchNavegador' => $ua));
            $_SESSION['intIdCliente'] = 0;
            $_SESSION['intIdProveedor'] = 0;
            $_SESSION['intIdProducto'] = 0;
            header("Location: view/default/");
          }
        } else {
            $MensajeError = '
              <div class="alert alert-warning"  id="success-alert" style="margin-top: 20px">
                     Se te removieron los permisos, conversa con tu administrador
              </div>
              ';
        }
      } else {
            $MensajeError = '
              <div class="alert alert-warning"  id="success-alert" style="margin-top: 20px">
                      Error con los datos de las credenciales
              </div>
              ';
      }
    }
    catch(PDPExceptio $e){
      echo $e->getMessage();
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
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="nvchUserPassword" required="" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <button type="submit" name="btnIngresar" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        <button type="reset" class="btn btn-danger btn-block btn-flat">Limpiar campos</button>
      </div>
    </form>
    <div class="col-12">
        <?php if (isset($MensajeError)) { echo $MensajeError; } ?>
    </div>
    
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
$("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
/*
  END autoclose
*/

</script>
</body>
</html>