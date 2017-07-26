<?php
include "../config2.php";

$intUserId = $_POST['intUserId'];
$nvchUserName = $_POST['nvchUserName'];
$nchUserMail = $_POST['nchUserMail'];
$nvchUserPassword = $_POST['nvchUserPassword'];
$intIdEmpleado = $_POST['intIdEmpleado'];//empleado id
$bitUserEstado = $_POST['bitUserEstado'];
$intTypeUser = $_POST['intTypeUser'];

$db_resteco=$_POST['db_resteco'];

if($db_resteco=='N'){
	mysql_query("
		insert into tb_usuario(
				nvchUserName,
				nchUserMail,
				nvchUserPassword,
				intIdEmpleado,
				bitUserEstado,
				intTypeUser
			) 
			values(
				'$nvchUserName',
				'$nchUserMail',
				'$nvchUserPassword',
				'$intIdEmpleado',
				'$bitUserEstado',
				'$intTypeUser'
			)
		");
	if(mysql_error()){
		$result['error']=mysql_error();
		$result['result']=0;
	}else{
		$result['error']='';
		$result['result']=1;
	}
}else if($db_resteco == 'E'){
	mysql_query("update tb_usuario set nvchUserName='$nvchUserName',nchUserMail='$nchUserMail',nvchUserPassword='$nvchUserPassword',intIdEmpleado='$intIdEmpleado', bitUserEstado='$bitUserEstado', intTypeUser='$intTypeUser' where intUserId=$intUserId");
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
$result['db_resteco']=$db_resteco;
echo json_encode($result);

?>