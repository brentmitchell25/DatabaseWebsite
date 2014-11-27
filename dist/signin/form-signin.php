<?phpOA
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];

	$queryPatientUsername = "SELECT Patient_Id FROM Patient WHERE Username = '$username'";
	$queryPatientPassword = "SELECT Patient_Id FROM Patient WHERE Password = '$password'";
	$queryDoctorUsername = "SELECT Doctor_Id FROM Doctor WHERE Username = '$username'";
	$queryDoctorPassword = "SELECT Doctor_Id FROM Doctor WHERE Password = '$password'";
	$queryHospitalUsername = "SELECT Hospital_Id FROM Patient WHERE Username = '$username'";
	$queryHospitalPassword = "SELECT Hospital_Id FROM Patient WHERE Password = '$password'";


	$hostName = "mysql.eecs.ku.edu";
	$sqlusername = "bmitchel";
	$sqlpassword = "hello";
	$conn = mysql_connect('mysql.eecs.ku.edu','bmitchel','hello') or die('Could not connect: ' . mysql_error());

	mysql_select_db('bmitchel');
	


$query_result = mysql_query( $query, $conn);
$row = mysql_fetch_array($query_result);
echo $row['Patient_Id'];
?>