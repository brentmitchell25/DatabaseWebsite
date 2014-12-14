<?php
ini_set("display_errors", TRUE);
	session_start();
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$_SESSION['id'] = 0;
	$_SESSION['permission'] = 'none';
	$patientLogin = "SELECT patient_id,first_name,last_name FROM Patient WHERE username = '$username' AND password = '$password'";
	$doctorLogin = "SELECT doctor_id,first_name,last_name FROM Doctor WHERE username = '$username' AND password = '$password'";
	$hospitalLogin = "SELECT hospital_id, name FROM Hospital WHERE username = '$username' AND password = '$password'";

	$conn = mysql_connect('mysql.eecs.ku.edu','bmitchel','hello') or die('Could not connect: ' . mysql_error());
	mysql_select_db('bmitchel');
	
	$patient = mysql_query( $patientLogin, $conn);
	$rowCountLogin = mysql_num_rows($patient);
	$login = mysql_fetch_array($patient);

	if($rowCountLogin > 0) {
		$_SESSION['id'] = $login['patient_id'];
		$_SESSION['name'] = $login['first_name'] . ' ' . $login['last_name'];
		$_SESSION['permission'] = 'patient_id';

	} else {
		$doctor = mysql_query( $doctorLogin, $conn);
		$rowCountLogin = mysql_num_rows($doctor);
		$login = mysql_fetch_array($doctor);

		if($rowCountLogin > 0) {
			$_SESSION['id'] = $login['doctor_id'];
			$_SESSION['name'] = $login['first_name'] . ' ' . $login['last_name'];
			$_SESSION['permission'] = 'doctor_id';
		}
		 else {
		 	$hospital = mysql_query( $hospitalLogin, $conn);
			$rowCountLogin = mysql_num_rows($hospital);
			$login = mysql_fetch_array($hospital);
	
			if($rowCountLogin > 0) {
				$_SESSION['id'] = $login['hospital_id'];
				$_SESSION['name'] = trim($login['name']);
				$_SESSION['permission'] = 'hospital_id';

			}
		}    

	}
	if($_SESSION['id'] > 0) {
			   header("Location:http://people.eecs.ku.edu/~bmitchel/DatabaseWebsite/dist/devoops/devoops/");
	} else {
		   header("Location:http://people.eecs.ku.edu/~bmitchel/DatabaseWebsite/dist/signin/");
	}
?>