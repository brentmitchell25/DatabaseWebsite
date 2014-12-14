<?php
	session_start();
	$conn = mysql_connect('mysql.eecs.ku.edu','bmitchel','hello') or die('Could not connect: ' . mysql_error());
	mysql_select_db('bmitchel');

	$id = $_SESSION['id'];
	$name = $_SESSION['name'];
	if($_SESSION['permission'] == 'patient_id') {
	$sql = "select p.patient_id, first_name,last_name,email,phone_number, prescription, refill "
    . "from Patient p, Prescription r "
    . "where p.patient_id = '$id' and p.patient_id = r.patient_id "
    . "Order by prescription";

	$query = mysql_query($sql,$conn);
	$arr = array();

	while($row = mysql_fetch_array($query)) {
	       array_push($arr,$row['patient_id'],$row['first_name'] . ' ' . $row['last_name'], $row['email'], $row['phone_number'],$row['prescription'],$row['refill']);

	}

	} else if($_SESSION['permission'] == 'doctor_id') {

	$sql = "SELECT p.patient_id, r.doctor_id, first_name, last_name, prescription, refill, MAX(date) as date "
	. "FROM Patient p, Prescription r, Visit v "
	. "WHERE r.patient_id = p.patient_id "
	. "AND r.doctor_id = '$id' "
	. "AND v.patient_id = r.patient_id "
	. "GROUP BY prescription,r.patient_id "
	. "ORDER BY p.patient_id ASC";

	$query = mysql_query($sql,$conn);
	$arr = array();

	while($row = mysql_fetch_array($query)) {
	       array_push($arr,$row['patient_id'],$row['first_name'] . ' ' . $row['last_name'], $row['prescription'], $row['refill'],$row['date']);
	}

	} else if($_SESSION['permission'] == 'hospital_id') {
$sql = "select doctor_id, first_name, last_name, d.email, phone_number, speciality "
    . "from Hospital h, Doctor d "
    . "where h.hospital_id = d.hospital_id and h.hospital_id = '$id'";

	$query = mysql_query($sql,$conn);
	$arr = array();

	while($row = mysql_fetch_array($query)) {
	       array_push($arr,$row['doctor_id'],$row['first_name'] . ' ' . $row['last_name'], $row['email'], $row['phone_number'],$row['speciality']);
	}

	}

	$jsonArr = array("permission" => $_SESSION['permission'], "name" => $name, "array" => $arr);
	echo json_encode($jsonArr);


?>