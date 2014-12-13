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
$sql = "SELECT p.patient_id, r.doctor_id, first_name, last_name, prescription, refill, MAX(date) as date "
    . "FROM Patient p, Prescription r, Visit v "
    . "WHERE r.patient_id = p.patient_id "
    . "AND r.doctor_id = '$id' "
    . "AND v.patient_id = r.patient_id "
    . "GROUP BY prescription,r.patient_id "
    . "ORDER BY p.patient_id ASC";

	$query = mysql_query($sql,$conn);
	$row = mysql_fetch_array($query);
	$rowCount = mysql_num_rows($query);
	
	$arr = array();
	while($row = mysql_fetch_assoc($query)) {
	       array_push($arr,$row['patient_id'],$row['first_name'] . ' ' . $row['last_name'], $row['prescription'], $row['refill'],$row['date']);
	}
	$jsonArr = array("numberOfColumns" => 4, "name" => $name, "array" => $arr);
	echo json_encode($jsonArr);


?>