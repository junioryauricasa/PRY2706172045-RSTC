<?php
include "../config.php";

$id_cust = $_POST['id_cust'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$phone = $_POST['phone'];
$crud=$_POST['crud'];

if($crud=='N'){
	mysql_query("insert into customer(name,gender,country,phone) values('$name','$gender','$country','$phone')");
	if(mysql_error()){
		$result['error']=mysql_error();
		$result['result']=0;
	}else{
		$result['error']='';
		$result['result']=1;
	}
}else if($crud == 'E'){
	mysql_query("update customer set name='$name',gender='$gender',country='$country',phone='$phone' where id_cust=$id_cust");
	if(mysql_error()){
		$result['error']=mysql_error();
		$result['result']=0;
	}else{
		$result['error']='';
		$result['result']=1;
	}
}else{

	$result['error']='Invalid Order';
	$result['result']=0;
}
$result['crud']=$crud;
echo json_encode($result);

?>