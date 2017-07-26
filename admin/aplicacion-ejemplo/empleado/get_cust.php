<?php
include "../config.php";

$id_cust=$_POST['id_cust'];
$query=mysql_query("select * from customer where id_cust=$id_cust");
$array = array();
while($data = mysql_fetch_array($query)){
	$array['id_cust']= $data['id_cust'];
	$array['name']= $data['name'];
	$array['gender']= $data['gender'];
	$array['country']= $data['country'];
	$array['phone']= $data['phone'];

}
echo json_encode($array);

?>