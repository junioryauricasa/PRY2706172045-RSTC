<?php
include "../config2.php";

$tb_usuario = $_POST['tb_usuario'];

mysql_query("delete from tb_usuario where tb_usuario=$tb_usuario");
if(mysql_error()){
	$result['error']=mysql_error();
	$result['result']=0;
}else{
	$result['error']='';
	$result['result']=1;
}
echo json_encode($result);

?>