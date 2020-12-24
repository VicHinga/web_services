<?php
header("Content-Type:application/json");
if (isset($_GET['tsp_id']) && $_GET['tsp_id']!="") {
	include('db.php');
	$tsp_id = $_GET['tsp_id'];
	$result = $db->query("SELECT students.id as stdid,students.name as stdname,round,course,tsp.name as tspname FROM students,tsp WHERE tsp_id=$tsp_id and tsp.id = $tsp_id");
	if(mysqli_num_rows($result)>0){
		$stdArr["data"] = array();
		while($row=$result->fetch_assoc()){
			array_push($stdArr["data"], $row);
		}
		echo json_encode($stdArr);
	}
}
?>