<?php
  session_start();
  require '../../datos/conexion/bd_conexion.php';
  $sql_conexion = new Conexion_BD();
  $sql_conectar = $sql_conexion->Conectar();
  $sql_comando = $sql_conectar->prepare('CALL INSERTARIMAGENUSUARIO(:intUserId,:nvchImgPerfil);');
  $sql_comando->execute(array(
    ':intUserId' => $_SESSION["user_session"],
    ':nvchImgPerfil' => $nvchDireccionImg)
  );