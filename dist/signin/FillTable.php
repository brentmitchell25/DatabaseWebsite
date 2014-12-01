<?php

	$conn = mysql_connect('mysql.eecs.ku.edu','bmitchel','hello') or die('Could not connect: ' . mysql_error());
	echo mysql_errno($conn) . ": " . mysql_error($conn) . "\n";
	mysql_select_db('bmitchel');


	$file = file('prescriptions.txt', FILE_IGNORE_NEW_LINES) or die("Couldn't handle file");
	$length = count($file);

	echo $file[3] . "<BR>";
	

	$len = 3500;
	for($i = 1;$i <= $len; $i++) {
	       	     $patientrand = mt_rand(1,1000);
	       	     $doctorrand = mt_rand(1,300);

		     $query = "SELECT years_of_practice from Doctor where doctor_id = '$doctorrand'";
		     $query_result = mysql_query( $query, $conn) or die( mysql_errno($conn) . ": " . mysql_error($conn) . "<BR>");
		     $row = mysql_fetch_array($query_result);
		     $years = $row['years_of_practice'];

		     $date;
		     if($years == 0) {
		     	   $date = date("Y-m-d",mt_rand(1388556000,1417240800));
		     }
		     else{
			$date = date("Y-m-d", mt_rand(strtotime('-$years year',time()),time()));
		     }

//		     $query = "UPDATE Doctor SET hospital_id = '$rand' WHERE doctor_id = '$i'";

		     $query = "INSERT INTO Visit(patient_id,doctor_id,date) VALUES('$patientrand','$doctorrand','$date')";
		     $query_result = mysql_query( $query, $conn) or die( mysql_errno($conn) . ": " . mysql_error($conn) . "<BR>");
//		     echo mysql_errno($conn) . ": " . mysql_error($conn) . "<BR>";

	}

echo 'hello';

?>