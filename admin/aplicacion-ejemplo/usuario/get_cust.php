<?php
include "../config2.php";

$intUserId=$_POST['intUserId'];
$query=mysql_query("select * from tb_usuario where intUserId=$intUserId");
$array = array();
while($data = mysql_fetch_array($query)){
	$array['intUserId']= $data['intUserId'];
	$array['nvchUserName']= $data['nvchUserName'];
	$array['nchUserMail']= $data['nchUserMail'];
	$array['nvchUserPassword']= $data['nvchUserPassword'];

	$array['bitUserEstado']= $data['bitUserEstado'];
	$array['intTypeUser']= $data['intTypeUser'];

}
echo json_encode($array);

?>