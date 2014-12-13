<?php   
	session_start();
    $doctorId = $_SESSION['id'];
    $patientId = $_REQUEST["PATIENT_ID"];
    $prescription = $_REQUEST["PRESCRIPTION"];
    $refill = $_REQUEST["REFILL"];
    $conn = mysql_connect('mysql.eecs.ku.edu','bmitchel','hello') or die('Could not connect: ' . mysql_error());
	mysql_select_db('bmitchel');
$sql = "update Prescription set refill = '$refill' where patient_id = '$patientId' and doctor_id = '$doctorId' and prescription = '$prescription'";

	$query = mysql_query($sql,$conn);
$arr = array("success" => mysql_error());
     

    echo json_encode($arr);
?>