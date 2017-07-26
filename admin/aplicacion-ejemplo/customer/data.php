<?php
include "../config.php";
$query=mysql_query("SELECT @rownum := @rownum + 1 AS urutan,t.*
	FROM customer t, 
	(SELECT @rownum := 0) r");
$data = array();
while($r = mysql_fetch_assoc($query)) {
	$data[] = $r;
}
$i=0;
foreach ($data as $key) {
		// add new button
	$data[$i]['button'] = '
				<button type="submit" id_cust="'.$data[$i]['id_cust'].'" class="btn btn-xs btn-warning btnedit" ><i class="fa fa-edit"></i></button> 
				<button type="submit" id_cust="'.$data[$i]['id_cust'].'" name_cust="'.$data[$i]['name'].'" class="btn btn-xs btn-danger btnhapus" ><i class="fa fa-remove"></i></button>
				';
	$i++;
}
$datax = array('data' => $data);
echo json_encode($datax);
?>