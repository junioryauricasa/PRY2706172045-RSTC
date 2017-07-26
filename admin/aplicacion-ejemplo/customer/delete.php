<?php
include "../config.php";

$id_cust = $_POST['id_cust'];

mysql_query("delete from customer where id_cust=$id_cust");
if(mysql_error()){
	$result['error']=mysql_error();
	$result['result']=0;
}else{
	$result['error']='';
	$result['result']=1;
}
echo json_encode($result);

?>