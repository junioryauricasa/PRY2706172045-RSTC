<?php
include "../config2.php";

$intUserId = $_POST['intUserId'];

mysql_query("delete from tb_usuario where intUserId=$intUserId");
if(mysql_error()){
	$result['error']=mysql_error();
	$result['result']=0;
}else{
	$result['error']='';
	$result['result']=1;
}
echo json_encode($result);

?>