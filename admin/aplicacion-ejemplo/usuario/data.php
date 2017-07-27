<?php
include "../config2.php";
$query=mysql_query("SELECT @rownum := @rownum + 1 AS urutan,t.*
	FROM tb_usuario t, 
	(SELECT @rownum := 0) r");
$data = array();
while($r = mysql_fetch_assoc($query)) {
	$data[] = $r;
}
$i=0;
foreach ($data as $key) {
	// add new button
	$data[$i]['button'] = '
		<button type="submit" intUserId="'.$data[$i]['intUserId'].'" class="btn btn-xs btn-warning btnedit" ><i class="fa fa-edit"></i></button> 
		<button type="submit" intUserId="'.$data[$i]['intUserId'].'" nvchUserName="'.$data[$i]['nvchUserName'].'" class="btn btn-xs btn-danger btnhapus" ><i class="fa fa-remove"></i></button>
		';
	$i++;
}
$datax = array('data' => $data);
echo json_encode($datax);
?>