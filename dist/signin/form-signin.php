<?php
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];

	$queryPatientUsername = "SELECT patient_id FROM Patient WHERE username = '$username'";
	$queryPatientPassword = "SELECT patient_id FROM Patient WHERE password = '$password'";
	$queryDoctorUsername = "SELECT doctor_id FROM Doctor WHERE username = '$username'";
	$queryDoctorPassword = "SELECT doctor_id FROM Doctor WHERE password = '$password'";
	$queryHospitalUsername = "SELECT hospital_id FROM Hospital WHERE username = '$username'";
	$queryHospitalPassword = "SELECT hospital_id FROM Hospital WHERE password = '$password'";


	$hostName = "mysql.eecs.ku.edu";
	$sqlusername = "bmitchel";
	$sqlpassword = "hello";
	$conn = mysql_connect('mysql.eecs.ku.edu','bmitchel','hello') or die('Could not connect: ' . mysql_error());

	mysql_select_db('bmitchel');
	

echo 'hello';
$query_result = mysql_query( $queryPatientUsername, $conn);
$row = mysql_fetch_array($query_result);
echo $row['patient_id'];
?>