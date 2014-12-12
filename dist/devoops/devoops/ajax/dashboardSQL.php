<?php
	session_start();
	$conn = mysql_connect('mysql.eecs.ku.edu','bmitchel','hello') or die('Could not connect: ' . mysql_error());
	mysql_select_db('bmitchel');

	$id = $_SESSION['id'];
	$name = $_SESSION['name'];
	if($_SESSION['permission'] == 'patient_id') {
	       $permissionid = $_SESSION['permission'];
	} else if($_SESSION['permission'] == 'doctor_id') {
	       $permissionid = $_SESSION['permission'];
	} else if($_SESSION['permission'] == 'hospital_id') {
	       $permissionid = $_SESSION['permission'];
	}

//	echo 'Docotor id: ' . $id . '<BR>';
	$sql = "SELECT p.patient_id, v.doctor_id, first_name, last_name, prescription, refill, date "
	. "FROM Patient p, Prescription r, Visit v "
	. "WHERE v.patient_id = p.patient_id "
	. "AND v.patient_id = r.patient_id "
	. "AND v.doctor_id = '$id' ORDER BY `p`.`patient_id` ASC";

	$query = mysql_query($sql,$conn);
	$row = mysql_fetch_array($query);
	$rowCount = mysql_num_rows($query);
	
	$arr = array();
	while($row = mysql_fetch_assoc($query)) {
	       array_push($arr,$row['patient_id'],$row['first_name'] . ' ' . $row['last_name'], $row['prescription'], $row['refill'],$row['date']);
	}
	$jsonArr = array("numberOfColumns" => 4, "name" => $name, "array" => $arr);
header("Content-Type: application/json; charset=utf-8", true);
//	echo json_encode(array("result" => 2));
	echo json_encode($jsonArr);


?>