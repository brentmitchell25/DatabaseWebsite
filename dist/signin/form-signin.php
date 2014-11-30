<?php
	session_start();
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
$_SESSION['id'] = 0;
	$queryPatientUsername = "SELECT patient_id FROM Patient WHERE username = '$username'";
	$queryPatientPassword = "SELECT patient_id FROM Patient WHERE password = '$password'";
	$queryDoctorUsername = "SELECT doctor_id FROM Doctor WHERE username = '$username'";
	$queryDoctorPassword = "SELECT doctor_id FROM Doctor WHERE password = '$password'";
	$queryHospitalUsername = "SELECT hospital_id FROM Hospital WHERE username = '$username'";
	$queryHospitalPassword = "SELECT hospital_id FROM Hospital WHERE password = '$password'";


	$conn = mysql_connect('mysql.eecs.ku.edu','bmitchel','hello') or die('Could not connect: ' . mysql_error());
	mysql_select_db('bmitchel');
	

	$query_username = mysql_query( $queryPatientUsername, $conn);
	$query_password = mysql_query( $queryPatientPassword, $conn);
	$rowCountUsername = mysql_num_rows($query_username);
	$rowCountPassword = mysql_num_rows($query_password);
	$username = mysql_fetch_array($query_username);
	$password = mysql_fetch_array($query_password);

	if($username['patient_id'] == $password['patient_id'] and $rowCountUsername > 0 and $rowCountPassword > 0) {
echo 'here1' . "<BR>";
		$_SESSION['id'] = $username['patient_id'];
	} else {
		$query_username = mysql_query( $queryDoctorUsername, $conn);
		$query_password = mysql_query( $queryDoctorPassword, $conn);
		$rowCountUsername = mysql_num_rows($query_username);
		$rowCountPassword = mysql_num_rows($query_password);
		$username = mysql_fetch_array($query_username);
		$password = mysql_fetch_array($query_password);

		if($username['doctor_id'] == $password['doctor_id'] and $rowCountUsername > 0 and $rowCountPassword > 0) {
echo 'here2' . "<BR>";	
		$_SESSION['id'] = $username['doctor_id'];
		}
/*		 else {
			$query_username = mysql_query( $queryHospitalUsername, $conn);
			$query_password = mysql_query( $queryHospitalPassword, $conn);
			$rowCountUsername = mysql_num_rows($query_username);
			$rowCountPassword = mysql_num_rows($query_password);
			$username = mysql_fetch_array($query_username);
			$password = mysql_fetch_array($query_password);
	
			if($username['hospital_id'] == $password['hospital_id'] and $rowCountUsername > 0 and $rowCountPassword > 0) {
				$_SESSION['id'] = $username['hospital_id'];
			}
		}    
*/
	}
	
	echo $_SESSION['id'];
?>